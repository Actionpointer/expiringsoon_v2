<div>
    <select 
        id="{{ $uniqueId }}" 
        class="form-select select2-single" 
        data-placeholder="{{ $placeholder }}"
        wire:model="value"
    >
        <option value=""></option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ $value == $this->value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:init', () => {
    window.initSelect2Single = function() {
        $('#{{ $uniqueId }}').select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true
        });
        // Remove previous change event
        $('#{{ $uniqueId }}').off('change').on('change', function() {
            const value = $(this).val();
            Livewire.dispatch('select2ValueUpdated', { 
                value: value, 
                wireModel: '{{ $wireModel }}',
                selectId: '{{ $uniqueId }}'
            });
            // Dispatch custom JS event for external listeners
            window.dispatchEvent(new CustomEvent('select2-single-changed-{{ $uniqueId }}', {
                detail: { value: value, selectId: '{{ $uniqueId }}' }
            }));
        });
    };
    window.initSelect2Single();
    // Remove previous event listener if exists
    if (window['updateSelect2Single{{ $uniqueId }}']) {
        window.removeEventListener('update-select2-single-{{ $uniqueId }}', window['updateSelect2Single{{ $uniqueId }}']);
    }
    window['updateSelect2Single{{ $uniqueId }}'] = function(e) {
        const { options, value } = e.detail;
        const $select = $('#{{ $uniqueId }}');
        $select.empty();
        $select.append('<option value=""></option>');
        for (const [val, label] of Object.entries(options)) {
            $select.append(`<option value="${val}">${label}</option>`);
        }
        $select.val(value).trigger('change');
        $select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true
        });
    };
    window.addEventListener('update-select2-single-{{ $uniqueId }}', window['updateSelect2Single{{ $uniqueId }}']);

});
</script>
@endpush 