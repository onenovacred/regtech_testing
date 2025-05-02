<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use DB;
use App\Models\EquifaxScoreApi;

class LiveEquifaxController extends Controller
{
    //
        public function __construct()
    {
        $this -> middleware('auth');
    }

    public function idtypes(){
        // ['name'=>'Aadhar Card', 'value'=> 'M'], ['name'=>'Driving Licence', 'value'=>'DL'], ['name'=>'Passport', 'value'=>'P']
        $idtypes = array(['name'=>'PAN Card', 'value'=> 'T'], ['name'=>'Voter ID', 'value'=>'V']);
        return response()->json($idtypes);
    }

    
    private $equifax_url = "https://ists.equifax.co.in/cir360service/cir360report";
  //  private $regtech_url = "http://regtechapi.in/api/ecredit";
    private   $regtech_url = "http://regtechapi.in/api/ecredit";
    // private $equifax_url = "https://bo6dqokjja.execute-api.ap-south-1.amazonaws.com/equifax/score";

    // private $equifax_token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2NjAxMTEyMTN9.d6TecpM6LWgp91bjAjYQvUCdtjSxTX4RDEnY_Qc3lgc";
        
    public function equifaxold(Request $request){
        $sql = DB::table('equifax_pdf_request')->insert([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'contactNo'=> $request->phone_number,
            'idValue'=> $request->id_value,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        
        $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
        // dd('testing now');
        $statusCode = null;
        // $equifax = null;
        $aadhar_num = $request->aadhar_num ? $request->aadhar_num : null;
        $pan_num = $request->pan_num ? $request->pan_num : null;
        $voter_id = $request->voter_num ? $request->voter_num : null;
        $passport = $request->passport_num ? $request->passport_num : null;
        $driving_licence = $request->driving_num ? $request->driving_num : null;

        $hit_limits_exceeded = 0;

        if($request -> isMethod('GET'))     
            return view('kyc.equifax',compact('statusCode','hit_limits_exceeded'));
        
        if($request -> isMethod('POST'))
        {
            $otp = mt_rand(100000,999999);
            //$status = $this->sendOtp($request->phone_number,$otp);
            

        //     $body = ["RequestHeader"=> [ 
        //     "CustomerId" => "7774",
        //     // "UserId"=> "STS_ZPCRLT",
        //     "Password" => "W3#QeicsBA",
        //     "MemberNumber" => "027FP28674",
        //     "SecurityCode" => "6PP",
        //     "ProductCode" => [
        //         "PCRLT"
        //     ],
        //     "CustRefField" => "DB/".Auth::user() -> id
        //     ],

        //     "RequestBody" => [    
        //     "InquiryPurpose" => "00",
        //     "FirstName" => $request -> fname,
        //     "MiddleName" => "",
        //     // "LastName" => $request -> lname,
        //     "InquiryPhones" => [
        //         [
        //             "seq" => "1",
        //             "Number" => $request -> phone_number,
        //         "PhoneType" => [
        //             "M"
        //             ]
        //         ]
        //     ],
        //     "IDDetails" => [
        //         [
        //                         "seq" => "1",
        //                         "IDValue" => $request -> id_value,
        //                         "IDType" => "T",
        //                         "Source" => "Inquiry"
        //         ]
        //     ]
        // ],

        // "Score" => [
        //         [
        //             "Type" => "ERS",
        //             "Version" => "3.1"
        //         ]
        //     ]
        // ];
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
        $body =
            [
                "RequestHeader"=> [
                    "CustomerId"=>"7656",
                    "UserId"=>"STS_LOANTA",
                    "Password"=>"W3#QeicsB",
                    "MemberNumber"=>"027FP27964",
                    "SecurityCode"=>"6IT",
                    "ProductCode"=> [
                        "PCRLT"
                    ],
                    "CustRefField" => $CustRefField
                ],
                "RequestBody"=>[
                    "InquiryPurpose"=>"16",
                    "FirstName"=>$request->fname,
                    "MiddleName"=>"",
                    "LastName"=>$request->lname,
                    "DOB"=>$request->dob,
                    "InquiryPhones"=>[
                        [
                            "seq"=>"1",
                            "Number"=>$request->phone_number,
                            "PhoneType"=>[
                                "M"
                            ]
                        ]
                    ],
                    "IDDetails"=>[
                        [
                            "seq"=>"1",
                            "IDType"=>"t",
                            "IDValue"=>$request->pan_num,
                            "Source"=> "Inquiry"
                        ]
                    ]
                ],
                "Score"=>[
                    [
                        "Type"=>"ERS",
                        "Version"=>"3.1"
                    ]
                ]
            ];

            $client = new Client();

            
            try{
                $response = $client -> post($this -> equifax_url,[
                    'json' => $body
                ]);
                $data = $request->all();
                // $responses = (new ApiController2)->equifaxurl($data);
                //  print_r(json_decode($response -> getBody(),true));
                $equifax = json_decode($response -> getBody(),true);
               // dd($equifax);

                if(!empty($equifax))
                {
                    $myarray = array();


                    if($equifax['CCRResponse']['Status'] == "0")
                        return view('kyc.equifax',compact('equifax'));

                    // foreach($equifax['CCRResponse']['CIRReportDataLst'] as $emptykey =>  $emptyvalue)
                    // if($equifax['CCRResponse']['Status'] == "0" && $emptyvalue['Error']['ErrorCode'] == "00")
                    //     return view('kyc.equifax',compact('equifax'));

                        
                    

                    foreach($equifax['CCRResponse']['CIRReportDataLst'] as $key => $value)
                    {
                        if(array_key_exists("Error",$value)){  
                            $isFound = 0;
                            return view('kyc.equifax',compact('equifax','isFound'));
                        }

                        
                        if(isset($value['InquiryResponseHeader']['ReportOrderNO']))
                            $orderNo = $value['InquiryResponseHeader']['ReportOrderNO'];
                        else
                            $orderNo = "";
                        
                        if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                            ['Name']['FullName']))
                            $consumerName = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['Name']['FullName'];
                        else
                            $consumerName = "";

                        if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                            ['DateOfBirth']))
                            $DOB = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                            ['DateOfBirth'];
                        else
                            $DOB = "";
                            
                        if(isset($value['InquiryResponseHeader']['Date']))
                            $date = $value['InquiryResponseHeader']['Date'];
                        else
                            $date = "";
                        
                        if(isset($value['InquiryResponseHeader']['Time']))
                            $time = $value['InquiryResponseHeader']['Time'];
                        else
                            $time = "";

                        if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                            ['Age']['Age']))
                            $age = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['Age']['Age'];
                        else
                            $age = "";

                        if($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'])
                            $gender = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'];
                        else
                            $gender = "";

                        if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['PANId'])){
                            foreach($value['CIRReportData']['IDAndContactInfo']
                            ['IdentityInfo']['PANId'] as $key1 => $value1)
                                if(isset($value1['IdNumber']))
                                    $PAN = $value1['IdNumber'];
                                else
                                    $PAN = "";
                        }else{
                            $PAN = "";
                        }

                        if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'])){
                            foreach($value['CIRReportData']['IDAndContactInfo']
                            ['IdentityInfo']['NationalIDCard'] as $key1 => $value1)
                                if(isset($value1['IdNumber']))
                                    $NationalIDCard = $value1['IdNumber'];
                                else
                                    $NationalIDCard = "";
                        }else{
                            $NationalIDCard = "";
                        }

                        if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'])){
                            foreach($value['CIRReportData']['IDAndContactInfo']
                            ['IdentityInfo']['VoterID'] as $key1 => $value1)
                                if(isset($value1['IdNumber']))
                                    $VoterID = $value1['IdNumber'];
                                else
                                    $VoterID = "";  
                        }else{
                            $VoterID = "";
                        }                                
                        // foreach($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
                        //     if(isset($value1['IdNumber']))
                        //         $VoterID = $value1['IdNumber'];
                        //     else
                        //         $VoterID = "";          

                        foreach($value['InquiryRequestInfo']['InquiryPhones'] as $key2 => $value2)
                            if(isset($value2['Number']))
                                $Number = $value2['Number'];
                            else
                                $Number = "";

                        if(isset($value['CIRReportData']['IDAndContactInfo']['AddressInfo']))
                            $consumer_address = $value['CIRReportData']['IDAndContactInfo']['AddressInfo'];
                        else
                            $consumer_address = "";

                        $score_array = $value['CIRReportData']['ScoreDetails'];
                        if(count($score_array) > 0){
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
                        }else{
                            $score_details = [];
                        }
                        
                        if(isset($value['CIRReportData']['RecentActivities']))
                            $enquiry_summary = $value['CIRReportData']['RecentActivities'];
                        else
                            $enquiry_summary = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts']))
                            $numberofAccounts = $value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts'];
                        else
                            $numberofAccounts = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalBalanceAmount']))
                            $TotalBalanceAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalBalanceAmount'];
                        else
                            $TotalBalanceAmount = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalPastDue']))
                            $TotalPastAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalPastDue'];
                        else
                            $TotalPastAmount = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['RecentAccount']))
                            $recent_account = $value['CIRReportData']['RetailAccountsSummary']
                                ['RecentAccount'];
                        else
                            $recent_account = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                                                    ['OldestAccount']))
                            $oldest_account = $value['CIRReportData']['RetailAccountsSummary']
                                ['OldestAccount'];
                        else
                            $oldest_account = "";

                        
                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['NoOfActiveAccounts']))
                            $numberOfOpenAccount = $value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfActiveAccounts'];
                        else
                            $numberOfOpenAccount = "";

                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['NoOfPastDueAccounts']))
                            $numberOfPastDueAccount = $value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfPastDueAccounts'];
                        else
                            $numberOfPastDueAccount = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalHighCredit']))
                            $TotalHighCredit = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalHighCredit'];
                        else
                            $TotalHighCredit = "";



                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalCreditLimit']))         
                            $TotalCreditLimit = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalCreditLimit'];
                        else
                            $TotalCreditLimit = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['NoOfWriteOffs']))
                            $NoOfWriteOffs = $value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfWriteOffs'];
                        else
                            $NoOfWriteOffs = "";



                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalSanctionAmount']))
                            $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalSanctionAmount'];
                        else
                            $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalSanctionAmount'];



                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['SingleHighestCredit']))
                            $SingleHighestCredit = $value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestCredit'];
                        else
                            $SingleHighestCredit = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['NoOfZeroBalanceAccounts']))
                            $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts'];
                        else
                            $NoOfZeroBalanceAccounts = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['TotalMonthlyPaymentAmount']))
                            $TotalMonthlyPaymentAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['TotalMonthlyPaymentAmount'];
                        else
                            $TotalMonthlyPaymentAmount = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['NoOfZeroBalanceAccounts']))
                            $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts'];
                        else
                            $NoOfZeroBalanceAccounts = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['SingleHighestBalance']))
                            $SingleHighestBalance = $value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestBalance'];
                        else
                            $SingleHighestBalance = "";


                        if(isset($value['CIRReportData']['RetailAccountsSummary']
                            ['SingleHighestSanctionAmount']))
                            $SingleHighestSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestSanctionAmount'];
                        else
                            $SingleHighestSanctionAmount = "";

        
                        
                        //RETAIL ACCOUNT DETAILS

                        $RetailAccountDetails = $value['CIRReportData']['RetailAccountDetails'];

                        //Enquiries
                        
                        if(isset($value['CIRReportData']['Enquiries'])){
                            $enquiries = $value['CIRReportData']['Enquiries'];
                        }else{
                            $enquiries = "";
                        }

                        //Enquiry Summary
                        if(isset($value['CIRReportData']['EnquirySummary']['Purpose']))
                            $Purpose = $value['CIRReportData']['EnquirySummary']['Purpose'];
                        else
                            $Purpose = "";


                        if(isset($value['CIRReportData']['EnquirySummary']['Total']))
                            $Total = $value['CIRReportData']['EnquirySummary']['Total'];
                        else
                            $Total = "";

                        
                        if(isset($value['CIRReportData']['EnquirySummary']['Past30Days']))
                            $Past30Days = $value['CIRReportData']['EnquirySummary']['Past30Days'];
                        else
                            $Past30Days= "";

                        


                        if(isset($value['CIRReportData']['EnquirySummary']['Past12Months']))
                            $Past12Months = $value['CIRReportData']['EnquirySummary']['Past12Months'];
                        else
                            $Past12Months = "";

                        
                        if(isset($value['CIRReportData']['EnquirySummary']['Past24Months']))
                            $Past24Months = $value['CIRReportData']['EnquirySummary']['Past24Months'];
                        else
                            $Past24Months = "";

                        
                        if(isset($value['CIRReportData']['EnquirySummary']['Recent']))
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
                    

                    $pdf = PDF::loadView('kyc.equifaxreportpdf',compact('myarray','equifax'))->setPaper('A4');
                    return $pdf->stream('invoice.pdf');
                }

                return view('kyc.equifax',compact('statusCode','equifax'));

            }catch(BadResponseException $e)
            {
                $statusCode = $e -> getResponse() -> getStatusCode();
            }

            return view('kyc.equifax',compact('statusCode','equifax','hit_limits_exceeded'));
        }
    }

    public function equifax(Request $request){
        // return 'test';
        $sql = DB::table('equifax_pdf_request')->insert([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'contactNo'=> $request->phone_number,
            'idValue'=> $request->id_value,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        
        $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
        // dd('testing now');
        $statusCode = null;
        // $equifax = null;
        $aadhar_num = $request->aadhar_num ? $request->aadhar_num : null;
        $pan_num = $request->pan_num ? $request->pan_num : null;
        $voter_id = $request->voter_num ? $request->voter_num : null;
        $passport = $request->passport_num ? $request->passport_num : null;
        $driving_licence = $request->driving_num ? $request->driving_num : null;

        $hit_limits_exceeded = 0;

        if($request -> isMethod('GET'))     
            return view('kyc.equifax',compact('statusCode','hit_limits_exceeded'));
        
        if($request -> isMethod('POST'))
        {
            $otp = mt_rand(100000,999999);
            //$status = $this->sendOtp($request->phone_number,$otp);
            

        //     $body = ["RequestHeader"=> [ 
        //     "CustomerId" => "7774",
        //     // "UserId"=> "STS_ZPCRLT",
        //     "Password" => "W3#QeicsBA",
        //     "MemberNumber" => "027FP28674",
        //     "SecurityCode" => "6PP",
        //     "ProductCode" => [
        //         "PCRLT"
        //     ],
        //     "CustRefField" => "DB/".Auth::user() -> id
        //     ],

        //     "RequestBody" => [    
        //     "InquiryPurpose" => "00",
        //     "FirstName" => $request -> fname,
        //     "MiddleName" => "",
        //     // "LastName" => $request -> lname,
        //     "InquiryPhones" => [
        //         [
        //             "seq" => "1",
        //             "Number" => $request -> phone_number,
        //         "PhoneType" => [
        //             "M"
        //             ]
        //         ]
        //     ],
        //     "IDDetails" => [
        //         [
        //                         "seq" => "1",
        //                         "IDValue" => $request -> id_value,
        //                         "IDType" => "T",
        //                         "Source" => "Inquiry"
        //         ]
        //     ]
        // ],

        // "Score" => [
        //         [
        //             "Type" => "ERS",
        //             "Version" => "3.1"
        //         ]
        //     ]
        // ];
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
        $accessToken = Auth::user()->access_token;
                
        $headers = [
        'AccessToken' => $accessToken,
        ];
        // $body =
        //     [
        //         "RequestHeader"=> [
        //             "CustomerId"=>"7656",
        //             "UserId"=>"STS_LOANTA",
        //             "Password"=>"W3#QeicsB",
        //             "MemberNumber"=>"027FP27964",
        //             "SecurityCode"=>"6IT",
        //             "ProductCode"=> [
        //                 "PCRLT"
        //             ],
        //             "CustRefField" => $CustRefField
        //         ],
        //         "RequestBody"=>[
        //             "InquiryPurpose"=>"16",
        //             "FirstName"=>$request->fname,
        //             "MiddleName"=>"",
        //             "LastName"=>$request->lname,
        //             "DOB"=>$request->dob,
        //             "InquiryPhones"=>[
        //                 [
        //                     "seq"=>"1",
        //                     "Number"=>$request->phone_number,
        //                     "PhoneType"=>[
        //                         "M"
        //                     ]
        //                 ]
        //             ],
        //             "IDDetails"=>[
        //                 [
        //                     "seq"=>"1",
        //                     "IDType"=>"t",
        //                     "IDValue"=>$request->pan_num,
        //                     "Source"=> "Inquiry"
        //                 ]
        //             ]
        //         ],
        //         "Score"=>[
        //             [
        //                 "Type"=>"ERS",
        //                 "Version"=>"3.1"
        //             ]
        //         ]
        //     ];

        $body =  [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'pan_num' => $request->pan_num
            ];

            $client = new Client();

            
            try{
                $response = $client -> post($this->regtech_url,[
                    'headers' => $headers,'json' => $body
                ]);
                $data = $request->all();
                dd($data);
                // $responses = (new ApiController2)->equifaxurl($data);
                //  print_r(json_decode($response -> getBody(),true));
                $equifaxdetails = json_decode($response -> getBody(),true);
                if($equifaxdetails['statusCode'] != 102)
                {
                    $equifax = $equifaxdetails['Equifax_Report'];
                    // return $equifax;
                    // print_r($equifax);

                    if(!empty($equifax))
                    {
                        $myarray = array();


                        if($equifax['CCRResponse']['Status'] == "0")
                            return view('kyc.equifax',compact('equifax'));

                        // foreach($equifax['CCRResponse']['CIRReportDataLst'] as $emptykey =>  $emptyvalue)
                        // if($equifax['CCRResponse']['Status'] == "0" && $emptyvalue['Error']['ErrorCode'] == "00")
                        //     return view('kyc.equifax',compact('equifax'));

                            
                        

                        foreach($equifax['CCRResponse']['CIRReportDataLst'] as $key => $value)
                        {
                            if(array_key_exists("Error",$value)){  
                                $isFound = 0;
                                return view('kyc.equifax',compact('equifax','isFound'));
                            }

                            
                            if(isset($value['InquiryResponseHeader']['ReportOrderNO']))
                                $orderNo = $value['InquiryResponseHeader']['ReportOrderNO'];
                            else
                                $orderNo = "";
                            
                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['Name']['FullName']))
                                $consumerName = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Name']['FullName'];
                            else
                                $consumerName = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['DateOfBirth']))
                                $DOB = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['DateOfBirth'];
                            else
                                $DOB = "";
                                
                            if(isset($value['InquiryResponseHeader']['Date']))
                                $date = $value['InquiryResponseHeader']['Date'];
                            else
                                $date = "";
                            
                            if(isset($value['InquiryResponseHeader']['Time']))
                                $time = $value['InquiryResponseHeader']['Time'];
                            else
                                $time = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['Age']['Age']))
                                $age = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Age']['Age'];
                            else
                                $age = "";

                            if($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'])
                                $gender = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'];
                            else
                                $gender = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['PANId'])){
                                foreach($value['CIRReportData']['IDAndContactInfo']
                                ['IdentityInfo']['PANId'] as $key1 => $value1)
                                    if(isset($value1['IdNumber']))
                                        $PAN = $value1['IdNumber'];
                                    else
                                        $PAN = "";
                            }else{
                                $PAN = "";
                            }

                            if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'])){
                                foreach($value['CIRReportData']['IDAndContactInfo']
                                ['IdentityInfo']['NationalIDCard'] as $key1 => $value1)
                                    if(isset($value1['IdNumber']))
                                        $NationalIDCard = $value1['IdNumber'];
                                    else
                                        $NationalIDCard = "";
                            }else{
                                $NationalIDCard = "";
                            }

                            if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'])){
                                foreach($value['CIRReportData']['IDAndContactInfo']
                                ['IdentityInfo']['VoterID'] as $key1 => $value1)
                                    if(isset($value1['IdNumber']))
                                        $VoterID = $value1['IdNumber'];
                                    else
                                        $VoterID = "";  
                            }else{
                                $VoterID = "";
                            }                                
                            // foreach($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
                            //     if(isset($value1['IdNumber']))
                            //         $VoterID = $value1['IdNumber'];
                            //     else
                            //         $VoterID = "";          

                            foreach($value['InquiryRequestInfo']['InquiryPhones'] as $key2 => $value2)
                                if(isset($value2['Number']))
                                    $Number = $value2['Number'];
                                else
                                    $Number = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['AddressInfo']))
                                $consumer_address = $value['CIRReportData']['IDAndContactInfo']['AddressInfo'];
                            else
                                $consumer_address = "";

                            $score_array = $value['CIRReportData']['ScoreDetails'];
                            if(count($score_array) > 0){
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
                            }else{
                                $score_details = [];
                            }
                            
                            if(isset($value['CIRReportData']['RecentActivities']))
                                $enquiry_summary = $value['CIRReportData']['RecentActivities'];
                            else
                                $enquiry_summary = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts']))
                                $numberofAccounts = $value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts'];
                            else
                                $numberofAccounts = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalBalanceAmount']))
                                $TotalBalanceAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalBalanceAmount'];
                            else
                                $TotalBalanceAmount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalPastDue']))
                                $TotalPastAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalPastDue'];
                            else
                                $TotalPastAmount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['RecentAccount']))
                                $recent_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['RecentAccount'];
                            else
                                $recent_account = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                                        ['OldestAccount']))
                                $oldest_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['OldestAccount'];
                            else
                                $oldest_account = "";

                            
                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfActiveAccounts']))
                                $numberOfOpenAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfActiveAccounts'];
                            else
                                $numberOfOpenAccount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfPastDueAccounts']))
                                $numberOfPastDueAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfPastDueAccounts'];
                            else
                                $numberOfPastDueAccount = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalHighCredit']))
                                $TotalHighCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalHighCredit'];
                            else
                                $TotalHighCredit = "";



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalCreditLimit']))         
                                $TotalCreditLimit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalCreditLimit'];
                            else
                                $TotalCreditLimit = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfWriteOffs']))
                                $NoOfWriteOffs = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfWriteOffs'];
                            else
                                $NoOfWriteOffs = "";



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalSanctionAmount']))
                                $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];
                            else
                                $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestCredit']))
                                $SingleHighestCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestCredit'];
                            else
                                $SingleHighestCredit = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts']))
                                $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                            else
                                $NoOfZeroBalanceAccounts = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalMonthlyPaymentAmount']))
                                $TotalMonthlyPaymentAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalMonthlyPaymentAmount'];
                            else
                                $TotalMonthlyPaymentAmount = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts']))
                                $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                            else
                                $NoOfZeroBalanceAccounts = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestBalance']))
                                $SingleHighestBalance = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestBalance'];
                            else
                                $SingleHighestBalance = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestSanctionAmount']))
                                $SingleHighestSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestSanctionAmount'];
                            else
                                $SingleHighestSanctionAmount = "";

            
                            
                            //RETAIL ACCOUNT DETAILS

                            $RetailAccountDetails = $value['CIRReportData']['RetailAccountDetails'];

                            //Enquiries
                            
                            if(isset($value['CIRReportData']['Enquiries'])){
                                $enquiries = $value['CIRReportData']['Enquiries'];
                            }else{
                                $enquiries = "";
                            }

                            //Enquiry Summary
                            if(isset($value['CIRReportData']['EnquirySummary']['Purpose']))
                                $Purpose = $value['CIRReportData']['EnquirySummary']['Purpose'];
                            else
                                $Purpose = "";


                            if(isset($value['CIRReportData']['EnquirySummary']['Total']))
                                $Total = $value['CIRReportData']['EnquirySummary']['Total'];
                            else
                                $Total = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Past30Days']))
                                $Past30Days = $value['CIRReportData']['EnquirySummary']['Past30Days'];
                            else
                                $Past30Days= "";

                            


                            if(isset($value['CIRReportData']['EnquirySummary']['Past12Months']))
                                $Past12Months = $value['CIRReportData']['EnquirySummary']['Past12Months'];
                            else
                                $Past12Months = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Past24Months']))
                                $Past24Months = $value['CIRReportData']['EnquirySummary']['Past24Months'];
                            else
                                $Past24Months = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Recent']))
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

                        dd($myarray);
                        
                        // return $myarray;
                        // return view('kyc.equifaxreportpdf',compact('myarray','equifax'));
                        $pdf = PDF::loadView('kyc.equifaxreportpdf',compact('myarray','equifax'))->setPaper('A2');
                        return $pdf->stream('invoice.pdf');
                    }

                }
                $pan_num = $request->pan_num;
                dd($equifaxdetails);
                $pdf = PDF::loadView('kyc.equifaxreportpdferror',compact('equifaxdetails','pan_num'))->setPaper('A4');
                return $pdf->stream('invoice.pdf');
                // $statusCode = 102;
                // $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                // return view('kyc.equifax',compact('statusCode','errorMessage'));

            }catch(BadResponseException $e)
            {
                $statusCode = $e -> getResponse() -> getStatusCode();
            }
            // return $equifaxdetails;
            return view('kyc.equifax',compact('statusCode','equifax','hit_limits_exceeded'));
        }
    }

    public function equifax29Jun2024(Request $request){
        // return 'test';
        $sql = DB::table('equifax_pdf_request')->insert([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'contactNo'=> $request->phone_number,
            'idValue'=> $request->pan_num,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        
        $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
        // dd('testing now');
        $statusCode = null;
        // $equifax = null;
        $aadhar_num = $request->aadhar_num ? $request->aadhar_num : null;
        $pan_num = $request->pan_num ? $request->pan_num : null;
        $voter_id = $request->voter_num ? $request->voter_num : null;
        $passport = $request->passport_num ? $request->passport_num : null;
        $driving_licence = $request->driving_num ? $request->driving_num : null;

        $hit_limits_exceeded = 0;

        if($request -> isMethod('GET'))     
            return view('kyc.equifax',compact('statusCode','hit_limits_exceeded'));
        
        if($request -> isMethod('POST'))
        {
            $otp = mt_rand(100000,999999);
            //$status = $this->sendOtp($request->phone_number,$otp);
            

        //     $body = ["RequestHeader"=> [ 
        //     "CustomerId" => "7774",
        //     // "UserId"=> "STS_ZPCRLT",
        //     "Password" => "W3#QeicsBA",
        //     "MemberNumber" => "027FP28674",
        //     "SecurityCode" => "6PP",
        //     "ProductCode" => [
        //         "PCRLT"
        //     ],
        //     "CustRefField" => "DB/".Auth::user() -> id
        //     ],

        //     "RequestBody" => [    
        //     "InquiryPurpose" => "00",
        //     "FirstName" => $request -> fname,
        //     "MiddleName" => "",
        //     // "LastName" => $request -> lname,
        //     "InquiryPhones" => [
        //         [
        //             "seq" => "1",
        //             "Number" => $request -> phone_number,
        //         "PhoneType" => [
        //             "M"
        //             ]
        //         ]
        //     ],
        //     "IDDetails" => [
        //         [
        //                         "seq" => "1",
        //                         "IDValue" => $request -> id_value,
        //                         "IDType" => "T",
        //                         "Source" => "Inquiry"
        //         ]
        //     ]
        // ],

        // "Score" => [
        //         [
        //             "Type" => "ERS",
        //             "Version" => "3.1"
        //         ]
        //     ]
        // ];
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
        $accessToken = Auth::user()->access_token;
                
        $headers = [
        'AccessToken' => $accessToken,
        ];
        // $body =
        //     [
        //         "RequestHeader"=> [
        //             "CustomerId"=>"7656",
        //             "UserId"=>"STS_LOANTA",
        //             "Password"=>"W3#QeicsB",
        //             "MemberNumber"=>"027FP27964",
        //             "SecurityCode"=>"6IT",
        //             "ProductCode"=> [
        //                 "PCRLT"
        //             ],
        //             "CustRefField" => $CustRefField
        //         ],
        //         "RequestBody"=>[
        //             "InquiryPurpose"=>"16",
        //             "FirstName"=>$request->fname,
        //             "MiddleName"=>"",
        //             "LastName"=>$request->lname,
        //             "DOB"=>$request->dob,
        //             "InquiryPhones"=>[
        //                 [
        //                     "seq"=>"1",
        //                     "Number"=>$request->phone_number,
        //                     "PhoneType"=>[
        //                         "M"
        //                     ]
        //                 ]
        //             ],
        //             "IDDetails"=>[
        //                 [
        //                     "seq"=>"1",
        //                     "IDType"=>"t",
        //                     "IDValue"=>$request->pan_num,
        //                     "Source"=> "Inquiry"
        //                 ]
        //             ]
        //         ],
        //         "Score"=>[
        //             [
        //                 "Type"=>"ERS",
        //                 "Version"=>"3.1"
        //             ]
        //         ]
        //     ];

        $body =  [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'id_value' => $request->pan_num
            ];

            $client = new Client();

            
            try{
                $response = $client -> post($this->regtech_url,[
                    'headers' => $headers,'json' => $body
                ]);
                $data = $request->all();
                // $responses = (new ApiController2)->equifaxurl($data);
                //  print_r(json_decode($response -> getBody(),true));
                $equifaxdetails = json_decode($response -> getBody(),true);
               
                if($equifaxdetails['statusCode'] != 102)
                {
                    $equifax = $equifaxdetails['Equifax_Report'];
                    // return $equifax;
                    // print_r($equifax);

                    if(!empty($equifax))
                    {
                        $myarray = array();


                        if($equifax['CCRResponse']['Status'] == "0")
                            return view('kyc.equifax',compact('equifax'));

                        // foreach($equifax['CCRResponse']['CIRReportDataLst'] as $emptykey =>  $emptyvalue)
                        // if($equifax['CCRResponse']['Status'] == "0" && $emptyvalue['Error']['ErrorCode'] == "00")
                        //     return view('kyc.equifax',compact('equifax'));
                        foreach($equifax['CCRResponse']['CIRReportDataLst'] as $key => $value)
                        {
                            if(array_key_exists("Error",$value)){  
                                $isFound = 0;
                                return view('kyc.equifax',compact('equifax','isFound'));
                            }

                            
                            if(isset($value['InquiryResponseHeader']['ReportOrderNO']))
                                $orderNo = $value['InquiryResponseHeader']['ReportOrderNO'];
                            else
                                $orderNo = "";
                            
                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Name']['FullName']))
                                $consumerName = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Name']['FullName'];
                            else
                                $consumerName = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['DateOfBirth']))
                                $DOB = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['DateOfBirth'];
                            else
                                $DOB = "";
                                
                            if(isset($value['InquiryResponseHeader']['Date']))
                                $date = $value['InquiryResponseHeader']['Date'];
                            else
                                $date = "";
                            
                            if(isset($value['InquiryResponseHeader']['Time']))
                                $time = $value['InquiryResponseHeader']['Time'];
                            else
                                $time = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                ['Age']['Age']))
                                $age = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
                                    ['Age']['Age'];
                            else
                                $age = "";

                            if($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'])
                                $gender = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'];
                            else
                                $gender = "";

                            if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['PANId'])){
                                foreach($value['CIRReportData']['IDAndContactInfo']
                                ['IdentityInfo']['PANId'] as $key1 => $value1)
                                    if(isset($value1['IdNumber']))
                                        $PAN = $value1['IdNumber'];
                                    else
                                        $PAN = "";
                            }else{
                                $PAN = "";
                            }

                             if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'])){
                                 foreach($value['CIRReportData']['IDAndContactInfo']
                                 ['IdentityInfo']['NationalIDCard'] as $key1 => $value1)
                                    if(isset($value1['IdNumber']))
                                        $NationalIDCard = $value1['IdNumber'];
                                     else
                                         $NationalIDCard = "";
                             }else{
                               $NationalIDCard = "";
                             }
                             if(isset($value['CIRReportData']['IDAndContactInfo']['PhoneInfo'])){
                               $PhoneInfo = $value['CIRReportData']['IDAndContactInfo']['PhoneInfo'];
                            }else{
                                $PhoneInfo = "";
                            }
                            if(isset($value['CIRReportData']['IDAndContactInfo']['EmailAddressInfo'])){
                                $EmailInfo = $value['CIRReportData']['IDAndContactInfo']['EmailAddressInfo'];
                             }else{
                                 $EmailInfo = "";
                             }

                            // if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'])){
                            //     foreach($value['CIRReportData']['IDAndContactInfo']
                            //     ['IdentityInfo']['VoterID'] as $key1 => $value1)
                            //         if(isset($value1['IdNumber']))
                            //             $VoterID = $value1['IdNumber'];
                            //         else
                            //             $VoterID = "";  
                            // }else{
                            //     $VoterID = "";
                            // }                                
                            // foreach($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
                            //     if(isset($value1['IdNumber']))
                            //         $VoterID = $value1['IdNumber'];
                            //     else
                                  $VoterID = "";          
                            
                            //foreach($value['InquiryRequestInfo'] as $key2 => $value2)
                                // if(isset($value2['Number']))
                                //     $Number = $value2['Number'];
                                // else
                                    $Number = "";

                               if(isset($value['CIRReportData']['IDAndContactInfo']['AddressInfo']))
                                $consumer_address = $value['CIRReportData']['IDAndContactInfo']['AddressInfo'];
                                else
                                 $consumer_address = "";

                                 $score_array = $value['CIRReportData']['ScoreDetails'];
                               if(count($score_array) > 0){
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
                            }else{
                                $score_details = [];
                            }
                            
                            if(isset($value['CIRReportData']['RecentActivities']))
                                $enquiry_summary = $value['CIRReportData']['RecentActivities'];
                            else
                                $enquiry_summary = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts']))
                                $numberofAccounts = $value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts'];
                            else
                                $numberofAccounts = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalBalanceAmount']))
                                $TotalBalanceAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalBalanceAmount'];
                            else
                                $TotalBalanceAmount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalPastDue']))
                                $TotalPastAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalPastDue'];
                            else
                                $TotalPastAmount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['RecentAccount']))
                                $recent_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['RecentAccount'];
                            else
                                $recent_account = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                                        ['OldestAccount']))
                                $oldest_account = $value['CIRReportData']['RetailAccountsSummary']
                                    ['OldestAccount'];
                            else
                                $oldest_account = "";

                            
                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfActiveAccounts']))
                                $numberOfOpenAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfActiveAccounts'];
                            else
                                $numberOfOpenAccount = "";

                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfPastDueAccounts']))
                                $numberOfPastDueAccount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfPastDueAccounts'];
                            else
                                $numberOfPastDueAccount = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalHighCredit']))
                                $TotalHighCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalHighCredit'];
                            else
                                $TotalHighCredit = "";



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalCreditLimit']))         
                                $TotalCreditLimit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalCreditLimit'];
                            else
                                $TotalCreditLimit = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfWriteOffs']))
                                $NoOfWriteOffs = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfWriteOffs'];
                            else
                                $NoOfWriteOffs = "";



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalSanctionAmount']))
                                $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];
                            else
                                $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalSanctionAmount'];



                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestCredit']))
                                $SingleHighestCredit = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestCredit'];
                            else
                                $SingleHighestCredit = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts']))
                                $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                            else
                                $NoOfZeroBalanceAccounts = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['TotalMonthlyPaymentAmount']))
                                $TotalMonthlyPaymentAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['TotalMonthlyPaymentAmount'];
                            else
                                $TotalMonthlyPaymentAmount = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['NoOfZeroBalanceAccounts']))
                                $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
                                    ['NoOfZeroBalanceAccounts'];
                            else
                                $NoOfZeroBalanceAccounts = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestBalance']))
                                $SingleHighestBalance = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestBalance'];
                            else
                                $SingleHighestBalance = "";


                            if(isset($value['CIRReportData']['RetailAccountsSummary']
                                ['SingleHighestSanctionAmount']))
                                $SingleHighestSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
                                    ['SingleHighestSanctionAmount'];
                            else
                                $SingleHighestSanctionAmount = "";

            
                            
                            //RETAIL ACCOUNT DETAILS

                            $RetailAccountDetails = $value['CIRReportData']['RetailAccountDetails'];

                            //Enquiries
                            
                            if(isset($value['CIRReportData']['Enquiries'])){
                                $enquiries = $value['CIRReportData']['Enquiries'];
                            }else{
                                $enquiries = "";
                            }

                            //Enquiry Summary
                            if(isset($value['CIRReportData']['EnquirySummary']['Purpose']))
                                $Purpose = $value['CIRReportData']['EnquirySummary']['Purpose'];
                            else
                                $Purpose = "";


                            if(isset($value['CIRReportData']['EnquirySummary']['Total']))
                                $Total = $value['CIRReportData']['EnquirySummary']['Total'];
                            else
                                $Total = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Past30Days']))
                                $Past30Days = $value['CIRReportData']['EnquirySummary']['Past30Days'];
                            else
                                $Past30Days= "";

                            


                            if(isset($value['CIRReportData']['EnquirySummary']['Past12Months']))
                                $Past12Months = $value['CIRReportData']['EnquirySummary']['Past12Months'];
                            else
                                $Past12Months = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Past24Months']))
                                $Past24Months = $value['CIRReportData']['EnquirySummary']['Past24Months'];
                            else
                                $Past24Months = "";

                            
                            if(isset($value['CIRReportData']['EnquirySummary']['Recent']))
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
                            $myarray['PhoneInfo']=$PhoneInfo;
                            $myarray['EmailAddressInfo']=$EmailInfo;
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
                      //  return view('kyc.equifaxreportpdf',compact('myarray','equifax'));
                       $pdf = PDF::loadView('kyc.equifaxreportpdf',compact('myarray','equifax'))->setPaper([0, 0, 970.0, 970.8],'A4');
                       return $pdf->stream('invoice.pdf');
                            //return view('kyc.equifaxreportpdf',compact('myarray','equifax'));
                    }

                }
                $pan_num = $request->pan_num;
                $pdf = PDF::loadView('kyc.equifaxreportpdferror',compact('equifaxdetails','pan_num'))->setPaper('A4');
                return $pdf->stream('invoice.pdf');
                 
                // $statusCode = 102;
                // $errorMessage = 'Verification Failed. Please enter correct PAN Number.';
                // return view('kyc.equifax',compact('statusCode','errorMessage'));

            }catch(BadResponseException $e)
            {
                $statusCode = $e -> getResponse() -> getStatusCode();
            }
            // return $equifaxdetails;
            return view('kyc.equifax',compact('statusCode','equifax','hit_limits_exceeded'));
        }
    }

    // public function equifax(Request $request){
    //     // $sql = DB::table('equifax_pdf_request')->insert([
    //     //     'firstName' => $request->fname,
    //     //     'lastName' => $request->lname,
    //     //     'contactNo'=> $request->phone_number,
    //     //     'idValue'=> $request->id_value,
    //     //     'created_at'=>date('Y-m-d H:i:s')
    //     // ]);
        
    //     $record_id = DB::table('equifax_pdf_request')->orderBy('id', 'desc')->first();
    //     // dd('testing now');
    //     $statusCode = null;
    //     // $equifax = null;
    //     // $aadhar_num = $request->aadhar_num ? $request->aadhar_num : null;
    //     $pan_num = $request->pan_num ? $request->pan_num : null;
    //     $voter_id = $request->voter_num ? $request->voter_num : null;
    //     // $passport = $request->passport_num ? $request->passport_num : null;
    //     // $driving_licence = $request->driving_num ? $request->driving_num : null;

    //     $hit_limits_exceeded = 0;

    //     if($request -> isMethod('GET'))     
    //         return view('kyc.equifax',compact('statusCode','hit_limits_exceeded'));
        
    //     if($request -> isMethod('POST'))
    //     {
    //         $otp = mt_rand(100000,999999);
    //         //$status = $this->sendOtp($request->phone_number,$otp);
            

    //     //     $body = ["RequestHeader"=> [ 
    //     //     "CustomerId" => "7774",
    //     //     // "UserId"=> "STS_ZPCRLT",
    //     //     "Password" => "W3#QeicsBA",
    //     //     "MemberNumber" => "027FP28674",
    //     //     "SecurityCode" => "6PP",
    //     //     "ProductCode" => [
    //     //         "PCRLT"
    //     //     ],
    //     //     "CustRefField" => "DB/".Auth::user() -> id
    //     //     ],

    //     //     "RequestBody" => [    
    //     //     "InquiryPurpose" => "00",
    //     //     "FirstName" => $request -> fname,
    //     //     "MiddleName" => "",
    //     //     // "LastName" => $request -> lname,
    //     //     "InquiryPhones" => [
    //     //         [
    //     //             "seq" => "1",
    //     //             "Number" => $request -> phone_number,
    //     //         "PhoneType" => [
    //     //             "M"
    //     //             ]
    //     //         ]
    //     //     ],
    //     //     "IDDetails" => [
    //     //         [
    //     //                         "seq" => "1",
    //     //                         "IDValue" => $request -> id_value,
    //     //                         "IDType" => "T",
    //     //                         "Source" => "Inquiry"
    //     //         ]
    //     //     ]
    //     // ],

    //     // "Score" => [
    //     //         [
    //     //             "Type" => "ERS",
    //     //             "Version" => "3.1"
    //     //         ]
    //     //     ]
    //     // ];
    //     $uname = Auth::user()->name;
    //     // $uname = DB::table('users')->where('id', Auth::id())->get()->first();

    //     $arr = explode(' ', trim($uname));
    //     $user = '';
    //     $substr = '';
    //     foreach($arr as $array){
    //         $substr = substr($array, 0, 1);
    //         $user = $user.$substr;
    //     }
    //     $CustRefField = '';
    //     // $recordId = sprintf("%04d", $record_id->id);
    //     // $CustRefField = "DB-".strtoupper($user).Carbon::now()->format('y').Carbon::now()->format('m').$recordId;
    //     $body = [ 
    //         "InquiryPurpose"=> "10",
    //         "TransactionAmount"=> "100",
    //         "FirstName"=> $request->fname,
    //         "MiddleName"=> "",
    //         "LastName"=> $request->lname,
    //         // "CustRefField" => $CustRefField,
    //         "InquiryAddresses"=> [
    //             [
    //                 "seq"=> "1",
    //                 "AddressType"=> [
    //                     "H"
    //                 ],
    //                 "AddressLine1"=> "",
    //                 "AddressLine2"=> "",
    //                 "Locality"=> "",
    //                 "City"=> "",
    //                 "State"=> "MH",
    //                 "Postal"=> ""
    //             ]
    //         ],
    //         "IDDetails"=> [
    //             [
    //                 "seq"=> "1",
    //                 "IDType"=> "T",
    //                 "IDValue"=>  $pan_num
    //             ],
    //             [
    //                 "seq"=> "2",
    //                 "IDType"=> "V",
    //                 "IDValue"=> $voter_id
    //             ]
    //         ],
    //         "DOB"=> $request->dob,
    //         "CustomFields"=> [
    //             [
    //                 "key"=> "PCRLT_Custom_Logic",
    //                 "value"=> "Y"
    //             ]
    //         ]
    //     ];  

    //     $client = new Client();

        
    //     // try{
    //         $response = $client -> post($this -> equifax_url,[
    //             'headers' => ['Authorization' => $this -> equifax_token],
    //             'json' => $body,
    //         ]);
    //         $data = $request->all();
    //         // $responses = (new ApiController2)->equifaxurl($data);
    //         //  print_r(json_decode($response -> getBody(),true));
    //         $equifax = json_decode($response -> getBody(),true);
    //         // dd($equifax);
    //         // print_r($equifax);

    //         if(!empty($equifax))
    //         {
    //             $myarray = array();


    //             if($equifax['CCRResponse']['Status'] == "0")
    //                 return view('kyc.equifax',compact('equifax'));

    //             // foreach($equifax['CCRResponse']['CIRReportDataLst'] as $emptykey =>  $emptyvalue)
    //             // if($equifax['CCRResponse']['Status'] == "0" && $emptyvalue['Error']['ErrorCode'] == "00")
    //             //     return view('kyc.equifax',compact('equifax'));

                    
                

    //             foreach($equifax['CCRResponse']['CIRReportDataLst'] as $key => $value)
    //             {
    //                 if(array_key_exists("Error",$value)){  
    //                     $isFound = 0;
    //                     return view('kyc.equifax',compact('equifax','isFound'));
    //                 }

                    
    //                 if(isset($value['InquiryResponseHeader']['ReportOrderNO']))
    //                     $orderNo = $value['InquiryResponseHeader']['ReportOrderNO'];
    //                 else
    //                     $orderNo = "";
                    
    //                 if(isset($value['InquiryRequestInfo']['FirstName']))
    //                     $consumerName = $value['InquiryRequestInfo']['FirstName'];
    //                 else
    //                     $consumerName = "";

    //                 if(isset($value['InquiryRequestInfo']['LastName']))
    //                     $consumerName .= " ".$value['InquiryRequestInfo']['LastName'];
                        

    //                 if(isset($value['InquiryRequestInfo']['DOB']))
    //                     $DOB = $value['InquiryRequestInfo']['DOB'];
    //                 else
    //                     $DOB = "";
                        
    //                 if(isset($value['InquiryResponseHeader']['Date']))
    //                     $date = $value['InquiryResponseHeader']['Date'];
    //                 else
    //                     $date = "";
                    
    //                 if(isset($value['InquiryResponseHeader']['Time']))
    //                     $time = $value['InquiryResponseHeader']['Time'];
    //                 else
    //                     $time = "";

    //                 if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
    //                     ['Age']['Age']))
    //                     $age = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']
    //                         ['Age']['Age'];
    //                 else
    //                     $age = "";

    //                 if(isset($value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender']))
    //                     $gender = $value['CIRReportData']['IDAndContactInfo']['PersonalInfo']['Gender'];
    //                 else
    //                     $gender = "";

    //                 if(isset($value['InquiryRequestInfo']['IDDetails'])){
    //                     $PAN = "";
    //                     $VoterID = "";
    //                     if($value['InquiryRequestInfo']['IDDetails'][0]['IDType'] == 'T')
    //                         $PAN = $value['InquiryRequestInfo']['IDDetails'][0]['IDValue'];
    //                     else if($value['InquiryRequestInfo']['IDDetails'][0]['IDType'] == 'V')
    //                         $VoterID = $value['InquiryRequestInfo']['IDDetails'][0]['IDValue'];
    //                 }else{
    //                     $PAN = "";
    //                     $VoterID = "";
    //                 }

    //                 if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['NationalIDCard'])){
    //                     foreach($value['CIRReportData']['IDAndContactInfo']
    //                     ['IdentityInfo']['NationalIDCard'] as $key1 => $value1)
    //                         if(isset($value1['IdNumber']))
    //                             $NationalIDCard = $value1['IdNumber'];
    //                         else
    //                             $NationalIDCard = "";
    //                 }else{
    //                     $NationalIDCard = "";
    //                 }

    //                 // if(isset($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'])){
    //                 //     foreach($value['CIRReportData']['IDAndContactInfo']
    //                 //     ['IdentityInfo']['VoterID'] as $key1 => $value1)
    //                 //         if(isset($value1['IdNumber']))
    //                 //             $VoterID = $value1['IdNumber'];
    //                 //         else
    //                 //             $VoterID = "";  
    //                 // }else{
    //                 //     $VoterID = "";
    //                 // }                                
    //                 // foreach($value['CIRReportData']['IDAndContactInfo']['IdentityInfo']['VoterID'] as $key1 => $value1)
    //                 //     if(isset($value1['IdNumber']))
    //                 //         $VoterID = $value1['IdNumber'];
    //                 //     else
    //                 //         $VoterID = "";          
    //                 // if(isset($value['InquiryRequestInfo']['InquiryPhones'])){
    //                 //     foreach($value['InquiryRequestInfo']['InquiryPhones'] as $key2 => $value2)
    //                 //         if(isset($value2['Number']))
    //                 //             $Number = $value2['Number'];
    //                 //         else
    //                 //             $Number = "";
    //                 // }else{
    //                 //     $Number = "";
    //                 // }

    //                 $Number = $request->phone_number;

    //                 if(isset($value['InquiryRequestInfo']['InquiryAddresses']))
    //                     $consumer_address = $value['InquiryRequestInfo']['InquiryAddresses'];
    //                 else
    //                     $consumer_address = "";

    //                 // if(isset($value['InquiryRequestInfo']['InquiryAddresses'][0]['State']) && $consumer_address != '')
    //                 //     $consumer_address .= ",".$value['InquiryRequestInfo']['InquiryAddresses'][0]['State'];
                      
    //                 // if(isset($value['InquiryRequestInfo']['InquiryAddresses'][0]['Postal']) && $consumer_address != '')
    //                 //     $consumer_address .= ",".$value['InquiryRequestInfo']['InquiryAddresses'][0]['Postal'];    

    //                 $score_array = $value['CIRReportData']['ScoreDetails'];
    //                 if(count($score_array) > 0){
    //                     // foreach($score_array as $scoredetails)
    //                     // {   
    //                         $score_details = $score_array;
    //                         // if(isset($scoredetails['Value'])){
    //                         //     $score = $scoredetails['Value'];
    //                         //     $score_version = $scoredetails['Version'];
    //                         // }else{
    //                         //     $score = "";
    //                         //     $score_version = "";
    //                         // }
    //                         // if(isset($scoredetails['ScoringElements']))
    //                         //     $scoringelements = $scoredetails['ScoringElements'];
    //                         // else
    //                         //     $scoringelements = "";
                            
    //                     // }
    //                 }else{
    //                     $score_details = [];
    //                 }
                    
    //                 if(isset($value['CIRReportData']['RecentActivities']))
    //                     $enquiry_summary = $value['CIRReportData']['RecentActivities'];
    //                 else
    //                     $enquiry_summary = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts']))
    //                     $numberofAccounts = $value['CIRReportData']['RetailAccountsSummary']['NoOfAccounts'];
    //                 else
    //                     $numberofAccounts = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalBalanceAmount']))
    //                     $TotalBalanceAmount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalBalanceAmount'];
    //                 else
    //                     $TotalBalanceAmount = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalPastDue']))
    //                     $TotalPastAmount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalPastDue'];
    //                 else
    //                     $TotalPastAmount = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['RecentAccount']))
    //                     $recent_account = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['RecentAccount'];
    //                 else
    //                     $recent_account = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                                             ['OldestAccount']))
    //                     $oldest_account = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['OldestAccount'];
    //                 else
    //                     $oldest_account = "";

                    
    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['NoOfActiveAccounts']))
    //                     $numberOfOpenAccount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['NoOfActiveAccounts'];
    //                 else
    //                     $numberOfOpenAccount = "";

    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['NoOfPastDueAccounts']))
    //                     $numberOfPastDueAccount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['NoOfPastDueAccounts'];
    //                 else
    //                     $numberOfPastDueAccount = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalHighCredit']))
    //                     $TotalHighCredit = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalHighCredit'];
    //                 else
    //                     $TotalHighCredit = "";



    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalCreditLimit']))         
    //                     $TotalCreditLimit = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalCreditLimit'];
    //                 else
    //                     $TotalCreditLimit = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['NoOfWriteOffs']))
    //                     $NoOfWriteOffs = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['NoOfWriteOffs'];
    //                 else
    //                     $NoOfWriteOffs = "";



    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalSanctionAmount']))
    //                     $TotalSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalSanctionAmount'];
    //                 else
    //                     $TotalSanctionAmount = '';



    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['SingleHighestCredit']))
    //                     $SingleHighestCredit = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['SingleHighestCredit'];
    //                 else
    //                     $SingleHighestCredit = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['NoOfZeroBalanceAccounts']))
    //                     $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['NoOfZeroBalanceAccounts'];
    //                 else
    //                     $NoOfZeroBalanceAccounts = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['TotalMonthlyPaymentAmount']))
    //                     $TotalMonthlyPaymentAmount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['TotalMonthlyPaymentAmount'];
    //                 else
    //                     $TotalMonthlyPaymentAmount = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['NoOfZeroBalanceAccounts']))
    //                     $NoOfZeroBalanceAccounts = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['NoOfZeroBalanceAccounts'];
    //                 else
    //                     $NoOfZeroBalanceAccounts = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['SingleHighestBalance']))
    //                     $SingleHighestBalance = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['SingleHighestBalance'];
    //                 else
    //                     $SingleHighestBalance = "";


    //                 if(isset($value['CIRReportData']['RetailAccountsSummary']
    //                     ['SingleHighestSanctionAmount']))
    //                     $SingleHighestSanctionAmount = $value['CIRReportData']['RetailAccountsSummary']
    //                         ['SingleHighestSanctionAmount'];
    //                 else
    //                     $SingleHighestSanctionAmount = "";

    
                    
    //                 //RETAIL ACCOUNT DETAILS
    //                 if(isset($value['CIRReportData']['RetailAccountDetails'])){
    //                     $RetailAccountDetails = $value['CIRReportData']['RetailAccountDetails'];
    //                 }else{
    //                     $RetailAccountDetails = '';
    //                 }

    //                 //Enquiries
                    
    //                 if(isset($value['CIRReportData']['Enquiries'])){
    //                     $enquiries = $value['CIRReportData']['Enquiries'];
    //                 }else{
    //                     $enquiries = "";
    //                 }

    //                 //Enquiry Summary
    //                 if(isset($value['CIRReportData']['EnquirySummary']['Purpose']))
    //                     $Purpose = $value['CIRReportData']['EnquirySummary']['Purpose'];
    //                 else
    //                     $Purpose = "";


    //                 if(isset($value['CIRReportData']['EnquirySummary']['Total']))
    //                     $Total = $value['CIRReportData']['EnquirySummary']['Total'];
    //                 else
    //                     $Total = "";

                    
    //                 if(isset($value['CIRReportData']['EnquirySummary']['Past30Days']))
    //                     $Past30Days = $value['CIRReportData']['EnquirySummary']['Past30Days'];
    //                 else
    //                     $Past30Days= "";

                    


    //                 if(isset($value['CIRReportData']['EnquirySummary']['Past12Months']))
    //                     $Past12Months = $value['CIRReportData']['EnquirySummary']['Past12Months'];
    //                 else
    //                     $Past12Months = "";

                    
    //                 if(isset($value['CIRReportData']['EnquirySummary']['Past24Months']))
    //                     $Past24Months = $value['CIRReportData']['EnquirySummary']['Past24Months'];
    //                 else
    //                     $Past24Months = "";

                    
    //                 if(isset($value['CIRReportData']['EnquirySummary']['Recent']))
    //                     $Recent = $value['CIRReportData']['EnquirySummary']['Recent'];
    //                 else
    //                     $Recent = "";

    //                 // foreach($RetailAccountDetails as $RetailAccountDetail)
    //                 // {
    //                 //     $AccountNumber = $RetailAccountDetail['AccountNumber'];
    //                 //     $Balance = $RetailAccountDetail['Balance'];
    //                 //     $Open = $RetailAccountDetail['Open'];
    //                 //     $DateReported = $RetailAccountDetail['DateReported'];
    //                 //     $Institution = $RetailAccountDetail['Institution'];
    //                 //     $PastDueAmount = $RetailAccountDetail['PastDueAmount'];
    //                 //     //$InterestRate = $RetailAccountDetail['AccountNumber']);
    //                 //     $DateOpened = $RetailAccountDetail['DateOpened'];
    //                 //     $Type = $RetailAccountDetail['AccountType'];
    //                 //     $LastPaymentDate = $RetailAccountDetail['LastPaymentDate'];
    //                 //     $LastPaymentDue = $RetailAccountDetail['LastPaymentDate'];
    //                 //     //$DateClosed = $RetailAccountDetail['AccountNumber']);
    //                 //     $OwnershipType = $RetailAccountDetail['source'];
    //                 //     //$WriteOffAmount = $RetailAccountDetail['AccountNumber']);
    //                 //     $SanctionAmount = $RetailAccountDetail['SanctionAmount'];
                        
                        

    //                 // }

    //                 //Personal Information
    //                 $myarray['CustRefField'] = $CustRefField;
    //                 $myarray['orderNo'] = $orderNo;
    //                 $myarray['consumerName'] = $consumerName;
    //                 $myarray['PAN'] = $PAN;
    //                 $myarray['VoterID'] = $VoterID;
    //                 $myarray['Number'] = $Number;
    //                 $myarray['DOB'] = $DOB;
    //                 $myarray['age'] = $age;
    //                 $myarray['gender'] = $gender;
    //                 $myarray['NationalIDCard'] = $NationalIDCard;
    //                 // $myarray['aadhar'] = $aadhar_num;
    //                 //Address
    //                 $myarray['consumer_address'] = $consumer_address;
                    
    //                 //Score
    //                 // $myarray['score'] = $score;
    //                 // $myarray['score_version'] = $score_version;
    //                 // $myarray['scoringelements'] = $scoringelements;
    //                 $myarray['score_details'] = $score_details;
                    
    //                 //date and time
    //                 $myarray['date'] = $date;
    //                 $myarray['time'] = $time;
    //                 $myarray['enquiries'] = $enquiries;
    //                 $myarray['enquiry_summary'] = $enquiry_summary;

    //                 //Summary
    //                 $myarray['numberofAccounts'] = $numberofAccounts;
    //                 $myarray['TotalBalanceAmount'] = $TotalBalanceAmount;
    //                 $myarray['TotalPastAmount'] = $TotalPastAmount;
    //                 $myarray['recentAccount'] = $recent_account;
    //                 $myarray['oldestAccount'] = $oldest_account;
    //                 $myarray['numberOfOpenAccount'] = $numberOfOpenAccount;
    //                 $myarray['numberOfPastDueAccount'] = $numberOfPastDueAccount;
    //                 $myarray['TotalHighCredit'] = $TotalHighCredit;
    //                 $myarray['TotalCreditLimit'] = $TotalCreditLimit;
    //                 $myarray['NoOfWriteOffs'] = $NoOfWriteOffs;
    //                 $myarray['TotalSanctionAmount'] = $TotalSanctionAmount;
    //                 $myarray['SingleHighestCredit'] = $SingleHighestCredit;
    //                 $myarray['NoOfZeroBalanceAccounts'] = $NoOfZeroBalanceAccounts;
    //                 $myarray['TotalMonthlyPaymentAmount'] = $TotalMonthlyPaymentAmount;
    //                 $myarray['NoOfZeroBalanceAccounts'] = $NoOfZeroBalanceAccounts;
    //                 $myarray['SingleHighestBalance'] = $SingleHighestBalance;
    //                 $myarray['SingleHighestSanctionAmount'] = $SingleHighestSanctionAmount
    //                 ;
    //                 $myarray['RetailAccountDetails'] = $RetailAccountDetails;
                    
    //                 //Enquiry Summary
    //                 $myarray['Purpose'] = $Purpose;
    //                 $myarray['Total'] = $Total;
    //                 $myarray['Past30Days'] = $Past30Days;
    //                 $myarray['Past24Months'] = $Past24Months;
    //                 $myarray['Recent'] = $Recent;
    //                 $myarray['Past12Months'] = $Past12Months;


                    
    //             }
                

    //             $pdf = PDF::loadView('kyc.equifaxreportpdf',compact('myarray','equifax'))->setPaper('A4');
    //             return $pdf->stream('invoice.pdf');
    //         }

    //         return view('kyc.equifax',compact('statusCode','equifax'));

    //     // }catch(BadResponseException $e)
    //     // {
    //     //     $statusCode = $e -> getResponse() -> getStatusCode();
    //     // }

    //         return view('kyc.equifax',compact('statusCode','equifax','hit_limits_exceeded'));
    //     }
    // }


    public function equifaxScoreIdtypes(){
        $idtypes = array(['name'=>'PAN Card', 'value'=> 'T']);
        return response()->json($idtypes);
    }
    public function scoreEquifax(){
        $score_api_message = session('score_api_message');
        dd($score_api_message);
        return view('kyc.equifax_score_api');
      }
      public function scoreEquifaxSubmit(Request $request){
        // return 'ok';
           $validator = $request->validate(
              [  
                  'FirstName' => 'required',
                  'LastName' => 'required',
                  'DOB' => 'required',
                  'MobileNumber'=>'required|regex:/^[0-9]{10}+$/',
                  'IdValue'=>'required',
              ],
              [
                  'FirstName.required' => 'FirstName key is required',
                  'LastName.required' => 'LastName key is required',
                  'DOB.required'=>'DOB key is required',
                  'MobileNumber.required'=>'MobileNumber is required',
                  'MobileNumber.regex'=>'MobileNumber should be 10 digits',
                  'IdValue.required'=>'Pan card value is required'
              ]
          );
          $api_score = new EquifaxScoreApi();
          $api_score->first_name=$request->FirstName;
          $api_score->last_name=$request->LastName;
          $api_score->date_of_birth=$request->DOB;
          $api_score->mobile_number=$request->MobileNumber;
          $api_score->pan_no=$request->IdValue;
          $api_score->created_at = date('Y-m-d H:i:s');
          $api_score->updated_at = date('Y-m-d H:i:s');
          $api_score->save();
          $body=[
              'FirstName' =>$request->FirstName,
              'LastName' =>$request->LastName,
              'DOB' =>$request->DOB,
              'MobileNumber'=>$request->MobileNumber,
              'IdValue'=> $request->IdValue
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
          $response = $client->post('http://regtechapi.in/api/creditscoreonly',[
              'headers' => $headers,
              'json' => $body,
          ]);
          $responseData = json_decode($response->getBody(), true);
    
          
          if(isset($responseData["statusCode"]) && $responseData["statusCode"]==102){
               $api_score->err_mark = $responseData["Error"];
               $api_score->status_code=102;
               $api_score->save();
               $score_api_message = json_encode([
                  'statusCode'=> 102,
                  'message'=>$responseData["Error"],
              
              ]);
               return redirect()->route('other.equifax_score')->with('score_api_message',$score_api_message);
         }
         if(isset($responseData["statusCode"]) && $responseData["statusCode"]==200)
         {
             $api_score->err_mark = 'success';
             $api_score->status_code=200;
             $api_score->score_value = $responseData["ScoreValue "];
             $api_score->save();
             $score_api_success_message = json_encode([
              'statusCode'=>200,
              'score_value'=>$responseData["ScoreValue "],
              'full_name'=>$request->FirstName.' '.$request->LastName,
              'pan_no'=>$request->IdValue,
           ]);
          return redirect()->route('other.equifax_score')->with('score_api_success_message',$score_api_success_message);
         }    
      return redirect()->route('other.equifax_score');
      
      }
}
