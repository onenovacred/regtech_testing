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
                              <p><strong>UdyamNumber: </strong>{{ $udyamcard['response']['udyam_reg_no'] }}</p>
<p><strong>Date Of Registration: </strong>{{ $udyamcard['response']['date_of_reg'] }}</p>
<p><strong>DIC: </strong>{{ $udyamcard['response']['district_industries_center'] }}</p>
<p><strong>MSME DFO: </strong>{{ $udyamcard['response']['msme_dfo'] }}</p>

{{-- Profile --}}
<p><strong>Enterprise Name: </strong>{{ $udyamcard['response']['profile']['enterprise_name'] }}</p>
<p><strong>Enterprise Type: </strong>{{ $udyamcard['response']['profile']['enterprise_type'] }}</p>
<p><strong>Major Activity: </strong>{{ $udyamcard['response']['profile']['major_activity'] }}</p>
<p><strong>Organisation Type: </strong>{{ $udyamcard['response']['profile']['organization_type'] }}</p>
<p><strong>Social Category: </strong>{{ $udyamcard['response']['profile']['social_category'] }}</p>
<p><strong>Date Of Incorporation: </strong>{{ $udyamcard['response']['profile']['date_of_incorporation'] }}</p>
<p><strong>Date Of Commencement: </strong>{{ $udyamcard['response']['profile']['date_of_commencement'] ?? 'N/A' }}</p>

{{-- Official Address --}}
<p><strong>Official Address:</strong><br>
    {{ $udyamcard['response']['official_address']['flat'] }},
    {{ $udyamcard['response']['official_address']['premises'] }},
    {{ $udyamcard['response']['official_address']['village'] }},
    {{ $udyamcard['response']['official_address']['block'] }},
    {{ $udyamcard['response']['official_address']['road'] }},
    {{ $udyamcard['response']['official_address']['city'] }},
    {{ $udyamcard['response']['official_address']['district'] }},
    {{ $udyamcard['response']['official_address']['state'] }} -
    {{ $udyamcard['response']['official_address']['pincode'] }}
</p>
<p><strong>Email: </strong>{{ $udyamcard['response']['official_address']['email'] }}</p>
<p><strong>Mobile: </strong>{{ $udyamcard['response']['official_address']['mobile'] }}</p>

{{-- Branch Details --}}
@if(!empty($udyamcard['response']['branch_details']))
    <p><strong>Branch Details:</strong></p>
    <ul>
        @foreach($udyamcard['response']['branch_details'] as $branch)
            <li>
                {{ $branch['name'] }} -
                {{ $branch['flat'] }}, {{ $branch['premises'] }}, {{ $branch['village'] }},
                {{ $branch['block'] }}, {{ $branch['road'] }},
                {{ $branch['city'] }}, {{ $branch['district'] }},
                {{ $branch['state'] }} - {{ $branch['pincode'] }}
            </li>
        @endforeach
    </ul>
@endif

{{-- Industry --}}
@if(!empty($udyamcard['response']['industry']))
    <p><strong>Industry Details:</strong></p>
    <ul>
        @foreach($udyamcard['response']['industry'] as $ind)
            <li>
                <strong>{{ $ind['industry'] }}</strong><br>
                Sub Sector: {{ $ind['sub_sector'] }}<br>
                Activity: {{ $ind['activity'] }}<br>
                Description: {{ $ind['activity_description'] }}<br>
                Industry Code: {{ $ind['industry_code'] }}<br>
                Sub Sector Code: {{ $ind['sub_sector_code'] }}<br>
                NIC Code: {{ $ind['nic_code'] }}<br>
                Date: {{ $ind['date'] }}
            </li>
        @endforeach
    </ul>
@endif

{{-- Enterprise Type History --}}
@if(!empty($udyamcard['response']['enterprise_type_history']))
    <p><strong>Enterprise Type History:</strong></p>
    <ul>
        @foreach($udyamcard['response']['enterprise_type_history'] as $history)
            <li>{{ $history['classification_year'] }} - {{ $history['enterprise_type'] }} ({{ $history['classification_date'] }})</li>
        @endforeach
    </ul>
@endif

                                 <div class="disclaimer-box">
        <h4>Disclaimer</h4>
        <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
    </div>
</body>
</html>
