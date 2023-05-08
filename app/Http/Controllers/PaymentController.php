<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payout;
use App\Models\Adset;
use App\Models\Payment;
use App\Models\OrderStatus;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;

class PaymentController extends Controller
{
    use PaymentTrait;
    
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function paymentcallback(){        
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        if(request()->expectsJson()){
            if(!request()->reference){
                return response()->json([
                    'status' => false,
                    'message' => 'Reference Not Found',
                ], 401);
            }else $reference = request()->reference;
        }
        else{
            if(!request()->query()){
                \abort(404);
            }else {
                switch($gateway){
                    case 'paystack': 
                        if(!request()->query('reference')) \abort(404);
                        if(request()->query('status') != 'success') {
                            
                            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
                        
                        }
                        $reference = request()->query('reference');
                    break;
                    case 'flutterwave':
                        if(!request()->query('tx_ref')) \abort(404);
                        if(request()->query('status') != 'successful') return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
                        $reference = request()->query('tx_ref');
                    break;
                    case 'paypal': 
                        if(!request()->query('token')) \abort(404);
                        if(request()->query('status') != 'success') return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
                        $reference = request()->query('token');
                    break;
                    case 'stripe': 
                    break;
                }
            }
        } 
        // dd($reference);
        $payment = Payment::where('reference',$reference)->first();
        //if payment was already successful before now
        if(!$payment || $payment->status == 'success' || $payment->user_id != $user->id){
            if(request()->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment Completed',
                ], 401);
            }else \abort(404);
        }
        $details = $this->verifyPayment($payment);
        if(!$details['status'] || $details['trx_status'] != 'success' || $details['amount'] < $payment->amount){
            if(request()->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment was not successful. Please try again',
                ], 401);
            }else return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
            
        }
        $payment->status = 'success';
        $payment->method = $details['method'];
        $payment->save();
        $this->giveValueAfterPayment($payment);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Payment Successful',
            ], 200) :
            redirect()->route('home')->with(['result'=>1,'message'=> 'Payment Successful']);
       
    }

    public function giveValueAfterPayment(Payment $payment){
        if($payment->status){
            foreach($payment->items as $item){
                if($item->paymentable_type == 'App\Models\Order'){
                    $order = Order::find($item->paymentable_id);
                    // OrderStatus::create(['order_id'=> $item->paymentable_id,'user_id'=> $payment->user_id,'name'=> 'processing']);
                    $status = $order->statuses()->create(['user_id'=> $payment->user_id,'name'=> 'processing']);
                }
                if($item->paymentable_type == 'App\Models\Adset'){
                    $adset = Adset::find($item->paymentable_id);
                    $adset->status = true;
                    $adset->save();
                }
                if($item->paymentable_type == 'App\Models\Subscription'){
                    $subscription = Subscription::find($item->paymentable_id);
                    $duration = $subscription->end_at->diffInMonths($subscription->start_at);
                    $renew_at = null;
                    switch($duration){
                        case '1': $renew_at =  now()->addMonths($duration)->subWeeks(1);
                        break;
                        case '3': $renew_at = now()->addMonths($duration)->subWeeks(2);
                        break;
                        case '6': $renew_at = now()->addMonths($duration)->subWeeks(3);
                        break;
                        case '12': $renew_at = now()->addMonths($duration)->subWeeks(4);
                        break;
                    }
                    $subscription->status = true;
                    $subscription->start_at = now();
                    $subscription->renew_at = $renew_at;
                    $subscription->end_at = now()->addMonths($duration);
                    $subscription->save();
                    $subscription->user->save();
                    Subscription::where('user_id',$payment->user->id)->whereNull('end_at')->delete();
                }
            }
        }
        
    }

    public function invoice(Payment $payment){
        return view('invoice',compact('payment'));
    }
    
    
    public function receipt(Payout $payout){
        return view('receipt',compact('payout'));
    }

    public function payoutcallback(){
        
    }

    
    
    
    
    


    
}
