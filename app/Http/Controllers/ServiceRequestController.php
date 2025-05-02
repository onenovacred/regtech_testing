<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function storeService(Request $request)
    {
        $serviceRequest = ServiceRequest::create([
            'service' => $request->input('service'),
        ]);
        return response()->json(['id' => $serviceRequest->id], 201);
    }

    public function storeDetails(Request $request)
    {
        $serviceRequest = ServiceRequest::find($request->input('id'));
        if ($serviceRequest) {
            $serviceRequest->update([
                'name' => $request->input('name'),
                'mobile_number' => $request->input('mobileNumber'),
                'email' => $request->input('email'),
            ]);
            return response()->json(['message' => 'Details updated successfully.']);
        }
        return response()->json(['message' => 'Service request not found.'], 404);
    }


    public function getDetails($id)
    {
        // Find the user by ID
        $user = ServiceRequest::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }


    public function postClientMessage($id, Request $request)
{
    // Validate the incoming message
    $request->validate([
        'message' => 'required|string',
    ]);

    // Find the user by ID
    $user = ServiceRequest::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $messages = $user->messages ?? [];

    // Ensure $messages is an array
    if (!is_array($messages)) {
        $messages = [];
    }

    // Append new message to the messages array with 'client' sender
    $messages[] = [
        'message' => $request->input('message'),
        'sender' => 'client',
        'created_at' => now(),
    ];

    // Update the user's messages field
    $user->messages = $messages;
    $user->save();

    return response()->json(['message' => 'Message added successfully']);
}



public function postOwnerMessage($id, Request $request)
{
    // Validate the incoming message
    $request->validate([
        'message' => 'required|string',
    ]);

    // Find the user by ID
    $user = ServiceRequest::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $messages = $user->messages ?? [];

    // Ensure $messages is an array
    if (!is_array($messages)) {
        $messages = [];
    }

    // Append new message to the messages array with 'client' sender
    $messages[] = [
        'message' => $request->input('message'),
        'sender' => 'owner',
        'created_at' => now(),
    ];

    // Update the user's messages field
    $user->messages = $messages;
    $user->save();

    return response()->json(['message' => 'Message added successfully']);
}



public function getClientMessage($id)
    {
        // Find the user by ID
        $user = ServiceRequest::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function getOwnerMessage($id)
    {
        // Find the user by ID
        $user = ServiceRequest::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }



    public function index()
    {
        $users = ServiceRequest::all(); // Retrieve all users from the database

        return response()->json($users);
    }


}