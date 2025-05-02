<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Exception;
use App\User;
use App\OTP;
use Carbon\Carbon;
use Hash;
use App\ApiMaster;
use App\SchemeMaster;
use App\UserSchemeMaster;
use Illuminate\Support\Facades\Response;
use App\HitCountMaster;
use App\Rcfull;
use Auth;
use App\consumer;
use App\businesskyc;
use App\businesstype;
use App\business;
use App\requireddetails;
use App\rulesdefined;
use App\termscondition;
use App\congratulations;
use App\agreementpolicy;
use App\bankdetails;
use App\link;
use Pdf;
use App\Transaction;
use DB;
use Session;
use Async;

class SearchApiController extends Controller
{
    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    // private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $base_urln = 'https://api.signzy.app/api/v3';
    // private $signzytoken = 'quaX7XBUjg4S8ITGJeWrhbQ86YakeNOr';
    private $signzytoken = 'nSMWQHptp8JAaROQjhtUKPnrP3mviY6R';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

    //Equifax
    // private $equifax_url = "https://eportuat.equifax.co.in/cir360Report/cir360Report";
        private $equifax_url = "https://ists.equifax.co.in/cir360service/cir360report";
    // private $equifax_url = "https://bo6dqokjja.execute-api.ap-south-1.amazonaws.com/equifax/score";

    // private $equifax_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2NjAxMTEyMTN9.d6TecpM6LWgp91bjAjYQvUCdtjSxTX4RDEnY_Qc3lgc";
    //Crif
    private $crif_url = "https://loantap.in/affiliate/apiv1-1/docboyz/crif";

    private $smartship_url = 'http://api.smartship.in'; //'http://oauth.smartship.in';

    private $api_club = 'https://api.apiclub.in/api';
    private $api_clubli = 'https://api.apiclub.in/uat/v1';

    private $api_club_key = '2487be27f4d20bc1d366cb38f098eba7';

    private $secretKey = 'pI76u95BabjkIFg6DNNRole7gZn71ljPk7W5WIHzApjlObIMywuq8pZGa30HXm5wR';

    private $equifaxsecretKey = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwiaWF0IjoxNjkzMzEyNTg2OTc4fQ.mMgl0deNRbkCXT0LnE8t7hRbTkwoK9TbnCrAS-TtjR4';

    private $clientId = 'ef41c6d7089614d1838c68efc81a8493:dc983c1bfbc4390f4952bd44ed0ae690';

    private $ckyctoken = 'gG9WM8pp2TDZ7DvnNNpqSnNXY7tSntiW';

    private $site_url = 'http://regtechapi.in';

    private $nsdlToken = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwibmFtZSI6IkFTSE9LIEtVTUFSIiwiaWF0IjoxNjY2MjM5MDIyfQ.ZuHUPDZhHtnkDHUrKwuwOuUYBqj4Kp0SRnJqiFWHVfs';
    public function getAccessToken(Request $request) {
        $statusCode = null;
        $access_token = null;

        if(empty($request->email))
            return response()->json(array(['message'=>'Email id is required','statusCode'=>'404']));

        if(empty($request->password))
            return response()->json(array(['message'=>'Password is required','statusCode'=>'404']));

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$request->email)->first();
        if (!$user)
            return response()->json(array(['message'=>'Email ID not associated with us','statusCode'=>'403']));

        if (!Hash::check($password, $user->password)) {
            return response()->json(array(['message'=>'Wrong Credentials','statusCode'=>'401']));
        }
        

        return response()->json(array(['access_token'=>$user->access_token,'statusCode'=>'200']));
    }
    public function verifyAccessToken($access_token) {
        $user = User::where('access_token',$access_token)->count();
        if($user>0)
            return true;
        else
            return false;
    }
    public function saveHitCount($user_id, $api_id, $remark, $statusCode) {
        $cnt200 = 0;
        $cnt400 = 0;
        $cnt101 = 0;
        $payableHits = 0;
        $scheme_price = 0;
        $total_amount = 0;
        $updateHitCount = UserSchemeMaster::where('user_id',$user_id)->where('api_id',$api_id)->orderBy('id', 'desc')->first();
        $payment_slab = explode(',', $updateHitCount->payment_slab);
        $scheme_prices = explode(',', $updateHitCount->scheme_price);
        // $transactions = Transaction::where('user_id', $user_id)->where('api_id',$api_id)->where('hit_year_month', date('Y-m'))->get();
        $transactions = Transaction::where('user_id', $user_id)->where('api_id',$api_id)->where('hit_year_month', date('Y-m'))->count();
        if($transactions){
            // for($i=0; $i<count($transactions);$i++){
            //     if($transactions[$i]['status_code'] == 102){
            //         $cnt400++;
            //     }else if($transactions[$i]['status_code'] == 200){
            //         $cnt200++;
            //     }else if($transactions[$i]['status_code'] == 101){
            //         $cnt101++;
            //     }
            // }
            // $payableHits = $cnt200 + $cnt400 + $cnt101; 
            $payableHits = $transactions; 

            for($i=0; $i<count($payment_slab); $i++){
                if($i == (count($payment_slab) - 1)){
                    if($payableHits <= $payment_slab[$i]){
                        $scheme_price = $scheme_prices[$i];
                        $total_amount = $payableHits * $scheme_prices[$i];
                    }else{
                        $scheme_price = $scheme_prices[$i];
                        $total_amount = $payableHits * $scheme_prices[$i];
                    }
                    break;
                }else{
                    if($payableHits <= $payment_slab[$i]){
                        $scheme_price = $scheme_prices[$i];
                        $total_amount = $payableHits * $scheme_prices[$i];
                        break;
                    }
                }
            }
        }else{
            $scheme_price = $scheme_prices[0];
            $total_amount = $scheme_prices[0];
        }
        
        $updateHitCount->update([
            'total_transaction_amount_per_api' => $total_amount
        ]);

        $addHitCount = new HitCountMaster;
        $addHitCount->user_id = $user_id;
        $addHitCount->api_id = $api_id;
        $addHitCount->scheme_price = $scheme_price;
        $addHitCount->hit_year_month = date('Y-m');
        $addHitCount->hit_count = 1;
        $addHitCount->save();
        $this->update_wallet_balance($user_id,$scheme_price);
        $this->update_transaction($user_id, $api_id, $scheme_price, $remark, $statusCode);
    }
    public function update_wallet_balance($user_id,$amount) 
    {    
        $userwallet = User::where('id',$user_id)->first();
        $userwallet->wallet_amount = $userwallet->wallet_amount - $amount;
        $userwallet->save();
    }
    public function transaction_id() 
    { 
        $str_result = '1234567890'; 
        $transaction_gen = substr(str_shuffle($str_result), 0, 12);
        
        $transaction = Transaction::where('transaction_id', $transaction_gen)->first();  
        if($transaction){
          $transaction_gen = substr(str_shuffle($str_result), 0, 12);
        }

        return $transaction_gen;
    }
    public function update_transaction($user_id,$api_id,$amount,$remark, $statusCode)
    {
        $user = User::where('id',$user_id)->first();
        $transaction = new Transaction;
        $transaction->transaction_id = $this->transaction_id();
        $transaction->user_id  = $user_id;
        $transaction->api_id  = $api_id; //work
        $transaction->type_creditdebit = 'Debit';
        $transaction->hit_year_month = date('Y-m');
        $transaction->scheme_price  = $amount;  //work
        if($statusCode == 200){
            $transaction->status = 'Success';
        }else{
            $transaction->status = 'Failed';
        }
        $transaction->status_code = $statusCode;
        $transaction->amount = $amount;
        $transaction->remark = $remark;
        if($statusCode != 500){
            $transaction->updated_balance = $user->wallet_amount - $amount;
        }else{
            $transaction->updated_balance = $user->wallet_amount;
        }
        $transaction->save();
    }
    public function allSearchApi(Request $request)
    {
        //ckycSearch PanNumber API
        if ($request->has('pano') && empty($request->dob) && empty($request->rc_number)) {
            $statusCode = null;
            $pancard = null;
            $api_id = null;
            if (empty($request->pano)) {
               return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
            }
            if (empty($request->date_of_birth)) {
                return response()->json([['message' => 'Date of birth is required', 'statusCode' => '404']]);
            }
    
            $validator = Validator::make($request->all(), [
                'date_of_birth' => ['required', 'date_format:Y-m-d'],
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'statusCode' => '404']);
            }
    
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
    
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
           
            $panno = $request->pano;
            $dob = $request->date_of_birth;
            $groupId = rand(100,10000000000);
            $checkId = rand(100,10000000000);
            $client = new Client();
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if($user->role_id == 0){
                 $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
            }
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $headers = [
                        'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
                    ];
                    $body = [
                        'panNumber' => $request->pano,
                        'groupId'=>$groupId,
                        'checkId'=>$checkId,
                    ];
                    $client = new Client();
                    $res = $client->post('https://api.kyckart.com/api/panCard/panDetailedContactV4', ['headers' => $headers, 'json' => $body]);
                    $allpandata = json_decode($res->getBody(), true);
                    //    return $allpandata;
                    $data = [
                        'document_type' => 'PAN',
                        'id_number' => $panno,
                        'consent' => true,
                        'consent_purpose' => 'this is the consent_purpose can be passed any string value',
                    ];
                    $searchkyc = [];
                    if (isset($allpandata['status']['statusCode']) && $allpandata['status']['statusCode'] == 200) {
                        if ($allpandata['response']['code'] == 400) {
                            $searchkyc['statusCode'] = $allpandata['response']['code'];
                            $searchkyc['message'] = $allpandata['response']['message'];
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if($user->role_id == 1){
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }
                                $panvalidation = DB::table('search')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status' => 102,
                                    'pan_no' => $request->pano,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['statusCode' => 102, 'response' => $allpandata['response']['message']]);
                        }
                        $searchkyc['statusCode'] = $allpandata['status']['statusCode'];
                           $searchkyc['message'] = 'Details downloaded successfully';
                           $searchkyc['success'] = true;
   
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['pan'] = $allpandata['response']['pan'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar'] = $allpandata['response']['maskedAadhaar'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] = $allpandata['response']['lastFourDigit'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] = $allpandata['response']['typeOfHolder'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] = $allpandata['response']['name'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] = $allpandata['response']['firstName'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] = $allpandata['response']['lastName'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] = $allpandata['response']['mobile_no'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['email'] = $allpandata['response']['email'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] = $allpandata['response']['dob'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] = $allpandata['response']['gender'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['address'] = $allpandata['response']['address'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['city'] = $allpandata['response']['city'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['state'] = $allpandata['response']['state'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['country'] = $allpandata['response']['country'];
                           $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['pincode'] = $allpandata['response']['pincode'];
                        if ($user->role_id == 1 || $user->role_id==0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $panvalidation = DB::table('search')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'groupId'=>$groupId,
                                'checkId'=>$checkId,
                                'status' => 200,
                                'pan_no' => $allpandata['response']['pan'],
                                'ckycid' => null,
                                'firstname' => $allpandata['response']['firstName'],
                                'fullname' => $allpandata['response']['name'],
                                'mobilenum' => $allpandata['response']['mobile_no'],
                                'email' => $allpandata['response']['email'],
                                'dob' => $allpandata['response']['dob'],
                                'paddress' => $allpandata['response']['address'],
                                'pstate' => $allpandata['response']['state'],
                                'pcity' => $allpandata['response']['city'],
                                'caddress' => null,
                                'cstate' => null,
                                'ccity' => null,
                                'currentpincode' => null,
                                'permanantpincode' => $allpandata['response']['pincode'],
                                // "pancard_id"=> $pancard['response']['pan_no'],
                                // "name"=> $pancard['response']['registered_name'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => 200, 'response' => $searchkyc]);
                    } else {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',202);
                                }
                            }
                           $panvalidation = DB::table('search')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'groupId'=>$groupId,
                                'checkId'=>$checkId,
                                'status' => 202,
                                'pan_no' => $request->pano,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                            return response()->json(['statusCode' => 202, 'response' => $allpandata]);
                        }
                    }
                } catch (ClientException $e) {
                    $response = $e->getResponse();
                    $statusCode = $response->getStatusCode();
                   
                    $errorResponse = json_decode($response->getBody(), true);
                    $errorResponse['error']['message'];
                    $kyccarderror = null;
                    $kyccarderror['error']['name'] = null;
                    $kyccarderror['error']['message'] = $errorResponse['error']['message'];
                    $kyccarderror['error']['reason'] = 'InValid Pan No';
                    $kyccarderror['error']['type'] = ' ';
                    $searchkyc['statusCode'] = 500;
                    $searchkyc['message'] = $errorResponse['error']['message'];
                    if($statusCode==400){
                        if ($user->role_id == 1 || $user->role_id==0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                               }
                            }
                           $panvalidation = DB::table('search')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'groupId'=>$groupId,
                                'checkId'=>$checkId,
                                'status' => 102,
                                'pan_no' => $request->pano,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => 102, 'response' => $searchkyc['message']]);
                    }else{
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',500);
                               }
                            }
                           
                            $panvalidation = DB::table('search')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'groupId'=>$groupId,
                                'checkId'=>$checkId,
                                'status' => 500,
                                'pan_no' => $request->pano,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => 500, 'response' => $searchkyc['message']]);
                    }
                  }
             }
            else{
                return response()->json(['status_code' =>500, 'message' => 'Please reacharge your wallet amount.']);
            } 
          }
         else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
          
        } 
        //searchkyclite
        elseif ($request->has('pano') && $request->has('dob') && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $accesstoken = $request->accesstoken;
            $seamlesstoken = $request->seamlesstoken;
            $paymenttoken = $request->paymenttoken;
            // return $accesstoken;
            if($accesstoken == '' && $seamlesstoken == '' && $paymenttoken == ''){
                    $statusCode = null;
                    $pancard = null;
                    $api_id = null;
                    if (empty($request->pano)) {
                        return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
                    }
    
                    if (empty($request->dob)) {
                        return response()->json([['message' => 'Date of birth is required', 'statusCode' => '404']]);
                     }
    
                    $validator = Validator::make($request->all(), [
                        'dob' => ['required', 'date_format:Y-m-d'],
                    ]);
    
                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors(), 'statusCode' => '404']);
                    }
    
                    if (!$request->headers->has('AccessToken')) {
                        return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                    }
    
                    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                    if ($verifyAccessToken == false) {
                        return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                    }
                   $user = User::where('access_token', $request->header('AccessToken'))->first();
                    //return $user->id;
                    if ($user->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $panno = $request->pano;
                    $dob = $request->dob;
                    $groupId = rand(100,10000000000);
                    $checkId = rand(100,10000000000);
                    $client = new Client();
                    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    if ($user->role_id == 0) {
                            $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
                            if ($apiamster) {
                                $api_id = $apiamster->id;
                            }
                        }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        try{
                            $headers = [
                                'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
                            ];
                            $body=[
                                'panNumber' =>$request->pano,
                                'groupId'=>$groupId,
                                'checkId'=>$checkId,
                            ];
                            $client = new Client();
                            $res = $client->post('https://api.kyckart.com/api/panCard/panDetailedContactV4', ['headers' => $headers, 'json' => $body]);
                            $allpandata = json_decode($res->getBody(), true);
                            $data = [ 
                                'document_type' => 'PAN',
                                'id_number' => $panno,
                                'consent' => true,
                                'consent_purpose' => 'this is the consent_purpose can be passed any string value',
                            ];
                            $searchkyc = [];
                        if (isset($allpandata['status']['statusCode']) && $allpandata['status']['statusCode'] == 200 && isset($allpandata['response']['code']) && $allpandata['response']['code'] == 200)
                            {
                              
                                    $searchkyc['kycStatus'] = 'SUCCESS';
                                    $searchkyc['message'] = 'Details downloaded successfully';
                                    $searchkyc['success'] = true;
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['pan']= $allpandata['response']['pan'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar']= $allpandata['response']['maskedAadhaar'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] = $allpandata['response']['lastFourDigit'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] = $allpandata['response']['typeOfHolder'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] = $allpandata['response']['name'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] = $allpandata['response']['firstName'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] = $allpandata['response']['lastName'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] = $allpandata['response']['mobile_no'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['email'] = $allpandata['response']['email'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] = $allpandata['response']['dob'];
                                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['gender']= $allpandata['response']['gender'];
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['address'] = $allpandata['response']['address'];
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['city']= $allpandata['response']['city'];
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['state']= $allpandata['response']['state'];
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['country']= $allpandata['response']['country'];
                                     $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['pincode']= $allpandata['response']['pincode'];
                                    if ($user->role_id == 1){
                                           if ($apiamster) {
                                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                            }
                                    }
                                    if ($user->role_id == 1 || $user->role_id == 0){
                                        $panvalidation = DB::table('search')->insert([
                                            'user_id' =>$user->id,
                                            'api_id' =>$api_id,
                                            'groupId'=>$groupId,
                                            'checkId'=>$checkId,
                                            'vender_status_code'=>isset($allpandata['status']['statusCode'])?$allpandata['status']['statusCode']:null,
                                            'vender_code'=>isset($allpandata['response']['code'])?$allpandata['response']['code']:null,
                                            'status' => 200,
                                            'pan_no' => $allpandata['response']['pan'],
                                            'ckycid' =>null,
                                            'firstname' => $allpandata['response']['firstName'],
                                            'fullname' => $allpandata['response']['name'],
                                            'mobilenum' =>$allpandata['response']['mobile_no'],
                                            'email' => $allpandata['response']['email'],
                                            'dob' => $allpandata['response']['dob'],
                                            'paddress' =>$allpandata['response']['address'],
                                            'pstate' =>$allpandata['response']['state'],
                                            'pcity' =>$allpandata['response']['city'],
                                            'caddress' =>null,
                                            'cstate' =>null,
                                            'ccity' =>null,
                                            'currentpincode' =>null,
                                            'permanantpincode' =>$allpandata['response']['pincode'], 
                                            // "pancard_id"=> $pancard['response']['pan_no'],
                                            // "name"=> $pancard['response']['registered_name'],
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now(),
                                        ]);
                                    }
                                return response()->json(['statusCode' => 200, 'response' => $searchkyc]);
                            }
                            elseif(isset($allpandata['status']['statusCode']) && $allpandata['status']['statusCode'] == 200 && isset($allpandata['response']['code']) && $allpandata['response']['code'] == 400){
                                if ($user->role_id == 1){
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }
                             if ($user->role_id == 1 || $user->role_id == 0){
                                  $panvalidation = DB::table('search')->insert([
                                   'user_id' => $user->id,
                                   'api_id' => $api_id,
                                   'dob' => $dob,
                                   'groupId'=>$groupId,
                                   'checkId'=>$checkId,
                                   'vender_status_code'=>isset($allpandata['status']['statusCode'])?$allpandata['status']['statusCode']:null,
                                   'vender_code'=>isset($allpandata['response']['code'])?$allpandata['response']['code']:null,
                                   'status' => 102,
                                   'pan_no' => $request->pano,
                                   'created_at' => Carbon::now(),
                                   'updated_at' => Carbon::now(),
                               ]);
                               return response()->json(['statusCode' =>102, 'response' =>$allpandata]);
                           }
    
                        }
                            else{
                                if ($user->role_id == 1){
                                     if ($apiamster) {
                                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 202);
                                     }
                                  }
                                  if($user->role_id == 1 || $user->role_id == 0){
                                   $panvalidation = DB::table('search')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'dob' => $dob,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'vender_status_code'=>isset($allpandata['status']['statusCode'])?$allpandata['status']['statusCode']:null,
                                    'vender_code'=>isset($allpandata['response']['code'])?$allpandata['response']['code']:null,
                                    'status' => 202,
                                    'pan_no' => $request->pano,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                                return response()->json(['statusCode' => 202, 'response' =>$allpandata]);
                            }
                         }  
                        }
                        catch (ClientException $e) {
                            $response = $e->getResponse();
                            $statusCode = $response->getStatusCode();
                            $errorResponse = json_decode($response->getBody(), true);
                            $errorResponse['error']['message'];
                            $kyccarderror = null;
                            $kyccarderror['error']['name'] = null;
                            $kyccarderror['error']['message'] = $errorResponse['error']['message'];
                            $kyccarderror['error']['reason'] ="InValid Pan No";
                            $kyccarderror['error']['type'] = " ";
                            $searchkyc['statusCode'] = 500;
                            $searchkyc['message']= $errorResponse['error']['message'];
                            if(isset($errorResponse ['status']['statusCode']) && $errorResponse ['status']['statusCode']==400 && $errorResponse ['error']['code']=='E0010002'){
                                if ($user->role_id == 1) {
                                     if ($apiamster) {
                                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }
                                if($user->role_id == 1 || $user->role_id == 0){
                                   $panvalidation = DB::table('search')->insert([
                                        'user_id' => $user->id,
                                        'api_id' => $api_id,
                                        'groupId'=>$groupId,
                                        'checkId'=>$checkId,
                                        'vender_status_code'=>isset($errorResponse ['status']['statusCode'])?$errorResponse ['status']['statusCode']:null,
                                        'vender_code'=>isset($errorResponse ['error']['code'])?$errorResponse ['error']['code']:null,
                                        'status' => 102,
                                        'pan_no' => $request->pano,
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                                return response()->json(['statusCode' => 102, 'response' => $searchkyc['message']]);
                            }
                            elseif(isset($errorResponse ['status']['statusCode']) && $errorResponse['status']['statusCode']==400 && $errorResponse['error']['code']==400){
                                if($user->role_id == 1){
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 202);
                                    }
                                }
                                if($user->role_id == 1 || $user->role_id == 0){
                                    $panvalidation = DB::table('search')->insert([
                                        'user_id' =>$user->id,
                                        'api_id' =>$api_id,
                                        'dob' => $dob,
                                        'groupId'=>$groupId,
                                        'checkId'=>$checkId,
                                        'vender_status_code'=>isset($errorResponse ['status']['statusCode'])?$errorResponse ['status']['statusCode']:null,
                                        'vender_code'=>isset($errorResponse ['error']['code'])?$errorResponse ['error']['code']:null,
                                        'status' => 202,
                                        'pan_no' => $request->pano,
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now(),
                                    ]);
                                    
                                }
                                return response()->json(['statusCode' => 202, 'response' => $searchkyc['message']]);
                            }
                            else{
                                   if($user->role_id == 1){
                                        if ($apiamster) {
                                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 500);
                                        }
                                    }
                                    if($user->role_id == 1 || $user->role_id == 0){
                                        $panvalidation = DB::table('search')->insert([
                                            'user_id' =>$user->id,
                                            'api_id' =>$api_id,
                                            'dob' => $dob,
                                            'groupId'=>$groupId,
                                            'checkId'=>$checkId,
                                            'vender_status_code'=>isset($errorResponse ['status']['statusCode'])?$errorResponse ['status']['statusCode']:null,
                                            'vender_code'=>isset($errorResponse ['error']['code'])?$errorResponse ['error']['code']:null,
                                            'status' => 500,
                                            'pan_no' => $request->pano,
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now(),
                                        ]);
                                        
                                    }
                                   return response()->json(['statusCode' => 500, 'response' => $searchkyc['message']]);
                            }
                           
                        }
                    }
                    else{
                        return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                    }
                    
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
    
            }
            elseif($accesstoken != ''){
                $api_id = null;
                $verifyAccessToken = $this->verifyAccessToken($accesstoken);
                if ($verifyAccessToken==false)
                    return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
        
                $access_token = $accesstoken;
                $user = User::where('access_token',$accesstoken)->first();
                if($user->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','enach')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
        
                $updateHitCount = UserSchemeMaster::where('user_id',$user->id)->where('api_id',$api_id)->orderBy('id', 'desc')->first();
                if($updateHitCount || $user->role_id==0){
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $url = 'https://regtechapi.in/e-nach-initiate-payments/'.$accesstoken;
                    // return $url;
                    return response()->json(['statusCode' => 200, 'Link' => $url]);
                    }
                    else{
                        return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
                    }
                }
                else{
                    return response()->json(['statusCode'=>103, 'message'=>'You are not registered to use this service. Please update your plan.']);
                }
                
            }
            elseif($seamlesstoken != '')
            {
                $api_id = null;
                $verifyAccessToken = $this->verifyAccessToken($seamlesstoken);
                if ($verifyAccessToken==false)
                    return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
        
                $access_token = $seamlesstoken;
                $user = User::where('access_token',$seamlesstoken)->first();
                if($user->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','enach')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
        
                $updateHitCount = UserSchemeMaster::where('user_id',$user->id)->where('api_id',$api_id)->orderBy('id', 'desc')->first();
                if($updateHitCount || $user->role_id==0){
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $url = 'https://regtechapi.in/enach_payment_seameless/'.$seamlesstoken;
                    // return $url;
                    return response()->json(['statusCode' => 200, 'Link' => $url]);
                    }
                    else{
                        return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
                    }
                }
                else{
                    return response()->json(['statusCode'=>103, 'message'=>'You are not registered to use this service. Please update your plan.']);
                }
            }
            elseif($paymenttoken != ''){
    
              $api_id = null;
              $verifyAccessToken = $this->verifyAccessToken($paymenttoken);
              if ($verifyAccessToken==false)
                  return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
      
              $access_token = $paymenttoken;
              $user = User::where('access_token',$paymenttoken)->first();
              if($user->role_id==1) {
                  $apiamster = ApiMaster::where('api_slug','payment')->first();
                  if($apiamster)
                      $api_id = $apiamster->id;
              }
      
              $updateHitCount = UserSchemeMaster::where('user_id',$user->id)->where('api_id',$api_id)->orderBy('id', 'desc')->first();
              if($updateHitCount || $user->role_id==0){
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {

                  $url = 'https://regtechapi.in/initiate-payment-integrations/'.$paymenttoken;
                }else{
                    return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);  
                }
                  // return $url;
                  return response()->json(['statusCode' => 200, 'Link' => $url]);
              }
              else{
                  return response()->json(['statusCode'=>103, 'message'=>'You are not registered to use this service. Please update your plan.']);
              }
    
          }
        } 
        //Equifax Score Api
        elseif ($request->has('first_name') && $request->has('last_name') && $request->has('phone_number') && empty($request->rc_number)) {
           
            $api_id = null;
            $score_details = null;
            $score_details_permission = null;
            $validator = \Validator::make(
                $request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'dob' => 'required',
                    'phone_number' => 'required|regex:/^[0-9]{10}+$/',
                    'pano' => 'required',
                ],
                [
                    'first_name.required' => 'First Name  is required',
                    'last_name.required' => 'Last Name  is required',
                    'dob.required' => 'Date of birth  is required',
                    'phone_number.required' => 'Phone Number is required',
                    'phone_number.regex' => 'Phone Number should be 10 digits',
                    'pano.required' => 'Pan card value is required',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'statusCode' => 401]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'equifax_score')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'equifax_score')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $body = [
                    'InquiryPurpose' => '10',
                    'FirstName' => $request->first_name,
                    'MiddleName' => '',
                    'LastName' => $request->last_name,
                    'DOB' => $request->dob,
                    'InquiryPhones' => [
                        [
                            'seq' => '1',
                            'Number' => $request->phone_number,
                            'PhoneType' => ['M'],
                        ],
                    ],
                    'IDDetails' => [
                        [
                            'seq' => '1',
                            'IDType' => 't',
                            'IDValue' => $request->pano,
                        ],
                    ],
                ];

                $headers = [
                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJ0bGFuZCIsImlhdCI6MTY5MTM4NDEzODczNH0.nHmNhb-NlFPziNE_-9iEGKTIVoiz5rM_lNVvPLvQLgU',
                    'Content-Type' => 'application/json',
                ];
                $client = new Client();
                $response = $client->post('https://6lzpgvkn3f.execute-api.ap-south-1.amazonaws.com/equifax/score', [
                    'headers' => $headers,
                    'json' => $body,
                ]);
                // return $response;
                $responseData = json_decode($response->getBody(), true);
                $score_details_permission = null;
                $equifax_score_data = null;
                if (isset($responseData['data']['CCRResponse']['CIRReportDataLst']['0']['CIRReportData']['ScoreDetails']['0']['Value'])) {
                    $score_value = $responseData['data']['CCRResponse']['CIRReportDataLst']['0']['CIRReportData']['ScoreDetails']['0']['Value'];
                    $equifax_score = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->where('permission', '<>', null)
                        ->where('permission', '<>', '')
                        ->orderBy('id', 'desc')
                        ->pluck('permission');
                    if (!empty($equifax_score) && count($equifax_score) > 0) {
                        $equifax_score_data1 = explode(',', $equifax_score[0]);
                        $equifax_score_data['data']['equifax_score'] = null;
                        $equifax_score_data['data']['ScoreValue'] = $responseData['data']['CCRResponse']['CIRReportDataLst']['0']['CIRReportData']['ScoreDetails']['0']['Value'];
                        $equifax_score_data['data']['success'] = $responseData['success'];
                        $equifax_score_data['data']['full_name'] = $request->first_name . ' ' . $request->last_name;
                        $equifax_score_data['data']['pan_no'] = $request->pano;
                        foreach ($equifax_score_data1 as $equifax_score) {
                            $score_details_permission[$equifax_score] = $equifax_score_data['data'][$equifax_score];
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'first_name' => $request->first_name,
                                'last_name' => $request->last_name,
                                'date_of_birth' => $request->dob,
                                'mobile_number' => $request->phone_number,
                                'pan_no' => $request->pano,
                                'score_value' => $score_value,
                                'status_code' => 200,
                                'err_mark' => null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'first_name' => $request->first_name,
                                'last_name' => $request->last_name,
                                'date_of_birth' => $request->dob,
                                'mobile_number' => $request->phone_number,
                                'pan_no' => $request->pano,
                                'score_value' => $score_value,
                                'status_code' => 200,
                                'err_mark' => null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['score_details' => $score_details_permission, 'statusCode' => 200]);
                    }
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'score_value' => $score_value,
                            'status_code' => 200,
                            'err_mark' => null,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'score_value' => $score_value,
                            'status_code' => 200,
                            'err_mark' => null,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json(['statusCode' => 200, 'full_name' => $request->first_name . ' ' . $request->last_name, 'pan_no' => $request->pano, 'success' => $responseData['success'], 'ScoreValue ' => $score_value]);
                } elseif (isset($responseData['data']['Error']['ErrorDesc'])) {
                    return response()->json(['statusCode' => 401, 'ErrorDesc' => $responseData['data']['Error']['ErrorDesc']]);
                } elseif (isset($responseData['data']['CCRResponse']['CIRReportDataLst']['0']['Error']['ErrorDesc'])) {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);
                        }
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'status_code' => 102,
                            'err_mark' => $responseData['data']['CCRResponse']['CIRReportDataLst']['0']['Error']['ErrorDesc'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'status_code' => 102,
                            'err_mark' => $responseData['data']['CCRResponse']['CIRReportDataLst']['0']['Error']['ErrorDesc'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json(['statusCode' => 102, 'Error' => $responseData['data']['CCRResponse']['CIRReportDataLst']['0']['Error']['ErrorDesc']]);
                } else {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 202);
                        }
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'status_code' => 202,
                            'err_mark' => 'Invalid Input',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $equifax_score_insert_data = DB::table('equifax_score_api')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'date_of_birth' => $request->dob,
                            'mobile_number' => $request->phone_number,
                            'pan_no' => $request->pano,
                            'status_code' => 202,
                            'err_mark' => "'Invalid Input",
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json(['statusCode' => 202, 'ErrorDesc' => 'Invalid Input']);
                }
            }
            else {
                return response()->json(['statusCode' => 500, 'message' => 'Please recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
           
        }
         //RC NUMBER API 
        elseif ($request->has('rc_number') && empty($request->pano) && empty($request->dob) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number)) {
            $statusCode = null;
            $rc_validation = null;
            $api_id = null;
            $apiamster = null;
            $service_provider = 'Kyckart';
    
            if (empty($request->rc_number)) {
                return response()->json(['statusCode' => '404', 'message' => 'RC number is required']);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['statusCode' => '404', 'message' => 'Header Access Token is required']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'rc')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'rc')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                } 
    
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $rcNumber = str_replace('-', '', $request->rc_number);
                $subString = strtoupper(substr($rcNumber, 0, 2));
                $groupId = rand(100,10000000000);
                $checkId = rand(100,10000000000);
                if ($subString == 'AP' || $subString == 'AR' || $subString == 'AS' || $subString == 'BR' || $subString == 'CG' || $subString == 'GA' || $subString == 'GJ' || $subString == 'HR' || $subString == 'HP' || $subString == 'JH' || $subString == 'KA' || $subString == 'KL' || $subString == 'MP' || $subString == 'MH' || $subString == 'MN' || $subString == 'ML' || $subString == 'MZ' || $subString == 'NL' || $subString == 'OD' || $subString == 'PB' || $subString == 'RJ' || $subString == 'SK' || $subString == 'TN' || $subString == 'TR' || $subString == 'UP' || $subString == 'UK' || $subString == 'UA' || $subString == 'WB' || $subString == 'TS' || $subString == 'AN' || $subString == 'CH' || $subString == 'DN' || $subString == 'DD' || $subString == 'JK' || $subString == 'LA' || $subString == 'LD' || $subString == 'DL' || $subString == 'PY') {
                    $currentMonth = date('Y-m');
                    $rcdata = DB::table('rcvalidation')
                        ->where('rc_number', $rcNumber)
                        ->where('hit_month', $currentMonth)
                        ->where('status_code', '200')
                        ->orderby('id', 'DESC')
                        ->first();
                    $databasedata = 0;
                    try {
                        $client = new Client();
                        $headers = [
                            'Accept' => 'application/json',
                            'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
                        ];
                        $body = [
                            'vehicleNumber' => $request->rc_number,
                            'groupId'=>$groupId,
                            'checkId'=>$checkId,
                        ];
                        $rc_validation = [];
                        $response = $client->post('https://api.kyckart.com/api/vehicle-registration/searchV4', [
                            'headers' => $headers,
                            'json' => $body,
                        ]);
                        $rc_validation_response = json_decode($response->getBody(), true);
                        if ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 200) {
                            $rc_validation['data']['client_id'] = null;
                            // $rc_validation['data']['transaction_id'] = $rc_validation_response['status']['transactionId'];
                            $rc_validation['data']['rc_number'] = $rc_validation_response['response']['registrationDetail']['number'];
                            $rc_validation['data']['registration_date'] = $rc_validation_response['response']['registrationDetail']['date'];
                            // $rc_validation['data']['registration_expiry_date'] = $rc_validation_response['response']['registrationDetail']['expiryDate'];
    
                            $rc_validation['data']['owner_name'] = $rc_validation_response['response']['owner'];
                            $rc_validation['data']['owner_number'] = $rc_validation_response['response']['ownerNumber'];
                            $rc_validation['data']['father_name'] = $rc_validation_response['response']['ownerFathersName'];
                            $rc_validation['data']['present_address'] = $rc_validation_response['response']['presentAddress'];
                            $rc_validation['data']['permanent_address'] = $rc_validation_response['response']['permanentAddress'];
                            $rc_validation['data']['mobile_number'] = null;
                            $rc_validation['data']['vehicle_category'] = $rc_validation_response['response']['vehicle']['category'];
                            $rc_validation['data']['vehicle_chasi_number'] = $rc_validation_response['response']['vehicle']['chassis'];
                            $rc_validation['data']['vehicle_engine_number'] = $rc_validation_response['response']['vehicle']['engine'];
                            $rc_validation['data']['maker_description'] = null;
                            $rc_validation['data']['maker_model'] = $rc_validation_response['response']['vehicle']['modelName'];
                            // $rc_validation['data']['vehicle_mmv'] = $rc_validation_response['response']['vehicle']['vehicleMMV'];
    
                            //  $rc_validation['data']['vehicle_class'] = $rc_validation_response['response']['vehicle']['class'];
                            // $rc_validation['data']['maker_name'] = $rc_validation_response['response']['vehicle']['companyName'];
                            $rc_validation['data']['body_type'] = $rc_validation_response['response']['vehicle']['bodyType'];
                            $rc_validation['data']['fuel_type'] = $rc_validation_response['response']['vehicle']['fuelType'];
                            $rc_validation['data']['color'] = $rc_validation_response['response']['vehicle']['color'];
                            $rc_validation['data']['norms_type'] = null;
                            // $rc_validation['data']['norms_desc'] = $rc_validation_response['response']['vehicle']['normsDesc'];
                            $rc_validation['data']['fit_up_to'] = null;
                            $rc_validation['data']['financer'] = $rc_validation_response['response']['hypotecationDetail']['financier'];
                            // $rc_validation['data']['is_financed'] = $rc_validation_response['response']['hypotecationDetail']['isFinanced'];
                            $rc_validation['data']['insurance_company'] = $rc_validation_response['response']['insurance']['company'];
                            $rc_validation['data']['insurance_policy_number'] = $rc_validation_response['response']['insurance']['policyNumber'];
                            $rc_validation['data']['insurance_upto'] = null;
                            // $rc_validation['data']['insurance_valid_till_date'] = $rc_validation_response['response']['insurance']['validTill'];
                            $rc_validation['data']['manufacturing_date'] = $rc_validation_response['response']['vehicle']['manufacturingDate'];
                            $rc_validation['data']['registered_at'] = null;
                            $rc_validation['data']['less_info'] = null;
                            $rc_validation['data']['cubic_capacity'] = $rc_validation_response['response']['vehicle']['cubicCapacity'];
                            $rc_validation['data']['vehicle_gross_weight'] = $rc_validation_response['response']['vehicle']['grossWeight'];
    
                            $rc_validation['data']['no_cylinders'] = $rc_validation_response['response']['vehicle']['noCyl'];
                            $rc_validation['data']['seat_capacity'] = $rc_validation_response['response']['vehicle']['seatCap'];
                            $rc_validation['data']['sleeper_capacity'] = $rc_validation_response['response']['vehicle']['sleeperCapacity'];
                            $rc_validation['data']['standing_capacity'] = $rc_validation_response['response']['vehicle']['standingCap'];
    
                            // $rc_validation['data']['rc_standard_capacity'] = $rc_validation_response['response']['vehicle']['rcStandardCap'];
                            $rc_validation['data']['wheelbase'] = $rc_validation_response['response']['vehicle']['wheelBase'];
                            $rc_validation['data']['unladen_weight'] = $rc_validation_response['response']['vehicle']['unladenWeight'];
                            $rc_validation['data']['vehicle_category_description'] = null;
                            $rc_validation['data']['pucc_number'] = $rc_validation_response['response']['pucc']['number'];
                            if (isset($rc_validation_response['response']['pucc']['upto']) && $rc_validation_response['response']['pucc']['upto'] != null && $rc_validation_response['response']['pucc']['upto'] != 'null' && $rc_validation_response['response']['pucc']['upto'] != 'NA') {
                                // $rc_validation['data']['pucc_upto'] = Carbon::parse($rc_validation1['vtpucc']['pucc_upto'])->format('Y-m-d');
                                $rc_validation['data']['pucc_upto'] = $rc_validation_response['response']['pucc']['upto'];
                            } else {
                                $rc_validation['data']['pucc_upto'] = $rc_validation_response['response']['pucc']['upto'];
                            }
                            // $rc_validation['data']['is_commercial'] = $rc_validation_response['response']['isCommercial'];
                            $rc_validation['data']['masked_name'] = null;
                            $rc_validation['data']['permit_issue_date'] = $rc_validation_response['response']['permitDetails']['permitIssueDate'];
                            $rc_validation['data']['permit_number'] = $rc_validation_response['response']['permitDetails']['permitNumber'];
                            $rc_validation['data']['permit_type'] = $rc_validation_response['response']['permitDetails']['permitType'];
                            $rc_validation['data']['permit_valid_from'] = $rc_validation_response['response']['permitDetails']['permitValidFrom'];
                            $rc_validation['data']['permit_valid_upto'] = $rc_validation_response['response']['permitDetails']['nationalPermitUpto'];
                            $rc_validation['data']['national_permit_issued_by'] = $rc_validation_response['response']['permitDetails']['nationalPermitIssuedBy'];
                            $rc_validation['data']['national_permit_number'] = $rc_validation_response['response']['permitDetails']['nationalPermitNumber'];
                            $rc_validation['data']['national_permit_upto'] = $rc_validation_response['response']['permitDetails']['nationalPermitUpto'];
                            $rc_validation['data']['blacklist_status'] = $rc_validation_response['response']['registrationDetail']['blacklistStatus'];
                            $rc_validation['data']['blacklist_details'] = $rc_validation_response['response']['registrationDetail']['blacklistDetails'][0];
                            $rc_validation['data']['rto_code'] = $rc_validation_response['response']['registrationDetail']['RTOCode'];
                            $rc_validation['data']['latest_by'] = $rc_validation_response['response']['registrationDetail']['rcStatusAsOn'];
                            $rc_validation['data']['tax_upto'] = $rc_validation_response['response']['registrationDetail']['taxUpto'];
                            $rc_validation['data']['noc_details'] = $rc_validation_response['response']['registrationDetail']['nocDetails'];
                            $rc_validation['data']['number'] = $rc_validation_response['response']['registrationDetail']['number'];
                            $rc_validation['data']['rc_status'] = $rc_validation_response['response']['registrationDetail']['rcStatus'];
                            $rc_validation['data']['authority'] = $rc_validation_response['response']['registrationDetail']['authority'];
                            $rc_validation['data']['non_use_to'] = $rc_validation_response['response']['nonUseDetails']['nonUseTo'];
                            $rc_validation['data']['non_use_from'] = $rc_validation_response['response']['nonUseDetails']['nonUseFrom'];
                            $rc_validation['data']['non_use_status'] = $rc_validation_response['response']['nonUseDetails']['nonUseStatus'];
                         
                           
                            if($user->role_id == 1 || $user->role_id == 0)
                            {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'client_id' => null,
                                    'transaction_id' => $rc_validation_response['status']['transactionId'],
                                    'status_code' => 200,
                                    'status_code_vender'=>$rc_validation_response['status']['statusCode'],
                                    'code_vender'=>$rc_validation_response['response']['code'],
                                    'rc_number' => $rc_validation_response['response']['registrationDetail']['number'],
                                    'rc_status' => $rc_validation_response['response']['registrationDetail']['rcStatus'],
                                    'owner_number' => $rc_validation_response['response']['ownerNumber'],
                                    'tax_upto' => $rc_validation_response['response']['registrationDetail']['taxUpto'],
                                    'blacklist_status' => $rc_validation_response['response']['registrationDetail']['blacklistStatus'],
                                    'father_name' => $rc_validation_response['response']['ownerFathersName'],
                                    'registration_date' => $rc_validation['data']['registration_date'],
                                    'owner_name' => $rc_validation['data']['owner_name'],
                                    'present_address' => $rc_validation['data']['present_address'],
                                    'permanent_address' => $rc_validation['data']['permanent_address'],
                                    'mobile_number' => null,
                                    'vehicle_category' => $rc_validation['data']['vehicle_category'],
                                    'vehicle_chasi_number' => $rc_validation['data']['vehicle_chasi_number'],
                                    'vehicle_engine_number' => $rc_validation['data']['vehicle_engine_number'],
                                    'maker_description' => null,
                                    'maker_model' => $rc_validation['data']['maker_model'],
                                    'body_type' => $rc_validation['data']['body_type'],
                                    'fuel_type' => $rc_validation['data']['fuel_type'],
                                    'color' => $rc_validation['data']['color'],
                                    'norms_type' => $rc_validation['data']['norms_type'],
                                    'fit_up_to' => $rc_validation['data']['fit_up_to'],
                                    'financer' => $rc_validation['data']['financer'],
                                    'insurance_company' => $rc_validation['data']['insurance_company'],
                                    'insurance_policy_number' => $rc_validation['data']['insurance_policy_number'],
                                    'insurance_upto' => $rc_validation['data']['insurance_upto'],
                                    'manufacturing_date' => $rc_validation['data']['manufacturing_date'],
                                    'registered_at' => null,
                                    'less_info' => 1,
                                    'cubic_capacity' => $rc_validation['data']['cubic_capacity'],
                                    'vehicle_gross_weight' => $rc_validation['data']['vehicle_gross_weight'],
                                    'no_cylinders' => $rc_validation['data']['no_cylinders'],
                                    'seat_capacity' => $rc_validation['data']['seat_capacity'],
                                    'sleeper_capacity' => $rc_validation['data']['sleeper_capacity'],
                                    'standing_capacity' => $rc_validation['data']['standing_capacity'],
                                    'wheelbase' => $rc_validation['data']['wheelbase'],
                                    'unladen_weight' => $rc_validation['data']['unladen_weight'],
                                    'vehicle_category_description' => null,
                                    'pucc_number' => $rc_validation['data']['pucc_number'],
                                    'pucc_upto' => $rc_validation['data']['pucc_upto'],
                                    'hit_month' => date('Y-m'),
                                    'national_permit_issued_by' => $rc_validation_response['response']['permitDetails']['nationalPermitIssuedBy'],
                                    'national_permit_number' => $rc_validation_response['response']['permitDetails']['nationalPermitNumber'],
                                    'national_permit_upto' => $rc_validation_response['response']['permitDetails']['nationalPermitUpto'],
                                    'permit_type' => $rc_validation_response['response']['permitDetails']['permitType'],
                                    'permit_valid_from' => $rc_validation_response['response']['permitDetails']['permitValidFrom'],
                                    'permit_number' => $rc_validation_response['response']['permitDetails']['permitNumber'],
                                    'permit_valid_upto' => $rc_validation_response['response']['permitDetails']['permitValidUpto'],
                                    'permit_issue_date' => $rc_validation_response['response']['permitDetails']['permitIssueDate'],
                                    'noc_details' => $rc_validation_response['response']['registrationDetail']['nocDetails'],
                                    'latest_by' => $rc_validation_response['response']['registrationDetail']['rcStatusAsOn'],
                                    'message_code' => null,
                                    'non_use_to' => $rc_validation_response['response']['nonUseDetails']['nonUseTo'],
                                    'non_use_from' => $rc_validation_response['response']['nonUseDetails']['nonUseFrom'],
                                    'non_use_status' => $rc_validation_response['response']['nonUseDetails']['nonUseStatus'],
                                    // "masked_name"=> $rc_validation1['vehicleDetails']['vehicle']['client_id'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['rc_validation' => $rc_validation, 'status_code' => 200, 'success' => true, 'message' => null, 'message_code' => 'success']);
                        } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 1003) {
                            $statusCode = 102;
                            $errorMessage = 'Record not found';
                           
                                if($user->role_id == 1 || $user->role_id == 0){
                                    if ($user->role_id == 1) {
                                        if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                        }
                                    }   
                                  $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code_vender'=>$rc_validation_response['status']['statusCode'],
                                    'code_vender'=>$rc_validation_response['response']['code'],
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                              }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 1007) {
                            $statusCode = 200;
                            $errorMessage = 'RC Number in Multiple RTOs';
                           
                            if($user->role_id == 1 || $user->role_id == 0){
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'status_code_vender'=>$rc_validation_response['status']['statusCode'],
                                    'code_vender'=>$rc_validation_response['response']['code'],
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($rc_validation_response['status']['statusCode'] == 200 && $rc_validation_response['response']['code'] == 404) {
                            $statusCode = 102;
                            $errorMessage = 'Record does not exist in records';
                          
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if($apiamster){
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'status_code_vender'=>$rc_validation_response['status']['statusCode'],
                                    'code_vender'=>$rc_validation_response['response']['code'],
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Internal server error.';
                            
                            if($user->role_id == 1 || $user->role_id == 0){
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                } 
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => 500,
                                    'status_code_vender'=>$rc_validation_response['status']['statusCode'],
                                    'code_vender'=>$rc_validation_response['response']['code'],
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        }
                    } catch (RequestException $e) {
                        $response = $e->getResponse();
                        $errorResponse = json_decode($response->getBody(), true);
                        $statusCode = $e->getResponse()->getStatusCode();
                        //return   $errorResponse;
                        if ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002') {
                            $statusCode = 102;
                            $errorMessage = 'Invalid Vehicle Number Please Enter Correct Vehicle Number.';
                           
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }  
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
    
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 400) {
                            $statusCode = 102;
                            $errorMessage = 'Invalid Vehicle Number Please Enter Correct Vehicle Number.';
                           
                              if($user->role_id == 1 || $user->role_id == 0){
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                                    }
                                }  
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 205) {
                            $statusCode = 201;
                            $errorMessage = 'API Failed due to internal error.';
                           
                            if($user->role_id == 1 || $user->role_id == 0){
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 201);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1004) {
                            $statusCode = 401;
                            $errorMessage = 'Sorry, RTO website is down for maintenance, we will inform you once it is back.';
                            
                            if($user->role_id == 1 || $user->role_id == 0){
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 401);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=> $errorResponse['error']['code'],
                                    'rc_number' => $rcNumber,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1006) {
                            $statusCode = 102;
                            $errorMessage = 'Invalid Vehicle Number. Please enter valid vehicle number.';
                           
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=> $errorResponse['error']['code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } elseif ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 1008) {
                            $statusCode = 201;
                            $errorMessage = 'Record Not Found/Invalid Rc Number.';
                           
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 201);
                                    }
                                }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        }
                        elseif($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 500){
                            $statusCode = 500;
                            $errorMessage = 'Internal Server error';
                           
                                if ($user->role_id == 1 || $user->role_id == 0) {
                                    if ($user->role_id == 1) {
                                        if ($apiamster) {
                                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                        }
                                    }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        } 
                        else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                          
                                if ($user->role_id == 1 || $user->role_id == 0) {
                                    if ($user->role_id == 1) {
                                        if ($apiamster) {
                                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                        }
                                    }
                                $rcvalidation = DB::table('rcvalidation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'groupId'=>$groupId,
                                    'checkId'=>$checkId,
                                    'status_code' => $statusCode,
                                    'rc_number' => $rcNumber,
                                    'status_code_vender'=>$errorResponse['status']['statusCode'],
                                    'code_vender'=>$errorResponse['error']['code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                    'service_provider' => $service_provider,
                                ]);
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        }
                    }
                } else {
                    return response()->json(['statusCode' => 102, 'message' => 'Verification Failed. Please enter correct State Code.']);
                }
            }
            else {
                return response()->json(['statusCode' => 500, 'message' => 'Please recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
        //Voter ID Validation
        elseif ($request->has('voter_number') && empty($request->pano) && empty($request->dob) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            // return 'test';
            $statusCode = null;
            $voter_validation = null;
            $voter_validation_permission = null;
            $api_id = null;

            if (empty($request->voter_number)) {
                return response()->json([['message' => 'Voter id number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $client = new Client();
            $headers = [
                'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
            ];
            $voterno = $request->voter_number;

            // $body =  [
            //     'voter_id' => $request->voter_number
            // ];
            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    // $res = $client->post($this->base_url.'/voter-id/voter-id', ['headers' => $headers, 'json' => $body,'form_params' => ['api_token' => $token]]);
                    $res = $client->get('https://api.kyckart.com/api/voterId/searchV2?cardNumber=' . $voterno, ['headers' => $headers]);
                    $voter_validations = json_decode($res->getBody(), true);
                    if ($voter_validations['status']['statusCode'] == 200 && $voter_validations['response']['code'] == 200) {
                        $voter_validation['code'] = 200;
                        $voter_validation['status'] = 'success';
                        $voter_validation['response']['epic_no'] = $voter_validations['response']['EPIC_NO'];
                        $voter_validation['response']['dob'] = 'NA';
                        $voter_validation['response']['holder_name'] = $voter_validations['response']['NAME'];
                        $voter_validation['response']['relation'] = $voter_validations['response']['RELATIVE_NAME'];
                        $voter_validation['response']['relation_type'] = $voter_validations['response']['RELATIVE_TYPE'];
                        $voter_validation['response']['age'] = $voter_validations['response']['AGE'];
                        $voter_validation['response']['gender'] = $voter_validations['response']['GENDER'];
                        $voter_validation['response']['area'] = $voter_validations['response']['PART_NAME'];
                        $voter_validation['response']['district'] = $voter_validations['response']['DISTRICT'];
                        $voter_validation['response']['assembly_constituency'] = $voter_validations['response']['ASSEMBLY_CONSTITUENCY_NAME'];
                        $voter_validation['response']['parliamentary_constituency'] = $voter_validations['response']['PARLIAMENTARY_CONSTITUENCY_NAME'];
                        $voter_validation['response']['polling_station'] = $voter_validations['response']['POLL_BOOTH_NAME'];
                        $voter_validation['response']['part_number'] = $voter_validations['response']['PART_NUM'];
                        $voter_validation['response']['part_name'] = $voter_validations['response']['PART_NAME'];
                        $voter_validation['response']['id'] = 'NA';
                        $voter_validation_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');
                        if (count($voter_validation_data) > 0 && $voter_validation_data != null) {
                            $voter_validation_details = explode(',', $voter_validation_data[0]);
                            $voter_validation_permission['code'] = 200;
                            $voter_validation_permission['status'] = 'success';
                            $voter_validation['response']['voter_id'] = null;
                            foreach ($voter_validation_details as $votervalidation) {
                                $voter_validation_permission['response'][$votervalidation] = $voter_validation['response'][$votervalidation];
                            }
                            if ($user->role_id == 1) {
                                //dd('users');
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                                $votervalidation = DB::table('voter_verification')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    // "client_id"=> $voter_validation['data']['client_id'],
                                    'epic_no' => $voter_validation['response']['epic_no'],
                                    'gender' => $voter_validation['response']['gender'],
                                    // "state"=> $voter_validation['data']['state'],
                                    'name' => $voter_validation['response']['holder_name'],
                                    'relation_name' => $voter_validation['response']['relation'],
                                    'relation_type' => $voter_validation['response']['relation_type'],
                                    // "house_no"=> $voter_validation['data']['house_no'],
                                    'dob' => $voter_validation['response']['dob'],
                                    'age' => $voter_validation['response']['age'],
                                    'area' => $voter_validation['response']['area'],
                                    'district' => $voter_validation['response']['district'],
                                    // "multiple"=> $voter_validation['data']['multiple'],
                                    // "last_update"=> $voter_validation['data']['last_update'],
                                    // "assembly_constituency"=> $voter_validation['data']['assembly_constituency'],
                                    // "assembly_constituency_number"=> $voter_validation['data']['assembly_constituency_number'],
                                    // "polling_station"=> $voter_validation['data']['polling_station'],
                                    // "part_number"=> $voter_validation['data']['part_number'],
                                    // "part_name"=> $voter_validation['data']['part_name'],
                                    // "slno_inpart"=> $voter_validation['data']['slno_inpart'],
                                    // "ps_lat_long"=> $voter_validation['data']['ps_lat_long'],
                                    // "rln_name_v1"=> $voter_validation['data']['rln_name_v1'],
                                    // "rln_name_v2"=> $voter_validation['data']['rln_name_v2'],
                                    // "rln_name_v3"=> $voter_validation['data']['rln_name_v3'],
                                    // "section_no"=> $voter_validation['data']['section_no'],
                                    // "name_v1"=> $voter_validation['data']['name_v1'],
                                    // "name_v2"=> $voter_validation['data']['name_v2'],
                                    // "name_v3"=> $voter_validation['data']['name_v3'],
                                    // "st_code"=> $voter_validation['data']['st_code'],
                                    // "parliamentary_constituency"=> $voter_validation['data']['parliamentary_constituency'],
                                    // "v_id"=> $voter_validation['data']['id'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            } elseif ($user->role_id == 0) {
                                $votervalidation = DB::table('voter_verification')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    // "client_id"=> $voter_validation['data']['client_id'],
                                    'epic_no' => $voter_validation['response']['epic_no'],
                                    'gender' => $voter_validation['response']['gender'],
                                    // "state"=> $voter_validation['data']['state'],
                                    'name' => $voter_validation['response']['holder_name'],
                                    'relation_name' => $voter_validation['response']['relation'],
                                    'relation_type' => $voter_validation['response']['relation_type'],
                                    // "house_no"=> $voter_validation['data']['house_no'],
                                    'dob' => $voter_validation['response']['dob'],
                                    'age' => $voter_validation['response']['age'],
                                    'area' => $voter_validation['response']['area'],
                                    'district' => $voter_validation['response']['district'],
                                    // "multiple"=> $voter_validation['data']['multiple'],
                                    // "last_update"=> $voter_validation['data']['last_update'],
                                    // "assembly_constituency"=> $voter_validation['data']['assembly_constituency'],
                                    // "assembly_constituency_number"=> $voter_validation['data']['assembly_constituency_number'],
                                    // "polling_station"=> $voter_validation['data']['polling_station'],
                                    // "part_number"=> $voter_validation['data']['part_number'],
                                    // "part_name"=> $voter_validation['data']['part_name'],
                                    // "slno_inpart"=> $voter_validation['data']['slno_inpart'],
                                    // "ps_lat_long"=> $voter_validation['data']['ps_lat_long'],
                                    // "rln_name_v1"=> $voter_validation['data']['rln_name_v1'],
                                    // "rln_name_v2"=> $voter_validation['data']['rln_name_v2'],
                                    // "rln_name_v3"=> $voter_validation['data']['rln_name_v3'],
                                    // "section_no"=> $voter_validation['data']['section_no'],
                                    // "name_v1"=> $voter_validation['data']['name_v1'],
                                    // "name_v2"=> $voter_validation['data']['name_v2'],
                                    // "name_v3"=> $voter_validation['data']['name_v3'],
                                    // "st_code"=> $voter_validation['data']['st_code'],
                                    // "parliamentary_constituency"=> $voter_validation['data']['parliamentary_constituency'],
                                    // "v_id"=> $voter_validation['data']['id'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json([['voter_validation' => $voter_validation_permission, 'statusCode' => '200']]);
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }

                            $votervalidation = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                // "client_id"=> $voter_validation['data']['client_id'],
                                'epic_no' => $voter_validation['response']['epic_no'],
                                'gender' => $voter_validation['response']['gender'],
                                // "state"=> $voter_validation['data']['state'],
                                'name' => $voter_validation['response']['holder_name'],
                                'relation_name' => $voter_validation['response']['relation'],
                                'relation_type' => $voter_validation['response']['relation_type'],
                                // "house_no"=> $voter_validation['data']['house_no'],
                                'dob' => $voter_validation['response']['dob'],
                                'age' => $voter_validation['response']['age'],
                                'area' => $voter_validation['response']['area'],
                                'district' => $voter_validation['response']['district'],
                                // "multiple"=> $voter_validation['data']['multiple'],
                                // "last_update"=> $voter_validation['data']['last_update'],
                                // "assembly_constituency"=> $voter_validation['data']['assembly_constituency'],
                                // "assembly_constituency_number"=> $voter_validation['data']['assembly_constituency_number'],
                                // "polling_station"=> $voter_validation['data']['polling_station'],
                                // "part_number"=> $voter_validation['data']['part_number'],
                                // "part_name"=> $voter_validation['data']['part_name'],
                                // "slno_inpart"=> $voter_validation['data']['slno_inpart'],
                                // "ps_lat_long"=> $voter_validation['data']['ps_lat_long'],
                                // "rln_name_v1"=> $voter_validation['data']['rln_name_v1'],
                                // "rln_name_v2"=> $voter_validation['data']['rln_name_v2'],
                                // "rln_name_v3"=> $voter_validation['data']['rln_name_v3'],
                                // "section_no"=> $voter_validation['data']['section_no'],
                                // "name_v1"=> $voter_validation['data']['name_v1'],
                                // "name_v2"=> $voter_validation['data']['name_v2'],
                                // "name_v3"=> $voter_validation['data']['name_v3'],
                                // "st_code"=> $voter_validation['data']['st_code'],
                                // "parliamentary_constituency"=> $voter_validation['data']['parliamentary_constituency'],
                                // "v_id"=> $voter_validation['data']['id'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $votervalidation = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                // "client_id"=> $voter_validation['data']['client_id'],
                                'epic_no' => $voter_validation['response']['epic_no'],
                                'gender' => $voter_validation['response']['gender'],
                                // "state"=> $voter_validation['data']['state'],
                                'name' => $voter_validation['response']['holder_name'],
                                'relation_name' => $voter_validation['response']['relation'],
                                'relation_type' => $voter_validation['response']['relation_type'],
                                // "house_no"=> $voter_validation['data']['house_no'],
                                'dob' => $voter_validation['response']['dob'],
                                'age' => $voter_validation['response']['age'],
                                'area' => $voter_validation['response']['area'],
                                'district' => $voter_validation['response']['district'],
                                // "multiple"=> $voter_validation['data']['multiple'],
                                // "last_update"=> $voter_validation['data']['last_update'],
                                // "assembly_constituency"=> $voter_validation['data']['assembly_constituency'],
                                // "assembly_constituency_number"=> $voter_validation['data']['assembly_constituency_number'],
                                // "polling_station"=> $voter_validation['data']['polling_station'],
                                // "part_number"=> $voter_validation['data']['part_number'],
                                // "part_name"=> $voter_validation['data']['part_name'],
                                // "slno_inpart"=> $voter_validation['data']['slno_inpart'],
                                // "ps_lat_long"=> $voter_validation['data']['ps_lat_long'],
                                // "rln_name_v1"=> $voter_validation['data']['rln_name_v1'],
                                // "rln_name_v2"=> $voter_validation['data']['rln_name_v2'],
                                // "rln_name_v3"=> $voter_validation['data']['rln_name_v3'],
                                // "section_no"=> $voter_validation['data']['section_no'],
                                // "name_v1"=> $voter_validation['data']['name_v1'],
                                // "name_v2"=> $voter_validation['data']['name_v2'],
                                // "name_v3"=> $voter_validation['data']['name_v3'],
                                // "st_code"=> $voter_validation['data']['st_code'],
                                // "parliamentary_constituency"=> $voter_validation['data']['parliamentary_constituency'],
                                // "v_id"=> $voter_validation['data']['id'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json([['voter_validation' => $voter_validation, 'statusCode' => '200']]);
                    } elseif ($voter_validations['status']['statusCode'] == 200 && $voter_validations['response']['code'] == 400) {
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 201);
                            }

                            $votervalidation = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $votervalidation = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json([['message' => 'Invalid Voter Id', 'statusCode' => '400']]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Voter ID.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode' =>500, 'message' => 'Please recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        } elseif ($request->has('aadhaar_number') && empty($request->voter_number) && empty($request->pano) && empty($request->dob) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            // return 'test';
            $statusCode = null;
            $aadhaar_validations = null;
            $aadhaar_validations_permission = null;
            $api_id = null;
            if (empty($request->aadhaar_number)) {
                return response()->json([['message' => 'Aadhaar number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();

            $headers = [
                // 'Authorization' => $this->token,
                // 'API-KEY' => $this->api_club_key,
                'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
                'Referer' => $this->site_url,
            ];

            $body = [
                'aadhaarNumber' => $request->aadhaar_number,
                'demographicCheck' => true,
            ];

            // $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    // $res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body,'form_params' => ['api_token' => $token]]);
                    // $res = $client->post($this->api_club.'/v1/validate_aadhar', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('https://api.kyckart.com/api/aadhaar/basic-verification', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_validation = json_decode($res->getBody(), true);
                    if ($aadhaar_validation['status']['statusCode'] == 200 && $aadhaar_validation['response']['verified'] == true) {
                        $aadhaar_validations['data']['client_id'] = null;
                        $aadhaar_validations['data']['age_range'] = $aadhaar_validation['response']['ageBand'];
                        $aadhaar_validations['data']['aadhaar_number'] = $request->aadhaar_number;
                        $aadhaar_validations['data']['state'] = $aadhaar_validation['response']['state'];
                        $aadhaar_validations['data']['gender'] = $aadhaar_validation['response']['gender'];
                        $aadhaar_validations['data']['last_digits'] = substr($aadhaar_validation['response']['mobileNumber'], 7, 3);
                        $aadhaar_validations['data']['is_mobile'] = true;
                        $aadhaar_validations['data']['less_info'] = false;
                        $aadhaar_validation_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');

                        if (count($aadhaar_validation_data) > 0 && $aadhaar_validation_data != null) {
                            $aadhaar_validations['data']['aadhaar'] = null;
                            $aadhaar_validations_per_data = explode(',', $aadhaar_validation_data[0]);
                            foreach ($aadhaar_validations_per_data as $aadhar_validation_item) {
                                $aadhaar_validations_permission['data'][$aadhar_validation_item] = $aadhaar_validations['data'][$aadhar_validation_item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                                $aadharvalidation = DB::table('aadhar_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'aadhar_no' => $request->aadhaar_number,
                                    'age_range' => $aadhaar_validation['response']['ageBand'],
                                    'state' => $aadhaar_validation['response']['state'],
                                    'gender' => $aadhaar_validation['response']['gender'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            } elseif ($user->role_id == 0) {
                                $aadharvalidation = DB::table('aadhar_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'aadhar_no' => $request->aadhaar_number,
                                    'age_range' => $aadhaar_validation['response']['ageBand'],
                                    'state' => $aadhaar_validation['response']['state'],
                                    'gender' => $aadhaar_validation['response']['gender'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json([['aadhaar_validation' => $aadhaar_validations_permission, 'statusCode' => '200']]);
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $aadharvalidation = DB::table('aadhar_validation')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'aadhar_no' => $request->aadhaar_number,
                                'age_range' => $aadhaar_validation['response']['ageBand'],
                                'state' => $aadhaar_validation['response']['state'],
                                'gender' => $aadhaar_validation['response']['gender'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $aadharvalidation = DB::table('aadhar_validation')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'aadhar_no' => $request->aadhaar_number,
                                'age_range' => $aadhaar_validation['response']['ageBand'],
                                'state' => $aadhaar_validation['response']['state'],
                                'gender' => $aadhaar_validation['response']['gender'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json([['aadhaar_validation' => $aadhaar_validations, 'statusCode' => '200']]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 404) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Aadhar Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                   $aadharvalidation = DB::table('aadhar_validation')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        // "client_id"=> $aadhaar_validation['response']['client_id'],
                        'aadhar_no' => $request->aadhaar_number,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
             else{
                return response()->json(['statusCode' => 500, 'message' => 'Please recharage your wallet.']);
             }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //Get Otp Generate Aadhar
        elseif ($request->has('otp_aadhar_number') && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->dob) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $aadhaar_validation = null;
            $aadhaar_otp_genrates = null;
            $aadhaar_otp_genrate_permission = null;
            $api_id = null;

            if (empty($request->otp_aadhar_number)) {
                return response()->json([['message' => 'Aadhaar number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'aadharotpgenrate')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $client = new Client();
            $headers = [
                'Authorization' => $this->signzytoken,
                'Accept' => 'application/json',
            ];

            $body = [
                'aadhaarNumber' => $request->otp_aadhar_number,
            ];
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->post($this->base_urln . '/getOkycOtp', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_otp_genrate = json_decode($res->getBody(), true);

                    if ($aadhaar_otp_genrate['data']['otpSentStatus'] == true && $aadhaar_otp_genrate['statusCode'] == 200) {
                        $aadhaar_otp_genrates['data']['otp_sent'] = $aadhaar_otp_genrate['data']['otpSentStatus'];
                        $aadhaar_otp_genrates['data']['if_number'] = $aadhaar_otp_genrate['data']['if_number'];
                        $aadhaar_otp_genrates['data']['client_id'] = $aadhaar_otp_genrate['data']['requestId'];
                        $aadhaar_otp_genrates['data']['valid_aadhaar'] = $aadhaar_otp_genrate['data']['isValidAadhaar'];
                        $aadhaar_otp_genrates_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');

                        if (count($aadhaar_otp_genrates_data) > 0 && $aadhaar_otp_genrates_data != null) {
                            $aadhaar_otp_genrate_permission_details = explode(',', $aadhaar_otp_genrates_data[0]);
                            $aadhaar_otp_genrates['data']['aadharotpgenrate'] = null;
                            foreach ($aadhaar_otp_genrate_permission_details as $aadhaar_otp_genrate_permission_item) {
                                $aadhaar_otp_genrate_permission['data'][$aadhaar_otp_genrate_permission_item] = $aadhaar_otp_genrates['data'][$aadhaar_otp_genrate_permission_item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            return response()->json([['aadhaar_validation' => $aadhaar_otp_genrate_permission, 'success' => true, 'status_code' => 200, 'message' => 'OTP Sent.']]);
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
                        return response()->json([['aadhaar_validation' => $aadhaar_otp_genrates, 'success' => true, 'status_code' => 200, 'message' => 'OTP Sent.']]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Aadhar Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }

            return response()->json([['aadhaar_validation' => $aadhaar_otp_genrate, 'statusCode' => '200']]);
        }
        //submitotpAadhar
        elseif ($request->has('client_id') && $request->has('otp_aadhar') && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->dob) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $aadhaar_otp_submit = null;
            $aadhaar_otp_submit_permission = null;
            $aadhaar_otp_submit_details = null;
            $hit_limits_exceeded = 0;
            $api_id = null;

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'aadharotpsubmit')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $headers = [
                'Authorization' => $this->signzytoken,
                'Accept' => 'application/json',
            ];

            if (isset($request->client_id)) {
                $body = [
                    'requestId' => $request->client_id,
                    'otp' => $request->otp_aadhar,
                ];
            } else {
                $body = [
                    'requestId' => $request->client_id,
                    'otp' => $request->otp_aadhar,
                ];
            }

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->post($this->base_urln . '/fetchOkycData', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_otp_submit = json_decode($res->getBody(), true);
                    $aadhaar_otp_submit_permission = null;
                    $aadhaar_otp_submit_details = null;
                    if (isset($aadhaar_otp_submit['statusCode']) && $aadhaar_otp_submit['statusCode'] == 200) {
                        $aadhaar_otp_submit_details['data']['client_id'] = $aadhaar_otp_submit['data']['client_id'];
                        $aadhaar_otp_submit_details['data']['full_name'] = $aadhaar_otp_submit['data']['full_name'];
                        $aadhaar_otp_submit_details['data']['aadhaar_number'] = $aadhaar_otp_submit['data']['aadhaar_number'];
                        $aadhaar_otp_submit_details['data']['dob'] = $aadhaar_otp_submit['data']['dob'];
                        $aadhaar_otp_submit_details['data']['gender'] = $aadhaar_otp_submit['data']['gender'];
                        $aadhaar_otp_submit_details['data']['country'] = $aadhaar_otp_submit['data']['address']['country'];
                        $aadhaar_otp_submit_details['data']['dist'] = $aadhaar_otp_submit['data']['address']['dist'];
                        $aadhaar_otp_submit_details['data']['state'] = $aadhaar_otp_submit['data']['address']['state'];
                        $aadhaar_otp_submit_details['data']['po'] = $aadhaar_otp_submit['data']['address']['po'];
                        $aadhaar_otp_submit_details['data']['loc'] = $aadhaar_otp_submit['data']['address']['loc'];
                        $aadhaar_otp_submit_details['data']['vtc'] = $aadhaar_otp_submit['data']['address']['vtc'];
                        $aadhaar_otp_submit_details['data']['subdist'] = $aadhaar_otp_submit['data']['address']['subdist'];
                        $aadhaar_otp_submit_details['data']['street'] = $aadhaar_otp_submit['data']['address']['street'];
                        $aadhaar_otp_submit_details['data']['house'] = $aadhaar_otp_submit['data']['address']['house'];
                        $aadhaar_otp_submit_details['data']['vtc'] = $aadhaar_otp_submit['data']['address']['vtc'];
                        $aadhaar_otp_submit_details['data']['landmark'] = $aadhaar_otp_submit['data']['address']['landmark'];
                        $aadhaar_otp_submit_details['data']['face_status'] = $aadhaar_otp_submit['data']['face_status'];
                        $aadhaar_otp_submit_details['data']['face_score'] = $aadhaar_otp_submit['data']['face_score'];
                        $aadhaar_otp_submit_details['data']['zip'] = $aadhaar_otp_submit['data']['zip'];
                        $aadhaar_otp_submit_details['data']['profile_image'] = $aadhaar_otp_submit['data']['profile_image'];
                        $aadhaar_otp_submit_details['data']['has_image'] = $aadhaar_otp_submit['data']['has_image'];
                        $aadhaar_otp_submit_details['data']['email_hash'] = $aadhaar_otp_submit['data']['email_hash'];
                        $aadhaar_otp_submit_details['data']['mobile_hash'] = $aadhaar_otp_submit['data']['mobile_hash'];
                        $aadhaar_otp_submit_details['data']['raw_xml'] = $aadhaar_otp_submit['data']['raw_xml'];
                        $aadhaar_otp_submit_details['data']['zip_data'] = $aadhaar_otp_submit['data']['zip_data'];
                        $aadhaar_otp_submit_details['data']['care_of'] = $aadhaar_otp_submit['data']['care_of'];
                        $aadhaar_otp_submit_details['data']['share_code'] = $aadhaar_otp_submit['data']['share_code'];
                        $aadhaar_otp_submit_details['data']['mobile_verified'] = $aadhaar_otp_submit['data']['mobile_verified'];
                        $aadhaar_otp_submit_details['data']['reference_id'] = $aadhaar_otp_submit['data']['reference_id'];
                        $aadhaar_otp_submit_details['data']['aadhaar_pdf'] = $aadhaar_otp_submit['data']['aadhaar_pdf'];
                        $aadhaar_otp_submit_details['data']['status'] = $aadhaar_otp_submit['data']['status'];
                        $aadhaar_otp_submit_details['data']['uniqueness_id'] = $aadhaar_otp_submit['data']['uniqueness_id'];
                        $aadhaar_otp_submit_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');

                        if (count($aadhaar_otp_submit_data) > 0 && $aadhaar_otp_submit_data != null) {
                            $aadhaar_otp_submit_permission_record = explode(',', $aadhaar_otp_submit_data[0]);
                            $aadhaar_otp_submit_details['data']['aadharotpsubmit'] = null;
                            foreach ($aadhaar_otp_submit_permission_record as $aadhaar_otp_submit_item) {
                                $aadhaar_otp_submit_permission['data'][$aadhaar_otp_submit_item] = $aadhaar_otp_submit_details['data'][$aadhaar_otp_submit_item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            return response()->json(['aadhaar_otp_submit' => $aadhaar_otp_submit_permission, 'statusCode' => '200']);
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
                        return response()->json(['aadhaar_otp_submit' => $aadhaar_otp_submit_details, 'statusCode' => '200']);
                    } else {
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                            }
                        }
                        return response()->json(['aadhaar_otp_submit' => $aadhaar_otp_submit, 'statusCode' => 102]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter valid details.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //DL Verification Api
        elseif ($request->has('license_number') && $request->has('dob') && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $license_validation = null;
            $license_validation_response = null;
            $license_validation_permission = null;
            $api_id = null;
            if (empty($request->license_number)) {
                return response()->json([['message' => 'License number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'license')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'license')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $headers = [
                // 'API-KEY' => $this->api_club_key,
                // 'Referer' => $this->site_url
                'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
            ];

            $body = [
                // 'dl_no' => $request->license_number,
                // 'dob'=> $request->dob
                'cardNumber' => $request->license_number,
                'dob' => $request->dob,
            ];

            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    // $res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body,'form_params' => ['api_token' => $token]]);
                    // $res = $client->post('https://api.apiclub.in/uat/v1/fetch_dl', ['headers' => $headers, 'json' => $body]);
                    // $res = $client->post('https://api.apiclub.in/api/v1/fetch_dl', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('https://api.kyckart.com/api/dl/intermediate', ['headers' => $headers, 'json' => $body]);
                    $license_validation = json_decode($res->getBody(), true);
                    // return $license_validation;
                    // return $license_validation['response']['license_number'];
                    //license_validation_response
                    if ($license_validation['status']['statusCode'] == 200) {
                        $license_validation_response['data']['license_number'] = $license_validation['response']['dlNumber'];
                        $license_validation_response['data']['dob'] = $license_validation['response']['dob'];
                        $license_validation_response['data']['name'] = $license_validation['response']['name'];
                        $license_validation_response['data']['father_or_husband_name'] = $license_validation['response']['father/husband'];
                        $license_validation_response['data']['blood_group'] = $license_validation['response']['bloodGroup'];
                        $license_validation_response['data']['profile_image'] = $license_validation['response']['img'];
                        $license_validation_response['data']['permanent_address'] = $license_validation['response']['address'][0]['completeAddress'];
                        $license_validation_response['data']['state'] = $license_validation['response']['address'][0]['state'];
                        $license_validation_response['data']['district'] = $license_validation['response']['address'][0]['district'];
                        $license_validation_response['data']['permanent_zip'] = $license_validation['response']['address'][0]['pin'];
                        $license_validation_response['data']['country'] = $license_validation['response']['address'][0]['country'];
                        $license_validation_response['data']['type'] = $license_validation['response']['address'][0]['type'];
                        $license_validation_response['data']['non_transport_doi'] = substr($license_validation['response']['validity']['nonTransport'], 0, 10);
                        $license_validation_response['data']['non_transport_doe'] = substr($license_validation['response']['validity']['nonTransport'], 14, 24);
                        $license_validation_response['data']['transport_doi'] = substr($license_validation['response']['validity']['transport'], 0, 10);
                        $license_validation_response['data']['transport_doe'] = substr($license_validation['response']['validity']['transport'], 14, 24);
                        $license_validation_response['data']['ola_code'] = substr($request->license_number, 0, 4);
                        $license_validation_response['data']['cov'] = $license_validation['response']['covDetails'][0]['cov'];
                        $license_validation_response['data']['issue_date'] = $license_validation['response']['covDetails'][0]['issueDate'];
                        $license_validation_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');
                        if (count($license_validation_data) > 0 && $license_validation_data != null) {
                            $license_validation_permission_record = explode(',', $license_validation_data[0]);
                            $license_validation_response['data']['license'] = null;
                            foreach ($license_validation_permission_record as $license_validation_item) {
                                $license_validation_permission['data'][$license_validation_item] = $license_validation_response['data'][$license_validation_item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                                $licensevalidation = DB::table('driving_license')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    // "client_id"=> $license_validation['data']['client_id'],
                                    'license_number' => $license_validation['response']['dlNumber'],
                                    // "temporary_address"=> $license_validation['response']['temporary_address'],
                                    'father_or_husband_name' => $license_validation['response']['father/husband'],
                                    // "doe"=> $license_validation['response']['doe'],
                                    // "temporary_zip"=> $license_validation['response']['temporary_zip'],
                                    // "permanent_address"=> $license_validation['response']['permanent_address'],
                                    // "doi"=> $license_validation['response']['doi'],
                                    'dob' => $license_validation['response']['dob'],
                                    // "permanent_zip"=> $license_validation['response']['permanent_zip'],
                                    'gender' => null,
                                    'name' => $license_validation['response']['name'],
                                    'state' => $license_validation['response']['address'][0]['state'],
                                    'profile_image' => $license_validation['response']['img'],
                                    // "ola_name"=> $license_validation['response']['ola_name'],
                                    // "initial_doi"=> $license_validation['response']['initial_doi'],
                                    // "ola_code"=> $license_validation['response']['ola_code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            } elseif ($user->role_id == 0) {
                                $licensevalidation = DB::table('driving_license')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    // "client_id"=> $license_validation['data']['client_id'],
                                    'license_number' => $license_validation['response']['dlNumber'],
                                    // "temporary_address"=> $license_validation['response']['temporary_address'],
                                    'father_or_husband_name' => $license_validation['response']['father/husband'],
                                    // "doe"=> $license_validation['response']['doe'],
                                    // "temporary_zip"=> $license_validation['response']['temporary_zip'],
                                    // "permanent_address"=> $license_validation['response']['permanent_address'],
                                    // "doi"=> $license_validation['response']['doi'],
                                    'dob' => $license_validation['response']['dob'],
                                    // "permanent_zip"=> $license_validation['response']['permanent_zip'],
                                    'gender' => null,
                                    'name' => $license_validation['response']['name'],
                                    'state' => $license_validation['response']['address'][0]['state'],
                                    'profile_image' => $license_validation['response']['img'],
                                    // "ola_name"=> $license_validation['response']['ola_name'],
                                    // "initial_doi"=> $license_validation['response']['initial_doi'],
                                    // "ola_code"=> $license_validation['response']['ola_code'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json([['license_validation' => $license_validation_permission, 'statusCode' => '200']]);
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $licensevalidation = DB::table('driving_license')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                // "client_id"=> $license_validation['data']['client_id'],
                                'license_number' => $license_validation['response']['dlNumber'],
                                // "temporary_address"=> $license_validation['response']['temporary_address'],
                                'father_or_husband_name' => $license_validation['response']['father/husband'],
                                // "doe"=> $license_validation['response']['doe'],
                                // "temporary_zip"=> $license_validation['response']['temporary_zip'],
                                // "permanent_address"=> $license_validation['response']['permanent_address'],
                                // "doi"=> $license_validation['response']['doi'],
                                'dob' => $license_validation['response']['dob'],
                                // "permanent_zip"=> $license_validation['response']['permanent_zip'],
                                'gender' => null,
                                'name' => $license_validation['response']['name'],
                                'state' => $license_validation['response']['address'][0]['state'],
                                'profile_image' => $license_validation['response']['img'],
                                // "ola_name"=> $license_validation['response']['ola_name'],
                                // "initial_doi"=> $license_validation['response']['initial_doi'],
                                // "ola_code"=> $license_validation['response']['ola_code'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $licensevalidation = DB::table('driving_license')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                // "client_id"=> $license_validation['data']['client_id'],
                                'license_number' => $license_validation['response']['dlNumber'],
                                // "temporary_address"=> $license_validation['response']['temporary_address'],
                                'father_or_husband_name' => $license_validation['response']['father/husband'],
                                // "doe"=> $license_validation['response']['doe'],
                                // "temporary_zip"=> $license_validation['response']['temporary_zip'],
                                // "permanent_address"=> $license_validation['response']['permanent_address'],
                                // "doi"=> $license_validation['response']['doi'],
                                'dob' => $license_validation['response']['dob'],
                                // "permanent_zip"=> $license_validation['response']['permanent_zip'],
                                'gender' => null,
                                'name' => $license_validation['response']['name'],
                                'state' => $license_validation['response']['address'][0]['state'],
                                'profile_image' => $license_validation['response']['img'],
                                // "ola_name"=> $license_validation['response']['ola_name'],
                                // "initial_doi"=> $license_validation['response']['initial_doi'],
                                // "ola_code"=> $license_validation['response']['ola_code'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json([['license_validation' => $license_validation_response, 'statusCode' => '200']]);
                    } elseif ($license_validation['status']['statusCode'] == 400) {
                        $message = 'license number wrong.';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 202);
                        }
                        return response()->json([['message' => $message, 'statusCode' => 500]]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $response = $e->getResponse();
                    $errorResponse = json_decode($response->getBody(), true);
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Licence Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }

        //LoanTap Pan Verification pancard api
        elseif ($request->has('pan_number') && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            // dd($request->pan_number);
            $statusCode = null;
            $pancard = null;
            $pancard_validation_permission = null;
            $api_id = null;
            if (empty($request->pan_number)) {
                return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $headers = [
                'Authorization' => $this->nsdlToken,
                // 'API-KEY' => $this->api_club_key,
                // 'Referer' => $this->site_url
            ];

            // $body =  [
            //     'pan_no' => $request->pan_number
            // ];

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    // $res = $client->post($this->base_url.'/pan/pan', ['headers' => $headers, 'json' => $body]);
                    // $res = $client->post($this->api_club.'/verify_pan', ['headers' => $headers, 'json' => $body]);
                    // $res = $client->post('https://mod5c77zjj.execute-api.ap-south-1.amazonaws.com/loantap/pan', ['headers' => $headers, 'form_params'=> ['pancard'=>strtoupper($request->pan_number)]]);
                    $res = $client->post('https://g6wijy0gpe.execute-api.ap-south-1.amazonaws.com/loantap/pan', ['headers' => $headers, 'form_params' => ['pancard' => strtoupper($request->pan_number)]]);
                    $pancard = json_decode($res->getBody(), true);
                    // return $pancard['fullName'];
                    if ($pancard['fullName'] == '') {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                            $panvalidation = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'pancard_id' => null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $panvalidation = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'pancard_id' => null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 200;
                        $panvalidation_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');
                        if (count($panvalidation_data) > 0 && $panvalidation_data != null) {
                            $panvalidation_permission_record = explode(',', $panvalidation_data[0]);
                            $pancard['pancard'] = null;
                            foreach ($panvalidation_permission_record as $pancard_validation_item) {
                                $pancard_validation_permission[$pancard_validation_item] = $pancard[$pancard_validation_item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                                $panvalidation = DB::table('pancard_varification')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'pancard_id' => $pancard['panNumber'],
                                    'name' => $pancard['fullName'],
                                    // "pancard_id"=> $pancard['response']['pan_no'],
                                    // "name"=> $pancard['response']['registered_name'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            } elseif ($user->role_id == 0) {
                                $panvalidation = DB::table('pancard_varification')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'pancard_id' => $pancard['panNumber'],
                                    'name' => $pancard['fullName'],
                                    // "pancard_id"=> $pancard['response']['pan_no'],
                                    // "name"=> $pancard['response']['registered_name'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json([['pancard' => $pancard_validation_permission, 'statusCode' => $statusCode]]);
                        }

                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $panvalidation = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'pancard_id' => $pancard['panNumber'],
                                'name' => $pancard['fullName'],
                                // "pancard_id"=> $pancard['response']['pan_no'],
                                // "name"=> $pancard['response']['registered_name'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $panvalidation = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'pancard_id' => $pancard['panNumber'],
                                'name' => $pancard['fullName'],
                                // "pancard_id"=> $pancard['response']['pan_no'],
                                // "name"=> $pancard['response']['registered_name'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 404) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }

                    $panvalidation = DB::table('pancard_varification')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        // "client_id"=> $aadhaar_validation['response']['client_id'],
                        'pancard_id' => $request->pan_number,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }

            return response()->json([['pancard' => $pancard, 'statusCode' => $statusCode]]);
        }
        // pancard_new_details
        elseif ($request->has('pan_no') && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $pancard = null;
            $pancard_permission = null;
            $api_id = null;
            $apimaster = null;
            if (empty($request->pan_no)) {
                return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apimaster = ApiMaster::where('api_slug', 'paninfo')->first();
                if ($apimaster) {
                    $api_id = $apimaster->id;
                }
            } 
            elseif ($user->role_id == 0) {
                $apimaster = ApiMaster::where('api_slug', 'paninfo')->first();
                if ($apimaster) {
                    $api_id = $apimaster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            $client = new Client();
            $headers = [
                'Accept' => 'application/json',
                'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
            ];
            $body = [
                'panNumber' => $request->pan_no,
            ];
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $response = $client->post('https://api.kyckart.com/api/panCard/panDetailedContactV4', [
                        'headers' => $headers,
                        'json' => $body,
                    ]);
                    $pancard_details = json_decode($response->getBody(), true);
                    if ($pancard_details['response']['code'] == 200 && $pancard_details['status']['statusCode'] == 200) {
                        $pancard['data']['client_id'] = null;
                        $pancard['data']['transactionId'] = $pancard_details['status']['transactionId'];
                        $pancard['data']['panNumber'] = $pancard_details['response']['pan'];
                        $pancard['data']['maskedAadhar'] = $pancard_details['response']['maskedAadhaar'];
                        $pancard['data']['lastFourDigitAadhar'] = $pancard_details['response']['lastFourDigit'];
                        $pancard['data']['typeOfHolder'] = $pancard_details['response']['typeOfHolder'];
                        $pancard['data']['name'] = $pancard_details['response']['name'];
                        $pancard['data']['firstName'] = $pancard_details['response']['firstName'];
                        $pancard['data']['middleName'] = $pancard_details['response']['middleName'];
                        $pancard['data']['lastName'] = $pancard_details['response']['lastName'];
                        $pancard['data']['gender'] = $pancard_details['response']['gender'];
                        $pancard['data']['dob'] = $pancard_details['response']['dob'];
                        $pancard['data']['address'] = $pancard_details['response']['address'];
                        $pancard['data']['city'] = isset($pancard_details['response']['city']) ? $pancard_details['response']['city'] : null;
                        $pancard['data']['state'] = $pancard_details['response']['state'];
                        $pancard['data']['country'] = $pancard_details['response']['country'];
                        $pancard['data']['pincode'] = $pancard_details['response']['pincode'];
                        $pancard['data']['mobile_no'] = $pancard_details['response']['mobile_no'];
                        $pancard['data']['email'] = $pancard_details['response']['email'];
                        $pancard['data']['isValid'] = $pancard_details['response']['isValid'];
                        $pancard['data']['aadhaarSeedingStatus'] = $pancard_details['response']['aadhaarSeedingStatus'];
                        $pancard['data']['serviceCode'] = isset($pancard_details['response']['serviceCode'])?$pancard_details['response']['serviceCode']:null;
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                $paninfo = DB::table('pan_info')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'client_id' => null,
                                    'status_code' => 200,
                                    'transaction_id' => $pancard_details['status']['transactionId'],
                                    'pan_no' => $pancard_details['response']['pan'],
                                    'masked_aadhar' => $pancard_details['response']['maskedAadhaar'],
                                    'last_four_digit_aadhar' => $pancard_details['response']['lastFourDigit'],
                                    'type_of_holder' => $pancard_details['response']['typeOfHolder'],
                                    'name' => $pancard_details['response']['name'],
                                    'firstname' => $pancard_details['response']['firstName'],
                                    'middlename' => $pancard_details['response']['middleName'],
                                    'lastname' => $pancard_details['response']['lastName'],
                                    'gender' => $pancard_details['response']['gender'],
                                    'dob' => $pancard_details['response']['dob'],
                                    'city' => isset($pancard_details['response']['city']) ? $pancard_details['response']['city'] : null,
                                    'state' => $pancard_details['response']['state'],
                                    'country' => $pancard_details['response']['country'],
                                    'pincode' => $pancard_details['response']['pincode'],
                                    'mobile_no' => $pancard_details['response']['mobile_no'],
                                    'email' => $pancard_details['response']['email'],
                                    'is_valid' => $pancard_details['response']['isValid'],
                                    'aadhar_seeding_status' => $pancard_details['response']['aadhaarSeedingStatus'],
                                    'service_code' => isset($pancard_details['response']['serviceCode'])?$pancard_details['response']['serviceCode']:null,
                                    'message_code' => 'success',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                          }
                          return response()->json(['pancard' => $pancard, 'status_code' => 200, 'success' => true, 'message_code' => 'success']); 
                        }
                      elseif ($pancard_details['status']['statusCode'] == 200 && $pancard_details['response']['code'] == 400) {
                        $statusCode = 102;
                        $errorMessage = 'No Records found!.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                                $paninfo = DB::table('pan_info')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'client_id' => null,
                                    'status_code' => 102,
                                    'message_code' => 'failed',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                                $paninfo = DB::table('pan_info')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'client_id' => null,
                                    'status_code' => 500,
                                    'message_code' => 'failed',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                } catch (BadResponseException $e) {
                    $response = $e->getResponse();
                    $errorResponse = json_decode($response->getBody(), true);
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002') {
                        $statusCode = 102;
                        $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                                $paninfo = DB::table('pan_info')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'client_id' => null,
                                    'status_code' => 102,
                                    'message_code' => 'failed',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                                $paninfo = DB::table('pan_info')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'client_id' => null,
                                    'status_code' => 500,
                                    'message_code' => 'failed',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //UDAYM SEARCH API.
        elseif ($request->has('udyamNumber') && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            // return 'searcapi';
            $udyamNumber = $request->udyamNumber;
            // return $gstno;
            $statusCode = null;
            $corporate_gstin = null;
            $api_id = null;

            if (empty($request->udyamNumber)) {
                return response()->json([['message' => 'Udyam number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'udyamsearch')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $token = DB::table('udyamtoken')->get();
            $autorizationtoken = $token[0]->token;
            $patron_id = $token[0]->userid;
            $headers = [
                'Authorization' => $autorizationtoken,
                'Accept' => 'application/json',
            ];

            $body = [
                'essentials' => [
                    'udyamNumber' => $udyamNumber,
                ],
            ];

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $response = $client->post('https://sandbox.signzy.tech/api/v2/patrons/' . $patron_id . '/udyamregistrations', [
                        'headers' => $headers,
                        'json' => $body,
                    ]);
                    $udyamresponse = json_decode($response->getBody(), true);
                    // return $udyamresponse;
                    $udyamresponsedata = null;
                    $udyamresponseupdate = null;
                    $udyamresponsepermission = null;

                    $udyamresponsedata['essentials'] = $udyamresponse['essentials'];
                    $udyamresponsedata['id'] = $udyamresponse['id'];
                    $udyamresponsedata['patronId'] = $udyamresponse['patronId'];
                    $udyamresponsedata['result']['generalInfo'] = $udyamresponse['result']['generalInfo'];
                    $udyamresponsedata['result']['enterpriseType'] = $udyamresponse['result']['enterpriseType'];
                    $udyamresponsedata['result']['unitsDetails'] = $udyamresponse['result']['unitsDetails'];
                    $udyamresponsedata['result']['officialAddressOfEnterprise'] = $udyamresponse['result']['officialAddressOfEnterprise'];
                    $udyamresponsedata['result']['nationalIndustryClassificationCodes'] = $udyamresponse['result']['nationalIndustryClassificationCodes'];

                    //Udayam Updated Response
                    $udyamresponseupdate['data']['udyamNumber'] = $udyamresponse['essentials']['udyamNumber'];
                    $udyamresponseupdate['data']['id'] = $udyamresponse['id'];
                    $udyamresponseupdate['data']['patronId'] = $udyamresponse['patronId'];
                    $udyamresponseupdate['data']['udyamRegistrationNumber'] = $udyamresponse['result']['generalInfo']['udyamRegistrationNumber'];
                    $udyamresponseupdate['data']['nameOfEnterprise'] = $udyamresponse['result']['generalInfo']['nameOfEnterprise'];
                    $udyamresponseupdate['data']['majorActivity'] = $udyamresponse['result']['generalInfo']['majorActivity'];
                    $udyamresponseupdate['data']['organisationType'] = $udyamresponse['result']['generalInfo']['organisationType'];
                    $udyamresponseupdate['data']['socialCategory'] = $udyamresponse['result']['generalInfo']['socialCategory'];
                    $udyamresponseupdate['data']['dateOfIncorporation'] = $udyamresponse['result']['generalInfo']['dateOfIncorporation'];
                    $udyamresponseupdate['data']['dateOfCommencementOfProductionBusiness'] = $udyamresponse['result']['generalInfo']['dateOfCommencementOfProductionBusiness'];
                    $udyamresponseupdate['data']['dic'] = $udyamresponse['result']['generalInfo']['dic'];
                    $udyamresponseupdate['data']['msmedi'] = $udyamresponse['result']['generalInfo']['msmedi'];
                    $udyamresponseupdate['data']['dateOfUdyamRegistration'] = $udyamresponse['result']['generalInfo']['dateOfUdyamRegistration'];
                    $udyamresponseupdate['data']['typeOfEnterprise'] = $udyamresponse['result']['generalInfo']['typeOfEnterprise'];
                    $udyamresponseupdate['data']['enterpriseType'] = $udyamresponse['result']['enterpriseType'];
                    $udyamresponseupdate['data']['sn'] = $udyamresponse['result']['unitsDetails'][0]['sn'];
                    $udyamresponseupdate['data']['unitName'] = $udyamresponse['result']['unitsDetails'][0]['unitName'];
                    $udyamresponseupdate['data']['flat'] = $udyamresponse['result']['unitsDetails'][0]['flat'];
                    $udyamresponseupdate['data']['building'] = $udyamresponse['result']['unitsDetails'][0]['building'];
                    $udyamresponseupdate['data']['villageTown'] = $udyamresponse['result']['unitsDetails'][0]['villageTown'];
                    $udyamresponseupdate['data']['roadStreetLane'] = $udyamresponse['result']['officialAddressOfEnterprise']['roadStreetLane'];
                    $udyamresponseupdate['data']['block'] = $udyamresponse['result']['officialAddressOfEnterprise']['block'];
                    $udyamresponseupdate['data']['city'] = $udyamresponse['result']['officialAddressOfEnterprise']['city'];
                    $udyamresponseupdate['data']['state'] = $udyamresponse['result']['officialAddressOfEnterprise']['state'];
                    $udyamresponseupdate['data']['pin'] = $udyamresponse['result']['officialAddressOfEnterprise']['pin'];
                    $udyamresponseupdate['data']['district'] = $udyamresponse['result']['officialAddressOfEnterprise']['district'];
                    $udyamresponseupdate['data']['mobile'] = $udyamresponse['result']['officialAddressOfEnterprise']['mobile'];
                    $udyamresponseupdate['data']['email'] = $udyamresponse['result']['officialAddressOfEnterprise']['email'];
                    $udyamresponseupdate['data']['nic2Digit'] = $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'];
                    $udyamresponseupdate['data']['nic4Digit'] = $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'];
                    $udyamresponseupdate['data']['nic5Digit'] = $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'];
                    $udyamresponseupdate['data']['activity'] = $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['activity'];
                    $udyamresponseupdate['data']['date'] = $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['date'];

                    $udyam_data = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->where('permission', '<>', null)
                        ->where('permission', '<>', '')
                        ->orderBy('id', 'desc')
                        ->pluck('permission');

                    if (count($udyam_data) > 0 && $udyam_data != null) {
                        $udyamresponseupdate['data']['udyamsearch'] = null;
                        $udyamresponse_record = explode(',', $udyam_data[0]);
                        foreach ($udyamresponse_record as $item) {
                            $udyamresponsepermission['data'][$item] = $udyamresponseupdate['data'][$item];
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $udyamadhar = DB::table('udyamsearch')->insert([
                                'udyam_number' => $udyamresponse['essentials']['udyamNumber'],
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'udyam_id' => $udyamresponse['id'],
                                'patron_id' => $udyamresponse['patronId'],
                                'udyam_registration_number' => $udyamresponse['result']['generalInfo']['udyamRegistrationNumber'],
                                'name_of_enterprise' => $udyamresponse['result']['generalInfo']['nameOfEnterprise'],
                                'major_activity' => $udyamresponse['result']['generalInfo']['majorActivity'],
                                'organisation_type' => $udyamresponse['result']['generalInfo']['organisationType'],
                                'social_category' => $udyamresponse['result']['generalInfo']['socialCategory'],
                                'date_of_incorporation' => $udyamresponse['result']['generalInfo']['dateOfIncorporation'],
                                'dateOfCommencementOfProductionBusiness' => $udyamresponse['result']['generalInfo']['dateOfCommencementOfProductionBusiness'],
                                'dic' => $udyamresponse['result']['generalInfo']['dic'],
                                'msmedi' => $udyamresponse['result']['generalInfo']['msmedi'],
                                'dateOfUdyamRegistration' => $udyamresponse['result']['generalInfo']['dateOfUdyamRegistration'],
                                'typeOfEnterprise' => $udyamresponse['result']['generalInfo']['typeOfEnterprise'],
                                'sn' => $udyamresponse['result']['unitsDetails'][0]['sn'],
                                'unit_name' => $udyamresponse['result']['unitsDetails'][0]['unitName'],
                                'flat' => $udyamresponse['result']['unitsDetails'][0]['flat'],
                                'building' => $udyamresponse['result']['unitsDetails'][0]['building'],
                                'villageTown' => $udyamresponse['result']['unitsDetails'][0]['villageTown'],
                                'roadStreetLane' => $udyamresponse['result']['officialAddressOfEnterprise']['roadStreetLane'],
                                'block' => $udyamresponse['result']['officialAddressOfEnterprise']['block'],
                                'city' => $udyamresponse['result']['officialAddressOfEnterprise']['city'],
                                'state' => $udyamresponse['result']['officialAddressOfEnterprise']['state'],
                                'pin' => $udyamresponse['result']['officialAddressOfEnterprise']['pin'],
                                'district' => $udyamresponse['result']['officialAddressOfEnterprise']['district'],
                                'mobile' => $udyamresponse['result']['officialAddressOfEnterprise']['mobile'],
                                'email' => $udyamresponse['result']['officialAddressOfEnterprise']['email'],
                                'nic2Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'],
                                'nic4Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'],
                                'nic5Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'],
                                'activity' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['activity'],
                                'date' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['date'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $udyamadhar = DB::table('udyamsearch')->insert([
                                'udyam_number' => $udyamresponse['essentials']['udyamNumber'],
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'udyam_id' => $udyamresponse['id'],
                                'patron_id' => $udyamresponse['patronId'],
                                'udyam_registration_number' => $udyamresponse['result']['generalInfo']['udyamRegistrationNumber'],
                                'name_of_enterprise' => $udyamresponse['result']['generalInfo']['nameOfEnterprise'],
                                'major_activity' => $udyamresponse['result']['generalInfo']['majorActivity'],
                                'organisation_type' => $udyamresponse['result']['generalInfo']['organisationType'],
                                'social_category' => $udyamresponse['result']['generalInfo']['socialCategory'],
                                'date_of_incorporation' => $udyamresponse['result']['generalInfo']['dateOfIncorporation'],
                                'dateOfCommencementOfProductionBusiness' => $udyamresponse['result']['generalInfo']['dateOfCommencementOfProductionBusiness'],
                                'dic' => $udyamresponse['result']['generalInfo']['dic'],
                                'msmedi' => $udyamresponse['result']['generalInfo']['msmedi'],
                                'dateOfUdyamRegistration' => $udyamresponse['result']['generalInfo']['dateOfUdyamRegistration'],
                                'typeOfEnterprise' => $udyamresponse['result']['generalInfo']['typeOfEnterprise'],
                                'sn' => $udyamresponse['result']['unitsDetails'][0]['sn'],
                                'unit_name' => $udyamresponse['result']['unitsDetails'][0]['unitName'],
                                'flat' => $udyamresponse['result']['unitsDetails'][0]['flat'],
                                'building' => $udyamresponse['result']['unitsDetails'][0]['building'],
                                'villageTown' => $udyamresponse['result']['unitsDetails'][0]['villageTown'],
                                'roadStreetLane' => $udyamresponse['result']['officialAddressOfEnterprise']['roadStreetLane'],
                                'block' => $udyamresponse['result']['officialAddressOfEnterprise']['block'],
                                'city' => $udyamresponse['result']['officialAddressOfEnterprise']['city'],
                                'state' => $udyamresponse['result']['officialAddressOfEnterprise']['state'],
                                'pin' => $udyamresponse['result']['officialAddressOfEnterprise']['pin'],
                                'district' => $udyamresponse['result']['officialAddressOfEnterprise']['district'],
                                'mobile' => $udyamresponse['result']['officialAddressOfEnterprise']['mobile'],
                                'email' => $udyamresponse['result']['officialAddressOfEnterprise']['email'],
                                'nic2Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'],
                                'nic4Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'],
                                'nic5Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'],
                                'activity' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['activity'],
                                'date' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['date'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status' => 200, 'response' => $udyamresponsepermission]);
                    }
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        $udyamadhar = DB::table('udyamsearch')->insert([
                            'udyam_number' => $udyamresponse['essentials']['udyamNumber'],
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'udyam_id' => $udyamresponse['id'],
                            'patron_id' => $udyamresponse['patronId'],
                            'udyam_registration_number' => $udyamresponse['result']['generalInfo']['udyamRegistrationNumber'],
                            'name_of_enterprise' => $udyamresponse['result']['generalInfo']['nameOfEnterprise'],
                            'major_activity' => $udyamresponse['result']['generalInfo']['majorActivity'],
                            'organisation_type' => $udyamresponse['result']['generalInfo']['organisationType'],
                            'social_category' => $udyamresponse['result']['generalInfo']['socialCategory'],
                            'date_of_incorporation' => $udyamresponse['result']['generalInfo']['dateOfIncorporation'],
                            'dateOfCommencementOfProductionBusiness' => $udyamresponse['result']['generalInfo']['dateOfCommencementOfProductionBusiness'],
                            'dic' => $udyamresponse['result']['generalInfo']['dic'],
                            'msmedi' => $udyamresponse['result']['generalInfo']['msmedi'],
                            'dateOfUdyamRegistration' => $udyamresponse['result']['generalInfo']['dateOfUdyamRegistration'],
                            'typeOfEnterprise' => $udyamresponse['result']['generalInfo']['typeOfEnterprise'],
                            'sn' => $udyamresponse['result']['unitsDetails'][0]['sn'],
                            'unit_name' => $udyamresponse['result']['unitsDetails'][0]['unitName'],
                            'flat' => $udyamresponse['result']['unitsDetails'][0]['flat'],
                            'building' => $udyamresponse['result']['unitsDetails'][0]['building'],
                            'villageTown' => $udyamresponse['result']['unitsDetails'][0]['villageTown'],
                            'roadStreetLane' => $udyamresponse['result']['officialAddressOfEnterprise']['roadStreetLane'],
                            'block' => $udyamresponse['result']['officialAddressOfEnterprise']['block'],
                            'city' => $udyamresponse['result']['officialAddressOfEnterprise']['city'],
                            'state' => $udyamresponse['result']['officialAddressOfEnterprise']['state'],
                            'pin' => $udyamresponse['result']['officialAddressOfEnterprise']['pin'],
                            'district' => $udyamresponse['result']['officialAddressOfEnterprise']['district'],
                            'mobile' => $udyamresponse['result']['officialAddressOfEnterprise']['mobile'],
                            'email' => $udyamresponse['result']['officialAddressOfEnterprise']['email'],
                            'nic2Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'],
                            'nic4Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'],
                            'nic5Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'],
                            'activity' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['activity'],
                            'date' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['date'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $udyamadhar = DB::table('udyamsearch')->insert([
                            'udyam_number' => $udyamresponse['essentials']['udyamNumber'],
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'udyam_id' => $udyamresponse['id'],
                            'patron_id' => $udyamresponse['patronId'],
                            'udyam_registration_number' => $udyamresponse['result']['generalInfo']['udyamRegistrationNumber'],
                            'name_of_enterprise' => $udyamresponse['result']['generalInfo']['nameOfEnterprise'],
                            'major_activity' => $udyamresponse['result']['generalInfo']['majorActivity'],
                            'organisation_type' => $udyamresponse['result']['generalInfo']['organisationType'],
                            'social_category' => $udyamresponse['result']['generalInfo']['socialCategory'],
                            'date_of_incorporation' => $udyamresponse['result']['generalInfo']['dateOfIncorporation'],
                            'dateOfCommencementOfProductionBusiness' => $udyamresponse['result']['generalInfo']['dateOfCommencementOfProductionBusiness'],
                            'dic' => $udyamresponse['result']['generalInfo']['dic'],
                            'msmedi' => $udyamresponse['result']['generalInfo']['msmedi'],
                            'dateOfUdyamRegistration' => $udyamresponse['result']['generalInfo']['dateOfUdyamRegistration'],
                            'typeOfEnterprise' => $udyamresponse['result']['generalInfo']['typeOfEnterprise'],
                            'sn' => $udyamresponse['result']['unitsDetails'][0]['sn'],
                            'unit_name' => $udyamresponse['result']['unitsDetails'][0]['unitName'],
                            'flat' => $udyamresponse['result']['unitsDetails'][0]['flat'],
                            'building' => $udyamresponse['result']['unitsDetails'][0]['building'],
                            'villageTown' => $udyamresponse['result']['unitsDetails'][0]['villageTown'],
                            'roadStreetLane' => $udyamresponse['result']['officialAddressOfEnterprise']['roadStreetLane'],
                            'block' => $udyamresponse['result']['officialAddressOfEnterprise']['block'],
                            'city' => $udyamresponse['result']['officialAddressOfEnterprise']['city'],
                            'state' => $udyamresponse['result']['officialAddressOfEnterprise']['state'],
                            'pin' => $udyamresponse['result']['officialAddressOfEnterprise']['pin'],
                            'district' => $udyamresponse['result']['officialAddressOfEnterprise']['district'],
                            'mobile' => $udyamresponse['result']['officialAddressOfEnterprise']['mobile'],
                            'email' => $udyamresponse['result']['officialAddressOfEnterprise']['email'],
                            'nic2Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic2Digit'],
                            'nic4Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic4Digit'],
                            'nic5Digit' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['nic5Digit'],
                            'activity' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['activity'],
                            'date' => $udyamresponse['result']['nationalIndustryClassificationCodes'][0]['date'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json(['statusCode' => 200, 'response' => $udyamresponsedata]);
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 404 || $statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Udyam Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                  return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        } elseif ($request->has('uamnumber') && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            // return $gstno;
            $uamnumber = $request->uamnumber;
            $statusCode = null;
            $corporate_gstin = null;
            $api_id = null;

            if (empty($request->uamnumber)) {
                return response()->json([['message' => 'Udyog Adhar number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'udyamadhar')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'udyamadhar')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $token = DB::table('udyamtoken')->get();
            $autorizationtoken = $token[0]->token;
            $patron_id = $token[0]->userid;
            $headers = [
                'Authorization' => $autorizationtoken,
                'Accept' => 'application/json',
            ];

            $body = [
                'type' => 'uam',
                'essentials' => [
                    'uamNumber' => $uamnumber,
                ],
            ];

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $response = $client->post('https://sandbox.signzy.tech/api/v2/patrons/' . $patron_id . '/udyogaadhaars', [
                        'headers' => $headers,
                        'json' => $body,
                    ]);
                    $udyamresponse = json_decode($response->getBody(), true);
                    $udyamresponseupdate = null;
                    $udyamresponse_permission = null;

                    $udyamresponseupdate['data']['udyamadhar'] = null;
                    $udyamresponseupdate['data']['uamNumber'] = $udyamresponse['essentials']['uamNumber'];
                    $udyamresponseupdate['data']['id'] = $udyamresponse['id'];
                    $udyamresponseupdate['data']['patronId'] = $udyamresponse['patronId'];
                    $udyamresponseupdate['data']['type'] = $udyamresponse['type'];
                    $udyamresponseupdate['data']['nameofEnterprise'] = $udyamresponse['result']['nameofEnterprise'];
                    $udyamresponseupdate['data']['majorActivity'] = $udyamresponse['result']['majorActivity'];
                    $udyamresponseupdate['data']['socialCategory'] = $udyamresponse['result']['socialCategory'];
                    $udyamresponseupdate['data']['enterpriseType'] = $udyamresponse['result']['enterpriseType'];
                    $udyamresponseupdate['data']['dateofCommencement'] = $udyamresponse['result']['dateofCommencement'];
                    $udyamresponseupdate['data']['dicName'] = $udyamresponse['result']['dicName'];
                    $udyamresponseupdate['data']['state'] = $udyamresponse['result']['state'];
                    $udyamresponseupdate['data']['appliedDate'] = $udyamresponse['result']['appliedDate'];
                    $udyamresponseupdate['data']['modifiedDate'] = $udyamresponse['result']['modifiedDate'];
                    $udyamresponseupdate['data']['validTillDate'] = $udyamresponse['result']['validTillDate'];
                    $udyamresponseupdate['data']['nic2Digit'] = $udyamresponse['result']['nic2Digit'];
                    $udyamresponseupdate['data']['nic4Digit'] = $udyamresponse['result']['nic4Digit'];
                    $udyamresponseupdate['data']['nic5DigitCode'] = $udyamresponse['result']['nic5DigitCode'];
                    $udyamresponseupdate['data']['status'] = $udyamresponse['result']['status'];

                    $udyamaadhar_data = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->where('permission', '<>', null)
                        ->where('permission', '<>', '')
                        ->orderBy('id', 'desc')
                        ->pluck('permission');
                    if (count($udyamaadhar_data) > 0 && $udyamaadhar_data != null) {
                        $udyamaadhar_data_record = explode(',', $udyamaadhar_data[0]);
                        foreach ($udyamaadhar_data_record as $item) {
                            $udyamresponse_permission['data'][$item] = $udyamresponseupdate['data'][$item];
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $udyamadhar = DB::table('udyogaadhaars')->insert([
                                'uam_number' => $udyamresponse['essentials']['uamNumber'],
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'uam_id' => $udyamresponse['id'],
                                'patronId' => $udyamresponse['patronId'],
                                'type' => $udyamresponse['type'],
                                'nameofEnterprise' => $udyamresponse['result']['nameofEnterprise'],
                                'majorActivity' => $udyamresponse['result']['majorActivity'],
                                'socialCategory' => $udyamresponse['result']['socialCategory'],
                                'enterpriseType' => $udyamresponse['result']['enterpriseType'],
                                'dateofCommencement' => $udyamresponse['result']['dateofCommencement'],
                                'dicName' => $udyamresponse['result']['dicName'],
                                'state' => $udyamresponse['result']['state'],
                                'appliedDate' => $udyamresponse['result']['appliedDate'],
                                'modifiedDate' => $udyamresponse['result']['modifiedDate'],
                                'validTillDate' => $udyamresponse['result']['validTillDate'],
                                'nic2Digit' => $udyamresponse['result']['nic2Digit'],
                                'nic4Digit' => $udyamresponse['result']['nic4Digit'],
                                'nic5DigitCode' => $udyamresponse['result']['nic5DigitCode'],
                                'status' => $udyamresponse['result']['status'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $udyamadhar = DB::table('udyogaadhaars')->insert([
                                'uam_number' => $udyamresponse['essentials']['uamNumber'],
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'uam_id' => $udyamresponse['id'],
                                'patronId' => $udyamresponse['patronId'],
                                'type' => $udyamresponse['type'],
                                'nameofEnterprise' => $udyamresponse['result']['nameofEnterprise'],
                                'majorActivity' => $udyamresponse['result']['majorActivity'],
                                'socialCategory' => $udyamresponse['result']['socialCategory'],
                                'enterpriseType' => $udyamresponse['result']['enterpriseType'],
                                'dateofCommencement' => $udyamresponse['result']['dateofCommencement'],
                                'dicName' => $udyamresponse['result']['dicName'],
                                'state' => $udyamresponse['result']['state'],
                                'appliedDate' => $udyamresponse['result']['appliedDate'],
                                'modifiedDate' => $udyamresponse['result']['modifiedDate'],
                                'validTillDate' => $udyamresponse['result']['validTillDate'],
                                'nic2Digit' => $udyamresponse['result']['nic2Digit'],
                                'nic4Digit' => $udyamresponse['result']['nic4Digit'],
                                'nic5DigitCode' => $udyamresponse['result']['nic5DigitCode'],
                                'status' => $udyamresponse['result']['status'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => 200, 'response' => $udyamresponse_permission]);
                    }
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        $udyamadhar = DB::table('udyogaadhaars')->insert([
                            'uam_number' => $udyamresponse['essentials']['uamNumber'],
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'uam_id' => $udyamresponse['id'],
                            'patronId' => $udyamresponse['patronId'],
                            'type' => $udyamresponse['type'],
                            'nameofEnterprise' => $udyamresponse['result']['nameofEnterprise'],
                            'majorActivity' => $udyamresponse['result']['majorActivity'],
                            'socialCategory' => $udyamresponse['result']['socialCategory'],
                            'enterpriseType' => $udyamresponse['result']['enterpriseType'],
                            'dateofCommencement' => $udyamresponse['result']['dateofCommencement'],
                            'dicName' => $udyamresponse['result']['dicName'],
                            'state' => $udyamresponse['result']['state'],
                            'appliedDate' => $udyamresponse['result']['appliedDate'],
                            'modifiedDate' => $udyamresponse['result']['modifiedDate'],
                            'validTillDate' => $udyamresponse['result']['validTillDate'],
                            'nic2Digit' => $udyamresponse['result']['nic2Digit'],
                            'nic4Digit' => $udyamresponse['result']['nic4Digit'],
                            'nic5DigitCode' => $udyamresponse['result']['nic5DigitCode'],
                            'status' => $udyamresponse['result']['status'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $udyamadhar = DB::table('udyogaadhaars')->insert([
                            'uam_number' => $udyamresponse['essentials']['uamNumber'],
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'uam_id' => $udyamresponse['id'],
                            'patronId' => $udyamresponse['patronId'],
                            'type' => $udyamresponse['type'],
                            'nameofEnterprise' => $udyamresponse['result']['nameofEnterprise'],
                            'majorActivity' => $udyamresponse['result']['majorActivity'],
                            'socialCategory' => $udyamresponse['result']['socialCategory'],
                            'enterpriseType' => $udyamresponse['result']['enterpriseType'],
                            'dateofCommencement' => $udyamresponse['result']['dateofCommencement'],
                            'dicName' => $udyamresponse['result']['dicName'],
                            'state' => $udyamresponse['result']['state'],
                            'appliedDate' => $udyamresponse['result']['appliedDate'],
                            'modifiedDate' => $udyamresponse['result']['modifiedDate'],
                            'validTillDate' => $udyamresponse['result']['validTillDate'],
                            'nic2Digit' => $udyamresponse['result']['nic2Digit'],
                            'nic4Digit' => $udyamresponse['result']['nic4Digit'],
                            'nic5DigitCode' => $udyamresponse['result']['nic5DigitCode'],
                            'status' => $udyamresponse['result']['status'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json(['statusCode' => 200, 'response' => $udyamresponse]);
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                         $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 400 || $statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Udyog adhar Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //Bank IFSC
        elseif ($request->has('ifsc') || ($request->has('account_number') && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number))) {
            $api_id = null;
            if (isset($request->account_number) && !isset($request->ifsc)) {
                return response()->json([['message' => 'IFSC code is required', 'statusCode' => '404']]);
            }
            if (!isset($request->account_number) && !isset($request->ifsc)) {
                return response()->json([['message' => 'IFSC code is required and Account number is required', 'statusCode' => '404']]);
            }
            if (!isset($request->account_number) && isset($request->ifsc)) {
                if ($request->ifsc != '') {
                    $statusCode = null;
                    $bank_verification_api = null;

                    if (empty($request->ifsc)) {
                        return response()->json([['message' => 'IFSC code is required', 'statusCode' => '404']]);
                    }

                    if (!$request->headers->has('AccessToken')) {
                        return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                    }

                    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                    if ($verifyAccessToken == false) {
                        return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                    }

                    $user = User::where('access_token', $request->header('AccessToken'))->first();
                    if ($user->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_ifsc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    } elseif ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_ifsc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    $client = new Client();
                    $headers = [
                        // 'Authorization' => $this->token,
                        'API-KEY' => $this->api_club_key,
                        'Referer' => $this->site_url,
                    ];

                    $body = [
                        'ifsc' => $request->ifsc,
                    ];

                    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    if ($updateHitCount || $user->role_id == 0) {
                        if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        try {
                            $res = $client->post($this->api_club . '/v1/bank_info', ['headers' => $headers, 'json' => $body]);
                            // $res = $client->post($this->base_url.'/bank-verification/find-ifsc', ['headers' => $headers, 'json' => $body]);
                            $bank_verification_api = json_decode($res->getBody(), true);
                            $bank_verification_api_permission = null;
                            $bank_verification_api_response = null;
                            if (isset($bank_verification_api['code']) && $bank_verification_api['code'] == 200) {
                                $bank_verification_api_response['data']['status'] = 'success';
                                $bank_verification_api_response['data']['request_id'] = $bank_verification_api['response']['request_id'];
                                $bank_verification_api_response['data']['ifsc'] = $bank_verification_api['response']['ifsc'];
                                $bank_verification_api_response['data']['name'] = $bank_verification_api['response']['name'];
                                $bank_verification_api_response['data']['code'] = $bank_verification_api['response']['code'];
                                $bank_verification_api_response['data']['branch'] = $bank_verification_api['response']['branch'];
                                $bank_verification_api_response['data']['micr'] = $bank_verification_api['response']['micr'];
                                $bank_verification_api_response['data']['address'] = $bank_verification_api['response']['address'];
                                $bank_verification_api_response['data']['city'] = $bank_verification_api['response']['city'];
                                $bank_verification_api_response['data']['state'] = $bank_verification_api['response']['state'];
                                $bank_verification_api_response['data']['contact'] = $bank_verification_api['response']['contact'];
                                $bank_verification_api_response['data']['district'] = $bank_verification_api['response']['district'];
                                $bank_verification_api_response['data']['upi'] = $bank_verification_api['response']['upi'];
                                $bank_verification_api_response['data']['imps'] = $bank_verification_api['response']['imps'];
                                $bank_verification_api_response['data']['neft'] = $bank_verification_api['response']['neft'];
                                $bank_verification_api_response['data']['rtgs'] = $bank_verification_api['response']['rtgs'];
                                $bank_verification_api_response['data']['logo'] = $bank_verification_api['response']['logo'];
                                $bank_verification_data = UserSchemeMaster::where('user_id', $user->id)
                                    ->where('api_id', $api_id)
                                    ->where('permission', '<>', null)
                                    ->where('permission', '<>', '')
                                    ->orderBy('id', 'desc')
                                    ->pluck('permission');
                                if (count($bank_verification_data) > 0 && $bank_verification_data != null) {
                                    $bank_verification_data_record = explode(',', $bank_verification_data[0]);
                                    $bank_verification_api_response['data']['bank_ifsc'] = null;

                                    foreach ($bank_verification_data_record as $item) {
                                        $bank_verification_api_permission['data'][$item] = $bank_verification_api_response['data'][$item];
                                    }
                                    if ($user->role_id == 1) {
                                        if ($apiamster) {
                                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                        }
                                        $ifscvalidation = DB::table('bank_ifsc_details')->insert([
                                            'user_id' => $user->id,
                                            'api_id' => $api_id,
                                            // "client_id"=> $bank_verification_api['data']['client_id'],
                                            'ifsc' => $bank_verification_api['response']['ifsc'],
                                            'bank_name' => $bank_verification_api['response']['name'],
                                            'branch' => $bank_verification_api['response']['branch'],
                                            'address' => $bank_verification_api['response']['address'],
                                            'contact' => $bank_verification_api['response']['contact'],
                                            'state' => $bank_verification_api['response']['state'],
                                            'city' => $bank_verification_api['response']['city'],
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now(),
                                        ]);
                                    } elseif ($user->role_id == 0) {
                                        $ifscvalidation = DB::table('bank_ifsc_details')->insert([
                                            'user_id' => $user->id,
                                            'api_id' => $api_id,
                                            // "client_id"=> $bank_verification_api['data']['client_id'],
                                            'ifsc' => $bank_verification_api['response']['ifsc'],
                                            'bank_name' => $bank_verification_api['response']['name'],
                                            'branch' => $bank_verification_api['response']['branch'],
                                            'address' => $bank_verification_api['response']['address'],
                                            'contact' => $bank_verification_api['response']['contact'],
                                            'state' => $bank_verification_api['response']['state'],
                                            'city' => $bank_verification_api['response']['city'],
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now(),
                                        ]);
                                    }
                                    return response()->json(['bank_ifsc_verification' => $bank_verification_api_permission, 'statusCode' => 200]);
                                }
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                    $ifscvalidation = DB::table('bank_ifsc_details')->insert([
                                        'user_id' => $user->id,
                                        'api_id' => $api_id,
                                        // "client_id"=> $bank_verification_api['data']['client_id'],
                                        'ifsc' => $bank_verification_api['response']['ifsc'],
                                        'bank_name' => $bank_verification_api['response']['name'],
                                        'branch' => $bank_verification_api['response']['branch'],
                                        'address' => $bank_verification_api['response']['address'],
                                        'contact' => $bank_verification_api['response']['contact'],
                                        'state' => $bank_verification_api['response']['state'],
                                        'city' => $bank_verification_api['response']['city'],
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now(),
                                    ]);
                                } elseif ($user->role_id == 0) {
                                    $ifscvalidation = DB::table('bank_ifsc_details')->insert([
                                        'user_id' => $user->id,
                                        'api_id' => $api_id,
                                        // "client_id"=> $bank_verification_api['data']['client_id'],
                                        'ifsc' => $bank_verification_api['response']['ifsc'],
                                        'bank_name' => $bank_verification_api['response']['name'],
                                        'branch' => $bank_verification_api['response']['branch'],
                                        'address' => $bank_verification_api['response']['address'],
                                        'contact' => $bank_verification_api['response']['contact'],
                                        'state' => $bank_verification_api['response']['state'],
                                        'city' => $bank_verification_api['response']['city'],
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now(),
                                    ]);
                                }
                            } elseif (isset($bank_verification_api['code']) && $bank_verification_api['code'] == 404) {
                                $statusCode = 102;
                                $errorMessage = ' Please enter correct IFSC Number.';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                                    }
                                }
                                return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                            } else {
                                $statusCode = 500;
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                }
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                                if ($user->role_id == 1) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            } elseif ($statusCode == 404) {
                                $statusCode = 102;
                                $errorMessage = 'Verification Failed. Please enter correct IFSC Number.';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                                    }
                                }
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                                    }
                                }
                            }
                            $ifscvalidation = DB::table('bank_ifsc_details')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                // "client_id"=> $bank_verification_api['data']['client_id'],
                                'ifsc' => $request->ifsc,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        }
                    }
                    else{
                        return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
                    }
                    } else {
                        return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                    }

                    return response()->json([['bank_ifsc_verification' => $bank_verification_api, 'statusCode' => '200']]);
                }
            }
            if (isset($request->account_number) && isset($request->ifsc)) {
                if ($request->ifsc != '' && $request->account_number != '') {
                    $statusCode = null;
                    $bank_verification = null;

                    if (empty($request->account_number)) {
                        return response()->json([['message' => 'Account number is required', 'statusCode' => '404']]);
                    }
                    if (empty($request->ifsc)) {
                        return response()->json([['message' => 'IFSC code is required', 'statusCode' => '404']]);
                    }
                    if (!$request->headers->has('AccessToken')) {
                        return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                    }
                    $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                    if ($verifyAccessToken == false) {
                        return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                    }

                    $user = User::where('access_token', $request->header('AccessToken'))->first();
                    if ($user->role_id == 1) {
                        $apiamster = ApiMaster::where('api_slug', 'bank_ifsc')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }

                    $client = new Client();
                    $headers = [
                        'Authorization' => $this->token,
                        'Accept' => 'application/json',
                    ];

                    $body = [
                        'id_number' => $request->account_number,
                        'ifsc' => $request->ifsc,
                    ];
                    $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    if ($updateHitCount || $user->role_id == 0) {
                        if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {

                        try {
                            $res = $client->post($this->base_url . '/bank-verification', ['headers' => $headers, 'json' => $body]);
                            $bank_verification = json_decode($res->getBody(), true);
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                        } catch (BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            if ($statusCode == 500) {
                                $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                                if ($user->role_id == 1) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            } elseif ($statusCode == 422) {
                                $statusCode = 102;
                                $errorMessage = 'Verification Failed. Please enter valid details.';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                                    }
                                }
                            } else {
                                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                                    }
                                }
                            }
                            return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                        }
                    }
                    else{
                        return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
                    }
                    } else {
                        return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                    }

                    return response()->json([['bank_verification' => $bank_verification, 'statusCode' => '200']]);
                }
            }
        }
        //UPI Validation.
        elseif ($request->has('upi_id') || $request->has('name') || ($request->has('order_id') && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number))) {
            //upi validation
            $statusCode = null;
            $api_id = null;
            if (empty($request->upi_id)) {
                return response()->json([['message' => 'UPI ID is required', 'statusCode' => '404']]);
            }
            if (empty($request->name)) {
                return response()->json([['message' => 'Name is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $client = new Client();
            $headers = [
                'API-KEY' => $this->api_club_key,
                'Referer' => $this->site_url,
                'Accept' => 'application/json',
            ];

            // $body =  [
            //     'name' => $request->name,
            //     'upi_id' => $request->upi_id,
            //     'order_id' => $request->order_id,
            //     'is_test' => $request->is_test,
            // ];
            // return $body;
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'upi')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'upi')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->request('POST', 'https://api.apiclub.in/api/v2/validate/upi', [
                        'body' => '{"is_test":"TRUE", "name":"' . $request->name . '","upi_id":"' . $request->upi_id . '", "order_id":"' . $request->order_id . '"}',
                        'headers' => [
                            'API-KEY' => $this->api_club_key,
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'Referer' => $this->site_url,
                        ],
                    ]);
                    // $res = $client->post($this->base_url.'/passport/passport/create', ['headers' => $headers, 'json' => $body]);
                    // $res = $client->post($this->api_club.'/v2/validate/upi', ['headers' => $headers, 'json' => $body]);
                    $upidetails = json_decode($res->getBody(), true);

                    $upidetails_response = null;
                    $upidetails_permission = null;
                    if (isset($upidetails['code']) && $upidetails['code'] == 200) {
                        $upidetails_response['data']['orderId'] = $upidetails['response']['orderId'];
                        $upidetails_response['data']['account_details'] = $upidetails['response']['account_details'];
                        $upidetails_response['data']['mode'] = $upidetails['response']['mode'];
                        $upidetails_response['data']['utr'] = $upidetails['response']['utr'];
                        $upidetails_response['data']['amount'] = $upidetails['response']['amount'];
                        $upidetails_response['data']['commission'] = $upidetails['response']['commission'];
                        $upidetails_response['data']['charge'] = $upidetails['response']['charge'];
                        $upidetails_response['data']['tax'] = $upidetails['response']['tax'];
                        $upidetails_response['data']['created_at'] = $upidetails['response']['created_at'];
                        $upidetails_response_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');
                        if (count($upidetails_response_data) > 0 && $upidetails_response_data != null) {
                            $upidetails_response_data_record = explode(',', $upidetails_response_data[0]);
                            $upidetails_response['data']['upi'] = null;
                            foreach ($upidetails_response_data_record as $item) {
                                $upidetails_permission['data'][$item] = $upidetails_response['data'][$item];
                            }
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                                $upidetailsData = DB::table('upi_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'orderId' => $upidetails['response']['orderId'],
                                    'account_status' => $upidetails['response']['account_details']['account_status'],
                                    'beneficiary_name' => $upidetails['response']['account_details']['beneficiary_name'],
                                    'beneficiary_vpa' => $upidetails['response']['account_details']['beneficiary_vpa'],
                                    'mode' => $upidetails['response']['mode'],
                                    'utr' => $upidetails['response']['utr'],
                                    'amount' => $upidetails['response']['amount'],
                                    'commission' => $upidetails['response']['commission'],
                                    'charge' => $upidetails['response']['charge'],
                                    'tax' => $upidetails['response']['tax'],
                                    'createdAt' => $upidetails['response']['created_at'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            } elseif ($user->role_id == 0) {
                                $upidetailsData = DB::table('upi_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'orderId' => $upidetails['response']['orderId'],
                                    'account_status' => $upidetails['response']['account_details']['account_status'],
                                    'beneficiary_name' => $upidetails['response']['account_details']['beneficiary_name'],
                                    'beneficiary_vpa' => $upidetails['response']['account_details']['beneficiary_vpa'],
                                    'mode' => $upidetails['response']['mode'],
                                    'utr' => $upidetails['response']['utr'],
                                    'amount' => $upidetails['response']['amount'],
                                    'commission' => $upidetails['response']['commission'],
                                    'charge' => $upidetails['response']['charge'],
                                    'tax' => $upidetails['response']['tax'],
                                    'createdAt' => $upidetails['response']['created_at'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['upidetails' => $upidetails_permission, 'statusCode' => 200]);
                        }

                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $upidetailsData = DB::table('upi_validation')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'orderId' => $upidetails['response']['orderId'],
                                'account_status' => $upidetails['response']['account_details']['account_status'],
                                'beneficiary_name' => $upidetails['response']['account_details']['beneficiary_name'],
                                'beneficiary_vpa' => $upidetails['response']['account_details']['beneficiary_vpa'],
                                'mode' => $upidetails['response']['mode'],
                                'utr' => $upidetails['response']['utr'],
                                'amount' => $upidetails['response']['amount'],
                                'commission' => $upidetails['response']['commission'],
                                'charge' => $upidetails['response']['charge'],
                                'tax' => $upidetails['response']['tax'],
                                'createdAt' => $upidetails['response']['created_at'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        } elseif ($user->role_id == 0) {
                            $upidetailsData = DB::table('upi_validation')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'orderId' => $upidetails['response']['orderId'],
                                'account_status' => $upidetails['response']['account_details']['account_status'],
                                'beneficiary_name' => $upidetails['response']['account_details']['beneficiary_name'],
                                'beneficiary_vpa' => $upidetails['response']['account_details']['beneficiary_vpa'],
                                'mode' => $upidetails['response']['mode'],
                                'utr' => $upidetails['response']['utr'],
                                'amount' => $upidetails['response']['amount'],
                                'commission' => $upidetails['response']['commission'],
                                'charge' => $upidetails['response']['charge'],
                                'tax' => $upidetails['response']['tax'],
                                'createdAt' => $upidetails['response']['created_at'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['upidetails' => $upidetails, 'statusCode' => '200']);
                    } elseif (isset($upidetails['code']) && $upidetails['code'] == 404) {
                        $statusCode = 102;
                        $errorMessage = 'Please enter valid details.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        $statusCode = 500;
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 404) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter valid details.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
             else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
             }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //corporate_gstin
        elseif ($request->has('gstin') && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $corporate_gstin = null;
            $api_id = null;

            if (empty($request->gstin)) {
                return response()->json([['message' => 'GSTIN number is required', 'statusCode' => '404']]);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'gstin')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'gstin')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $headers = [
                // 'Authorization' => $this->token,
                'API-KEY' => $this->api_club_key,
                'Referer' => $this->site_url,
                'Accept' => 'application/json',
            ];

            $body = [
                'gstin' => $request->gstin,
            ];

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->post($this->api_club . '/v1/gstin_info', ['headers' => $headers, 'json' => $body]);
                    $corporate_gstin = json_decode($res->getBody(), true);
                    $corporate_gstin_response = null;
                    $corporate_gstin_permission = null;
                    if (isset($corporate_gstin['code']) && $corporate_gstin['code'] == 200) {
                        $corporate_gstin_response['data']['stateJurisdiction'] = null;
                        $corporate_gstin_response['data']['stateJurisdictionCode'] = null;
                        $corporate_gstin_response['data']['additionalPlaceOfBusinessFields'] = null;
                        $corporate_gstin_response['data']['dateOfCancellation'] = null;
                        $corporate_gstin_response['data']['natureOfBusinessActivity'] = null;
                        $corporate_gstin_response['data']['dateOfRegistration'] = null;
                        $corporate_gstin_response['data']['constitutionOfBusiness'] = null;
                        $corporate_gstin_response['data']['principalPlaceOfBusinessFields'] = null;
                        $corporate_gstin_response['data']['gstnStatus'] = null;
                        $corporate_gstin_response['data']['centerJurisdictionCode'] = null;
                        $corporate_gstin_response['data']['centerJurisdiction'] = null;
                        $corporate_gstin_response['data']['eInvoiceStatus'] = null;
                        $corporate_gstin_response['data']['gstin'] = null;
                        $corporate_gstin_response['data']['request_id'] = $corporate_gstin['response']['request_id'];
                        $corporate_gstin_response['data']['gstIdentificationNumber'] = $corporate_gstin['response']['gstin'];
                        $corporate_gstin_response['data']['legalNameOfBusiness'] = $corporate_gstin['response']['legal_name'];
                        $corporate_gstin_response['data']['tradeName'] = $corporate_gstin['response']['trade_name'];
                        $corporate_gstin_response['data']['taxpayerType'] = $corporate_gstin['response']['taxpayer_type'];
                        $corporate_gstin_response['data']['reg_date'] = $corporate_gstin['response']['reg_date'];
                        $corporate_gstin_response['data']['state_code'] = $corporate_gstin['response']['state_code'];
                        $corporate_gstin_response['data']['nature'] = $corporate_gstin['response']['nature'];
                        $corporate_gstin_response['data']['jurisdiction'] = $corporate_gstin['response']['jurisdiction'];
                        $corporate_gstin_response['data']['business_type'] = $corporate_gstin['response']['business_type'];
                        $corporate_gstin_response['data']['lastUpdatedDate'] = $corporate_gstin['response']['last_update'];
                        $corporate_gstin_response['data']['address'] = $corporate_gstin['response']['address'];
                        $corporate_gstin_response['data']['add_address'] = $corporate_gstin['response']['add_address'];
                        $corporate_gstin_response['data']['status'] = $corporate_gstin['response']['status'];
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }

                            $gstinData = DB::table('gstin')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'request_id' => $corporate_gstin['response']['request_id'],
                                'gstin_number' => $corporate_gstin['response']['gstin'],
                                'legal_name' => $corporate_gstin['response']['legal_name'],
                                'trade_name' => $corporate_gstin['response']['trade_name'],
                                'taxpayer_type' => $corporate_gstin['response']['taxpayer_type'],
                                'reg_date' => $corporate_gstin['response']['reg_date'],
                                'state_code' => $corporate_gstin['response']['state_code'],
                                'nature' => $corporate_gstin['response']['nature'],
                                'jurisdiction' => $corporate_gstin['response']['jurisdiction'],
                                'business_type' => $corporate_gstin['response']['business_type'],
                                'last_update' => $corporate_gstin['response']['last_update'],
                                'address_one' => $corporate_gstin['response']['address']['addr1'],
                                'address_two' => $corporate_gstin['response']['address']['addr2'],
                                'locality' => $corporate_gstin['response']['address']['locality'],
                                'pincode' => $corporate_gstin['response']['address']['pin'],
                                'state' => $corporate_gstin['response']['address']['state'],
                                'latitude' => $corporate_gstin['response']['address']['lat'],
                                'longitude' => $corporate_gstin['response']['address']['long'],
                                'city' => $corporate_gstin['response']['address']['city'],
                                'district' => $corporate_gstin['response']['address']['district'],
                                'status' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }

                        return response()->json([['corporate_gstin' => $corporate_gstin, 'statusCode' => '200']]);
                    } elseif (isset($corporate_gstin['code']) && $corporate_gstin['code'] == 404) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct GSTIN Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        $statusCode = 500;
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode == 500) {
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    } elseif ($statusCode == 404 || $statusCode == 422) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct GSTIN Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //telecom api
        elseif ($request->has('client_ref_num') && $request->has('mobile_number') && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $telecomdetails = null;
            $api_id = null;

            if (empty($request->client_ref_num)) {
                return response()->json([['message' => 'client ref number is required', 'statusCode' => '404']]);
            }
            if (empty($request->mobile_number)) {
                return response()->json([['message' => 'mobile number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'telecom')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'telecom')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $client = new Client();
            $headers = [
                'Authorization' => 'Basic Mzk1MTY2MjY6RDkxa012a3FkZXUyUGhOZ25CMUZCclgxV2I0TEVnbzA=',
                'Accept' => 'application/json',
            ];

            $body = [
                'client_ref_num' => $request->client_ref_num,
                'mobile_number' => $request->mobile_number,
            ];

            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->post('https://svcdemo.digitap.work/validation/mobile/v1/mobile-lookup', ['headers' => $headers, 'json' => $body]);
                    $telecom_details = json_decode($res->getBody(), true);
                    $telecom_detail_response = null;
                    $telecom_detail_permission = null;
                    $telecom_detail_response['data']['client_ref_num'] = $telecom_details['client_ref_num'];
                    $telecom_detail_response['data']['request_id'] = $telecom_details['request_id'];
                    $telecom_detail_response['data']['result_code'] = $telecom_details['result_code'];
                    $telecom_detail_response['data']['message'] = $telecom_details['message'];
                    $telecom_detail_response['data']['name'] = $telecom_details['result']['customer_details']['name'];
                    $telecom_detail_response['data']['alternate_number'] = $telecom_details['result']['customer_details']['alternate_number'];
                    $telecom_detail_response['data']['is_valid'] = $telecom_details['result']['is_valid'];
                    $telecom_detail_response['data']['subscriber_status'] = $telecom_details['result']['subscriber_status'];
                    $telecom_detail_response['data']['connection_status'] = $telecom_details['result']['connection_status'];
                    $telecom_detail_response['data']['connection_type'] = $telecom_details['result']['connection_type'];
                    $telecom_detail_response['data']['msisdn'] = $telecom_details['result']['msisdn'];
                    $telecom_detail_response['data']['current_service_provider'] = $telecom_details['result']['current_service_provider'];
                    $telecom_detail_response['data']['original_service_provider'] = $telecom_details['result']['original_service_provider'];
                    $telecom_detail_response['data']['roaming_service_provider'] = $telecom_details['result']['roaming_service_provider'];
                    $telecom_detail_response['data']['is_roaming'] = $telecom_details['result']['is_roaming'];
                    $telecom_detail_response['data']['is_ported'] = $telecom_details['result']['is_ported'];
                    $telecom_detail_response['data']['last_ported_date'] = $telecom_details['result']['last_ported_date'];
                    $telecom_detail_data = UserSchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->where('permission', '<>', null)
                        ->where('permission', '<>', '')
                        ->orderBy('id', 'desc')
                        ->pluck('permission');
                    if (count($telecom_detail_data) > 0 && $telecom_detail_data != null) {
                        $telecom_detail_record = explode(',', $telecom_detail_data[0]);
                        $telecom_detail_response['data']['telecom'] = null;
                        foreach ($telecom_detail_record as $item) {
                            $telecom_detail_permission['data'][$item] = $telecom_detail_response['data'][$item];
                        }
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                            $telecom_data = DB::table('telecom')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'statusCode' => $telecom_details['http_response_code'],
                                'client_ref_num' => $telecom_details['client_ref_num'],
                                'request_id' => $telecom_details['request_id'],
                                'result_code' => $telecom_details['result_code'],
                                'message' => $telecom_details['message'],
                                'customer_name' => $telecom_details['result']['customer_details']['name'],
                                'alternate_number' => $telecom_details['result']['customer_details']['alternate_number'],
                                'is_valid' => $telecom_details['result']['is_valid'],
                                'subscriber_status' => $telecom_details['result']['subscriber_status'],
                                'connection_status_code' => $telecom_details['result']['connection_status']['status_code'],
                                'error_code_id' => $telecom_details['result']['connection_status']['error_code_id'],
                                'connection_type' => $telecom_details['result']['connection_type'],
                                'msisdn_country_code' => $telecom_details['result']['msisdn']['msisdn_country_code'],
                                'msisdn' => $telecom_details['result']['msisdn']['msisdn'],
                                'type' => $telecom_details['result']['msisdn']['type'],
                                'mnc' => $telecom_details['result']['msisdn']['mnc'],
                                'imsi' => $telecom_details['result']['msisdn']['imsi'],
                                'mcc' => $telecom_details['result']['msisdn']['mcc'],
                                'mcc_mnc' => $telecom_details['result']['msisdn']['mcc_mnc'],
                                'current_network_prefix' => $telecom_details['result']['current_service_provider']['network_prefix'],
                                'current_network_name' => $telecom_details['result']['current_service_provider']['network_name'],
                                'current_network_region' => $telecom_details['result']['current_service_provider']['network_region'],
                                'current_mcc' => $telecom_details['result']['current_service_provider']['mcc'],
                                'current_mnc' => $telecom_details['result']['current_service_provider']['mnc'],
                                'current_country_prefix' => $telecom_details['result']['current_service_provider']['country_prefix'],
                                'current_country_code' => $telecom_details['result']['current_service_provider']['country_code'],
                                'current_country_name' => $telecom_details['result']['current_service_provider']['country_name'],
                                'original_network_prefix' => $telecom_details['result']['original_service_provider']['network_prefix'],
                                'original_network_name' => $telecom_details['result']['original_service_provider']['network_name'],
                                'original_network_region' => $telecom_details['result']['original_service_provider']['network_region'],
                                'original_mcc' => $telecom_details['result']['original_service_provider']['mcc'],
                                'original_mnc' => $telecom_details['result']['original_service_provider']['mnc'],
                                'original_country_prefix' => $telecom_details['result']['original_service_provider']['country_prefix'],
                                'original_country_code' => $telecom_details['result']['original_service_provider']['country_code'],
                                'original_country_name' => $telecom_details['result']['original_service_provider']['country_name'],
                                'is_roaming' => $telecom_details['result']['is_roaming'],
                                'roaming_network_prefix' => $telecom_details['result']['roaming_service_provider']['network_prefix'],
                                'roaming_network_name' => $telecom_details['result']['roaming_service_provider']['network_name'],
                                'roaming_network_region' => $telecom_details['result']['roaming_service_provider']['network_region'],
                                'roaming_mcc' => $telecom_details['result']['roaming_service_provider']['mcc'],
                                'roaming_mnc' => $telecom_details['result']['roaming_service_provider']['mnc'],
                                'roaming_country_prefix' => $telecom_details['result']['roaming_service_provider']['country_prefix'],
                                'roaming_country_code' => $telecom_details['result']['roaming_service_provider']['country_code'],
                                'roaming_country_name' => $telecom_details['result']['roaming_service_provider']['country_name'],
                                'is_ported' => $telecom_details['result']['is_ported'],
                                'last_ported_date' => $telecom_details['result']['last_ported_date'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['telecom_details' => $telecom_detail_permission, 'statusCode' => 200]);
                    }
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        $telecom_data = DB::table('telecom')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'statusCode' => $telecom_details['http_response_code'],
                            'client_ref_num' => $telecom_details['client_ref_num'],
                            'request_id' => $telecom_details['request_id'],
                            'result_code' => $telecom_details['result_code'],
                            'message' => $telecom_details['message'],
                            'customer_name' => $telecom_details['result']['customer_details']['name'],
                            'alternate_number' => $telecom_details['result']['customer_details']['alternate_number'],
                            'is_valid' => $telecom_details['result']['is_valid'],
                            'subscriber_status' => $telecom_details['result']['subscriber_status'],
                            'connection_status_code' => $telecom_details['result']['connection_status']['status_code'],
                            'error_code_id' => $telecom_details['result']['connection_status']['error_code_id'],
                            'connection_type' => $telecom_details['result']['connection_type'],
                            'msisdn_country_code' => $telecom_details['result']['msisdn']['msisdn_country_code'],
                            'msisdn' => $telecom_details['result']['msisdn']['msisdn'],
                            'type' => $telecom_details['result']['msisdn']['type'],
                            'mnc' => $telecom_details['result']['msisdn']['mnc'],
                            'imsi' => $telecom_details['result']['msisdn']['imsi'],
                            'mcc' => $telecom_details['result']['msisdn']['mcc'],
                            'mcc_mnc' => $telecom_details['result']['msisdn']['mcc_mnc'],
                            'current_network_prefix' => $telecom_details['result']['current_service_provider']['network_prefix'],
                            'current_network_name' => $telecom_details['result']['current_service_provider']['network_name'],
                            'current_network_region' => $telecom_details['result']['current_service_provider']['network_region'],
                            'current_mcc' => $telecom_details['result']['current_service_provider']['mcc'],
                            'current_mnc' => $telecom_details['result']['current_service_provider']['mnc'],
                            'current_country_prefix' => $telecom_details['result']['current_service_provider']['country_prefix'],
                            'current_country_code' => $telecom_details['result']['current_service_provider']['country_code'],
                            'current_country_name' => $telecom_details['result']['current_service_provider']['country_name'],
                            'original_network_prefix' => $telecom_details['result']['original_service_provider']['network_prefix'],
                            'original_network_name' => $telecom_details['result']['original_service_provider']['network_name'],
                            'original_network_region' => $telecom_details['result']['original_service_provider']['network_region'],
                            'original_mcc' => $telecom_details['result']['original_service_provider']['mcc'],
                            'original_mnc' => $telecom_details['result']['original_service_provider']['mnc'],
                            'original_country_prefix' => $telecom_details['result']['original_service_provider']['country_prefix'],
                            'original_country_code' => $telecom_details['result']['original_service_provider']['country_code'],
                            'original_country_name' => $telecom_details['result']['original_service_provider']['country_name'],
                            'is_roaming' => $telecom_details['result']['is_roaming'],
                            'roaming_network_prefix' => $telecom_details['result']['roaming_service_provider']['network_prefix'],
                            'roaming_network_name' => $telecom_details['result']['roaming_service_provider']['network_name'],
                            'roaming_network_region' => $telecom_details['result']['roaming_service_provider']['network_region'],
                            'roaming_mcc' => $telecom_details['result']['roaming_service_provider']['mcc'],
                            'roaming_mnc' => $telecom_details['result']['roaming_service_provider']['mnc'],
                            'roaming_country_prefix' => $telecom_details['result']['roaming_service_provider']['country_prefix'],
                            'roaming_country_code' => $telecom_details['result']['roaming_service_provider']['country_code'],
                            'roaming_country_name' => $telecom_details['result']['roaming_service_provider']['country_name'],
                            'is_ported' => $telecom_details['result']['is_ported'],
                            'last_ported_date' => $telecom_details['result']['last_ported_date'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    } elseif ($user->role_id == 0) {
                        $telecom_data = DB::table('telecom')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'statusCode' => $telecom_details['http_response_code'],
                            'client_ref_num' => $telecom_details['client_ref_num'],
                            'request_id' => $telecom_details['request_id'],
                            'result_code' => $telecom_details['result_code'],
                            'message' => $telecom_details['message'],
                            'customer_name' => $telecom_details['result']['customer_details']['name'],
                            'alternate_number' => $telecom_details['result']['customer_details']['alternate_number'],
                            'is_valid' => $telecom_details['result']['is_valid'],
                            'subscriber_status' => $telecom_details['result']['subscriber_status'],
                            'connection_status_code' => $telecom_details['result']['connection_status']['status_code'],
                            'error_code_id' => $telecom_details['result']['connection_status']['error_code_id'],
                            'connection_type' => $telecom_details['result']['connection_type'],
                            'msisdn_country_code' => $telecom_details['result']['msisdn']['msisdn_country_code'],
                            'msisdn' => $telecom_details['result']['msisdn']['msisdn'],
                            'type' => $telecom_details['result']['msisdn']['type'],
                            'mnc' => $telecom_details['result']['msisdn']['mnc'],
                            'imsi' => $telecom_details['result']['msisdn']['imsi'],
                            'mcc' => $telecom_details['result']['msisdn']['mcc'],
                            'mcc_mnc' => $telecom_details['result']['msisdn']['mcc_mnc'],
                            'current_network_prefix' => $telecom_details['result']['current_service_provider']['network_prefix'],
                            'current_network_name' => $telecom_details['result']['current_service_provider']['network_name'],
                            'current_network_region' => $telecom_details['result']['current_service_provider']['network_region'],
                            'current_mcc' => $telecom_details['result']['current_service_provider']['mcc'],
                            'current_mnc' => $telecom_details['result']['current_service_provider']['mnc'],
                            'current_country_prefix' => $telecom_details['result']['current_service_provider']['country_prefix'],
                            'current_country_code' => $telecom_details['result']['current_service_provider']['country_code'],
                            'current_country_name' => $telecom_details['result']['current_service_provider']['country_name'],
                            'original_network_prefix' => $telecom_details['result']['original_service_provider']['network_prefix'],
                            'original_network_name' => $telecom_details['result']['original_service_provider']['network_name'],
                            'original_network_region' => $telecom_details['result']['original_service_provider']['network_region'],
                            'original_mcc' => $telecom_details['result']['original_service_provider']['mcc'],
                            'original_mnc' => $telecom_details['result']['original_service_provider']['mnc'],
                            'original_country_prefix' => $telecom_details['result']['original_service_provider']['country_prefix'],
                            'original_country_code' => $telecom_details['result']['original_service_provider']['country_code'],
                            'original_country_name' => $telecom_details['result']['original_service_provider']['country_name'],
                            'is_roaming' => $telecom_details['result']['is_roaming'],
                            'roaming_network_prefix' => $telecom_details['result']['roaming_service_provider']['network_prefix'],
                            'roaming_network_name' => $telecom_details['result']['roaming_service_provider']['network_name'],
                            'roaming_network_region' => $telecom_details['result']['roaming_service_provider']['network_region'],
                            'roaming_mcc' => $telecom_details['result']['roaming_service_provider']['mcc'],
                            'roaming_mnc' => $telecom_details['result']['roaming_service_provider']['mnc'],
                            'roaming_country_prefix' => $telecom_details['result']['roaming_service_provider']['country_prefix'],
                            'roaming_country_code' => $telecom_details['result']['roaming_service_provider']['country_code'],
                            'roaming_country_name' => $telecom_details['result']['roaming_service_provider']['country_name'],
                            'is_ported' => $telecom_details['result']['is_ported'],
                            'last_ported_date' => $telecom_details['result']['last_ported_date'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return response()->json([['telecom_details' => $telecom_details, 'statusCode' => '200']]);
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $response = $e->getResponse();
                    $errorResponse = json_decode($response->getBody(), true);
                    if ($statusCode == 500) {
                        $statusCode = 500;
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } elseif ($statusCode == 400) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct Mobile Number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        $statusCode =401;
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);
                            }
                        }
                      return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                  
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //Bank Statement  API
        elseif ($request->has('bank_name') && $request->has('account_type') && $request->has('bank_stmt') && empty($request->client_ref_num) && empty($request->mobile_number) && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $bank_statement_details = null;
            $api_id = null;
            if (!$request->hasFile('bank_stmt')) {
                return response()->json([['message' => 'bank statement file is required', 'statusCode' => '404']]);
            }
            if (empty($request->bank_name)) {
                return response()->json([['message' => 'bank name is required', 'statusCode' => '404']]);
            }
            if (empty($request->account_type)) {
                return response()->json([['message' => 'account type  is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }

            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            } elseif ($user->role_id == 0) {
                $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $headers = ['Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwiaWF0IjoxNjkzMzEyNTg2OTc4fQ.mMgl0deNRbkCXT0LnE8t7hRbTkwoK9TbnCrAS-TtjR4'];
            $client = new Client();
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $data = [
                    'bank' => $request->bank_name,
                    'bankStmt' => new \CURLFILE($_FILES['bank_stmt']['tmp_name'], $_FILES['bank_stmt']['type'], $_FILES['bank_stmt']['name']),
                    'accountType' => $request->account_type,
                ];
                $url = 'https://prod.ltflow.com/ltflow/bank-statement/summary';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $get_data = curl_exec($ch);
                $bankstatment = json_decode($get_data, true);
                $bankstatment_response = null;
                $bankstatment_response_permission = null;
                if (isset($bankstatment['bank_account']) || (isset($bankstatment['FraudAnalytics']) && $bankstatment['FraudAnalytics']['status'] == 'SUCCESS')) {
                    $bankstatment_response['data']['bank_statement'] = null;
                    $bankstatment_response['data']['bank_account'] = $bankstatment['bank_account'];
                    $bankstatment_response['data']['missingMonths'] = $bankstatment['missingMonths'];
                    $bankstatment_response['data']['sanctionedAmount'] = $bankstatment['sanctionedAmount'];
                    $bankstatment_response['data']['monthWiseAnlaysis'] = $bankstatment['monthWiseAnlaysis'];
                    $bankstatment_response['data']['openingAndClosingBalance'] = $bankstatment['openingAndClosingBalance'];
                    $bankstatment_response['data']['incomePerMonth'] = $bankstatment['incomePerMonth'];
                    $bankstatment_response['data']['incomes'] = $bankstatment['incomes'];
                    $bankstatment_response['data']['expensePerMonth'] = $bankstatment['expensePerMonth'];
                    $bankstatment_response['data']['message'] = isset($bankstatment['message'])?$bankstatment['message']:null;
                    $bankstatment_response['data']['eodBalancePerMonth'] = $bankstatment['eodBalancePerMonth'];
                    $bankstatment_response['data']['loanRepaymentInstances'] = $bankstatment['loanRepaymentInstances'];
                    $bankstatment_response['data']['bounceTransactions'] = $bankstatment['bounceTransactions'];
                    $bankstatment_response['data']['dailyEODBalance'] = $bankstatment['dailyEODBalance'];
                    $bankstatment_response['data']['topFiveFundsTransfer'] = $bankstatment['topFiveFundsTransfer'];
                    $bankstatment_response['data']['topFiveFundsReceived'] = $bankstatment['topFiveFundsReceived'];
                    $bankstatment_response['data']['transactions'] = $bankstatment['transactions'];
                    $bankstatment_response['data']['FraudAnalytics'] = $bankstatment['FraudAnalytics'];
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    }
                    return response()->json(['bank_statement' => $bankstatment, 'statusCode' => 200]);
                } elseif (isset($bankstatment['errors']) && $bankstatment['status'] == 'ERROR') {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                        }
                    }
                    return response()->json(['statusCode' =>102, 'errors' => $bankstatment['errors']]);
                } else {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);
                        }
                    }
                    return response()->json(['statusCode' => 500, 'errors' => 'Internal Server Error.']);
                }
            }else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
            }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //API SETU GOVERMENT COMPANIES API.
        elseif ($request->has('companines_cin_number') && $request->has('company_type') && $request && empty($request->bank_name) && empty($request->account_type) && empty($request->bank_stmt) && empty($request->client_ref_num) && empty($request->mobile_number) && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $companies_cin_details = null;
            $api_id = null;
            if (empty($request->companines_cin_number)) {
                return response()->json([['message' => 'company cin number is required', 'statusCode' => '404']]);
            }
            if (empty($request->company_type)) {
                return response()->json([['message' => 'company type is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'CIN')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $headers = [
                'X-APISETU-APIKEY' => 'xrrtXIcmP8wsdzxgmvkktksGrgqbVTwC',
                'X-APISETU-CLIENTID' => 'in.zapfin',
            ];
            $client = new Client();
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                if (!empty($request->company_type) && $request->get('company_type') == 'Information') {
                    try {
                        $res = $client->get('https://apisetu.gov.in/mca/v1/companies/' . $request->companines_cin_number, ['headers' => $headers]);
                        $companies_cin_details = json_decode($res->getBody(), true);
                        return $companies_cin_details;
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $response = $e->getResponse();
                        $errorResponse = json_decode($response->getBody(), true);
                        if ($statusCode == 400) {
                            $statusCode == 400;
                            $error = 'invalid parameter';
                            $errorDescription = 'Bad request.';
                        } elseif ($statusCode == 401) {
                            $statusCode == 401;
                            $error = 'invalid_authentication';
                            $errorDescription = 'Authentication failed.';
                        } elseif ($statusCode == 404) {
                            $statusCode == 404;
                            $error = 'record_not_found';
                            $errorDescription = 'No record found.';
                        } elseif ($statusCode == 500) {
                            $statusCode == 500;
                            $error = 'internal_server_error';
                            $errorDescription = 'Internal server error';
                        } elseif ($statusCode == 502) {
                            $statusCode == 502;
                            $error = 'bad gateway';
                            $errorDescription = 'Publisher service returned an invalid response.';
                        } elseif ($statusCode == 503) {
                            $statusCode == 503;
                            $error = 'service_unavailable';
                            $errorDescription = 'Publisher service is temporarily unavailable.';
                        } else {
                            $statusCode == 504;
                            $error = 'gateway_timeout';
                            $errorDescription = 'Publisher service did not respond in time.';
                        }
                        return response()->json(['statusCode' => $statusCode, 'error' => $error, 'errorDescription' => $errorDescription]);
                    }
                } elseif (!empty($request->company_type) && $request->get('company_type') == 'Director') {
                    try {
                        $res = $client->get('https://apisetu.gov.in/mca-directors/v1/companies/' . $request->companines_cin_number, ['headers' => $headers]);
                        $companies_director_cin_details = json_decode($res->getBody(), true);
                        return $companies_director_cin_details;
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $response = $e->getResponse();
                        $errorResponse = json_decode($response->getBody(), true);
                        if ($statusCode == 400) {
                            $statusCode == 400;
                            $error = 'invalid parameter';
                            $errorDescription = 'Bad request.';
                        } elseif ($statusCode == 401) {
                            $statusCode == 401;
                            $error = 'invalid_authentication';
                            $errorDescription = 'Authentication failed.';
                        } elseif ($statusCode == 404) {
                            $statusCode == 404;
                            $error = 'record_not_found';
                            $errorDescription = 'No record found.';
                        } elseif ($statusCode == 500) {
                            $statusCode == 500;
                            $error = 'internal_server_error';
                            $errorDescription = 'Internal server error';
                        } elseif ($statusCode == 502) {
                            $statusCode == 502;
                            $error = 'bad gateway';
                            $errorDescription = 'Publisher service returned an invalid response.';
                        } elseif ($statusCode == 503) {
                            $statusCode == 503;
                            $error = 'service_unavailable';
                            $errorDescription = 'Publisher service is temporarily unavailable.';
                        } else {
                            $statusCode == 504;
                            $error = 'gateway_timeout';
                            $errorDescription = 'Publisher service did not respond in time.';
                        }
                        return response()->json(['statusCode' => $statusCode, 'error' => $error, 'errorDescription' => $errorDescription]);
                    }
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You have entered wrong company type. Please enter correct company type.']);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }  
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //API SETU GOVERMENT GSTN TAX PAYER API.
        elseif ($request->has('tax_payer_gstin_number') && empty($request->companines_cin_number) && empty($request->company_type) && $request && empty($request->bank_name) && empty($request->account_type) && empty($request->bank_stmt) && empty($request->client_ref_num) && empty($request->mobile_number) && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $taxpayer_gstin_details = null;
            $api_id = null;
            if (empty($request->tax_payer_gstin_number)) {
                return response()->json([['message' => 'tax payer gstin number is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1){
                $apiamster = ApiMaster::where('api_slug', 'gstin')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            $headers = [
                'X-APISETU-APIKEY' => 'xrrtXIcmP8wsdzxgmvkktksGrgqbVTwC',
                'X-APISETU-CLIENTID' => 'in.zapfin',
            ];
            $client = new Client();
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                try {
                    $res = $client->get('https://apisetu.gov.in/gstn/v2/taxpayers/' . $request->tax_payer_gstin_number, ['headers' => $headers]);
                    $taxpayer_gstin_details = json_decode($res->getBody(), true);
                    $statusCode = $res->getStatusCode();
                    $taxpayer_gstin_response = null;
                    $taxpayer_gstin = null;
                    $taxpayer_gstin_permission = null;
                    if (isset($statusCode) && $statusCode == 200) {
                        $taxpayer_gstin_data = UserSchemeMaster::where('user_id', $user->id)
                            ->where('api_id', $api_id)
                            ->where('permission', '<>', null)
                            ->where('permission', '<>', '')
                            ->orderBy('id', 'desc')
                            ->pluck('permission');
                    
                        if (count($taxpayer_gstin_data) > 0 && $taxpayer_gstin_data != null) {
                            $taxpayer_gstin['gstin'] = null;
                            $taxpayer_gstin['request_id'] = null;
                            $taxpayer_gstin['reg_date'] = null;
                            $taxpayer_gstin['state_code'] = null;
                            $taxpayer_gstin['nature'] = null;
                            $taxpayer_gstin['jurisdiction'] = null;
                            $taxpayer_gstin['business_type'] = null;
                            $taxpayer_gstin['lastUpdatedDate'] = null;
                            $taxpayer_gstin['address'] = null;
                            $taxpayer_gstin['add_address'] = null;
                            $taxpayer_gstin['status'] = null;
                            $taxpayer_gstin['gstIdentificationNumber'] = $taxpayer_gstin_details['gstIdentificationNumber'];
                            $taxpayer_gstin['legalNameOfBusiness'] = $taxpayer_gstin_details['legalNameOfBusiness'];
                            $taxpayer_gstin['tradeName'] = $taxpayer_gstin_details['tradeName'];
                            $taxpayer_gstin['taxpayerType'] = $taxpayer_gstin_details['taxpayerType'];
                            $taxpayer_gstin['lastUpdatedDate'] = $taxpayer_gstin_details['lastUpdatedDate'];
                            $taxpayer_gstin['dateOfCancellation'] = $taxpayer_gstin_details['dateOfCancellation'];
                            $taxpayer_gstin['natureOfBusinessActivity'] = $taxpayer_gstin_details['natureOfBusinessActivity'];
                            $taxpayer_gstin['dateOfRegistration'] = $taxpayer_gstin_details['dateOfRegistration'];
                            $taxpayer_gstin['constitutionOfBusiness'] = $taxpayer_gstin_details['constitutionOfBusiness'];
                            $taxpayer_gstin['principalPlaceOfBusinessFields'] = $taxpayer_gstin_details['principalPlaceOfBusinessFields'];
                            $taxpayer_gstin['gstnStatus'] = $taxpayer_gstin_details['gstnStatus'];
                            $taxpayer_gstin['centerJurisdictionCode'] = $taxpayer_gstin_details['centerJurisdictionCode'];
                            $taxpayer_gstin['centerJurisdiction'] = $taxpayer_gstin_details['centerJurisdiction'];
                            $taxpayer_gstin['eInvoiceStatus'] = $taxpayer_gstin_details['eInvoiceStatus'];
                            $taxpayer_gstin['stateJurisdiction'] = $taxpayer_gstin_details['stateJurisdiction'];
                            $taxpayer_gstin['stateJurisdictionCode'] = $taxpayer_gstin_details['stateJurisdictionCode'];
                            $taxpayer_gstin['additionalPlaceOfBusinessFields'] = isset($taxpayer_gstin_details['additionalPlaceOfBusinessFields']) ? $taxpayer_gstin_details['additionalPlaceOfBusinessFields'] : null;

                            $taxpayer_gstin_record = explode(',', $taxpayer_gstin_data[0]);
                            foreach ($taxpayer_gstin_record as $item) {
                                $taxpayer_gstin_permission[$item] = $taxpayer_gstin[$item];
                            }
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if($user->role_id == 1){
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                              
                                DB::table('gstin')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'gstin_number' => $taxpayer_gstin_details['gstIdentificationNumber'],
                                    'stateJurisdictionCode' => $taxpayer_gstin_details['stateJurisdictionCode'],
                                    'legalNameOfBusiness' => $taxpayer_gstin_details['legalNameOfBusiness'],
                                    'stateJurisdiction' => $taxpayer_gstin_details['stateJurisdiction'],
                                    'taxpayer_type' => $taxpayer_gstin_details['taxpayerType'],
                                    'dateOfCancellation' => $taxpayer_gstin_details['dateOfCancellation'],
                                    'lastUpdatedDate' => $taxpayer_gstin_details['lastUpdatedDate'],
                                    'dateOfRegistration' => $taxpayer_gstin_details['dateOfRegistration'],
                                    'constitutionOfBusiness' => $taxpayer_gstin_details['constitutionOfBusiness'],
                                    'tradeName' => $taxpayer_gstin_details['tradeName'],
                                    'gstnStatus' => $taxpayer_gstin_details['gstnStatus'],
                                    'buildingName' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'],
                                    'location' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['location'],
                                    'streetName' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['streetName'],
                                    'district' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'],
                                    'latitude' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['lattitude'],
                                    'locality' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['locality'],
                                    'pincode' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['pincode'],
                                    'landMark' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['landMark'],
                                    'state' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['stateName'],
                                    'geocodelvl' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['geocodelvl'],
                                    'floorNumber' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['floorNumber'],
                                    'longitude' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['longitude'],
                                    'natureOfPrincipalPlaceOfBusiness' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'],
                                    'centerJurisdictionCode' => $taxpayer_gstin_details['centerJurisdictionCode'],
                                    'centerJurisdiction' => $taxpayer_gstin_details['centerJurisdiction'],
                                    'eInvoiceStatus' => $taxpayer_gstin_details['gstnStatus'],
                                    'additionalPlaceOfBusinessFields' => isset($taxpayer_gstin_details['additionalPlaceOfBusinessFields']) ? json_encode($taxpayer_gstin_details['additionalPlaceOfBusinessFields'], true) : null,
                                    'status' => 'success',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['statusCode' => 200, 'taxpayer_gstin' => $taxpayer_gstin_permission]);
                        }

                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            DB::table('gstin')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'gstin_number' => $taxpayer_gstin_details['gstIdentificationNumber'],
                                'stateJurisdictionCode' => $taxpayer_gstin_details['stateJurisdictionCode'],
                                'legalNameOfBusiness' => $taxpayer_gstin_details['legalNameOfBusiness'],
                                'stateJurisdiction' => $taxpayer_gstin_details['stateJurisdiction'],
                                'taxpayer_type' => $taxpayer_gstin_details['taxpayerType'],
                                'dateOfCancellation' => $taxpayer_gstin_details['dateOfCancellation'],
                                'lastUpdatedDate' => $taxpayer_gstin_details['lastUpdatedDate'],
                                'dateOfRegistration' => $taxpayer_gstin_details['dateOfRegistration'],
                                'constitutionOfBusiness' => $taxpayer_gstin_details['constitutionOfBusiness'],
                                'tradeName' => $taxpayer_gstin_details['tradeName'],
                                'gstnStatus' => $taxpayer_gstin_details['gstnStatus'],
                                'buildingName' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'],
                                'location' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['location'],
                                'streetName' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['streetName'],
                                'district' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'],
                                'latitude' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['lattitude'],
                                'locality' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['locality'],
                                'pincode' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['pincode'],
                                'landMark' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['landMark'],
                                'state' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['stateName'],
                                'geocodelvl' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['geocodelvl'],
                                'floorNumber' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['floorNumber'],
                                'longitude' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['longitude'],
                                'natureOfPrincipalPlaceOfBusiness' => $taxpayer_gstin_details['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'],
                                'centerJurisdictionCode' => $taxpayer_gstin_details['centerJurisdictionCode'],
                                'centerJurisdiction' => $taxpayer_gstin_details['centerJurisdiction'],
                                'eInvoiceStatus' => $taxpayer_gstin_details['gstnStatus'],
                                'additionalPlaceOfBusinessFields' => isset($taxpayer_gstin_details['additionalPlaceOfBusinessFields']) ? json_encode($taxpayer_gstin_details['additionalPlaceOfBusinessFields'], true) : null,
                                'status' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['statusCode' => 200, 'taxpayer_gstin' => $taxpayer_gstin_details]);
                    }
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $response = $e->getResponse();
                    $errorResponse = json_decode($response->getBody(), true);
                    if ($statusCode == 400) {
                        $statusCode = 102;
                        $errorMessage = 'Wrong taxpayer gstin number. Please enter correct taxpayer gstin number.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                            }
                        }
                    } elseif ($statusCode == 401) {
                        $statusCode == 401;
                        $errorMessage = 'Authentication failed.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                        }
                    } elseif ($statusCode == 403) {
                        $statusCode == 403;
                        $errorMessage = 'You are not authorized to use this API.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                        }
                    } elseif ($statusCode == 404) {
                        $statusCode == 404;
                        $errorMessage = 'Record Not Found.';
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                        }
                    } elseif ($statusCode == 500) {
                        $statusCode == 500;
                        $errorMessage = 'Internal Server Error.';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                        }
                    } elseif ($statusCode == 502) {
                        $statusCode == 502;
                        $errorMessage = 'Publisher service returned an invalid response. Please contact with techsupport@docboyz.in';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 500);
                        }
                    } elseif ($statusCode == 503) {
                        $statusCode == 503;
                        $errorMessage = 'Publisher service is temporarily unavailable. Please contact with techsupport@docboyz.in';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 500);
                        }
                    } else {
                        $statusCode == 504;
                        $errorMessage = 'Publisher service did not respond in time.Please contact with techsupport@docboyz.in';
                        if ($user->role_id == 1) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 500);
                        }
                    }
                    return response()->json(['statusCode' => $statusCode, 'errorMessage' => $errorMessage]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }  
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        } elseif ($request->has('file') && empty($request->tax_payer_gstin_number) && empty($request->companines_cin_number) && empty($request->company_type) && empty($request->bank_name) && empty($request->account_type) && empty($request->bank_stmt) && empty($request->client_ref_num) && empty($request->mobile_number) && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            //Pancard Scrapping
            if (!empty($request->file_type) && $request->get('file_type') == 'pancard') {
                $statusCode = null;
                $pan_cards = null;
                $api_id = null;
                // $apimaster=null;
                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }

                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }

                $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                    if ($apiamster) {
                         $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                 if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                        if ($apiamster) {
                             $api_id = $apiamster->id;
                        }
                  }
                if ($updateHitCount || $user->role_id == 0) {
                 if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://13.126.53.71:8080/panocr',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $pancard = json_decode($response, true);

                    if (isset($pancard['raw_ocr_texts'])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $paninfo = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'name'=>isset($pancard['name']) ? $pancard['name'] : null,
                                'dob' => isset($pancard['date_of_birth']) ? $pancard['date_of_birth'] : null,
                                'pancard_id' => isset($pancard['pan_number']) ? $pancard['pan_number'] : null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 200, 'pancard' => $pancard]);
                    } elseif (isset($pancard['error']) && $pancard['error'] == 'Invalid file type, must be an image') {
                        $statusCode = 102;
                        $errorMessage = 'Invalid file type, must be an pancard image';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $paninfo = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    } elseif (isset($pancard['error']) && $pancard['error'] == "No file part") {
                        $statusCode = 404;
                        $errorMessage = 'No image file provided';
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $paninfo = DB::table('pancard_varification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                }
                else{
                    return response()->json(['statusCode' => 103, 'message' => 'Please reacharge your wallet.']);
                }
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }
            //Scrapping Voter Id
            elseif (!empty($request->file_type) && $request->get('file_type') == 'voterid') {
                $statusCode = null;
                $voter_id = null;
                $api_id = null;
                // $apimaster=null;
                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }

                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }

                $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'voter_id')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                  } 
                if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://13.126.53.71:8080/voterocr',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $voterid = json_decode($response, true);
                    if (isset($voterid['raw_ocr_texts'])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $voter_id = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'name' => isset($voterid['name'])?$voterid['name']:null,
                                'epic_no' => isset($voterid['voter_id_number'])?:$voterid['voter_id_number'],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
        
                        }
                        return response()->json(['status_code' => 200, 'voterid' => $voterid]);
                    } elseif (isset($voterid['error']) && $voterid['error'] == 'Invalid file type, must be an image') {
                        $statusCode = 102;
                        $errorMessage = 'Invalid file type, must be an voter image';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $voter_id = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    } elseif (isset($voterid['error']) && $voterid['error'] == "No file part") {
                        $statusCode = 404;
                        $errorMessage = 'No image file provided';
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $voter_id = DB::table('voter_verification')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } 
                else{
                    return response()->json(['statusCode' => 103, 'message' => 'Please reacharge your wallet.']);
                }   
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }

            // Scrapping Aadhar card
            elseif (!empty($request->file_type) && $request->get('file_type') == 'aadharcard') {
                $statusCode = null;
                $aadhar_card = null;
                $api_id = null;

                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }

                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }

                $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                   if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'aadhaar')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    
                 if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://13.126.53.71:8080/aadharocr',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $aadhar_card = json_decode($response, true);
                        if (isset($aadhar_card['raw_ocr_texts'])) {
                         
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'aadhar_no' => isset($aadhar_card['aadhar_number'])?$aadhar_card['aadhar_number']:null,
                                    'date_of_birth' => isset($aadhar_card['date_of_birth'])?$aadhar_card['date_of_birth']:null,
                                    'name' => isset($aadhar_card['name'])?$aadhar_card['name']:null,
                                    'gender'=>isset($aadhar_card['gender'])?$aadhar_card['gender']:null,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 200, 'aadharcard' => $aadhar_card]);
                        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == 'Invalid file type, must be an image') {
                            $statusCode = 102;
                            $errorMessage = 'Invalid file type, must be an aadhar card image.';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == "No file part") {
                            $statusCode = 404;
                            $errorMessage = 'No image file provided';
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_validation')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        }
                    } else {
                        return response()->json(['statusCode' =>500, 'message' => 'Please reacharge your wallet.']);
                       
                    }
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }
            //Aadhar Card Masked
            elseif (!empty($request->file_type) && $request->get('file_type') == 'mask_aadhar_card'){
                $statusCode = null;
                $aadhar_card = null;
                $api_id = null;
                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }
                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }
                 $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'aadharmasking')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                  if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'aadharmasking')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                   }
                    if ($updateHitCount || $user->role_id == 0) {
                        if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => '13.200.221.11:5000/mask_aadhar',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $aadhar_card = json_decode($response, true);
                        if (isset($aadhar_card['data'])) {
                            $aadharcard_response = null;
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_masking_details')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'aadhar_mask_base64' => isset($aadhar_card['data'])?$aadhar_card['data']:null,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);  
                            }
                            return response()->json(['status_code' => 200, 'aadharcard' =>$aadhar_card]);
                        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == 'Invalid file type, must be an image') {
                            $statusCode = 102;
                            $errorMessage = 'Invalid file type, must be an aadhar card image.';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_masking_details')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                        } elseif (isset($aadhar_card['error']) && $aadhar_card['error'] == 'No file provided') {
                            $statusCode = 404;
                            $errorMessage = 'No image file provided';
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                }
                                $aadharcard = DB::table('aadhar_masking_details')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        }
                    } else {
                        return response()->json(['statusCode' =>500, 'message' => 'Please reacharge your wallet amount.']);
                       
                    }
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }
            //Driving license
            elseif(!empty($request->file_type) && $request->get('file_type') == 'drivinglicense') {
                $statusCode = null;
                $drivinglicense = null;
                $api_id = null;

                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }

                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }

                $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'license')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                    if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'license')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                 if ($updateHitCount || $user->role_id == 0) {
                        if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => 'http://13.126.53.71:8080/dlocr',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $drivinglicense = json_decode($response, true);
                        if (isset($drivinglicense['raw_ocr_texts'])) {
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $driving_license = DB::table('driving_license')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'license_number' => isset($drivinglicense['dl_no'])?$drivinglicense['dl_no']:null,
                                    'dob' => isset($drivinglicense['birth_date'])?$drivinglicense['birth_date']:null,
                                    'valid_till' => isset($drivinglicense['expiry_date'])?$drivinglicense['expiry_date']:null,
                                    'name' => isset($drivinglicense['name'])?$drivinglicense['name']:null,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 200, 'driving_license' => $drivinglicense]);
                        } elseif (isset($drivinglicense['error']) && $drivinglicense['error'] == 'Invalid file type, must be an image') {
                            $statusCode = 102;
                            $errorMessage = 'Invalid file type, must be an driving license image.';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                    }
                                }
                                $driving_license = DB::table('driving_license')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                        } elseif (isset($drivinglicense['error']) && $drivinglicense['error'] == "No file part") {
                            $statusCode = 404;
                            $errorMessage = 'No image file provided';
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                }
                                $driving_license = DB::table('driving_license')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        }
                    } else {
                        return response()->json(['statusCode' =>500, 'message' => 'Please reacharge your wallet amount.']);
                       
                    }
                } else {
                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }
            //passport verifiction
            elseif (!empty($request->file_type) && $request->get('file_type') == 'passport') {
                $statusCode = null;
                $passport = null;
                $api_id = null;
                if (empty($request->hasFile('file'))) {
                    return response()->json([['message' => 'file is required', 'statusCode' => '404']]);
                }

                if (!$request->headers->has('AccessToken')) {
                    return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
                }
                $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
                if ($verifyAccessToken == false) {
                    return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
                }
                $user = User::where('access_token', $request->header('AccessToken'))->first();
                if ($user->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'passportupload')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                    ->where('api_id', $api_id)
                    ->orderBy('id', 'desc')
                    ->first();
                    if ($user->role_id == 0) {
                        $apiamster = ApiMaster::where('api_slug', 'passportupload')->first();
                        if ($apiamster) {
                            $api_id = $apiamster->id;
                        }
                    }
                    if ($updateHitCount || $user->role_id == 0) {
                        if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                            CURLOPT_URL => '13.200.221.11:5000/process-passport',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        ]);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $passport = json_decode($response, true);
                        if (isset($passport['mrz_info'])) {
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                    }
                                }
                                $passport_detils = DB::table('passport_upload')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'date_of_birth' => isset($passport['mrz_info']['date_of_birth_yymmdd'])?$passport['mrz_info']['date_of_birth_yymmdd']:null,
                                    'expiration_date' => isset($passport['mrz_info']['expiration_date_yymmdd'])?$passport['mrz_info']['expiration_date_yymmdd']:null,
                                    'gender' => isset($passport['mrz_info']['gender'])?$passport['mrz_info']['gender']:null,
                                    'mrz_type' => isset($passport['mrz_info']['mrz_type'])?$passport['mrz_info']['mrz_type']:null,
                                    'nationality' => isset($passport['mrz_info']['nationality'])?$passport['mrz_info']['nationality']:null,
                                    'number' => isset($passport['mrz_info']['number'])?$passport['mrz_info']['number']:null,
                                    'valid_document' => isset($passport['valid_document'])?$passport['valid_document']:null,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 200, 'passport_verification' => $passport]);
                        } elseif (isset($passport['error']) && $passport['error'] == 'Failed to extract MRZ information') {
                            $statusCode = 102;
                            $errorMessage = 'Failed to extract MRZ information.';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                    }
                                }
                                $passport_detils = DB::table('passport_upload')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                        } elseif (isset($passport['error']) && $passport['error'] == 'No file provided') {
                            $statusCode = 404;
                            $errorMessage = 'No image file provided';
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            if ($user->role_id == 1 || $user->role_id == 0) {
                                if ($user->role_id == 1) {
                                    if ($apiamster) {
                                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                    }
                                }
                                $driving_license = DB::table('passport_upload')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                            }
                            return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                        }
                    } else {
                        return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                    }
                } else {

                    return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
                }
            }
           else {
                return response()->json(['statusCode' => 103, 'message' => 'InValid file type Please enter correct file type.']);
            }
        }
        //Bank Statement
        elseif ($request->has('file') && $request->has('bank_name') && $request->has('account_type') && empty($request->tax_payer_gstin_number) && empty($request->companines_cin_number) && empty($request->company_type) && empty($request->bank_stmt) && empty($request->client_ref_num) && empty($request->mobile_number) && empty($request->gstin) && empty($request->upi_id) && empty($request->name) && empty($request->order_id) && empty($request->ifsc) && empty($request->account_number) && empty($request->uamnumber) && empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) && empty($request->license_number) && empty($request->dob) && empty($request->client_id) && empty($request->otp_aadhar) && empty($request->otp_aadhar_number) && empty($request->aadhaar_number) && empty($request->voter_number) && empty($request->pano) && empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) {
            $statusCode = null;
            $api_id = null;
            $bankStatement = [];
            if (empty($request->hasFile('file'))) {
                return response()->json(['message' => 'file is required', 'statusCode' => '404']);
            }

            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();

            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
               

            if ($updateHitCount || $user->role_id == 0) {
                if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://13.200.221.11:5000/extract-bank-statement',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                ]);

                $response = curl_exec($curl);
                curl_close($curl);
                $bankstatment = json_decode($response, true);
                if (isset($bankstatment[0]['extracted_info'])) {
                       if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
            
                    $bankStatement = $bankstatment[0]['extracted_info']['tabular_data'][0];
                    $pdf = PDF::loadView('kyc.statementpdf', compact('bankStatement'))->setPaper('A4');
                    $bankstatement_pdf_content = $pdf->output();
                    $bankstatement_pdf_content_base64 = base64_encode($bankstatement_pdf_content);
                    return response()->json(['status_code' => 200, 'bank_statement' => $bankstatment, 'bank_details' => $bankstatement_pdf_content_base64]);
                } elseif (isset($bankstatment['error']) && $bankstatment['error'] == 'Invalid file type, must be a PDF') {
                    $statusCode = 102;
                    $errorMessage = 'Invalid file type, must be a PDF';
                       if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                            }
                        }
                     return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                } elseif (isset($bankstatment['error']) && $bankstatment['error'] == 'No file provided') {
                    $statusCode = 404;
                    $errorMessage = 'No image file provided';
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                } elseif (isset($bankstatment['Status']) && $bankstatment['Status'] == 102) {
                    $headers = ['Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwiaWF0IjoxNjkzMzEyNTg2OTc4fQ.mMgl0deNRbkCXT0LnE8t7hRbTkwoK9TbnCrAS-TtjR4'];
                    $data = [
                        'bank' => $request->bank_name,
                        'bankStmt' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']),
                        'accountType' => $request->account_type,
                    ];
                    $url = 'https://prod.ltflow.com/ltflow/bank-statement/summary';
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $get_data = curl_exec($ch);
                    $bankstatment = json_decode($get_data, true);
                    $bankstatment_response = null;
                    $bankstatment_response_permission = null;
                    if (isset($bankstatment['bank_account']) || (isset($bankstatment['FraudAnalytics']) && $bankstatment['FraudAnalytics']['status'] == 'SUCCESS')) {
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
                        $bankStatements = [];
                        foreach ($bankstatment['transactions'] as $key => $item) {
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
                        $bankstatement_pdf_content = $pdf->output();
                        $bankstatement_pdf_content_base64 = base64_encode($bankstatement_pdf_content);
                        return response()->json(['status_code' => 200, 'bank_statement' => $bankstatment, 'bank_details' => $bankstatement_pdf_content_base64]);
                    } elseif (isset($bankstatment['errors']) && $bankstatment['status'] == 'ERROR') {
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                        }
                        return response()->json(['statusCode' => 102, 'errors' => $bankstatment['errors']]);
                    } else {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', 500);
                                }
                            }
                        return response()->json(['statusCode' => 500, 'errors' => 'Internal Server Error. Please contact techsupport@docboyz.in. for more details']);
                    }
                } else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                   
                        if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                            }
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } else {
                return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
            }
        }
         else{
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
       }
      //Company Details Api.
        elseif ($request->has('companyName') ||($request->has('flrsLicenseNo') && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)) ) {
            $statusCode = null;
            $api_id = null;
            $companyDetails = [];
            if (empty($request->companyName) && empty($request->flrsLicenseNo)) {
                return response()->json(['message' => 'Atleast one parameter is required.', 'statusCode' => '103']);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();

            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'companysearch')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
           
                if ($updateHitCount || $user->role_id == 0) {
                 if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $companyName = $request->companyName;
                    $flrsLicenseNo = $request->flrsLicenseNo;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://13.200.221.11:5000/fetch-company-products', // Assuming it's an HTTP URL
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode([
                            'premiseState' => null,
                            'premiseDistrict' => null,
                            'companyName' => $companyName,
                            'flrsLicenseNo' => $flrsLicenseNo,
                        ]),
                        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                    ]);

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $companyProductDetails = json_decode($response, true);
                    if (isset($companyProductDetails[0]['companyDetails'])) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                          return response()->json(['status_code' => 200, 'company_details' => $companyProductDetails]);
                    } elseif (isset($companyProductDetails['status']) && $companyProductDetails['status'] == 500) {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                        
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 102;
                        $errorMessage = 'invalid companyName or flrsLicenseNo';
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                    
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                 
                }
            } else {
                 return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        elseif ($request->has('known_face') && $request->has('image1') && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
           
            $statusCode = null;
            $api_id = null;
            if (empty($request->known_face)) {
                return response()->json(['message' => 'known face is required.', 'statusCode' => '103']);
            }
            if (empty($request->image1)) {
                return response()->json(['message' => 'image1 is required.', 'statusCode' => '103']);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();

            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'facematch')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'facematch')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
           
                if ($updateHitCount || $user->role_id == 0) {
                 if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => '13.200.221.11:5000/rec_faces',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>['known_face'=> new \CURLFILE($_FILES['known_face']['tmp_name'], $_FILES['known_face']['type'], $_FILES['known_face']['name']),'image1'=> new \CURLFILE($_FILES['image1']['tmp_name'], $_FILES['image1']['type'], $_FILES['image1']['name'])],
                      ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $rec_faces = json_decode($response, true);
                    if (isset($rec_faces['result']) && $rec_faces['result']==true) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            DB::table('face_match')->insert([
                                'api_id'=>$api_id,
                                'user_id'=>$user->id,
                                'result'=>$rec_faces['result'],
                                'status_code'=>200,
                                'message_code'=>'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 200, 'rec_face' =>$rec_faces]);
                    } elseif (isset($rec_faces['error']) && $rec_faces['error'] =="[Errno 5] Input/output error") {
                        $statusCode = 102;
                        $errorMessage = 'face match failed.';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            DB::table('face_match')->insert([
                                'api_id'=>$api_id,
                                'user_id'=>$user->id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            DB::table('face_match')->insert([
                                'api_id'=>$api_id,
                                'user_id'=>$user->id,
                                'status_code'=>500,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                 
                }
            } else {
                 return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        elseif ($request->has('image_file') && empty($request->known_face) && empty($request->image1) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
            $statusCode = null;
            $api_id = null;
            if (empty($request->image_file)) {
                return response()->json(['message' => 'image file is required.', 'statusCode' => '103']);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }

            $user = User::where('access_token', $request->header('AccessToken'))->first();

            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'detectedemotions')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'detectedemotions')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
           
                if ($updateHitCount || $user->role_id == 0) {
                 if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => '13.200.221.11:5000/detect_emotion',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>['image'=> new \CURLFILE($_FILES['image_file']['tmp_name'], $_FILES['image_file']['type'], $_FILES['image_file']['name'])],
                      ));
                    $response = curl_exec($curl);
                    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);
                    $detect_emotion = json_decode($response, true);
                    if (isset($detect_emotion['emotions']) && $statusCode==200) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                             }
                            $detect_emotaions = DB::table('emotions')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'detected_emotions_description'=>isset($detect_emotion['emotions'][0]) ?$detect_emotion['emotions'][0]:null,
                                'status_code' =>200,
                                'message_code' =>"success",
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]); 
                        }
                        return response()->json(['status_code' => 200, 'response' =>$detect_emotion]);
                    } elseif (isset($detect_emotion['emotions']) && $detect_emotion['emotions']=="[Errno 5] Input/output error") {
                        $statusCode = 102;
                        $errorMessage = 'Image does not detect.';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                               
                            }
                            $detect_emotaions = DB::table('emotions')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>102,
                                'message_code' =>"failed",
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]); 
                        }
                          return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                           }
                            $detect_emotaions = DB::table('emotions')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' =>"failed",
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                 
                }
            } else {
                 return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
        }
        //parameter details
        //panNumber
        //date_of_birth
        //identifier_type
     elseif($request->has('panNumber') && $request->has('date_of_birth') && $request->has('identifier_type') && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
      
        $statusCode = null;
        $pancard = null;
        $api_id = null;
        if (empty($request->panNumber)) {
            return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
        }
        if (empty($request->identifier_type)) {
            return response()->json([['message' => 'identifier_type is required', 'statusCode' => '404']]);
        }

        if (empty($request->date_of_birth)) {
            return response()->json(['message' =>"Date of birth is required", 'statusCode' => '404']);
        }

        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }

        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        // return $user->id;
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'searchkyc')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }

        $panno = $request->panNumber;
        $client_ref_number = strval(rand(1000000,9999999));
        $identity_type = $request->identifier_type;
        $dob = $request->date_of_birth;
        $client = new Client();
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {

            // return $api_id;
            $url = 'https://api.digitap.ai/ckyc/v1/search';
            $data = [
                'client_ref_num' =>$client_ref_number,
                'identifier' =>$panno,
                'identifier_type' =>$identity_type,
             ];

            $body = json_encode($data);

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:Basic NjA0MDMyMDE6N09XVHNZU3g0Vk1VNjlNOGpQR29UUW1ZblpSVFN6R3M=', 'Content-Type:application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $get_data1 = curl_exec($ch);
            $kyccard = json_decode($get_data1, true);
         
            // Async::run($kyccard);
            // $results = Async::wait();

            if (isset($kyccard['result_code']) && $kyccard['result_code']==103) {
                $kyccarderror = null;
              
                $kyccarderror['error']['status'] = 102;
                $kyccarderror['error']['message'] = $kyccard['error'];
            
               if ($user->role_id == 1) {
                  if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed.',102);
                 }
                    
                 $panvalidation = DB::table('search_new')->insert([
                    'user_id' => $user->id,
                    'api_id' => $api_id,
                    'dob' => $dob,
                    'status' =>102,
                    'pan_no' =>$request->panNumber,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                  ]);
                }
                 
                return response()->json(['statusCode' =>102, 'response' => $kyccarderror]);
            }

            if (isset($kyccard['result_code']) && $kyccard['result_code'] == 101) {
                 //return $kyccard;
                $searchkyc = [];
                $url = 'https://api.digitap.ai/ckyc/v1/download';

                $data = [
                    'ckyc_id' => $kyccard['result']['ckyc_id'],
                    'auth_factor_type' =>"DOB",
                    'client_ref_num'=> $kyccard['client_ref_num'],
                    'auth_factor' => $dob,
                ];

                $body = json_encode($data);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:Basic NjA0MDMyMDE6N09XVHNZU3g0Vk1VNjlNOGpQR29UUW1ZblpSVFN6R3M=', 'Content-Type:application/json']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $alldata = curl_exec($ch);
                $allpandata = json_decode($alldata, true);
                if (isset($allpandata['result_code']) && $allpandata['result_code'] ==101) {
                    $searchkyc['status'] = $allpandata['status'];
                    $searchkyc['kycStatus'] = null;
                    $searchkyc['message'] = 'Details downloaded successfully.';
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['constitution_type'] = $allpandata['result']['personal_details']['constitution_type'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['account_type'] = $allpandata['result']['personal_details']['account_type'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['ckyc_no'] = $allpandata['result']['personal_details']['ckyc_no'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['prefix'] = $allpandata['result']['personal_details']['prefix'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] = $allpandata['result']['personal_details']['first_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['middleName'] = $allpandata['result']['personal_details']['middle_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] = $allpandata['result']['personal_details']['last_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] =$allpandata['result']['personal_details']['full_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_prefix'] =$allpandata['result']['personal_details']['maiden_prefix'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fname'] =$allpandata['result']['personal_details']['maiden_fname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_mname'] =$allpandata['result']['personal_details']['maiden_mname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_lname'] =$allpandata['result']['personal_details']['maiden_lname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fullname'] =$allpandata['result']['personal_details']['maiden_fullname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_or_spouse_flag'] =$allpandata['result']['personal_details']['father_or_spouse_flag'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_prefix'] =$allpandata['result']['personal_details']['father_prefix'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_fname'] =$allpandata['result']['personal_details']['father_fname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_mname'] =$allpandata['result']['personal_details']['father_mname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_lname'] =$allpandata['result']['personal_details']['father_lname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['father_fullname'] =$allpandata['result']['personal_details']['father_fullname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mother_prefix'] =$allpandata['result']['personal_details']['mother_prefix'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fname'] =$allpandata['result']['personal_details']['mother_fname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mother_mname'] =$allpandata['result']['personal_details']['mother_mname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mother_lname'] =$allpandata['result']['personal_details']['mother_lname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fullname'] =$allpandata['result']['personal_details']['mother_fullname'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] ='+'.$allpandata['result']['personal_details']['mob_code'].$allpandata['result']['personal_details']['mob_num'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['pan'] =$allpandata['result']['personal_details']['pan'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['email'] = $allpandata['result']['personal_details']['email'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] = $allpandata['result']['personal_details']['dob'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['age'] = $kyccard['result']['age'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] = $allpandata['result']['personal_details']['gender'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permLine1'] = $allpandata['result']['personal_details']['perm_line1'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permLine2'] = $allpandata['result']['personal_details']['perm_line2'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['perm_line3'] = $allpandata['result']['personal_details']['perm_line3'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permCity'] = $allpandata['result']['personal_details']['perm_city'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permDist'] = $allpandata['result']['personal_details']['perm_dist'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permState'] = $allpandata['result']['personal_details']['perm_state'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permPin'] = $allpandata['result']['personal_details']['perm_pin'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permCountry'] = $allpandata['result']['personal_details']['perm_country'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['permPoa'] = $allpandata['result']['personal_details']['perm_poa'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['perm_corres_sameflag'] = $allpandata['result']['personal_details']['perm_corres_sameflag'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine1'] = $allpandata['result']['personal_details']['corres_line1'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine2'] = $allpandata['result']['personal_details']['corres_line2'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corres_line3'] = $allpandata['result']['personal_details']['corres_line3'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresCity'] = $allpandata['result']['personal_details']['corres_city'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresDist'] = $allpandata['result']['personal_details']['corres_dist'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresState'] = $allpandata['result']['personal_details']['corres_state'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresCountry'] = $allpandata['result']['personal_details']['corres_country'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresPoa'] = $allpandata['result']['personal_details']['corres_poa'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['corresPin'] = $allpandata['result']['personal_details']['corres_pin'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['resi_std_code'] = $allpandata['result']['personal_details']['resi_std_code'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['resi_tel_num'] = $allpandata['result']['personal_details']['resi_tel_num'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['off_tel_num'] = $allpandata['result']['personal_details']['off_tel_num'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['off_std_code'] = $allpandata['result']['personal_details']['off_std_code'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['remarks'] = $allpandata['result']['personal_details']['remarks'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['dec_date'] = $allpandata['result']['personal_details']['dec_date'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['dec_place'] = $allpandata['result']['personal_details']['dec_place'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['doc_sub'] = $allpandata['result']['personal_details']['doc_sub'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_date'] = $kyccard['result']['kyc_date'];
                    
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_name'] = $allpandata['result']['personal_details']['kyc_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_designation'] = $allpandata['result']['personal_details']['kyc_designation'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_branch'] = $allpandata['result']['personal_details']['kyc_branch'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_empcode'] = $allpandata['result']['personal_details']['kyc_empcode'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['org_name'] = $allpandata['result']['personal_details']['org_name'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['org_code'] = $allpandata['result']['personal_details']['org_code'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['numIdentity'] = $allpandata['result']['personal_details']['num_identity'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['numRelated'] = $allpandata['result']['personal_details']['num_related'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['numImages'] = $allpandata['result']['personal_details']['num_images'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['related_person_details'] = $allpandata['result']['related_person_details'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['identity_details'] = $allpandata['result']['identity_details'];
                    $searchkyc['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'] = $allpandata['result']['image_details'];
                      if($user->role_id == 1){
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                        }
                         if(isset( $allpandata['result']['image_details']) && $allpandata['result']['image_details']['image'][0]['sequence_no']=="1" || $allpandata['result']['image_details']['image'][1]['sequence_no']=="2" || $allpandata['result']['image_details']['image'][2]['sequence_no']=="3" ||  $allpandata['result']['image_details']['image'][3]['sequence_no']=="4"){
                               
                            $panvalidation = DB::table('search_new')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status' => 200,
                                'constitution_type' => isset($allpandata['result']['personal_details']['constitution_type'])?$allpandata['result']['personal_details']['constitution_type']:null,
                                'account_type' => isset($allpandata['result']['personal_details']['account_type'])?$allpandata['result']['personal_details']['account_type']:null,
                                'prefix' => isset($allpandata['result']['personal_details']['prefix'])?$allpandata['result']['personal_details']['prefix']:null,
                                'maiden_prefix' => isset($allpandata['result']['personal_details']['maiden_prefix'])?$allpandata['result']['personal_details']['maiden_prefix']:null,
                                'maiden_fname' => isset($allpandata['result']['personal_details']['maiden_fname'])?$allpandata['result']['personal_details']['maiden_fname']:null,
                                'maiden_mname' => isset($allpandata['result']['personal_details']['maiden_mname'])?$allpandata['result']['personal_details']['maiden_mname']:null,
                                'maiden_lname' => isset($allpandata['result']['personal_details']['maiden_lname'])?$allpandata['result']['personal_details']['maiden_lname']:null,
                                'maiden_fullname' => isset($allpandata['result']['personal_details']['maiden_fullname'])?$allpandata['result']['personal_details']['maiden_fullname']:null,
                                'father_prefix' => isset($allpandata['result']['personal_details']['father_prefix'])?$allpandata['result']['personal_details']['father_prefix']:null,
                                'father_fname' => isset($allpandata['result']['personal_details']['father_fname'])?$allpandata['result']['personal_details']['father_fname']:null,
                                'father_mname' => isset($allpandata['result']['personal_details']['father_mname'])?$allpandata['result']['personal_details']['father_mname']:null,
                                'father_lname' => isset($allpandata['result']['personal_details']['father_lname'])?$allpandata['result']['personal_details']['father_lname']:null,
                                'father_fullname' => isset($allpandata['result']['personal_details']['father_fullname'])?$allpandata['result']['personal_details']['father_fullname']:null,
                                'mother_prefix' => isset($allpandata['result']['personal_details']['mother_prefix'])?$allpandata['result']['personal_details']['mother_prefix']:null,
                                'mother_fname' => isset($allpandata['result']['personal_details']['mother_fname'])?$allpandata['result']['personal_details']['mother_fname']:null,
                                'mother_mname' => isset($allpandata['result']['personal_details']['mother_mname'])?$allpandata['result']['personal_details']['mother_mname']:null,
                                'mother_lname' => isset($allpandata['result']['personal_details']['mother_lname'])?$allpandata['result']['personal_details']['mother_lname']:null,
                                'mother_fullname' => isset($allpandata['result']['personal_details']['mother_fullname'])?$allpandata['result']['personal_details']['mother_fullname']:null,
                                'pan_no' => isset($allpandata['result']['personal_details']['pan'])?$allpandata['result']['personal_details']['pan']:null,
                                'ckycid' => isset($allpandata['result']['personal_details']['ckyc_no'])?$allpandata['result']['personal_details']['ckyc_no']:null,
                                'firstname' => isset($allpandata['result']['personal_details']['first_name'])?$allpandata['result']['personal_details']['first_name']:null,
                                'middle_name' => isset($allpandata['result']['personal_details']['middle_name'])?$allpandata['result']['personal_details']['middle_name']:null,
                                'last_name' => isset($allpandata['result']['personal_details']['last_name'])?$allpandata['result']['personal_details']['last_name']:null,
                                'fullname' =>isset($allpandata['result']['personal_details']['full_name'])?$allpandata['result']['personal_details']['full_name']:null,
                                'mobilenum' =>isset($allpandata['result']['personal_details']['mob_num'])?$allpandata['result']['personal_details']['mob_num']:null,
                                'email' =>isset($allpandata['result']['personal_details']['email'])?$allpandata['result']['personal_details']['email']:null,
                                'dob' => isset($allpandata['result']['personal_details']['dob'])?$allpandata['result']['personal_details']['dob']:null,
                                'age' => isset($kyccard['result']['age'])?$kyccard['result']['age']:null,
                                'gender' => isset($allpandata['result']['personal_details']['gender'])?$allpandata['result']['personal_details']['gender']:null,
                                'pstate' =>isset($allpandata['result']['personal_details']['perm_state'])?$allpandata['result']['personal_details']['perm_state']:null,
                                'pcity' =>isset($allpandata['result']['personal_details']['perm_city'])?$allpandata['result']['personal_details']['perm_city']:null,
                                'permCountry' =>isset($allpandata['result']['personal_details']['perm_country'])?$allpandata['result']['personal_details']['perm_country']:null,
                                'permPoa' =>isset($allpandata['result']['personal_details']['perm_poa'])?$allpandata['result']['personal_details']['perm_poa']:null,
                                'caddress1' =>isset($allpandata['result']['personal_details']['corres_line1'])?$allpandata['result']['personal_details']['corres_line1']:null,
                                'caddress2' =>isset($allpandata['result']['personal_details']['corres_line2'])?$allpandata['result']['personal_details']['corres_line2']:null,
                                'caddress3' =>isset($allpandata['result']['personal_details']['corres_line3'])?$allpandata['result']['personal_details']['corres_line3']:null,
                                'paddress' =>isset($allpandata['result']['personal_details']['permLine1'])?$allpandata['result']['personal_details']['permLine1']:null,
                                'paddress2' =>isset($allpandata['result']['personal_details']['permLine2'])?$allpandata['result']['personal_details']['permLine2']:null,
                                'paddress3' =>isset($allpandata['result']['personal_details']['perm_line3'])?$allpandata['result']['personal_details']['perm_line3']:null,
                                'perm_corres_sameflag' =>isset($allpandata['result']['personal_details']['perm_corres_sameflag'])?$allpandata['result']['personal_details']['perm_corres_sameflag']:null,
                                'cstate' =>isset($allpandata['result']['personal_details']['corres_state'])?$allpandata['result']['personal_details']['corres_state']:null,
                                'ccity' => isset($allpandata['result']['personal_details']['corres_city'])?$allpandata['result']['personal_details']['corres_city']:null,
                                'currentpincode' =>isset($allpandata['result']['personal_details']['corres_pin'])?$allpandata['result']['personal_details']['corres_pin']:null,
                                'permanantpincode' =>isset($allpandata['result']['personal_details']['perm_pin'])?$allpandata['result']['personal_details']['perm_pin']:null,
                                'branch_code1' =>isset($allpandata['result']['image_details']['image'][0]['branch_code'])?$allpandata['result']['image_details']['image'][0]['branch_code']:null,
                                'branch_code2' =>isset($allpandata['result']['image_details']['image'][1]['branch_code'])?$allpandata['result']['image_details']['image'][1]['branch_code']:null,
                                'branch_code3' => isset($allpandata['result']['image_details']['image'][2]['branch_code'])?$allpandata['result']['image_details']['image'][2]['branch_code']:null,
                                'branch_code4'=> isset($allpandata['result']['image_details']['image'][3]['branch_code'])?$allpandata['result']['image_details']['image'][3]['branch_code']:null,
                                'resi_std_code' =>isset($allpandata['result']['personal_details']['resi_std_code'])?$allpandata['result']['personal_details']['resi_std_code']:null,
                                'resi_tel_num' =>isset($allpandata['result']['personal_details']['resi_tel_num'])?$allpandata['result']['personal_details']['resi_tel_num']:null,
                                'off_std_code' => isset($allpandata['result']['personal_details']['off_std_code'])?$allpandata['result']['personal_details']['off_std_code']:null,
                                'remarks'=> isset($allpandata['result']['personal_details']['remarks'])?$allpandata['result']['personal_details']['remarks']:null,
                                'father_or_spouse_flag'=> isset($allpandata['result']['personal_details']['father_or_spouse_flag'])?$allpandata['result']['personal_details']['father_or_spouse_flag']:null,
                                'dec_date'=> isset($allpandata['result']['personal_details']['dec_date'])?$allpandata['result']['personal_details']['dec_date']:null,
                                'dec_place'=> isset($allpandata['result']['personal_details']['dec_place'])?$allpandata['result']['personal_details']['dec_place']:null,
                                'doc_sub'=> isset($allpandata['result']['personal_details']['doc_sub'])?$allpandata['result']['personal_details']['doc_sub']:null,
                                'kyc_date'=> isset($kyccard['result']['kyc_date'])?$kyccard['result']['kyc_date']:null,
                                'kyc_name'=> isset($allpandata['result']['personal_details']['kyc_name'])?$allpandata['result']['personal_details']['kyc_name']:null,
                                'kyc_designation'=> isset($allpandata['result']['personal_details']['kyc_designation'])?$allpandata['result']['personal_details']['kyc_designation']:null,
                                'kyc_branch'=> isset($allpandata['result']['personal_details']['kyc_branch'])?$allpandata['result']['personal_details']['kyc_branch']:null,
                                'kyc_empcode'=> isset($allpandata['result']['personal_details']['kyc_empcode'])?$allpandata['result']['personal_details']['kyc_empcode']:null,
                                'org_name'=> isset($allpandata['result']['personal_details']['org_name'])?$allpandata['result']['personal_details']['org_name']:null,
                                'org_code'=> isset($allpandata['result']['personal_details']['org_code'])?$allpandata['result']['personal_details']['org_code']:null,
                                'image_url1' =>isset($allpandata['result']['image_details']['image'][0]['image_url'])?$allpandata['result']['image_details']['image'][0]['image_url']:null,
                                'image_url2' =>isset($allpandata['result']['image_details']['image'][1]['image_url'])?$allpandata['result']['image_details']['image'][1]['image_url']:null,
                                'image_url3' => isset($allpandata['result']['image_details']['image'][2]['image_url'])?$allpandata['result']['image_details']['image'][2]['image_url']:null,
                                'image_url4'=> isset($allpandata['result']['image_details']['image'][3]['image_url'])?$allpandata['result']['image_details']['image'][3]['image_url']:null,
                                'image_code1' =>isset($allpandata['result']['image_details']['image'][0]['image_code'])?$allpandata['result']['image_details']['image'][0]['image_code']:null,
                                'image_code2' =>isset($allpandata['result']['image_details']['image'][1]['image_code'])?$allpandata['result']['image_details']['image'][1]['image_code']:null,
                                'image_code3' => isset($allpandata['result']['image_details']['image'][2]['image_code'])?$allpandata['result']['image_details']['image'][2]['image_code']:null,
                                'image_code4'=> isset($allpandata['result']['image_details']['image'][3]['image_code'])?$allpandata['result']['image_details']['image'][3]['image_code']:null,
                                'image_data1' =>isset($allpandata['result']['image_details']['image'][0]['image_data'])?$allpandata['result']['image_details']['image'][0]['image_data']:null,
                                'image_data2' => isset($allpandata['result']['image_details']['image'][1]['image_data'])?$allpandata['result']['image_details']['image'][1]['image_data']:null,
                                'image_data3'=> isset($allpandata['result']['image_details']['image'][2]['image_data'])?$allpandata['result']['image_details']['image'][2]['image_data']:null,
                                'image_data4'=> isset($allpandata['result']['image_details']['image'][3]['image_data'])?$allpandata['result']['image_details']['image'][3]['image_data']:null,
                                'ident_type1' =>isset($allpandata['result']['identity_details']['identity'][0]['ident_type'])?$allpandata['result']['identity_details']['identity'][0]['ident_type']:null,
                                'ident_type2' => isset($allpandata['result']['identity_details']['identity'][1]['ident_type'])?$allpandata['result']['identity_details']['identity'][1]['ident_type']:null,
                                'ident_type3'=> isset($allpandata['result']['identity_details']['identity'][2]['ident_type'])?$allpandata['result']['identity_details']['identity'][2]['ident_type']:null,
                                'ident_type4'=> isset($allpandata['result']['identity_details']['identity'][3]['ident_type'])?$allpandata['result']['identity_details']['identity'][3]['ident_type']:null,
                                'ident_num1'=> isset($allpandata['result']['identity_details']['identity'][0]['ident_num'])?$allpandata['result']['identity_details']['identity'][0]['ident_num']:null,
                                'ident_num2' =>isset($allpandata['result']['identity_details']['identity'][1]['ident_num'])?$allpandata['result']['identity_details']['identity'][1]['ident_num']:null,
                                'ident_num3' => isset($allpandata['result']['identity_details']['identity'][2]['ident_num'])?$allpandata['result']['identity_details']['identity'][2]['ident_num']:null,
                                'ident_num4' => isset($allpandata['result']['identity_details']['identity'][3]['ident_num'])?$allpandata['result']['identity_details']['identity'][3]['ident_num']:null,
                                'idver_status1'=> isset($allpandata['result']['identity_details']['identity'][0]['idver_status'])?$allpandata['result']['identity_details']['identity'][0]['idver_status']:null,
                                'idver_status2'=> isset($allpandata['result']['identity_details']['identity'][1]['idver_status'])?$allpandata['result']['identity_details']['identity'][1]['idver_status']:null,
                                'idver_status3'=> isset($allpandata['result']['identity_details']['identity'][2]['idver_status'])?$allpandata['result']['identity_details']['identity'][2]['idver_status']:null,
                                'idver_status4'=> isset($allpandata['result']['identity_details']['identity'][3]['idver_status'])?$allpandata['result']['identity_details']['identity'][3]['idver_status']:null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                          
                         }
                    return response()->json(['statusCode' => 200, 'response' =>$searchkyc]);
                } elseif (isset($allpandata['status']) && $allpandata['status'] == 'INVALID') {
                   
                        $statusCode = 102;
                        if($user->role_id == 1){
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                            }
                        }
                    
                            // return 'insert';
                            $panvalidation = DB::table('search_new')->insert([
                            'user_id' => $user->id,
                            'api_id' => $api_id,
                            'dob' => $dob,
                            'status' => 102,
                            'pan_no' => $request->panNumber,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                           ]);
                    $searchkyc['status'] = $allpandata['status'];
                    $searchkyc['error'] = $allpandata['error'];
                    return response()->json(['statusCode' => 102, 'response' => $searchkyc]);
                } else {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction success.',200);
                        }
                    }
                 
                    $panvalidation = DB::table('search_new')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        'dob' => $dob,
                        'status' => 202,
                        'pan_no' => $request->panNumber,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                 
                    return response()->json(['statusCode' => 202, 'response' => $allpandata]);
                }
                // return response()->json(json_decode($alldata,true));
                // return response()->json(['statusCode'=>200, 'response'=>$allpandata]);
            } else {
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $this->saveHitCount($user->id, $api_id, 'Transaction success.',200);
                    }
                }
                $panvalidation = DB::table('search_new')->insert([
                    'user_id' => $user->id,
                    'api_id' => $api_id,
                    'status' => 201,
                    'pan_no' => $request->panNumber,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json(['statusCode' => 201, 'response' => $kyccard]);
            }
        }
        else{
            return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
        }
           } else {
             return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
           }
       }
       //Bhunaksha Api
       elseif($request->has('bhumi_type') && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $bhunakash = null;
        $api_id = null;
        if (empty($request->has('State'))) {
            return response()->json([['status_code' => '404','message' => 'state is required',]]);
        }
        /*Bhunaksha Bihar*/
        if(!empty($request->State) && $request->get('State')=="bihar"){
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Subdiv'))) {
                return response()->json([['message' => 'subdiv is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Circle'))) {
                return response()->json([['message' => 'Circle is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Mauza'))) {
                return response()->json([['message' => 'mauza is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Surveytype'))) {
                return response()->json([['message' => 'surveytype is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Mapinstance'))) {
                return response()->json([['message' => 'mapinstance is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Sheetno'))) {
                return response()->json([['message' => 'sheetno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
             if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
             }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/biharplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Subdiv" => $request->Subdiv,
                        "Circle" => $request->Circle,
                        "Mauza" => $request->Mauza,
                        "Surveytype" => $request->Surveytype,
                        "Mapinstance" => $request->Mapinstance,
                        "sheetno" => $request->Sheetno,
                        "Plotno" => $request->Plotno
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $response =   curl_exec($curl);
                curl_close($curl);
                $bihar = json_decode($response, true);
                $bihar_info=null;
                if (isset($bihar['statuscode']) && $bihar['statuscode']==200) {
                    $bihar_info['Giscode']=isset($bihar['Giscode'])?$bihar['Giscode']:null;
                    $bihar_info['Plotinfo']=isset($bihar['Plotinfo'])? $bihar['Plotinfo']:null;
                    $bihar_info['Plotno']=isset($bihar['Plotno'])?$bihar['Plotno']:null;
                          if ($user->role_id == 1) {
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                          } 
                          if($user->role_id == 1 || $user->role_id == 0){
                            $bhunakasha_bihar = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($bihar['Giscode'])?$bihar['Giscode']:null,
                                'Plotinfo' =>isset($bihar['Plotinfo'])? $bihar['Plotinfo']:null,
                                'Plotno' =>isset($bihar['Plotno'])?$bihar['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state' => 'bihar',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                          }
                          
                        
                    return response()->json(['status_code' => 200, 'data' =>$bihar_info]);
                
                } elseif (isset($bihar['statuscode']) && $bihar['statuscode'] == 404) {
                    $statusCode = 202;
                    $errorMessage =$bihar['error_message'];
                    if($user->role_id == 1){
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    }
                    if ($user->role_id == 1 || $user->role_id == 0) {
                           $bhunakasha_bihar = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state' => 'bihar',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' =>202, 'message' => $errorMessage]);
                } 
                else{
                    $statusCode = 500;
                    $errorMessage =  'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                      if($user->role_id == 1){
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                       }
                     if ($user->role_id == 1 || $user->role_id == 0) {
                          
                            $bhunakasha_bihar = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state' => 'bihar',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' => 103, 'message' => 'Please recharge your wallet amount.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
        /*Bhunaksha Chhattisgarh*/
        elseif(!empty($request->State) && $request->get('State')=="chhattisgarh"){
           
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Tehsil'))) {
                return response()->json([['message' => 'tehsil is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Ri'))) {
                return response()->json([['message' => 'Ri is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
              }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/chhattisgarhplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Tehsil" => $request->Tehsil,
                        "Ri" => $request->Ri,
                        "Village" => $request->Village,
                        "Plotno" => $request->Plotno
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $chatishgrah = json_decode($response, true);
                $chatishgrah_info =null;
                if (isset($chatishgrah['statuscode']) && $chatishgrah['statuscode']==200) {
                    $chatishgrah_info['Giscode']=isset($chatishgrah['Giscode'])?$chatishgrah['Giscode']:null;
                    $chatishgrah_info['Plotinfo']=isset($chatishgrah['Plotinfo'])?$chatishgrah['Plotinfo']:null;
                    $chatishgrah_info['Plotno']=isset($chatishgrah['Plotno'])?$chatishgrah['Plotno']:null;

                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                           
                            $bhunakasha_chatishgrah = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($chatishgrah['Giscode'])?$chatishgrah['Giscode']:null,
                                'Plotinfo' =>isset($chatishgrah['Plotinfo'])?$chatishgrah['Plotinfo']:null,
                                'Plotno' =>isset($chatishgrah['Plotno'])?$chatishgrah['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state' => 'chatishgrah',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                     return response()->json(['status_code' => 200, 'data' =>$chatishgrah_info]);
                } elseif (isset($chatishgrah['statuscode']) && $chatishgrah['statuscode'] == 404) {
                    $statusCode = 202;
                    $errorMessage = $chatishgrah['error_message'];
                    if ($user->role_id == 1 || $user->role_id == 0) {
                          if($user->role_id == 1){
                            if ($apiamster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                            }
                        }
                            $bhunakasha_chatishgrah = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'state' => 'chatishgrah',
                                'message_code' => 'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' =>202, 'message' => $errorMessage]);
                } 
                else{
                    $statusCode = 500;
                    $errorMessage =  'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                    if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                           
                            $bhunakasha_chatishgrah = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state' => 'chatishgrah',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
            
      }
        /*Bhunaksha Uttar Pradesh*/
        elseif(!empty($request->State) && $request->get('State')=="up"){
          
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Tehsil'))) {
                return response()->json([['message' => 'tehsil is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                 }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
             if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                     }
             }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/upplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Tehsil" => $request->Tehsil,
                        "Village" => $request->Village,
                        "Plotno" => $request->Plotno
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $up_details = json_decode($response, true);
                $up_details_info =null;
                if (isset($up_details['statuscode']) && $up_details['statuscode']==200) {
                    $up_details_info['Giscode']=isset($up_details['Giscode'])?$up_details['Giscode']:null;
                    $up_details_info['Plotinfo']=isset($up_details['Plotinfo'])?$up_details['Plotinfo']:null;
                    $up_details_info['Plotno']=isset($up_details['Plotno'])?$up_details['Plotno']:null;
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                           
                            $bhunakasha_up = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($up_details['Giscode'])?$up_details['Giscode']:null,
                                'Plotinfo' =>isset($up_details['Plotinfo'])?$up_details['Plotinfo']:null,
                                'Plotno' =>isset($up_details['Plotno'])?$up_details['Plotno']:null,
                                'status_code' =>200,
                                'state'=>'up',
                                'message_code' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 200, 'data' =>$up_details_info]);
                } elseif (isset($up_details['statuscode']) && $up_details['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $up_details['error_message'];
                   
                        if ($user->role_id == 1 || $user->role_id == 1) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_up = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'up',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        
                    
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage =  'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                       if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            
                            $bhunakasha_up = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'up',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                     return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
        /*Bhunaksha kerala*/
        elseif(!empty($request->State) && $request->get('State')=="kerala"){
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Taluka'))) {
                return response()->json([['message' => 'taluka is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Blockno'))) {
                return response()->json([['message' => 'blockno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Surveyno'))) {
                return response()->json([['message' => 'surveyno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Subdivno'))) {
                return response()->json([['message' => 'subdivno is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
             if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
             }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/keralaplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Taluk" => $request->Taluka,
                        "Village" => $request->Village,
                        "Blockno" => $request->Blockno,
                        "Surveyno" => $request->Surveyno,
                        "Subdivno" => $request->Subdivno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $kerala_details = json_decode($response, true);
                $kerala_info=null;
                if (isset($kerala_details['statuscode']) && $kerala_details['statuscode']==200) {
                    $kerala_info['Giscode']=isset($kerala_details['Giscode'])?$kerala_details['Giscode']:null;
                    $kerala_info['Plotinfo']=isset($kerala_details['Plotinfo'])?$kerala_details['Plotinfo']:null;
                    $kerala_info['Plotno']=isset($kerala_details['Plotno'])?$kerala_details['Plotno']:null;
                 
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                           
                            $bhunakasha_kerala = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($kerala_details['Giscode'])?$kerala_details['Giscode']:null,
                                'area_details' =>isset($kerala_details['Plotinfo']['Area_details'])?$kerala_details['Plotinfo']['Area_details']:null,
                                'owner_details' =>isset($kerala_details['Plotinfo']['Owner_details'])?$kerala_details['Plotinfo']['Owner_details']:null,
                                'remark' =>isset($kerala_details['Plotinfo']['Remark'])?$kerala_details['Plotinfo']['Remark']:null,
                                'Plotno' =>isset($kerala_details['Plotno'])?$kerala_details['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state'=>'kerala',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                   
                    
                    return response()->json(['status_code' => 200, 'data' =>$kerala_info]);
                } elseif (isset($kerala_details['statuscode']) && $kerala_details['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $kerala_details['error_message'];
                 
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1 ){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                           
                            $bhunakasha_kerala = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'kerala',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        
                    
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                  
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_kerala = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'kerala',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
       
        }
        /*Bhunaksha Lakshadweep*/
        elseif(!empty($request->State) && $request->get('State')=="lakshadweep"){
          if (empty($request->has('District'))) {

                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Taluka'))) {

                return response()->json([['message' => 'taluka is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Surveyno'))) {

                return response()->json([['message' => 'surveyno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Village'))) {

                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {

                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {

                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                  $curl = curl_init();
                   curl_setopt_array($curl,array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/lakshadweepplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Taluk" => $request->Taluka,
                        "Village" => $request->Village,
                        "Survey" => $request->Surveyno,
                        "Plotno" => $request->Plotno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $lakshadweep_details = json_decode($response, true);
                $lakshadweep_info=null;
                if (isset($lakshadweep_details['statuscode']) && $lakshadweep_details['statuscode']==200) {
                    $lakshadweep_info['Giscode']=isset($lakshadweep_details['Giscode'])?$lakshadweep_details['Giscode']:null;
                    $lakshadweep_info['Plotinfo']=isset($lakshadweep_details['Plotinfo'])?$lakshadweep_details['Plotinfo']:null;
                    $lakshadweep_info['Plotno']=isset($lakshadweep_details['Plotno'])?$lakshadweep_details['Plotno']:null;
                      if ($user->role_id == 1 || $user->role_id == 0) {
                          if($user->role_id == 1){
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                          }
                           
                            $bhunakasha_lakshadweep = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($lakshadweep_details['Giscode'])?$lakshadweep_details['Giscode']:null,
                                'Plotinfo' =>isset($lakshadweep_details['Plotinfo'])?$lakshadweep_details['Plotinfo']:null,
                                'Plotno' =>isset($lakshadweep_details['Plotno'])?$lakshadweep_details['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state'=>'lakshadweep',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                     return response()->json(['status_code' => 200, 'data' =>$lakshadweep_info]);
                } elseif (isset($lakshadweep_details['statuscode']) && $lakshadweep_details['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $lakshadweep_details['error_message'];
                  
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                           
                            $bhunakasha_lakshadweep = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'lakshadweep',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                   
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_lakshadweep = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'lakshadweep',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                      
                    
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
        /*Bhunaksha Rajasthan*/
        elseif(!empty($request->State) && $request->get('State')=="rajasthan"){
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Tehsil'))) {
                return response()->json([['message' => 'tehsil is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Ri'))) {
                return response()->json([['message' => 'ri is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Halka'))) {
                return response()->json([['message' => 'halka is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Sheetno'))) {
                return response()->json([['message' => 'sheetno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/rajasthanplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Tehsil" => $request->Tehsil,
                        "Ri" => $request->Ri,
                        "Halkas" => $request->Halka,
                        "Village" => $request->Village,
                        "Sheetno" => $request->Sheetno,
                        "Plotno" => $request->Plotno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $rajasthan = json_decode($response, true);
                $rajasthan_info=null;
                if (isset($rajasthan['statuscode']) && $rajasthan['statuscode']==200) {
                    $rajasthan_info['Giscode']=isset($rajasthan['Giscode'])?$rajasthan['Giscode']:null;
                    $rajasthan_info['Plotinfo']=isset($rajasthan['Plotinfo'])?$rajasthan['Plotinfo']:null;
                    $rajasthan_info['Plotno']=isset($rajasthan['Plotno'])?$rajasthan['Plotno']:null;
                   
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                           
                            $bhunakasha_rajasthan = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($rajasthan['Giscode'])?$rajasthan['Giscode']:null,
                                'Plotinfo' =>isset($rajasthan['Plotinfo'])?$rajasthan['Plotinfo']:null,
                                'Plotno' =>isset($rajasthan['Plotno'])?$rajasthan['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state'=>'rajasthan',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                   
                    
                  return response()->json(['status_code' => 200, 'data' =>$rajasthan_info]);
                } elseif (isset($rajasthan['statuscode']) && $rajasthan['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $rajasthan['error_message'];
                  
                        if ($user->role_id == 1 ||$user->role_id ==0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_rajasthan = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'rajasthan',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        
                    
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                   
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_rajasthan = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'rajasthan',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
        /*Bhunaksha Goa*/
        elseif(!empty($request->State) && $request->get('State')=="goa"){
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Taluka'))) {
                return response()->json([['message' => 'taluka is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Sheetno'))) {
                return response()->json([['message' => 'sheetno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
             }
             $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                 }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/goaplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Taluka" => $request->Taluka,
                        "Village" => $request->Village,
                        "Sheetno" => $request->Sheetno,
                        "Plotno" => $request->Plotno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $goa_details = json_decode($response, true);
                $goa_info=null;
                if (isset($goa_details['statuscode']) && $goa_details['statuscode']==200) {
                    $goa_info['Giscode']=isset($goa_details['Giscode'])?$goa_details['Giscode']:null;
                    $goa_info['Plotinfo']=isset($goa_details['Plotinfo'])?$goa_details['Plotinfo']:null;
                    $goa_info['Plotno']=isset($goa_details['Plotno'])?$goa_details['Plotno']:null;
                   
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                         
                            $bhunakasha_goa = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($goa_details['Giscode'])?$goa_details['Giscode']:null,
                                'Plotinfo' =>isset($goa_details['Plotinfo'])?$goa_details['Plotinfo']:null,
                                'Plotno' =>isset($goa_details['Plotno'])?$goa_details['Plotno']:null,
                                'status_code' =>200,
                                'state'=>'goa',
                                'message_code' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 200, 'data' =>$goa_info]);
                } elseif (isset($goa_details['statuscode']) && $goa_details['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $goa_details['error_message'];
                    
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_goa = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'goa',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                 } 
                else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                    if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                          
                            $bhunakasha_goa = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'goa',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                      
                    
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet amount.']);
            }
          
          }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
    
        }
       /*Bhunaksha Jharkhand*/
        elseif(!empty($request->State) && $request->get('State')=="jharkhand"){
            
            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Halka'))) {
                return response()->json([['message' => 'halka is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Circle'))) {
                return response()->json([['message' => 'Circle is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Mauza'))) {
                return response()->json([['message' => 'mauza is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Sheetno'))) {
                return response()->json([['message' => 'sheetno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/jharkhandplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Circle" => $request->Circle,
                        "Halka" => $request->Halka,
                        "Mauza" => $request->Mauza,
                        "Sheetno" => $request->Sheetno,
                        "Plotno" => $request->Plotno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $jharkhand = json_decode($response, true);
                $jharkhand_info=null;
                if (isset($jharkhand['statuscode']) && $jharkhand['statuscode']==200) {
                    $jharkhand_info['Giscode']=isset($jharkhand['Giscode'])?$jharkhand['Giscode']:null;
                    $jharkhand_info['Plotinfo']=isset($jharkhand['Plotinfo'])?$jharkhand['Plotinfo']:null;
                    $jharkhand_info['Plotno']=isset($jharkhand['Plotno'])?$jharkhand['Plotno']:null;
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                           
                            $bhunakasha_jharkhand = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($jharkhand['Giscode'])?$jharkhand['Giscode']:null,
                                'Plotinfo' =>isset($jharkhand['Plotinfo'])?$jharkhand['Plotinfo']:null,
                                'Plotno' =>isset($jharkhand['Plotno'])?$jharkhand['Plotno']:null,
                                'status_code' =>200,
                                'message_code' => 'success',
                                'state'=>'jharkhand',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 200, 'data' =>$jharkhand_info]);
                } elseif (isset($jharkhand['statuscode']) && $jharkhand['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $jharkhand['error_message'];
                      if ($user->role_id == 1 || $user->role_id == 0) {
                           if($user->role_id == 1){
                            if ($apiamster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                            }
                           }
                          
                            $bhunakasha_jharkhand = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'message_code' => 'failed',
                                'state'=>'jharkhand',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage ='Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                     if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                           
                            $bhunakasha_jharkhand = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'message_code' => 'failed',
                                'state'=>'jharkhand',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                      
                    
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
           }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
         /*Bhunaksha Odisha*/
        elseif(!empty($request->State) && $request->get('State')=="odisha"){

            if (empty($request->has('District'))) {
                return response()->json([['message' => 'district is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Tehsil'))) {
                return response()->json([['message' => 'tehsil is required', 'statusCode' => '404']]);
            }  
            if (empty($request->has('Ri'))) {
                return response()->json([['message' => 'Ri is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Village'))) {
                return response()->json([['message' => 'village is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Sheetno'))) {
                return response()->json([['message' => 'sheetno is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('Plotno'))) {
                return response()->json([['message' => 'plot number is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
            $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'bhunaksha')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
            if ($updateHitCount || $user->role_id == 0) {
             if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://13.200.221.11:5000/odishaplotinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(array(
                        "District" => $request->District,
                        "Tehsil" => $request->Tehsil,
                        "Ri" => $request->Ri,
                        "Village" => $request->Village,
                        "Sheetno" => $request->Sheetno,
                        "Plotno" => $request->Plotno,
                    )),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $odisha = json_decode($response, true);
                $odisha_info=null;
                if (isset($odisha['statuscode']) && $odisha['statuscode']==200) {
                    $odisha_info['Giscode']=isset($odisha['Giscode'])?$odisha['Giscode']:null;
                    $odisha_info['Plotinfo']=isset($odisha['Plotinfo'])?$odisha['Plotinfo']:null;
                    $odisha_info['Plotno']=isset($odisha['Plotno'])?$odisha['Plotno']:null;
                      if ($user->role_id == 1 || $user->role_id == 0) {
                          if($user->role_id == 0){
                            if ($apiamster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                            }
                          }
                           
                            $bhunakasha_odisha = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Giscode' =>isset($odisha['Giscode'])?$odisha['Giscode']:null,
                                'Plotinfo' =>isset($odisha['Plotinfo'])?$odisha['Plotinfo']:null,
                                'Plotno' =>isset($odisha['Plotno'])?$odisha['Plotno']:null,
                                'status_code' =>200,
                                'state'=>'odisha',
                                'message_code' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 200, 'data' =>$odisha_info]);
                } elseif (isset($odisha['statuscode']) && $odisha['statuscode']==404) {
                    $statusCode = 202;
                    $errorMessage = $odisha['error_message'];
                       if ($user->role_id == 1 || $user->role_id == 0) {
                            if($user->role_id == 1){
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                           
                            $bhunakasha_odisha = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>202,
                                'state'=>'odisha',
                                'message_code' => 'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                } 
                else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error. Please contact techsupport@docboyz.in. for more details';
                      if ($user->role_id == 1 || $user->role_id == 0) {
                           if($user->role_id == 1){
                            if ($apiamster) {
                                $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                            }
                           }
                            
                            $bhunakasha_odisha = DB::table('bhunaksha')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code' =>500,
                                'state'=>'odisha',
                                'message_code' => 'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                }
            } 
            else {
                return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet.']);
            }
           }
          else {
            return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
          }
        }
        else{
            return response()->json(['status_code'=>103,'message'=>'Please enter valid state name']);
        }
      }
      /*End Bhunaksha api */
      /*Start Udyam Search Api New*/
      elseif($request->has('UdyamRegNumber') &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $udayam_details = null;
        $api_id = null;
        if (empty($request->has('UdyamRegNumber'))) {
            return response()->json([['message' => 'UdyamRegNumber is required', 'statusCode' => '404']]);
        }
        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug','udyamsearch')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc') 
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
          if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
               $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://13.200.221.11:5000/getudyamdetails',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode(array(
                 "UdyamRegNumber" => $request->UdyamRegNumber,
                 )),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            $udyamdetails = json_decode($response, true);
           // return   $udyamdetails;
            $udyamdetails_response =null;
            if (isset($udyamdetails['statuscode']) && $udyamdetails['statuscode'] == 200) {
                 $udyamdetails_response['essentials']["udyamNumber"] = $udyamdetails["Organization_details"]["Udyam Registration Number"];
                 $udyamdetails_response["id"] = null;
                 $udyamdetails_response["patronId"] = null;
                 $udyamdetails_response["result"]["generalInfo"]["udyamRegistrationNumber"] =$udyamdetails["Organization_details"]["Udyam Registration Number"];
                 $udyamdetails_response["result"]["generalInfo"]["gender"] =$udyamdetails["Organization_details"]["Gender"];
                 $udyamdetails_response["result"]["generalInfo"]["majorActivity"] =$udyamdetails["Organization_details"]["Major Activity"];
                 $udyamdetails_response["result"]["generalInfo"]["nameOfEnterprise"] =$udyamdetails["Organization_details"]["Name of Enterprise"];
                 $udyamdetails_response["result"]["generalInfo"]["organisationType"] =$udyamdetails["Organization_details"]["Organisation Type"];
                 $udyamdetails_response["result"]["generalInfo"]["socialCategory"] =$udyamdetails["Organization_details"]["Social Category"];
                 $udyamdetails_response["result"]["generalInfo"]["dateOfIncorporation"] =$udyamdetails["Organization_details"]["Date of Incorporation"];
                 $udyamdetails_response["result"]["generalInfo"]["dateOfCommencementOfProductionBusiness"] =$udyamdetails["Organization_details"]["Date of Commencement of Business"];
                 $udyamdetails_response["result"]["generalInfo"]["dic"] =null;
                 $udyamdetails_response["result"]["generalInfo"]["msmedi"] =null;
                 $udyamdetails_response["result"]["generalInfo"]["dateOfUdyamRegistration"]=null;
                 $udyamdetails_response["result"]["generalInfo"]["typeOfEnterprise"] =null;
                 $udyamdetails_response["result"]["enterpriseType"][0]['dataYear'] = null;
                 $udyamdetails_response["result"]["enterpriseType"][0]['classificationYear'] = $udyamdetails["Organization_details"]["Enterprise Classification"][0]['Classification Year'];
                 $udyamdetails_response["result"]["enterpriseType"][0]['enterpriseType']= $udyamdetails["Organization_details"]["Enterprise Classification"][0]['Enterprise Type'];
                 $udyamdetails_response["result"]["enterpriseType"][0]['classificationDate']= $udyamdetails["Organization_details"]["Enterprise Classification"][0]['Classification Date'];
                 $udyamdetails_response["result"]["enterpriseType"][0]['sn']= $udyamdetails["Organization_details"]["Enterprise Classification"][0]['SNo'];
                 $udyamdetails_response["result"]["unitsDetails"][0]['sn'] = null;
                 $udyamdetails_response["result"]["unitsDetails"][0]['unitName'] = $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Unit Name"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['flat'] =$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Flat/Door/Block No"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['building'] = $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Name of Premises/Building"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['villageTown'] = $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Village/Town"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['block'] =$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Block"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['road'] = $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Road/Street/Lane"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['city'] =  $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["City"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['pin'] =  $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Pin"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['state'] =  $udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["State"];
                 $udyamdetails_response["result"]["unitsDetails"][0]['district'] =$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["District"];
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['flatDoorBlockNo'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['nameOfPremisesBuilding'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['villageTown'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['block'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['roadStreetLane'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['city'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['state'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['pin'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['district'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['mobile'] =null;
                 $udyamdetails_response["result"]["officialAddressOfEnterprise"]['email'] =null;
                 $udyamdetails_response["result"]["nationalIndustryClassificationCodes"][0]['nic2Digit'] =null;
                 $udyamdetails_response["result"]["nationalIndustryClassificationCodes"][0]['nic4Digit'] =null;
                 $udyamdetails_response["result"]["nationalIndustryClassificationCodes"][0]['nic5Digit'] =null;
                 $udyamdetails_response["result"]["nationalIndustryClassificationCodes"][0]['activity'] =null;
                 $udyamdetails_response["result"]["nationalIndustryClassificationCodes"][0]['date'] =null;
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    }
                    $udyam_database = DB::table('udyamsearch')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        'udyam_number'=>isset($udyamdetails["Organization_details"]["Udyam Registration Number"])?$udyamdetails["Organization_details"]["Udyam Registration Number"]:null,
                        'dateOfCommencementOfProductionBusiness'=>isset($udyamdetails["Organization_details"]["Date of Commencement of Business"])?$udyamdetails["Organization_details"]["Date of Commencement of Business"]:null,
                        'date_of_incorporation'=>isset($udyamdetails["Organization_details"]["Date of Incorporation"])?$udyamdetails["Organization_details"]["Date of Incorporation"]:null,
                        'classificationDate'=>isset($udyamdetails["Organization_details"]["Enterprise Classification"][0]["Classification Date"])?$udyamdetails["Organization_details"]["Enterprise Classification"][0]["Classification Date"]:null,
                        'classificationYear'=>isset($udyamdetails["Organization_details"]["Enterprise Classification"][0]["Classification Year"])?$udyamdetails["Organization_details"]["Enterprise Classification"][0]["Classification Year"]:null,
                        'typeOfEnterprise'=>isset($udyamdetails["Organization_details"]["Enterprise Classification"][0]["Enterprise Type"])?$udyamdetails["Organization_details"]["Enterprise Classification"][0]["Enterprise Type"]:null,
                        'sn'=>isset($udyamdetails["Organization_details"]["Enterprise Classification"][0]["SNo"])?$udyamdetails["Organization_details"]["Enterprise Classification"][0]["SNo"]:null,
                        'gender'=>isset($udyamdetails["Organization_details"]["Gender"])?$udyamdetails["Organization_details"]["Gender"]:null,
                        'major_activity'=>isset($udyamdetails["Organization_details"]["Major Activity"])?$udyamdetails["Organization_details"]["Major Activity"]:null,
                        'name_of_enterprise'=>isset($udyamdetails["Organization_details"]["Name of Enterprise"])?$udyamdetails["Organization_details"]["Name of Enterprise"]:null,
                        'organisation_type'=>isset($udyamdetails["Organization_details"]["Organisation Type"])?$udyamdetails["Organization_details"]["Organisation Type"]:null,
                        'social_category'=>isset($udyamdetails["Organization_details"]["Social Category"])?$udyamdetails["Organization_details"]["Social Category"]:null,
                        'udyam_registration_number'=>isset($udyamdetails["Organization_details"]["Udyam Registration Number"])?$udyamdetails["Organization_details"]["Udyam Registration Number"]:null,
                        'block'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Block"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Block"]:null,
                        'city'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["City"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["City"]:null,
                        'district'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["District"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["District"]:null,
                        'FlatDoorBlockNo'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Flat/Door/Block No"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Flat/Door/Block No"]:null,
                        'NameOfPremisesBuilding'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Name of Premises/Building"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Name of Premises/Building"]:null,
                        'pin'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Pin"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Pin"]:null,
                        'roadStreetLane'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Road/Street/Lane"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Road/Street/Lane"]:null,
                        'state'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["State"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["State"]:null,
                        'unit_name'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Unit Name"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Unit Name"]:null,
                        'villageTown'=>isset($udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Village/Town"])?$udyamdetails["Organization_details"]["Unit/Plant Locations"][0]["Village/Town"]:null,
                        'status_code' => 200,
                        'message' =>"success",
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                
                return response()->json(['status_code' => 200, 'response' => $udyamdetails_response]);
            } elseif (isset($udyamdetails['statuscode']) && $udyamdetails['statuscode'] == 404) {
                $statusCode =202;
                $errorMessage = $udyamdetails['error_message'];
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    }
                    $udyam_database = DB::table('udyamsearch')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        'status_code' => 202,
                        'message' =>"failed",
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                return response()->json(['status_code' =>202, 'message' => $errorMessage]);
            }
            else {
                $statusCode = 500;
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                   if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                        }
                    }
                    $udyam_database = DB::table('udyamsearch')->insert([
                        'user_id' => $user->id,
                        'api_id' => $api_id,
                        'status_code' => 500,
                        'message' =>"failed",
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                 
              return response()->json(['status_code' =>500, 'message' => $errorMessage]);
            }
           
        } 
        else {
            return response()->json(['status_code' =>500, 'message' => 'Please recharge your wallet amount.']);
        }
       }
     else {
        return response()->json(['status_code' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
       }
       /*End Udyam Search Api New*/
       /*Address API Start */
       elseif($request->has('address_type')&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
      
         if($request->get('address_type')=="verify_address"){
            $statusCode = null;
            $verify_address = null;
            $api_id = null;
            if (empty($request->has('address'))) {
                return response()->json([['message' => 'address is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
             $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'verifyaddress')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'verifyaddress')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://13.200.221.11:5000/verify_address',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode(['address'=>$request->address]),
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'
                          ),
                    ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $verify_address = json_decode($response, true);
                    if (isset($verify_address['input_address'])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $verifyaddress = DB::table('verify_address')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'input_address'=>isset($verify_address['input_address'])?$verify_address['input_address']:null,
                                'match'=>isset($verify_address['match'])?$verify_address['match']:null,
                                'verified_address'=>isset($verify_address['verified_address'])?$verify_address['verified_address']:null,
                                'status_code'=>200,
                                'message_code'=>'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 200, 'data' =>$verify_address]);
                    } elseif (isset($verify_address['status']) && $verify_address['status']==408) {
                        $statusCode = 102;
                        $errorMessage = 'Verification Failed. Please enter correct address';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $verifyaddress = DB::table('verify_address')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }elseif(isset($verify_address['error']) && $verify_address['error'] == 'Address verification failed'){
                        $statusCode = 202;
                        $errorMessage = 'Address verification failed.';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $verifyaddress = DB::table('verify_address')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>202,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 202, 'message' => $errorMessage]);
                    }
                    else {
                        $statusCode = 500;
                        $errorMessage = 'Internal server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $verifyaddress = DB::table('verify_address')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>500,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                }
             } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
         elseif($request->get('address_type')=="get_place"){
            $statusCode = null;
            $get_place = null;
            $api_id = null;
            if (empty($request->has('longitude')) && empty($request->has('latitude'))) {
                return response()->json([['message' => 'At least one parameter is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
             $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'getplace')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'getplace')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $latitude = floatval($request->input('latitude'));
                        $longitude = floatval($request->input('longitude'));
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://13.200.221.11:5000/get-place',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode(array(
                                'long' => $longitude,
                                'lat' => $latitude
                            )),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        
                     $response = curl_exec($curl);
                    $get_place = json_decode($response, true);
                    if (isset($get_place[0]['label'])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $getplace = DB::table('get_place')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'Place'=>isset($get_place[0]['label'])?$get_place[0]['label']:null,
                                'longitude'=>isset($get_place[0]['point'][0])?$get_place[0]['point'][0]:null,
                                'latitude'=>isset($get_place[0]['point'][1])?$get_place[0]['point'][1]:null,
                                'status_code'=>200,
                                'message_code'=>'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 200, 'data' =>$get_place]);
                    } elseif (isset($get_place['error']) && $get_place['error']=="Failed to retrieve data") {
                        $statusCode = 102;
                        $errorMessage = 'Invalid details. Please enter correct details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $getplace = DB::table('get_place')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }
                    else {
                        $statusCode = 500;
                        $errorMessage = 'Internal server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $getplace = DB::table('get_place')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>500,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet amount.']);
                }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
         elseif($request->get('address_type')=="create_geofence"){
            $statusCode = null;
            $create_geofence = null;
            $api_id = null;
            if (empty($request->has('latitude'))) {
                return response()->json([['message' => 'latitude is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('longitude'))) {
                return response()->json([['message' => 'longitude is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('radius'))) {
                return response()->json([['message' => 'radius is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
             $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'creategeofence')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'creategeofence')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $latitude = floatval($request->input('latitude'));
                        $longitude = floatval($request->input('longitude'));
                        $radius = floatval($request->input('radius'));
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://13.200.221.11:5000/create-geofence',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode(array(
                                'latitude' => $longitude,
                                'longitude' => $latitude,
                                'radius' => $radius
                            )),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        
                     $response = curl_exec($curl);
                     $create_geofence = json_decode($response, true);
                    if (isset($create_geofence['GeofenceId'])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            $creategeofence = DB::table('create_geofence')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'CreateTime'=>isset($create_geofence['CreateTime'])?$create_geofence['CreateTime']:null,
                                'GeofenceId'=>isset($create_geofence['GeofenceId'])?$create_geofence['GeofenceId']:null,
                                'UpdateTime'=>isset($create_geofence['UpdateTime'])?$create_geofence['UpdateTime']:null,
                                'status_code'=>200,
                                'message_code'=>'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 200, 'data' =>$create_geofence]);
                    } elseif (isset($create_geofence['error']) && $create_geofence['error']=="Failed to retrieve data") {
                        $statusCode = 102;
                        $errorMessage = 'Invalid details. Please enter correct details.';
                         if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $creategeofence = DB::table('create_geofence')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }
                    else {
                        $statusCode = 500;
                        $errorMessage = 'Internal server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $creategeofence = DB::table('create_geofence')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>500,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
         elseif($request->get('address_type')=="auto_complate"){
            $statusCode = null;
            $auto_complate = null;
            $api_id = null;
            if (empty($request->has('text'))) {
                return response()->json([['message' => 'text is required', 'statusCode' => '404']]);
            }
            if (empty($request->has('maxResult'))) {
                return response()->json([['message' => 'maxResult is required', 'statusCode' => '404']]);
            }
            if($request->has('maxResult') && $request->maxResult>15){
                return response()->json([['message' => 'maxResult should be less then 15', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
             $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'autocomplate')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug', 'autocomplate')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $addressText = $request->input('text');
                        $maxResult = intval($request->input('maxResult'));
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://13.200.221.11:5000/autocomplete',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode(array(
                                'text' =>$addressText,
                                'maxResults' =>$maxResult,
                            )),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        
                     $response = curl_exec($curl);
                     $auto_complate = json_decode($response, true);
                    if (isset($auto_complate[0])) {
                        $autocomplate_res = [];
                        foreach($auto_complate as $key=>$address){
                            $autocomplate_res[]=[
                                'sn'=>$key+1,
                                'address'=>$address
                            ];
                        }
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                        }
                     return response()->json(['status_code' => 200, 'data' =>$autocomplate_res]);
                    } elseif (isset($auto_complate['error']) && $auto_complate['error']=="Failed to retrieve data") {
                        $statusCode = 102;
                        $errorMessage = 'Invalid details. Please enter correct details.';
                         if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }
                    elseif(empty($auto_complate[0])){
                        $statusCode =202;
                        $errorMessage = 'Invalid text. Please enter correct text.';
                         if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                        }
                        return response()->json(['status_code' =>202, 'message' => $errorMessage]);
                    }
                    else {
                        $statusCode = 500;
                        $errorMessage = 'Internal server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
         elseif($request->get('address_type')=="get_coordinate"){
            $statusCode = null;
            $get_coordinates = null;
            $api_id = null;
            if (empty($request->has('address'))) {
                return response()->json([['message' => 'address is required', 'statusCode' => '404']]);
            }
            if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
            }
             $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
            }
            $user = User::where('access_token', $request->header('AccessToken'))->first();
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','getcoordinate')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
                ->where('api_id', $api_id)
                ->orderBy('id', 'desc')
                ->first();
                if ($user->role_id == 0) {
                    $apiamster = ApiMaster::where('api_slug','getcoordinate')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                if ($updateHitCount || $user->role_id == 0) {
                    if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://13.200.221.11:5000/get-coordinates',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST =>'POST',
                            CURLOPT_POSTFIELDS => json_encode(array(
                             'address' =>$request->address,
                            )),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));
                        
                     $response = curl_exec($curl);
                     $get_coordinates = json_decode($response, true);
                    if (isset($get_coordinates[0])) {
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                                }
                            }
                            foreach($get_coordinates as $address){
                                   $longitude = isset($address['point'][0]) ? $address['point'][0] : null;
                                   $latitude = isset($address['point'][1]) ? $address['point'][1] : null;
                                   $getcoordinates = DB::table('get_coordinate')->insert([
                                    'user_id' => $user->id,
                                    'api_id' => $api_id,
                                    'address'=>isset($address['label'])?$address['label']:null,
                                    'latitude'=> $latitude,
                                    'longitude'=> $longitude,
                                    'relevance'=>isset($address['relevance'])?$address['relevance']:null,
                                    'status_code'=>200,
                                    'message_code'=>'success',
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ]);
                             }
                           
                        }
                        return response()->json(['status_code' => 200, 'data' => $get_coordinates]);
                    } elseif (isset($get_coordinates['error']) && $get_coordinates['error']=="Failed to retrieve data") {
                        $statusCode = 102;
                        $errorMessage = 'Invalid address. Please enter correct address.';
                         if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', $statusCode);
                                }
                            }
                            $getcoordinates = DB::table('get_coordinate')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => 102, 'message' => $errorMessage]);
                    }
                    else {
                        $statusCode = 500;
                        $errorMessage = 'Internal server Error. Please contact techsupport@docboyz.in. for more details';
                        if ($user->role_id == 1 || $user->role_id == 0) {
                            if ($user->role_id == 1) {
                                if ($apiamster) {
                                    $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                                }
                            }
                            $getcoordinates = DB::table('get_coordinate')->insert([
                                'user_id' => $user->id,
                                'api_id' => $api_id,
                                'status_code'=>500,
                                'message_code'=>'failed',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                        return response()->json(['status_code' => $statusCode, 'message' => $errorMessage]);
                    }
                } else {
                    return response()->json(['statusCode' =>500, 'message' => 'Please recharge your wallet.']);
                }
            } else {
                return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
            }
         }
         else{
            return response()->json(['statusCode' => 103, 'message' => 'Invalid address type parameter.']);
         }
       
       }
       // Equifax Ecredit Api
       elseif($request->has('credit') && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
          $validator = Validator::make($request->all(), [
            'mobileNumber' => 'required|regex:/^[0-9]{10}$/',
           ]);
         if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'Forbidden',
                    'errors' => $validator->errors(),
                ],
                403
            );
        }

        $sql = DB::table('equifax_pdf_request')->insert([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'contactNo' => $request->mobileNumber,
            'idValue' => $request->pan_num,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $api_id = null;
        // $validator = Validator::make($request -> all(),[
        //     // 'FirstName' => ['required','string','max:255'],
        //     // 'LastName' => ['required','string','max:255'],
        //     'ContactNo' => ['required','string','max:255'],
        //     'IDValue' => ['required'],
        // ]);
        $record_id = DB::table('equifax_pdf_request')
            ->orderBy('id', 'desc')
            ->first();
        $aadhar_num = $request->aadhar_num ? $request->aadhar_num : null;
        $pan_num = $request->pan_num ? $request->pan_num : null;
        $voter_id = $request->voter_num ? $request->voter_num : null;
        $passport = $request->passport_num ? $request->passport_num : null;
        $driving_licence = $request->driving_num ? $request->driving_num : null;

        // if($validator -> fails())
        //     return response() -> json(['Errors' => $validator -> errors(),
        //                                 'statusCode' => '404']);
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'equifax')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $uname = $user->name;
        // $uname = DB::table('users')->where('id', Auth::id())->get()->first();
        $arr = explode(' ', trim($uname));
        $usr = '';
        $substr = '';
        foreach ($arr as $array) {
            $substr = substr($array, 0, 1);
            $usr = $usr . $substr;
        }
        $recordId = sprintf('%04d', $record_id->id);
        $CustRefField = 'DB-' . strtoupper($usr) . Carbon::now()->format('y') . Carbon::now()->format('m') . $recordId;
        $body = [
            'RequestHeader' => [
                'CustomerId' => '7656',
                'UserId' => 'STS_LOANTA',
                'Password' => 'W3#QeicsB',
                'MemberNumber' => '027FP27964',
                'SecurityCode' => '6IT',
                'ProductCode' => ['PCRLT'],
                'CustRefField' => $CustRefField,
            ],
            'RequestBody' => [
                'InquiryPurpose' => '16',
                'FirstName' => $request->fname,
                'MiddleName' => '',
                'LastName' => $request->lname,
                'DOB' => $request->dob,
                'InquiryPhones' => [
                    [
                        'seq' => '1',
                        'Number' => $request->mobileNumber,
                        'PhoneType' => ['M'],
                    ],
                ],
                'IDDetails' => [
                    [
                        'seq' => '1',
                        'IDType' => 't',
                        'IDValue' => $request->pan_num,
                        'Source' => 'Inquiry',
                    ],
                ],
            ],
            'Score' => [
                [
                    'Type' => 'ERS',
                    'Version' => '3.1',
                ],
            ],
        ];
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {

            try {
                $client = new Client();
                $res = $client->post($this->equifax_url, ['json' => $body]);
                $response = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                    }
                }
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                if ($statusCode == 500) {
                    $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    if ($user->role_id == 1) {
                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed', $statusCode);
                    }
                } elseif ($statusCode == 422) {
                    $statusCode = 102;
                    $errorMessage = 'Verification Failed. Please enter valid details.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                        }
                    }
                } else {
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                        }
                    }
                }
                return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            }
        }
        else{
            return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
        }
        } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
        $equifaxstatus = $response['CCRResponse']['CIRReportDataLst'][0]['InquiryResponseHeader']['HitCode'];
        // return $equifax;
        if ($equifaxstatus > 0) {
            return response()->json(['Equifax_Report' => $response, 'statusCode' => '200']);
        } else {
            // return response()->json(['statusCode'=>102, 'message'=>'Please enter valid details']);
            return response()->json(['statusCode' => 102, 'message' => $response]);
        }
       }
       elseif($request->has('bank') && $request->has('accounttype') &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
       
        $api_id = null;
        if (!$request->hasFile('bank_Statement')) {
            return json_encode(['message' => 'bank_Statement  not found'], true);
        }

        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'bank_statement')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $client = new Client();
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();

        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0) {
                $curl = curl_init();
                 curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://eyfnupbb4d.execute-api.ap-south-1.amazonaws.com/bankStatement/transactions',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => [
                    'bankStmt' => new \CURLFILE($_FILES['bank_Statement']['tmp_name'], $_FILES['bank_Statement']['type'], $_FILES['bank_Statement']['name']),
                    'bank' => $request->bank,
                    'accountType' => $request->accounttype,
                ],
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJEb2NCb3l6IiwiaWF0IjoxNjkzMzEyNTg2OTc4fQ.mMgl0deNRbkCXT0LnE8t7hRbTkwoK9TbnCrAS-TtjR4'
                  ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $bankstatement = json_decode($response , true);
                if (!empty($bankstatment['message'])) {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',500);
                        }
                    }
                    return response()->json(['statusCode' => 500, 'Message' => 'Internal Server Error']);
                }
                $bankstatment1 = [];
                foreach ($bankstatement['data'] as $bankstatments) {

                    $bankstatment2['amount'] = $bankstatments['amount'];
                    $bankstatment2['balanceAfterTransaction'] = $bankstatments['balanceAfterTransaction'];
                    $bankstatment2['bank'] = $bankstatments['bank'];
                    $bankstatment2['batchID'] = $bankstatments['batchID'];
                    $bankstatment2['category'] = $bankstatments['category'];
                    $bankstatment2['dateTime'] = $bankstatments['dateTime'];
                    $bankstatment2['description'] = $bankstatments['description'];
                    $bankstatment2['remark'] = $bankstatments['remark'];
                    $bankstatment2['transactionId'] = $bankstatments['transactionId'];
                    $bankstatment2['transactionNumber'] = $bankstatments['transactionNumber'];
                    $bankstatment2['type'] = $bankstatments['type'];
                    $bankstatment2['valueDate'] = $bankstatments['valueDate'];
                    $bankstatment3['data'] = $bankstatment2;
                    array_push($bankstatment1, $bankstatment3['data']);
                }

                // return $bankstatment1;
                if ($bankstatement['statusCode'] == '201') {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        return response()->json(['statusCode' => 200, 'response' => $bankstatment1]);
                    }
                    return response()->json(['statusCode' => 200, 'response' => $bankstatment1]);
                } else {
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                        $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed',500);
                        }
                    }
                    return response()->json(['statusCode' => 500, 'response' => $bankstatment1['error']]);
                }
            }
            else{
                return response()->json(['statusCode'=>500 ,'message'=>'Please Recharage your wallet.']);
            }
         } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
       }
       //Bank Details APIS END
       //pantogstin api
       elseif($request->has('pancard_number') &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $pancardtogst = null;
        $api_id = null;
        $apimaster = null;
        if (empty($request->pancard_number)) {
            return response()->json([['message' => 'Pancard number is required', 'statusCode' => '404']]);
        }
        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apimaster = ApiMaster::where('api_slug', 'pantogst')->first();
            if ($apimaster) {
                $api_id = $apimaster->id;
            }
        } 
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
        ];
        $groupId = rand(100,10000000000);
        $checkId = rand(100,10000000000);
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
            try {
                $response= $client->get('https://api.kyckart.com/api/gst/panToGstv2', [
                    'headers' => $headers,
                    'query' => [
                        'panNumber' => $request->pancard_number,
                        'checkId' =>$groupId, 
                        'groupId' => $checkId,
                    ]
                ]);
                $pancardtogst = json_decode($response->getBody(), true);
                if (isset($pancardtogst['status']['statusCode']) && $pancardtogst['status']['statusCode'] == 200) {
                    if($pancardtogst['status']['statusCode'] == 200 && !empty($pancardtogst['response']['code']) && $pancardtogst['response']['code']  == 400){
                        $statusCode = 102;
                        $errorMessage = 'No data found.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                            DB::table('pantogstin')->insert([
                                'user_id'=>$user->id,
                                'api_id'=>$api_id,
                                'status_code'=>500,
                                'message'=>'success',
                                'check_id'=>isset($checkId)?$checkId:null,
                                'group_id'=>isset($groupId)?$groupId:null,
                                'vender_status_code'=>isset($pancardtogst['status']['statusCode'])?$pancardtogst['status']['statusCode']:null,
                                'vender_code'=>isset($pancardtogst['response']['code'])?$pancardtogst['response']['code']:null,
                                'pan_number'=>isset($request->pancard_number)?$request->pancard_number:null,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                               ]);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                      if ($user->role_id == 1) {
                          if ($apimaster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                           
                         }
                         foreach($pancardtogst['response'] as $data){
                            DB::table('pantogstin')->insert([
                             'user_id'=>$user->id,
                             'api_id'=>$api_id,
                             'status_code'=>200,
                             'message'=>'success',
                             'check_id'=>isset($checkId)?$checkId:null,
                             'group_id'=>isset($groupId)?$groupId:null,
                             'vender_status_code'=>isset($pancardtogst['status']['statusCode'])?$pancardtogst['status']['statusCode']:null,
                             'vender_code'=>isset($pancardtogst['response']['code'])?$pancardtogst['response']['code']:null,
                             'lgnm'=>isset($data['lgnm'])?$data['lgnm']:null,
                             'gstin'=>isset($data['gstin'])?$data['gstin']:null,
                             'tradeName'=>isset($data['tradeNam'])?$data['tradeNam']:null,
                             'ctb'=>isset($data['ctb'])?$data['ctb']:null,
                             'rgdt'=>isset($data['rgdt'])?$data['rgdt']:null,
                             'lstupdt'=>isset($data['lstupdt'])?$data['lstupdt']:null,
                             'pan_number'=>isset($request->pancard_number)?$request->pancard_number:null,
                             'created_at'=>Carbon::now(),
                             'updated_at'=>Carbon::now(),
                            ]);
                         }
                       }
                      return response()->json(['response' =>$pancardtogst['response'], 'status_code' => 200, 'success' => true, 'message_code' => 'success']); 
                    }
                  else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                          
                        }
                        DB::table('pantogstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>500,
                            'message'=>'success',
                            'check_id'=>isset($checkId)?$checkId:null,
                            'group_id'=>isset($groupId)?$groupId:null,
                            'vender_status_code'=>isset($pancardtogst['status']['statusCode'])?$pancardtogst['status']['statusCode']:null,
                            'vender_code'=>isset($pancardtogst['response']['code'])?$pancardtogst['response']['code']:null,
                            'pan_number'=>isset($request->pancard_number)?$request->pancard_number:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                           ]);
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            } catch (BadResponseException $e) {
                $response = $e->getResponse();
                $errorResponse = json_decode($response->getBody(), true);
                $statusCode = $e->getResponse()->getStatusCode();
                if ($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002') {
                    $statusCode = 102;
                    $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                           
                        }
                        DB::table('pantogstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>102,
                            'message'=>'success',
                            'check_id'=>isset($checkId)?$checkId:null,
                            'group_id'=>isset($groupId)?$groupId:null,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['response']['code'])?$errorResponse['response']['code']:null,
                            'pan_number'=>isset($request->pancard_number)?$request->pancard_number:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                           ]);
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                } else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                          
                        }
                        DB::table('pantogstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>500,
                            'message'=>'success',
                            'check_id'=>isset($checkId)?$checkId:null,
                            'group_id'=>isset($groupId)?$groupId:null,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['response']['code'])?$errorResponse['response']['code']:null,
                            'pan_number'=>isset($request->pancard_number)?$request->pancard_number:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                           ]);
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
           
        }
        else {
            return response()->json(['statusCode' => 500, 'message' => 'Please recharage your wallet.']);
        }
        } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
       }
       //basic gstin api_kyckart
       elseif($request->has('gstin_number')&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $gstbasic_verification = null;
        $api_id = null;
        $apimaster = null;
        if (empty($request->gstin_number)) {
            return response()->json([['message' => 'gstin number is required', 'statusCode' => '404']]);
        }
        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apimaster = ApiMaster::where('api_slug', 'gstin')->first();
            if ($apimaster) {
                $api_id = $apimaster->id;
            }
        } 
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'x-api-key' => '24r4figxopl5lw0b3nmlwf414jry1d0hq',
        ];
        $groupId = rand(100,10000000000);
        $checkId = rand(100,10000000000);
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
            try {
                $response= $client->post('https://api.kyckart.com/api/v2/gst/basic', [
                    'headers' => $headers,
                    'json' => [
                        'gstin' => $request->gstin_number,
                        'checkId' =>$groupId, 
                        'groupId' => $checkId,
                    ]
                ]);
                $gstbasic_verification = json_decode($response->getBody(), true);
                if (isset($gstbasic_verification['status']['statusCode']) && $gstbasic_verification['status']['statusCode'] == 200 && empty($gstbasic_verification['error']['code'])) {
                    if($gstbasic_verification['status']['statusCode'] == 200 && !empty($gstbasic_verification['response']['code']) && $gstbasic_verification['response']['code']  == 400){
                        $statusCode = 102;
                        $errorMessage = 'No data found.';
                        if ($user->role_id == 1) {
                            if ($apimaster) {
                                $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                            }
                            DB::table('gstin')->insert([
                                'user_id'=>$user->id,
                                'api_id'=>$api_id,
                                'status_code'=>102,
                                'message_code'=>'failed',
                                'gstin_number'=>$request->gstin_number,
                                'groupId'=>$groupId,
                                'checkId'=> $checkId,
                                'vendor_code'=>isset($gstbasic_verification['error']['code'])?$gstbasic_verification['error']['code']:null,
                                'vender_status_code'=>isset($gstbasic_verification['status']['statusCode'])?$gstbasic_verification['status']['statusCode']:null,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                                
                            ]);
                        }
                        return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                    }
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Success.', 200);
                        }
                        DB::table('gstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>200,
                            'message_code'=>'success',
                            'gstin_number'=>isset($gstbasic_verification['response']['gstin'])?$gstbasic_verification['response']['gstin']:null,
                            'dateOfRegistration'=>isset($gstbasic_verification['response']['rgdt'])?$gstbasic_verification['response']['rgdt']:null,
                            'lastUpdatedDate'=>isset($gstbasic_verification['response']['lstupdt'])?$gstbasic_verification['response']['lstupdt']:null,
                            'tradeName'=>isset($gstbasic_verification['response']['tradeNam'])?$gstbasic_verification['response']['tradeNam']:null,
                            'groupId'=>$groupId,
                            'checkId'=> $checkId,
                            'vendor_code'=>isset($gstbasic_verification['error']['code'])?$gstbasic_verification['error']['code']:null,
                            'vender_status_code'=>isset($gstbasic_verification['status']['statusCode'])?$gstbasic_verification['status']['statusCode']:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                            
                        ]);
                    }
                    return response()->json(['response' =>$gstbasic_verification['response'], 'status_code' => 200, 'success' => true, 'message_code' => 'success']); 
                }
                elseif($gstbasic_verification['status']['statusCode'] == 200 && $gstbasic_verification['error']['code']  == "E0010003"){

                    $statusCode = 102;
                    $errorMessage = 'Invalid GSTIN / UID';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                        DB::table('gstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>102,
                            'message_code'=>'failed',
                            'gstin_number'=>$request->gstin_number,
                            'groupId'=>$groupId,
                            'checkId'=> $checkId,
                            'vendor_code'=>isset($gstbasic_verification['error']['code'])?$gstbasic_verification['error']['code']:null,
                            'vender_status_code'=>isset($gstbasic_verification['status']['statusCode'])?$gstbasic_verification['status']['statusCode']:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                            
                        ]);
                        return response()->json([ 'status_code' => 102,'message' =>$errorMessage]); 
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
                  else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                        }
                        DB::table('gstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>500,
                            'message_code'=>'failed',
                            'gstin_number'=>$request->gstin_number,
                            'groupId'=>$groupId,
                            'checkId'=> $checkId,
                            'vendor_code'=>isset($gstbasic_verification['error']['code'])?$gstbasic_verification['error']['code']:null,
                            'vender_status_code'=>isset($gstbasic_verification['status']['statusCode'])?$gstbasic_verification['status']['statusCode']:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                            
                        ]);
                    }
                  
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            
            } catch (BadResponseException $e) {
                $response = $e->getResponse();
                $errorResponse = json_decode($response->getBody(), true);
                $statusCode = $e->getResponse()->getStatusCode();
                if ($errorResponse['error']['code'] == 'E0010002') {
                    $statusCode = 102;
                    $errorMessage = 'Gstin Number InValid Please Enter Gstin PanNumber.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed.', 102);
                        }
                        DB::table('gstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>102,
                            'message_code'=>'failed',
                            'gstin_number'=>$request->gstin_number,
                            'groupId'=>$groupId,
                            'checkId'=> $checkId,
                            'vendor_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                            
                        ]);
                    }
                   
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                } else {
                    $statusCode = 500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apimaster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', $statusCode);
                        }
                        DB::table('gstin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'status_code'=>500,
                            'message_code'=>'failed',
                            'gstin_number'=>$request->gstin_number,
                            'groupId'=>$groupId,
                            'checkId'=> $checkId,
                            'vendor_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                            
                        ]);
                    }
                 
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                }
            }
        }
        else {
            return response()->json(['statusCode' =>500, 'message' => 'Please recharage your wallet.']);
        }   
        } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }   
       }
       //send otp
       elseif($request->has('mobile_no') && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){

        if (empty($request->mobile_no)) {
            return response()->json([['message' => 'Mobile is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
         if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
          }

        if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
         }
         $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
         if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
          }
        $user = User::where('access_token', $request->header('AccessToken'))->first();
		$authKey = "368753AXggrthFX61713441P1";
        $senderId = "DocBoy";
        $message = urlencode(    
            "Dear%20Customer,2323%20OTP%20for%20Login%20Thank%20You%20Team%20DocBoyz"
        );
       
        $prt = '91';
        $newno = $prt.$request->mobile_no;
        $otp= rand(100,10000);
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $newno,
            'message' => $message,
            'sender' => $senderId,
            'otp' =>$otp,
        );
       
        $url = "https://api.msg91.com/api/sendotp.php?authkey=368753AXggrthFX61713441P1&mobiles=$newno&message=Dear%20Customer,$otp%20OTP%20for%20Login%20Thank%20You%20Team%20DocBoyz&sender=DocBoy&otp=$otp&DLT_TE_ID=1307163462070500440";
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
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return response()->json(['status_code'=>102,'message'=>$err,'success'=>false]);
         } else {
              DB::table('sendotp')->insert([
                'mobile_number'=>$newno,
                'otp'=>$otp,
                'user_id'=>$user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now() 
              ]);
            return response()->json(['status_code'=>200,'otp'=>$otp, 'message'=>"otp has been sent successfully."]);
        }
      
       }
       //confirm otp
       elseif($request->has('mobileNo') && $request->has('otp') && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
         
        if ($request->has('mobileNo') == false) {
            return response()->json([
                'status' => 'false',
                'message' => "Mobile Number Required."
            ]);
        }
        if ($request->has('otp') == false) {
            return response()->json([
                'status' => 'false',
                'message' => "OTP Required."
            ]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
         if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
          }

        if (!$request->headers->has('AccessToken')) {
                return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
         }
         $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
         if ($verifyAccessToken == false) {
                return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
          }
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $prt = '91';
        $mobileNumber =$prt.$request->mobileNo;
        $otp = $request->otp;
        $loginUser = DB::table('sendotp')->
               where('user_id', $user->id)->
               where('mobile_number',$mobileNumber)->where('otp',$otp)->
               orderBy('created_at','DESC')->first();  
        if(isset($loginUser) &&   $loginUser != null){
              return response()->json([
                    'status_code' =>200,
                    'message' => 'mobile number verified successfully.',
                ]);
    
        }
        elseif(empty($loginUser) && $loginUser==null){
            return response()->json([
                'status_code' =>102,
                'message' => 'mobile number verified unsuccessfully.',
            ]);
        }
        else{
            return response()->json([
                'status_code' =>401,
                'message' => "Invalid OTP! And Mobile Number Please provide a valid mobile number or otp."
            ]);
        } 
       }
       elseif($request->has('cinNumber')&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $corporate_cin = null;
        $api_id = null;
        if (empty($request->cinNumber)) {
            return response()->json([['message' => 'CIN number is required', 'statusCode' => '404']]);
        }

        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }

        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'cin')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }

        $client = new Client();
        $headers = [
            'x-api-key' =>'24r4figxopl5lw0b3nmlwf414jry1d0hq',
            'Accept' => 'application/json',
        ];
        $groupId = rand(100,10000000000);
        $checkId = rand(100,10000000000);

        $body = [
            'cinNumber' => $request->cinNumber,
            'checkId'=>$checkId,
            'groupId'=>$groupId,
        ];
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
            try {
                $res = $client->post('https://api.kyckart.com/api/roc/cin-advanced', ['headers' => $headers, 'json' => $body]);
                $corporate_cin = json_decode($res->getBody(), true);
                $corporate_cin_details = null;
                 if(isset($corporate_cin['response']['code']) && $corporate_cin['response']['code']==200 && $corporate_cin['status']['statusCode']==200){
                    $corporate_cin_details['data']['cin']=isset($corporate_cin['response']['cin'])?$corporate_cin['response']['cin']:null;
                    $corporate_cin_details['data']['numberOfMembers']=isset($corporate_cin['response']['numberOfMembers'])?$corporate_cin['response']['numberOfMembers']:null;
                    $corporate_cin_details['data']['subCategory']=isset($corporate_cin['response']['subCategory'])?$corporate_cin['response']['subCategory']:null;
                    $corporate_cin_details['data']['class']=isset($corporate_cin['response']['class'])?$corporate_cin['response']['class']:null;
                    $corporate_cin_details['data']['companyType']=isset($corporate_cin['response']['companyType'])?$corporate_cin['response']['companyType']:null;
                    $corporate_cin_details['data']['companyName']=isset($corporate_cin['response']['companyName'])?$corporate_cin['response']['companyName']:null;
                    $corporate_cin_details['data']['paidUpCapital']=isset($corporate_cin['response']['paidUpCapital'])?$corporate_cin['response']['paidUpCapital']:null;
                    $corporate_cin_details['data']['authorisedCapital']=isset($corporate_cin['response']['authorisedCapital'])?$corporate_cin['response']['authorisedCapital']:null;
                    $corporate_cin_details['data']['whetherListed']=isset($corporate_cin['response']['whetherListed'])?$corporate_cin['response']['whetherListed']:null;
                    $corporate_cin_details['data']['dateOfIncorporation']=isset($corporate_cin['response']['dateOfIncorporation'])?$corporate_cin['response']['dateOfIncorporation']:null;
                    $corporate_cin_details['data']['lastAgmDate']=isset($corporate_cin['response']['lastAgmDate'])?$corporate_cin['response']['lastAgmDate']:null;
                    $corporate_cin_details['data']['registrationNumber']=isset($corporate_cin['response']['registrationNumber'])?$corporate_cin['response']['registrationNumber']:null;
                    $corporate_cin_details['data']['registeredAddress']=isset($corporate_cin['response']['registeredAddress'])?$corporate_cin['response']['registeredAddress']:null;
                    $corporate_cin_details['data']['activeCompliance']=isset($corporate_cin['response']['activeCompliance'])?$corporate_cin['response']['activeCompliance']:null;
                    $corporate_cin_details['data']['suspendedAtStockExchange']=isset($corporate_cin['response']['suspendedAtStockExchange'])?$corporate_cin['response']['suspendedAtStockExchange']:null;
                    $corporate_cin_details['data']['balanceSheetDate']=isset($corporate_cin['response']['balanceSheetDate'])?$corporate_cin['response']['balanceSheetDate']:null;
                    $corporate_cin_details['data']['category']=isset($corporate_cin['response']['category'])?$corporate_cin['response']['category']:null;
                    $corporate_cin_details['data']['status']=isset($corporate_cin['response']['status'])?$corporate_cin['response']['status']:null;
                    $corporate_cin_details['data']['rocOffice']=isset($corporate_cin['response']['rocOffice'])?$corporate_cin['response']['rocOffice']:null;
                    $corporate_cin_details['data']['countryOfIncorporation']=isset($corporate_cin['response']['countryOfIncorporation'])?$corporate_cin['response']['countryOfIncorporation']:null;
                    $corporate_cin_details['data']['descriptionOfMainDivision']=isset($corporate_cin['response']['descriptionOfMainDivision'])?$corporate_cin['response']['descriptionOfMainDivision']:null;
                    $corporate_cin_details['data']['addressOtherThanRegisteredOffice']=isset($corporate_cin['response']['addressOtherThanRegisteredOffice'])?$corporate_cin['response']['addressOtherThanRegisteredOffice']:null;
                    $corporate_cin_details['data']['emailId']=isset($corporate_cin['response']['emailId'])?$corporate_cin['response']['emailId']:null;
                    $corporate_cin_details['data']['natureOfBusiness']=isset($corporate_cin['response']['natureOfBusiness'])?$corporate_cin['response']['natureOfBusiness']:null;
                    $corporate_cin_details['data']['noOfDirectors']=isset($corporate_cin['response']['noOfDirectors'])?$corporate_cin['response']['noOfDirectors']:null;
                    $corporate_cin_details['data']['statusForEfiling']=isset($corporate_cin['response']['statusForEfiling'])?$corporate_cin['response']['statusForEfiling']:null;
                    $corporate_cin_details['data']['statusUnderCirp']=isset($corporate_cin['response']['statusUnderCirp'])?$corporate_cin['response']['statusUnderCirp']:null;
                    $corporate_cin_details['data']['pan']=isset($corporate_cin['response']['pan'])?$corporate_cin['response']['pan']:null;
                    $corporate_cin_details['data']['directors']=isset($corporate_cin['response']['directorDetails'])?$corporate_cin['response']['directorDetails']:null;
                    $corporate_cin_details['data']['splitAddress']=isset($corporate_cin['response']['splitAddress'])?$corporate_cin['response']['splitAddress']:null;
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    
                          DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($corporate_cin['response']['cin'])?$corporate_cin['response']['cin']:null,
                            'numberOfMembers'=>isset($corporate_cin['response']['numberOfMembers'])?$corporate_cin['response']['numberOfMembers']:null,
                            'subCategory'=>isset($corporate_cin['response']['subCategory'])?$corporate_cin['response']['subCategory']:null,
                            'class'=>isset($corporate_cin['response']['class'])?$corporate_cin['response']['class']:null,
                            'companyType'=>isset($corporate_cin['response']['companyType'])?$corporate_cin['response']['companyType']:null,
                            'companyName'=>isset($corporate_cin['response']['companyName'])?$corporate_cin['response']['companyName']:null,
                            'paidUpCapital'=>isset($corporate_cin['response']['paidUpCapital'])?$corporate_cin['response']['paidUpCapital']:null,
                            'authorisedCapital'=>isset($corporate_cin['response']['authorisedCapital'])?$corporate_cin['response']['authorisedCapital']:null,
                            'whetherListed'=>isset($corporate_cin['response']['whetherListed'])?$corporate_cin['response']['whetherListed']:null,
                            'dateOfIncorporation'=>isset($corporate_cin['response']['dateOfIncorporation'])?$corporate_cin['response']['dateOfIncorporation']:null,
                            'lastAgmDate'=>isset($corporate_cin['response']['lastAgmDate'])?$corporate_cin['response']['lastAgmDate']:null,
                            'registrationNumber'=>isset($corporate_cin['response']['registrationNumber'])?$corporate_cin['response']['registrationNumber']:null,
                            'registeredAddress'=>isset($corporate_cin['response']['registeredAddress'])?$corporate_cin['response']['registeredAddress']:null,
                            'activeCompliance'=>isset($corporate_cin['response']['activeCompliance'])?$corporate_cin['response']['activeCompliance']:null,
                            'suspendedAtStockExchange'=>isset($corporate_cin['response']['suspendedAtStockExchange'])?$corporate_cin['response']['suspendedAtStockExchange']:null,
                            'balanceSheetDate'=>isset($corporate_cin['response']['balanceSheetDate'])?$corporate_cin['response']['balanceSheetDate']:null,
                            'category'=>isset($corporate_cin['response']['category'])?$corporate_cin['response']['category']:null,
                            'status'=>isset($corporate_cin['response']['status'])?$corporate_cin['response']['status']:null,
                            'rocOffice'=>isset($corporate_cin['response']['rocOffice'])?$corporate_cin['response']['rocOffice']:null,
                            'countryOfIncorporation'=>isset($corporate_cin['response']['countryOfIncorporation'])?$corporate_cin['response']['countryOfIncorporation']:null,
                            'descriptionOfMainDivision'=>isset($corporate_cin['response']['descriptionOfMainDivision'])?$corporate_cin['response']['descriptionOfMainDivision']:null,
                            'addressOtherThanRegisteredOffice'=>isset($corporate_cin['response']['addressOtherThanRegisteredOffice'])?$corporate_cin['response']['addressOtherThanRegisteredOffice']:null,
                            'emailId'=>isset($corporate_cin['response']['emailId'])?$corporate_cin['response']['emailId']:null,
                            'natureOfBusiness'=>isset($corporate_cin['response']['natureOfBusiness'])?$corporate_cin['response']['natureOfBusiness']:null,
                            'noOfDirectors'=>isset($corporate_cin['response']['noOfDirectors'])?$corporate_cin['response']['noOfDirectors']:null,
                            'statusForEfiling'=>isset($corporate_cin['response']['statusForEfiling'])?$corporate_cin['response']['statusForEfiling']:null,
                            'statusUnderCirp'=>isset($corporate_cin['response']['statusUnderCirp'])?$corporate_cin['response']['statusUnderCirp']:null,
                            'pan'=>isset($corporate_cin['response']['pan'])?$corporate_cin['response']['pan']:null,
                            'directors'=>isset($corporate_cin['response']['directorDetails'])?json_encode($corporate_cin['response']['directorDetails']):null,
                            'splitAddress'=>isset($corporate_cin['response']['splitAddress'])?json_encode($corporate_cin['response']['splitAddress']):null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>200,
                            'message'=>'Success',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['corporate_cin'=> $corporate_cin_details,'statusCode'=>200,'success'=>true]);
                 }
                 elseif(isset($corporate_cin['response']['code']) && $corporate_cin['response']['code']==400 && $corporate_cin['status']['statusCode']==400){
                    $statusCode = 102;
                    $errorMessage = 'No data found';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cinNumber)?$request->cinNumber:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>102,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode'=> $statusCode,'message'=> $errorMessage]);
                 }
                 else{
                    $statusCode=500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cinNumber)?$request->cinNumber:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>500,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode'=> $statusCode,'message'=> $errorMessage]);
                 }
               } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $response = $e->getResponse();
                $errorResponse = json_decode($response->getBody(), true);
                if($errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002'){
                       $errorMessage ="cin number is invalid! Please enter a valid cin number.";
                       $statusCode = 102;
                       if ($user->role_id == 1) {
                           if ($apiamster) {
                               $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                           }
                           DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cinNumber)?$request->cinNumber:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>102,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                       }
                       return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                   }
                 elseif (!empty($errorResponse['status']['statusCode']) && $errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 205) {
                    $statusCode = 201;
                    $errorMessage = 'API Failed due to internal error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 201);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cinNumber)?$request->cinNumber:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>201,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                 }
                 elseif (!empty($errorResponse['status']['statusCode']) && $errorResponse['status']['statusCode'] == 429 && $errorResponse['error']['code'] == "E0010008") {
                    $statusCode = 201;
                    $errorMessage = 'Rate limit exceeded.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 201);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>201,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                 }
                 else {
                    $statusCode=500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cinNumber)?$request->cinNumber:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>500,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                }
                return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            }
        }
        else{
            return response()->json(['statusCode' => 500, 'message' => 'Please recharage your wallet.']);
        }
        } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
       }
       elseif($request->has('cin_number') && empty($request->cinNumber)&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $corporate_cin = null;
        $api_id = null;
        if (empty($request->cin_number)) {
            return response()->json([['message' => 'CIN number is required', 'statusCode' => '404']]);
        }

        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }

        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'cinbasic')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }

        $client = new Client();
        $headers = [
            'x-api-key' =>'24r4figxopl5lw0b3nmlwf414jry1d0hq',
            'Accept' => 'application/json',
        ];
        $groupId = rand(100,10000000000);
        $checkId = rand(100,10000000000);

        $body = [
            'cinNumber' => $request->cin_number,
            'checkId'=>$checkId,
            'groupId'=>$groupId,
        ];
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
            try {
                $res = $client->post('https://api.kyckart.com/api/roc/cin-basic', ['headers' => $headers, 'json' => $body]);
                $corporate_cin = json_decode($res->getBody(), true);
                $corporate_cin_details = null;
                 if(isset($corporate_cin['response']['code']) && $corporate_cin['response']['code']==200 && $corporate_cin['status']['statusCode']==200){
                    $corporate_cin_details['data']['cin']=isset($corporate_cin['response']['cin'])?$corporate_cin['response']['cin']:null;
                    $corporate_cin_details['data']['numberOfMembers']=isset($corporate_cin['response']['numberOfMembers'])?$corporate_cin['response']['numberOfMembers']:null;
                    $corporate_cin_details['data']['subCategory']=isset($corporate_cin['response']['subCategory'])?$corporate_cin['response']['subCategory']:null;
                    $corporate_cin_details['data']['classType']=isset($corporate_cin['response']['classType'])?$corporate_cin['response']['classType']:null;
                    $corporate_cin_details['data']['companyType']=isset($corporate_cin['response']['companyType'])?$corporate_cin['response']['companyType']:null;
                    $corporate_cin_details['data']['companyName']=isset($corporate_cin['response']['companyName'])?$corporate_cin['response']['companyName']:null;
                    $corporate_cin_details['data']['paidUpCapital']=isset($corporate_cin['response']['paidUpCapital'])?$corporate_cin['response']['paidUpCapital']:null;
                    $corporate_cin_details['data']['authorisedCapital']=isset($corporate_cin['response']['authorisedCapital'])?$corporate_cin['response']['authorisedCapital']:null;
                    $corporate_cin_details['data']['whetherListed']=isset($corporate_cin['response']['whetherListed'])?$corporate_cin['response']['whetherListed']:null;
                    $corporate_cin_details['data']['dateOfIncorporation']=isset($corporate_cin['response']['dateOfIncorporation'])?$corporate_cin['response']['dateOfIncorporation']:null;
                    $corporate_cin_details['data']['registrationNumber']=isset($corporate_cin['response']['registrationNumber'])?$corporate_cin['response']['registrationNumber']:null;
                    $corporate_cin_details['data']['registeredAddress']=isset($corporate_cin['response']['registeredAddress'])?$corporate_cin['response']['registeredAddress']:null;
                    $corporate_cin_details['data']['registeredDisctrict']=isset($corporate_cin['response']['registeredDisctrict'])?$corporate_cin['response']['registeredDisctrict']:null;
                    $corporate_cin_details['data']['registeredState']=isset($corporate_cin['response']['registeredState'])?$corporate_cin['response']['registeredState']:null;
                    $corporate_cin_details['data']['registeredCity']=isset($corporate_cin['response']['registeredCity'])?$corporate_cin['response']['registeredCity']:null;
                    $corporate_cin_details['data']['registeredPincode']=isset($corporate_cin['response']['registeredPincode'])?$corporate_cin['response']['registeredPincode']:null;
                    $corporate_cin_details['data']['registeredCountry']=isset($corporate_cin['response']['registeredCountry'])?$corporate_cin['response']['registeredCountry']:null;
                    $corporate_cin_details['data']['activeCompliance']=isset($corporate_cin['response']['activeCompliance'])?$corporate_cin['response']['activeCompliance']:null;
                    $corporate_cin_details['data']['category']=isset($corporate_cin['response']['category'])?$corporate_cin['response']['category']:null;
                    $corporate_cin_details['data']['status']=isset($corporate_cin['response']['status'])?$corporate_cin['response']['status']:null;
                    $corporate_cin_details['data']['rocOffice']=isset($corporate_cin['response']['rocOffice'])?$corporate_cin['response']['rocOffice']:null;
                    $corporate_cin_details['data']['addressOtherThanRegisteredOffice']=isset($corporate_cin['response']['addressOtherThanRegisteredOffice'])?$corporate_cin['response']['addressOtherThanRegisteredOffice']:null;
                    $corporate_cin_details['data']['emailId']=isset($corporate_cin['response']['emailId'])?$corporate_cin['response']['emailId']:null;
                    $corporate_cin_details['data']['natureOfBusiness']=isset($corporate_cin['response']['natureOfBusiness'])?$corporate_cin['response']['natureOfBusiness']:null;
                    $corporate_cin_details['data']['noOfDirectors']=isset($corporate_cin['response']['noOfDirectors'])?$corporate_cin['response']['noOfDirectors']:null;
                    $corporate_cin_details['data']['statusForEfiling']=isset($corporate_cin['response']['statusForEfiling'])?$corporate_cin['response']['statusForEfiling']:null;
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Successful', 200);
                        }
                    
                          DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($corporate_cin['response']['cin'])?$corporate_cin['response']['cin']:null,
                            'numberOfMembers'=>isset($corporate_cin['response']['numberOfMembers'])?$corporate_cin['response']['numberOfMembers']:null,
                            'subCategory'=>isset($corporate_cin['response']['subCategory'])?$corporate_cin['response']['subCategory']:null,
                            'class'=>isset($corporate_cin['response']['classType'])?$corporate_cin['response']['classType']:null,
                            'companyType'=>isset($corporate_cin['response']['companyType'])?$corporate_cin['response']['companyType']:null,
                            'companyName'=>isset($corporate_cin['response']['companyName'])?$corporate_cin['response']['companyName']:null,
                            'paidUpCapital'=>isset($corporate_cin['response']['paidUpCapital'])?$corporate_cin['response']['paidUpCapital']:null,
                            'authorisedCapital'=>isset($corporate_cin['response']['authorisedCapital'])?$corporate_cin['response']['authorisedCapital']:null,
                            'whetherListed'=>isset($corporate_cin['response']['whetherListed'])?$corporate_cin['response']['whetherListed']:null,
                            'dateOfIncorporation'=>isset($corporate_cin['response']['dateOfIncorporation'])?$corporate_cin['response']['dateOfIncorporation']:null,
                            'registrationNumber'=>isset($corporate_cin['response']['registrationNumber'])?$corporate_cin['response']['registrationNumber']:null,
                            'registeredAddress'=>isset($corporate_cin['response']['registeredAddress'])?$corporate_cin['response']['registeredAddress']:null,
                            'registeredDisctrict'=>isset($corporate_cin['response']['registeredDisctrict'])?$corporate_cin['response']['registeredDisctrict']:null,
                            'registeredState'=>isset($corporate_cin['response']['registeredState'])?json_encode($corporate_cin['response']['registeredState']):null,
                            'registeredCity'=>isset($corporate_cin['response']['registeredCity'])?$corporate_cin['response']['registeredCity']:null,
                            'registeredPincode'=>isset($corporate_cin['response']['registeredPincode'])?$corporate_cin['response']['registeredPincode']:null,
                            'registeredCountry'=>isset($corporate_cin['response']['registeredCountry'])?$corporate_cin['response']['registeredCountry']:null,
                            'activeCompliance'=>isset($corporate_cin['response']['activeCompliance'])?$corporate_cin['response']['activeCompliance']:null,
                            'category'=>isset($corporate_cin['response']['category'])?$corporate_cin['response']['category']:null,
                            'status'=>isset($corporate_cin['response']['status'])?$corporate_cin['response']['status']:null,
                            'rocOffice'=>isset($corporate_cin['response']['rocOffice'])?$corporate_cin['response']['rocOffice']:null,
                            'addressOtherThanRegisteredOffice'=>isset($corporate_cin['response']['addressOtherThanRegisteredOffice'])?$corporate_cin['response']['addressOtherThanRegisteredOffice']:null,
                            'emailId'=>isset($corporate_cin['response']['emailId'])?$corporate_cin['response']['emailId']:null,
                            'natureOfBusiness'=>isset($corporate_cin['response']['natureOfBusiness'])?$corporate_cin['response']['natureOfBusiness']:null,
                            'noOfDirectors'=>isset($corporate_cin['response']['noOfDirectors'])?$corporate_cin['response']['noOfDirectors']:null,
                            'statusForEfiling'=>isset($corporate_cin['response']['statusForEfiling'])?$corporate_cin['response']['statusForEfiling']:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>200,
                            'message'=>'Success',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['corporate_cin'=> $corporate_cin_details,'statusCode'=>200,'success'=>true]);
                 }
                 elseif(isset($corporate_cin['response']['code']) && $corporate_cin['response']['code']==404 && $corporate_cin['status']['statusCode']==200){
                    $statusCode = 102;
                    $errorMessage = 'company not found';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed', 102);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>102,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode'=> $statusCode,'message'=> $errorMessage]);
                 }
                 else{
                    $statusCode=500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($corporate_cin['status']['statusCode'])?$corporate_cin['status']['statusCode']:null,
                            'vender_code'=>isset($corporate_cin['response']['code'])?$corporate_cin['response']['code']:null,
                            'status_code'=>500,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode'=> $statusCode,'message'=> $errorMessage]);
                 }
               } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $response = $e->getResponse();
                $errorResponse = json_decode($response->getBody(), true);
                if(!empty($errorResponse['status']['statusCode']) && $errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 'E0010002'){
                       $errorMessage ="CIN Number is invalid! Please enter a valid cin number.";
                       $statusCode = 102;
                       if ($user->role_id == 1) {
                           if ($apiamster) {
                               $this->saveHitCount($user->id, $api_id, 'Transaction Failed', $statusCode);
                           }
                           DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>102,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                       }
                       return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                   }
                 elseif (!empty($errorResponse['status']['statusCode']) && $errorResponse['status']['statusCode'] == 400 && $errorResponse['error']['code'] == 205) {
                    $statusCode = 201;
                    $errorMessage = 'API Failed due to internal error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 201);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>201,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                 }
                 elseif (!empty($errorResponse['status']['statusCode']) && $errorResponse['status']['statusCode'] == 429 && $errorResponse['error']['code'] == "E0010008") {
                    $statusCode = 201;
                    $errorMessage = 'Rate limit exceeded.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.', 201);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>201,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                    return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
                 }
                 else {
                    $statusCode=500;
                    $errorMessage = 'Internal Server Error.';
                    if ($user->role_id == 1) {
                        if ($apiamster) {
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);
                        }
                        DB::table('corporate_cin')->insert([
                            'user_id'=>$user->id,
                            'api_id'=>$api_id,
                            'cin'=>isset($request->cin_number)?$request->cin_number:null,
                            'checkId'=>$checkId,
                            'groupId'=>$groupId,
                            'vender_status_code'=>isset($errorResponse['status']['statusCode'])?$errorResponse['status']['statusCode']:null,
                            'vender_code'=>isset($errorResponse['error']['code'])?$errorResponse['error']['code']:null,
                            'status_code'=>500,
                            'message'=>'Failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]); 
                    }
                }
                return response()->json(['statusCode' => $statusCode, 'message' => $errorMessage]);
            }
        }
        else{
            return response()->json(['statusCode' => 500, 'message' => 'Please recharage your wallet.']);
        }
        } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
        }
       }
       elseif($request->has('email_to_verify')&&empty($request->cin_number) && empty($request->cinNumber)&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $email_verify = null;
        $api_id = null;
        if(empty($request->email_to_verify)){
            return response()->json(['message'=>'email is required','statusCode'=>404]);
        }
        if(!$request->headers->has('AccessToken')){
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'verifyemail')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
        ->where('api_id', $api_id)
        ->orderBy('id', 'desc')
        ->first();
        $email_id = $request->email_to_verify;
        if($updateHitCount || $user->role_id==0){
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 ||$user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://13.126.53.71:8080/verify_email',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['email_to_verify'=>$email_id]),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $email_verify = json_decode($response, true);
                if(isset($email_verify['statuscode']) && $email_verify['statuscode']==200){
                         $email_verify_response =null; 
                         if($user->role_id==1){
                            if($apiamster){
                                $this->saveHitCount($user->id, $api_id, 'Transaction Success',200);   
                            }
                            DB::table('verify_email')->insert([
                                'user_id'=>$user->id,
                                'api_id'=> $api_id,
                                'email_id'=>isset($email_verify['email'])?$email_verify['email']:null,
                                'HTTPStatusCode'=>isset($email_verify['response']['ResponseMetadata']['HTTPStatusCode'])?$email_verify['response']['ResponseMetadata']['HTTPStatusCode']:null,
                                'RequestId'=>isset($email_verify['response']['ResponseMetadata']['RequestId'])?$email_verify['response']['ResponseMetadata']['RequestId']:null,
                                'RetryAttempts'=>isset($email_verify['response']['ResponseMetadata']['RetryAttempts'])?$email_verify['response']['ResponseMetadata']['RetryAttempts']:null,
                                'verification_initiated'=>isset($email_verify['verification_initiated'])?$email_verify['verification_initiated']:null,
                                'verification_status'=>isset($email_verify['verification_status'])?$email_verify['verification_status']:null,
                                'status_code'=>200,
                                'message'=>'success',
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                            ]);
                         }
                         $email_verify_response['email']=isset($email_verify['email'])?$email_verify['email']:null;
                         $email_verify_response['HTTPStatusCode']=isset($email_verify['response']['ResponseMetadata']['HTTPStatusCode'])?$email_verify['response']['ResponseMetadata']['HTTPStatusCode']:null;
                         $email_verify_response['RequestId']=isset($email_verify['response']['ResponseMetadata']['RequestId'])?$email_verify['response']['ResponseMetadata']['RequestId']:null;
                         $email_verify_response['RetryAttempts']=isset($email_verify['response']['ResponseMetadata']['RetryAttempts'])?$email_verify['response']['ResponseMetadata']['RetryAttempts']:null;
                         $email_verify_response['verification_initiated']=isset($email_verify['verification_initiated'])?$email_verify['verification_initiated']:null;
                         $email_verify_response['verification_status']=isset($email_verify['verification_status'])?$email_verify['verification_status']:null;
                        return response()->json(['statusCode'=>200,'data'=>$email_verify_response]);
                }
                elseif(isset($email_verify["error"]) && $email_verify["error"]=="An error occurred (InvalidParameterValue) when calling the VerifyEmailIdentity operation: Invalid email address<$email_id>."){
                    $errorMessage ="Invalid email address.Please enter correct email address";
                    if($user->role_id==1){
                        if($apiamster){
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);  

                        }
                        DB::table('verify_email')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'status_code'=>102,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>102,'message'=> $errorMessage]);
                }
                else{
                    $errorMessage  = "Internal Server Error.";
                    if($user->role_id==1){
                        if($apiamster){
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);   
                        }
                        DB::table('verify_email')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'status_code'=>500,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>500,'message'=>$errorMessage]);
                }
             }
            else{
                return response()->json(['statusCode'=>500,'message'=>'Please recharge your wallet.']);  
            }
        }
        else{
            return response()->json(['statusCode'=>103,'message'=>'You are not register.please update your plan.']);
        }

       }
       elseif( $request->has('identity') && empty($request->email_to_verify) &&empty($request->cin_number) && empty($request->cinNumber)&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $email_check_verify = null;
        $api_id = null;
        if(empty($request->identity)){
            return response()->json(['message'=>'identity is required','statusCode'=>404]);
        }
        if(!$request->headers->has('AccessToken')){
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'checkverificationemailstatus')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
        ->where('api_id', $api_id)
        ->orderBy('id', 'desc')
        ->first();
        $email_id = $request->identity;
        if($updateHitCount || $user->role_id==0){
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://13.126.53.71:8080/check_verification_status',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode(['identity'=>$email_id]),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $email_check_verify = json_decode($response, true);
                if(isset($email_check_verify['statuscode']) && $email_check_verify['statuscode']==200){
                         if($user->role_id==1){
                            if($apiamster){
                                $this->saveHitCount($user->id, $api_id, 'Transaction Success',200);   
                            }
                            DB::table('identify_verify_email')->insert([
                                'user_id'=>$user->id,
                                'api_id'=> $api_id,
                                'identity'=>isset($email_check_verify['identity'])?$email_check_verify['identity']:null,
                                'verification_status'=>isset($email_check_verify['verification_status'])?$email_check_verify['verification_status']:null,
                                'status_code'=>200,
                                'message'=>'success',
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                            ]);
                         }
                       $email_check_verify1['identity']=isset($email_check_verify['identity'])?$email_check_verify['identity']:null;
                       $email_check_verify1['verification_status']=isset($email_check_verify['verification_status'])?$email_check_verify['verification_status']:null;
                      return response()->json(['statusCode'=>200,'data'=>$email_check_verify1]);
                }
                elseif(isset($email_check_verify["error"]) && $email_check_verify["error"]=="An error occurred (InvalidParameterValue) when calling the GetIdentityVerificationAttributes operation: Identity $email_id is invalid. Must be a verified email address or domain."){
                    $errorMessage ="Invalid email address.Please enter correct email address";
                    if($user->role_id==1){
                        if($apiamster){
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);  

                        }
                        DB::table('identify_verify_email')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'status_code'=>102,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>102,'message'=> $errorMessage]);
                }
                else{
                    $errorMessage  = "Internal Server Error.";
                    if($user->role_id==1){
                        if($apiamster){
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);   
                        }
                        DB::table('identify_verify_email')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'status_code'=>500,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>500,'message'=>$errorMessage]);
                }
             }
            else{
                return response()->json(['statusCode'=>500,'message'=>'Please recharge  your wallet.']);  
            }
        }
        else{
            return response()->json(['statusCode'=>103,'message'=>'You are not register.please update your plan.']);
        }
       }
       //Esign Api
       elseif($request->has('esign_access_token') &&empty($request->identity) && empty($request->email_to_verify) &&empty($request->cin_number) && empty($request->cinNumber)&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $api_id = null;
        $access_token = $request->esign_access_token;
        if (!$request->headers->has('AccessToken')) {
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }
        $user = User::where('access_token',$request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'docboyzesign')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
            ->where('api_id', $api_id)
            ->orderBy('id', 'desc')
            ->first();
        if ($updateHitCount || $user->role_id == 0) {
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
               $user_accesign = User::where('access_token',$access_token)->first();
               if(isset($user_accesign) && $user_accesign != null){
                 if ($user->role_id == 1) {
                    if ($apiamster) {
                        $this->saveHitCount($user->id, $api_id, 'Transaction Success.',200);
                    }
                  }
                 return response()->json(['statusCode' => 200, 'Link' => "https://regtechapi.in/esign_signnature/$access_token"]);
               }
               else{
                 if ($user->role_id == 1) {
                    if ($apiamster) {
                        $this->saveHitCount($user->id, $api_id, 'Transaction Failed.',102);
                    }
                  }
                   return response()->json(['statusCode' => 102, 'message' =>"invalid token. please enter correct valid token"]);
                 }
           }
           else{
            return response()->json(['statusCode'=>500 ,'message'=>'Please Recharge your wallet.']);
           }
          } else {
            return response()->json(['statusCode' => 103, 'message' => 'You are not registered to use this service. Please update your plan.']);
         }
       }
       elseif($request->has('bucket_name') && $request->has('prefix') &&empty($request->key) &&empty($request->identity) && empty($request->email_to_verify) &&empty($request->cin_number) && empty($request->cinNumber)&& empty($request->mobileNo) && empty($request->otp) && empty($request->gstin_number)&&empty($request->pancard_number) &&empty($request->bank) && empty($request->accounttype) &&empty($request->credit) && empty($request->address_type)&&empty($request->UdyamRegNumber) &&empty($request->bhumi_type) && empty($request->panNumber) && empty($request->date_of_birth) && empty($request->identifier_type) && empty($request->image_file) && empty($request->known_face) && empty($request->image_face) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->companyName) && empty($request->flrsLicenseNo) && empty($request->file) &&empty($request->bank_name) && empty($request->account_type) &&empty($request->tax_payer_gstin_number) &&empty($request->companines_cin_number) && empty($request->company_type) &&empty($request->bank_stmt) &&empty($request->client_ref_num) && empty($request->mobile_number) &&empty($request->gstin) && empty($request->upi_id) &&empty($request->name) && empty($request->order_id) &&empty($request->ifsc) &&empty($request->account_number) && empty($request->uamnumber) &&empty($request->udyamNumber) && empty($request->pan_no) && empty($request->pan_number) &&empty($request->license_number) && empty($request->dob) &&empty($request->client_id) &&empty($request->otp_aadhar) &&empty($request->otp_aadhar_number) &&empty($request->aadhaar_number) && empty($request->voter_number) &&empty($request->pano) &&empty($request->first_name) && empty($request->last_name) && empty($request->phone_number) && empty($request->rc_number)){
        $statusCode = null;
        $dedupe_s3_details = null;
        $api_id = null;
        if(empty($request->bucket_name)){
            return response()->json(['message'=>'bucket_name is required','statusCode'=>404]);
        }
        if(empty($request->prefix)){
            return response()->json(['message'=>'prefix is required','statusCode'=>404]);
        }
        if(empty($request->aws_access_key_id)){
            return response()->json(['message'=>'aws_access_key_id is required','statusCode'=>404]);
        }
        if(empty($request->aws_secret_access_key)){
            return response()->json(['message'=>'aws_secret_access_key is required','statusCode'=>404]);
        }
        if(empty($request->region_name)){
            return response()->json(['message'=>'region_name is required','statusCode'=>404]);
        }
        if(!$request->headers->has('AccessToken')){
            return response()->json([['message' => 'Header Access Token is required', 'statusCode' => '404']]);
        }
        $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
        if ($verifyAccessToken == false) {
            return response()->json([['message' => 'Wrong Access Token', 'statusCode' => '403']]);
        }

        $user = User::where('access_token', $request->header('AccessToken'))->first();
        if ($user->role_id == 1) {
            $apiamster = ApiMaster::where('api_slug', 'dedupe')->first();
            if ($apiamster) {
                $api_id = $apiamster->id;
            }
        }
        $updateHitCount = UserSchemeMaster::where('user_id', $user->id)
        ->where('api_id', $api_id)
        ->orderBy('id', 'desc')
        ->first();
        $bucket_name = $request->bucket_name;
        $prefix = $request->prefix;
        $aws_access_key_id = $request->aws_access_key_id;
        $aws_secret_access_key = $request->aws_secret_access_key;
        $region_name = $request->region_name;

        if($updateHitCount || $user->role_id==0){
            if (($user->wallet_amount > 0 && $user->role_id == 1) || $user->role_id == 0 || $user->type=="role_postpaid") {
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://13.126.53.71:8080/dedupe_s3',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'bucket_name'=>$bucket_name,
                        'prefix'=>$prefix,
                        'aws_access_key_id'=>$aws_access_key_id,
                        'aws_secret_access_key'=>$aws_secret_access_key,
                        'region_name'=> $region_name,
                      )
                ]);
                 $response = curl_exec($curl);
                curl_close($curl);
                $dedupe_s3_details = json_decode($response, true);
                if(isset($dedupe_s3_details['statuscode']) && $dedupe_s3_details['statuscode']==200){
                         if($user->role_id==1){
                            if($apiamster){
                                $this->saveHitCount($user->id, $api_id, 'Transaction Success',200);   
                            }
                            DB::table('dedupe_s3')->insert([
                                'user_id'=>$user->id,
                                'api_id'=> $api_id,
                                'deleted_files'=>isset($dedupe_s3_details['deleted_files'])?json_encode($dedupe_s3_details['deleted_files']):null,
                                'bucket_name'=>isset( $bucket_name)? $bucket_name:null,
                                'prefix'=>isset($bucket_name)?$bucket_name:null,
                                'aws_access_key_id'=>isset($aws_access_key_id)?$aws_access_key_id:null,
                                'aws_secret_access_key'=>isset($aws_secret_access_key)?$aws_secret_access_key:null,
                                'region_name'=>isset($region_name)? $region_name:null,
                                'status_code'=>200,
                                'message'=>'success',
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                            ]);
                         }
                         $dedupe_s3_details1['deleted_files'] = $dedupe_s3_details['deleted_files'];
                        return response()->json(['statusCode'=>200,'data'=>$dedupe_s3_details1]);
                }
                elseif(isset($dedupe_s3_details["statuscode"]) && $dedupe_s3_details["statuscode"]==102){
                       if($user->role_id==1){
                        if($apiamster){
                            $this->saveHitCount($user->id, $api_id, 'Transaction Failed',102);  

                        }
                        DB::table('dedupe_s3')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'bucket_name'=>isset( $bucket_name)? $bucket_name:null,
                            'prefix'=>isset($bucket_name)?$bucket_name:null,
                            'aws_access_key_id'=>isset($aws_access_key_id)?$aws_access_key_id:null,
                            'aws_secret_access_key'=>isset($aws_secret_access_key)?$aws_secret_access_key:null,
                            'region_name'=>isset($region_name)? $region_name:null,
                            'status_code'=>102,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>102,'message'=> $dedupe_s3_details['error']]);
                }
                else{
                    $errorMessage  = "Internal Server Error.";
                    if($user->role_id==1){
                        if($apiamster){
                            $this->update_transaction($user->id, $api_id, 0, 'Transaction Failed.',500);   
                        }
                        DB::table('dedupe_s3')->insert([
                            'user_id'=>$user->id,
                            'api_id'=> $api_id,
                            'bucket_name'=>isset( $bucket_name)? $bucket_name:null,
                            'prefix'=>isset($bucket_name)?$bucket_name:null,
                            'aws_access_key_id'=>isset($aws_access_key_id)?$aws_access_key_id:null,
                            'aws_secret_access_key'=>isset($aws_secret_access_key)?$aws_secret_access_key:null,
                            'region_name'=>isset($region_name)? $region_name:null,
                            'status_code'=>102,
                            'message'=>'failed',
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),
                        ]);
                     }
                     return response()->json(['statusCode'=>500,'message'=>$errorMessage]);
                }
             }
            else{
                return response()->json(['statusCode'=>500,'message'=>'Please recharge your wallet.']);  
            }
        }
        else{
            return response()->json(['statusCode'=>103,'message'=>'You are not register.please update your plan.']);
         }
       }
        //again new api
        else {
           
            return response()->json(['statusCode' => '103', 'message' => 'Invalid Api Parameter Request.']);
        }

        // return 'test3';
    }

    
}
