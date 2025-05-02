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
                    <a href = "{{ route('kyc.aadhaar_api') }}" role = "button" class = "btn btn-light float-right">Aadhaar
                        APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            OTP Verification has been expired.
                        </div>
                    @endif
                    @if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '404')
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.aadhaar_otp_submit') }}">
                                {{ csrf_field() }}
                                @if (isset($otpsubmitAadharRequest[1]) && $otpsubmitAadharRequest[1] == 'client_id' && empty($otpsubmitAadharRequest[2]))
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 7723458" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @elseif(isset($otpsubmitAadharRequest[1]) &&
                                        $otpsubmitAadharRequest[1] == 'otp_aadhar' &&
                                        empty($otpsubmitAadharRequest[2]))
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 7723458" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @elseif(isset($otpsubmitAadharRequest[2]) && $otpsubmitAadharRequest[2] == 'client_id' && empty($otpsubmitAadharRequest[1]))
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 7723458" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @elseif(isset($otpsubmitAadharRequest[2]) &&
                                        $otpsubmitAadharRequest[2] == 'otp_aadhar' &&
                                        empty($otpsubmitAadharRequest[1]))
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 7723458" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @elseif(
                                    (isset($otpsubmitAadharRequest[2]) && $otpsubmitAadharRequest[2] == 'otp_aadhar') ||
                                        (isset($otpsubmitAadharRequest[1]) && $otpsubmitAadharRequest[1] == 'client_id'))
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 7723458" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">Aadhar OTP Submit</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id"
                                            value="{{ old('client_id') }}"
                                            placeholder="client_id: aadhaar_v2_zBAosdffdaoNmdfhsVC" required> <br>
                                        <input type="text" class="form-control" maxlength="6" minlength="6"
                                            id="otp" name="otp" value="{{ old('otp') }}"
                                            placeholder="Ex: 772345" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Aadhar OTP Submit</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($aadhaar_validation['aadhaar_otp_submit']['data']) &&
                    isset($aadhaar_validation['statusCode']) &&
                    $aadhaar_validation['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Aadhar Card Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p>client_id: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['client_id'] }}
                                    </p>
                                    <p>full_name: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['full_name'] }}
                                    </p>
                                    <p>aadhaar_number:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['aadhaar_number'] }}</p>
                                    <p>dob: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['dob'] }}</p>
                                    <p>gender: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['gender'] }}</p>

                                    <p>country:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['country'] }}
                                    </p>
                                    <p>dist: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['dist'] }}
                                    </p>
                                    <p>state:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['state'] }}</p>
                                    <p>po: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['po'] }}</p>
                                    <p>loc: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['loc'] }}
                                    </p>
                                    <p>vtc: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['vtc'] }}
                                    </p>
                                    <p>subdist:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['subdist'] }}
                                    </p>
                                    <p>street:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['street'] }}</p>
                                    <p>house:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['house'] }}</p>
                                    <p>landmark:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['landmark'] }}
                                    </p>

                                    <p>face_status:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['face_status'] }}</p>
                                    <p>face_score: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['face_score'] }}
                                    </p>
                                    <p>zip: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['zip'] }}</p>
                                    <p>profile_image: <br><img
                                            src="data:image/jpeg;base64,{{ $aadhaar_validation['aadhaar_otp_submit']['data']['profile_image'] }}"
                                            alt="Profile"></p>
                                    <p>has_image: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['has_image'] }}
                                    </p>
                                    <p>raw_xml: <a
                                            href="{{ $aadhaar_validation['aadhaar_otp_submit']['data']['raw_xml'] }}"
                                            class="btn btn-success">Download</a></p>
                                    <p>zip_data: <a
                                            href="{{ $aadhaar_validation['aadhaar_otp_submit']['data']['zip_data'] }}"
                                            class="btn btn-success">Download</a></p>
                                    <p>care_of: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['care_of'] }}</p>
                                    <p>share_code: {{ $aadhaar_validation['aadhaar_otp_submit']['data']['share_code'] }}
                                    </p>
                                    <p>mobile_verified:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['mobile_verified'] }}</p>
                                    <p>reference_id:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['reference_id'] }}</p>
                                    <p>aadhaar_pdf:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['aadhaar_pdf'] }}</p>
                                    <p>status:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['status'] }}</p>
                                    <p>uniqueness_id:
                                        {{ $aadhaar_validation['aadhaar_otp_submit']['data']['uniqueness_id'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($aadhaar_validation_response['aadhaar_otp_submit']['data']) && isset($statusCode) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Aadhar Card Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['client_id']))
                                        <p>client_id:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['client_id'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['full_name']))
                                        <p>full_name:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['full_name'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['aadhaar_number']))
                                        <p>aadhaar_number:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['aadhaar_number'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['dob']))
                                        <p>dob: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['dob'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['gender']))
                                        <p>gender:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['gender'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['country']))
                                        <p>country:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['country'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['dist']))
                                        <p>dist: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['dist'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['state']))
                                        <p>state:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['state'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['po']))
                                        <p>po: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['po'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['loc']))
                                        <p>loc: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['loc'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['vtc']))
                                        <p>vtc: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['vtc'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['subdist']))
                                        <p>subdist:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['subdist'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['street']))
                                        <p>street:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['street'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['house']))
                                        <p>house:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['house'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['landmark']))
                                        <p>landmark:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['landmark'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['face_status']))
                                        <p>face_status:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['face_status'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['zip']))
                                        <p>zip: {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['zip'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['profile_image']))
                                        <p>profile_image: <br><img
                                                src="data:image/jpeg;base64,{{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['profile_image'] }}"
                                                alt="Profile"></p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['has_image']))
                                        <p>has_image:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['has_image'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['raw_xml']))
                                        <p>raw_xml: <a
                                                href="{{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['raw_xml'] }}"
                                                class="btn btn-success">Download</a></p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['zip_data']))
                                        <p>zip_data: <a
                                                href="{{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['zip_data'] }}"
                                                class="btn btn-success">Download</a></p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['care_of']))
                                        <p>care_of:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['care_of'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['share_code']))
                                        <p>share_code:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['share_code'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['mobile_verified']))
                                        <p>mobile_verified:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['mobile_verified'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['reference_id']))
                                        <p>reference_id:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['reference_id'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['aadhaar_pdf']))
                                        <p>aadhaar_pdf:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['aadhaar_pdf'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['status']))
                                        <p>status:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['status'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($aadhaar_validation_response['aadhaar_otp_submit']['data']['uniqueness_id']))
                                        <p>uniqueness_id:
                                            {{ $aadhaar_validation_response['aadhaar_otp_submit']['data']['uniqueness_id'] }}
                                        </p>
                                    @else
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
