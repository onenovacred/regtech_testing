<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApidocController extends Controller
{
     public function index(Request $request) 
       {
            
            return view('apidocs.apidocs', compact('apidocs', 'statusCode','hit_limits_exceeded'));
        }
       
}
