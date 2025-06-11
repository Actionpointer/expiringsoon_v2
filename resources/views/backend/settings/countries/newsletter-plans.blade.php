@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    

    @include('backend.settings.countries.partials.navigation')

    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="search" type="text" class="form-control" placeholder="Search newsletters...">
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

    

    <!-- Tabs -->
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <h5 class="card-header-title">Newsletter Plans</h5>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsletterPlanModal">
                        <i class="bi-plus me-1"></i> Add Credit Package
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Package Name</th>
                        <th>Credits</th>
                        <th>Bonus</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sampleNewsletterPlans = [
                        [
                            'id' => 1,
                            'name' => 'Starter',
                            'description' => 'Perfect for new businesses just getting started with email marketing',
                            'credits' => 1000,
                            'bonus_credits' => 0,
                            'validity_days' => 365,
                            'price' => 19.99,
                            'discount_percentage' => 0,
                            'is_active' => true
                        ],
                        [
                            'id' => 2,
                            'name' => 'Business',
                            'description' => 'Great for established businesses with a regular email schedule',
                            'credits' => 5000,
                            'bonus_credits' => 500,
                            'validity_days' => 365,
                            'price' => 89.99,
                            'discount_percentage' => 10,
                            'is_active' => true
                        ],
                        [
                            'id' => 3,
                            'name' => 'Enterprise',
                            'description' => 'For large companies with extensive email marketing needs',
                            'credits' => 20000,
                            'bonus_credits' => 3000,
                            'validity_days' => 365,
                            'price' => 299.99,
                            'discount_percentage' => 20,
                            'is_active' => true
                        ],
                        [
                            'id' => 4,
                            'name' => 'Seasonal Boost',
                            'description' => 'Limited time offer for holiday marketing campaigns',
                            'credits' => 10000,
                            'bonus_credits' => 2000,
                            'validity_days' => 90,
                            'price' => 149.99,
                            'discount_percentage' => 25,
                            'is_active' => false
                        ]
                    ];
                    @endphp

                    @foreach($sampleNewsletterPlans as $plan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="d-block h5 text-inherit mb-0">{{ $plan['name'] }}</span>
                            </div>
                            <span class="fs-6 text-body">{{ $plan['description'] }}</span>
                        </td>
                        <td>
                            <span class="fw-bold">{{ number_format($plan['credits']) }}</span>
                        </td>
                        <td>
                            @if($plan['bonus_credits'] > 0)
                                <span class="badge bg-soft-success">+{{ number_format($plan['bonus_credits']) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            {{ $plan['validity_days'] }} days
                        </td>
                        
                        <td>
                            @if($plan['is_active'])
                                <span class="badge bg-soft-success">Active</span>
                            @else
                                <span class="badge bg-soft-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold">{{ $country->currency_symbol }}{{ $plan['price'] }}</span>
                                @if($plan['discount_percentage'] > 0)
                                    <span class="badge bg-soft-danger">{{ $plan['discount_percentage'] }}% off</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editNewsletterPlanModal"
                                    data-plan-id="{{ $plan['id'] }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePlanModal"
                                    data-plan-type="newsletter"
                                    data-plan-id="{{ $plan['id'] }}"
                                    data-plan-name="{{ $plan['name'] }}">
                                    <i class="bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Tab Content -->

</div>

<!-- Include Modals -->
@include('backend.settings.countries.partials.modals')

@endsection

@push('scripts')
<script>
    // This fixes the linter errors by ensuring the onclick handlers are properly formatted
    document.addEventListener('DOMContentLoaded', function() {
        // Event handlers for the edit buttons
        document.querySelectorAll('[data-bs-target="#editNewsletterPlanModal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const planId = this.getAttribute('data-plan-id');
                if (planId) {
                    editNewsletterPlan(parseInt(planId));
                }
            });
        });

        // Event handlers for the delete buttons
        document.querySelectorAll('[data-bs-target="#deletePlanModal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const planType = this.getAttribute('data-plan-type');
                const planId = this.getAttribute('data-plan-id');
                const planName = this.getAttribute('data-plan-name');
                if (planId && planType && planName) {
                    deletePlan(planType, parseInt(planId), planName);
                }
            });
        });
    });
</script>
@endpush