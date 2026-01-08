<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>License PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        p { margin: 4px 0; }
        img { max-width: 150px; }
    </style>
</head>
<body>
    <h3>License Details N</h3>
                              
                                <p>License Number: {{ $license_validation[0]['license_validation']['response']['license_number'] }}</p>
                        
                         <p><strong>Name: </strong>{{ $license_validation[0]['license_validation']['response']['holder_name'] }}</p>
                        <p><strong>Father / Husband Name: </strong>{{ $license_validation[0]['license_validation']['response']['father_or_husband_name'] }}</p>
                        <p><strong>DOB: </strong>{{$license_validation[0]['license_validation']['response']['dob']}}</p>
                        <p><strong>Permanent Address: </strong>{{ $license_validation[0]['license_validation']['response']['permanent_address'] }}</p>
                        
                       
                       
                    
                       
                        <p><strong>Image: </strong><br><img src="{{ $license_validation[0]['license_validation']['response']['image'] }}" alt="Profile"></p>
                        <p><strong>License Verification:</strong> {{ $license_validation[0]['statusCode'] }}</p>
</body>
</html>
