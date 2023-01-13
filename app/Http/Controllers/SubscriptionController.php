<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Adplan;
use App\Models\Feature;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;

class SubscriptionController extends Controller
{
    use PaymentTrait,OrderTrait;

    public function __construct(){
        $this->middleware('auth')->except('plans');
    }

    public function plans()
    {
        $plans = Plan::orderBy('id','desc')->get();
        $enterprises = $plans->keyBy('slug');
        return view('plans',compact('plans','enterprises'));
    }

    public function admin_index(){
        $subscriptions = Subscription::all();
        $features = Feature::all();
        return view('admin.subscriptions',compact('subscriptions','features'));
    }

    
    public function plan_subscription(Request $request){
        $user = auth()->user();
        if($request->has('subscription_id')){
            $subscription = Subscription::find($request->subscription_id);
            if($user->subscription_id && $user->subscription_id == $subscription->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                return redirect()->back()->with(['result'=> 0,'message'=> 'Subscription already exist']);
            }
        }
        if($request->has('plan')){
            $plan = Plan::where('slug',$request->plan)->first();
            if($user->subscription_id && $user->subscription->plan_id == $plan->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                return redirect()->back()->with(['result'=> 0,'message'=> 'Subscription already exist']);
            }
            $subscription = Subscription::create(
                ['user_id'=> auth()->id(),
                'plan_id'=> $plan->id,
                'amount'=> $request->coupon_used ? $plan['months_'.$request->duration] - $this->getCoupon($request->coupon_used,$plan['months_'.$request->duration])['value'] : $plan['months_'.$request->duration],
                'start_at'=> now(),
                'renew_at'=> $this->renewal_period($request->duration),
                'end_at'=> now()->addMonths($request->duration),
                'coupon' => $request->coupon_used,
                'auto_renew'=> $request->auto_renew ? true:false
            ]);
        
        }

        $link = $this->initializePayment($subscription->amount,[$subscription->id],'App\Models\Subscription');
        if(!$link)
            return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

    public function feature_subscription(Request $request){
        $features = collect([]);
        if($request->has('feature_id')){
            $feature = Feature::where('id',$request->feature_id)->get();
            $features->push($feature);
        }else{
            foreach($request->adplans as $key=>$plan){
                $feature = Feature::create(['user_id'=> auth()->id(),'adplan_id' => $plan,'units'=> $request->units[$key],'amount'=> $request->amount[$key],'start_at'=> now(),'end_at'=> now()->addDays($request->days[$key]),'auto_renew'=> $request->auto_renew ? true:false ]);
                $features->push($feature);
            }
        }
        $link = $this->initializePayment($features->sum('amount'),$features->pluck('id')->toArray(),'App\Models\Feature');
        if(!$link)
            return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

    public function subscription_cancel_renew(Request $request){
        $subscription = Subscription::find($request->subscription_id);
        $subscription->auto_renew = false;
        $subscription->save();
        return redirect()->back();
    }

    public function renewal_period($duration){
        switch($duration){
            case '1': return now()->addMonths($duration)->subWeeks(1);
            break;
            case '3': return now()->addMonths($duration)->subWeeks(2);
            break;
            case '6': return now()->addMonths($duration)->subWeeks(3);
            break;
            case '12': return now()->addMonths($duration)->subWeeks(4);
            break;
        }
    }
    
    public function feature_cancel_renew(Request $request){
        $feature = Feature::find($request->feature_id);
        $feature->auto_renew = false;
        $feature->save();
        return redirect()->back();
    }

    
    public function destroy($id)
    {
        //
    }
}
