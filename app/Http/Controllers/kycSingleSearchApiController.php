<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use App\Models\Crif;
use App\Models\User;
use Redirect;
use Exception;
use App\Models\Rcfull;
use ZipArchive;
use DOMDocument;
use App\Models\ApiMaster;
use Carbon\Carbon;
use App\Models\Transaction;
use GuzzleHttp\Psr7;
use App\Models\SchemeMaster;
use GuzzleHttp\Client;
use App\Models\HitCountMaster;
use App\Helpers\RcExport;
use App\Models\SchemeTypeMaster;
use App\Models\UserSchemeMaster;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Export;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Events\AfterSheet;
use GuzzleHttp\Exception\ClientException;
use Maatwebsite\Excel\Concerns\FromArray;
use GuzzleHttp\Exception\RequestException;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Readers\ReadersImport;
use GuzzleHttp\Exception\BadResponseException;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EquifaxScoreApi;



class kycSingleSearchApiController extends Controller
{
    private $crif_url = 'https://loantap.in/affiliate/apiv1-1/docboyz/crif';

    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    // private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MjUzOTIyMTYsImp0aSI6IjhkOWZmNTFiLTJiYmItNDc4My1iYmI5LTg5ZWMzNGY3MDNmZiIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsImZyZXNoIjpmYWxzZSwiaWF0IjoxNTkzODU2MjE2LCJuYmYiOjE1OTM4NTYyMTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19LCJ0eXBlIjoiYWNjZXNzIn0.f0Ea5UmL_DQsSCBF6sWJzU-n7NPT9TL_IkKFY_a-3KQ';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

    public function transaction_id()
    {
        $str_result = '1234567890';
        $transaction_gen = substr(str_shuffle($str_result), 0, 12);

        $transaction = Transaction::where('transaction_id', $transaction_gen)->first();
        if ($transaction) {
            $transaction_gen = substr(str_shuffle($str_result), 0, 12);
        }

        return $transaction_gen;
    }

    public function update_transaction($api_id, $amount, $remark, $statusCode)
    {
        $transaction = new Transaction();
        $transaction->transaction_id = $this->transaction_id();
        $transaction->user_id = Auth()->user()->id;
        $transaction->api_id = $api_id; //work
        $transaction->type_creditdebit = 'Debit';
        $transaction->scheme_price = $amount; //work
        if ($statusCode == 200) {
            $transaction->status = 'Success';
        } else {
            $transaction->status = 'Failed';
        }
        $transaction->status_code = $statusCode;
        // $transaction->status = 'Success';
        $transaction->amount = $amount;
        $transaction->remark = $remark;
        $transaction->updated_balance = Auth()->user()->wallet_amount - $amount;
        $transaction->save();
    }

    public function update_wallet_balance($amount)
    {
        $userwallet = User::where('id', Auth()->user()->id)->first();
        // $userwallet->wallet_amount = $userwallet->wallet_amount - $amount;
        $userwallet->wallet_amount = $userwallet->wallet_amount;
        $userwallet->save();
    }

    public function searchApi(Request $request)
    {
        $statusCode = null;
        $bhunakshstatusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $rc_validation = null;
        $checkWeight = null;
        $voter_validation = null;
        $aadhaar_validation = null;
        $aadhaar_otp_genrate = null;
        $license_validation = null;
        $udyamcard = null;
        $upidetails = null;
        $pancard = null;
        $voterid = null;
        $passport = null;
        $aadhaar_masking = null;
        $aadharcardocr = null;
        $lincensedocr = null;
        $bhunakasha = null;
        $verify_address = null;
        $get_place = null;
        $create_geofence = null;
        $get_coordinate = null;
        $auto_complate = null;
        $udyamaadhar = null;
        $searchkyclite = null;
        $udyamcardv2 = null;
        $bankstatment = null;
        $pantogstDetails = null;
        $BasicGstinVerification = null;
        $pan_cards = null;
        $corporate_basic = null;
        $corporate_advance = null;
        $dedupe_details = null;
        $score_api_success_message = null;
        $score_api_message = null;
        $equifax = null;
        $check_verify_email_status = null;
        $verify_email = null;
        $statusCodeCkyc = null;
        $searchkyc = null;
        $telecom = null;
        $statusTeleComCode = null;
        $corporate_gstin = null;
        $statusCodeGstin = null;
        $statusCodeIfsc = null;
        $bank_verification_ifsc = null;
        $pancardVerification = null;
        $statusCodepanVerification = null;
        $pancardInfoDetails = null;
        $pancardnew_details = null;
        $passportverify = null;
        $bankstatement_analyser = null;
        $face_match = null;
        $aadhaarOCR1 = null;
        $aadhaar1 = null;
        $statusCodeAadhaarUpload = null;
        $aadhaar_masking1 = null;
        $statusCodevoterUpload = null;
        $voter_detailed_info_upload = null;
        $voteruplode = null;
        $statusCodepanUpload = null;
        $pancardupload2 = null;
        $pancarduploade = null;
        $passport_create_client = null;
        $passport_verification_upload = null;
        $statusCodeUploadPassport = null;
        $passport_verify1 = null;
        $corporate_cin1 = null;
        $statusCodeCorporate = null;
        $corporate_din1 = null;
        $rc_validationTest = null;
        $rc_validationLite = null;
        $fast_tag_information = null;
        $passportUpload = null;
        $rc_challan = null;
        $bank_statement2 = null;
        $bank_verification = null;
        $licenseUpload = null;
        $license_upload_validation = null;
        $electricity = null;
        $shopestablishment = null;
        $fssi_validation = null;
        $epfo_details = null;
        $uan_details = null;
        $company_search = null;
        $company_details = null;
        $pancard_search = null;
        $pancard_search_lite = null;
        $bypancard_details = null;
        $gstin_details = null;
        $land_details = null;
        $community_details = null;
        $pincode_details = null;
        $image_scanner_details = null;
        $facematch_details = null;
        $detection_emotion_details = null;
        $aadharcard_extract = null;
        $lincense_extract = null;
        $extract_pancard_text = null;
        $extract_voterid = null;
        $facematch_details1 = null;
        $predictppl_details = null;
        if ($request->isMethod('GET')) {
            return view('kyc.single_search', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        if ($request->isMethod('POST')) {

            if (!empty($request->apies) && $request->get('apies') == "RcValidation") {

                $client = new Client();
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'rc_number' => $request->rc_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'rc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $rc_validation = json_decode($res->getBody(), true);
                        
                        $rc_validation_response = null;
                        if (isset($rc_validation['rc_validation']['data']['vehicle_gross_weight']) || (isset($rc_validation['status_code']) && $rc_validation['status_code'] == 200)) {
                            
                            $grossWeight = $rc_validation['rc_validation']['data']['vehicle_gross_weight'];
                            $statusCode = 200;
                            if ($grossWeight == null) {
                                $grossWeight = 0;
                            }
                            $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)
                                ->Where('max_weight', '>=', $grossWeight)
                                ->first();
                            $apimaster = ApiMaster::where('api_slug', 'rc')->first();
                            $rc_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->pluck('permission');
                                
                            if (count($rc_response_filed) > 0 && $rc_response_filed != null) {
                                $rc_response_data = explode(',', $rc_response_filed[0]);
                                $rc_validation['rc_validation']['data']['rc'] = null;
                                foreach ($rc_response_data as $item) {
                                    $rc_validation_response['rc_validation']['data'][$item] = $rc_validation['rc_validation']['data'][$item];
                                }
                                
                                return view('kyc.single_search', compact('rc_validation_response', 'checkWeight', 'statusCode', 'hit_limits_exceeded'));
                            }
                        } elseif (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == 102) {
                            $statusCode = $rc_validation['statusCode'];
                        } else {
                            $statusCode = $rc_validation['statusCode'];
                        }
                    } catch (BadResponseException $e) {
                        dd('catch');
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    // dd('prod');
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $rc_validation = json_decode($res->getBody(), true);
                            $rc_validation_response = null;
                            if (isset($rc_validation['rc_validation']['data']['vehicle_gross_weight']) || (isset($rc_validation['status_code']) && $rc_validation['status_code'] == 200)) {
                                $grossWeight = $rc_validation['rc_validation']['data']['vehicle_gross_weight'];
                                $statusCode = 200;
                                if ($grossWeight == null) {
                                    $grossWeight = 0;
                                }
                                $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)
                                    ->Where('max_weight', '>=', $grossWeight)
                                    ->first();
                                $apimaster = ApiMaster::where('api_slug', 'rc')->first();
                                $rc_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->pluck('permission');
                                if (count($rc_response_filed) > 0 && $rc_response_filed != null) {
                                    $rc_response_data = explode(',', $rc_response_filed[0]);
                                    $rc_validation['rc_validation']['data']['rc'] = null;
                                    foreach ($rc_response_data as $item) {
                                        $rc_validation_response['rc_validation']['data'][$item] = $rc_validation['rc_validation']['data'][$item];
                                    }
                                    
                                    return view('kyc.single_search', compact('rc_validation_response', 'checkWeight', 'statusCode', 'hit_limits_exceeded'));
                                }
                            }
                            if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] != 500) {
                                $user = User::where('id', Auth::user()->id)->first();
                                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                                $user->save();
                            }
                            if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == 103) {
                                return view('kyc.single_search', compact('rc_validation', 'hit_limits_exceeded'));
                            }

                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('rc_validation', 'checkWeight', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
                dd($rc_validation, $checkWeight, $statusCode, $hit_limits_exceeded);
                return view('kyc.single_search', compact('rc_validation', 'checkWeight', 'statusCode', 'hit_limits_exceeded'));
            } elseif (!empty($request->apies) && $request->get('apies') == "VoterId") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body = [
                    'voter_number' => $request->voter_number,
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $voter_validation = json_decode($res->getBody(), true);
                        $voter_validation_response = null;
                        $statusCode = 200;
                        if (isset($voter_validation[0]['voter_validation']) && isset($voter_validation[0]['voter_validation']['code']) && $voter_validation[0]['voter_validation']['code'] == 200) {
                            $apimaster = ApiMaster::where('api_slug', 'voter_id')->first();
                            $voter_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($voter_response_filed) > 0 && $voter_response_filed != null) {
                                $voter_response_data = explode(',', $voter_response_filed[0]);
                                $voter_validation[0]['voter_validation']['response']['voter_id'] = null;
                                foreach ($voter_response_data as $item) {
                                    $voter_validation_response['voter_validation']['response'][$item] = $voter_validation[0]['voter_validation']['response'][$item];
                                }
                                return view('kyc.single_search', compact('voter_validation_response', 'statusCode', 'hit_limits_exceeded'));
                            }
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $voter_validation = json_decode($res->getBody(), true);
                            $voter_validation_response = null;
                            $statusCode = 200;
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            if (isset($voter_validation[0]['voter_validation']) && isset($voter_validation[0]['voter_validation']['code']) && $voter_validation[0]['voter_validation']['code'] == 200) {
                                $apimaster = ApiMaster::where('api_slug', 'voter_id')->first();
                                $voter_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($voter_response_filed) > 0 && $voter_response_filed != null) {
                                    $voter_response_data = explode(',', $voter_response_filed[0]);
                                    $voter_validation[0]['voter_validation']['response']['voter_id'] = null;
                                    foreach ($voter_response_data as $item) {
                                        $voter_validation_response['voter_validation']['response'][$item] = $voter_validation[0]['voter_validation']['response'][$item];
                                    }
                                    return view('kyc.single_search', compact('voter_validation_response', 'statusCode', 'hit_limits_exceeded'));
                                }
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('voter_validation', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
                return view('kyc.single_search', compact('voter_validation', 'statusCode', 'hit_limits_exceeded'));
            } elseif (!empty($request->apies) && $request->get('apies') == "AadharCardVerification") {

                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'aadhaar_number' => $request->aadhaar_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_validation = json_decode($res->getBody(), true);
                        $aadhaar_validation_response = null;
                        if (isset($aadhaar_validation[0]['statusCode']) && $aadhaar_validation[0]['statusCode'] == 200) {
                            $apimaster = ApiMaster::where('api_slug', 'aadhaar')->first();
                            $aadhaar_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($aadhaar_response_filed) > 0 && $aadhaar_response_filed != null) {
                                $aadhaar_response_data = explode(',', $aadhaar_response_filed[0]);
                                $aadhaar_validation[0]['aadhaar_validation']['data']['aadhaar'] = null;
                                foreach ($aadhaar_response_data as $item) {
                                    $aadhaar_validation_response['aadhaar_validation']['data'][$item] = $aadhaar_validation[0]['aadhaar_validation']['data'][$item];
                                }
                                return view('kyc.single_search', compact('aadhaar_validation_response', 'hit_limits_exceeded'));
                            }
                            return view('kyc.single_search', compact('aadhaar_validation', 'hit_limits_exceeded'));
                        } else {
                            return view('kyc.single_search', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                            $aadhaar_validation = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $aadhaar_validation_response = null;
                            if (isset($aadhaar_validation[0]['statusCode']) && $aadhaar_validation[0]['statusCode'] == 200) {
                                $apimaster = ApiMaster::where('api_slug', 'aadhaar')->first();
                                $aadhaar_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($aadhaar_response_filed) > 0 && $aadhaar_response_filed != null) {
                                    $aadhaar_response_data = explode(',', $aadhaar_response_filed[0]);
                                    $aadhaar_validation[0]['aadhaar_validation']['data']['aadhaar'] = null;
                                    foreach ($aadhaar_response_data as $item) {
                                        $aadhaar_validation_response['aadhaar_validation']['data'][$item] = $aadhaar_validation[0]['aadhaar_validation']['data'][$item];
                                    }
                                    return view('kyc.single_search', compact('aadhaar_validation_response', 'hit_limits_exceeded'));
                                }
                                return view('kyc.single_search', compact('aadhaar_validation', 'hit_limits_exceeded'));
                            } else {
                                return view('kyc.single_search', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "OTPAadharCard") {

                $client = new Client();
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'otp_aadhar_number' => $request->otp_aadhaar_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadharotpgenrate')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/aadhaar-v2/generate-otp', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_otp_genrate = json_decode($res->getBody(), true);
                        $statusCode = 200;
                        $aadhaar_otp_generate_response = null;
                        if (isset($aadhaar_otp_genrate[0]['status_code']) && $aadhaar_otp_genrate[0]['status_code'] == 200) {
                            $apimaster = ApiMaster::where('api_slug', 'aadharotpgenrate')->first();
                            $aadhaar_otp_generate_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($aadhaar_otp_generate_response_filed) > 0 && $aadhaar_otp_generate_response_filed != null) {
                                $aadhaar_otp_generate_response_data = explode(',', $aadhaar_otp_generate_response_filed[0]);
                                $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['aadharotpgenrate'] = null;
                                $statusCode = 200;
                                foreach ($aadhaar_otp_generate_response_data as $item) {
                                    $aadhaar_otp_generate_response[0]['aadhaar_validation']['data'][$item] = $aadhaar_otp_genrate[0]['aadhaar_validation']['data'][$item];
                                }
                                return view('kyc.single_search', compact('aadhaar_otp_generate_response', 'statusCode', 'hit_limits_exceeded'));
                            }
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            // $res = $client->post($this->base_url.'/aadhaar-v2/generate-otp', ['headers' => $headers, 'json' => $body]);
                            $aadhaar_otp_genrate = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $statusCode = 200;
                            $aadhaar_otp_generate_response = null;
                            if (isset($aadhaar_otp_genrate[0]['status_code']) && $aadhaar_otp_genrate[0]['status_code'] == 200) {
                                $apimaster = ApiMaster::where('api_slug', 'aadharotpgenrate')->first();
                                $aadhaar_otp_generate_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($aadhaar_otp_generate_response_filed) > 0 && $aadhaar_otp_generate_response_filed != null) {
                                    $aadhaar_otp_generate_response_data = explode(',', $aadhaar_otp_generate_response_filed[0]);
                                    $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['aadharotpgenrate'] = null;
                                    $statusCode = 200;
                                    foreach ($aadhaar_otp_generate_response_data as $item) {
                                        $aadhaar_otp_generate_response[0]['aadhaar_validation']['data'][$item] = $aadhaar_otp_genrate[0]['aadhaar_validation']['data'][$item];
                                    }
                                    return view('kyc.single_search', compact('aadhaar_otp_generate_response', 'statusCode', 'hit_limits_exceeded'));
                                }
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('aadhaar_otp_genrate', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "DrivingVerification") {
                $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->license_number
                // ];
                $accessToken = Auth::user()->access_token;
                // $date = Carbon::parse($request->dob)->format('Y-m-d');
                $date = $request->dob;
                // dd($request->dob);

                $headers = [
                    'AccessToken' => $accessToken,
                    'Accept' => 'application/json',
                ];
                $body = [
                    'license_number' => $request->license_number,
                    'dob' => $date,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'license')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }

                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $license_validation = json_decode($res->getBody(), true);
                        $statusCode = 200;
                        if (isset($license_validation[0]['license_validation']) && isset($license_validation[0]['statusCode']) && $license_validation[0]['statusCode'] == 200) {
                            $apimaster = ApiMaster::where('api_slug', 'license')->first();

                            $license_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($license_response_filed) > 0 && $license_response_filed != null) {
                                $license_response_data = explode(',', $license_response_filed[0]);
                                $license_validation[0]['license_validation']['data']['license'] = null;
                                foreach ($license_response_data as $item) {
                                    $license_validation_response['license_validation']['data'][$item] = $license_validation[0]['license_validation']['data'][$item];
                                }
                                return view('kyc.single_search', compact('license_validation_response', 'statusCode', 'hit_limits_exceeded'));

                            }
                            return view('kyc.single_search', compact('license_validation', 'statusCode', 'hit_limits_exceeded'));
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            //$res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body]);
                            $license_validation = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $statusCode = 200;
                            if (isset($license_validation[0]['license_validation']) && isset($license_validation[0]['statusCode']) && $license_validation[0]['statusCode'] == 200) {
                                $apimaster = ApiMaster::where('api_slug', 'license')->first();

                                $license_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($license_response_filed) > 0 && $license_response_filed != null) {
                                    $license_response_data = explode(',', $license_response_filed[0]);
                                    $license_validation[0]['license_validation']['data']['license'] = null;
                                    foreach ($license_response_data as $item) {
                                        $license_validation_response['license_validation']['data'][$item] = $license_validation[0]['license_validation']['data'][$item];
                                    }
                                    return view('kyc.single_search', compact('license_validation_response', 'statusCode', 'hit_limits_exceeded'));
                                }
                            }
                            return view('kyc.single_search', compact('license_validation', 'statusCode', 'hit_limits_exceeded'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('license_validation', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "UdyamSearch") {
                $client = new Client();

                // $headers = [
                //     'Authorization' => $this->token,
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->pan_number
                // ];
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'udyamNumber' => $request->udyam_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                    try {
                        //dd($body);
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $udyamcard = json_decode($res->getBody(), true);
                        $statusCode = null;
                        $udyamcard_response = null;
                        $udyamresponseupdate = null;
                        //return  $udyamcard;
                        // $pdfurl = $udyamcard['response']['result']['pdfUrl'];
                        // return Redirect::away($pdfurl);
                        // dd($pancard);

                        if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == 200) {
                            $statusCode = 200;

                            $apimaster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                            $udyamcard_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($udyamcard_response_filed) > 0 && $udyamcard_response_filed != null) {
                                $udyamcard_response_data = explode(',', $udyamcard_response_filed[0]);

                                $udyamresponseupdate['data']['udyamsearch'] = null;
                                $udyamresponseupdate['data']['udyamNumber'] = $udyamcard['response']['essentials']['udyamNumber'];
                                $udyamresponseupdate['data']['id'] = $udyamcard['response']['id'];
                                $udyamresponseupdate['data']['patronId'] = $udyamcard['response']['patronId'];
                                $udyamresponseupdate['data']['udyamRegistrationNumber'] = $udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber'];
                                $udyamresponseupdate['data']['nameOfEnterprise'] = $udyamcard['response']['result']['generalInfo']['nameOfEnterprise'];
                                $udyamresponseupdate['data']['majorActivity'] = $udyamcard['response']['result']['generalInfo']['majorActivity'];
                                $udyamresponseupdate['data']['organisationType'] = $udyamcard['response']['result']['generalInfo']['organisationType'];
                                $udyamresponseupdate['data']['socialCategory'] = $udyamcard['response']['result']['generalInfo']['socialCategory'];
                                $udyamresponseupdate['data']['dateOfIncorporation'] = $udyamcard['response']['result']['generalInfo']['dateOfIncorporation'];
                                $udyamresponseupdate['data']['dateOfCommencementOfProductionBusiness'] = $udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness'];
                                $udyamresponseupdate['data']['dic'] = $udyamcard['response']['result']['generalInfo']['dic'];
                                $udyamresponseupdate['data']['msmedi'] = $udyamcard['response']['result']['generalInfo']['msmedi'];
                                $udyamresponseupdate['data']['dateOfUdyamRegistration'] = $udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration'];
                                $udyamresponseupdate['data']['typeOfEnterprise'] = $udyamcard['response']['result']['generalInfo']['typeOfEnterprise'];
                                $udyamresponseupdate['data']['enterpriseType'] = $udyamcard['response']['result']['enterpriseType'];
                                $udyamresponseupdate['data']['sn'] = $udyamcard['response']['result']['unitsDetails'][0]['sn'];
                                $udyamresponseupdate['data']['unitName'] = $udyamcard['response']['result']['unitsDetails'][0]['unitName'];
                                $udyamresponseupdate['data']['flat'] = $udyamcard['response']['result']['unitsDetails'][0]['flat'];
                                $udyamresponseupdate['data']['building'] = $udyamcard['response']['result']['unitsDetails'][0]['building'];
                                $udyamresponseupdate['data']['villageTown'] = $udyamcard['response']['result']['unitsDetails'][0]['villageTown'];
                                $udyamresponseupdate['data']['roadStreetLane'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['roadStreetLane'];
                                $udyamresponseupdate['data']['block'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['block'];
                                $udyamresponseupdate['data']['city'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['city'];
                                $udyamresponseupdate['data']['state'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['state'];
                                $udyamresponseupdate['data']['pin'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['pin'];
                                $udyamresponseupdate['data']['district'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['district'];
                                $udyamresponseupdate['data']['mobile'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['mobile'];
                                $udyamresponseupdate['data']['email'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['email'];
                                $udyamresponseupdate['data']['nic2Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'];
                                $udyamresponseupdate['data']['nic4Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'];
                                $udyamresponseupdate['data']['nic5Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'];
                                $udyamresponseupdate['data']['activity'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['activity'];
                                $udyamresponseupdate['data']['date'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['date'];
                                foreach ($udyamcard_response_data as $item) {
                                    $udyamcard_response['data'][$item] = $udyamresponseupdate['data'][$item];
                                }
                                return view('kyc.single_search', compact('udyamcard_response', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                            }
                            return view('kyc.single_search', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } elseif ($statusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            //dd($body);
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $udyamcard = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $statusCode = null;
                            $udyamcard_response = null;
                            $udyamresponseupdate = null;
                            if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == 200) {
                                $statusCode = 200;
                                $apimaster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                                $udyamcard_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($udyamcard_response_filed) > 0 && $udyamcard_response_filed != null) {
                                    $udyamcard_response_data = explode(',', $udyamcard_response_filed[0]);

                                    $udyamresponseupdate['data']['udyamsearch'] = null;
                                    $udyamresponseupdate['data']['udyamNumber'] = $udyamcard['response']['essentials']['udyamNumber'];
                                    $udyamresponseupdate['data']['id'] = $udyamcard['response']['id'];
                                    $udyamresponseupdate['data']['patronId'] = $udyamcard['response']['patronId'];
                                    $udyamresponseupdate['data']['udyamRegistrationNumber'] = $udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber'];
                                    $udyamresponseupdate['data']['nameOfEnterprise'] = $udyamcard['response']['result']['generalInfo']['nameOfEnterprise'];
                                    $udyamresponseupdate['data']['majorActivity'] = $udyamcard['response']['result']['generalInfo']['majorActivity'];
                                    $udyamresponseupdate['data']['organisationType'] = $udyamcard['response']['result']['generalInfo']['organisationType'];
                                    $udyamresponseupdate['data']['socialCategory'] = $udyamcard['response']['result']['generalInfo']['socialCategory'];
                                    $udyamresponseupdate['data']['dateOfIncorporation'] = $udyamcard['response']['result']['generalInfo']['dateOfIncorporation'];
                                    $udyamresponseupdate['data']['dateOfCommencementOfProductionBusiness'] = $udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness'];
                                    $udyamresponseupdate['data']['dic'] = $udyamcard['response']['result']['generalInfo']['dic'];
                                    $udyamresponseupdate['data']['msmedi'] = $udyamcard['response']['result']['generalInfo']['msmedi'];
                                    $udyamresponseupdate['data']['dateOfUdyamRegistration'] = $udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration'];
                                    $udyamresponseupdate['data']['typeOfEnterprise'] = $udyamcard['response']['result']['generalInfo']['typeOfEnterprise'];
                                    $udyamresponseupdate['data']['enterpriseType'] = $udyamcard['response']['result']['enterpriseType'];
                                    $udyamresponseupdate['data']['sn'] = $udyamcard['response']['result']['unitsDetails'][0]['sn'];
                                    $udyamresponseupdate['data']['unitName'] = $udyamcard['response']['result']['unitsDetails'][0]['unitName'];
                                    $udyamresponseupdate['data']['flat'] = $udyamcard['response']['result']['unitsDetails'][0]['flat'];
                                    $udyamresponseupdate['data']['building'] = $udyamcard['response']['result']['unitsDetails'][0]['building'];
                                    $udyamresponseupdate['data']['villageTown'] = $udyamcard['response']['result']['unitsDetails'][0]['villageTown'];
                                    $udyamresponseupdate['data']['roadStreetLane'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['roadStreetLane'];
                                    $udyamresponseupdate['data']['block'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['block'];
                                    $udyamresponseupdate['data']['city'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['city'];
                                    $udyamresponseupdate['data']['state'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['state'];
                                    $udyamresponseupdate['data']['pin'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['pin'];
                                    $udyamresponseupdate['data']['district'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['district'];
                                    $udyamresponseupdate['data']['mobile'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['mobile'];
                                    $udyamresponseupdate['data']['email'] = $udyamcard['response']['result']['officialAddressOfEnterprise']['email'];
                                    $udyamresponseupdate['data']['nic2Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'];
                                    $udyamresponseupdate['data']['nic4Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'];
                                    $udyamresponseupdate['data']['nic5Digit'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'];
                                    $udyamresponseupdate['data']['activity'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['activity'];
                                    $udyamresponseupdate['data']['date'] = $udyamcard['response']['result']['nationalIndustryClassificationCodes'][0]['date'];
                                    foreach ($udyamcard_response_data as $item) {
                                        $udyamcard_response['data'][$item] = $udyamresponseupdate['data'][$item];
                                    }
                                    return view('kyc.single_search', compact('udyamcard_response', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                                }
                                return view('kyc.single_search', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                            }

                            // return Redirect::away($pdfurl);
                            // dd($pancard);
                            // if(isset($pancard[0]['pancard']['code'])){
                            //     $statusCode = $pancard[0]['pancard']['code'];
                            // }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } elseif ($statusCode == 422) {
                                $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;

                        return view('kyc.single_search', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "UPIValidation") {
                $client = new Client();

                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'name' => $request->name,
                    'upi_id' => $request->upi_id,
                    'order_id' => $request->order_id,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'upi')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $upidetails = json_decode($res->getBody(), true);

                        $upidetails_response = null;
                        if (isset($upidetails['upidetails']['code']) && $upidetails['upidetails']['code'] == 200) {
                            $apimaster = ApiMaster::where('api_slug', 'upi')->first();
                            $upidetails_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $apimaster->id)
                                ->where('permission', '<>', null)
                                ->where('permission', '<>', '')
                                ->pluck('permission');
                            if (count($upidetails_response_filed) > 0 && $upidetails_response_filed != null) {
                                $upidetails_response_data = explode(',', $upidetails_response_filed[0]);
                                $upidetails['upidetails']['response']['upi'] = null;
                                foreach ($upidetails_response_data as $item) {
                                    $upidetails_response['upidetails']['response'][$item] = $upidetails['upidetails']['response'][$item];
                                }
                                return view('kyc.single_search', compact('upidetails_response', 'hit_limits_exceeded'));
                            }
                        } elseif (isset($upidetails['statusCode']) && $upidetails['statusCode'] == 102) {
                            $statusCode = 102;
                            $errorMessage = 'Please enter valid details.';
                            return view('kyc.single_search', compact('upidetails', 'errorMessage'));
                        } else {
                            $upistatusCode = 500;
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('upistatusCode', 'errorMessage'));
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } elseif ($statusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $upidetails = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $upidetails_response = null;
                            if (isset($upidetails['upidetails']['code']) && $upidetails['upidetails']['code'] == 200) {
                                $apimaster = ApiMaster::where('api_slug', 'upi')->first();
                                $upidetails_response_filed = UserSchemeMaster::where('user_id', Auth::user()->id)
                                    ->where('api_id', $apimaster->id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->pluck('permission');
                                if (count($upidetails_response_filed) > 0 && $upidetails_response_filed != null) {
                                    $upidetails_response_data = explode(',', $upidetails_response_filed[0]);
                                    $upidetails['upidetails']['response']['upi'] = null;
                                    foreach ($upidetails_response_data as $item) {
                                        $upidetails_response['upidetails']['response'][$item] = $upidetails['upidetails']['response'][$item];
                                    }
                                    return view('kyc.single_search', compact('upidetails', 'upidetails_response', 'hit_limits_exceeded'));
                                }
                            } elseif (isset($upidetails['statusCode']) && $upidetails['statusCode'] == 102) {
                                $statusCode = 102;
                                $errorMessage = 'Please enter valid details.';
                                return view('kyc.single_search', compact('upidetails', 'errorMessage'));
                            } else {
                                $upistatusCode = 500;
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                                return view('kyc.single_search', compact('upistatusCode', 'errorMessage'));
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } elseif ($statusCode == 422) {
                                $errorMessage = 'Verification Failed. Please enter correct details.';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;

                        return view('kyc.single_search', compact('upidetails', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PancardOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['panocrfile']['tmp_name'], $_FILES['panocrfile']['type'], $_FILES['panocrfile']['name']),
                                'file_type' => 'pancard'
                            ],
                        CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $pancard = json_decode($response, true);
                    if (isset($pancard['status_code']) && $pancard['status_code'] == 200) {
                        return view('kyc.single_search', compact('pancard'));
                    } elseif (isset($pancard['status_code']) && $pancard['status_code'] == 102) {
                        $errorMessage = "Invalid file type, must be an  pancard image.";
                        return view('kyc.single_search', compact('pancard'));
                    } elseif (isset($pancard['status_code']) && $pancard['status_code'] == 404) {
                        $errorMessage = "No file found.";
                        return view('kyc.single_search', compact('pancard'));
                    } else {
                        $pastatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('pancard', 'pastatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;

                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                    'file' => new \CURLFILE($_FILES['panocrfile']['tmp_name'], $_FILES['panocrfile']['type'], $_FILES['panocrfile']['name']),
                                    'file_type' => 'pancard'
                                ],
                            CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $pancard = json_decode($response, true);
                        if (isset($pancard['status_code']) && $pancard['status_code'] == 200) {
                            return view('kyc.single_search', compact('pancard'));
                        } elseif (isset($pancard['status_code']) && $pancard['status_code'] == 102) {
                            $errorMessage = "Invalid file type, must be an  pancard image.";
                            return view('kyc.single_search', compact('pancard'));
                        } elseif (isset($pancard['status_code']) && $pancard['status_code'] == 404) {
                            $errorMessage = "No file found.";
                            return view('kyc.single_search', compact('pancard'));
                        } elseif (isset($pancard['statusCode']) && $pancard['statusCode'] == 103) {
                            $errorMessage = $pancard['message'];
                            return view('kyc.single_search', compact('pancard'));
                        } else {
                            $pastatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('pancard', 'pastatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "VoterIdOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['voteridocrfile']['tmp_name'], $_FILES['voteridocrfile']['type'], $_FILES['voteridocrfile']['name']),
                            'file_type' => 'voterid'
                        ],
                        CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $voterid = json_decode($response, true);
                    if (isset($voterid['status_code']) && $voterid['status_code'] == 200) {

                        return view('kyc.single_search', compact('voterid'));
                    } elseif (isset($voterid['status_code']) && $voterid['status_code'] == 102) {
                        $errorMessage = "Invalid file type, must be an  voter id image.";
                        return view('kyc.single_search', compact('voterid'));
                    } elseif (isset($voterid['status_code']) && $voterid['status_code'] == 404) {
                        $errorMessage = "No file found.";
                        return view('kyc.single_search', compact('voterid'));
                    } elseif (isset($voterid['statusCode']) && $voterid['statusCode'] == 103) {
                        $errorMessage = $voterid['message'];
                        return view('kyc.single_search', compact('voterid'));
                    } else {
                        $vostatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('voterid', 'vostatusCode'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['voteridocrfile']['tmp_name'], $_FILES['voteridocrfile']['type'], $_FILES['voteridocrfile']['name']),
                                'file_type' => 'voterid'
                            ],
                            CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $voterid = json_decode($response, true);
                        if (isset($voterid['status_code']) && $voterid['status_code'] == 200) {

                            return view('kyc.single_search', compact('voterid'));
                        } elseif (isset($voterid['status_code']) && $voterid['status_code'] == 102) {
                            $errorMessage = "Invalid file type, must be an  voter id image.";
                            return view('kyc.single_search', compact('voterid'));
                        } elseif (isset($voterid['status_code']) && $voterid['status_code'] == 404) {
                            $errorMessage = "No file found.";
                            return view('kyc.single_search', compact('voterid'));
                        } elseif (isset($voterid['statusCode']) && $voterid['statusCode'] == 103) {
                            $errorMessage = $voterid['message'];
                            return view('kyc.single_search', compact('voterid'));
                        } else {
                            $vostatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('voterid', 'vostatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('voterid', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "PassportOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'passportupload')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['passportocrfile']['tmp_name'], $_FILES['passportocrfile']['type'], $_FILES['passportocrfile']['name']),
                            'file_type' => 'passport'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $passport = json_decode($result, true);
                    if (isset($passport['status_code']) && $passport['status_code'] == 200) {

                        return view('kyc.single_search', compact('passport'));
                    } elseif (isset($passport['status_code']) && $passport['status_code'] == 102) {
                        $errorMessage = "Failed to extract MRZ information.";
                        return view('kyc.single_search', compact('passport'));
                    } elseif (isset($passport['statusCode']) && $passport['statusCode'] == 103) {
                        $errorMessage = $passport['message'];
                        return view('kyc.single_search', compact('passport'));
                    } elseif (isset($passport['status_code']) && $passport['status_code'] == 404) {
                        $errorMessage = "No file found.";
                        return view('kyc.single_search', compact('passport'));
                    } else {
                        $pstatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('passport', 'pstatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['passportocrfile']['tmp_name'], $_FILES['passportocrfile']['type'], $_FILES['passportocrfile']['name']),
                                'file_type' => 'passport'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $passport = json_decode($result, true);
                        if (isset($passport['status_code']) && $passport['status_code'] == 200) {

                            return view('kyc.single_search', compact('passport'));
                        } elseif (isset($passport['status_code']) && $passport['status_code'] == 102) {
                            $errorMessage = "Failed to extract MRZ information.";
                            return view('kyc.single_search', compact('passport'));
                        } elseif (isset($passport['status_code']) && $passport['status_code'] == 404) {
                            $errorMessage = "No file found.";
                            return view('kyc.single_search', compact('passport'));
                        } elseif (isset($passport['statusCode']) && $passport['statusCode'] == 103) {
                            $errorMessage = $passport['message'];
                            return view('kyc.single_search', compact('passport'));
                        } else {
                            $pstatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('passport', 'pstatusCode'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('passport', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "AadharMaskOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadharmasking')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['aadharmaskocrfile']['tmp_name'], $_FILES['aadharmaskocrfile']['type'], $_FILES['aadharmaskocrfile']['name']),
                            'file_type' => 'aadhar_card'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);

                    $result = curl_exec($curl);
                    $aadhaar_masking = json_decode($result, true);
                    if (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 200) {
                        return view('kyc.single_search', compact('aadhaar_masking', 'statusCode'));
                    } elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 102) {
                        $errorMessage = "Invalid file type, must be an image.";
                        return view('kyc.single_search', compact('aadhaar_masking'));
                    } elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 404) {

                        $errorMessage = "No image file provided";
                        return view('kyc.single_search', compact('aadhaar_masking'));
                    } else {
                        $amstatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('amstatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['aadharmaskocrfile']['tmp_name'], $_FILES['aadharmaskocrfile']['type'], $_FILES['aadharmaskocrfile']['name']),
                                'file_type' => 'aadhar_card'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $aadhaar_masking = json_decode($result, true);
                        if (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 200) {

                            return view('kyc.single_search', compact('aadhaar_masking', 'statusCode'));
                        } elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 102) {
                            $errorMessage = "Invalid file type, must be an image.";
                            return view('kyc.single_search', compact('aadhaar_masking'));
                        } elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 404) {

                            $errorMessage = "No image file provided";
                            return view('kyc.single_search', compact('aadhaar_masking'));
                        } elseif (isset($aadhaar_masking['statusCode']) && $aadhaar_masking['statusCode'] == 103) {

                            $errorMessage = $aadhaar_masking['message'];
                            return view('kyc.single_search', compact('aadhaar_masking'));
                        } else {
                            $amstatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('amstatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "AadharOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['aadharocrfile']['tmp_name'], $_FILES['aadharocrfile']['type'], $_FILES['aadharocrfile']['name']),
                            'file_type' => 'aadharcard'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $aadharcardocr = json_decode($result, true);
                    if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 200) {

                        return view('kyc.single_search', compact('aadharcardocr'));
                    } elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 102) {
                        $errorMessage = "Invalid file type, must be an aadhar card image.";
                        return view('kyc.single_search', compact('aadharcardocr'));
                    } elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 404) {
                        $errorMessage = "No file found.";
                        return view('kyc.single_search', compact('aadharcardocr'));
                    } else {
                        $astatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('aadharcardocr', 'astatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['aadharocrfile']['tmp_name'], $_FILES['aadharocrfile']['type'], $_FILES['aadharocrfile']['name']),
                                'file_type' => 'aadharcard'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $aadharcardocr = json_decode($result, true);
                        if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 200) {

                            return view('kyc.single_search', compact('aadharcardocr'));
                        } elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 102) {
                            $errorMessage = "Invalid file type, must be an aadhar card image.";
                            return view('kyc.single_search', compact('aadharcardocr'));
                        } elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 404) {
                            $errorMessage = "No file found.";
                            return view('kyc.single_search', compact('aadharcardocr'));
                        } elseif (isset($aadharcardocr['statusCode']) && $aadharcardocr['statusCode'] == 103) {
                            $errorMessage = $aadharcardocr['message'];
                            return view('kyc.single_search', compact('aadharcardocr'));
                        } else {
                            $astatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('aadharcardocr', 'astatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('aadharcardocr', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "DrivingLicenseOcr") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'license')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['drivingocrfile']['tmp_name'], $_FILES['drivingocrfile']['type'], $_FILES['drivingocrfile']['name']),
                            'file_type' => 'drivinglicense'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $lincensedocr = json_decode($result, true);
                    if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 200) {

                        return view('kyc.single_search', compact('lincensedocr'));
                    } elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 102) {
                        $errorMessage = "Invalid file type, must be an driving license image.";
                        return view('kyc.single_search', compact('lincensedocr', 'errorMessage'));
                    } elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 404) {
                        $errorMessage = "No file found.";
                        return view('kyc.single_search', compact('lincensedocr', 'errorMessage'));
                    } else {
                        $listatusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.single_search', compact('lincensedocr', 'listatusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['drivingocrfile']['tmp_name'], $_FILES['drivingocrfile']['type'], $_FILES['drivingocrfile']['name']),
                                'file_type' => 'drivinglicense'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $lincensedocr = json_decode($result, true);
                        if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 200) {

                            return view('kyc.single_search', compact('lincensedocr'));
                        } elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 102) {
                            $errorMessage = "Invalid file type, must be an driving license image.";
                            return view('kyc.single_search', compact('lincensedocr', 'errorMessage'));
                        } elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 404) {
                            $errorMessage = "No file found.";
                            return view('kyc.single_search', compact('lincensedocr', 'errorMessage'));
                        } elseif (isset($lincensedocr['statusCode']) && $lincensedocr['statusCode'] == 103) {
                            $errorMessage = $lincensedocr['message'];
                            return view('kyc.single_search', compact('lincensedocr', 'errorMessage'));
                        } else {
                            $listatusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search', compact('lincensedocr', 'listatusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('lincensedocr', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BhunakshaApi") {
                $accessToken = Auth::user()->access_token;
                if (!empty($request->states) && $request->get('states') == "bihar") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->br_district,
                                "Subdiv" => $request->br_subdiv,
                                "Circle" => $request->br_circle,
                                "Mauza" => $request->br_mauza,
                                "Surveytype" => $request->br_surveytype,
                                "Mapinstance" => $request->br_mapinstance,
                                "Sheetno" => $request->br_sheet_number,
                                "Plotno" => $request->br_plot_number
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    'State' => $request->states,
                                    "District" => $request->br_district,
                                    "Subdiv" => $request->br_subdiv,
                                    "Circle" => $request->br_circle,
                                    "Mauza" => $request->br_mauza,
                                    "Surveytype" => $request->br_surveytype,
                                    "Mapinstance" => $request->br_mapinstance,
                                    "Sheetno" => $request->br_sheet_number,
                                    "Plotno" => $request->br_plot_number
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "jharkhand") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->jhar_district,
                                "Circle" => $request->jhar_circle,
                                "Halka" => $request->jhar_halka,
                                "Mauza" => $request->jhar_mauza,
                                "Sheetno" => $request->jhar_sheetno,
                                "Plotno" => $request->jhar_ploat_number
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->jhar_district,
                                    "Circle" => $request->jhar_circle,
                                    "Halka" => $request->jhar_halka,
                                    "Mauza" => $request->jhar_mauza,
                                    "Sheetno" => $request->jhar_sheetno,
                                    "Plotno" => $request->jhar_ploat_number
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }

                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "up") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->up_district,
                                "Tehsil" => $request->up_tehsil,
                                "Village" => $request->up_village,
                                "Plotno" => $request->up_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.search_bhunakasha', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->up_district,
                                    "Tehsil" => $request->up_tehsil,
                                    "Village" => $request->up_village,
                                    "Plotno" => $request->up_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }

                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "chhattisgarh") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->chha_distract,
                                "Tehsil" => $request->chha_tehsil,
                                "Ri" => $request->chha_ri_circle,
                                "Village" => $request->chha_village,
                                "Plotno" => $request->chha_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->chha_distract,
                                    "Tehsil" => $request->chha_tehsil,
                                    "Ri" => $request->chha_ri_circle,
                                    "Village" => $request->chha_village,
                                    "Plotno" => $request->chha_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "rajasthan") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->ra_district,
                                "Tehsil" => $request->ra_tehsil,
                                "Ri" => $request->ra_ri_circle,
                                "Halka" => $request->ra_ri_halkas,
                                "Village" => $request->ra_village,
                                "Sheetno" => $request->ra_sheet_number,
                                "Plotno" => $request->ra_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->ra_district,
                                    "Tehsil" => $request->ra_tehsil,
                                    "Ri" => $request->ra_ri_circle,
                                    "Halka" => $request->ra_ri_halkas,
                                    "Village" => $request->ra_village,
                                    "Sheetno" => $request->ra_sheet_number,
                                    "Plotno" => $request->ra_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "lakshadweep") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->laksh_district,
                                "Taluka" => $request->laksh_taluk,
                                "Village" => $request->laksh_village,
                                "Surveyno" => $request->laksh_survey,
                                "Plotno" => $request->laksh_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->laksh_district,
                                    "Taluka" => $request->laksh_taluk,
                                    "Village" => $request->laksh_village,
                                    "Surveyno" => $request->laksh_survey,
                                    "Plotno" => $request->laksh_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "kerala") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->ker_district,
                                "Taluka" => $request->ker_taluk,
                                "Village" => $request->ker_village,
                                "Blockno" => $request->ker_blockno,
                                "Surveyno" => $request->ker_survey_number,
                                "Subdivno" => $request->ker_subdivno,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->ker_district,
                                    "Taluka" => $request->ker_taluk,
                                    "Village" => $request->ker_village,
                                    "Blockno" => $request->ker_blockno,
                                    "Surveyno" => $request->ker_survey_number,
                                    "Subdivno" => $request->ker_subdivno,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "goa") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->goa_district,
                                "Taluka" => $request->goa_taluka,
                                "Village" => $request->goa_village,
                                "Sheetno" => $request->goa_sheet_number,
                                "Plotno" => $request->goa_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->goa_district,
                                    "Taluka" => $request->goa_taluka,
                                    "Village" => $request->goa_village,
                                    "Sheetno" => $request->goa_sheet_number,
                                    "Plotno" => $request->goa_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }
                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                } elseif (!empty($request->states) && $request->get('states') == "odisha") {
                    if (Auth::user()->scheme_type != 'demo') {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bhumi_type" => "bhunaksha",
                                "State" => $request->states,
                                "District" => $request->odi_district,
                                "Tehsil" => $request->odi_tehsil,
                                "Ri" => $request->odi_ri_circle,
                                "Village" => $request->odi_village,
                                "Sheetno" => $request->odi_sheetnumber,
                                "Plotno" => $request->odi_plot_number,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $bhunakasha = json_decode($result, true);
                        if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                            $bhunakshstatusCode = 200;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                            $bhunakshstatusCode = 202;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                            $bhunakshstatusCode = 103;
                            $error_message = $bhunakasha['message'];
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        } else {
                            $bhunakshstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                        }
                    } else {
                        $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                        $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                        if ($hit_count_remaining > 0) {
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            $curl = curl_init();
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array(
                                    "bhumi_type" => "bhunaksha",
                                    "State" => $request->states,
                                    "District" => $request->odi_district,
                                    "Tehsil" => $request->odi_tehsil,
                                    "Ri" => $request->odi_ri_circle,
                                    "Village" => $request->odi_village,
                                    "Sheetno" => $request->odi_sheetnumber,
                                    "Plotno" => $request->odi_plot_number,
                                ),
                                CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                            ]);
                            $result = curl_exec($curl);
                            $bhunakasha = json_decode($result, true);
                            if (isset($bhunakasha['data']) && $bhunakasha['status_code'] == 200) {
                                $bhunakshstatusCode = 200;
                                return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 202) {
                                $bhunakshstatusCode = 202;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha['status_code']) && $bhunakasha['status_code'] == 103) {
                                $bhunakshstatusCode = 103;
                                $error_message = $bhunakasha['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } elseif (isset($bhunakasha[0]['statusCode']) && $bhunakasha[0]['statusCode'] == 403) {
                                $bhunakshstatusCode = 403;
                                $error_message = $bhunakasha[0]['message'];
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            } else {
                                $bhunakshstatusCode = 500;
                                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                                return view('kyc.single_search', compact('bhunakshstatusCode', 'error_message'));
                            }

                        } else {
                            $hit_limits_exceeded = 1;
                            return view('kyc.single_search', compact('bhunakasha', 'bhunakshstatusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                        }
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "verifyAddress") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'verifyaddress')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['address_type' => 'verify_address', 'address' => $request->verify_address],
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $verify_address = json_decode($result, true);
                    if (isset($verify_address['status_code']) && $verify_address['status_code'] == 200) {
                        return view('kyc.single_search', compact('verify_address'));
                    } elseif (isset($verify_address['status_code']) && $verify_address['status_code'] == 102) {
                        $error_message = $verify_address['message'];
                        return view('kyc.single_search', compact('verify_address', 'error_message'));
                    } elseif (isset($verify_address['status_code']) && $verify_address['status_code'] == 202) {
                        $error_message = $verify_address['message'];
                        return view('kyc.single_search', compact('verify_address', 'error_message'));
                    } elseif (isset($verify_address['statusCode']) && $verify_address['statusCode'] == 103) {
                        $error_message = $verify_address['message'];
                        return view('kyc.single_search', compact('verify_address', 'error_message'));
                    } elseif (isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode'] == 403) {
                        $error_message = $verify_address[0]['message'];
                        return view('kyc.single_search', compact('verify_address', 'error_message'));
                    } else {
                        $verifyaddstatusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.single_search', compact('verifyaddstatusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['address_type' => 'verify_address', 'address' => $request->verify_address],
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $verify_address = json_decode($result, true);
                        if (isset($verify_address['status_code']) && $verify_address['status_code'] == 200) {
                            return view('kyc.single_search', compact('verify_address'));
                        } elseif (isset($verify_address['status_code']) && $verify_address['status_code'] == 102) {
                            $error_message = $verify_address['message'];
                            return view('kyc.single_search', compact('verify_address', 'error_message'));
                        } elseif (isset($verify_address['status_code']) && $verify_address['status_code'] == 202) {
                            $error_message = $verify_address['message'];
                            return view('kyc.single_search', compact('verify_address', 'error_message'));
                        } elseif (isset($verify_address['statusCode']) && $verify_address['statusCode'] == 103) {
                            $error_message = $verify_address['message'];
                            return view('kyc.single_search', compact('verify_address', 'error_message'));
                        } elseif (isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode'] == 403) {
                            $error_message = $verify_address[0]['message'];
                            return view('kyc.single_search', compact('verify_address', 'error_message'));
                        } else {
                            $verifyaddstatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('verifyaddstatusCode', 'error_message'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('verify_address', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "getPlace") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'getplace')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'address_type' => 'get_place',
                            'longitude' => $request->gp_longitude,
                            'latitude' => $request->gp_latitude
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $get_place = json_decode($result, true);
                    if (isset($get_place['status_code']) && $get_place['status_code'] == 200) {
                        return view('kyc.single_search', compact('get_place'));
                    } elseif (isset($get_place['status_code']) && $get_place['status_code'] == 102) {
                        $error_message = $get_place['message'];
                        return view('kyc.single_search', compact('get_place', 'error_message'));
                    } elseif (isset($get_place['statusCode']) && $get_place['statusCode'] == 103) {
                        $error_message = $get_place['message'];
                        return view('kyc.single_search', compact('get_place', 'error_message'));
                    } elseif (isset($get_place[0]['statusCode']) && $get_place[0]['statusCode'] == 403) {
                        $error_message = $get_place[0]['message'];
                        return view('kyc.single_search', compact('get_place', 'error_message'));
                    } else {
                        $getplace_statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.single_search', compact('getplace_statusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/get_place',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'address_type' => 'get_place',
                                'longitude' => $request->gp_longitude,
                                'latitude' => $request->gp_latitude
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $get_place = json_decode($result, true);
                        if (isset($get_place['status_code']) && $get_place['status_code'] == 200) {
                            return view('kyc.single_search', compact('get_place'));
                        } elseif (isset($get_place['status_code']) && $get_place['status_code'] == 102) {
                            $error_message = $get_place['message'];
                            return view('kyc.single_search', compact('get_place', 'error_message'));
                        } elseif (isset($get_place['statusCode']) && $get_place['statusCode'] == 103) {
                            $error_message = $get_place['message'];
                            return view('kyc.single_search', compact('get_place', 'error_message'));
                        } elseif (isset($get_place[0]['statusCode']) && $get_place[0]['statusCode'] == 403) {
                            $error_message = $get_place[0]['message'];
                            return view('kyc.single_search', compact('get_place', 'error_message'));
                        } else {
                            $getplace_statusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('getplace_statusCode', 'error_message'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('get_place', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CreateGeofence") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'creategeofence')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'address_type' => 'create_geofence',
                            'latitude' => $request->cregeo_longitude,
                            'longitude' => $request->cregeo_latitude,
                            'radius' => $request->cregeo_radius
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $create_geofence = json_decode($result, true);
                    if (isset($create_geofence['status_code']) && $create_geofence['status_code'] == 200) {
                        return view('kyc.single_search', compact('create_geofence'));
                    } elseif (isset($create_geofence['status_code']) && $create_geofence['status_code'] == 102) {
                        $error_message = $create_geofence['message'];
                        return view('kyc.single_search', compact('create_geofence', 'error_message'));
                    } elseif (isset($create_geofence['statusCode']) && $create_geofence['statusCode'] == 103) {
                        $error_message = $create_geofence['message'];
                        return view('kyc.single_search', compact('create_geofence', 'error_message'));
                    } elseif (isset($create_geofence[0]['statusCode']) && $create_geofence[0]['statusCode'] == 403) {
                        $error_message = $create_geofence[0]['message'];
                        return view('kyc.single_search', compact('create_geofence', 'error_message'));
                    } else {
                        $geostatusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.single_search', compact('geostatusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'address_type' => 'create_geofence',
                                'latitude' => $request->cregeo_longitude,
                                'longitude' => $request->cregeo_latitude,
                                'radius' => $request->cregeo_radius
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $create_geofence = json_decode($result, true);
                        if (isset($create_geofence['status_code']) && $create_geofence['status_code'] == 200) {
                            return view('kyc.single_search', compact('create_geofence'));
                        } elseif (isset($create_geofence['status_code']) && $create_geofence['status_code'] == 102) {
                            $error_message = $create_geofence['message'];
                            return view('kyc.single_search', compact('create_geofence', 'error_message'));
                        } elseif (isset($create_geofence['statusCode']) && $create_geofence['statusCode'] == 103) {
                            $error_message = $create_geofence['message'];
                            return view('kyc.single_search', compact('create_geofence', 'error_message'));
                        } elseif (isset($create_geofence[0]['statusCode']) && $create_geofence[0]['statusCode'] == 403) {
                            $error_message = $create_geofence[0]['message'];
                            return view('kyc.single_search', compact('create_geofence', 'error_message'));
                        } else {
                            $geostatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('geostatusCode', 'error_message'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('create_geofence', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "GETCoordinate") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'getcoordinate')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'address_type' => 'get_coordinate',
                            'address' => $request->coordinate_address,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $get_coordinate = json_decode($result, true);
                    if (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 200) {
                        return view('kyc.single_search', compact('get_coordinate'));
                    } elseif (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 102) {
                        $error_message = $get_coordinate['message'];
                        return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                    } elseif (isset($get_coordinate['statusCode']) && $get_coordinate['statusCode'] == 103) {
                        $error_message = $get_coordinate['message'];
                        return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                    } elseif (isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode'] == 403) {
                        $error_message = $get_coordinate[0]['message'];
                        return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                    } else {
                        $getcostatusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.single_search', compact('getcostatusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'address_type' => 'get_coordinate',
                                'address' => $request->coordinate_address,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $get_coordinate = json_decode($result, true);
                        if (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 200) {
                            return view('kyc.single_search', compact('get_coordinate'));
                        } elseif (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 102) {
                            $error_message = $get_coordinate['message'];
                            return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                        } elseif (isset($get_coordinate['statusCode']) && $get_coordinate['statusCode'] == 103) {
                            $error_message = $get_coordinate['message'];
                            return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                        } elseif (isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode'] == 403) {
                            $error_message = $get_coordinate[0]['message'];
                            return view('kyc.single_search', compact('get_coordinate', 'error_message'));
                        } else {
                            $getcostatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('getcostatusCode', 'error_message'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('get_coordinate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "AutoComplateAddress") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'autocomplate')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'address_type' => 'auto_complate',
                            'text' => $request->autoaddress_text,
                            'maxResult' => $request->autoaddress_max_result,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $auto_complate = json_decode($result, true);

                    if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 200) {
                        return view('kyc.single_search', compact('auto_complate'));
                    } elseif (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 102) {
                        $error_message = $auto_complate['message'];
                        return view('kyc.single_search', compact('auto_complate', 'error_message'));
                    } elseif (isset($auto_complate['statusCode']) && $auto_complate['statusCode'] == 103) {
                        $error_message = $auto_complate['message'];
                        return view('kyc.single_search', compact('auto_complate', 'error_message'));
                    } elseif (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode'] == 404) {
                        $error_message = $auto_complate[0]['message'];
                        return view('kyc.single_search', compact('auto_complate', 'error_message'));
                    } elseif (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode'] == 403) {
                        $error_message = $auto_complate[0]['message'];
                        return view('kyc.single_search', compact('auto_complate', 'error_message'));
                    } else {
                        $autostatusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.single_search', compact('autostatusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'address_type' => 'auto_complate',
                                'text' => $request->autoaddress_text,
                                'maxResult' => $request->autoaddress_max_result,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $auto_complate = json_decode($result, true);
                        if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 200) {
                            return view('kyc.single_search', compact('auto_complate'));
                        } elseif (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 102) {
                            $error_message = $auto_complate['message'];
                            return view('kyc.single_search', compact('auto_complate', 'error_message'));
                        } elseif (isset($auto_complate['statusCode']) && $auto_complate['statusCode'] == 103) {
                            $error_message = $auto_complate['message'];
                            return view('kyc.single_search', compact('auto_complate', 'error_message'));
                        } elseif (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode'] == 404) {
                            $error_message = $auto_complate[0]['message'];
                            return view('kyc.single_search', compact('auto_complate', 'error_message'));
                        } elseif (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode'] == 403) {
                            $error_message = $auto_complate[0]['message'];
                            return view('kyc.single_search', compact('auto_complate', 'error_message'));
                        } else {
                            $autostatusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('autostatusCode', 'error_message'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('auto_complate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "UdhyogAadhaar") {
                $client = new Client();

                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'uamnumber' => $request->udyogadhar_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'udyamadhar')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $udyamaadhar = json_decode($res->getBody(), true);


                        if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 200) {
                            $statusCode = 200;

                            return view('kyc.single_search', compact('udyamaadhar'));

                        }
                    } catch (BadResponseException $e) {
                        $udyamaaadharstatusCode = $e->getResponse()->getStatusCode();
                        if ($udyamaaadharstatusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } elseif ($udyamaaadharstatusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search', compact('udyamaaadharstatusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;

                    if ($hit_count_remaining > 0) {

                        try {
                            //dd($body);
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $udyamaadhar = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 200) {
                                $statusCode = 200;
                                return view('kyc.single_search', compact('udyamaadhar'));
                            }
                        } catch (BadResponseException $e) {
                            $udyamaaadharstatusCode = $e->getResponse()->getStatusCode();
                            if ($udyamaaadharstatusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } elseif ($udyamaaadharstatusCode == 422) {
                                $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search', compact('udyamaaadharstatusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('udyamaadhar', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "SearchKyclite") {

                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'ckycsearch')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'pano' => $request->panNumber,
                            'dob' => $request->date_of_birth
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $searchkyclite = json_decode($result, true);
                    if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 200) {
                        return view('kyc.single_search', compact('searchkyclite'));
                    } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 102) {
                        return view('kyc.single_search', compact('searchkyclite'));
                    } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 103) {
                        return view('kyc.single_search', compact('searchkyclite'));
                    } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 202) {
                        return view('kyc.single_search', compact('searchkyclite'));
                    } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 201) {

                        return view('kyc.single_search', compact('searchkyclite'));
                    } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 500) {
                        return view('kyc.single_search', compact('searchkyclite'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'pano' => $request->panNumber,
                                'dob' => $request->date_of_birth
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $searchkyclite = json_decode($result, true);
                        if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 200) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 102) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 103) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 202) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 201) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        } elseif (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode'] == 500) {
                            return view('kyc.single_search', compact('searchkyclite'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('searchkyclite', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "UdyamSearchv2") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "UdyamRegNumber" => $request->udyam_numberv2,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $udyamcardv2 = json_decode($result, true);

                    if (isset($udyamcardv2['response']) && $udyamcardv2['status_code'] == 200) {
                        $statusCode = 200;
                        return view('kyc.single_search', compact('udyamcardv2'));
                    } elseif (isset($udyamcardv2['status_code']) && $udyamcardv2['status_code'] == 202) {
                        $statusCode = 202;
                        $error_message = $udyamcardv2['message'];
                        return view('kyc.single_search', compact('udyamcardv2'));
                    } elseif (isset($udyamcardv2['status_code']) && $udyamcardv2['status_code'] == 103) {
                        $statusCode = 103;
                        $error_message = $udyamcardv2['message'];
                        return view('kyc.single_search', compact('udyamcardv2'));
                    } elseif (isset($udyamcardv2[0]['statusCode']) && $udyamcardv2[0]['statusCode'] == 403) {
                        $statusCode = 403;
                        $error_message = $udyamcardv2[0]['message'];
                        return view('kyc.single_search', compact('udyamcardv2'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "UdyamRegNumber" => $request->udyam_numberv2,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $udyamcardv2 = json_decode($result, true);
                        if (isset($udyamcardv2['response']) && $udyamcardv2['status_code'] == 200) {
                            $statusCode = 200;
                            return view('kyc.single_search', compact('udyamcardv2'));
                        } elseif (isset($udyamcardv2['status_code']) && $udyamcardv2['status_code'] == 202) {
                            $statusCode = 202;
                            $error_message = $udyamcardv2['message'];
                            return view('kyc.single_search', compact('udyamcardv2'));
                        } elseif (isset($udyamcardv2['status_code']) && $udyamcardv2['status_code'] == 103) {
                            $statusCode = 103;
                            $error_message = $udyamcardv2['message'];
                            return view('kyc.single_search', compact('udyamcardv2'));
                        } elseif (isset($udyamcardv2[0]['statusCode']) && $udyamcardv2[0]['statusCode'] == 403) {
                            $statusCode = 403;
                            $error_message = $udyamcardv2[0]['message'];
                            return view('kyc.single_search', compact('udyamcardv2'));
                        } else {
                            $udyamcardv2statusCode = 500;
                            $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                            return view('kyc.single_search', compact('udyamcardv2statusCode', 'error_message'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('udyamcardv2', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankStatements") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $headers = ['AccessToken: ' . $accessToken];
                    $data = [
                        'bank_name' => $request->bank_name,
                        'bank_stmt' => new \CURLFILE($_FILES['bank_statement']['tmp_name'], $_FILES['bank_statement']['type'], $_FILES['bank_statement']['name']),
                        'account_type' => $request->accounttype,
                    ];
                    $url = 'http://regtechapi.in/api/seachv4';
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $get_data = curl_exec($ch);
                    $bankstatment = json_decode($get_data, true);
                    //   dd($bankstatment);
                    if (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 200) {
                        $bankStatements = [];
                        foreach ($bankstatment['bank_statement']['transactions'] as $key => $item) {
                            $bankStatement = [
                                'TransactionId' => isset($item['transactionId']) ? $item['transactionId'] : ' ',
                                'description' => isset($item['description']) ? $item['description'] : ' ',
                                'type' => isset($item['type']) ? $item['type'] : ' ',
                                'category' => isset($item['category']) ? $item['category'] : ' ',
                                'amount' => isset($item['amount']) ? $item['amount'] : '',
                                'balanceAfterTransaction' => isset($item['balanceAfterTransaction']) ? $item['balanceAfterTransaction'] : '',
                                'dateTime' => isset($item['dateTime']) ? $item['dateTime'] : ' ',
                            ];
                            $bankStatements[] = $bankStatement;
                        }
                        $customPaper = [0, 0, 967.0, 967.8];
                        $pdf = PDF::loadView('kyc.statementpdf_loantap', compact('bankStatements'))->setPaper($customPaper, 'landscape');
                        return $pdf->stream('invoice.pdf');
                    } elseif (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 102) {
                        $error_message = $bankstatment['errors'][0]['reason'];
                        return view('kyc.single_search', compact('bankstatment', 'error_message'));
                    } elseif (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 103) {
                        $error_message = $bankstatment['message'];
                        return view('kyc.single_search', compact('bankstatment', 'error_message'));
                    } else {
                        $bankStatementStatusCode = 500;
                        return view('kyc.single_search', compact('bankStatementStatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $headers = ['AccessToken: ' . $accessToken];
                        $data = [
                            'bank_name' => $request->bank_name,
                            'bank_stmt' => new \CURLFILE($_FILES['bank_statement']['tmp_name'], $_FILES['bank_statement']['type'], $_FILES['bank_statement']['name']),
                            'account_type' => $request->accounttype,
                        ];
                        $url = 'http://regtechapi.in/api/seachv4';
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $get_data = curl_exec($ch);
                        $bankstatment = json_decode($get_data, true);
                        if (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 200) {
                            $bankStatements = [];
                            foreach ($bankstatment['bank_statement']['transactions'] as $key => $item) {
                                $bankStatement = [
                                    'TransactionId' => isset($item['transactionId']) ? $item['transactionId'] : ' ',
                                    'description' => isset($item['description']) ? $item['description'] : ' ',
                                    'type' => isset($item['type']) ? $item['type'] : ' ',
                                    'category' => isset($item['category']) ? $item['category'] : ' ',
                                    'amount' => isset($item['amount']) ? $item['amount'] : '',
                                    'balanceAfterTransaction' => isset($item['balanceAfterTransaction']) ? $item['balanceAfterTransaction'] : '',
                                    'dateTime' => isset($item['dateTime']) ? $item['dateTime'] : ' ',
                                ];
                                $bankStatements[] = $bankStatement;
                            }
                            $customPaper = [0, 0, 967.0, 967.8];
                            $pdf = PDF::loadView('kyc.statementpdf_loantap', compact('bankStatements'))->setPaper($customPaper, 'landscape');
                            return $pdf->stream('invoice.pdf');
                        } elseif (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 102) {
                            $error_message = $bankstatment['errors'];

                            return view('kyc.single_search', compact('bankstatment', 'error_message'));
                        } elseif (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 103) {
                            $error_message = $bankstatment['message'];
                            return view('kyc.single_search', compact('bankstatment', 'error_message'));
                        } else {
                            $bankStatementStatusCode = 500;
                            return view('kyc.single_search', compact('bankStatementStatusCode'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('bankstatment', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PANTOGST") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pantogst')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'pancard_number' => $request->pancardNumber,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $pantogstDetails = json_decode($result, true);
                    if (isset($pantogstDetails['status_code']) && $pantogstDetails['status_code'] == 200) {
                        return view('kyc.single_search', compact('pantogstDetails'));
                    } elseif (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] == 102) {
                        $error_message = $pantogstDetails['message'];
                        return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                    } elseif (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] == 103) {
                        $error_message = $pantogstDetails['message'];
                        return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                    } elseif (isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode'] == 403) {
                        $error_message = $pantogstDetails[0]['message'];
                        return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                    } elseif (isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode'] == 404) {
                        $error_message = $pantogstDetails[0]['message'];
                        return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                    } else {
                        $pangststatusCode = 500;
                        $error_message = "Internal Server Error.";
                        return view('kyc.single_search', compact('pangststatusCode', 'error_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'pancard_number' => $request->pancardNumber,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $pantogstDetails = json_decode($result, true);
                        if (isset($pantogstDetails['status_code']) && $pantogstDetails['status_code'] == 200) {
                            return view('kyc.single_search', compact('pantogstDetails'));
                        } elseif (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] == 102) {
                            $error_message = $pantogstDetails['message'];
                            return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                        } elseif (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] == 103) {
                            $error_message = $pantogstDetails['message'];
                            return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                        } elseif (isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode'] == 403) {
                            $error_message = $pantogstDetails[0]['message'];
                            return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                        } elseif (isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode'] == 404) {
                            $error_message = $pantogstDetails[0]['message'];
                            return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                        } else {
                            $pangststatusCode = 500;
                            $error_message = "Internal Server Error.";
                            return view('kyc.single_search', compact('pantogstDetails', 'error_message'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pantogstDetails', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BasicGstin") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'gstin')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'gstin_number' => $request->gstinNumber,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $BasicGstinVerification = json_decode($result, true);
                    if (isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code'] == 200) {
                        return view('kyc.single_search', compact('BasicGstinVerification'));
                    } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 102 || isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code'] == 102) {
                        $error_message = $BasicGstinVerification['message'];
                        return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                    } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 103) {
                        $error_message = $BasicGstinVerification['message'];
                        return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                    } elseif (isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode'] == 403) {
                        $error_message = $BasicGstinVerification[0]['message'];
                        return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                    } elseif (isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode'] == 404) {
                        $error_message = $BasicGstinVerification[0]['message'];
                        return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                    } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 500) {
                        $error_message = $BasicGstinVerification['message'];
                        return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                    } else {
                        $basicgstinStatusCode = 500;
                        return view('kyc.single_search', compact('BasicGstinVerification'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'gstin_number' => $request->gstinNumber,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $BasicGstinVerification = json_decode($result, true);
                        if (isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code'] == 200) {
                            return view('kyc.single_search', compact('BasicGstinVerification'));
                        } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 102 || isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code'] == 102) {
                            $error_message = $BasicGstinVerification['message'];
                            return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                        } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 103) {
                            $error_message = $BasicGstinVerification['message'];
                            return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                        } elseif (isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode'] == 403) {
                            $error_message = $BasicGstinVerification[0]['message'];
                            return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                        } elseif (isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode'] == 404) {
                            $error_message = $BasicGstinVerification[0]['message'];
                            return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                        } elseif (isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode'] == 500) {
                            $error_message = $BasicGstinVerification['message'];
                            return view('kyc.single_search', compact('BasicGstinVerification', 'error_message'));
                        } else {
                            $basicgstinStatusCode = 500;
                            return view('kyc.single_search', compact('BasicGstinVerification'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('BasicGstinVerification', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "Pancard") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'paninfo')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'pan_no' => $request->pan_no,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $pan_cards = json_decode($result, true);
                    if (isset($pan_cards['status_code']) && $pan_cards['status_code'] == 200) {
                        return view('kyc.single_search', compact('pan_cards'));
                    } elseif (isset($pan_cards['statusCode']) && $pan_cards['statusCode'] == 102) {
                        $error_message = $pan_cards['message'];
                        return view('kyc.single_search', compact('pan_cards', 'error_message'));
                    } elseif (isset($pan_cards['statusCode']) && $pan_cards['statusCode'] == 103) {
                        $error_message = $pan_cards['message'];
                        return view('kyc.single_search', compact('pan_cards', 'error_message'));
                    } else {
                        $pancardStatusCode = 500;
                        return view('kyc.single_search', compact('pancardStatusCode'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'pan_no' => $request->pan_no,
                            ),
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $pan_cards = json_decode($result, true);
                        if (isset($pan_cards['status_code']) && $pan_cards['status_code'] == 200) {
                            return view('kyc.single_search', compact('pan_cards'));
                        } elseif (isset($pan_cards['statusCode']) && $pan_cards['statusCode'] == 102) {
                            $error_message = $pan_cards['message'];
                            return view('kyc.single_search', compact('pan_cards', 'error_message'));
                        } elseif (isset($pan_cards['statusCode']) && $pan_cards['statusCode'] == 103) {
                            $error_message = $pan_cards['message'];
                            return view('kyc.single_search', compact('pan_cards', 'error_message'));
                        } else {
                            $pancardStatusCode = 500;
                            return view('kyc.single_search', compact('pancardStatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pan_cards', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CinBasic") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('cin_number' => $request->cin_number),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $corporate_basic = json_decode($response, true);
                    if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 200) {
                        return view('kyc.single_search', compact('corporate_basic'));
                    } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 102) {
                        return view('kyc.single_search', compact('corporate_basic'));
                    } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 201) {
                        return view('kyc.single_search', compact('corporate_basic'));
                    } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 103) {
                        return view('kyc.single_search', compact('corporate_basic'));
                    } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 500) {
                        return view('kyc.single_search', compact('corporate_basic'));
                    } else {
                        $cinadbasicStatusCode = 500;
                        return view('kyc.single_search', compact('cinadbasicStatusCode'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array('cin_number' => $request->cin_number),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $corporate_basic = json_decode($response, true);
                        if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 200) {
                            return view('kyc.single_search', compact('corporate_basic'));
                        } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 102) {
                            return view('kyc.single_search', compact('corporate_basic'));
                        } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 201) {
                            return view('kyc.single_search', compact('corporate_basic'));
                        } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 103) {
                            return view('kyc.single_search', compact('corporate_basic'));
                        } elseif (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode'] == 500) {
                            return view('kyc.single_search', compact('corporate_basic'));
                        } else {
                            $cinadbasicStatusCode = 500;
                            return view('kyc.single_search', compact('cinadbasicStatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('corporate_basic', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CinAdvanced") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('cinNumber' => $request->cinNumber),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $corporate_advance = json_decode($response, true);
                    if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 200) {
                        return view('kyc.single_search', compact('corporate_advance'));
                    } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 102) {
                        return view('kyc.single_search', compact('corporate_advance'));
                    } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 201) {
                        return view('kyc.single_search', compact('corporate_advance'));
                    } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 103) {
                        return view('kyc.single_search', compact('corporate_advance'));
                    } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 500) {
                        return view('kyc.single_search', compact('corporate_advance'));
                    } else {
                        $cinadvancedStatusCode = 500;
                        return view('kyc.single_search', compact('cinadvancedStatusCode'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array('cinNumber' => $request->cinNumber),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $corporate_advance = json_decode($response, true);
                        if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 200) {
                            return view('kyc.single_search', compact('corporate_advance'));
                        } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 102) {
                            return view('kyc.single_search', compact('corporate_advance'));
                        } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 201) {
                            return view('kyc.single_search', compact('corporate_advance'));
                        } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 103) {
                            return view('kyc.single_search', compact('corporate_advance'));
                        } elseif (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode'] == 500) {
                            return view('kyc.single_search', compact('corporate_advance'));
                        } else {
                            $cinadvancedStatusCode = 500;
                            return view('kyc.single_search', compact('cinadvancedStatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('corporate_advance', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "dedupe") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'dedupe')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "bucket_name" => $request->bucket_name,
                            "prefix" => $request->prefix,
                            "aws_access_key_id" => $request->aws_access_key_id,
                            "aws_secret_access_key" => $request->aws_secret_access_key,
                            "region_name" => $request->region_name,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $dedupe_details = json_decode($response, true);
                    if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('dedupe_details'));
                    } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 102) {
                        $error_message = $dedupe_details['message'];
                        return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                    } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 103) {
                        $error_message = $dedupe_details['message'];
                        return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                    } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 500) {
                        $error_message = $dedupe_details['message'];
                        return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                    } else {
                        $dedupeStatusCode = 500;
                        return view('kyc.single_search');
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bucket_name" => $request->bucket_name,
                                "prefix" => $request->prefix,
                                "aws_access_key_id" => $request->aws_access_key_id,
                                "aws_secret_access_key" => $request->aws_secret_access_key,
                                "region_name" => $request->region_name,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $dedupe_details = json_decode($response, true);
                        if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                        } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 102) {
                            $error_message = $dedupe_details['message'];
                            return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                        } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 103) {
                            $error_message = $dedupe_details['message'];
                            return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                        } elseif (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 500) {
                            $error_message = $dedupe_details['message'];
                            return view('kyc.single_search', compact('dedupe_details', 'error_message'));
                        } else {
                            $dedupeStatusCode = 500;
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('dedupe_details', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "EquifaxScroe") {
                if (Auth::user()->scheme_type != 'demo') {
                    $api_score = new EquifaxScoreApi();
                    $api_score->first_name = $request->FirstName;
                    $api_score->last_name = $request->LastName;
                    $api_score->date_of_birth = $request->sdob;
                    $api_score->mobile_number = $request->MobileNumber;
                    $api_score->pan_no = $request->segmentIdValue;
                    $api_score->created_at = date('Y-m-d H:i:s');
                    $api_score->updated_at = date('Y-m-d H:i:s');
                    $api_score->save();
                    $body = [
                        'first_name' => $request->FirstName,
                        'last_name' => $request->LastName,
                        'dob' => $request->sdob,
                        'phone_number' => $request->MobileNumber,
                        'pano' => $request->sIdValue
                    ];
                    //   $headers = [
                    //       'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJ0bGFuZCIsImlhdCI6MTY5MTM4NDEzODczNH0.nHmNhb-NlFPziNE_-9iEGKTIVoiz5rM_lNVvPLvQLgU',
                    //       'Content-Type' => ' application/json',
                    //   ];
                    $accessToken = Auth::user()->access_token;

                    $headers = [
                        'AccessToken' => $accessToken,
                    ];
                    $client = new Client();
                    $response = $client->post('http://regtechapi.in/api/seachv4', [
                        'headers' => $headers,
                        'json' => $body,
                    ]);
                    $responseData = json_decode($response->getBody(), true);
                    //return $responseData;

                    if (isset($responseData["statusCode"]) && $responseData["statusCode"] == 102) {
                        $api_score->err_mark = $responseData["Error"];
                        $api_score->status_code = 102;
                        $api_score->save();
                        $score_api_message = json_encode([
                            'statusCode' => 102,
                            'message' => $responseData["Error"],

                        ]);
                        return view('kyc.single_search', compact('score_api_message'));
                    }
                    if (isset($responseData["statusCode"]) && $responseData["statusCode"] == 200) {
                        $api_score->err_mark = 'success';
                        $api_score->status_code = 200;
                        $api_score->score_value = $responseData["ScoreValue "];
                        $api_score->save();
                        $score_api_success_message = json_encode([
                            'statusCode' => 200,
                            'score_value' => $responseData["ScoreValue "],
                            'full_name' => $request->FirstName . ' ' . $request->LastName,
                            'pan_no' => $request->sIdValue,
                        ]);
                        return view('kyc.single_search', compact('score_api_success_message'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $api_score = new EquifaxScoreApi();
                        $api_score->first_name = $request->FirstName;
                        $api_score->last_name = $request->LastName;
                        $api_score->date_of_birth = $request->sdob;
                        $api_score->mobile_number = $request->MobileNumber;
                        $api_score->pan_no = $request->IdValue;
                        $api_score->created_at = date('Y-m-d H:i:s');
                        $api_score->updated_at = date('Y-m-d H:i:s');
                        $api_score->save();
                        $body = [
                            'first_name' => $request->FirstName,
                            'last_name' => $request->LastName,
                            'dob' => $request->sdob,
                            'phone_number' => $request->MobileNumber,
                            'pano' => $request->sIdValue
                        ];
                        $accessToken = Auth::user()->access_token;

                        $headers = [
                            'AccessToken' => $accessToken,
                        ];
                        $client = new Client();
                        $response = $client->post('http://regtechapi.in/api/seachv4', [
                            'headers' => $headers,
                            'json' => $body,
                        ]);
                        $responseData = json_decode($response->getBody(), true);
                        if (isset($responseData["statusCode"]) && $responseData["statusCode"] == 102) {
                            $api_score->err_mark = $responseData["Error"];
                            $api_score->status_code = 102;
                            $api_score->save();
                            $score_api_message = json_encode([
                                'statusCode' => 102,
                                'message' => $responseData["Error"],

                            ]);
                            return view('kyc.single_search', compact('score_api_message'));
                            // return redirect()->route('other.equifax_score')->with('score_api_message',$score_api_message);
                        }
                        if (isset($responseData["statusCode"]) && $responseData["statusCode"] == 200) {
                            $api_score->err_mark = 'success';
                            $api_score->status_code = 200;
                            $api_score->score_value = $responseData["ScoreValue "];
                            $api_score->save();
                            $score_api_success_message = json_encode([
                                'statusCode' => 200,
                                'score_value' => $responseData["ScoreValue "],
                                'full_name' => $request->FirstName . ' ' . $request->LastName,
                                'pan_no' => $request->sIdValue,
                            ]);
                            return view('kyc.single_search', compact('score_api_success_message'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }

                }

            } elseif (!empty($request->apies) && $request->get('apies') == "Ecredit") {
                $sql = DB::table('equifax_pdf_request')->insert([
                    'firstName' => $request->crfname,
                    'lastName' => $request->crlname,
                    'contactNo' => $request->crphone_number,
                    'idValue' => $request->crpan_num,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
                // dd('testing now');
                $statusCode = null;
                // $equifax = null;
                $aadhar_num = $request->craadhar_num ? $request->craadhar_num : null;
                $pan_num = $request->crpan_num ? $request->crpan_num : null;
                $voter_id = $request->crvoter_num ? $request->crvoter_num : null;
                $passport = $request->crpassport_num ? $request->crpassport_num : null;
                $driving_licence = $request->crdriving_num ? $request->crdriving_num : null;

                $hit_limits_exceeded = 0;
                $otp = mt_rand(100000, 999999);
                $uname = Auth::user()->name;
                $arr = explode(' ', trim($uname));
                $user = '';
                $substr = '';
                foreach ($arr as $array) {
                    $substr = substr($array, 0, 1);
                    $user = $user . $substr;
                }

                $recordId = sprintf("%04d", $record_id->id);
                $CustRefField = "DB-" . strtoupper($user) . Carbon::now()->format('y') . Carbon::now()->format('m') . $recordId;
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];


                $body = [
                    'api_type' => 'Ecredit',
                    'fname' => $request->crfname,
                    'lname' => $request->crlname,
                    'phone_num' => $request->crphone_number,
                    'pan_num' => $request->crpan_num,
                    'DateOfBirth' => $request->crdob,
                ];

                $client = new Client();
                try {
                    $response = $client->post("http://regtechapi.in/api/seachv4", [
                        'headers' => $headers,
                        'json' => $body
                    ]);
                    $data = $request->all();

                    // $responses = (new ApiController2)->equifaxurl($data);
                    //  print_r(json_decode($response -> getBody(),true));
                    $equifaxdetails = json_decode($response->getBody(), true);
                    if ($equifaxdetails['statusCode'] != 102) {
                        $equifax = $equifaxdetails['Equifax_Report'];
                        // return $equifax;
                        // print_r($equifax);

                        if (!empty($equifax)) {
                            $myarray = array();


                            if ($equifax['CCRResponse']['Status'] == "0")
                                return view('kyc.equifax', compact('equifax'));

                            // foreach($equifax['CCRResponse']['CIRReportDataLst'] as $emptykey =>  $emptyvalue)
                            // if($equifax['CCRResponse']['Status'] == "0" && $emptyvalue['Error']['ErrorCode'] == "00")
                            //     return view('kyc.equifax',compact('equifax'));




                            foreach ($equifax['CCRResponse']['CIRReportDataLst'] as $key => $value) {
                                if (array_key_exists("Error", $value)) {
                                    $isFound = 0;
                                    return view('kyc.equifax', compact('equifax', 'isFound'));
                                }


                                if (isset($value['InquiryResponseHeader']['ReportOrderNO']))
                                    $orderNo = $value['InquiryResponseHeader']['ReportOrderNO'];
                                else
                                    $orderNo = "";

                                if (
                                    isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Name']['FullName'])
                                )
                                    $consumerName = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Name']['FullName'];
                                else
                                    $consumerName = "";

                                if (
                                    isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['DateOfBirth'])
                                )
                                    $DOB = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['DateOfBirth'];
                                else
                                    $DOB = "";

                                if (isset($value['InquiryResponseHeader']['Date']))
                                    $date = $value['InquiryResponseHeader']['Date'];
                                else
                                    $date = "";

                                if (isset($value['InquiryResponseHeader']['Time']))
                                    $time = $value['InquiryResponseHeader']['Time'];
                                else
                                    $time = "";

                                if (
                                    isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Age']['Age'])
                                )
                                    $age = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Age']['Age'];
                                else
                                    $age = "";

                                if ($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'])
                                    $gender = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'];
                                else
                                    $gender = "";

                                if (isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['PANId'])) {
                                    foreach ($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['PANId'] as $key1 => $value1)
                                        if (isset($value1['IdNumber']))
                                            $PAN = $value1['IdNumber'];
                                        else
                                            $PAN = "";
                                } else {
                                    $PAN = "";
                                }

                                if (isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'])) {
                                    foreach ($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'] as $key1 => $value1)
                                        if (isset($value1['IdNumber']))
                                            $NationalIDCard = $value1['IdNumber'];
                                        else
                                            $NationalIDCard = "";
                                } else {
                                    $NationalIDCard = "";
                                }

                                if (isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'])) {
                                    foreach ($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
                                        if (isset($value1['IdNumber']))
                                            $VoterID = $value1['IdNumber'];
                                        else
                                            $VoterID = "";
                                } else {
                                    $VoterID = "";
                                }
                                // foreach($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
                                //     if(isset($value1['IdNumber']))
                                //         $VoterID = $value1['IdNumber'];
                                //     else
                                //         $VoterID = "";          

                                foreach ($value['InquiryRequestInfo']['InquiryPhones'] as $key2 => $value2)
                                    if (isset($value2['Number']))
                                        $Number = $value2['Number'];
                                    else
                                        $Number = "";

                                if (isset($value['CIRReportData']['IDAndContactInfo']['AddressInfo']))
                                    $consumer_address = $value['CIRReportData']['IDAndContactInfo']['AddressInfo'];
                                else
                                    $consumer_address = "";

                                $score_array = $value['CIRReportData']['ScoreDetails'];
                                if (count($score_array) > 0) {
                                    // foreach($score_array as $scoredetails)
                                    // {   
                                    $score_details = $score_array;
                                    // if(isset($scoredetails['Value'])){
                                    //     $score = $scoredetails['Value'];
                                    //     $score_version = $scoredetails['Version'];
                                    // }else{
                                    //     $score = "";
                                    //     $score_version = "";
                                    // }
                                    // if(isset($scoredetails['ScoringElements']))
                                    //     $scoringelements = $scoredetails['ScoringElements'];
                                    // else
                                    //     $scoringelements = "";

                                    // }
                                } else {
                                    $score_details = [];
                                }

                                if (isset($value['CIRReportData']['RecentActivities']))
                                    $enquiry_summary = $value['CIRReportData']['RecentActivities'];
                                else
                                    $enquiry_summary = "";

                                if (isset($value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts']))
                                    $numberofAccounts = $value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts'];
                                else
                                    $numberofAccounts = "";

                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalBalanceAmount'])
                                )
                                    $TotalBalanceAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalBalanceAmount'];
                                else
                                    $TotalBalanceAmount = "";

                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalPastDue'])
                                )
                                    $TotalPastAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalPastDue'];
                                else
                                    $TotalPastAmount = "";

                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['RecentAccount'])
                                )
                                    $recent_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['RecentAccount'];
                                else
                                    $recent_account = "";

                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['OldestAccount'])
                                )
                                    $oldest_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['OldestAccount'];
                                else
                                    $oldest_account = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfActiveAccounts'])
                                )
                                    $numberOfOpenAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfActiveAccounts'];
                                else
                                    $numberOfOpenAccount = "";

                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfPastDueAccounts'])
                                )
                                    $numberOfPastDueAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfPastDueAccounts'];
                                else
                                    $numberOfPastDueAccount = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalHighCredit'])
                                )
                                    $TotalHighCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalHighCredit'];
                                else
                                    $TotalHighCredit = "";



                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalCreditLimit'])
                                )
                                    $TotalCreditLimit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalCreditLimit'];
                                else
                                    $TotalCreditLimit = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfWriteOffs'])
                                )
                                    $NoOfWriteOffs = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfWriteOffs'];
                                else
                                    $NoOfWriteOffs = "";



                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'])
                                )
                                    $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];
                                else
                                    $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];



                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestCredit'])
                                )
                                    $SingleHighestCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestCredit'];
                                else
                                    $SingleHighestCredit = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'])
                                )
                                    $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                                else
                                    $NoOfZeroBalanceAccounts = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalMonthlyPaymentAmount'])
                                )
                                    $TotalMonthlyPaymentAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalMonthlyPaymentAmount'];
                                else
                                    $TotalMonthlyPaymentAmount = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'])
                                )
                                    $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                                else
                                    $NoOfZeroBalanceAccounts = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestBalance'])
                                )
                                    $SingleHighestBalance = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestBalance'];
                                else
                                    $SingleHighestBalance = "";


                                if (
                                    isset($value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestSanctionAmount'])
                                )
                                    $SingleHighestSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestSanctionAmount'];
                                else
                                    $SingleHighestSanctionAmount = "";



                                //RETAIL ACCOUNT DETAILS

                                $RetailAccountDetails = $value['CIRReportData']['RetailAccountDetails'];

                                //Enquiries

                                if (isset($value['CIRReportData']['Enquiries'])) {
                                    $enquiries = $value['CIRReportData']['Enquiries'];
                                } else {
                                    $enquiries = "";
                                }

                                //Enquiry Summary
                                if (isset($value['CIRReportData']['EnquirySummary']['Purpose']))
                                    $Purpose = $value['CIRReportData']['EnquirySummary']['Purpose'];
                                else
                                    $Purpose = "";


                                if (isset($value['CIRReportData']['EnquirySummary']['Total']))
                                    $Total = $value['CIRReportData']['EnquirySummary']['Total'];
                                else
                                    $Total = "";


                                if (isset($value['CIRReportData']['EnquirySummary']['Past30Days']))
                                    $Past30Days = $value['CIRReportData']['EnquirySummary']['Past30Days'];
                                else
                                    $Past30Days = "";




                                if (isset($value['CIRReportData']['EnquirySummary']['Past12Months']))
                                    $Past12Months = $value['CIRReportData']['EnquirySummary']['Past12Months'];
                                else
                                    $Past12Months = "";


                                if (isset($value['CIRReportData']['EnquirySummary']['Past24Months']))
                                    $Past24Months = $value['CIRReportData']['EnquirySummary']['Past24Months'];
                                else
                                    $Past24Months = "";


                                if (isset($value['CIRReportData']['EnquirySummary']['Recent']))
                                    $Recent = $value['CIRReportData']['EnquirySummary']['Recent'];
                                else
                                    $Recent = "";

                                // foreach($RetailAccountDetails as $RetailAccountDetail)
                                // {
                                //     $AccountNumber = $RetailAccountDetail['AccountNumber'];
                                //     $Balance = $RetailAccountDetail['Balance'];
                                //     $Open = $RetailAccountDetail['Open'];
                                //     $DateReported = $RetailAccountDetail['DateReported'];
                                //     $Institution = $RetailAccountDetail['Institution'];
                                //     $PastDueAmount = $RetailAccountDetail['PastDueAmount'];
                                //     //$InterestRate = $RetailAccountDetail['AccountNumber']);
                                //     $DateOpened = $RetailAccountDetail['DateOpened'];
                                //     $Type = $RetailAccountDetail['AccountType'];
                                //     $LastPaymentDate = $RetailAccountDetail['LastPaymentDate'];
                                //     $LastPaymentDue = $RetailAccountDetail['LastPaymentDate'];
                                //     //$DateClosed = $RetailAccountDetail['AccountNumber']);
                                //     $OwnershipType = $RetailAccountDetail['source'];
                                //     //$WriteOffAmount = $RetailAccountDetail['AccountNumber']);
                                //     $SanctionAmount = $RetailAccountDetail['SanctionAmount'];



                                // }

                                //Personal Information
                                $myarray['CustRefField'] = $CustRefField;
                                $myarray['orderNo'] = $orderNo;
                                $myarray['consumerName'] = $consumerName;
                                $myarray['PAN'] = $PAN;
                                $myarray['VoterID'] = $VoterID;
                                $myarray['Number'] = $Number;
                                $myarray['DOB'] = $DOB;
                                $myarray['age'] = $age;
                                $myarray['gender'] = $gender;
                                $myarray['NationalIDCard'] = $NationalIDCard;
                                // $myarray['aadhar'] = $aadhar_num;
                                //Address
                                $myarray['consumer_address'] = $consumer_address;

                                //Score
                                // $myarray['score'] = $score;
                                // $myarray['score_version'] = $score_version;
                                // $myarray['scoringelements'] = $scoringelements;
                                $myarray['score_details'] = $score_details;

                                //date and time
                                $myarray['date'] = $date;
                                $myarray['time'] = $time;
                                $myarray['enquiries'] = $enquiries;
                                $myarray['enquiry_summary'] = $enquiry_summary;

                                //Summary
                                $myarray['numberofAccounts'] = $numberofAccounts;
                                $myarray['TotalBalanceAmount'] = $TotalBalanceAmount;
                                $myarray['TotalPastAmount'] = $TotalPastAmount;
                                $myarray['recentAccount'] = $recent_account;
                                $myarray['oldestAccount'] = $oldest_account;
                                $myarray['numberOfOpenAccount'] = $numberOfOpenAccount;
                                $myarray['numberOfPastDueAccount'] = $numberOfPastDueAccount;
                                $myarray['TotalHighCredit'] = $TotalHighCredit;
                                $myarray['TotalCreditLimit'] = $TotalCreditLimit;
                                $myarray['NoOfWriteOffs'] = $NoOfWriteOffs;
                                $myarray['TotalSanctionAmount'] = $TotalSanctionAmount;
                                $myarray['SingleHighestCredit'] = $SingleHighestCredit;
                                $myarray['NoOfZeroBalanceAccounts'] = $NoOfZeroBalanceAccounts;
                                $myarray['TotalMonthlyPaymentAmount'] = $TotalMonthlyPaymentAmount;
                                $myarray['NoOfZeroBalanceAccounts'] = $NoOfZeroBalanceAccounts;
                                $myarray['SingleHighestBalance'] = $SingleHighestBalance;
                                $myarray['SingleHighestSanctionAmount'] = $SingleHighestSanctionAmount
                                ;
                                $myarray['RetailAccountDetails'] = $RetailAccountDetails;

                                //Enquiry Summary
                                $myarray['Purpose'] = $Purpose;
                                $myarray['Total'] = $Total;
                                $myarray['Past30Days'] = $Past30Days;
                                $myarray['Past24Months'] = $Past24Months;
                                $myarray['Recent'] = $Recent;
                                $myarray['Past12Months'] = $Past12Months;



                            }

                            // return $myarray;
                            // return view('kyc.equifaxreportpdf',compact('myarray','equifax'));
                            $pdf = PDF::loadView('kyc.equifaxreportpdf', compact('myarray', 'equifax'))->setPaper('A2');
                            return $pdf->stream('invoice.pdf');
                        }

                    }
                    $pan_num = $request->pan_num;
                    $pdf = PDF::loadView('kyc.equifaxreportpdferror', compact('equifaxdetails', 'pan_num'))->setPaper('A4');
                    return $pdf->stream('invoice.pdf');

                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "EmailVerify") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'verifyemail')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "email_to_verify" => $request->verify_email_id,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $verify_email = json_decode($response, true);
                    if (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 200) {

                        return view('kyc.single_search', compact('verify_email'));
                    } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 102) {
                        $error_message = $verify_email['message'];
                        return view('kyc.single_search', compact('verify_email', 'error_message'));
                    } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 103) {
                        $error_message = $verify_email['message'];
                        return view('kyc.single_search', compact('verify_email', 'error_message'));
                    } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 500) {
                        $error_message = $verify_email['message'];
                        return view('kyc.single_search', compact('verify_email', 'error_message'));
                    } else {
                        $verifyEmailStatusCode = 500;
                        return view('kyc.single_search');
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "email_to_verify" => $request->verify_email_id,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $verify_email = json_decode($response, true);
                        if (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 200) {

                            return view('kyc.single_search', compact('verify_email'));
                        } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 102) {
                            $error_message = $verify_email['message'];
                            return view('kyc.single_search', compact('verify_email', 'error_message'));
                        } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 103) {
                            $error_message = $verify_email['message'];
                            return view('kyc.single_search', compact('verify_email', 'error_message'));
                        } elseif (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 500) {
                            $error_message = $verify_email['message'];
                            return view('kyc.single_search', compact('verify_email', 'error_message'));
                        } else {
                            $verifyEmailStatusCode = 500;
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('email_verify', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CheckEmailVerify") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'checkverificationemailstatus')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "identity" => $request->check_verify_email_id,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $check_verify_email_status = json_decode($response, true);
                    if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 200) {
                        return view('kyc.single_search', compact('check_verify_email_status'));
                    } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 102) {
                        $error_message = $check_verify_email_status['message'];
                        return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                    } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 103) {
                        $error_message = $check_verify_email_status['message'];
                        return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                    } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 500) {
                        $error_message = $check_verify_email_status['message'];
                        return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                    } else {
                        $verifyEmailStatusCode = 500;
                        return view('kyc.single_search', compact('verifyEmailStatusCode'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "identity" => $request->check_verify_email_id,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $check_verify_email_status = json_decode($response, true);

                        if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 200) {
                            return view('kyc.single_search', compact('check_verify_email_status'));
                        } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 102) {
                            $error_message = $check_verify_email_status['message'];
                            return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                        } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 103) {
                            $error_message = $check_verify_email_status['message'];
                            return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                        } elseif (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 500) {
                            $error_message = $check_verify_email_status['message'];
                            return view('kyc.single_search', compact('check_verify_email_status', 'error_message'));
                        } else {
                            $verifyEmailStatusCode = 500;
                            return view('kyc.single_search', compact('verifyEmailStatusCode'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('check_verify_email_status', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "Ckyc") {

                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $pano = $request->pan_number_ckyc;
                $dob = $request->dob_ckyc;
                $client_ref_num = rand(10000, 99999);
                if (Auth::user()->scheme_type != 'demo') {
                    // return 'demo';
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'searchkycdigitap')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, [
                        CURLOPT_URL => 'http://regtechapi.in/api/ckyc_searchadvance',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'pano' => $pano,
                            'client_ref_num' => $client_ref_num,
                            'dob' => $dob,
                            'identifier_type' => 'PAN'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $searchkyc = json_decode($result, true);

                    if (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 200 && $searchkyc['response']['status'] == "VALID") {
                        $statusCodeCkyc = 200;
                        return view('kyc.single_search', compact('statusCodeCkyc', 'searchkyc'));
                    } elseif (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 102) {
                        $statusCodeCkyc = 102;
                        return view('kyc.single_search', compact('statusCodeCkyc'));
                    } elseif (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 103) {
                        $statusCodeCkyc = 103;
                        return view('kyc.single_search', compact('statusCodeCkyc'));
                    } else {
                        $statusCodeCkyc = 500;
                        return view('kyc.single_search', compact('statusCodeCkyc'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, [
                            CURLOPT_URL => 'http://regtechapi.in/api/ckyc_searchadvance',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'pano' => $pano,
                                'client_ref_num' => $client_ref_num,
                                'dob' => $dob,
                                'identifier_type' => 'PAN'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                        ]);
                        // $get_data1 = curl_exec($curl1);
                        $result = curl_exec($curl1);
                        $searchkyc = json_decode($result, true);

                        if (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 200 && $searchkyc['response']['status'] == "VALID") {
                            $statusCodeCkyc = 200;
                            return view('kyc.single_search', compact('statusCodeCkyc', 'searchkyc', 'hit_limits_exceeded', 'low_wallet_balance'));
                        } elseif (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 102) {
                            $statusCodeCkyc = 102;
                            return view('kyc.single_search', compact('statusCodeCkyc'));
                        } elseif (isset($searchkyc['statusCode']) && $searchkyc['statusCode'] == 103) {
                            $statusCodeCkyc = 103;
                            return view('kyc.single_search', compact('statusCodeCkyc'));
                        } else {
                            $statusCodeCkyc = 500;
                            return view('kyc.single_search', compact('statusCodeCkyc'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;

                        return view('kyc.single_search', compact('searchkyc', 'statusCodeCkyc', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "TelecomApi") {
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $json = [
                    'IDNumber' => $request->mobile_number_telcom,
                ];
                $client = new CLient();
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $api_master = ApiMaster::where('api_slug', 'telecom_generate_otp')->first();
                        if ($api_master)
                            $api_id = $api_master->id;
                    }

                    try {
                        $response = $client->post('http://regtechapi.in/api/seachv4', [
                            'headers' => $headers,
                            'json' => $json
                        ]);

                        $telecom = json_decode($response->getBody(), true);
                        $statusCode = 200;

                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $telecom['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('telecom'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post('http://regtechapi.in/api/seachv4', [
                                'headers' => $headers,
                                'json' => $json
                            ]);

                            $telecom = json_decode($response->getBody(), true);
                            $statusCode = 200;

                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $telecom['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('telecom'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('telecom', 'hit_limits_exceeded'));
                    }

                }


            } elseif (!empty($request->apies) && $request->get('apies') == "GSTIN") {

                $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->corporate_gstin

                // ];
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'gstin' => $request->corporate_gstinv2
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'gstin')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }



                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $corporate_gstin = json_decode($res->getBody(), true);
                        $statusCodeGstin = 200;
                        return view('kyc.single_search', compact('corporate_gstin'));
                    } catch (BadResponseException $e) {
                        $statusCodeGstin = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCodeGstin'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $corporate_gstin = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('corporate_gstin'));
                        } catch (BadResponseException $e) {
                            $statusCodeGstin = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodeGstin'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('corporate_gstin', 'statusCodeGstin', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "Ifsc") {
                $client = new Client();

                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'ifsc' => $request->bank_ifsc_code
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_ifsc')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $bank_verification_ifsc = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('bank_verification_ifsc'));
                    } catch (BadResponseException $e) {
                        $statusCodeIfsc = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCodeIfsc'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            //$res = $client->post($this->base_url.'/bank-verification/find-ifsc', ['headers' => $headers, 'json' => $body]);
                            $bank_verification_ifsc = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('bank_verification_ifsc'));
                        } catch (BadResponseException $e) {
                            $statusCodeIfsc = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodeIfsc'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('bank_verification_ifsc', 'statusCodeIfsc', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "Pancard_Verification") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'pan_number' => $request->verify_pan_number
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/pancard', ['headers' => $headers, 'json' => $body]);
                        $pancardVerification = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('pancardVerification'));
                    } catch (BadResponseException $e) {
                        $statusCodepanVerification = $e->getResponse()->getStatusCode();
                        if ($statusCodepanVerification == 500) {
                            $errorMessageVerification = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } else if ($statusCodepanVerification == 422) {
                            $errorMessageVerification = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessageVerification = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search', compact('statusCodepanVerification', 'errorMessageVerification'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/pancard', ['headers' => $headers, 'json' => $body]);
                            $pancardVerification = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('pancardVerification'));
                        } catch (BadResponseException $e) {
                            $statusCodepanVerification = $e->getResponse()->getStatusCode();
                            if ($statusCodepanVerification == 500) {
                                $errorMessageVerification = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } else if ($statusCodepanVerification == 422) {
                                $errorMessageVerification = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessageVerification = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search', compact('statusCodepanVerification', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancardVerification', 'statusCodepanVerification', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PANCARDINFO") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'pan_number' => $request->paninfo_number
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/pancard_details', ['headers' => $headers, 'json' => $body]);
                        $pancardInfoDetails = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('pancardInfoDetails'));
                    } catch (BadResponseException $e) {
                        $statusCodePanCardInfo = $e->getResponse()->getStatusCode();
                        if ($statusCodePanCardInfo == 500) {
                            $errorMessagePincardInfo = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } else if ($statusCodePanCardInfo == 422) {
                            $errorMessagePincardInfo = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessagePincardInfo = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search', compact('statusCodePanCardInfo'));
                    }
                } else {

                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/pancard_details', ['headers' => $headers, 'json' => $body]);
                            $pancardInfoDetails = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('pancardInfoDetails'));
                        } catch (BadResponseException $e) {
                            $statusCodePanCardInfo = $e->getResponse()->getStatusCode();
                            if ($statusCodePanCardInfo == 500) {
                                $errorMessagePincardInfo = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } else if ($statusCodePanCardInfo == 422) {
                                $errorMessagePincardInfo = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessagePincardInfo = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search', compact('statusCodePanCardInfo'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancardInfoDetails', 'statusCodePanCardInfo', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PANCARDDETAILS") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'pan_no' => $request->pandetails_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    // return 'yusys';
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pandetails1')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $response = $client->post('http://regtechapi.in/api/pan_details_check', ['headers' => $headers, 'json' => $body]);
                        $pancardnew_details = json_decode($response->getBody(), true);
                        return view('kyc.single_search', compact('pancardnew_details'));
                    } catch (BadResponseException $e) {
                        $response = $e->getResponse();
                        $pancardError = json_decode($response->getBody(), true);
                        $statusCode = $e->getResponse()->getStatusCode();
                        if (isset($pancardError['statusCode']) && $pancardError['statusCode'] == 102) {
                            $statusCode = 102;
                            $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                            return view('kyc.single_search');
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.single_search');
                        }
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {

                        try {
                            $response = $client->post('http://regtechapi.in/api/pan_details_check', ['headers' => $headers, 'json' => $body]);
                            $pancardnew_details = json_decode($response->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('pancardnew_details'));
                        } catch (BadResponseException $e) {
                            $response = $e->getResponse();
                            $pancardError = json_decode($response->getBody(), true);
                            $statusCode = $e->getResponse()->getStatusCode();
                            if (isset($pancardError['statusCode']) && $pancardError['statusCode'] == 102) {
                                $statusCode = 102;
                                $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                                return view('kyc.single_search');
                            } else {
                                $statusCode = 500;
                                $errorMessage = 'Internal Server Error.';
                                return view('kyc.single_search');
                            }
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PassportVerification") {
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $json = [
                    'id_number' => $request->passport_file_number,
                    'dob' => $request->passport_dob
                ];

                $client = new Client();

                if (Auth::user()->scheme_type != "demo") {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'passportverify')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }


                    try {
                        $res = $client->post('http://regtechapi.in/api/passport_verification', ['headers' => $headers, 'json' => $json, 'verify' => false]);
                        $passportverify = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('passportverify'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/passport_verification', ['headers' => $headers, 'json' => $json, 'verify' => false]);
                            $passportverify = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('passportverify'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('passportverify', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankAnalyser") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/bank_anlyser",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "file" => new \CURLFILE($_FILES['bank_statement_file']['tmp_name'], $_FILES['bank_statement_file']['type'], $_FILES['bank_statement_file']['name']),
                            "password" => $request->bank_password,
                            "bank" => $request->analayser_bank_name,
                            'accountType' => $request->bank_account_type,
                            "country" => "INDIA"
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));
                    $result = curl_exec($curl1);
                    $bankstatement_analyser = json_decode($result, true);
                    if (isset($bankstatement_analyser['statusCode']) && $bankstatement_analyser['statusCode'] == '200') {
                        $statmendata = $bankstatement_analyser['response'];
                        $statusCode = $bankstatement_analyser['statusCode'];
                        $atm_withdrawl = $bankstatement_analyser['response']['atm_withdrawls'];
                        $averageMonthlyBalance = $bankstatement_analyser['response']['averageMonthlyBalance'];
                        $averageQuarterlyBalance = $bankstatement_analyser['response']['averageQuarterlyBalance'];
                        $expenses = $bankstatement_analyser['response']['expenses'];
                        $high_value_transactions = $bankstatement_analyser['response']['high_value_transactions'];
                        $incomes = $bankstatement_analyser['response']['incomes'];
                        $minimum_balances = $bankstatement_analyser['response']['minimum_balances'];
                        $money_received_transactions = $bankstatement_analyser['response']['money_received_transactions'];
                        // return $atm_withdrawl;
                        $customPaper = [0, 0, 967.0, 967.8];
                        $pdf = PDF::loadView('kyc.analyserpdf', compact('atm_withdrawl', 'averageMonthlyBalance', 'averageQuarterlyBalance', 'expenses', 'high_value_transactions', 'incomes', 'minimum_balances', 'money_received_transactions'))->setPaper($customPaper, 'A4');
                        // $pdf = PDF::loadView('kyc.analyserpdf',compact('statmendata'))->setPaper('A4');
                        return $pdf->stream('invoice.pdf');

                    } else {
                        return view('kyc.single_search', compact('bankstatement_analyser', 'hit_limits_exceeded'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/bank_anlyser",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "file" => new \CURLFILE($_FILES['bank_statement_file']['tmp_name'], $_FILES['bank_statement_file']['type'], $_FILES['bank_statement_file']['name']),
                                "password" => $request->bank_password,
                                "bank" => $request->analayser_bank_name,
                                'accountType' => $request->bank_account_type,
                                "country" => "INDIA"
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));
                        $result = curl_exec($curl1);
                        $bankstatement_analyser = json_decode($result, true);
                        if (isset($bankstatement_analyser['statusCode']) && $bankstatement_analyser['statusCode'] == '200') {
                            $statmendata = $bankstatement_analyser['response'];
                            $statusCode = $bankstatement_analyser['statusCode'];
                            $atm_withdrawl = $bankstatement_analyser['response']['atm_withdrawls'];
                            $averageMonthlyBalance = $bankstatement_analyser['response']['averageMonthlyBalance'];
                            $averageQuarterlyBalance = $bankstatement_analyser['response']['averageQuarterlyBalance'];
                            $expenses = $bankstatement_analyser['response']['expenses'];
                            $high_value_transactions = $bankstatement_analyser['response']['high_value_transactions'];
                            $incomes = $bankstatement_analyser['response']['incomes'];
                            $minimum_balances = $bankstatement_analyser['response']['minimum_balances'];
                            $money_received_transactions = $bankstatement_analyser['response']['money_received_transactions'];
                            // return $atm_withdrawl;
                            $customPaper = [0, 0, 967.0, 967.8];
                            $pdf = PDF::loadView('kyc.analyserpdf', compact('atm_withdrawl', 'averageMonthlyBalance', 'averageQuarterlyBalance', 'expenses', 'high_value_transactions', 'incomes', 'minimum_balances', 'money_received_transactions'))->setPaper($customPaper, 'A4');
                            // $pdf = PDF::loadView('kyc.analyserpdf',compact('statmendata'))->setPaper('A4');
                            return $pdf->stream('invoice.pdf');

                        } else {
                            return view('kyc.single_search', compact('bankstatement_analyser', 'hit_limits_exceeded'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "FaceMatch") {
                $client = new Client();

                $doc_img = base64_encode(file_get_contents($request->file('doc_img')->path()));
                $selfie = base64_encode(file_get_contents($request->file('selfie')->path()));

                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'doc_img' => $doc_img,
                    'selfie' => $selfie,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'facematch')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/face_match1', ['headers' => $headers, 'json' => $body]);

                        $face_match = json_decode($res->getBody(), true);
                        if (isset($face_match[0]['face_match']['code'])) {
                            $statusCode = $face_match[0]['face_match']['code'];
                        }
                        return view('kyc.single_search', compact('face_match'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } else if ($statusCode == 422) {
                            $errorMessage = 'Document Image and Selfie Image is required in base64 format';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/face_match1', ['headers' => $headers, 'json' => $body]);
                            $face_match = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            if (isset($face_match[0]['face_match']['code'])) {
                                $statusCode = $face_match[0]['face_match']['code'];
                            }
                            return view('kyc.single_search', compact('face_match'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } else if ($statusCode == 422) {
                                $errorMessage = 'Document Image and Selfie Image is required in base64 format';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;

                        return view('kyc.single_search', compact('face_match', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "AadharUpload") {

                $accessToken = Auth::user()->access_token;
                $curl1 = curl_init();
                curl_setopt_array($curl1, array(
                    CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => array(
                        "aadharcard_img" => new \CURLFILE($_FILES['aadhaar_image_pdf']['tmp_name'], $_FILES['aadhaar_image_pdf']['type'], $_FILES['aadhaar_image_pdf']['name']),
                    ),
                    CURLOPT_HTTPHEADER => array(
                        "AccessToken" . $accessToken,
                    ),
                ));
                // $get_data1 = curl_exec($curl1);
                $result = curl_exec($curl1);
                $aadhaarOCR1 = json_decode($result, true);

                $statusCodeAadhaarUpload = isset($aadhaarOCR['status_code']) ? $aadhaarOCR['status_code'] : null;
                $aadhaar_number = null;
                // if($aadhaarOCR['data']['ocr_fields']) {
                //      $aadhaar_number = $aadhaarOCR['data']['ocr_fields'][0]['aadhaar_number']['value'];
                // }
                if ($statusCodeAadhaarUpload) {
                    $statusCodeAadhaarUpload = 200;
                } else {
                    $statusCodeAadhaarUpload = 500;
                }

                if ($aadhaar_number) {
                    $client = new Client();
                    // $headers = [
                    //     'Authorization' => $this->token,        
                    //     'Accept'        => 'application/json',
                    // ];
                    // $body =  [
                    //     'id_number' => $aadhaar_number
                    // ];
                    $accessToken = Auth::user()->access_token;

                    $headers = [
                        'AccessToken' => $accessToken,
                    ];
                    $body = [
                        'aadhaar_number' => $aadhaar_number
                    ];
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                        $aadhaar1 = json_decode($res->getBody(), true);
                        //dd($aadhaar);
                        $statusCodeAadhaarUpload = 200;

                        return view('kyc.single_search', compact('aadhaar1', 'statusCodeAadhaarUpload'));

                    } catch (BadResponseException $e) {
                        $statusCodeAadhaarUpload = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCodeAadhaarUpload', 'errorMessage'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "AadharMasking") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "aadharcard_img1" => new \CURLFILE($_FILES['aadhaar_front_image']['tmp_name'], $_FILES['aadhaar_front_image']['type'], $_FILES['aadhaar_front_image']['name']),
                            //"file_back" => new \CURLFILE($_FILES['file_back']['tmp_name'],$_FILES['file_back']['type'],$_FILES['file_back']['name']),
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));

                    $result = curl_exec($curl1);
                    $aadhaar_masking1 = json_decode($result, true);
                    return view('kyc.single_search', compact('aadhaar_masking1'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "aadharcard_img1" => new \CURLFILE($_FILES['aadhaar_front_image']['tmp_name'], $_FILES['aadhaar_front_image']['type'], $_FILES['aadhaar_front_image']['name']),
                                // "file_back" => new \CURLFILE($_FILES['file_back']['tmp_name'],$_FILES['file_back']['type'],$_FILES['file_back']['name']),
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));

                        $result = curl_exec($curl1);
                        $aadhaar_masking1 = json_decode($result, true);
                        return view('kyc.single_search', compact('aadhaar_masking1'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('aadhaar_masking1', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "VoterUpload") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "voterid_file" => new \CURLFILE($_FILES['voter_image']['tmp_name'], $_FILES['voter_image']['type'], $_FILES['voter_image']['name'])
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $voterocr = json_decode($result, true);
                    $voteruplode = isset($voterocr[0]['ocr_fields']) ? $voterocr[0]['ocr_fields'] : null;
                    $voter_detailed_info_upload = isset($voterocr[0]['voter_validation']) ? $voterocr[0]['voter_validation'] : null;
                    $statusCodevoterUpload = isset($voterocr[0]['statusCode']) ? $voterocr[0]['statusCode'] : null;

                    if (isset($voter_detailed_info_upload['status_code']) && $voter_detailed_info_upload['status_code'] == 200) {
                        $is_valid = 1;
                    }
                    $is_valid = 1;
                    return view('kyc.single_search', compact('voteruplode', 'voter_detailed_info_upload', 'statusCodevoterUpload'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "voterid_file" => new \CURLFILE($_FILES['voter_image']['tmp_name'], $_FILES['voter_image']['type'], $_FILES['voter_image']['name'])
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));
                        // $get_data1 = curl_exec($curl1);
                        $result = curl_exec($curl1);
                        $voterocr = json_decode($result, true);
                        $voteruplode = isset($voterocr[0]['ocr_fields']) ? $voterocr[0]['ocr_fields'] : null;
                        $voter_detailed_info_upload = isset($voterocr[0]['voter_validation']) ? $voterocr[0]['voter_validation'] : null;
                        $statusCodevoterUpload = isset($voterocr[0]['statusCode']) ? $voterocr[0]['statusCode'] : null;

                        if (isset($voter_detailed_info_upload['status_code']) && $voter_detailed_info_upload['status_code'] == 200) {
                            $is_valid = 1;
                        }


                        $is_valid = 1;
                        return view('kyc.single_search', compact('voteruplode', 'voter_detailed_info_upload', 'statusCodevoterUpload'));

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('voteruplode', 'voter_detailed_info_upload', 'hit_limits_exceeded'));
                    }

                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PanUpload") {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "pan_image" => new \CURLFILE($_FILES['pancard_image']['tmp_name'], $_FILES['pancard_image']['type'], $_FILES['pancard_image']['name'])
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $pancarduploade = json_decode($result, true);
                    $statusCode = '';
                    if (isset($pancarduploade[0]['statusCode'])) {
                        $statusCode = $pancarduploade[0]['statusCode'];
                    }
                    $pan_verified = 0;
                    $pancardupload2 = null;
                    if ($statusCode == 200) {
                        $pan_no = $pancarduploade[0]['pancard']['pan_number'];
                        $client = new Client();

                        $headers = [
                            'AccessToken' => $accessToken,
                        ];
                        $body = [
                            'pan_number' => $pan_no
                        ];
                        try {
                            //$res = $client->post($this->base_url.'/pan/pan', ['headers' => $headers, 'json' => $body]);
                            $res = $client->post('http://regtechapi.in/api/pancard', ['headers' => $headers, 'json' => $body]);
                            $pancardupload2 = json_decode($res->getBody(), true);
                            if ($pancardupload2[0]['statusCode'] == 200)
                                $pan_verified = 1;
                        } catch (BadResponseException $e) {
                            $statusCodepanUpload = $e->getResponse()->getStatusCode();
                            $pan_verified = 0;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodepanUpload'));
                        }
                    }
                    return view('kyc.single_search', compact('statusCodepanUpload', 'pancarduploade', 'pancardupload2'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "pan_image" => new \CURLFILE($_FILES['pancard_image']['tmp_name'], $_FILES['pancard_image']['type'], $_FILES['pancard_image']['name'])
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));
                        // $get_data1 = curl_exec($curl1);
                        $result = curl_exec($curl1);
                        $pancarduploade = json_decode($result, true);
                        $statusCode = '';
                        if (isset($pancarduploade[0]['statusCode'])) {
                            $statusCode = $pancarduploade[0]['statusCode'];
                        }
                        $pan_verified = 0;
                        $pancardupload2 = null;
                        if ($statusCode == 200) {
                            $pan_no = $pancarduploade[0]['pancard']['pan_number'];
                            $client = new Client();

                            $headers = [
                                'AccessToken' => $accessToken,
                            ];
                            $body = [
                                'pan_number' => $pan_no
                            ];
                            try {
                                //$res = $client->post($this->base_url.'/pan/pan', ['headers' => $headers, 'json' => $body]);
                                $res = $client->post('http://regtechapi.in/api/pancard', ['headers' => $headers, 'json' => $body]);
                                $pancardupload2 = json_decode($res->getBody(), true);
                                if ($pancardupload2[0]['statusCode'] == 200)
                                    $pan_verified = 1;
                            } catch (BadResponseException $e) {
                                $statusCodepanUpload = $e->getResponse()->getStatusCode();
                                $pan_verified = 0;
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                                return view('kyc.single_search', compact('statusCodepanUpload'));
                            }
                        }
                        return view('kyc.single_search', compact('statusCodepanUpload', 'pancarduploade', 'pancardupload2'));

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancardupload2', 'hit_limits_exceeded'));
                    }

                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PassportCreateClient") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body = [
                    'idNumber' => $request->passport_clientid
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_name', 'passport')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }


                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $passport_create_client = json_decode($res->getBody(), true);
                        $statusCode = 200;
                        return view('kyc.single_search', compact('passport_create_client'));
                    } catch (BadResponseException $e) {
                        $statusCodepassport_create_client = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCodepassport_create_client'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $passport_create_client = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('passport_create_client'));
                        } catch (BadResponseException $e) {
                            $statusCodepassport_create_client = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodepassport_create_client'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('passport_create_client', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PassportUpload") {

                if (Auth::user()->scheme_type != 'demo') {
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "passport_file" => new \CURLFILE($_FILES['passport_upload_file']['tmp_name'], $_FILES['passport_upload_file']['type'], $_FILES['passport_upload_file']['name']),
                            //   "client_id"=>$request->passport_upload_client_id
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: " . $this->token,
                        ),
                    ));
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $passportUpload = json_decode($result, true);

                    if (isset($passportUpload['statusCode'])) {
                        $statusCodeUploadPassport = $passportUpload['statusCode'];
                    } else {
                        $statusCodeUploadPassport = 500;
                    }
                    // dd($passport);
                    // echo 'status_code='.$status_code;
                    $passport_verification = null;
                    $is_verified = 0;
                    if ($statusCodeUploadPassport == 200 || $statusCodeUploadPassport == 400) {
                        $client_id = $passportUpload['OCR_DATA']['data']['client_id'];
                        // dd($client_id);
                        // echo 'client_id='.$client_id;
                        $client = new Client();
                        $accessToken = Auth::user()->access_token;

                        $headers = [
                            'AccessToken' => $accessToken,
                        ];

                        $body = [
                            'client_id' => $client_id
                        ];

                        try {
                            $res = $client->post('http://regtechapi.in/api/passport_verify', ['headers' => $headers, 'json' => $body]);
                            $passport_verification_upload = json_decode($res->getBody(), true);
                            // dd($passport_verification);
                            if ($passport_verification_upload['status_code'] == 200)
                                $is_verified = 1;
                            return view('kyc.single_search', compact('statusCodeUploadPassport', 'passport_verification_upload'));
                        } catch (BadResponseException $e) {
                            $statusCodeUploadPassport = $e->getResponse()->getStatusCode();
                            $is_verified = 0;
                            $errorMessagePassportUpload = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodeUploadPassport', 'errorMessagePassportUpload'));
                        }
                    }
                    return view('kyc.single_search', compact('passportUpload', 'statusCodeUploadPassport'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/passport_upload",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "passport_file" => new \CURLFILE($_FILES['passport_upload_file']['tmp_name'], $_FILES['passport_upload_file']['type'], $_FILES['passport_upload_file']['name']),
                                //   "client_id"=>$request->passport_upload_client_id
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "Authorization: " . $this->token,
                            ),
                        ));
                        // $get_data1 = curl_exec($curl1);
                        $result = curl_exec($curl1);
                        $passportpassportUpload = json_decode($result, true);

                        if (isset($passportUpload['statusCode'])) {
                            $statusCodeUploadPassport = $passportUpload['statusCode'];
                        } else {
                            $statusCodeUploadPassport = 500;
                        }
                        // dd($passport);
                        // echo 'status_code='.$status_code;
                        $passport_verification = null;
                        $is_verified = 0;
                        if ($statusCodeUploadPassport == 200 || $statusCodeUploadPassport == 400) {
                            $client_id = $passportUpload['OCR_DATA']['data']['client_id'];
                            // dd($client_id);
                            // echo 'client_id='.$client_id;
                            $client = new Client();
                            $accessToken = Auth::user()->access_token;

                            $headers = [
                                'AccessToken' => $accessToken,
                            ];

                            $body = [
                                'client_id' => $client_id
                            ];

                            try {
                                // dd(1);
                                $res = $client->post('http://regtechapi.in/api/passport_verify', ['headers' => $headers, 'json' => $body]);
                                $passport_verification_upload = json_decode($res->getBody(), true);
                                // dd($passport_verification);
                                if ($passport_verification_upload['status_code'] == 200)
                                    $is_verified = 1;
                                return view('kyc.single_search', compact('statusCode', 'passport_verification_upload'));
                            } catch (BadResponseException $e) {
                                $statusCode = $e->getResponse()->getStatusCode();
                                $is_verified = 0;
                                $errorMessagePassportUpload = 'Error. Please contact techsupport@docboyz.in. for more details';
                                return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                            }
                        }
                        return view('kyc.single_search', compact('passportUpload', 'statusCodeUploadPassport'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('passportUpload', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PassportVerify") {
                if (Auth::user()->scheme_type != 'demo') {
                    $client = new Client();
                    $accessToken = Auth::user()->access_token;

                    $headers = [
                        'AccessToken' => $accessToken,
                    ];

                    $body = [
                        'clientId' => $request->client_id
                    ];
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $passport_verify1 = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('passport_verify1'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $client = new Client();
                        $accessToken = Auth::user()->access_token;

                        $headers = [
                            'AccessToken' => $accessToken,
                        ];
                        $body = [
                            'clientId' => $request->client_id
                        ];
                        try {

                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $passport_verify1 = json_decode($res->getBody(), true);
                            return view('kyc.single_search', compact('passport_verify1'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded'));
                    }

                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CorpoarteCin") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'corporate_cin_number' => $request->corpoarate_number_cin
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'cin')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }


                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/corporate/cin', ['headers' => $headers, 'json' => $body]);
                        $corporate_cin1 = json_decode($res->getBody(), true);
                        $statusCode = 200;
                        return view('kyc.single_search', compact('corporate_cin1'));
                    } catch (BadResponseException $e) {
                        $statusCodeCorporate = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCodeCorporate'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $corporate_cin1 = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('corporate_cin1'));
                        } catch (BadResponseException $e) {
                            $statusCodeCorporate = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCodeCorporate'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('corporate_cin1', 'statusCodeCorporate', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CorpoarteDin") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body = [
                    'corporate_din_number' => $request->corpoarate_number_din
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'din')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }



                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        // $res = $client->post('https://kyc-api.flowboard.in/api/v1/corporate/din', ['headers' => $headers, 'json' => $body]);
                        $corporate_din1 = json_decode($res->getBody(), true);
                        // dd($request->corporate_din);
                        $statusCode = 200;
                        return view('kyc.single_search', compact('corporate_din1'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            // $res = $client->post($this->base_url.'/corporate/din', ['headers' => $headers, 'json' => $body]);
                            $corporate_din1 = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('corporate_din1'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('corporate_din1', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "RcValidationTest") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'rc_num' => $request->rc_rc_number_test
                ];

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'rc')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $rc_validationTest = json_decode($res->getBody(), true);
                        // dd($rc_validation);
                        if (isset($rc_validationTest[0]['rc_validation']['data']['vehicle_gross_weight'])) {
                            $grossWeight = $rc_validationTest[0]['rc_validation']['data']['vehicle_gross_weight'];
                            if ($grossWeight == null) {
                                $grossWeight = 0;
                            }
                            $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                        }
                        if (isset($rc_validationTest[0]['statusCode'])) {
                            $statusCode = $rc_validationTest[0]['statusCode'];
                        } else {
                            $statusCode = $rc_validationTest['statusCode'];
                        }
                        return view('kyc.single_search', compact('rc_validationTest'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $rc_validationTest = json_decode($res->getBody(), true);
                            //dd($rc_validation);
                            if (isset($rc_validationTest[0]['rc_validation']['data']['vehicle_gross_weight'])) {
                                $grossWeight = $rc_validationTest[0]['rc_validation']['data']['vehicle_gross_weight'];
                                if ($grossWeight == null) {
                                    $grossWeight = 0;
                                }
                                $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                            }
                            if (isset($rc_validationTest[0]['statusCode']) && $rc_validationTest[0]['statusCode'] != 500) {
                                $user = User::where('id', Auth::user()->id)->first();
                                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                                $user->save();
                            }
                            return view('kyc.single_search', compact('rc_validationTest'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('rc_validationTest', 'checkWeight', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "RcValidationLite") {
                $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->rc_number
                // ];
                $accessToken = Auth::user()->access_token;
                // dd( $accessToken);

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'Rc_Number' => $request->rc_number
                ];

                if (Auth::user()->scheme_type != 'demo') {

                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'rcvallite')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        // dd('testeroneasassssone');
                        //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $rc_validationLite = json_decode($res->getBody(), true);

                        if (isset($rc_validationLite[0]['statusCode'])) {
                            $statusCode = $rc_validationLite[0]['statusCode'];
                        } else {
                            $statusCode = $rc_validationLite['statusCode'];
                        }
                        return view('kyc.single_search', compact('rc_validationLite'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $rc_validationLite = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            if (isset($rc_validationLite[0]['statusCode'])) {
                                $statusCode = $rc_validationLite[0]['statusCode'];
                            } else {
                                $statusCode = $rc_validationLite['statusCode'];
                            }
                            return view('kyc.single_search', compact('rc_validationLite'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search', compact('statusCode', 'errorMessage'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('rc_validationLite', 'hit_limits_exceeded'));
                    }

                }
            } elseif (!empty($request->apies) && $request->get('apies') == "FastTagInformation") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'rc_number' => $request->rc_fast_number,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'rc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $fast_tag_information = json_decode($res->getBody(), true);
                        if (isset($fast_tag_information['rc_validation']['data']['vehicle_gross_weight']) || (isset($fast_tag_information['status_code']) && $fast_tag_information['status_code'] == 200)) {
                            $grossWeight1 = $fast_tag_information['rc_validation']['data']['vehicle_gross_weight'];
                            $statusCode = 200;
                            if ($grossWeight1 == null) {
                                $grossWeight1 = 0;
                            }
                            $checkWeight1 = Rcfull::where('min_weight', '<=', $grossWeight1)
                                ->Where('max_weight', '>=', $grossWeight1)
                                ->first();
                            return view('kyc.single_search', compact('fast_tag_information', 'checkWeight1', 'statusCode', 'hit_limits_exceeded'));
                        } elseif (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == 102) {
                            $statusCode = $fast_tag_information['statusCode'];
                        } else {
                            $statusCode = $fast_tag_information['statusCode'];
                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $fast_tag_information = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            if (isset($fast_tag_information['rc_validation']['data']['vehicle_gross_weight']) || (isset($fast_tag_information['status_code']) && $fast_tag_information['status_code'] == 200)) {
                                $grossWeight1 = $fast_tag_information['rc_validation']['data']['vehicle_gross_weight'];
                                $statusCode = 200;
                                if ($grossWeight1 == null) {
                                    $grossWeight1 = 0;
                                }
                                $checkWeight1 = Rcfull::where('min_weight', '<=', $grossWeight1)
                                    ->Where('max_weight', '>=', $grossWeight1)
                                    ->first();
                                return view('kyc.single_search', compact('fast_tag_information', 'checkWeight1', 'statusCode', 'hit_limits_exceeded'));
                            } elseif (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == 102) {
                                $statusCode = $fast_tag_information['statusCode'];
                            } else {
                                $statusCode = $fast_tag_information['statusCode'];
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search');
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('fast_tag_information', 'checkWeight1', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "RcFullValidation") {
                $client = new Client();

                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'rc_number' => $request->rc_fnumber
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'rcfull')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $rc_challan = json_decode($res->getBody(), true);
                        // dd($rc_challan[0]['statusCode']);
                        return view('kyc.single_search', compact('rc_challan'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $rc_challan = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('rc_challan'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('rc_challan', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankStatement") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "bank_Statement" => new \CURLFILE($_FILES['bankstatement_file']['tmp_name'], $_FILES['bankstatement_file']['type'], $_FILES['bankstatement_file']['name']),
                            "bank_Name" => $request->stbank_name,
                            'accountype' => $request->staccountType,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $bankstatement = json_decode($result, true);
                    if (isset($bankstatement['statusCode']) && $bankstatement['statusCode'] == 200) {
                        $statmendata = null;
                        foreach ($bankstatement['response'] as $key => $item) {
                            $bankStatement = [
                                'TransactionId' => isset($item['transactionId']) ? $item['transactionId'] : ' ',
                                'description' => isset($item['description']) ? $item['description'] : ' ',
                                'type' => isset($item['type']) ? $item['type'] : ' ',
                                'category' => isset($item['category']) ? $item['category'] : ' ',
                                'amount' => isset($item['amount']) ? $item['amount'] : '',
                                'balanceAfterTransaction' => isset($item['balanceAfterTransaction']) ? $item['balanceAfterTransaction'] : '',
                                'dateTime' => isset($item['dateTime']) ? $item['dateTime'] : ' ',
                            ];
                            $statmendata[] = $bankStatement;
                        }
                        $customPaper = [0, 0, 967.0, 967.8];
                        $pdf = PDF::loadView('kyc.statementpdf', compact('statmendata'))->setPaper($customPaper, 'landscape');
                        return $pdf->stream('invoice.pdf');
                    } else {
                        $bank_statement2 = $bankstatement;
                        return view('kyc.single_search', compact('bank_statement2'));
                    }

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "bank_Statement" => new \CURLFILE($_FILES['bankstatement_file']['tmp_name'], $_FILES['bankstatement_file']['type'], $_FILES['bankstatement_file']['name']),
                                "bank_Name" => $request->stbank_name,
                                'accountype' => $request->staccountType,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));
                        // $get_data1 = curl_exec($curl1);
                        $result = curl_exec($curl1);
                        $bankstatement = json_decode($result, true);
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        if (isset($bankstatement['statusCode']) && $bankstatement['statusCode'] == 200) {
                            $statmendata = null;
                            foreach ($bankstatement['response'] as $key => $item) {
                                $bankStatement = [
                                    'TransactionId' => isset($item['transactionId']) ? $item['transactionId'] : ' ',
                                    'description' => isset($item['description']) ? $item['description'] : ' ',
                                    'type' => isset($item['type']) ? $item['type'] : ' ',
                                    'category' => isset($item['category']) ? $item['category'] : ' ',
                                    'amount' => isset($item['amount']) ? $item['amount'] : '',
                                    'balanceAfterTransaction' => isset($item['balanceAfterTransaction']) ? $item['balanceAfterTransaction'] : '',
                                    'dateTime' => isset($item['dateTime']) ? $item['dateTime'] : ' ',
                                ];
                                $statmendata[] = $bankStatement;
                            }
                            $customPaper = [0, 0, 967.0, 967.8];
                            $pdf = PDF::loadView('kyc.statementpdf', compact('statmendata'))->setPaper($customPaper, 'landscape');
                            return $pdf->stream('invoice.pdf');
                        } else {
                            $bank_statement2 = $bankstatement;
                            return view('kyc.single_search', compact('bank_statement2'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('bank_statement2', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankValidation") {
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        $client = new Client();
                        $accessToken = Auth::user()->access_token;

                        $headers = [
                            'AccessToken' => $accessToken,
                        ];
                        $body = [
                            'bankName' => 'Test No',
                            'accno' => $request->bank_validation_account_number,
                            'Ifsc' => $request->bank_validation_ifsc_number
                        ];
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                        $bank_verification = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('bank_verification'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $bank_verification['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('bank_verification'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $client = new Client();
                            $accessToken = Auth::user()->access_token;

                            $headers = [
                                'AccessToken' => $accessToken,
                            ];
                            $body = [
                                'bankName' => 'Test No',
                                'accno' => $request->bank_validation_account_number,
                                'Ifsc' => $request->bank_validation_ifsc_number
                            ];
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                            $bank_verification = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('bank_verification'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $bank_verification['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('bank_verification'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('bank_verification', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "DrivingLicenseUpload") {
                $validated = $request->validate([
                    'license_front_image' => ['required'],
                    'license_back_image' => ['required'],
                ], [
                    'license_front_image.required' => 'Please enter license front image.',
                    'license_back_image.required' => 'Please enter license back image.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4", //"https://sandbox.flowboard.in/api/v1/ocr/license",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "dl_front" => new \CURLFILE($_FILES['license_front_image']['tmp_name'], $_FILES['license_front_image']['type'], $_FILES['license_front_image']['name']),
                            "back" => new \CURLFILE($_FILES['license_back_image']['tmp_name'], $_FILES['license_back_image']['type'], $_FILES['license_back_image']['name'])
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));

                    $result = curl_exec($curl1);
                    $licenseUploadOcr = json_decode($result, true);
                    if (isset($licenseUploadOcr[0]['$ocr_fields'])) {
                        $licenseUpload = $licenseUploadOcr[0]['$ocr_fields'];
                        $license_upload_validation = $licenseUploadOcr[0]['license_validation'];
                        $statusCode = $licenseUploadOcr[0]['statusCode'];
                    }

                    if (isset($license_upload_validation['status_code']) && $license_upload_validation['status_code'] == 200) {
                        $is_valid = 1;
                    }
                    if ($licenseUploadOcr == null) {
                        $licenseUpload['statusCode'] = 500;
                    }
                    return view('kyc.single_search', compact('licenseUpload', 'license_upload_validation'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4", //"https://sandbox.flowboard.in/api/v1/ocr/license",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "dl_front" => new \CURLFILE($_FILES['license_front_image']['tmp_name'], $_FILES['license_front_image']['type'], $_FILES['license_front_image']['name']),
                                "back" => new \CURLFILE($_FILES['license_back_image']['tmp_name'], $_FILES['license_back_image']['type'], $_FILES['license_back_image']['name'])
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));

                        $result = curl_exec($curl1);
                        $licenseUploadOcr = json_decode($result, true);
                        if (isset($licenseUploadOcr[0]['$ocr_fields'])) {
                            $licenseUpload = $licenseUploadOcr[0]['$ocr_fields'];
                            $license_upload_validation = $licenseUploadOcr[0]['license_validation'];
                            $statusCode = $licenseUploadOcr[0]['statusCode'];
                        }

                        if (isset($license_upload_validation['status_code']) && $license_upload_validation['status_code'] == 200) {
                            $is_valid = 1;
                        }
                        if ($licenseUploadOcr == null) {
                            $licenseUpload['statusCode'] = 500;
                        }
                        return view('kyc.single_search', compact('licenseUpload', 'license_upload_validation'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('licenseUpload', 'license_upload_validation', 'hit_limits_exceeded'));
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "Electricity") {
                $validated = $request->validate([
                    'ele_idNumber' => ['required'],
                ], [
                    'ele_idNumber.required' => 'Please enter consumer number with billing unit.',
                ]);
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body = [
                    'IDNUMBER' => $request->ele_idNumber
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'electricity')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }

                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $electricity = json_decode($res->getBody(), true);
                        $statusCode = 200;
                        return view('kyc.single_search', compact('electricity'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_search');
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $electricity = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('electricity'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.single_search');
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('electricity', 'hit_limits_exceeded'));
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "ShopestaBlishment") {
                $validated = $request->validate([
                    'establ_id_number' => ['required'],
                ], [
                    'establ_id_number.required' => 'Please enter shop establishment number.',
                ]);
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body = [
                    'id_num' => $request->establ_id_number,
                    'operator_code' => $request->operator_code
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'shop_establishment')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }



                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $shopestablishment = json_decode($res->getBody(), true);
                        // $statusCode = 200;
                        return view('kyc.single_search', compact('shopestablishment'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $shopestablishment['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('shopestablishment'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $shopestablishment = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('shopestablishment'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $shopestablishment['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('shopestablishment'));

                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('shopestablishment', 'hit_limits_exceeded'));
                    }


                }
            } elseif (!empty($request->apies) && $request->get('apies') == "FSSAI") {
                $client = new Client();
                $user_id = Auth()->user()->id;
                $user = User::where('id', $user_id)->first();
                $validated = $request->validate([
                    'fssi_id_number' => ['required'],
                ], [
                    'fssi_id_number.required' => 'Please enter fssai number.',
                ]);
                $accessToken = $user->access_token;
                $headers = [
                    'AccessToken' => $accessToken
                ];

                $body = [
                    'fssi_id_number' => $request->fssi_id_number
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'fssi')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $fssi_validation = json_decode($res->getBody(), true);
                        return view('kyc.single_search', compact('fssi_validation'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $fssi_validation['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('fssi_validation'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $fssi_validation = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $fssi_validation['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('fssi_validation'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;

                        return view('kyc.single_search', compact('fssi_validation', 'hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "EPFOWithoutOTP") {
                $accessToken = Auth::user()->access_token;
                $user = User::where('access_token', $accessToken)->first();
                $validated = $request->validate([
                    'employee_name' => ['required'],
                    'company_name' => ['required']
                ], [
                    'employee_name.required' => 'Please enter name.',
                    'company_name.required' => 'Please enter company name.',
                ]);
                $client = new Client();
                $headers = [
                    'AccessToken' => $accessToken,
                    'Accept' => 'application/json'
                ];
                $json = [
                    'Name' => $request->employee_name,
                    'company' => $request->company_name
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    try {
                        $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                        $epfo_details = json_decode($response->getBody(), true);
                        return view('kyc.single_search', compact('epfo_details'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $epfo_details['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('epfo_details'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                            $epfo_details = json_decode($response->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('epfo_details'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $epfo_details['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('epfo_details'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('epfo_details', 'hit_limits_exceeded'));
                    }

                }
            } elseif (!empty($request->apies) && $request->get('apies') == "UANDetails") {
                $accessToken = Auth::user()->access_token;
                $validated = $request->validate([
                    'u_mobile_number' => ['required'],
                ], [
                    'u_mobile_number.required' => 'Please enter mobile number.',
                ]);
                $client = new Client();
                $headers = [
                    'AccessToken' => $accessToken,
                    'Accept' => 'application/json'
                ];
                $json = [
                    'mobile_num' => $request->u_mobile_number
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    try {
                        $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                        $uan_details = json_decode($response->getBody(), true);
                        return view('kyc.single_search', compact('uan_details'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $uan_details['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('uan_details'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                            $uan_details = json_decode($response->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('uan_details'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $uan_details['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('uan_details'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('uan_details', 'hit_limits_exceeded'));
                    }
                }


            } elseif (!empty($request->apies) && $request->get('apies') == "CompanySearch") {
                $accessToken = Auth::user()->access_token;
                $user = User::where('access_token', $accessToken)->first();
                $validated = $request->validate([
                    'scompany_name' => ['required'],
                    'sdata_count' => ['required'],
                ], [
                    'scompany_name.required' => 'Please enter company name.',
                    'sdata_count.required' => 'Please enter data count.',
                ]);
                $client = new Client();
                $headers = [
                    'AccessToken' => $accessToken,
                    'Accept' => 'application/json'
                ];
                $json = [
                    'company_name' => $request->scompany_name,
                    'search_size' => $request->sdata_count
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    try {
                        $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                        // return $response;
                        $company_search = json_decode($response->getBody(), true);
                        return view('kyc.single_search', compact('company_search'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $company_search['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('company_search'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                            // return $response;
                            $company_search = json_decode($response->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();

                            return view('kyc.single_search', compact('company_search'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $company_search['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('company_search'));
                        }

                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('company_search', 'hit_limits_exceeded'));
                    }
                }

            } elseif (!empty($request->apies) && $request->get('apies') == "CompanyDetails") {
                $accessToken = Auth::user()->access_token;
                $user = User::where('access_token', $accessToken)->first();
                $validated = $request->validate([
                    'dcompany_code' => ['required'],
                    'ddata_code' => ['required'],
                ], [
                    'dcompany_code.required' => 'Please enter company code.',
                    'ddata_code.required' => 'Please enter data count.',
                ]);
                $client = new Client();
                $headers = [
                    'AccessToken' => $accessToken,
                    'Accept' => 'application/json'
                ];
                $json = [
                    'company_code' => $request->dcompany_code,
                    'filing_data_size' => $request->ddata_code
                ];
                if (Auth::user()->scheme_type != 'demo') {


                    try {
                        $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                        // return $response;
                        $company_details = json_decode($response->getBody(), true);
                        return view('kyc.single_search', compact('company_details'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $company_details['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('company_details'));

                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post("http://regtechapi.in/api/seachv4", ['headers' => $headers, 'json' => $json]);
                            $company_details = json_decode($response->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('company_details'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            $company_details['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('company_details'));

                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('company_details', 'hit_limits_exceeded'));
                    }
                }


            } elseif (!empty($request->apies) && $request->get('apies') == "CRIF") {
                $body = array();
                $headers = [
                    'X-API-KEY' => 'MEtOdRx3fn4o9zeVAXByVQoKpXn66c3fli4rcCkLy9',
                    'DEV-ACCESS-KEY' => 'CxFJiV2eqm99KpQqzOJMLxVW2eBZwAiMYaezH57P'
                ];

                $sql = DB::table('equifax_pdf_request')->insert([
                    'firstName' => $request->fullname,
                    'lastName' => null,
                    'contactNo' => $request->mno,
                    'idValue' => $request->pan,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();

                $uname = Auth::user()->name;
                // $uname = DB::table('users')->where('id', Auth::id())->get()->first();

                $arr = explode(' ', trim($uname));
                $user = '';
                $substr = '';
                foreach ($arr as $array) {
                    $substr = substr($array, 0, 1);
                    $user = $user . $substr;
                }

                $recordId = sprintf("%04d", $record_id->id);
                $CustRefField = "DB-" . strtoupper($user) . Carbon::now()->format('y') . Carbon::now()->format('m') . $recordId;

                $body = [
                    'gender' => "male",
                    'dob' => $request->crifdob,
                    'pan_card' => $request->crifpan,
                    'mobile_number' => $request->crifmno,
                    'full_name' => $request->criffullname,
                    "home" => [
                        "city" => $request->crifcity,
                        "zipcode" => $request->crifzipcode,
                        "address" => [
                            "line2" => $request->crifaddrline2,
                            "line1" => $request->crifaddrline1
                        ],

                    ],
                    "allowed_for_awesomeui" => "yes",
                    "chm_ref" => $CustRefField
                ];
                $json = json_encode($body);
                $client = new Client();

                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'creditscorereport')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $html_report = base64_decode($reportgenerated['data']['file']['html_report']);
                        // exit(1);
                        $Crif = new Crif();
                        $Crif->user_id = Auth::user()->id;
                        $Crif->full_name = $reportgenerated['data']['request_meta']['full_name'];
                        $Crif->gender = $reportgenerated['data']['request_meta']['gender'];
                        $Crif->pan_card_no = $reportgenerated['data']['request_meta']['pan_card'];
                        $Crif->mob_no = $reportgenerated['data']['request_meta']['mobile_number'];
                        $Crif->crif_report_id = $reportgenerated['data']['crif_report_id'];
                        $Crif->crif_score = $reportgenerated['data']["crif_score"];
                        $Crif->crif_estimated_data = $reportgenerated['data']["crif_estimated_date"];
                        $Crif->response_xml = $reportgenerated['data']['file']['response_xml'];
                        $Crif->html_report = $reportgenerated['data']['file']['html_report'];
                        // $Crif -> enquiry = $reportgenerated['data']['credit_account']['enquiry'];
                        // $Crif -> account = $reportgenerated['data']['credit_account']['account'];

                        $Crif->save();
                        $data = $reportgenerated['data']['file']['response_xml'];
                        //dd($data);
                        // $fname = Auth::user() -> id."-".time()."."."xml"; 
                        // $destpath = public_path()."/XML";
                        // if (!is_dir($destpath)) {  mkdir($destpath,0777,true);  }
                        // File::put($destpath.$fname,$data);


                        if (Auth::user()->role_id == 1) {
                            if ($apiamster) {
                                $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();

                                $addHitCount = new HitCountMaster;
                                $addHitCount->user_id = Auth()->user()->id;
                                $addHitCount->api_id = $api_id;
                                $addHitCount->scheme_price = $updateHitCount->scheme_price;
                                $addHitCount->hit_year_month = date('Y-m');
                                $addHitCount->hit_count = 1;
                                $addHitCount->save();
                            }
                        }
                        $statusCode = 200;
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $response = $client->post($this->crif_url, [
                                'headers' => $headers,
                                'json' => $json
                            ]);

                            $reportgenerated = json_decode($response->getBody(), true);

                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();

                            $statusCode = 200;
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('crif.creditreport', compact('reportgenerated', 'statusCode', 'hit_limits_exceeded'));
                    }
                }
                $response = $client->post("https://loantap.in/affiliate/apiv1-1/docboyz/crif", [
                    'headers' => $headers,
                    'json' => $body
                ]);
                $reportgenerated = json_decode($response->getBody(), true);


            } elseif (!empty($request->apies) && $request->get('apies') == "SearchData") {
                $client = new Client();
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $validated = $request->validate([
                    'sdata_panNumber' => ['required'],
                    'sdata_dob' => ['required'],
                ], [
                    'sdata_panNumber.required' => 'Please enter pan number.',
                    'sdata_dob.required' => 'Please enter  date of birth.',
                ]);
                $body = [
                    'panNo' => $request->sdata_panNumber,
                    'dateofbirth' => $request->sdata_dob
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    // return 'demo';
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);

                        $pancard_search = json_decode($res->getBody(), true);
                        if (isset($pancard_search['statusCode'])) {
                            $statusCode = $pancard_search['statusCode'];
                        }
                        return view('kyc.single_search', compact('pancard_search'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } else if ($statusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        $pancard_search['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('pancard_search'));
                    }
                } else {

                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {

                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $pancard_search = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('pancard_search'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } else if ($statusCode == 422) {
                                $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            $pancard_search['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('pancard_search'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancard_search', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "SearchLiteData") {
                $validated = $request->validate([
                    'slitedata_panNumber' => ['required'],
                    'slitedata_dob' => ['required'],
                ], [
                    'slitedata_panNumber.required' => 'Please enter pan number.',
                    'slitedata_dob.required' => 'Please enter date of birth.',
                ]);
                $client = new Client();
                $accessToken = Auth::user()->access_token;

                $headers = [
                    'AccessToken' => $accessToken,
                ];
                $body = [
                    'pano' => $request->slitedata_panNumber,
                    'dob' => $request->slitedata_dob
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);

                        $pancard_search_lite = json_decode($res->getBody(), true);
                        //   if(isset($pancard_search_lite['statusCode'])){
                        //       $statusCode =$pancard_search_lite['statusCode'];
                        //   }
                        return view('kyc.single_search', compact('pancard_search_lite'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } else if ($statusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        $pancard_search_lite['statusCode'] = $statusCode;
                        return view('kyc.single_search', compact('pancard_search_lite'));
                    }
                } else {

                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        try {
                            $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                            $pancard_search_lite = json_decode($res->getBody(), true);
                            $user = User::where('id', Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count + 1;
                            $user->save();
                            return view('kyc.single_search', compact('pancard_search_lite'));
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                            } else if ($statusCode == 422) {
                                $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            }
                            $pancard_search_lite['statusCode'] = $statusCode;
                            return view('kyc.single_search', compact('pancard_search_lite'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('pancard_search_lite', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ByPancard") {
                $validated = $request->validate([
                    'by_panNumber' => ['required'],
                ], [
                    'by_panNumber.required' => 'Please enter pan number.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $pan_number = $request->by_panNumber;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => ' http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "bypan_id" => $pan_number,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $bypancard_details = json_decode($response, true);
                    if (isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('bypancard_details'));
                    }
                    return view('kyc.single_search', compact('bypancard_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $pan_number = $request->by_panNumber;
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bypan_id" => $pan_number,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $bypancard_details = json_decode($response, true);
                        if (isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('bypancard_details'));
                        }
                        return view('kyc.single_search', compact('bypancard_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "GstinDetails") {
                $validated = $request->validate([
                    'gstin_details_number' => ['required'],
                ], [
                    'gstin_details_number.required' => 'Please enter gstin number.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $gstin_id = $request->gstin_details_number;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "gstin_id" => $gstin_id,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $gstin_details = json_decode($response, true);
                    if (isset($gstin_details['status']) && $gstin_details['status'] == 200) {
                        return view('kyc.single_search', compact('gstin_details'));
                    }
                    return view('kyc.single_search', compact('gstin_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $gstin_id = $request->gstin_details_number;
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "gstin_id" => $gstin_id,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $gstin_details = json_decode($response, true);
                        if (isset($gstin_details['status']) && $gstin_details['status'] == 200) {
                            return view('kyc.single_search', compact('gstin_details'));
                        }
                        return view('kyc.single_search', compact('gstin_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CompanyProduct") {
                if (Auth::user()->scheme_type != 'demo') {
                    $companyName = $request->pro_company_name;
                    $flrsLicenseNo = $request->pro_license_no;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "companyName" => $companyName,
                            "flrsLicenseNo" => $flrsLicenseNo
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $companyProductDetails = json_decode($response, true);

                    if (isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 200) {
                        return view('kyc.single_search', compact('companyProductDetails'));
                    }
                    return view('kyc.single_search', compact('companyProductDetails'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $companyName = $request->pro_company_name;
                        $flrsLicenseNo = $request->pro_license_no;
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "companyName" => $companyName,
                                "flrsLicenseNo" => $flrsLicenseNo
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $companyProductDetails = json_decode($response, true);
                        if (isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 200) {
                            return view('kyc.single_search', compact('companyProductDetails'));
                        }
                        return view('kyc.single_search', compact('companyProductDetails'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "LandRecord") {
                $validated = $request->validate([
                    'lurl' => ['required'],
                    'loriginal_ploat_number' => ['required'],
                    'l_levels' => ['required'],
                ], [
                    'lurl.required' => 'Please enter url.',
                    'loriginal_ploat_number.required' => 'Please enter ploat number.',
                    'l_levels.required' => 'Please enter ploat number.'
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $url = $request->lurl;
                    $original_ploat = $request->loriginal_ploat_number;
                    $gstStateCode = $request->lgst_state_code;
                    $levels = $request->l_levels;
                    $xCoordinate = $request->lx_coordinate;
                    $yCoordinate = $request->ly_coordinate;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "Url" => $url,
                            "OP" => $original_ploat,
                            "GstStateCode" => $gstStateCode,
                            "Levels" => $levels,
                            "X_Coordinate" => $xCoordinate,
                            "Y_Coordinate" => $yCoordinate,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $land_details = json_decode($response, true);
                    if (isset($land_details['status']) && $land_details['status'] == 200) {
                        return view('kyc.single_search', compact('land_details'));
                    }
                    return view('kyc.single_search', compact('land_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $url = $request->lurl;
                        $original_ploat = $request->loriginal_ploat_number;
                        $gstStateCode = $request->lgst_state_code;
                        $levels = $request->l_levels;
                        $xCoordinate = $request->lx_coordinate;
                        $yCoordinate = $request->ly_coordinate;
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "Url" => $url,
                                "OP" => $original_ploat,
                                "GstStateCode" => $gstStateCode,
                                "Levels" => $levels,
                                "X_Coordinate" => $xCoordinate,
                                "Y_Coordinate" => $yCoordinate,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $land_details = json_decode($response, true);
                        if (isset($land_details['status']) && $land_details['status'] == 200) {
                            return view('kyc.single_search', compact('land_details'));
                        }
                        return view('kyc.single_search', compact('land_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "CommunityArea") {
                $validated = $request->validate([
                    'comm_latitude' => ['required'],
                    'comm_longitude' => ['required'],
                ], [
                    'comm_latitude.required' => 'Please enter latitude.',
                    'comm_longitude.required' => 'Please enter longitude.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $latitude = $request->comm_latitude;
                    $longitude = $request->comm_longitude;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "lat" => $latitude,
                            "long" => $longitude
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $community_details = json_decode($response, true);
                    if (isset($community_details['status']) && $community_details['status'] == 200) {
                        return view('kyc.single_search', compact('community_details'));
                    }
                    return view('kyc.single_search', compact('community_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $latitude = $request->comm_latitude;
                        $longitude = $request->comm_longitude;
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "lat" => $latitude,
                                "long" => $longitude
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $community_details = json_decode($response, true);
                        if (isset($community_details['status']) && $community_details['status'] == 200) {
                            return view('kyc.single_search', compact('community_details'));
                        }
                        return view('kyc.single_search', compact('community_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "Pincode") {
                $validated = $request->validate([
                    'from_pincode' => ['required'],
                    'to_pincode' => ['required'],
                ], [
                    'from_pincode.required' => 'Please enter pincode.',
                    'to_pincode.required' => 'Please enter pincode.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $frompincode = $request->from_pincode;
                    $topincode = $request->to_pincode;
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "from_pin" => $frompincode,
                            "to_pin" => $topincode,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $pincode_details = json_decode($response, true);
                    if (isset($pincode_details['statusCode']) && $pincode_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('pincode_details'));
                    }
                    return view('kyc.single_search', compact('pincode_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $frompincode = $request->from_pincode;
                        $topincode = $request->to_pincode;
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "from_pin" => $frompincode,
                                "to_pin" => $topincode,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $pincode_details = json_decode($response, true);
                        if (isset($pincode_details['statusCode']) && $pincode_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('pincode_details'));
                        }
                        return view('kyc.single_search', compact('pincode_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ImageScanner") {
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['img_file' => new \CURLFILE($_FILES['scimage_file']['tmp_name'], $_FILES['scimage_file']['type'], $_FILES['scimage_file']['name'])],
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $image_scanner_details = json_decode($response, true);
                    if (isset($image_scanner_details['statusCode']) && $image_scanner_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('image_scanner_details'));
                    }
                    return view('kyc.single_search', compact('image_scanner_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['img_file' => new \CURLFILE($_FILES['scimage_file']['tmp_name'], $_FILES['scimage_file']['type'], $_FILES['scimage_file']['name'])],
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $image_scanner_details = json_decode($response, true);
                        if (isset($image_scanner_details['statusCode']) && $image_scanner_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('image_scanner_details'));
                        }
                        return view('kyc.single_search', compact('image_scanner_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "FaceDetection") {
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'face_image' => new \CURLFILE($_FILES['fdimage_file']['tmp_name'], $_FILES['fdimage_file']['type'], $_FILES['fdimage_file']['name']),
                        ],
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $facematch_details = json_decode($response, true);
                    if (isset($facematch_details['statusCode']) && $facematch_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('facematch_details'));
                    }
                    return view('kyc.single_search', compact('facematch_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'face_image' => new \CURLFILE($_FILES['fdimage_file']['tmp_name'], $_FILES['fdimage_file']['type'], $_FILES['fdimage_file']['name']),
                            ],
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $facematch_details = json_decode($response, true);
                        if (isset($facematch_details['statusCode']) && $facematch_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('facematch_details'));
                        }
                        return view('kyc.single_search', compact('facematch_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "DetectedEmotion") {
                $validated = $request->validate([
                    'edimage_file' => ['required'],
                ], [
                    'edimage_file.required' => 'Please uplode image.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'image_file' => new \CURLFILE($_FILES['edimage_file']['tmp_name'], $_FILES['edimage_file']['type'], $_FILES['edimage_file']['name']),
                        ],
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $detection_emotion_details = json_decode($response, true);
                    if (isset($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('detection_emotion_details'));
                    }
                    return view('kyc.single_search', compact('detection_emotion_details'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'image_file' => new \CURLFILE($_FILES['edimage_file']['tmp_name'], $_FILES['edimage_file']['type'], $_FILES['edimage_file']['name']),
                            ],
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $detection_emotion_details = json_decode($response, true);
                        if (isset($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('detection_emotion_details'));
                        }
                        return view('kyc.single_search', compact('detection_emotion_details'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ExtractAadhar") {
                $validated = $request->validate([
                    'extaadharimage_file' => ['required'],
                ], [
                    'extaadharimage_file.required' => 'Please uplode image.'
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'aadharextracttext')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['extaadharimage_file']['tmp_name'], $_FILES['extaadharimage_file']['type'], $_FILES['extaadharimage_file']['name']),
                            'file_type' => 'extract_aadharcard_text'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $aadharcard_extract = json_decode($result, true);
                    if (isset($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 200) {
                        return view('kyc.single_search', compact('aadharcard_extract'));
                    }
                    return view('kyc.single_search', compact('aadharcard_extract'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['extaadharimage_file']['tmp_name'], $_FILES['extaadharimage_file']['type'], $_FILES['extaadharimage_file']['name']),
                                'file_type' => 'extract_aadharcard_text'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $aadharcard_extract = json_decode($result, true);
                        if (isset($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 200) {
                            return view('kyc.single_search', compact('aadharcard_extract'));
                        }
                        return view('kyc.single_search', compact('aadharcard_extract'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('aadharcard_extract', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ExtractDrivingLicense") {
                $validated = $request->validate([
                    'extdlimage_file' => ['required'],
                ], [
                    'extdlimage_file.required' => 'Please uplode image.'
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'licenseextracttext')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['extdlimage_file']['tmp_name'], $_FILES['extdlimage_file']['type'], $_FILES['extdlimage_file']['name']),
                            'file_type' => 'extract_drivinglicense_text'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $lincense_extract = json_decode($result, true);
                    if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 200) {

                        return view('kyc.single_search', compact('lincense_extract'));
                    }
                    return view('kyc.single_search', compact('lincense_extract'));

                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['extdlimage_file']['tmp_name'], $_FILES['extdlimage_file']['type'], $_FILES['extdlimage_file']['name']),
                                'file_type' => 'extract_drivinglicense_text'
                            ],
                            CURLOPT_HTTPHEADER => ['AccessToken:' . $accessToken],
                        ]);
                        $result = curl_exec($curl);
                        $lincense_extract = json_decode($result, true);
                        if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 200) {

                            return view('kyc.single_search', compact('lincense_extract'));
                        }

                        return view('kyc.single_search', compact('lincense_extract'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('lincense_extract', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ExtractPanCard") {
                $validated = $request->validate([
                    'extpanimage_file' => ['required'],
                ], [
                    'extpanimage_file.required' => 'Please uplode image.'
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'pancardextracttext')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['extpanimage_file']['tmp_name'], $_FILES['extpanimage_file']['type'], $_FILES['extpanimage_file']['name']),
                            'file_type' => 'extract_pancard_text'
                        ],
                        CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $extract_pancard_text = json_decode($response, true);
                    if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code'] == 200) {
                        return view('kyc.single_search', compact('extract_pancard_text'));
                    }
                    return view('kyc.single_search', compact('extract_pancard_text'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['extpanimage_file']['tmp_name'], $_FILES['extpanimage_file']['type'], $_FILES['extpanimage_file']['name']),
                                'file_type' => 'extract_pancard_text'
                            ],
                            CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $extract_pancard_text = json_decode($response, true);
                        if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code'] == 200) {
                            return view('kyc.single_search', compact('extract_pancard_text'));
                        }
                        return view('kyc.single_search', compact('extract_pancard_text'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('extract_pancard_text', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "ExtractVoterId") {
                $validated = $request->validate([
                    'extvoterimage_file' => ['required'],
                ], [
                    'extvoterimage_file.required' => 'Please uplode image.'
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'voterextracttext')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'file' => new \CURLFILE($_FILES['extvoterimage_file']['tmp_name'], $_FILES['extvoterimage_file']['type'], $_FILES['extvoterimage_file']['name']),
                            'file_type' => 'extract_voterid_text'
                        ],
                        CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $extract_voterid = json_decode($response, true);

                    if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] == 200) {
                        return view('kyc.single_search', compact('extract_voterid'));
                    }
                    return view('kyc.single_search', compact('extract_voterid'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'file' => new \CURLFILE($_FILES['extvoterimage_file']['tmp_name'], $_FILES['extvoterimage_file']['type'], $_FILES['extvoterimage_file']['name']),
                                'file_type' => 'extract_voterid_text'
                            ],
                            CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $extract_voterid = json_decode($response, true);
                        if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] == 200) {
                            return view('kyc.single_search', compact('extract_voterid'));
                        }
                        return view('kyc.single_search', compact('extract_voterid'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "FaceMatch1") {
                $validated = $request->validate([
                    'knownimage_file' => ['required'],
                    'faceimage_file' => ['required'],
                ], [
                    'knownimage_file.required' => 'Please uplode image.',
                    'faceimage_file.required' => 'Please uplode image.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => [
                            'known_face' => new \CURLFILE($_FILES['knownimage_file']['tmp_name'], $_FILES['knownimage_file']['type'], $_FILES['knownimage_file']['name']),
                            'image1' => new \CURLFILE($_FILES['faceimage_file']['tmp_name'], $_FILES['faceimage_file']['type'], $_FILES['faceimage_file']['name'])
                        ],
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $facematch_details1 = json_decode($response, true);

                    if (isset($facematch_details1['statusCode']) && $facematch_details1['statusCode'] == 200) {
                        return view('kyc.single_search', compact('facematch_details1'));
                    }
                    return view('kyc.single_search', compact('facematch_details1'));
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => [
                                'known_face' => new \CURLFILE($_FILES['knownimage_file']['tmp_name'], $_FILES['knownimage_file']['type'], $_FILES['knownimage_file']['name']),
                                'image1' => new \CURLFILE($_FILES['faceimage_file']['tmp_name'], $_FILES['faceimage_file']['type'], $_FILES['faceimage_file']['name'])
                            ],
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $facematch_details1 = json_decode($response, true);
                        if (isset($facematch_details1['statusCode']) && $facematch_details1['statusCode'] == 200) {
                            return view('kyc.single_search', compact('facematch_details1'));
                        }
                        return view('kyc.single_search', compact('facematch_details1'));
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankAnalyserv1") {
                $validated = $request->validate([
                    'ananstatementpdffile' => ['required'],
                    'ananbank_name' => ['required'],
                ], [
                    'ananstatementpdffile.required' => 'Please uplode statement file.',
                    'ananbank_name.required' => 'Please enter bank name.',
                ]);
                $accessToken = Auth::user()->access_token;
                $headers = [
                    'AccessToken' => $accessToken,
                ];
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_anlyser')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            "bankStemtpdf" => new \CURLFILE($_FILES['ananstatementpdffile']['tmp_name'], $_FILES['ananstatementpdffile']['type'], $_FILES['ananstatementpdffile']['name']),
                            "Password1" => $request->ananpassword,
                            "bnk_Name" => $request->ananbank_name,
                            'account_Type' => $request->ananaccount_type,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'AccessToken:' . $accessToken,
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $bank_statement_analyser = json_decode($response, true);
                    if (isset($bank_statement_analyser['statusCode']) && $bank_statement_analyser['statusCode'] == 200) {
                        $statmendata = $bank_statement_analyser['response'];
                        $statusCode = $bank_statement_analyser['statusCode'];
                        $atm_withdrawl = $bank_statement_analyser['response']['atm_withdrawls'];
                        $averageMonthlyBalance = $bank_statement_analyser['response']['averageMonthlyBalance'];
                        $averageQuarterlyBalance = $bank_statement_analyser['response']['averageQuarterlyBalance'];
                        $expenses = $bank_statement_analyser['response']['expenses'];
                        $high_value_transactions = $bank_statement_analyser['response']['high_value_transactions'];
                        $incomes = $bank_statement_analyser['response']['incomes'];
                        $minimum_balances = $bank_statement_analyser['response']['minimum_balances'];
                        $money_received_transactions = $bank_statement_analyser['response']['money_received_transactions'];
                        $customPaper = [0, 0, 967.0, 967.8];
                        $pdf = PDF::loadView('kyc.analyserpdf', compact('atm_withdrawl', 'averageMonthlyBalance', 'averageQuarterlyBalance', 'expenses', 'high_value_transactions', 'incomes', 'minimum_balances', 'money_received_transactions'))->setPaper($customPaper, 'A4');
                        return $pdf->stream('invoice.pdf');

                    } else {
                        return view('kyc.single_search', compact('bank_statement_analyser'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $accessToken = Auth::user()->access_token;
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                "bankStemtpdf" => new \CURLFILE($_FILES['ananstatementpdffile']['tmp_name'], $_FILES['ananstatementpdffile']['type'], $_FILES['ananstatementpdffile']['name']),
                                "Password1" => $request->ananpassword,
                                "bnk_Name" => $request->ananbank_name,
                                'account_Type' => $request->ananaccount_type,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'AccessToken:' . $accessToken,
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $bank_statement_analyser = json_decode($response, true);
                        if (isset($bank_statement_analyser['statusCode']) && $bank_statement_analyser['statusCode'] == 200) {
                            $statmendata = $bank_statement_analyser['response'];
                            $statusCode = $bank_statement_analyser['statusCode'];
                            $atm_withdrawl = $bank_statement_analyser['response']['atm_withdrawls'];
                            $averageMonthlyBalance = $bank_statement_analyser['response']['averageMonthlyBalance'];
                            $averageQuarterlyBalance = $bank_statement_analyser['response']['averageQuarterlyBalance'];
                            $expenses = $bank_statement_analyser['response']['expenses'];
                            $high_value_transactions = $bank_statement_analyser['response']['high_value_transactions'];
                            $incomes = $bank_statement_analyser['response']['incomes'];
                            $minimum_balances = $bank_statement_analyser['response']['minimum_balances'];
                            $money_received_transactions = $bank_statement_analyser['response']['money_received_transactions'];
                            $customPaper = [0, 0, 967.0, 967.8];
                            $pdf = PDF::loadView('kyc.analyserpdf', compact('atm_withdrawl', 'averageMonthlyBalance', 'averageQuarterlyBalance', 'expenses', 'high_value_transactions', 'incomes', 'minimum_balances', 'money_received_transactions'))->setPaper($customPaper, 'A4');
                            return $pdf->stream('invoice.pdf');

                        } else {
                            return view('kyc.single_search', compact('bank_statement_analyser'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "BankStatementReaderv1") {
                $validated = $request->validate([
                    'bankstatementpdffile' => ['required'],
                    'statementbank_name' => ['required'],
                ], [
                    'bankstatementpdffile.required' => 'Please uplode statement file.',
                    'statementbank_name.required' => 'Please enter bank name.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {
                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
                        if ($apiamster)
                            $api_id = $apiamster->id;
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "bankStmtpdf" => new \CURLFILE($_FILES['bankstatementpdffile']['tmp_name'], $_FILES['bankstatementpdffile']['type'], $_FILES['bankstatementpdffile']['name']),
                            "password1" => $request->statementpassword,
                            "bnk_name" => $request->statementbank_name,
                            'Account_Type' => $request->statementaccount_type,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: " . $accessToken,
                        ),
                    ));
                    $result = curl_exec($curl1);
                    $bank_statement_reader = json_decode($result, true);
                    if ($bank_statement_reader['statusCode'] == '200') {
                        $statmendata = $bank_statement_reader['response']['transactions'];
                        $pdf = PDF::loadView('kyc.statementpdf', compact('statmendata'))->setPaper('A4');
                        return $pdf->stream('invoice.pdf');
                    } else {
                        return view('kyc.single_search', compact('bank_statement_reader'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => "http://regtechapi.in/api/seachv4",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => array(
                                "bankStmtpdf" => new \CURLFILE($_FILES['bankstatementpdffile']['tmp_name'], $_FILES['bankstatementpdffile']['type'], $_FILES['bankstatementpdffile']['name']),
                                "password1" => $request->statementpassword,
                                "bnk_name" => $request->statementbank_name,
                                'Account_Type' => $request->statementaccount_type,
                            ),
                            CURLOPT_HTTPHEADER => array(
                                "AccessToken: " . $accessToken,
                            ),
                        ));
                        $result = curl_exec($curl1);
                        $bank_statement_reader = json_decode($result, true);

                        if ($bank_statement_reader['statusCode'] == '200') {
                            $statmendata = $bank_statement_reader['response']['transactions'];
                            $pdf = PDF::loadView('kyc.statementpdf', compact('statmendata'))->setPaper('A4');
                            return $pdf->stream('invoice.pdf');
                        } else {
                            return view('kyc.single_search', compact('bank_statement_reader'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('hit_limits_exceeded'));
                    }
                }
            } elseif (!empty($request->apies) && $request->get('apies') == "PredictPPLAPI") {

                $validated = $request->validate([
                    'predictppl_csv' => ['required']
                ], [
                    'predictppl_csv.required' => 'Please uplode file.',
                ]);
                if (Auth::user()->scheme_type != 'demo') {

                    if (Auth::user()->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'predictppl')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['csv_file' => new \CURLFILE($_FILES['predictppl_csv']['tmp_name'], $_FILES['predictppl_csv']['type'], $_FILES['predictppl_csv']['name'])],
                        CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $predictppl_details = json_decode($response, true);
                    if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 200) {
                        return view('kyc.single_search', compact('predictppl_details'));
                    } elseif (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 102) {
                        return view('kyc.single_search', compact('predictppl_details'));
                    } elseif (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 500) {
                        return view('kyc.single_search', compact('predictppl_details'));
                    } else {
                        return view('kyc.single_search', compact('predictppl_details'));
                    }
                } else {
                    $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                    $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                    if ($hit_count_remaining > 0) {
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $accessToken = Auth::user()->access_token;
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://regtechapi.in/api/seachv4',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['csv_file' => new \CURLFILE($_FILES['predictppl_csv']['tmp_name'], $_FILES['predictppl_csv']['type'], $_FILES['predictppl_csv']['name'])],
                            CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $predictppl_details = json_decode($response, true);

                        if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 200) {
                            return view('kyc.single_search', compact('predictppl_details'));
                        } elseif (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 102) {
                            return view('kyc.single_search', compact('predictppl_details'));
                        } elseif (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 500) {
                            return view('kyc.single_search', compact('predictppl_details'));
                        } else {

                            return view('kyc.single_search', compact('predictppl_details'));
                        }
                    } else {
                        $hit_limits_exceeded = 1;
                        return view('kyc.single_search', compact('predictppl_details', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                    }
                }
            }
            return view('kyc.single_search', compact('predictppl_details', 'bank_statement_analyser', 'bank_statement_reader', 'facematch_details1', 'extract_voterid', 'extract_pancard_text', 'extract_pancard_text', 'lincense_extract', 'aadharcard_extract', 'image_scanner_details', 'pincode_details', 'community_details', 'land_details', 'companyProductDetails', 'gstin_details', 'bypancard_details', 'bank_verification_ifsc', 'pancard_search_lite', 'pancard_search', 'company_details', 'company_search', 'uan_details', 'epfo_details', 'fssi_validation', 'shopestablishment', 'electricity', 'licenseUpload', 'license_upload_validation', 'bank_verification', 'bank_statement2', 'rc_challan', 'fast_tag_information', 'rc_validationTest', 'rc_validationLite', 'corporate_cin1', 'passport_verify1', 'passportUpload', 'passport_create_client', 'statusCodepanUpload', 'pancarduploade', 'pancardupload2', 'aadhaar_masking1', 'voteruplode', 'voter_detailed_info_upload', 'aadhaar1', 'aadhaarOCR1', 'statusCodeAadhaarUpload', 'face_match', 'bankstatement_analyser', 'passportverify', 'pancardnew_details', 'pancardInfoDetails', 'pancardVerification', 'check_verify_email_status', 'corporate_gstin', 'telecom', 'searchkyc', 'verify_email', 'equifax', 'score_api_success_message', 'dedupe_details', 'rc_validation', 'udyamcardv2', 'pan_cards', 'BasicGstinVerification', 'pantogstDetails', 'searchkyclite', 'udyamaadhar', 'udyamcard', 'bankstatment', 'voter_validation', 'aadhaar_validation', 'aadhaar_otp_genrate', 'bhunakasha', 'license_validation', 'verify_address', 'get_place', 'create_geofence', 'get_coordinate', 'auto_complate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }

    }
    public function aadhaar_otp_submit_search(Request $request)
    {
        $statusCode = null;
        $aadhaar_otp_submit = null;
        $hit_limits_exceeded = 0;
        if ($request->isMethod('GET')) {
            $apimaster = ApiMaster::where('api_slug', 'aadharotpsubmit')->first();
            return view('kyc.single_api_response.aadhaar_otp_submit', compact('aadhaar_otp_submit', 'statusCode', 'hit_limits_exceeded'));
        }
        if ($request->isMethod('POST')) {
            $client = new Client();
            // $headers = [
            //     'Authorization' => $this->token,
            //     'Accept'        => 'application/json',
            // ];

            // $body =  [
            //     'client_id' => $request->client_id,
            //     'otp' => $request->otp
            // ];

            $accessToken = Auth::user()->access_token;

            $headers = [
                'AccessToken' => $accessToken,
            ];
            $body = [
                'client_id' => $request->client_id,
                'otp_aadhar' => $request->otp,
            ];
            if (Auth::user()->scheme_type != 'demo') {
                if (Auth::user()->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'aadharotpsubmit')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                try {
                    $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_validation = json_decode($res->getBody(), true);
                    if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == 200) {

                        return view('kyc.single_api_response.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.single_api_response.aadhaar_otp_submit', compact('statusCode', 'errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    try {
                        $res = $client->post('http://regtechapi.in/api/seachv4', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_validation = json_decode($res->getBody(), true);
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();

                        if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == 200) {
                            return view('kyc.single_api_response.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));

                        }
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_api_response.aadhaar_otp_submit', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.single_api_response.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
                }
            }
        }
        // dd($aadhaar_validation);
        return view('kyc.single_api_response.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode', 'hit_limits_exceeded'));
    }
    public function telecom_submit_otp_search(Request $request)
    {
        $statusCode = null;
        $telecom_submit_otp = null;
        $hit_limits_exceeded = null;

        if ($request->isMethod('GET')) {
            return view('kyc.single_api_response.telecom_submit_otp', compact('telecom_submit_otp', 'statusCode', 'hit_limits_exceeded'));
        }
        if ($request->isMethod('POST')) {
            $accessToken = Auth::user()->access_token;

            $headers = [
                'AccessToken' => $accessToken,
            ];
            $json = [
                'Client_id' => $request->client_id,
                'Otp' => $request->otp
            ];
            $client = new Client();
            if (Auth::user()->scheme_type != 'demo') {
                if (Auth::user()->role_id == 1) {
                    $api_master = ApiMaster::where('api_slug', 'telecom_submit_otp')->first();
                    if ($api_master)
                        $api_id = $api_master->id;

                }
                try {
                    $response = $client->post('http://regtechapi.in/api/seachv4', [
                        'headers' => $headers,
                        'json' => $json
                    ]);

                    $telecom_submit_otp = json_decode($response->getBody(), true);
                    $statusCode = 200;

                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.single_api_response.telecom_submit_otp', compact('statusCode', 'errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    try {
                        $response = $client->post('http://regtechapi.in/api/seachv4', [
                            'headers' => $headers,
                            'json' => $json
                        ]);

                        $telecom_submit_otp = json_decode($response->getBody(), true);
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.single_api_response.telecom_submit_otp', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.single_api_response.telecom_submit_otp', compact('telecom_submit_otp', 'statusCode', 'hit_limits_exceeded'));
                }
            }
            return view('kyc.single_api_response.telecom_submit_otp', compact('telecom_submit_otp', 'statusCode', 'hit_limits_exceeded'));
        }
    }

    public function searchApiDoc()
    {
        return view('kyc.single_search_api');
    }
}
