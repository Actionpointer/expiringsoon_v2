<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Adplan;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    use PaymentTrait,OrderTrait;

    public function index(){
        $user = auth()->user();
        $adplans = Adplan::all();
        $features = Feature::where('user_id',$user->id)->where('status',true)->get();
        return view('vendor.features.adsets',compact('user','features','adplans'));
    }

    public function subscribe(Request $request){
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
        if(!$link)
            return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

    public function cancel_renewal(Request $request){
        $feature = Feature::find($request->feature_id);
        $feature->auto_renew = false;
        $feature->save();
        return redirect()->back();
    }
}
