<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Adplan;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdplansResource;
use App\Http\Resources\FeatureResource;

class FeatureController extends Controller
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
        $features = Feature::where('user_id',$user->id)->where('status',true)->get();
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Adsets retrieved Successfully','data' => FeatureResource::collection($features)], 200)
        : view('vendor.features.adsets',compact('user','features','adplans')); 
    }

    public function subscribe(Request $request){
        try{
            $features = collect([]);
            if($request->has('feature_id')){
                $feature = Feature::where('id',$request->feature_id)->get();
                $features->push($feature);
            }else{
                foreach($request->adplans as $key=>$plan){
                    $feature = Feature::create(['user_id'=> auth()->id(),'adplan_id' => $plan,'units'=> $request->units[$key],'amount'=> $request->amount[$key],'start_at'=> now(),'end_at'=> now()->addDays($request->days[$key]),'auto_renew'=> $request->auto_renew ? true:false ]);
                    $features->push($feature);
                }
            }
            $link = $this->initializePayment($features->sum('amount'),$features->pluck('id')->toArray(),'App\Models\Feature');
            if(!$link){
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
                        'data' => $link,
                    ], 200) :
                    redirect()->to($link);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function cancel_renewal(Request $request){
        $feature = Feature::find($request->feature_id);
        $feature->auto_renew = false;
        $feature->save();
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Auto renewal cancelled Successfully'], 200)
        : redirect()->back()->with(['result'=>1,'message' => 'Auto renewal cancelled Successfully']);
    }
}
