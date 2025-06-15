<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Adplan;
use App\Models\Adset;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdplansResource;
use App\Http\Resources\AdsetResource;

class AdsetController extends Controller
{
    use PaymentTrait,OrderTrait;

    public function plans(){
        $adplans = Adplan::all();
        return response()->json([
            'status' => true,
            'message' => 'Adplans retrieved Successfully',
            'data' => AdplansResource::collection($adplans),
        ], 200);
    }
    
    public function index(){
        $user = auth()->user();
        $adplans = Adplan::all();
        $adsets = Adset::where('user_id',$user->id)->where('status',true)->get();
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Adsets retrieved Successfully','data' => AdsetResource::collection($adsets)], 200)
        : view('vendor.adsets.list',compact('user','adsets','adplans')); 
    }

    public function create(){
        $adplans = Adplan::all();
        $user = auth()->user();
        return view('vendor.adsets.create',compact('adplans','user'));
    }

    public function subscribe(Request $request){
        try{
            $adsets = collect([]);
            // dd($request->all());
            if($request->has('adset_id')){
                $adset = Adset::find($request->adset_id);
                $adsets->push($adset);
            }else{
                foreach($request->adplans as $key=>$plan){
                    $adset = Adset::create(['user_id'=> auth()->id(),'adplan_id' => $plan,'units'=> $request->units[$key],'amount'=> $request->days[$key] * $request->units[$key] * $request->price[$key],'start_at'=> now(),'end_at'=> now()->addDays($request->days[$key]),'auto_renew'=> $request->auto_renew ? true:false ]);
                    $adsets->push($adset);
                }
            }
            $result = $this->initializePayment($adsets->sum('amount'),$adsets->pluck('id')->toArray(),'App\Models\Adset',$request->coupon_used);
            
            if(!$result['link']){
                return redirect()->back()->with(['result'=> 0,'message'=> 'Something went wrong, Please try again later']);
            }else{
                return redirect()->to($result['link']);
            }    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        $adsets = collect([]);
        foreach($request->adsets as $plan){
            if($plan['days']){
                $adplan = Adplan::find($plan['id']);
                $adset = Adset::create(['user_id'=> auth()->id(),'adplan_id' => $plan['id'],'units'=> $plan['units'],
                'amount'=> $adplan->price_per_day * $plan['units'] * $plan['days'],'start_at'=> now(),'end_at'=> now()->addDays($plan['days']),
                'auto_renew'=> $request->auto_renew ? true:false ]);
                $adsets->push($adset);
            }  
        }
        $result = $this->initializePayment($adsets->sum('amount'),$adsets->pluck('id')->toArray(),'App\Models\Adset',$request->coupon_used);
        if(!$result['link']){
            return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ], 401);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Open payment link on browser to complete payment',
                'data' => $result,
            ], 200);
        }
    }

    public function cancel_renewal(Request $request){
        $adset = Adset::find($request->adset_id);
        $adset->auto_renew = false;
        $adset->save();
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Auto renewal cancelled Successfully'], 200)
        : redirect()->back()->with(['result'=>1,'message' => 'Auto renewal cancelled Successfully']);
    }
}
