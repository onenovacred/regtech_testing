<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Input</title>
</head>
<body>
    <form action="{{ route('submitForm') }}" method="POST">
        @csrf
        <label for="inputData">Enter your data:</label>
        <input type="text" id="inputData" name="inputData" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
