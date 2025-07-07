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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                        <th>Plan Name</th>
                        <th>Type</th>
                        <th>Dimensions</th>
                        <th>Placement</th>
                        <th>Format</th>
                        <th>Devices</th>
                        <th>Durations</th>
                        <th>Pricing</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adPlans as $plan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="d-block h5 text-inherit mb-0">{{ $plan->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-capitalize">{{ $plan->type }}</span>
                        </td>
                        <td>
                            @if($plan->width && $plan->height)
                            {{ $plan->width }}x{{ $plan->height }}
                            @else
                            <span class="badge bg-soft-secondary">Responsive</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-soft-primary">
                                {{ str_replace('_', ' ', ucfirst($plan->placement)) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-info">
                                {{ ucfirst($plan->format) }}
                            </span>
                        </td>
                        <td>
                            @if($plan->device_desktop)
                                <span class="badge bg-primary">Desktop</span>
                            @endif
                            @if($plan->device_tablet)
                                <span class="badge bg-info">Tablet</span>
                            @endif
                            @if($plan->device_mobile)
                                <span class="badge bg-success">Mobile</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->duration_daily)
                                <span class="badge bg-primary">Daily</span>
                            @endif
                            @if($plan->duration_weekly)
                                <span class="badge bg-info">Weekly</span>
                            @endif
                            @if($plan->duration_monthly)
                                <span class="badge bg-success">Monthly</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                @if($plan->price_cpm !== null)
                                    <span class="badge bg-soft-primary mb-1">CPM: {{ $country->currency_symbol }}{{ $plan->price_cpm }}/1000</span>
                                @endif
                                @if($plan->price_cpc !== null)
                                    <span class="badge bg-soft-info mb-1">CPC: {{ $country->currency_symbol }}{{ $plan->price_cpc }}/click</span>
                                @endif
                                @if($plan->price_fixed !== null)
                                    <span class="badge bg-soft-dark">Fixed: {{ $country->currency_symbol }}{{ $plan->price_fixed }}/day</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($plan->is_active)
                            <span class="badge bg-soft-success">Active</span>
                            @else
                            <span class="badge bg-soft-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAdPlanModal"
                                    data-plan-id="{{ $plan->id }}"
                                    data-plan-name="{{ $plan->name }}"
                                    data-plan-type="{{ $plan->type }}"
                                    data-plan-placement="{{ $plan->placement }}"
                                    data-plan-format="{{ $plan->format }}"
                                    data-plan-width="{{ $plan->width }}"
                                    data-plan-height="{{ $plan->height }}"
                                    data-plan-description="{{ $plan->description }}"
                                    data-plan-instruction="{{ $plan->instruction }}"
                                    data-plan-device-desktop="{{ $plan->device_desktop }}"
                                    data-plan-device-tablet="{{ $plan->device_tablet }}"
                                    data-plan-device-mobile="{{ $plan->device_mobile }}"
                                    data-plan-duration-daily="{{ $plan->duration_daily }}"
                                    data-plan-duration-weekly="{{ $plan->duration_weekly }}"
                                    data-plan-duration-monthly="{{ $plan->duration_monthly }}"
                                    data-plan-price-cpm="{{ $plan->price_cpm }}"
                                    data-plan-price-cpc="{{ $plan->price_cpc }}"
                                    data-plan-price-fixed="{{ $plan->price_fixed }}"
                                    data-plan-is-active="{{ $plan->is_active }}">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePlanModal"
                                    data-plan-type="ad"
                                    data-plan-id="{{ $plan->id }}"
                                    data-plan-name="{{ $plan->name }}">
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
                editAdPlan(this);
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