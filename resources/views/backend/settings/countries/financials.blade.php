@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    @include('backend.settings.countries.partials.navigation')

    <!-- Gateway Configuration -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Gateway Configuration</h3>
        </div>
        <div class="col-12">
            <div id="gateway-forms-list">
                @foreach($country_gateways as $cg)
                <form class="card mb-3 gateway-form" method="POST" action="{{ route('admin.settings.countries.financials.gateway.store') }}">
                    @csrf
                    <input type="hidden" name="country_id" value="{{$country->id}}">
                    <input type="hidden" name="country_gateway_id" value="{{$cg->id}}">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Select Gateway</label>
                                <select class="form-select" name="gateway_id" required>
                                    <option value="">Select Gateway</option>
                                    @foreach($gateways->sortBy('name') as $gateway)
                                    <option value="{{$gateway->id}}" @if($cg->gateway_id == $gateway->id) selected @endif>{{$gateway->display_name ?? $gateway->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Mode</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="mode" id="modeTest{{$cg->id}}" value="test" @if($cg->mode == 'test') checked @endif>
                                    <label class="btn btn-outline-primary" for="modeTest{{$cg->id}}">Test</label>
                                    <input type="radio" class="btn-check" name="mode" id="modeLive{{$cg->id}}" value="live" @if($cg->mode == 'live') checked @endif>
                                    <label class="btn btn-outline-primary" for="modeLive{{$cg->id}}">Live</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" name="is_primary" id="isPrimary{{$cg->id}}" value="1" @if($cg->is_primary) checked @endif>
                                    <label class="form-check-label" for="isPrimary{{$cg->id}}">Primary</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input show-bank-fields-toggle" name="show_bank_fields" id="showBankFields{{$cg->id}}" value="1" @if($cg->show_bank_fields) checked @endif data-target="#bankFieldsSelect{{$cg->id}}-container">
                                    <label class="form-check-label" for="showBankFields{{$cg->id}}">Show Bank Fields</label>
                                </div>
                            </div>
                            <div class="col-3 mb-3 d-flex gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                                <form method="POST" action="{{ route('admin.settings.countries.financials.gateway.delete') }}" onsubmit="return confirm('Delete this gateway?');" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $cg->id }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="row" id="bankFieldsSelect{{$cg->id}}-container" @if(!$cg->show_bank_fields) style="display:none;" @endif>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Bank Fields</label>
                                <div class="row">
                                    @php
                                    $selectedFields = is_array($cg->bank_fields) ? $cg->bank_fields : (json_decode($cg->bank_fields, true) ?: []);
                                    @endphp
                                    @foreach($fields as $key => $label)
                                    <div class="form-check col-md-2 mb-2">
                                        <input class="form-check-input" type="checkbox" name="bank_fields[]" id="{{$key}}_{{$cg->id}}" value="{{$key}}" @if(in_array($key, $selectedFields)) checked @endif>
                                        <label class="form-check-label" for="{{$key}}_{{$cg->id}}">{{$label}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
            <!-- Blank form template for new gateway addition -->
            <template id="gateway-form-template">
                <form class="card mb-3 gateway-form" method="POST" action="{{ route('admin.settings.countries.financials.gateway.store') }}">
                    @csrf
                    <input type="hidden" name="country_id" value="{{$country->id}}">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Select Gateway</label>
                                <select class="form-select" name="gateway_id" required>
                                    <option value="">Select Gateway</option>
                                    @foreach($gateways->sortBy('name') as $gateway)
                                    <option value="{{$gateway->id}}">{{$gateway->display_name ?? $gateway->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Mode</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="mode" id="modeTestNEW" value="test" checked>
                                    <label class="btn btn-outline-primary" for="modeTestNEW">Test</label>
                                    <input type="radio" class="btn-check" name="mode" id="modeLiveNEW" value="live">
                                    <label class="btn btn-outline-primary" for="modeLiveNEW">Live</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" name="is_primary" id="isPrimaryNEW" value="1">
                                    <label class="form-check-label" for="isPrimaryNEW">Primary</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input show-bank-fields-toggle" name="show_bank_fields" id="showBankFieldsNEW" value="1" data-target="#bankFieldsSelectNEW-container">
                                    <label class="form-check-label" for="showBankFieldsNEW">Show Bank Fields</label>
                                </div>
                            </div>
                            <div class="col-3 mb-3 d-flex gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-danger remove-gateway-form">Delete</button>
                            </div>
                        </div>
                        <div class="row" id="bankFieldsSelectNEW-container" style="display:none;">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Bank Fields</label>
                                <div class="row">
                                    @foreach($fields as $key => $label)
                                    <div class="form-check col-md-2 mb-2">
                                        <input class="form-check-input" type="checkbox" name="bank_fields[]" id="{{$key}}_NEW" value="{{$key}}">
                                        <label class="form-check-label" for="{{$key}}_NEW">{{$label}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
            <div class="text-end">
                <button type="button" class="btn btn-primary" id="add-gateway-form">Add New Gateway</button>
            </div>
        </div>
    </div>


    <!-- Transaction & Withdrawal Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Transaction & Withdrawal Settings</h3>
        </div>

        <!-- Transaction Charges -->
        <div class="col-lg-4 mb-4">
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
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Withdrawal Settings</h4>
                </div>
                <div class="card-body">
                    <form id="withdrawalSettingsForm" action="{{ route('admin.settings.countries.financials.banking') }}" method="POST">
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

        <!-- Withdrawal Settings -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Account Settings</h4>
                </div>
                <div class="card-body">
                    <form id="financialSettingsForm" action="{{ route('admin.settings.countries.financials.banking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="country_id" value="{{$country->id}}">
                        <div class="mb-3">
                            <label class="form-label">Account Number Length</label>
                            <input type="number" class="form-control" name="account_length" @if($country_banking) value="{{$country_banking->account_length}}" @endif min="1" max="20">
                            <small class="form-text text-muted">Number of digits in account number</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tax Rate (%)</label>
                            <input type="number" class="form-control" name="tax_rate" @if($country_banking) value="{{$country_banking->tax_rate}}" @endif min="0" max="100" step="0.01" placeholder="e.g. 7.5">
                            <small class="form-text text-muted">Leave blank to not include tax in prices and transactions</small>
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
                        
                        <div class="col-12 text-center mb-4">
                            <button type="submit" class="btn btn-primary">Save Account Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // For existing forms and dynamically added forms
        $(document).on('change', '.show-bank-fields-toggle', function() {
            var target = $(this).data('target');
            if ($(this).is(':checked')) {
                $(target).css('display', 'block');
            } else {
                $(target).css('display', 'none');
            }
        });
        // Add new gateway form
        $('#add-gateway-form').on('click', function() {
            var $template = $($('#gateway-form-template').html());
            // Remove any id collisions
            var uniq = Date.now();

            // First, update all IDs and data-targets
            $template.find('[id]').each(function() {
                var oldId = $(this).attr('id');
                var newId = oldId.replace('NEW', uniq);
                $(this).attr('id', newId);
                // Also update for="..." on labels
                $template.find('label[for="' + oldId + '"]').attr('for', newId);
            });

            // Then specifically update the data-target for the checkbox
            $template.find('.show-bank-fields-toggle').attr('data-target', '#bankFieldsSelectNEW-container'.replace('NEW', uniq));

            // Also update the container ID to match the new data-target
            $template.find('#bankFieldsSelectNEW-container').attr('id', 'bankFieldsSelectNEW-container'.replace('NEW', uniq));

            $('#gateway-forms-list').append($template);
        });
        // Remove new gateway form
        $('#gateway-forms-list').on('click', '.remove-gateway-form', function() {
            $(this).closest('.gateway-form').remove();
        });
    });
</script>
@endpush