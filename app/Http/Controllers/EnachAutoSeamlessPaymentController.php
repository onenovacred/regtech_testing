<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\User;

class EnachAutoSeamlessPaymentController extends Controller
{
    public function initiateEnachSamelessPayment()
    {
        $access_token = Auth::user()->access_token;
        return view('enach_auto_shameless.initiate_enach_payment',compact('access_token'));
    }
    public function initiateEnachSamelessPaymentPost(Request $request)
    {
       $seamlesstoken = $request->access_token;
        $user = User::where('access_token',$seamlesstoken)->first();
        $userid =  $user['id'];
        $request->validate(
            [
                'amount' => 'required',
                'productinfo' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'firstname' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'phone' => 'required',
                'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'udf1' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf2' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf3' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf4' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf5' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf6' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
                'udf7' => 'required|regex:/^[a-zA-Z0-9\-_ .&]+$/',
            ],
            [
                'amount.required' => 'Please enter amount',
                'productinfo.required' => 'Please enter product info',
                'firstname.required' => 'Please enter first name',
                'email.required' => 'Please enter email',
                'phone.required' => 'Please enter phone number',
                'udf1.required' => 'Please enter udf1',
                'udf2.required' => 'Please enter udf2',
                'udf3.required' => 'Please enter udf3',
                'udf4.required' => 'Please enter udf4',
                'udf5.required' => 'Please enter udf5',
                'udf6.required' => 'Please enter udf6',
                'udf7.required' => 'Please enter udf7',
            ]
        );
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
        $udf7 = $request->input('udf7');
        $address_one = $request->input('address_one');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $zip_code = $request->input('zip_code');
        $payment_mode = $request->input('payment_mode');
        $customer_authentication_id = uniqid();
        $final_collection_date = date('d/m/Y', strtotime($request->final_collection_date));
        $E_nach_hash_key = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '|' . $udf6 . '|' . $udf7 . '||||' . $salt_key;
        $hash = strtolower(hash('sha512', $E_nach_hash_key));
        $data = [
            'key' => $key,
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productinfo,
            'firstname' => $firstname,
            'phone' => $phone,
            'email' => $email,
            'surl' => 'https://regtechapi.in/enach_seamless_payment_success',
            'furl' => 'https://regtechapi.in/enach_seamless_payment_failure',
            'hash' => $hash,
            'udf1' => $udf1,
            'udf2' => $udf2,
            'udf3' => $udf3,
            'udf4' => $udf4,
            'udf5' => $udf5,
            'udf6' => $udf6,
            'udf7' => $udf7,
            'address1'=>$address_one,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'zipcode' => $zip_code,
            'show_payment_mode' => $payment_mode,
            'customer_authentication_id' => $customer_authentication_id,
            'final_collection_date' => $final_collection_date,
            'request_flow' => 'SEAMLESS',
        ];
        $url = 'https://pay.easebuzz.in/payment/initiateLink';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        if ($responseData['status'] == 1) {
            DB::table('e_nach_seamless_initiate_payment_gateway')->insert([
                'merchant_key' => $key,
                'salt_key' => $salt_key,
                'txnid' => $txnid,
                'amount' => $amount,
                'productinfo' => $productinfo,
                'firstname' => $firstname,
                'phone' => $phone,
                'email' => $email,
                'hash' => $hash,
                'udf1' => $udf1,
                'udf2' => $udf2,
                'udf3' => $udf3,
                'udf4' => $udf4,
                'udf5' => $udf5,
                'udf6' => $udf6,
                'udf7' => $udf7,
                'address_one' => $address_one,
                'city' => $city,
                'state' => $state,
                'user_id' => $userid,
                'country' => $country,
                'zip_code' => $zip_code,
                'payment_mode' => $payment_mode,
                'customer_auth_id' => $customer_authentication_id,
                'final_date' => date('Y-m-d', strtotime($final_collection_date)),
                'status_code' => 200,
                'request_flow' => 'SEAMLESS',
                'status' => 'success',
                'data_id' => $responseData['data'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('seamless_payment', ['access_key' => $responseData['data']]);
        } else {
            DB::table('e_nach_seamless_initiate_payment_gateway')->insert([
                'merchant_key' => $key,
                'salt_key' => $salt_key,
                'txnid' => $txnid,
                'amount' => $amount,
                'productinfo' => $productinfo,
                'firstname' => $firstname,
                'phone' => $phone,
                'email' => $email,
                'hash' => $hash,
                'udf1' => $udf1,
                'udf2' => $udf2,
                'udf3' => $udf3,
                'udf4' => $udf4,
                'udf5' => $udf5,
                'udf6' => $udf6,
                'udf7' => $udf7,
                'address_one' => $address_one,
                'city' => $city,
                'state' => $state,
                'user_id' => $userid,
                'country' => $country,
                'zip_code' => $zip_code,
                'payment_mode' => $payment_mode,
                'customer_auth_id' => $customer_authentication_id,
                'final_date' => date('Y-m-d', strtotime($final_collection_date)),
                'status_code' => 500,
                'request_flow' => 'SEAMLESS',
                'status' => 'Failed',
                'remark' => $responseData['error_desc'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['status' => 500, 'error_desc' => $responseData]);
        }
    }
   
    public function seamlessPayment($access_key)
    {
        return view('enach_auto_shameless.seamless_payment', compact('access_key'));
    }
    public function seamlessPaymentSubmit(Request $request)
    {
       
        $request->validate(
            [
                'payment_mode' => 'required',
                'ifsc' => 'required',
                'account_type' => 'required',
                'account_no' => 'required',
                'auth_mode' => 'required',
                'bank_code' => 'required',
            ],
            [
                'payment_mode.required' => 'Please select payment mode.',
                'ifsc.required' => 'Please enter  ifsc.',
                'account_type.required' => 'Please select account type.',
                'account_no.required' => 'Please enter account number.',
                'auth_mode.required' => 'Please select auth mode.',
                'bank_code.required' => 'Please enter bank code.',
            ]
        );
     
        $access_key = $request->access_key;
        $payment_mode =$request->payment_mode;
        $ifsc=$request->ifsc;
        $account_type=$request->account_type;
        $account_no = $request->account_no;
        $auth_mode = $request->auth_mode;
        $bank_code= $request->bank_code;
        $url = 'https://pay.easebuzz.in/initiate_seamless_payment';
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'access_key' => $access_key,
                'payment_mode' => $payment_mode,
                'ifsc' => $ifsc,
                'account_type' => $account_type,
                'account_no' => $account_no,
                'auth_mode' => $auth_mode,
                'bank_code' => $bank_code,
            ]),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
       if(isset($response) &&  $response != null){
            DB::table('e_nach_seamless_initiate_payment_gateway')->where('data_id',$access_key)->update([
                'ifsc_code'=>$request->ifsc,
                'payment_mode'=>$payment_mode,
                'account_type'=>$account_type,
                'account_number'=>$account_no,
                'auth_mode'=>$auth_mode
            ]);
               
            return $response;
         }
         return redirect()->route('page_not_found');
     }
     public function successPayment(Request $request)
     {
        DB::table('e_nach_seamless_initiate_payment_gateway')->where('txnid', $request->input('txnid'))->update([
            'status' => $request->input('status'),
            'status_code'=>200,
            'card_type'=>$request->input('card_type'),
            'remark'=>$request->input('error'),
            'net_amount_debit'=>$request->input('net_amount_debit'),
            'easepayid'=>$request->input('easepayid'),
            'name_on_card'=>$request->input('name_on_card'),
            'payment_source'=>$request->input('payment_source'),
            'mode'=>$request->input('mode'),
            'unmappedstatus'=>$request->input('unmappedstatus'),
            'cardCategory'=>$request->input('cardCategory'),
            'bank_name'=>$request->input('bank_name'),
            'addedon'=>$request->input('addedon'),
            'PG_TYPE'=>$request->input('PG_TYPE'),
            'bank_ref_num'=>$request->input('bank_ref_num'),
            'bankcode'=>$request->input('bankcode'),
            'error_Message'=>$request->input('error_Message'),
            'upi_va'=>$request->input('upi_va'),
            'cardnum'=>$request->input('cardnum'),
            'issuing_bank'=>$request->input('issuing_bank'),
            'cash_back_percentage'=>$request->input('cash_back_percentage'),
            'authorization_status'=>$request->input('authorization_status'),
            'customer_authentication_id'=>$request->input('customer_authentication_id'),
            'auto_debit_auth_error'=>$request->input('auto_debit_auth_error'),
            'udf5'=>$request->input('udf5'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),

        ]);
         return view('enach_auto_shameless.success');
     }
     public function failurePayment(Request $request)
     {
     
       DB::table('e_nach_seamless_initiate_payment_gateway')->where('txnid', $request->input('txnid'))->update([
            'status' => $request->input('status'),
            'status_code'=>102,
            'card_type'=>$request->input('card_type'),
            'remark'=>$request->input('error'),
            'net_amount_debit'=>$request->input('net_amount_debit'),
            'easepayid'=>$request->input('easepayid'),
            'name_on_card'=>$request->input('name_on_card'),
            'payment_source'=>$request->input('payment_source'),
            'mode'=>$request->input('mode'),
            'unmappedstatus'=>$request->input('unmappedstatus'),
            'cardCategory'=>$request->input('cardCategory'),
            'bank_name'=>$request->input('bank_name'),
            'addedon'=>$request->input('addedon'),
            'PG_TYPE'=>$request->input('PG_TYPE'),
            'bank_ref_num'=>$request->input('bank_ref_num'),
            'bankcode'=>$request->input('bankcode'),
            'error_Message'=>$request->input('error_Message'),
            'upi_va'=>$request->input('upi_va'),
            'cardnum'=>$request->input('cardnum'),
            'issuing_bank'=>$request->input('issuing_bank'),
            'cash_back_percentage'=>$request->input('cash_back_percentage'),
            'authorization_status'=>$request->input('authorization_status'),
            'customer_authentication_id'=>$request->input('customer_authentication_id'),
            'auto_debit_auth_error'=>$request->input('auto_debit_auth_error'),
            'udf5'=>$request->input('udf5'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),

        ]);
        return view('enach_auto_shameless.failure');
     }
    
    public function pageNotFound(){
        return view('enach_auto_shameless.page_not_found');
    }
}
