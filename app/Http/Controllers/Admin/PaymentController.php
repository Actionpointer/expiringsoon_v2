<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payout;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Exports\PayoutsExport;
use App\Exports\PaymentsExport;
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
        
        $description = 'all';
        $country_id = null;
        $sortBy = null;
        $status = null;
        $payments = Payment::within();
        if(request()->query() && request()->query('status')){
            $status = request()->query('status');
            $payments = $payments->where('status',strtolower($status));
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $payments = $payments->whereHas('user',function($quement) use($country_id){
                $quement->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('description') && request()->query('description') != 'all'){
            $description = request()->query('description');
            $item = 'App\Models\\'.$description;
            $payments = $payments->whereHas('items',function($query) use($item){
                $query->where('paymentable_type',$item);
            });
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $payments = $payments->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $payments = $payments->orderBy('created_at','desc');
            }
            
        }
        $countries = Country::all();
        if(request()->query() && request()->query('download')){
            return Excel::download(new PaymentsExport($payments->get()), 'payments.xlsx');
        }
        $payments = $payments->paginate(16);
        $min_date = $payments->total() ? $payments->min('created_at')->format('Y-m-d') : null;
        $max_date = $payments->total() ? $payments->max('created_at')->format('Y-m-d') : null;
        return view('admin.payments.index',compact('payments','min_date','max_date','countries','country_id','status','description','sortBy'));
    }

    public function settlements(){
        $description = 'all';
        $country_id = null;
        $sortBy = null;
        $status = 'all';
        $settlements = Settlement::within();
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == "paid"){
                $settlements = $settlements->where('status',true);
            }else{
                $settlements = $settlements->where('status',false);
            }
           
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $settlements = $settlements->whereHas('receiver',function($quement) use($country_id){
                $quement->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('description') && request()->query('description') != 'all'){
            $description = request()->query('description');
            $settlements = $settlements->where('description',$description);
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $settlements = $settlements->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $settlements = $settlements->orderBy('created_at','desc');
            }
            
        }
        $countries = Country::all();
        if(request()->query() && request()->query('download')){
            return Excel::download(new SettlementsExport($settlements->get()), 'settlements.xlsx');
        }
        $settlements = $settlements->paginate(16);
        $min_date = $settlements->total() ? $settlements->min('created_at')->format('Y-m-d') : null;
        $max_date = $settlements->total() ? $settlements->max('created_at')->format('Y-m-d') : null;
        return view('admin.payments.settlements',compact('settlements','min_date','max_date','countries','country_id','status','description','sortBy'));
    }

    public function payouts(){
        $receiver = null;
        $country_id = null;
        $channel = 'all';
        $status = 'all';
        $sortBy = null;
        $payouts = Payout::within();
        
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            switch($status){
                case 'paid': $payouts = $payouts->where('status','paid');
                    break;
                case 'pending': $payouts = $payouts->where('status','pending');
                    break;
                case 'approved': $payouts = $payouts->where('status','approved');
                    break;
                case 'processing': $payouts = $payouts->where('status','processing');
                    break;
                default: $payouts = $payouts->where('status','LIKE','%Rejected%');
                break;
                
            } 
        }
        if(request()->query() && request()->query('channel') && request()->query('channel') != 'all'){
            $channel = request()->query('channel');
            $payouts = $payouts->where('channel',$channel);
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $payouts = $payouts->whereHas('receiver',function($quement) use($country_id){
                $quement->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('receiver')){
            $receiver = request()->query('receiver');
            $payouts = $payouts->where(function($rec) use($receiver){
                $rec->whereHas('user',function($qshment) use($receiver){ 
                    $qshment->where('fname','LIKE',"%$receiver%")->orWhere('lname','LIKE',"%$receiver%");
                })->orWhereHas('shop',function($shver) use($receiver){
                    $shver->where('name','LIKE',"%$receiver%");
                });
            });
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $payouts = $payouts->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $payouts = $payouts->orderBy('created_at','desc');
            }
            
        }
        $countries = Country::all();
        if(request()->query() && request()->query('download')){
            return Excel::download(new PayoutsExport($payouts->get()), 'payouts.xlsx');
        }
        $payouts = $payouts->paginate(16);
        
        $min_date = $payouts->total() ? $payouts->min('created_at')->format('Y-m-d') : null;
        $max_date = $payouts->total() ? $payouts->max('created_at')->format('Y-m-d') : null;
        return view('admin.payments.payouts',compact('payouts','min_date','max_date','countries','country_id','status','receiver','channel','sortBy'));
        
    }
    
    public function update(Request $request){

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
