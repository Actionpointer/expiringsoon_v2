@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    @include('backend.settings.countries.partials.navigation')

    <!-- Gateway Configuration -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Payment Gateway Configuration</h3>
        </div>
        
        <!-- Primary Gateway Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Primary Gateway</h4>
                </div>
                <div class="card-body">
                    <form id="primaryGatewayForm" method="POST" action="{{route('admin.settings.countries.financials.gateway')}}">
                        @csrf
                        <input type="hidden" name="is_primary" value="1">
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        
                        <div class="mb-4">
                            <label class="form-label">Select Gateway</label>
                            <div class="tom-select-custom">
                                <select class="js-select form-select form-select-sm" name="gateway_id" data-hs-tom-select-options='{"placeholder": "Select gateway"}'>
                                    <option value="">None</option>
                                    @foreach($gateways as $gateway)
                                    <option value="{{$gateway->id}}" @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',true)->where('gateway_id',$gateway->id)->first()) selected @endif>{{ucwords($gateway->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Operating Mode</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="mode" id="primaryModeTest" value="test" 
                                    @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',true)->first() && $country_gateways->where('is_primary',true)->first()->mode == "test" ) checked @endif>
                                <label class="btn btn-outline-primary" for="primaryModeTest">Test Mode</label>
                                
                                <input type="radio" class="btn-check" name="mode" id="primaryModeLive" value="live"
                                    @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',true)->first() && $country_gateways->where('is_primary',true)->first()->mode == "live" ) checked @endif>
                                <label class="btn btn-outline-primary" for="primaryModeLive">Live Mode</label>
                            </div>
                            <small class="form-text text-muted">In test mode, no real transactions will be processed</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="primaryGatewayStatus"value="1" name="status" checked
                                @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',true)->first() && $country_gateways->where('is_primary',true)->first()->status) checked @endif>
                                <label class="form-check-label">Enable Primary Gateway</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Primary Gateway</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Secondary Gateway Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Secondary Gateway</h4>
                </div>
                <div class="card-body">
                    <form id="secondaryGatewayForm" method="POST" action="{{route('admin.settings.countries.financials.gateway')}}">
                        <input type="hidden" name="is_primary" value="0">
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        
                        <div class="mb-4">
                            <label class="form-label">Select Gateway</label>
                            <select class="form-select" name="gateway_id">
                                <option value="">None</option>
                                @foreach($gateways as $gateway)
                                <option value="{{$gateway->id}}" @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',false)->where('gateway_id',$gateway->id)->first()) selected @endif>{{$gateway->name}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Used as backup when primary gateway fails</small>
                        </div>
                        
                    <div class="mb-4">
                            <label class="form-label">Operating Mode</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="mode" id="secondaryModeTest" value="test"
                                @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',false)->first() && $country_gateways->where('is_primary',false)->first()->mode == "test" ) checked @endif>
                                <label class="btn btn-outline-primary" for="secondaryModeTest">Test Mode</label>
                                
                                <input type="radio" class="btn-check" name="mode" id="secondaryModeLive" value="live"
                                @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',false)->first() && $country_gateways->where('is_primary',false)->first()->mode == "live" ) checked @endif>
                                <label class="btn btn-outline-primary" for="secondaryModeLive">Live Mode</label>
                            </div>
                            <small class="form-text text-muted">In test mode, no real transactions will be processed</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="secondaryGatewayStatus" value="1" name="status"
                                @if($country_gateways->isNotEmpty() && $country_gateways->where('is_primary',false)->first() && $country_gateways->where('is_primary',false)->first()->status) checked @endif>
                                <label class="form-check-label">Enable Secondary Gateway</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Secondary Gateway</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Banking Configuration -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Banking Configuration</h3>
        </div>
        
        <!-- Banking Requirements -->
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Account Settings</h4>
                </div>
                <div class="card-body">
                    <!-- Start a single form that contains both columns -->
                    <form id="financialSettingsForm" action="{{ route('admin.settings.countries.financials.banking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        
                        <div class="row">
                            <!-- Account Settings Column -->
                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-header-title">Account Settings</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Account Format -->
                                        <div class="mb-4">
                                           
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                                    <label class="form-label">Account Number Length</label>
                                                    <input type="number" class="form-control" name="account_length" @if($country_banking) value="{{$country_banking->account_length}}" @endif min="1" max="20">
                                <small class="form-text text-muted">Number of digits in account number</small>
                            </div>
                                                
                            <div class="col-sm-6 mb-3">
                                                    <label class="form-label">Tax Rate (%)</label>
                                                    <input type="number" class="form-control" name="tax_rate" @if($country_banking) value="{{$country_banking->tax_rate}}" @endif min="0" max="100" step="0.01" placeholder="e.g. 7.5">
                                                    <small class="form-text text-muted">Leave blank to not include tax in prices and transactions</small>
                            </div>
                        </div>
                    </div>

                    <!-- Required Fields -->
                    <div class="mb-4">
                        <h5>Required Banking Fields</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireAccountName" name="banking_fields[]" value="account_name" @if($country_banking && is_array($country_banking->banking_fields) && in_array('account_name',$country_banking->banking_fields)) checked  @endif >
                                    <label class="form-check-label">Account Name</label>
                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireAccountNumber" name="banking_fields[]" value="account_number" @if($country_banking && is_array($country_banking->banking_fields) && in_array('account_number',$country_banking->banking_fields)) checked  @endif>
                                    <label class="form-check-label">Account Number</label>
                                </div>
                                                </div>
                                                <div class="col-sm-6">  
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireBankName" name="banking_fields[]" value="bank_name" @if($country_banking && is_array($country_banking->banking_fields) && in_array('bank_name',$country_banking->banking_fields)) checked  @endif>
                                    <label class="form-check-label">Bank Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requirePhoneNumber" name="banking_fields[]" value="phone_number" @if($country_banking && is_array($country_banking->banking_fields) && in_array('phone_number',$country_banking->banking_fields)) checked  @endif>
                                                        <label class="form-check-label">Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireBranchCode" name="banking_fields[]" value="branch_code" @if($country_banking && is_array($country_banking->banking_fields) && in_array('branch_code',$country_banking->banking_fields)) checked  @endif>
                                    <label class="form-check-label">Branch Code</label>
                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireSwiftCode" name="banking_fields[]" value="swift_code" @if($country_banking && is_array($country_banking->banking_fields) && in_array('swift_code',$country_banking->banking_fields)) checked  @endif>
                                    <label class="form-check-label">SWIFT Code</label>
                                </div>
                                                </div>
                                                <div class="col-sm-6">
                                <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireIban" name="banking_fields[]" value="iban" @if($country_banking && is_array($country_banking->banking_fields) && in_array('iban',$country_banking->banking_fields)) checked  @endif>
                                    <label class="form-check-label">IBAN Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireIfsc" name="banking_fields[]" value="ifsc" @if($country_banking && is_array($country_banking->banking_fields) && in_array('ifsc',$country_banking->banking_fields)) checked  @endif>
                                                        <label class="form-check-label">IFSC Code</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireRoutingNumber" name="banking_fields[]" value="routing_number" @if($country_banking && is_array($country_banking->banking_fields) && in_array('routing_number',$country_banking->banking_fields)) checked  @endif>
                                                        <label class="form-check-label">Routing Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="requireBvn" name="banking_fields[]" value="bvn" @if($country_banking && is_array($country_banking->banking_fields) && in_array('bvn',$country_banking->banking_fields)) checked  @endif>
                                                        <label class="form-check-label">BVN</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Verification Settings Column -->
                            <div class="col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-header-title">Verification & Tax Settings</h4>
                        </div>
                                    <div class="card-body">
                    <!-- Verification Requirements -->
                    <div class="mb-4">
                        <h5>Account Verification</h5>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="requireVerification" value="1" name="verification_required" @if($country_banking && $country_banking->verification_required) checked @endif>
                                <label class="form-check-label">Require Account Verification</label>
                            </div>
                            <small class="form-text text-muted">Account details will be verified with bank before activation</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Verification Method</label>
                                                <select class="form-select" name="verification_method">
                                                    <option value="gateway" @if($country_banking && $country_banking->verification_method == "gateway") selected @endif>Instant Verification (via Payment Gateway)</option>
                                                    <option value="micro_deposit" @if($country_banking && $country_banking->verification_method == "micro_deposit") selected @endif>Micro-deposit Verification</option>
                                                    <option value="manual" @if($country_banking && $country_banking->verification_method == "manual") selected @endif>Manual Verification</option>
                            </select>
                        </div>

                                            
                    </div>

                                        <div class="mb-3">
                                            <label class="form-label">Newsletter Cost per Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $country->currency_symbol }}</span>
                                                <input type="number" step="0.01" class="form-control" name="newsletter_cost"
                                                @if($country_banking) value="{{$country_banking->newsletter_cost}}" @endif 
                                                    placeholder="e.g. 0.02">
                </div>
                                            <small class="form-text text-muted">Amount to subtract from wallet for each email recipient</small>
                </div>
                    <div class="mb-4">
                                            <h5>Wallets</h5>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="freezeWallet" value="1" name="freeze_wallets" @if($country_banking && $country_banking->freeze_wallets) checked @endif>
                                                <label class="form-check-label">Freeze All Wallets</label>
                                </div>
                                            <small class="form-text text-muted">All user and store wallets will be frozen</small>
                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Single Submit Button for Both Sections -->
                        <div class="row">
                            <div class="col-12 text-center mb-4">
                                <button type="submit" class="btn btn-primary">Save All Financial Settings</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction & Withdrawal Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Transaction & Withdrawal Settings</h3>
        </div>

        <!-- Transaction Charges -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Transaction Charges</h4>
                </div>
                <div class="card-body">
                    <form id="transactionChargesForm" action="{{ route('admin.settings.countries.financials.banking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        <div class="mb-4">
                            <label class="form-label">Percentage Fee</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="transaction_charges[percentage]" 
                                    @if($country_banking && is_array($country_banking->transaction_charges) && array_key_exists('percentage',$country_banking->transaction_charges)) value="{{$country_banking->transaction_charges['percentage']}}" @endif 
                                    placeholder="e.g. 2.5" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">Charged on transaction amount</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Fixed Fee</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $country->currency_symbol }}</span>
                                <input type="number" class="form-control" name="transaction_charges[fixed]"
                                    @if($country_banking && is_array($country_banking->transaction_charges) && array_key_exists('fixed',$country_banking->transaction_charges)) value="{{$country_banking->transaction_charges['fixed']}}" @endif 
                                    placeholder="e.g. 100">
                            </div>
                            <small class="form-text text-muted">Added to percentage fee</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Cap Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $country->currency_symbol }}</span>
                                <input type="number" class="form-control" name="transaction_charges[cap]" 
                                    @if($country_banking && is_array($country_banking->transaction_charges) && array_key_exists('cap',$country_banking->transaction_charges)) value="{{$country_banking->transaction_charges['cap']}}" @endif 
                                    placeholder="e.g. 2000">
                            </div>
                            <small class="form-text text-muted">Maximum total fee charged</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Transaction Charges</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Withdrawal Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Withdrawal Settings</h4>
                </div>
                <div class="card-body">
                    <form id="withdrawalSettingsForm"action="{{ route('admin.settings.countries.financials.banking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        <!-- Withdrawal Charges -->
                        <div class="mb-4">
                            <h5>Withdrawal Charges</h5>
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" name="withdrawal_charges[percentage]" 
                                    @if($country_banking && is_array($country_banking->withdrawal_charges) && array_key_exists('percentage',$country_banking->withdrawal_charges)) value="{{$country_banking->withdrawal_charges['percentage']}}" @endif 
                                    placeholder="e.g. 1.5" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ $country->currency_symbol }}</span>
                                <input type="number" class="form-control" name="withdrawal_charges[fixed]" 
                                    @if($country_banking && is_array($country_banking->withdrawal_charges) && array_key_exists('fixed',$country_banking->withdrawal_charges)) value="{{$country_banking->withdrawal_charges['fixed']}}" @endif 
                                    placeholder="e.g. 50">
                                <span class="input-group-text">Fixed</span>
                        </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ $country->currency_symbol }}</span>
                                <input type="number" class="form-control" name="withdrawal_charges[cap]" 
                                    @if($country_banking && is_array($country_banking->withdrawal_charges) && array_key_exists('cap',$country_banking->withdrawal_charges)) value="{{$country_banking->withdrawal_charges['cap']}}" @endif 
                                    placeholder="e.g. 1000">
                                <span class="input-group-text">Cap</span>
                            </div>
                        </div>

                        <!-- Payout Type -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label">Instant Withdrawal</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="instantWithdrawal" name="instant_withdrawal" @if($country_banking && $country_banking->instant_withdrawal) checked @endif value="1">
                            </div>
                        </div>

                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label">Requires Approval</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="requiresApproval" name="requires_approval" @if($country_banking && $country_banking->requires_approval) checked @endif value="1">
                </div>
            </div>
        </div>

                        <!-- Processing Times -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label">Weekend Processing</label>
                            <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="weekendProcessing" name="weekend_processing" @if($country_banking && $country_banking->weekend_processing) checked @endif value="1">
                            </div>
                        </div>

                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label">Holiday Processing</label>
                            <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="holidayProcessing" name="holiday_processing" @if($country_banking && $country_banking->holiday_processing) checked @endif value="1">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Withdrawal Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    
</script>
@endpush