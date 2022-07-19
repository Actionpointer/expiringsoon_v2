<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Setting;
use App\Models\Category;



class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = User::whereIn('role',['admin','customercare'])->get();
        $categories = Category::all();
        $banks = Bank::all();
        $settings = Setting::all();
        return view('admin.settings',compact('banks','users','categories','settings'));
    }
    
    public function categories(){
        $categories = Category::all();
        return view('admin.categories',compact('categories'));
    }
    
    

    
    
    
    
}
