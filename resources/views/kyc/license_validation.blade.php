@extends('adminlte::page')

@section('title', 'License Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">License Verification</h3>
                <a role = "button" class = "btn btn-light float-right"
                href = "{{ route('kyc.license_api') }}">DL APIs</a>
            </div>
            <div class="card-body">
                @if(isset($license_validation['statusCode']) && $license_validation['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        License Number is Invalid
                  </div>
                @endif
                @if(isset($license_validation['statusCode']) && ($license_validation['statusCode'] == '404' || null))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($license_validation['statusCode']) && $license_validation['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.license_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">License Number</label>
                                <input type="text" class="form-control"
                                    id="license_number" name="license_number" value="{{old('license_number')}}"
                                    placeholder="Ex: MH121020152012" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}" placeholder="DD-MM-YYYY" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($license_validation) && isset($license_validation[0]['statusCode']))
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">License Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p>License Number: {{ $license_validation[0]['license_validation']['response']['license_number'] }}</p>
                        <p>Name: {{ $license_validation[0]['license_validation']['response']['holder_name'] }}</p>
                        <p>Father / Husband Name: {{ $license_validation[0]['license_validation']['response']['father_or_husband_name'] }}</p>
                        <p>DOB: {{$license_validation[0]['license_validation']['response']['dob']}}</p>
                        <p>Permanent Address: {{ $license_validation[0]['license_validation']['response']['permanent_address'] }}</p>
                        <p>Temporary Address: {{ $license_validation[0]['license_validation']['response']['temporary_address'] }}</p>
                        <p>Permanent ZIP: {{ $license_validation[0]['license_validation']['response']['permanent_zip'] }}</p>
                        <p>Temporary ZIP: {{ $license_validation[0]['license_validation']['response']['temporary_zip'] }}</p>
                        <p>State: {{ $license_validation[0]['license_validation']['response']['state']}}</p>
                        <p>Valid From: {{ $license_validation[0]['license_validation']['response']['valid_from']}}</p>
                        <p>Valid Upto: {{ $license_validation[0]['license_validation']['response']['valid_upto']}}</p>
                        {{-- <p>District: {{ $license_validation[0]['license_validation']['response']['address'][0]['district'] }}</p> --}}
                        <p>Image: <br><img src="{{ $license_validation[0]['license_validation']['response']['image'] }}" alt="Profile"></p>
                        <p>License Verification: {{ $license_validation[0]['statusCode'] }}</p>

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
 