<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CORPORATE GSTIN Details</title>
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
        <div class="rc-watermark">CORPORATE GSTIN Details</div>

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
    <h3 class="card-title">CORPORATE GSTIN Details</h3>
    <p><strong>Business Name:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['legal_name'])){{ $corporate_gstin[0]['corporate_gstin']['response']['legal_name'] }}@else '' @endif</p>
    <p><strong>GSTIN Number:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['gstin'])){{ $corporate_gstin[0]['corporate_gstin']['response']['gstin'] }}@else '' @endif</p>
    <p><strong>Status:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['status'])){{ $corporate_gstin[0]['corporate_gstin']['response']['status'] }}@else '' @endif</p>
    <p><strong>Trade Name:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['trade_name'])){{ $corporate_gstin[0]['corporate_gstin']['response']['trade_name'] }}@else '' @endif</p>
    <p><strong>Taxpayer Type:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['taxpayer_type'])){{ $corporate_gstin[0]['corporate_gstin']['response']['taxpayer_type'] }}@else '' @endif</p>
    <p><strong>Registration Date:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['reg_date'])){{ $corporate_gstin[0]['corporate_gstin']['response']['reg_date'] }}@else '' @endif</p>
    <p><strong>Nature:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['nature'])){{ $corporate_gstin[0]['corporate_gstin']['response']['nature'] }}@else '' @endif</p>
    <p><strong>Jurisdiction:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['jurisdiction'])){{ $corporate_gstin[0]['corporate_gstin']['response']['jurisdiction'] }}@else '' @endif</p>
    <p><strong>Business Type:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['business_type'])){{ $corporate_gstin[0]['corporate_gstin']['response']['business_type'] }}@else '' @endif</p>
    <p><strong>Last Update:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['last_update'])){{ $corporate_gstin[0]['corporate_gstin']['response']['last_update'] }}@else '' @endif</p>
    <p><strong>State Code:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['state_code'])){{ $corporate_gstin[0]['corporate_gstin']['response']['state_code'] }}@else '' @endif</p>
    <p><strong>Address:</strong> @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['addr1'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['addr1'] }}@else '' @endif, @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['addr2'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['addr2'] }}@else '' @endif, @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['pin'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['pin'] }}@else '' @endif, @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['state'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['state'] }}@else '' @endif, @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['city'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['city'] }}@else '' @endif, @if(isset($corporate_gstin[0]['corporate_gstin']['response']['address']['district'])){{ $corporate_gstin[0]['corporate_gstin']['response']['address']['district'] }}@else '' @endif</p>
     <div class="disclaimer-box">
                        <h4>Disclaimer</h4>
                        <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
    </div>
</body>
</html>
