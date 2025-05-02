<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post,RegtechBlog};

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
    public function contact()
    {
        return view('home.contact');
    }
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
        $blogDetails = RegtechBlog::where('id',24)->first();
        return view('home.blognew',compact('blogDetails'));

    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('home.show', compact('post'));
    }


}
