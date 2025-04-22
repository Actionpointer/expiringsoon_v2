@extends('layouts.base.provider')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end mb-3">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Plans</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Plans Settings</h1>
            </div>
        </div>
        @include('settings.partials.menu')
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Total Plans</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $subscriptionPlans->count() + $adPlans->count() + $newsletterPlans->count() }}</span>
                            <span class="text-body fs-6 ms-1">plans</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Subscription Plans</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $subscriptionPlans->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">active plans</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Ad Plans</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $adPlans->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">ad formats</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Newsletter Plans</h6>
                    <div class="row align-items-center gx-2">
                        <div class="col">
                            <span class="display-4 text-dark">{{ $newsletterPlans->count() }}</span>
                            <div class="d-flex align-items-center">
                                <span class="text-body">credit packages</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-nav card-nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#subscription" data-bs-toggle="tab">
                        <i class="bi-box me-1"></i> Subscription Plans
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#advertising" data-bs-toggle="tab">
                        <i class="bi-badge-ad me-1"></i> Ad Plans
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#newsletter" data-bs-toggle="tab">
                        <i class="bi-envelope me-1"></i> Newsletter Plans
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- Subscription Plans Tab -->
            <div class="tab-pane fade show active" id="subscription" role="tabpanel">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <h5 class="card-header-title">Subscription Plans</h5>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubscriptionPlanModal">
                                <i class="bi-plus me-1"></i> Add Plan
                            </button>
                        </div>
                    </div>
                </div>

                @include('settings.plans.partials.subscription-table')
            </div>

            <!-- Ad Plans Tab -->
            <div class="tab-pane fade" id="advertising" role="tabpanel">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <h5 class="card-header-title">Ad Plans</h5>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdPlanModal">
                                <i class="bi-plus me-1"></i> Add Ad Format
                            </button>
                        </div>
                    </div>
                </div>

                @include('settings.plans.partials.ad-table')
            </div>

            <!-- Newsletter Plans Tab -->
            <div class="tab-pane fade" id="newsletter" role="tabpanel">
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

                @include('settings.plans.partials.newsletter-table')
            </div>
        </div>
    </div>
</div>
@endsection

@section('secondary')
@include('settings.plans.partials.modals')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize datatables
        HSCore.components.HSDatatables.init('.js-datatable');

        // Initialize tom select
        HSCore.components.HSTomSelect.init('.js-select');
    });
</script>
@endpush 