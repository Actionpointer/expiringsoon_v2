<div>
    <select 
        id="{{ $uniqueId }}" 
        class="form-select select2-multiple w-100" 
        data-placeholder="{{ $placeholder }}"
        multiple
        wire:model="values"
    >
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ in_array($value, $this->values) ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:init', () => {
    function initSelect2Multiple() {
        $('#{{ $uniqueId }}').select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            multiple: true,
            tags: true,
            width:'100%'
        });
        // Remove previous change event
        $('#{{ $uniqueId }}').off('change').on('change', function() {
            const values = $(this).val();
            Livewire.dispatch('select2MultipleValuesUpdated', { 
                values: values, 
                wireModel: '{{ $wireModel }}',
                selectId: '{{ $uniqueId }}'
            });
            // Dispatch custom JS event for external listeners
            window.dispatchEvent(new CustomEvent('select2-multiple-changed-{{ $uniqueId }}', {
                detail: { values: values, selectId: '{{ $uniqueId }}' }
            }));
        });
    }
    initSelect2Multiple();
    // Remove previous event listener if exists
    if (window['updateSelect2Multiple{{ $uniqueId }}']) {
        window.removeEventListener('update-select2-multiple-{{ $uniqueId }}', window['updateSelect2Multiple{{ $uniqueId }}']);
    }
    window['updateSelect2Multiple{{ $uniqueId }}'] = function(e) {
        const { options, values } = e.detail;
        const $select = $('#{{ $uniqueId }}');
        $select.empty();
        for (const [val, label] of Object.entries(options)) {
            $select.append(`<option value="${val}">${label}</option>`);
        }
        $select.val(values).trigger('change');
        $select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            multiple: true,
            tags: true,
            width:'100%'
        });
    };
    window.addEventListener('update-select2-multiple-{{ $uniqueId }}', window['updateSelect2Multiple{{ $uniqueId }}']);
});

</script>
@endpush 