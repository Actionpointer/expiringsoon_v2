<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        Message::where('receiver_id',$user->id)->whereNull('order_id')->update(['is_read'=> 1]);
        $messages = Message::whereNull('order_id')->where(function ($query) use($user) {
            return $query->where('user_id',$user->id)
                         ->orWhere('receiver_id',$user->id); } )->get();
        return view('messages',compact('messages'));
    }

    public function store(Request $request)
    {
        $message = new Message;
        $message->user_id = auth()->id();
        if($request->receiver_id) $message->receiver_id = $request->receiver_id;
        $message->body = $request->body;
        $message->save();
        return redirect()->back();
    }


    public function admin_index(){
        $messages = Message::orderBy('created_at','desc')->orderBy('is_read','desc')->get()->unique('user_id');
        return view('admin.messages',compact('messages'));
    }
    public function admin_conversation(User $user){
        Message::where('user_id',$user->id)->whereNull('receiver_id')->update(['is_read'=> 1]);
        $messages = Message::whereNull('order_id')->where(function ($query) use($user) {
            return $query->where('user_id',$user->id)
                         ->orWhere('receiver_id',$user->id); } )->get();
        return view('messages',compact('messages','user'));
    }
    
}
