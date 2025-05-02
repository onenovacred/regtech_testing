<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Auth;
use App\Models\ApiMaster;
use App\Models\SchemeMaster;
use App\Models\HitCountMaster;
use App\Models\SchemeTypeMaster;
use App\Models\User;

class VaccineController extends Controller
{
    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MjUzOTIyMTYsImp0aSI6IjhkOWZmNTFiLTJiYmItNDc4My1iYmI5LTg5ZWMzNGY3MDNmZiIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsImZyZXNoIjpmYWxzZSwiaWF0IjoxNTkzODU2MjE2LCJuYmYiOjE1OTM4NTYyMTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19LCJ0eXBlIjoiYWNjZXNzIn0.f0Ea5UmL_DQsSCBF6sWJzU-n7NPT9TL_IkKFY_a-3KQ';
    
    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

    public function vaccine_genrate_otp(Request $request){


    	$statusCode = null;
        $vaccine_generate_otp = null;
        $hit_limits_exceeded = null;

        if($request->isMethod('GET')){
            return view('vaccine.auth.vaccine_genrate_otp', compact('vaccine_generate_otp', 'statusCode'));
        }
         if($request->isMethod('POST')){
            
            $client = new Client();


            //POST PARAMS
            $headers = [
                'Authorization' => $this -> sandbox_token,
                'Accept' => 'application/json'

            ];

            $body = [
                'mobile_number' => $request -> mobile_number
            ];


            if(Auth::user()->scheme_type!='demo'){
                if(Auth::user()->role_id== 1){
                    $apimaster = ApiMaster::where('api_slug','vaccine_generate_otp') -> first();
                    if($apimaster)
                        $api_id = $apimaster -> id;
                }
            

            try
            {                
                $response = $client -> post($this->sandbox_url.'/vaccine/generate-otp',['headers' => $headers,
                    'json' => $body]);
                $vaccine_generate_otp = json_decode($response -> getBody(),true);
                if(Auth::user()->role_id==1) {
                        if($apiamster) {
                            $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                            $addHitCount = new HitCountMaster;
                            $addHitCount->user_id = Auth()->user()->id;
                            $addHitCount->api_id = $api_id;
                            $addHitCount->scheme_price = $updateHitCount->scheme_price;
                            $addHitCount->hit_year_month = date('Y-m');
                            $addHitCount->hit_count = 1;
                            $addHitCount->save();

                            $remark = 'Vaccine generate otp Debited '.$updateHitCount->scheme_price.' Sucessfull';
                            $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                            $this->update_wallet_balance($updateHitCount->scheme_price);
                        }
                    }
                
            }catch(BadResponseException $e)
            {
                $statusCode = $e -> getResponse() -> getStatusCode(); 
            }
            }else
            {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $response = $client -> post($this->sandbox_url.'/vaccine/generate-otp',['headers' => $headers,'json' => $body]);
                        $vaccine_generate_otp = json_decode($response -> getBody(),true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('vaccine.auth.vaccine_genrate_otp', compact('vaccine_generate_otp', 'statusCode','hit_limits_exceeded'));
                }
            
            }        
        }
        return view('vaccine.auth.vaccine_genrate_otp', compact('vaccine_generate_otp', 'statusCode','hit_limits_exceeded'));
    }
                
    


     public function vaccine_submit_otp(Request $request){
        $statusCode = null;
        $vaccine_submit_otp = null;
        $hit_limits_exceeded = null;

        if($request->isMethod('GET')){
            return view('vaccine.auth.vaccine_submit_otp', compact('vaccine_submit_otp', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $client = new Client();

            //POST PARAMS
            $headers = [
                'Authorization' => $this -> sandbox_token,
                'Accept' => 'application/json'

            ];

            $body = [
                'client_id' => $request -> client_id,
                'otp' => $request -> otp
            ];


            if(Auth::user()->scheme_type!='demo'){
                if(Auth::user()->role_id== 1){
                    $apimaster = ApiMaster::where('api_slug','vaccine_submit_otp') -> first();
                    if($apimaster)
                        $api_id = $apimaster -> id;
                }
            

            try
            {                
                $response = $client -> post($this->sandbox_url.'/vaccine/submit-otp',['headers' => $headers,
                    'json' => $body]);
                $vaccine_submit_otp = json_decode($response -> getBody(),true);
                if(Auth::user()->role_id==1) {
                        if($apiamster) {
                            $updateHitCount = SchemeMaster::where('user_id',Auth()->user()->id)->where('api_id',$api_id)->first();

                            $addHitCount = new HitCountMaster;
                            $addHitCount->user_id = Auth()->user()->id;
                            $addHitCount->api_id = $api_id;
                            $addHitCount->scheme_price = $updateHitCount->scheme_price;
                            $addHitCount->hit_year_month = date('Y-m');
                            $addHitCount->hit_count = 1;
                            $addHitCount->save();

                            $remark = 'Vaccine Submit OTP Debited '.$updateHitCount->scheme_price.' Sucessfull';
                            $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                            $this->update_wallet_balance($updateHitCount->scheme_price);
                        }
                    }
                
            }catch(BadResponseException $e)
            {
                $statusCode = $e -> getResponse() -> getStatusCode(); 
            }
            }else
            {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $response = $client -> post($this->sandbox_url.'/vaccine/generate-otp',['headers' => $headers,'json' => $body]);
                        $vaccine_generate_otp = json_decode($response -> getBody(),true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('vaccine.auth.vaccine_submit_otp', compact('vaccine_submit_otp', 'statusCode','hit_limits_exceeded'));
                }
            
            }            
        }

        return view('vaccine.auth.vaccine_submit_otp', compact('vaccine_submit_otp', 'statusCode','hit_limits_exceeded'));
                
    }

    // Vaccine Get details

     public function vaccine_get_details(Request $request){


         $statusCode = null;
        $vaccine_get_details = null;

        if($request->isMethod('GET')){
            return view('vaccine.auth.vaccine_get_details', compact('vaccine_get_details', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_get_details number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_get_details = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_get_details['status_code'];
            $category =  $vaccine_get_details["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_get_details["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_get_details);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_get_details["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_get_details;
            return view('vaccine.auth.vaccine_get_details', compact('vaccine_get_details', 'statusCode','tag_class'));
        }
    }

    // Vaccine benefiaries registration 

     public function benefiaries_registration_api(Request $request){


         $statusCode = null;
        $benefiaries_registration_api = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.registration.beneficiary.benefiaries_registration_api', compact('benefiaries_registration_api', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"benefiaries_registration_api number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $benefiaries_registration_api = json_decode($get_data, true);
            $err = 0;
            $statusCode = $benefiaries_registration_api['status_code'];
            $category =  $benefiaries_registration_api["data"]["vehicle_category_description"];
            $gross_weight =  $benefiaries_registration_api["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(benefiaries_registration_api);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $benefiaries_registration_api["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $benefiaries_registration_api;
            return view('vaccine.booking.registration.beneficiary.benefiaries_registration_api', compact('benefiaries_registration_api', 'statusCode','tag_class'));
        }
    }

    // Vaccine Delete benefiaries registration 

     public function delete_benefiaries(Request $request){


         $statusCode = null;
        $delete_benefiaries = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.registration.beneficiary.delete_benefiaries', compact('delete_benefiaries', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"delete_benefiaries number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $delete_benefiaries = json_decode($get_data, true);
            $err = 0;
            $statusCode = $delete_benefiaries['status_code'];
            $category =  $delete_benefiaries["data"]["vehicle_category_description"];
            $gross_weight =  $delete_benefiaries["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(delete_benefiaries);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $delete_benefiaries["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $delete_benefiaries;
            return view('vaccine.booking.registration.beneficiary.delete_benefiaries', compact('delete_benefiaries', 'statusCode','tag_class'));
        }
    }

      // Vaccine Get Gender 

     public function get_gender(Request $request){


         $statusCode = null;
        $get_gender = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.registration.beneficiary.get_gender', compact('get_gender', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"get_gender number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $get_gender = json_decode($get_data, true);
            $err = 0;
            $statusCode = $get_gender['status_code'];
            $category =  $get_gender["data"]["vehicle_category_description"];
            $gross_weight =  $get_gender["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(get_gender);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $get_gender["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $get_gender;
            return view('vaccine.booking.registration.beneficiary.get_gender', compact('get_gender', 'statusCode','tag_class'));
        }
    }

    // Vaccine Delete benefiaries registration 

     public function download_vaccination_certificates(Request $request){


         $statusCode = null;
        $download_vaccination_certificates = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.registration.download_vaccination_certificates', compact('download_vaccination_certificates', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"download_vaccination_certificates number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $download_vaccination_certificates = json_decode($get_data, true);
            $err = 0;
            $statusCode = $download_vaccination_certificates['status_code'];
            $category =  $download_vaccination_certificates["data"]["vehicle_category_description"];
            $gross_weight =  $download_vaccination_certificates["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(download_vaccination_certificates);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $download_vaccination_certificates["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $download_vaccination_certificates;
            return view('vaccine.booking.registration.download_vaccination_certificates', compact('download_vaccination_certificates', 'statusCode','tag_class'));
        }
    }
    

    // Vaccine Get State

     public function vaccine_get_states(Request $request){


         $statusCode = null;
        $vaccine_get_states = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.admin_location.vaccine_get_states', compact('vaccine_get_states', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_get_states number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_get_states = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_get_states['status_code'];
            $category =  $vaccine_get_states["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_get_states["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_get_states);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_get_states["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_get_states;
            return view('vaccine.booking.admin_location.vaccine_get_states', compact('vaccine_get_states', 'statusCode','tag_class'));
        } 
    }
    
    // Vaccine Get District

     public function vaccine_get_list_of_districts(Request $request){


         $statusCode = null;
        $vaccine_get_list_of_districts = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.admin_location.vaccine_get_list_of_districts', compact('vaccine_get_list_of_districts', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_get_list_of_districts number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_get_list_of_districts = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_get_list_of_districts['status_code'];
            $category =  $vaccine_get_list_of_districts["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_get_list_of_districts["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_get_list_of_districts);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_get_list_of_districts["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_get_list_of_districts;
            return view('vaccine.booking.admin_location.vaccine_get_list_of_districts', compact('vaccine_get_list_of_districts', 'statusCode','tag_class'));
        } 
    }

    // Vaccine Create Appointment 

     public function create_appointment_vaccine(Request $request){


         $statusCode = null;
        $create_appointment_vaccine = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.create_appointment_vaccine', compact('create_appointment_vaccine', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"create_appointment_vaccine number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $create_appointment_vaccine = json_decode($get_data, true);
            $err = 0;
            $statusCode = $create_appointment_vaccine['status_code'];
            $category =  $create_appointment_vaccine["data"]["vehicle_category_description"];
            $gross_weight =  $create_appointment_vaccine["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(create_appointment_vaccine);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $create_appointment_vaccine["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $create_appointment_vaccine;
            return view('vaccine.booking.appointment.admin_location.create_appointment_vaccine', compact('create_appointment_vaccine', 'statusCode','tag_class'));
        } 
    }
    
     // Vaccine Cancel Appointment 

     public function cancle_appointment_vaccine(Request $request){


         $statusCode = null;
        $cancle_appointment_vaccine = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.cancle_appointment_vaccine', compact('cancle_appointment_vaccine', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"cancle_appointment_vaccine number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $cancle_appointment_vaccine = json_decode($get_data, true);
            $err = 0;
            $statusCode = $cancle_appointment_vaccine['status_code'];
            $category =  $cancle_appointment_vaccine["data"]["vehicle_category_description"];
            $gross_weight =  $cancle_appointment_vaccine["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(cancle_appointment_vaccine);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $cancle_appointment_vaccine["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $cancle_appointment_vaccine;
            return view('vaccine.booking.appointment.admin_location.cancle_appointment_vaccine', compact('cancle_appointment_vaccine', 'statusCode','tag_class'));
        } 
    }

    // Vaccine Reschedule Appointment 

     public function reschedule_appointment_vaccine(Request $request){


         $statusCode = null;
        $reschedule_appointment_vaccine = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.reschedule_appointment_vaccine', compact('reschedule_appointment_vaccine', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"reschedule_appointment_vaccine number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $reschedule_appointment_vaccine = json_decode($get_data, true);
            $err = 0;
            $statusCode = $reschedule_appointment_vaccine['status_code'];
            $category =  $reschedule_appointment_vaccine["data"]["vehicle_category_description"];
            $gross_weight =  $reschedule_appointment_vaccine["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(reschedule_appointment_vaccine);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $reschedule_appointment_vaccine["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $reschedule_appointment_vaccine;
            return view('vaccine.booking.appointment.admin_location.reschedule_appointment_vaccine', compact('reschedule_appointment_vaccine', 'statusCode','tag_class'));
        } 
    }


    // Vaccine Download Appointment Details 

     public function download_appointment_details_vaccine(Request $request){


         $statusCode = null;
        $download_appointment_details_vaccine = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.download_appointment_details_vaccine', compact('download_appointment_details_vaccine', 'statusCode'));
        }
        if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"download_appointment_details_vaccine number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $download_appointment_details_vaccine = json_decode($get_data, true);
            $err = 0;
            $statusCode = $download_appointment_details_vaccine['status_code'];
            $category =  $download_appointment_details_vaccine["data"]["vehicle_category_description"];
            $gross_weight =  $download_appointment_details_vaccine["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(download_appointment_details_vaccine);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $download_appointment_details_vaccine["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $download_appointment_details_vaccine;
            return view('vaccine.booking.appointment.download_appointment_details_vaccine', compact('download_appointment_details_vaccine', 'statusCode','tag_class'));
        } 
    }
    
    // Vaccine get_list_benefiaries_vaccine

     public function get_list_benefiaries_vaccine(Request $request){


         $statusCode = null;
        $get_list_benefiaries_vaccine = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.get_list_benefiaries_vaccine', compact('get_list_benefiaries_vaccine', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"get_list_benefiaries_vaccine number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $get_list_benefiaries_vaccine = json_decode($get_data, true);
            $err = 0;
            $statusCode = $get_list_benefiaries_vaccine['status_code'];
            $category =  $get_list_benefiaries_vaccine["data"]["vehicle_category_description"];
            $gross_weight =  $get_list_benefiaries_vaccine["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(get_list_benefiaries_vaccine);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $get_list_benefiaries_vaccine["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $get_list_benefiaries_vaccine;
            return view('vaccine.booking.appointment.get_list_benefiaries_vaccine', compact('get_list_benefiaries_vaccine', 'statusCode','tag_class'));
        } 
    }

     // Vaccine get_vaccine_center_lat_long

     public function get_vaccine_center_lat_long(Request $request){


         $statusCode = null;
        $get_vaccine_center_lat_long = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.get_vaccine_center_lat_long', compact('get_vaccine_center_lat_long', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"get_vaccine_center_lat_long number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $get_vaccine_center_lat_long = json_decode($get_data, true);
            $err = 0;
            $statusCode = $get_vaccine_center_lat_long['status_code'];
            $category =  $get_vaccine_center_lat_long["data"]["vehicle_category_description"];
            $gross_weight =  $get_vaccine_center_lat_long["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(get_vaccine_center_lat_long);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $get_vaccine_center_lat_long["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $get_vaccine_center_lat_long;
            return view('vaccine.booking.appointment.get_vaccine_center_lat_long', compact('get_vaccine_center_lat_long', 'statusCode','tag_class'));
        } 
    }

    // Vaccine booking/appointment/session

     public function vaccine_session_by_district(Request $request){


         $statusCode = null;
        $vaccine_session_by_district = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.session.vaccine_session_by_district', compact('vaccine_session_by_district', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_session_by_district number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_session_by_district = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_session_by_district['status_code'];
            $category =  $vaccine_session_by_district["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_session_by_district["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_session_by_district);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_session_by_district["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_session_by_district;
            return view('vaccine.booking.appointment.session.vaccine_session_by_district', compact('vaccine_session_by_district', 'statusCode','tag_class'));
        } 
    }

    // Vaccine booking/appointment/session   vaccine/booking/appointment/session/

     public function vaccine_session_by_district_for_seven_days(Request $request){


         $statusCode = null;
        $vaccine_session_by_district_for_seven_days = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.session.vaccine_session_by_district_for_seven_days', compact('vaccine_session_by_district_for_seven_days', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_session_by_district_for_seven_days number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_session_by_district_for_seven_days = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_session_by_district_for_seven_days['status_code'];
            $category =  $vaccine_session_by_district_for_seven_days["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_session_by_district_for_seven_days["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_session_by_district_for_seven_days);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_session_by_district_for_seven_days["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_session_by_district_for_seven_days;
            return view('vaccine.booking.appointment.session.vaccine_session_by_district_for_seven_days', compact('vaccine_session_by_district_for_seven_days', 'statusCode','tag_class'));
        } 
    }

      // Vaccine booking/appointment/session   vaccine/booking/appointment/session/

     public function vaccine_session_by_pin(Request $request){


         $statusCode = null;
        $vaccine_session_by_pin = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.session.vaccine_session_by_pin', compact('vaccine_session_by_pin', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_session_by_pin number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_session_by_pin = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_session_by_pin['status_code'];
            $category =  $vaccine_session_by_pin["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_session_by_pin["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_session_by_pin);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_session_by_pin["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_session_by_pin;
            return view('vaccine.booking.appointment.session.vaccine_session_by_pin', compact('vaccine_session_by_pin', 'statusCode','tag_class'));
        } 
    }

     // Vaccine booking/appointment/session   vaccine_session_by_pin_for_seven_days

     public function vaccine_session_by_pin_for_seven_days(Request $request){


         $statusCode = null;
        $vaccine_session_by_pin_for_seven_days = null;

        if($request->isMethod('GET')){
            return view('vaccine.booking.appointment.session.vaccine_session_by_pin_for_seven_days', compact('vaccine_session_by_pin_for_seven_days', 'statusCode'));
        }
         if($request->isMethod('POST')){
            $body = json_encode(array(
                "rc_number" => $request->rc_number,
            ));


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.flowboard.in/api/v1/rc/rc-full",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $this->token",
                ),

            ));

            if (!$request->rc_number) {
                return json_encode(['message'=>"vaccine_session_by_pin_for_seven_days number no Not found"], true);
            }
            $token = $this->token;
            $get_data = curl_exec($curl);
    
            $vaccine_session_by_pin_for_seven_days = json_decode($get_data, true);
            $err = 0;
            $statusCode = $vaccine_session_by_pin_for_seven_days['status_code'];
            $category =  $vaccine_session_by_pin_for_seven_days["data"]["vehicle_category_description"];
            $gross_weight =  $vaccine_session_by_pin_for_seven_days["data"]["vehicle_gross_weight"];
            $tagclass = '';            
            $check = Rcfull::Select()->where('min_weight',"=", DB::raw('(SELECT min(min_weight) as min FROM `rc` WHERE max_weight > '.$gross_weight.')'))->get();
            
            if($check->count()==1){
                $tagclass = $check[0]['tag_class'];
                if($tagclass == "VC4"){
                    if(Str::contains(strtolower($category), "m-cycle") ||  Str::contains(strtolower($category), "three wheeler")){
                        $tagclass = null;
                    }

                }
            }
            else{
                $tagclass = null;
            }
            dd(vaccine_session_by_pin_for_seven_days);
            // $apiId = 12;
            $req = "rc_number= " . $request->rc_number;
            // $vaccine_session_by_pin_for_seven_days["data"]["tag_class"] = $tagclass;
            $tag_class = $tagclass;
            // self::statusUpdate($token, $statusCode, $get_data, $req, $apiId);
            // return $vaccine_session_by_pin_for_seven_days;
            return view('vaccine.booking.appointment.session.vaccine_session_by_pin_for_seven_days', compact('vaccine_session_by_pin_for_seven_days', 'statusCode','tag_class'));
        } 
    }
       
}
