<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSchemeMaster;
use App\Models\Transaction;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use GuzzleHttp\Client;

class BillingController extends Controller
{
     public function index() {
    	
        return view('billing.list_prepaid');
      }



     public function addwallet(Request $request) {
        if($request->isMethod('GET')){
        	$users = User::where('type', 'role_prepaid')->get();
            // return view('billing.add_wallet', compact('add_wallet', 'users'));
            return view('billing.add_wallet', compact('users'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->type == '' || Auth::user()->type == null){
                $user = User::find($request->user);
                if($user){
                    if($request->transaction_type == 'debit'){
                        if($request->amount <= $user->wallet_amount){
                           $user->wallet_amount = $user->wallet_amount - $request->amount;
                           $user->save();
                            $this->transaction($user, 'Debit', $request->amount, $request->reason);
                           return back()->with('success', 'Amount has been Debited successfully');
                        } else {
                            return back()->with('error', 'User has Rs'.$user->wallet_amount.' Please enter less amount');
                        }
    
                    } else if($request->transaction_type == 'credit'){
                        
                        $originalAmount = $request->amount;
                        $gstAmount = $originalAmount * 0.18;
                        $totalgstAmount = $originalAmount + $gstAmount;
        
                        $client = new Client();
                        $key = "A2OEHVZPKS";
                        $txnid = uniqid();
                        $amount = $totalgstAmount;
                        $salt = "YLVD3RJJ4N";
                        $productinfo = 'Recharge';
                        $email = $user->email;
                        $firstname = $user->name;
                        $phone = '9876543210';
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
                        // $user->wallet_amount = $user->wallet_amount + $request->amount;
                        // $user->save();
                        // $this->transaction($user, 'Credit', $request->amount, $request->reason);
                        // return back()->with('success', 'Amount has been Credited successfully');
                    }
                }else{
                    return back()->with('error', 'Please Select User');
                }
            }else{
                // return Auth::user()->id;
                // return 'test2';
                $user = User::find(Auth::user()->id);
                // $curl = curl_init();

                // curl_setopt_array($curl, array(
                //     CURLOPT_URL => 'https://testpay.easebuzz.in/payment/initiateLink',
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_ENCODING => '',
                //     CURLOPT_MAXREDIRS => 10,
                //     CURLOPT_TIMEOUT => 0,
                //     CURLOPT_FOLLOWLOCATION => true,
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_CUSTOMREQUEST => 'POST',
                //     CURLOPT_POSTFIELDS => array('key' => '2PBP7IABZ2', 'txnid' => 'CDEF', 'amount' => $request->amount, 'productinfo' => 'Recharge', 'firstname' => $user->name, 'phone' => '9876543210', 'email' => $user->email, 'surl' => 'https://docs.easebuzz.in/code-response/success', 'furl' => 'https://docs.easebuzz.in/code-response/failure', 'hash' => '0b502773b129744b83253b6939f5e134572e17ac9fd6697c4fdd1740847957e68786a32fc3073cb0d29027563722cfec14796d426cff7e518b019106b225840a'),
                //     CURLOPT_HTTPHEADER => array(
                //         'cache-control: no-cache',
                //         'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                //         'postman-token: f9ad29df-daa5-ec23-f55a-61b11e4ae640'
                //     ),
                // ));

                // $response = json_decode(curl_exec($curl));

                // curl_close($curl);

                // $url = 'https://pay.easebuzz.in/pay/'.$response->data;
                // return Redirect::to($url);
                $originalAmount = $request->amount;
                $gstAmount = $originalAmount * 0.18;
                $totalgstAmount = $originalAmount + $gstAmount;

                $client = new Client();
                $key = "A2OEHVZPKS";
                $txnid = uniqid();
                $amount = $totalgstAmount;
                $salt = "YLVD3RJJ4N";
                $productinfo = 'Recharge';
                $email = $user->email;
                $firstname = $user->name;
                $phone = '9876543210';
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

                // $user->wallet_amount = $user->wallet_amount + $request->amount;
                // $user->save();

                // //if transaction is successful
                // if($user->start_date == '' || $user->start_date == null){
                //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                //     foreach($scheme_details as $details){
                //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);    
                //     }
                //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                // }
                // $this->transaction($user, 'Credit', $request->amount, $request->reason);
                // return back()->with('success', 'Amount has been Credited successfully');
            }            
        }
    }

    public function successPayment(Request $request)
    {
        $user_amount = DB::table('users')->where('email',$request->input('email'))->get();
        $wallet_amount = $user_amount[0]->wallet_amount;
        $transactionId = $request->input('txnid');
        $amount = $request->input('amount');
        $total_amount = $wallet_amount + $amount;
        $reason = 'Recharge';
        $update_wallet_amount = DB::table('users')->where('email',$request->input('email'))->update(['wallet_amount'=>$total_amount]);
        $user_details = DB::table('users')->where('email',$request->input('email'))->get();
        $user = $user_details[0]; 
        $this->transaction($user, 'Credit', $amount, $reason);
        return view('payment.success',compact('transactionId','amount'));
    }
    public function add_walletadmin(Request $request){
        if($request->isMethod('GET')){
        	$users = User::where('type', 'role_prepaid')->get();
            // return view('billing.add_wallet', compact('add_wallet', 'users'));
            return view('billing.add_wallet', compact('users'));
        }
        if($request->isMethod('POST')){
            if(Auth::user()->type == '' || Auth::user()->type == null){
                $user = User::find($request->user);
                if($user){
                    if($request->transaction_type == 'debit'){
                        if($request->amount <= $user->wallet_amount){
                           $user->wallet_amount = $user->wallet_amount - $request->amount;
                           $user->save();
                            $this->transaction($user, 'Debit', $request->amount, $request->reason);
                           return back()->with('success', 'Amount has been Debited successfully');
                        } else {
                            return back()->with('error', 'User has Rs'.$user->wallet_amount.' Please enter less amount');
                        }
    
                    } else if($request->transaction_type == 'credit'){
                        $user->wallet_amount = $user->wallet_amount + $request->amount;
                        $user->save();
                        $this->transaction($user, 'Credit', $request->amount, $request->reason);
                        return back()->with('success', 'Amount has been Credited successfully');
                    }
                }else{
                    return back()->with('error', 'Please Select User');
                }
            }else{
                $user = User::find(Auth::user()->id);
                // $curl = curl_init();

                // curl_setopt_array($curl, array(
                //     CURLOPT_URL => 'https://testpay.easebuzz.in/payment/initiateLink',
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_ENCODING => '',
                //     CURLOPT_MAXREDIRS => 10,
                //     CURLOPT_TIMEOUT => 0,
                //     CURLOPT_FOLLOWLOCATION => true,
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_CUSTOMREQUEST => 'POST',
                //     CURLOPT_POSTFIELDS => array('key' => '2PBP7IABZ2', 'txnid' => 'CDEF', 'amount' => $request->amount, 'productinfo' => 'Recharge', 'firstname' => $user->name, 'phone' => '9876543210', 'email' => $user->email, 'surl' => 'https://docs.easebuzz.in/code-response/success', 'furl' => 'https://docs.easebuzz.in/code-response/failure', 'hash' => '0b502773b129744b83253b6939f5e134572e17ac9fd6697c4fdd1740847957e68786a32fc3073cb0d29027563722cfec14796d426cff7e518b019106b225840a'),
                //     CURLOPT_HTTPHEADER => array(
                //         'cache-control: no-cache',
                //         'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                //         'postman-token: f9ad29df-daa5-ec23-f55a-61b11e4ae640'
                //     ),
                // ));

                // $response = json_decode(curl_exec($curl));

                // curl_close($curl);

                // $url = 'https://pay.easebuzz.in/pay/'.$response->data;
                // return Redirect::to($url);

                $user->wallet_amount = $user->wallet_amount + $request->amount;
                $user->save();

                //if transaction is successful
                if($user->start_date == '' || $user->start_date == null){
                    $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                    foreach($scheme_details as $details){
                        $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);    
                    }
                    //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                }
                $this->transaction($user, 'Credit', $request->amount, $request->reason);
                return back()->with('success', 'Amount has been Credited successfully');
            }            
        }
    }
    public function failurePayment(Request $request)
    {
         $errormessage = $request->input('error_Message');
         $name_on_card = $request->input('name_on_card');
         return view('payment.failed',compact('errormessage','name_on_card'));
    }

    public function transaction($user, $type, $amount, $remark) {
        $transaction = new Transaction;
        $transaction->transaction_id = $this->transaction_id();
        $transaction->user_id  = $user->id;
        $transaction->api_id  = 0; //work
        $transaction->type_creditdebit = $type;
        $transaction->scheme_price  = 0;  //work
        $transaction->status = 'Success';
        $transaction->amount = $amount;
        $transaction->remark = $remark;
        $transaction->updated_balance = $user->wallet_amount;
        $transaction->save();
    }

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

    public function deductwallet() {
    	
        return view('billing.deduct_wallet', compact('deduct_wallet'));
    }
}
