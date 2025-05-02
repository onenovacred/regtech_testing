@extends('adminlte::page')

@section('title', 'Regtechapi - aadhar Upload')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Aadhaar Upload</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.aadhaar_api') }}">Aadhaar APIs</a>
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
                        <form role="form" method="post" action="{{route('kyc.aadhaar.upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar PDF</label>
                                <input type="file" class="form-control" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhaar CARD OCR</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Aadhaar Number: {{ $aadhaar['data']['aadhaar_number'] }}</p>
                        <p>Full Name: {{$aadhaarOCR['data']['ocr_fields'][0]['full_name']['value']}}</p>
                        <p>DOB: {{$aadhaarOCR['data']['ocr_fields'][0]['dob']['value']}}</p>
                        
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($aadhaar!=null)
        <div class = "card card-success">
            <div class = "card-header">
                <h3 class = "card-title">Aadhaar Verification</h3>
            </div>
            <div class = "card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Aadhaar Number: {{ $aadhaar['data']['aadhaar_number'] }}</p>
                        <p>Age Range: {{ $aadhaar['data']['age_range'] }}</p>
                        <p>Gender: @if($aadhaar['data']['gender'] == 'M') Male @elseif($aadhaar['data']['gender'] == 'F') Female @else {{$aadhaar['data']['gender']}} @endif</p>
                        <p>Mobile: {{ '*******'.$aadhaar['data']['last_digits'] }}</p>
                        <p>State: {{ $aadhaar['data']['state'] }}</p>
                        <p>Aadhaar Verification: {{ $aadhaar['message_code'] }}</p>
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