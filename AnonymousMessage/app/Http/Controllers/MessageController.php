<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function addMessage(User $user)
    {
     
        return view('Message::create', compact('user'));
        
    }

    public function postMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|max:255',
        ]);
       $message = Message::create([
           'user_id' => $user->id,
           'message' => $request->message
       ]);

       return redirect('/')->with('success', 'Your message was posted successfully, Its your turn to create an account and see your anonymous messages');
    }
}
