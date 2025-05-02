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
                <a href = "{{ route('kyc.aadhaar_api') }}" role = "button" 
                class = "btn btn-light float-right">Aadhaar APIs</a> 
            </div>
            <div class="card-body">
                @if(isset($aadhaar_validation[0]['aadhaar_validation']['code']) && $aadhaar_validation[0]['aadhaar_validation']['code'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Aadhaar Number is Invalid 
                  </div>
                @endif
                @if(isset($aadhaar_validation[0]['aadhaar_validation']['code']) && ($aadhaar_validation[0]['aadhaar_validation']['code'] == '404'))
                <div class="alert alert-danger" role="alert">
                    {{$aadhaar_validation[0]['aadhaar_validation']['response']}}
                </div>
                @endif
                @if(isset($aadhaar_validation[0]['aadhaar_validation']['code']) && $aadhaar_validation[0]['aadhaar_validation']['code'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
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
        <!-- status_code -->
        @if(!empty($aadhaar_validation) && isset($aadhaar_validation[0]['aadhaar_validation']['status']['statusCode']) && $aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'] == 200)  
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhaar Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                    
                        <p>Age Range: {{ $aadhaar_validation[0]['aadhaar_validation']['response']['ageBand'] }}</p>
                        <p>Gender: {{ $aadhaar_validation[0]['aadhaar_validation']['response']['gender']}}</p>
                        <p>Mobile: {{ $aadhaar_validation[0]['aadhaar_validation']['response']['mobileNumber'] }}</p>
                        <p>State: {{ $aadhaar_validation[0]['aadhaar_validation']['response']['state'] }}</p>
                        <p>Aadhaar Verification: {{ $aadhaar_validation[0]['aadhaar_validation']['response']['verified'] }}</p>
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