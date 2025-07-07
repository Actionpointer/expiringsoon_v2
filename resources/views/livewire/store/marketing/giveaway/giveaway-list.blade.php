<div class="container">
    <!-- row -->
    <div class="row mb-8">
        <div class="col-md-12">
            <!-- page header -->
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Giveaways</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Giveaways</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{ route('store.marketing.giveaways.create', $store) }}" class="btn btn-primary">Add Giveaway</a>
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
                                        Giveaway Code
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
                                    <th wire:click="sortBy('quantity')" style="cursor: pointer;">
                                        Quantity
                                        @if($sortBy === 'quantity')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Rule</th>
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
                                @forelse($giveaways as $giveaway)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $giveaway->id }}" />
                                            <label class="form-check-label" for="orderOne"></label>
                                        </div>
                                    </td>
                                    <td>GIVEAWAY#{{ $giveaway->id }}</td>
                                    <td>
                                        <div>
                                            <div class="fw-medium">{{ $giveaway->productVariant->product->name ?? 'N/A' }}</div>
                                            <small class="text-muted">{{ $giveaway->productVariant->name ?? 'N/A' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $giveaway->start_at ? $giveaway->start_at->format('d M Y (h:i a)') : 'Not set' }}</td>
                                    <td>{{ $giveaway->quantity ?? 'Unlimited' }}</td>
                                    <td>
                                        @if($giveaway->max_per_user == 1)
                                            <span class="badge bg-light-info text-dark-info">1 per user</span>
                                        @else
                                            <span class="badge bg-light-warning text-dark-warning">{{ $giveaway->max_per_user }} per user</span>
                                        @endif
                                        @if($giveaway->only_customers)
                                            <br><small class="text-muted">Existing customers only</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($giveaway->published)
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
                                                    <a class="dropdown-item" href="{{ route('store.marketing.giveaways.edit', [$store, $giveaway]) }}">
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
                                    <td colspan="8" class="text-center">No giveaways found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                    {{ $giveaways->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
