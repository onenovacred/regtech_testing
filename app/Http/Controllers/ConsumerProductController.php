<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consumer;
use App\Models\businesskyc;
use App\Models\businesstype;
use App\Models\business;
use App\Models\requireddetails;
use App\Models\rulesdefined;
use App\Models\termscondition;
use App\Models\congratulations;
use App\Models\agreementpolicy;
use App\Models\bankdetails;
use App\Models\link;
use Auth;
use App\Models\documentname;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ConsumerProductController extends Controller
{
    private $equifax_url = "http://regtechapi.in/api/equifaxurl";
    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
  

    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYyNTczNDU2MCwianRpIjoiMDE2OWRmYTctNWY3Yi00OTZhLWI3Y2MtMjZhNmExNDZiMjdlIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYyNTczNDU2MCwiZXhwIjoxOTQxMDk0NTYwLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.XCjAFtZlAqWySAGf-2-TP6ICs-6z9Xpoi33l8UqUywg';
    public function consumerproductstored(Request $request)
    {
        // dd($request->all());
        $businesstype = businesstype::all();
        $businesskyc = businesskyc::all();
        $documentname = documentname::all();
        if($request->fullname==null && $request->firstname==null && $request->lastname==null 
        && $request->dob==null && $request->mobileno==null && $request->emailaddress==null &&
        $request->address==null && $request->city==null && $request->state==null && 
        $request->addressline3==null && $request->addressline2==null &&
        $request->addressline1==null && $request->rdogender==null &&
        $request->uploadimage==null && $request->uploadaudiovideo==null)
        {
                $message = "Please filled customer details";
                return view('consumer.consumer_product', compact('message','businesstype','businesskyc','documentname'));
        }
        $consumerid= " ";
        $validator = Validator::make($request -> all(),[
            'uploadimage' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'uploadaudiovideo' => 'mimes:mp4,mov,ogg,mp3|max:20000'
        ]);

        if($validator->fails()){
            $message = "Please filled all required fields";
            return view('consumer.consumer_product', compact('message','businesstype','businesskyc','documentname'));
            // return response()->json(['Error' => $validator->errors(),'statusCode' => '404']);
        }
        // dd($request->all());
        if($request->fullname!=null || $request->firstname!=null || $request->lastname!=null 
        || $request->dob!=null || $request->mobileno!=null || $request->emailaddress!=null ||
        $request->address!=null || $request->city!=null || $request->state==null ||
        $request->addressline3!=null || $request->addressline2!=null ||
        $request->addressline1!=null || $request->rdogender!=null ||
        $request->uploadimage!=null && $request->uploadaudiovideo!=null)
        {
            $consumer = new consumer();
            if($request->fullname==null )
             $consumer->firstname = "";
            else
            $consumer->firstname= $request->firstname;
            $consumer->lastname = $request->lastname;
            $consumer->fullname = $request->fullname;
            $consumer->emailaddress = $request->emailaddress;
            $consumer->dob = $request->dob;
            $consumer->mobileno = $request->mobileno;
            $consumer->address = $request->address;
            $consumer->consumerheading = $request->consumerhd;
            $consumer->city = $request->city;
            $consumer->state = $request->state;
            $consumer->addressline3 = $request->addressline3;
            $consumer->addressline2 = $request->addressline2;
            $consumer->addressline1 = $request->addressline1;
            $consumer->gender = $request->rdogender;
            if($request->uploadimage!=null)
            {
                $file = $request->file('uploadimage');
                $file_name = "consumer" . time() . '_consumer' .  "." . $file->getClientOriginalExtension();
                $file->move(public_path('document/consumer/image'), $file_name);
                $consumer->consumerimage =  $file_name;
            }
            else
            {
                $consumer->consumerimage = $request->uploadimage;
            }
            if($request->uploadaudiovideo!=null)
            {
                $file = $request->file('uploadaudiovideo');
                $file_name = "consumeraudio" . time() . '_consumer' .  "." . $file->getClientOriginalExtension();
                $file->move(public_path('document/consumer/audiovideo'), $file_name);
                $consumer->audiovideo =  $file_name;
            }
            else
            {
                $consumer->audiovideo = $request->uploadaudiovideo;
            }
            $consumer->save();
            $consumerid = $consumer->id;
            $request->session()->put('consumerid',$consumerid);
            // echo $consumer->id;
            // exit(1);
            if($request->businesstypeid!=0 || $request->businesskycid!=0 
            || $request->businessname!=null || $request->businessaddress!=null
            || $request->uploadeddocument!=null)
             {
                 $business= new business();
                 $business->businesskycid = $request->businesskycid;
                 $business->businessname =  $request->businessname;
                 $business->businessaddress = $request->businessaddress;
                 $business->businesstypeid = $request->businesstypeid;
                 $business->customerid =  $consumerid;
                 $business->businessheading = $request->businesshd;
                 if($request->uploadeddocument!=null)
                 {
                    $file = $request->file('uploadeddocument');
                    $file_name = $business->businessname . time() . '_business' .  "." . $file->getClientOriginalExtension();
                    $file->move(public_path('document/business'), $file_name);
                    $business->uploaddocument =  $file_name;
                 }
                 else
                 {
                    $business->uploaddocument =  $request->uploadeddocument;
                 }
                 
                 $business->save();
                //  echo $business->id;
                //  exit(1);

             } /* end of business if */
             if($request->uploadfile!=null || $request->uploadeddocumentname!=0
             || $request->pannumber!=null || $request->aadhaarnumber!=null)
             {
                    $requireddetails = new requireddetails();
                    $requireddetails->documentdetailsid = $request->uploadeddocumentname;
                    $requireddetails->pannumber = $request->pannumber;
                    $requireddetails->aadhaarnumber = $request->aadhaarnumber;
                    $requireddetails->requireddetailsheading = $request->requireddetailshd;
                    $requireddetails->customerid = $consumerid;
                    if( $request->uploadfile!=null)
                    {
                        $file = $request->file('uploadfile');
                        $file_name = $requireddetails->uploadeddocumentname . time() . '_requireddetails' .  "." . $file->getClientOriginalExtension();
                        $file->move(public_path('document/requireddetails'), $file_name);
                        $requireddetails->uploadfile = $file_name;
                    }
                    else
                    {
                        $requireddetails->uploadfile = $request->uploadfile;
                    }
                    $requireddetails->save();
                    // echo $requireddetails->id;
                    // exit(1);

             } /*end of if of other details */
             if(sizeof($request->score)!=1)
            {
                $data = [];
                $datas = [];
                for($i=0;$i<sizeof($request->score);$i++)
                {
                    for($j=0;$j<sizeof($request->loanamount);$j++)
                    {
                        if($i==$j)
                        {
                            // echo $consumerid;
                            // exit(1);
                           
                            $rulesdefined = new rulesdefined();
                            $rulesdefined->score= $request->score[$i]['score'];
                            $rulesdefined->loanamount= $request->loanamount[$i]['loanamount'];
                            $rulesdefined->rulesdefinedheading = $request->rulesdefinedhd;
                            $rulesdefined->customerid =  $consumerid;
                            $rulesdefined->save();
                            // rulesdefined::create([
                            //     'score' => $request->score[$i]['score'],
                            //     'loanamount' => $request->loanamount[$i]['loanamount'],
                            //     'rulesdefinedheading' => $request->requireddetailshd,
                            //     'customerid'=> $consumerid
                            // ]);
                        }
                    }
                }
            } /* end of rules defined */
            if($request->termscondition!=null || $request->selectapi!="0" || 
                $request->crifapiscore!=null || $request->loansactioned!=null)
            {
                $termscondition = new termscondition();
                $termscondition->customerid = $consumerid;
                $termscondition->termscondition = $request->termscondition;
                $termscondition->crifapiscore = $request->crifapiscore;
                $termscondition->loansactioned = $request->loansactioned;
                $termscondition->termsconditionheading = $request->termsconditionhd;
                if($request->selectapi!="Choose API")
                {
                    $termscondition->apiname =  $request->selectapi;
                }
                $termscondition->apiname=null;
                $termscondition->save();

            } /* end of terms and condition */
            if($request->congmsg!=null || $request->uploadcongfile!=null)
            {
                $congratulations = new congratulations();
                $congratulations->customerid = $consumerid;
                $congratulations->message = $request->congmsg;
                if($request->uploadcongfile!=null)
                {
                    $file = $request->file('uploadcongfile');
                    $file_name = "congratulations" . time() . '_congratulations' .  "." . $file->getClientOriginalExtension();
                    $file->move(public_path('document/congratulations'), $file_name);
                    $congratulations->uploadcongfile = $file_name;
                }
                else
                {
                    $congratulations->uploadcongfile=$request->uploadcongfile;
                }
                $congratulations->congratulationsheading = $request->congratulationshd;
                $congratulations->save();
               
            } /* end of congratulations */
            if($request->agreementupload!=null || $request->agreemnet!=null)
            {
                $agreementpolicy = new agreementpolicy();
                $agreementpolicy->customerid = $consumerid;
                $agreementpolicy->agreement = $request->agreemnet;
                if($request->agreementupload!=null)
                {
                    $file = $request->file('agreementupload');
                    $file_name = "agreement" . time() . '_agreement' .  "." . $file->getClientOriginalExtension();
                    $file->move(public_path('document/agreement'), $file_name);
                    $agreementpolicy->agreementupload = $file_name;
                }
                else
                {
                    $agreementpolicy->agreementupload=$request->agreementupload;
                }
                $agreementpolicy->agreementheading = $request->agreementhd;
                $agreementpolicy->save();
            } /*  end of agreement if*/
            if($request->bankname!=null || $request->accountnumber!=null ||
             $request->accounttype!="0" || $request->ifsccode!=null)
            {
                $bankdetails = new bankdetails();
                $bankdetails->customerid = $consumerid;
                $bankdetails->bankname = $request->bankname;
                $bankdetails->accountnumber = $request->accountnumber;
                // if($request->accounttype==0)
                // {
                //     $bankdetails->accounttype=null;
                // }
                // else
                // {
                    $bankdetails->accounttype= $request->accounttype;
                // }
                $bankdetails->ifsccode=$request->ifsccode;
                $bankdetails->bankdetailsheading = $request->bankdetailshd;
                $bankdetails->save();
               
            } /* end of auto debit if */
            if($request->linkname!=null)
            {   
                $link = new link();
                $link->customerid = $consumerid;
                $link->linkname = $request->linkname;
                $link->linkheading = $request->linkhd;
                $link->save();
            } /* end of link if */
            $link = 'https://localhost/projects/regtechapi/linksend/'.$request->session()->get('consumerid');
            $data = array('link'=>$link);
  
            Mail::send('consumer.mailtemplate', $data, function($message) use ($request) {
                $message->to('asifkaushar@gmail.com', 'docboyz.in');
                $message->from('asifkaushar@gmail.com','docboyz.in');
             });
             return redirect('/');
        } /*  end of main if */
       
      
            // dd($request->all());
    }
    public function index(Request $request)
    {
        $businesstype = businesstype::all();
        $businesskyc = businesskyc::all();
        $documentname = documentname::all();
    //    echo $businesstype[0]['id'];
    //    exit(1);
        return view('consumer.consumer_product', compact('businesstype','businesskyc','documentname'));
      
    }
    public function businesstype(Request $request)
    {
        $businesstype = new businesstype();
        $businesstype->businesstype = $request->businesstype;
        $businesstype -> save();
        return response()->json($businesstype->id);
    }
    public function businesskyc(Request $request)
    {
        $businesskyc = new businesskyc();
        $businesskyc->businesskyc = $request->businesskyc;
        $businesskyc->save();
        return response()->json($businesskyc->id);
    }
    public function documentname(Request $request)
    {
        $documentname = new documentname();
        $documentname->	documentname = $request->documentname;
        $documentname->save();
        return response()->json($documentname->id);
    }   
    public function equifax(Request $request)
    {
        $otp = mt_rand(100000,999999);
        //$status = $this->sendOtp($request->phone_number,$otp);
        // print_r($request->all());
        $body =  [
            'FirstName' => $request->fname,
            'LastName' => $request->lname,
            'ContactNo' => $request->phone_number,
            'IDValue' => $request->id_value
        ];
        $client = new Client();
        try{
            $response = $client -> post($this -> equifax_url,[
                'json' => $body
            ]);
            $equifax = json_decode($response -> getBody(),true);
            return response()->json($equifax);
        }
        catch(BadResponseException $e)
        {
            $statusCode = $e -> getResponse() -> getStatusCode();
        }
    }
    public function pancardvalidation(Request $request)
    {
        $client = new Client();
        $headers = [
            'accesstoken' => "926d84fdc9f41838681df794e098654f76",        
            'Content-Type'        => 'application/json',
        ];
        $body =  [
            'pan_number' => $request->pan_number
        ];
        try{
            $res = $client->post('http://regtechapi.in/api/pancard', ['headers' => $headers, 'json' => $body]);
            $pancard= json_decode($res->getBody(), true);
            //dd($pancard2);
            // echo "<pre>";
            // print_r($pancard2);
            // echo "</pre>";
            // exit();
            $request->session()->put('statusforpanvalidation',$pancard[0]['statusCode']);
            if($pancard[0]['statusCode']==200)
            return response()->json($pancard);
            } catch(BadResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
             return response()->json($statusCode);
        }
    }
    public function aadhaarvalidation(Request $request)
    {
        $client = new Client();
        $headers = [
            'accesstoken' => "926d84fdc9f41838681df794e098654f76",        
            'Content-Type'        => 'application/json',
        ];
        $body =  [
            'aadhaar_number' => $request->aadhaar_number
        ];
        try{
            $res = $client->post('http://regtechapi.in/api/aadhaar_validation', ['headers' => $headers, 'json' => $body]);
            $aadhaar= json_decode($res->getBody(), true);
            $request->session()->put('statusforaadhaarvalidation',$aadhaar[0]['statusCode']);
            if($aadhaar[0]['statusCode']==200)
            return response()->json($aadhaar);
        }catch(BadResponseException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            return response()->json($statusCode);
        }
    }
    public function esigninitialized(Request $request)
    {
        $client = new Client();
        $headers = [
            'Authorization' => $this->sandbox_token,        
            'Accept'        => 'application/json',
        ];

        $body =  [
            "pdf_pre_uploaded"=> true,
            "file" =>"https://en.unesco.org/inclusivepolicylab/sites/default/files/dummy-pdf_2.pdf",
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
        try{
            $res = $client->post($this->sandbox_url.'/esign/initialize', ['headers' => $headers, 'json' => $body]);
            $esign = json_decode($res->getBody(), true);
            // $client_id = $esign['data']['client_id'];
            // $clients = [
            //     "client_id" => $client_id
            // ];
        
            // $res1 = $client->post($this->sandbox_url.'esign/get-upload-link',['headers' => $headers,'json' =>$clients]);
            // $esigns = json_decode($res1->getBody(), true);
            return response()->json($esign);
        } catch(BadResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
        }
    }
}
