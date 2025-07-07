<div class="container">
	<!-- row -->
	<div class="row mb-8">
		<div class="col-md-12">
			<!-- page header -->
			<!-- page header -->
			<div class="d-md-flex justify-content-between align-items-center">
				<div>
					<h2>Coupon</h2>
					<!-- breacrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Coupon</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					<a href="{{ route('store.marketing.coupons.create', $store) }}" class="btn btn-primary">Add Coupon</a>
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
								<input class="form-control" type="search" wire:model.live="search" placeholder="Search coupons..." aria-label="Search" />
							</form>
						</div>
						<div class="col-lg-2 col-md-4 col-12">
							<!-- select -->
							<select class="form-select" wire:model.live="status">
								<option value="">All Status</option>
								<option value="active">Active</option>
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
									<th style="cursor: pointer;" wire:click="sortBy('code')">
										Coupon Code
										@if($sortBy === 'code')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th style="cursor: pointer;" wire:click="sortBy('value')">
										Value
										@if($sortBy === 'value')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th style="cursor: pointer;" wire:click="sortBy('start_at')">
										Start Date
										@if($sortBy === 'start_at')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th style="cursor: pointer;" wire:click="sortBy('end_at')">
										End Date
										@if($sortBy === 'end_at')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th style="cursor: pointer;" wire:click="sortBy('quantity')">
										Quantity
										@if($sortBy === 'quantity')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th style="cursor: pointer;" wire:click="sortBy('published')">
										Status
										@if($sortBy === 'published')
											<i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
										@endif
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@forelse($coupons as $coupon)
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="coupon{{ $coupon->id }}" />
											<label class="form-check-label" for="coupon{{ $coupon->id }}"></label>
										</div>
									</td>
									<td>{{ $coupon->code }}</td>
									<td>
										@if($coupon->type === 'percentage')
											{{ $coupon->value }}%
										@else
											{{ $store->country->currency_symbol ?? '$' }}{{ number_format($coupon->value, 2) }}
										@endif
									</td>
									<td>{{ $coupon->start_at ? \Carbon\Carbon::parse($coupon->start_at)->format('d M Y') : 'Not set' }}</td>
									<td>{{ $coupon->end_at ? \Carbon\Carbon::parse($coupon->end_at)->format('d M Y') : 'No expiry' }}</td>
									<td>{{ $coupon->quantity ?? 'Unlimited' }}</td>
									<td>
										@if($coupon->published)
											<span class="badge bg-light-primary text-dark-primary">Active</span>
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
													<a class="dropdown-item" href="#" wire:click="delete({{ $coupon->id }})">
														<i class="bi bi-trash me-3"></i>
														Delete
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="{{ route('store.marketing.coupons.edit', [$store, $coupon]) }}">
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
									<td colspan="8" class="text-center py-4">
										<p class="text-muted mb-0">No coupons found</p>
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
				<div class="border-top d-md-flex justify-content-between align-items-center p-6">
					<span>Showing {{ $coupons->firstItem() ?? 0 }} to {{ $coupons->lastItem() ?? 0 }} of {{ $coupons->total() }} entries</span>
					<nav class="mt-2 mt-md-0">
						{{ $coupons->links() }}
					</nav>
				</div>
			</div>
		</div>
	</div>
</div> 