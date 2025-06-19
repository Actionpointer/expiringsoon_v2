<div>
    <div class="input-group">
        <span class="input-group-btn">
            <a class="btn btn-primary file-manager-btn" 
               data-input="{{ $uniqueId }}" 
               data-preview="{{ $uniqueId }}_preview">
                <i class="fa fa-picture-o"></i> Choose
            </a>
        </span>
        <input 
            id="{{ $uniqueId }}" 
            class="form-control" 
            type="text" 
            placeholder="{{ $placeholder }}"
            wire:model="value"
        >
    </div>
    <div id="{{ $uniqueId }}_preview" class="border-dashed rounded-2" style="margin-top:15px;max-height:100px;"></div>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:init', () => {
    // Initialize File Manager for this specific instance
    $('.file-manager-btn[data-input="{{ $uniqueId }}"]').filemanager('image', {
        prefix: '{{ $routePrefix }}'
    });

    // Handle file manager value changes
    $('#{{ $uniqueId }}').on('change', function() {
        const value = $(this).val();
        Livewire.dispatch('fileManagerValueUpdated', { 
            value: value, 
            wireModel: '{{ $wireModel }}',
            inputId: '{{ $uniqueId }}'
        });
    });
});
</script>
@endpush 