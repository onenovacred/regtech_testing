<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
use DB;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        // $users = User::all(); // You can limit users if needed
        // return $users;
        $users = DB::table('task_user')->get(); // You can limit users if needed
        // return $users;
        return view('upload', compact('users'));
    }

    // public function uploadFile(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|exists:users,name',
    //         'file' => 'required|file|max:10240', // max 10MB
    //     ]);

    //     $username = $request->input('username');
    //     $dateFolder = Carbon::now()->format('Y-m-d');

    //     $path = "$username/$dateFolder";
    //     $uploadedPath = Storage::disk('s3')->put($path, $request->file('file'));

    //     return back()->with('success', "File uploaded to S3 at: $uploadedPath");
    // }

       public function uploadFile(Request $request)
{
    // return 'ok';
    $request->validate([
        // 'username' => 'required|exists:users,name',
        'file' => 'required|file|max:90000',
    ]);

    $username = $request->input('username');
    $dateFolder = \Carbon\Carbon::now()->format('Y-m-d');

    $file = $request->file('file');

    // ✅ Get original file name with extension
    $originalName = $file->getClientOriginalName();

    // ✅ Optional: sanitize filename (recommended)
    $safeFileName = preg_replace('/[^A-Za-z0-9.\-_]/', '_', $originalName);

    // ✅ Upload using putFileAs
    $s3Path = "development/$username/$dateFolder";
    Storage::disk('s3')->putFileAs(
        $s3Path, // folder path
        $file,                   // file object
        $safeFileName            // use original/safe file name
    );

    return back()->with('success', "File uploaded to S3 with original name: $safeFileName");
}
}
