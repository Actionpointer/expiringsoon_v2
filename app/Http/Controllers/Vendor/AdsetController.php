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
        : view('vendor.adverts.adsets',compact('user','adsets','adplans')); 
    }

    public function subscribe(Request $request){
        dd($request->all());
        try{
            $adsets = collect([]);
            if($request->has('adset_id')){
                $adset = Adset::where('id',$request->adset_id)->get();
                $adsets->push($adset);
            }else{
                foreach($request->adplans as $key=>$plan){
                    $adset = Adset::create(['user_id'=> auth()->id(),'adplan_id' => $plan,'units'=> $request->units[$key],'amount'=> $request->amount[$key],'start_at'=> now(),'end_at'=> now()->addDays($request->days[$key]),'auto_renew'=> $request->auto_renew ? true:false ]);
                    $adsets->push($adset);
                }
            }
            $result = $this->initializePayment($adsets->sum('amount'),$adsets->pluck('id')->toArray(),'App\Models\Adset');
            if(!$result['link']){
                return request()->expectsJson() ? 
                    response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ], 401) :
                    redirect()->back()->with(['result'=> 0,'message'=> 'Something went wrong, Please try again later']);
            }else{
                return request()->expectsJson() ? 
                response()->json([
                    'status' => true,
                    'message' => 'Open payment link on browser to complete payment',
                    'data' => $result,
                ], 200) :
                redirect()->to($result['link']);
            }    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
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
