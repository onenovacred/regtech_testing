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
                <h3 class="card-title">Passport Upload</h3>
                <a href = "{{ route('kyc.passport_api') }}" class="btn btn-light float-right">Passport APIs</a>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Passport is Invalid 
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
                        <form role="form" method="post" action="{{route('kyc.passport_upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Client ID</label>
                                <input type="text" class="form-control" name="client_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Passport File</label>
                                <input type="file" class="form-control" name="file"  required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($passport) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Passport Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <strong><p>OCR READING OF  : {{ $passport['data']['passport_num'] }}</p></strong>
                        <strong><p>Status Code : {{200}}</p></strong>
                        <p>Passport Number: {{ $passport['data']['passport_num'] }}</p>
                        <p>DOB: {{ $passport['data']['dob'] }}</p>
                        <p>Father Name: {{ $passport['data']['father'] }}</p>
                        <p>Full Name: {{ $passport['data']['given_name'] }}</p>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div>
                    
       
                        <p>client_id: {{ $passport['data']['client_id'] }}</p>
                        <p>country_code: {{ $passport['data']['country_code'] }}</p>
                        <p>dob: {{ $passport['data']['dob'] }}</p>
                        <p>doe: {{ $passport['data']['doe'] }}</p>
                        <p>doi: {{ $passport['data']['doi'] }}</p>
                        <p>gender: {{ $passport['data']['gender'] }}</p>
                        <p>given_name: {{ $passport['data']['given_name'] }}</p>
                        <p>nationality: {{ $passport['data']['nationality'] }}</p>
                        <p>passport_num: {{ $passport['data']['passport_num'] }}</p>
                        <p>place_of_birth: {{ $passport['data']['place_of_birth'] }}</p>
                        <p>place_of_issue: {{ $passport['data']['place_of_issue'] }}</p>
                        <p>surname: {{ $passport['data']['surname'] }}</p>
                        <p>mrz_line_1: {{ $passport['data']['mrz_line_1'] }}</p>
                        <p>mrz_line_2: {{ $passport['data']['mrz_line_2'] }}</p>
                        <p>type_of_passport: {{ $passport['data']['type_of_passport'] }}</p>
                        <p>address: {{ $passport['data']['address'] }}</p>
                        <p>father: {{ $passport['data']['father'] }}</p>
                        <p>mother: {{ $passport['data']['mother'] }}</p>
                        <p>file_num: {{ $passport['data']['file_num'] }}</p>
                        <p>old_doi: {{ $passport['data']['old_doi'] }}</p>
                        <p>old_passport_num: {{ $passport['data']['old_passport_num'] }}</p>
                        <p>old_place_of_issue: {{ $passport['data']['old_place_of_issue'] }}</p>
                        <p>pin: {{ $passport['data']['pin'] }}</p>
                        <p>spouse: {{ $passport['data']['spouse'] }}</p>
                        <p>passport_validity: {{ $passport['data']['passport_validity'] }}</p>
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