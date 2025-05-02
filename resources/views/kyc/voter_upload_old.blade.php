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
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Voter is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
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

        @if(!empty($voter) && $statusCode == 200 &&  $voter['message'] !== "Voter ID Card Not Found.")
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
        @else
            <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Voter ID</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Voter ID not Found!</p>
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