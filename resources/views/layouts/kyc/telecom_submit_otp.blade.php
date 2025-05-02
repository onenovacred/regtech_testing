@extends('adminlte::page')

@section('title', 'Telecom Submit OTP')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Telecom Submit OTP</h3>
            </div>
            <div class="card-body">
                @if($telecom_submit_otp['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        OTP is Invalid. 
                    </div>
                @endif

                @if($telecom_submit_otp['statusCode'] == '404' || $telecom_submit_otp['statusCode'] == '400')
                    <div class = "alert-danger alert-danger" role = "alert">
                        Server Error, Please try later
                    </div>
                @endif
                @if($telecom_submit_otp['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{ route('kyc.telecom_submit_otp') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Client ID</label>
                                    <input type="text" class="form-control"  
                                    id="client_id" name="client_id" value="{{old('client_id')}}" 
                                    placeholder="Ex: telecom_WKnzKAVVrtEghupBohfb" required>
                                </div>
                                
                                <div class = "form-group">
                                    <label class = "form-col-label" for = "otp">Enter OTP</label>
                                    <input type = "text" name = "otp" class = "form-control" value = "{{old('otp')}}"
                                    placeholder="Ex: 1010" required> 
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($telecom_submit_otp) && $telecom_submit_otp['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Telecom Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Client ID: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['client_id'] }}</p>
                        <p>Mobile Number: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['mobile_number'] }}</p>
                        <p>Address: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['address'] }}</p>
                        <p>City: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['city'] }}</p>
                        <p>State: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['state'] }}</p>
                        <p>Pin Code: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['pin_code'] }}</p>
                        <p>Full Name: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['full_name'] }}</p>
                        <p>Date of Birth: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['parsed_dob'] }}</p>
                        <p>User Email: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['user_email'] }}</p>
                        <p>Operator: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['operator'] }}</p>
                        <p>Billing Type: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['billing_type'] }}</p>
                        <p>Alternate Phone Number: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['alternate_phone'] }}</p>
                        <p>Extra Fields: {{ $telecom_submit_otp['Telecom Submit OTP']['data']['extra_fields'] }}</p>
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