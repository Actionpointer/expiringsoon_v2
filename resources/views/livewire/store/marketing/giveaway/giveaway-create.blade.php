<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Create Giveaway</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Giveaways</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.giveaways', $store) }}" class="btn btn-light">Back to Giveaways</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- row -->
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Giveaway Information Card -->
                <div class="card">
                    <div class="card-header">
                        Giveaway Information
                    </div>
                    <div class="card-body p-4">
                        <!-- Select Product Variant -->
                        <div class="mb-4">
                            <label class="form-label">Select Product Variant</label>
                            @livewire('components.form.select2-single', [
                                'value' => '',
                                'options' => $allVariants,
                                'placeholder' => 'Select a product variant for this giveaway',
                                'wireModel' => 'selectedProductVariant',
                                'uniqueId' => 'product-variant-select',
                            ])
                            @error('selectedProductVariant') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Maximum per User -->
                        <div class="mb-4">
                            <label class="form-label">Maximum per User</label>
                            <input type="number" class="form-control" wire:model.live="maxPerUser" placeholder="Enter minimum 1 or leave empty for unlimited" min="1">
                            <div class="form-text">Leave empty to allow multiple entries per user</div>
                            @error('maxPerUser') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Restrict to existing customers -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="restrictToExisting" wire:model.live="onlyCustomers">
                                <label class="form-check-label" for="restrictToExisting">
                                    Restrict to existing customers
                                </label>
                            </div>
                        </div>
                        
                        <!-- Total Quantity -->
                        <div class="mb-4">
                            <label class="form-label">Total Quantity</label>
                            <input type="number" class="form-control" wire:model.live="quantity" placeholder="Enter minimum 1 or leave blank to use all available" min="1">
                            <div class="form-text">Leave blank to use all available stock</div>
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Start Date -->
                        <div class="mb-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" wire:model.live="startAt">
                            @error('startAt') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- End Date -->
                        <div class="mb-4">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" wire:model.live="endAt">
                            <div class="form-text">Leave blank for continuous giveaway</div>
                            @error('endAt') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2" wire:click="save(false)">Publish</button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="save(true)">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <!-- Giveaway Summary Card -->
                <div class="card">
                    <div class="card-header">
                        Giveaway Summary
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Details -->
                        <h6 class="mb-3">Product Details</h6>
                        @if($selectedVariantData)
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                @if($selectedVariantData['image'])
                                <img src="{{ $selectedVariantData['image'] }}" alt="{{ $selectedVariantData['product_name'] }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                                <div>
                                    <h6 class="mb-1">{{ $selectedVariantData['product_name'] }}</h6>
                                    <small class="text-muted">{{ $selectedVariantData['name'] }}</small>
                                </div>
                            </div>
                            <div class="border rounded p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Price:</span>
                                    <span class="fw-bold">{{ $currencySymbol }}{{ number_format($selectedVariantData['price'], 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Available Stock:</span>
                                    <span>{{ $selectedVariantData['stock'] }}</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-muted mb-4">No product variant selected</p>
                        @endif
                        
                        <!-- Giveaway Rules -->
                        <h6 class="mb-3">Giveaway Rules</h6>
                        <div class="summary-item mb-2">
                            <span>Maximum per User:</span>
                            <span>{{ $maxPerUser ? $maxPerUser : 'Unlimited' }}</span>
                        </div>
                        <div class="summary-item mb-4">
                            <span>Restricted to Existing Customers:</span>
                            <span>{{ $onlyCustomers ? 'Yes' : 'No' }}</span>
                        </div>
                        
                        <!-- Quantity -->
                        <h6 class="mb-3">Quantity</h6>
                        <div class="summary-item mb-4">
                            <span>Total Quantity:</span>
                            <span>{{ $quantity ? $quantity : 'All available stock' }}</span>
                        </div>
                        
                        <!-- Duration -->
                        <h6 class="mb-3">Duration</h6>
                        <div class="summary-item mb-2">
                            <span>Start Date:</span>
                            <span>{{ $startAt ? \Carbon\Carbon::parse($startAt)->format('M d, Y') : 'Not set' }}</span>
                        </div>
                        <div class="summary-item">
                            <span>End Date:</span>
                            <span>{{ $endAt ? \Carbon\Carbon::parse($endAt)->format('M d, Y') : 'Continuous' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
