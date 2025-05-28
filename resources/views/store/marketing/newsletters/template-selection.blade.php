@extends('layouts.frontend.store.app')

@push('styles')
<style>
    .template-card {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
        transition: all 0.3s;
        height: 250px;
        margin-bottom: 20px;
    }
    
    .template-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .template-card:hover img {
        transform: scale(1.05);
    }
    
    .template-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px;
        transform: translateY(100%);
        transition: transform 0.3s;
    }
    
    .template-card:hover .template-overlay {
        transform: translateY(0);
    }
    
    .template-buttons {
        display: flex;
        justify-content: space-between;
    }
    
    .filter-buttons {
        margin-bottom: 2rem;
    }
    
    .filter-buttons .btn {
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .template-title {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Select Newsletter Template</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Marketing</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store.marketing.newsletters', 1) }}" class="text-inherit">Newsletters</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Select Template</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.newsletters', 1) }}" class="btn btn-light">Back to Newsletters</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter buttons -->
    <div class="row">
        <div class="col-12">
            <div class="filter-buttons">
                <button class="btn btn-primary filter-btn active" data-filter="all">All Templates</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="promotional">Promotional</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="product">Product</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="announcement">Announcement</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="sale">Sale</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="seasonal">Seasonal</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="welcome">Welcome</button>
            </div>
        </div>
    </div>
    
    <!-- Templates grid -->
    <div class="row templates-container">
        <!-- Template 1 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="promotional product">
            <div class="template-card">
                <div class="template-title">New Product</div>
                <img src="https://placehold.co/400x600?text=Template+1" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'new-product']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'new-product']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 2 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="sale promotional">
            <div class="template-card">
                <div class="template-title">Flash Sale</div>
                <img src="https://placehold.co/400x600?text=Template+2" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'flash-sale']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'flash-sale']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 3 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="welcome">
            <div class="template-card">
                <div class="template-title">Welcome</div>
                <img src="https://placehold.co/400x600?text=Template+3" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'welcome']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'welcome']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 4 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="seasonal promotional">
            <div class="template-card">
                <div class="template-title">Holiday Special</div>
                <img src="https://placehold.co/400x600?text=Template+4" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'holiday-special']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'holiday-special']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 5 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="announcement">
            <div class="template-card">
                <div class="template-title">Big Announcement</div>
                <img src="https://placehold.co/400x600?text=Template+5" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'announcement']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'announcement']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 6 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="product">
            <div class="template-card">
                <div class="template-title">Product Showcase</div>
                <img src="https://placehold.co/400x600?text=Template+6" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'product-showcase']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'product-showcase']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Add more templates with different categories -->
        <!-- Template 7 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="promotional">
            <div class="template-card">
                <div class="template-title">Special Offer</div>
                <img src="https://placehold.co/400x600?text=Template+7" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'special-offer']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'special-offer']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 8 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="sale">
            <div class="template-card">
                <div class="template-title">Clearance Sale</div>
                <img src="https://placehold.co/400x600?text=Template+8" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'clearance-sale']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'clearance-sale']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 9 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="seasonal">
            <div class="template-card">
                <div class="template-title">Summer Collection</div>
                <img src="https://placehold.co/400x600?text=Template+9" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'summer-collection']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'summer-collection']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 10 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="announcement">
            <div class="template-card">
                <div class="template-title">Store News</div>
                <img src="https://placehold.co/400x600?text=Template+10" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'store-news']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'store-news']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 11 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="product promotional">
            <div class="template-card">
                <div class="template-title">Featured Products</div>
                <img src="https://placehold.co/400x600?text=Template+11" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'featured-products']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'featured-products']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template 12 -->
        <div class="col-md-3 col-sm-4 col-6 template-item" data-category="welcome">
            <div class="template-card">
                <div class="template-title">Thank You</div>
                <img src="https://placehold.co/400x600?text=Template+12" alt="Newsletter Template">
                <div class="template-overlay">
                    <div class="template-buttons">
                        <a href="{{ route('store.marketing.newsletters.preview', ['store' => 1, 'template' => 'thank-you']) }}" target="_blank" class="btn btn-sm btn-outline-light">Preview</a>
                        <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => 'thank-you']) }}" class="btn btn-sm btn-primary">Use</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Filter functionality
        $('.filter-btn').on('click', function() {
            // Update active button
            $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            
            const selectedFilter = $(this).data('filter');
            
            if (selectedFilter === 'all') {
                // Show all templates
                $('.template-item').show();
            } else {
                // Hide all templates
                $('.template-item').hide();
                // Show only templates with the selected category
                $('.template-item').each(function() {
                    const categories = $(this).data('category').split(' ');
                    if (categories.includes(selectedFilter)) {
                        $(this).show();
                    }
                });
            }
        });
    });
</script>
@endpush 