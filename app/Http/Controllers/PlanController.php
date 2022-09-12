<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('type','enterprise')->orderBy('id','desc')->get();
        $enterprises = $plans->keyBy('slug');
        return view('plans',compact('plans','enterprises'));
    }

    public function plans(){
        $plans = Plan::orderBy('type','desc')->get();
        return view('admin.plans.list',compact('plans','enterprises'));
    }

    public function create(){
        return view('admin.plans.create');
    }

    public function store(Request $request){
        $plan =  new Plan;
        $plan->name =  $request->name;
        $plan->description =  $request->description;
        $plan->features = $request->features;
        $plan->type = $request->type;
        $plan->products = $request->products;
        $plan->shops = $request->shops;
        $plan->months_1 = $request->months_1;
        $plan->months_3 = $request->months_3;
        $plan->months_6 = $request->months_6;
        $plan->months_12 = $request->months_12;
        $plan->save();
    }
    
    public function update(Request $request){
        $plan =  Plan::find($request->plan_id);
        $plan->name =  $request->name;
        $plan->description =  $request->description;
        $plan->features = $request->features;
        $plan->type = $request->type;
        $plan->products = $request->products;
        $plan->shops = $request->shops;
        $plan->months_1 = $request->months_1;
        $plan->months_3 = $request->months_3;
        $plan->months_6 = $request->months_6;
        $plan->months_12 = $request->months_12;
        $plan->save();
    }
     
    public function delete(Request $request){
        $plan =  Plan::find($request->plan_id);
        if($plan->subscriptions->isEmpty() && $plan->adverts->isEmpty() ){
            $plan->delete();
            return redirect()->back()->with(['result'=>1, 'message'=> 'Plan deleted successfully']);
        }
        else return redirect()->back()->with(['result'=> 0,'message'=>' Plan cannot be deleted']);
    }
    
    public function edit(Plan $plan){
        return view('admin.plans.edit');
    }

    public function show($id)
    {
        //
    }

}
