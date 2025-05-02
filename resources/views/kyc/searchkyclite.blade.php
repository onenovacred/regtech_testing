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
                <h3 class="card-title">Search Kyc Lite</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.search_api') }}">Search APIs</a>
            </div>
            <div class="card-body">
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        PAN Number is Invalid 
                  </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] == '404'))
                <div class="alert alert-danger" role="alert">
                    Server Error. Please try again later.
                </div>
                @endif
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == '500') <!--$pancard[0]['pancard']['code']-->
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.searchkyc.lite')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}" placeholder="YYYY-MM-DD" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pancard) && $pancard['response']['kycStatus'] == 'SUCCESS')
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Search Kyc Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Full Name:</strong> {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}</p>
                        <p><strong>Mobile Number: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}</p>
                        <p><strong>Email:</strong> {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}</p>
                        <p><strong>Dob: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] }}</p>
                        <p><strong>Masked Aadhaar:</strong> {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar'] }}</p>
                        <p><strong>lastFourDigit: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] }}</p>
                        <p><strong>Type Of Holder:</strong> {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] }}</p>
                        <p><strong>Gender: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] }}</p>
                        <p><strong>Address: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address'] }}</p>
                        <p><strong>City: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city'] }}</p>
                        <p><strong>Country: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country'] }}</p>
                        <p><strong>Pincode: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode'] }}</p>
                        
                        <!-- <p>PAN Verification: @if(isset($pancard[0]['pancard']['message'][0])) $pancard[0]['pancard']['message'][0] @endif</p> -->
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