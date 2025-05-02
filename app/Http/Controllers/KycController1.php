<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Exception;
use Auth;
use App\Models\ApiMaster;
use App\Models\SchemeMaster;
use App\Models\UserSchemeMaster;
use App\Models\HitCountMaster;
use App\Models\SchemeTypeMaster;
use App\Models\User;
use App\Models\Rcfull;
use App\Models\Crif;
use Illuminate\Support\ViewErrorBag;
use Redirect;
use File;
use Barryvdh\DomPDF\Facade\Pdf;
use DOMDocument;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class KycController1 extends Controller
{
    public function aadharValidation(Request $request){
        $token = $request->header('AccessToken');
        $user = User::where('access_token', $token)->first();
        // return $user;
        $statusCode = null;
        $aadhaar_validation = null;
        $hit_limits_exceeded = 0;
        $api_id = '';

        $client = new Client();
            $accessToken = $user->access_token;

            $headers = [
                'AccessToken' => $accessToken,
            ];
            $body = [
                'aadhaar_number' => $request->aadhaar_number
            ];
            if ($user->scheme_type != 'demo') {
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                    if ($apiamster)
                        $api_id = $apiamster->id;
                }


                try {
                    $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                    //$this->base_url.'/aadhaar-validation/aadhaar-validation'
                    $aadhaar_validation = json_decode($res->getBody(), true);
                    if (isset($aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'])) {
                        $statusCode = $aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'];
                    }

                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return response()->json([$statusCode, $errorMessage]);
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    try {
                        $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_validation = json_decode($res->getBody(), true);

                        $user = User::where('id', $user->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return response()->json([$statusCode, $errorMessage]);
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return response()->json([$aadhaar_validation, $statusCode, $hit_limits_exceeded]);
                }
            }
            return response()->json([$aadhaar_validation, $statusCode, $hit_limits_exceeded]);
    }


    public function aadhaarUpload(Request $request)
    {
        $statusCode = null;
        $aadhaar = null;
        $hit_limits_exceeded = 0;
        $aadhaarOCR = null;
            //checking if file exists or not
            if (!$request->hasFile('file')) {
                return json_encode(['message' => "file not found"], true);
            }


            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                // CURLOPT_URL => "https://kyc-api.flowboard.in/api/v1/aadhaar/upload/eaadhaar",
                CURLOPT_URL => "http://regtechapi.in/api/aadhaar_upload", //"https://sandbox.flowboard.in/api/v1/ocr/aadhaar",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']),
                    // "base64" => "",
                    // "yob" => "",
                    // "full_name" => ""
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $this->$request->has('AccessToken'),
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $aadhaarOCR = json_decode($result, true);
            //dd($aadhaarOCR);
            $statusCode = isset($aadhaarOCR['status_code']) ? $aadhaarOCR['status_code'] : null;
            $aadhaar_number = null;
            if ($aadhaarOCR['data']['ocr_fields']) {
                $aadhaar_number = $aadhaarOCR['data']['ocr_fields'][0]['aadhaar_number']['value'];
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
                    $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                    $aadhaar = json_decode($res->getBody(), true);
                    //dd($aadhaar);
                    $statusCode = 200;

                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return response()->json([$statusCode, $errorMessage]);
                }
            return response()->json([$aadhaar, $aadhaarOCR, $statusCode, $hit_limits_exceeded]);
        }
    }
}
