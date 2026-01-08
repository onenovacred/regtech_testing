@extends('adminlte::page')

@section('title', 'Regtechapi - Aadhar OTP Submit')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Aadhar OTP Submit</h3>
                <a href = "{{ route('kyc.aadhaar_api') }}" role = "button" 
                class = "btn btn-light float-right">Aadhaar APIs</a>
            </div>
            <div class="card-body">
                @if(isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Aadhaar is Invalid 
                  </div>
                @endif
                @if(isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '404')
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif    
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhaar_otp_submit')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhar OTP Submit</label>
                                <input type="text" class="form-control" 
                                    id="client_id" name="client_id" value="{{old('client_id')}}" 
                                    placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                <input type="text" class="form-control" 
                                    maxlength="6" minlength="6" 
                                    id="otp" name="otp" value="{{old('otp')}}" 
                                    placeholder="Ex: 7723458" required>
                                </div>
                                <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_validation) && $aadhaar_validation['status'] == 200)

        <script>
            window.open("{{ route('aadhaar.pdf', ['client_id' => $aadhaar_validation]) }}", "_blank");
        </script>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhar Card Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>full_name: {{ $aadhaar_validation['data']['data']['full_name'] }}</p>
                        <p>aadhaar_number: {{ $aadhaar_validation['data']['data']['aadhaar_number'] }}</p>
                        <p>dob: {{ $aadhaar_validation['data']['data']['dob'] }}</p>
                        <p>gender: {{ $aadhaar_validation['data']['data']['gender'] }}</p>
                        <p>Email: {{ $aadhaar_validation['data']['data']['email_hash'] }}</p>
                        
                        <p>country: {{ $aadhaar_validation['data']['data']['address']['country']}}</p>
                        <p>dist: {{ $aadhaar_validation['data']['data']['address']['dist'] }}</p>
                        <p>state: {{ $aadhaar_validation['data']['data']['address']['state'] }}</p>
                        <p>po: {{ $aadhaar_validation['data']['data']['address']['po'] }}</p>
                        <p>loc: {{ $aadhaar_validation['data']['data']['address']['loc'] }}</p>
                        <p>vtc: {{ $aadhaar_validation['data']['data']['address']['vtc'] }}</p>
                        <p>subdist: {{ $aadhaar_validation['data']['data']['address']['subdist'] }}</p>
                        <p>street: {{ $aadhaar_validation['data']['data']['address']['street'] }}</p>
                        <p>house: {{ $aadhaar_validation['data']['data']['address']['house'] }}</p>
                        <p>landmark: {{ $aadhaar_validation['data']['data']['address']['landmark'] }}</p>

                        <p>face_status: {{ $aadhaar_validation['data']['data']['face_status'] }}</p>
                        <p>face_score: {{ $aadhaar_validation['data']['data']['face_score'] }}</p>
                        <p>zip: {{ $aadhaar_validation['data']['data']['zip'] }}</p>
                        <p>profile_image: <br><img src="data:image/jpeg;base64,{{ $aadhaar_validation['data']['data']['profile_image'] }}" alt="Profile"></p>
                        <p>has_image: {{ $aadhaar_validation['data']['data']['has_image'] }}</p>
                        
                        <p>raw_xml:  <a href="{{ $aadhaar_validation['data']['data']['raw_xml'] }}" class="btn btn-success">Download</a></p>
                        <p>zip_data: <a href="{{ $aadhaar_validation['data']['data']['zip_data'] }}" class="btn btn-success">Download</a></p>
                        <p>care_of: {{ $aadhaar_validation['data']['data']['care_of'] }}</p>
                        <p>share_code: {{ $aadhaar_validation['data']['data']['share_code'] }}</p>
                        <p>mobile_verified: {{ $aadhaar_validation['data']['data']['mobile_verified'] }}</p>
                       
                        <p>aadhaar_pdf: {{ $aadhaar_validation['data']['data']['aadhaar_pdf'] }}</p>
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