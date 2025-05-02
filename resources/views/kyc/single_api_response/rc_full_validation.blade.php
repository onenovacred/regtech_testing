
@if(!empty($rc_challan) && isset($rc_challan['status_code']) && $rc_challan['status_code'] ==200)
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
                                <p><strong>Owner Name: </strong>{{ isset($rc_challan['rc_validation']['data']['owner_name'])?$rc_challan['rc_validation']['data']['owner_name']:"null" }}</p>
                                <p><strong>Permanent Address: </strong>{{ isset($rc_challan['rc_validation']['data']['permanent_address'])?$rc_challan['rc_validation']['data']['permanent_address']:'null' }}</p>
                                <p><strong>Mobile No: </strong>{{ isset($rc_challan['rc_validation']['data']['mobile_number'])?$rc_challan['rc_validation']['data']['mobile_number']:'null' }}</p>
                                <p><strong>Financer: </strong>{{ isset($rc_challan['rc_validation']['data']['financer'])?$rc_challan['rc_validation']['data']['financer']:'null' }}</p>

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number: </strong>{{ isset($rc_challan['rc_validation']['data']['rc_number'])?$rc_challan['rc_validation']['data']['rc_number']:'null' }}</p>
                                <p><strong>Engine Number: </strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_engine_number'])?$rc_challan['rc_validation']['data']['vehicle_engine_number']:'null' }}</p>
                                <p><strong>Chassis Number: </strong>{{isset($rc_challan['rc_validation']['data']['vehicle_chasi_number'])?$rc_challan['rc_validation']['data']['vehicle_chasi_number']:'null' }}</p>
                                <p><strong>Registration Date: </strong>{{ isset($rc_challan['rc_validation']['data']['registration_date'])?$rc_challan['rc_validation']['data']['registration_date']:"null" }}</p>
                                <p><strong>Manufacturing Date: </strong>{{ isset($rc_challan['rc_validation']['data']['manufacturing_date'])?$rc_challan['rc_validation']['data']['manufacturing_date']:'null' }}</p>
                                <p><strong>Registered At: </strong>{{ isset($rc_challan['rc_validation']['data']['registered_at'])?$rc_challan['rc_validation']['data']['registered_at']:'null' }}</p>
                                <p><strong>Maker Model: </strong>{{isset($rc_challan['rc_validation']['data']['maker_model'])?$rc_challan['rc_validation']['data']['maker_model']:'null'}}</p>
                                <p><strong>Fuel Type: </strong>{{isset($rc_challan['rc_validation']['data']['fuel_type'])?$rc_challan['rc_validation']['data']['fuel_type']:'null'}}</p>
                                <p><strong>Color: </strong>{{isset($rc_challan['rc_validation']['data']['color'])?$rc_challan['rc_validation']['data']['color']:'null'}}</p>
                                <p><strong>Norms Type: </strong>{{isset($rc_challan['rc_validation']['data']['norms_type'])?$rc_challan['rc_validation']['data']['norms_type']:'null'}}</p>
                                <p><strong>Fit Upto: </strong>{{isset($rc_challan['rc_validation']['data']['fit_up_to'])?$rc_challan['rc_validation']['data']['fit_up_to']:'null'}}</p>
                                <p><strong>Tax Upto: </strong>{{isset($rc_challan['rc_validation']['data']['tax_upto'])?$rc_challan['rc_validation']['data']['tax_upto']:'null'}}</p>
            
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Company: </strong>{{ isset($rc_challan['rc_validation']['data']['insurance_company'])?$rc_challan['rc_validation']['data']['insurance_company']:'null' }}</p>
                                <p><strong>Policy Number: </strong>{{ isset($rc_challan['rc_validation']['data']['insurance_policy_number'])?$rc_challan['rc_validation']['data']['insurance_policy_number']:'null' }}</p>
                                <p><strong>Insurance Upto: </strong>{{ isset($rc_challan['rc_validation']['data']['insurance_upto'])?$rc_challan['rc_validation']['data']['insurance_upto']:'null' }}</p>
                                <hr>
                                <p><strong>License Verification: </strong>{{ isset($rc_challan['rc_validation']['message_code'])?$rc_challan['rc_validation']['message_code']:'null' }}</p>


                                <p><strong>client_id: </strong>{{ isset($rc_challan['rc_validation']['data']['client_id'])?$rc_challan['rc_validation']['data']['client_id' ]:'null'}}</p>
                                <p><strong>rc_number: </strong>{{isset($rc_challan['rc_validation']['data']['rc_number' ])?$rc_challan['rc_validation']['data']['rc_number' ]:'null' }}</p>
                                <p><strong>registration_date: </strong>{{ isset($rc_challan['rc_validation']['data']['registration_date' ])?$rc_challan['rc_validation']['data']['registration_date' ]:'null' }}</p>
                                <p><strong>owner_name: </strong>{{ isset($rc_challan['rc_validation']['data']['owner_name' ])?$rc_challan['rc_validation']['data']['owner_name' ]:'null' }}</p>
                                <p><strong>father_name: </strong>{{ isset($rc_challan['rc_validation']['data']['father_name'])?$rc_challan['rc_validation']['data']['father_name' ]:'null' }}</p>
                                <p><strong>present_address:</strong>{{ isset($rc_challan['rc_validation']['data']['present_address'])?$rc_challan['rc_validation']['data']['present_address' ]:'null' }}</p>
                                <p><strong>permanent_address:</strong>{{ isset($rc_challan['rc_validation']['data']['permanent_address' ])?$rc_challan['rc_validation']['data']['permanent_address' ]:'null' }}</p>
                                <p><strong>mobile_number:</strong>{{ isset($rc_challan['rc_validation']['data']['mobile_number' ])?$rc_challan['rc_validation']['data']['mobile_number' ]:'null' }}</p>
                                <p><strong>vehicle_category:</strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_category'])?$rc_challan['rc_validation']['data']['vehicle_category' ]:'null' }}</p>
                                <p><strong>vehicle_chasi_number:</strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_chasi_number' ])?$rc_challan['rc_validation']['data']['vehicle_chasi_number' ]:'null' }}</p>
                                <p><strong>vehicle_engine_number:</strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_engine_number' ])?$rc_challan['rc_validation']['data']['vehicle_engine_number' ]:'null' }}</p>
                                <p><strong>maker_description:</strong>{{ isset($rc_challan['rc_validation']['data']['maker_description' ])?$rc_challan['rc_validation']['data']['maker_description' ]:'null' }}</p>
                                <p><strong>maker_model:</strong>{{ isset($rc_challan['rc_validation']['data']['maker_model' ])?$rc_challan['rc_validation']['data']['maker_model' ]:'null' }}</p>
                                <p><strong>body_type:</strong>{{ isset($rc_challan['rc_validation']['data']['body_type'])?$rc_challan['rc_validation']['data']['body_type' ]:'null' }}</p>
                                <p><strong>fuel_type:</strong>{{isset( $rc_challan['rc_validation']['data']['fuel_type'])? $rc_challan['rc_validation']['data']['fuel_type' ]:'null'}}</p>
                                <p><strong>color:</strong>{{ isset($rc_challan['rc_validation']['data']['color' ])?$rc_challan['rc_validation']['data']['color' ]:'null' }}</p>
                                <p><strong>norms_type:</strong>{{isset($rc_challan['rc_validation']['data']['norms_type' ])?$rc_challan['rc_validation']['data']['norms_type' ]:'null' }}</p>
                                <p><strong>fit_up_to:</strong>{{ isset($rc_challan['rc_validation']['data']['fit_up_to'])?$rc_challan['rc_validation']['data']['fit_up_to' ]:'null' }}</p>
                                <p><strong>financer:</strong>{{ isset($rc_challan['rc_validation']['data']['financer' ])?$rc_challan['rc_validation']['data']['financer' ]:'null' }}</p>
                                <p><strong>financed:</strong>{{ isset($rc_challan['rc_validation']['data']['financed'])?$rc_challan['rc_validation']['data']['financed']:'null' }}</p>
                                <p><strong>insurance_company:</strong>{{isset($rc_challan['rc_validation']['data']['insurance_company'])?$rc_challan['rc_validation']['data']['insurance_company' ]:'null' }}</p>
                                <p><strong>insurance_policy_number:</strong>{{isset($rc_challan['rc_validation']['data']['insurance_policy_number'])?$rc_challan['rc_validation']['data']['insurance_policy_number' ]:'null' }}</p>
                                <p><strong>insurance_upto:</strong>{{ isset($rc_challan['rc_validation']['data']['insurance_upto'])?$rc_challan['rc_validation']['data']['insurance_upto' ]:'null' }}</p>
                                <p><strong>manufacturing_date:</strong>{{ isset($rc_challan['rc_validation']['data']['manufacturing_date'])?$rc_challan['rc_validation']['data']['manufacturing_date' ]:'null' }}</p>
                                <p><strong>registered_at:</strong>{{ isset($rc_challan['rc_validation']['data']['registered_at'])?$rc_challan['rc_validation']['data']['registered_at' ]:'null' }}</p>
                                <p><strong>latest_by:</strong>{{isset($rc_challan['rc_validation']['data']['latest_by' ])?$rc_challan['rc_validation']['data']['latest_by' ]:'null' }}</p>
                                <p><strong>less_info:</strong>{{ isset($rc_challan['rc_validation']['data']['less_info'])?$rc_challan['rc_validation']['data']['less_info' ]:'null' }}</p>
                                <p><strong>tax_upto:</strong>{{ isset($rc_challan['rc_validation']['data']['tax_upto'])?$rc_challan['rc_validation']['data']['tax_upto' ]:'null' }}</p>
                                <p><strong>cubic_capacity:</strong>{{ isset($rc_challan['rc_validation']['data']['cubic_capacity' ])?$rc_challan['rc_validation']['data']['cubic_capacity' ]:'null' }}</p>
                                <p><strong>vehicle_gross_weight:</strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_gross_weight'])?$rc_challan['rc_validation']['data']['vehicle_gross_weight' ]:'null' }} Tag: {{isset($rc_challan[0]['rc_validation']['data']['tag_class' ])?$rc_challan[0]['rc_validation']['data']['tag_class' ]:'null'}}</p>
                                <p><strong>no_cylinders:</strong>{{ isset($rc_challan['rc_validation']['data']['no_cylinders' ])?$rc_challan['rc_validation']['data']['no_cylinders' ]:'null' }}</p>
                                <p><strong>seat_capacity:</strong>{{ isset($rc_challan['rc_validation']['data']['seat_capacity' ])?$rc_challan['rc_validation']['data']['seat_capacity' ]:'null' }}</p>
                                <p><strong>sleeper_capacity:</strong>{{ isset($rc_challan['rc_validation']['data']['sleeper_capacity'])?$rc_challan['rc_validation']['data']['sleeper_capacity']:'null' }}</p>
                                <p><strong>standing_capacity:</strong>{{ isset($rc_challan['rc_validation']['data']['standing_capacity'])?$rc_challan['rc_validation']['data']['standing_capacity' ]:'null' }}</p>
                                <p><strong>wheelbase:</strong>{{isset($rc_challan['rc_validation']['data']['wheelbase'])?$rc_challan['rc_validation']['data']['wheelbase' ]:'null' }}</p>
                                <p><strong>unladen_weight:</strong>{{isset($rc_challan['rc_validation']['data']['unladen_weight'])?$rc_challan['rc_validation']['data']['unladen_weight' ]:'null' }}</p>
                                <p><strong>vehicle_category_description:</strong>{{ isset($rc_challan['rc_validation']['data']['vehicle_category_description' ])?$rc_challan['rc_validation']['data']['vehicle_category_description' ]:'null' }}</p>
                                <p><strong>pucc_number:</strong>{{ isset($rc_challan['rc_validation']['data']['pucc_number'])?$rc_challan['rc_validation']['data']['pucc_number']:'null' }}</p>
                                <p><strong>pucc_upto:</strong>{{ isset($rc_challan['rc_validation']['data']['pucc_upto'])?$rc_challan['rc_validation']['data']['pucc_upto' ]:'null' }}</p>
                                <p><strong>permit_number:</strong>{{ isset($rc_challan['rc_validation']['data']['permit_number' ])?$rc_challan['rc_validation']['data']['permit_number' ]:'null' }}</p>
                                <p><strong>permit_issue_date:</strong>{{ isset($rc_challan['rc_validation']['data']['permit_issue_date' ])?$rc_challan['rc_validation']['data']['permit_issue_date' ]:'null' }}</p>
                                <p><strong>permit_valid_from:</strong>{{ isset($rc_challan['rc_validation']['data']['permit_valid_from'])?$rc_challan['rc_validation']['data']['permit_valid_from' ]:'null' }}</p>
                                <p><strong>permit_valid_upto:</strong>{{ isset($rc_challan['rc_validation']['data']['permit_valid_upto'])?$rc_challan['rc_validation']['data']['permit_valid_upto' ]:'null' }}</p>
                                <p><strong>permit_type:</strong>{{ isset($rc_challan['rc_validation']['data']['permit_type'])?$rc_challan['rc_validation']['data']['permit_type']:'null' }}</p>
                                <p><strong>national_permit_number:</strong>{{ isset($rc_challan['rc_validation']['data']['national_permit_number'])?$rc_challan['rc_validation']['data']['national_permit_number']:'null' }}</p>
                                <p><strong>national_permit_upto:</strong>{{ isset($rc_challan['rc_validation']['data']['national_permit_upto'])?$rc_challan['rc_validation']['data']['national_permit_upto']:'null' }}</p>
                                <p><strong>national_permit_issued_by:</strong>{{ isset($rc_challan['rc_validation']['data']['national_permit_issued_by'])?$rc_challan['rc_validation']['data']['national_permit_issued_by']:'null' }}</p>
                                <p><strong>non_use_status:</strong>{{ isset($rc_challan['rc_validation']['data']['non_use_status'])?$rc_challan['rc_validation']['data']['non_use_status']:'null' }}</p>
                                <p><strong>non_use_from:</strong>{{ isset($rc_challan['rc_validation']['data']['non_use_from'])?$rc_challan['rc_validation']['data']['non_use_from']:'null' }}</p>
                                <p><strong>non_use_to:</strong>{{ isset($rc_challan['rc_validation']['data']['non_use_to'])?$rc_challan['rc_validation']['data']['non_use_to']:'null' }}</p>
                                <p><strong>blacklist_status:</strong>{{ isset($rc_challan['rc_validation']['data']['blacklist_status'])?$rc_challan['rc_validation']['data']['blacklist_status']:'null' }}</p>
                                <p><strong>noc_details:</strong>{{ isset($rc_challan['rc_validation']['data']['noc_details'])?$rc_challan['rc_validation']['data']['noc_details']:'null' }}</p>
                                <p><strong>owner_number:</strong>{{ isset($rc_challan['rc_validation']['data']['owner_number' ])?$rc_challan['rc_validation']['data']['owner_number' ]:'null' }}</p>
                                <h3>Challan Details</h3>
                                <hr/>
                                <p><strong>challan_number: </strong>null</p>
                                <p><strong>offense_details:</strong>null</p>
                                <p><strong>challan_place:</strong>null</p>
                                <p><strong>challan_date: </strong>null</p>
                                <p><strong>state:</strong>null</p>
                                <p><strong>RTO:</strong>null</p>
                                <p><strong>accusedName:</strong>null</p>
                                <p><strong>amount:</strong>null</p>
                                <p><strong>status:</strong>null</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif