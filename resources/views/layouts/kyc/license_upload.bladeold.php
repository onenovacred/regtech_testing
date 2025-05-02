@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">License Upload</h3>
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
                        <form role="form" method="post" action="{{route('kyc.license.upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">License Front Image</label>
                                    <input type="file" class="form-control" name="front"  required>
                                    <label>License Back Image</label>
                                    <input type="file" class="form-control" name="back"  required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($license) && $license['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">License Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>License Number: {{ $license['data']['license_number']['value'] }}</p>
                        <p>DOB: {{ $license['data']['dob']['value'] }}</p>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
        @endif
        @if($license_validation!=null)
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