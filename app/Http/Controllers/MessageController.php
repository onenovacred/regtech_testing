<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
{
    $message = Message::create($request->all());

    // Optionally: Notify the recipient of the new message

    return response()->json($message, 201);
}

public function getMessages($chat_id)
{
    return response()->json(Message::where('chat_id', $chat_id)->get());
}

}