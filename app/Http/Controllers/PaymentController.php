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
        //dd(request()->query());
        if(!request()->reference){
            return response()->json([
                'status' => false,
                'message' => 'Reference Not Found',
            ], 401);
        }else $reference = request()->reference;
        $payment = Payment::where('reference',$reference)->first();
        //if there's no payent or payment is already successful or the payer is not the auth user
        if(!$payment || $payment->status == 'success' || $payment->user_id != $user->id){
            if(request()->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment Completed',
                ], 401);
            }else \abort(404);
        }
        $details = $this->verifyPayment($payment);
        if(!$details['status'] || $details['trx_status'] != 'success' || $details['amount'] < $payment->payable){
            if(request()->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Payment was not successful. Please try again',
                ], 401);
            }else return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
            
        }
        // $payment->status = 'success';
        // $payment->method = $details['method'];
        // $payment->save();
        $redirect_to = $this->giveValueAfterPayment($payment);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Payment Successful',
            ], 200) :
            redirect()->to($redirect_to)->with(['result'=>1,'message'=> 'Payment Successful']);
            
    }


    public function invoice(Payment $payment){
        return view('invoice',compact('payment'));
    } 
    
    public function receipt(Payout $payout){
        return view('receipt',compact('payout'));
    }

    
}
