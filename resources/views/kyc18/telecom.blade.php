@extends('adminlte::page')

@section('title', 'Telecom')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Telecom</h3>
                <a href = "{{ route('kyc.telecom_apis') }}" class = "btn btn-light float-right">Telecom APIs</a>
            </div>
            <div class="card-body">
                @if(isset($telecom['statusCode']) && $telecom['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Wrong Phone Number. 
                    </div>
                @endif

                @if(isset($telecom['statusCode']) && $telecom['statusCode'] == '404')
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($telecom['statusCode']) && $telecom['statusCode'] == '400')
                <div class="alert alert-danger" role="alert">
                    Wrong Phone Number.
                </div>
                @endif
                @if(isset($telecom['statusCode']) && $telecom['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <!-- @if($statusCode == '200')
               <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif -->

                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{ route('kyc.telecom_generate_otp') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Telecom Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="mobile_number" name="mobile_number" value="{{old('mobile_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form><br>

                        <a href = "{{ route('kyc.telecom_submit_otp') }}" class = "btn btn-success" role = "button">
                            Submit OTP
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($telecom) && $telecom['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Telecom Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Client ID: {{ $telecom['Telecom Generate OTP Details']['data']['client_id'] }}</p>
                        <p>Operator: {{ $telecom['Telecom Generate OTP Details']['data']['operator'] }}</p>

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