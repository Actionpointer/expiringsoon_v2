<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Http\Traits\PayoutTrait;
use App\Http\Traits\PaymentTrait;
use App\Models\PaymentItem;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use PaymentTrait;
    public function __construct(){
        $this->middleware('auth');
    }
    public function paymentcallback(){
        // dd(request()->query);
        // ["trxref" => "632889cbaa15f","reference" => "632889cbaa15f"]
        //check status of transaction ..if failed, 
        //flutter = request()->query('status') // successful, cancelled
        //paystack = request()->query('status') // 
        if(cache('settings')['active_payment_gateway'] == 'flutter' && request()->query('status') != 'successful'){
            //delete this order, and remove the order number from the cart
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again1']);
        }
        if(cache('settings')['active_payment_gateway'] == 'paystack'){
            $details = $this->verifyPaystackPayment(request()->query('reference'));
        }  
        else {
            $details = $this->verifyFlutterWavePayment(request()->query('tx_ref'));
        }
        if(!$this->getPaymentData('status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again2']);
        }
        if(!$this->getPaymentData('trx_status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again3']);
        }
        if(!$payment = Payment::where('reference',$this->getPaymentData('reference',$details))->first()){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again4']);
        }
        if($payment->amount != $this->getPaymentData('amount',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again5']);
        }
        foreach($this->getPaymentData('items',$details) as $item){
            PaymentItem::create(['payment_id'=> $payment->id,'paymentable_id'=> $item,'paymentable_type'=> $this->getPaymentData('type',$details)]);
        }
        $payment->status = 'success';
        $payment->save();
        return redirect()->route('home')->with(['result'=>1,'message'=> 'Payment Successful']);
       
    }

    public function status(Payment $payment){
        if(cache('settings')['active_payment_gateway'] == 'paystack'){
            $details = $this->verifyPaystackPayment($payment->reference);
        }  
        else {
            $details = $this->verifyFlutterWavePayment($payment->reference);
        }
        // dd($this->getPaymentData('method',$details));
        if(!$this->getPaymentData('status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        if(!$this->getPaymentData('trx_status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        $payment = Payment::where('reference',$this->getPaymentData('reference',$details))->first();
        if(!$payment){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        if($payment->amount != $this->getPaymentData('amount',$details)){
            return redirect('account')->with('statuss','Payment was not successful. Please try again');
        }
        foreach($this->getPaymentData('items',$details) as $item){
            PaymentItem::updateOrCreate(['payment_id'=> $payment->id,'paymentable_id'=> $item,'paymentable_type'=> $this->getPaymentData('type',$details)]);
        }
        $payment->status = 'success';
        $payment->method = $this->getPaymentData('method',$details);
        $payment->save();
        return redirect()->route('home')->with(['result'=> 1,'message'=> 'Payment Successful']);
    }
    
    
    public function index(){
        $payments = Payment::where('user_id',auth()->id())->where('status','success')->get();
        return view('payments',compact('payments'));
    }
    public function invoice(Payment $payment){
        return view('invoice',compact('payment'));
    }
    public function receipt(Settlement $settlement){
        return view('receipt',compact('settlement'));
    }

    public function verification(){
        if(!request()->query() || !request()->query('transaction_id') || !request()->query('tx_ref'))
        \abort(404);
        $trans_id = request()->query('transaction_id');
        $trans_ref = request()->query('tx_ref');
        $trans_status = request()->query('status');
        $response = $this->verifyPayment($trans_id);
        // dd($response);
        $payment = Payment::where('reference',$trans_ref)->first();
        if($trans_status == 'successful' && $response->status == 'success' && $payment && $response && $payment->reference == $response->data->tx_ref  && $response->data->currency == $payment->currency && $response->data->amount >= $payment->amount){
            $payment->method = $response->data->payment_type;
            $payment->status = 'success';
            $payment->save();
        }else{
            $payment->status = 'failed';
            $payment->save();
        }
        // else mark payment failed
        return redirect()->route('payment.status',$payment);
    }

    public function accountNumberResolve(Request $request){
        $bank = Bank::find($request->bank_id);
        $response = $this->resolveBankAccount($bank->code,$request->account_number);
        return response()->json($response,200);
    }

    // public function topup(Request $request){
    //     if($url = $this->initializePayment($request->amount)){
    //         return redirect()->to($url);
    //     }else
    //         return redirect()->back()->with(['result'=> '0','message'=> 'Error Processing Payment']);
    // }

    public function shop_index(Shop $shop){
        $settlements = Settlement::where('receiver_type','App\Models\Shop')->where('receiver_id',$shop->id)->get();
        return view('shop.payments',compact('shop','settlements'));
    }
    
    public function admin_index(){
        $payments = Payment::where('status','success')->get();
        $settlements = Settlement::all();
        return view('admin.payments',compact('payments','settlements'));
    }
    
    


    
}
