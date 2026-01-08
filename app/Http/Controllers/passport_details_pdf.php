<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Passport Verification Details PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        p { margin: 4px 0; }
        img { max-width: 150px; }
    </style>
</head>
<body>
    <h3 class="card-title">Passport Verification Details</h3>

     <p><b>Message : {{ $passportverify['Verification_Details']['message'] }} </b></p>
                        <p><b>Message Code : {{ $passportverify['Verification_Details']['message_code'] }} </b></p>
                        <p>client_id: {{ $passportverify['Verification_Details']['data']['client_id'] }}</p>
                        <p>otp_sent: {{ $passportverify['Verification_Details']['data']['passport_number'] }}</p>
                        <p>if_number: {{ $passportverify['Verification_Details']['data']['full_name'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['dob'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['date_of_application'] }}</p>
                        <p>valid_aadhaar: {{ $passportverify['Verification_Details']['data']['file_number'] }}</p>
                                   
</body>
</html>
