<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use App\Models\State;
use App\Models\Country;
use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ShipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rates(){
        
        $name = null;
        $country_id = null;
        $origin_id = null;
        $destination_id = null;
        $sortBy = null;
        $rates = Rate::within()->whereNull('shop_id');

        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $rates = $rates->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('origin_id') && request()->query('origin_id') != 'all'){
            $origin_id = request()->query('origin_id');
            $rates = $rates->where('origin_id',$origin_id);
        }
        if(request()->query() && request()->query('destination_id') && request()->query('destination_id') != 'all'){
            $destination_id = request()->query('destination_id');
            $rates = $rates->where('destination_id',$destination_id);
        }

        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $rates = $rates->where('company_name','LIKE',"%$name%");
        }

        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'amount_asc'){
                $rates = $rates->orderBy('amount','asc');
            }
            if(request()->query('sortBy') == 'amount_desc'){
                $rates = $rates->orderBy('amount','desc');
            }
        }

        $countries = Country::all();
        $states = State::within()->get();
        $rates = $rates->paginate(16);
        return view('admin.shipments.rates',compact('rates','countries','states','country_id','origin_id','destination_id','name','sortBy'));
    }

    public function store(Request $request){
        $rate = new Rate;
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->company_name = $request->company_name;
        $rate->company_email = $request->company_email;
        $rate->company_phone = $request->company_phone;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Saved']);
    }

    public function update(Request $request){
        // dd($request->all());
        $rate = Rate::find($request->rate_id);
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->company_name = $request->company_name;
        $rate->company_email = $request->company_email;
        $rate->company_phone = $request->company_phone;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Updated']);
    }
    
    public function destroy(Request $request){
        $rate = Rate::where('id',$request->rate_id)->delete();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Deleted']);
    }

    /*deliveries */
    public function index(){
        $name = null;
        $country_id = null;
        $status = null;
        $sortBy = null;
        $shipments = Shipment::within();
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $shipments = $shipments->whereHas('rate',function($query) use($country_id){
                $query->where('country_id',$country_id);});
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'delivered'){
                $shipments = $shipments->whereNotNull('delivered_at');
            }
            if($status == 'shipped'){
                $shipments = $shipments->whereNotNull('shipped_at');
            }
            if($status == 'ready'){
                $shipments = $shipments->whereNotNull('ready_at');
            }
        }

        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $shipments = $shipments->where('company_name','LIKE',"%$name%");
        }

        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'delivery_asc'){
                $shipments = $shipments->orderBy('delivered_at','asc');
            }
            if(request()->query('sortBy') == 'delivery_desc'){
                $shipments = $shipments->orderBy('delivered_at','desc');
            }
            if(request()->query('sortBy') == 'shipped_asc'){
                $shipments = $shipments->orderBy('shipped_at','asc');
            }
            if(request()->query('sortBy') == 'shipped_desc'){
                $shipments = $shipments->orderBy('shipped_at','desc');
            }
            if(request()->query('sortBy') == 'ready_asc'){
                $shipments = $shipments->orderBy('ready_at','asc');
            }
            if(request()->query('sortBy') == 'ready_desc'){
                $shipments = $shipments->orderBy('ready_at','desc');
            }
        }

        $countries = Country::all();
        $shipments = $shipments->paginate(16);
        return view('admin.shipments.index',compact('shipments','countries','status','country_id','name','sortBy'));

    }

    

    public function process(Request $request){
        //
    }
    
}

