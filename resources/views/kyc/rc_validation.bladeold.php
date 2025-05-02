@extends('adminlte::page')

@section('title', 'License Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">RC Verification</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.rc_api') }}">RC APIs</a>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Registration Number is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.rc_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">RC Number</label>
                                <input type="text" class="form-control"
                                    id="rc_number" name="rc_number" value="{{old('rc_number')}}" 
                                    placeholder="Ex: MH12PQ1234" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($rc_validation) && $rc_validation['status_code'] == 200)
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
                        <p>Owner Name: {{ $rc_validation['data']['owner_name'] }}</p>
                        <p>Permanent Address: {{ $rc_validation['data']['permanent_address'] }}</p>
                        <p>Mobile No: {{ $rc_validation['data']['mobile_number'] }}</p>
                        <p>Financer: {{ $rc_validation['data']['financer'] }}</p>

                        <h3>Vehicle Details</h3>
                        <hr>
                        <p>RC Number: {{ $rc_validation['data']['rc_number'] }}</p>
                        <p>Engine Number: {{ $rc_validation['data']['vehicle_engine_number'] }}</p>
                        <p>Chassis Number: {{ $rc_validation['data']['vehicle_chasi_number'] }}</p>
                        <p>Registration Date: {{ $rc_validation['data']['registration_date'] }}</p>
                        <p>Manufacturing Date: {{ $rc_validation['data']['manufacturing_date'] }}</p>
                        <p>Registered At: {{ $rc_validation['data']['registered_at'] }}</p>
                        <p>Maker Model: {{$rc_validation['data']['maker_model']}}</p>
                        <p>Fuel Type: {{$rc_validation['data']['fuel_type']}}</p>
                        <p>Color: {{$rc_validation['data']['color']}}</p>
                        <p>Norms Type: {{$rc_validation['data']['norms_type']}}</p>
                        <p>Fit Upto: {{$rc_validation['data']['fit_up_to']}}</p>
                        <p>Tax Upto: {{$rc_validation['data']['tax_upto']}}</p>
      
                        <h3>Insurance</h3>
                        <hr>
                        <p>Insurance Company: {{ $rc_validation['data']['insurance_company'] }}</p>
                        <p>Policy Number: {{ $rc_validation['data']['insurance_policy_number'] }}</p>
                        <p>Insurance Upto: {{ $rc_validation['data']['insurance_upto'] }}</p>
                        <hr>
                        <p>License Verification: {{ $rc_validation['message_code'] }}</p>


    <p><strong>client_id: </strong>{{ $rc_validation['data']['client_id' ] }}</p>
    <p><strong>rc_number: </strong>{{ $rc_validation['data']['rc_number' ] }}</p>
    <p><strong>registration_date: </strong>{{ $rc_validation['data']['registration_date' ] }}</p>
    <p><strong>owner_name: </strong>{{ $rc_validation['data']['owner_name' ] }}</p>
    <p><strong>father_name: </strong>{{ $rc_validation['data']['father_name' ] }}</p>
    <p><strong>present_address:</strong>{{ $rc_validation['data']['present_address' ] }}</p>
    <p><strong>permanent_address:</strong>{{ $rc_validation['data']['permanent_address' ] }}</p>
    <p><strong>mobile_number:</strong>{{ $rc_validation['data']['mobile_number' ] }}</p>
    <p><strong>vehicle_category:</strong>{{ $rc_validation['data']['vehicle_category' ] }}</p>
    <p><strong>vehicle_chasi_number:</strong>{{ $rc_validation['data']['vehicle_chasi_number' ] }}</p>
    <p><strong>vehicle_engine_number:</strong>{{ $rc_validation['data']['vehicle_engine_number' ] }}</p>
    <p><strong>maker_description:</strong>{{ $rc_validation['data']['maker_description' ] }}</p>
    <p><strong>maker_model:</strong>{{ $rc_validation['data']['maker_model' ] }}</p>
    <p><strong>body_type:</strong>{{ $rc_validation['data']['body_type' ] }}</p>
    <p><strong>fuel_type:</strong>{{ $rc_validation['data']['fuel_type' ] }}</p>
    <p><strong>color:</strong>{{ $rc_validation['data']['color' ] }}</p>
    <p><strong>norms_type:</strong>{{ $rc_validation['data']['norms_type' ] }}</p>
    <p><strong>fit_up_to:</strong>{{ $rc_validation['data']['fit_up_to' ] }}</p>
    <p><strong>financer:</strong>{{ $rc_validation['data']['financer' ] }}</p>
    <p><strong>financed:</strong>{{ $rc_validation['data']['financed' ] }}</p>
    <p><strong>insurance_company:</strong>{{ $rc_validation['data']['insurance_company' ] }}</p>
    <p><strong>insurance_policy_number:</strong>{{ $rc_validation['data']['insurance_policy_number' ] }}</p>
    <p><strong>insurance_upto:</strong>{{ $rc_validation['data']['insurance_upto' ] }}</p>
    <p><strong>manufacturing_date:</strong>{{ $rc_validation['data']['manufacturing_date' ] }}</p>
    <p><strong>registered_at:</strong>{{ $rc_validation['data']['registered_at' ] }}</p>
    <p><strong>latest_by:</strong>{{ $rc_validation['data']['latest_by' ] }}</p>
    <p><strong>less_info:</strong>{{ $rc_validation['data']['less_info' ] }}</p>
    <p><strong>tax_upto:</strong>{{ $rc_validation['data']['tax_upto' ] }}</p>
    <p><strong>cubic_capacity:</strong>{{ $rc_validation['data']['cubic_capacity' ] }}</p>
    <p><strong>vehicle_gross_weight:</strong>{{ $rc_validation['data']['vehicle_gross_weight' ] }} Tag: {{$checkWeight->tag_class}}</p>
    <p><strong>no_cylinders:</strong>{{ $rc_validation['data']['no_cylinders' ] }}</p>
    <p><strong>seat_capacity:</strong>{{ $rc_validation['data']['seat_capacity' ] }}</p>
    <p><strong>sleeper_capacity:</strong>{{ $rc_validation['data']['sleeper_capacity' ] }}</p>
    <p><strong>standing_capacity:</strong>{{ $rc_validation['data']['standing_capacity' ] }}</p>
    <p><strong>wheelbase:</strong>{{ $rc_validation['data']['wheelbase' ] }}</p>
    <p><strong>unladen_weight:</strong>{{ $rc_validation['data']['unladen_weight' ] }}</p>
    <p><strong>vehicle_category_description:</strong>{{ $rc_validation['data']['vehicle_category_description' ] }}</p>
    <p><strong>pucc_number:</strong>{{ $rc_validation['data']['pucc_number' ] }}</p>
    <p><strong>pucc_upto:</strong>{{ $rc_validation['data']['pucc_upto' ] }}</p>
    <p><strong>permit_number:</strong>{{ $rc_validation['data']['permit_number' ] }}</p>
    <p><strong>permit_issue_date:</strong>{{ $rc_validation['data']['permit_issue_date' ] }}</p>
    <p><strong>permit_valid_from:</strong>{{ $rc_validation['data']['permit_valid_from' ] }}</p>
    <p><strong>permit_valid_upto:</strong>{{ $rc_validation['data']['permit_valid_upto' ] }}</p>
    <p><strong>permit_type:</strong>{{ $rc_validation['data']['permit_type' ] }}</p>
    <p><strong>national_permit_number:</strong>{{ $rc_validation['data']['national_permit_number' ] }}</p>
    <p><strong>national_permit_upto:</strong>{{ $rc_validation['data']['national_permit_upto' ] }}</p>
    <p><strong>national_permit_issued_by:</strong>{{ $rc_validation['data']['national_permit_issued_by' ] }}</p>
    <p><strong>non_use_status:</strong>{{ $rc_validation['data']['non_use_status' ] }}</p>
    <p><strong>non_use_from:</strong>{{ $rc_validation['data']['non_use_from' ] }}</p>
    <p><strong>non_use_to:</strong>{{ $rc_validation['data']['non_use_to' ] }}</p>
    <p><strong>blacklist_status:{{ $rc_validation['data']['blacklist_status' ] }}</p>
    <p><strong>noc_details:</strong>{{ $rc_validation['data']['noc_details' ] }}</p>
    <p><strong>owner_number:</strong>{{ $rc_validation['data']['owner_number' ] }}</p>
    <p><strong>rc_status:</strong>{{ $rc_validation['data']['rc_status' ] }}</p>
    <p><strong>masked_name:</strong>{{ $rc_validation['data']['masked_name' ] }}</p>
    <p><strong>challan_details:</strong>{{ $rc_validation['data']['challan_details' ] }}</p>
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