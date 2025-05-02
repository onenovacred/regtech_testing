@extends('adminlte::page')

@section('title', 'Aadhaar Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Aadhaar Verification</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Aadhaar is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhaar_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="12" minlength="12" 
                                    id="aadhaar_number" name="aadhaar_number" value="{{old('aadhaar_number')}}" 
                                    placeholder="Ex: 1111 2222 3333" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_validation) && $aadhaar_validation['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhaar Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Aadhaar Number: {{ $aadhaar_validation['data']['aadhaar_number'] }}</p>
                        <p>Age Range: {{ $aadhaar_validation['data']['age_range'] }}</p>
                        <p>Gender: @if($aadhaar_validation['data']['gender'] == 'M') Male @elseif($aadhaar_validation['data']['gender'] == 'F') Female @else {{$aadhaar_validation['data']['gender']}} @endif</p>
                        <p>Mobile: {{ '*******'.$aadhaar_validation['data']['last_digits'] }}</p>
                        <p>State: {{ $aadhaar_validation['data']['state'] }}</p>
                        <p>Aadhaar Verification: {{ $aadhaar_validation['message_code'] }}</p>
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