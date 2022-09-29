<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\State;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function index()
    {
        // return 'ok';
       \App\Jobs\SubscriptionRenewalJob::dispatch();
       return 'ok';
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
    
}
