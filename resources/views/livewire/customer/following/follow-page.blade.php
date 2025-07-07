<div class="py-6 p-md-6 p-lg-10">
    <div class="mb-4">
        <!-- heading -->
        <h2 class="mb-0">Stores you follow</h2>
        <p class="text-muted mt-2">Stay updated with your favorite stores</p>
    </div>

    <!-- Search and filter bar -->
    <div class="d-flex flex-wrap align-items-center mb-5">
        <div class="d-flex align-items-center me-auto mb-3 mb-md-0">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search stores...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="me-2 text-nowrap">Sort by:</div>
            <select class="form-select form-select-sm">
                <option selected>Recently followed</option>
                <option>Most ordered</option>
                <option>Alphabetical</option>
            </select>
        </div>
    </div>

    <!-- Stores grid -->
    <div class="row g-4">
        <!-- Store item 1 -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="d-flex p-3 border-bottom">
                        <img src="{{asset('frontend/images/stores-logo/stores-logo-1.svg')}}" alt="Store Logo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">TechHub Store</h5>
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="text-warning me-1">
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-half small"></i>
                                        </div>
                                        <span class="small text-muted">(4.5)</span>
                                    </div>
                                </div>
                                <span class="badge bg-success rounded-pill">New products</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row mb-3">
                            <div class="col-6 border-end">
                                <div class="text-center">
                                    <div class="h5 mb-0">24</div>
                                    <div class="small text-muted">Orders</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="h5 mb-0">120+</div>
                                    <div class="small text-muted">Products</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="small text-muted">
                                <i class="bi bi-clock me-1"></i> Following since June 2023
                            </div>
                            <div class="small text-success">
                                <i class="bi bi-tag-fill me-1"></i> 20% off sale
                            </div>
                        </div>
                        <div class="small mb-3 text-muted">
                            <i class="bi bi-bag me-1"></i> Last order: 2 weeks ago
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-danger me-2">
                                <i class="bi bi-heart-fill me-1"></i> Unfollow
                            </button>
                            <a href="#" class="btn btn-sm btn-primary flex-grow-1">Visit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store item 2 -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="d-flex p-3 border-bottom">
                        <img src="{{asset('frontend/images/stores-logo/stores-logo-2.svg')}}" alt="Store Logo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">Fashion Avenue</h5>
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="text-warning me-1">
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star small"></i>
                                        </div>
                                        <span class="small text-muted">(4.0)</span>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill">Featured</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row mb-3">
                            <div class="col-6 border-end">
                                <div class="text-center">
                                    <div class="h5 mb-0">12</div>
                                    <div class="small text-muted">Orders</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="h5 mb-0">85+</div>
                                    <div class="small text-muted">Products</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="small text-muted">
                                <i class="bi bi-clock me-1"></i> Following since March 2023
                            </div>
                            <div class="small text-primary">
                                <i class="bi bi-tag-fill me-1"></i> Free shipping
                            </div>
                        </div>
                        <div class="small mb-3 text-muted">
                            <i class="bi bi-bag me-1"></i> Last order: 1 month ago
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-danger me-2">
                                <i class="bi bi-heart-fill me-1"></i> Unfollow
                            </button>
                            <a href="#" class="btn btn-sm btn-primary flex-grow-1">Visit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store item 3 -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="d-flex p-3 border-bottom">
                        <img src="{{asset('frontend/images/stores-logo/stores-logo-3.svg')}}" alt="Store Logo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">Healthy Essentials</h5>
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="text-warning me-1">
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                        </div>
                                        <span class="small text-muted">(5.0)</span>
                                    </div>
                                </div>
                                <span class="badge bg-warning text-dark rounded-pill">Sale</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row mb-3">
                            <div class="col-6 border-end">
                                <div class="text-center">
                                    <div class="h5 mb-0">18</div>
                                    <div class="small text-muted">Orders</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="h5 mb-0">65+</div>
                                    <div class="small text-muted">Products</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="small text-muted">
                                <i class="bi bi-clock me-1"></i> Following since January 2023
                            </div>
                            <div class="small text-warning">
                                <i class="bi bi-tag-fill me-1"></i> Summer sale
                            </div>
                        </div>
                        <div class="small mb-3 text-muted">
                            <i class="bi bi-bag me-1"></i> Last order: 3 days ago
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-danger me-2">
                                <i class="bi bi-heart-fill me-1"></i> Unfollow
                            </button>
                            <a href="#" class="btn btn-sm btn-primary flex-grow-1">Visit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store item 4 -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="d-flex p-3 border-bottom">
                        <img src="{{asset('frontend/images/stores-logo/stores-logo-4.svg')}}" alt="Store Logo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">Home Decor Plus</h5>
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="text-warning me-1">
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-fill small"></i>
                                            <i class="bi bi-star-half small"></i>
                                            <i class="bi bi-star small"></i>
                                        </div>
                                        <span class="small text-muted">(3.5)</span>
                                    </div>
                                </div>
                                <span class="badge bg-info rounded-pill">Restock</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="row mb-3">
                            <div class="col-6 border-end">
                                <div class="text-center">
                                    <div class="h5 mb-0">7</div>
                                    <div class="small text-muted">Orders</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="h5 mb-0">110+</div>
                                    <div class="small text-muted">Products</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="small text-muted">
                                <i class="bi bi-clock me-1"></i> Following since April 2023
                            </div>
                            <div class="small text-info">
                                <i class="bi bi-tag-fill me-1"></i> Limited edition
                            </div>
                        </div>
                        <div class="small mb-3 text-muted">
                            <i class="bi bi-bag me-1"></i> Last order: 2 months ago
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-danger me-2">
                                <i class="bi bi-heart-fill me-1"></i> Unfollow
                            </button>
                            <a href="#" class="btn btn-sm btn-primary flex-grow-1">Visit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

    <!-- Empty state (hidden by default) -->
    <div class="text-center py-5 d-none">
        <img src="{{asset('frontend/images/empty-state.svg')}}" alt="No stores" class="img-fluid mb-4" style="max-width: 200px;">
        <h3>You're not following any stores yet</h3>
        <p class="text-muted">Follow stores to get updates on new products, sales, and promotions</p>
        <a href="#" class="btn btn-primary mt-3">Explore Stores</a>
    </div>
</div>