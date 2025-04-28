<!-- State Modals -->
<div class="modal fade" id="addStateModal" tabindex="-1" aria-labelledby="addStateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.state') }}" method="post">@csrf
            <input type="hidden" name="country_id" value="{{ $country->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStateModalLabel">Add New State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        <div class="mb-4">
                            <label class="form-label">State</label>
                            <input name="name" class="form-control" placeholder="Name of state" required>
                        </div>
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" value="1" class="form-check-input" id="stateStatus" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"> <span id="state_action">Add</span> State</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editStateModal" tabindex="-1" aria-labelledby="editStateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.state') }}" method="post">@csrf
            <input type="hidden" name="state_id" value="">
            <input type="hidden" name="action" value="update">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStateModalLabel">Edit <span class="state_label"></span> State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        <div class="mb-4">
                            <label class="form-label">State</label>
                            <input name="name" class="form-control state_name" placeholder="Name of state" required>
                        </div>
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" value="1" class="form-check-input" id="stateStatus" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"> Update <span class="state_label"></span> State</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteStateModal" tabindex="-1" aria-labelledby="deleteStateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.state') }}" method="post">@csrf
            <input type="hidden" name="state_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteStateModalLabel">Delete <span class="state_label"></span> State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <p>Are you sure you want to delete <span class="state_label"></span> state?</p>
                    <p>This action cannot be undone.</p>
                    <input type="hidden" name="action" value="delete">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete <span class="state_label"></span> State</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="viewCitiesModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCityModal">Add New</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
            </div>
            <div class="modal-body">
                
                <div class="row" id="stateCities">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.city') }}" method="post">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCityModalLabel">Add New City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">        
                    <div class="mb-4">
                        <label class="form-label">City Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter city name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">State</label>
                        <select class="form-select" name="state_id">
                            <option value="" selected>Select State</option>
                            @foreach ($country->states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>         
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="status" value="1" class="form-check-input" id="cityStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add City</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.city') }}" method="post">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCityModalLabel">Edit <span class="city_label"></span> City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">        
                    <div class="mb-4">
                        <label class="form-label">City Name</label>
                        <input type="text" name="name" class="form-control city_name" placeholder="Enter city name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">State</label>
                        <select class="form-select" name="state_id">
                            <option value="" selected>Select State</option>
                            @foreach ($country->states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>         
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="status" value="1" class="form-check-input" id="cityStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update <span class="city_label"></span> City</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteCityModal" tabindex="-1" aria-labelledby="deleteCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.settings.places.city') }}" method="post">@csrf
            <input type="hidden" name="city_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCityModalLabel">Delete <span class="city_label"></span> City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <p>Are you sure you want to delete <span class="city_label"></span> city?</p>
                    <p>This action cannot be undone.</p>
                    <input type="hidden" name="action" value="delete">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete <span class="city_label"></span> City</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bank Modals -->
<div class="modal fade" id="addBankModal" tabindex="-1" aria-labelledby="addBankModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBankModalLabel">Add New Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control" placeholder="Enter bank name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Bank Code</label>
                        <input type="text" class="form-control" placeholder="e.g. 044">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Account Number Format</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="Length (e.g. 10)">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Prefix (e.g. 0,1,2)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Gateway Support</label>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="paystackSupport">
                            <label class="form-check-label">Paystack</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="flutterwaveSupport">
                            <label class="form-check-label">Flutterwave</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="bankStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Bank</button>
            </div>
        </div>
    </div>
</div>

<!-- Verification Method Modal -->
<div class="modal fade" id="addVerificationModal" tabindex="-1" aria-labelledby="addVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVerificationModalLabel">Add Verification Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Method Name</label>
                        <input type="text" class="form-control" placeholder="e.g. BVN">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" placeholder="e.g. Bank Verification Number">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Required Fields</label>
                        <input type="text" class="form-control mb-2" placeholder="Field name">
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            <i class="bi-plus"></i> Add Field
                        </button>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Priority</label>
                        <input type="number" class="form-control" min="1" value="1">
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="verificationMethodStatus" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add Method</button>
            </div>
        </div>
    </div>
</div> 