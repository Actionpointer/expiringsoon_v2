<div>
    <select 
        id="{{ $uniqueId }}" 
        class="form-select select2-single" 
        data-placeholder="{{ $placeholder }}"
        wire:model="value" required
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
    function initSelect2(targetId) {
        const $select = $('#' + targetId);
        const placeholder = $select.data('placeholder') || $select.attr('data-placeholder') || '';
        if ($select.length === 0) return;
        if ($select.data('select2')) {
            $select.select2('destroy');
        }
        $select.select2({
            placeholder: placeholder,
            allowClear: true
        });
    }

    // Delegate change event for all select2-single elements
    $(document).on('select2:select', '.select2-single', function() {
        const selectId = $(this).attr('id');
        const value = $(this).val();
        const extra = $(this).find('option:selected').data('extra') ?? '';
        Livewire.dispatch('select2ValueUpdated', {
            id: selectId,
            value: value,
            extra: extra,
        });
    });

    // Initial run for all select2-single elements
    $('.select2-single').each(function() {
        initSelect2($(this).attr('id'));
    });

    // Listen for Livewire update event
    Livewire.on('init-select2-row', function(e) {
        const { index } = e[0];
        const targetId = 'select2-single-' + index;
        setTimeout(function() {
            initSelect2(targetId);
        }, 100);
    });
});
</script>
@endpush 