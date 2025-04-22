<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Adplan;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\NewsletterPlan;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionPlans = Plan::all();
        $adPlans = Adplan::all();
        $newsletterPlans = NewsletterPlan::all();
        $currencies = Currency::all();
        return view('settings.plans.index',compact('subscriptionPlans','adPlans','newsletterPlans','currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
