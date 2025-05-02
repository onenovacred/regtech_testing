@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <style>
        .form-control {
            border: 1px solid #ced4da !important;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if ($renew ?? '' == 'true')
                                Renew Plan
                            @else
                                Edit User
                            @endif
                        </h3>
                    </div>
                    <form role="form" id="frmUpdateScheme" method="post" action="{{ route('user.update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="renew" name="renew" value="{{ $renew ?? '' }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" id="ids" name="ids" value="{{ $user_scheme_ids }}">
                        <input type="hidden" id="delete_ids" name="delete_ids">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select Scheme Type</label>
                                        <select class="form-control" id="scheme_type" name="scheme_type" required>
                                            <option value="demo" @if ($user->scheme_type == 'demo') selected @endif>Demo
                                            </option>
                                            <option value="production" @if ($user->scheme_type == 'production') selected @endif>
                                                Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select Scheme</label>
                                        <select class="form-control" id="scheme_type_id" name="scheme_type_id"
                                            @if ($user->scheme_type == 'production') disabled @endif>
                                            <option value="">Select Scheme</option>
                                            <!-- if($user->scheme_type=='demo') -->
                                            @foreach ($scheme_types as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    @if ($user->scheme_type_id == $value->id) selected @endif>{{ $value->name }}
                                                </option>
                                            @endforeach
                                            <!-- endif -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Full Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">User Menu Permission</label>
                                        <select id="menu_ids" name="menu_ids[]" class="form-control selectpicker multiselect" multiple="" data-live-search="true" data-actions-box="true">
                                            <option value="user">Users</option>
                                            <option value="apimaster">Api Master</option>
                                            <option value="report">Report</option>
                                            <option value="transactions">Transactions</option>
                                            <option value="schemetypemaster">Scheme Type Master</option>   
				                        </select>    
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rdo"
                                                value="role_postpaid" @if ($user->type == 'role_postpaid') checked @endif>
                                            <label class="form-check-label">Postpaid</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rdo"
                                                value="role_prepaid" @if ($user->type == 'role_prepaid') checked @endif>
                                            <label class="form-check-label">Prepaid</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3" id="plan_duration_days">Plan Duration
                                    ({{ $user_scheme_details[0]['duration'] }} Days)</div>
                                <div class="col-md-3">Plan Amount (Rs.)</div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <label>Select A Regtech Plan</label><br />
                                </div>
                                <div class="col-md-3">

                                    <select name="plan" id="plan" class="form-control selectpicker"
                                        data-live-search="true" data-actions-box="true">
                                        <option value="">Select Plan</option>
                                        <option value="basic" @if ($user_scheme_details[0]['plan'] == 'basic') selected @endif>Basic Plan
                                        </option>
                                        <option value="starter"@if ($user_scheme_details[0]['plan'] == 'starter') selected @endif>Starter
                                            Plan</option>
                                        <option value="standard"@if ($user_scheme_details[0]['plan'] == 'standard') selected @endif>Standard
                                            Plan</option>
                                        <option value="advance"@if ($user_scheme_details[0]['plan'] == 'advance') selected @endif>Advance
                                            Plan</option>
                                        <option value="growth"@if ($user_scheme_details[0]['plan'] == 'growth') selected @endif>Growth
                                            Plan</option>
                                        <option value="unicorn"@if ($user_scheme_details[0]['plan'] == 'unicorn') selected @endif>Unicorn
                                            Plan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                            if($user_scheme_details[0]['start_date'] != null && $user_scheme_details[0]['start_date'] != ''){
                                                $startDate = $user_scheme_details[0]['start_date'];
                                                $endDate = $user_scheme_details[0]['end_date'];
                                                $newStartDate = date("Y-m-d", strtotime($startDate));
                                                $newEndDate = date("Y-m-d", strtotime($endDate));
                                        ?>
                                    <input class="form-control" type="text" name="plan_duration" id="plan_duration"
                                        value="{{ $newStartDate }} to {{ $newEndDate }}" placeholder="Plan Duration"
                                        disabled>
                                    <?php }else{ ?>
                                    <input class="form-control" type="text" name="plan_duration" id="plan_duration"
                                        value="" placeholder="Plan Duration" disabled>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3" style="padding-right: 15px;">
                                    <input class="form-control" type="text" name="plan_amount" id="plan_amount"
                                        value="{{ $user_scheme_details[0]['plan_amount'] }}" placeholder="Plan Amount"
                                        disabled>
                                </div>
                            </div>
                            <hr>
                            <?php
                            $apis = DB::table('api_master')
                                ->select('id', 'api_name', 'admin_price', 'api_group_id')
                                ->get();
                            ?>
                            <input type="hidden" name="scheme_type" id="scheme_type" value="{{ $user->scheme_type }}">
                            <div class="form-group" id="demo">
                                <?php
                                if (Auth::user()->id != 1) {
                                    $api_group = null;
                                    $api_group = DB::table('user_scheme_master')
                                        ->where('user_id', Auth::user()->id)
                                        ->join('api_group', 'user_scheme_master.api_group_id', '=', 'api_group.id')
                                        ->select('api_group.*')
                                        ->distinct()
                                        ->get();
                                }
                                
                                ?>
                                @foreach ($api_group as $key => $value)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox" style="margin-left: 8px;">
                                                <input class="custom-control-input groupcheckboxdemo" type="checkbox"
                                                    id="grpchkdemo_{{ $value->id }}" value="{{ $value->id }}">
                                                <label for="grpchkdemo_{{ $value->id }}"
                                                    class="custom-control-label text-red">{{ $value->group_name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // $sub_menus = DB::table('api_master')
                                    //     ->select('id', 'table_name', 'api_name', 'admin_price', 'api_group_id')
                                    //     ->where('api_group_id', $value->id)
                                    //     ->get();
                                    $sub_menus = null;
                                    if (Auth::user()->id == 1) {
                                        $sub_menus = DB::table('api_master')
                                            ->select('id', 'table_name', 'api_name', 'admin_price', 'api_group_id')
                                            ->where('api_group_id', $value->id)
                                            ->get();
                                    } else {
                                        $sub_menus = DB::table('user_scheme_master')
                                            ->join('api_master', 'api_master.id', '=', 'user_scheme_master.api_id')
                                            ->join('api_group', 'api_group.id', '=', 'user_scheme_master.api_group_id')
                                            ->where('user_scheme_master.user_id', '=', Auth::user()->id)
                                            ->where('api_master.api_group_id', '=', $value->id)->distinct()
                                            ->get(['user_scheme_master.*', 'api_master.*']);
                                    }
                                    
                                   ?>
                                    @if (count($sub_menus) > 0)
                                        @foreach ($sub_menus as $sub_menu)
                                            <div class="row" style="padding-bottom: 5px;">
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox" style="margin-left: 8px;">
                                                        <input
                                                            class="custom-control-input checkbox groupcheckboxdemo_{{ $sub_menu->api_group_id }}"
                                                            type="checkbox"
                                                            id="chkdemo_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}"
                                                            name="chk_api_iddemo" value="{{ $sub_menu->id }}"
                                                            @if (in_array($sub_menu->id, $user_scheme_arr)) checked @endif>
                                                        <label
                                                            for="chkdemo_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}"
                                                            class="custom-control-label">{{ $sub_menu->api_name }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control"
                                                                id="txtPlanPricedemo{{ $sub_menu->id }}"
                                                                name="txtPlanPricedemo{{ $sub_menu->id }}"
                                                                value="{{ $sub_menu->admin_price }}" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text"
                                                                class="form-control grouptextdemo_{{ $sub_menu->api_group_id }}"
                                                                id="txtUserPricedemo{{ $sub_menu->id }}"
                                                                @if (!in_array($sub_menu->id, $user_scheme_arr)) disabled @else value="{{ $user_scheme_price[$sub_menu->id] }}" @endif>
                                                        </div>
                                                           <!-- Get Response in Dropdown-->
                                                        <div class="col-md-3">
                                                            <?php
                                                            $sub_menusid = DB::table('api_master')
                                                                ->select('table_name')
                                                                ->where('id', $sub_menu->id)
                                                                ->get();
                                                            if (!empty($sub_menusid)) {
                                                                $data = json_decode($sub_menusid[0]->table_name);
                                                                if (is_array($data)) {
                                                                    echo '<select id="stage_id" name="stage_id[]" class="form-control selectpicker multiselect" multiple="" data-live-search="true" data-actions-box="true">';
                                                            
                                                                    foreach ($data as $tableName) {
                                                                        echo '<option value="' . $tableName . '">' . $tableName . '</option>';
                                                                    }
                                                            
                                                                    echo '</select>';
                                                                }
                                                            }
                                                            
                                                            ?>

                                                        </div>
                                                        <!-- Get Request in Dropdown! -->
                                                        <div class="col-md-3">
                                                            <?php
                                                            $sub_menusid = DB::table('api_master')
                                                                ->select('request_table_name')
                                                                ->where('id', $sub_menu->id)
                                                                ->get();
                                                               // dd($sub_menusid);
                                                            if (!empty($sub_menusid)) {
                                                                $data = json_decode($sub_menusid[0]->request_table_name);
                                                                if (is_array($data)) {
                                                                    echo '<select id="request_value" name="request_value[]" class="form-control selectpicker multiselect" multiple="" data-live-search="true" data-actions-box="true">';
                                                            
                                                                    foreach ($data as $request_table_name) {
                                                                        echo '<option value="' . $request_table_name . '">' . $request_table_name . '</option>';
                                                                    }
                                                            
                                                                    echo '</select>';
                                                                }
                                                            }
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-group" id="production">


                                <!-- <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6>Custom Range From</h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6>Custom Range To</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php
                                    if (Auth::user()->id != 1) {
                                        $api_group = null;
                                        $api_group = DB::table('user_scheme_master')
                                            ->where('user_id', Auth::user()->id)
                                            ->join('api_group', 'user_scheme_master.api_group_id', '=', 'api_group.id')
                                            ->select('api_group.*')
                                            ->distinct()
                                            ->get();
                                    }
                                  ?>
                                @foreach ($api_group as $key => $value)
                                    <div class="row" style="padding-bottom: 10px">
                                        <div class="col-md-5">
                                            <div class="custom-control custom-checkbox" style="margin-left: 8px;">
                                                <input class="custom-control-input groupcheckbox" type="checkbox"
                                                    id="grpchk_{{ $value->id }}" value="{{ $value->id }}">
                                                <label for="grpchk_{{ $value->id }}"
                                                    class="custom-control-label text-red">{{ $value->group_name }}</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-7">
                                                <div class="field_wrapper1{{ $value->id }}">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control customRange_from{{ $value->id }}" id="customRange_1_from{{ $value->id }}" name="customRange_1_from{{ $value->id }}" value="" placeholder="range from...">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control customRange_to{{ $value->id }}" id="customRange_1_to{{ $value->id }}" name="customRange_1_to{{ $value->id }}" value="" placeholder="range upto...">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" id="customPlanPrice1{{ $value->id }}" name="customPlanPrice1{{ $value->id }}" value="">
                                                        </div>
                                                        <div class="col-md-2" style="padding-top:5px;">
                                                            <a href="javascript:void(0);" class="add_button" onclick="addRange1({{ $value->id }})" title="Add field" ><i class="fa fa-fw fa-plus-circle"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     -->
                                    </div>
                                    <?php
                                    // $sub_menus = DB::table('api_master')
                                    //     ->select('id', 'api_name', 'admin_price', 'basic_price', 'starter_price', 'standard_price', 'advance_price', 'growth_price', 'unicorn_price', 'api_group_id')
                                    //     ->where('api_group_id', $value->id)
                                    //     ->get();
                                    $sub_menus = null;
                                    if (Auth::user()->id == 1) {
                                        $sub_menus = DB::table('api_master')
                                        ->select('id', 'api_name', 'admin_price', 'basic_price', 'starter_price', 'standard_price', 'advance_price', 'growth_price', 'unicorn_price', 'api_group_id')
                                        ->where('api_group_id', $value->id)
                                        ->get();
                                      
                                    } else {
                                        $sub_menus = DB::table('user_scheme_master')
                                            ->join('api_master', 'api_master.id', '=', 'user_scheme_master.api_id')
                                            ->join('api_group', 'api_group.id', '=', 'user_scheme_master.api_group_id')
                                            ->where('user_scheme_master.user_id', '=', Auth::user()->id)
                                            ->where('api_master.api_group_id', '=', $value->id)->distinct()
                                            ->get(['user_scheme_master.*', 'api_master.*']);
                                    }
                                       
                                    ?>
                                    @if (count($sub_menus) > 0)
                                        @foreach ($sub_menus as $key1 => $sub_menu)
                                            <div class="row" id="editContent{{ $sub_menu->id }}"
                                                style="padding-bottom: 5px;">
                                                <div class="col-md-5">
                                                    <div class="custom-control custom-checkbox" style="margin-left: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <input
                                                                    class="custom-control-input checkbox groupcheckbox_{{ $sub_menu->api_group_id }}"
                                                                    type="checkbox"
                                                                    id="chk_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}"
                                                                    name="chk_api_id" value="{{ $sub_menu->id }}"
                                                                    @if (in_array($sub_menu->id, $user_scheme_arr)) checked @endif>
                                                                <label
                                                                    for="chk_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}"
                                                                    class="custom-control-label">{{ $sub_menu->api_name }}</label>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <select name="planType" id="planType_{{ $sub_menu->id }}"
                                                                    class="planType form-control selectpicker"
                                                                    data-live-search="true" data-actions-box="true">
                                                                    <option value="">Nothing selected</option>
                                                                    <option value="regtech_plan"
                                                                        @if (isset($user_scheme_details[$key]) &&
                                                                                isset($user_scheme_range[$sub_menu->id]) &&
                                                                                $user_scheme_range[$sub_menu->id] == 'null') selected @endif>
                                                                        Regtech API Plan</option>
                                                                    <option value="custom_plan"
                                                                        @if (isset($user_scheme_details[$key]) &&
                                                                                isset($user_scheme_range[$sub_menu->id]) &&
                                                                                $user_scheme_range[$sub_menu->id] != 'null') selected @endif>
                                                                        Custom Plan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $count = count($user_scheme_arr);
                                                ?>
                                                <input type="hidden" name="count" id="count"
                                                    value="{{ $count }}">
                                                @if (isset($user_scheme_details[$key]) &&
                                                        isset($user_scheme_range[$sub_menu->id]) &&
                                                        $user_scheme_range[$sub_menu->id] == 'null')
                                                    <input type="hidden" name="regtechplan{{ $sub_menu->id }}"
                                                        id="regtechplan{{ $sub_menu->id }}" value="regtech_plan">
                                                @elseif(isset($user_scheme_details[$key]) &&
                                                        isset($user_scheme_range[$sub_menu->id]) &&
                                                        $user_scheme_range[$sub_menu->id] != 'null')
                                                    <input type="hidden" name="regtechplan{{ $sub_menu->id }}"
                                                        id="regtechplan{{ $sub_menu->id }}" value="custom_plan">
                                                @else
                                                    <input type="hidden" name="regtechplan{{ $sub_menu->id }}"
                                                        id="regtechplan{{ $sub_menu->id }}" value="">
                                                @endif
                                                <div class="col-md-2 text-center" id="regtech_plan{{ $sub_menu->id }}">
                                                    <?php
                                                        if(isset($user_scheme_details[0]['plan']) && $user_scheme_details[0]['plan'] != ''){
                                                            $scheme_price = $user_scheme_details[0]['plan'].'_price';
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        id="txtPlanPrice{{ $sub_menu->id }}"
                                                        name="txtPlanPrice{{ $sub_menu->id }}"
                                                        value="{{ $sub_menu->$scheme_price }}" disabled>
                                                    <?php 
                                                        }else{
                                                    ?>
                                                    <input type="text" class="form-control"
                                                        id="txtPlanPrice{{ $sub_menu->id }}"
                                                        name="txtPlanPrice{{ $sub_menu->id }}" value="" disabled>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>

                                                <div class="col-md-2 text-center" id="user_price{{ $sub_menu->id }}">
                                                    <input type="text"
                                                        class="form-control grouptext_{{ $sub_menu->api_group_id }}"
                                                        id="txtUserPrice{{ $sub_menu->id }}"
                                                        @if (!in_array($sub_menu->id, $user_scheme_arr)) disabled @else value="{{ $user_scheme_price[$sub_menu->id] }}" @endif>
                                                </div>


                                                <div class="col-md-7" id="custom_plan{{ $sub_menu->id }}">
                                                    <?php
                                                    $schemeRangeExploded = [];
                                                    $schemePriceExploded = [];
                                                    if (isset($user_scheme_price[$sub_menu->id])) {
                                                        $schemePriceExploded = explode(',', $user_scheme_price[$sub_menu->id]);
                                                    }
                                                    if (isset($user_scheme_range[$sub_menu->id])) {
                                                        $schemeRangeExploded = explode(',', $user_scheme_range[$sub_menu->id]);
                                                    }
                                                    ?>
                                                    <div class="field_wrapper{{ $sub_menu->id }}">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text"
                                                                    class="form-control customRange_from{{ $sub_menu->id }}"
                                                                    id="customRange_1_from{{ $sub_menu->id }}"
                                                                    name="customRange_1_from{{ $sub_menu->id }}"
                                                                    value="0" placeholder="hits range from...">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text"
                                                                    class="form-control customRange_to{{ $sub_menu->id }}"
                                                                    id="customRange_1_to{{ $sub_menu->id }}"
                                                                    name="customRange_1_to{{ $sub_menu->id }}"
                                                                    @if (isset($schemeRangeExploded[0])) value="{{ $schemeRangeExploded[0] }}" @else value = "" @endif
                                                                    placeholder="hits range upto...">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control"
                                                                    id="customPlanPrice1{{ $sub_menu->id }}"
                                                                    name="customPlanPrice1{{ $sub_menu->id }}"
                                                                    @if (isset($schemePriceExploded[0])) value="{{ $schemePriceExploded[0] }}" @else value = "" @endif
                                                                    placeholder="Rs.">
                                                            </div>
                                                            <div class="col-md-2" style="padding-top:5px;">
                                                                <a href="javascript:void(0);" class="add_button"
                                                                    onclick="addRange({{ $sub_menu->id }})"
                                                                    title="Add field"><i
                                                                        class="fa fa-fw fa-plus-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $priceRange = 0;
                                                        if(count($schemePriceExploded) > 1){
                                                            foreach($schemePriceExploded as $key=>$price){
                                                                if(isset($schemeRangeExploded[$key+1])){ ?>
                                                    <div id="rangeDiv{{ $sub_menu->id }}{{ $key + 2 }}"
                                                        class="row" style="padding: 5px 0px">
                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                class="form-control customRange_from{{ $sub_menu->id }}"
                                                                id="customRange_{{ $key + 2 }}_from{{ $sub_menu->id }}"
                                                                name="customRange_{{ $key + 2 }}_from{{ $sub_menu->id }}"
                                                                value="{{ $schemeRangeExploded[$key] }}"
                                                                placeholder="hits range from...">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                class="form-control customRange_to{{ $sub_menu->id }}"
                                                                id="customRange_{{ $key + 2 }}_to{{ $sub_menu->id }}"
                                                                name="customRange_{{ $key + 2 }}_to{{ $sub_menu->id }}"
                                                                value="{{ $schemeRangeExploded[$key + 1] }}"
                                                                placeholder="hits range upto...">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control"
                                                                id="customPlanPrice{{ $key + 2 }}{{ $sub_menu->id }}"
                                                                name="customPlanPrice{{ $key + 2 }}{{ $sub_menu->id }}"
                                                                value="{{ $schemePriceExploded[$key + 1] }}"
                                                                placeholder="Rs.">
                                                        </div>
                                                        <div class="col-md-2" style="padding-top:5px">
                                                            <a href="javascript:void(0);"
                                                                class="remove_button{{ $sub_menu->id }}"
                                                                onclick="removeRange({{ $sub_menu->id }}{{ $key + 2 }})"><i
                                                                    class="fa fa-fw fa-minus-circle"></i></a>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                                    $priceRange = $key + 1;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <input type="hidden" id="priceRange{{ $sub_menu->id }}"
                                                        value="{{ $priceRange }}"
                                                        name="priceRange{{ $sub_menu->id }}" />
                                                </div>
                                                        <div class="col-md-2">
                                                            <?php
                                                            $sub_menusid = DB::table('api_master')
                                                                ->select('table_name')
                                                                ->where('id', $sub_menu->id)
                                                                ->get();
                                                            if (!empty($sub_menusid)) {
                                                                $data = json_decode($sub_menusid[0]->table_name);
                                                                if (is_array($data)) {
                                                                    echo '<select id="stage_id" name="stage_id[]" class="form-control selectpicker multiselect" multiple="" data-live-search="true" data-actions-box="true">';
                                                            
                                                                    foreach ($data as $tableName) {
                                                                        echo '<option value="' . $tableName . '">' . $tableName . '</option>';
                                                                    }
                                                            
                                                                    echo '</select>';
                                                                }
                                                            }
                                                            
                                                            ?>

                                                        </div>
                                                        <!-- Get Request in Dropdown! -->
                                                        <div class="col-md-3">
                                                            <?php
                                                            $sub_menusid = DB::table('api_master')
                                                                ->select('request_table_name')
                                                                ->where('id', $sub_menu->id)
                                                                ->get();
                                                               // dd($sub_menusid);
                                                            if (!empty($sub_menusid)) {
                                                                $data = json_decode($sub_menusid[0]->request_table_name);
                                                                if (is_array($data)) {
                                                                    echo '<select id="stage_id" name="request_value[]" class="form-control selectpicker multiselect w-50" multiple="" data-live-search="true" data-actions-box="true">';
                                                            
                                                                    foreach ($data as $request_table_name) {
                                                                        echo '<option value="' . $request_table_name . '">' . $request_table_name . '</option>';
                                                                    }
                                                            
                                                                    echo '</select>';
                                                                }
                                                            }
                                                            
                                                            ?>

                                                        </div>

                                            </div>
                                            
                                            <!-- <div class="row" id="content{{ $sub_menu->id }}" style="padding-bottom: 5px; display: none">
                                                    <div class="col-md-5">
                                                        <div class="custom-control custom-checkbox" style="margin-left: 8px;">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <input class="custom-control-input checkbox groupcheckbox_{{ $sub_menu->api_group_id }}" type="checkbox" id="chk_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}" name="chk_api_id" value="{{ $sub_menu->id }}" @if (in_array($sub_menu->id, $user_scheme_arr)) checked @endif>
                                                                    <label for="chk_{{ $sub_menu->id }}_{{ $sub_menu->api_group_id }}" class="custom-control-label">{{ $sub_menu->api_name }}</label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <select name="planType" id="planType_{{ $sub_menu->id }}" class="planType form-control selectpicker" data-live-search="true" data-actions-box="true">
                                                                        <option value="">Nothing selected</option>
                                                                        <option value="regtech_plan">Regtech API Plan</option>
                                                                        <option value="custom_plan" >Custom Plan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2 text-center" id="regtech_plan1{{ $sub_menu->id }}">
                                                        <input type="text" class="form-control" id="txtPlanPrice{{ $sub_menu->id }}" name="txtPlanPrice{{ $sub_menu->id }}" value="" disabled>
                                                    </div>
                                                    
                                                    <div class="col-md-2 text-center" id="user_price1{{ $sub_menu->id }}">
                                                        <input type="text" class="form-control grouptext_{{ $sub_menu->api_group_id }}" id="txtUserPrice{{ $sub_menu->id }}" disabled>
                                                    </div>

                                                    <div class="col-md-7" id="custom_plan1{{ $sub_menu->id }}" style="display: none">
                                                        <div class="field_wrapper{{ $sub_menu->id }}">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control customRange_1_from{{ $sub_menu->id }}" id="customRange_1_from{{ $sub_menu->id }}" name="customRange_1_from{{ $sub_menu->id }}" value="" placeholder="range from...">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control customRange_1_to{{ $sub_menu->id }}" id="customRange_1_to{{ $sub_menu->id }}" name="customRange_1_to{{ $sub_menu->id }}" value="" placeholder="range upto...">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="customPlanPrice1{{ $sub_menu->id }}" name="customPlanPrice1{{ $sub_menu->id }}" value="">
                                                                </div>
                                                                <div class="col-md-2" style="padding-top:5px;">
                                                                    <a href="javascript:void(0);" class="add_button" onclick="addRange({{ $sub_menu->id }})" title="Add field" ><i class="fa fa-fw fa-plus-circle"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                            <div class="text-center">
                                <button type="button" id="btnUpdate" class="btn btn-primary"
                                    style="width:40%; margin: 20px 0 20px 0">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('custom_js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script>
        var x = 2;
        var regtechPlan = $("#plan option:selected").val();

        function getPlans(regtechPlan) {
            var formdata = {
                plan: regtechPlan
            };
            $.ajax({
                type: 'get',
                url: '{!! route('getPlanValues') !!}',
                data: formdata,
                datatype: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i]['price'] != null) {
                            $("#txtPlanPrice" + data[i]['id']).val(data[i]['price']);
                        } else {
                            $("#txtPlanPrice" + data[i]['id']).val('0');
                        }
                    }
                },
                error: function(error) {
                    alert(error);
                }
            });
        }

        $(document).ready(function() {
            var passed_array = <?php echo json_encode($apis); ?>;
            // Display the elements inside the array
            for (var i = 0; i < passed_array.length; i++) {
                if ($("#regtechplan" + passed_array[i]['id']).val() == 'regtech_plan') {
                    $('#regtech_plan' + passed_array[i]['id']).show();
                    $('#user_price' + passed_array[i]['id']).show();
                    $('#custom_plan' + passed_array[i]['id']).hide();
                } else if ($("#regtechplan" + passed_array[i]['id']).val() == 'custom_plan') {
                    $('#regtech_plan' + passed_array[i]['id']).hide();
                    $('#user_price' + passed_array[i]['id']).hide();
                    $('#custom_plan' + passed_array[i]['id']).show();
                } else {
                    $('#regtech_plan' + passed_array[i]['id']).show();
                    $('#user_price' + passed_array[i]['id']).show();
                    $('#custom_plan' + passed_array[i]['id']).hide();
                }
            }
            if ($("#scheme_type").val() == 'demo') {
                $("#demo").show();
                $("#production").hide();
                $("#productionItems").hide();
            } else {
                $("#demo").hide();
                $("#production").show();
                $("#productionItems").show();
            }
            getPlans(regtechPlan);
            var customRange = 0;
            $("#productionItems").hide();
            $("#submitButton").hide();

            $("select.planType").change(function() {
                curid = $(this).attr("id");
                var res = curid.split("_");
                var data = $(this).val();
                // $("#editContent"+res[1]).hide();
                // $("#content"+res[1]).show();
                $('#regtech_plan' + res[1]).hide();
                $('#user_price' + res[1]).hide();
                $('#custom_plan' + res[1]).hide();
                // $('#regtech_plan1'+res[1]).hide();
                // $('#user_price1'+res[1]).hide();
                // $('#custom_plan1'+res[1]).hide();
                if (data == "regtech_plan") {
                    $('#regtech_plan' + res[1]).show();
                    $('#user_price' + res[1]).show();
                    $('#custom_plan' + res[1]).hide();
                    // $('#regtech_plan1'+res[1]).show();
                    // $('#user_price1'+res[1]).show();
                    // $('#custom_plan1'+res[1]).hide();
                }
                if (data == "custom_plan") {
                    $('#custom_plan' + res[1]).show();
                    $('#regtech_plan' + res[1]).hide();
                    $('#user_price' + res[1]).hide();
                    // $('#custom_plan1'+res[1]).show();
                    // $('#regtech_plan1'+res[1]).hide();
                    // $('#user_price1'+res[1]).hide();
                }
                if (data == '') {
                    $('#regtech_plan' + res[1]).show();
                    $('#user_price' + res[1]).show();
                }
            });
        });

        $(function() {

            var d = new Date();
            var currentDate = '';

            if (d.getDate() < 10) {
                if (d.getMonth() < 10) {
                    currentDate = d.getFullYear() + "-" + '0' + (d.getMonth() + 1) + "-" + '0' + d.getDate();
                } else {
                    currentDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + '0' + d.getDate();
                }

            } else {
                if (d.getMonth() < 10) {
                    currentDate = d.getFullYear() + "-" + '0' + (d.getMonth() + 1) + "-" + d.getDate();
                } else {
                    currentDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
                }
            }

            function calculatedays(ndays) {
                var newdt = new Date();
                newdt.setDate(newdt.getDate() + parseInt(ndays));
                var newdate = newdt.getFullYear();
                if (newdt.getMonth() < 10) {
                    newdate = newdate + '-' + '0' + (newdt.getMonth() + 1);
                } else {
                    newdate = newdate + '-' + (newdt.getMonth() + 1);
                }
                if (newdt.getDate() < 10) {
                    newdate = newdate + '-' + '0' + newdt.getDate();
                } else {
                    newdate = newdate + '-' + newdt.getDate();
                }
                return newdate;
            }

            $('#plan').change(function() {
                regtechPlan = $(this).val();
                var date = 0;
                if ($(this).val() == 'basic') {
                    date = calculatedays(30);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (30 Days)');
                    document.getElementById("plan_amount").value = '15000';
                } else if ($(this).val() == 'starter') {
                    date = calculatedays(90);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (90 Days)');
                    document.getElementById("plan_amount").value = '37500';
                } else if ($(this).val() == 'standard') {
                    date = calculatedays(90);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (90 Days)');
                    document.getElementById("plan_amount").value = '75000';
                } else if ($(this).val() == 'advance') {
                    date = calculatedays(180);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (180 Days)');
                    document.getElementById("plan_amount").value = '150000';
                } else if ($(this).val() == 'growth') {
                    date = calculatedays(365);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (365 Days)');
                    document.getElementById("plan_amount").value = '450000';
                } else if ($(this).val() == 'unicorn') {
                    date = calculatedays(365);
                    document.getElementById("plan_duration").value = currentDate + ' to ' + date;
                    $('#plan_duration_days').html('Plan Duration (365 Days)');
                    document.getElementById("plan_amount").value = '750000';
                } else {
                    document.getElementById("plan_duration").value = '';
                    $('#plan_duration_days').html('Plan Duration (0 Days)');
                    document.getElementById("plan_amount").value = '';
                }

                getPlans(regtechPlan);
            });


            $("#btnUpdate").click(function() {
                var ids = "";
                var delete_ids = "";
                var curid = "";
                var flag = 0;
                var focusid = "";

                var scheme_type = $("#scheme_type option:selected").val();
                var scheme_type_id = $("#scheme_type_id option:selected").val();
                var name = $.trim($("#name").val());
                var email = $.trim($("#email").val());
                var plan = $.trim(regtechPlan);

                if (scheme_type == "") {
                    $("#scheme_type").focus();
                    // $("#scheme_type").addClass('is-invalid');
                    return false;
                }
                // else {
                //     $("#name").removeClass('is-invalid').addClass('is-valid');
                // }
                if (scheme_type == "demo") {
                    if (scheme_type_id == "") {
                        $("#scheme_type_id").focus();
                        // $("#scheme_type").addClass('is-invalid');
                        return false;
                    }
                    // else {
                    //     $("#name").removeClass('is-invalid').addClass('is-valid');
                    // }
                }
                if (name == "") {
                    $("#name").focus();
                    // $("#name").addClass('is-invalid');
                    return false;
                }
                // else {
                //     $("#name").removeClass('is-invalid').addClass('is-valid');
                // }
                if (email == "") {
                    $("#email").focus();
                    // $("#email").addClass('is-invalid');
                    return false;
                }

                if (scheme_type == "production") {
                    if (plan == "") {
                        $("#plan").focus();
                        // $("#cpassword").addClass('is-invalid');
                        return false;
                    }
                }


                if (scheme_type == "production") {
                    $(document).find("input[name='chk_api_id']:checked").each(function() {
                        curid = $(this).attr("id");
                        var res = curid.split("_");
                        var custom_plan = '';
                        var custom_plan_val = '';
                        var custom_range_val = '';

                        var plan_type = $("#planType_" + res[1]).val();
                        if (plan_type.indexOf("custom_plan") != -1) {
                            if (document.getElementById('customPlanPrice1' + res[1]).value == '') {
                                $("#customPlanPrice1" + res[1]).focus();
                                return false;
                            }
                            if (document.getElementById('customRange_1_from' + res[1]).value ==
                                '') {
                                $("#customRange_1_from" + res[1]).focus();
                                return false;
                            }
                            if (document.getElementById('customRange_1_to' + res[1]).value == '') {
                                $("#customRange_1_to" + res[1]).focus();
                                return false;
                            }
                            var value = [];
                            var rangeValue = [];
                            if ($("#priceRange" + res[1]).val() > 0) {
                                x += Number($("#priceRange" + res[1]).val());
                            }

                            for (var i = 1; i <= x; i++) {
                                if ($("#customRange_" + i + "_to" + res[1]).val() != '') {
                                    if (document.getElementById('customPlanPrice' + i + res[1])) {
                                        value.push(document.getElementById('customPlanPrice' + i +
                                            res[1]).value);
                                        rangeValue.push(document.getElementById('customRange_' + i +
                                            '_to' + res[1]).value);
                                        // custom_plan_val = document.getElementById('customPlanPrice'+i+res[1]).value;
                                    }
                                }
                            }
                            custom_plan_val = value.join(',');
                            custom_range_val = rangeValue.join(',');
                            custom_plan = 'yes';
                            ids = ids + res[1] + "|" + custom_plan_val + "|" + res[2] + "|" +
                                custom_plan + "|" + plan + "|" + custom_range_val + "/";
                        } else {
                            if (document.getElementById('txtUserPrice' + res[1]).value == '') {
                                $("#customRange_1_to" + res[1]).focus();
                                return false;
                            }

                            custom_plan = 'no';
                            custom_plan_val = null;
                            ids = ids + res[1] + "|" + $("#txtUserPrice" + res[1]).val() + "|" +
                                res[2] + "|" + custom_plan + "|" + plan + "|" + null + "/";
                        }
                        if (custom_plan == 'no' && $("#txtUserPrice" + res[1]).val() == "") {
                            // alert($("#txtUserPrice"+res[1]).val());
                            flag = 1;
                            if (focusid == "")
                                focusid = res[1];
                        }
                    });
                    ids = ids.replace(/,\s*$/, "");
                    $("#ids").val(ids);

                    $(document).find("input[name='chk_api_id']:not(:checked)").each(function() {
                        curid = $(this).attr("id");
                        var res = curid.split("_");
                        delete_ids = delete_ids + res[1] + ",";
                    });
                    delete_ids = delete_ids.replace(/,\s*$/, "");

                    $("#delete_ids").val(delete_ids);
                    if (ids == "") {
                        alert('Please select at least 1 service');
                        return false;
                    } else if (flag == 0) {
                        // alert('done');
                        $("#frmUpdateScheme").submit();
                    } else {
                        // alert('flag 1');
                        $("#txtUserPrice" + focusid).focus();
                    }
                } else if (scheme_type == "demo") {
                    $(document).find("input[name='chk_api_iddemo']:checked").each(function() {
                        curid = $(this).attr("id");
                        var res = curid.split("_");
                        console.log(res);
                        custom_plan = 'no';
                        custom_plan_val = null;
                        ids = ids + res[1] + "|" + $("#txtUserPricedemo" + res[1]).val() + "|" +
                            res[2] + "|" + custom_plan + "|" + plan + "|" + null + "/";
                        // ids = ids + res[1] + "|" + $("#txtUserPricedemo"+res[1]).val() + "|" + res[2] + ",";
                        if ($("#txtUserPricedemo" + res[1]).val() == "") {
                            // alert($("#txtUserPrice"+res[1]).val());
                            flag = 1;
                            if (focusid == "")
                                focusid = res[1];
                        }
                    });
                    ids = ids.replace(/,\s*$/, "");
                    $("#ids").val(ids);

                    $(document).find("input[name='chk_api_iddemo']:not(:checked)").each(function() {
                        curid = $(this).attr("id");
                        var res = curid.split("_");
                        delete_ids = delete_ids + res[1] + ",";
                    });
                    delete_ids = delete_ids.replace(/,\s*$/, "");

                    $("#delete_ids").val(delete_ids);
                    if (ids == "") {
                        alert('Please select at least 1 service');
                        return false;
                    } else if (flag == 0) {
                        // alert('done');
                        $("#frmUpdateScheme").submit();
                    } else {
                        // alert('flag 1');
                        $("#txtUserPricedemo" + focusid).focus();
                    }
                }
            });

            $(document).on("change", ".checkbox", function() {
                var curid = $(this).attr('id');
                var res = curid.split("_");
                var scheme_type = $("#scheme_type option:selected").val();
                if (scheme_type == 'production') {
                    if (this.checked) {
                        $("#txtUserPrice" + res[1]).val('').prop('disabled', false);
                        // $('#planType_'+res[1]).prop('disabled', false);
                    } else {
                        $("#txtUserPrice" + res[1]).val('').prop('disabled', true);
                    }
                } else if (scheme_type == 'demo') {
                    if (this.checked) {
                        $("#txtUserPricedemo" + res[1]).val('').prop('disabled', false);
                        // $('#planType_'+res[1]).prop('disabled', false);
                    } else {
                        $("#txtUserPricedemo" + res[1]).val('').prop('disabled', true);
                    }
                }

                $('#customRange_to' + res[1]).change(function() {
                    if ($(this).val() <= 100000) {
                        var customPlanPrice = document.getElementById('customPlanPrice' + res[1]);
                        customPlanPrice.value = '1.75';
                    } else if ($(this).val() > 100000 && $(this).val() <= 200000) {
                        var customPlanPrice = document.getElementById('customPlanPrice' + res[1]);
                        customPlanPrice.value = '1.50';
                    } else if ($(this).val() > 200000 && $(this).val() <= 300000) {
                        var customPlanPrice = document.getElementById('customPlanPrice' + res[1]);
                        customPlanPrice.value = '1.25';
                    }
                });

                if (scheme_type == 'production') {
                    var cntGroup = $('.groupcheckbox_' + res[2]).length;
                    var cntChecked = $('.groupcheckbox_' + res[2] + ':checked').length;
                    if (cntGroup != cntChecked) {
                        $(document).find("#grpchk_" + res[2]).prop('checked', false);
                    } else {
                        $(document).find("#grpchk_" + res[2]).prop('checked', true);
                    }
                } else if (scheme_type == 'demo') {
                    var cntGroup = $('.groupcheckboxdemo_' + res[2]).length;
                    var cntChecked = $('.groupcheckboxdemo_' + res[2] + ':checked').length;
                    if (cntGroup != cntChecked) {
                        $(document).find("#grpchkdemo_" + res[2]).prop('checked', false);
                    } else {
                        $(document).find("#grpchkdemo_" + res[2]).prop('checked', true);
                    }
                }
            });

            $("#scheme_type").change(function() {
                var scheme_type = $("#scheme_type option:selected").val();
                $("#demo").hide();
                $("#production").hide();
                $("#productionItems").hide();
                $("#submitButton").hide();
                if (scheme_type == 'demo') {
                    $("#demo").show();
                    $("#production").hide();
                    $("#productionItems").hide();
                    $("#submitButton").show();
                    $("#scheme_type_id").val('').prop('disabled', false).prop('required', true);
                    $(document).find("input[name='chk_api_iddemo']").each(function() {
                        var curid = $(this).attr("id");
                        var res = curid.split("_");
                        // alert($("#txtBasicPrice"+res[1]).val());
                        // $("#txtUserPrice"+res[1]).val($("#txtBasicPrice"+res[1]).val());
                        $("#txtUserPricedemo" + res[1]).val("0");
                    });
                } else if (scheme_type == 'production') {
                    $("#demo").hide();
                    $("#production").show();
                    $("#productionItems").show();
                    $("#submitButton").show();
                    $("#scheme_type_id").val('').prop('disabled', true).prop('required', false);
                    $(document).find("input[name='chk_api_id']").each(function() {
                        var curid = $(this).attr("id");
                        var res = curid.split("_");
                        $("#txtUserPrice" + res[1]).val("");
                    });
                }
            });

            $(document).on("change", ".groupcheckbox", function() {
                var curid = $(this).attr('id');
                var ischecked = $(this).prop('checked');
                var res = curid.split("_");
                var scheme_type = $("#scheme_type option:selected").val();
                if (ischecked == true) {
                    $(document).find(".groupcheckbox_" + res[1]).prop('checked', true);
                    if (scheme_type != 'demo') {
                        $(document).find(".grouptext_" + res[1]).val('').prop('disabled', false);
                    }
                } else {
                    $(document).find(".groupcheckbox_" + res[1]).prop('checked', false);
                    if (scheme_type != 'demo') {
                        $(document).find(".grouptext_" + res[1]).val('').prop('disabled', true);
                    }
                }
            });

            $(document).on("change", ".groupcheckboxdemo", function() {
                var curid = $(this).attr('id');
                var ischecked = $(this).prop('checked');
                var res = curid.split("_");
                var scheme_type = $("#scheme_type option:selected").val();
                // console.log("scheme_type1");
                if (ischecked == true) {
                    // console.log("scheme_type1");
                    $(document).find(".groupcheckboxdemo_" + res[1]).prop('checked', true);
                    $(document).find(".grouptextdemo_" + res[1]).val('').prop('disabled', false);
                } else {
                    $(document).find(".groupcheckboxdemo_" + res[1]).prop('checked', false);
                    $(document).find(".grouptextdemo_" + res[1]).val('').prop('disabled', true);
                }
            });
        });

        function addRange(id) {
            x = 2;
            if ($("#priceRange" + id).val() > 0) {
                x += Number($("#priceRange" + id).val());
            }
            var fieldHTML = '<div id="rangeDiv' + id + x +
                '" class="row" style="padding: 5px 0px"><div class="col-md-4"><input type="text" class="form-control customRange_from' +
                id + '" id="customRange_' + x + '_from' + id + '" name="customRange_' + x + '_from' + id +
                '" value="" placeholder="hits range from..."></div><div class="col-md-4"><input type="text" class="form-control customRange_to' +
                id + '" id="customRange_' + x + '_to' + id + '" name="customRange_' + x + '_to' + id +
                '" value="" placeholder="hits range upto..."></div><div class="col-md-2"><input type="text" class="form-control" id="customPlanPrice' +
                x + id + '" name="customPlanPrice' + x + id +
                '" value="" placeholder="Rs."></div><div class="col-md-2" style="padding-top:5px"><a href="javascript:void(0);" class="remove_button' +
                id + '" onclick="removeRange(' + id + x +
                ')"><i class="fa fa-fw fa-minus-circle"></i></a></div></div>'; //New input field html 
            x++;
            $('.field_wrapper' + id).append(fieldHTML);
        };

        function removeRange(id) {
            $("#rangeDiv" + id).remove();
            x--;
        };
    </script>
@stop
