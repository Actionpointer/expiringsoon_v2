<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Payout;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\PayoutTrait;

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

    public function payout(Shop $shop,Request $request){
        // payout
        $user = auth()->user();
        $minThreshold = Setting::where('name','minimum_payouts')->first()->value;
        if($request->payout > $shop->wallet)
        return redirect()->back()->with(['result'=> '0','message'=> 'Insufficient Balance']);
        if($request->payout < $minThreshold)
        return redirect()->back()->with(['result'=> '0','message'=> 'Payout must be greater than threshold']);
        //log payout
        return redirect()->back()->with(['result'=> '1','message'=> 'Payout Request Successful']);
        
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
            if(cache('settings')['automatic_payout_transfer']){
                foreach($request->payouts as $req){
                    $payout = Payout::find($req);
                    $result = $this->initializePayout($payout);
                    if($result){
                        $payout->status = 'processing';
                        $payout->save();
                        return redirect()->back()->with(['result'=> '1','message'=> 'Payout Processing']);
                    }else return redirect()->back()->with(['result'=> '0','message'=> 'Something went wrong']);
                }
            }else{
                $payout = Payout::whereIn('id',$request->payouts)->update(['status'=> 'paid']);
            }
            return redirect()->back()->with(['result'=> '1','message'=> 'Payout Successful']);
        }else{
            $payout = Payout::whereIn('id',$request->payouts)->update(['status'=> 'rejected']);
            return redirect()->back()->with(['result'=> '0','message'=> 'Payout Rejected']);
        }
    }
    
    public function create()
    {
        //
    }

    
}
