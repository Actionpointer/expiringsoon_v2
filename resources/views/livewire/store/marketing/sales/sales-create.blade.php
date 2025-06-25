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
                    <a href="{{ route('store.marketing.sales',1) }}" class="btn btn-light">Back to Sales</a>
                </div>
            </div>
        </div>
    </div>

    <!-- row -->
    <form action="#" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Giveaway Information Card -->
                <div class="card">
                    <div class="card-header">
                        Sales Information
                    </div>
                    <div class="card-body p-4">
                        <!-- Select Product -->
                        <div class="mb-4">
                            <label class="form-label">Select Product</label>
                            <div class="form-group">
                                <select class="form-select" name="product_id">
                                    <option selected>Select a product for this sales</option>
                                    <option value="1">Product A</option>
                                    <option value="2">Product B</option>
                                    <option value="3">Product C</option>
                                </select>

                            </div>
                        </div>

                        <!-- Maximum per User -->
                        <div class="mb-4">
                            <label class="form-label">Sales Price</label>
                            <input type="number" class="form-control" name="sales_price" placeholder="Enter sales price">

                        </div>

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="mm/dd/yyyy">

                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="mm/dd/yyyy">
                            <div class="form-text">Leave blank for continuous sales</div>
                        </div>

                        <!-- Restrict to existing customers -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="restrictToExisting" name="restrict_to_existing">
                                <label class="form-check-label" for="restrictToExisting">
                                    Flash Sale
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 class="mb-3">Flash Timeframe</h5>
                            <div class="mb-3"><label class="form-label">Display Every</label>
                                <div class="input-group"><input placeholder="Enter minutes" class="form-control" type="number" value=""><span class="input-group-text">minutes</span></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Display For</label>
                                <div class="input-group"><input placeholder="Enter minutes" class="form-control" type="number" value=""><span class="input-group-text">minutes</span></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Publish</button>
                            <button type="button" class="btn btn-outline-secondary">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <!-- Giveaway Summary Card -->
                <div class="card">
                    <div class="card-header">
                        Sales Summary
                    </div>
                    <div class="card-body p-4">
                        <!-- Product Details -->
                        <h6 class="mb-3">Product Details</h6>
                        <p class="text-muted mb-4">No product selected</p>

                        <!-- Giveaway Rules -->
                        <h6 class="mb-3">Sales Duration</h6>
                        <div class="mb-3">
                            <h6>Sale Duration</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Start Date:</span>
                                <span>Not set</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>End Date:</span>
                                <span>Continuous</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Flash Sale Settings</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Display Every:</span>
                                <span>Not set minutes</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Display For:</span>
                                <span>Not set minutes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
