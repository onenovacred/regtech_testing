<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Masked Aadhaar</title>

    <style>
        body { font-family: sans-serif; }
        img { width: 100%; max-width: 600px; }
    </style>
</head>
<body>

<h2>Masked Aadhaar</h2>

@if(!empty($tempImagePath))
    <img src="{{ $tempImagePath }}">
@else
    <p>No image available</p>
@endif

</body>
</html>
