@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    
    @include('backend.settings.countries.partials.navigation')

    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend input-group-text">
                    <i class="bi-search"></i>
                </div>
                <input id="search" type="text" class="form-control" placeholder="Search ad plans...">
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
                    <h5 class="card-header-title">Ad Plans</h5>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdPlanModal">
                        <i class="bi-plus me-1"></i> Add Plan
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Format Name</th>
                        <th>Type</th>
                        <th>Dimensions</th>
                        <th>Placement</th>
                        <th>Format</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Pricing</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sampleAdPlans = [
                        [
                            'id' => 1,
                            'name' => 'Homepage Banner',
                            'type' => 'banner',
                            'width' => 728,
                            'height' => 90,
                            'placement' => 'homepage_banner',
                            'format' => 'image',
                            'description' => 'Premium banner displayed at the top of the homepage',
                            'instruction' => 'Upload a high-quality image with text that is clearly visible',
                            'price_cpm' => 50,
                            'price_cpc' => 0.75,
                            'price_fixed' => 120,
                            'is_active' => true
                        ],
                        [
                            'id' => 2,
                            'name' => 'Sidebar Ad',
                            'type' => 'sidebar',
                            'width' => 300,
                            'height' => 250,
                            'placement' => 'product_sidebar',
                            'format' => 'image',
                            'description' => 'Sidebar ad displayed on product pages',
                            'instruction' => 'Use compelling visuals to attract attention',
                            'price_cpm' => 35,
                            'price_cpc' => 0.50,
                            'price_fixed' => 80,
                            'is_active' => true
                        ],
                        [
                            'id' => 3,
                            'name' => 'Featured Product',
                            'type' => 'featured',
                            'width' => null,
                            'height' => null,
                            'placement' => 'category_top',
                            'format' => 'carousel',
                            'description' => 'Highlight your products at the top of category pages',
                            'instruction' => 'Submit multiple high-quality product images',
                            'price_cpm' => 75,
                            'price_cpc' => 1.20,
                            'price_fixed' => 150,
                            'is_active' => true
                        ],
                        [
                            'id' => 4,
                            'name' => 'Mobile Pop-up',
                            'type' => 'popup',
                            'width' => 320,
                            'height' => 480,
                            'placement' => 'checkout_page',
                            'format' => 'video',
                            'description' => 'Mobile-only pop-up ad with video',
                            'instruction' => 'Keep videos under 15 seconds for best results',
                            'price_cpm' => 60,
                            'price_cpc' => 0.90,
                            'price_fixed' => 100,
                            'is_active' => false
                        ]
                    ];
                    @endphp

                    @foreach($sampleAdPlans as $plan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="d-block h5 text-inherit mb-0">{{ $plan['name'] }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-capitalize">{{ $plan['type'] }}</span>
                        </td>
                        <td>
                            @if($plan['width'] && $plan['height'])
                            {{ $plan['width'] }}x{{ $plan['height'] }}
                            @else
                            <span class="badge bg-soft-secondary">Responsive</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-soft-primary">
                                {{ str_replace('_', ' ', ucfirst($plan['placement'])) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-info">
                                {{ ucfirst($plan['format']) }}
                            </span>
                        </td>
                        <td>{{ $plan['description'] }}</td>
                        <td>
                            @if($plan['is_active'])
                            <span class="badge bg-soft-success">Active</span>
                            @else
                            <span class="badge bg-soft-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="badge bg-soft-primary mb-1">
                                    CPM: {{ $country->currency_symbol }}{{ $plan['price_cpm'] }}/1000
                                </span>
                                <span class="badge bg-soft-info mb-1">
                                    CPC: {{ $country->currency_symbol }}{{ $plan['price_cpc'] }}/click
                                </span>
                                <span class="badge bg-soft-dark">
                                    Fixed: {{ $country->currency_symbol }}{{ $plan['price_fixed'] }}/day
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAdPlanModal"
                                    data-plan-id="{{ $plan['id'] }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePlanModal"
                                    data-plan-type="ad"
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
        document.querySelectorAll('[data-bs-target="#editAdPlanModal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const planId = this.getAttribute('data-plan-id');
                if (planId) {
                    editAdPlan(parseInt(planId));
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