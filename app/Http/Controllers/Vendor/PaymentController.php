<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VendorPaymentResource;

class PaymentController extends Controller
{
    use PayoutTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    //vendor payments to us
    public function index(){
        $user = auth()->user();
        $payments = $user->payments->where('status','success');
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $payments->count() ? 'Payments retrieved Successfully':'No Payment retrieved',
            'data' => VendorPaymentResource::collection($payments),
            'count' => $payments->count()
        ], 200) : view('vendor.payments',compact('payments'));
    }
    //our payouts to shops
    public function payouts(Shop $shop){
        $banks = Bank::all();
        return view('vendor.shop.payouts',compact('shop','banks'));
    }

    public function bank_info(Shop $shop,Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'bvn' => [Rule::requiredIf(session('locale')['country_iso'] =='NG'),'string','size:11'],
            'branch_id' => [Rule::requiredIf(session('locale')['country_iso'] =='GH'),'string'],
            'bank_id' => 'required|string',
            'account_number' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $bank = Bank::find($request->bank_id);
        $result = $this->verifybankaccount($request->account_number,$bank->code,$request->bvn,$request->branch_id);
        if(!$result){
            return redirect()->back()->with(['result'=> 0,'message'=> 'Could not verify your bank account']);
        }
        if($request->account_id){
            $account = Account::find($request->account_id); 
        }else{
            $account = new Account;
            $account->shop_id = $shop->id;
        }
        $account->account_name = $result;
        $account->account_number = $request->account_number;
        $account->bank_id = $request->bank_id;
        if($request->branch_id) $account->branch_id = $request->branch_id;
        $account->status = true;
        $account->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Bank details Updated']);
    }

    public function store(Shop $shop,Request $request){
        // payout
        // dd($request->all());
        $user = $shop->user;
        if($request->amount < $shop->user->minimum_payout() || $request->amount > $shop->user->maximum_payout()){
            return redirect()->back()->with(['result'=> '0','message'=> 'Adjust payout to match minimum and maximum payout']);
        }
        if($request->amount > $shop->wallet){
            return redirect()->back()->with(['result'=> '0','message'=> 'Insufficient Balance']);
        }
        if(!$shop->bankaccount->status){
            return redirect()->back()->with(['result'=> '0','message'=> 'Re-validate your bank account']);
        }
        $payout = Payout::create(['user_id'=> $user->id,'shop_id'=> $shop->id,'account_id'=> $shop->bankaccount->id,'reference'=> uniqid(),'amount'=> $request->amount]);
        $shop->wallet -= $request->amount;
        $shop->save();
        if(cache('settings')['automatic_payout_transfer']){
            $this->initializePayout($payout);
        }
        return redirect()->back()->with(['result'=> '1','message'=> 'Payout Request Successful']);
    }

    public function payoutcallback(Request $request){
        dd($request->getContent());
        if(cache('settings')['active_payment_gateway'] == 'flutter' && request()->query('status') != 'success'){
            //delete this order, and remove the order number from the cart
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payout was not successful. Please try again']);
        }
        if(cache('settings')['active_payment_gateway'] == 'paystack'){
            $details = $this->verifyPaystackPayment(request()->query('reference'));
        }  
        else {
            $details = $this->verifyFlutterWavePayment(request()->query('tx_ref'));
        }
    }  

    public function shop_index(Shop $shop){
        $settlements = Settlement::where('receiver_type','App\Models\Shop')->where('receiver_id',$shop->id)->get();
        return view('vendor.shop.payments',compact('shop','settlements'));
    }

    public function apply(Request $request){
        $code = $request->code;
        $amount = $request->amount;
        return $this->getCoupon($code,$amount);
    }

    
}
