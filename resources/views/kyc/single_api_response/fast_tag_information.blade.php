@if (
    !empty($fast_tag_information['rc_validation']) &&
        isset($fast_tag_information['status_code']) &&
        $fast_tag_information['status_code'] == 200)
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
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['owner_name'] }}</p>
                                <p><strong>Permanent Address:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['permanent_address'] }}</p>
                                <p><strong>Mobile No:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['mobile_number'] }}</p>
                                <p><strong>Financer:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['financer'] }}
                                </p>

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>Engine Number:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['vehicle_engine_number'] }}</p>
                                <p><strong>Chassis Number:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['vehicle_chasi_number'] }}</p>
                                <p><strong>Registration Date:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>Manufacturing Date:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['manufacturing_date'] }}</p>
                                <p><strong>Registered At:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['registered_at'] }}</p>
                                <p><strong>Maker Model:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['maker_model'] }}</p>
                                <p><strong>Fuel Type:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['fuel_type'] }}</p>
                                <p><strong>Color:</strong> {{ $fast_tag_information['rc_validation']['data']['color'] }}</p>
                                <p><strong>Norms Type:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['norms_type'] }}</p>
                                <p><strong>Fit Upto:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['fit_up_to'] }}</p>
                                <p><strong>Tax Upto:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['tax_upto'] }}
                                </p>
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Company:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['insurance_company'] }}</p>
                                <p><strong>Policy Number:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['insurance_policy_number'] }}</p>
                                <p><strong>Insurance Upto:</strong>
                                    {{ $fast_tag_information['rc_validation']['data']['insurance_upto'] }}</p>
                                <hr>
                                <p><strong>rc_number:
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>registration_date:
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>owner_name:
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['owner_name'] }}</p>
                                <p><strong>father_name:
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['father_name'] }}</p>
                                <p><strong>present_address:</strong>{{ $fast_tag_information['rc_validation']['data']['present_address'] }}
                                </p>
                                <p><strong>permanent_address:</strong>{{ $fast_tag_information['rc_validation']['data']['permanent_address'] }}
                                </p>
                                <p><strong>mobile_number:</strong>{{ $fast_tag_information['rc_validation']['data']['mobile_number'] }}
                                </p>
                                <p><strong>vehicle_category:</strong>{{ $fast_tag_information['rc_validation']['data']['vehicle_category'] }}
                                </p>
                                <p><strong>vehicle_chasi_number:</strong>{{ $fast_tag_information['rc_validation']['data']['vehicle_chasi_number'] }}
                                </p>
                                <p><strong>vehicle_engine_number:</strong>{{ $fast_tag_information['rc_validation']['data']['vehicle_engine_number'] }}
                                </p>
                                <p><strong>maker_description:</strong>{{ $fast_tag_information['rc_validation']['data']['maker_description'] }}
                                </p>
                                <p><strong>maker_model:</strong>{{ $fast_tag_information['rc_validation']['data']['maker_model'] }}
                                </p>
                                <p><strong>body_type:</strong>{{ $fast_tag_information['rc_validation']['data']['body_type'] }}
                                </p>
                                <p><strong>fuel_type:</strong>{{ $fast_tag_information['rc_validation']['data']['fuel_type'] }}
                                </p>
                                <p><strong>color:</strong>{{ $fast_tag_information['rc_validation']['data']['color'] }}</p>
                                <p><strong>norms_type:</strong>{{ $fast_tag_information['rc_validation']['data']['norms_type'] }}
                                </p>
                                <p><strong>fit_up_to:</strong>{{ $fast_tag_information['rc_validation']['data']['fit_up_to'] }}
                                </p>
                                <p><strong>financer:</strong>{{ $fast_tag_information['rc_validation']['data']['financer'] }}
                                </p>
                                <p><strong>insurance_company:</strong>{{ $fast_tag_information['rc_validation']['data']['insurance_company'] }}
                                </p>
                                <p><strong>insurance_policy_number:</strong>{{ $fast_tag_information['rc_validation']['data']['insurance_policy_number'] }}
                                </p>
                                <p><strong>insurance_upto:</strong>{{ $fast_tag_information['rc_validation']['data']['insurance_upto'] }}
                                </p>
                                <p><strong>manufacturing_date:</strong>{{ $fast_tag_information['rc_validation']['data']['manufacturing_date'] }}
                                </p>
                                <p><strong>registered_at:</strong>{{ $fast_tag_information['rc_validation']['data']['registered_at'] }}
                                </p>
                                <p><strong>latest_by:</strong>{{ $fast_tag_information['rc_validation']['data']['latest_by'] }}
                                </p>
                                <p><strong>tax_upto:</strong>{{ $fast_tag_information['rc_validation']['data']['tax_upto'] }}
                                </p>
                                <p><strong>cubic_capacity:</strong>{{ $fast_tag_information['rc_validation']['data']['cubic_capacity'] }}
                                </p>
                                <p><strong>vehicle_gross_weight:</strong>{{ $fast_tag_information['rc_validation']['data']['vehicle_gross_weight'] }}
                                </p>
                                <p><strong>no_cylinders:</strong>{{ $fast_tag_information['rc_validation']['data']['no_cylinders'] }}
                                </p>
                                <p><strong>seat_capacity:</strong>{{ $fast_tag_information['rc_validation']['data']['seat_capacity'] }}
                                </p>
                                <p><strong>sleeper_capacity:</strong>{{ $fast_tag_information['rc_validation']['data']['sleeper_capacity'] }}
                                </p>
                                <p><strong>standing_capacity:</strong>{{ $fast_tag_information['rc_validation']['data']['standing_capacity'] }}
                                </p>
                                <p><strong>wheelbase:</strong>{{ $fast_tag_information['rc_validation']['data']['wheelbase'] }}
                                </p>
                                <p><strong>unladen_weight:</strong>{{ $fast_tag_information['rc_validation']['data']['unladen_weight'] }}
                                </p>
                                <p><strong>vehicle_category_description:</strong>{{ $fast_tag_information['rc_validation']['data']['vehicle_category_description'] }}
                                </p>
                                <p><strong>pucc_number:</strong>{{ $fast_tag_information['rc_validation']['data']['pucc_number'] }}
                                </p>
                                <p><strong>pucc_upto:</strong>{{ $fast_tag_information['rc_validation']['data']['pucc_upto'] }}
                                </p>
                                <p><strong>permit_number:</strong>{{ $fast_tag_information['rc_validation']['data']['permit_number'] }}
                                </p>
                                <p><strong>permit_issue_date:</strong>{{ $fast_tag_information['rc_validation']['data']['permit_issue_date'] }}
                                </p>
                                <p><strong>permit_valid_from:</strong>{{ $fast_tag_information['rc_validation']['data']['permit_valid_from'] }}
                                </p>
                                <p><strong>permit_valid_upto:</strong>{{ $fast_tag_information['rc_validation']['data']['permit_valid_upto'] }}
                                </p>
                                <p><strong>permit_type:</strong>{{ $fast_tag_information['rc_validation']['data']['permit_type'] }}
                                </p>
                                <p><strong>national_permit_number:</strong>{{ $fast_tag_information['rc_validation']['data']['national_permit_number'] }}
                                </p>
                                <p><strong>national_permit_upto:</strong>{{ $fast_tag_information['rc_validation']['data']['national_permit_upto'] }}
                                </p>
                                <p><strong>national_permit_issued_by:</strong>{{ $fast_tag_information['rc_validation']['data']['national_permit_issued_by'] }}
                                </p>
                                <p><strong>non_use_status:</strong>{{ $fast_tag_information['rc_validation']['data']['non_use_status'] }}
                                </p>
                                <p><strong>non_use_from:</strong>{{ $fast_tag_information['rc_validation']['data']['non_use_from'] }}
                                </p>
                                <p><strong>non_use_to:</strong>{{ $fast_tag_information['rc_validation']['data']['non_use_to'] }}
                                </p>
                                <p><strong>blacklist_status:</strong>{{ $fast_tag_information['rc_validation']['data']['blacklist_status'] }}
                                </p>
                                <p><strong>noc_details:</strong>{{ $fast_tag_information['rc_validation']['data']['noc_details'] }}
                                </p>
                                <p><strong>owner_number:</strong>{{ $fast_tag_information['rc_validation']['data']['owner_number'] }}
                                </p>
                                <p><strong>rc_status:
                                    </strong>{{ $fast_tag_information['rc_validation']['data']['rc_status'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif