<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideokycController extends Controller
{
    public function videokyc_docboyzapi_initialize(Request $request){
    	$statusCode = null;
    	$hit_limits_exceeded = null;

    	 return view('kyc.video_kyc.videokyc_docboyzapi_initialize', compact('statusCode', 'hit_limits_exceeded'));
    }
}
