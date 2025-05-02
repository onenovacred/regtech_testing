@extends('adminlte::page')

@section('title', 'Regtechapi - EPFO OTP')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">EPFO OTP Genrate</h3>
                
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        EPFO number is Invalid 
                  </div>
                @endif
                @if(isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($statusCode) && $statusCode == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pf_generate_otp')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">EPFO Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="12" minlength="12" 
                                    id="epfo_number" name="epfo_number" value="{{old('epfo_number')}}" 
                                    placeholder="Ex: 1111 2222 3333" required>
                                </div>
                                <button type="submit" class="btn btn-success">Get OTP</button>
                        </form><br>

                       <a href="{{url('/kyc/pf_submit_otp')}}"> <button type="submit" class="btn btn-success">Click to Submit OTP</button></a>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pf_generate_otp) && $pf_generate_otp['status_code'] == 200)
        
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">EPFO OTP Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Client Id: {{ $pf_generate_otp['data']['client_id'] }}</p>
                        <p>Otp Sent: {{ $pf_generate_otp['data']['otp_sent'] }}</p>
                        <p>Masked Mobile Number: {{ $pf_generate_otp['data']['masked_mobile_number'] }}</p>
                        
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