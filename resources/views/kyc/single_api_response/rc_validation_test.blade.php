
@if(!empty($rc_validationTest) && isset($rc_validationTest[0]['rc_validation']['status_code']))
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
                                <p><strong>Owner Name: </strong>{{ $rc_validationTest[0]['rc_validation']['data']['owner_name'] }}</p>
                                <p><strong>Permanent Address:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['permanent_address'] }}</p>
                                <p><strong>Mobile No:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['mobile_number'] }}</p>
                                <p><strong>Financer:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['financer'] }}</p>

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>Engine Number:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['vehicle_engine_number'] }}</p>
                                <p><strong>Chassis Number:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['vehicle_chasi_number'] }}</p>
                                <p><strong>Registration Date:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>Manufacturing Date:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['manufacturing_date'] }}</p>
                                <p><strong>Registered At:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['registered_at'] }}</p>
                                <p><strong>Maker Model:</strong> {{$rc_validationTest[0]['rc_validation']['data']['maker_model']}}</p>
                                <p><strong>Fuel Type:</strong> {{$rc_validationTest[0]['rc_validation']['data']['fuel_type']}}</p>
                                <p><strong>Color:</strong> {{$rc_validationTest[0]['rc_validation']['data']['color']}}</p>
                                <p><strong>Norms Type:</strong> {{$rc_validationTest[0]['rc_validation']['data']['norms_type']}}</p>
                                <p><strong>Fit Upto:</strong> {{$rc_validationTest[0]['rc_validation']['data']['fit_up_to']}}</p>
                                <p><strong>Tax Upto:</strong> {{$rc_validationTest[0]['rc_validation']['data']['tax_upto']}}</p>
            
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Company:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['insurance_company'] }}</p>
                                <p><strong>Policy Number:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['insurance_policy_number'] }}</p>
                                <p><strong>Insurance Upto:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['insurance_upto'] }}</p>
                                <hr>
                                <p><strong>License Verification:</strong> {{ $rc_validationTest[0]['rc_validation']['data']['message_code'] }}</p>


                                <p><strong>rc_number: </strong>{{ $rc_validationTest[0]['rc_validation']['data']['rc_number' ] }}</p>
                                <p><strong>registration_date: </strong>{{ $rc_validationTest[0]['rc_validation']['data']['registration_date' ] }}</p>
                                <p><strong>owner_name: </strong>{{ $rc_validationTest[0]['rc_validation']['data']['owner_name' ] }}</p>
                                <p><strong>father_name: </strong>{{ $rc_validationTest[0]['rc_validation']['data']['father_name' ] }}</p>
                                <p><strong>present_address:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['present_address' ] }}</p>
                                <p><strong>permanent_address:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permanent_address' ] }}</p>
                                <p><strong>mobile_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['mobile_number' ] }}</p>
                                <p><strong>vehicle_category:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['vehicle_category' ] }}</p>
                                <p><strong>vehicle_chasi_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['vehicle_chasi_number' ] }}</p>
                                <p><strong>vehicle_engine_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['vehicle_engine_number' ] }}</p>
                                <p><strong>maker_description:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['maker_description' ] }}</p>
                                <p><strong>maker_model:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['maker_model' ] }}</p>
                                <p><strong>body_type:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['body_type' ] }}</p>
                                <p><strong>fuel_type:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['fuel_type' ] }}</p>
                                <p><strong>color:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['color' ] }}</p>
                                <p><strong>norms_type:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['norms_type' ] }}</p>
                                <p><strong>fit_up_to:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['fit_up_to' ] }}</p>
                                <p><strong>financer:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['financer' ] }}</p>
                                <p><strong>insurance_company:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['insurance_company' ] }}</p>
                                <p><strong>insurance_policy_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['insurance_policy_number' ] }}</p>
                                <p><strong>insurance_upto:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['insurance_upto' ] }}</p>
                                <p><strong>manufacturing_date:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['manufacturing_date' ] }}</p>
                                <p><strong>registered_at:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['registered_at' ] }}</p>
                                <p><strong>latest_by:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['latest_by' ] }}</p>
                                <p><strong>tax_upto:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['tax_upto' ] }}</p>
                                <p><strong>cubic_capacity:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['cubic_capacity' ] }}</p>
                                <p><strong>vehicle_gross_weight:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['vehicle_gross_weight' ] }}</p>
                                <p><strong>no_cylinders:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['no_cylinders' ] }}</p>
                                <p><strong>seat_capacity:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['seat_capacity' ] }}</p>
                                <p><strong>sleeper_capacity:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['sleeper_capacity' ] }}</p>
                                <p><strong>standing_capacity:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['standing_capacity' ] }}</p>
                                <p><strong>wheelbase:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['wheelbase' ] }}</p>
                                <p><strong>unladen_weight:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['unladen_weight' ] }}</p>
                                <p><strong>vehicle_category_description:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['vehicle_category_description' ] }}</p>
                                <p><strong>pucc_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['pucc_number' ] }}</p>
                                <p><strong>pucc_upto:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['pucc_upto' ] }}</p>
                                <p><strong>permit_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permit_number' ] }}</p>
                                <p><strong>permit_issue_date:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permit_issue_date' ] }}</p>
                                <p><strong>permit_valid_from:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permit_valid_from' ] }}</p>
                                <p><strong>permit_valid_upto:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permit_valid_upto' ] }}</p>
                                <p><strong>permit_type:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['permit_type' ] }}</p>
                                <p><strong>national_permit_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['national_permit_number' ] }}</p>
                                <p><strong>national_permit_upto:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['national_permit_upto' ] }}</p>
                                <p><strong>national_permit_issued_by:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['national_permit_issued_by' ] }}</p>
                                <p><strong>non_use_status:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['non_use_status' ] }}</p>
                                <p><strong>non_use_from:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['non_use_from' ] }}</p>
                                <p><strong>non_use_to:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['non_use_to' ] }}</p>
                                <p><strong>blacklist_status:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['blacklist_status'] }}</p>
                                <p><strong>noc_details:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['noc_details' ] }}</p>
                                <p><strong>owner_number:</strong>{{ $rc_validationTest[0]['rc_validation']['data']['owner_number' ] }}</p>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif