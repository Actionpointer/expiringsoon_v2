<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\Adplan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
   
    //list it to the vendor to buy
    public function plan_index()
    {
        $plans = Plan::orderBy('id','desc')->get();
        $enterprises = $plans->keyBy('slug');
        return view('plans',compact('plans','enterprises'));
    }
    
    public function adplan_index(){
        $user = auth()->user();
        $adplans = Adplan::all();
        return view('vendor.adsets',compact('user','adplans'));
    }
    
    


}
