@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Aadhar masking</h3>
            </div>
            <div class="card-body">
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Please upload valid aadhar photo. Error code - 102 
                  </div>
                @endif
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && ($aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '404' || $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhaar_masking')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar Front</label>
                                <input type="file" class="form-control" name="file" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Aadhaar Back</label>
                                <input type="file" class="form-control" name="file_back">
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_masking) && isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhar Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Aadhar Number: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['aadhaar_number']['value'] }}</p>
                        <p><strong>Full Name: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['full_name']['value'] }}</p>
                        <p><strong>Gender: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['gender']['value'] }}</p>
                        <p><strong>DOB: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['dob']['value'] }}</p>
                        @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]))
                            <p><strong>Address: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['value'] }}</p>
                            <p><strong>City: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['city'] }}</p>
                            <p><strong>State: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['state'] }}</p>
                            <p><strong>Pincode: </strong>{{ $aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['zip'] }}</p>
                        @endif
                        @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']))
                            <p><strong>Masked Aadhar Front -</strong></p>
                        @else
                            <p><strong>Masked Aadhar -</strong></p>
                        @endif
                        <img src="{{$aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['masked_image']}}" style="width: 100%">
                        @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']))
                        <p style="margin-top:10px;"><strong>Masked Aadhar Back -</strong></p>
                        <img src="{{$aadhaar_masking[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']}}" style="width: 100%">
                        @endif
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