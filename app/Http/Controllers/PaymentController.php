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
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use PaymentTrait;
    public function __construct(){
        $this->middleware('auth');
    }
    public function callback(){
        // dd(request()->query);
        // ["trxref" => "632889cbaa15f","reference" => "632889cbaa15f"]
        //get the transaction id
        //check which payment gateway is active
        //if paystack, call paystack verify, else call flutter by trait
        if(cache('settings')['active_payment_gateway'] == 'paystack')
            $details = $this->verifyPaystackPayment(request()->query('reference'));
        else $details = $this->verifyFlutterWavePayment(request()->query('trxref'));
        dd($details);
        //receive info of payment..
        //create the payment and its paymentable (order, or subscription)
        //redirect to dashboard if vendor, to orders if user
       
    }
    public function index(){
        $payments = Payment::where('user_id',auth()->id())->get();
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

    public function topup(Request $request){
        if($url = $this->initializePayment($request->amount)){
            return redirect()->to($url);
        }else
            return redirect()->back()->with(['result'=> '0','message'=> 'Error Processing Payment']);
    }

    public function shop_index(Shop $shop){
        $settlements = Settlement::where('receiver_type','App\Models\Shop')->where('receiver_id',$shop->id)->get();
        return view('shop.payments',compact('shop','settlements'));
    }
    
    public function admin_index(){
        $payments = Payment::all();
        $settlements = Settlement::all();
        return view('admin.payments',compact('payments','settlements'));
    }
    
    


    
}
