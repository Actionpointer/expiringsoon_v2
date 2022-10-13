<?php

namespace App\Http\Controllers;

use App\Events\DisbursePayout;
use App\Models\Bank;
use App\Models\Shop;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use Illuminate\Support\Facades\Validator;

class PayoutController extends Controller
{
    use PayoutTrait;
    public function __construct(){
        $this->middleware('auth');
    }

    //vendor
    public function index(Shop $shop)
    {
        $banks = Bank::all();
        return view('shop.payouts',compact('shop','banks'));
    }

    public function bank_info(Shop $shop,Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'bvn' => Rule::requiredIf(cache('settings')['country_iso'] =='NG'),'string','size:11',
            'branch_id' => Rule::requiredIf(cache('settings')['country_iso'] =='GH'),'string',
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

    public function payout(Shop $shop,Request $request){
        // payout
        // dd($request->all());
        $user = $shop->owner();
        if($request->amount < $shop->owner()->minimum_payout() || $request->amount > $shop->owner()->maximum_payout()){
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
    

    /** Admin */
    public function admin_index()
    {
        $payouts = Payout::orderBy('created_at','desc')->get();
        return view('admin.payouts',compact('payouts'));
    }

    public function admin_manage(Request $request)
    {
        if($request->action == 'pay'){
            foreach($request->payouts as $req){ 
                $payout = Payout::find($req);
                $payout->status = 'processing';
                $payout->save();
                event(new DisbursePayout($payout));
            }
            return redirect()->back()->with(['result'=> '1','message'=> 'Payout Processing']);
        }else{
            $payout = Payout::whereIn('id',$request->payouts)->update(['status'=> 'rejected']);
            return redirect()->back()->with(['result'=> '1','message'=> 'Payout Rejected']);
        }   
    }
    
    

    
}
