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
use Redirect;
use File;
use Barryvdh\DomPDF\Facade\Pdf;
use DOMDocument;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;


class KycController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $crif_url = "https://loantap.in/affiliate/apiv1-1/docboyz/crif";

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
        if($transaction){
          $transaction_gen = substr(str_shuffle($str_result), 0, 12);
        }

        return $transaction_gen;
    }

     public function update_transaction($api_id,$amount,$remark, $statusCode)
     {
        $transaction = new Transaction;
        $transaction->transaction_id = $this->transaction_id();
        $transaction->user_id  = Auth()->user()->id;
        $transaction->api_id  = $api_id; //work
        $transaction->type_creditdebit = 'Debit';
        $transaction->scheme_price  = $amount;  //work
        if($statusCode == 200){
            $transaction->status = 'Success';
        }else{
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
        $userwallet = User::where('id',Auth()->user()->id )->first();
        // $userwallet->wallet_amount = $userwallet->wallet_amount - $amount;
        $userwallet->wallet_amount = $userwallet->wallet_amount;
        $userwallet->save();
    }

    public function pancard(Request $request) {
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.pancard', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        if($request->isMethod('POST')){
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
           $body =  [
            'pan_number' => $request->pan_number
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','pancard')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/pancard',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                  //   return $pancard[0]['pancard'];
                    if(isset($pancard[0]['statusCode'])){
                        $statusCode = $pancard[0]['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.pancard', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                    $res = $client->post('http://regtechapi.in/api/pancard',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.pancard', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.pancard', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.pancard', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function pancard_details(Request $request) {
       
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.pandetails', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
       
        if($request->isMethod('POST')){
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
           $body =  [
            'pan_number' => $request->pan_number
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','pancard')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/pancard_details',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                    // dd($pancard);
                    if(isset($pancard[0]['pancard']['code'])){
                        $statusCode = $pancard[0]['pancard']['code'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.pandetails', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/pancard_details',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // dd($pancard);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.pandetails', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.pandetails', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.pandetails', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

     //pan upload api implementation
     public function pancard_upload(Request $request){
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $pancard2 = null;

        if($request->isMethod('GET')){
             $client = new Client();
            return view('kyc.pancard_upload', compact('pancard','pancard2','statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            //checking if file exists or not
            if (!$request->hasFile('file')) {
                return json_encode(['message'=>"file not found"], true);
            }

            $accessToken = Auth::user()->access_token;
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "http://regtechapi.in/api/panupload", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                ),
                CURLOPT_HTTPHEADER => array(
                    "AccessToken: ".$accessToken,
                ),
            ));
                  // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $pancard = json_decode($result, true);
            // return $pancard;
            $statusCode = '';
            if(isset($pancard[0]['statusCode'])){
                $statusCode = $pancard[0]['statusCode'];
            }
            $pan_verified = 0;
            $pancard2 = null;
            if($statusCode==200)
            {
                $pan_no = $pancard[0]['pancard']['pan_number'];
                $client = new Client();
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'pan_number' => $pan_no
                ];
                    try{
                        //$res = $client->post($this->base_url.'/pan/pan', ['headers' => $headers, 'json' => $body]);
                        $res = $client->post('http://regtechapi.in/api/pancard',['headers' => $headers, 'json' => $body]);
                        $pancard2 = json_decode($res->getBody(), true);
                        // return $pancard2[0]['pancard'];
                        if($pancard2[0]['statusCode']==200)
                            $pan_verified = 1;
                        } catch(BadResponseException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
                            $pan_verified = 0;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                            return view('kyc.pancard_upload', compact('statusCode','errorMessage'));
                    }
            }
            return view('kyc.pancard_upload', compact('pancard', 'statusCode','hit_limits_exceeded','pan_verified','pancard2'));
        }
    }

    public function searchkyc(Request $request){
    //    return 'ok';
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.searchkyc', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        
       
        if($request->isMethod('POST')){
            // return $request->dob;
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
            $body =  [
                'pano' => $request->pan_number,
                'dob' => $request->dob
                ];
            if(Auth::user()->scheme_type!='demo') {
                // return 'demo';
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','searchkyc')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/ckycSearchfull',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                    return  $pancard;
                    // dd($pancard['response']['kycDetails']['personalIdentifiableData']);
                    if(isset($pancard['statusCode'])){
                        // dd($pancard['statusCode']);
                        $statusCode =$pancard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.searchkyc', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/ckycSearch',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // dd($pancard);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.searchkyc', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.searchkyc', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.searchkyc', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function searchkyclite(Request $request){
       
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.searchkyclite', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        
       
        if($request->isMethod('POST')){
            // return $request->dob;
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
            $body =  [
                'pano' => $request->pan_number,
                'dob' => $request->dob
                ];
            if(Auth::user()->scheme_type!='demo') {
                // return 'demo';
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','pancard')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/search',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                    // dd($pancard['response']['kycDetails']['personalIdentifiableData']);
                    if(isset($pancard['statusCode'])){
                        // dd($pancard['statusCode']);
                        $statusCode =$pancard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.searchkyclite', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/search',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // dd($pancard);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.searchkyclite', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.searchkyclite', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.searchkyclite', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function ckycsearchdata(Request $request){
        // return 'test';
       
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.ckycsearchdata', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        
       
        if($request->isMethod('POST')){
            // return $request->dob;
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
            $body =  [
                'pano' => $request->pan_number,
                'dob' => $request->dob
                ];
            if(Auth::user()->scheme_type!='demo') {
                // return 'demo';
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','ckycsearch')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/ckycSearch',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                    // return $pancard;
                    // dd($pancard['response']['kycDetails']['personalIdentifiableData']);
                    if(isset($pancard['statusCode'])){
                        // dd($pancard['statusCode']);
                        $statusCode =$pancard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.ckycsearchdata', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/ckycSearch',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // dd($pancard);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.ckycsearchdata', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.ckycsearchdata', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.ckycsearchdata', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function ckycdownload(Request $request){
        // return 'download test';
       
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.ckycdownload', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        
       
        if($request->isMethod('POST')){
            // return $request->dob;
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
            $body =  [
                'pano' => $request->pan_number,
                'dob' => $request->dob,
                'ckycid' => $request->ckycid
                ];
            if(Auth::user()->scheme_type!='demo') {
                // return 'demo';
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','ckycdownload')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/ckycDownload',['headers' => $headers, 'json' => $body]);
                    
                    $pancard = json_decode($res->getBody(), true);
                    // return $pancard;
                    // dd($pancard['response']['kycDetails']['personalIdentifiableData']);
                    if(isset($pancard['statusCode'])){
                        // dd($pancard['statusCode']);
                        $statusCode =$pancard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.ckycdownload', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/ckycDownload',['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // dd($pancard);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.ckycdownload', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.ckycdownload', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.ckycdownload', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }


    public function aadhaar_validation(Request $request) {
        $statusCode = null;
        $aadhaar_validation = null;
        $hit_limits_exceeded = 0;
        $api_id = '';

        if($request->isMethod('GET')){
            
            return view('kyc.aadhaar_validation', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){

            $client = new Client();
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];
            $body =  [
            'aadhaar_number' => $request->aadhaar_number
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                
                try{
                    $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                    //$this->base_url.'/aadhaar-validation/aadhaar-validation'
                    $aadhaar_validation = json_decode($res->getBody(), true);
                    if(isset($aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'])){
                        $statusCode = $aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'];
                    }
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.aadhaar_validation', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_validation = json_decode($res->getBody(), true);
                        
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.aadhaar_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.aadhaar_validation', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.aadhaar_validation', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
    }


    public function passportverify(Request $request){
        // return 'true';
        $statusCode = null;
        $passportverify = null;
        $hit_limits_exceeded = null;        
        if($request -> isMethod('GET'))
            return view('kyc.passportverify',compact('passportverify','statusCode','hit_limits_exceeded'));
        
        if($request -> isMethod('POST')){
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];
            $json = ['id_number'=> $request->id_number,
                'dob'=> $request->dob];

                $client = new Client();
                
                if(Auth::user() -> scheme_type!="demo"){
                    if(Auth::user() -> role_id == '1'){
                    $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                    }

                
                try{
                    $res = $client -> post('http://regtechapi.in/api/passport_verification',['headers' => $headers,'json' => $json,'verify'=>false]);
                    $passportverify = json_decode($res->getBody(), true);
                    $statusCode = 200;
                }catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.passportverify', compact('statusCode','errorMessage'));
                }
            }else{
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client -> post('http://regtechapi.in/api/passport_verification',['headers' => $headers,'json' => $json,'verify'=>false]);
                        $passportverify = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.passportverify', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.passportverify', compact('passportverify', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.passportverify',compact('passportverify','statusCode','hit_limits_exceeded'));
    }


    //aadhaar upload api implementation
     public function aadhaar_upload(Request $request){
        $statusCode = null;
        $aadhaar = null;
        $hit_limits_exceeded = 0;
        $aadhaarOCR = null;

        if($request->isMethod('GET')){
            return view('kyc.aadhaar_upload', compact('aadhaar','aadhaarOCR', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            //checking if file exists or not
            if (!$request->hasFile('file')) {
                return json_encode(['message'=>"file not found"], true);
            }


            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                // CURLOPT_URL => "https://kyc-api.flowboard.in/api/v1/aadhaar/upload/eaadhaar",
                CURLOPT_URL =>  "http://regtechapi.in/api/aadhaar_upload", //"https://sandbox.flowboard.in/api/v1/ocr/aadhaar",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                    // "base64" => "",
                    // "yob" => "",
                    // "full_name" => ""
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: ".$this->sandbox_token,
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $aadhaarOCR = json_decode($result, true);
              //dd($aadhaarOCR);
            $statusCode = isset($aadhaarOCR['status_code'])?$aadhaarOCR['status_code']:null;
            $aadhaar_number = null;
            if($aadhaarOCR['data']['ocr_fields']) {
                 $aadhaar_number = $aadhaarOCR['data']['ocr_fields'][0]['aadhaar_number']['value'];
            }
           
            if($aadhaar_number){
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
                $body =  [
                'aadhaar_number' => $aadhaar_number
                ];
                 try{
                    $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/aadhaar-validation/aadhaar-validation', ['headers' => $headers, 'json' => $body]);
                    $aadhaar = json_decode($res->getBody(), true);
                    //dd($aadhaar);
                    $statusCode = 200;
                   
                    }catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.aadhaar_upload', compact('statusCode','errorMessage'));
                    }
            }
            return view('kyc.aadhaar_upload', compact('aadhaar', 'aadhaarOCR', 'statusCode','hit_limits_exceeded'));
        }
    }
            


    // Aadhar OTP Genrate

    public function aadhaar_otp_genrate(Request $request) {
        $statusCode = null;
        $aadhaar_otp_genrate = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            
            return view('kyc.aadhaar_otp_genrate', compact('aadhaar_otp_genrate', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'aadhar_number' => $request->aadhaar_number
                // ];

                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'aadhaar_number' => $request->aadhaar_number
                ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                    $res = $client->post('http://regtechapi.in/api/aadhaar_otp_genrate', ['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/aadhaar-v2/generate-otp', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_otp_genrate = json_decode($res->getBody(), true);
                    $statusCode = 200;
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.aadhaar_otp_genrate', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/aadhaar_otp_genrate', ['headers' => $headers, 'json' => $body]);
                        // $res = $client->post($this->base_url.'/aadhaar-v2/generate-otp', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_otp_genrate = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.aadhaar_otp_genrate', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.aadhaar_otp_genrate', compact('aadhaar_otp_genrate', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.aadhaar_otp_genrate', compact('aadhaar_otp_genrate', 'statusCode','hit_limits_exceeded'));
    }
    

    // aadhar OTP Submit


    public function aadhaar_otp_submit(Request $request) {
        $statusCode = null;
        $aadhaar_otp_submit = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            
            return view('kyc.aadhaar_otp_submit', compact('aadhaar_otp_submit', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
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
                $body =  [
                    'client_id' => $request->client_id,
                    'otp' => $request->otp
                ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                    $res = $client->post('http://regtechapi.in/api/aadhaar_otp_submit', ['headers' => $headers, 'json' => $body]);
                    // $res = $client->post($this->base_url.'/aadhaar-v2/submit-otp', ['headers' => $headers, 'json' => $body]);
                    $aadhaar_validation = json_decode($res->getBody(), true);
                    //dd($aadhaar_validation);
                    $statusCode = 200;
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.aadhaar_otp_submit', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/aadhaar_otp_submit', ['headers' => $headers, 'json' => $body]);
                        // $res = $client->post($this->base_url.'/aadhaar-v2/submit-otp', ['headers' => $headers, 'json' => $body]);
                        $aadhaar_validation = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.aadhaar_otp_submit', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // dd($aadhaar_validation);
        return view('kyc.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
    }

    // aadhar masking python intigration needed

    public function aadhaar_masking(Request $request) {
        $statusCode = null;
        $aadhaar_masking = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            
            return view('kyc.aadhaar_masking', compact('aadhaar_masking', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            
            if (!$request->hasFile('file')) {
                return json_encode(['message'=>"file not found"], true);
            }

            $accessToken = Auth::user()->access_token;
            
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL =>  "http://regtechapi.in/api/aadhaar_masking", 
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                    "file_back" => new \CURLFILE($_FILES['file_back']['tmp_name'],$_FILES['file_back']['type'],$_FILES['file_back']['name']),
                ),
                CURLOPT_HTTPHEADER => array(
                    "AccessToken: ".$accessToken,
                ),
            ));
            
            $result = curl_exec($curl1);
            $aadhaar_masking = json_decode($result, true);
            
        }
        return view('kyc.aadhaar_masking', compact('aadhaar_masking', 'statusCode','hit_limits_exceeded'));
    }

    // Voter id  Validation 
    public function voter_validation(Request $request) {
        $statusCode = null;
        $voter_validation = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.voter_validation', compact('voter_validation', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];

            $body =  [
                'voter_number' => $request->voter_number
            ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','voter_id')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                try{
                    $res = $client->post('http://regtechapi.in/api/voter_validation', ['headers' => $headers, 'json' => $body]);
                    $voter_validation = json_decode($res->getBody(), true);
                    $statusCode = 200;
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.voter_validation', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/voter_validation', ['headers' => $headers, 'json' => $body]);
                        $voter_validation = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.voter_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.voter_validation', compact('voter_validation', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // dd($voter_validation[0]['statusCode']);
        return view('kyc.voter_validation', compact('voter_validation', 'statusCode','hit_limits_exceeded'));
    }

    //voter upload api implementation
    public function voter_upload(Request $request){
        $statusCode = null;
        $voter = null;
        $voterocr = null;
        $hit_limits_exceeded = 0;
        $voter_detailed_info = null;
        $isValid = 0;


        if($request->isMethod('GET')){
            return view('kyc.voter_upload', compact('voter','voter_detailed_info','statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            //checking if file exists or not
            if (!$request->hasFile('file')) {
                return json_encode(['message'=>"file not found"], true);
            }

            $accessToken = Auth::user()->access_token;

            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "http://regtechapi.in/api/voter_upload",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name'])
                ),
                CURLOPT_HTTPHEADER => array(
                    "AccessToken: ".$accessToken,
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $voterocr = json_decode($result, true);
            $voter = isset($voterocr[0]['ocr_fields'])?$voterocr[0]['ocr_fields']:null;
            $voter_detailed_info =  isset($voterocr[0]['voter_validation'])?$voterocr[0]['voter_validation']:null;
            $statusCode = isset($voterocr[0]['statusCode'])?$voterocr[0]['statusCode']:null;

            if(isset($voter_detailed_info['status_code']) && $voter_detailed_info['status_code'] == 200){
                $is_valid = 1;
            }
            
            // // $statusCode = $voter['status_code'];
            // // if($statusCode == 200){
            //     $voter_detailed_info = null;
            //     $id_number = $voter['data']['ocr_fields'][0]['epic_number']['value'];
            //     $client = new Client();
            //     $accessToken = Auth::user()->access_token;
                
            //     $headers = [
            //     'AccessToken' => $accessToken,
            //     ];
            //     $json = [
            //                 'file' => $request->file
            //             ];

            //     try{
            //         $response = $client -> post('http://regtechapi.in/api/voter_upload',['headers' => $headers, 'json' => $json]);
            //         $voter_detailed_info = json_decode($response -> getBody(),true);
            //         $statusCode = 200;
                    
            //         if(isset($voter_detailed_info['status_code']) && $voter_detailed_info['status_code'] == 200){
            //             $is_valid = 1;
            //         }
            //     }catch(BadResponseException $e){
            //         $statusCode = $e->getResponse()->getStatusCode();
            //         $is_valid = 0;
            //         $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
            //         return view('kyc.voter_upload', compact('statusCode','errorMessage'));
            //     }
            $is_valid=1;
                return view('kyc.voter_upload', compact('voter','voter_detailed_info','is_valid','statusCode','hit_limits_exceeded'));
            // }         
            // return view('kyc.voter_upload', compact('voter','voter_detailed_info','statusCode','hit_limits_exceeded'));
            
        }
    }


    public function license_validation(Request $request) {
        $statusCode = null;
        $license_validation = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.license_validation', compact('license_validation', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
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
                'Accept' => 'application/json'
                ];
                $body =  [
                'license_number' => $request->license_number,
                "dob"=> $date
                ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','license')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                   // $res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('http://regtechapi.in/api/license_validation',['headers' => $headers, 'json' => $body]); 
                    $license_validation = json_decode($res->getBody(), true);
                    // dd($license_validation);
                    $statusCode = 200;
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.license_validation', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/license_validation',['headers' => $headers, 'json' => $body]); 
                        //$res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body]);
                        $license_validation = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                        $statusCode = 200;
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.license_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.license_validation', compact('license_validation', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // dd($license_validation[0]['license_validation']['code']);
        // dd($license_validation);
        return view('kyc.license_validation', compact('license_validation', 'statusCode','hit_limits_exceeded'));
    }
    public function rc_validationmp(Request $request) {
        $statusCode = null;
        $rc_validation = null;
        $checkWeight = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.rc_validationmp', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->rc_number
                // ];
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'rc_number' => $request->rc_number
                ];
                
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','rc')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
            
                try{
                    //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('http://regtechapi.in/api/rc_validationmp', ['headers' => $headers, 'json' => $body]);
                    $rc_validation = json_decode($res->getBody(), true);
                    // dd($rc_validation);
                    if(isset($rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'])){
                        $grossWeight = $rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'];
                        if($grossWeight == null){
                            $grossWeight = 0;
                        }
                        $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                    }
                    if(isset($rc_validation[0]['statusCode'])){
                        $statusCode = $rc_validation[0]['statusCode'];
                    }else{
                        $statusCode = $rc_validation['statusCode'];
                    }
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.rc_validationmp', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/rc_validationmp', ['headers' => $headers, 'json' => $body]);
                        $rc_validation = json_decode($res->getBody(), true);
                        //dd($rc_validation);
                        if(isset($rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'])){
                            $grossWeight = $rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'];
                            if($grossWeight == null){
                                $grossWeight = 0;
                            }
                            $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                        }
                        if(isset($rc_validation[0]['statusCode']) && $rc_validation[0]['statusCode'] != 500){
                            $user = User::where('id',Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count+1;
                            $user->save();
                        }
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.rc_validationmp', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.rc_validationmp', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.rc_validationmp', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
    }


    public function rc_validation(Request $request) {
        // return 'test';
        $statusCode = null;
        $rc_validation = null;
        $checkWeight = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.rc_validation', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->rc_number
                // ];
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'rc_number' => $request->rc_number
                ];
                
            if(Auth::user()->scheme_type!='demo') {
                // return 'notok';
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','rc')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
            
                try{
                    //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('http://regtechapi.in/api/rc_validation', ['headers' => $headers, 'json' => $body]);
                    $rc_validation = json_decode($res->getBody(), true);
                    // dd($rc_validation['rc_validation']['data']->vehicle_gross_weight);
                    if(isset($rc_validation['rc_validation']['data']['vehicle_gross_weight'])){
                        $grossWeight = $rc_validation['rc_validation']['data']['vehicle_gross_weight'];
                        if($grossWeight == null){
                            $grossWeight = 0;
                        }
                        $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                    }
                    if(isset($rc_validation['status_code'])){
                        $statusCode = $rc_validation['status_code'];
                    }else{
                        $statusCode = $rc_validation['status_code'];
                    }
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.rc_validation', compact('statusCode','errorMessage'));
                }
            } else {
                // return 'ok';
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/rc_validation', ['headers' => $headers, 'json' => $body]);
                        $rc_validation = json_decode($res->getBody(), true);
                        // dd($rc_validation['rc_validation']['data']['vehicle_gross_weight']);
                        if(isset($rc_validation['rc_validation']['data']['vehicle_gross_weight'])){
                            $grossWeight = $rc_validation['rc_validation']['data']['vehicle_gross_weight'];
                            if($grossWeight == null){
                                $grossWeight = 0;
                            }
                            $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                        }
                        if(isset($rc_validation['status_code']) && $rc_validation['status_code'] != 500){
                            $user = User::where('id',Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count+1;
                            $user->save();
                        }
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.rc_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.rc_validation', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // return $rc_validation['status_code'];
        return view('kyc.rc_validation', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
    }
    public function rc_validationlite(Request $request) {
        $statusCode = null;
        $rc_validation = null;
        $checkWeight = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.rc_validationlite', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            
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
                $body =  [
                'rc_number' => $request->rc_number
                ];
                
            if(Auth::user()->scheme_type!='demo') {
                
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','rcvallite')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
            
                try{
                    // dd('testeroneasassssone');
                    //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('http://regtechapi.in/api/rc_validationlite', ['headers' => $headers, 'json' => $body]);
                    $rc_validation = json_decode($res->getBody(), true);
                    
                    // if(isset($rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'])){
                    //     $grossWeight = $rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'];
                    //     if($grossWeight == null){
                    //         $grossWeight = 0;
                    //     }
                    //     $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                    // }
                    if(isset($rc_validation[0]['statusCode'])){
                        $statusCode = $rc_validation[0]['statusCode'];
                    }else{
                        $statusCode = $rc_validation['statusCode'];
                    }
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.rc_validationlite', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
               
                if($hit_count_remaining>0)
                {
                    // dd('$hit_count_remaining');
                    try{
                        $res = $client->post('http://regtechapi.in/api/rc_validationlite', ['headers' => $headers, 'json' => $body]);
                        $rc_validation = json_decode($res->getBody(), true);
                        // dd($rc_validation);
                        // if(isset($rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'])){
                        //     $grossWeight = $rc_validation[0]['rc_validation']['data']['vehicle_gross_weight'];
                        //     if($grossWeight == null){
                        //         $grossWeight = 0;
                        //     }
                        //     $checkWeight = Rcfull::where('min_weight', '<=', $grossWeight)->Where('max_weight', '>=', $grossWeight)->first();
                        // }
                        if(isset($rc_validation[0]['statusCode']) && $rc_validation[0]['statusCode'] != 500){
                            $user = User::where('id',Auth::user()->id)->first();
                            $user->scheme_hit_count = $user->scheme_hit_count+1;
                            $user->save();
                        }
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.rc_validationlite', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.rc_validationlite', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
      
        return view('kyc.rc_validationlite', compact('rc_validation','checkWeight', 'statusCode','hit_limits_exceeded'));
    }


    public function rc_full_validation(Request $request) {
        $statusCode = null;
        $rc_validation = null;
        $rc_challan = null;
        $checkWeight = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.rc_full_validation', compact('rc_challan','checkWeight', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();

                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'rc_number' => $request->rc_number
                ];
                
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','rcfull')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                
                try{
                    //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                    $res = $client->post('http://regtechapi.in/api/rc_validation', ['headers' => $headers, 'json' => $body]);
                    $rc_challan = json_decode($res->getBody(), true);
                    // dd($rc_challan[0]['statusCode']);
        
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.rc_full_validation', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        //$res = $client->post($this->base_url.'/rc/rc-full', ['headers' => $headers, 'json' => $body]);
                        $res = $client->post('http://regtechapi.in/api/rc_validation', ['headers' => $headers, 'json' => $body]);
                        $rc_challan = json_decode($res->getBody(), true);
                        
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.rc_full_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.rc_full_validation', compact('rc_challan','checkWeight', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.rc_full_validation', compact('rc_challan','checkWeight', 'statusCode','hit_limits_exceeded'));
    }

    public function pull_kra(Request $request) {
        $statusCode = null;
        $pull_kra = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.pull_kra', compact('pull_kra', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'id_number' => $request->pan_number,
                'dob' => $request->dob
            ];

            try{
                $res = $client->post($this->base_url.'/pull-kra/pull-kra', ['headers' => $headers, 'json' => $body]);
                $pull_kra = json_decode($res->getBody(), true);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
           
        }

        return view('kyc.pull_kra', compact('pull_kra', 'statusCode','hit_limits_exceeded'));
    }

    // bank_verification
    public function bank_verification(Request $request) {
        $statusCode = null;
        $bank_verification = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->account_number,
                //     'ifsc' => $request->ifsc
                // ];
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'name' => 'Test No',
                'accno' => $request->account_number,
                'ifsc' => $request->ifsc
                ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','bank')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                    $res = $client->post('http://regtechapi.in/api/bank_verification',['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                    $bank_verification = json_decode($res->getBody(), true);
                    return $bank_verification;
                    // return $bank_verification[0];
                    $statusCode = 200;
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/bank_verification',['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                        $bank_verification = json_decode($res->getBody(), true);
                        // return $bank_verification[0];
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // return $bank_verification;

        return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
    }

    public function bank_statement(Request $request){
        $statusCode = null;
        $bank_verification = null;
        $hit_limits_exceeded = 0;
        $bank_upload=null;

        if($request->isMethod('GET')){
           return view('kyc.bank_upload', compact('bank_upload', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // return $request->password;
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->account_number,
                //     'ifsc' => $request->ifsc
                // ];
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                // $body =  [
                // 'name' => 'Test No',
                // 'accno' => $request->account_number,
                // 'ifsc' => $request->ifsc
                // ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','bank')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                // try{
                    // return 'ok test';
                   $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/bank_details", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                            "password" => $request->password,
                            "bank" => $request->bank,
                            'accountType' => $request->accounttype,
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: ".$accessToken,
                        ),
                    ));
                          // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $bankstatement = json_decode($result, true);
                    // return $bankstatement['statusCode'];
                    if($bankstatement['statusCode'] == '200'){
                    $statmendata = $bankstatement['response'];

                    // return $statmendata;
                   // $pdf = PDF::loadView('kyc.equifaxreportpdf',compact('myarray','equifax'))->setPaper('A4');
                    // return $pdf->stream('invoice.pdf');
                   
                        $pdf = PDF::loadView('kyc.statementpdf',compact('statmendata'))->setPaper('A4');
                        return $pdf->stream('invoice.pdf');

                    }
                    else{
                        return view('kyc.bank_upload', compact('bank_upload', 'statusCode','hit_limits_exceeded'));
                    }
                    
                // } catch(BadResponseException $e) {
                //     $statusCode = $e->getResponse()->getStatusCode();
                //     $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                //     return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                // }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/bank_verification',['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                        $bank_verification = json_decode($res->getBody(), true);
                        // return $bank_verification[0];
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // return $bank_verification;

        return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
    }

    public function bank_analyser(Request $request){
        $statusCode = null;
        $bank_verification = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $bank_upload=null;
        if($request->isMethod('GET')){
           return view('kyc.bankanalyser', compact('bank_upload', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // return $request->password;
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->account_number,
                //     'ifsc' => $request->ifsc
                // ];
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                // $body =  [
                // 'name' => 'Test No',
                // 'accno' => $request->account_number,
                // 'ifsc' => $request->ifsc
                // ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','bank')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                // try{
                    // return 'ok test';
                   $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/bank_anlyser", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                            "password" => $request->password,
                            "bank" => $request->bank,
                            'accountType' => $request->accounttype,
                            "country" => "INDIA"
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: ".$accessToken,
                        ),
                    ));
                          // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $bankstatement = json_decode($result, true);
                    // return $bankstatement;
                    if($bankstatement['statusCode'] == '200'){
                        $statmendata = $bankstatement['response'];
                        $statusCode = $bankstatement['statusCode'];
                        $atm_withdrawl =  $bankstatement['response']['atm_withdrawls'];
                        $averageMonthlyBalance =  $bankstatement['response']['averageMonthlyBalance'];
                        $averageQuarterlyBalance =  $bankstatement['response']['averageQuarterlyBalance'];
                        $expenses =  $bankstatement['response']['expenses'];
                        $high_value_transactions =  $bankstatement['response']['high_value_transactions'];
                        $incomes =  $bankstatement['response']['incomes'];
                        $minimum_balances =  $bankstatement['response']['minimum_balances'];
                        $money_received_transactions =  $bankstatement['response']['money_received_transactions'];
                        // return $atm_withdrawl;
                        $pdf = PDF::loadView('kyc.analyserpdf',compact('atm_withdrawl','averageMonthlyBalance','averageQuarterlyBalance','expenses','high_value_transactions','incomes','minimum_balances','money_received_transactions'))->setPaper('A4');
                        // $pdf = PDF::loadView('kyc.analyserpdf',compact('statmendata'))->setPaper('A4');
                        return $pdf->stream('invoice.pdf');
                        // $hit_limits_exceeded = 1;
                        // return view('kyc.bankanalyser', compact('statmendata', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));

                    }
                    else{
                        return view('kyc.bankanalyser', compact('bank_upload', 'statusCode','hit_limits_exceeded'));
                    }
                    
                // } catch(BadResponseException $e) {
                //     $statusCode = $e->getResponse()->getStatusCode();
                //     $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                //     return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                // }
            } else {
                // $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                // $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // if($hit_count_remaining>0)
                // {
                //     try{
                //         $res = $client->post('http://regtechapi.in/api/bank_verification',['headers' => $headers, 'json' => $body]);
                //         //$res = $client->post($this->base_url.'/bank-verification', ['headers' => $headers, 'json' => $body]);
                //         $bank_verification = json_decode($res->getBody(), true);
                //         // return $bank_verification[0];
                //         $user = User::where('id',Auth::user()->id)->first();
                //         $user->scheme_hit_count = $user->scheme_hit_count+1;
                //         $user->save();
                //     } catch(BadResponseException $e) {
                //         $statusCode = $e->getResponse()->getStatusCode();
                //         $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                //         return view('kyc.bank_verification', compact('statusCode','errorMessage'));
                //     }
                // } else {
                //     $hit_limits_exceeded = 1;
                //     return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
                // }

                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','bank')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                // try{
                    // return 'ok test';
                   $accessToken = Auth::user()->access_token;
                    $curl1 = curl_init();
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => "http://regtechapi.in/api/bank_anlyser", //"https://kyc-api.flowboard.in/api/v1/pan/pan-upload",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                            "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                            "password" => $request->password,
                            "bank" => $request->bank,
                            "country" => "INDIA",
                            'accountType' => $request->accounttype
                        ),
                        CURLOPT_HTTPHEADER => array(
                            "AccessToken: ".$accessToken,
                        ),
                    ));
                          // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $bankstatement = json_decode($result, true);
                    // return $bankstatement;
                    if($bankstatement['statusCode'] == '200'){
                        $statmendata = $bankstatement['response'];
                        $statusCode = $bankstatement['statusCode'];
                        $atm_withdrawl =  $bankstatement['response']['atm_withdrawls'];
                        $averageMonthlyBalance =  $bankstatement['response']['averageMonthlyBalance'];
                        $averageQuarterlyBalance =  $bankstatement['response']['averageQuarterlyBalance'];
                        $expenses =  $bankstatement['response']['expenses'];
                        $high_value_transactions =  $bankstatement['response']['high_value_transactions'];
                        $incomes =  $bankstatement['response']['incomes'];
                        $minimum_balances =  $bankstatement['response']['minimum_balances'];
                        $money_received_transactions =  $bankstatement['response']['money_received_transactions'];
                        // return $atm_withdrawl;
                        $pdf = PDF::loadView('kyc.analyserpdf',compact('atm_withdrawl','averageMonthlyBalance','averageQuarterlyBalance','expenses','high_value_transactions','incomes','minimum_balances','money_received_transactions'))->setPaper('A4');
                        // $atm_withdrawl =  $bankstatement['response']['atm_withdrawls'];
                        // $averageMonthlyBalance =  $bankstatement['response']['averageMonthlyBalance'];
                        // $averageQuarterlyBalance =  $bankstatement['response']['averageQuarterlyBalance'];
                        // $expenses =  $bankstatement['response']['expenses'];
                        // $high_value_transactions =  $bankstatement['response']['high_value_transactions'];
                        // $incomes =  $bankstatement['response']['incomes'];
                        // $minimum_balances =  $bankstatement['response']['minimum_balances'];
                        // $money_received_transactions =  $bankstatement['response']['money_received_transactions'];
                        // return $atm_withdrawl;
                        // $pdf = PDF::loadView('kyc.analyserpdf',compact('atm_withdrawl','averageMonthlyBalance','averageQuarterlyBalance','expenses','high_value_transactions','incomes','minimum_balances','money_received_transactions'))->setPaper('A4');
                        // return $pdf->stream('invoice.pdf');
                        // $pdf = PDF::loadView('kyc.analyserpdf',compact('statmendata'))->setPaper('A4');
                        return $pdf->stream('invoice.pdf');
                        // $hit_limits_exceeded = 1;
                        // return view('kyc.bankanalyser', compact('statmendata', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));

                    }
                    else{
                        return view('kyc.bankanalyser', compact('bank_upload', 'statusCode','hit_limits_exceeded'));
                    }
            }
        }
        // return $bank_verification;

        return view('kyc.bank_verification', compact('bank_verification', 'statusCode','hit_limits_exceeded'));
    }

    // corporate_cin
    public function corporate_cin(Request $request) {
        $statusCode = null;
        $corporate_cin = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.corporate_cin', compact('corporate_cin', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                // $headers = [
                //     'Authorization' => $this->token,        
                //     'Accept'        => 'application/json',
                // ];

                // $body =  [
                //     'id_number' => $request->id_number
                // ];

                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'corporate_cin' => $request->id_number
                ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','cin')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                
                try{
                    $res = $client->post('http://regtechapi.in/api/corporate_cin',['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/corporate/cin', ['headers' => $headers, 'json' => $body]);
                    $corporate_cin = json_decode($res->getBody(), true);
                    //dd($corporate_cin);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.corporate_cin', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/corporate_cin',['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/corporate/cin', ['headers' => $headers, 'json' => $body]);
                        $corporate_cin = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.corporate_cin', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.corporate_cin', compact('corporate_cin', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.corporate_cin', compact('corporate_cin', 'statusCode','hit_limits_exceeded'));
    }

    // corporate_din
    public function corporate_din(Request $request) {
        $statusCode = null;
        $corporate_din = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.corporate_din', compact('corporate_din', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];

            $body =  [
                'id_number' => $request->corporate_din
            ];

                // $accessToken = Auth::user()->access_token;
                
                // $headers = [
                // 'AccessToken' => $accessToken,
                // ];
                // $body =  [
                // 'corporate_cin' => $request->id_number
                // ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','din')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                

                try{                        
                    $res = $client->post('http://regtechapi.in/api/corporate_din',['headers' => $headers, 'json' => $body]);
                    // $res = $client->post('https://kyc-api.flowboard.in/api/v1/corporate/din', ['headers' => $headers, 'json' => $body]);
                    $corporate_din = json_decode($res->getBody(), true);
                    // dd($request->corporate_din);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.corporate_din', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/corporate_din',['headers' => $headers, 'json' => $body]);
                        // $res = $client->post($this->base_url.'/corporate/din', ['headers' => $headers, 'json' => $body]);
                        $corporate_din = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.corporate_din', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.corporate_din', compact('corporate_din', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

                    // dd($corporate_din);
        return view('kyc.corporate_din', compact('corporate_din', 'statusCode','hit_limits_exceeded'));
    }

     // Credit_monitor
     public function Credit_monitor(Request $request) {
        $statusCode = null;
        $Credit_monitor = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.Credit_monitor', compact('Credit_monitor', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'id_number' => $request->Credit_monitor,
                'companies_associated' => $request->companies_associated
            ];
            
            try{
                $res = $client->post($this->base_url.'/corporate/din', ['headers' => $headers, 'json' => $body]);
                $Credit_monitor = json_decode($res->getBody(), true);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
           
        }

        return view('kyc.Credit_monitor', compact('Credit_monitor', 'statusCode','hit_limits_exceeded'));
    }

    // corporate_gstin
    public function corporate_gstin(Request $request) {
        $statusCode = null;
        $corporate_gstin = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.corporate_gstin', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
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
                $body =  [
                'gstin' => $request->corporate_gstin
                ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','gstin')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                

                try{
                    $res = $client->post('http://regtechapi.in/api/corporate_gstin',['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/corporate/gstin', ['headers' => $headers, 'json' => $body]);
                    $corporate_gstin = json_decode($res->getBody(), true);
                    //dd($corporate_gstin);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.corporate_gstin', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/corporate_gstin',['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/corporate/gstin', ['headers' => $headers, 'json' => $body]);
                        $corporate_gstin = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.corporate_gstin', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.corporate_gstin', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.corporate_gstin', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
    }

    public function corporate_gstin_confidence(Request $request) {
        $statusCode = null;
        $corporate_gstin = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.corporate_gstin_confidence', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            
            $accessToken = Auth::user()->access_token;
            
            $headers = [
            'AccessToken' => $accessToken,
            ];
            $body =  [
            'gstin' => $request->corporate_gstin,
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode
            ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','gstinconfidence')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                try{
                    $res = $client->post('http://regtechapi.in/api/gstin_pan_confidence',['headers' => $headers, 'json' => $body]);
                    //$res = $client->post($this->base_url.'/corporate/gstin', ['headers' => $headers, 'json' => $body]);
                    $corporate_gstin = json_decode($res->getBody(), true);
                    //dd($corporate_gstin);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.corporate_gstin_confidence', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/gstin_pan_confidence',['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/corporate/gstin', ['headers' => $headers, 'json' => $body]);
                        $corporate_gstin = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.corporate_gstin_confidence', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.corporate_gstin_confidence', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('kyc.corporate_gstin_confidence', compact('corporate_gstin', 'statusCode','hit_limits_exceeded'));
    }
   
    // electricity
    public function electricity(Request $request) {
        $statusCode = null;
        $electricity = null;
        $states = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.electricity', compact('electricity', 'statusCode','states','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->scheme_type!='demo') {
                $client = new Client();
                $accessToken = Auth::user()->access_token;
            
                $headers = [
                'AccessToken' => $accessToken,
                ];

                $body =  [
                    'id_number' => $request->id_number
                ];

                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','electricity')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                    $res = $client->post('http://regtechapi.in/api/electricity', ['headers' => $headers, 'json' => $body]);
                    $electricity = json_decode($res->getBody(), true);

                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.electricity', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/electricity', ['headers' => $headers, 'json' => $body]);
                        $electricity = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.electricity', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                }
            }
            return view('kyc.electricity', compact('electricity', 'statusCode', 'states','hit_limits_exceeded'));
        }
    }

    //eSign  
    public function esign(Request $request) {
        $statusCode = null;
        $esign = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.esign', compact('esign', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'id_number' => $request->account_number,
                'ifsc' => $request->ifsc
            ];

            try{
                $res = $client->post($this->base_url.'/corporate/gstin', ['headers' => $headers, 'json' => $body]);
                $esign = json_decode($res->getBody(), true);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
           
        }

        return view('kyc.esign', compact('esign', 'statusCode','hit_limits_exceeded'));
    }


      // Docboyz Esign

     public function esign_docboyz(Request $request) {
        $statusCode = null;
        $license_validation = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('esign.esign_docboyz', compact('esign_docboyz', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                $headers = [
                    'Authorization' => $this->token,        
                    'Accept'        => 'application/json',
                ];

                $body =  [
                    'id_number' => $request->license_number
                ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','license')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                

                try{
                    $res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body]);
                    $esign_docboyz = json_decode($res->getBody(), true);
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.esign_docboyz', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post($this->base_url.'/driving-license/driving-license', ['headers' => $headers, 'json' => $body]);
                        $esign_docboyz = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.esign_docboyz', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.esign_docboyz', compact('esign_docboyz', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('esign.esign_docboyz', compact('esign_docboyz', 'statusCode','hit_limits_exceeded'));
    }

     // shopestablishment 
     public function shopestablishment(Request $request) {
        $statusCode = null;
        $shopestablishment = null;
        $hit_limits_exceeded = 0;

        $client = new Client();
        $accessToken = Auth::user()->access_token;
            
        $headers = [
            'AccessToken' => $accessToken,
        ];

        try{
            $res = $client->get('http://regtechapi.in/api/shopestablishment', ['headers' => $headers]);
            $states = json_decode($res->getBody(), true);
            $statusCode = 200;
        } catch(BadResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
        }

        if($request->isMethod('GET')){
            return view('kyc.shopestablishment', compact('shopestablishment', 'statusCode','states','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','shop_establishment')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                $client = new Client();
                $accessToken = Auth::user()->access_token;
            
                $headers = [
                    'AccessToken' => $accessToken,
                ];

                $body =  [
                    'id_number' => $request->id_number,
                    'state_code' => $request->state_code
                ];

                try{
                    $res = $client->post('http://regtechapi.in/api/shopestablishment', ['headers' => $headers, 'json' => $body]);
                    $shopestablishment = json_decode($res->getBody(), true);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.shopestablishment', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/shopestablishment', ['headers' => $headers, 'json' => $body]);
                        $shopestablishment = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.shopestablishment', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.shopestablishment', compact('shopestablishment', 'statusCode','states','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.shopestablishment', compact('shopestablishment', 'statusCode','states','hit_limits_exceeded'));
    }

     // telecom
     public function telecom(Request $request) {
        $statusCode = null;
        $telecom = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.telecom', compact('telecom', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
         
            $accessToken = Auth::user()->access_token;
            
            $headers = [
                'AccessToken' => $accessToken,
            ];

            $json = [
                'id_number' => $request -> mobile_number            
            ];



            $client = new CLient();


            if(Auth::user() -> scheme_type!= 'demo'){
                if(Auth::user() -> role_id == 1){
                    $api_master = ApiMaster::where('api_slug','telecom_generate_otp') -> first();
                    if($api_master)
                        $api_id = $api_master -> id;                        
                }

                try{
                    $response = $client -> post('http://regtechapi.in/api/telecom/generate-otp',[
                        'headers' => $headers,
                        'json' => $json
                        ]);

                    $telecom = json_decode($response -> getBody(),true);
                    $statusCode = 200;

                }catch(BadResponseException $e){
                    $statusCode = $e -> getResponse() -> getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.telecom', compact('statusCode','errorMessage'));
                }
            }else
            {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $response = $client -> post('http://regtechapi.in/api/telecom/generate-otp',[
                        'headers' => $headers,
                        'json' => $json
                        ]);

                        $telecom = json_decode($response -> getBody(),true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.telecom', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.telecom', compact('telecom', 'statusCode','hit_limits_exceeded'));
                }
       
            }
        return view('kyc.telecom', compact('telecom', 'statusCode','hit_limits_exceeded'));
        }
    }


    public function telecom_submit_otp(Request $request){
        $statusCode = null;
        $telecom_submit_otp = null;
        $hit_limits_exceeded = null;

        if($request -> isMethod('GET'))
            return view('kyc.telecom_submit_otp',compact('telecom_submit_otp','statusCode','hit_limits_exceeded'));

        if($request -> isMethod('POST')){
            $accessToken = Auth::user()->access_token;
            
            $headers = [
                'AccessToken' => $accessToken,
            ];
            $json = [
                'client_id' => $request -> client_id,
                'otp' => $request -> otp
                ];
            $client = new Client();
            if(Auth::user()->scheme_type!='demo' ){
                if(Auth::user()->role_id == 1){
                    $api_master = ApiMaster::where('api_slug','telecom_submit_otp') -> first();
                    if($api_master)
                        $api_id = $api_master -> id;                    

                }
                try
                {
                    $response = $client -> post('http://regtechapi.in/api/telecom/submit-otp',[
                        'headers' => $headers,
                        'json' => $json
                    ]);

                    $telecom_submit_otp = json_decode($response -> getBody(),true);
                    $statusCode = 200;

                }catch(BadResponseException $e)
                {
                    $statusCode = $e -> getResponse() -> getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.telecom_submit_otp', compact('statusCode','errorMessage'));
                }
            }
            else
            {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $response = $client -> post('http://regtechapi.in/api/telecom/submit-otp',[
                        'headers' => $headers,
                        'json' => $json
                        ]);

                        $telecom_submit_otp = json_decode($response -> getBody(),true);
                                            dd($telecom_submit_otp);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.telecom_submit_otp', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.telecom_submit_otp', compact('telecom_submit_otp','statusCode','hit_limits_exceeded'));
                }
            }
            return view('kyc.telecom_submit_otp', compact('telecom_submit_otp','statusCode','hit_limits_exceeded'));
        }
    }        

    public function telecom_apis(){
        return view('kyc.telecom_api');
    }


    public function face_match_api(){
        return view('kyc.face_match_api');
    }

    //license upload api implementation
    public function license_upload(Request $request){
        $statusCode = null;
        $license = null;
        $hit_limits_exceeded = 0;
        $license_validation = null;

        if($request->isMethod('GET')){
            return view('kyc.license_upload', compact('license','license_validation', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            //checking if file exists or not
            if (!$request->hasFile('front')) {
                return json_encode(['message'=>"front file not found"], true);
            }
            if (!$request->hasFile('back')) {
                return json_encode(['message'=>"back file not found"], true);
            }

            $accessToken = Auth::user()->access_token;

            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "http://regtechapi.in/api/driving_upload", //"https://sandbox.flowboard.in/api/v1/ocr/license",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "front" => new \CURLFILE($_FILES['front']['tmp_name'],$_FILES['front']['type'],$_FILES['front']['name']),
                    "back" => new \CURLFILE($_FILES['back']['tmp_name'],$_FILES['back']['type'],$_FILES['back']['name'])
                ),
                CURLOPT_HTTPHEADER => array(
                    "AccessToken: ".$accessToken,
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            //dd($curl1);
            $licenseocr = json_decode($result, true);
            if(isset($licenseocr[0]['$ocr_fields'])){
                $license = $licenseocr[0]['$ocr_fields'];
                $license_validation = $licenseocr[0]['license_validation'];
                $statusCode = $licenseocr[0]['statusCode'];
            }

            if(isset($license_validation['status_code']) && $license_validation['status_code'] == 200){
                $is_valid = 1;
            }
            return view('kyc.license_upload', compact('license', 'statusCode','hit_limits_exceeded','is_valid','license_validation'));
        }
    }

    // Passport
    public function passport(Request $request) {
        return view('kyc.passport');
    }

    // Passport create client
    public function passport_create_client_ajax(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
             $client = new Client();
                $headers = [
                    'Authorization' => $this->token,        
                    'Accept'        => 'application/json',
                ];

                $body =  [
                    'id_number' => 'asd'
                ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_name','passport')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                $client = new Client();
                $headers = [
                    'Authorization' => $this->token,        
                    'Accept'        => 'application/json',
                ];

                $body =  [
                    'id_number' => 'asd'
                ];

                try{
                    $res = $client->post($this->base_url.'/passport/passport/create', ['headers' => $headers, 'json' => $body]);
                    $passport = json_decode($res->getBody(), true);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.passport_create_client', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post($this->base_url.'/passport/passport/create', ['headers' => $headers, 'json' => $body]);
                        $passport = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                        $statusCode = 200;

                        $remark = 'Passport validation Debited '.$updateHitCount->scheme_price.' Sucessfull';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark, $statusCode);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.passport_create_client', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        // return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
        return response()->json(array(['passport'=>$passport,'hit_limits_exceeded'=>$hit_limits_exceeded,'statusCode'=>$statusCode]));
    }

    // Passport upload
     public function passport_upload_ajax(Request $request){
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_upload', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if($request->hasFile('file')) {
            $file = $request->file('file');
            dd($file);
            }
            //checking if file exists or not
            // if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
            // if(!isset($_FILES['file'])){
            //     return json_encode(['message'=>"file not found"], true);
            // }


            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "https://kyc-api.flowboard.in/api/v1/passport/passport/".$request->client_id."/upload",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: ".$this->token,
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $passport = json_decode($result, true);
            $statusCode = 200;

            // dd($passport);

            // return $get_data1;
            // return view('kyc.passport_upload', compact('passport', 'statusCode','hit_limits_exceeded'));
            return response()->json(array(['passport'=>$passport,'hit_limits_exceeded'=>$hit_limits_exceeded,'statusCode'=>$statusCode]));
        }
    }

    // Passport verify
    public function passport_verify_ajax(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_verify', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(Auth::user()->role_id==1) {
            //     $apiamster = ApiMaster::where('api_name','PAN CARD - FBORD')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }

            //$client = new Client();
	    $client = new Client(['verify' => false ]);

            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'client_id' => $request->client_id
            ];

            try{
                // dd($body);
                $res = $client->post($this->base_url.'/passport/passport/verify', ['headers' => $headers, 'json' => $body]);
                $passport = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                //     if($apiamster) {
                //         $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();
                //         // $updateHitCount->hit_count = $updateHitCount->hit_count+1;
                //         // $updateHitCount->save();

                //         $addHitCount = new HitCountMaster;
                //         $addHitCount->user_id = Auth()->user()->id;
                //         $addHitCount->api_id = $api_id;
                //         $addHitCount->scheme_price = $updateHitCount->scheme_price;
                //         $addHitCount->hit_year_month = date('Y-m');
                //         $addHitCount->hit_count = 1;
                //         $addHitCount->save();
                //     }
                // }
                // dd($passport);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        }

        return view('kyc.passport_verify', compact('passport', 'statusCode','hit_limits_exceeded'));
    }

    // Passport get client details
    public function passport_get_client_details_ajax(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_get_client_details', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(Auth::user()->role_id==1) {
            //     $apiamster = ApiMaster::where('api_name','PAN CARD - FBORD')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }

            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'client_id' => $request->client_id
            ];

            try{
                $res = $client->get($this->base_url.'/passport/passport/'.$request->client_id, ['headers' => $headers, 'json' => $body]);
                $passport = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                    // if($apiamster) {
                    //     $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                    //     $addHitCount = new HitCountMaster;
                    //     $addHitCount->user_id = Auth()->user()->id;
                    //     $addHitCount->api_id = $api_id;
                    //     $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    //     $addHitCount->hit_year_month = date('Y-m');
                    //     $addHitCount->hit_count = 1;
                    //     $addHitCount->save();
                    // }
                // }

                // dd($passport);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        }

        return view('kyc.passport_get_client_details', compact('passport', 'statusCode','hit_limits_exceeded'));
    }

    // Passport create client
    public function passport_create_client(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];

            $body =  [
                'id_number' => 'asd'
            ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_name','passport')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                
                try{
                    $res = $client->post('http://regtechapi.in/api/passport_create_client', ['headers' => $headers, 'json' => $body]);
                    $passport = json_decode($res->getBody(), true);
                    $statusCode = 200;

                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.passport_create_client', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/passport_create_client', ['headers' => $headers, 'json' => $body]);
                        $passport = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.passport_create_client', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.passport_create_client', compact('passport', 'statusCode','hit_limits_exceeded'));
    }

    // Passport upload
     public function passport_upload(Request $request){
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;
        $status_code=null;

        if($request->isMethod('GET')){
            return view('kyc.passport_upload', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            //checking if file exists or not
            if (!$request->hasFile('file')) {
                return json_encode(['message'=>"file not found"], true);
            }


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
                    "file" => new \CURLFILE($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']),
                    "client_id"=>$request->client_id
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: ".$this->token,
                ),
            ));
            // $get_data1 = curl_exec($curl1);
            $result = curl_exec($curl1);
            $passport = json_decode($result, true);
            
            if(isset($passport['statusCode'])){
                $statusCode = $passport['statusCode'];
            }else{
                $statusCode = 500;
            }
                // dd($passport);
                // echo 'status_code='.$status_code;
            $passport_verification = null;
            $is_verified = 0;
            if($statusCode==200 || $statusCode==400)
            {
                $client_id = $passport['OCR_DATA']['data']['client_id'];
                // dd($client_id);
                // echo 'client_id='.$client_id;
                $client = new Client();
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];

                $body =  [
                    'client_id' => $client_id
                ];

                try{
                    // dd(1);
                    $res = $client->post('http://regtechapi.in/api/passport_verify', ['headers' => $headers, 'json' => $body]);
                    $passport_verification = json_decode($res->getBody(), true);
                    // dd($passport_verification);
                    if($passport_verification['status_code']==200)
                        $is_verified = 1;
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $is_verified = 0;
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.passport_upload', compact('statusCode','errorMessage'));
                }
            }

            // return $get_data1;
            // dd($statusCode);
            return view('kyc.passport_upload', compact('passport_verification', 'statusCode','hit_limits_exceeded','status_code','passport_verification'));
        }
      }


    
    //API LIST
    public function pancard_api()
    {
     return view('kyc.pancard_api');   
    }

    public function search_api()
    {
     return view('kyc.search_api');   
    }

    public function ckycsearch_api()
    {
     return view('kyc.ckycsearch_api');   
    }

    public function ckycdownload_api()
    {
     return view('kyc.ckycdownload_api');   
    }

    public function udyam_api()
    {
     return view('kyc.udyam_api');   
    }

    public function udyamadhar_api()
    {
     return view('kyc.udyamadhar_api');   
    }

    //API LIST
    public function aadhaar_api(Request $request) 
    {       
        return view('kyc.aadhaar_api');
    }

    //API LIST
    public function voter_api()
    {
        return view('kyc.voter_api');
    }

    //API LIST
    public function license_api()
    {
        return view('kyc.license_api');
    }

    //API LIST
    public function rc_api()
    {
        return view('kyc.rc_api');
    }

    //API LIST
    public function corporate_cin_apis()
    {
        return view('kyc.corporate_cin_apis');
    }

    //API LIST//
    public function corporate_din_apis()
    {
        return view('kyc.corporate_din_apis');
    }

    //GSTIN API
    public function corporate_gstin_api()
    {
        return view('kyc.corporate_gstin_api');
    }

    public function corporate_gstin_confidence_api()
    {
        return view('kyc.corporate_gstin_confidence_api');
    }

    // Passport verify
    public function passport_verify(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_verify', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            $accessToken = Auth::user()->access_token;
                
            $headers = [
            'AccessToken' => $accessToken,
            ];

            $body =  [
                'client_id' => $request->client_id
                ];
            try{
                
                $res = $client->post('http://regtechapi.in/api/passport_verify',['headers' => $headers,'json' => $body]);
                $passport = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                //     if($apiamster) {
                //         $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();
                //         // $updateHitCount->hit_count = $updateHitCount->hit_count+1;
                //         // $updateHitCount->save();

                //         $addHitCount = new HitCountMaster;
                //         $addHitCount->user_id = Auth()->user()->id;
                //         $addHitCount->api_id = $api_id;
                //         $addHitCount->scheme_price = $updateHitCount->scheme_price;
                //         $addHitCount->hit_year_month = date('Y-m');
                //         $addHitCount->hit_count = 1;
                //         $addHitCount->save();
                //     }
                // }
                // dd($passport);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        }

        return view('kyc.passport_verify', compact('passport', 'statusCode','hit_limits_exceeded'));
    }

    // Passport get client details
    public function passport_get_client_details(Request $request) {
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.passport_get_client_details', compact('passport', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(Auth::user()->role_id==1) {
            //     $apiamster = ApiMaster::where('api_name','PAN CARD - FBORD')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }

            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'client_id' => $request->client_id
            ];

            try{
                $res = $client->get($this->base_url.'/passport/passport/'.$request->client_id, ['headers' => $headers, 'json' => $body]);
                $passport = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                    // if($apiamster) {
                    //     $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                    //     $addHitCount = new HitCountMaster;
                    //     $addHitCount->user_id = Auth()->user()->id;
                    //     $addHitCount->api_id = $api_id;
                    //     $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    //     $addHitCount->hit_year_month = date('Y-m');
                    //     $addHitCount->hit_count = 1;
                    //     $addHitCount->save();
                    // }
                // }

                // dd($passport);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        }

        return view('kyc.passport_get_client_details', compact('passport', 'statusCode','hit_limits_exceeded'));
    }

	// eSign 
    public function esign_initialize(Request $request) {
        $statusCode = null;
        $esign = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.esign_initialize', compact('esign', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','esign')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                $client = new Client();
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];

                $body =  [
                    "pdf_pre_uploaded"=> false,
                    "config"=> [
                        "auth_mode"=> "1",
                        "reason"=> "Contract",
                        "positions"=> [
                            "1"=> [
                                [
                                    "x"=> 10,
                                    "y"=> 20
                                ]
                            ],
                            "2"=> [
                                [
                                    "x"=> 0,
                                    "y"=> 0
                                ]
                            ]
                        ]
                    ],
                    "prefill_options"=> [
                        "full_name"=> $request->full_name,
                        "mobile_number"=> $request->mobile_number,
                        "user_email"=> $request->user_email
                    ]
                ];

                    // dd($body);
                try{
                    $res=$client->post('http://regtechapi.in/api/esign', ['headers' => $headers, 'json' => $body,'verify' =>false]);
                    //$res = $client->post($this->sandbox_url.'/esign/initialize', ['headers' => $headers, 'json' => $body,'verify' =>false]);
                     //dd($res);
                    $esign = json_decode($res->getBody(), true);
                    // dd($esign);
                    // print_r($esign);
                    // exit(1);

                    $statusCode = 200;
                    
                    // dd($esign);
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.esign_initialize', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/esign', ['headers' => $headers, 'json' => $body]);
                        $esign = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.esign_initialize', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.esign_initialize', compact('esign', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.esign_initialize', compact('esign', 'statusCode','hit_limits_exceeded'));
    }


    // Usage
     public function usage(Request $request) {
        $statusCode = null;
        $usage = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.usage', compact('usage', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','usage')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                $client = new Client();
                $headers = [
                    'Authorization' => $this->token,        
                    'Accept'        => 'application/json',
                ];

                $body =  [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'type' => $request->type,
                    'recipient_email' => $request->recipient_email
                ];

                try{
                    $res = $client->post($this->base_url.'/utils/usage/usage-report', ['headers' => $headers, 'json' => $body]);
                    $usage = json_decode($res->getBody(), true);
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.usage', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post($this->base_url.'/utils/usage/usage-report', ['headers' => $headers, 'json' => $body]);
                        $usage = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.usage', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.usage', compact('usage', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.usage', compact('usage', 'statusCode','hit_limits_exceeded'));
     }

    // eSign 
    public function esign_upload_link(Request $request) {
        $statusCode = null;
        $esign = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.esign_upload_link', compact('esign', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(Auth::user()->role_id==1) {
            //     $apiamster = ApiMaster::where('api_name','PAN CARD - FBORD')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }

            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'pdf_pre_uploaded' => false
            ];

            try{
                $res = $client->post($this->base_url.'/esign/get-upload-link', ['headers' => $headers, 'json' => $body]);
                $esign = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                    // if($apiamster) {
                    //     $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                    //     $addHitCount = new HitCountMaster;
                    //     $addHitCount->user_id = Auth()->user()->id;
                    //     $addHitCount->api_id = $api_id;
                    //     $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    //     $addHitCount->hit_year_month = date('Y-m');
                    //     $addHitCount->hit_count = 1;
                    //     $addHitCount->save();
                    // }
                // }
                dd($esign);
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.esign_upload_link', compact('statusCode','errorMessage'));
            }
        }

        return view('kyc.esign_upload_link', compact('esign', 'statusCode','hit_limits_exceeded'));
    }

    // eSign 
    public function esign_get_client_link(Request $request) {
        $statusCode = null;
        $esign = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.esign_get_client_link', compact('esign', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(Auth::user()->role_id==1) {
            //     $apiamster = ApiMaster::where('api_name','PAN CARD - FBORD')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }

            $client = new Client();
            $headers = [
                'Authorization' => $this->token,        
                'Accept'        => 'application/json',
            ];

            $body =  [
                'pdf_pre_uploaded' => false
            ];

            try{
                $res = $client->post($this->base_url.'/initialize', ['headers' => $headers, 'json' => $body]);
                $esign = json_decode($res->getBody(), true);
                // if(Auth::user()->role_id==1) {
                    // if($apiamster) {
                    //     $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                    //     $addHitCount = new HitCountMaster;
                    //     $addHitCount->user_id = Auth()->user()->id;
                    //     $addHitCount->api_id = $api_id;
                    //     $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    //     $addHitCount->hit_year_month = date('Y-m');
                    //     $addHitCount->hit_count = 1;
                    //     $addHitCount->save();
                    // }
                // }
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.esign_get_client_link', compact('statusCode','errorMessage'));
            }
        }

        return view('kyc.esign_get_client_link', compact('esign', 'statusCode','hit_limits_exceeded'));
    }

    // ownapi
     public function ownapi(Request $request) {
        return Redirect::to("http://videokyc.docboyz.in/");
    }

    public function passport_api(){
        return view('kyc.passport_api');
    }

    public function all_apis(){
        return view('kyc.all_apis');
    }

    //bank verifcation ifsc

     // bank_verification
     public function bank_verification_find_ifsc(Request $request) {
        $statusCode = null;
        $bank_verification_ifsc = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('kyc.bank_ifsc', compact('bank_verification_ifsc', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
                
                $accessToken = Auth::user()->access_token;
                
                $headers = [
                'AccessToken' => $accessToken,
                ];
                $body =  [
                'ifsc' => $request->ifsc
                ];

            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','bank_ifsc')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }

                try{
                    $res = $client->post('http://regtechapi.in/api/bank_verification_find_ifsc', ['headers' => $headers, 'json' => $body]);
                    $bank_verification_ifsc = json_decode($res->getBody(), true);
                    //dd($bank_verification_ifsc);
                    if(isset($aadhaar_validation[0]['aadhaar_validation']['code'])){
                        $statusCode = $aadhaar_validation[0]['aadhaar_validation']['code'];
                    }
                    
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.bank_ifsc', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/bank_verification_find_ifsc', ['headers' => $headers, 'json' => $body]);
                        //$res = $client->post($this->base_url.'/bank-verification/find-ifsc', ['headers' => $headers, 'json' => $body]);
                        $bank_verification_ifsc = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.bank_ifsc', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.bank_ifsc', compact('bank_verification_ifsc', 'statusCode','hit_limits_exceeded'));
                }
            }
        }

        return view('kyc.bank_ifsc', compact('bank_verification_ifsc', 'statusCode','hit_limits_exceeded'));
    }

	public function fssi_verification (Request $request) {
        
        
        $statusCode = null;
        $fssi_validation = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            
            return view('kyc.fssi_validation', compact('fssi_validation', 'statusCode','hit_limits_exceeded'));
        }
        // dd('dddd');

        if($request->isMethod('POST')){
           // $data="22819015001312";
            $client = new Client();
            
            $user_id=Auth()->user()->id;
            $user = User::where('id',$user_id)->first();
            $accessToken = $user->access_token;
                $headers = [
                    'AccessToken' => $accessToken
                ];

                $body =  [
                    'id_number' => $request->fssi_number
                ];
                // dd($request->fssi_number);
                
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','fssi')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                    // dd($request->fssi_number);
                try{
                   $res = $client->post('http://regtechapi.in/api/fssi', ['headers' => $headers, 'json' => $body]);                          
                    $fssi_validation = json_decode($res->getBody(), true);
                    // dd($fssi_validation);
                    // if(Auth::user()->role_id==1) {
                    //     if($apiamster) {
                    //         $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();
                    //         $addHitCount = new HitCountMaster;
                    //         $addHitCount->user_id = Auth()->user()->id;
                    //         $addHitCount->api_id = $api_id;
                    //         $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    //         $addHitCount->hit_year_month = date('Y-m');
                    //         $addHitCount->hit_count = 1;
                    //         $addHitCount->save();

                            
                    //         $remark = 'FSSAI validation Debited '.$updateHitCount->scheme_price.' Sucessfull';
                    //         $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                    //         $this->update_wallet_balance($updateHitCount->scheme_price);




                    //     }
                    // dd( $fssi_validation);
                    // }
                } 
               
                catch(BadResponseException $e) {
                    // dd( $fssi_validation);
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    return view('kyc.fssi_validation', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/fssi', ['headers' => $headers, 'json' => $body]);
                        $fssi_validation = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        return view('kyc.fssi_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                   
                    return view('kyc.fssi_validation', compact('fssi_validation', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        // dd( $fssi_validation);
        return view('kyc.fssi_validation', compact('fssi_validation', 'statusCode','hit_limits_exceeded'));
    }
	 
	public function fssai_api(Request $request)
	{
		return view('kyc.fssai_api');
	}

    //EPFO otp generate

public function pf_generate_otp(Request $request) {
    $statusCode = null;
    $pf_generate_otp = null;
    $hit_limits_exceeded = 0;

    if($request->isMethod('GET')){
        
        return view('kyc.pf_generate_otp', compact('pf_generate_otp', 'statusCode'));//,'hit_limits_exceeded'));
    }
    if($request->isMethod('POST')){
       
        $client = new Client();
        $accessToken = Auth::user()->access_token;
        $headers = [
            'AccessToken' => $accessToken,        
            'Accept'        => 'application/json',
        ];

        $body =  [
            'id_number' => $request->epfo_number
        ];
        // if(Auth::user()->scheme_type!='demo') {
        //     if(Auth::user()->role_id==1) {
        //         $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
        //         if($apiamster)
        //             $api_id = $apiamster->id;
        //     }
            
            try{
                // dd('hii');
                $res = $client->post('http://regtechapi.in/api/pf_generate_otp', ['headers' => $headers, 'json' => $body]);
                // $res = $client->post($this->base_url.'/income/epfo/passbook/generate-otp', ['headers' => $headers, 'json' => $body]);
                $pf_generate_otp = json_decode($res->getBody(), true);
                //  dd($pf_generate_otp);
                //  dd('hiii');
                $statusCode = 200;
                
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.pf_generate_otp', compact('statusCode','errorMessage'));
            }
        // } else {
        //     $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
        //     $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
        //     if($hit_count_remaining>0)
        //     {
        //         try{
        //             $res = $client->post($this->base_url.'/aadhaar-v2/generate-otp', ['headers' => $headers, 'json' => $body]);
        //             $aadhaar_otp_genrate = json_decode($res->getBody(), true);
        //             $user = User::where('id',Auth::user()->id)->first();
        //             $user->scheme_hit_count = $user->scheme_hit_count+1;
        //             $user->save();
        //         } catch(BadResponseException $e) {
        //             $statusCode = $e->getResponse()->getStatusCode();
        //         }
        //     } 
        // else {
        //         $hit_limits_exceeded = 1;
        //         return view('kyc.aadhaar_otp_genrate', compact('aadhaar_otp_genrate', 'statusCode','hit_limits_exceeded'));
        //     }
        //}
    }

    return view('kyc.pf_generate_otp', compact('pf_generate_otp', 'statusCode'));//,'hit_limits_exceeded'));
}

// EPFO OTP Submit


public function pf_submit_otp(Request $request) {
    // dd('sasas');
    $statusCode = null;
    $pf_submit_otp = null;
    $hit_limits_exceeded = 0;

    if($request->isMethod('GET')){
        
        return view('kyc.pf_submit_otp', compact('pf_submit_otp', 'statusCode'));//,'hit_limits_exceeded'));
    }
    if($request->isMethod('POST')){

        $client = new Client();
        $accessToken = Auth::user()->access_token;
        $headers = [
            'AccessToken' => $accessToken,        
            'Accept'        => 'application/json',
        ];

        $body =  [
            'client_id' => $request->client_id,
            'otp' => $request->otp
        ];

        // if(Auth::user()->scheme_type!='demo') {
        //     if(Auth::user()->role_id==1) {
        //         $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
        //         if($apiamster)
        //             $api_id = $apiamster->id;
        //     }

            try{
                // dd('hii');
                $res = $client->post('http://regtechapi.in/api/pf_submit_otp', ['headers' => $headers, 'json' => $body]);
                // $res = $client->post($this->base_url.'/income/epfo/passbook/submit-otp', ['headers' => $headers, 'json' => $body]);
                //dd($res);
                $pf_submit_otp = json_decode($res->getBody(), true);
                
                $statusCode = 200;
               
            } catch(BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.pf_submit_otp', compact('statusCode','errorMessage'));
            }
        // } else {
        //     $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
        //     $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
        //     if($hit_count_remaining>0)
        //     {
        //         try{
        //             $res = $client->post($this->base_url.'/aadhaar-v2/submit-otp', ['headers' => $headers, 'json' => $body]);
        //             $aadhaar_validation = json_decode($res->getBody(), true);
        //             $user = User::where('id',Auth::user()->id)->first();
        //             $user->scheme_hit_count = $user->scheme_hit_count+1;
        //             $user->save();
        //         } catch(BadResponseException $e) {
        //             $statusCode = $e->getResponse()->getStatusCode();
        //         }
            // } else {
            //     $hit_limits_exceeded = 1;
            //     return view('kyc.aadhaar_otp_submit', compact('aadhaar_validation', 'statusCode','hit_limits_exceeded'));
            // }
        //}
    }
    // dd($aadhaar_validation);
    return view('kyc.pf_submit_otp', compact('pf_submit_otp', 'statusCode'));//,'hit_limits_exceeded'));
}

    public function pf_without_otp(Request $request) {
        $statusCode = null;
        $epfo_details = null;
        if($request->isMethod('GET')){
        
            return view('kyc.pf_without_otp');//,'hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            // if(empty($request->name))
            //     return response()->json(array(['message'=>'name is required','statusCode'=>'404']));
            
            // if(empty($request->name))
            //     return response()->json(array(['message'=>'comapany is required','statusCode'=>'404']));

            // if(!$request->headers->has('AccessToken'))
            //     return response()->json(array(['message'=>'Header Access Token is required','statusCode'=>'404']));

            // $verifyAccessToken = $this->verifyAccessToken($request->header('AccessToken'));
            // if ($verifyAccessToken==false)
            //     return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
            $accessToken = Auth::user()->access_token;
            $user = User::where('access_token',$accessToken)->first();
            // if($user->role_id==1) {
            //     $apiamster = ApiMaster::where('api_slug','epfowithoutotp')->first();
            //     if($apiamster)
            //         $api_id = $apiamster->id;
            // }
            
            $client = new Client();
            $headers = [
                'AccessToken' => $accessToken,
                'Accept' => 'application/json' 
                ];
            $json = [
                'name' => $request -> name,
                'company' => $request -> company_name
            ];
            try{
                $response = $client -> post("http://regtechapi.in/api/epfo",['headers' => $headers,'json' => $json]);
                    // return $response;
                $epfo_details = json_decode($response -> getBody(),true);
                
            }catch(BadResponseException $e){
                $statusCode = $e -> getResponse() -> getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.pf_without_otp', compact('statusCode','errorMessage'));
                // return response()->json(['statusCode'=>$statusCode,'message' => 'Unprocessable Entity']);
            }
        }
        return view('kyc.pf_without_otp', compact('epfo_details'));
    }

    public function uan_details(Request $request) {
        $statusCode = null;
        $uan_details = null;
        if($request->isMethod('GET')){
        
            return view('kyc.uan_details');//,'hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            
            $accessToken = Auth::user()->access_token;
            $user = User::where('access_token',$accessToken)->first();
            
            $client = new Client();
            $headers = [
                'AccessToken' => $accessToken,
                'Accept' => 'application/json' 
                ];
            $json = [
                'mobile_number' => $request -> mobile_number
            ];
            try{
                $response = $client -> post("http://regtechapi.in/api/uan",['headers' => $headers,'json' => $json]);
                    // return $response;
                $uan_details = json_decode($response -> getBody(),true);
                
            }catch(BadResponseException $e){
                $statusCode = $e -> getResponse() -> getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.uan_details', compact('statusCode','errorMessage'));
                // return response()->json(['statusCode'=>$statusCode,'message' => 'Unprocessable Entity']);
            }
        }
        return view('kyc.uan_details', compact('uan_details'));
    }

    public function company_search(Request $request) {
        $statusCode = null;
        $company_search = null;
        if($request->isMethod('GET')){
        
            return view('kyc.company_search');//,'hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            
            $accessToken = Auth::user()->access_token;
            $user = User::where('access_token',$accessToken)->first();
            
            $client = new Client();
            $headers = [
                'AccessToken' => $accessToken,
                'Accept' => 'application/json' 
                ];
            $json = [
                'company' => $request -> company,
                'search_size' => $request -> search_size
            ];
            try{
                $response = $client -> post("http://regtechapi.in/api/company_search",['headers' => $headers,'json' => $json]);
                    // return $response;
                $company_search = json_decode($response -> getBody(),true);
                
                
                $statusCode = $company_search['statusCode'];
            }catch(BadResponseException $e){
                $statusCode = $e -> getResponse() -> getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.company_search', compact('statusCode','errorMessage'));
                // return response()->json(['statusCode'=>$statusCode,'message' => 'Unprocessable Entity']);
            }
        }
        return view('kyc.company_search', compact('company_search', 'statusCode'));
    }

    public function company_details(Request $request) {
        $statusCode = null;
        $company_details = null;
        if($request->isMethod('GET')){
        
            return view('kyc.company_details');//,'hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            
            $accessToken = Auth::user()->access_token;
            $user = User::where('access_token',$accessToken)->first();
            
            $client = new Client();
            $headers = [
                'AccessToken' => $accessToken,
                'Accept' => 'application/json' 
                ];
            $json = [
                'company_code' => $request -> company_code,
                'filing_data_size' => $request -> filing_data_size
            ];
            try{
                $response = $client -> post("http://regtechapi.in/api/company_details",['headers' => $headers,'json' => $json]);
                    // return $response;
                $company_details = json_decode($response -> getBody(),true);
                
                $statusCode = $company_details['statusCode'];
            }catch(BadResponseException $e){
                $statusCode = $e -> getResponse() -> getStatusCode();
                $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                return view('kyc.company_details', compact('statusCode','errorMessage'));
                // return response()->json(['statusCode'=>$statusCode,'message' => 'Unprocessable Entity']);
            }
        }
        return view('kyc.company_details', compact('company_details', 'statusCode'));
    }

    public function getPlanValues(Request $request) {
        $plan_details = '';
        if($request->plan == 'basic'){
            $plan_details=DB::table('api_master')->select('id','basic_price as price', 'api_group_id')->get();
        }else if($request->plan == 'starter'){
            $plan_details=DB::table('api_master')->select('id','starter_price as price', 'api_group_id')->get();
        }else if($request->plan == 'standard'){
            $plan_details=DB::table('api_master')->select('id','standard_price as price', 'api_group_id')->get();
        }else if($request->plan == 'advance'){
            $plan_details=DB::table('api_master')->select('id','advance_price as price', 'api_group_id')->get();
        }else if($request->plan == 'growth'){
            $plan_details=DB::table('api_master')->select('id','growth_price as price', 'api_group_id')->get();
        }else if($request->plan == 'unicorn'){
            $plan_details=DB::table('api_master')->select('id','unicorn_price as price', 'api_group_id')->get();            
        }
        return response()->json($plan_details);
    }


    public function fasttag_information(Request $request) {
        $fasttag_information = '';
        $statusCode = '';
        return view('kyc.fasttag_information', compact('fasttag_information', 'statusCode'));
    }

    public function upi_validation(Request $request) {
        $statusCode = null;
        $upidetails = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.upi_validation', compact('upidetails', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        if($request->isMethod('POST')){
            $client = new Client();
            
            $accessToken = Auth::user()->access_token;
                
            $headers = [
                'AccessToken' => $accessToken,
            ];
           $body =  [
            'name' => $request->name,
            'upi_id' => $request->upi_id,
            'order_id' => $request->order_id,
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','upi')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/upi_validation',['headers' => $headers, 'json' => $body]);
                    
                    $upidetails = json_decode($res->getBody(), true);
                    if(isset($upidetails[0]['upidetails']['code'])){
                        $statusCode = $upidetails[0]['upidetails']['code'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.pancard', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/upi_validation',['headers' => $headers, 'json' => $body]);
                        $upidetails = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.upi_validation', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.upi_validation', compact('upidetails', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        return view('kyc.upi_validation', compact('upidetails', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function face_match(Request $request) {
        $statusCode = null;
        $face_match = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.face_match', compact('face_match', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
        if($request->isMethod('POST')){
            $client = new Client();

            $doc_img = base64_encode(file_get_contents($request->file('doc_img')->path()));
            $selfie = base64_encode(file_get_contents($request->file('selfie')->path()));

            $accessToken = Auth::user()->access_token;
                
            $headers = [
                'AccessToken' => $accessToken,
            ];
           $body =  [
            'doc_img' => $doc_img,
            'selfie' => $selfie,
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','facematch')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                try{
                    $res = $client->post('http://regtechapi.in/api/face_match1',['headers' => $headers, 'json' => $body]);
                    
                    $face_match = json_decode($res->getBody(), true);
                    if(isset($face_match[0]['face_match']['code'])){
                        $statusCode = $face_match[0]['face_match']['code'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Document Image and Selfie Image is required in base64 format';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.face_match', compact('statusCode','errorMessage'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post('http://regtechapi.in/api/face_match1',['headers' => $headers, 'json' => $body]);
                        $face_match = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Document Image and Selfie Image is required in base64 format';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.face_match', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.face_match', compact('face_match', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        return view('kyc.face_match', compact('face_match', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function rc_count(Request $request){
        $count = 0;
        $startDate = '2022-12-06 17:38:52';
        $endDate = '2022-12-12 24:00:00';
        $startDate1 = '2022-05-30 00:00:00';
        $endDate1 = '2022-12-04 23:59:00';
        $rccount = DB::table('rcvalidation')->whereBetween(('created_at'),[$startDate, $endDate])->where('status_code',200)->groupBy('rc_number')->pluck('rc_number');
        $test = $rccount;
        return $test;
        // for($i=0;$i<$rccount->count();$i++){
            $rccheckcount = DB::table('rcvalidation')->whereBetween(('created_at'),[$startDate1, $endDate1])->whereIn('rc_number',$test)->count();
            // if($rccheckcount > 0){
            //     $count++;
    
            // }
            return $rccheckcount;
    
        // }
        // return $count;
       }
    
       public function udyam_details(Request $request) {
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.udyamdetails', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
       
        if($request->isMethod('POST')){
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
           $body =  [
            'udyamNumber' => $request->udyam_number
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','udyamsearch')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/udyamsearch',['headers' => $headers, 'json' => $body]);
                    
                    $udyamcard = json_decode($res->getBody(), true);
                    // return $udyamcard['response'];
                    // $pdfurl = $udyamcard['response']['result']['pdfUrl'];
                    // return Redirect::away($pdfurl);
                    // dd($pancard);
                    if(isset($udyamcard['statusCode'])){
                        $statusCode = $udyamcard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.udyamdetails', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{//dd($body);
                        $res = $client->post('http://regtechapi.in/api/udyamsearch',['headers' => $headers, 'json' => $body]);
                        
                        $udyamcard = json_decode($res->getBody(), true);
                        // return $udyamcard['response'];
                        // $pdfurl = $udyamcard['response']['result']['pdfUrl'];
                        // return Redirect::away($pdfurl);
                        // dd($pancard);
                        // if(isset($pancard[0]['pancard']['code'])){
                        //     $statusCode = $pancard[0]['pancard']['code'];
                        // }
                        if(isset($udyamcard['statusCode'])){
                            $statusCode = $udyamcard['statusCode'];
                        }
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.udyamdetails', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.udyamdetails', compact('udyamcard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.udyamdetails', compact('udyamcard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
       }

    public function udyogadhar_details(Request $request) {
        // return 'test1';
        $statusCode = null;
        $pancard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if($request->isMethod('GET')){
            return view('kyc.udyogadhardetails', compact('pancard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
        }
       
        if($request->isMethod('POST')){
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
           $body =  [
            'uamnumber' => $request->udyogadhar_number
            ];
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','udyamsearch')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                // if(Auth()->user()->wallet_amount >= $updateHitCount->scheme_price){
                try{//dd($body);
                    $res = $client->post('http://regtechapi.in/api/udyogaadhaars',['headers' => $headers, 'json' => $body]);
                    
                    $udyamcard = json_decode($res->getBody(), true);
                    
                    // return $udyamcard;
                    // dd($pancard);
                    if(isset($udyamcard['statusCode'])){
                        // return $udyamcard['statusCode'];
                        $statusCode = $udyamcard['statusCode'];
                    }
                } catch(BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if($statusCode == 500){
                        $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                    }else if($statusCode == 422){
                        $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    }else{
                        $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                    }
                    return view('kyc.udyogadhardetails', compact('statusCode','errorMessage'));
                }
            } else {
                
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                // dd($hit_count_remaining);
                if($hit_count_remaining>0)
                {
                    
                    try{//dd($body);
                        $res = $client->post('http://regtechapi.in/api/udyogaadhaars',['headers' => $headers, 'json' => $body]);
                        
                        $udyamcard = json_decode($res->getBody(), true);
                        $pdfurl = $udyamcard['response']['result']['pdfUrl'];
                        // return Redirect::away($pdfurl);
                        // dd($pancard);
                        // if(isset($pancard[0]['pancard']['code'])){
                        //     $statusCode = $pancard[0]['pancard']['code'];
                        // }
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if($statusCode == 500){
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        }else if($statusCode == 422){
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        }else{
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.udyogadhardetails', compact('statusCode','errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    
                    return view('kyc.udyogadhardetails', compact('udyamcard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        
        return view('kyc.udyogadhardetails', compact('udyamcard', 'statusCode','hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function pancard_new_info(Request $request)
    {
        // return 'ok1';
        $statusCode = null;
        $pancard = null;
        $pandetailsinfo = null;
        $pancardError = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if ($request->isMethod('GET')) {
            return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        if ($request->isMethod('POST')) {
            $client = new Client();
            $accessToken = Auth::user()->access_token;

            $headers = [
                'AccessToken' => $accessToken,
            ];
            $body = [
                'pan_no' => $request->pan_number,
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
                    $pancard = json_decode($response->getBody(), true);
                    $api_master = ApiMaster::where('api_slug', 'pandetails1')->first();
                    $pancard_details = UserSchemeMaster::where('user_id',Auth::user()->id)
                        ->where('api_id', $api_master->id)
                        ->pluck('permission');
                    // return $pancard_details;
                    // $pandetails_data = explode(',', $pancard_details[0]);
                    if(count($pancard_details) > 0){
                        $pandetails_data = explode(',', $pancard_details[0]);
                    }
                    //  dd($pandetails_data);
                    if (isset($pancard['status_code']) && $pancard['status_code'] == 200) {
                        if (isset($pandetails_data) && $pancard_details != null) {
                            $pancard['pancard']['data']['pandetails1'] = null;
                            $statusCode = $pancard['status_code'];
                            $errorMessage = 'Success';
                            foreach ($pandetails_data as $pan_data) {
                                $pandetailsinfo['data'][$pan_data] = $pancard['pancard']['data'][$pan_data];
                            }
                            return view('kyc.pandetails_info_new', compact('pandetailsinfo', 'statusCode', 'errorMessage'));
                        } else {
                            $statusCode = $pancard['status_code'];
                            $errorMessage = 'Success';
                            return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                        }
                    } elseif ($pancard['statusCode'] == 102 && $pancard['message'] == 'No Records found!.') {
                        $statusCode = $pancard['statusCode'];
                        $errorMessage = 'No Records Found !';
                        return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                    } elseif ($pancard['statusCode'] == 102 && $pancard['message'] == 'PAN Number InValid Please Enter Correct PanNumber.') {
                        $statusCode = $pancard['statusCode'];
                        $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                        return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.pandetails_info_new', compact('statusCode', 'errorMessage'));
                    }
                } catch (BadResponseException $e) {
                    $response = $e->getResponse();
                    $pancardError = json_decode($response->getBody(), true);
                    $statusCode = $e->getResponse()->getStatusCode();
                    if (isset($pancardError['statusCode']) && $pancardError['statusCode'] == 102) {
                        $statusCode = 102;
                        $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                        return view('kyc.pandetails_info_new', compact('pancardError', 'statusCode', 'errorMessage'));
                    } else {
                        $statusCode = 500;
                        $errorMessage = 'Internal Server Error.';
                        return view('kyc.pandetails_info_new', compact('pancardError', 'statusCode', 'errorMessage'));
                    }
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    
                    try {
                        $response = $client->post('http://regtechapi.in/api/pan_details_check', ['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($response->getBody(), true);
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $api_master = ApiMaster::where('api_slug', 'pandetails1')->first();
                        $pancard_details = UserSchemeMaster::where('user_id',Auth::user()->id)
                            ->where('api_id', $api_master->id)
                            ->pluck('permission');
                        if(count($pancard_details) > 0){
                            $pandetails_data = explode(',', $pancard_details[0]);
                        }
                        if (isset($pancard['status_code']) && $pancard['status_code'] == 200) {
                            if (isset($pandetails_data) && $pancard_details != null) {

                                $pancard['pancard']['data']['pandetails1'] = null;
                                $statusCode = $pancard['status_code'];
                                $errorMessage = 'Success';
                                
                                foreach ($pandetails_data as $pan_data) {
                                    $pandetailsinfo['data'][$pan_data] = $pancard['pancard']['data'][$pan_data];
                                }
                                return view('kyc.pandetails_info_new', compact('pandetailsinfo', 'statusCode', 'errorMessage'));
                            } else {
                                $statusCode = $pancard['status_code'];
                                $errorMessage = 'Success';
                                return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                            }
                        } elseif ($pancard['statusCode'] == 102 && $pancard['message'] == 'No Records found!.') {
                            $statusCode = $pancard['statusCode'];
                            $errorMessage = 'No Records Found !';
                            return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                        } elseif ($pancard['statusCode'] == 102 && $pancard['message'] == 'PAN Number InValid Please Enter Correct PanNumber.') {
                            $statusCode = $pancard['statusCode'];
                            $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                            return view('kyc.pandetails_info_new', compact('pancard', 'statusCode', 'errorMessage'));
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.pandetails_info_new', compact('statusCode', 'errorMessage'));
                        }
                    } catch (BadResponseException $e) {
                        $response = $e->getResponse();
                        $pancardError = json_decode($response->getBody(), true);
                        $statusCode = $e->getResponse()->getStatusCode();
                        if (isset($pancardError['statusCode']) && $pancardError['statusCode'] == 102) {
                            $statusCode = 102;
                            $errorMessage = 'PAN Number InValid Please Enter Correct PanNumber.';
                            return view('kyc.pandetails_info_new', compact('pancardError', 'statusCode', 'errorMessage'));
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Internal Server Error.';
                            return view('kyc.pandetails_info_new', compact('pancardError', 'statusCode', 'errorMessage'));
                        }
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.pandetails_info_new', compact('pancardError', 'pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
    }

    public function searchkyclite1(Request $request)
    {
        $statusCode = null;
        $pancard = null;
        $pandetailspermission = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $api_slug = 'searchkyclite';

        if ($request->isMethod('GET')) {
            $api_masterInfo = ApiMaster::where('api_slug', 'searchkyclite')->first();
            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                ->where('api_id', $api_masterInfo->id)
                ->pluck('request_permission')
                ->first();
            if (!empty($searchkyclite)) {
                $searchkyclite_request = explode(',', $searchkyclite);

                return view('kyc.searchkyclite1', compact('pancard', 'searchkyclite_request', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
            }
            return view('kyc.searchkyclite1', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        
        if ($request->isMethod('POST')) {
            $client = new Client();
            $accessToken = Auth::user()->access_token;
            $headers = [
                'AccessToken' =>$accessToken,
            ];
            $body = [
                'pano' => $request->pan_number,
                'dob' => '1990-08-12',
            ];
            if (Auth::user()->scheme_type != 'demo') {
                // return 'demo';
                if (Auth::user()->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug', 'pancard')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }

                $res = $client->post('http://regtechapi.in/api/search_v2', ['headers' => $headers, 'json' => $body]);
                $pancard = json_decode($res->getBody(), true);
                $api_masterInfo = ApiMaster::where('api_slug', 'searchkyclite')->first();
                $statusCode = $pancard['statusCode'];
                // dd($pancard);
                if (isset($pancard['response']['kycDetails']) && $pancard['response']['statusCode'] == 200) {
                    $pancard_info = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('permission');
                    if (isset($pancard_info) && count($pancard_info) > 0) {
                        $pandetails_data = explode(',', $pancard_info[0]);
                        $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['searchkyclite'] = null;
                        $status_code = $pancard['response']['statusCode'];
                        $errorMessage = 'Success';
                        foreach ($pandetails_data as $pan_data) {
                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails'][$pan_data] = $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails'][$pan_data];
                        }
                        $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                            ->where('api_id', $api_masterInfo->id)
                            ->pluck('request_permission')
                            ->first();
                        if (!empty($searchkyclite)) {
                            $searchkyclite_request = explode(',', $searchkyclite);
                        }
                        return view('kyc.searchkyclite1', compact('pandetailspermission', 'status_code', 'searchkyclite_request', 'errorMessage'));
                    } else {
                        $status_code = $pancard['response']['statusCode'];
                        $errorMessage = 'Success';
                        return view('kyc.searchkyclite1', compact('status_code', 'errorMessage', 'pancard'));
                    }
                }
                if ($statusCode == 500) {
                    $errorMessage = 'Internal Server Error.';
                    $statusCode = 500;
                    $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('request_permission')
                        ->first();
                    if (!empty($searchkyclite)) {
                        $searchkyclite_request = explode(',', $searchkyclite);
                        return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                    } else {
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } elseif ($statusCode == 102) {
                    $statusCode = 102;
                    $errorMessage = 'In Correct PAN Number. Please enter correct PAN Number';
                    $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('request_permission')
                        ->first();
                    if (!empty($searchkyclite)) {
                        $searchkyclite_request = explode(',', $searchkyclite);
                        return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                    } else {
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } elseif ($statusCode == 422) {
                    $statusCode = 422;
                    $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                    $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('request_permission')
                        ->first();
                    if (!empty($searchkyclite)) {
                        $searchkyclite_request = explode(',', $searchkyclite);
                        return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                    } else {
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } elseif ($statusCode == 401) {
                    //  dd('PAN Number is invalid! Please enter a valid PAN Number.');
                    $statusCode = 401;
                    $errorMessage = 'PAN Number is invalid! Please enter a valid PAN Number.';
                    $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('request_permission')
                        ->first();
                    if (!empty($searchkyclite)) {
                        $searchkyclite_request = explode(',', $searchkyclite);
                        return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                    } else {
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } elseif ($statusCode == 103) {
                    $statusCode = 103;
                    $errorMessage = 'You are not registered to use this service. Please update your plan.';
                    $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                        ->where('api_id', $api_masterInfo->id)
                        ->pluck('request_permission')
                        ->first();
                    if (!empty($searchkyclite)) {
                        $searchkyclite_request = explode(',', $searchkyclite);
                        return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                    } else {
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $statusCode = 500;
                    $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                }
                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage', 'pancard'));
            } else {
                // return 'type';
                $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                //    dd($scheme_type);
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    try {
                        // dd('$hit_count_remaining try21');
                        $res = $client->post('http://regtechapi.in/api/search_v2', ['headers' => $headers, 'json' => $body]);
                        $pancard = json_decode($res->getBody(), true);
                        // return $pancard;
                        //dd($pancard);
                        $user = User::where('id', Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count + 1;
                        $user->save();
                        $api_masterInfo = ApiMaster::where('api_slug', 'searchkyclite')->first();
                        $statusCode = $pancard['statusCode'];
                        if (isset($pancard['response']['kycDetails']) && $pancard['response']['statusCode'] == 200) {
                            $pancard_info = UserSchemeMaster::where('user_id',Auth::user()->id)
                            ->where('api_id', $api_masterInfo->id)
                            ->pluck('permission');
                          if (isset($pancard_info) && count($pancard_info) > 0) {
                            $pandetails_data = explode(',', $pancard_info[0]);
                            $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['searchkyclite'] = null;
                            $status_code = $pancard['response']['statusCode'];
                            $errorMessage = 'Success';
                            // return $pandetails_data;
                            foreach ($pandetails_data as $pan_data) {
                                $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails'][$pan_data] = $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails'][$pan_data];
                            }
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                            }
                            return view('kyc.searchkyclite1', compact('pandetailspermission','status_code','searchkyclite_request', 'errorMessage'));
                        } else {
                           
                            $status_code = $pancard['response']['statusCode'];
                            $errorMessage = 'Success';
                            return view('kyc.searchkyclite1', compact('status_code', 'errorMessage', 'pancard'));
                        }
                        }
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal Server Error.';
                            $statusCode = 500;
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                                return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                            } else {
                                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                            }
                        } elseif ($statusCode == 102) {
                            $statusCode = 102;
                            $errorMessage = 'In Correct PAN Number. Please enter correct PAN Number';
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                                return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                            } else {
                                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                            }
                        } elseif ($statusCode == 422) {
                            $statusCode = 422;
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                                return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                            } else {
                                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                            }
                        } elseif ($statusCode == 401) {
                            //  dd('PAN Number is invalid! Please enter a valid PAN Number.');
                            $statusCode = 401;
                            $errorMessage = 'PAN Number is invalid! Please enter a valid PAN Number.';
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                                return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                            } else {
                                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                            }
                        } elseif ($statusCode == 103) {
                            $statusCode = 103;
                            $errorMessage = 'You are not registered to use this service. Please update your plan.';
                            $searchkyclite = UserSchemeMaster::where('user_id', Auth::user()->id)
                                ->where('api_id', $api_masterInfo->id)
                                ->pluck('request_permission')
                                ->first();
                            if (!empty($searchkyclite)) {
                                $searchkyclite_request = explode(',', $searchkyclite);
                                return view('kyc.searchkyclite1', compact('searchkyclite_request', 'statusCode', 'errorMessage'));
                            } else {
                                return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                            }
                        } else {
                            $statusCode = 500;
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage', 'pancard'));
                    } catch (BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                        if ($statusCode == 500) {
                            $errorMessage = 'Internal server error. Please contact techsupport@docboyz.in. for more details';
                        } elseif ($statusCode == 422) {
                            $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                        } else {
                            $errorMessage = 'Error. Please contact techsupport@docboyz.in. for more details';
                        }
                        return view('kyc.searchkyclite1', compact('statusCode', 'errorMessage'));
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.searchkyclite1', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }

        return view('kyc.searchkyclite1', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function ckysearch_advance_api(){
        return view('kyc.ckycsearch_advance_api');
    }
    public function ckycSearchAdvance(Request $request)
    {
        $statusCode = null;
        $searchkyc = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;

        if ($request->isMethod('GET')) {
            return view('kyc.ckycsearch_advance', compact('searchkyc', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }

        if ($request->isMethod('POST')) {

            $accessToken = Auth::user()->access_token;

            $headers = [
                'AccessToken' => $accessToken,
            ];
            $pano = $request->pan_number;
            $dob = $request->dob;
            $client_ref_num = rand(10000,99999);
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
                         'pano'=>$pano,
                         'client_ref_num' =>$client_ref_num, 
                         'dob' =>$dob,
                         'identifier_type' => 'PAN'
                    ],
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                // $get_data1 = curl_exec($curl1);
                $result = curl_exec($curl1);
                $searchkyc = json_decode($result, true);
             
                if(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==200 && $searchkyc['response']['status']=="VALID"){
                    $statusCode =200;
                    return view('kyc.ckycsearch_advance', compact('statusCode','searchkyc'));
                }
                elseif(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==102){
                    $statusCode =102;
                    return view('kyc.ckycsearch_advance', compact('statusCode'));
                }
                elseif(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==103){
                    $statusCode =103;
                    return view('kyc.ckycsearch_advance', compact('statusCode'));
                }
                else{
                    $statusCode =500;
                    return view('kyc.ckycsearch_advance', compact('statusCode'));
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
                             'pano'=>$pano,
                             'client_ref_num' =>$client_ref_num, 
                             'dob' =>$dob,
                             'identifier_type' => 'PAN'
                        ],
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    // $get_data1 = curl_exec($curl1);
                    $result = curl_exec($curl1);
                    $searchkyc = json_decode($result, true);
                 
                    if(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==200 && $searchkyc['response']['status']=="VALID"){
                        $statusCode =200;
                        return view('kyc.ckycsearch_advance', compact('statusCode','searchkyc','hit_limits_exceeded', 'low_wallet_balance'));
                    }
                    elseif(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==102){
                        $statusCode =102;
                        return view('kyc.ckycsearch_advance', compact('statusCode'));
                    }
                    elseif(isset($searchkyc['statusCode']) && $searchkyc['statusCode']==103){
                        $statusCode =103;
                        return view('kyc.ckycsearch_advance', compact('statusCode'));
                    }
                    else{
                        $statusCode =500;
                        return view('kyc.ckycsearch_advance', compact('statusCode'));
                    }
                } else {
                    $hit_limits_exceeded = 1;

                    return view('kyc.ckycsearch_advance', compact('searchkyc', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }

        return view('kyc.ckycsearch_advance', compact('searchkyc', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
    }

    public function bhunakasha_api(){
        return view('kyc.bhunaksha_api');
      }
      public function bhunakasha(Request $request){
        $statusCode = null;
        $bhunakasha = null;
        $error_message = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
       if($request->isMethod('get')){
          return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
      if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(!empty($request->states) && $request->get('states')=="bihar"){
              if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
                            "District" => $request->br_district,
                            "Subdiv" => $request->br_subdiv,
                            "Circle" => $request->br_circle,
                            "Mauza" => $request->br_mauza,
                            "Surveytype" => $request->br_surveytype,
                            "Mapinstance" => $request->br_mapinstance,
                            "sheetno" => $request->br_sheet_number,
                            "Plotno" => $request->br_plot_number
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
              } 
             else {
                 $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                 $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                  if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
                            "District" => $request->br_district,
                            "Subdiv" => $request->br_subdiv,
                            "Circle" => $request->br_circle,
                            "Mauza" => $request->br_mauza,
                            "Surveytype" => $request->br_surveytype,
                            "Mapinstance" => $request->br_mapinstance,
                            "sheetno" => $request->br_sheet_number,
                            "Plotno" => $request->br_plot_number
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                   } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
              }
           }
           elseif(!empty($request->states) && $request->get('states')=="jharkhand"){
            if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                  curl_setopt_array($curl, [
                      CURLOPT_URL =>'http://regtechapi.in/api/bhunaksha',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>array(
                          'state'=>$request->states,
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
                  if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                      $statusCode =200;
                      return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                  }
                  elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                      $statusCode = 202;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                  elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                  else{
                      $statusCode = 500;
                      $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL =>'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                      $statusCode = 103;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="up"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
                        "District" => $request->up_district,
                        "Tehsil" => $request->up_tehsil,
                        "Village" => $request->up_village,
                        "Plotno" => $request->up_plot_number,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                    $statusCode = 202;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
                            "District" => $request->up_district,
                            "Tehsil" => $request->up_tehsil,
                            "Village" => $request->up_village,
                            "Plotno" => $request->up_plot_number,
                        ),
                       CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="chhattisgarh"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
               curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS =>array(
                       "state"=>$request->states,
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
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                   $statusCode = 202;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                       }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                 } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="rajasthan"){
            if (Auth::user()->scheme_type != 'demo') {
              $curl = curl_init();
              curl_setopt_array($curl, [
                  CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>array(
                      "state"=>$request->states,
                      "District" => $request->ra_district,
                      "Tehsil" => $request->ra_tehsil,
                      "Ri" => $request->ra_ri_circle,
                      "Halkas" => $request->ra_ri_halkas,
                      "Village" => $request->ra_village,
                      "Sheetno" => $request->ra_sheet_number,
                      "Plotno" => $request->ra_plot_number,
                  ),
                 CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
              ]);
              $result = curl_exec($curl);
              $bhunakasha = json_decode($result, true);
              if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                  $statusCode =200;
                  return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
              }
              elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                  $statusCode = 202;
                  $error_message = $bhunakasha['message'];
                  return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
              elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
            }
              else{
                  $statusCode = 500;
                  $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                  return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
                            "District" => $request->ra_district,
                            "Tehsil" => $request->ra_tehsil,
                            "Ri" => $request->ra_ri_circle,
                            "Halkas" => $request->ra_ri_halkas,
                            "Village" => $request->ra_village,
                            "Sheetno" => $request->ra_sheet_number,
                            "Plotno" => $request->ra_plot_number,
                        ),
                       CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                      $statusCode = 103;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                } 
               else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="lakshadweep"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
               curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS => array(
                       "state"=>$request->states,
                       "District" => $request->laksh_district,
                       "Taluk" => $request->laksh_taluk,
                       "Village" => $request->laksh_village,
                       "Survey" => $request->laksh_survey,
                       "Plotno" => $request->laksh_plot_number,
                   ),
                  CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
               ]);
               $result = curl_exec($curl);
               $bhunakasha = json_decode($result, true);
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                   $statusCode = 202;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                  $curl = curl_init();
                  curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS => array(
                       "state"=>$request->states,
                       "District" => $request->laksh_district,
                       "Taluk" => $request->laksh_taluk,
                       "Village" => $request->laksh_village,
                       "Survey" => $request->laksh_survey,
                       "Plotno" => $request->laksh_plot_number,
                   ),
                  CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
               ]);
               $result = curl_exec($curl);
               $bhunakasha = json_decode($result, true);
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                   $statusCode = 202;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="kerala"){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        "state"=>$request->states,
                        "District" => $request->ker_district,
                        "Taluk" => $request->ker_taluk,
                        "Village" => $request->ker_village,
                        "Blockno" => $request->ker_blockno,
                        "Surveyno" => $request->ker_survey_number,
                        "Subdivno" => $request->ker_subdivno,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                    $statusCode = 202;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                 curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        "state"=>$request->states,
                        "District" => $request->ker_district,
                        "Taluk" => $request->ker_taluk,
                        "Village" => $request->ker_village,
                        "Blockno" => $request->ker_blockno,
                        "Surveyno" => $request->ker_survey_number,
                        "Subdivno" => $request->ker_subdivno,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                    $statusCode = 202;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="goa"){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
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
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                    $statusCode = 202;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
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
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                    $statusCode = 202;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="odisha"){
            if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                 curl_setopt_array($curl, [
                     CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => '',
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 0,
                     CURLOPT_FOLLOWLOCATION => true,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => 'POST',
                     CURLOPT_POSTFIELDS =>array(
                         "state"=>$request->states,
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
                 if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                     $statusCode =200;
                     return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                 }
                 elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                     $statusCode = 202;
                     $error_message = $bhunakasha['message'];
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                 }
                 elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                 else{
                     $statusCode = 500;
                     $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                 }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==202){
                        $statusCode = 202;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                       $statusCode = 103;
                       $error_message = $bhunakasha['message'];
                       return view('kyc.bhunakasha', compact('statusCode','error_message'));
                   }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
               else {
                  $hit_limits_exceeded = 1;
                  return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
              }
           }
           else{
            return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
           }
         }
      }
      public function bhunakashaold(Request $request){
        $statusCode = null;
        $bhunakasha = null;
        $error_message = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
       if($request->isMethod('get')){
          return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
      if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(!empty($request->states) && $request->get('states')=="bihar"){
              if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
                            "District" => $request->br_district,
                            "Subdiv" => $request->br_subdiv,
                            "Circle" => $request->br_circle,
                            "Mauza" => $request->br_mauza,
                            "Surveytype" => $request->br_surveytype,
                            "Mapinstance" => $request->br_mapinstance,
                            "sheetno" => $request->br_sheet_number,
                            "Plotno" => $request->br_plot_number
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
              } 
             else {
                 $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                 $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                  if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
                            "District" => $request->br_district,
                            "Subdiv" => $request->br_subdiv,
                            "Circle" => $request->br_circle,
                            "Mauza" => $request->br_mauza,
                            "Surveytype" => $request->br_surveytype,
                            "Mapinstance" => $request->br_mapinstance,
                            "sheetno" => $request->br_sheet_number,
                            "Plotno" => $request->br_plot_number
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                   } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
              }
           }
           elseif(!empty($request->states) && $request->get('states')=="jharkhand"){
            if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                  curl_setopt_array($curl, [
                      CURLOPT_URL =>'http://regtechapi.in/api/bhunaksha',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>array(
                          'state'=>$request->states,
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
                  if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                      $statusCode =200;
                      return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                  }
                  elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                      $statusCode = 102;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                  elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                  else{
                      $statusCode = 500;
                      $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL =>'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            'state'=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                      $statusCode = 103;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="up"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
                        "District" => $request->up_district,
                        "Tehsil" => $request->up_tehsil,
                        "Village" => $request->up_village,
                        "Plotno" => $request->up_plot_number,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                    $statusCode = 102;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
                            "District" => $request->up_district,
                            "Tehsil" => $request->up_tehsil,
                            "Village" => $request->up_village,
                            "Plotno" => $request->up_plot_number,
                        ),
                       CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="chhattisgarh"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
               curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS =>array(
                       "state"=>$request->states,
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
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                   $statusCode = 102;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                        $statusCode = 103;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                       }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                 } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="rajasthan"){
            if (Auth::user()->scheme_type != 'demo') {
              $curl = curl_init();
              curl_setopt_array($curl, [
                  CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>array(
                      "state"=>$request->states,
                      "District" => $request->ra_district,
                      "Tehsil" => $request->ra_tehsil,
                      "Ri" => $request->ra_ri_circle,
                      "Halkas" => $request->ra_ri_halkas,
                      "Village" => $request->ra_village,
                      "Sheetno" => $request->ra_sheet_number,
                      "Plotno" => $request->ra_plot_number,
                  ),
                 CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
              ]);
              $result = curl_exec($curl);
              $bhunakasha = json_decode($result, true);
              if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                  $statusCode =200;
                  return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
              }
              elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                  $statusCode = 102;
                  $error_message = $bhunakasha['message'];
                  return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
              elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
            }
              else{
                  $statusCode = 500;
                  $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                  return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
                            "District" => $request->ra_district,
                            "Tehsil" => $request->ra_tehsil,
                            "Ri" => $request->ra_ri_circle,
                            "Halkas" => $request->ra_ri_halkas,
                            "Village" => $request->ra_village,
                            "Sheetno" => $request->ra_sheet_number,
                            "Plotno" => $request->ra_plot_number,
                        ),
                       CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $bhunakasha = json_decode($result, true);
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                      $statusCode = 103;
                      $error_message = $bhunakasha['message'];
                      return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                } 
               else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="lakshadweep"){
            if (Auth::user()->scheme_type != 'demo') {
               $curl = curl_init();
               curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS => array(
                       "state"=>$request->states,
                       "District" => $request->laksh_district,
                       "Taluk" => $request->laksh_taluk,
                       "Village" => $request->laksh_village,
                       "Survey" => $request->laksh_survey,
                       "Plotno" => $request->laksh_plot_number,
                   ),
                  CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
               ]);
               $result = curl_exec($curl);
               $bhunakasha = json_decode($result, true);
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                   $statusCode = 102;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                  $curl = curl_init();
                  curl_setopt_array($curl, [
                   CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS => array(
                       "state"=>$request->states,
                       "District" => $request->laksh_district,
                       "Taluk" => $request->laksh_taluk,
                       "Village" => $request->laksh_village,
                       "Survey" => $request->laksh_survey,
                       "Plotno" => $request->laksh_plot_number,
                   ),
                  CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken]
               ]);
               $result = curl_exec($curl);
               $bhunakasha = json_decode($result, true);
               if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                   $statusCode =200;
                   return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                   $statusCode = 102;
                   $error_message = $bhunakasha['message'];
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
               }
               elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                $statusCode = 103;
                $error_message = $bhunakasha['message'];
                return view('kyc.bhunakasha', compact('statusCode','error_message'));
              }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="kerala"){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        "state"=>$request->states,
                        "District" => $request->ker_district,
                        "Taluk" => $request->ker_taluk,
                        "Village" => $request->ker_village,
                        "Blockno" => $request->ker_blockno,
                        "Surveyno" => $request->ker_survey_number,
                        "Subdivno" => $request->ker_subdivno,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                    $statusCode = 102;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                 curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        "state"=>$request->states,
                        "District" => $request->ker_district,
                        "Taluk" => $request->ker_taluk,
                        "Village" => $request->ker_village,
                        "Blockno" => $request->ker_blockno,
                        "Surveyno" => $request->ker_survey_number,
                        "Subdivno" => $request->ker_subdivno,
                    ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $bhunakasha = json_decode($result, true);
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                    $statusCode = 102;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="goa"){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
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
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                    $statusCode = 102;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        "state"=>$request->states,
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
                if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                    $statusCode =200;
                    return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                    $statusCode = 102;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                  }
                } 
           else {
                 $hit_limits_exceeded = 1;
                 return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
            }
           }
           elseif(!empty($request->states) && $request->get('states')=="odisha"){
            if (Auth::user()->scheme_type != 'demo') {
                 $curl = curl_init();
                 curl_setopt_array($curl, [
                     CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => '',
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 0,
                     CURLOPT_FOLLOWLOCATION => true,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => 'POST',
                     CURLOPT_POSTFIELDS =>array(
                         "state"=>$request->states,
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
                 if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                     $statusCode =200;
                     return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                 }
                 elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                     $statusCode = 102;
                     $error_message = $bhunakasha['message'];
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                 }
                 elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                    $statusCode = 103;
                    $error_message = $bhunakasha['message'];
                    return view('kyc.bhunakasha', compact('statusCode','error_message'));
                }
                 else{
                     $statusCode = 500;
                     $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                     return view('kyc.bhunakasha', compact('statusCode','error_message'));
                 }
            } 
           else {
               $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
               $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/bhunaksha',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "state"=>$request->states,
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
                    if(isset($bhunakasha['data']) && $bhunakasha['status_code']==200){
                        $statusCode =200;
                        return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==102){
                        $statusCode = 102;
                        $error_message = $bhunakasha['message'];
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                    elseif(isset($bhunakasha['status_code']) && $bhunakasha['status_code']==103){
                       $statusCode = 103;
                       $error_message = $bhunakasha['message'];
                       return view('kyc.bhunakasha', compact('statusCode','error_message'));
                   }
                    else{
                        $statusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.bhunakasha', compact('statusCode','error_message'));
                    }
                
                } 
               else {
                  $hit_limits_exceeded = 1;
                  return view('kyc.bhunakasha', compact('bhunakasha','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
              }
           }
           else{
            return view('kyc.bhunakasha', compact('bhunakasha','statusCode'));
           }
         }
      }


      public function udyam_newapi(){
        return view('kyc.udyam_new_api');
    }

  public function udyam_newdetails(Request $request)
       {
        $statusCode = null;
        $udyamcard = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        if ($request->isMethod('GET')) {
            
             return view('kyc.udyamdetailsv2', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        if ($request->isMethod('POST')) {
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
                        CURLOPT_URL => 'http://regtechapi.in/api/udyamdetails',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "UdyamRegNumber"=>$request->udyam_number,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                 $udyamcard = json_decode($result, true);
              
               if(isset($udyamcard['response']) && $udyamcard['status_code']==200){
                    $statusCode =200;
                    return view('kyc.udyamdetailsv2', compact('udyamcard','statusCode'));
                }
                elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==202){
                    $statusCode = 202;
                    $error_message = $udyamcard['message'];
                    return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                }
                elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==103){
                   $statusCode = 103;
                   $error_message = $udyamcard['message'];
                   return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
               }
               elseif(isset($udyamcard[0]['statusCode']) && $udyamcard[0]['statusCode']==403){
                $statusCode = 403;
                $error_message = $udyamcard[0]['message'];
                 return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                }
            } else {
                $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if ($hit_count_remaining > 0) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/udyamdetails',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>array(
                            "UdyamRegNumber"=>$request->udyam_number,
                        ),
                        CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                    ]);
                    $result = curl_exec($curl);
                  $udyamcard = json_decode($result, true);
                if(isset($udyamcard['response']) && $udyamcard['status_code']==200){
                    $statusCode =200;
                    return view('kyc.udyamdetailsv2', compact('udyamcard','statusCode'));
                }
                elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==202){
                    $statusCode = 202;
                    $error_message = $udyamcard['message'];
                    return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                }
                elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==103){
                   $statusCode = 103;
                   $error_message = $udyamcard['message'];
                   return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                 }
                 elseif(isset($udyamcard[0]['statusCode']) && $udyamcard[0]['statusCode']==403){
                    $statusCode = 403;
                    $error_message = $udyamcard[0]['message'];
                    return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                  }
                else{
                    $statusCode = 500;
                    $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                    return view('kyc.udyamdetailsv2', compact('statusCode','error_message'));
                 }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.udyamdetailsv2', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
        }
        return view('kyc.udyamdetailsv2', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }


       public function udyam_newdetails_api_search(){
        return view('kyc.udyam_search_new_api');
  } 
public function udyam_newdetails_search(Request $request)
     {
      $statusCode = null;
      $udyamcard = null;
      $hit_limits_exceeded = 0;
      $low_wallet_balance = 0;
      if ($request->isMethod('GET')) {
           return view('kyc.udyamdetails_search_v2', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      if ($request->isMethod('POST')) {
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
                      CURLOPT_POSTFIELDS =>array(
                          "UdyamRegNumber"=>$request->udyam_number,
                      ),
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                  ]);
                  $result = curl_exec($curl);
               $udyamcard = json_decode($result, true);
              if(isset($udyamcard['response']) && $udyamcard['status_code']==200){
                  $statusCode =200;
                  return view('kyc.udyamdetails_search_v2', compact('udyamcard','statusCode'));
              }
              elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==202){
                  $statusCode = 202;
                  $error_message = $udyamcard['message'];
                  return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
              }
              elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==103){
                 $statusCode = 103;
                 $error_message = $udyamcard['message'];
                 return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
             }
             elseif(isset($udyamcard[0]['statusCode']) && $udyamcard[0]['statusCode']==403){
               $statusCode = 403;
               $error_message = $udyamcard[0]['message'];
               return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
              }
              else{
                  $statusCode = 500;
                  $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                  return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
              }
          } else {
              $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
              $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if ($hit_count_remaining > 0) {
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
                      CURLOPT_POSTFIELDS =>array(
                          "UdyamRegNumber"=>$request->udyam_number,
                      ),
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                  ]);
                  $result = curl_exec($curl);
                $udyamcard = json_decode($result, true);
              if(isset($udyamcard['response']) && $udyamcard['status_code']==200){
                  $statusCode =200;
                  return view('kyc.udyamdetails_search_v2', compact('udyamcard','statusCode'));
              }
              elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==202){
                  $statusCode = 202;
                  $error_message = $udyamcard['message'];
                  return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
              }
              elseif(isset($udyamcard['status_code']) &&  $udyamcard['status_code']==103){
                 $statusCode = 103;
                 $error_message = $udyamcard['message'];
                 return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
               }
               elseif(isset($udyamcard[0]['statusCode']) && $udyamcard[0]['statusCode']==403){
                  $statusCode = 403;
                  $error_message = $udyamcard[0]['message'];
                  return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
                }
              else{
                  $statusCode = 500;
                  $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                  return view('kyc.udyamdetails_search_v2', compact('statusCode','error_message'));
               }
              } else {
                  $hit_limits_exceeded = 1;
                  return view('kyc.udyamdetails_search_v2', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
          }
        }
            return view('kyc.udyamdetails_search_v2', compact('udyamcard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
     }

     public function aadhar_ocr_masking(Request $request){
        $statusCode = null;
        $aadhaar_masking = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
      if($request->isMethod('get')){
          return view('kyc.aadhaar_ocr_masking', compact('aadhaar_masking','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      if($request->isMethod('post')){
            if (Auth::user()->scheme_type != 'demo') {
              if (Auth::user()->role_id == 1) {
                  $apiamster = ApiMaster::where('api_slug','aadharmasking')->first();
                  if ($apiamster) {
                      $api_id = $apiamster->id;
                  }
                }
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/aadharcard_mask',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
    
                $result = curl_exec($curl);
                $aadhaar_masking = json_decode($result, true);
                if (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] ==200) {
                  return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','statusCode'));
                }
               elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 102) {
                  $errorMessage = "Invalid file type, must be an image.";
                  return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','errorMessage'));
               }
               elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 404) {
                
                  $errorMessage = "No image file provided";
                  return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','errorMessage'));
               }
               else {
                      $amstatusCode = 500;
                      $errorMessage = 'Internal Server Error.';
                     return view('kyc.aadhaar_ocr_masking',compact('amstatusCode','errorMessage'));
                }
              } 
             else {
                 $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                 $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                  if ($hit_count_remaining > 0) {
                $accessToken = Auth::user()->access_token;
                 $user = User::where('id', Auth::user()->id)->first();
                 $user->scheme_hit_count = $user->scheme_hit_count + 1;
                 $user->save();
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/aadharcard_mask',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
                $result = curl_exec($curl);
                $aadhaar_masking = json_decode($result, true);
                if (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] ==200) {
                  
                   return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','statusCode'));
                }
               elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 102) {
                  $errorMessage = "Invalid file type, must be an image.";
                  return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','errorMessage'));
               }
               elseif (isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 404) {
                
                  $errorMessage = "No image file provided";
                  return view('kyc.aadhaar_ocr_masking',compact('aadhaar_masking','errorMessage'));
               }
              else {
                      $amstatusCode = 500;
                      $errorMessage = 'Internal Server Error.';
                     return view('kyc.aadhaar_ocr_masking',compact('amstatusCode','errorMessage'));
               }
                  } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.aadhaar_ocr_masking', compact('statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
         }
        }
      }

      public function aadharcard_ocr(Request $request){
        $statusCode = null;
        $aadharcardocr = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
      if($request->isMethod('get')){
          return view('kyc.aadharcard_ocr_one', compact('aadharcardocr','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      if($request->isMethod('post')){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
             if (Auth::user()->role_id == 1) {
               $apiamster = ApiMaster::where('api_slug','aadhaar')->first();
                if ($apiamster) {
               $api_id = $apiamster->id;
               }
              }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/aadharcard_ocr',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                ]);
                $result = curl_exec($curl);
                $aadharcardocr = json_decode($result, true);
                if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==200) {
                 
                   return view('kyc.aadharcard_ocr_one',compact('aadharcardocr'));
                }
                elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==102) {
                  $errorMessage = "Invalid file type, must be an aadhar card image.";
                  return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','errorMessage'));
               }
               elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==404) {
                $errorMessage = "No file found.";
                return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','errorMessage'));
               }
               else{
                $astatusCode =500;
                $errorMessage = 'Internal Server Error.';
                return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','astatusCode','errorMessage'));
                }
              } 
             else {
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
                        CURLOPT_URL => 'http://regtechapi.in/api/aadharcard_ocr',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $aadharcardocr = json_decode($result, true);
                    if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==200) {
                     
                       return view('kyc.aadharcard_ocr_one',compact('aadharcardocr'));
                    }
                    elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==102) {
                      $errorMessage = "Invalid file type, must be an aadhar card image.";
                      return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','errorMessage'));
                   }
                   elseif (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] ==404) {
                    $errorMessage = "No file found.";
                    return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','errorMessage'));
                   }
                   else{
                    $astatusCode =500;
                    $errorMessage = 'Internal Server Error.';
                    return view('kyc.aadharcard_ocr_one',compact('aadharcardocr','astatusCode','errorMessage'));
                    }
                  } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.aadharcard_ocr_one', compact('aadharcardocr','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
         }
        }
      }

      public function drivinglicense_ocr(Request $request){
        $statusCode = null;
        $lincensedocr = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
      if($request->isMethod('get')){
       
          return view('kyc.lincense_ocr_one', compact('lincensedocr','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      if($request->isMethod('post')){
            if (Auth::user()->scheme_type != 'demo') {
                if (Auth::user()->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug','license')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/drivingLicense_ocr',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                ]);
                $result = curl_exec($curl);
                $lincensedocr = json_decode($result, true);
                if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==200) {
                 
                   return view('kyc.lincense_ocr_one',compact('lincensedocr'));
                }
                elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==102) {
                  $errorMessage = "Invalid file type, must be an driving license image.";
                  return view('kyc.lincense_ocr_one',compact('lincensedocr','errorMessage'));
               }
               elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==404) {
                $errorMessage = "No file found.";
                return view('kyc.lincense_ocr_one',compact('lincensedocr','errorMessage'));
               }
               else{
                $listatusCode =500;
                $errorMessage = 'Internal Server Error.';
                return view('kyc.lincense_ocr_one',compact('lincensedocr','listatusCode','errorMessage'));
                }
              } 
             else {
                 $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                 $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                  if ($hit_count_remaining > 0) {
                    $accessToken = Auth::user()->access_token;
                    $user = User::where('id', Auth::user()->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/drivingLicense_ocr',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $lincensedocr = json_decode($result, true);
                    if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==200) {
                     
                       return view('kyc.lincense_ocr_one',compact('lincensedocr'));
                    }
                    elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==102) {
                      $errorMessage = "Invalid file type, must be an driving license image.";
                      return view('kyc.lincense_ocr_one',compact('lincensedocr','errorMessage'));
                   }
                   elseif (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] ==404) {
                    $errorMessage = "No file found.";
                    return view('kyc.lincense_ocr_one',compact('lincensedocr','errorMessage'));
                   }
                   else{
                    $listatusCode =500;
                    $errorMessage = 'Internal Server Error.';
                    return view('kyc.lincense_ocr_one',compact('lincensedocr','listatusCode','errorMessage'));
                    }
                  } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.lincense_ocr_one', compact('lincensedocr','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
         }
        }
      }

      public function pancard_ocr(Request $request){
     
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $pancard = null;

        if ($request->isMethod('get')) {
            return view('kyc.pancard_ocr', compact('pancard','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        if ($request->isMethod('post')) {
            if (Auth::user()->scheme_type != 'demo') {
                if (Auth::user()->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug','pancard')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                }
                $accessToken = Auth::user()->access_token;
                $curl = curl_init();
                curl_setopt_array($curl, [
                CURLOPT_URL => 'http://regtechapi.in/api/pancard_ocr',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
             ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $pancard = json_decode($response, true);
                if (isset($pancard['status_code']) && $pancard['status_code'] ==200) {
                    return view('kyc.pancard_ocr',compact('pancard'));
                }
                elseif (isset($pancard['status_code']) && $pancard['status_code'] ==102) {
                   $errorMessage = "Invalid file type, must be an  pancard image.";
                   return view('kyc.pancard_ocr',compact('pancard','errorMessage'));
                }
                elseif (isset($pancard['status_code']) && $pancard['status_code'] ==404) {
                 $errorMessage = "No file found.";
                 return view('kyc.pancard_ocr',compact('pancard','errorMessage'));
                }
                else{
                 $vostatusCode =500;
                 $errorMessage = 'Internal Server Error.';
                 return view('kyc.pancard_ocr',compact('pancard','vostatusCode','errorMessage'));
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
                CURLOPT_URL => 'http://regtechapi.in/api/pancard_ocr',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
             ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $pancard = json_decode($response, true);
                if (isset($pancard['status_code']) && $pancard['status_code'] ==200) {
                    return view('kyc.pancard_ocr',compact('pancard'));
                }
                elseif (isset($pancard['status_code']) && $pancard['status_code'] ==102) {
                   $errorMessage = "Invalid file type, must be an  pancard image.";
                   return view('kyc.pancard_ocr',compact('pancard','errorMessage'));
                }
                elseif (isset($pancard['status_code']) && $pancard['status_code'] ==404) {
                 $errorMessage = "No file found.";
                 return view('kyc.pancard_ocr',compact('pancard','errorMessage'));
                }
                else{
                 $vostatusCode =500;
                 $errorMessage = 'Internal Server Error.';
                 return view('kyc.pancard_ocr',compact('pancard','vostatusCode','errorMessage'));
               }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.pancard_ocr', compact('pancard', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
      }
    }

    public function passport_ocr(Request $request){
        $statusCode = null;
        $passport = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
      if($request->isMethod('get')){
          return view('kyc.passport_ocr_one', compact('passport','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      if($request->isMethod('post')){
            if (Auth::user()->scheme_type != 'demo') {
                $accessToken = Auth::user()->access_token;
                if (Auth::user()->role_id == 1) {
                 $apiamster = ApiMaster::where('api_slug','passportupload')->first();
                   if ($apiamster) {
                   $api_id = $apiamster->id;
                   }
                   }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/passport_ocr',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                ]);
                $result = curl_exec($curl);
                $passport = json_decode($result, true);
                if (isset($passport['status_code']) && $passport['status_code'] ==200) {
                 
                   return view('kyc.passport_ocr_one',compact('passport'));
                }
                elseif (isset($passport['status_code']) && $passport['status_code'] ==102) {
                  $errorMessage = "Failed to extract MRZ information.";
                  return view('kyc.passport_ocr_one',compact('passport','errorMessage'));
               }
               elseif (isset($passport['status_code']) && $passport['status_code'] ==404) {
                $errorMessage = "No file found.";
                return view('kyc.passport_ocr_one',compact('passport','errorMessage'));
               }
               else{
                $pstatusCode =500;
                $errorMessage = 'Internal Server Error.';
                return view('kyc.passport_ocr_one',compact('passport','pstatusCode','errorMessage'));
                }
              } 
             else {
                 $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
                 $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                  if ($hit_count_remaining > 0) {
                    $accessToken = Auth::user()->access_token;
                    $user = User::where('id', Auth::user()->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => 'http://regtechapi.in/api/passport_ocr',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                        CURLOPT_HTTPHEADER => ['AccessToken:'.$accessToken],
                    ]);
                    $result = curl_exec($curl);
                    $passport = json_decode($result, true);
                    if (isset($passport['status_code']) && $passport['status_code'] ==200) {
                     
                       return view('kyc.passport_ocr_one',compact('passport'));
                    }
                    elseif (isset($passport['status_code']) && $passport['status_code'] ==102) {
                      $errorMessage = "Failed to extract MRZ information.";
                      return view('kyc.passport_ocr_one',compact('passport','errorMessage'));
                   }
                   elseif (isset($passport['status_code']) && $passport['status_code'] ==404) {
                    $errorMessage = "No file found.";
                    return view('kyc.passport_ocr_one',compact('passport','errorMessage'));
                   }
                   else{
                    $pstatusCode =500;
                    $errorMessage = 'Internal Server Error.';
                    return view('kyc.passport_ocr_one',compact('passport','pstatusCode','errorMessage'));
                    }
                    
                  } 
             else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.passport_ocr_one', compact('passport','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
         }
        }
 }

      public function voterId_ocr(Request $request){
         
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $voterid =null;

        if ($request->isMethod('get')) {
            return view('kyc.voterId_ocr', compact('voterid','statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
        if ($request->isMethod('post')) {
           
            if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                    $apiamster = ApiMaster::where('api_slug','voter_id')->first();
                    if ($apiamster) {
                        $api_id = $apiamster->id;
                    }
                  } 
                   $accessToken = Auth::user()->access_token;
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/voter_ocr',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                 ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $voterid = json_decode($response, true);
                    if (isset($voterid['status_code']) && $voterid['status_code'] ==200) {
                 
                        return view('kyc.voterId_ocr',compact('voterid'));
                     }
                     elseif (isset($voterid['status_code']) && $voterid['status_code'] ==102) {
                       $errorMessage = "Invalid file type, must be an  voter id image.";
                       return view('kyc.voterId_ocr',compact('voterid','errorMessage'));
                    }
                    elseif (isset($voterid['status_code']) && $voterid['status_code'] ==404) {
                     $errorMessage = "No file found.";
                     return view('kyc.voterId_ocr',compact('voterid','errorMessage'));
                    }
                    else{
                     $vostatusCode =500;
                     $errorMessage = 'Internal Server Error.';
                     return view('kyc.voterId_ocr',compact('voterid','vostatusCode','errorMessage'));
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
                    CURLOPT_URL => 'http://regtechapi.in/api/voter_ocr',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['file' => new \CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])],
                    CURLOPT_HTTPHEADER => ["AccessToken:$accessToken"],
                 ]);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $voterid = json_decode($response, true);
                    if (isset($voterid['status_code']) && $voterid['status_code'] ==200) {
                 
                        return view('kyc.voterId_ocr',compact('voterid'));
                     }
                     elseif (isset($voterid['status_code']) && $voterid['status_code'] ==102) {
                       $errorMessage = "Invalid file type, must be an  voter id image.";
                       return view('kyc.voterId_ocr',compact('voterid','errorMessage'));
                    }
                    elseif (isset($voterid['status_code']) && $voterid['status_code'] ==404) {
                     $errorMessage = "No file found.";
                     return view('kyc.voterId_ocr',compact('voterid','errorMessage'));
                    }
                    else{
                     $vostatusCode =500;
                     $errorMessage = 'Internal Server Error.';
                     return view('kyc.voterId_ocr',compact('voterid','vostatusCode','errorMessage'));
                   }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('kyc.voterId_ocr', compact('voterid', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
                }
            }
       }
    }

    public function createGeofence(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $create_geofence = null;
        if ($request->isMethod('GET')) {
             return view('kyc.create_geofence', compact('create_geofence', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) {
           $accessToken = Auth::user()->access_token;
           if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                   $apiamster = ApiMaster::where('api_slug','creategeofence')->first();
                   if ($apiamster) {
                       $api_id = $apiamster->id;
                   }
               }
               $curl = curl_init();
                   curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/create_geofence',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        'latitude' =>$request->latitude,
                        'longitude' =>$request->longitude,
                        'radius' =>$request->radius
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $create_geofence = json_decode($result, true);
              if(isset($create_geofence['status_code']) && $create_geofence['status_code']==200){
                   return view('kyc.create_geofence', compact('create_geofence'));
              }
              elseif(isset($create_geofence['status_code']) && $create_geofence['status_code']==102){
                $error_message = $create_geofence['message'];
                return view('kyc.create_geofence', compact('create_geofence','error_message'));
             }
             elseif(isset($create_geofence['statusCode']) &&  $create_geofence['statusCode']==103){
                  $error_message = $create_geofence['message'];
                  return view('kyc.create_geofence', compact('create_geofence','error_message'));
              }
              elseif(isset($create_geofence[0]['statusCode']) && $create_geofence[0]['statusCode']==403){
                 $error_message = $create_geofence[0]['message'];
                return view('kyc.create_geofence', compact('create_geofence','error_message'));
              }
               else{
                   $geostatusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.create_geofence', compact('geostatusCode','error_message'));
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
                    CURLOPT_URL => 'http://regtechapi.in/api/create_geofence',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        'latitude' =>$request->latitude,
                        'longitude' =>$request->longitude,
                        'radius' =>$request->radius
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $create_geofence = json_decode($result, true);
               if(isset($create_geofence['status_code']) && $create_geofence['status_code']==200){
                   return view('kyc.create_geofence', compact('create_geofence'));
                }
              elseif(isset($create_geofence['status_code']) && $create_geofence['status_code']==102){
                $error_message = $create_geofence['message'];
                return view('kyc.create_geofence', compact('create_geofence','error_message'));
               }
               elseif(isset($create_geofence['statusCode']) &&  $create_geofence['statusCode']==103){
                  $error_message = $create_geofence['message'];
                  return view('kyc.create_geofence', compact('create_geofence','error_message'));
               }
               elseif(isset($create_geofence[0]['statusCode']) && $create_geofence[0]['statusCode']==403){
                  $error_message = $create_geofence[0]['message'];
                   return view('kyc.create_geofence', compact('create_geofence','error_message'));
               }
               else{
                   $geostatusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.create_geofence', compact('geostatusCode','error_message'));
               }
                   
               } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.create_geofence', compact('create_geofence', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
          }
       return view('kyc.create_geofence', compact('create_geofence', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
     }

     public function getPlace(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $get_place = null;
        if ($request->isMethod('GET')) {
             return view('kyc.getplace', compact('get_place', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) {
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
                    CURLOPT_URL => 'http://regtechapi.in/api/get_place',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        'longitude' =>$request->longitude,
                        'latitude' =>$request->latitude
                    ),
                     CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
                 $result = curl_exec($curl);
                 $get_place = json_decode($result, true);
              if(isset($get_place['status_code']) && $get_place['status_code']==200){
                   return view('kyc.getplace', compact('get_place'));
              }
             elseif(isset($get_place['status_code']) &&  $get_place['status_code']==102){
                 $error_message = $get_place['message'];
                 return view('kyc.getplace', compact('get_place','error_message'));
             }
             elseif(isset($get_place['statusCode']) &&  $get_place['statusCode']==103){
                  $error_message = $get_place['message'];
                  return view('kyc.getplace', compact('get_place','error_message'));
              }
              elseif(isset($get_place[0]['statusCode']) && $get_place[0]['statusCode']==403){
                 $error_message = $get_place[0]['message'];
                return view('kyc.getplace', compact('get_place','error_message'));
              }
               else{
                   $getplace_statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.getplace', compact('getplace_statusCode','error_message'));
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
                    CURLOPT_POSTFIELDS =>array(
                        'longitude' =>$request->longitude,
                        'latitude' =>$request->latitude
                    ),
                     CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
                 $result = curl_exec($curl);
                 $get_place = json_decode($result, true);
                 if(isset($get_place['status_code']) && $get_place['status_code']==200){
                   return view('kyc.getplace', compact('get_place'));
                 }
                elseif(isset($get_place['status_code']) &&  $get_place['status_code']==102){
                 $error_message = $get_place['message'];
                 return view('kyc.getplace', compact('get_place','error_message'));
                }
               elseif(isset($get_place['statusCode']) &&  $get_place['statusCode']==103){
                  $error_message = $get_place['message'];
                  return view('kyc.getplace', compact('get_place','error_message'));
                }
                elseif(isset($get_place[0]['statusCode']) && $get_place[0]['statusCode']==403){
                    $error_message = $get_place[0]['message'];
                   return view('kyc.getplace', compact('get_place','error_message'));
                }
               else{
                   $getplace_statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.getplace', compact('getplace_statusCode','error_message'));
               }
                   
               } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.getplace', compact('get_place', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
       return view('kyc.getplace', compact('get_place', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
     }

     public function getCoordinate(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $get_coordinate = null;
        if ($request->isMethod('GET')) {
             return view('kyc.get_coordinate', compact('get_coordinate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) {
           $accessToken = Auth::user()->access_token;
           $addressText = $request->input('address');
           if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                   $apiamster = ApiMaster::where('api_slug','getcoordinate')->first();
                   if ($apiamster) {
                       $api_id = $apiamster->id;
                   }
               }
                  $curl = curl_init();
                   curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/get_coordinate',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'address' =>$request->input('address'),
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $get_coordinate = json_decode($result, true);
              if(isset($get_coordinate['status_code']) && $get_coordinate['status_code']==200){
                   return view('kyc.get_coordinate', compact('get_coordinate'));
              }
              elseif(isset($get_coordinate['status_code']) && $get_coordinate['status_code']==102){
                $error_message = $get_coordinate['message'];
                return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
             }
             elseif(isset($get_coordinate['statusCode']) &&  $get_coordinate['statusCode']==103){
                  $error_message = $get_coordinate['message'];
                  return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
             }
              elseif(isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode']==403){
                 $error_message = $get_coordinate[0]['message'];
               return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
              }
               else{
                   $getcostatusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.get_coordinate', compact('getcostatusCode','error_message'));
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
                      CURLOPT_URL => 'http://regtechapi.in/api/get_coordinate',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => array(
                          'address' =>$request->input('address'),
                      ),
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                     ]);
                   $result = curl_exec($curl);
                   $get_coordinate = json_decode($result, true);
                  if(isset($get_coordinate['status_code']) && $get_coordinate['status_code']==200){
                        return view('kyc.get_coordinate', compact('get_coordinate'));
                   }
                   elseif(isset($get_coordinate['status_code']) && $get_coordinate['status_code']==102){
                     $error_message = $get_coordinate['message'];
                     return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
                  }
                  elseif(isset($get_coordinate['statusCode']) &&  $get_coordinate['statusCode']==103){
                       $error_message = $get_coordinate['message'];
                       return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
                  }
                   elseif(isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode']==403){
                      $error_message = $get_coordinate[0]['message'];
                     return view('kyc.get_coordinate', compact('get_coordinate','error_message'));
                   }
                  else{
                        $getcostatusCode = 500;
                        $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                        return view('kyc.get_coordinate', compact('getcostatusCode','error_message'));
                  }
                   
               } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.get_coordinate', compact('get_coordinate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
          return view('kyc.get_coordinate', compact('get_coordinate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
     }

     public function verifyAddress(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $verify_address = null;
        if ($request->isMethod('GET')) {
            
            return view('kyc.verify_address', compact('verify_address', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) {
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
                    CURLOPT_URL => 'http://regtechapi.in/api/verify_address',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => ['address'=>$request->address],
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
                 $result = curl_exec($curl);
                $verify_address = json_decode($result, true);
              if(isset($verify_address['status_code']) && $verify_address['status_code']==200){
                   return view('kyc.verify_address', compact('verify_address'));
              }
              elseif(isset($verify_address['status_code']) &&  $verify_address['status_code']==102){
                $error_message = $verify_address['message'];
                return view('kyc.verify_address', compact('verify_address','error_message'));
             }
              elseif(isset($verify_address['status_code']) &&  $verify_address['status_code']==202){
                $error_message = $verify_address['message'];
                return view('kyc.verify_address', compact('verify_address','error_message'));
             }
             elseif(isset($verify_address['statusCode']) &&  $verify_address['statusCode']==103){
                  $error_message = $verify_address['message'];
                  return view('kyc.verify_address', compact('verify_address','error_message'));
              }
              elseif(isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode']==403){
                 $error_message = $verify_address[0]['message'];
                return view('kyc.verify_address', compact('verify_address','error_message'));
              }
               else{
                   $statusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.verify_address', compact('statusCode','error_message'));
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
                      CURLOPT_URL => 'http://regtechapi.in/api/verify_address',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => ['address'=>$request->address],
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                     ]);
                   $result = curl_exec($curl);
                  $verify_address = json_decode($result, true);
                if(isset($verify_address['status_code']) && $verify_address['status_code']==200){
                     return view('kyc.verify_address', compact('verify_address'));
                }
                elseif(isset($verify_address['status_code']) &&  $verify_address['status_code']==102){
                  $error_message = $verify_address['message'];
                  return view('kyc.verify_address', compact('verify_address','error_message'));
                }
                elseif(isset($verify_address['status_code']) &&  $verify_address['status_code']==202){
                  $error_message = $verify_address['message'];
                  return view('kyc.verify_address', compact('verify_address','error_message'));
                }
               elseif(isset($verify_address['statusCode']) &&  $verify_address['statusCode']==103){
                    $error_message = $verify_address['message'];
                    return view('kyc.verify_address', compact('verify_address','error_message'));
                 }
                elseif(isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode']==403){
                   $error_message = $verify_address[0]['message'];
                  return view('kyc.verify_address', compact('verify_address','error_message'));
                 }
                else{
                     $statusCode = 500;
                     $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                     return view('kyc.verify_address', compact('statusCode','error_message'));
                }
               } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.verify_address', compact('verify_address', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
       return view('kyc.verify_address', compact('verify_address', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
     }

    
      public function autoFatchAddress(Request $request){
        $accessToken = Auth::user()->access_token;
        $addressText = $request->input('text');
        $maxResult = intval($request->input('max_result'));
        if (Auth::user()->scheme_type != 'demo') {
            if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','autocomplate')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $curl = curl_init();
                curl_setopt_array($curl, [
                 CURLOPT_URL => 'http://regtechapi.in/api/autocomplete',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS =>array(
                     'text' =>$addressText,
                     'maxResult' =>$maxResult,
                 ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
           $result = curl_exec($curl);
           $auto_complate = json_decode($result, true);
         
           if(isset($auto_complate['status_code']) && $auto_complate['status_code']==200){
             
                return response()->json(['data'=> $auto_complate]);
           }
           elseif(isset($auto_complate['status_code']) && $auto_complate['status_code']==102){
             $error_message = $auto_complate['message'];
             return response()->json(['data'=> $auto_complate]);
            
          }
          elseif(isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103){
               $error_message = $auto_complate['message'];
               return response()->json(['data'=> $auto_complate]);
           }
           elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404){
             $error_message = $auto_complate[0]['message'];
             return response()->json(['data'=> $auto_complate]);
          }
           elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403){
              $error_message = $auto_complate[0]['message'];
              return response()->json(['data'=> $auto_complate]);
           }
            else{
                $autostatusCode = 500;
                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                return response()->json(['data'=>$autostatusCode,'message'=> $error_message]);
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
                 CURLOPT_URL => 'http://regtechapi.in/api/autocomplete',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS =>array(
                     'text' =>$addressText,
                     'maxResult' =>$maxResult,
                 ),
                   CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                ]);
              $result = curl_exec($curl);
              $auto_complate = json_decode($result, true);
           if(isset($auto_complate['status_code']) && $auto_complate['status_code']==200){
          
                return response()->json(['data'=> $auto_complate]);
           }
           elseif(isset($auto_complate['status_code']) && $auto_complate['status_code']==102){
             $error_message = $auto_complate['message'];
             return response()->json(['data'=> $auto_complate]);
           
          }
          elseif(isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103){
               $error_message = $auto_complate['message'];
               return response()->json(['data'=> $auto_complate]);
           }
           elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404){
             $error_message = $auto_complate[0]['message'];
             return response()->json(['data'=> $auto_complate]);
          }
           elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403){
              $error_message = $auto_complate[0]['message'];
              return response()->json(['data'=> $auto_complate]);
           }
            else{
                $autostatusCode = 500;
                $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                return response()->json(['data'=>$autostatusCode,'message'=> $error_message]);
            }
          } else {
                $hit_limits_exceeded = 1;
                $low_wallet_balance=0;
                return  response()->json(['hit_limits_exceeded'=>$hit_limits_exceeded,'low_wallet_balance'=>$low_wallet_balance]);
            }
        }
      }

      public function autoComplate(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $auto_complate = null;
        if ($request->isMethod('GET')) {
             return view('kyc.autocomplate', compact('auto_complate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) 
       {
           $accessToken = Auth::user()->access_token;
           $addressText = $request->input('text');
           $maxResult = intval($request->input('max_result'));
           if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                   $apiamster = ApiMaster::where('api_slug','autocomplate')->first();
                   if ($apiamster) {
                       $api_id = $apiamster->id;
                   }
               }
               $curl = curl_init();
                   curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/autocomplete',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>array(
                        'text' =>$addressText,
                        'maxResult' =>$maxResult,
                    ),
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $auto_complate = json_decode($result, true);
            
              if(isset($auto_complate['status_code']) && $auto_complate['status_code']==200){
                   return view('kyc.autocomplate', compact('auto_complate'));
              }
              elseif(isset($auto_complate['status_code']) && $auto_complate['status_code']==102){
                $error_message = $auto_complate['message'];
                return view('kyc.autocomplate', compact('auto_complate','error_message'));
             }
             elseif(isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103){
                  $error_message = $auto_complate['message'];
                  return view('kyc.autocomplate', compact('auto_complate','error_message'));
              }
              elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404){
                $error_message = $auto_complate[0]['message'];
                return view('kyc.autocomplate', compact('auto_complate','error_message'));
             }
              elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403){
                 $error_message = $auto_complate[0]['message'];
                return view('kyc.autocomplate', compact('auto_complate','error_message'));
              }
               else{
                   $autostatusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.autocomplate', compact('autostatusCode','error_message'));
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
                    CURLOPT_URL => 'http://regtechapi.in/api/autocomplete',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'text' =>$addressText,
                        'maxResult' =>$maxResult,
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $auto_complate = json_decode($result, true);
               if(isset($auto_complate['status_code']) && $auto_complate['status_code']==200){
                    return view('kyc.autocomplate', compact('auto_complate'));
                }
              elseif(isset($auto_complate['status_code']) && $auto_complate['status_code']==102){
                 $error_message = $auto_complate['message'];
                   return view('kyc.autocomplate', compact('auto_complate','error_message'));
               }
              elseif(isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103){
                  $error_message = $auto_complate['message'];
                  return view('kyc.autocomplate', compact('auto_complate','error_message'));
               }
              elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404){
                 $error_message = $auto_complate[0]['message'];
                 return view('kyc.autocomplate', compact('auto_complate','error_message'));
              }
             elseif(isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403){
                 $error_message = $auto_complate[0]['message'];
                return view('kyc.autocomplate', compact('auto_complate','error_message'));
              }
               else{
                   $autostatusCode = 500;
                   $error_message = "Internal Server Error. Please contact techsupport@docboyz.in.";
                   return view('kyc.autocomplate', compact('autostatusCode','error_message'));
               }
                   
               } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.autocomplate', compact('auto_complate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
       return view('kyc.autocomplate', compact('auto_complate', 'statusCode', 'hit_limits_exceeded', 'low_wallet_balance'));
      }
      public function pantogst(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $pantogstDetails = null;
        if ($request->isMethod('GET')) {
             return view('kyc.pantogst', compact('pantogstDetails', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if ($request->isMethod('POST')) {
           $accessToken = Auth::user()->access_token;
           if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                   $apiamster = ApiMaster::where('api_slug','pantogst')->first();
                   if ($apiamster) {
                       $api_id = $apiamster->id;
                   }
               }
                  $curl = curl_init();
                   curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/pantogst',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'pancard_number' =>$request->pancardNumber,
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $pantogstDetails = json_decode($result, true);
              if(isset($pantogstDetails['status_code']) && $pantogstDetails['status_code']==200){
                   return view('kyc.pantogst', compact('pantogstDetails'));
              }
              elseif(isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode']==102){
                $error_message = $pantogstDetails['message'];
                return view('kyc.pantogst', compact('pantogstDetails','error_message'));
             }
             elseif(isset($pantogstDetails['statusCode']) &&  $pantogstDetails['statusCode']==103){
                  $error_message = $pantogstDetails['message'];
                  return view('kyc.pantogst', compact('pantogstDetails','error_message'));
             }
              elseif(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==403){
                 $error_message = $pantogstDetails[0]['message'];
               return view('kyc.pantogst', compact('pantogstDetails','error_message'));
              }
              elseif(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==404){
                $error_message = $pantogstDetails[0]['message'];
                return view('kyc.pantogst', compact('pantogstDetails','error_message'));
             }
               else{
                   $pangststatusCode = 500;
                   $error_message = "Internal Server Error.";
                   return view('kyc.pantogst', compact('pangststatusCode','error_message'));
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
                    CURLOPT_URL => 'http://regtechapi.in/api/pantogst',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'pancard_number' =>$request->pancardNumber,
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
                $result = curl_exec($curl);
                $pantogstDetails = json_decode($result, true);
              if(isset($pantogstDetails['status_code']) && $pantogstDetails['status_code']==200){
                   return view('kyc.pantogst', compact('pantogstDetails'));
              }
              elseif(isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode']==102){
                $error_message = $pantogstDetails['message'];
                return view('kyc.pantogst', compact('pantogstDetails','error_message'));
              }
              elseif(isset($pantogstDetails['statusCode']) &&  $pantogstDetails['statusCode']==103){
                  $error_message = $pantogstDetails['message'];
                  return view('kyc.pantogst', compact('pantogstDetails','error_message'));
              }
              elseif(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==403){
                 $error_message = $pantogstDetails[0]['message'];
               return view('kyc.pantogst', compact('pantogstDetails','error_message'));
               }
              elseif(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==404){
                $error_message = $pantogstDetails[0]['message'];
                return view('kyc.pantogst', compact('pantogstDetails','error_message'));
             }
            else{
                   $pangststatusCode = 500;
                   $error_message = "Internal Server Error.";
                   return view('kyc.pantogst', compact('pantogstDetails','error_message'));
               }
            } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.pantogst', compact('pantogstDetails', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
          return view('kyc.pantogst', compact('pantogstDetails','hit_limits_exceeded', 'low_wallet_balance'));
     }
     public function pantogstapi(){
        return view('kyc.pantogst_api');
     }
     public function basicGstinVerification(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $BasicGstinVerification = null;
        if ($request->isMethod('GET')) {
             return view('kyc.basicGstin', compact('BasicGstinVerification', 'hit_limits_exceeded', 'low_wallet_balance'));
        }
       if ($request->isMethod('POST')) {
           $accessToken = Auth::user()->access_token;
           if (Auth::user()->scheme_type != 'demo') {
               if (Auth::user()->role_id == 1) {
                   $apiamster = ApiMaster::where('api_slug','gstin')->first();
                   if ($apiamster) {
                       $api_id = $apiamster->id;
                   }
               }
                  $curl = curl_init();
                   curl_setopt_array($curl, [
                    CURLOPT_URL => 'http://regtechapi.in/api/gstverification',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'gstin_number' =>$request->gstinNumber,
                    ),
                    CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                   ]);
              $result = curl_exec($curl);
              $BasicGstinVerification = json_decode($result, true);
              if(isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code']==200){
                   return view('kyc.basicGstin', compact('BasicGstinVerification'));
              }
              elseif(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==102 || isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code']==102){
                $error_message = $BasicGstinVerification['message'];
                return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
              }
             elseif(isset($BasicGstinVerification['statusCode']) &&  $BasicGstinVerification['statusCode']==103){
                  $error_message = $BasicGstinVerification['message'];
                  return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
             }
              elseif(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==403){
                 $error_message = $BasicGstinVerification[0]['message'];
               return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
              }
              elseif(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==404){
                $error_message = $BasicGstinVerification[0]['message'];
                return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
             }
             elseif(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==500){
                $error_message = $BasicGstinVerification['message'];
                return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
             }
             else{
                $basicgstinStatusCode =500;
                return view('kyc.basicGstin', compact('BasicGstinVerification'));
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
                      CURLOPT_URL => 'http://regtechapi.in/api/gstverification',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => array(
                          'gstin_number' =>$request->gstinNumber,
                      ),
                      CURLOPT_HTTPHEADER => ['AccessToken: ' . $accessToken],
                     ]);
                   $result = curl_exec($curl);
                   $BasicGstinVerification = json_decode($result, true);
                if(isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code']==200){
                     return view('kyc.basicGstin', compact('BasicGstinVerification'));
                }
                elseif(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==102 || isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code']==102){
                  $error_message = $BasicGstinVerification['message'];
                  return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
                }
               elseif(isset($BasicGstinVerification['statusCode']) &&  $BasicGstinVerification['statusCode']==103){
                    $error_message = $BasicGstinVerification['message'];
                    return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
               }
                elseif(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==403){
                   $error_message = $BasicGstinVerification[0]['message'];
                 return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
                }
                elseif(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==404){
                  $error_message = $BasicGstinVerification[0]['message'];
                  return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
               }
               elseif(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==500){
                  $error_message = $BasicGstinVerification['message'];
                  return view('kyc.basicGstin', compact('BasicGstinVerification','error_message'));
               }
               else{
                  $basicgstinStatusCode =500;
                  return view('kyc.basicGstin', compact('BasicGstinVerification'));
               }
             } else {
                   $hit_limits_exceeded = 1;
                   return view('kyc.basicGstin', compact('BasicGstinVerification', 'hit_limits_exceeded', 'low_wallet_balance'));
               }
           }
       }
          return view('kyc.basicGstin', compact('BasicGstinVerification','hit_limits_exceeded', 'low_wallet_balance'));
     }
     public function basicGstinVerificationApi(){
        return view('kyc.basicgstin_api');
     }
     public function corporate_basic_api(){
        return view('kyc.corporate_cin_basic_apis');
     }
     public function corporate_basic(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $corporate_basic = null;
        if ($request->isMethod('GET')) {
            return view('kyc.corporate_cin_basic', compact('corporate_basic', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(Auth::user()->scheme_type != 'demo'){
            if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','cinbasic')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
             CURLOPT_URL => 'http://regtechapi.in/api/corporate_cin_basicv2',
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => array('cin_number' =>$request->cin_number),
             CURLOPT_HTTPHEADER => array(
               'AccessToken:'.$accessToken,
             ),
           ));
           
           $response = curl_exec($curl);
           curl_close($curl);
           $corporate_basic = json_decode($response, true);
            if(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==200){
               return view('kyc.corporate_cin_basic', compact('corporate_basic'));
            }
            elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==102){
               return view('kyc.corporate_cin_basic', compact('corporate_basic'));
            }
            elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==201){
               return view('kyc.corporate_cin_basic', compact('corporate_basic'));
            }
            elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==103){
               return view('kyc.corporate_cin_basic', compact('corporate_basic'));
            }
            elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==500){
               return view('kyc.corporate_cin_basic', compact('corporate_basic'));
            }
            else{
               $cinadbasicStatusCode = 500;
               return view('kyc.corporate_cin_basic', compact('cinadbasicStatusCode'));
            }
           }
           else{
            $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if($hit_count_remaining >0){
                $user = User::where('id', Auth::user()->id)->first();
                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                $user->save();
                $curl = curl_init();
                curl_setopt_array($curl, array(
                 CURLOPT_URL => 'http://regtechapi.in/api/corporate_cin_basicv2',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS => array('cin_number' =>$request->cin_number),
                 CURLOPT_HTTPHEADER => array(
                   'AccessToken:'.$accessToken,
                 ),
               ));
               
               $response = curl_exec($curl);
               curl_close($curl);
               $corporate_basic = json_decode($response, true);
                if(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==200){
                   return view('kyc.corporate_cin_basic', compact('corporate_basic'));
                }
                elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==102){
                   return view('kyc.corporate_cin_basic', compact('corporate_basic'));
                }
                elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==201){
                   return view('kyc.corporate_cin_basic', compact('corporate_basic'));
                }
                elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==103){
                   return view('kyc.corporate_cin_basic', compact('corporate_basic'));
                }
                elseif(isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==500){
                   return view('kyc.corporate_cin_basic', compact('corporate_basic'));
                }
                else{
                   $cinadbasicStatusCode = 500;
                   return view('kyc.corporate_cin_basic', compact('cinadbasicStatusCode'));
                }   
              }
              else{
                $hit_limits_exceeded = 1;
                return view('kyc.corporate_cin_basic', compact('corporate_basic', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
          }
       }
     }
     public function corporate_advanced_api(){
     
        return view('kyc.corporate_cin_advanced_apis');
     }
     public function corporate_advanced(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $corporate_advance = null;
        if ($request->isMethod('GET')) {
            return view('kyc.corporate_cin_advance', compact('corporate_advance', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(Auth::user()->scheme_type != 'demo'){
            if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','cin')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
             $curl = curl_init();
             curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://regtechapi.in/api/corporate_cin_advancev2',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('cinNumber' =>$request->cinNumber),
              CURLOPT_HTTPHEADER => array(
                'AccessToken:'.$accessToken,
              ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $corporate_advance = json_decode($response, true);
             if(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==200){
                return view('kyc.corporate_cin_advance', compact('corporate_advance'));
             }
             elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==102){
                return view('kyc.corporate_cin_advance', compact('corporate_advance'));
             }
             elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==201){
                return view('kyc.corporate_cin_advance', compact('corporate_advance'));
             }
             elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==103){
                return view('kyc.corporate_cin_advance', compact('corporate_advance'));
             }
             elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==500){
                return view('kyc.corporate_cin_advance', compact('corporate_advance'));
             }
             else{
                $cinadvancedStatusCode = 500;
                return view('kyc.corporate_cin_advance', compact('cinadvancedStatusCode'));
             }
         
           }
           else{
            $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if($hit_count_remaining >0){
                $user = User::where('id', Auth::user()->id)->first();
                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                $user->save();  
                $curl = curl_init();
                curl_setopt_array($curl, array(
                 CURLOPT_URL => 'http://regtechapi.in/api/corporate_cin_advancev2',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS => array('cinNumber' =>$request->cinNumber),
                 CURLOPT_HTTPHEADER => array(
                   'AccessToken:'.$accessToken,
                 ),
               ));
               
               $response = curl_exec($curl);
               curl_close($curl);
               $corporate_advance = json_decode($response, true);
                if(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==200){
                   return view('kyc.corporate_cin_advance', compact('corporate_advance'));
                }
                elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==102){
                   return view('kyc.corporate_cin_advance', compact('corporate_advance'));
                }
                elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==201){
                   return view('kyc.corporate_cin_advance', compact('corporate_advance'));
                }
                elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==103){
                   return view('kyc.corporate_cin_advance', compact('corporate_advance'));
                }
                elseif(isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==500){
                   return view('kyc.corporate_cin_advance', compact('corporate_advance'));
                }
                else{
                   $cinadvancedStatusCode = 500;
                   return view('kyc.corporate_cin_advance', compact('cinadvancedStatusCode'));
                }
              }
              else{
                $hit_limits_exceeded = 1;
                return view('kyc.corporate_cin_advance', compact('corporate_advance', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
          }
       }
    }
    public function verify_email(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $verify_email = null;
        if ($request->isMethod('GET')) {
            return view('kyc.email_verify', compact('verify_email', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(Auth::user()->scheme_type != 'demo'){
              if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','verifyemail')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://regtechapi.in/api/verify_email',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>array(
              "email_to_verify"=>$request->email_id,
              ),
              CURLOPT_HTTPHEADER =>array(
                'AccessToken:'.$accessToken,
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $verify_email = json_decode($response,true);
             if(isset($verify_email['statusCode']) && $verify_email['statusCode']==200){
              
                return view('kyc.email_verify', compact('verify_email'));
             }
             elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==102){
                $error_message = $verify_email['message'];
                return view('kyc.email_verify', compact('verify_email','error_message'));
             }
             elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==103){
                $error_message = $verify_email['message'];
                return view('kyc.email_verify', compact('verify_email','error_message'));
             }
             elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==500){
                $error_message = $verify_email['message'];
                return view('kyc.email_verify', compact('verify_email','error_message'));
             }
             else{
                $verifyEmailStatusCode = 500;
                return view('kyc.email_verify');
             }
         
           }
           else{
            $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if($hit_count_remaining >0){
                $user = User::where('id', Auth::user()->id)->first();
                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                $user->save();  
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://regtechapi.in/api/verify_email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>array(
                "email_to_verify"=>$request->email_id,
                ),
                CURLOPT_HTTPHEADER =>array(
                  'AccessToken:'.$accessToken,
                ),
              ));
              $response = curl_exec($curl);
              curl_close($curl);
              $verify_email = json_decode($response,true);
               if(isset($verify_email['statusCode']) && $verify_email['statusCode']==200){
                
                  return view('kyc.email_verify', compact('verify_email'));
               }
               elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==102){
                  $error_message = $verify_email['message'];
                  return view('kyc.email_verify', compact('verify_email','error_message'));
               }
               elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==103){
                $error_message = $verify_email['message'];
                return view('kyc.email_verify', compact('verify_email','error_message'));
              }
               elseif(isset($verify_email['statusCode']) && $verify_email['statusCode']==500){
                  $error_message = $verify_email['message'];
                  return view('kyc.email_verify', compact('verify_email','error_message'));
               }
               else{
                  $verifyEmailStatusCode = 500;
                  return view('kyc.email_verify');
               }    
             }
          else{
            $hit_limits_exceeded = 1;
            return view('kyc.email_verify', compact('email_verify', 'hit_limits_exceeded', 'low_wallet_balance'));
          }
       }
    }
    }
    public function check_verify_email_status(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $check_verify_email_status = null;
        if ($request->isMethod('GET')) {
            return view('kyc.check_email_varifaction_status', compact('check_verify_email_status', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(Auth::user()->scheme_type != 'demo'){
             if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','checkverificationemailstatus')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
             $curl = curl_init();
             curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://regtechapi.in/api/check_verification_email_status',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>array(
                "identity"=>$request->email_id,
                ),
                CURLOPT_HTTPHEADER =>array(
                  'AccessToken:'.$accessToken,
                ),
              ));
             $response = curl_exec($curl);
             curl_close($curl);
             $check_verify_email_status = json_decode($response,true);
             
             if(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==200){
               return view('kyc.check_email_varifaction_status', compact('check_verify_email_status'));
             }
             elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==102){
                return view('kyc.check_email_varifaction_status', compact('verify_email'));
             }
             elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==103){
                return view('kyc.check_email_varifaction_status', compact('verify_email'));
             }
             elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==500){
                return view('kyc.check_email_varifaction_status', compact('verify_email'));
             }
             else{
                $verifyEmailStatusCode = 500;
                return view('kyc.check_email_varifaction_status', compact('verifyEmailStatusCode'));
             }
         
           }
           else{
            $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if($hit_count_remaining >0){
                $user = User::where('id', Auth::user()->id)->first();
                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                $user->save();  
                $curl = curl_init();
                curl_setopt_array($curl, array(
                   CURLOPT_URL => 'http://regtechapi.in/api/check_verification_email_status',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS =>array(
                   "identity"=>$request->email_id,
                   ),
                   CURLOPT_HTTPHEADER =>array(
                     'AccessToken:'.$accessToken,
                   ),
                 ));
                $response = curl_exec($curl);
                curl_close($curl);
                $check_verify_email_status = json_decode($response,true);
                
                if(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==200){
                  return view('kyc.check_email_varifaction_status', compact('check_verify_email_status'));
                }
                elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==102){
                  $error_message =  $check_verify_email_status['message'];
                   return view('kyc.check_email_varifaction_status', compact('check_verify_email_status','error_message'));
                }
                elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==103){
                    $error_message =  $check_verify_email_status['message'];
                   return view('kyc.check_email_varifaction_status', compact('check_verify_email_status','error_message'));
                }
                elseif(isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode']==500){
                    $error_message =  $check_verify_email_status['message'];
                   return view('kyc.check_email_varifaction_status', compact('check_verify_email_status','error_message'));
                }
                else{
                   $verifyEmailStatusCode = 500;
                   return view('kyc.check_email_varifaction_status', compact('verifyEmailStatusCode'));
                }
              }
              else{
                $hit_limits_exceeded = 1;
                return view('kyc.check_email_varifaction_status', compact('check_verify_email_status', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
          }
        }
        
      }
     public function email_verify_api(){
        return view('kyc.email_verify_api');
      }
     public function check_verify_email_status_api(){
        return view('kyc.check_email_verifaction_status_api');
     }
     public function dedupe(Request $request){
        $statusCode = null;
        $hit_limits_exceeded = 0;
        $low_wallet_balance = 0;
        $dedupe_details = null;
        if ($request->isMethod('GET')) {
            return view('kyc.dedupe', compact('dedupe_details', 'hit_limits_exceeded', 'low_wallet_balance'));
       }
       if($request->isMethod('post')){
          $accessToken = Auth::user()->access_token;
           if(Auth::user()->scheme_type != 'demo'){
             if (Auth::user()->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug','dedupe')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }
             $curl = curl_init();
             curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://regtechapi.in/api/dedupe_s3',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>array(
                "bucket_name"=>$request->bucket_name,
                "prefix"=>$request->prefix,
                "aws_access_key_id"=>$request->aws_access_key_id,
                "aws_secret_access_key"=>$request->aws_secret_access_key,
                "region_name"=>$request->region_name,
                 ),
                CURLOPT_HTTPHEADER =>array(
                  'AccessToken:'.$accessToken,
                ),
              ));
             $response = curl_exec($curl);
             curl_close($curl);
             $dedupe_details = json_decode($response,true);
            if(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==200){
                return view('kyc.dedupe', compact('dedupe_details'));
             }
             elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==102){
                $error_message =  $dedupe_details['message'];
                return view('kyc.dedupe', compact('dedupe_details','error_message'));
             }
             elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==103){
                $error_message =  $dedupe_details['message'];
                return view('kyc.dedupe', compact('dedupe_details','error_message'));
             }
             elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==500){
                $error_message =  $dedupe_details['message'];
                return view('kyc.dedupe', compact('dedupe_details','error_message'));
             }
             else{
                $dedupeStatusCode = 500;
                return view('kyc.dedupe');
             }
         
           }
           else{
            $scheme_type = SchemeTypeMaster::where('id', Auth::user()->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
              if($hit_count_remaining >0){
                $user = User::where('id', Auth::user()->id)->first();
                $user->scheme_hit_count = $user->scheme_hit_count + 1;
                $user->save();  
                $curl = curl_init();
                curl_setopt_array($curl, array(
                   CURLOPT_URL => 'http://regtechapi.in/api/dedupe_s3',
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => '',
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 0,
                   CURLOPT_FOLLOWLOCATION => true,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => 'POST',
                   CURLOPT_POSTFIELDS =>array(
                   "bucket_name"=>$request->bucket_name,
                   "prefix"=>$request->prefix,
                   "aws_access_key_id"=>$request->aws_access_key_id,
                   "aws_secret_access_key"=>$request->aws_secret_access_key,
                   "region_name"=>$request->region_name,
                    ),
                   CURLOPT_HTTPHEADER =>array(
                     'AccessToken:'.$accessToken,
                   ),
                 ));
                $response = curl_exec($curl);
                curl_close($curl);
                $dedupe_details = json_decode($response,true);
               if(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==200){
                   return view('kyc.dedupe', compact('dedupe_details','error_message'));
                }
                elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==102){
                   $error_message =  $dedupe_details['message'];
                   return view('kyc.dedupe', compact('dedupe_details','error_message'));
                }
                elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==103){
                   $error_message =  $dedupe_details['message'];
                   return view('kyc.dedupe', compact('dedupe_details','error_message'));
                }
                elseif(isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==500){
                   $error_message =  $dedupe_details['message'];
                   return view('kyc.dedupe', compact('dedupe_details','error_message'));
                }
                else{
                   $dedupeStatusCode = 500;
                   return view('kyc.dedupe');
                }
              }
              else{
                $hit_limits_exceeded = 1;
                return view('kyc.dedupe', compact('dedupe_details', 'hit_limits_exceeded', 'low_wallet_balance'));
              }
          }
       }
      }
     public function dedupe_api(){
        return view('kyc.dedupe_api');
     }

}