<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Create Coupon</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Coupon</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.coupons', $store) }}" class="btn btn-light">Back to Coupons</a>
                </div>
            </div>
        </div>
    </div>

    <!-- row -->
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Coupon Information Card -->
                <div class="card">
                    <div class="card-header">
                        Coupon Information
                    </div>
                    <div class="card-body p-4">
                        <!-- Coupon Name -->
                        <div class="mb-4">
                            <label class="form-label">Coupon Name</label>
                            <input type="text" class="form-control" wire:model.live="name" placeholder="Enter coupon name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Coupon Code</label>
                                <input type="text" class="form-control" wire:model.live="code" placeholder="Enter coupon code">
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Coupon Quantity</label>
                                <input type="number" class="form-control" wire:model.live="quantity" placeholder="Enter Quantity" min="1">
                                @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Coupon Description</label>
                            <textarea class="form-control" wire:model.live="description" placeholder="Enter coupon description" rows="3"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Coupon Type and Value -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Coupon Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model.live="isPercentage" id="percentage" value="1">
                                    <label class="form-check-label" for="percentage">
                                        Percentage Discount
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model.live="isPercentage" id="fixed" value="0">
                                    <label class="form-check-label" for="fixed">
                                        Fixed Amount
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Value</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" wire:model.live="value" placeholder="Enter value" min="0" step="0.01">
                                    <span class="input-group-text">{{ $isPercentage ? '%' : $currencySymbol }}</span>
                                </div>
                                @error('value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Start and End Date -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" wire:model.live="startDate">
                                @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" wire:model.live="endDate">
                                <div class="form-text">Leave blank for no expiry</div>
                                @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
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
                <!-- Coupon Limits Card -->
                <div class="card">
                    <div class="card-header">
                        Coupon Limits & Restrictions
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Limits -->
                        <h6 class="mb-3">Product Limits</h6>
                        <div class="mb-4">      
                            <div class="form-group">
                                @livewire('components.form.select2-multiple', [
                                    'value' => [],
                                    'options' => $allProducts,
                                    'placeholder' => 'Select products for this coupon (optional)',
                                    'wireModel' => 'selectedProducts',
                                    'uniqueId' => 'products-select',
                                ])
                                <div class="form-text">Leave empty to apply to all products</div>
                            </div>
                        </div>

                        <!-- Coupon Usage Limits -->
                        <h6 class="mb-3">Coupon Usage Limits</h6>
                        <div class="mb-4">
                            <label class="form-label">Number of uses per user</label>
                            <input type="number" class="form-control" wire:model.live="limitPerUser" placeholder="Enter number of uses per user" min="1">
                            <div class="form-text">Leave empty for unlimited uses per user</div>
                            @error('limitPerUser') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                         
                        <!-- Order Limits -->
                        <h6 class="mb-3">Order Limits</h6>
                        <div class="mb-4">
                            <label class="form-label">Minimum order amount</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $currencySymbol }}</span>
                                <input type="number" class="form-control" wire:model.live="minimumSpend" placeholder="Enter minimum order amount" min="0" step="0.01">
                            </div>
                            <div class="form-text">Leave empty for no minimum</div>
                            @error('minimumSpend') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Maximum discount cap</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $currencySymbol }}</span>
                                <input type="number" class="form-control" wire:model.live="cap" placeholder="Enter maximum discount cap" min="0" step="0.01">
                            </div>
                            <div class="form-text">Leave empty for no cap (applies to percentage discounts)</div>
                            @error('cap') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Coupon Summary Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        Coupon Summary
                    </div>
                    <div class="card-body p-4">
                        <div class="summary-item mb-2">
                            <span>Coupon Name:</span>
                            <span>{{ $name ?: 'Not set' }}</span>
                        </div>
                        <div class="summary-item mb-2">
                            <span>Code:</span>
                            <span class="fw-bold">{{ strtoupper($code) ?: 'Not set' }}</span>
                        </div>
                        <div class="summary-item mb-2">
                            <span>Type:</span>
                            <span>{{ $isPercentage ? 'Percentage Discount' : 'Fixed Amount' }}</span>
                        </div>
                        <div class="summary-item mb-2">
                            <span>Value:</span>
                            <span class="fw-bold text-primary">
                                {{ $value ? ($isPercentage ? $value . '%' : $currencySymbol . number_format($value, 2)) : 'Not set' }}
                            </span>
                        </div>
                        <div class="summary-item mb-2">
                            <span>Quantity:</span>
                            <span>{{ $quantity ?: 'Not set' }}</span>
                        </div>
                        <div class="summary-item mb-2">
                            <span>Duration:</span>
                            <span>
                                {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('M d, Y') : 'Not set' }} - 
                                {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('M d, Y') : 'No expiry' }}
                            </span>
                        </div>
                        @if($minimumSpend)
                        <div class="summary-item mb-2">
                            <span>Min. Order:</span>
                            <span>{{ $currencySymbol }}{{ number_format($minimumSpend, 2) }}</span>
                        </div>
                        @endif
                        @if($cap && $isPercentage)
                        <div class="summary-item mb-2">
                            <span>Max. Discount:</span>
                            <span>{{ $currencySymbol }}{{ number_format($cap, 2) }}</span>
                        </div>
                        @endif
                        @if($limitPerUser)
                        <div class="summary-item mb-2">
                            <span>Uses per User:</span>
                            <span>{{ $limitPerUser }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> 