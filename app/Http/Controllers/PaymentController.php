<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Easebuzz\Easebuzz;
// use App\Models\PaymentGetway;
use GuzzleHttp\Client;
use Auth;
use App\Models\User;

class PaymentController extends Controller
{

    //
    public function processPaymentInitiate(Request $request)
    {


        $easebuzzObj   = new Easebuzz(config('app.easebuzz_merchant_key'), config('app.easebuzz_salt_key'), 'test');

        $data = array(
            "txnid" => $request->txnid,
            "amount" => $request->amount,
            "firstname" => $request->firstname,
            "email" => $request->email,
            "phone" => $request->phone,
            "city" => $request->city,
            "state" => $request->state,
            "country" => $request->country,
            "zipcode" => $request->zipcode,
            "productinfo" => $request->productinfo,
            "surl" => url('payment/success'),
            "furl" => url('payment/failure'),
        );
        $initiateApi = $easebuzzObj->initiatePaymentAPI($data);
        return response()->json(["payment" => $initiateApi]);
    }
    public function processPaymentInitiateIfram(Request $request)
    {

        $easebuzzObj   = new Easebuzz(config('app.easebuzz_merchant_key'), config('app.easebuzz_salt_key'), 'test');
    }
    public function initiatePaymentProcess()
    {   
        $access_token = Auth::user()->access_token;
        return view('payment.initiate-payment',compact('access_token'));
    }
    public function initiatePaymentProcessPost(Request $request)
    {    
        $nonseamlesstoken = $request->access_token;
        $user = User::where('access_token',$nonseamlesstoken)->first();
        $client = new Client();
        $key = "7PQJ3ZJPRQ";
        $txnid = uniqid();
        $amount = $request->amount;
        $salt = "U67ODUQVI8";
        $productinfo = $request->productinfo;
        $email = $request->email;
        $firstname = $request->name;
        $phone = $request->phone;
        $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email.'|||||||||||'. $salt;
        $hash = strtolower(hash('sha512', $hashString));
        $data = [
            'key' => $key,
            'txnid' => $txnid,
            "amount" => $amount,
            "firstname" =>  $firstname,
            "productinfo" => $productinfo,
            "email" => $email,
            "phone" => $phone,
            "hash" => $hash,
            "surl"=>"https://regtechapi.in/success",
            "furl"=>"https://regtechapi.in/failure",
            
         ];
      
        
        $url = "https://pay.easebuzz.in/payment/initiateLink";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        $paymentUrl = "https://pay.easebuzz.in/pay/{$responseData['data']}";
        return redirect($paymentUrl);
    }
    public function successPayment(Request $request)
    {
        // return $request->all();
        $transactionId = $request->input('txnid');
        $amount = $request->input('amount');
        return view('payment.success',compact('transactionId','amount'));
    }
    public function successResponse(Request $request)
    {
         return $request->all();
        // $transactionId = $request->input('txnid');
        // $amount = $request->input('amount');
        // return view('payment.success',compact('transactionId','amount'));
    }
    public function failureResponse(Request $request)
    {
         return $request->all();
        // $transactionId = $request->input('txnid');
        // $amount = $request->input('amount');
        // return view('payment.success',compact('transactionId','amount'));
    }
    public function failurePayment(Request $request)
    {
         $errormessage = $request->input('error_Message');
         $name_on_card = $request->input('name_on_card');
         return view('payment.failed',compact('errormessage','name_on_card'));
    }
    public function paymentCheckout(Request $request){
          return response()->json(['data'=>$request->all()]);
    }
    public function shamelessPayment(){

        $key = '7PQJ3ZJPRQ';
        $txnid = uniqid();
        $amount = '1.0';
        $salt = 'U67ODUQVI8';
        $productinfo ='Laptop';
        $email = 'rajesh455@gmail.com';
        $firstname = 'Rajesh Singh';
        $phone = '9661234878';
        $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email.'|||||||||||'. $salt;
        $hash = strtolower(hash('sha512', $hashString));
        $url = 'https://testpay.easebuzz.in/payment/initiateLink';
        $data = [
            'key' => $key,
            'txnid' => $txnid,
            "amount" => $amount,
            "firstname" =>  $firstname,
            "productinfo" => $productinfo,
            "email" => $email,
            "phone" => $phone,
            "hash" => $hash,
            "surl"=>"http://localhost:8000/success",
            "furl"=>"http://localhost:8000/failure",
         ];
        // $payment_getway = new PaymentGetway();
        // $payment_getway->key = $key;
        // $payment_getway->salt_key = $salt;
        // $payment_getway->txnid = $txnid;
        // $payment_getway->email = $email;
        // $payment_getway->first_name =$firstname;
        // $payment_getway->phone = $phone;
        // $payment_getway->hash =$hash;
        $payment_getway->save();
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        if($responseData['status']==1){
            $access_key = $responseData['data'];
          return view('payment.shameless_payment_integration',compact('access_key','txnid'));
        }

    }
    public function shamelessPaymentPost(Request $request){
     // $key="A2OEHVZPKS";
     // $salt="YLVD3RJJ4N";
      $access_key=$request->access_key;
      $amount=$request->amount;
      $phone=$request->phone;
      $productinfo=$request->productinfo;
      $email=$request->email;
      $date_of_birth= \Carbon\Carbon::create($request->year,$request->month,$request->day,0);
      $dateOfBirthday = $date_of_birth->toDateTimeString();
      $gender=$request->gender;
      $payment_mode=$request->payment_mode;
      $card_holder_name=$request->card_holder_name;
      $card__number=$request->card__number;
      $card_cvv=$request->card_cvv;
      $card_expiry_date=$request->card_expiry_date;
      $zip_code=$request->zip_code;
      $state=$request->state;
      $country=$request->country;
   //   $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' .$card_holder_name. '|' . $email.'|||||||||||'. $salt;
     // $hash = strtolower(hash('sha512', $hashString));
      $data=[
        // 'key'=>"2PBP7IABZ2",
        // 'salt'=>"DAH88E3UWQ",
        'access_key' =>$access_key,
        'bank_code' =>'PNBCB',
        "payment_mode" =>$payment_mode,
        "card_holder_name" =>$card_holder_name,
        "card_number" => $card__number,
        "card_cvv" => $card_cvv,
        "card_expiry_date"=>$card_expiry_date
      ];
    //   dd($data);
      $url = 'https://testpay.easebuzz.in/initiate_seamless_payment/';
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      $response = curl_exec($curl);
      print_r(curl_error($curl));
      curl_close($curl);
      $responseData = json_decode($response, true);
    //  dd($response);
      return redirect();
    }
}
