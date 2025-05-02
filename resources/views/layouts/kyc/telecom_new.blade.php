@extends('adminlte::page')

@section('title', 'Telecom')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Telecom New Details</h3>
                    <a href = "{{ route('kyc.telecom_new_apis') }}" class = "btn btn-light float-right">Telecom New APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($telecom['statusCode']) && $telecom['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            Wrong Phone Number.
                        </div>
                    @endif

                    @if (isset($telecom['statusCode']) && $telecom['statusCode'] == '404')
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($telecom['statusCode']) && $telecom['statusCode'] == '400')
                        <div class="alert alert-danger" role="alert">
                            Wrong Phone Number.
                        </div>
                    @endif
                    @if (isset($telecom['statusCode']) && $telecom['statusCode'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.telecom_new') }}">
                                {{ csrf_field() }}
                                @if (isset($telecomRequest[1]) && $telecomRequest[1] == 'client_ref_num' && empty($telecomRequest[2]))
                                    <div class="form-group">
                                        <label for="name">Client Reference Number</label>
                                        <input type="text" class="form-control" maxlength="5" minlength="5"
                                            id="client_ref_num" name="client_ref_num" value="{{ old('client_ref_num') }}"
                                            placeholder="Ex: sas429" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif (isset($telecomRequest[1]) && $telecomRequest[1] == 'mobile_number' && empty($telecomRequest[2]))
                                    <div class="form-group">
                                        <label for="name">Client Reference Number</label>
                                        <input type="text" class="form-control" maxlength="5" minlength="5"
                                            id="client_ref_num" name="client_ref_num" value="{{ old('client_ref_num') }}"
                                            placeholder="Ex: sas429" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif (
                                    (isset($telecomRequest[1]) && $telecomRequest[1] == 'client_ref_num') ||
                                        (isset($telecomRequest[2]) && $telecomRequest[2] == 'mobile_number'))
                                    <div class="form-group">
                                        <label for="name">Client Reference Number</label>
                                        <input type="text" class="form-control" maxlength="5" minlength="5"
                                            id="client_ref_num" name="client_ref_num" value="{{ old('client_ref_num') }}"
                                            placeholder="Ex: sas429" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif (
                                    (isset($telecomRequest[1]) && $telecomRequest[1] == 'mobile_number') ||
                                        (isset($telecomRequest[2]) && $telecomRequest[2] == 'client_ref_num'))
                                    <div class="form-group">
                                        <label for="name">Client Reference Number</label>
                                        <input type="text" class="form-control" maxlength="5" minlength="5"
                                            id="client_ref_num" name="client_ref_num" value="{{ old('client_ref_num') }}"
                                            placeholder="Ex: sas429" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">Client Reference Number</label>
                                        <input type="text" class="form-control" maxlength="5" minlength="5"
                                            id="client_ref_num" name="client_ref_num"
                                            value="{{ old('client_ref_num') }}" placeholder="Ex: sas429" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif
                            </form><br>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($telecom) && $telecom[0]['telecom_details']['http_response_code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Telecom Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Reference Number:</strong>
                                        {{ $telecom[0]['telecom_details']['client_ref_num'] }}</p>
                                    <p><strong>Request Id:</strong> {{ $telecom[0]['telecom_details']['request_id'] }}</p>
                                    <p><strong>Result Code:</strong> {{ $telecom[0]['telecom_details']['result_code'] }}
                                    </p>
                                    <p><strong>Message:</strong> {{ $telecom[0]['telecom_details']['message'] }}</p>
                                    <p><strong>Is Valid:</strong>{{ $telecom[0]['telecom_details']['result']['is_valid'] }}
                                    </p>
                                    <p><strong>Subscriber Status:</strong>
                                        {{ $telecom[0]['telecom_details']['result']['subscriber_status'] }}</p>
                                    <p><strong>Connection
                                            Type:</strong>{{ $telecom[0]['telecom_details']['result']['connection_type'] }}
                                    </p>
                                    <p><strong>Is
                                            Ported:</strong>{{ $telecom[0]['telecom_details']['result']['is_ported'] }}</p>
                                    <p><strong>Last Ported Date:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['last_ported_date']))
                                            {{ $telecom[0]['telecom_details']['result']['last_ported_date'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Porting History:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['porting_history']))
                                            {{ $telecom[0]['telecom_details']['result']['porting_history'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>Customer Details</b></h5>

                                    <p><strong>Customer
                                            Name:</strong>{{ $telecom[0]['telecom_details']['result']['customer_details']['name'] }}
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>Connection Status</b></h5>

                                    <p><strong>Status
                                            Code:</strong>{{ $telecom[0]['telecom_details']['result']['connection_status']['status_code'] }}
                                    </p>
                                    <p><strong>Error
                                            Code:</strong>{{ $telecom[0]['telecom_details']['result']['connection_status']['error_code_id'] }}
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>msisdn</b></h5>

                                    <p><strong>Country
                                            Code:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['msisdn_country_code'] }}
                                    </p>
                                    <p><strong>MSISDN:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['msisdn'] }}
                                    </p>
                                    <p><strong>Type:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['type'] }}
                                    </p>
                                    <p><strong>MNC:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['mnc'] }}
                                    </p>
                                    <p><strong>IMSI:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['imsi'] }}
                                    </p>
                                    <p><strong>MCC:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['mcc'] }}
                                    </p>
                                    <p><strong>MCC
                                            MNC:</strong>{{ $telecom[0]['telecom_details']['result']['msisdn']['mcc_mnc'] }}
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>Current Service</b></h5>
                                    <p><strong>Network Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['network_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['network_prefix'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['network_name']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['network_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Region:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['network_region']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['network_region'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MNC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['mnc']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['mnc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MCC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['mcc']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['mcc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['country_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['country_prefix'] }}
                                        @else
                                            " "
                                        @endif

                                    </p>
                                    <p><strong>Country Code:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['country_code']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['country_code'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['current_service_provider']['country_name']))
                                            {{ $telecom[0]['telecom_details']['result']['current_service_provider']['country_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>Original Service</b></h5>
                                    <p><strong>Network Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['network_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['network_prefix'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['network_name']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['network_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Region:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['network_region']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['network_region'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MNC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['mnc']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['mnc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MCC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['mcc']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['mcc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['country_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['country_prefix'] }}
                                        @else
                                            " "
                                        @endif

                                    </p>
                                    <p><strong>Country Code:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['country_code']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['country_code'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['original_service_provider']['country_name']))
                                            {{ $telecom[0]['telecom_details']['result']['original_service_provider']['country_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <hr />
                                    <h5 class="text-center text-uppercase text-muted"><b>Roaming Service</b></h5>
                                    <p><strong>Network Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['network_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['network_prefix'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['network_name']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['network_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Network Region:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['network_region']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['network_region'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MNC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['mnc']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['mnc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>MCC:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['mcc']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['mcc'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Prefix:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['country_prefix']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['country_prefix'] }}
                                        @else
                                            " "
                                        @endif

                                    </p>
                                    <p><strong>Country Code:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['country_code']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['country_code'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <p><strong>Country Name:</strong>
                                        @if (!empty($telecom[0]['telecom_details']['result']['roaming_service_provider']['country_name']))
                                            {{ $telecom[0]['telecom_details']['result']['roaming_service_provider']['country_name'] }}
                                        @else
                                            " "
                                        @endif
                                    </p>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($telecom_response) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Telecom Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($telecom_response[0]['telecom_details']['client_ref_num']))
                                        <p><strong>Reference Number:</strong>
                                            {{ $telecom_response[0]['telecom_details']['client_ref_num'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['request_id']))
                                        <p><strong>Request Id:</strong>
                                            {{ $telecom_response[0]['telecom_details']['request_id'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['result_code']))
                                        <p><strong>Result Code:</strong>
                                            {{ $telecom_response[0]['telecom_details']['result_code'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['message']))
                                        <p><strong>Message:</strong>
                                            {{ $telecom_response[0]['telecom_details']['message'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['is_valid']))
                                        <p><strong>Is
                                                Valid:</strong>{{ $telecom_response[0]['telecom_details']['is_valid'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['subscriber_status']))
                                        <p><strong>Subscriber Status:</strong>
                                            {{ $telecom_response[0]['telecom_details']['subscriber_status'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['connection_type']))
                                        <p><strong>Connection
                                                Type:</strong>{{ $telecom_response[0]['telecom_details']['connection_type'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['is_portead']))
                                        <p><strong>Is Ported:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['is_portead']))
                                                {{ $telecom[0]['telecom_details']['is_portead'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($telecom_response[0]['telecom_details']['last_ported_date']))
                                        <p><strong>Last Ported Date:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['last_ported_date']))
                                                {{ $telecom[0]['telecom_details']['last_ported_date'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($telecom_response[0]['telecom_details']['porting_history']))
                                        <p><strong>Porting History:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['porting_history']))
                                                {{ $telecom[0]['telecom_details']['porting_history'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif
                                    <h5 class="text-center text-uppercase text-muted"><b>Customer Details</b></h5>
                                    @if (!empty($telecom_response[0]['telecom_details']['name']))
                                        <p><strong>Customer
                                                Name:</strong>{{ $telecom_response[0]['telecom_details']['name'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($telecom_response[0]['telecom_details']['alternate_number']))
                                        <p><strong>Alternate Number:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['alternate_number']))
                                                {{ $telecom[0]['telecom_details']['alternate_number'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif
                                    <hr />
                                    @if (!empty($telecom_response[0]['telecom_details']['connection_status']))
                                        <h5 class="text-center text-uppercase text-muted"><b>Connection Status</b></h5>
                                        <p><strong>Status
                                                Code:</strong>{{ $telecom_response[0]['telecom_details']['connection_status']['status_code'] }}
                                        </p>
                                        <p><strong>Error Code:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['connection_status']['error_code_id']))
                                                {{ $telecom_response[0]['telecom_details']['connection_status']['error_code_id'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <hr />
                                    @endif

                                    @if (!empty($telecom_response[0]['telecom_details']['msisdn']))
                                          <h5 class="text-center text-uppercase text-muted"><b>msisdn</b></h5>
                                             <p><strong>Country
                                                    Code:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['msisdn_country_code'] }}
                                            </p>
                                       
                                             <p><strong>MSISDN:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['msisdn'] }}
                                            </p>
                                             <p><strong>Type:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['type'] }}
                                            </p>
                                             <p><strong>MNC:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['mnc'] }}
                                            </p>
                                             <p><strong>IMSI:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['imsi'] }}
                                            </p>
                                            <p><strong>MCC:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['mcc'] }}
                                            </p>
                                             <p><strong>MCC
                                                    MNC:</strong>{{ $telecom_response[0]['telecom_details']['msisdn']['mcc_mnc'] }}
                                            </p>
                                        <hr />
                                    @endif
                                  @if(!empty($telecom_response[0]['telecom_details']['current_service_provider']))
                                    <h5 class="text-center text-uppercase text-muted"><b>Current Service</b></h5>
                                   
                                        <p><strong>Network Prefix:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['network_prefix']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['network_prefix'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>Network Name:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['network_name']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['network_name'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>Network Region:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['network_region']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['network_region'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>MNC:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['mnc']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['mnc'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>MCC:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['mcc']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['mcc'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>Country Prefix:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['country_prefix']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['country_prefix'] }}
                                            @else
                                                " "
                                            @endif

                                        </p>
                                        <p><strong>Country Code:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['country_code']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['country_code'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                        <p><strong>Country Name:</strong>
                                            @if (!empty($telecom_response[0]['telecom_details']['current_service_provider']['country_name']))
                                                {{ $telecom_response[0]['telecom_details']['current_service_provider']['country_name'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    <hr />
                                    @endif
                                      @if(!empty($telecom_response[0]['telecom_details']['original_service_provider']))
                                      <h5 class="text-center text-uppercase text-muted"><b>Original Service</b></h5>
                                          <p><strong>Network Prefix:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['network_prefix']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['network_prefix'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>Network Name:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['network_name']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['network_name'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>Network Region:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['network_region']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['network_region'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>MNC:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['mnc']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['mnc'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>MCC:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['mcc']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['mcc'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>Country Prefix:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['country_prefix']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['country_prefix'] }}
                                              @else
                                                  " "
                                              @endif
  
                                          </p>
                                          <p><strong>Country Code:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['country_code']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['country_code'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                          <p><strong>Country Name:</strong>
                                              @if (!empty($telecom_response[0]['telecom_details']['original_service_provider']['country_name']))
                                                  {{ $telecom_response[0]['telecom_details']['original_service_provider']['country_name'] }}
                                              @else
                                                  " "
                                              @endif
                                          </p>
                                      <hr />
                                      @endif
                                       @if(!empty($telecom_response[0]['telecom_details']['roaming_service_provider']))
                                       <h5 class="text-center text-uppercase text-muted"><b>Roaming Service</b></h5>
                                           <p><strong>Network Prefix:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['network_prefix']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['network_prefix'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                           <p><strong>Network Name:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['network_name']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['network_name'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                           <p><strong>Network Region:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['network_region']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['network_region'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                           <p><strong>MNC:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['mnc']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['mnc'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>   
                                           <p><strong>MCC:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['mcc']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['mcc'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                           <p><strong>Country Prefix:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['country_prefix']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['country_prefix'] }}
                                               @else
                                                   " "
                                               @endif
   
                                           </p>
                                           <p><strong>Country Code:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['country_code']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['country_code'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                           <p><strong>Country Name:</strong>
                                               @if (!empty($telecom_response[0]['telecom_details']['roaming_service_provider']['country_name']))
                                                   {{ $telecom_response[0]['telecom_details']['roaming_service_provider']['country_name'] }}
                                               @else
                                                   " "
                                               @endif
                                           </p>
                                       <hr />
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
