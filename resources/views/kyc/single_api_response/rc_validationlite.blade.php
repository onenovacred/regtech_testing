@if(!empty($rc_validationLite) && isset($rc_validationLite[0]['rc_validation']['status_code']))
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
                                <p><strong>Owner Name: </strong>{{ $rc_validationLite[0]['rc_validation']['data']['owner_name'] }}</p>
                               

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number:</strong> {{ $rc_validationLite[0]['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>Registration Date:</strong> {{ $rc_validationLite[0]['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>Manufacturing Date:</strong> {{ $rc_validationLite[0]['rc_validation']['data']['manufacturing_date'] }}</p>
                                <p><strong>Registered At:</strong> {{ $rc_validationLite[0]['rc_validation']['data']['registered_at'] }}</p>
                                <p><strong>Fuel Type:</strong> {{$rc_validationLite[0]['rc_validation']['data']['fuel_type']}}</p>
                                <p><strong>Fit Upto:</strong> {{$rc_validationLite[0]['rc_validation']['data']['fit_up_to']}}</p>
                                <p><strong>Tax Upto:</strong> {{$rc_validationLite[0]['rc_validation']['data']['tax_upto']}}</p>
            
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Upto:</strong> {{ $rc_validationLite[0]['rc_validation']['data']['insurance_upto'] }}</p>
                                <hr>
                               


                                <p><strong>rc_number: </strong>{{ $rc_validationLite[0]['rc_validation']['data']['rc_number' ] }}</p>
                                <p><strong>registration_date: </strong>{{ $rc_validationLite[0]['rc_validation']['data']['registration_date' ] }}</p>
                                <p><strong>owner_name: </strong>{{ $rc_validationLite[0]['rc_validation']['data']['owner_name' ] }}</p>
                                <p><strong>vehicle_category:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['vehicle_category' ] }}</p>
                                <p><strong>fuel_type:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['fuel_type' ] }}</p>
                                <p><strong>fit_up_to:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['fit_up_to' ] }}</p>
                                <p><strong>insurance_upto:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['insurance_upto' ] }}</p>
                                <p><strong>manufacturing_date:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['manufacturing_date' ] }}</p>
                                <p><strong>registered_at:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['registered_at' ] }}</p>
                                <p><strong>tax_upto:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['tax_upto' ] }}</p>
                                <p><strong>pucc_upto:</strong>{{ $rc_validationLite[0]['rc_validation']['data']['pucc_upto' ] }}</p>
                                <p><strong>rc_status: </strong>{{ $rc_validationLite[0]['rc_validation']['data']['rc_status' ] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif