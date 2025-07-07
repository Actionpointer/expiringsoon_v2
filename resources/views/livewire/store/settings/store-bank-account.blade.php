<div class="container">
    <!-- Header Row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <!-- page header -->
                    <h2>Bank Account Details</h2>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.settings', $store) }}" class="text-inherit">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bank Account Details</li>
                        </ol>
                    </nav>
                </div>
                <!-- Save changes button -->
                <div>
                    <button type="submit" form="bankingForm" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Sidebar -->
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            @include('livewire.store.settings.sidebar',['store'=> $store])
        </div>

        <!-- Settings Content -->
        <div class="col-lg-9 col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Gateway Payout Methods Section with Accordion -->
            <div class="card border-0 shadow-sm mb-6">
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Bank Account Information</h4>
                    <p class="text-muted small mb-0">Set up payout methods for each available gateway</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="gatewayAccordion">
                        @foreach($countryGateways as $cg)
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="heading{{ $cg->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cg->id }}" aria-expanded="false" aria-controls="collapse{{ $cg->id }}">
                                        <span class="fw-bold">{{ $cg->gateway->display_name ?? $cg->gateway->name }}</span>
                                        <span class="badge bg-secondary ms-2 small">{{ ucfirst($cg->mode) }}</span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $cg->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $cg->id }}" data-bs-parent="#gatewayAccordion">
                                    <div class="accordion-body">
                                        @if($cg->show_bank_fields && $cg->bank_fields)
                                            @php
                                                $fields = is_array($cg->bank_fields) ? $cg->bank_fields : json_decode($cg->bank_fields, true);
                                            @endphp
                                            <form wire:submit.prevent="savePayoutMethodForGateway({{ $cg->id }})">
                                                @foreach($fields as $field)
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                        @if($field === 'bank_list')
                                                            @php
                                                                $bankList = $this->getBankListForGateway($cg->gateway->slug, $store->country->name);
                                                            @endphp
                                                            <select class="form-select" wire:model.defer="payoutData.{{ $cg->id }}.bank_code">
                                                                <option value="">Select Bank</option>
                                                                @foreach($bankList as $bank)
                                                                    <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control" wire:model.defer="payoutData.{{ $cg->id }}.{{ $field }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Save Payout Method</button>
                                                </div>
                                            </form>
                                        @else
                                            <div class="text-center">
                                                <button class="btn btn-primary" wire:click="connectAccount({{ $cg->id }})">
                                                    <i class="bi bi-link-45deg me-2"></i>Connect Account
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>