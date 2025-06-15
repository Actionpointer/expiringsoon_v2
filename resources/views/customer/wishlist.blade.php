@extends('layouts.frontend.customer.app')
@section('content')
    <!-- section -->
    <section>
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                        <!-- heading -->
                        <h3 class="fs-5 mb-0">Menu</h3>
                        <!-- button -->
                        <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                            aria-controls="offcanvasAccount">
                            <i class="bi bi-text-indent-left fs-3"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
                    @include('layouts.frontend.customer.dashboard.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="py-6 p-md-6 p-lg-10">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <h2 class="mb-0">My Wishlist</h2>
                            <a href="#" class="btn btn-outline-primary">Continue Shopping</a>
                        </div>

                        <!-- Search and Filter -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <div class="input-group me-2">
                                    <input type="text" class="form-control" id="wishlistSearch" placeholder="Search wishlist..." aria-label="Search wishlist">
                                    <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <select class="form-select form-select-sm" id="sortWishlist">
                                    <option selected value="default">Default sorting</option>
                                    <option value="name-asc">Name (A-Z)</option>
                                    <option value="name-desc">Name (Z-A)</option>
                                    <option value="price-low">Price (Low to High)</option>
                                    <option value="price-high">Price (High to Low)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Wishlist table -->
                        <div class="table-responsive-xxl border-0">
                            <table class="table mb-0 text-nowrap table-centered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Configuration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Wishlist Item 1 -->
                                    <tr>
                                        <td class="align-middle w-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="product1">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/100x80" alt="Organic Banana" class="icon-shape icon-xl">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Organic Banana</h6>
                                                    <span class="text-muted"><small>$0.98 / lb</small></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">$35.00</td>
                                        <td class="align-middle">
                                            <span class="badge bg-success">In Stock</span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">Price alert: $30.00</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Add to Cart</button>
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#configModal" data-product-id="1" data-product-name="Organic Banana" data-price="35.00" data-status="In Stock"><i class="bi bi-gear"></i></button>
                                                <button class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Wishlist Item 2 -->
                                    <tr>
                                        <td class="align-middle w-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="product2">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/100x80" alt="Fresh Kiwi" class="icon-shape icon-xl">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Fresh Kiwi</h6>
                                                    <span class="text-muted"><small>4 no</small></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">$20.97</td>
                                        <td class="align-middle">
                                            <span class="badge bg-danger">Out of Stock</span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">Stock alert: When available</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-dark btn-sm">Contact us</button>
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#configModal" data-product-id="2" data-product-name="Fresh Kiwi" data-price="20.97" data-status="Out of Stock"><i class="bi bi-gear"></i></button>
                                                <button class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Wishlist Item 3 -->
                                    <tr>
                                        <td class="align-middle w-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="product3">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/100x80" alt="Golden Pineapple" class="icon-shape icon-xl">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Golden Pineapple</h6>
                                                    <span class="text-muted"><small>2 no</small></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">$35.00</td>
                                        <td class="align-middle">
                                            <span class="badge bg-success">In Stock</span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">No Config</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Add to Cart</button>
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#configModal" data-product-id="3" data-product-name="Golden Pineapple" data-price="35.00" data-status="In Stock"><i class="bi bi-gear"></i></button>
                                                <button class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Wishlist Item 4 -->
                                    <tr>
                                        <td class="align-middle w-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="product4">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/100x80" alt="BeatRoot" class="icon-shape icon-xl">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">BeatRoot</h6>
                                                    <span class="text-muted"><small>1 kg</small></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">$29.00</td>
                                        <td class="align-middle">
                                            <span class="badge bg-success">In Stock</span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">Stock alert: < 10 units</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Add to Cart</button>
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#configModal" data-product-id="4" data-product-name="BeatRoot" data-price="29.00" data-status="In Stock"><i class="bi bi-gear"></i></button>
                                                <button class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Wishlist Item 5 -->
                                    <tr>
                                        <td class="align-middle w-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="product5">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/100x80" alt="Fresh Apple" class="icon-shape icon-xl">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Fresh Apple</h6>
                                                    <span class="text-muted"><small>2 kg</small></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">$70.00</td>
                                        <td class="align-middle">
                                            <span class="badge bg-success">In Stock</span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">Price alert: $65.00</small><br>
                                            <small class="text-muted">Stock alert: < 5 units</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Add to Cart</button>
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#configModal" data-product-id="5" data-product-name="Fresh Apple" data-price="70.00" data-status="In Stock"><i class="bi bi-gear"></i></button>
                                                <button class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk actions -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="d-flex">
                                <select class="form-select me-3">
                                    <option selected>Bulk actions</option>
                                    <option value="1">Add all to cart</option>
                                    <option value="2">Remove all</option>
                                </select>
                                <button class="btn btn-primary">Apply</button>
                            </div>
                            <div>
                                <button class="btn btn-success">Add All to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Configuration Modal -->
    <div class="modal fade" id="configModal" tabindex="-1" aria-labelledby="configModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="configModalLabel">Configure Wishlist Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="productName" class="mb-3">Product Name</h6>
                    
                    <ul class="nav nav-tabs" id="configTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="price-tab" data-bs-toggle="tab" data-bs-target="#price-tab-pane" type="button" role="tab">Price Config</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="availability-tab" data-bs-toggle="tab" data-bs-target="#availability-tab-pane" type="button" role="tab">Availability Config</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content pt-3" id="configTabsContent">
                        <!-- Price Config Tab -->
                        <div class="tab-pane fade show active" id="price-tab-pane" role="tabpanel" aria-labelledby="price-tab">
                            <form id="priceConfigForm">
                                <input type="hidden" id="productId" name="productId">
                                
                                <div class="mb-3">
                                    <label for="currentPrice" class="form-label">Current Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="currentPrice" disabled>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="targetPrice" class="form-label">Alert me when price falls below</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="targetPrice" name="targetPrice" step="0.01" min="0">
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="enablePriceAlert" name="enablePriceAlert">
                                    <label class="form-check-label" for="enablePriceAlert">Enable price alert</label>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Availability Config Tab -->
                        <div class="tab-pane fade" id="availability-tab-pane" role="tabpanel" aria-labelledby="availability-tab">
                            <form id="availabilityConfigForm">
                                <input type="hidden" id="productIdAvail" name="productIdAvail">
                                
                                <div class="mb-3">
                                    <label for="currentStatus" class="form-label">Current Status</label>
                                    <input type="text" class="form-control" id="currentStatus" disabled>
                                </div>
                                
                                <div id="inStockOptions">
                                    <div class="mb-3">
                                        <label for="stockThreshold" class="form-label">Alert me when quantity available falls below</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="stockThreshold" name="stockThreshold" min="1" value="5">
                                            <span class="input-group-text">units</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="outOfStockOptions">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="notifyWhenAvailable" name="notifyWhenAvailable" checked>
                                            <label class="form-check-label" for="notifyWhenAvailable">
                                                Notify me when item is back in stock
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="enableStockAlert" name="enableStockAlert">
                                    <label class="form-check-label" for="enableStockAlert">Enable stock alert</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveConfig">Save Configuration</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.frontend.customer.dashboard.mobile-sidebar')
@endsection

@push('scripts')
<script>
    // Select all items functionality
    document.getElementById('selectAllItems')?.addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('tbody .form-check-input').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });

    // Search functionality
    document.getElementById('wishlistSearch')?.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        filterWishlistItems(searchTerm);
    });

    document.getElementById('searchButton')?.addEventListener('click', function() {
        const searchTerm = document.getElementById('wishlistSearch').value.toLowerCase();
        filterWishlistItems(searchTerm);
    });

    function filterWishlistItems(searchTerm) {
        const wishlistItems = document.querySelectorAll('tbody tr');
        
        wishlistItems.forEach(item => {
            const productName = item.querySelector('h6').textContent.toLowerCase();
            const productDesc = item.querySelector('.text-muted small')?.textContent.toLowerCase() || '';
            
            if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Sort functionality
    document.getElementById('sortWishlist')?.addEventListener('change', function() {
        const sortOption = this.value;
        const tableBody = document.querySelector('tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            const nameA = a.querySelector('h6').textContent.trim();
            const nameB = b.querySelector('h6').textContent.trim();
            
            const priceA = parseFloat(a.querySelector('td:nth-child(3)').textContent.replace('$', ''));
            const priceB = parseFloat(b.querySelector('td:nth-child(3)').textContent.replace('$', ''));
            
            switch(sortOption) {
                case 'name-asc':
                    return nameA.localeCompare(nameB);
                case 'name-desc':
                    return nameB.localeCompare(nameA);
                case 'price-low':
                    return priceA - priceB;
                case 'price-high':
                    return priceB - priceA;
                default:
                    return 0;
            }
        });
        
        // Re-append rows in the sorted order
        rows.forEach(row => tableBody.appendChild(row));
    });

    // Configuration modal
    const configModal = document.getElementById('configModal');
    if (configModal) {
        configModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const price = button.getAttribute('data-price');
            const status = button.getAttribute('data-status');
            
            // Set product info in the modal
            document.getElementById('productName').textContent = productName;
            document.getElementById('productId').value = productId;
            document.getElementById('productIdAvail').value = productId;
            document.getElementById('currentPrice').value = price;
            document.getElementById('currentStatus').value = status;
            
            // Show/hide appropriate stock options based on product status
            const inStockOptions = document.getElementById('inStockOptions');
            const outOfStockOptions = document.getElementById('outOfStockOptions');
            
            if (status === 'In Stock') {
                inStockOptions.style.display = 'block';
                outOfStockOptions.style.display = 'none';
            } else {
                inStockOptions.style.display = 'none';
                outOfStockOptions.style.display = 'block';
            }
            
            // Set default values based on existing configuration
            // In a real application, you would fetch this data from the server
            if (productId === '1') {
                document.getElementById('targetPrice').value = '30.00';
                document.getElementById('enablePriceAlert').checked = true;
            } else if (productId === '2') {
                document.getElementById('notifyWhenAvailable').checked = true;
                document.getElementById('enableStockAlert').checked = true;
            } else if (productId === '4') {
                document.getElementById('stockThreshold').value = '10';
                document.getElementById('enableStockAlert').checked = true;
            } else if (productId === '5') {
                document.getElementById('targetPrice').value = '65.00';
                document.getElementById('enablePriceAlert').checked = true;
                document.getElementById('stockThreshold').value = '5';
                document.getElementById('enableStockAlert').checked = true;
            } else {
                // Reset form for items with no config
                document.getElementById('targetPrice').value = '';
                document.getElementById('enablePriceAlert').checked = false;
                document.getElementById('stockThreshold').value = '5';
                document.getElementById('enableStockAlert').checked = false;
            }
        });
    }

    // Save configuration
    document.getElementById('saveConfig')?.addEventListener('click', function() {
        const productId = document.getElementById('productId').value;
        const productName = document.getElementById('productName').textContent;
        
        // Get price configuration
        const enablePriceAlert = document.getElementById('enablePriceAlert').checked;
        const targetPrice = document.getElementById('targetPrice').value;
        
        // Get stock configuration
        const enableStockAlert = document.getElementById('enableStockAlert').checked;
        const stockThreshold = document.getElementById('stockThreshold').value;
        const notifyWhenAvailable = document.getElementById('notifyWhenAvailable')?.checked;
        
        // In a real application, you would send this data to the server
        console.log('Saving configuration for product ID:', productId);
        console.log('Price alert enabled:', enablePriceAlert, 'Target price:', targetPrice);
        console.log('Stock alert enabled:', enableStockAlert, 'Stock threshold:', stockThreshold);
        
        // Show success message and close modal
        alert(`Configuration saved for ${productName}`);
        
        // Close the modal
        const modal = bootstrap.Modal.getInstance(configModal);
        modal.hide();
    });

    // Bulk actions functionality
    document.querySelector('.btn-primary')?.addEventListener('click', function() {
        const selectedAction = document.querySelector('select.form-select').value;
        const checkedItems = document.querySelectorAll('tbody .form-check-input:checked');
        
        if (checkedItems.length === 0) {
            alert('Please select at least one item.');
            return;
        }
        
        if (selectedAction === '1') {
            alert(`Adding ${checkedItems.length} items to cart.`);
            // Here you would implement the actual add to cart functionality
        } else if (selectedAction === '2') {
            alert(`Removing ${checkedItems.length} items from wishlist.`);
            // Here you would implement the actual remove functionality
        }
    });

    // Add all to cart button
    document.querySelector('.btn-success:last-child')?.addEventListener('click', function() {
        // Here you would implement adding all items to cart
        alert('Adding all in-stock items to cart');
    });
</script>
@endpush
