<main>
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ isset($category_id) ? $this->categories->find($category_id)?->name ?? 'All Products' : 'All Products' }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <div class="mt-8 mb-lg-14 mb-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row gx-10">
                <!-- col -->
                <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                    <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1" id="offcanvasCategory"
                        aria-labelledby="offcanvasCategoryLabel">
                        <div class="offcanvas-header d-lg-none">
                            <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ps-lg-2 pt-lg-0">
                            <div class="mb-8">
                                <!-- title -->
                                <h5 class="mb-3">Categories</h5>
                                @php
                                    $categoryOptions = $this->categories->map(fn($cat) => [
                                        'value' => $cat->id,
                                        'label' => $cat->name,
                                    ])->toArray();
                                @endphp
                                @livewire('components.form.select2-multiple', [
                                    'values' => $selected_categories,
                                    'options' => $categoryOptions,
                                    'placeholder' => 'Select categories...',
                                    'wireModel' => 'selected_categories',
                                    'uniqueId' => 'select2-multiple-categories',
                                ], key('select2-multiple-categories'))
                            </div>

                            <div class="mb-8">
                                <h5 class="mb-3">Store</h5>
                                @php
                                    $storeOptions = $this->stores->map(fn($store) => [
                                        'value' => $store->id,
                                        'label' => $store->name,
                                    ])->toArray();
                                @endphp
                                @livewire('components.form.select2-single', [
                                    'value' => $selected_store,
                                    'options' => $storeOptions,
                                    'placeholder' => 'Select a store...',
                                    'wireModel' => 'selected_store',
                                    'uniqueId' => 'select2-single-store',
                                ], key('select2-single-store'))
                            </div>
                            <div class="mb-8">
                                <!-- price -->
                                <h5 class="mb-3">Price</h5>
                                <div>
                                    <!-- range -->
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" class="form-control" placeholder="Min" 
                                                   wire:model.live.debounce.300ms="price_min" />
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" placeholder="Max" 
                                                   wire:model.live.debounce.300ms="price_max" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- rating -->
                            <div class="mb-8">
                                <h5 class="mb-3">Rating</h5>
                                <div>
                                    <!-- form check -->
                                    @for($i = 5; $i >= 1; $i--)
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="radio" value="{{ $i }}" 
                                               id="rating{{ $i }}" wire:model.live="rating_filter" />
                                        <label class="form-check-label" for="rating{{ $i }}">
                                            @for($star = 1; $star <= 5; $star++)
                                                <i class="bi bi-star{{ $star <= $i ? '-fill' : ($i - $star <= 0.5 ? '-half' : '') }} text-warning"></i>
                                            @endfor
                                            <span class="ms-1">& up</span>
                                        </label>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-8 position-relative">
                                <!-- Banner Design -->
                                <!-- Banner Content -->
                                <div class="position-absolute p-5 py-8">
                                    <h3 class="mb-0">Fresh Fruits</h3>
                                    <p>Get Upto 25% Off</p>
                                    <a href="#" class="btn btn-dark">
                                        Shop Now
                                        <i class="feather-icon icon-arrow-right ms-1"></i>
                                    </a>
                                </div>
                                <!-- Banner Content -->
                                <!-- Banner Image -->
                                <!-- img -->
                                <img src="{{asset('frontend/images/banner/assortment-citrus-fruits.png')}}" alt=""
                                    class="img-fluid rounded" />
                                <!-- Banner Image -->
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="col-lg-9 col-md-12">
                    <!-- card -->
                    <div class="card mb-4 bg-light border-0">
                        <!-- card body -->
                        <div class="card-body p-9">
                            <h2 class="mb-0 fs-1">
                                {{ $category_id ? $this->categories->find($category_id)?->name ?? 'All Products' : 'All Products' }}
                            </h2>
                        </div>
                    </div>
                    <!-- list icon -->
                    <div class="d-lg-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-lg-0">
                            <p class="mb-0">
                                <span class="text-dark">{{ $this->products->total() }}</span>
                                Products found
                            </p>
                        </div>

                        <!-- icon -->
                        <div class="d-md-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <a href="shop-list.html" class="text-muted me-3"><i class="bi bi-list-ul"></i></a>
                                    <a href="shop-grid.html" class="me-3 active"><i class="bi bi-grid"></i></a>
                                    <a href="shop-grid-3-column.html" class="me-3 text-muted"><i
                                            class="bi bi-grid-3x3-gap"></i></a>
                                </div>
                                <div class="ms-2 d-lg-none">
                                    <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas"
                                        href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-filter me-2">
                                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                        </svg>
                                        Filters
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex mt-2 mt-lg-0">
                                <div class="me-2 flex-grow-1">
                                    <!-- select option -->
                                    <select class="form-select" wire:model.live="expiry_sort">
                                        <option value="" selected>Expire In</option>
                                        <option value="6">6 Months</option>
                                        <option value="5">5 Months</option>
                                        <option value="4">4 Months</option>
                                        <option value="3">3 Months</option>
                                        <option value="2">2 Months</option>
                                        <option value="1">1 Months</option>
                                    </select>
                                </div>
                                <div>
                                    <!-- select option -->
                                    <select class="form-select" wire:model.live="sort_by">
                                        <option value="featured" selected>Sort by: Featured</option>
                                        <option value="price_low">Price: Low to High</option>
                                        <option value="price_high">Price: High to Low</option>
                                        <option value="newest">Release Date</option>
                                        <option value="rating">Avg. Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                        <!-- col -->
                        @forelse($this->products as $product)
                            @php
                                // Get the default variant or the first variant
                                $variant = $product->variants->where('is_default', true)->first() ?? $product->variants->first();
                                $rating = $product->ratings();
                                $reviewCount = $product->reviews->count();
                            @endphp
                            
                            @if($variant)
                            <div class="col">
                                <!-- card -->
                                <div class="card card-product">
                                    <div class="card-body">
                                        <!-- badge -->
                                        <div class="text-center position-relative">
                                            @if($product->discount > 0)
                                            <div class="position-absolute top-0 start-0">
                                                <span class="badge bg-danger">{{ round($product->discount) }}% Off</span>
                                            </div>
                                            @endif
                                            <a href="{{ route('product', $product->slug) }}">
                                                <!-- img -->
                                                <img src="{{ $variant->photo ?? $product->image }}" 
                                                     alt="{{ $product->name }}" class="mb-3 img-fluid" 
                                                     style="height: 200px; object-fit: cover;" />
                                            </a>
                                            <!-- action btn -->
                                            <div class="card-product-action">
                                                <a href="#!" class="btn-action" data-bs-toggle="modal"
                                                    data-bs-target="#quickViewModal">
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"></i>
                                                </a>
                                                <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                                    data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                                <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                                    title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- heading -->
                                        <div class="text-small mb-1">
                                            <a href="#!" class="text-decoration-none text-muted">
                                                <small>{{ $product->category->name ?? 'Uncategorized' }}</small>
                                            </a>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="{{ route('product', $product->slug) }}"
                                                class="text-inherit text-decoration-none">{{ $product->name }}</a>
                                        </h2>
                                        <div>
                                            <!-- rating -->
                                            <small class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $rating ? '-fill' : ($i - $rating <= 0.5 ? '-half' : '') }}"></i>
                                                @endfor
                                            </small>
                                            <span class="text-muted small">({{ $reviewCount }})</span>
                                        </div>
                                        <!-- price -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <span class="text-dark">${{ number_format($variant->price, 2) }}</span>
                                                @if($product->discount > 0)
                                                    <span class="text-decoration-line-through text-muted">
                                                        ${{ number_format($variant->price / (1 - $product->discount/100), 2) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- btn -->
                                            <div>
                                                <a href="#!" class="btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                    Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <h4 class="text-muted">No products found</h4>
                                    <p class="text-muted">Try adjusting your filters or search criteria.</p>
                                    <button class="btn btn-primary" wire:click="clearFilters">Clear All Filters</button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    @if($this->products->hasPages())
                    <div class="row mt-8">
                        <div class="col">
                            <!-- nav -->
                            <nav>
                                {{ $this->products->links() }}
                            </nav>
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@push('styles')
<link href="{{asset('frontend/libs/tiny-slider/dist/tiny-slider.css')}}" rel="stylesheet" />
<link href="{{asset('frontend/libs/nouislider/dist/nouislider.min.css')}}" rel="stylesheet" />
@endpush
@push('scripts')
<script src="{{asset('frontend/libs/nouislider/dist/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/libs/wnumb/wNumb.min.js')}}"></script>
<script src="{{asset('frontend/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
<script src="{{asset('frontend/js/vendors/tns-slider.js')}}"></script>
<script src="{{asset('frontend/js/vendors/zoom.js')}}"></script>
@endpush