<div class="container">
	<!-- row -->
	<div class="row mb-8">
		<div class="col-md-12">
			<!-- page header -->
			<div class="d-md-flex justify-content-between align-items-center">
				<div>
					<h2>Bundles</h2>
					<!-- breacrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Bundles</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					<a href="{{ route('store.marketing.bundles.create',request()->store) }}" class="btn btn-primary">Add Bundle</a>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-xl-12 col-12 mb-5">
			<!-- card -->
			<div class="card h-100 card-lg">
				<div class="p-6">
					<div class="row justify-content-between">
						<div class="col-md-4 col-12 mb-2 mb-md-0">
							<!-- form -->
							<form class="d-flex" role="search">
								<input class="form-control" type="search" placeholder="Search by title" aria-label="Search" wire:model.lazy="search" />
							</form>
						</div>
						<div class="col-lg-2 col-md-4 col-12">
							<!-- select -->
							<select class="form-select" wire:model="status">
								<option value="">All Status</option>
								<option value="published">Published</option>
								<option value="draft">Draft</option>
							</select>
						</div>
					</div>
				</div>
				<!-- card body -->
				<div class="card-body p-0">
					<!-- table responsive -->
					<div class="table-responsive">
						<table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
							<thead class="bg-light">
								<tr>
									<th>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="checkAll" />
											<label class="form-check-label" for="checkAll"></label>
										</div>
									</th>
									<th wire:click="sortBy('title')" style="cursor: pointer;">
										Bundle Title
										@if($sortBy === 'title')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th>Products</th>
									<th wire:click="sortBy('sumup_price')" style="cursor: pointer;">
										Sum-up Price
										@if($sortBy === 'sumup_price')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th wire:click="sortBy('price')" style="cursor: pointer;">
										Bundle Price
										@if($sortBy === 'price')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th wire:click="sortBy('created_at')" style="cursor: pointer;">
										Created on
										@if($sortBy === 'created_at')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th wire:click="sortBy('status')" style="cursor: pointer;">
										Status
										@if($sortBy === 'status')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@forelse ($bundles as $bundle)
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="{{ $bundle->id }}" />
											<label class="form-check-label" for="orderOne"></label>
										</div>
									</td>
									<td>
										<a href="{{ route('store.marketing.bundles.edit',[request()->store,$bundle]) }}">
                                            <img src="{{ $bundle->photo }}" alt="" class="icon-shape icon-md" />
                                            {{ $bundle->title }}
                                        </a>
									</td>
									<td>{{ $bundle->productBundleVariants->pluck('variant.name')->implode(', ') }}</td>

									<td>{{ $store->country->currency_symbol }} {{ number_format($bundle->sumup_price, 2) }}</td>
									<td>{{ $store->country->currency_symbol }} {{ number_format($bundle->price, 2) }}</td>
									<td>{{ $bundle->created_at->format('d M Y') }}</td>
									<td>
										@if ($bundle->published)
										<span class="badge bg-light-primary text-dark-primary">Published</span>
										@else
										<span class="badge bg-light-warning text-dark-warning">Draft</span>
										@endif
									</td>
									<td>
										<div class="dropdown">
											<a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="feather-icon icon-more-vertical fs-5"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a class="dropdown-item" href="#">
														<i class="bi bi-trash me-3"></i>
														Delete
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="{{ route('store.marketing.bundles.edit', [request()->store,$bundle]) }}">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="9" class="text-center">No bundles found.</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
				<div class="border-top d-md-flex justify-content-between align-items-center p-6">
					{{ $bundles->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
