<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Adplan;
use App\Models\Feature;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    use PaymentTrait,OrderTrait;

    public function __construct(){
        $this->middleware('auth')->except('plans');
    }

    public function admin_index(){
        $subscriptions = Subscription::all();
        $features = Feature::all();
        return view('admin.subscriptions',compact('subscriptions','features'));
    }

    
}
