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
use Redirect;
use File;
use DOMDocument;
use App\Transaction;
use Session;
use DB;
use Illuminate\Support\Carbon;

class CrifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $crif_url = "https://loantap.in/affiliate/apiv1-1/docboyz/crif";

    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MjUzOTIyMTYsImp0aSI6IjhkOWZmNTFiLTJiYmItNDc4My1iYmI5LTg5ZWMzNGY3MDNmZiIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsImZyZXNoIjpmYWxzZSwiaWF0IjoxNTkzODU2MjE2LCJuYmYiOjE1OTM4NTYyMTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19LCJ0eXBlIjoiYWNjZXNzIn0.f0Ea5UmL_DQsSCBF6sWJzU-n7NPT9TL_IkKFY_a-3KQ';
    
    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';

   public function crif(Request $request){ 
        
        $statusCode = null;
        $reportgenerated = null;
        $hit_limits_exceeded = 0; 
        $html_report = "";

        if($request -> isMethod('GET')){
            return view('crif.creditreport',compact('statusCode','reportgenerated','hit_limits_exceeded'));
        }

        if($request -> isMethod('POST')){
            $body=array();
            $headers = [
                'X-API-KEY' => 'MEtOdRx3fn4o9zeVAXByVQoKpXn66c3fli4rcCkLy9',
                'DEV-ACCESS-KEY' => 'CxFJiV2eqm99KpQqzOJMLxVW2eBZwAiMYaezH57P'
            ]; 

            $sql = DB::table('equifax_pdf_request')->insert([
                'firstName' => $request->fullname,
                'lastName' => null,
                'contactNo'=> $request->mno,
                'idValue'=> $request->pan,
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            
            $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
            
            $uname = Auth::user()->name;
            // $uname = DB::table('users')->where('id', Auth::id())->get()->first();
    
            $arr = explode(' ', trim($uname));
            $user = '';
            $substr = '';
            foreach($arr as $array){
                $substr = substr($array, 0, 1);
                $user = $user.$substr;
            }
            
            $recordId = sprintf("%04d", $record_id->id);
            $CustRefField = "DB-".strtoupper($user).Carbon::now()->format('y').Carbon::now()->format('m').$recordId;

            $body = [
                'gender' => "male",
                'dob' => $request -> dob,
                'pan_card' => $request -> pan,
                'mobile_number' => $request -> mno,
                'full_name' => $request -> fullname,
                "home" => [
                    "city" => $request -> city,
                    "zipcode" => $request -> zipcode,
                    "address" => [
                                "line2" => $request -> addrline2,
                                "line1" => $request -> addrline1
                            ],
                   
                ],
            "allowed_for_awesomeui" => "yes",
            "chm_ref" => $CustRefField
            ];
            $json = json_encode($body);
        $client = new Client();

        if(Auth::user()->scheme_type != 'demo'){
            if(Auth::user() -> role_id == 1){
                $apiamster = ApiMaster::where('api_slug','creditscorereport')->first();
                    if($apiamster)
                        $api_id = $apiamster->id;                    
            }
            try{   
                $html_report = base64_decode($reportgenerated['data']['file']['html_report']);
                // exit(1);
                $Crif = new Crif();
                $Crif -> user_id = Auth::user() -> id;
                $Crif -> full_name = $reportgenerated['data']['request_meta']['full_name'];
                $Crif -> gender = $reportgenerated['data']['request_meta']['gender'];
                $Crif -> pan_card_no = $reportgenerated['data']['request_meta']['pan_card'];
                $Crif -> mob_no = $reportgenerated['data']['request_meta']['mobile_number'];
                $Crif -> crif_report_id = $reportgenerated['data']['crif_report_id'];
                $Crif -> crif_score = $reportgenerated['data']["crif_score"];
                $Crif -> crif_estimated_data = $reportgenerated['data']["crif_estimated_date"];
                $Crif -> response_xml = $reportgenerated['data']['file']['response_xml'];
                $Crif -> html_report = $reportgenerated['data']['file']['html_report'];
                // $Crif -> enquiry = $reportgenerated['data']['credit_account']['enquiry'];
                // $Crif -> account = $reportgenerated['data']['credit_account']['account'];
                
                $Crif -> save();
                $data = $reportgenerated['data']['file']['response_xml'];
                //dd($data);
                // $fname = Auth::user() -> id."-".time()."."."xml"; 
                // $destpath = public_path()."/XML";
                // if (!is_dir($destpath)) {  mkdir($destpath,0777,true);  }
                // File::put($destpath.$fname,$data);

            
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
                    }
                }
                $statusCode = 200;
            }catch(BadResponseException $e){
                $statusCode = $e->getResponse()->getStatusCode();
            }
        }else {
                $scheme_type = SchemeTypeMaster::where('id',Auth::user()->scheme_type_id)->first();
                $hit_count_remaining = $scheme_type->hit_limits - Auth::user()->scheme_hit_count;
                if($hit_count_remaining>0)
                {
                    try{
                        $response = $client -> post($this -> crif_url,[
                            'headers' => $headers,
                            'json' => $json
                        ]);
                
                        $reportgenerated = json_decode($response -> getBody(),true);

                        $user = User::where('id',Auth::user()->id)->first();
                        $user->scheme_hit_count = $user->scheme_hit_count+1;
                        $user->save();

                        $statusCode = 200;
                    }catch(BadResponseException $e) {
                        $statusCode = $e->getResponse()->getStatusCode();
                    }
                } else {
                    $hit_limits_exceeded = 1;
                    return view('crif.creditreport', compact('reportgenerated','statusCode','hit_limits_exceeded'));
                }
            }              $response = $client -> post("https://loantap.in/affiliate/apiv1-1/docboyz/crif",[
                    'headers' => $headers,
                    'json' => $body
                ]);   
                $reportgenerated = json_decode($response -> getBody(),true);
     
            

        }
        return view('crif.creditreport', compact('reportgenerated','statusCode','hit_limits_exceeded', 'CustRefField', 'html_report'));
        }
    

    public function sendOTP(Request $request)  {
        // dd('asasa');
        $otp = rand(1111,9999);
        Session::put('otp_code',$otp);
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
        $newno = $prt.$number;
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
        if ($err) {
            return response()->json(['error'=>'Something went wrong. Please try again.']);
        } else {
            return response()->json(['otp'=>$otp,'success'=>'OTP sent successfully']);
        }
    }


    // Verify OTP
    public function verifyotp(Request $request)
    {
        //  return $request->all();
      
        if(Session::has('otp_code')){
            $otp_code = Session::get('otp_code');
            if($request->otp_code == $otp_code){
                return response()->json(['success'=>'OTP verified successfully']);
            } else {
                return response()->json(['fail'=>'OTP is not match']);
            }
        }
        if(Session::has('otp_code1')){
          
            $otp_code1 = Session::get('otp_code1');
            if($request->otp_code1 == $otp_code1){
                return response()->json(['success'=>'OTP verified successfully']);
            } else {
                return response()->json(['fail'=>'OTP is not match']);
            }
        } 
        else {
            return response()->json(['error'=>'Something went wrong. Please try again.']);
        }
    }
}
