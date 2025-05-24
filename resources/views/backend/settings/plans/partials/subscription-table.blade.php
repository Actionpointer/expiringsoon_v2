<div class="table-responsive">
    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
        <thead class="thead-light">
            <tr>
                <th>Plan Name</th>
                <th>Description</th>
                <th>Shops</th>
                <th>Products</th>
                <th>Price Config</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptionPlans as $plan)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="d-block h5 text-inherit mb-0">{{ $plan->name }}</span>
                    </div>
                </td>
                <td>{{ $plan->description }}</td>
                <td>{{ $plan->shops }} shops</td>
                <td>{{ $plan->products }} products</td>
                <td>
                    <div class="d-flex flex-column">
                        @foreach($plan->prices as $price)
                        <button type="button" 
                                class="btn btn-soft-primary btn-xs mb-1 text-start"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="editPriceConfig({{ $plan->id }}, '{{ $plan->name }}', {{ json_encode($price) }})">
                            <i class="bi-pencil me-2"></i> {{ $price->currency_code }} Configuration
                        </button>
                        @endforeach
                        <button type="button" 
                                class="btn btn-soft-info btn-xs mt-2"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="addPriceConfig({{ $plan->id }}, '{{ $plan->name }}', {{ json_encode($plan->prices->pluck('currency_code')) }})">
                            <i class="bi-plus-circle me-1"></i> Add Price
                        </button>
                    </div>
                </td>
                <td>
                    @if(!$plan->deleted_at)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" 
                                class="btn btn-white btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editSubscriptionPlanModal"
                                onclick="editSubscriptionPlan({{ $plan->id }})">
                            <i class="bi-pencil-square"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-white btn-sm"
                                data-bs-toggle="modal" 
                                data-bs-target="#deletePlanModal"
                                onclick="deletePlan('subscription', {{ $plan->id }}, '{{ $plan->name }}')">
                            <i class="bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach

            <!-- Sample Rows -->
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="d-block h5 text-inherit mb-0">Basic Plan</span>
                    </div>
                </td>
                <td>Perfect for small businesses</td>
                <td>2 shops</td>
                <td>50 products</td>
                <td>
                    <div class="d-flex flex-column">
                        <button type="button" 
                                class="btn btn-soft-primary btn-xs mb-1 text-start"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="editPriceConfig(1, 'Basic Plan', {
                                    currency_code: 'USD',
                                    minimum_payout: '100',
                                    maximum_payout: '1000',
                                    commission_percentage: '5',
                                    commission_fixed: '2.5',
                                    months_1: '9.99',
                                    months_3: '27.99',
                                    months_6: '53.99',
                                    months_12: '99.99'
                                })">
                             USD <i class="bi-gear ms-2"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-soft-primary btn-xs mb-1 text-start"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="editPriceConfig(1, 'Basic Plan', {
                                    currency_code: 'EUR',
                                    minimum_payout: '90',
                                    maximum_payout: '900',
                                    commission_percentage: '5',
                                    commission_fixed: '2',
                                    months_1: '8.99',
                                    months_3: '25.99',
                                    months_6: '49.99',
                                    months_12: '89.99'
                                })">
                             EUR <i class="bi-gear ms-2"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-soft-info btn-xs mt-2"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="addPriceConfig(1, 'Basic Plan', ['USD', 'EUR'])">
                            <i class="bi-plus-circle me-1"></i> Add Price
                        </button>
                    </div>
                </td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editSubscriptionPlanModal">
                            <i class="bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#deletePlanModal">
                            <i class="bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="d-block h5 text-inherit mb-0">Premium Plan</span>
                    </div>
                </td>
                <td>For growing businesses</td>
                <td>5 shops</td>
                <td>200 products</td>
                <td>
                    <div class="d-flex flex-column">
                        <button type="button" 
                                class="btn btn-soft-primary btn-xs mb-1 text-start"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="editPriceConfig(2, 'Premium Plan', {
                                    currency_code: 'NGN',
                                    minimum_payout: '5000',
                                    maximum_payout: '50000',
                                    commission_percentage: '7.5',
                                    commission_fixed: '100',
                                    months_1: '4999',
                                    months_3: '13999',
                                    months_6: '26999',
                                    months_12: '49999'
                                })">
                            NGN <i class="bi-gear ms-2"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-soft-info btn-xs mt-2"
                                data-bs-toggle="modal" 
                                data-bs-target="#configurePriceModal"
                                onclick="addPriceConfig(2, 'Premium Plan', ['NGN'])">
                            <i class="bi-plus-circle me-1"></i> Add Price
                        </button>
                    </div>
                </td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editSubscriptionPlanModal">
                            <i class="bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#deletePlanModal">
                            <i class="bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div> 