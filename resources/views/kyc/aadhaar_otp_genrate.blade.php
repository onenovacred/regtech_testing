@extends('adminlte::page')

@section('title', 'Regtechapi - Aadhar OTP')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Aadhar OTP Genrate..</h3> 
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.aadhaar_api') }}">Aadhaar APIs</a>
            </div>
            <div class="card-body">
                @if(isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Aadhaar is Invalid 
                  </div>
                @endif
                @if(isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '404')
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhaar_otp_genrate')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="12" minlength="12" 
                                    id="aadhaar_number" name="aadhaar_number" value="{{old('aadhaar_number')}}" 
                                    placeholder="Ex: 1111 2222 3333" required>
                                </div>
                                <button type="submit" class="btn btn-success">Get OTP</button>
                                <button type="submit" class="btn btn-success">Click to Submit OTP</button>
                        </form><br>

                       <a href="{{url('/kyc/aadhaar_otp_submit')}}"> <button type="submit" class="btn btn-success">Click to Submit OTP</button></a>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_otp_genrate) && $aadhaar_otp_genrate['status'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhaar OTP Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Request_id: {{ $aadhaar_otp_genrate['data']['request_id'] }}</p>
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