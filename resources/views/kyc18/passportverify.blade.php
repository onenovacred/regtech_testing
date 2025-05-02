@extends('adminlte::page')

@section('title', 'Regtechapi - Passport Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Passport Verification</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.passport_api') }}">Passport APIs</a>
            </div>
            <div class="card-body">
                @if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        File Number is Invalid 
                  </div>
                @endif
                @if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal server error. Please contact techsupport@docboyz.in. for more details
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{ route('kyc.verify__passport') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">File Number</label>
                                <input type="text" class="form-control"  
                                    id="id_number" name="id_number" value="{{old('id_number')}}" 
                                    placeholder="Ex: PN1067476816213" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">DOB</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="dob" name="dob" value="{{old('dob')}}" 
                                    placeholder="Ex: yyyy-mm-dd" required>
                                </div>
                                <button type="submit" class="btn btn-success offset-md-3">Verify</button>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($passportverify) && $passportverify['statusCode'] == '200')
            <div class = "card card-success">
                <div class = "card-header">
                    <h3 class = "card-title">Passport Verification Details</h3>
                </div>
                <div class = "card-body">
                    <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p><b>Passport Verification {{ $passportverify['statusCode'] }} </b></p>
                    
                        <p>FileNumber: {{ $passportverify['Verification_Details']['response']['fileNumber'] }}</p>
                        <p>full_name: {{ $passportverify['Verification_Details']['response']['name'] }}</p>
                        <p>dob: {{ $passportverify['Verification_Details']['response']['dob'] }}</p>
                        <p>date_of_application: {{ $passportverify['Verification_Details']['response']['applicationReceivedOnDate'] }}</p>
                        <p>TypeOfApplication: {{ $passportverify['Verification_Details']['response']['typeOfApplication'] }}</p>
                      </div>
                    </div>
                </div>
                </div>
            </div>
        @endif

        @if(!empty($passportverify) && $passportverify['statusCode'] == '422')
            <div class = "card card-danger">
                <div class = "card-header">
                    <h3 class = "card-title">Passport Verification Details</h3>
                </div>
                <div class = "card-body">
                    <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><b>Message : {{ $passportverify['Verification_Details']['message'] }} </b></p>
                        <p><b>Message Code : {{ $passportverify['Verification_Details']['message_code'] }} </b></p>
                        <p>client_id: {{ $passportverify['Verification_Details']['data']['client_id'] }}</p>
                        <p>otp_sent: {{ $passportverify['Verification_Details']['data']['passport_number'] }}</p>
                        <p>if_number: {{ $passportverify['Verification_Details']['data']['full_name'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['dob'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['date_of_application'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['file_number'] }}</p>
                      </div>
                    </div>
                </div>
                </div>
            </div>
        @endif
@stop


@section('custom_js')
@stop