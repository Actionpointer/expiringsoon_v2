<div class="container">
	<div class="row mb-8">
		<div class="col-md-12">
			<!-- page header -->
			<div class="d-md-flex justify-content-between align-items-center">
				<div>
					<h2>Products</h2>
					<!-- breadcrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="{{ route('store.dashboard', $store) }}" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Products</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					{{-- {{ route('store.products.create', $store) }} --}}
					<a href="" class="btn btn-primary">Add Product</a>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-xl-12 col-12 mb-5">
			<!-- card -->
			<div class="card h-100 card-lg">
			<div class="px-6 py-6">
				<div class="row justify-content-between">
					<!-- search form -->
					<div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="bi bi-search"></i>
							</span>
							<input wire:model.debounce.300ms="search" class="form-control" type="search" placeholder="Search by product name or description" aria-label="Search" />
						</div>
					</div>
					<!-- select options -->
					<div class="col-lg-8 col-md-6 col-12 d-flex gap-2 justify-content-end">
						<select wire:model="categoryFilter" class="form-select" style="max-width: 200px;">
							<option value="">All Categories</option>
							@foreach($this->storeCategories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
						<select wire:model="statusFilter" class="form-select" style="max-width: 150px;">
							<option value="">All Status</option>
							<option value="published">Published</option>
							<option value="draft">Draft</option>
							<option value="approved">Approved</option>
							<option value="pending">Pending</option>
						</select>
						<select wire:model="expiryFilter" class="form-select" style="max-width: 180px;">
							<option value="">All Expiry</option>
							<option value="expiring-soon">Expiring Soon (30d)</option>
							<option value="expired">Expired</option>
							<option value="no-expiry">No Expiry Date</option>
						</select>
						<select wire:model="perPage" class="form-select" style="max-width: 120px;">
							<option value="10">10 Per Page</option>
							<option value="25">25 Per Page</option>
							<option value="50">50 Per Page</option>
							<option value="100">100 Per Page</option>
						</select>
					</div>
				</div>
			</div>
			<!-- card body -->
			<div class="card-body p-0">
				<!-- table -->
				<div class="table-responsive">
					<table class="table table-centered table-hover text-nowrap table-borderless mb-0">
						<thead class="bg-light">
						<tr>
							<th>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="checkAll" />
									<label class="form-check-label" for="checkAll"></label>
								</div>
							</th>
							<th>Image</th>
							<th wire:click="sortBy('name')" class="cursor-pointer">
								Product Name
								@if ($sortField === 'name')
									<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
								@endif
							</th>
							<th>Category</th>
							<th wire:click="sortBy('published')" class="cursor-pointer">
								Status
								@if ($sortField === 'published')
									<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
								@endif
							</th>
							<th wire:click="sortBy('expire_at')" class="cursor-pointer">
								Expiry
								@if ($sortField === 'expire_at')
									<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
								@endif
							</th>
							<th wire:click="sortBy('created_at')" class="cursor-pointer">
								Created
								@if ($sortField === 'created_at')
									<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
								@endif
							</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
							@forelse($this->products as $product)
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="{{ $product->id }}" id="product{{ $product->id }}" />
											<label class="form-check-label" for="product{{ $product->id }}"></label>
										</div>
									</td>
									<td>
										{{-- href="{{ route('store.products.edit', ['store' => $store, 'product' => $product]) }}" --}}
										<a >
											@php
												$hasPhoto = false;
												$photoUrl = null;
												
												if (!empty($product->photos)) {
													try {
														$photos = json_decode($product->photos, true);
														if (is_array($photos) && count($photos) > 0) {
															$photoUrl = $photos[0];
															$hasPhoto = true;
														}
													} catch (\Exception $e) {
														// Handle JSON decode error silently
													}
												}
											@endphp
											
											@if($hasPhoto && $photoUrl)
												<img src="{{ asset('storage/' . $photoUrl) }}" alt="{{ $product->name }}" class="icon-shape icon-md" />
											@else
												<div class="icon-shape icon-md bg-light">
													<i class="bi bi-image text-muted"></i>
												</div>
											@endif
										</a>
									</td>
									<td>
										 {{-- href="{{ route('store.products.edit', ['store' => $store, 'product' => $product]) }}"  --}}
										<a class="text-reset">
											{{ $product->name }}
										</a>
										<div class="text-muted small">{{ Str::limit($product->description, 40) }}</div>
									</td>
									<td>
										{{ $product->category->name ?? 'Uncategorized' }}
									</td>
									<td>
										@if($product->published)
											@if($product->approved_at)
												<span class="badge bg-light-primary text-dark-primary">Published</span>
											@else
												<span class="badge bg-light-warning text-dark-warning">Pending Approval</span>
											@endif
										@else
											<span class="badge bg-light-secondary text-dark-secondary">Draft</span>
										@endif
									</td>
									<td>
										@if($product->always_available)
											<span class="badge bg-light-success">No Expiry</span>
										@elseif($product->expire_at)
											@if($product->expire_at->isPast())
												<span class="badge bg-light-danger text-dark-danger">Expired</span>
											@elseif($product->expire_at->diffInDays(now()) <= 30)
												<span class="badge bg-light-warning text-dark-warning">
													{{ $product->expire_at->diffInDays(now()) }} days left
												</span>
											@else
												<span class="badge bg-light-info text-dark-info">
													{{ $product->expire_at->format('M d, Y') }}
												</span>
											@endif
										@else
											<span class="badge bg-light-secondary">Not Set</span>
										@endif
									</td>
									<td>{{ $product->created_at->format('M d, Y') }}</td>
									<td>
										<div class="dropdown">
											<a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="feather-icon icon-more-vertical fs-5"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item"  href="#" x-data @click="$dispatch('editProductRequest', { id: {{ $product->id }} })">
														<i class="bi bi-pencil-square me-3"></i>
														Editt
													</a>
													
												</li>
												@if(!$product->published)
													<li>
														<button class="dropdown-item text-success" 
															wire:click="$emit('publishProduct', {{ $product->id }})"
															wire:loading.attr="disabled">
															<i class="bi bi-check-circle me-3"></i>
															Publish
														</button>
													</li>
												@else
													<li>
														<button class="dropdown-item text-secondary" 
															wire:click="$emit('unpublishProduct', {{ $product->id }})"
															wire:loading.attr="disabled">
															<i class="bi bi-file-earmark-minus me-3"></i>
															Unpublish
														</button>
													</li>
												@endif
												<li>
													<button class="dropdown-item text-danger" 
														wire:click="confirmDelete({{ $product->id }})"
														wire:loading.attr="disabled">
														<i class="bi bi-trash me-3"></i>
														Delete
													</button>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="8" class="text-center py-4">
										<div class="d-flex flex-column align-items-center">
											<i class="bi bi-box fs-1 text-muted mb-3"></i>
											<h5>No products found</h5>
											<p class="text-muted">
												@if($search || $categoryFilter || $statusFilter || $expiryFilter)
													Try adjusting your search or filter criteria
												@else
													Start by adding your first product
												@endif
											</p>
											@if(!$search && !$categoryFilter && !$statusFilter && !$expiryFilter)
												<a href="{{ route('store.products.create', $store) }}" class="btn btn-primary mt-3">
													<i class="bi bi-plus-circle me-2"></i>Add Product
												</a>
											@endif
										</div>
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					

				</div>
			</div>
			<div class="card-footer border-top d-flex justify-content-between align-items-center">
				<div class="text-muted">
					Showing 
					<span>{{ $this->products->firstItem() ?? 0 }}</span>
					to 
					<span>{{ $this->products->lastItem() ?? 0 }}</span>
					of 
					<span>{{ $this->products->total() ?? 0 }}</span>
					results
				</div>
				<div>
					{{ $this->products->links() }}
				</div>
			</div>
		</div>
	</div>

	
</div>
<livewire:store.product.edit-product-modal />
@push('scripts')
	<script>

		window.addEventListener('livewire:load', function () {
			// Initialize any scripts needed for the products list
			
			// Select all checkbox
			document.getElementById('checkAll')?.addEventListener('change', function() {
				const checkboxes = document.querySelectorAll('tbody .form-check-input');
				checkboxes.forEach(checkbox => {
					checkbox.checked = this.checked;
				});
			});

			// Listen for the delete confirmation event
			window.addEventListener('show-delete-confirmation', event => {
				Swal.fire({
					title: event.detail.title,
					text: event.detail.text,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc3545',
					cancelButtonColor: '#6c757d',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.isConfirmed) {
						Livewire.emit('deleteProduct', event.detail.productId);
					}
				})
			});

		});
	</script>
@endpush
