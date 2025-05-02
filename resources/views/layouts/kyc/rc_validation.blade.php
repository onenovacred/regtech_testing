@extends('adminlte::page')

@section('title', 'RC Verification')

@section('content_header')
    <style>
        table {
            width: 100%;
        }

        .data-title {
            background-color: grey;
            color: black;
            height: 20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">RC Verification</h3>
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.rc_api') }}">RC APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            Invalid RC Number / RC Number in Multiple RTOs. Error Code - 102
                        </div>
                    @endif
                    @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '101')
                        <div class="alert alert-danger" role="alert">
                            RC Number in Multiple RTOs. Error Code - 101
                        </div>
                    @endif
                    @if (isset($rc_validation['statusCode']) &&
                            ($rc_validation['statusCode'] == '404' ||
                                $rc_validation['statusCode'] == '400' ||
                                $rc_validation['statusCode'] == '401'))
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.rc_validation') }}">
                                {{ csrf_field() }}
                                @if (isset($rcRequest[1]) && $rcRequest[1] == 'rc_number')
                                    <div class="form-group">
                                        <label for="name">RC Number</label>
                                        <input type="text" class="form-control" id="rc_number" name="rc_number"
                                            value="{{ old('rc_number') }}" placeholder="Ex: MH12PQ1234" required>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="name">RC Number</label>
                                        <input type="text" class="form-control" id="rc_number" name="rc_number"
                                            value="{{ old('rc_number') }}" placeholder="Ex: MH12PQ1234" required>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (
        !empty($rc_validation['rc_validation']) &&
            isset($rc_validation['status_code']) &&
            $rc_validation['status_code'] == 200)
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">RC Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <h3>Owner Details</h3>
                                    <hr>
                                    <p><strong>Owner Name:
                                        </strong>{{ $rc_validation['rc_validation']['data']['owner_name'] }}</p>
                                    <p><strong>Permanent Address:</strong>
                                        {{ $rc_validation['rc_validation']['data']['permanent_address'] }}</p>
                                    <p><strong>Mobile No:</strong>
                                        {{ $rc_validation['rc_validation']['data']['mobile_number'] }}</p>
                                    <p><strong>Financer:</strong> {{ $rc_validation['rc_validation']['data']['financer'] }}
                                    </p>

                                    <h3>Vehicle Details</h3>
                                    <hr>
                                    <p><strong>RC Number:</strong>
                                        {{ $rc_validation['rc_validation']['data']['rc_number'] }}</p>
                                    <p><strong>Engine Number:</strong>
                                        {{ $rc_validation['rc_validation']['data']['vehicle_engine_number'] }}</p>
                                    <p><strong>Chassis Number:</strong>
                                        {{ $rc_validation['rc_validation']['data']['vehicle_chasi_number'] }}</p>
                                    <p><strong>Registration Date:</strong>
                                        {{ $rc_validation['rc_validation']['data']['registration_date'] }}</p>
                                    <p><strong>Manufacturing Date:</strong>
                                        {{ $rc_validation['rc_validation']['data']['manufacturing_date'] }}</p>
                                    <p><strong>Registered At:</strong>
                                        {{ $rc_validation['rc_validation']['data']['registered_at'] }}</p>
                                    <p><strong>Maker Model:</strong>
                                        {{ $rc_validation['rc_validation']['data']['maker_model'] }}</p>
                                    <p><strong>Fuel Type:</strong>
                                        {{ $rc_validation['rc_validation']['data']['fuel_type'] }}</p>
                                    <p><strong>Color:</strong> {{ $rc_validation['rc_validation']['data']['color'] }}</p>
                                    <p><strong>Norms Type:</strong>
                                        {{ $rc_validation['rc_validation']['data']['norms_type'] }}</p>
                                    <p><strong>Fit Upto:</strong>
                                        {{ $rc_validation['rc_validation']['data']['fit_up_to'] }}</p>
                                    <p><strong>Tax Upto:</strong> {{ $rc_validation['rc_validation']['data']['tax_upto'] }}
                                    </p>
                                    <h3>Insurance</h3>
                                    <hr>
                                    <p><strong>Insurance Company:</strong>
                                        {{ $rc_validation['rc_validation']['data']['insurance_company'] }}</p>
                                    <p><strong>Policy Number:</strong>
                                        {{ $rc_validation['rc_validation']['data']['insurance_policy_number'] }}</p>
                                    <p><strong>Insurance Upto:</strong>
                                        {{ $rc_validation['rc_validation']['data']['insurance_upto'] }}</p>
                                    <hr>
                                    <p><strong>rc_number:
                                        </strong>{{ $rc_validation['rc_validation']['data']['rc_number'] }}</p>
                                    <p><strong>registration_date:
                                        </strong>{{ $rc_validation['rc_validation']['data']['registration_date'] }}</p>
                                    <p><strong>owner_name:
                                        </strong>{{ $rc_validation['rc_validation']['data']['owner_name'] }}</p>
                                    <p><strong>father_name:
                                        </strong>{{ $rc_validation['rc_validation']['data']['father_name'] }}</p>
                                    <p><strong>present_address:</strong>{{ $rc_validation['rc_validation']['data']['present_address'] }}
                                    </p>
                                    <p><strong>permanent_address:</strong>{{ $rc_validation['rc_validation']['data']['permanent_address'] }}
                                    </p>
                                    <p><strong>mobile_number:</strong>{{ $rc_validation['rc_validation']['data']['mobile_number'] }}
                                    </p>
                                    <p><strong>vehicle_category:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_category'] }}
                                    </p>
                                    <p><strong>vehicle_chasi_number:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_chasi_number'] }}
                                    </p>
                                    <p><strong>vehicle_engine_number:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_engine_number'] }}
                                    </p>
                                    <p><strong>maker_description:</strong>{{ $rc_validation['rc_validation']['data']['maker_description'] }}
                                    </p>
                                    <p><strong>maker_model:</strong>{{ $rc_validation['rc_validation']['data']['maker_model'] }}
                                    </p>
                                    <p><strong>body_type:</strong>{{ $rc_validation['rc_validation']['data']['body_type'] }}
                                    </p>
                                    <p><strong>fuel_type:</strong>{{ $rc_validation['rc_validation']['data']['fuel_type'] }}
                                    </p>
                                    <p><strong>color:</strong>{{ $rc_validation['rc_validation']['data']['color'] }}</p>
                                    <p><strong>norms_type:</strong>{{ $rc_validation['rc_validation']['data']['norms_type'] }}
                                    </p>
                                    <p><strong>fit_up_to:</strong>{{ $rc_validation['rc_validation']['data']['fit_up_to'] }}
                                    </p>
                                    <p><strong>financer:</strong>{{ $rc_validation['rc_validation']['data']['financer'] }}
                                    </p>
                                    <p><strong>insurance_company:</strong>{{ $rc_validation['rc_validation']['data']['insurance_company'] }}
                                    </p>
                                    <p><strong>insurance_policy_number:</strong>{{ $rc_validation['rc_validation']['data']['insurance_policy_number'] }}
                                    </p>
                                    <p><strong>insurance_upto:</strong>{{ $rc_validation['rc_validation']['data']['insurance_upto'] }}
                                    </p>
                                    <p><strong>manufacturing_date:</strong>{{ $rc_validation['rc_validation']['data']['manufacturing_date'] }}
                                    </p>
                                    <p><strong>registered_at:</strong>{{ $rc_validation['rc_validation']['data']['registered_at'] }}
                                    </p>
                                    <p><strong>latest_by:</strong>{{ $rc_validation['rc_validation']['data']['latest_by'] }}
                                    </p>
                                    <p><strong>tax_upto:</strong>{{ $rc_validation['rc_validation']['data']['tax_upto'] }}
                                    </p>
                                    <p><strong>cubic_capacity:</strong>{{ $rc_validation['rc_validation']['data']['cubic_capacity'] }}
                                    </p>
                                    <p><strong>vehicle_gross_weight:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_gross_weight'] }}
                                    </p>
                                    <p><strong>no_cylinders:</strong>{{ $rc_validation['rc_validation']['data']['no_cylinders'] }}
                                    </p>
                                    <p><strong>seat_capacity:</strong>{{ $rc_validation['rc_validation']['data']['seat_capacity'] }}
                                    </p>
                                    <p><strong>sleeper_capacity:</strong>{{ $rc_validation['rc_validation']['data']['sleeper_capacity'] }}
                                    </p>
                                    <p><strong>standing_capacity:</strong>{{ $rc_validation['rc_validation']['data']['standing_capacity'] }}
                                    </p>
                                    <p><strong>wheelbase:</strong>{{ $rc_validation['rc_validation']['data']['wheelbase'] }}
                                    </p>
                                    <p><strong>unladen_weight:</strong>{{ $rc_validation['rc_validation']['data']['unladen_weight'] }}
                                    </p>
                                    <p><strong>vehicle_category_description:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_category_description'] }}
                                    </p>
                                    <p><strong>pucc_number:</strong>{{ $rc_validation['rc_validation']['data']['pucc_number'] }}
                                    </p>
                                    <p><strong>pucc_upto:</strong>{{ $rc_validation['rc_validation']['data']['pucc_upto'] }}
                                    </p>
                                    <p><strong>permit_number:</strong>{{ $rc_validation['rc_validation']['data']['permit_number'] }}
                                    </p>
                                    <p><strong>permit_issue_date:</strong>{{ $rc_validation['rc_validation']['data']['permit_issue_date'] }}
                                    </p>
                                    <p><strong>permit_valid_from:</strong>{{ $rc_validation['rc_validation']['data']['permit_valid_from'] }}
                                    </p>
                                    <p><strong>permit_valid_upto:</strong>{{ $rc_validation['rc_validation']['data']['permit_valid_upto'] }}
                                    </p>
                                    <p><strong>permit_type:</strong>{{ $rc_validation['rc_validation']['data']['permit_type'] }}
                                    </p>
                                    <p><strong>national_permit_number:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_number'] }}
                                    </p>
                                    <p><strong>national_permit_upto:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_upto'] }}
                                    </p>
                                    <p><strong>national_permit_issued_by:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_issued_by'] }}
                                    </p>
                                    <p><strong>non_use_status:</strong>{{ $rc_validation['rc_validation']['data']['non_use_status'] }}
                                    </p>
                                    <p><strong>non_use_from:</strong>{{ $rc_validation['rc_validation']['data']['non_use_from'] }}
                                    </p>
                                    <p><strong>non_use_to:</strong>{{ $rc_validation['rc_validation']['data']['non_use_to'] }}
                                    </p>
                                    <p><strong>blacklist_status:</strong>{{ $rc_validation['rc_validation']['data']['blacklist_status'] }}
                                    </p>
                                    <p><strong>noc_details:</strong>{{ $rc_validation['rc_validation']['data']['noc_details'] }}
                                    </p>
                                    <p><strong>owner_number:</strong>{{ $rc_validation['rc_validation']['data']['owner_number'] }}
                                    </p>
                                    <p><strong>rc_status:
                                        </strong>{{ $rc_validation['rc_validation']['data']['rc_status'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--RC SELECTED RESPONSE -->
    @if (!empty($rc_validation_response) && $rc_validation_response != null)
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">RC Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <h3>Owner Details</h3>
                                    <hr>
                                    @if (!empty($rc_validation_response['rc_validation']['data']['owner_name']))
                                        <p><strong>Owner Name:
                                            </strong>{{ $rc_validation_response['rc_validation']['data']['owner_name'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['permanent_address']))
                                        <p><strong>Permanent Address:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['permanent_address'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['mobile_number']))
                                        <p><strong>Mobile No:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['mobile_number'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['financer']))
                                        <p><strong>Financer:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['financer'] }}</p>
                                    @endif
                                    <h3>Vehicle Details</h3>
                                    <hr>
                                    @if (!empty($rc_validation_response['rc_validation']['data']['rc_number']))
                                        <p><strong>RC Number:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['rc_number'] }}</p>
                                    @endif

                                    @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_engine_number']))
                                        <p><strong>Engine Number:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['vehicle_engine_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_chasi_number']))
                                        <p><strong>Chassis Number:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['vehicle_chasi_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['registration_date']))
                                        <p><strong>Registration Date:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['registration_date'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['manufacturing_date']))
                                        <p><strong>Manufacturing Date:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['manufacturing_date'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['registered_at']))
                                        <p><strong>Registered At:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['registered_at'] }}</p>
                                    @endif

                                    @if (!empty($rc_validation_response['rc_validation']['data']['maker_model']))
                                        <p><strong>Maker Model:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['maker_model'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['fuel_type']))
                                        <p><strong>Fuel Type:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['fuel_type'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['color']))
                                        <p><strong>Color:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['color'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['norms_type']))
                                        <p><strong>Norms Type:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['norms_type'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['fit_up_to']))
                                        <p><strong>Fit Upto:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['fit_up_to'] }}</p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['tax_upto']))
                                        <p><strong>Tax Upto:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['tax_upto'] }}</p>
                                    @endif

                                    <h3>Insurance</h3>
                                    <hr>
                                    @if (!empty($rc_validation_response['rc_validation']['data']['insurance_company']))
                                        <p><strong>Insurance Company:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['insurance_company'] }}</p>
                                    @endif

                                    @if (!empty($rc_validation_response['rc_validation']['data']['insurance_policy_number']))
                                        <p><strong>Policy Number:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['insurance_policy_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['insurance_upto']))
                                        <p><strong>Insurance Upto:</strong>
                                            {{ $rc_validation_response['rc_validation']['data']['insurance_upto'] }}</p>
                                    @endif
                                    <hr>
                                    @if (!empty($rc_validation_response['rc_validation']['data']['rc_number']))
                                        <p><strong>rc_number:
                                            </strong>{{ $rc_validation_response['rc_validation']['data']['rc_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['registration_date']))
                                        <p><strong>registration_date:
                                            </strong>{{ $rc_validation_response['rc_validation']['data']['registration_date'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['owner_name']))
                                        <p><strong>owner_name:
                                            </strong>{{ $rc_validation_response['rc_validation']['data']['owner_name'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['father_name']))
                                        <p><strong>father_name:
                                            </strong>{{ $rc_validation_response['rc_validation']['data']['father_name'] }}
                                        </p>
                                    @endif

                                    @if (!empty($rc_validation_response['rc_validation']['data']['present_address']))
                                        <p><strong>present_address:</strong>{{ $rc_validation_response['rc_validation']['data']['present_address'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['permanent_address']))
                                        <p><strong>permanent_address:</strong>{{ $rc_validation_response['rc_validation']['data']['permanent_address'] }}
                                        </p>
                                    @endif

                                    @if (!empty($rc_validation_response['rc_validation']['data']['mobile_number']))
                                        <p><strong>mobile_number:</strong>{{ $rc_validation_response['rc_validation']['data']['mobile_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_category']))
                                        <p><strong>vehicle_category:</strong>{{ $rc_validation_response['rc_validation']['data']['vehicle_category'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_chasi_number']))
                                        <p><strong>vehicle_chasi_number:</strong>{{ $rc_validation_response['rc_validation']['data']['vehicle_chasi_number'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_engine_number']))
                                    <p><strong>vehicle_engine_number:</strong>{{ $rc_validation_response['rc_validation']['data']['vehicle_engine_number'] }}
                                    </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['maker_description']))
                                    <p><strong>maker_description:</strong>{{ $rc_validation_response['rc_validation']['data']['maker_description'] }}
                                    </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['maker_model']))
                                        <p><strong>maker_model:</strong>{{ $rc_validation_response['rc_validation']['data']['maker_model'] }}
                                        </p>
                                    @endif
                                    @if (!empty($rc_validation_response['rc_validation']['data']['body_type']))
                                    <p><strong>body_type:</strong>{{ $rc_validation_response['rc_validation']['data']['body_type'] }}
                                    </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['fuel_type']))
                                   <p><strong>fuel_type:</strong>{{ $rc_validation_response['rc_validation']['data']['fuel_type'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['color']))
                                   <p><strong>color:</strong>{{ $rc_validation_response['rc_validation']['data']['color'] }}
                                   </p>
                                   @endif  
                                   @if (!empty($rc_validation_response['rc_validation']['data']['norms_type']))
                                   <p><strong>norms_type:</strong>{{ $rc_validation_response['rc_validation']['data']['norms_type'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['fit_up_to']))
                                   <p><strong>fit_up_to:</strong>{{ $rc_validation_response['rc_validation']['data']['fit_up_to'] }}
                                   </p>
                                   @endif  
                                   @if (!empty($rc_validation_response['rc_validation']['data']['financer']))
                                   <p><strong>financer:</strong>{{ $rc_validation_response['rc_validation']['data']['financer'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['insurance_company']))
                                   <p><strong>insurance_company:</strong>{{ $rc_validation_response['rc_validation']['data']['insurance_company'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['insurance_policy_number']))
                                   <p><strong>insurance_policy_number:</strong>{{ $rc_validation_response['rc_validation']['data']['insurance_policy_number'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['manufacturing_date']))
                                   <p><strong>manufacturing_date:</strong>{{ $rc_validation_response['rc_validation']['data']['manufacturing_date'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['registered_at']))
                                   <p><strong>registered_at:</strong>{{ $rc_validation_response['rc_validation']['data']['registered_at'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['latest_by']))
                                   <p><strong>latest_by:</strong>{{ $rc_validation_response['rc_validation']['data']['latest_by'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['tax_upto']))
                                   <p><strong>tax_upto:</strong>{{ $rc_validation_response['rc_validation']['data']['tax_upto'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['cubic_capacity']))
                                   <p><strong>cubic_capacity:</strong>{{ $rc_validation_response['rc_validation']['data']['cubic_capacity'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_gross_weight']))
                                   <p><strong>vehicle_gross_weight:</strong>{{ $rc_validation_response['rc_validation']['data']['vehicle_gross_weight'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['no_cylinders']))
                                   <p><strong>no_cylinders:</strong>{{ $rc_validation_response['rc_validation']['data']['no_cylinders'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['seat_capacity']))
                                   <p><strong>seat_capacity:</strong>{{ $rc_validation_response['rc_validation']['data']['seat_capacity'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['sleeper_capacity']))
                                   <p><strong>sleeper_capacity:</strong>{{ $rc_validation_response['rc_validation']['data']['sleeper_capacity'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['standing_capacity']))
                                   <p><strong>standing_capacity:</strong>{{ $rc_validation_response['rc_validation']['data']['standing_capacity'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['wheelbase']))
                                   <p><strong>wheelbase:</strong>{{ $rc_validation_response['rc_validation']['data']['wheelbase'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['unladen_weight']))
                                   <p><strong>unladen_weight:</strong>{{ $rc_validation_response['rc_validation']['data']['unladen_weight'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['vehicle_category_description']))
                                   <p><strong>vehicle_category_description:</strong>{{ $rc_validation_response['rc_validation']['data']['vehicle_category_description'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['pucc_number']))
                                   <p><strong>pucc_number:</strong>{{ $rc_validation_response['rc_validation']['data']['pucc_number'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['pucc_upto']))
                                   <p><strong>pucc_upto:</strong>{{ $rc_validation_response['rc_validation']['data']['pucc_upto'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['permit_number']))
                                   <p><strong>permit_number:</strong>{{ $rc_validation_response['rc_validation']['data']['permit_number'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['permit_issue_date']))
                                   <p><strong>permit_issue_date:</strong>{{ $rc_validation_response['rc_validation']['data']['permit_issue_date'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['permit_valid_from']))
                                   <p><strong>permit_valid_from:</strong>{{ $rc_validation_response['rc_validation']['data']['permit_valid_from'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['permit_valid_upto']))
                                   <p><strong>permit_valid_upto:</strong>{{ $rc_validation_response['rc_validation']['data']['permit_valid_upto'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['permit_type']))
                                   <p><strong>permit_type:</strong>{{ $rc_validation_response['rc_validation']['data']['permit_type'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['national_permit_number']))
                                   <p><strong>national_permit_number:</strong>{{ $rc_validation_response['rc_validation']['data']['national_permit_number'] }}
                                   </p>
                                   @endif
                                   
                                   @if (!empty($rc_validation_response['rc_validation']['data']['national_permit_upto']))
                                   <p><strong>national_permit_upto:</strong>{{ $rc_validation_response['rc_validation']['data']['national_permit_upto'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['national_permit_issued_by']))
                                   <p><strong>national_permit_issued_by:</strong>{{ $rc_validation_response['rc_validation']['data']['national_permit_issued_by'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['non_use_status']))
                                   <p><strong>non_use_status:</strong>{{ $rc_validation_response['rc_validation']['data']['non_use_status'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['non_use_from']))
                                   <p><strong>non_use_from:</strong>{{ $rc_validation_response['rc_validation']['data']['non_use_from'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['non_use_to']))
                                   <p><strong>non_use_to:</strong>{{ $rc_validation_response['rc_validation']['data']['non_use_to'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['blacklist_status']))
                                   <p><strong>blacklist_status:</strong>{{ $rc_validation_response['rc_validation']['data']['blacklist_status'] }}
                                   </p>
                                   @endif
                                    
                                   @if (!empty($rc_validation_response['rc_validation']['data']['noc_details']))
                                   <p><strong>noc_details:</strong>{{ $rc_validation_response['rc_validation']['data']['noc_details'] }}
                                   </p>
                                   @endif
                                   @if (!empty($rc_validation_response['rc_validation']['data']['owner_number']))
                                   <p><strong>owner_number:</strong>{{ $rc_validation_response['rc_validation']['data']['owner_number'] }}
                                   </p>
                                   @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop


@section('custom_js')
@stop
