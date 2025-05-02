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
                <h3 class="card-title">EPFO OTP Submit</h3>
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
                        <form role="form" method="post" action="{{route('kyc.pf_submit_otp')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">EPFO OTP Submit</label>
                                <input type="text" class="form-control" 
                                    id="client_id" name="client_id" value="{{old('client_id')}}" 
                                    placeholder="client_id: " required> <br>
                                <input type="text" class="form-control" 
                                    maxlength="6" minlength="6" 
                                    id="otp" name="otp" value="{{old('otp')}}" 
                                    placeholder="Ex: 7723458" required>
                                </div>
                                <button type="submit" class="btn btn-success">EPFO OTP Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pf_submit_otp) && $pf_submit_otp['status_code'] == 200)
        <h1>hii</h1>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">EPFO Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>client_id: {{ $pf_submit_otp['data']['client_id'] }}</p>
                        
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