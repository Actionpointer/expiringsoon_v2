<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    use PaymentTrait,OrderTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //plans
        $user = auth()->user();
        $plans = Plan::all();
        return response()->json([
            'status' => true,
            'message' => 'Plans Retrived Successfully',
            'data' => ['plans'=> $plans,'current_plan'=> $user->subscription->plan->id ]], 200);
    }

    public function store(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'subscription_id' => 'required_without:plan|numeric',
                'plan' => 'required_without:subscription_id|string',
                'coupon_used' => 'nullable',
                'duration' => 'required|numeric',
                'auto_renew' => 'required|numeric',
                
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
                ], 401);
            }
            $user = auth()->user();
            if($request->has('subscription_id')){
                $subscription = Subscription::find($request->subscription_id);
                if($user->subscription_id && $user->subscription_id == $subscription->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                    return response()->json([
                        'status' => false,
                        'message' => 'Subscription already exist',
                    ], 401);
                }
            }
            if($request->has('plan')){
                $plan = Plan::where('slug',$request->plan)->first();
                if($user->subscription_id && $user->subscription->plan_id == $plan->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                    return response()->json([
                        'status' => false,
                        'message' => 'Subscription already exist',
                    ], 401);
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
            if(!$link){
                return response()->json([
                    'status' => false,
                    'message' => 'service unavailable right now..TRY AGAIN LATER',
                    'data' => null
                ], 200);
            }
            else{
                return response()->json([
                    'status' => true,
                    'message' => 'open link on your browser',
                    'data' => $link
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }    
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

    
}
