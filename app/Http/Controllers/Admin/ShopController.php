<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Shop;

use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Requests\ShopRequest;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    use SecurityTrait;
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index(){
        $shops = Shop::all();
        return view('admin.shops.list',compact('shops'));
    }
    public function show(Shop $shop){
        return view('admin.shops.view',compact('shop'));
    }
    public function manage(Request $request){
        $shop = Shop::find($request->shop_id);
        $shop->approved = $request->approved;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Shop Status Updated']);
    }
    public function kyc(Request $request){
        $kyc = Kyc::find($request->kyc_id);
        $kyc->status = $request->status;
        $kyc->reason = $request->reason ?? null;
        $kyc->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'KYC Document updated']);

    }
    

    
}
