<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <!-- page header -->
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Sales</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
<div>
                    <a href="{{ route('store.marketing.sales.create', $store) }}" class="btn btn-primary">Add Sales</a>
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
                                <input class="form-control" type="search" placeholder="Search by product name" aria-label="Search" wire:model.live="search" />
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <!-- select -->
                            <select class="form-select" wire:model.live="status">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
                                    <th wire:click="sortBy('id')" style="cursor: pointer;">
                                        Sales Code
                                        @if($sortBy === 'id')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Products</th>
                                    <th wire:click="sortBy('start_at')" style="cursor: pointer;">
                                        Start Date
                                        @if($sortBy === 'start_at')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('end_at')" style="cursor: pointer;">
                                        End Date
                                        @if($sortBy === 'end_at')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Original Price</th>
                                    <th>Sales Price</th>
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
                                @forelse($sales as $sale)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $sale->id }}" />
                                            <label class="form-check-label" for="orderOne"></label>
                                        </div>
                                    </td>
                                    <td>SALE#{{ $sale->id }}</td>
                                    <td>{{ $sale->product->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->start_at ? $sale->start_at->format('d M Y (h:i a)') : 'N/A' }}</td>
                                    <td>{{ $sale->end_at ? $sale->end_at->format('d M Y (h:i a)') : 'N/A' }}</td>
                                    <td>{{ $currencySymbol }}{{ number_format($sale->product->price ?? 0, 2) }}</td>
                                    <td>{{ $currencySymbol }}{{ number_format(($sale->product->price ?? 0) * (1 - ($sale->discount_percentage / 100)), 2) }}</td>
                                    <td>
                                        @if ($sale->published)
                                            <span class="badge bg-light-primary text-dark-primary">Active</span>
                                        @else
                                            <span class="badge bg-light-warning text-dark-warning">Inactive</span>
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
                                                    <a class="dropdown-item" href="{{ route('store.marketing.sales.edit', [$store, $sale]) }}">
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
                                    <td colspan="9" class="text-center">No sales found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
