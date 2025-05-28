<div class="modal fade" id="workplacesModal" tabindex="-1" aria-labelledby="workplacesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-6">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1" id="workplacesModalLabel">Your Stores</h5>
                        <p class="mb-0 small">Manage the stores you own or collaborate with</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="my-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="search" class="form-control border-start-0" id="searchStores" placeholder="Search stores" />
                    </div>
                </div>
                
                <!-- Store List -->
                <div data-simplebar style="height: 380px">
                    <div class="list-group list-group-flush store-list">
                        <!-- Owner Store Example -->
                        <a href="{{ route('store.dashboard', ['store' => 'store-1']) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-shop fs-4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Fresh Groceries Store</h6>
                                        <span class="badge bg-primary rounded-pill">Owner</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>New York
                                        </small>
                                        <small class="text-muted">Created: June 2023</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Staff Store Example -->
                        <a href="{{ route('store.dashboard', ['store' => 'store-2']) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-shop-window fs-4 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Organic Foods Market</h6>
                                        <span class="badge bg-success rounded-pill">Staff</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>Los Angeles
                                        </small>
                                        <small class="text-muted">Joined: August 2023</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Dynamic Stores Loop (Commented out - replace with your actual code) -->
                        {{-- @foreach($userStores as $store)
                        <a href="{{ route('store.dashboard', ['store' => $store->slug]) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    @if($store->logo)
                                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="w-100 h-100 rounded-circle object-fit-cover">
                                    @else
                                        <i class="bi bi-shop fs-4 {{ $store->pivot->role == 'owner' ? 'text-primary' : 'text-success' }}"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">{{ $store->name }}</h6>
                                        <span class="badge {{ $store->pivot->role == 'owner' ? 'bg-primary' : 'bg-success' }} rounded-pill">
                                            {{ ucfirst($store->pivot->role) }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $store->city ?? 'Location not set' }}
                                        </small>
                                        <small class="text-muted">
                                            {{ $store->pivot->role == 'owner' ? 'Created: ' : 'Joined: ' }}
                                            {{ $store->pivot->created_at->format('M Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach --}}
                        
                        <!-- Additional Example Stores for Demo -->
                        <a href="{{ route('store.dashboard', ['store' => 'store-3']) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-shop fs-4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Bakery Delights</h6>
                                        <span class="badge bg-primary rounded-pill">Owner</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>Chicago
                                        </small>
                                        <small class="text-muted">Created: January 2024</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('store.dashboard', ['store' => 'store-4']) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-shop-window fs-4 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Premium Meats</h6>
                                        <span class="badge bg-success rounded-pill">Staff</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>Houston
                                        </small>
                                        <small class="text-muted">Joined: February 2024</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('store.dashboard', ['store' => 'store-5']) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-center">
                                <div class="store-icon rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-shop fs-4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Seafood Express</h6>
                                        <span class="badge bg-primary rounded-pill">Owner</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>Miami
                                        </small>
                                        <small class="text-muted">Created: November 2023</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('store.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create New Store
                    </a>
                    <a href="#" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </a>
                </div>
                
                <!-- JavaScript to handle search functionality -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('searchStores');
                        const storeItems = document.querySelectorAll('.store-list .list-group-item');
                        
                        searchInput.addEventListener('input', function() {
                            const searchTerm = this.value.toLowerCase().trim();
                            
                            storeItems.forEach(item => {
                                const storeName = item.querySelector('h6').textContent.toLowerCase();
                                const storeLocation = item.querySelector('.bi-geo-alt').nextSibling.textContent.toLowerCase();
                                
                                if (storeName.includes(searchTerm) || storeLocation.includes(searchTerm)) {
                                    item.style.display = '';
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>