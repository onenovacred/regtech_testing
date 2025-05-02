<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use App\Models\UserSchemeMaster;
use App\Models\HitCountMaster;
use App\Models\User;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\Pickuppdf;
use Mail;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $reports = array();
        // $serviceType = 0;
        $startDate = "";
        $endDate = "";
        $year_month = "";
        $userService = 0;
        $users = '';
        $status_codes = [];
        $cnt200 = 0;
        $cnt400 = 0;
        $cnt500 = 0;
        $cnt101 = 0;
        $count200 = 0;
        $count400 = 0;
        $count500 = 0;
        $count101 = 0;
        $isAdmin = false;
        $payableHits = 0;
        $hits_per_day = [];
        $hits_date = [];
        $transactions = '';
        $hit_count_master = '';
        $user_scheme_master = '';
        if (Auth::user()->id == 1) {
            $isAdmin = true;
            $users = User::where('type', 'role_prepaid')->get();
            // $user_scheme_master_dropdown = UserSchemeMaster::with('api_master')->get()->toArray();
            $ddl_year_month = HitCountMaster::select('hit_year_month')->whereNotNull('hit_year_month')->orderBy('hit_year_month', 'desc')->groupBy('hit_year_month')->get();
            // dd($ddl_year_month);
            if ($request->isMethod('GET')) {
                $user_scheme_master = UserSchemeMaster::select('api_id')->with('api_master')->groupby('api_id')->get();

                $cnt200 = 0;
                $cnt400 = 0;
                $cnt500 = 0;
                $cnt101 = 0;
                foreach ($user_scheme_master as $key => $value) {
                    $hit_count_master = HitCountMaster::where('api_id', $value->api_id)->get();
                    $transactions = Transaction::where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();

                    $cnt500 = $cnt500 + Transaction::where('api_id', $value->api_id)->where('status_code', 500)->count();
                    $cnt400 = $cnt400 + Transaction::where('api_id', $value->api_id)->where('status_code', 102)->count();
                    $cnt200 = $cnt200 + Transaction::where('api_id', $value->api_id)->where('status_code', 200)->count();
                    $cnt101 = $cnt101 + Transaction::where('api_id', $value->api_id)->where('status_code', 101)->count();
                    $count500 = $cnt500;
                    $count400 = $cnt400;
                    $count200 = $cnt200;
                    $count101 = $cnt101;

                    // foreach($transactions as $transaction){
                    //     if($transaction->status_code == 500){
                    //         $cnt500++;
                    //         $count500++;
                    //     }else if($transaction->status_code == 102){
                    //         $cnt400++;
                    //         $count400++;
                    //     }else if($transaction->status_code == 200){
                    //         $cnt200++;
                    //         $count200++;
                    //     }else if($transaction->status_code == 101){
                    //         $cnt101++;
                    //         $count101++;
                    //     }
                    // }
                    if ($hit_count_master->count() > 0) {
                        $reports[$key]['api_id'] = $value->api_id;
                        $reports[$key]['api_name'] = $value->api_master->api_name;
                        $reports[$key]['scheme_price'] = $value->scheme_price;
                        $reports[$key]['hit_count'] = $transactions;
                        $reports[$key]['total'] = 0;
                        foreach ($hit_count_master as $hits) {
                            $reports[$key]['total'] += $hits->scheme_price;
                        }
                    }
                }
            }
            // dd($ddl_year_month);
            if ($request->isMethod('POST')) {
                $userService = $request->user;
                $year_month = $request->year_month;
                if ($userService == 0) {
                    // return 'apitestif';
                    $user_scheme_master = UserSchemeMaster::with('api_master')->groupby('api_id')->get();

                    $cnt200 = 0;
                    $cnt400 = 0;
                    $cnt500 = 0;
                    $cnt101 = 0;
                    foreach ($user_scheme_master as $key => $value) {
                        if ($year_month != 0) {
                            $transactions = Transaction::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->whereIn('status_code', [500, 200, 101, 102])->count();
                            // $transactions = Transaction::select('status_code')->where('api_id',$value->api_id)->where('hit_year_month', $year_month)->withoutGlobalScopes()->get();
                            $cnt500 = $cnt500 + Transaction::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 500)->count();
                            $cnt400 = $cnt400 + Transaction::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 102)->count();
                            $cnt200 = $cnt200 + Transaction::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 200)->count();
                            $cnt101 = $cnt101 + Transaction::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 101)->count();
                            $count500 = $cnt500;
                            $count400 = $cnt400;
                            $count200 = $cnt200;
                            $count101 = $cnt101;
                        } else {
                            $transactions = Transaction::where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();
                            // $transactions = Transaction::select('status_code')->where('api_id',$value->api_id)->withoutGlobalScopes()->get();
                            $cnt500 = $cnt500 + Transaction::where('api_id', $value->api_id)->where('status_code', 500)->count();
                            $cnt400 = $cnt400 + Transaction::where('api_id', $value->api_id)->where('status_code', 102)->count();
                            $cnt200 = $cnt200 + Transaction::where('api_id', $value->api_id)->where('status_code', 200)->count();
                            $cnt101 = $cnt101 + Transaction::where('api_id', $value->api_id)->where('status_code', 101)->count();
                            $count500 = $cnt500;
                            $count400 = $cnt400;
                            $count200 = $cnt200;
                            $count101 = $cnt101;
                        }

                        // foreach($transactions as $transaction){
                        //     if($transaction->status_code == 500){
                        //         $cnt500++;
                        //         $count500++;
                        //     }else if($transaction->status_code == 102){
                        //         $cnt400++;
                        //         $count400++;
                        //     }else if($transaction->status_code == 200){
                        //         $cnt200++;
                        //         $count200++;
                        //     }else if($transaction->status_code == 101){
                        //         $cnt101++;
                        //         $count101++;
                        //     }
                        // }
                        if (!empty($ddl_year_month)) {
                            if ($year_month != 0)
                                $hit_count_master = HitCountMaster::where('api_id', $value->api_id)->where('hit_year_month', $year_month)->get();
                            else
                                $hit_count_master = HitCountMaster::where('api_id', $value->api_id)->get();
                        } else
                            $hit_count_master = HitCountMaster::where('api_id', $value->api_id)->get();

                        if ($hit_count_master->count() > 0) {
                            $reports[$key]['api_id'] = $value->api_id;
                            $reports[$key]['api_name'] = $value->api_master->api_name;
                            $reports[$key]['scheme_price'] = $value->scheme_price;
                            $reports[$key]['hit_count'] = $transactions;
                            $reports[$key]['total'] = 0;
                            foreach ($hit_count_master as $hits) {
                                $reports[$key]['total'] += $hits->scheme_price;
                            }
                        }
                    }
                } else {
                    // return 'apitestelse';
                    // if($serviceType==0)
                    $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', $userService)->groupby('api_id')->get();

                    // else
                    //     $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', $userService)->where('api_id',$serviceType)->get();

                    $cnt200 = 0;
                    $cnt400 = 0;
                    $cnt500 = 0;
                    $cnt101 = 0;
                    foreach ($user_scheme_master as $key => $value) {
                        $payableHits = 0;
                        // if(!empty($startDate) && !empty($endDate))
                        // $hit_count_master = HitCountMaster::where('user_id',Auth::user()->id)->where('api_id',$value->api_id)->whereBetween('created_at', [$startDate, $endDate])->count();

                        if ($year_month != 0) {
                            // $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id',$value->api_id)->where('hit_year_month', $year_month)->withoutGlobalScopes()->get();
                            $transactions = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->whereIn('status_code', [500, 200, 101, 102])->count();
                            // return $ddl_year_month;
                            // return $cnt500;  
                            $cnt500 = $cnt500 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 500)->count();
                            $cnt400 = $cnt400 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 102)->count();
                            $cnt200 = $cnt200 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 200)->count();
                            $cnt101 = $cnt101 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('status_code', 101)->count();
                            $count500 = $cnt500;
                            $count400 = $cnt400;
                            $count200 = $cnt200;
                            $count101 = $cnt101;

                        } else {
                            // $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id',$value->api_id)->withoutGlobalScopes()->get();
                            $transactions = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();

                            $cnt500 = $cnt500 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 500)->count();
                            $cnt400 = $cnt400 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 102)->count();
                            $cnt200 = $cnt200 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 200)->count();
                            $cnt101 = $cnt101 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 101)->count();
                            $count500 = $cnt500;
                            $count400 = $cnt400;
                            $count200 = $cnt200;
                            $count101 = $cnt101;
                        }
                        if (!empty($ddl_year_month)) {
                            if ($year_month != 0)
                                $hit_count_master = HitCountMaster::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->count();
                            else
                                $hit_count_master = HitCountMaster::where('user_id', $userService)->where('api_id', $value->api_id)->count();
                        } else
                            $hit_count_master = HitCountMaster::where('user_id', $userService)->where('api_id', $value->api_id)->count();

                        // for($i=0; $i<count($transactions);$i++){
                        //     if($transactions[$i]['status_code'] == 500){
                        //         $cnt500++;
                        //         $count500++;
                        //     }else if($transactions[$i]['status_code'] == 102){
                        //         $cnt400++;
                        //         $count400++;
                        //     }else if($transactions[$i]['status_code'] == 200){
                        //         $cnt200++;
                        //         $count200++;
                        //     }else if($transactions[$i]['status_code'] == 101){
                        //         $cnt101++;
                        //         $count101++;
                        //     }
                        // }
                        if ($year_month != 0) {

                            // $hits_per_days = DB::select("SELECT * FROM docboyz_api.transaction where user_id = ".$userService." and api_id = ".$value->api_id." and hit_year_month = '".$year_month."' group by DATE(created_at)");
                            $hits_per_days = DB::table('transaction')
                                ->select(DB::raw('user_id, api_id, hit_year_month, DATE(created_at) as date, COUNT(*) as count'))
                                ->where('user_id', $userService)
                                ->where('api_id', $value->api_id)
                                ->whereNotNull('hit_year_month')
                                ->groupBy('user_id', 'api_id', 'hit_year_month', 'date')
                                ->get();

                            // foreach($hits_per_days as $key1=>$hit){
                            //     // $date = date("Y-m-d", strtotime($hit->created_at));
                            //     $date = 2022-11-01;
                            //     // $hits_date[$key1] = date("d-m", strtotime($hit->created_at));
                            //     $hits_date[$key1] ='2022-11-01 00:26:40';
                            //     $hits_per_day[$key1] = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('created_at', 'like', $date.'%')->where('status_code', '!=', 401)->count();
                            //     return  $hit->created_at;
                            // }
                        } else {
                            //$hits_per_days = DB::select("SELECT * FROM docboyz_api.transaction where user_id = ".$userService." and api_id = ".$value->api_id." and hit_year_month is not null group by DATE(created_at)");
                            $hits_per_days = DB::table('transaction')
                                ->select(DB::raw('user_id, api_id, hit_year_month, DATE(created_at) as date, COUNT(*) as count'))
                                ->where('user_id', $userService)
                                ->where('api_id', $value->api_id)
                                ->whereNotNull('hit_year_month')
                                ->groupBy('user_id', 'api_id', 'hit_year_month', 'date')
                                ->get();
                            foreach ($hits_per_days as $key1 => $hit) {
                                $date = date("Y-m-d", strtotime($hit->created_at));
                                $hits_date[$key1] = date("d-m", strtotime($hit->created_at));
                                $hits_per_day[$key1] = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->whereNotNull('hit_year_month')->where('created_at', 'like', $date . '%')->where('status_code', '!=', 401)->count();
                            }
                        }

                        $payableHits = $cnt200 + $cnt400 + $cnt101;
                        // return $payableHits;
                        if ($hit_count_master > 0) {
                            $reports[$key]['api_id'] = $value->api_id;
                            $reports[$key]['api_name'] = $value->api_master->api_name;
                            $reports[$key]['hit_count'] = $transactions;
                            if ($value->custom_plan == 'yes') {
                                $payment_slab = explode(',', $value->payment_slab);
                                $scheme_price = explode(',', $value->scheme_price);
                                for ($i = 0; $i < count($payment_slab); $i++) {
                                    if ($i == (count($payment_slab) - 1)) {
                                        if ($payableHits <= $payment_slab[$i]) {
                                            $reports[$key]['scheme_price'] = $scheme_price[$i];
                                            $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                        } else if ($payableHits > $payment_slab[$i]) {
                                            $reports[$key]['scheme_price'] = $scheme_price[$i];
                                            $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                        }

                                        break;
                                    } else {
                                        if ($payableHits <= $payment_slab[$i]) {
                                            $reports[$key]['scheme_price'] = $scheme_price[$i];
                                            $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                        }
                                        break;
                                    }
                                }
                            } else {
                                $reports[$key]['scheme_price'] = $value->scheme_price;
                                $reports[$key]['total'] = $payableHits * $value->scheme_price;
                                // if($value->scheme_price != 0 && ($value->total_transaction_amount_per_api != 0 || $value->total_transaction_amount_per_api != null)){
                                //     $reports[$key]['hit_count'] = $value->total_transaction_amount_per_api / $value->scheme_price;
                                // }else{
                                //     $reports[$key]['hit_count'] = 0;
                                // }
                            }
                        }
                    }
                }
            }
            $user_scheme_master_arr = $user_scheme_master->toArray();
        } else {

            $userService = Auth::user()->id;
            // $user_scheme_master_dropdown = UserSchemeMaster::with('api_master')->where('user_id',Auth::user()->id)->get()->toArray();
            $ddl_year_month = HitCountMaster::select('hit_year_month')->whereNotNull('hit_year_month')->orderBy('hit_year_month', 'desc')->groupBy('hit_year_month')->get();
            // dd($ddl_year_month);
            if ($request->isMethod('GET')) {
                $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->get();

                $cnt200 = 0;
                $cnt400 = 0;
                $cnt500 = 0;
                $cnt101 = 0;
                foreach ($user_scheme_master as $key => $value) {
                    $payableHits = 0;
                    // $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id',$value->api_id)->get();
                    $transactions = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();

                    $cnt500 = $cnt500 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 500)->count();
                    $cnt400 = $cnt400 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 102)->count();
                    $cnt200 = $cnt200 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 200)->count();
                    $cnt101 = $cnt101 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 101)->count();
                    $count500 = $cnt500;
                    $count400 = $cnt400;
                    $count200 = $cnt200;
                    $count101 = $cnt101;

                    $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();

                    // for($i=0; $i<count($transactions);$i++){
                    //     if($transactions[$i]['status_code'] == 500){
                    //         $cnt500++;
                    //         $count500++;
                    //     }else if($transactions[$i]['status_code'] == 102){
                    //         $cnt400++;
                    //         $count400++;
                    //     }else if($transactions[$i]['status_code'] == 200){
                    //         $cnt200++;
                    //         $count200++;
                    //     }else if($transactions[$i]['status_code'] == 101){
                    //         $cnt101++;
                    //         $count101++;
                    //     }
                    // }


                    //$hits_per_days = DB::select("SELECT * FROM `regtech-api.transaction` where user_id = ".$userService." and api_id = ".$value->api_id." and hit_year_month is not null group by DATE(created_at)");



                    $hits_per_days = DB::table('transaction')
                        ->select(DB::raw('user_id, api_id, hit_year_month, DATE(created_at) as date, COUNT(*) as count'))
                        ->where('user_id', $userService)
                        ->where('api_id', $value->api_id)
                        ->whereNotNull('hit_year_month')
                        ->groupBy('user_id', 'api_id', 'hit_year_month', 'date')
                        ->get();



                    // foreach($hits_per_days as $key1=>$hit){
                    //     $date = date("Y-m-d", strtotime($hit->created_at));
                    //     $hits_date[$key1] = date("d-m", strtotime($hit->created_at));
                    //     $hits_per_day[$key1] = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->whereNotNull('hit_year_month')->where('created_at', 'like', $date.'%')->where('status_code', '!=', 401)->count();
                    // }

                    $payableHits = $cnt200 + $cnt400 + $cnt101;

                    if ($hit_count_master > 0) {
                        $reports[$key]['api_id'] = $value->api_id;
                        $reports[$key]['api_name'] = $value->api_master->api_name ?? null;
                        $reports[$key]['hit_count'] = $transactions;
                        if ($value->custom_plan == 'yes') {
                            $payment_slab = explode(',', $value->payment_slab);
                            $scheme_price = explode(',', $value->scheme_price);
                            for ($i = 0; $i < count($payment_slab); $i++) {
                                if ($i == (count($payment_slab) - 1)) {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    } else if ($payableHits > $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                } else {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                }
                            }
                        } else {
                            $reports[$key]['scheme_price'] = $value->scheme_price;
                            $reports[$key]['total'] = $payableHits ?? null * $value->scheme_price;
                        }
                    }
                }
            }
            if ($request->isMethod('POST')) {

                $serviceType = $request->serviceType;
                // $startDate = $request->startDate;
                // $endDate = $request->endDate;
                $year_month = $request->year_month;
                if ($serviceType == 0)
                    $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->get();
                else
                    $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->where('api_id', $serviceType)->get();

                $cnt200 = 0;
                $cnt400 = 0;
                $cnt500 = 0;
                $cnt101 = 0;
                foreach ($user_scheme_master as $key => $value) {
                    $payableHits = 0;
                    if ($year_month != 0) {
                        // $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id',$value->api_id)->where('hit_year_month', $year_month)->get();
                        $transactions = Transaction::where('user_id', $userService)->where('hit_year_month', $year_month)->where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();

                        $cnt500 = $cnt500 + Transaction::where('user_id', $userService)->where('hit_year_month', $year_month)->where('api_id', $value->api_id)->where('status_code', 500)->count();
                        $cnt400 = $cnt400 + Transaction::where('user_id', $userService)->where('hit_year_month', $year_month)->where('api_id', $value->api_id)->where('status_code', 102)->count();
                        $cnt200 = $cnt200 + Transaction::where('user_id', $userService)->where('hit_year_month', $year_month)->where('api_id', $value->api_id)->where('status_code', 200)->count();
                        $cnt101 = $cnt101 + Transaction::where('user_id', $userService)->where('hit_year_month', $year_month)->where('api_id', $value->api_id)->where('status_code', 101)->count();
                        $count500 = $cnt500;
                        $count400 = $cnt400;
                        $count200 = $cnt200;
                        $count101 = $cnt101;
                    } else {
                        // $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id',$value->api_id)->get();
                        $transactions = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->whereIn('status_code', [500, 200, 101, 102])->count();

                        $cnt500 = $cnt500 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 500)->count();
                        $cnt400 = $cnt400 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 102)->count();
                        $cnt200 = $cnt200 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 200)->count();
                        $cnt101 = $cnt101 + Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('status_code', 101)->count();
                        $count500 = $cnt500;
                        $count400 = $cnt400;
                        $count200 = $cnt200;
                        $count101 = $cnt101;
                    }

                    // if(!empty($startDate) && !empty($endDate))
                    // $hit_count_master = HitCountMaster::where('user_id',Auth::user()->id)->where('api_id',$value->api_id)->whereBetween('created_at', [$startDate, $endDate])->count();
                    if (!empty($ddl_year_month)) {
                        if ($year_month != 0)
                            $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->count();
                        else
                            $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();
                    } else
                        $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();

                    // for($i=0; $i<count($transactions);$i++){

                    //     if($transactions[$i]['status_code'] == 500){
                    //         $cnt500++;
                    //         $count500++;
                    //     }else if($transactions[$i]['status_code'] == 102){
                    //         $cnt400++;
                    //         $count400++;
                    //     }else if($transactions[$i]['status_code'] == 200){
                    //         $cnt200++;
                    //         $count200++;
                    //     }else if($transactions[$i]['status_code'] == 101){
                    //         $cnt101++;
                    //         $count101++;
                    //     }
                    // }

                    //  $hits_per_days = DB::select("SELECT * FROM docboyz_api.transaction where user_id = ".$userService." and api_id = ".$value->api_id." and hit_year_month = '".$year_month."' group by DATE(created_at)");
                    $hits_per_days = DB::table('transaction')
                        ->select(DB::raw('user_id, api_id, hit_year_month, DATE(created_at) as date, COUNT(*) as count'))
                        ->where('user_id', $userService)
                        ->where('api_id', $value->api_id)
                        ->whereNotNull('hit_year_month')
                        ->groupBy('user_id', 'api_id', 'hit_year_month', 'date')
                        ->get();
                    // foreach($hits_per_days as $key1=>$hit){
                    //     $date = date("Y-m-d", strtotime($hit->created_at));
                    //     $hits_date[$key1] = date("d-m", strtotime($hit->created_at));
                    //     $hits_per_day[$key1] = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->where('created_at', 'like', $date.'%')->where('status_code', '!=', 401)->count();
                    // }

                    $payableHits = $cnt200 + $cnt400 + $cnt101;

                    if ($hit_count_master > 0) {
                        $reports[$key]['api_id'] = $value->api_id;
                        $reports[$key]['api_name'] = $value->api_master->api_name ?? null;
                        $reports[$key]['hit_count'] = $transactions;
                        if ($value->custom_plan == 'yes') {
                            $payment_slab = explode(',', $value->payment_slab);
                            $scheme_price = explode(',', $value->scheme_price);
                            for ($i = 0; $i < count($payment_slab); $i++) {
                                if ($i == (count($payment_slab) - 1)) {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    } else if ($payableHits > $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                } else {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                }
                            }
                        } else {
                            $reports[$key]['scheme_price'] = $value->scheme_price;
                            $reports[$key]['total'] = $payableHits * $value->scheme_price;
                        }
                    }
                }
            }
            $user_scheme_master_arr = $user_scheme_master->toArray();
        }
        $hit_count = [];
        $api_name = [];
        $total_hits = 0;
        if (count($hits_date) > 0) {
            foreach ($hits_date as $ht) {
                $total_hits++;
            }
        } else {
            foreach ($reports as $key => $value) {
                array_push($hit_count, $value['hit_count']);
                array_push($api_name, $value['api_name']);
                $total_hits++;
            }
        }

        return view('reports.list', compact('hits_date', 'hits_per_day', 'isAdmin', 'year_month', 'cnt500', 'cnt101', 'cnt400', 'cnt200', 'count500', 'count101', 'count400', 'count200', 'reports', 'total_hits', 'users', 'hit_count', 'api_name', 'userService', 'ddl_year_month'));
    }

    public function generateBill(Request $request)
    {

        $reports = array();
        // $serviceType = 0;
        $year_month = 0;
        $userService = 0;
        $users = '';
        $cnt200 = 0;
        $cnt400 = 0;
        $cnt500 = 0;
        $cnt101 = 0;
        if (Auth::user()->id == 1) {
            $userService = $request->userDetails;
            $year_month = $request->yearMonth;


            // dd($year_month);

            $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', $userService)->get();

            foreach ($user_scheme_master as $key => $value) {
                $cnt200 = 0;
                $cnt400 = 0;
                $cnt500 = 0;
                $cnt101 = 0;
                $payableHits = 0;
                if ($year_month != 0) {
                    $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->get();
                    $hit_count_master = HitCountMaster::where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->count();
                } else {
                    $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id', $value->api_id)->get();
                    $hit_count_master = HitCountMaster::where('user_id', $userService)->where('api_id', $value->api_id)->count();
                }

                for ($i = 0; $i < count($transactions); $i++) {
                    if ($transactions[$i]['status_code'] == 500) {
                        $cnt500++;
                    } else if ($transactions[$i]['status_code'] == 102) {
                        $cnt400++;
                    } else if ($transactions[$i]['status_code'] == 200) {
                        $cnt200++;
                    } else if ($transactions[$i]['status_code'] == 101) {
                        $cnt101++;
                    }
                }
                $payableHits = $cnt200 + $cnt400 + $cnt101;
                if ($hit_count_master > 0) {
                    $reports[$key]['api_id'] = $value->api_id;
                    $reports[$key]['api_name'] = $value->api_master->api_name;
                    $reports[$key]['hit_count'] = $cnt200 + $cnt400 + $cnt101;
                    if ($value->custom_plan == 'yes') {
                        $payment_slab = explode(',', $value->payment_slab);
                        $scheme_price = explode(',', $value->scheme_price);
                        if ($year_month != 0) {
                            for ($i = 0; $i < count($payment_slab); $i++) {
                                if ($i == (count($payment_slab) - 1)) {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    } else if ($payableHits > $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                } else {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                        break;
                                    }
                                }
                            }
                        } else {
                            $transaction_details = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->select('hit_year_month')->groupBy('hit_year_month')->get();
                            if ($transaction_details) {
                                if (count($transaction_details) > 1) {
                                    $reports[$key]['scheme_price'] = $scheme_price[0];
                                    $reports[$key]['total'] = $payableHits * $scheme_price[0];
                                } else {
                                    for ($i = 0; $i < count($payment_slab); $i++) {
                                        if ($i == (count($payment_slab) - 1)) {
                                            if ($payableHits <= $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                            } else if ($payableHits > $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                            }
                                            break;
                                        } else {
                                            if ($payableHits <= $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                                break;
                                            }
                                        }
                                    }
                                }
                            } else {
                                $reports[$key]['scheme_price'] = 0;
                                $reports[$key]['total'] = 0;
                            }
                        }
                    } else {
                        $reports[$key]['scheme_price'] = $value->scheme_price;
                        $reports[$key]['total'] = $payableHits * $value->scheme_price;
                    }
                }
            }
            $user_scheme_master_arr = $user_scheme_master->toArray();
        } else {
            
            $userService = Auth::user()->id;
            // $user_scheme_master_dropdown = UserSchemeMaster::with('api_master')->where('user_id',Auth::user()->id)->get()->toArray();
            $ddl_year_month = HitCountMaster::whereNotNull('hit_year_month')->select('hit_year_month')->orderBy('hit_year_month', 'desc')->groupBy('hit_year_month')->get();
            // dd($ddl_year_month);

            $serviceType = $request->serviceType;
            // $startDate = $request->startDate;
            // $endDate = $request->endDate;
            $year_month = $request->yearMonth;
            if ($serviceType == 0)
                $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->get();
            else
                $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->where('api_id', $serviceType)->get();

            foreach ($user_scheme_master as $key => $value) {
                $cnt200 = 0;
                $cnt400 = 0;
                $cnt500 = 0;
                $cnt101 = 0;
                $payableHits = 0;
                // if(!empty($startDate) && !empty($endDate))
                // $hit_count_master = HitCountMaster::where('user_id',Auth::user()->id)->where('api_id',$value->api_id)->whereBetween('created_at', [$startDate, $endDate])->count();
                if ($year_month != 0) {
                    $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->get();
                    $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->count();
                } else {
                    $transactions = Transaction::select('status_code')->where('user_id', $userService)->where('api_id', $value->api_id)->get();
                    $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();
                }

                for ($i = 0; $i < count($transactions); $i++) {
                    if ($transactions[$i]['status_code'] == 500) {
                        $cnt500++;
                    } else if ($transactions[$i]['status_code'] == 102) {
                        $cnt400++;
                    } else if ($transactions[$i]['status_code'] == 200) {
                        $cnt200++;
                    } else if ($transactions[$i]['status_code'] == 101) {
                        $cnt101++;
                    }
                }

                $payableHits = $cnt200 + $cnt400 + $cnt101;

                if ($hit_count_master > 0) {
                    $reports[$key]['api_id'] = $value->api_id;
                    $reports[$key]['api_name'] = $value->api_master->api_name;
                    $reports[$key]['hit_count'] = $cnt200 + $cnt400 + $cnt101;
                    if ($value->custom_plan == 'yes') {
                        $payment_slab = explode(',', $value->payment_slab);
                        $scheme_price = explode(',', $value->scheme_price);
                        if ($year_month != 0) {
                            for ($i = 0; $i < count($payment_slab); $i++) {
                                if ($i == (count($payment_slab) - 1)) {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    } else if ($payableHits > $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                    }
                                    break;
                                } else {
                                    if ($payableHits <= $payment_slab[$i]) {
                                        $reports[$key]['scheme_price'] = $scheme_price[$i];
                                        $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                        break;
                                    }
                                }
                            }
                        } else {
                            $transaction_details = Transaction::where('user_id', $userService)->where('api_id', $value->api_id)->select('hit_year_month')->groupBy('hit_year_month')->get();

                            if ($transaction_details) {
                                if (count($transaction_details) > 1) {
                                    $reports[$key]['scheme_price'] = $scheme_price[0];
                                    $reports[$key]['total'] = $payableHits * $scheme_price[0];
                                } else {
                                    for ($i = 0; $i < count($payment_slab); $i++) {
                                        if ($i == (count($payment_slab) - 1)) {
                                            if ($payableHits <= $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                            } else if ($payableHits > $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                            }
                                            break;
                                        } else {
                                            if ($payableHits <= $payment_slab[$i]) {
                                                $reports[$key]['scheme_price'] = $scheme_price[$i];
                                                $reports[$key]['total'] = $payableHits * $scheme_price[$i];
                                                break;
                                            }
                                        }
                                    }
                                }
                            } else {
                                $reports[$key]['scheme_price'] = 0;
                                $reports[$key]['total'] = 0;
                            }
                        }
                    } else {
                        $reports[$key]['scheme_price'] = $value->scheme_price;
                        $reports[$key]['total'] = $payableHits * $value->scheme_price;
                    }
                }
            }
            $user_scheme_master_arr = $user_scheme_master->toArray();
        }
        $users = User::where('type', 'role_prepaid')->where('id', $userService)->first();

        $hit_count = [];
        $api_name = [];
        $total_hits = 0;
        foreach ($reports as $key => $value) {
            array_push($hit_count, $value['hit_count']);
            array_push($api_name, $value['api_name']);
            $total_hits++;
        }

        return view('reports.generate_bill', compact('users', 'year_month', 'cnt500', 'cnt400', 'cnt200', 'reports', 'total_hits', 'users', 'hit_count', 'api_name', 'userService'));
    }

    public function export(Request $request)
    {
        $reports = array();
        $sr = 0;
        $serviceType = $request->serviceType;
        // $startDate = $request->startDate;
        // $endDate = $request->endDate;
        $year_month = $request->year_month;

        if ($serviceType == "0") {
            $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->get();

            foreach ($user_scheme_master as $key => $value) {
                $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();
                if ($hit_count_master > 0) {
                    $reports[$sr]['api_id'] = $value->api_id;
                    $reports[$sr]['api_name'] = $value->api_master->api_name;
                    $reports[$sr]['scheme_price'] = $value->scheme_price;
                    $reports[$sr]['hit_count'] = $hit_count_master;
                    $reports[$sr]['total'] = $value->scheme_price * $hit_count_master;
                    $sr++;
                }
            }
        } else {
            $user_scheme_master = UserSchemeMaster::with('api_master')->where('user_id', Auth::user()->id)->where('api_id', $serviceType)->get();

            foreach ($user_scheme_master as $key => $value) {
                // if(!empty($startDate) && !empty($endDate))
                //     $hit_count_master = HitCountMaster::where('user_id',Auth::user()->id)->where('api_id',$value->api_id)->whereBetween('created_at', [$startDate, $endDate])->count();
                if (!empty($ddl_year_month))
                    $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->where('hit_year_month', $year_month)->count();
                else
                    $hit_count_master = HitCountMaster::where('user_id', Auth::user()->id)->where('api_id', $value->api_id)->count();
                if ($hit_count_master > 0) {
                    $reports[$sr]['api_id'] = $value->api_id;
                    $reports[$sr]['api_name'] = $value->api_master->api_name;
                    $reports[$sr]['scheme_price'] = $value->scheme_price;
                    $reports[$sr]['hit_count'] = $hit_count_master;
                    $reports[$sr]['total'] = $value->scheme_price * $hit_count_master;
                    $sr++;
                }
            }
        }

        $pdf = PDF::loadView('pdf.report', compact('reports', 'serviceType', 'startDate', 'endDate', 'year_month'));
        $pdf->setPaper('A4', 'portrait');
        // return $pdf->download("text.pdf");
        // $pdf->render();
        // return $pdf->stream();
        $path = public_path('pdf/');
        $datetime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
        $fileName = 'report-' . $datetime . '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        $data = new \stdClass();
        $data->name = 'Ajay';
        $data->pickup_name = 'Test';
        $data->subject_name = 'Test email';
        // $data->pdf_link = Helper::S3F($AWSfile);
        // $data->pdf_link = route('case.generatepdf.link', ['pickup_id' => base64_encode($Pickups->id),'activity_id'=> base64_encode($Pickups->activity_id)]);
        $data->pdf_link = $path . '/' . $fileName;
        $data->agent_detail = 'Agent Name';    //'1mohsin.sk@gmail.com'
        Mail::to('ajay.bhalke@deeptechmind.com')
            ->send(new Pickuppdf($data->pdf_link, $data));

        return response()->json(['status' => 200, 'reports' => $reports, 'message' => 'PDF exported successful']);
    }

    public function reportfile($filename)
    {
        $file = public_path() . "/pdf/" . $filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $filename, $headers);
    }

    public function pdf(Request $request)
    {
        $reports = array();
        $sr = 0;
        $serviceType = 0;
        $startDate = "";
        $endDate = "";
        #pdf code
        // $pdf = PDF::loadView('pdf.report', compact('reports', 'serviceType', 'startDate', 'endDate'));
        return view('pdf.report', compact('reports'));
        // $pdf->setPaper('A4', 'portrait');
        // return $pdf->download("text.pdf");
        // $pdf->render();
        // return $pdf->stream();
        // $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
        // exit(0); 
    }

    public function sendemail(Request $request)
    {
        $data = new \stdClass();
        $data->name = 'Ajay';
        $data->pickup_name = 'Test';
        $data->subject_name = 'Test email';
        // $data->pdf_link = Helper::S3F($AWSfile);
        // $data->pdf_link = route('case.generatepdf.link', ['pickup_id' => base64_encode($Pickups->id),'activity_id'=> base64_encode($Pickups->activity_id)]);
        $data->pdf_link = 'google.com';
        $data->agent_detail = 'Agent Name';    //'1mohsin.sk@gmail.com'
        Mail::to('ajay.bhalke@deeptechmind.com')
            ->send(new Pickuppdf($data->pdf_link, $data));
        // return $pdf->stream();
    }
}
