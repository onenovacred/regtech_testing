<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Carbon\Carbon;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;

class DunzoController extends Controller
{
    //
    private $client_id = "f857e670-5877-4550-aaea-05bf6340c0fb";
    private $secret_key="2bd0dac7-89e8-11ee-8424-c60bb620164f";
    private $token ="eyJhbGciOiJFUzI1NiIsImtpZCI6ImtleV9pZF8xIiwidHlwIjoiSldUIiwidmVyc2lvbiI6IjEifQ.eyJ0eXBlIjoiIiwicmVzb3VyY2VzIjpudWxsLCJ1c2VyX2lkIjowLCJ1c2VyX3V1aWQiOiI1NTY3MzVmNS04NzRiLTQ0MTctOWI1Ny01YzkzNTUxNGYyMTgiLCJ1c2VyX3R5cGUiOiJEIiwiZnVsbF9uYW1lIjoiIiwic2Vzc2lvbl9pZCI6IiIsIm1ldGEiOnsiaXNfYXBpX3VzZXIiOnRydWUsInVzZXJuYW1lIjoiZjg1N2U2NzAtNTg3Ny00NTUwLWFhZWEtMDViZjYzNDBjMGZiIn0sImlzcyI6ImR1bnpvLWF1dGgtc3ZjIiwic3ViIjoiMCIsImV4cCI6MTg3NzgwNzcwNSwiaWF0IjoxNzIwMDA3NzA1LCJqdGkiOiIxYmZmZmU3OC04OWIzLTQ4MjItOTkwNy01NjRhMGQ2Mzc5OWIifQ.7ipqZJ62hLh5nPq3EbGGZk9wWwcm7f6c5SVEDAnIuN2tOE7gykIEbNwGxBhOVe2WnLwqxApCzolycIB60XedMQ";
    private $quote ="https://apis-staging.dunzo.in/api/v2/quote";
    private $create_task ="https://apis-staging.dunzo.in/api/v2/tasks";
    private $task_status="https://apis-staging.dunzo.in/api/v1/tasks";
    private $cancle_drop_task="https://apis-staging.dunzo.in/api/v2/tasks/cancel-drops";
    private $cancle_task="https://apis-staging.dunzo.in/api/v2/tasks/cancel";
    public function create_logistics_task(){
         return view('dunzo.create_logistics_task');
    }
    public function create_logistics_task_submit(Request $request){
        $request->validate([
            'pickup_latitude' => ['required',  function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter latitude float number format.');
                }   
            }], 
            'pickup_longitude' => ['required', function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter longitude float number format.');
                } 
            }],
            'drop_latitude' => ['required',function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter latitude float number format.');
                }  
            }], 
            'drop_longitude' => ['required', function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter longitude float number format.');
                } 
            }],
            'drop_amount' => ['required', 'numeric'],
            'payment_method' => ['required'],
        ], [
            'pickup_latitude.required' => 'Please enter latitude.',
            'pickup_longitude.required' => 'Please enter longitude.',
            'drop_latitude.required' => 'Please enter latitude.',
            'drop_longitude.required' => 'Please enter longitude.',
            'drop_amount.required' => 'Plese enter amount.',
            'drop_amount.numeric' => 'Amount must be a number.',
            'payment_method.required' => 'Please select payment mode.',
        ]);
          $minimum_delay = 30 * 60;
          $current_time = time();
          $schedule_time = $current_time + rand($minimum_delay, $minimum_delay * 2);
          try{
             $body=[
                "pickup_details"=> [
                    [
                        "lat"=>floatval($request->pickup_latitude),
                        "lng"=>floatval($request->pickup_longitude),
                        "reference_id"=> "pickup-ref"
                    ]
                ],
                "optimised_route"=> true,
                "drop_details" => [
                    [
                        "lat"=>floatval($request->drop_latitude),
                        "lng"=>floatval($request->drop_longitude),
                        "reference_id"=> "drop-ref1",
                        "payment_data"=> [
                            "payment_method"=>$request->payment_method,
                            "amount"=>floatval($request->drop_amount),
                        ]
                    ]
                ],
                "delivery_type"=> "SCHEDULED",
                "schedule_time"=> $schedule_time
             ];
             $headers=[
               'client-id'=>$this->client_id,
               'Authorization'=>$this->token,
             ];
               $client = new Client();
               $res = $client->post($this->quote,['headers'=>$headers,'json'=>$body]);
               $response = json_decode($res->getBody(),true);              
               return  $response;
           }catch(BadResponseException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            $message = $e->getResponse()->getReasonPhrase();
            $response = $e->getResponse();
            $errorResponse = json_decode($response->getBody(), true);
             if($statusCode == 401){
             }
             if($statusCode == 429){
                
             }
             if($statusCode == 400){ 
               
             }
             if($statusCode == 422){ 
                
             }
             if($statusCode == 503){
              }
             if($statusCode == 500){
                
             }
            return view('dunzo.error_message',compact('statusCode','message'));
           }
    }
    public function create_task(){
        return view('dunzo.create_task');
    }
    public function create_task_submit(Request $request){

        $request->validate([
            'pickup_name'=>['required','regex:/^[a-zA-Z0-9\s]+$/u'],
            'mobile_number'=>['required', function ($attribute, $value, $fail) {
                if (!preg_match('/^\d{10}$/', $value)) {
                    $fail('Mobile number should be 10 digit.');
                }
            }],
           'pickup_address1'=>['required'],
           'pickup_latitude' => ['required',  function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter latitude float number format.');
                }   
            }], 
            'pickup_longitude' => ['required', function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter longitude float number format.');
                } 
            }],
            'drop_name'=>['required','regex:/^[a-zA-Z0-9\s]+$/u'],
           'drop_mobile_number'=>['required', function ($attribute, $value, $fail) {
              if (!preg_match('/^\d{10}$/', $value)) {
                  $fail('Mobile number should be 10 digit.');
              }
            }],
            'drop_address1'=>['required'],
            'drop_latitude' => ['required',function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter latitude float number format.');
                }  
            }], 
            'drop_longitude' => ['required', function ($attribute, $value, $fail) {
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    $fail('Please enter longitude float number format.');
                } 
            }],
            'drop_amount' => ['required', 'numeric'],
            'payment_method' => ['required'],
        ], [
            'pickup_latitude.required' => 'Please enter latitude.',
            'pickup_name.required'=>'Please enter name',
            'pickup_name.regex'=>'Name may only contain letter and number',
            'mobile_number.required'=>'Please enter mobile number',
            'pickup_longitude.required' => 'Please enter longitude.',
            'drop_latitude.required' => 'Please enter latitude.',
            'drop_longitude.required' => 'Please enter longitude.',
            'drop_amount.required' => 'Plese enter amount.',
            'drop_amount.numeric' => 'Amount must be a number.',
            'payment_method.required' => 'Please select payment mode.',
            'pickup_address1.required'=>"Please enter a address.",
            'drop_address1.required'=>"Please enter a address.", 
            'drop_mobile_number.required'=>"Please enter a mobile number.",
            'drop_name.required'=>"Please enter a name.",
            'drop_name.regex'=>"Name may only contain letter and number",
        ]);
        
          $referenceId = Str::uuid()->toString();
          $requestId= Str::uuid()->toString();
          $minimum_delay = 30 * 60;
          $current_time = time();
          $schedule_time = $current_time + rand($minimum_delay, $minimum_delay * 2);
           try{
             $body=[
                "request_id"=>$requestId,
                "reference_id"=>$referenceId,
                "pickup_details"=>[
                    [
                        "reference_id"=> "pick_ref_1",
                        "special_instructions"=> "fragile items, handle with great care",
                        "address"=> [
                            "apartment_address"=> "",
                            "street_address_1"=>$request->pickup_address1,
                            "street_address_2"=>$request->pickup_address2,
                            "landmark"=>$request->pickup_landmark,
                            "city"=>$request->pickup_city,
                            "state"=>$request->pickup_state,
                            "pincode"=>$request->pickup_pincode,
                            "country"=>$request->pickup_country,
                            "lng"=>floatval($request->pickup_longitude),
                            "lat"=>floatval($request->pickup_latitude),
                            "contact_details"=>[
                                "name"=>$request->pickup_name,
                                "phone_number"=>$request->mobile_number
                             ]
                        ],
                        "otp_required"=> true
                    ]
                ],
                "optimised_route"=> true,
                "drop_details"=> [
                    [
                        "reference_id"=> "drop_ref_2",
                        "special_instructions"=> "hand it to the security guard",
                        "address"=> [
                            "apartment_address"=> "",
                            "street_address_1"=>$request->drop_address1,
                            "street_address_2"=>$request->drop_address2,
                            "landmark"=>$request->drop_landmark,
                            "city"=>$request->drop_city,
                            "state"=>$request->drop_state,
                            "pincode"=>$request->drop_pincode,
                            "country"=>$request->drop_country,
                            "lat"=>floatval($request->drop_latitude),
                            "lng"=>floatval($request->drop_longitude),
                            "contact_details"=>[
                                "name"=>$request->drop_name,
                                "phone_number"=>$request->drop_mobile_number
                            ]
                        ],
                        "otp_required"=>false,
                        "payment_data"=> [
                            "payment_method"=>$request->payment_method,
                            "amount"=>floatval($request->drop_amount)
                        ]
                    ]
                ],
                "payment_method"=>$request->payment_method,
                "delivery_type"=> "SCHEDULED",
                "schedule_time"=> $schedule_time
            ];
             $headers=[
               'client-id'=>$this->client_id,
               'Authorization'=>$this->token,
             ];
               $client = new Client();
               $res = $client->post($this->create_task,['headers'=>$headers,'json'=>$body]);
               $response = json_decode($res->getBody(),true);  
             //  return  $response;
               if(isset($response['task_id'])){
                  return redirect()->route('task.status',['task_id'=>$response['task_id']]);
                }
               else{
                    return response()->json(['data'=>$response]);       
               }
                

           }catch(BadResponseException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            $message = $e->getResponse()->getReasonPhrase();
            $response = $e->getResponse();
            $errorResponse = json_decode($response->getBody(), true);
             if($statusCode == 401){
                return view('dunzo.error_message',compact('statusCode','message'));
             }
             if($statusCode == 429){
                return view('dunzo.error_message',compact('statusCode','message'));
             }
             if($statusCode == 400){ 
                return view('dunzo.error_message',compact('statusCode','message'));
             }
             if($statusCode == 422){ 
                return view('dunzo.error_message',compact('statusCode','message'));
             }
             if($statusCode == 503){
                return view('dunzo.error_message',compact('statusCode','message'));
             }
             if($statusCode == 500){
                return view('dunzo.error_message',compact('statusCode','message'));

            }
            return view('dunzo.error_message',compact('statusCode','message'));
           }
    }

 //Create Task

 public function taskStatus($taskid){
     
       $headers=[
        'client-id'=>$this->client_id,
        'Authorization'=>$this->token,
      ];
      try{
        $client = new Client();
        $res = $client->get($this->task_status.'/'.$taskid.'/status',['headers'=>$headers]);
        $response = json_decode($res->getBody(),true);
        return  $response; 
      }catch(BadResponseException $e){
        $statusCode = $e->getResponse()->getStatusCode();
        $message = $e->getResponse()->getReasonPhrase();
        $response = $e->getResponse();
        $errorResponse = json_decode($response->getBody(), true);
        dd($errorResponse);
        if($statusCode == 401){
            return view('dunzo.error_message',compact('statusCode','message'));
        }
        if($statusCode == 429){
            return view('dunzo.error_message',compact('statusCode','message'));
        }
        if($statusCode == 400){ 
            return view('dunzo.error_message',compact('statusCode','message'));
        }
        if($statusCode == 422){ 
            return view('dunzo.error_message',compact('statusCode','message'));
        }
        if($statusCode == 503){
            return view('dunzo.error_message',compact('statusCode','message'));
        }
        if($statusCode == 500){
            return view('dunzo.error_message',compact('statusCode','message'));

       }
       return view('dunzo.error_message',compact('statusCode','message'));
      } 
       
 }
    
//Create Task api report
public function generatePDF()
{
    $json_data = '{
        "task_id": "d115254b-c044-4387-a229-4df0a3c0af17",
        "state": "In Progress",
        "distance": 6.355,
        "estimated_price": 275,
        "estimated_price_breakup": {
            "delivery_charge": 226,
            "delivery_charge_breakup": {	
                "base_delivery_charge": 85,
                "total_gst_amount": 20,
                "gst_breakup": {
                    "cgst": 10.17,
                    "sgst": 10.17,
                    "igst": 0,
                    "round_off": -0.34,
                    "cgst_percentage": 9,
                    "sgst_percentage": 9,
                    "igst_percentage": 0
                },
                "surge": 28,
                "surge_multiplier": 1.33,
                "multi_drop_price": 0,
                "multi_drop_price_per_drop": 0
            },
            "cod_txn_fee": 49.5,
            "cod_txn_fee_breakup": {
                "amount": 49.5,	
                "round_off": -0.5,
                "txn_fee_rule": {
                    "value": 5,
                    "type": "PERCENTAGE"
                },
                "drop_breakup": [
                    {
                        "drop_reference_id": "drop-ref3",
                        "product_amount": 990,
                        "txn_fee_amount": 49.5
                    }
                ]
            }
        },
        "eta": {
            "pickup": 12,
            "dropoff": 45
        },
        "drop_ids": [
            "drop_ref_2",
            "drop_ref_1"
        ]
    }';
    $data = json_decode($json_data, true);
    $pdf = PDF::loadView('dunzo.create_task_api_report',compact('data'))->setPaper('A4');
    return $pdf->stream('invoice.pdf');
}
//estatimate price report
public function generatePDF2()
{
    $json_data ='{
  "category_id": "pickup_drop",
  "distance": 6.355,
  "estimated_price": 233,
  "estimated_price_breakup": {
    "delivery_charge": 226,
    "delivery_charge_breakup": {
      "base_delivery_charge": 85,
      "total_gst_amount": 20,
      "gst_breakup": {
        "cgst": 10.17,
        "sgst": 10.17,
        "igst": 0,
        "round_off": -0.34,
        "cgst_percentage": 9,
        "sgst_percentage": 9,
        "igst_percentage": 0
      }
    },
    "surge": 28,
    "surge_multiplier": 1.33,
    "multi_drop_price": 0,
    "multi_drop_price_per_drop": 0
  },
  "cod_txn_fee": 7,
  "cod_txn_fee_breakup": {
    "amount": 7.8,
    "round_off": -0.8,
    "txn_fee_rule": {
      "value": 5,
      "type": "PERCENTAGE"
    },
    "drop_breakup": [
      {
        "drop_reference_id": "drop-ref1",
        "product_amount": 101,
        "txn_fee_amount": 5.05
      },
      {
        "drop_reference_id": "drop-ref3",
        "product_amount": 55,
        "txn_fee_amount": 2.75
      }
    ]
  },
  "eta": {
    "pickup": 15,
    "dropoff": 35
  },
  "drop_order": [
    "drop-ref3",
    "drop-ref2",
    "drop-ref1"
  ]
}
';
    $data = json_decode($json_data, true);
    $pdf = PDF::loadView('dunzo.estatimate_price_api_report',compact('data'))->setPaper('A4');
    return $pdf->stream('invoice.pdf');
}

}
