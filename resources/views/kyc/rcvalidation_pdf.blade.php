<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RC Validation PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        p { margin: 4px 0; }
        img { max-width: 150px; }
    </style>
</head>
<header>
    <style>
        .rc-watermark {
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.72); /* Light gray with transparency */
            z-index: 0;
        }

        .header img {
            position: relative;
            z-index: 1;
        }

        .header {
            position: relative;
        }

         body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        p { margin: 4px 0; }
        img { max-width: 150px; }

        /* Style for the disclaimer box */
        .disclaimer-box {
            margin-top: 20px;
            padding: 15px;
            border: 2px solid #ddd;
            background-color: #f9f9f9;
            font-size: 12px;
            color: #555;
        }

        /* Style for the disclaimer title */
        .disclaimer-box h4 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        /* Style for the disclaimer text */
        .disclaimer-box p {
            margin-top: 10px;
            text-align: left;
        }
    </style>

    <div class="header">
        <!-- Watermark Text Behind Logo -->
        <div class="rc-watermark">RC VALIDATION</div>

        <!-- Logo Row -->
        <div class="row">
            <div class="col-md-4 offset-md-3">
                <img src="{{ public_path('/logos/regtech.png') }}" alt="logo" style="margin-left:40px; margin-bottom:6px; width:10%; height:65px">
            </div>
            <img src="{{ public_path('/logos/regtech4.png') }}" alt="logo" style="margin-left:30px; width:15%; height:35px">
        </div>
    </div>
</header>

    <hr>
<body>
    <h3>Owner Details</h3>
                                <hr>
                                <p><strong>Owner Name: </strong>{{ $rc_validation['rc_validation']['data']['owner_name'] }}</p>
                                <p><strong>Permanent Address:</strong> {{ $rc_validation['rc_validation']['data']['permanent_address'] }}</p>
                                <p><strong>Mobile No:</strong> {{ $rc_validation['rc_validation']['data']['mobile_number'] }}</p>
                                <p><strong>Financer:</strong> {{ $rc_validation['rc_validation']['data']['financer'] }}</p>

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number:</strong> {{ $rc_validation['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>Engine Number:</strong> {{ $rc_validation['rc_validation']['data']['vehicle_engine_number'] }}</p>
                                <p><strong>Chassis Number:</strong> {{ $rc_validation['rc_validation']['data']['vehicle_chasi_number'] }}</p>
                                <p><strong>Registration Date:</strong> {{ $rc_validation['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>Manufacturing Date:</strong> {{ $rc_validation['rc_validation']['data']['manufacturing_date'] }}</p>
                                <p><strong>RTO Code:</strong> {{ $rc_validation['rc_validation']['data']['rto_code'] }}</p> 
                                <p><strong>Maker Model:</strong> {{$rc_validation['rc_validation']['data']['maker_model']}}</p>
                                <p><strong>Fuel Type:</strong> {{$rc_validation['rc_validation']['data']['fuel_type']}}</p>
                                <p><strong>Color:</strong> {{$rc_validation['rc_validation']['data']['color']}}</p>
                                <p><strong>Norms Type:</strong> {{$rc_validation['rc_validation']['data']['norms_type']}}</p>
                                <p><strong>Fit Upto:</strong> {{$rc_validation['rc_validation']['data']['fit_up_to']}}</p>
                                <p><strong>Tax Upto:</strong> {{$rc_validation['rc_validation']['data']['tax_upto']}}</p>
            
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Company:</strong> {{ $rc_validation['rc_validation']['data']['insurance_company'] }}</p>
                                <p><strong>Policy Number:</strong> {{ $rc_validation['rc_validation']['data']['insurance_policy_number'] }}</p>
                                <p><strong>Insurance Upto:</strong> {{ $rc_validation['rc_validation']['data']['insurance_upto'] }}</p>
                                <hr>
                             


                                <p><strong>rc_number: </strong>{{ $rc_validation['rc_validation']['data']['rc_number' ] }}</p>
                                <p><strong>registration_date: </strong>{{ $rc_validation['rc_validation']['data']['registration_date' ] }}</p>
                                <p><strong>owner_name: </strong>{{ $rc_validation['rc_validation']['data']['owner_name' ] }}</p>
                                <p><strong>father_name: </strong>{{ $rc_validation['rc_validation']['data']['father_name' ] }}</p>
                                <p><strong>present_address:</strong>{{ $rc_validation['rc_validation']['data']['present_address' ] }}</p>
                                <p><strong>permanent_address:</strong>{{ $rc_validation['rc_validation']['data']['permanent_address' ] }}</p>
                                <p><strong>mobile_number:</strong>{{ $rc_validation['rc_validation']['data']['mobile_number' ] }}</p>
                                <p><strong>vehicle_category:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_category' ] }}</p>
                                <p><strong>vehicle_chasi_number:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_chasi_number' ] }}</p>
                                <p><strong>vehicle_engine_number:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_engine_number' ] }}</p>
                                <p><strong>maker_description:</strong>{{ $rc_validation['rc_validation']['data']['maker_description' ] }}</p>
                                <p><strong>maker_model:</strong>{{ $rc_validation['rc_validation']['data']['maker_model' ] }}</p>
                                <p><strong>body_type:</strong>{{ $rc_validation['rc_validation']['data']['body_type' ] }}</p>
                                <p><strong>fuel_type:</strong>{{ $rc_validation['rc_validation']['data']['fuel_type' ] }}</p>
                                <p><strong>color:</strong>{{ $rc_validation['rc_validation']['data']['color' ] }}</p>
                                <p><strong>norms_type:</strong>{{ $rc_validation['rc_validation']['data']['norms_type' ] }}</p>
                                <p><strong>fit_up_to:</strong>{{ $rc_validation['rc_validation']['data']['fit_up_to' ] }}</p>
                                <p><strong>financer:</strong>{{ $rc_validation['rc_validation']['data']['financer' ] }}</p>
                                <p><strong>insurance_company:</strong>{{ $rc_validation['rc_validation']['data']['insurance_company' ] }}</p>
                                <p><strong>insurance_policy_number:</strong>{{ $rc_validation['rc_validation']['data']['insurance_policy_number' ] }}</p>
                                <p><strong>insurance_upto:</strong>{{ $rc_validation['rc_validation']['data']['insurance_upto' ] }}</p>
                                <p><strong>manufacturing_date:</strong>{{ $rc_validation['rc_validation']['data']['manufacturing_date' ] }}</p>
                               
                                <p><strong>latest_by:</strong>{{ $rc_validation['rc_validation']['data']['latest_by' ] }}</p>
                                <p><strong>tax_upto:</strong>{{ $rc_validation['rc_validation']['data']['tax_upto' ] }}</p>
                                <p><strong>cubic_capacity:</strong>{{ $rc_validation['rc_validation']['data']['cubic_capacity' ] }}</p>
                                <p><strong>vehicle_gross_weight:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_gross_weight' ] }}</p>
                                <p><strong>no_cylinders:</strong>{{ $rc_validation['rc_validation']['data']['no_cylinders' ] }}</p>
                                <p><strong>seat_capacity:</strong>{{ $rc_validation['rc_validation']['data']['seat_capacity' ] }}</p>
                                <p><strong>sleeper_capacity:</strong>{{ $rc_validation['rc_validation']['data']['sleeper_capacity' ] }}</p>
                                <p><strong>standing_capacity:</strong>{{ $rc_validation['rc_validation']['data']['standing_capacity' ] }}</p>
                                <p><strong>wheelbase:</strong>{{ $rc_validation['rc_validation']['data']['wheelbase' ] }}</p>
                                <p><strong>unladen_weight:</strong>{{ $rc_validation['rc_validation']['data']['unladen_weight' ] }}</p>
                                <p><strong>vehicle_category_description:</strong>{{ $rc_validation['rc_validation']['data']['vehicle_category_description' ] }}</p>
                                <p><strong>pucc_number:</strong>{{ $rc_validation['rc_validation']['data']['pucc_number' ] }}</p>
                                <p><strong>pucc_upto:</strong>{{ $rc_validation['rc_validation']['data']['pucc_upto' ] }}</p>
                                <p><strong>permit_number:</strong>{{ $rc_validation['rc_validation']['data']['permit_number' ] }}</p>
                                <p><strong>permit_issue_date:</strong>{{ $rc_validation['rc_validation']['data']['permit_issue_date' ] }}</p>
                                <p><strong>permit_valid_from:</strong>{{ $rc_validation['rc_validation']['data']['permit_valid_from' ] }}</p>
                                <p><strong>permit_valid_upto:</strong>{{ $rc_validation['rc_validation']['data']['permit_valid_upto' ] }}</p>
                                <p><strong>permit_type:</strong>{{ $rc_validation['rc_validation']['data']['permit_type' ] }}</p>
                                <p><strong>national_permit_number:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_number' ] }}</p>
                                <p><strong>national_permit_upto:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_upto' ] }}</p>
                                <p><strong>national_permit_issued_by:</strong>{{ $rc_validation['rc_validation']['data']['national_permit_issued_by' ] }}</p>
                                <p><strong>non_use_status:</strong>{{ $rc_validation['rc_validation']['data']['non_use_status' ] }}</p>
                                <p><strong>non_use_from:</strong>{{ $rc_validation['rc_validation']['data']['non_use_from' ] }}</p>
                                <p><strong>non_use_to:</strong>{{ $rc_validation['rc_validation']['data']['non_use_to' ] }}</p>
                                <p><strong>blacklist_status:</strong>{{ $rc_validation['rc_validation']['data']['blacklist_status'] }}</p>
                                <p><strong>noc_details:</strong>{{ $rc_validation['rc_validation']['data']['noc_details' ] }}</p>
                                <p><strong>owner_number:</strong>{{ $rc_validation['rc_validation']['data']['owner_number' ] }}</p>
                                <p><strong>rc_status: </strong>{{ $rc_validation['rc_validation']['data']['rc_status' ] }}</p>

                                 <div class="disclaimer-box">
        <h4>Disclaimer</h4>
        <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
    </div>
</body>
</html>
