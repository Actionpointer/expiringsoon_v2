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
use App\Exports\PayoutsExport;
use App\Exports\PaymentsExport;
use Illuminate\Validation\Rule;
use App\Exports\SettlementsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $payments = Payment::within()->where('status','success')->paginate(10);
        return view('admin.payments.index',compact('payments'));
    }
    public function exportPayments(){
        return Excel::download(new PaymentsExport, 'payments.xlsx');
    }

    public function settlements(){
        $settlements = Settlement::within()->paginate(50);
        $min_date = $settlements->min('created_at')->format('Y-m-d');
        $max_date = $settlements->min('created_at')->format('Y-m-d');
        // dd($min_date->format('Y-m-d'));
        return view('admin.payments.settlements',compact('settlements','min_date','max_date'));
    }

    public function exportSettlements(Request $request){
        $settlements = Settlement::within();
        if($request->description && $request->description != 'all'){
            $settlements = $settlements->where('description',$request->description);
        }
        if($request->status && $request->status == 'pending'){
            $settlements = $settlements->where('status',false);
        }
        if($request->status && $request->status == 'paid'){
            $settlements = $settlements->where('status',true);
        }
        if($request->from_date){
            $settlements = $settlements->where('created_at','>=',$request->from_date);
        }
        if($request->to_date){
            $settlements = $settlements->where('created_at','<=',$request->to_date);
        }
        $settlements = $settlements->select()->get();
        return Excel::download(new SettlementsExport($settlements), 'settlements.xlsx');

    }

    public function payouts()
    {
        $payouts = Payout::within()->orderBy('created_at','desc')->paginate(10);
        return view('admin.payments.payouts',compact('payouts'));
    }
    public function exportPayouts(){
        return Excel::download(new PayoutsExport, 'payouts.xlsx');
    }

    public function update(Request $request)
    {

        if($request->action == 'pay'){
            foreach($request->payouts as $req){ 
                $payout = Payout::find($req);
                if(cache('settings')['automatic_payout']){
                    $payout->status = 'processing';
                    $payout->save();
                }else{
                    $payout->status = 'paid';
                    $payout->paid_at = now();
                    $payout->save();
                }
            }
            return redirect()->back()->with(['result'=> '1','message'=> 'Payout Processing']);
        }else{
            $payout = Payout::whereIn('id',$request->payouts)->update(['status'=> 'Rejected. '.$request->reason]);
            return redirect()->back()->with(['result'=> '1','message'=> 'Payouts Rejected']);
        }   
    }
    
    

    
}
