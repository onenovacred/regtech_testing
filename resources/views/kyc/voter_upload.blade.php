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
                <h3 class="card-title">Voter Verification</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.voter_api') }}">Voter APIs</a>
            </div>
            <div class="card-body">
             @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details
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
                        <form role="form" method="post" action="{{route('kyc.voter.upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Voter ID Image</label>
                                <input type="file" class="form-control" name="file"  required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($voter) && isset($statusCode) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Voter ID CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Voter ID Number: {{ $voter['data']['ocr_fields'][0]['epic_number']['value'] }}</p>
                        @php
                        $dob = explode('-',$voter['data']['ocr_fields'][0]['dob']['value']);
                        @endphp
                        <p>DOB: {{ $dob[0] }}-XX-XX</p>
                        <p>Age: {{ $voter['data']['ocr_fields'][0]['age']['value'] }}</p>
                        <p>Gender: {{ $voter['data']['ocr_fields'][0]['gender']['value'] }}</p>
                        <p>Father Name: {{ $voter['data']['ocr_fields'][0]['care_of']['value'] }}</p>
                        <p>Full Name: {{ $voter['data']['ocr_fields'][0]['full_name']['value'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($voter_detailed_info!=null && isset($is_valid) && $is_valid == 1)
        <div class = "card card-success">
            <div class = "card-header">
                <h3 class = "card-title">Voter Detailed Information</h3>
            </div>
            <div class = "card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      	<p>Verification Sucessfull  </p>
                        <p>Client ID: {{ $voter_detailed_info['data']['client_id'] }}</p>
                        <p>Gender: @if($voter_detailed_info['data']['gender'] == 'M') Male @elseif($voter_detailed_info['data']['gender'] == 'F') Female @else {{$voter_detailed_info['data']['gender']}} @endif</p>
                        <p>State: {{ $voter_detailed_info['data']['state'] }}</p>
                        <p>Name: {{$voter_detailed_info['data']['name']}}</p>
                        <p>Relation Name: {{$voter_detailed_info['data']['relation_name']}}</p>
                        <p>Relation Type: {{ $voter_detailed_info['data']['relation_type'] }}</p>
                        <p>House No.: {{ $voter_detailed_info['data']['house_no'] }}</p>
                        <p>DOB: {{ $voter_detailed_info['data']['dob'] }}</p>
                        <p>Age: {{ $voter_detailed_info['data']['age'] }}</p>
                        <p>Area: {{ $voter_detailed_info['data']['area'] }}</p>
                        <p>District: {{ $voter_detailed_info['data']['district'] }}</p>
                        <p>Multiple: {{$voter_detailed_info['data']['multiple']}}</p>
                        <p>Last Update: {{$voter_detailed_info['data']['last_update']}}</p>
                        <p>Assembly Constituency: {{ $voter_detailed_info['data']['assembly_constituency'] }}</p>
                        <p>Assembly Constituency Number: {{ $voter_detailed_info['data']['assembly_constituency_number'] }}</p>
                        <p>Polling Station: {{ $voter_detailed_info['data']['polling_station'] }}</p>
                        <p>Part Number: {{ $voter_detailed_info['data']['part_number'] }}</p>
                        <p>Part Name: {{ $voter_detailed_info['data']['part_name'] }}</p>
                        <p>Parliamentary Constituency: {{ $voter_detailed_info['data']['parliamentary_constituency'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@stop


@section('custom_js')
@stop