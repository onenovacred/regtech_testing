<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pancard Details PDF</title>
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
        <div class="rc-watermark">PAN Details</div>

        <!-- Logo Row -->
        <div class="row">
            <div class="col-md-4 offset-md-3">
                <img src="{{ public_path('/logos/regtech.png') }}" alt="logo" style="margin-left:40px; margin-bottom:6px; width:10%; height:65px">
            </div>
            <img src="{{ public_path('/logos/regtech4.png') }}" alt="logo" style="margin-left:30px; width:15%; height:35px">
        </div>
    </div>
</header>
<body>
    <h3 class="card-title">Pancard Details</h3>

        <p><strong>Full Name:</strong> {{ isset($pancard['pancard']['data']['fullName'])?$pancard['pancard']['data']['fullName']:'null'}}</p>
                        <p><strong>PAN no: </strong>{{ isset($pancard['pancard']['data']['panNumber'])?$pancard['pancard']['data']['panNumber']:'null' }}</p>
                        <p><strong>Is Valid: </strong>{{ isset($pancard['pancard']['data']['isValid'])?$pancard['pancard']['data']['isValid']:'null'}}</p>
                        <p><strong>FirstName: </strong>{{ isset($pancard['pancard']['data']['firstName'])?$pancard['pancard']['data']['firstName']:'null' }}</p>
                        <p><strong>MiddleName: </strong>{{isset($pancard['pancard']['data']['middleName'])?$pancard['pancard']['data']['middleName']:'null'}}</p>
                        <p><strong>LastName: </strong>{{ isset($pancard['pancard']['data']['lastName'])?$pancard['pancard']['data']['lastName']:'null' }}</p>
                        <p><strong>DOB: </strong>{{ isset($pancard['pancard']['data']['dob'])?$pancard['pancard']['data']['dob']:'null' }}</p> 
                        <p><strong>Pan Status Code: </strong>{{ isset($pancard['pancard']['data']['panStatusCode'])?$pancard['pancard']['data']['panStatusCode']:'null'}}</p>
                        <p><strong>Pan Status: </strong>{{ isset($pancard['pancard']['data']['panStatus'])?$pancard['pancard']['data']['panStatus']:'null' }}</p>
                        <p><strong>Aadhaar Seeding Status: </strong>{{ isset($pancard['pancard']['data']['aadhaarSeedingStatus'])?$pancard['pancard']['data']['aadhaarSeedingStatus']:'null' }}</p>
                        <p><strong>Aadhaar Seeding Status Code: </strong>{{ isset($pancard['pancard']['data']['aadhaarSeedingStatusCode'])?$pancard['pancard']['data']['aadhaarSeedingStatusCode']:'null' }}</p>
                        <p><strong>last UpdatedOn: </strong>{{isset($pancard['pancard']['data']['lastUpdatedOn'])?$pancard['pancard']['data']['lastUpdatedOn']:'null' }}</p>
                        <div class="disclaimer-box">
                        <h4>Disclaimer</h4>
                        <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
                        </div>
                      </div>
                                   
</body>
</html>
