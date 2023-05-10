<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        $messages = Message::where(function ($query) use($user) {
            return $query->where('sender_id',$user->id)
                         ->orWhere('receiver_id',$user->id); } )->get();
        return view('messages',compact('messages'));
    }

    public function store(Request $request){
        $message = Message::create(['sender_id'=> $request->sender_id,'receiver_id'=> $request->receiver_id ?? null,'body'=> $request->body]);
        return redirect()->back();
    }


    
    
}
