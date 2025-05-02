<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usertable;

class UserController1 extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:15',
        'email' => 'required|string|email|max:255|unique:users',
    ]);

    $user = Usertable::create($request->all());

    return response()->json($user, 201);
}

public function index()
    {
        $users = Usertable::all(); // Retrieve all users from the database

        return response()->json($users);
    }


    // public function postClientMessage($id, Request $request)
    // {
    //     $request->validate([
    //         'message' => 'required|string', // Validate the incoming message
    //     ]);

    //     // Find the user by ID
    //     $user = UserTable::find($id);

    //     if (!$user) {
    //         return response()->json(['message' => 'User not found'], 404);
    //     }



    //     $messages = $user->messages ?? [];

    //     // Ensure $messages is an array
    //     if (!is_array($messages)) {
    //         $messages = [];
    //     }

    //     // Append new message to the messages array with 'client' key
    //     $messages[] = ['client' => $request->input('message')];

    //     // Update the user's messages field
    //     $user->messages = $messages;
    //     $user->save();

    //     return response()->json(['message' => 'Message added successfully']);
    // }



    public function postClientMessage($id, Request $request)
{
    // Validate the incoming message
    $request->validate([
        'message' => 'required|string',
    ]);

    // Find the user by ID
    $user = UserTable::find($id);

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
    ];

    // Update the user's messages field
    $user->messages = $messages;
    $user->save();

    return response()->json(['message' => 'Message added successfully']);
}







    // public function postOwnerMessage($id, Request $request)
    // {
    //     $request->validate([
    //         'message' => 'required|string', // Validate the incoming message
    //     ]);

    //     // Find the user by ID
    //     $user = UserTable::find($id);

    //     if (!$user) {
    //         return response()->json(['message' => 'User not found'], 404);
    //     }



    //     $messages = $user->messages ?? [];

    //     // Ensure $messages is an array
    //     if (!is_array($messages)) {
    //         $messages = [];
    //     }

    //     // Append new message to the messages array with 'client' key
    //     $messages[] = ['owner' => $request->input('message')];

    //     // Update the user's messages field
    //     $user->messages = $messages;
    //     $user->save();

    //     return response()->json(['message' => 'Message added successfully']);
    // }





    public function postOwnerMessage($id, Request $request)
    {
        // Validate the incoming message
        $request->validate([
            'message' => 'required|string',
        ]);
    
        // Find the user by ID
        $user = UserTable::find($id);
    
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
        ];
    
        // Update the user's messages field
        $user->messages = $messages;
        $user->save();
    
        return response()->json(['message' => 'Message added successfully']);
    }



    public function show($id)
    {
        // Find the user by ID
        $user = Usertable::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }


}