<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;

class SubscriptionController extends Controller
{
    use PaymentTrait;
    public function __construct(){
        $this->middleware('auth')->except('plans');
    }
    
    
    public function index(){
        $plans = Plan::all();
        $user = auth()->user();
        return view('vendor.subscription',compact('plans','user'));
    }

    
    public function admin_index()
    {
        $subscriptions = Subscription::all();
        return view('admin.subscriptions',compact('subscriptions'));
    }

    
    public function store(Request $request)
    {
        if($request->has('subscription_id')){
            $subscription = Subscription::find($request->subscription_id);
        }else{
            $plan = Plan::where('slug',$request->plan)->first();
            if(auth()->user()->subscriptions->where('plan_id',$plan->id)->where('type','enterprise')->where('status',true)->where('end_at','>',now())->isNotEmpty()){
                return redirect()->back()->with(['result'=> 0,'message'=> 'Subscription already exist']);
            }
            $subscription = Subscription::create(['user_id'=> auth()->id(),'plan_id'=> $plan->id,'type'=> $plan->type,'amount'=> $plan['months_'.$request->duration],'start_at'=> now(),'end_at'=> now()->addMonths($request->duration)]);
        }
        $link = $this->initializePayment($subscription->amount,[$subscription->id,$subscription->duration]);
        if(!$link)
            return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

    public function cancel_renew(Request $request){
        $subscription = Subscription::find($request->subscription_id);
        $subscription->auto_renew = false;
        $subscription->save();
        return redirect()->back();
    }

    
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
