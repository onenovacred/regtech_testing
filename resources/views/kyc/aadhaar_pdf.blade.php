<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aadhaar PDF</title>
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
        <div class="rc-watermark">Aadhaar Details</div>

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
    <!-- <h2>Aadhaar Details</h2> -->
    <p><strong>Full Name:</strong> {{ $aadhaar_validation['data']['data']['full_name'] }}</p>
    <p><strong>Aadhaar Number:</strong> {{ $aadhaar_validation['data']['data']['aadhaar_number'] }}</p>
    <p><strong>DOB:</strong> {{ $aadhaar_validation['data']['data']['dob'] }}</p>
    <p><strong>Gender:</strong> {{ $aadhaar_validation['data']['data']['gender'] }}</p>
    <p><strong>Email:</strong> {{ $aadhaar_validation['data']['data']['email_hash'] }}</p>
    <p><strong>Address:</strong> {{ $aadhaar_validation['data']['data']['address']['house'] }},
        {{ $aadhaar_validation['data']['data']['address']['street'] }},
        {{ $aadhaar_validation['data']['data']['address']['loc'] }},
        {{ $aadhaar_validation['data']['data']['address']['dist'] }},
        {{ $aadhaar_validation['data']['data']['address']['state'] }},
        {{ $aadhaar_validation['data']['data']['address']['country'] }} - {{ $aadhaar_validation['data']['data']['zip'] }}
    </p>
    <p><strong>Mobile Verified:</strong> {{ $aadhaar_validation['data']['data']['mobile_verified'] }}</p>
    <p><strong>Profile Image:</strong><br>
        <img src="data:image/jpeg;base64,{{ $aadhaar_validation['data']['data']['profile_image'] }}" alt="Profile Image">
    </p>
        <div class="disclaimer-box">
                        <h4>Disclaimer</h4>
                        <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
                        </div>
</body>
</html>
