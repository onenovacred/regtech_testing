<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .error-container {
            background-color: white;
            padding: 40px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error-code {
            font-size: 75px;
            margin-bottom: 10px;
            color:rgb(128, 13, 13);
            display: flex;
            justify-content: center;
            align-items: center;

        }
        .error-message {
            margin-top: 20px;
            font-size: 30px;
            font-weight: 600;
         }
    </style>
</head>
<body>
    <div class="error-container">
        <h2 class="error-code">{{$statusCode}}</h2>
        <p class="error-message">{{$message}}.</p>
     </div>
</body>
</html>
