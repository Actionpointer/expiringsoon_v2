<?php

namespace App\Http\Controllers\Admin;


use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\CountryAdPlan;
use App\Models\CountryBanking;
use App\Models\CountryGateway;
use App\Http\Traits\SecurityTrait;
use App\Models\CountryVerification;
use App\Http\Controllers\Controller;
use App\Models\CountryNewsletterPlan;
use App\Models\CountrySubscriptionPlan;
use App\Models\Gateway;
use App\Models\VerificationProvider;

class CountryController extends Controller
{
    use SecurityTrait;
    
    public function index(){
        $countries = Country::all();
        return view('backend.settings.countries.index',compact('countries'));
    }

    public function financials($value){
        $country = Country::where('iso2',strtoupper($value))->first();
        $country_gateways = CountryGateway::where('country_id',$country->id)->get();
        $country_banking = CountryBanking::where('country_id',$country->id)->first();
        $gateways = Gateway::all();
        $fields = [
            'bank_list' => 'Bank List (Show dropdown)',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'account_name' => 'Account Name',
            'account_type' => 'Account Type',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'country_code' => 'Country Code',
            'currency' => 'Currency',
            'branch_code' => 'Branch Code',
            'swift_code' => 'SWIFT Code',
            'sort_code' => 'Sort Code',
            'bsb_code' => 'BSB Code',
            'clearing_code' => 'Clearing Code',
            'iban' => 'IBAN',
            'ifsc' => 'IFSC',
            'bvn' => 'BVN',
            'routing_number' => 'Routing Number',
            'transit_number' => 'Transit Number'
            ];
        return view('backend.settings.countries.financials',compact('country','country_gateways','country_banking','country','gateways','fields'));
    }

    public function financial_gateway_store(Request $request){
        $data = $request->validate([
            'country_id' => 'required|exists:sqlite_countries.countries,id',
            'gateway_id' => 'required|exists:gateways,id',
            'mode' => 'required|in:test,live',
            'is_primary' => 'boolean',
            'show_bank_fields' => 'boolean',
            'bank_fields' => 'nullable|array',
            'bank_fields.*' => 'string',
        ]);

        // Prepare the data for saving
        $gatewayData = [
            'country_id' => $data['country_id'],
            'gateway_id' => $data['gateway_id'],
            'mode' => $data['mode'],
            'is_primary' => $request->has('is_primary'),
            'show_bank_fields' => $request->has('show_bank_fields'),
            'bank_fields' => $request->has('bank_fields') ? json_encode($data['bank_fields']) : null,
            'status' => true, // Default to enabled
        ];

        // Check if this is an update (country_gateway_id is provided)
        if ($request->filled('country_gateway_id')) {
            $countryGateway = CountryGateway::findOrFail($request->country_gateway_id);
            $countryGateway->update($gatewayData);
            $message = 'Gateway settings updated successfully';
        } else {
            // Check if this gateway already exists for this country
            $existingGateway = CountryGateway::where('country_id', $data['country_id'])
                ->where('gateway_id', $data['gateway_id'])
                ->first();
            
            if ($existingGateway) {
                $existingGateway->update($gatewayData);
                $message = 'Gateway settings updated successfully';
            } else {
                CountryGateway::create($gatewayData);
                $message = 'Gateway added successfully';
            }
        }

        // If this gateway is set as primary, unset other primary gateways for this country
        if ($request->has('is_primary')) {
            CountryGateway::where('country_id', $data['country_id'])
                ->where('id', '!=', $request->filled('country_gateway_id') ? $request->country_gateway_id : CountryGateway::where('country_id', $data['country_id'])->where('gateway_id', $data['gateway_id'])->first()->id)
                ->update(['is_primary' => false]);
        }

        return redirect()->back()->with(['result' => 1, 'message' => $message]);
    }

    public function financial_gateway_delete(Request $request){
        $request->validate([
            'id' => 'required|exists:country_gateways,id'
        ]);
        
        $countryGateway = CountryGateway::findOrFail($request->id);
        $countryGateway->delete();
        return redirect()->back()->with(['result' => 1, 'message' => 'Gateway removed successfully']);
    }

    public function financial_banking(Request $request){
        //dd($request->all());
        CountryBanking::updateOrCreate(['country_id'=> $request->country_id],$request->except(['country_id','_token']));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Gateway settings updated successfully']);
    }

    public function subscription_plan(Country $country){
        $subscription_plan = CountrySubscriptionPlan::where('country_id',$country->id)->get();
        return view('backend.settings.countries.subscription-plans',compact('country','subscription_plan'));
    }

    public function store_subscription_plan(Request $request){
        CountrySubscriptionPlan::create($request->all());
        return redirect()->back();
    }

    public function update_subscription_plan(Request $request){
        CountrySubscriptionPlan::where('id',$request->plan_id)->update($request->except(['plan_id','_token']));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Subscription plan settings updated successfully']);
    }

    public function ad_plan(Country $country){
        $adPlans = CountryAdPlan::where('country_id',$country->id)->get();
        return view('backend.settings.countries.ad-plans',compact('country','adPlans'));
    }

    public function storeAdPlan(Request $request)
    {
        $data = $request->validate([
            'country_id' => 'required|exists:sqlite_countries.countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'nullable|string',
            'type' => 'required|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'price_cpm' => 'required|numeric',
            'price_cpc' => 'required|numeric',
            'price_fixed' => 'required|numeric',
            'placement' => 'required|string',
            'format' => 'required|string',
            'is_active' => 'boolean',
            'device_desktop' => 'boolean',
            'device_tablet' => 'boolean',
            'device_mobile' => 'boolean',
            'duration_daily' => 'boolean',
            'duration_weekly' => 'boolean',
            'duration_monthly' => 'boolean',
        ]);
        CountryAdPlan::create($data);
        return redirect()->back()->with('success', 'Ad plan created successfully.');
    }

    public function updateAdPlan(Request $request)
    {
        $plan = CountryAdPlan::findOrFail($request->plan_id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'nullable|string',
            'type' => 'required|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'price_cpm' => 'required|numeric',
            'price_cpc' => 'required|numeric',
            'price_fixed' => 'required|numeric',
            'placement' => 'required|string',
            'format' => 'required|string',
            'is_active' => 'boolean',
            'device_desktop' => 'boolean',
            'device_tablet' => 'boolean',
            'device_mobile' => 'boolean',
            'duration_daily' => 'boolean',
            'duration_weekly' => 'boolean',
            'duration_monthly' => 'boolean',
        ]);
        $plan->update($data);
        return redirect()->back()->with('success', 'Ad plan updated successfully.');
    }

    // public function newsletter_plan(Country $country){
    //     $newsletterPlans = CountryNewsletterPlan::where('country_id',$country->id)->get();
    //     return view('backend.settings.countries.newsletter-plans',compact('country','newsletterPlans'));
    // }

    public function updateNewsletterPlan(Request $request){
        $country = Country::where('iso2',strtoupper($request->country))->first();
        $country_newsletter_plan = CountryNewsletterPlan::where('country_id',$country->id)->get();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Newsletter plan settings updated successfully']);
    }


    public function verifications($value){
        $country = Country::where('iso2',strtoupper($value))->first();
        $country_verification = CountryVerification::where('country_id',$country->id)->first();
        $verification_providers = VerificationProvider::all();
        return view('backend.settings.countries.verifications',compact('country','country_verification','verification_providers'));
    }

    public function updateVerification(Request $request){
        //dd($request->all());
        $country = Country::find($request->country_id);
        $cv = CountryVerification::firstOrNew(['country_id' => $country->id]);
        $cv->verification_provider_id = $request->verification_provider_id;
        // Helper to build document array
        $buildDocs = function($docs) {
            $result = [];
            if (!$docs) return $result;
            foreach ($docs as $key => $opts) {
                if (isset($opts['enabled'])) {
                    $result[] = [
                        'key' => $key,
                        'require_file' => !empty($opts['require_file']),
                        'require_issue_date' => !empty($opts['require_issue_date']),
                        'require_expiry_date' => !empty($opts['require_expiry_date']),
                        'require_document_number' => !empty($opts['require_document_number'])
                    ];
                }
            }
            return $result;
        };

        $cv->id_requirement = $request->input('id_requirement', 'any');
        $cv->business_requirement = $request->input('business_requirement', 'any');
        $cv->address_requirement = $request->input('address_requirement', 'any');
        $cv->additional_requirement = $request->input('additional_requirement', 'any');

        $cv->id_documents = $buildDocs($request->input('id_documents', []));
        $cv->business_documents = $buildDocs($request->input('business_documents', []));
        $cv->address_documents = $buildDocs($request->input('address_documents', []));
        $cv->additional_documents = $buildDocs($request->input('additional_documents', []));

        $cv->save();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Verification settings updated successfully']);
    }
     
}
