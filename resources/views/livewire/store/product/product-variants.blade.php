<div>
    <div id="variant_container">
        <h4 class="mb-3 h5">Product Variants</h4>
        <div class="card">
            @foreach($variants as $index => $variant)
            <div class="card-body border-bottom" wire:key="variant_card_body{{$index}}">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-muted">Variant <span>{{$loop->iteration}}</span></h4>
                    @if(count($variants) > 1)
                    <a href="#" class="text-danger fs-4"
                        wire:click.prevent="removeVariant({{ $index }})">
                        <i class="bi bi-x-circle"></i>
                    </a>
                    @endif
                </div>
                
                <div class="variant-row border rounded p-3 mb-3" wire:key="variant-row{{ $index }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    class="form-control"
                                    wire:model="variants.{{ $index }}.price"
                                    step="0.01"
                                    placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                    class="form-control"
                                    wire:model="variants.{{ $index }}.stock"
                                    placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Variant Photo</label>
                                @livewire('components.form.file-manager', [
                                'value' => $variant['photo'] ?? '',
                                'placeholder' => 'Select variant photo',
                                'wireModel' => 'variants.' . $index . '.photo',
                                'routePrefix' => $routePrefix,
                                'uniqueId' => 'file-manager-' . $index // <-- ensure unique
                                ], key('variant-photo-'.$index))
                            </div>
                        </div>
                        
                    </div>

                    <!-- Dynamic attribute options will be inserted here via JavaScript -->
                    <div class="variant-options-container mt-3" data-variant-index="{{ $index }}">
                        <!-- Options will be dynamically generated based on selected attributes -->
                            <div class="row">
                                @foreach ($availableAttributes as $key => $availableAttribute)
                                <div class="col-md-4" wire:key="variant_select_key-{{$key}}-index-{{$index}}">
                                    <label>{{ $availableAttribute['name'] }}</label>
                                    <select wire:key="variant_selects-{{$key}}-index-{{$index}}" class="form-control" wire:change="variantOptionSelected($event.target.value,'{{ $availableAttribute['id'] }}',{{$index}})" id="variant-{{$availableAttribute['id']}}-index-{{$index}}">
                                        <option value="">Select {{ $availableAttribute['name'] }}</option>
                                        @php
                                            $currentValue = $variantOptions[$index][$availableAttribute['id']] ?? '';
                                        @endphp
                                        @foreach($availableAttribute['options'] as $option)
                                            <option value="{{$option}}" {{ $option == $currentValue ? 'selected' : '' }}>{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
    <button type="button" class="btn btn-outline-primary my-3 w-100" wire:click="addVariant">
        <i class="fas fa-plus"></i> Add Variant
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Listen for attribute changes from ProductAttributes component
        
    });
</script>