@extends('layouts.backend.base.app')

@section('main')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item"><a href="#">Places</a></li>
                        <li class="breadcrumb-item active">Nigeria</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Nigeria Setup</h1>
            </div>
            <div class="col-sm-auto">
                <span class="badge bg-soft-success">Active</span>
            </div>
        </div>
    </div>

    <!-- Setup Navigation -->
    <div class="mb-4">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#locations" data-bs-toggle="tab">
                    <i class="bi-geo-alt me-1"></i> Locations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#banking" data-bs-toggle="tab">
                    <i class="bi-bank me-1"></i> Banking
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#verification" data-bs-toggle="tab">
                    <i class="bi-shield-check me-1"></i> Verification
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#transactions" data-bs-toggle="tab">
                    <i class="bi-currency-exchange me-1"></i> Transactions
                </a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Locations Tab -->
        @include('backend.settings.places.partials.tabs.locations')

        <!-- Banking Tab -->
        @include('backend.settings.places.partials.tabs.banking')

        <!-- Verification Tab -->
        @include('backend.settings.places.partials.tabs.verification')

        <!-- Transactions Tab -->
        @include('backend.settings.places.partials.tabs.transactions')
    </div>
</div>

<!-- Modals -->
@include('backend.settings.places.partials.modals')
@endsection