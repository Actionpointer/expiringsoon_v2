<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Events\DisbursePayout;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use PayoutTrait;
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $payments = Payment::where('status','success')->get();
        $settlements = Settlement::all();
        return view('admin.payments',compact('payments','settlements'));
    }

    /** Admin */
    public function payouts()
    {
        $payouts = Payout::orderBy('created_at','desc')->get();
        return view('admin.payouts',compact('payouts'));
    }

    public function update(Request $request)
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
