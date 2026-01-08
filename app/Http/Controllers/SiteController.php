<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post,RegtechBlog};
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    public function home()
    {
        return view('home.services.customer_verification');
    }
    public function company()
    {
        return view('home.company');
    }
    public function careers()
    {
        return view('home.careers');
    }
    // public function contact()
    // {
    //     return view('home.contact');
    // }
    public function db_doc_collection()
    {
        return view('home.services.db_doc_collection');
    }
    public function debt_recovery()
    {
        return view('home.services.debt_recovery');
    }
    public function customer_verification()
    {
        return view('home.services.customer_verification');
    }
    public function docboyz_platform()
    {
        return view('home.services.docboyz_platform');
    }
    public function e_kyc()
    {
        return view('home.services.e_kyc');
    }
    public function bankstatementanalyser(){
        // return 'ok';
        return view('bank.page');
    }
    public function video_kyc()
    {
        return view('home.services.video_kyc');
    }
    public function e_sign()
    {
        return view('home.services.e_sign');
    }
    public function aadhar_masking()
    {
        return view('home.services.aadhar_masking');
    }
    public function db_fmatch()
    {
        return view('home.services.face_match');
    }
    public function e_nach_e_mandate()
    {
        return view('home.services.e-nach-e-mandate');
    }
    public function offline_aadhar()
    {
        return view('home.services.offline_aadhar');
    }
    public function multitenant()
    {
        return view('home.services.multitenant');
    }
    public function blog()
    {
       
        // $posts = Post::latest()->paginate(3);

        // return view('home.blog', ['posts' => $posts])
        // ->with('i', (request()->input('page', 1) - 1) * 3);
        // $blogDetails = RegtechBlog::where('id',24)->first();
        // $blogDetails = RegtechBlog::where('id',27)->first();
        $blogs = RegtechBlog::latest()->paginate(8);
        return view('home.index', compact('blogs'));
        return $blogDetails;
        return view('home.blognew',compact('blogDetails'));

    }

    public function show($id)
    {
        $blogDetails = RegtechBlog::where('id',$id)->first();
        return view('home.blognew',compact('blogDetails'));
        // $post = Post::find($id);
        // return view('home.show', compact('post'));
    }


    // public function contact(Request $request)
    // {
    //     // If request is GET -> just show the form
    //     if ($request->isMethod('get')) {
    //         return view('home.contact');
    //     }

    //     // If request is POST -> forward data to API
    //     if ($request->isMethod('post')) {
    //         $apiUrl = url('http://regtechapi.in/api/contact-us');

    //         $formData = [
    //             'name' => $request->input('full_name'),
    //             'email' => $request->input('email_id'),
    //             'mobile_number' => $request->input('phone'),
    //             'enquire_for' => $request->input('enquire_for'),
    //             'message' => $request->input('enquiry_for'),
    //         ];

    //         $response = Http::post($apiUrl, $formData);

    //         $data = $response->json();

    //         if ($response->successful() && isset($data['success']) && $data['success'] === true) {
    //             return redirect()->back()->with('success', $data['message'] ?? 'Enquiry submitted successfully!');
    //         } else {
    //             return redirect()->back()->with('error', $data['message'] ?? 'Something went wrong. Please try again.');
    //         }
    //     }
    // } 

    public function contact(Request $request)
    {
        // If request is GET -> just show the form
        if ($request->isMethod('get')) {
            return view('home.contact');
        }

        // If request is POST -> forward data to API
        if ($request->isMethod('post')) {
            $apiUrl = url('http://regtechapi.in/api/contact');

            $formData = [
                'fname' => $request->input('full_name'),
                'lname' => $request->input('full_name'),
                'email' => $request->input('email_id'),
                'phone' => $request->input('phone'),
                'enquireFor' => $request->input('enquiry_for'),
                'message' => $request->input('message'),
            ];

            $response = Http::post($apiUrl, $formData);

            $data = $response->json();

            if ($response->successful() && isset($data['success']) && $data['success'] === true) {
                return redirect()->back()->with('success', $data['message'] ?? 'Enquiry submitted successfully!');
            } else {
                return redirect()->back()->with('error', $data['message'] ?? 'Something went wrong. Please try again.');
            }
        }
    }



}
