<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Create Sales</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Sales</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.sales', $store) }}" class="btn btn-light">Back to Sales</a>
                </div>
            </div>
        </div>
    </div>

    <!-- row -->
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Sales Information Card -->
                <div class="card">
                    <div class="card-header">
                        Sales Information
                    </div>
                    <div class="card-body p-4">
                        <!-- Select Product -->
                        <div class="mb-4">
                            <label class="form-label">Select Product</label>
                            @livewire('components.form.select2-single', [
                                    'value' => '',
                                    'options' => $allProducts,
                                    'placeholder' => 'Select a product for this sale',
                                    'wireModel' => 'selectedProduct',
                                    'uniqueId' => 'product-select',
        
                                ])
                            @error('selectedProduct') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Discount Percentage -->
                        <div class="mb-4">
                            <label class="form-label">Discount Percentage</label>
                            <input type="number" class="form-control" wire:model.live="discountPercentage" placeholder="Enter sales discount" min="0" max="100" step="0.01">
                            @error('discountPercentage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" wire:model.live="startDate">
                            @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" wire:model.live="endDate">
                            <div class="form-text">Leave blank for continuous sales</div>
                            @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Flash Sale Checkbox -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isFlashSale" wire:model.live="isFlashSale">
                                <label class="form-check-label" for="isFlashSale">
                                    Flash Sale
                                </label>
                            </div>
                        </div>

                        <!-- Flash Timeframe (Conditional) -->
                        @if($isFlashSale)
                        <div class="mb-3">
                            <h5 class="mb-3">Flash Timeframe</h5>
                            <div class="mb-3">
                                <label class="form-label">Display Every</label>
                                <div class="input-group">
                                    <input placeholder="Enter minutes" class="form-control" type="number" wire:model.live="frequencyMinutes" min="1">
                                    <span class="input-group-text">minutes</span>
                                </div>
                                @error('frequencyMinutes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display For</label>
                                <div class="input-group">
                                    <input placeholder="Enter minutes" class="form-control" type="number" wire:model.live="durationMinutes" min="1">
                                    <span class="input-group-text">minutes</span>
                                </div>
                                @error('durationMinutes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2" wire:click="save(false)">Publish</button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="save(true)">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <!-- Sales Summary Card -->
                <div class="card">
                    <div class="card-header">
                        Sales Summary
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Details -->
                        <h6 class="mb-3">Product Details</h6>
                        @if($selectedProductData)
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $selectedProductData['image'] }}" alt="{{ $selectedProductData['name'] }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-1">{{ $selectedProductData['name'] }}</h6>
                                    <small class="text-muted">{{ count($selectedProductData['variants']) }} variant(s)</small>
                                </div>
                            </div>
                            
                            <!-- Variants List -->
                            <h6 class="mb-3">Product Variants</h6>
                            @foreach($selectedProductData['variants'] as $variant)
                            <div class="border rounded p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-medium">{{ $variant['name'] }}</span>
                                    <small class="text-muted">Stock: {{ $variant['stock'] }}</small>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <small>Original Price:</small>
                                    <small>{{ $currencySymbol }}{{ number_format($variant['price'], 2) }}</small>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <small>Discount:</small>
                                    <small>{{ $discountPercentage }}%</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="fw-medium">Sale Price:</small>
                                    <small class="fw-bold text-primary">{{ $currencySymbol }}{{ number_format($variant['price'] * (1 - $discountPercentage / 100), 2) }}</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>You Save:</small>
                                    <small class="text-success">{{ $currencySymbol }}{{ number_format($variant['price'] * ($discountPercentage / 100), 2) }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted mb-4">No product selected</p>
                        @endif

                        <!-- Sales Duration -->
                        <h6 class="mb-3">Sales Duration</h6>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Start Date:</span>
                                <span>{{ $startDate ? \Carbon\Carbon::parse($startDate)->format('M d, Y h:i A') : 'Not set' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>End Date:</span>
                                <span>{{ $endDate ? \Carbon\Carbon::parse($endDate)->format('M d, Y h:i A') : 'Continuous' }}</span>
                            </div>
                        </div>

                        <!-- Flash Sale Settings (Conditional) -->
                        @if($isFlashSale)
                        <div class="mb-3">
                            <h6 class="mb-3">Flash Sale Settings</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Display Every:</span>
                                <span>{{ $frequencyMinutes ? $frequencyMinutes . ' minutes' : 'Not set' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Display For:</span>
                                <span>{{ $durationMinutes ? $durationMinutes . ' minutes' : 'Not set' }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

