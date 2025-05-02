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
use App\Models\HitCountMaster;
use App\Models\SchemeTypeMaster;
use App\Models\User;
use App\Models\Crif;
use App\Models\OtpCheck;
use Redirect;
use File;
use DOMDocument;
use App\Transaction;
use Session;
use DB;
use Illuminate\Support\Carbon;

class CrifController1 extends Controller
{
    private $crif_url = "https://loantap.in/affiliate/apiv1-1/docboyz/crif";

    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MjUzOTIyMTYsImp0aSI6IjhkOWZmNTFiLTJiYmItNDc4My1iYmI5LTg5ZWMzNGY3MDNmZiIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsImZyZXNoIjpmYWxzZSwiaWF0IjoxNTkzODU2MjE2LCJuYmYiOjE1OTM4NTYyMTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19LCJ0eXBlIjoiYWNjZXNzIn0.f0Ea5UmL_DQsSCBF6sWJzU-n7NPT9TL_IkKFY_a-3KQ';

    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

    public function Criff(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();

        $statusCode = null;
        $reportgenerated = null;
        $hit_limits_exceeded = 0;
        $html_report = "";

        $body = array();
        $headers = [
            'X-API-KEY' => 'MEtOdRx3fn4o9zeVAXByVQoKpXn66c3fli4rcCkLy9',
            'DEV-ACCESS-KEY' => 'CxFJiV2eqm99KpQqzOJMLxVW2eBZwAiMYaezH57P'
        ];

        // Insert request data into database
        DB::table('equifax_pdf_request')->insert([
            'firstName' => $request->fullname,
            'lastName' => null,
            'contactNo' => $request->mno,
            'idValue' => $request->pan,
            'created_at' => now()
        ]);

        $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();

        $uname = $user->name;
        $arr = explode(' ', trim($uname));
        $userInitials = '';
        foreach ($arr as $array) {
            $userInitials .= substr($array, 0, 1);
        }

        $recordId = sprintf("%04d", $record_id->id);
        $CustRefField = "DB-" . strtoupper($userInitials) . now()->format('y') . now()->format('m') . $recordId;

        $body = [
            'gender' => "male",
            'dob' => $request->dob,
            'pan_card' => $request->pan,
            'mobile_number' => $request->mno,
            'full_name' => $request->fullname,
            "home" => [
                "city" => $request->city,
                "zipcode" => $request->zipcode,
                "address" => [
                    "line2" => $request->addrline2,
                    "line1" => $request->addrline1
                ],
            ],
            "allowed_for_awesomeui" => "yes",
            "chm_ref" => $CustRefField
        ];
        $json = json_encode($body);
        $client = new Client();

        if ($user->scheme_type != 'demo') {
            
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'creditscorereport')->first();

                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            try {
                $response = $client->post("https://loantap.in/affiliate/apiv1-1/docboyz/crif", [
                    'headers' => $headers,
                    'json' => $body
                ]);
                $reportgenerated = json_decode($response->getBody(), true);
                return $reportgenerated;
                $html_report = base64_decode($reportgenerated['data']['file']['html_report'] ?? null);
                // return 'hellox';
                $Crif = new Crif();
                $Crif->user_id = $user->id;
                $Crif->full_name = $reportgenerated['data']['request_meta']['full_name'] ?? null;
                $Crif->gender = $reportgenerated['data']['request_meta']['gender'] ?? null;
                $Crif->pan_card_no = $reportgenerated['data']['request_meta']['pan_card'] ?? null;
                $Crif->mob_no = $reportgenerated['data']['request_meta']['mobile_number'] ?? null;
                $Crif->crif_report_id = $reportgenerated['data']['crif_report_id'] ?? null;
                $Crif->crif_score = $reportgenerated['data']["crif_score"] ?? null;
                $Crif->crif_estimated_data = $reportgenerated['data']["crif_estimated_date"] ?? null;
                $Crif->response_xml = $reportgenerated['data']['file']['response_xml'] ?? null;
                $Crif->html_report = $reportgenerated['data']['file']['html_report'] ?? null;
                $Crif->save();

                if ($user->role_id == 1 && $apiamster) {
                    $updateHitCount = SchemeMaster::where('user_id', $user->id)->where('api_id', $api_id)->first();

                    $addHitCount = new HitCountMaster;
                    $addHitCount->user_id = $user->id;
                    $addHitCount->api_id = $api_id;
                    $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    $addHitCount->hit_year_month = now()->format('Y-m');
                    $addHitCount->hit_count = 1;
                    $addHitCount->save();
                }

                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $response = $client->post($this->crif_url, [
                        'headers' => $headers,
                        'json' => $body
                    ]);

                    $reportgenerated = json_decode($response->getBody(), true);

                    $user->scheme_hit_count += 1;
                    $user->save();

                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json([
                    'reportgenerated' => $reportgenerated,
                    'statusCode' => $statusCode,
                    'hit_limits_exceeded' => $hit_limits_exceeded
                ]);
            }
            $response = $client->post("https://loantap.in/affiliate/apiv1-1/docboyz/crif", [
                'headers' => $headers,
                'json' => $body
            ]);
            $reportgenerated = json_decode($response->getBody(), true);
        }

        return response()->json([
            'reportgenerated' => $reportgenerated,
            'statusCode' => $statusCode,
            'hit_limits_exceeded' => $hit_limits_exceeded,
            'CustRefField' => $CustRefField,
            'html_report' => $html_report
        ]);
    }


    public function sendOTP(Request $request)
    {
        // dd('asasa');
        $otp = rand(1111, 9999);
        Session::put('otp_code', $otp);
        // $authKey = "285719AiPxI75X5da6af0c";
        $authKey = "368753AXggrthFX61713441P1";
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "DocBoy";

        $message = urlencode(
            "Dear%20Customer,2323%20OTP%20for%20Login%20Thank%20You%20Team%20DocBoyz"
        );
        //Define route 
        $number = $request->phone;
        $route = "4";
        //Prepare you post parameters
        $prt = '91';
        $newno = $prt . $number;
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $newno,
            'message' => $message,
            'sender' => $senderId,
            'otp' => $otp,
            'route' => $route
        );
        // $postData = array(
        //     'authkey' => $authKey,
        //     'mobiles' => $request->phone,
        //     'message' => $message,
        //     'sender' => $senderId,
        //     'route' => $route
        // );
        //API URL
        $url = "https://api.msg91.com/api/sendotp.php?authkey=368753AXggrthFX61713441P1&mobiles=$newno&message=Dear%20Customer,$otp%20OTP%20for%20Login%20Thank%20You%20Team%20DocBoyz&sender=DocBoy&otp=$otp&DLT_TE_ID=1307163462070500440";
        // $url="http://www.sms.rocketm.in/api/sendhttp.php";
        // init the resource
        // $ch = curl_init();
        // curl_setopt_array($ch, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_POST => true,
        //     CURLOPT_POSTFIELDS => $postData,
        //     CURLOPT_FOLLOWLOCATION => true
        // ));
        // //Ignore SSL certificate verification
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // //get response
        // $response = curl_exec($ch);
        // $err = curl_error($ch);
        // curl_close($ch);
        // if ($err) {
        //     return response()->json(['error'=>'Something went wrong. Please try again.']);
        // } else {
        //     return response()->json(['success'=>'OTP sent successfully']);
        // }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/JSON"
            ),
        ));

        //Ignore SSL certificate verification
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        // if ($err) {
        //     return response()->json(['error' => 'Something went wrong. Please try again.']);
        // } else {
        //     $otpCheck = OtpCheck::create([
        //         'otp' => $otp,
        //         'mobile_number' => $number,
        //     ]);
        //     return response()->json(['success' => 'OTP sent successfully']);
        // }
        // return "hello";
        if ($err) {
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        } else {
            // Using DB::table()->insert() to insert data
            $inserted = DB::table('otp_check')->insert([
                'otp' => $otp,
                'mobile_number' => $number
            ]);
        
            if ($inserted) {
                return response()->json(['success' => 'OTP sent successfully']);
            } else {
                return response()->json(['error' => 'Failed to send OTP. Please try again.']);
            }
        }
    }


    // Verify OTP
    // public function verifyotp(Request $request)
    // {


    //     if (Session::has('otp_code')) {
    //         $otp_code = Session::get('otp_code');
    //         if ($request->otp_code == $otp_code) {
    //             return response()->json(['success' => 'OTP verified successfully']);
    //         } else {
    //             return response()->json(['fail' => 'OTP is not match']);
    //         }
    //     }
    //     if (Session::has('otp_code1')) {

    //         $otp_code1 = Session::get('otp_code1');
    //         if ($request->otp_code1 == $otp_code1) {
    //             return response()->json(['success' => 'OTP verified successfully']);
    //         } else {
    //             return response()->json(['fail' => 'OTP is not match']);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Something went wrong. Please try again.']);
    //     }
    // }


    public function verifyotp(Request $request)
    {
        // $otpCode = OtpCheck::latest()->first();
        $otpCode = OtpCheck::where('mobile_number', $request->phone)
                       ->latest()
                       ->first();

        // Check if an OTP entry was found
        if (!$otpCode) {
            return response()->json(['error' => 'No OTP found for this mobile number.'], 404);
        }


        if ($request->otp_code == $otpCode->otp) {
            return response()->json(['success' => 'OTP verified successfully']);
        } else {
            return response()->json(['fail' => 'OTP is not match']);
        }
    }
}
