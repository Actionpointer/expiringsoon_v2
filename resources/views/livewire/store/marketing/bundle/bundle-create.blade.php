<div class="container">
    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <!-- page header -->
                <div>
                    <h2>Add Bundle</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Stores</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Tech Gadgets Store</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Bundles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Bundle</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{route('store.marketing.bundles',$store)}}" class="btn btn-light">Back to Bundles</a>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body p-4">
                        <h4 class="mb-4 h5">Bundle Information</h4>
                        <!-- Bundle Title -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Title</label>
                            <input type="text" class="form-control" placeholder="Christmas Bundle" wire:model.defer="title" required />
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Select Products -->
                        <div class="mb-4">
                            <label class="form-label">Select Product Variants</label>
                            <livewire:components.form.select2-multiple
                                :options="collect($allVariants)->pluck('name', 'id')->toArray()"
                                uniqueId="bundle-variants-select"
                                placeholder="Select product variants to add to bundle"
                                wire:model="selectedVariants"
                            />
                            @error('selectedVariants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Bundle Image -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Image</label>
                            @livewire('components.form.file-manager', [
                                    'uniqueId' => 'bundle-image-input',
                                    'placeholder' => 'Choose bundle images',
                                    'wireModel' => 'image',
                                    'routePrefix' => route('store.filemanager', $store)
                                ])
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Bundle Price -->
                        <div class="mb-4">
                            <label class="form-label">Bundle Price</label>
                            <input type="number" class="form-control" placeholder="Enter bundle price" wire:model.live="price" min="1" step="0.01" />
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" wire:click="save(false)">Publish</button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="save(true)">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body p-4">
                        <h4 class="mb-4 h5">Bundle Summary</h4>
                        <!-- Selected Products -->
                        <h6 class="mb-3">Selected Product Variants</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-hover border">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Product Variant</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($summaryVariants as $variant)
                                    <tr>
                                        <td>{{ $variant['name'] }}</td>
                                        <td>{{ $currencySymbol }}{{ number_format($variant['price'], 2) }}</td>
                                        <td>{{ $variant['stock'] }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No variants selected.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Summary -->
                        <h6 class="mb-3">Summary</h6>
                        <table class="table summary-table">
                            <tr>
                                <td>Number of Items:</td>
                                <td class="text-end">{{ count($summaryVariants) }}</td>
                            </tr>
                            <tr>
                                <td>Sum Up Price:</td>
                                <td class="text-end">{{ $currencySymbol }}{{ number_format(collect($summaryVariants)->sum('price'), 2) }}</td>
                            </tr>
                            <tr>
                                <td>Bundle Price:</td>
                                <td class="text-end">{{ $currencySymbol }}{{ number_format($price, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Discount:</td>
                                <td class="text-end">{{ $currencySymbol }}{{ number_format(collect($summaryVariants)->sum('price') - floatval($price), 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
