<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Models\ApiGroup;
use App\Models\ApiMaster;
use App\Models\UserSchemeMaster;
use App\Models\DemoUserSchemeMaster;
use App\Models\SchemeTypeMaster;
use Illuminate\Support\Facades\Schema;
use Mail;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->id == 1 && Auth::user()->role_id == 0) {
            $users = User::where('role_id', 1)
                ->orderBy('id', 'desc')
                ->get();
            return view('users.list', compact('users'));
        } elseif (Auth::user()->id != 1 && Auth::user()->role_id == 1) {
            if (Auth::user()->subparent_id == '' || Auth::user()->subparent_id == null) {
                $users = User::where('role_id', 1)
                    ->where('parent_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();

                return view('users.list', compact('users'));
            } else {
                $users = User::where('role_id', 1)
                    ->where('subparent_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();
                return view('users.list', compact('users'));
            }
        }
    }

    public function add()
    {
        $users = User::where('role_id', 1)->get();
        $api_group = ApiGroup::all();
        $scheme_types = SchemeTypeMaster::all();
        return view('users.add', compact('users', 'api_group', 'scheme_types'));
    }

    public function create(Request $request)
    {
        if (Auth::user()->id == 1 && Auth::user()->role_id == 0) {
            $users = new User();
            $users->scheme_type = $request->scheme_type;
            if ($request->scheme_type == 'demo') {
                $users->scheme_type_id = $request->scheme_type_id;
                $users->scheme_hit_count = 0;
            }
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->role_id = 1;
            $users->status = 0;
            $users->type = $request->rdo;
            $users->parent_id = Auth::user()->id;
            $users->subparent_id = Auth::user()->id;
            $users->verified = 0;
            $users->one_time_comission = $request->one_time_comission;
            if ($users->save()) {
                $update_access_token = User::where('id', $users->id)->first();
                $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                $update_access_token->save();
                $user_id = $users->id;
                // if($request->scheme_type=='production') {
                $plan_amount = '';
                $plan_duration = '';

                $ids = explode('/', $request->ids);
                foreach ($ids as $key => $value) {
                    $res = explode('|', $value);

                    if (isset($res[4])) {
                        if ($res[4] == 'basic') {
                            $plan_amount = '15000';
                            $plan_duration = '30';
                        } elseif ($res[4] == 'starter') {
                            $plan_amount = '37500';
                            $plan_duration = '90';
                        } elseif ($res[4] == 'standard') {
                            $plan_amount = '75000';
                            $plan_duration = '90';
                        } elseif ($res[4] == 'advance') {
                            $plan_amount = '150000';
                            $plan_duration = '180';
                        } elseif ($res[4] == 'growth') {
                            $plan_amount = '450000';
                            $plan_duration = '365';
                        } elseif ($res[4] == 'unicorn') {
                            $plan_amount = '750000';
                            $plan_duration = '365';
                        }
                        $selectedValuesResponse = $request->input('stage_response' . $res[0]);
                        $selectedValuesRequest = $request->input('request_value' . $res[0]);
                        if (!empty($selectedValuesResponse)) {
                         
                            $response_fileds = implode(',', $selectedValuesResponse);
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration), 'permission' => $response_fileds]);
                        }
                        if(!empty($selectedValuesRequest)){
                            $request_fileds = implode(',', $selectedValuesRequest);
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration),'request_permission' => $request_fileds]);
                        }
                        $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]);
                    }
                }
                // }else{
                //     $ids = explode("/", $request->ids);
                //     foreach ($ids as $key => $value) {
                //         $res = explode("|", $value);
                //         $user = UserSchemeMaster::updateOrCreate(
                //             ['user_id'=>$user_id, 'api_id'=>$res[0], 'scheme_price'=>$res[1],'api_group_id'=>$res[2]]
                //         );
                //     }
                // }
                $delete_ids = explode(',', $request->delete_ids);
                $user = UserSchemeMaster::where('user_id', $user_id)
                    ->whereIn('api_id', $delete_ids)
                    ->delete();

                // $name =  $users->name;
                // $subject = 'Welcome to DocBoyzApi';
                // $FromUser = 'pdfreports@docboyz.in';
                // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

                // // $userName = $user->name;
                // // $userEmail = $user->email;

                // $userName = "Ajay Bhalke";
                // $userEmail = "ajay@docboyz.in";

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

                //if transaction is successful
                // if($user->start_date == '' || $user->start_date == null){
                //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                //     foreach($scheme_details as $details){
                //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
                //     }
                //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                // }

                // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
                // {
                //     $message->to($userEmail, $userName)->subject($subject);
                //     $message->from($FromUser,'DocBoyzApi');
                // });
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User added successfully');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to add user details');
            }
        } elseif (Auth::user()->id != 1 && Auth::user()->role_id == 1) {
            if (Auth::user()->subparent_id == '' || Auth::user()->subparent_id == null) {
                $users = new User();
                $users->scheme_type = $request->scheme_type;
                if ($request->scheme_type == 'demo') {
                    $users->scheme_type_id = $request->scheme_type_id;
                    $users->scheme_hit_count = 0;
                }
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = bcrypt($request->password);
                $users->role_id = 1;
                $users->status = 0;
                $users->type = $request->rdo;
                $users->parent_id = Auth::user()->id;
                $users->subparent_id = Auth::user()->id;
                $users->verified = 0;
                $users->one_time_comission = $request->one_time_comission;
                if ($users->save()) {
                    $update_access_token = User::where('id', $users->id)->first();
                    $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                    $update_access_token->save();
                    $user_id = $users->id;
                    // if($request->scheme_type=='production') {
                    $plan_amount = '';
                    $plan_duration = '';

                    $ids = explode('/', $request->ids);
                    foreach ($ids as $key => $value) {
                        $res = explode('|', $value);

                        if (isset($res[4])) {
                            if ($res[4] == 'basic') {
                                $plan_amount = '15000';
                                $plan_duration = '30';
                            } elseif ($res[4] == 'starter') {
                                $plan_amount = '37500';
                                $plan_duration = '90';
                            } elseif ($res[4] == 'standard') {
                                $plan_amount = '75000';
                                $plan_duration = '90';
                            } elseif ($res[4] == 'advance') {
                                $plan_amount = '150000';
                                $plan_duration = '180';
                            } elseif ($res[4] == 'growth') {
                                $plan_amount = '450000';
                                $plan_duration = '365';
                            } elseif ($res[4] == 'unicorn') {
                                $plan_amount = '750000';
                                $plan_duration = '365';
                            }
                            $selectedValuesResponse = $request->input('stage_response' . $res[0]);
                            $selectedValuesRequest = $request->input('request_value' . $res[0]);
                            if (!empty($selectedValuesResponse)) {
                             
                                $response_fileds = implode(',', $selectedValuesResponse);
                                $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration), 'permission' => $response_fileds]);
                            }
                            if(!empty($selectedValuesRequest)){
                                $request_fileds = implode(',', $selectedValuesRequest);
                                $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration),'request_permission' => $request_fileds]);
                            }
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]);
                        }
                    }
                    // }else{
                    //     $ids = explode("/", $request->ids);
                    //     foreach ($ids as $key => $value) {
                    //         $res = explode("|", $value);
                    //         $user = UserSchemeMaster::updateOrCreate(
                    //             ['user_id'=>$user_id, 'api_id'=>$res[0], 'scheme_price'=>$res[1],'api_group_id'=>$res[2]]
                    //         );
                    //     }
                    // }
                    $delete_ids = explode(',', $request->delete_ids);
                    $user = UserSchemeMaster::where('user_id', $user_id)
                        ->whereIn('api_id', $delete_ids)
                        ->delete();

                    // $name =  $users->name;
                    // $subject = 'Welcome to DocBoyzApi';
                    // $FromUser = 'pdfreports@docboyz.in';
                    // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

                    // // $userName = $user->name;
                    // // $userEmail = $user->email;

                    // $userName = "Ajay Bhalke";
                    // $userEmail = "ajay@docboyz.in";

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

                    //if transaction is successful
                    // if($user->start_date == '' || $user->start_date == null){
                    //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                    //     foreach($scheme_details as $details){
                    //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
                    //     }
                    //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                    // }

                    // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
                    // {
                    //     $message->to($userEmail, $userName)->subject($subject);
                    //     $message->from($FromUser,'DocBoyzApi');
                    // });
                    return redirect()
                        ->route('user.list')
                        ->with('success', 'User added successfully');
                } else {
                    return redirect()
                        ->route('user.list')
                        ->with('error', 'Failed to add user details');
                }
            } else {
                $userparent = User::where('id', Auth::user()->id)->first();
                $users = new User();
                $users->scheme_type = $request->scheme_type;
                if ($request->scheme_type == 'demo') {
                    $users->scheme_type_id = $request->scheme_type_id;
                    $users->scheme_hit_count = 0;
                }
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = bcrypt($request->password);
                $users->role_id = 1;
                $users->status = 0;
                $users->type = $request->rdo;
                $users->parent_id = $userparent->parent_id;
                $users->subparent_id = Auth::user()->id;
                $users->verified = 0;
                $users->one_time_comission = $request->one_time_comission;
                if ($users->save()) {
                    $update_access_token = User::where('id', $users->id)->first();
                    $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                    $update_access_token->save();
                    $user_id = $users->id;
                    // if($request->scheme_type=='production') {
                    $plan_amount = '';
                    $plan_duration = '';

                    $ids = explode('/', $request->ids);
                    foreach ($ids as $key => $value) {
                        $res = explode('|', $value);

                        if (isset($res[4])) {
                            if ($res[4] == 'basic') {
                                $plan_amount = '15000';
                                $plan_duration = '30';
                            } elseif ($res[4] == 'starter') {
                                $plan_amount = '37500';
                                $plan_duration = '90';
                            } elseif ($res[4] == 'standard') {
                                $plan_amount = '75000';
                                $plan_duration = '90';
                            } elseif ($res[4] == 'advance') {
                                $plan_amount = '150000';
                                $plan_duration = '180';
                            } elseif ($res[4] == 'growth') {
                                $plan_amount = '450000';
                                $plan_duration = '365';
                            } elseif ($res[4] == 'unicorn') {
                                $plan_amount = '750000';
                                $plan_duration = '365';
                            }
                            $selectedValuesResponse = $request->input('stage_response' . $res[0]);
                            $selectedValuesRequest = $request->input('request_value' . $res[0]);
                            if (!empty($selectedValuesResponse)) {
                             
                                $response_fileds = implode(',', $selectedValuesResponse);
                                $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration), 'permission' => $response_fileds]);
                            }
                            if(!empty($selectedValuesRequest)){
                                $request_fileds = implode(',', $selectedValuesRequest);
                                $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration),'request_permission' => $request_fileds]);
                            }
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]);
                        }
                    }
                    // }else{
                    //     $ids = explode("/", $request->ids);
                    //     foreach ($ids as $key => $value) {
                    //         $res = explode("|", $value);
                    //         $user = UserSchemeMaster::updateOrCreate(
                    //             ['user_id'=>$user_id, 'api_id'=>$res[0], 'scheme_price'=>$res[1],'api_group_id'=>$res[2]]
                    //         );
                    //     }
                    // }
                    $delete_ids = explode(',', $request->delete_ids);
                    $user = UserSchemeMaster::where('user_id', $user_id)
                        ->whereIn('api_id', $delete_ids)
                        ->delete();

                    // $name =  $users->name;
                    // $subject = 'Welcome to DocBoyzApi';
                    // $FromUser = 'pdfreports@docboyz.in';
                    // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

                    // // $userName = $user->name;
                    // // $userEmail = $user->email;

                    // $userName = "Ajay Bhalke";
                    // $userEmail = "ajay@docboyz.in";

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

                    //if transaction is successful
                    // if($user->start_date == '' || $user->start_date == null){
                    //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                    //     foreach($scheme_details as $details){
                    //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
                    //     }
                    //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                    // }

                    // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
                    // {
                    //     $message->to($userEmail, $userName)->subject($subject);
                    //     $message->from($FromUser,'DocBoyzApi');
                    // });
                    return redirect()
                        ->route('user.list')
                        ->with('success', 'User added successfully');
                } else {
                    return redirect()
                        ->route('user.list')
                        ->with('error', 'Failed to add user details');
                }
            }
        } else {
            $users = new User();
            $users->scheme_type = $request->scheme_type;
            if ($request->scheme_type == 'demo') {
                $users->scheme_type_id = $request->scheme_type_id;
                $users->scheme_hit_count = 0;
            }
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->role_id = 1;
            $users->status = 0;
            $users->type = $request->rdo;
            $users->parent_id = null;
            $users->subparent_id = null;
            $users->verified = 0;
            $users->one_time_comission = $request->one_time_comission;
            if ($users->save()) {
                $update_access_token = User::where('id', $users->id)->first();
                $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                $update_access_token->save();
                $user_id = $users->id;
                // if($request->scheme_type=='production') {
                $plan_amount = '';
                $plan_duration = '';

                $ids = explode('/', $request->ids);
                foreach ($ids as $key => $value) {
                    $res = explode('|', $value);

                    if (isset($res[4])) {
                        if ($res[4] == 'basic') {
                            $plan_amount = '15000';
                            $plan_duration = '30';
                        } elseif ($res[4] == 'starter') {
                            $plan_amount = '37500';
                            $plan_duration = '90';
                        } elseif ($res[4] == 'standard') {
                            $plan_amount = '75000';
                            $plan_duration = '90';
                        } elseif ($res[4] == 'advance') {
                            $plan_amount = '150000';
                            $plan_duration = '180';
                        } elseif ($res[4] == 'growth') {
                            $plan_amount = '450000';
                            $plan_duration = '365';
                        } elseif ($res[4] == 'unicorn') {
                            $plan_amount = '750000';
                            $plan_duration = '365';
                        }
                        $selectedValuesResponse = $request->input('stage_response' . $res[0]);
                        $selectedValuesRequest = $request->input('request_value' . $res[0]);
                        if (!empty($selectedValuesResponse)) {
                         
                            $response_fileds = implode(',', $selectedValuesResponse);
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration), 'permission' => $response_fileds]);
                        }
                        if(!empty($selectedValuesRequest)){
                            $request_fileds = implode(',', $selectedValuesRequest);
                            $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration),'request_permission' => $request_fileds]);
                        }
                        $user = UserSchemeMaster::updateOrCreate(['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5]], ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]);
                    }
                }
                // }else{
                //     $ids = explode("/", $request->ids);
                //     foreach ($ids as $key => $value) {
                //         $res = explode("|", $value);
                //         $user = UserSchemeMaster::updateOrCreate(
                //             ['user_id'=>$user_id, 'api_id'=>$res[0], 'scheme_price'=>$res[1],'api_group_id'=>$res[2]]
                //         );
                //     }
                // }
                $delete_ids = explode(',', $request->delete_ids);
                $user = UserSchemeMaster::where('user_id', $user_id)
                    ->whereIn('api_id', $delete_ids)
                    ->delete();

                // $name =  $users->name;
                // $subject = 'Welcome to DocBoyzApi';
                // $FromUser = 'pdfreports@docboyz.in';
                // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

                // // $userName = $user->name;
                // // $userEmail = $user->email;

                // $userName = "Ajay Bhalke";
                // $userEmail = "ajay@docboyz.in";

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

                //if transaction is successful
                // if($user->start_date == '' || $user->start_date == null){
                //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
                //     foreach($scheme_details as $details){
                //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
                //     }
                //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
                // }

                // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
                // {
                //     $message->to($userEmail, $userName)->subject($subject);
                //     $message->from($FromUser,'DocBoyzApi');
                // });
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User added successfully');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to add user details');
            }
        }
    }
    public function delete($id)
    {
        $users = User::where('id', $id)->delete();
        $userSchemeMaster = UserSchemeMaster::where('user_id', $id)->delete();
        return redirect()
            ->route('user.list')
            ->with('success', 'User deleted successfully');
    }

    public function editold($id)
    {
        $user = User::where('id', $id)->first();
        $api_group = ApiGroup::all();
        $user_scheme = UserSchemeMaster::where('user_id', $id)->get();
        $scheme_types = SchemeTypeMaster::all();
        $user_scheme_ids = '';
        foreach ($user_scheme as $key => $value) {
            $user_scheme_ids .= $value->api_id . '|' . $value->scheme_price . '|' . $value->api_group_id . ',';
        }
        $user_scheme_ids = rtrim($user_scheme_ids, ',');
        $user_scheme_arr = UserSchemeMaster::where('user_id', $id)
            ->pluck('api_id')
            ->toArray();
        $user_scheme_range = UserSchemeMaster::where('user_id', $id)
            ->pluck('payment_slab', 'api_id')
            ->toArray();
        $user_scheme_price = UserSchemeMaster::where('user_id', $id)
            ->pluck('scheme_price', 'api_id')
            ->toArray();
        $user_scheme_details = UserSchemeMaster::where('user_id', $id)->get();
        $count = 0;
        foreach ($user_scheme_details as $user_scheme) {
            if ($user_scheme['end_date'] == '' || $user_scheme['end_date'] == null || Carbon::parse($user_scheme['end_date'])->isPast() != true) {
                $count++;
            }
        }
        $renew = 'false';
        if ($count > 0) {
            $renew = 'false';
        } else {
            $renew = 'true';
        }
        return view('users.edit_old', compact('user_scheme_range', 'renew', 'user_scheme_details', 'user', 'api_group', 'user_scheme_ids', 'user_scheme_arr', 'user_scheme_price', 'scheme_types'));
    }

    // public function update(Request $request) {
    //     $user = User::where('id',$request->user_id)->first();
    //     $user->name = $request->name;
    //     if($request->scheme_type=='demo') {
    //         $user->scheme_type = $request->scheme_type;
    //         $user->scheme_type_id = $request->scheme_type_id;
    //         $user->scheme_hit_count = 0;
    //     }
    //     else
    //     {
    //         $user->scheme_type = $request->scheme_type;
    //         $user->scheme_type_id = null;
    //         $user->scheme_hit_count = null;
    //     }
    //     $user->save();

    //     $user_id = $request->user_id;
    //     $ids = explode(",", $request->ids);
    //     foreach ($ids as $key => $value) {
    //         $res = explode("|", $value);
    //         $user = UserSchemeMaster::updateOrCreate(
    //             ['user_id'=>$user_id, 'api_id'=>$res[0]],
    //             ['scheme_price'=>$res[1],'api_group_id'=>$res[2]]
    //         );
    //     }
    //     $delete_ids = explode(",", $request->delete_ids);
    //     $user = UserSchemeMaster::where('user_id',$user_id)->whereIn('api_id',$delete_ids)->delete();
    //     return back()->with('success','User scheme updated successful');
    // }

    public function updateold(Request $request)
    {
        // dd($request->ids);
        if ($request->renew == 'false') {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id,
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null,
                ]);
            }

            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;

            $ids = explode('/', $request->ids);
            $start_date = '';
            $end_date = '';
            // $ids = array_values(array_unique($ids));

            foreach ($ids as $key => $value) {
                $res = explode('|', $value);
                if (isset($res[4])) {
                    if ($res[4] == 'basic') {
                        $plan_amount = '15000';
                        $plan_duration = '30';
                    } elseif ($res[4] == 'starter') {
                        $plan_amount = '37500';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'standard') {
                        $plan_amount = '75000';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'advance') {
                        $plan_amount = '150000';
                        $plan_duration = '180';
                    } elseif ($res[4] == 'growth') {
                        $plan_amount = '450000';
                        $plan_duration = '365';
                    } elseif ($res[4] == 'unicorn') {
                        $plan_amount = '750000';
                        $plan_duration = '365';
                    }
                    $start_date = Carbon::now();
                    $end_date = Carbon::now()->addDays($plan_duration);
                    $user_scheme_details = UserSchemeMaster::where('user_id', $request->user_id)
                        ->where('api_id', $res[0])
                        ->first();

                    if ($user_scheme_details) {
                        if ($user_scheme_details['end_date'] == '' || $user_scheme_details['end_date'] == null) {
                            $start_date = Carbon::now();
                            $end_date = Carbon::now()->addDays($plan_duration);
                        } else {
                            $start_date = $user_scheme_details['start_date'];
                            $end_date = $user_scheme_details['end_date'];
                        }
                        $user = UserSchemeMaster::where(['user_id' => $request->user_id, 'api_id' => $res[0]])->update([
                            'api_id' => $res[0],
                            'plan' => $res[4],
                            'plan_amount' => $plan_amount,
                            'duration' => $plan_duration,
                            'custom_plan' => $res[3],
                            'payment_slab' => $res[5],
                            'scheme_price' => $res[1],
                            'api_group_id' => $res[2],
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                        ]);
                    } else {
                        $user = new UserSchemeMaster();
                        $user->user_id = $request->user_id;
                        $user->api_id = $res[0];
                        $user->plan = $res[4];
                        $user->plan_amount = $plan_amount;
                        $user->duration = $plan_duration;
                        $user->custom_plan = $res[3];
                        $user->payment_slab = $res[5];
                        $user->scheme_price = $res[1];
                        $user->api_group_id = $res[2];
                        $user->start_date = $start_date;
                        $user->end_date = $end_date;

                        $user->save();
                    }
                }
            }

            // $name =  $users->name;
            // $subject = 'Welcome to DocBoyzApi';
            // $FromUser = 'pdfreports@docboyz.in';
            // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

            // $userName = $user->name;
            // $userEmail = $user->email;

            // $userName = "Ajay Bhalke";
            // $userEmail = "ajay@docboyz.in";

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

            //if transaction is successful
            // if($user->start_date == '' || $user->start_date == null){
            //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
            //     foreach($scheme_details as $details){
            //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
            //     }
            //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
            // }

            // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
            // {
            //     $message->to($userEmail, $userName)->subject($subject);
            //     $message->from($FromUser,'DocBoyzApi');
            // });
            if ($user) {
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User details updated successfully.');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to update user details.');
            }
        } else {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id,
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null,
                ]);
            }

            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // $update_access_token = User::where('id',$request->user_id)->first();
            // $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
            // $update_access_token->save();

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;
            $ids = explode('/', $request->ids);
            foreach ($ids as $key => $value) {
                $res = explode('|', $value);
                if (isset($res[4])) {
                    if ($res[4] == 'basic') {
                        $plan_amount = '15000';
                        $plan_duration = '30';
                    } elseif ($res[4] == 'starter') {
                        $plan_amount = '37500';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'standard') {
                        $plan_amount = '75000';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'advance') {
                        $plan_amount = '150000';
                        $plan_duration = '180';
                    } elseif ($res[4] == 'growth') {
                        $plan_amount = '450000';
                        $plan_duration = '365';
                    } elseif ($res[4] == 'unicorn') {
                        $plan_amount = '750000';
                        $plan_duration = '365';
                    }

                    $user = new UserSchemeMaster();
                    $user->user_id = $request->user_id;
                    $user->api_id = $res[0];
                    $user->plan = $res[4];
                    $user->plan_amount = $plan_amount;
                    $user->duration = $plan_duration;
                    $user->custom_plan = $res[3];
                    $user->payment_slab = $res[5];
                    $user->scheme_price = $res[1];
                    $user->api_group_id = $res[2];
                    $user->start_date = Carbon::now();
                    $user->end_date = Carbon::now()->addDays($plan_duration);

                    $user->save();
                }
            }

            // $name =  $users->name;
            // $subject = 'Welcome to DocBoyzApi';
            // $FromUser = 'pdfreports@docboyz.in';
            // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

            // $userName = $user->name;
            // $userEmail = $user->email;

            // $userName = "Ajay Bhalke";
            // $userEmail = "ajay@docboyz.in";

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

            //if transaction is successful
            // if($user->start_date == '' || $user->start_date == null){
            //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
            //     foreach($scheme_details as $details){
            //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
            //     }
            //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
            // }

            // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
            // {
            //     $message->to($userEmail, $userName)->subject($subject);
            //     $message->from($FromUser,'DocBoyzApi');
            // });
            if ($user) {
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User details updated successfully');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to update user details');
            }
        }
    }

    public function edit($id)
    {
       
        $user = User::where('id', $id)->first();
        $api_group = ApiGroup::all();
        $user_scheme = UserSchemeMaster::where('user_id', $id)->get();
        $scheme_types = SchemeTypeMaster::all();
        $user_scheme_ids = '';
        foreach ($user_scheme as $key => $value) {
            $user_scheme_ids .= $value->api_id . '|' . $value->scheme_price . '|' . $value->api_group_id . ',';
        }
        $user_scheme_ids = rtrim($user_scheme_ids, ',');
        $user_scheme_arr = UserSchemeMaster::where('user_id', $id)
            ->pluck('api_id')
            ->toArray();
        $user_scheme_range = UserSchemeMaster::where('user_id', $id)
            ->pluck('payment_slab', 'api_id')
            ->toArray();
        $user_scheme_price = UserSchemeMaster::where('user_id', $id)
            ->pluck('scheme_price', 'api_id')
            ->toArray(); 
          
        $user_scheme_details = UserSchemeMaster::where('user_id', $id)->get();
      
        $count = 0;
        foreach ($user_scheme_details as $user_scheme) {
            if ($user_scheme['end_date'] == '' || $user_scheme['end_date'] == null || Carbon::parse($user_scheme['end_date'])->isPast() != true) {
                $count++;
            }
        }
        $renew = 'false';
        if ($count > 0) {
            $renew = 'false';
        } else {
            $renew = 'true';
        }
        $tableName = 'rcvalidation';
        $rccolumns = Schema::getColumnListing($tableName);
        // return $rccolumns;

        return view('users.edit', compact('user_scheme_range', 'renew', 'user_scheme_details', 'rccolumns', 'user', 'api_group', 'user_scheme_ids', 'user_scheme_arr', 'user_scheme_price', 'scheme_types'));
    }

    public function update(Request $request)
    {
         
        $txtPlanPrice = $request->input('txtPlanPricedemo');
        $txtUserPrice = $request->input('txtUserPricedemo');
        if ($request->renew == 'false') {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id,
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null,
                ]);
            }

            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;

            $ids = explode('/', $request->ids);
            $start_date = '';
            $end_date = '';
            // $ids = array_values(array_unique($ids));

            foreach ($ids as $key => $value) {
                $res = explode('|', $value);
                if (isset($res[4])) {
                    if ($res[4] == 'basic') {
                        $plan_amount = '15000';
                        $plan_duration = '30';
                    } elseif ($res[4] == 'starter') {
                        $plan_amount = '37500';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'standard') {
                        $plan_amount = '75000';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'advance') {
                        $plan_amount = '150000';
                        $plan_duration = '180';
                    } elseif ($res[4] == 'growth') {
                        $plan_amount = '450000';
                        $plan_duration = '365';
                    } elseif ($res[4] == 'unicorn') {
                        $plan_amount = '750000';
                        $plan_duration = '365';
                    }
                    $start_date = Carbon::now();
                    $end_date = Carbon::now()->addDays($plan_duration);
                    $user_scheme_details = UserSchemeMaster::where('user_id', $request->user_id)
                        ->where('api_id', $res[0])
                        ->first();
                    $selectedValuesResponse = $request->input('stage_response'.$res[0]);
                    $selectedValuesRequest = $request->input('request_value'.$res[0]);
                     $selected_value = null;
                     $selected_value_req = null;
                   if (!empty($selectedValuesResponse)) {
                         $selected_value = implode(',',$selectedValuesResponse);
                          $api_master = DB::table('api_master')
                            ->where('api_slug', $selectedValuesResponse[0])
                            ->first();
                     
                        $insert_value = DB::table('user_scheme_master')
                            ->where('user_id', $request->user_id)
                            ->where('api_id', $api_master->id)
                            ->update(['permission' => $selected_value]);
                    }
                    if(!empty($selectedValuesRequest)){
                        $selected_value_req =implode(',',$selectedValuesRequest);
                         $api_master = DB::table('api_master')
                           ->where('api_slug', $selectedValuesRequest[0])
                           ->first();
                    
                       $insert_value = DB::table('user_scheme_master')
                           ->where('user_id', $request->user_id)
                           ->where('api_id', $api_master->id)
                           ->update(['request_permission' => $selected_value_req]);
                    }
                   if ($user_scheme_details) {
                        if ($user_scheme_details['end_date'] == '' || $user_scheme_details['end_date'] == null) {
                            $start_date = Carbon::now();
                            $end_date = Carbon::now()->addDays($plan_duration);
                        } else {
                            $start_date = $user_scheme_details['start_date'];
                            $end_date = $user_scheme_details['end_date'];
                        }
                        $user = UserSchemeMaster::where(['user_id' => $request->user_id, 'api_id' => $res[0]])->update([
                            'api_id' => $res[0],
                            'plan' => $res[4],
                            'plan_amount' => $plan_amount,
                            'duration' => $plan_duration,
                            'custom_plan' => $res[3],
                            'payment_slab' => $res[5],
                            'scheme_price' => $res[1],
                            'api_group_id' => $res[2],
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                        ]);
                       
                    } else {
                        $user = new UserSchemeMaster();
                        $user->user_id = $request->user_id;
                        $user->api_id = $res[0];
                        $user->plan = $res[4];
                        $user->plan_amount = $plan_amount;
                        $user->duration = $plan_duration;
                        $user->custom_plan = $res[3];
                        $user->payment_slab = $res[5];
                        $user->scheme_price = $res[1];
                        $user->api_group_id = $res[2];
                        $user->start_date = $start_date;
                        $user->end_date = $end_date;
                        $user->permission =$selected_value;
                        $user->request_permission=$selected_value_req;
                        $user->save();
                    }
                }
            }

            // $name =  $users->name;
            // $subject = 'Welcome to DocBoyzApi';
            // $FromUser = 'pdfreports@docboyz.in';
            // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

            // $userName = $user->name;
            // $userEmail = $user->email;

            // $userName = "Ajay Bhalke";
            // $userEmail = "ajay@docboyz.in";

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

            //if transaction is successful
            // if($user->start_date == '' || $user->start_date == null){
            //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
            //     foreach($scheme_details as $details){
            //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
            //     }
            //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
            // }

            // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
            // {
            //     $message->to($userEmail, $userName)->subject($subject);
            //     $message->from($FromUser,'DocBoyzApi');
            // });
            if ($user) {
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User details updated successfully.');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to update user details.');
            }
        } else {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id,
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null,
                ]);
            }
            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // $update_access_token = User::where('id',$request->user_id)->first();
            // $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
            // $update_access_token->save();

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;

            $ids = explode('/', $request->ids);

            foreach ($ids as $key => $value) {
                $res = explode('|', $value);
               
                if (isset($res[4])) {
                    if ($res[4] == 'basic') {
                        $plan_amount = '15000';
                        $plan_duration = '30';
                    } elseif ($res[4] == 'starter') {
                        $plan_amount = '37500';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'standard') {
                        $plan_amount = '75000';
                        $plan_duration = '90';
                    } elseif ($res[4] == 'advance') {
                        $plan_amount = '150000';
                        $plan_duration = '180';
                    } elseif ($res[4] == 'growth') {
                        $plan_amount = '450000';
                        $plan_duration = '365';
                    } elseif ($res[4] == 'unicorn') {
                        $plan_amount = '750000';
                        $plan_duration = '365';
                    }

                    $user = UserSchemeMaster::where('user_id', $request->user_id)
                        ->where('api_id', $res[0])
                        ->first();
                        $selectedValuesResponse = $request->input('stage_response'.$res[0]);
                        $selectedValuesRequest = $request->input('request_value'.$res[0]);
                         $selected_value = null;
                         $selected_value_req = null;
                       if (!empty($selectedValuesResponse)) {
                             $selected_value = implode(',',$selectedValuesResponse);
                              $api_master = DB::table('api_master')
                                ->where('api_slug', $selectedValuesResponse[0])
                                ->first();
                         
                            $insert_value = DB::table('user_scheme_master')
                                ->where('user_id', $request->user_id)
                                ->where('api_id', $api_master->id)
                                ->update(['permission' => $selected_value]);
                        }
                        if(!empty($selectedValuesRequest)){
                            $selected_value_req =implode(',',$selectedValuesRequest);
                             $api_master = DB::table('api_master')
                               ->where('api_slug', $selectedValuesRequest[0])
                               ->first();
                        
                           $insert_value = DB::table('user_scheme_master')
                               ->where('user_id', $request->user_id)
                               ->where('api_id', $api_master->id)
                               ->update(['request_permission' => $selected_value_req]);
                        }
                    if (isset($user)) {
                        $user->user_id = $request->user_id;
                        $user->api_id = $res[0];
                        $user->plan = $res[4];
                        $user->plan_amount = $plan_amount;
                        $user->duration = $plan_duration;
                        $user->custom_plan = $res[3];
                        $user->payment_slab = $res[5];
                        $user->scheme_price = $res[1];
                        $user->api_group_id = $res[2];
                        $user->start_date = Carbon::now();
                        $user->end_date = Carbon::now()->addDays($plan_duration);
                        $user->save();
                    } else {
                        $user = new UserSchemeMaster();
                        $user->user_id = $request->user_id;
                        $user->api_id = $res[0];
                        $user->plan = $res[4];
                        $user->plan_amount = $plan_amount;
                        $user->duration = $plan_duration;
                        $user->custom_plan = $res[3];
                        $user->payment_slab = $res[5];
                        $user->scheme_price = $res[1];
                        $user->api_group_id = $res[2];
                        $user->start_date = Carbon::now();
                        $user->end_date = Carbon::now()->addDays($plan_duration);
                        $user->permission =$selected_value;
                        $user->request_permission=$selected_value_req;
                        $user->save();
                    }
                }
            }

            // $name =  $users->name;
            // $subject = 'Welcome to DocBoyzApi';
            // $FromUser = 'pdfreports@docboyz.in';
            // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

            // $userName = $user->name;
            // $userEmail = $user->email;

            // $userName = "Ajay Bhalke";
            // $userEmail = "ajay@docboyz.in";

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

            //if transaction is successful
            // if($user->start_date == '' || $user->start_date == null){
            //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
            //     foreach($scheme_details as $details){
            //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
            //     }
            //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
            // }

            // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
            // {
            //     $message->to($userEmail, $userName)->subject($subject);
            //     $message->from($FromUser,'DocBoyzApi');
            // });
            if ($user) {
                return redirect()
                    ->route('user.list')
                    ->with('success', 'User details updated successfully');
            } else {
                return redirect()
                    ->route('user.list')
                    ->with('error', 'Failed to update user details');
            }
        }
    }
    // public function update(Request $request) {

    //      $selectedValues = $request->input('stage_id');
    //      $selectedValuesRequest = $request->input('request_value');
    //      $txtPlanPrice = $request->input('txtPlanPricedemo');
    //      $txtUserPrice = $request->input('txtUserPricedemo');
    //      if(!empty($selectedValues)){

    //         $api_master = DB::table('api_master')->where('api_slug',$selectedValues[0])->first();

    //         $selected_value = implode(",",$selectedValues);
    //         $insert_value = DB::table('user_scheme_master')->where('user_id',$request->user_id)->where('api_id',$api_master->id)->update(['permission'=>$selected_value]);
    //      }
    //      if(!empty($selectedValuesRequest)){
    //         $api_master_req = DB::table('api_master')->where('api_slug',$selectedValuesRequest[0])->first();
    //         $selected_value_req = implode(",",$selectedValuesRequest);
    //         $insert_value = DB::table('user_scheme_master')->where('user_id',$request->user_id)->where('api_id',$api_master_req->id)->update(['request_permission'=>$selected_value_req]);
    //      }

    //      $selectedRequestValues = $request->input('request_value');
    //      $api_master = DB::table('api_master')->where('api_slug',$selectedValues[0])->first();
    //      $selected_value = implode(",",$selectedValues);
    //      $insert_value = DB::table('user_scheme_master')->where('user_id',$request->user_id)->where('api_id',$api_master->id)->update(['permission'=>$selected_value]);
    //       if($request->renew == 'false'){
    //         if($request->scheme_type=='demo') {
    //             $users = User::where('id',$request->user_id)->update([
    //                 'scheme_type' => $request->scheme_type,
    //                 'scheme_type_id' => $request->scheme_type_id
    //             ]);

    //         }else{
    //             $users = User::where('id',$request->user_id)->update([
    //                 'scheme_type' => $request->scheme_type,
    //                 'scheme_type_id' => null,
    //                 'scheme_hit_count' => null
    //             ]);
    //         }

    //         $users = User::where('id',$request->user_id)->update([
    //             'name' => $request->name,
    //             'email' => $request->email
    //         ]);

    //         $plan_amount = '';
    //         $plan_duration = '';

    //         $user_id = $request->user_id;

    //         $ids = explode("/", $request->ids);
    //         $start_date = '';
    //         $end_date = '';
    //         // $ids = array_values(array_unique($ids));

    //         foreach ($ids as $key => $value) {
    //             $res = explode("|", $value);
    //             if(isset($res[4])){
    //                 if($res[4] == 'basic'){
    //                     $plan_amount = '15000';
    //                     $plan_duration = '30';
    //                 }elseif($res[4] == 'starter'){
    //                     $plan_amount = '37500';
    //                     $plan_duration = '90';
    //                 }elseif($res[4] == 'standard'){
    //                     $plan_amount = '75000';
    //                     $plan_duration = '90';
    //                 }elseif($res[4] == 'advance'){
    //                     $plan_amount = '150000';
    //                     $plan_duration = '180';
    //                 }elseif($res[4] == 'growth'){
    //                     $plan_amount = '450000';
    //                     $plan_duration = '365';
    //                 }elseif($res[4] == 'unicorn'){
    //                     $plan_amount = '750000';
    //                     $plan_duration = '365';
    //                 }
    //                 $start_date = Carbon::now();
    //                 $end_date = Carbon::now()->addDays($plan_duration);
    //                 $user_scheme_details = UserSchemeMaster::where('user_id', $request->user_id)->where('api_id', $res[0])->first();

    //                 if($user_scheme_details){
    //                     if($user_scheme_details['end_date'] == '' || $user_scheme_details['end_date'] == null){
    //                         $start_date = Carbon::now();
    //                         $end_date = Carbon::now()->addDays($plan_duration);
    //                     }else{
    //                         $start_date = $user_scheme_details['start_date'];
    //                         $end_date = $user_scheme_details['end_date'];
    //                     }
    //                     $user = UserSchemeMaster::where(['user_id'=> $request->user_id, 'api_id' => $res[0]])->update([
    //                         'api_id'=>$res[0],
    //                         'plan'=>$res[4],
    //                         'plan_amount'=>$plan_amount,
    //                         'duration'=>$plan_duration,
    //                         'custom_plan'=>$res[3],
    //                         'payment_slab'=>$res[5],
    //                         'scheme_price'=>$res[1],
    //                         'api_group_id'=>$res[2],
    //                         'start_date'=>$start_date,
    //                         'end_date'=>$end_date
    //                     ]);
    //                 }else{

    //                     $user = new UserSchemeMaster;
    //                     $user->user_id = $request->user_id;
    //                     $user->api_id = $res[0];
    //                     $user->plan = $res[4];
    //                     $user->plan_amount = $plan_amount;
    //                     $user->duration = $plan_duration;
    //                     $user->custom_plan = $res[3];
    //                     $user->payment_slab = $res[5];
    //                     $user->scheme_price = $res[1];
    //                     $user->api_group_id = $res[2];
    //                     $user->start_date = $start_date;
    //                     $user->end_date = $end_date;
    //                     $user->save();
    //                 }
    //             }
    //         }

    //         // $name =  $users->name;
    //         // $subject = 'Welcome to DocBoyzApi';
    //         // $FromUser = 'pdfreports@docboyz.in';
    //         // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

    //         // $userName = $user->name;
    //         // $userEmail = $user->email;

    //         // $userName = "Ajay Bhalke";
    //         // $userEmail = "ajay@docboyz.in";

    //         // $curl = curl_init();

    //         // curl_setopt_array($curl, array(
    //         //     CURLOPT_URL => 'https://testpay.easebuzz.in/payment/initiateLink',
    //         //     CURLOPT_RETURNTRANSFER => true,
    //         //     CURLOPT_ENCODING => '',
    //         //     CURLOPT_MAXREDIRS => 10,
    //         //     CURLOPT_TIMEOUT => 0,
    //         //     CURLOPT_FOLLOWLOCATION => true,
    //         //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         //     CURLOPT_CUSTOMREQUEST => 'POST',
    //         //     CURLOPT_POSTFIELDS => array('key' => '2PBP7IABZ2', 'txnid' => 'CDEF', 'amount' => $request->amount, 'productinfo' => 'Recharge', 'firstname' => $user->name, 'phone' => '9876543210', 'email' => $user->email, 'surl' => 'https://docs.easebuzz.in/code-response/success', 'furl' => 'https://docs.easebuzz.in/code-response/failure', 'hash' => '0b502773b129744b83253b6939f5e134572e17ac9fd6697c4fdd1740847957e68786a32fc3073cb0d29027563722cfec14796d426cff7e518b019106b225840a'),
    //         //     CURLOPT_HTTPHEADER => array(
    //         //         'cache-control: no-cache',
    //         //         'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
    //         //         'postman-token: f9ad29df-daa5-ec23-f55a-61b11e4ae640'
    //         //     ),
    //         // ));

    //         // $response = json_decode(curl_exec($curl));

    //         // curl_close($curl);

    //         // $url = 'https://pay.easebuzz.in/pay/'.$response->data;
    //         // return Redirect::to($url);

    //         //if transaction is successful
    //         // if($user->start_date == '' || $user->start_date == null){
    //         //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
    //         //     foreach($scheme_details as $details){
    //         //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
    //         //     }
    //         //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
    //         // }

    //         // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
    //         // {
    //         //     $message->to($userEmail, $userName)->subject($subject);
    //         //     $message->from($FromUser,'DocBoyzApi');
    //         // });
    //         if($user){
    //             return redirect()->route('user.list')->with('success','User details updated successfully.');
    //         } else {
    //             return redirect()->route('user.list')->with('error','Failed to update user details.');
    //         }
    //     }else{

    //         if($request->scheme_type=='demo') {
    //             $users = User::where('id',$request->user_id)->update([
    //                 'scheme_type' => $request->scheme_type,
    //                 'scheme_type_id' => $request->scheme_type_id
    //             ]);
    //         }else{

    //             $users = User::where('id',$request->user_id)->update([
    //                 'scheme_type' => $request->scheme_type,
    //                 'scheme_type_id' => null,
    //                 'scheme_hit_count' => null
    //             ]);
    //         }
    //         $users = User::where('id',$request->user_id)->update([
    //             'name' => $request->name,
    //             'email' => $request->email
    //         ]);

    //         // $update_access_token = User::where('id',$request->user_id)->first();
    //         // $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
    //         // $update_access_token->save();

    //         $plan_amount = '';
    //         $plan_duration = '';

    //         $user_id = $request->user_id;
    //         $ids = explode("/", $request->ids);
    //         foreach ($ids as $key => $value) {
    //             $res = explode("|", $value);
    //             if(isset($res[4])){
    //                 if($res[4] == 'basic'){
    //                     $plan_amount = '15000';
    //                     $plan_duration = '30';
    //                 }elseif($res[4] == 'starter'){
    //                     $plan_amount = '37500';
    //                     $plan_duration = '90';
    //                 }elseif($res[4] == 'standard'){
    //                     $plan_amount = '75000';
    //                     $plan_duration = '90';
    //                 }elseif($res[4] == 'advance'){
    //                     $plan_amount = '150000';
    //                     $plan_duration = '180';
    //                 }elseif($res[4] == 'growth'){
    //                     $plan_amount = '450000';
    //                     $plan_duration = '365';
    //                 }elseif($res[4] == 'unicorn'){
    //                     $plan_amount = '750000';
    //                     $plan_duration = '365';
    //                 }

    //                 $user = new UserSchemeMaster;
    //                 $user->user_id = $request->user_id;
    //                 $user->api_id = $res[0];
    //                 $user->plan = $res[4];
    //                 $user->plan_amount = $plan_amount;
    //                 $user->duration = $plan_duration;
    //                 $user->custom_plan = $res[3];
    //                 $user->payment_slab = $res[5];
    //                 $user->scheme_price = $res[1];
    //                 $user->api_group_id = $res[2];
    //                 $user->start_date = Carbon::now();
    //                 $user->end_date = Carbon::now()->addDays($plan_duration);
    //                 $user->save();

    //             }
    //         }

    //         // $name =  $users->name;
    //         // $subject = 'Welcome to DocBoyzApi';
    //         // $FromUser = 'pdfreports@docboyz.in';
    //         // $message1 = 'Your email Id:'.$users->email."<br>".'Your password:'.$request->password;

    //         // $userName = $user->name;
    //         // $userEmail = $user->email;

    //         // $userName = "Ajay Bhalke";
    //         // $userEmail = "ajay@docboyz.in";

    //         // $curl = curl_init();

    //         // curl_setopt_array($curl, array(
    //         //     CURLOPT_URL => 'https://testpay.easebuzz.in/payment/initiateLink',
    //         //     CURLOPT_RETURNTRANSFER => true,
    //         //     CURLOPT_ENCODING => '',
    //         //     CURLOPT_MAXREDIRS => 10,
    //         //     CURLOPT_TIMEOUT => 0,
    //         //     CURLOPT_FOLLOWLOCATION => true,
    //         //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         //     CURLOPT_CUSTOMREQUEST => 'POST',
    //         //     CURLOPT_POSTFIELDS => array('key' => '2PBP7IABZ2', 'txnid' => 'CDEF', 'amount' => $request->amount, 'productinfo' => 'Recharge', 'firstname' => $user->name, 'phone' => '9876543210', 'email' => $user->email, 'surl' => 'https://docs.easebuzz.in/code-response/success', 'furl' => 'https://docs.easebuzz.in/code-response/failure', 'hash' => '0b502773b129744b83253b6939f5e134572e17ac9fd6697c4fdd1740847957e68786a32fc3073cb0d29027563722cfec14796d426cff7e518b019106b225840a'),
    //         //     CURLOPT_HTTPHEADER => array(
    //         //         'cache-control: no-cache',
    //         //         'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
    //         //         'postman-token: f9ad29df-daa5-ec23-f55a-61b11e4ae640'
    //         //     ),
    //         // ));

    //         // $response = json_decode(curl_exec($curl));

    //         // curl_close($curl);

    //         // $url = 'https://pay.easebuzz.in/pay/'.$response->data;
    //         // return Redirect::to($url);

    //         //if transaction is successful
    //         // if($user->start_date == '' || $user->start_date == null){
    //         //     $scheme_details = UserSchemeMaster::where('user_id',Auth()->user()->id)->get();
    //         //     foreach($scheme_details as $details){
    //         //         $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date'=> Carbon::now(), 'end_date'=> Carbon::now()->addDays($details->duration)]);
    //         //     }
    //         //     //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
    //         // }

    //         // Mail::send(['html'=>'emails.userAdd'], ['name' => $name, 'message1' => $message1, 'user'=>$users, 'password'=>$request->password], function($message) use($subject, $user, $FromUser, $message1, $userName, $userEmail)
    //         // {
    //         //     $message->to($userEmail, $userName)->subject($subject);
    //         //     $message->from($FromUser,'DocBoyzApi');
    //         // });
    //         if($user){
    //             return redirect()->route('user.list')->with('success','User details updated successfully');
    //         } else {
    //             return redirect()->route('user.list')->with('error','Failed to update user details');
    //         }
    //     }
    // }

    //new users
     public function changePassword()
    {
        return view('users.change_password');
    }
    public function dglocker()
    {
        // dd('test');
        return Redirect::to('https://www.docboyz.in/Karzacallbock');
        // return view('users.change_password');
    }

    public function changePasswordSave(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_data = User::where('id', $user_id)->first();

        $old_password = $request->oldpassword;
        $new_password = $request->password;
        $confirm_password = $request->confirm_password;

        if ($new_password != $confirm_password) {
            $msg = 'Password and confirm password not matching';
            return redirect('/userChangePassword')->with('warning', $msg);
        }

        if (Hash::check($old_password, $user_data->password)) {
            $user_data->password = bcrypt($new_password);
            if ($user_data->save()) {
                $msg = 'Password Changed Successfully';
                return redirect('/userChangePassword')->with('success', $msg);
            } else {
                $msg = 'Password Change Failed';
                return redirect('/userChangePassword')->with('error', $msg);
            }
        } else {
            $msg = 'Old Password Does Not Match';
            return redirect('/userChangePassword')->with('error', $msg);
        }
    }

    public function setNewPassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        return view('users.set_new_password', compact('user'));
    }

    public function setNewPasswordSave(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        if ($password != $confirm_password) {
            $msg = 'Password and confirm password must be same';
            return redirect('/userSetNewPassword/' . $user_id)->with('error', $msg);
        } else {
            $user_data = User::where('id', $user_id)->first();
            $user_data->password = bcrypt($request->password);
            if ($user_data->save()) {
                $msg = 'New Password Set Successfully';
                return redirect('/userSetNewPassword/' . $user_id)->with('success', $msg);
            } else {
                $msg = 'Password Change Failed';
                return redirect('/userSetNewPassword/' . $user_id)->with('error', $msg);
            }
        }
    }
}
