<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload File to S3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #f9f9f9, #f1f4ff);
        }

        .wrapper {
            max-width: 600px;
            margin: 60px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }

        .header {
            background: linear-gradient(135deg, #6c63ff, #a084e8);
            padding: 24px 32px;
            color: white;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .form-body {
            padding: 30px 32px;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        select,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.3s;
        }

        select:focus,
        input[type="file"]:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 5px rgba(108, 99, 255, 0.4);
            outline: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        button {
            background: linear-gradient(to right, #6c63ff, #a084e8);
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.4);
        }

        .hidden {
            display: none;
        }

        .alert-success {
            background: #e0fbe2;
            color: #1f7a4f;
            border: 1px solid #b3f2be;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="header">
        <h2>📤 Development Backup</h2>
    </div>

    <div class="form-body">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="username">👤 Select User</label>
                <select name="username" id="username" required>
                    <option value="" selected disabled>-- Choose a User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group hidden" id="file-upload-section">
                <label for="file">📎 Choose File</label>
                <input type="file" name="file" id="file" required>
                @error('file')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group hidden" id="submit-section">
                <button type="submit">🚀 Upload File</button>
            </div>
        </form>
    </div>
</div>

<script>
    const userSelect = document.getElementById('username');
    const fileSection = document.getElementById('file-upload-section');
    const submitSection = document.getElementById('submit-section');

    userSelect.addEventListener('change', () => {
        if (userSelect.value) {
            fileSection.classList.remove('hidden');
            submitSection.classList.remove('hidden');
        } else {
            fileSection.classList.add('hidden');
            submitSection.classList.add('hidden');
        }
    });
</script>

</body>
</html>
