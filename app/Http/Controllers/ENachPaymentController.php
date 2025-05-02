<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\User;
use DB;
use Auth;

class ENachPaymentController extends Controller
{
    public function initiatePayment()
    {
        
    //    return $token;
    //    $verifyAccessToken = $this->verifyAccessToken($token);
    //    if ($verifyAccessToken==false)
    //        return response()->json(array(['message'=>'Wrong Access Token','statusCode'=>'403']));
        $access_token = Auth::user()->access_token;
        return view('e-nach-payment.initiate-payment',compact('access_token'));
    }
    public function initiatePaymentPost(Request $request)
    {
       
        $nonseamlesstoken = $request->access_token;
        $user = User::where('access_token',$nonseamlesstoken)->first();
        $userid =  $user['id'];
        $request->validate(
            [
                'amount' => 'required',
                'productinfo' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'firstname' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'phone' => 'required',
                'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'udf1' => 'required',
                'udf2' => 'required',
                'udf3' => 'required',
                'udf4' => 'required',
                'udf5' => 'required',
                'udf6' => 'required',
            ],
            [
                'amount.required' => 'Please enter amount',
                'productinfo.required' => 'Please enter loan id',
                'firstname.required' => 'Please enter name',
                'email.required' => 'Please enter email',
                'phone.required' => 'Please enter phone number',
                'udf1.required' => 'Please enter  bank code',
                'udf2.required' => 'Please enter account number',
                'udf3.required' => 'Please enter bank Name',
                'udf4.required' => 'Please enter ifsc code',
                'udf5.required' => 'Please enter maximum amount',
                'udf6.required' => 'Please enter frequency',
            ]
        );
        $length =60;
        $access_token  = Str::random($length);
        $salt_key_length = 10;
        $salt_key_customer = bin2hex(random_bytes($salt_key_length));
        $saltkey_customer = strtoupper($salt_key_customer);
        $key = '7PQJ3ZJPRQ';
        $salt_key = 'U67ODUQVI8';
        $txnid = uniqid();
        $amount = $request->input('amount');
        $productinfo = $request->input('productinfo');
        $firstname = $request->input('firstname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $udf1 = $request->input('udf1');
        $udf2 = $request->input('udf2');
        $udf3 = $request->input('udf3');
        $udf4 = $request->input('udf4');
        $udf5 = $request->input('udf5');
        $udf6 = $request->input('udf6');
        $udf7 = "user7";
        $address_one=$request->input('address_one');
        $address_two=$request->input('address_two');
        $city=$request->input('city');
        $state=$request->input('state');
        $country=$request->input('country');
        $zip_code=$request->input('zip_code');
        $payment_mode =$request->input('payment_mode');
        $customer_authentication_id=uniqid();
        $final_collection_date = date('d/m/Y', strtotime($request->final_collection_date));
        $E_nach_hash_key = $key.'|'.$txnid.'|'.$amount.'|'. $productinfo.'|'.$firstname.'|'.$email.'|'.$udf1.'|'.$udf2.'|'.$udf3.'|'.$udf4.'|'.$udf5.'|'.$udf6.'|'.$udf7.'||||'.$salt_key;
        $hash = strtolower(hash('sha512', $E_nach_hash_key)); 
       
        $data = [
            'key' => $key,
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productinfo,
            'firstname' => $firstname,
            'phone' => $phone,
            'email' => $email,
            'surl' =>"https://regtechapi.in/e-nach-payment-success",
            'furl' =>"https://regtechapi.in/e-nach-payment-failure",
            'hash' => $hash,
            'udf1'=>$udf1,
            'udf2'=>$udf2,
            'udf3'=>$udf3,
            'udf4'=>$udf4,
            'udf5'=>$udf5,
            'udf6' =>$udf6,
            'udf7' =>$udf7,
            'address1'=>$address_one,
            'city'=>$city,
            'state'=> $state,
            'country'=>$country,
            'zipcode'=>$zip_code,
            'show_payment_mode'=>$payment_mode,
            'customer_authentication_id'=>$customer_authentication_id,
            'final_collection_date'=>$final_collection_date,
        ];
       // dd($data);
        $url='https://pay.easebuzz.in/payment/initiateLink';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        if($responseData['status']==1){

           $e_nach_initiate_payment_gateway = DB::table('e_nach_initiate_payment_gateway')->insert([
             'merchant_key'=>$key,
             'salt_key'=> $salt_key,
             'txnid'=>$txnid,
             'amount'=>$amount,
             'productinfo'=>$productinfo,
             'firstname'=>$firstname,
             'access_token'=>$access_token,
             'customer_salt_key'=>$saltkey_customer,
             'phone'=>$phone,
             'email'=>$email,
             'hash'=>$hash,
             'udf1'=>$udf1,
             'udf2'=>$udf2,
             'udf3'=>$udf3,
             'udf4'=>$udf4,
             'udf5'=>$udf5,
             'udf6'=>$udf6,
             'udf7'=>$udf7,
             'address_one'=>$address_one,
             'city'=>$city,
             'state'=>$state,
             'user_id'=>$userid,
             'country'=>$country,
             'zip_code'=>$zip_code,
             'payment_mode'=>$payment_mode,
             'customer_authentication_id'=>$customer_authentication_id,
             'final_collection_date'=>date('Y-m-d', strtotime($final_collection_date)),
             'status_code'=>200,    
             'data_id'=>$responseData['data'],
             'created_at'=>Carbon::now(),
             'updated_at'=>Carbon::now(),

           ]);
            $redirectPaymentUrl = "https://pay.easebuzz.in/pay/{$responseData['data']}";
            return redirect($redirectPaymentUrl);
        }
        else{
            $e_nach_initiate_payment_gateway = DB::table('e_nach_initiate_payment_gateway')->insert([
                'merchant_key'=>$key,
                'salt_key'=> $salt_key,
                'customer_salt_key'=>$saltkey_customer,
                'txnid'=>$txnid,
                'amount'=>$amount,
                'productinfo'=>$productinfo,
                'firstname'=>$firstname,
                'phone'=>$phone,
                'access_token'=>$access_token,
                'email'=>$email,
                'hash'=>$hash,
                'udf1'=>$udf1,
                'udf2'=>$udf2,
                'udf3'=>$udf3,
                'udf4'=>$udf4,
                'udf5'=>$udf5,
                'udf6'=>$udf6,
                'udf7'=>$udf7,
                'address_one'=>$address_one,
                'city'=>$city,
                'state'=>$state,
                'user_id'=>$userid,
                'country'=>$country,
                'zip_code'=>$zip_code,
                'payment_mode'=>$payment_mode,
                'customer_authentication_id'=>$customer_authentication_id,
                'final_collection_date'=>date('Y-m-d', strtotime($final_collection_date)),
                'status_code'=>500,    
                'remark'=>$responseData['error_desc'],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
   
              ]);
          return response()->json(['status' => 500,'error_desc'=>$responseData]);
        }
        
    }
    public function successPayment(Request $request)
    {
        $e_nach_success_initiate_payment_getway=DB::table('e_nach_initiate_payment_gateway')->where('txnid', $request->input('txnid'))->update([
            'status' => $request->input('status'),
            'status_code'=>200,
            'card_type'=>$request->input('card_type'),
            'remark'=>$request->input('error'),
            'net_amount_debit'=>$request->input('net_amount_debit'),
            'easepayid'=>$request->input('easepayid'),
            'name_on_card'=>$request->input('name_on_card'),
            'payment_source'=>$request->input('payment_source'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),

        ]);
         $transactionId = $request->input('txnid');
        return view('e-nach-payment.success',compact('transactionId'));
    }
    public function failurePayment(Request $request)
    {
        
        $e_nach_success_initiate_payment_getway=DB::table('e_nach_initiate_payment_gateway')->where('txnid', $request->input('txnid'))->update([
            'status' => $request->input('status'),
            'status_code'=>200,
            'card_type'=>$request->input('card_type'),
            'remark'=>$request->input('error'),
            'net_amount_debit'=>$request->input('net_amount_debit'),
            'easepayid'=>$request->input('easepayid'),
            'name_on_card'=>$request->input('name_on_card'),
            'payment_source'=>$request->input('payment_source'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),

        ]);
        $transactionId = $request->input('txnid');
        return view('e-nach-payment.failure',compact('transactionId'));
    }
}
