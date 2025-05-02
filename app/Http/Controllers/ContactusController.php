<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contactus;

class ContactusController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'enquireFor' => 'required|string',
            'message' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Store the contact data in the database
        Contactus::create([
            'first_name' => $request->input('fname'),
            'last_name' => $request->input('lname'),
            'email' => $request->input('email'),
            'mobile_no' => $request->input('phone'),
            'enquire_for' => $request->input('enquireFor'),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}