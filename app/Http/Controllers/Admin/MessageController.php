<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        $messages = Message::whereHas('sender',function ($query){$query->whereIn('role',['vendor','shopper']);})->orderBy('created_at','desc')->orderBy('read_at','desc')->get()->unique('sender_id');
        // dd($messages);
        return view('admin.messages',compact('messages'));
    }
    public function show(User $user){
        Message::where('sender_id',$user->id)->update(['read_at'=> now()]);
        $messages = Message::where(function ($query) use($user) {
            return $query->where('sender_id',$user->id)
                         ->orWhere('receiver_id',$user->id); } )->get();
        return view('messages',compact('messages','user'));
    }

    public function admin_index(){
        $messages = Message::whereHas('sender',function ($query){$query->whereIn('role',['vendor','shopper']);})->orderBy('created_at','desc')->orderBy('read_at','desc')->get()->unique('sender_id');
        // dd($messages);
        return view('admin.messages',compact('messages'));
    }
    public function admin_conversation(User $user){
        Message::where('sender_id',$user->id)->update(['read_at'=> now()]);
        $messages = Message::where(function ($query) use($user) {
            return $query->where('sender_id',$user->id)
                         ->orWhere('receiver_id',$user->id); } )->get();
        return view('messages',compact('messages','user'));
    }
    
}
