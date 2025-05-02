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
class SetBrandingController extends Controller
{
    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
    public function index(Request $request)
    {
        return view('branding.branding');
    }
    public function branding(Request $request)
    {
        $statusCode = null;
        $branding = null;
        $hit_limits_exceeded = 0;

        if($request->isMethod('GET')){
            return view('branding.branding', compact('branding', 'statusCode','hit_limits_exceeded'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->scheme_type!='demo') {
                if(Auth::user()->role_id==1) {
                    $apiamster = ApiMaster::where('api_slug','branding')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;
                }
                $client = new Client();
                $headers = [
                    'Authorization' => $this->sandbox_token,        
                    'Accept'        => 'application/json',
                ];
                $file = $request->file('brand_image_url');
                $file_name ="branding" . time() . '_branding' .  "." . $file->getClientOriginalExtension();
                $file->move(public_path('branding/'), $file_name);  
                $urls="http://localhost/projects/regtechapi/public/";    
                $body =  [
                    "brand_image_url"=> $urls."branding/".$file_name,
                    "brand_name"=> $request->brand_name
                ];
                    //  dd($body);
                     try{
                        $res = $client->post($this->sandbox_url.'/esign/set-branding', ['headers' => $headers, 'json' => $body]);
                        // dd(1);
                        $branding = json_decode($res->getBody(), true);
                        // dd($esign);
                         print_r($branding);
                        // exit(1);
                        unlink(public_path('branding/') .$file_name);
                        exit(1);
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
    
                                $remark = 'Branding'.$updateHitCount->scheme_price.' Sucessfull';
                                $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                                $this->update_wallet_balance($updateHitCount->scheme_price);
                            }
                        }
                       
                        // dd($esign);
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
            }
            else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $res = $client->post($this->sandbox_url.'/initialize', ['headers' => $headers, 'json' => $body]);
                        $esign = json_decode($res->getBody(), true);
                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();
                    } catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('branding.branding', compact('pancard', 'statusCode','hit_limits_exceeded'));
                }
            }
        }
        return view('branding.branding', compact('branding', 'statusCode','hit_limits_exceeded'));
    }
}
