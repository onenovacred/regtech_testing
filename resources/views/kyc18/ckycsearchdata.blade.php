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
                <h3 class="card-title">CKYC Search</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.ckycsearch_api') }}">CKYCSearch APIs</a>
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
                        <form role="form" method="post" action="{{route('kyc.ckycsearchdata.lite')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}" placeholder="YYYY-MM-DD" required>
                                </div> -->
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pancard) && $pancard['response']['kycStatus'] == 'SUCCESS')
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">cKyc Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p><strong>CKYcid:</strong> {{ $pancard['response']['kycDetails']['ckycId'] }}</p>
                        <p><strong>Full Name:</strong> {{ $pancard['response']['kycDetails']['fullName'] }}</p>
                        <p><strong>kycDate:</strong> {{ $pancard['response']['kycDetails']['kycDate'] }}</p>
                        <p><strong>Age: </strong>{{ $pancard['response']['kycDetails']['age'] }}</p>
                        <p><strong>Father fullname: </strong>{{ $pancard['response']['kycDetails']['fathersFullName'] }}</p>
                        <p>profile_image: <br><img src="data:image/jpeg;base64,{{ $pancard['response']['kycDetails']['photo'] }}" alt="Profile"></p>
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