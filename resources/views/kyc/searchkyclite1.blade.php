@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">
                                                                        Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Search Kyc LiteV1</h3>
                    <a role="button" class="btn btn-light float-right" href="{{ route('kyc.search_api') }}">Search APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($statusCode) && $statusCode == 401 && isset($searchkyclite_request))
                        <div class="alert alert-danger" role="alert">
                            PAN Number is invalid! Please enter a valid PAN Number
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 401)
                        <div class="alert alert-danger" role="alert">
                            PAN Number is invalid! Please enter a valid PAN Number
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 422 && isset($searchkyclite_request))
                        <div class="alert alert-danger" role="alert">
                            Verification Failed. Please enter correct PAN Number.
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 422)
                        <div class="alert alert-danger" role="alert">
                            Verification Failed. Please enter correct PAN Number.
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 102 && isset($searchkyclite_request))
                        <div class="alert alert-danger" role="alert">
                            In Correct PAN Number. Please enter correct PAN Number
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 102)
                        <div class="alert alert-danger" role="alert">
                            In Correct PAN Number. Please enter correct PAN Number
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 500 && isset($searchkyclite_request))
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error.
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error.
                        </div>
                    </div>
                    @elseif(isset($statusCode) && $statusCode == 103 && isset($searchkyclite_request))
                        <div class="alert alert-danger" role="alert">
                            You are not registered to use this service. Please update your plan.
                        </div>
                    @elseif(isset($statusCode) && $statusCode == 103)
                        <div class="alert alert-danger" role="alert">
                            You are not registered to use this service. Please update your plan.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.searchkyc.lite1') }}">
                                {{ csrf_field() }}
                                @if (isset($searchkyclite_request[1]) && $searchkyclite_request[1] == 'pan_no' && !isset($searchkyclite_request[2]))
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                @elseif(isset($searchkyclite_request[2]) && $searchkyclite_request[2] == 'pan_no' && !isset($searchkyclite_request[2]))
                                    
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                @elseif (isset($searchkyclite_request[1]) && $searchkyclite_request[1] == 'dob' && !isset($searchkyclite_request[2]))
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required />
                                    </div>
                                @elseif (isset($searchkyclite_request[2]) && $searchkyclite_request[2] == 'dob' && !isset($searchkyclite_request[1]))
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required />
                                    </div>
                                    {{-- @endif --}}
                                @elseif (isset($searchkyclite_request[1]) && $searchkyclite_request[1] == 'dob' && $searchkyclite_request[2] == 'pan_no')
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required />
                                    </div>
                                @elseif(isset($searchkyclite_request[2]) && $searchkyclite_request[2] == 'dob' && $searchkyclite_request[1] == 'pan_no')
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required />
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number" name="pan_number" value="{{ old('pan_number') }}"
                                            placeholder="Ex:ABCDE1234N" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD" required />
                                    </div> -->
                                @endif
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($pandetailspermission) && $status_code == 200)

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Search Kyc Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName']))
                                        <p><strong>Full Name:</strong>
                                            {{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum']))
                                        <p><strong>Mobile Number:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email']))
                                        <p><strong>Email:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob']))
                                        <p><strong>DOB:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan']))
                                        <p><strong>Pan Number:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar']
                                        ))
                                        <p><strong>MaskedAadhaar:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit']
                                        ))
                                        <p><strong>LastFourDigit:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder']
                                        ))
                                        <p><strong>TypeOfHolder:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName']))
                                        <p><strong>FirstName:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName']
                                        ))
                                        <p><strong>MiddleName:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName']))
                                        <p><strong>LastName:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address']))
                                        <p><strong>Address:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city']))
                                        <p><strong>City:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['state']))
                                        <p><strong>State:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['state'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country']))
                                        <p><strong>Country:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode']))
                                        <p><strong>Pincode:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender']))
                                        <p><strong>Gender:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] }}
                                        </p>
                                    @endif
                                    @if (!empty($pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['isValid']))
                                        <p><strong>IsValid:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['isValid'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails'][
                                                'aadhaarSeedingStatus'
                                            ]
                                        ))
                                        <p><strong>AadhaarSeedingStatus:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['aadhaarSeedingStatus'] }}
                                        </p>
                                    @endif
                                    @if (
                                        !empty(
                                            $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['serviceCode']
                                        ))
                                        <p><strong>ServiceCode:
                                            </strong>{{ $pandetailspermission['response']['kycDetails']['personalIdentifiableData']['personalDetails']['serviceCode'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($pancard) && $status_code == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Search Kyc Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Full Name:</strong>
                                        {{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}
                                    </p>
                                    <p><strong>Mobile Number:
                                        </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}
                                    </p>
                                    <p><strong>Email:
                                        </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}
                                    </p>
                                    <p><strong>DOB:
                                        </strong>{{ $pancard['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] }}
                                    </p>
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
