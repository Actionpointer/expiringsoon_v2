<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShippingRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rate = new ShippingRate;
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $rate = ShippingRate::find($request->rate_id);
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Updated']);
    }

    
    public function destroy(Request $request)
    {
        $rate = ShippingRate::where('id',$request->rate_id)->delete();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Deleted']);
    }
}

