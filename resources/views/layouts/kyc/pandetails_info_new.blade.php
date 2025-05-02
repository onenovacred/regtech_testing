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
                    <h3 class="card-title">PAN CARD DETAILS.</h3>
                    <a role="button" class="btn btn-light float-right" href="{{ route('kyc.pancard_info_api') }}">Pan Card
                        APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($pancard['statusCode']) && $pancard['statusCode']==102 && $pancard['message'] == 'No Records found!.')
                        <div class="alert alert-danger" role="alert">
                            Record Not Found !
                        </div>
                    @endif
                    @if (isset($pancard['statusCode']) && $pancard['statusCode']==102 && $pancard['message'] =='PAN Number InValid Please Enter Correct PanNumber.')
                        <div class="alert alert-danger" role="alert">
                            PAN Number InValid Please Enter Correct PanNumber.
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($pancardError['statusCode']) && $pancardError['statusCode']==102)
                    <div class="alert alert-danger" role="alert">
                        PAN Number InValid Please Enter Correct PanNumber.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.pancard.new_info') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" id="pan_number"
                                        name="pan_number" value="{{ old('pan_number') }}" placeholder="Ex: ABCDE1234N"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($pandetailsinfo) && $pandetailsinfo != null)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">PAN CARD Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div>
                            <p><strong>Client Id:</strong>null</p>
                             @if(!empty($pandetailsinfo['data']["transactionId"]) != null)
                             <p><strong>Transaction Id: </strong>{{ $pandetailsinfo['data']["transactionId"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["panNumber"]) != null)
                             <p><strong>Pan Number : </strong>{{ $pandetailsinfo['data']["panNumber"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["maskedAadhar"]) != null)
                             <p><strong>MaskedAadhar : </strong>{{ $pandetailsinfo['data']["maskedAadhar"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["lastFourDigitAadhar"]) != null)
                             <p><strong>LastFourDigitAadhar : </strong>{{ $pandetailsinfo['data']["lastFourDigitAadhar"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["typeOfHolder"]) != null)
                             <p><strong>TypeOfHolder: </strong>{{ $pandetailsinfo['data']["typeOfHolder"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["name"]) != null)
                             <p><strong>Full Name: </strong>{{ $pandetailsinfo['data']["name"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["firstName"]) != null)
                             <p><strong>FirstName  </strong>{{ $pandetailsinfo['data']["firstName"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["name"]) != null)
                             <p><strong>Full Name: </strong>{{ $pandetailsinfo['data']["name"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["firstName"]) != null)
                             <p><strong>FirstName  </strong>{{ $pandetailsinfo['data']["firstName"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["middleName"]) != null)
                             <p><strong>Middle Name: </strong>{{ $pandetailsinfo['data']["middleName"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["lastName"]) != null)
                             <p><strong>Last Name:  </strong>{{ $pandetailsinfo['data']["lastName"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["gender"]) != null)
                             <p><strong>Gender:  </strong>{{ $pandetailsinfo['data']["gender"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["dob"]) != null)
                             <p><strong>DOB: </strong>{{ $pandetailsinfo['data']["dob"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["address"]) != null)
                             <p><strong>Address:  </strong>{{ $pandetailsinfo['data']["address"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["city"]) != null)
                             <p><strong>City:  </strong>{{ $pandetailsinfo['data']["city"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["state"]) != null)
                             <p><strong>State:  </strong>{{ $pandetailsinfo['data']["state"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["country"]) != null)
                             <p><strong>Country:  </strong>{{ $pandetailsinfo['data']["country"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["pincode"]) != null)
                             <p><strong>Pincode:  </strong>{{ $pandetailsinfo['data']["pincode"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["mobile_no"]) != null)
                             <p><strong>Mobile Number:  </strong>{{ $pandetailsinfo['data']["mobile_no"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["pincode"]) != null)
                             <p><strong>Pincode:  </strong>{{ $pandetailsinfo['data']["pincode"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["mobile_no"]) != null)
                             <p><strong>Mobile Number:  </strong>{{ $pandetailsinfo['data']["mobile_no"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["email"]) != null)
                             <p><strong>Email:  </strong>{{ $pandetailsinfo['data']["email"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["isValid"]) != null)
                             <p><strong>Is Valid:  </strong>{{ $pandetailsinfo['data']["isValid"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["email"]) != null)
                             <p><strong>Email:  </strong>{{ $pandetailsinfo['data']["email"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["aadhaarSeedingStatus"]) != null)
                             <p><strong>AadhaarSeedingStatus:  </strong>{{ $pandetailsinfo['data']["aadhaarSeedingStatus"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["serviceCode"]) != null)
                             <p><strong>ServiceCode:  </strong>{{ $pandetailsinfo['data']["serviceCode"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["aadhaarSeedingStatus"]) != null)
                             <p><strong>AadhaarSeedingStatus:  </strong>{{ $pandetailsinfo['data']["aadhaarSeedingStatus"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["status_code"]) != null)
                             <p><strong>Status Code:  </strong>{{ $pandetailsinfo['data']["status_code"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["success"]) != null)
                             <p><strong>Success:  </strong>{{ $pandetailsinfo['data']["success"] }}</p>
                             @endif
                             @if(!empty($pandetailsinfo['data']["message_code"]) != null)
                             <p><strong>Message Code:  </strong>{{ $pandetailsinfo['data']["message_code"] }}</p>
                             @endif
            
                          </div> 
                        </div>
                    </div>
                </div>
            </div>
            @endif
        
        @if (!empty($pancard) && isset($pancard['pancard']['data']) && $statusCode== 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Client Id:</strong>null</p>
                        <p><strong>Transaction Id: </strong>{{$pancard['pancard']['data']["transactionId"] }}</p>
                        <p><strong>Pan Number: </strong>{{$pancard['pancard']['data']['panNumber'] }}</p>
                        <p><strong>Masked Aadhar: </strong>{{$pancard['pancard']['data']['maskedAadhar'] }}</p>
                        <p><strong>LastFourDigitAadhar: </strong>{{$pancard['pancard']['data']['lastFourDigitAadhar'] }}</p>
                        <p><strong>TypeOfHolder:</strong> {{$pancard['pancard']['data']['typeOfHolder'] }}</p>
                        <p><strong>Full Name: </strong>{{$pancard['pancard']['data'][ "name"] }}</p>
                        <p><strong>FirstName: </strong>{{$pancard['pancard']['data']['firstName'] }}</p>
                        <p><strong>MiddleName: </strong>{{$pancard['pancard']['data']['middleName'] }}</p>
                        <p><strong>LastName: </strong>{{$pancard['pancard']['data']['lastName'] }}</p>
                        <p><strong>Gender:</strong>{{$pancard['pancard']['data']['gender'] }}</p>
                        <p><strong>Date Of Birthday: </strong>{{$pancard['pancard']['data']['dob'] }}</p>
                        <p><strong>Address: </strong>{{$pancard['pancard']['data']['address'] }}</p>
                        <p><strong>City: </strong>{{$pancard['pancard']['data']['city'] }}</p>
                        <p><strong>State: </strong>{{$pancard['pancard']['data']['state'] }}</p>
                        <p><strong>Country: </strong>{{$pancard['pancard']['data']['country'] }}</p>
                        <p><strong>Pincode: </strong>{{$pancard['pancard']['data']['pincode'] }}</p>
                        <p><strong>Mobile Number: </strong>{{$pancard['pancard']['data']['mobile_no'] }}</p>
                        <p><strong>Email: </strong>{{$pancard['pancard']['data']['email'] }}</p>
                        <p><strong>IsValid: </strong>{{$pancard['pancard']['data']['isValid'] }}</p>
                        <p><strong>AadhaarSeedingStatus: </strong>{{$pancard['pancard']['data']['aadhaarSeedingStatus'] }}</p>
                        <p><strong>ServiceCode: </strong>{{$pancard['pancard']['data']['serviceCode'] }}</p>
                        <p><strong>Status Code: </strong>{{$pancard['status_code'] }}</p>
                        <p><strong>Success: </strong>{{$pancard['success'] }}</p>
                        <p><strong>Message Code: </strong>{{$pancard['message_code'] }}</p>
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
