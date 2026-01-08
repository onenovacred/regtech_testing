<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload New Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-6">

    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md text-center border border-indigo-100">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6">🚀 Update Website Landing Page</h1>
        <p class="text-gray-500 mb-8">Upload your new <code>index.html</code> file to replace the current landing page.</p>

        <!-- Upload Form -->
        <form action="{{ route('upload.site') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex flex-col items-center">
                <label class="block text-gray-600 font-semibold mb-2">Choose index.html File</label>

                <input 
                    type="file" 
                    name="indexFile" 
                    accept=".html"
                    required
                    class="block w-full text-sm text-gray-700 border border-indigo-300 rounded-lg cursor-pointer bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-2"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition duration-200 ease-in-out">
                ⬆️ Upload & Replace
            </button>
        </form>

        <!-- Success / Error Messages -->
        @if (session('success'))
            <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Optional footer -->
        <p class="mt-10 text-xs text-gray-400">Managed by RegTech Admin • {{ date('Y') }}</p>
    </div>

</body>
</html>
