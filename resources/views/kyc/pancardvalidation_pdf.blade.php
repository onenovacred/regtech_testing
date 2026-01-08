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
<body>
    <h3 class="card-title">Pancard Details</h3>

    <p><strong>Full Name:</strong> {{ isset($pancard['pancard']['data']['full_name'])?$pancard['pancard']['data']['full_name']:'null' }}</p>
    <p><strong>PAN no: </strong>{{ isset($pancard['pancard']['data']['pan_number'])?$pancard['pancard']['data']['pan_number']:'null'}}</p>
    <p><strong>Category: </strong>{{ isset($pancard['pancard']['data']['category'])?$pancard['pancard']['data']['category']:'null' }}</p>
                                   
</body>
</html>
