<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Voter PDF</title>
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
        <div class="rc-watermark">Voter Details</div>

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
    <h3 class="card-title">Voter Details</h3>
     <p>Voter ID / Epic Number: {{ $voter_validation[0]['voter_validation']['result']['epic_no'] ?? '' }}</p>
                        <p>Name: {{ $voter_validation[0]['voter_validation']['result']['name'] ?? '' }}</p>
                       
                        <p>First Name: {{ $voter_validation[0]['voter_validation']['result']['name_fn'] ?? '' }}</p>
                      
                        <p>Last Name: {{ $voter_validation[0]['voter_validation']['result']['name_ln'] ?? '' }}</p>
                    

                        <p>Relation Type: {{ $voter_validation[0]['voter_validation']['result']['rln_type'] ?? '' }}</p>
                        <p>Relation Name: {{ $voter_validation[0]['voter_validation']['result']['rln_name'] ?? '' }}</p>
                      

                        <p>Age: {{ $voter_validation[0]['voter_validation']['result']['age'] ?? '' }}</p>
                        <p>Gender:
                            @if(($voter_validation[0]['voter_validation']['result']['gender'] ?? '') == 'M')
                                Male
                            @elseif(($voter_validation[0]['voter_validation']['result']['gender'] ?? '') == 'F')
                                Female
                            @else
                                {{ $voter_validation[0]['voter_validation']['result']['gender'] ?? '' }}
                            @endif
                        </p>

                        <p>State: {{ $voter_validation[0]['voter_validation']['result']['st_name'] ?? '' }}</p>
                        <p>State Code: {{ $voter_validation[0]['voter_validation']['result']['st_code'] ?? '' }}</p>
                        <p>District: {{ $voter_validation[0]['voter_validation']['result']['dist_name'] ?? '' }}</p>
                     

                        <p>Assembly Constituency: {{ $voter_validation[0]['voter_validation']['result']['ac_name'] ?? '' }}</p>
                      
                        <p>Assembly Constituency Number: {{ $voter_validation[0]['voter_validation']['result']['ac_no'] ?? '' }}</p>

                        <p>Parliamentary Constituency: {{ $voter_validation[0]['voter_validation']['result']['pc_name'] ?? '' }}</p>
                       
                        <p>Parliamentary Constituency Number: {{ $voter_validation[0]['voter_validation']['result']['pc_no'] ?? '' }}</p>

                        <p>Polling Station: {{ $voter_validation[0]['voter_validation']['result']['ps_name'] ?? '' }}</p>
                      
                        <p>Polling Station Number: {{ $voter_validation[0]['voter_validation']['result']['ps_no'] ?? '' }}</p>
                        <p>Polling Lat/Long: {{ $voter_validation[0]['voter_validation']['result']['ps_lat_long'] ?? '' }}</p>
                        <p>Polling Building Name: {{ $voter_validation[0]['voter_validation']['result']['psbuildingName'] ?? '' }}</p>
                        
                        <p>Polling Room Details: {{ $voter_validation[0]['voter_validation']['result']['psRoomDetails'] ?? '' }}</p>
                    
                        <p>Building Address: {{ $voter_validation[0]['voter_validation']['result']['buildingAddress'] ?? '' }}</p>

                        <p>Part Number: {{ $voter_validation[0]['voter_validation']['result']['part_no'] ?? '' }}</p>
                        <p>Part Name: {{ $voter_validation[0]['voter_validation']['result']['part_name'] ?? '' }}</p>
                    
                        <p>Section Number: {{ $voter_validation[0]['voter_validation']['result']['section_no'] ?? '' }}</p>

                        <p>Last Update: {{ $voter_validation[0]['voter_validation']['result']['last_update'] ?? '' }}</p>
                        <p>SL No. in Part: {{ $voter_validation[0]['voter_validation']['result']['slno_inpart'] ?? '' }}</p>
                        <p>ID: {{ $voter_validation[0]['voter_validation']['result']['id'] ?? '' }}</p>

                        <p>Created Date/Time: {{ $voter_validation[0]['voter_validation']['result']['createdDttm'] ?? '' }}</p>
                        <p>Is Active: {{ $voter_validation[0]['voter_validation']['result']['isActive'] ? 'Yes' : 'No' }}</p>

                        <div class="disclaimer-box">
                        <h4>Disclaimer</h4>
                            <p>The above services are provided through Regtech API platform using authorized data sources. The information is for verification and compliance support only, and Regtech API assumes no liability for decisions made based on this data.</p>
                        </div>
</body> 
</html>
