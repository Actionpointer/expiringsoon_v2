<div>
    <div id="variant_container">
        <h4 class="mb-3 h5">Product Variants</h4>
        @foreach($variants as $index => $variant)
        <div class="card">
            
            <div class="card-body">
                <div class="variant-row border rounded p-3 mb-3" wire:key="variant-{{ $index }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    class="form-control"
                                    wire:model="variants.{{ $index }}.price"
                                    step="0.01"
                                    placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                    class="form-control"
                                    wire:model="variants.{{ $index }}.stock"
                                    placeholder="0">
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
                                'routePrefix' => $routePrefix
                                ])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="d-flex">
                                    @if($variant['is_default'])
                                    <span class="badge badge-success mr-2">Default</span>
                                    @endif
                                    @if(count($variants) > 1)
                                    <button type="button"
                                        class="btn btn-sm btn-danger"
                                        wire:click="removeVariant({{ $index }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic attribute options will be inserted here via JavaScript -->
                    <div class="variant-options-container mt-3" data-variant-index="{{ $index }}">
                        <!-- Options will be dynamically generated based on selected attributes -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-outline-primary my-3 w-100" wire:click="addVariant">
        <i class="fas fa-plus"></i> Add Variant
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Listen for attribute changes from ProductAttributes component
        Livewire.on('attributesChanged', (data) => {
            updateVariantOptions(data.attributes);
        });

        function updateVariantOptions(attributes) {
            if (!Array.isArray(attributes)) return; // Defensive: only proceed if attributes is an array
            const containers = document.querySelectorAll('.variant-options-container');

            containers.forEach((container, variantIndex) => {
                container.innerHTML = '';

                attributes.forEach((attribute, attrIndex) => {
                    if (attribute.selected && Array.isArray(attribute.options) && attribute.options.length > 0) {
                        const select = document.createElement('select');
                        select.className = 'form-control mt-2';
                        select.setAttribute('wire:model', `variants.${variantIndex}.options.${attrIndex}`);
                        select.setAttribute('data-attribute-id', attribute.id);

                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = `Select ${attribute.name}`;
                        select.appendChild(option);

                        (Array.isArray(attribute.options) ? attribute.options : []).forEach(opt => {
                            const option = document.createElement('option');
                            option.value = opt.id || opt;
                            option.textContent = opt.name || opt;
                            select.appendChild(option);
                        });

                        const label = document.createElement('label');
                        label.textContent = attribute.name;
                        label.className = 'form-label mt-2';

                        container.appendChild(label);
                        container.appendChild(select);
                    }
                });
            });
        }
    });
</script>