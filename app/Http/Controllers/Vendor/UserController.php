<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $user = auth()->user(); 
        return view('vendor.dashboard',compact('user'));
    }

    

    public function notifications(){
        
    }

    public function verification(){
        $user = auth()->user(); 
        return view('vendor.verification',compact('user'));
    }


}
