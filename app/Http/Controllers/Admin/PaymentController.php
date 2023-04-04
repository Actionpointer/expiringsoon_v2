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
        $payments = Payment::within()->where('status','success')->paginate(10);
        return view('admin.payments.index',compact('payments'));
    }

    public function settlements(){
        $settlements = Settlement::within()->paginate(10);
        return view('admin.payments.settlements',compact('settlements'));
    }

    public function payouts()
    {
        $payouts = Payout::within()->orderBy('created_at','desc')->paginate(10);
        return view('admin.payments.payouts',compact('payouts'));
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
