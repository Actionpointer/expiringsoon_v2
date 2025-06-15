@extends('layouts.frontend.store.app')

@section('content')
<div class="container">
	<!-- row -->
	<div class="row mb-8">
		<div class="col-md-12">
			<!-- page header -->
			<!-- page header -->
			<div class="d-md-flex justify-content-between align-items-center">
				<div>
					<h2>Giveaways</h2>
					<!-- breacrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">GiveAways</li>
						</ol>
					</nav>
				</div>
				<!-- button -->
				<div>
					<a href="{{ route('store.marketing.giveaways.create',1) }}" class="btn btn-primary">Add Giveaway</a>
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
								<input class="form-control" type="search" placeholder="Search" aria-label="Search" />
							</form>
						</div>
						<div class="col-lg-2 col-md-4 col-12">
							<!-- select -->
							<select class="form-select">
								<option selected>Status</option>
								<option value="Success">Success</option>
								<option value="Pending">Pending</option>
								<option value="Cancel">Cancel</option>
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
									
									<th>Giveaway Code</th>
									<th>Products</th>
									<th>Start Date</th>
									<th>Quantity</th>
									<th>Rule</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="orderOne" />
											<label class="form-check-label" for="orderOne"></label>
										</div>
									</td>
									
									<td>CODE</td>
									<td>Product A</td>

									<td>01 May 2023 (10:12 am)</td>
									<td>1000</td>
									<td>1 per user</td>
									<td>
										<span class="badge bg-light-primary text-dark-primary">Success</span>
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
													<a class="dropdown-item" href="#">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="orderOne" />
											<label class="form-check-label" for="orderOne"></label>
										</div>
									</td>
									
									<td>CODE</td>
									<td>Product A</td>

									<td>01 May 2023 (10:12 am)</td>
									<td>1000</td>
									<td>Many to 1 user</td>
									<td>
										<span class="badge bg-light-primary text-dark-primary">Success</span>
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
													<a class="dropdown-item" href="#">
														<i class="bi bi-pencil-square me-3"></i>
														Edit
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="border-top d-md-flex justify-content-between align-items-center p-6">
					<span>Showing 1 to 8 of 12 entries</span>
					<nav class="mt-2 mt-md-0">
						<ul class="pagination mb-0">
							<li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
							<li class="page-item"><a class="page-link active" href="#!">1</a></li>
							<li class="page-item"><a class="page-link" href="#!">2</a></li>
							<li class="page-item"><a class="page-link" href="#!">3</a></li>
							<li class="page-item"><a class="page-link" href="#!">Next</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection