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
                <h3 class="card-title">Ckyc Download</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.ckycdownload_api') }}">ckycDownload APIs</a>
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
                        <form role="form" method="post" action="{{route('kyc.ckycdownload.lite')}}">
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
                                <div class="form-group">
                                    <label for="name">Ckyc Id</label>
                                    <input type="text" class="form-control" id="ckycid" name="ckycid" value="{{old('ckycid')}}" placeholder="ckycid" required>
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
                <h3 class="card-title">Search Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Full Name:</strong> {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}</p>
                        <p><strong>Mobile Number: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}</p>
                        <p><strong>Email: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}</p>
                        <p><strong>Current Address: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine1'] }}</br>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine2'] }}</p>
                        <p><strong>Current City: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCity'] }}</p>
                        <p><strong>Current Dist: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresDist'] }}</p>
                        <p><strong>Current Pincode: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPin'] }}</p>
                        <p><strong>Permanent Address: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine1'] }}</br>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine2'] }}</p>
                        <p><strong>Permanent Dist: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permDist'] }}</p>
                        <p><strong>Permanent City: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCity'] }}</p>
                        <p><strong>Permanent Pincode: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPin'] }}</p>
                        <p><strong>Number Of Identity: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numIdentity'] }}</p>
                        <p><strong>Number Of Related: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numRelated'] }}</p>
                        <p><strong>Number Of Images: </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numImages'] }}</p>
                        <p>profile_image: <br><img src="data:image/jpeg;base64,{{ $pancard['response']['kycDetails']['personalIdentifiableData']['imageDetails']['image'][0]['imageData'] }}" alt="Profile"></p>
                        <p>Proof: <br><img src="data:image/jpeg;base64,{{ $pancard['response']['kycDetails']['personalIdentifiableData']['imageDetails']['image'][2]['imageData'] }}" alt="Profile"></p>
                      </div>
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