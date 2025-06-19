<div>
    <h4 class="mb-3 h5">Product Attributes</h4>
    <div class="card">
        <div class="card-body" id="attribute_container">
            <div class="row mb-3">
                <div class="col-md-4"><label class="form-label">Attributes</label></div>
                <div class="col-md-8"><label class="form-label">Options</label></div>
            </div>
            
            @foreach($selectedAttributes as $index => $attributeId)
                <div class="row mb-3 attribute_row">
                    <div class="col-md-4">
                        @php
                            $attributeOptions = [];
                            foreach($productAttributes as $attr) {
                                $attributeOptions[$attr['slug']] = $attr['name'];
                            }
                        @endphp
                        @livewire('components.form.select2-single', [
                            'value' => $attributeId,
                            'options' => $attributeOptions,
                            'placeholder' => 'Select Attribute',
                            'wireModel' => 'selected_attributes.' . $index
                        ])
                    </div>
                    <div class="col-md-7 align-items-center">
                        @php
                            $selectedAttribute = collect($productAttributes)->first(function($attr) use ($attributeId) {
                                return $attr['slug'] === $attributeId;
                            });
                            $options = [];
                            if ($selectedAttribute && $selectedAttribute['options']) {
                                $optionsArray = explode(',', $selectedAttribute['options']);
                                foreach($optionsArray as $option) {
                                    $options[trim($option)] = trim($option);
                                }
                            }
                        @endphp
                        <!-- DEBUG: Show attributeId and options -->
                        <div class="text-muted small">
                            <strong>Attribute ID:</strong> {{ $attributeId }}<br>
                            <strong>Options:</strong> {{ json_encode($options) }}
                        </div>
                        
                        @livewire('components.form.select2-multiple', [
                            'values' => $selectedOptions[$index] ?? [],
                            'options' => $options,
                            'placeholder' => 'Select Options',
                            'wireModel' => 'selected_options.' . $index
                        ])
                    </div>
                    <div class="col-md-1 px-0">
                        @if($index > 0)
                            <a href="#" class="text-danger fs-4 p-2" wire:click="removeAttributeRow({{ $index }})">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-grid p-4">
            <button type="button" class="btn btn-outline-primary" wire:click="addAttributeRow">Add Attribute</button>
        </div>
    </div>
</div> 

<script>
    Livewire.on('select2 updated', function(data) {
        setTimeout(function() {
            $('destroy corresponding select2 multiple').select2('destroy').off()
            $('populate the corresponding select2 multiple with options from data')
            $('reinitialize the select2 element')
        }, 100);   
    });
</script>