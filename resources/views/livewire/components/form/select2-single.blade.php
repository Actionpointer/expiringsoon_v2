<div>
    <select 
        id="{{ $uniqueId }}" 
        class="form-select select2-single" 
        data-placeholder="{{ $placeholder }}"
        wire:model="value"
    >
        <option value=""></option>
        @foreach($options as $option)
            <option 
                value="{{ $option['value'] }}"
                data-extra="{{ $option['extra'] ?? '' }}"
                {{ $option['value'] == $this->value ? 'selected' : '' }}
            >
                {{ $option['label'] }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:init', () => {
    const selectId = '{{ $uniqueId }}';
    const $select = $('#'+selectId);
    $select.select2({
        placeholder: '{{ $placeholder }}',
        allowClear: true
    });

    $select.on('change', function() {
        const value = $(this).val();
        const extra = $(this).find('option:selected').data('extra') ?? '';
        Livewire.dispatch('select2ValueUpdated', {
            id: selectId,
            value: value,
            extra: extra,
        });
    });

    Livewire.on(selectId, function(e) {
        const { id, values } = e;
        if (id !== selectId) return;
        $select.select2('destroy');
        $select.empty();
        $select.append('<option value=""></option>');
        values.forEach(opt => {
            $select.append(`<option value="${opt.value}" data-extra="${opt.extra ?? ''}">${opt.label}</option>`);
        });
        $select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true
        });
        $select.trigger('change.select2');
    });
});
</script>
@endpush 