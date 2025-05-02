@extends('adminlte::page')

@section('title', 'License Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">License Verification</h3>
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.license_api') }}">DL APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            License Number is Invalid
                        </div>
                    @endif
                    @if (isset($license_validation['statusCode']) && ($license_validation['statusCode'] == '404' || null))
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($license_validation[0]['statusCode']) && $license_validation[0]['statusCode'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Lincense Number is Wrong.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.license_validation') }}">
                                {{ csrf_field() }}
                                @if (isset($licenseRequest[1]) && $licenseRequest[1] == 'license_number' && !isset($licenseRequest[2]))
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number"
                                            value="{{ old('license_number') }}" placeholder="Ex: MH121020152012" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif(isset($licenseRequest[2]) && $licenseRequest[2] == 'dob')
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number"
                                            value="{{ old('license_number') }}" placeholder="Ex: MH121020152012" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif(isset($licenseRequest[1]) && $licenseRequest[1] == 'dob' && !isset($licenseRequest[2]))
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number"
                                            value="{{ old('license_number') }}" placeholder="Ex: MH121020152012" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif(isset($licenseRequest[2]) && $licenseRequest[2] == 'license_number')
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number"
                                            value="{{ old('license_number') }}" placeholder="Ex: MH121020152012" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number"
                                            name="license_number" value="{{ old('license_number') }}"
                                            placeholder="Ex: MH121020152012" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (
                !empty($license_validation[0]['license_validation']) &&
                    isset($license_validation[0]['statusCode']) &&
                    ($license_validation[0]['statusCode'] = 200))
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">License Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p>License Number:
                                        {{ $license_validation[0]['license_validation']['data']['license_number'] }}</p>
                                    <p>Name: {{ $license_validation[0]['license_validation']['data']['name'] }}</p>
                                    <p>Father / Husband Name:
                                        {{ $license_validation[0]['license_validation']['data']['father_or_husband_name'] }}
                                    </p>
                                    <p>DOB: {{ $license_validation[0]['license_validation']['data']['dob'] }}</p>
                                    <p>Permanent Address:
                                        {{ $license_validation[0]['license_validation']['data']['permanent_address'] }}
                                    </p>
                                    <p>Permanent ZIP:
                                        {{ $license_validation[0]['license_validation']['data']['permanent_zip'] }}
                                    </p>
                                    <p>State:
                                        {{ $license_validation[0]['license_validation']['data']['state'] }}
                                    </p>
                                    <p>District:
                                        {{ $license_validation[0]['license_validation']['data']['district'] }}
                                    </p>
                                    <p>Image: <br><img
                                            src="{{ $license_validation[0]['license_validation']['data']['profile_image'] }}"
                                            alt="Profile"></p>
                                    {{-- <p>License Verification: {{ $license_validation[0]['statusCode'] }}</p> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (
                !empty($license_validation_response['license_validation']) &&
                    $license_validation_response['license_validation'] != null)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">License Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($license_validation_response['license_validation']['data']['license_number']))
                                        <p>License Number:
                                            {{ $license_validation_response['license_validation']['data']['license_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['dob']))
                                        <p>DOB: {{ $license_validation_response['license_validation']['data']['dob'] }}</p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['name']))
                                        <p>Name: {{ $license_validation_response['license_validation']['data']['name'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['father_or_husband_name']))
                                        <p>Father / Husband Name:
                                            {{ $license_validation_response['license_validation']['data']['father_or_husband_name'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['blood_group']))
                                        <p>Blood Group:
                                            {{ $license_validation_response['license_validation']['data']['blood_group'] }}
                                        </p>
                                    @endif
                                     @if (!empty($license_validation_response['license_validation']['data']['permanent_address']))
                                        <p>Permanent Address:
                                            {{ $license_validation_response['license_validation']['data']['permanent_address'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['state']))
                                        <p>State:
                                            {{ $license_validation_response['license_validation']['data']['state'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['district']))
                                        <p>District:
                                            {{ $license_validation_response['license_validation']['data']['district'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['permanent_zip']))
                                        <p>Permanent ZIP:
                                            {{ $license_validation_response['license_validation']['data']['permanent_zip'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['country']))
                                        <p>Country :
                                            {{ $license_validation_response['license_validation']['data']['country'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['type']))
                                        <p>Type :
                                            {{ $license_validation_response['license_validation']['data']['type'] }}
                                        </p>
                                    @endif

                                    @if (!empty($license_validation_response['license_validation']['data']['non_transport_doi']))
                                        <p>Non Transport DOI :
                                            {{ $license_validation_response['license_validation']['data']['non_transport_doi'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['non_transport_doe']))
                                        <p>Non Transport DOE :
                                            {{ $license_validation_response['license_validation']['data']['non_transport_doe'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['transport_doi']))
                                        <p>Transport DOI :
                                            {{ $license_validation_response['license_validation']['data']['transport_doi'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['transport_doe']))
                                        <p>Transport DOE :
                                            {{ $license_validation_response['license_validation']['data']['transport_doe'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['ola_code']))
                                        <p>OLA Code :
                                            {{ $license_validation_response['license_validation']['data']['ola_code'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['cov']))
                                        <p>Cov:
                                            {{ $license_validation_response['license_validation']['data']['cov'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['issue_date']))
                                        <p>Issue Date:
                                            {{ $license_validation_response['license_validation']['data']['issue_date'] }}
                                        </p>
                                    @endif
                                    @if (!empty($license_validation_response['license_validation']['data']['profile_image']))
                                    <p>Image: <br><img
                                            src="{{ $license_validation_response['license_validation']['data']['profile_image'] }}"
                                            alt="Profile">
                                    </p>
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
