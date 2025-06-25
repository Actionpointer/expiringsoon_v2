<div>
    <h4 class="mb-3 h5">Product Attributes</h4>
    <div class="card">
        <div class="card-body" id="attribute_container">
            <div class="row mb-3">
                <div class="col-md-4"><label class="form-label">Attributes</label></div>
                <div class="col-md-8"><label class="form-label">Options</label></div>
            </div>
            
            @foreach($attributeRows as $index => $attributeId)
                @php
                    $singleId = 'select2-single-' . $index;
                    $multipleId = 'select2-multiple-' . $index;
                    $attributeOptions = [];
                    $options = [];
                    foreach($productAttributes as $attr) {
                        $attributeOptions[] = [
                            'value' => $attr['slug'],
                            'label' => $attr['name'],
                            'extra' => $attr['options'] ?? '',
                        ];
                    }
                @endphp
                <div class="row mb-3 attribute_row" wire:key="attribute-row-{{ $index }}">
                    <div class="col-md-4">
                        @livewire('components.form.select2-single', [
                            'value' => is_array($attributeId) ? $attributeId['value'] : $attributeId,
                            'options' => $attributeOptions,
                            'placeholder' => 'Select Attribute',
                            'wireModel' => 'attributeRows.' . $index,
                            'uniqueId' => $singleId
                        ],key('select2-single-'.$index))
                    </div>
                    <div class="col-md-7 align-items-center">
                        @livewire('components.form.select2-multiple', [
                            'values' => $selectedOptions[$index] ?? [],
                            'options' => $options,
                            'placeholder' => 'Select Options',
                            'wireModel' => 'selected_options.' . $index,
                            'uniqueId' => $multipleId
                        ],key('select2-multiple-'.$index))
                    </div>
                    <div class="col-md-1 px-0">
                        @if($index > 0)
                            <a href="#" class="text-danger fs-4 p-2" wire:click.prevent="removeAttributeRow({{ $index }})">
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