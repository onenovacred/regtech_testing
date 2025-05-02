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
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        License is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
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
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($license_validation) && $license_validation['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">License Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>License Number: {{ $license_validation['data']['license_number'] }}</p>
                        <p>Name: {{ $license_validation['data']['name'] }}</p>
                        <p>Father / Husband Name: {{ $license_validation['data']['father_or_husband_name'] }}</p>
                        <p>Gender: {{$license_validation['data']['gender']}}</p>
                        <p>DOB: {{$license_validation['data']['dob']}}</p>
                        <p>Permanent Address: {{ $license_validation['data']['permanent_address'] }}</p>
                        <p>Permanent ZIP: {{ $license_validation['data']['permanent_zip'] }}</p>
                        <p>Temporary Address: {{ $license_validation['data']['temporary_address'] }}</p>
                        <p>Temporary ZIP: {{ $license_validation['data']['temporary_zip'] }}</p>
                        <p>Citizenship: {{ $license_validation['data']['citizenship'] }}</p>
                        <p>State: {{ $license_validation['data']['state'] }}</p>
                        <p>DOI: {{$license_validation['data']['doi']}}</p>
                        <p>DOE: {{$license_validation['data']['doe']}}</p>
                        <p>RTO Code: {{ $license_validation['data']['ola_code'] }}</p>
                        <p>RTO Name: {{ $license_validation['data']['ola_name'] }}</p>
                        <p>License Verification: {{ $license_validation['message_code'] }}</p>
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