<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Async;
use Session;
use Exception;
use Carbon\Carbon;
use App\Models\OTP;
use App\Models\link;
use App\Models\User;
use GuzzleHttp\Psr7;
use App\Models\crifdb;
use App\Models\Rcfull;
use GuzzleHttp\Client;
use App\Models\business;
use App\Models\consumer;
use App\Models\ApiMaster;
use App\Models\SchemeTypeMaster;
use App\Models\ApiGroup;
use App\Models\bankdetails;
use App\Models\businesskyc;
use App\Models\Transaction;
use App\Models\businesstype;
use App\Models\documentname;
use App\Models\rulesdefined;
use App\Models\SchemeMaster;
use App\Models\HitCountMaster;
use App\Models\termscondition;
use App\Models\agreementpolicy;
use App\Models\congratulations;
use App\Models\requireddetails;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserSchemeMaster;
use App\Models\{Post, RegtechBlog};
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;

class ApiController4 extends Controller
{
    public function getapimaster($token)
    {
        $user = null;
        // $user = User::where('access_token', $token)->first();
        if (is_numeric($token)) {
            // Fetch user by ID
            $user = User::where('id', $token)->first();
        } else {
            // Fetch user by access token
            $user = User::where('access_token', $token)->first();
        }
        if ($user->role_id == 1) {
            $userScheme = UserSchemeMaster::where('user_id', $user->id)->orderBy('created_at', 'desc')->get(['api_group_id', 'custom_plan', 'payment_slab', 'plan_amount', 'api_id', 'scheme_price']);
            // $userScheme = UserSchemeMaster::where('user_id', $user->id)->get();

            $combinedResults = [];
            $count = 0;
            foreach ($userScheme as $scheme) {
                $apiname = ApiMaster::where('id', $scheme->api_id)->get(['api_name', 'admin_price', 'route_name'])->first();
                $result = (object) [
                    'api_group_id' => $scheme->api_group_id,
                    'id' => $scheme->api_id,
                    'scheme_price' => $scheme->scheme_price,
                    'custom_plan' => $scheme->custom_plan,
                    'payment_slab' => $scheme->payment_slab,
                    'plan_amount' => $scheme->plan_amount,
                    // 'api_name' => $apiname->api_name ? $apiname->api_name : null,
                    'api_name' => $apiname->api_name ?? null,
                    'admin_price' => $apiname->admin_price ?? null,
                    'route_name' => $apiname->route_name ?? null,
                ];

                $count++;


                // Add the object to the results array
                $combinedResults[] = $result;
            }
            $renew = ($count > 0) ? 'false' : 'true';

            // return $combinedResults;

            // return [
            //     'combinedResults' => $combinedResults,
            //     'renew' => $renew,
            // ];

            $combinedResults[] = (object) ['renew' => $renew];

            // Directly return the combined results
            return $combinedResults;
        } else {
            $apimaster = ApiMaster::all();
            return $apimaster;
        }
    }

    public function apigroup($token)
    {
        $user = User::where('access_token', $token)->first();

        if ($user->role_id == 0) {
            $api_group = ApiGroup::all();
            if (isset($api_group[0]) && $api_group[0] != null) {
                return response()->json(['api_group' => $api_group, 'status_code' => 200]);
            }
            return response()->json(['message' => 'Record not found.', 'status_code' => 102]);
        } else {
            $combineResults = [];
            $userScheme = UserSchemeMaster::where('user_id', $user->id)->pluck('api_group_id')->unique();
            foreach ($userScheme as $scheme) {
                $api_groupwithname = ApiGroup::where('id', $scheme)->pluck('group_name')->first();
                $result = (object) [
                    'id' => $scheme,
                    'group_name' => $api_groupwithname,
                ];
                $combineResults[] = $result;
            }

            return response()->json(['api_group' => $combineResults]);
        }
    }

    public function getSpecificUserApi($token)
    {
        $user = User::where('access_token', $token)->first();
        $user_api_group = DB::table('user_scheme_master')
            ->where('user_id', $user->id)
            ->distinct()
            ->pluck('api_group_id');

        return $user_api_group;
    }

    public function getUserMenuPermission($token)
    {
        $user = User::where('access_token', $token)->first();
        $user_menu_permission = DB::table('menu_permission')->where('user_id', $user->id)->get();
        return $user_menu_permission;
    }

    public function getUserByToken($token)
    {

        if (is_numeric($token)) {
            $user = User::where('id', $token)->first();
            return $user;
        } else {
            $user = User::where('access_token', $token)->first();
            return $user;
        }
    }

    public function getAllUsersAscending()
    {
        $user = User::where('role_id', 1)->get();
        return $user;
    }

    public function getUserById($id)
    {
        $combineResults = [];
        $user = User::where('id', $id)->first();
        $plan = UserSchemeMaster::where('user_id', $id)->pluck('plan')->first();
        $userMenuPermission = DB::table('menu_permission')->where('user_id', $id)->get('menu');
        $permissionOptions = $userMenuPermission->map(function ($menu) {
            return [
                'value' => $menu->menu,
                'label' => $menu->menu
            ];
        })->toArray();
        $combineResults = [
            'user' => $user,
            'plan' => $plan,
            'userMenuPermission' => $permissionOptions
        ];

        return $combineResults;
    }



    public function getScheme($token)
    {
        $user = User::where('access_token', $token)->first();
        $scheme = UserSchemeMaster::join('api_master', 'api_master.id', '=', 'user_scheme_master.api_id')
            ->join('api_group', 'api_group.id', '=', 'user_scheme_master.api_group_id')
            ->where('user_scheme_master.user_id', '=', $user->id)
            ->get(['user_scheme_master.*', 'api_master.*']);

        return $scheme;
    }

    public function getAllUsers($token)
    {
        $user = User::where('access_token', $token)->first();

        if ($user->role_id == 0) {
            $users = User::where('role_id', 1)->orderBy('id', 'desc')->get();
            return $users;
        } else {
            $getAllUser = User::where('subparent_id', $user->id)->orderBy('id', 'desc')->get();
            return $getAllUser;
        }
    }


    public function getAllTransactions(Request $request, $token)
    {
        $user = User::where('access_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $perPage = $request->input('perPage', 15); // Default to 15 if not provided
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $searchQuery = $request->input('searchQuery', ''); // Default to empty string if not provided

        $query = Transaction::orderBy('id', 'desc');

        if ($user->role_id != 0) {
            $query->where('user_id', $user->id);
        }

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('transaction_id', 'like', "%{$searchQuery}%")
                    ->orWhere('created_at', 'like', "%{$searchQuery}%")
                    ->orWhere('type_creditdebit', 'like', "%{$searchQuery}%");
            });
        }

        $transactions = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($transactions);
    }




    // user create function
    public function userCreate(Request $request)
    {


        // $validator = Validator::make($request->all(), [
        //     'scheme_type' => 'required|string',
        //     'scheme_type_id' => 'nullable|integer',
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|confirmed',
        //     'rdo' => 'required|string',
        //     'one_time_comission' => 'required|numeric',
        //     'ids' => 'required|string',
        //     'menu_ids' => 'nullable|array',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        $authHeader = $request->header('Authorization');
        $token = null;
        if ($authHeader) {
            $parts = explode(' ', $authHeader);
            if (count($parts) === 2 && strtolower($parts[0]) === 'bearer') {
                $token = $parts[1];
            }
        }

        $userInfo = User::where('access_token', $token)->first();

        if ($userInfo->id == 1 && $userInfo->role_id == 0) {

            $users = new User;
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
            $users->verified = 0;
            $users->one_time_comission = $request->one_time_comission;
            $users->parent_id = $userInfo->id;
            $users->subparent_id = $userInfo->id;
            if ($users->save()) {
                // return 'user';
                $update_access_token = User::where('id', $users->id)->first();
                $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                $update_access_token->save();
                $user_id = $users->id;
                // if($request->scheme_type=='production') {
                $plan_amount = '';
                $plan_duration = '';
                $ids = explode("/", $request->ids);
                foreach ($ids as $key => $value) {
                    $res = explode("|", $value);
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

                        $user = UserSchemeMaster::updateOrCreate(
                            ['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5] ?? null],
                            ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]
                        );
                    }
                }
                $selectedMenuIds = $request->input('menu_ids');

                if (!empty($selectedMenuIds)) {
                    for ($i = 0; $i < count($selectedMenuIds); $i++) {
                        $insert_menu = DB::table('menu_permission')->insert(['user_id' => $user_id, 'menu' => $selectedMenuIds[$i]]);
                    }
                }
                return response()->json(['message' => 'User added successfully'], 200);
                // return 'success';
            } else {
                return response()->json(['message' => 'Failed to add user details']);
            }
        } elseif ($userInfo->id != 1 && $userInfo->role_id == 1) {

            if ($userInfo->subparent_id == '' || $userInfo->subparent_id == null) {
                $users = new User;
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
                $users->verified = 0;
                $users->one_time_comission = $request->one_time_comission;
                $users->parent_id = Auth::user()->id;
                $users->subparent_id = Auth::user()->id;
                if ($users->save()) {
                    $update_access_token = User::where('id', $users->id)->first();
                    $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                    $update_access_token->save();
                    $user_id = $users->id;
                    // if($request->scheme_type=='production') {
                    $plan_amount = '';
                    $plan_duration = '';

                    $ids = explode("/", $request->ids);
                    foreach ($ids as $key => $value) {
                        $res = explode("|", $value);
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


                            $user = UserSchemeMaster::updateOrCreate(
                                ['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5] ?? null],
                                ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]
                            );

                        }
                    }
                    $selectedMenuIds = $request->input('menu_ids');
                    if (!empty($selectedMenuIds)) {
                        for ($i = 0; $i < count($selectedMenuIds); $i++) {
                            $insert_menu = DB::table('menu_permission')->insert(['user_id' => $user_id, 'menu' => $selectedMenuIds[$i]]);
                        }
                    }

                    return response()->json(['message' => 'User added successfully'], 200);
                } else {
                    return response()->json(['message' => 'Failed to add user']);
                }

            } else {
                $userparent = User::where('id', $userInfo->id)->first();
                $selectedMenuIds = $request->input('menu_ids');
                if (!empty($selectedMenuIds)) {
                    $selected_menu = implode(",", $selectedMenuIds);
                    // return count($selectedMenuIds);
                    for ($i = 0; $i < count($selectedMenuIds); $i++) {
                        $insert_menu = DB::table('menu_permission')->insert(['user_id' => $request->user_id, 'menu' => $selectedMenuIds[$i]]);
                    }
                }
                $users = new User;
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
                $users->verified = 0;
                $users->one_time_comission = $request->one_time_comission;
                $users->parent_id = $userparent->parent_id;
                $users->subparent_id = $userInfo->id;
                if ($users->save()) {
                    $update_access_token = User::where('id', $users->id)->first();
                    $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                    $update_access_token->save();
                    $user_id = $users->id;
                    // if($request->scheme_type=='production') {
                    $plan_amount = '';
                    $plan_duration = '';

                    $ids = explode("/", $request->ids);
                    foreach ($ids as $key => $value) {
                        $res = explode("|", $value);

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

                            $user = UserSchemeMaster::updateOrCreate(
                                ['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5] ?? null],
                                ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]
                            );
                        }
                    }
                    return response()->json(['message' => 'User added successfully'], 200);
                } else {
                    return response()->json(['message' => 'Failed to add user details']);
                }
            }
        } else {
            $users = new User;
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
            $users->verified = 0;
            $users->one_time_comission = $request->one_time_comission;
            $users->parent_id = null;
            $users->subparent_id = null;
            if ($users->save()) {
                $update_access_token = User::where('id', $users->id)->first();
                $update_access_token->access_token = $update_access_token->id . md5(rand(1, 10) . microtime());
                $update_access_token->save();
                $user_id = $users->id;
                // if($request->scheme_type=='production') {
                $plan_amount = '';
                $plan_duration = '';

                $ids = explode("/", $request->ids);
                foreach ($ids as $key => $value) {
                    $res = explode("|", $value);

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

                        $user = UserSchemeMaster::updateOrCreate(
                            ['user_id' => $user_id, 'api_id' => $res[0], 'plan' => $res[4], 'plan_amount' => $plan_amount, 'duration' => $plan_duration, 'custom_plan' => $res[3], 'payment_slab' => $res[5] ?? null],
                            ['scheme_price' => $res[1], 'api_group_id' => $res[2], 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($plan_duration)]
                        );
                    }
                }
                $selectedMenuIds = $request->input('menu_ids');
                if (!empty($selectedMenuIds)) {
                    for ($i = 0; $i < count($selectedMenuIds); $i++) {
                        $insert_menu = DB::table('menu_permission')->insert(['user_id' => $user_id, 'menu' => $selectedMenuIds[$i]]);
                    }
                }

                return response()->json(['message', 'User added successfully'], 200);
            } else {
                return response()->json(['message', 'Failed to add user details']);
            }
        }
    }


    public function userUpdate(Request $request)
    {
        // return $request->all();

        $selectedMenuIds = $request->input('menu_ids');
        $selectedValues = $request->input('stage_id');
        // return $selectedValues;
        $selectedValuesRequest = $request->input('request_value');
        $txtPlanPrice = $request->input('txtPlanPricedemo');
        $txtUserPrice = $request->input('txtUserPricedemo');
        // return $request->user_id;
        if (!empty($selectedValues)) {
            $api_master = DB::table('api_master')->where('api_slug', $selectedValues[0])->first();

            $selected_value = implode(",", $selectedValues);
            $insert_value = DB::table('user_scheme_master')->where('user_id', $request->user_id)->where('api_id', $api_master->id)->update(['permission' => $selected_value]);
        }
        if (!empty($selectedValuesRequest)) {
            $api_master_req = DB::table('api_master')->where('api_slug', $selectedValuesRequest[0])->first();
            $selected_value_req = implode(",", $selectedValuesRequest);
            $insert_value = DB::table('user_scheme_master')->where('user_id', $request->user_id)->where('api_id', $api_master_req->id)->update(['request_permission' => $selected_value_req]);
        }
        if (!empty($selectedMenuIds)) {
            $selected_menu = implode(",", $selectedMenuIds);
            // return count($selectedMenuIds);
            for ($i = 0; $i < count($selectedMenuIds); $i++) {
                $insert_menu = DB::table('menu_permission')->insert(['user_id' => $request->user_id, 'menu' => $selectedMenuIds[$i]]);
            }
        }

        $api_ids = [];

        if ($request->renew == 'false') {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null
                ]);
            }

            $users = User::where('id', operator: $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;

            $ids = explode("/", $request->ids);
            $start_date = '';
            $end_date = '';
            // $ids = array_values(array_unique($ids));

            foreach ($ids as $key => $value) {
                $res = explode("|", $value);
                // return $res[3];
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

                    $api_ids[] = $res[0];

                    $user_scheme_details = UserSchemeMaster::where('user_id', $request->user_id)->where('api_id', $res[0])->first();
                    // return $user_scheme_details;
                    if ($user_scheme_details) {
                        if ($user_scheme_details['end_date'] == '' || $user_scheme_details['end_date'] == null) {
                            $start_date = Carbon::now();
                            $end_date = Carbon::now()->addDays($plan_duration);
                        } else {
                            $start_date = $user_scheme_details['start_date'];
                            $end_date = $user_scheme_details['end_date'];
                        }
                        // Delete existing records for the user

                        $user = UserSchemeMaster::where(['user_id' => $request->user_id, 'api_id' => $res[0]])->update([
                            'api_id' => $res[0],
                            'plan' => $res[4],
                            'plan_amount' => $plan_amount,
                            'duration' => $plan_duration,
                            'custom_plan' => $res[3],
                            'payment_slab' => $res[5] ?? null,
                            'scheme_price' => $res[1],
                            'api_group_id' => $res[2],
                            'start_date' => $start_date,
                            'end_date' => $end_date
                        ]);

                    } else {


                        $user = new UserSchemeMaster;
                        $user->user_id = $request->user_id;
                        $user->api_id = $res[0];
                        $user->plan = $res[4];
                        $user->plan_amount = $plan_amount;
                        $user->duration = $plan_duration;
                        $user->custom_plan = $res[3];
                        $user->payment_slab = $res[5] ?? null;
                        $user->scheme_price = $res[1];
                        $user->api_group_id = $res[2];
                        $user->start_date = $start_date;
                        $user->end_date = $end_date;

                        $user->save();
                    }



                }
            }

            if ($user) {
                $user_scheme = UserSchemeMaster::where('user_id', $request->user_id)->get();  // Get all records for the given user_id
                foreach ($user_scheme as $scheme) {
                    if (!in_array($scheme->api_id, $api_ids)) {
                        $scheme->delete();
                    }
                }
                return response()->json(['message', 'User details updated successfully'], 200);
            } else {
                return response()->json(['message', 'Failed to update user details'], 201);
            }
        } else {
            if ($request->scheme_type == 'demo') {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => $request->scheme_type_id
                ]);
            } else {
                $users = User::where('id', $request->user_id)->update([
                    'scheme_type' => $request->scheme_type,
                    'scheme_type_id' => null,
                    'scheme_hit_count' => null
                ]);
            }

            $users = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $plan_amount = '';
            $plan_duration = '';

            $user_id = $request->user_id;
            $ids = explode("/", $request->ids);
            foreach ($ids as $key => $value) {
                $res = explode("|", $value);
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

                    $user = new UserSchemeMaster;
                    $user->user_id = $request->user_id;
                    $user->api_id = $res[0];
                    $user->plan = $res[4];
                    $user->plan_amount = $plan_amount;
                    $user->duration = $plan_duration;
                    $user->custom_plan = $res[3];
                    $user->payment_slab = $res[5] ?? null;
                    $user->scheme_price = $res[1];
                    $user->api_group_id = $res[2];
                    $user->start_date = Carbon::now();
                    $user->end_date = Carbon::now()->addDays($plan_duration);

                    $user->save();
                }
            }

            if ($user) {
                return response()->json(['message', 'User details updated successfully'], 200);
            } else {
                return response()->json(['message', 'Failed to update user details'], 201);
            }
        }
    }


    public function userDelete($id)
    {
        $users = User::where('id', $id)->delete();
        $userSchemeMaster = UserSchemeMaster::where('user_id', $id)->delete();
        return response()->json(['message', 'User deleted successfully'], 200);
    }


    public function setNewPassword(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        if ($password != $confirm_password) {
            $msg = "Password and confirm password must be same";
            return response()->json(['message' => $msg], 401);
        } else {
            $user_data = User::where('id', $user_id)->first();
            $user_data->password = bcrypt($request->password);
            if ($user_data->save()) {
                $msg = "New Password Reset Successfully";
                return response()->json(['message' => $msg], 200);
            } else {
                $msg = "Password Reset Failed";
                return response()->json(['message' => $msg], 201);
            }
        }
    }


    public function resetUserPassword(Request $request)
    {
        $user_id = $request->user_id;
        $user_data = User::where('id', $user_id)->first();
        $old_password = $request->oldpassword;
        $new_password = $request->password;
        $confirm_password = $request->confirm_password;

        if ($new_password != $confirm_password) {
            $msg = "Password and confirm password not matching";
            return response()->json(['warning' => $msg]);
        }

        if (Hash::check($old_password, $user_data->password)) {
            $user_data->password = bcrypt($new_password);
            if ($user_data->save()) {
                $msg = "Password Changed Successfully";
                return response()->json(['success' => $msg]);
            } else {
                $msg = "Password Change Failed";
                return response()->json(['error' => $msg]);
            }
        } else {
            $msg = "Old Password Does Not Match";
            return response()->json(['error' => $msg]);
        }
    }


    // billing

    public function add_walletadmin(Request $request)
    {
        $authToken = User::where('access_token', $request->token)->first();
        if ($authToken->type == '' || $authToken->type == null) {
            $user = User::find($request->user);
            if ($user) {

                if ($request->transaction_type == 'debit') {
                    if ($request->amount <= $user->wallet_amount) {
                        $user->wallet_amount = $user->wallet_amount - $request->amount;
                        $user->save();
                        $this->transaction($user, 'Debit', $request->amount, "Recharge");
                        return response()->json(['success' => 'Amount has been Debited successfully'], 200);
                    } else {
                        return response()->json(['error' => 'User has Rs' . $user->wallet_amount . ' Please enter less amount'], 401);
                    }

                } else if ($request->transaction_type == 'credit') {
                    $user->wallet_amount = $user->wallet_amount + $request->amount;
                    $user->save();
                    $this->transaction($user, 'Credit', $request->amount, "Recharge");
                    return response()->json(['success' => 'Amount has been Credited successfully'], 200);
                }
            } else {
                return response()->json(['error' => 'Please Select User'], 401);
            }
        } else {
            $user = User::find($authToken->id);

            $user->wallet_amount = $user->wallet_amount + $request->amount;
            $user->save();

            //if transaction is successful
            if ($user->start_date == '' || $user->start_date == null) {
                $scheme_details = UserSchemeMaster::where('user_id', Auth()->user()->id)->get();
                foreach ($scheme_details as $details) {
                    $date_update = DB::table('user_scheme_master')->where('user_id', $user->id)->update(['start_date' => Carbon::now(), 'end_date' => Carbon::now()->addDays($details->duration)]);
                }
                //$date_update = UserSchemeMaster::update(['start_date'=> Carbon::now()])->where('user_id', $user->id);
            }
            $this->transaction($user, 'Credit', $request->amount, "Recharge");
            return response()->json(['success' => 'Amount has been Credited successfully'], 200);
        }
    }

    public function transaction($user, $type, $amount, $remark)
    {
        $transaction = new Transaction;
        $transaction->transaction_id = $this->transaction_id();
        $transaction->user_id = $user->id;
        $transaction->api_id = 0; //work
        $transaction->type_creditdebit = $type;
        $transaction->scheme_price = 0;  //work
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
        if ($transaction) {
            $transaction_gen = substr(str_shuffle($str_result), 0, 12);
        }

        return $transaction_gen;
    }


    // billing user
    public function addwallet(Request $request)
    {
        $authToken = User::where('access_token', $request->token)->first();
        // return $authToken;

        if ($authToken->type == '' || $authToken->type == null) {
            $user = User::find($request->user);
           
            if ($user) {
                if ($request->transaction_type == 'debit') {
                    if ($request->amount <= $user->wallet_amount) {
                        $user->wallet_amount = $user->wallet_amount - $request->amount;
                        $user->save();
                        $this->transaction($user, 'Debit', $request->amount, "Recharge");
                        return response()->json(['success' => 'Amount has been Debited successfully'], 200);
                    } else {
                        return response()->json(['error' => 'User has Rs' . $user->wallet_amount . ' Please enter less amount'], 401);
                    }

                } else if ($request->transaction_type == 'credit') {

                    $originalAmount = $request->amount;
                    $gstAmount = $originalAmount * 0.18;
                    $totalgstAmount = $originalAmount + $gstAmount;
                    $key = "7PQJ3ZJPRQ";
                    $txnid = uniqid();
                    $amount = $totalgstAmount;
                    $salt = "U67ODUQVI8";
                    $productinfo = 'Recharge';
                    $email = $user->email;
                    $firstname = $user->name;
                    $phone = '9876543210';
                    $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
                    $hash = strtolower(hash('sha512', $hashString));
                    $data = [
                        'key' => $key,
                        'txnid' => $txnid,
                        "amount" => $amount,
                        "firstname" => $firstname,
                        "productinfo" => $productinfo,
                        "email" => $email,
                        "phone" => $phone,
                        "hash" => $hash,
                        "surl" => "http://localhost:8000//success_url",
                        "furl" => "http://localhost:8000//failure_url",
                    ];


                    $url = "https://pay.easebuzz.in/payment/initiateLink";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $responseData = json_decode($response, true);
                    return response()->json(['payment_status_code' => 200, 'data' => $responseData, 'key' => $key]);

                }
            } else {
                return response()->json(['error' => 'Please Select User', 'status_code' => 401]);
            }
        } else {

            $user = User::find($authToken->id);


            $originalAmount = $request->amount;
            $gstAmount = $originalAmount * 0.18;
            $totalgstAmount = $originalAmount + $gstAmount;
            $key = "7PQJ3ZJPRQ";
            $txnid = uniqid();
            $amount = $totalgstAmount;
            $salt = "U67ODUQVI8";
            $productinfo = 'Recharge';
            $email = $user->email;
            $firstname = $user->name;
            $phone = '9876543210';
            $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
            $hash = strtolower(hash('sha512', $hashString));
            $data = [
                'key' => $key,
                'txnid' => $txnid,
                "amount" => $amount,
                "firstname" => $firstname,
                "productinfo" => $productinfo,
                "email" => $email,
                "phone" => $phone,
                "hash" => $hash,
                "surl" => "http://localhost:8000//success_url",
                "furl" => "http://localhost:8000//failure_url",
            ];


            $url = "https://pay.easebuzz.in/payment/initiateLink";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            $response = curl_exec($curl);
            curl_close($curl);
            $responseData = json_decode($response, true);
            return response()->json(['payment_status_code' => 200, 'data' => $responseData, 'key' => $key]);
        }

    }
    public function WalletSuccessPayment($amount, $txnid, $email)
    {
        $user_amount = DB::table('users')->where('email', $email)->get();
        $wallet_amount = $user_amount[0]->wallet_amount;
        $transactionId = $txnid;
        $total_amount = $wallet_amount + $amount;
        $reason = 'Recharge';
        $update_wallet_amount = DB::table('users')->where('email', $email)->update(['wallet_amount' => $total_amount]);
        $user_details = DB::table('users')->where('email', $email)->get();
        $user = $user_details[0];
        $this->transaction($user, 'Credit', $amount, $reason);
        return redirect()->route('payment_success', ['amount' => $amount, 'txnid' => $txnid]);
    }
    public function redirectSuccessPayment($amount, $txnid)
    {
        return view('payment.successwallet', compact('amount', 'txnid'));
    }








    public function billingAddAmount(Request $request)
    {
        // return $request->all();

        $validation = $request->validate([
            'amount' => 'required|numeric|min:1',
        ], [
            'amount.required' => "Please enter amount.",
            'amount.min' => "Amount must be 1000 rupees or above.",
        ]);
        $phoneNumber = mt_rand(1000000000, 9999999999);
        $key = "7PQJ3ZJPRQ";
        $txnid = uniqid();

        // $amount = isset($request->total_amounts)?$request->total_amounts:$request->amount;
        $amount = $request->total_amounts;
        // return $amount;
        $salt = "U67ODUQVI8";
        $productinfo = "Recharge";
        $email = $request->email;
        $firstname = $request->name;
        $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
        $hash = strtolower(hash('sha512', $hashString));

        $data = [
            'key' => $key,
            'txnid' => $txnid,
            "amount" => $amount,
            "firstname" => $firstname,
            "productinfo" => $productinfo,
            "email" => $email,
            "phone" => $phoneNumber,
            "hash" => $hash,
            "surl" => "http://localhost:5173/success_url",
            "furl" => "http://localhost:5173/failure_url",

        ];
        $url = "https://pay.easebuzz.in/payment/initiateLink";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        // return  $responseData;
        return response()->json(['status_code' => 200, 'data' => $responseData]);

    }

    public function userActiveInactive ($id){
        $user_deatails = User::where('id', $id)->first();
        if ($user_deatails->status == 0) {
            // $password = 'adminpasschange@0988';
            $update_access_token = $user_deatails->id . md5(rand(1, 10) . microtime());
            $update_user_status = DB::table('users')->where('id', $id)->update(['access_token' => $update_access_token, 'status' => 1]);
            return response()->json(['message'=>"User status updated successfully", 'status'=>200]);
            // return $update_access_token;
        } else {
            // $password = 'adminpasschange@0988';
            $update_access_token = $user_deatails->id . md5(rand(1, 10) . microtime());
            $update_user_status = DB::table('users')->where('id', $id)->update(['access_token' => $update_access_token, 'status' => 0]);
            return response()->json( ['message'=>"User status updated successfully"], 200);
        }
    }


//     @if(Auth::user()->scheme_type=='demo')
// @php
// $hits_remaining = 0;
// $scheme_hit_count = Auth::user()->scheme_hit_count;
// $scheme_type=DB::table('scheme_types')->where('id',Auth::user()->scheme_type_id)->first();
// if(isset($scheme_type)){
//     $hits_remaining = $scheme_type->hit_limits - $scheme_hit_count;
// }
// @endphp
// @if($hits_remaining==0 || $hits_remaining<0)
//     <div class="alert alert-danger alert-dismissible">
//         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
//         <h5><i class="icon fas fa-exclamation-triangle"></i> Your free usage of API are ends. Please subscribe to plan.</h5>
//     </div>
// @else
//     <div class="alert alert-warning alert-dismissible">
//         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
//         <h5><i class="icon fas fa-exclamation-triangle"></i> You are using free version of DocBoyzApi. You have left {{$hits_remaining}} free hits.</h5>
//     </div>
// @endif
// @endif

}
