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
    const selectId = '{{ $uniqueId }}';
    const $select = $('#'+selectId);
    $select.select2({
        placeholder: '{{ $placeholder }}',
        allowClear: true,
        multiple: true,
        tags: true,
        width:'100%'
    });

    $select.off('change').on('change', function() {
        const values = $(this).val();
        Livewire.dispatch('select2MultipleValuesUpdated', {
            id: selectId,
            values: values
        });
    });

    Livewire.on(selectId, function(e) {
        const { id, values, selected } = e;
        if (id !== selectId) return;
        $select.select2('destroy');
        $select.empty();
        $select.append('<option value=""></option>');
        values.forEach(opt => {
            $select.append(`<option value="${opt.value}" data-extra="${opt.extra ?? ''}">${opt.label}</option>`);
        });
        $select.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true,
            multiple: true,
            tags: true,
            width:'100%'
        });
        $select.val(selected ?? []).trigger('change.select2');
    });
});
</script>
@endpush 