@extends('layouts.frontend.store.app')

@push('styles')
<style>
    .status-badge.active {
        background-color: #198754;
    }
    
    .status-badge.expired {
        background-color: #dc3545;
    }
    
    .status-badge.paused {
        background-color: #fd7e14;
    }
    
    .status-badge.scheduled {
        background-color: #0d6efd;
    }
    
    .ad-image {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }
    
    .action-dropdown .dropdown-item {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
    
    .action-dropdown .dropdown-item i {
        margin-right: 0.5rem;
        width: 1rem;
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Featured Products Ads</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.adverts', 1) }}" class="text-inherit">Adverts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Featured Products</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('store.marketing.adverts.create', ['store' => 1, 'adset' => 1]) }}" class="btn btn-primary">Create New Ad</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Adset Stats -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <h6 class="text-muted mb-1">Adset Type</h6>
                            <h5>Featured Products</h5>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <h6 class="text-muted mb-1">Ad Units</h6>
                            <h5>2 of 10 Used</h5>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <h6 class="text-muted mb-1">Created Date</h6>
                            <h5>10/03/2025</h5>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <h6 class="text-muted mb-1">Expiry Date</h6>
                            <h5>10/06/2025</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ads List -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Your Ads</h5>
                    <div>
                        <select class="form-select form-select-sm">
                            <option selected>All Status</option>
                            <option>Active</option>
                            <option>Paused</option>
                            <option>Expired</option>
                            <option>Scheduled</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Ad</th>
                                    <th>Target</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Stats</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Active Ad -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/240x160?text=Summer+Sale" alt="Summer Sale Ad" class="ad-image me-3">
                                            <div>
                                                <h6 class="mb-1">Summer Collection</h6>
                                                <small class="text-muted">Product Showcase</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>All Categories</td>
                                    <td>15/03/2025</td>
                                    <td>15/04/2025</td>
                                    <td><span class="badge status-badge active">Active</span></td>
                                    <td>
                                        <div>Views: 1,245</div>
                                        <div>Clicks: 128</div>
                                        <div class="text-success small">CTR: 10.3%</div>
                                    </td>
                                    <td>
                                        <div class="dropdown action-dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pause-fill"></i> Pause</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up"></i> Analytics</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Expired Ad -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/240x160?text=Spring+Deals" alt="Spring Deals Ad" class="ad-image me-3">
                                            <div>
                                                <h6 class="mb-1">Spring Deals</h6>
                                                <small class="text-muted">Limited Time Offer</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Fashion, Accessories</td>
                                    <td>01/02/2025</td>
                                    <td>01/03/2025</td>
                                    <td><span class="badge status-badge expired">Expired</span></td>
                                    <td>
                                        <div>Views: 2,780</div>
                                        <div>Clicks: 315</div>
                                        <div class="text-success small">CTR: 11.3%</div>
                                    </td>
                                    <td>
                                        <div class="dropdown action-dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-clockwise"></i> Renew</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Duplicate</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up"></i> Analytics</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Paused Ad -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/240x160?text=New+Arrivals" alt="New Arrivals Ad" class="ad-image me-3">
                                            <div>
                                                <h6 class="mb-1">New Arrivals</h6>
                                                <small class="text-muted">Product Launch</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Electronics</td>
                                    <td>20/04/2025</td>
                                    <td>20/05/2025</td>
                                    <td><span class="badge status-badge paused">Paused</span></td>
                                    <td>
                                        <div>Views: 654</div>
                                        <div>Clicks: 42</div>
                                        <div class="text-warning small">CTR: 6.4%</div>
                                    </td>
                                    <td>
                                        <div class="dropdown action-dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-play-fill"></i> Activate</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up"></i> Analytics</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Scheduled Ad -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/240x160?text=Holiday+Special" alt="Holiday Special Ad" class="ad-image me-3">
                                            <div>
                                                <h6 class="mb-1">Holiday Special</h6>
                                                <small class="text-muted">Limited Edition</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home & Garden</td>
                                    <td>01/06/2025</td>
                                    <td>30/06/2025</td>
                                    <td><span class="badge status-badge scheduled">Scheduled</span></td>
                                    <td>
                                        <div>Views: -</div>
                                        <div>Clicks: -</div>
                                        <div class="text-muted small">Not started</div>
                                    </td>
                                    <td>
                                        <div class="dropdown action-dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-calendar-check"></i> Change Schedule</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-play-fill"></i> Activate Now</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Performance Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Performance Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h6 class="text-muted">Total Views</h6>
                                <h3 class="fw-bold">4,679</h3>
                                <div class="text-success small">
                                    <i class="bi bi-graph-up"></i> 12% vs. last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h6 class="text-muted">Total Clicks</h6>
                                <h3 class="fw-bold">485</h3>
                                <div class="text-success small">
                                    <i class="bi bi-graph-up"></i> 8% vs. last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h6 class="text-muted">Avg. CTR</h6>
                                <h3 class="fw-bold">10.4%</h3>
                                <div class="text-warning small">
                                    <i class="bi bi-dash"></i> 0.5% vs. last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="text-center">
                                <h6 class="text-muted">Conversion Rate</h6>
                                <h3 class="fw-bold">3.2%</h3>
                                <div class="text-success small">
                                    <i class="bi bi-graph-up"></i> 1.5% vs. last month
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Create Ad CTA -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body text-center py-4">
                    <h4 class="mb-3">You have 8 unused ad units in this adset</h4>
                    <p class="text-muted mb-4">Create more ads to maximize your adset's potential and reach more customers</p>
                    <a href="{{ route('store.marketing.adverts.create', ['store' => 1, 'adset' => 1]) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Create New Ad
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any interactive elements
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Filter ads based on status
        $('select.form-select').on('change', function() {
            const status = $(this).val();
            if (status === 'All Status') {
                $('tbody tr').show();
            } else {
                $('tbody tr').hide();
                $(`tbody tr td:nth-child(5):contains("${status}")`).parent('tr').show();
            }
        });
    });
</script>
@endpush
