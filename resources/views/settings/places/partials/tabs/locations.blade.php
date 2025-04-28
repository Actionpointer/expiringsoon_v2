<div class="tab-pane fade show active" id="locations">
    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="locationSearch" type="text" class="form-control" placeholder="Search locations...">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row justify-content-sm-end">
                <div class="col-sm-auto">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- States Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header-title">States</h5>
                        <span class="badge bg-soft-dark ms-2">Total: 37</span>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStateModal">
                        <i class="bi-gear"></i> Manage States
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- States List -->
            <div class="table-responsive datatable-custom">
                <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                         "order": [],
                         "pageLength": 12,
                         "isResponsive": false,
                         "isShowPaging": true
                       }'>
                    <thead class="thead-light">
                        <tr>
                            <th>State</th>
                            <th>Status</th>
                            <th>Cities</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($country->states as $state)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>{{ $state->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($state->status)
                                    <span class="badge bg-soft-success">Active</span>
                                @else
                                    <span class="badge bg-soft-danger">Inactive</span>
                                @endif
                                
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="d-block h5 mb-0">{{ $state->cities->count() }} Cities</span>
                                        <span class="d-block small text-body">{{ $country->cities->where('status',true)->count() }} Active</span>
                                    </div>
                                    
                                    <button type="button" class="btn btn-white btn-sm view_cities" data-state="{{ $state->name }}" data-bs-toggle="modal" data-bs-target="#viewCitiesModal" 
                                            data-cities="{{ $state->cities }}">
                                        <i class="bi-building"></i> View Cities
                                    </button>
                                </div>
                                
                            </td>
                            
                            
                            <td>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editStateModal" 
                                        data-state="{{$state}}">
                                    <i class="bi-pen"></i> Edit
                                </button>
                                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStateModal" 
                                        data-state="{{$state}}">
                                    <i class="bi-trash "></i> Delete
                                </button>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables for better performance with large datasets
        // $('.js-datatable').each(function () {
        //     $.HSCore.components.HSDatatables.init($(this));
        // });

        // Initialize tom-select for better UX on select boxes
        HSCore.components.HSTomSelect.init('.js-select')
        $('.view_cities').on('click', function () {
            // Get the currency data from the data-currency attribute
            const cities = $(this).data('cities');
            //loop through the cities array and create a new row for each city
            $('#stateCities').empty(); // Clear previous cities
            $.each(cities, function (index, city) {
                console.log(city);
                const stateCity = `<div class="col-sm-6 col-md-3 mb-3">
                                        <div class="card card-body">
                                            <div class="d-flex justify-content-between">
                                                <h6> ${city.name}</h6>
                                                <div>
                                                    <a href="javascript:void(0)" class="p-2 bg-info rounded edit_city" data-city_id="${JSON.stringify(city)}"> <span class="bi-pen"></span></a>
                                                    <a href="javascript:void(0)" class="p-2 bg-danger rounded delete_city" data-city="${JSON.stringify(city)}"> <span class="bi-trash"></span></a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>`;
                    $('#stateCities').append(stateCity);
            });
            // Populate the modal fields with the extracted data
            $('#viewCitiesModal .modal-title').text('Cities in ' + $(this).data('state'));
            // Show the modal
            $('#viewCitiesModal').modal('show');
        });
        $(document).on('click','.edit_city',function () {
            console.log($(this).data('city'));
            // Get the currency data from the data-currency attribute
            const city = $(this).data('city');
            // Populate the modal fields with the extracted data
            $('#editCityModal .modal-title').text('Edit City: ' + city.name);
            $('#editCityModal #cityName').val(city.name);
            $('#editCityModal #cityStatus').prop('checked', city.status);
            $('#editCityModal #cityId').val(city.id);
            // Show the modal
            $('#editCityModal').modal('show');
        });
        $(document).on('click','.delete_city',function () {
            // Get the currency data from the data-currency attribute
            const city = $(this).data('city');
            // Populate the modal fields with the extracted data
            $('#deleteCityModal .modal-title').text('Delete City: ' + city.name);
            $('#deleteCityModal #cityId').val(city.id);
            // Show the modal
            $('#deleteCityModal').modal('show');
        });
    });
</script>
@endpush 