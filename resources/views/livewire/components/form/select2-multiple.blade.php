<div>
    <select
        id="{{ $uniqueId }}"
        class="form-select select2-multiple w-100"
        data-placeholder="{{ $placeholder }}"
        multiple required
        wire:model="values">
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
        function initSelect2(targetId) {
            const $select = $('#' + targetId);
            const placeholder = $select.data('placeholder') || $select.attr('data-placeholder') || '';
            if ($select.length === 0) return;
            if ($select.data('select2')) {
                $select.select2('destroy');
            }
            $select.select2({
                placeholder: placeholder,
                allowClear: true,
                multiple: true,
                tags: true,
                width: '100%'
            });
        }

        // Delegate change event for all select2-multiple elements
        $(document).on('change', '.select2-multiple', function() {
            const selectId = $(this).attr('id');
            const values = $(this).val();
            Livewire.dispatch('select2MultipleValuesUpdated', {
                id: selectId,
                values: values
            });
        });

        // Initial run for all select2-multiple elements
        $('.select2-multiple').each(function() {
            initSelect2($(this).attr('id'));
        });

        // Listen for Livewire update event for this select2-multiple
        Livewire.on('updateSelectMultipleOptions', function(e) {
            const { id, values, selected } = e[0];
            const $select = $('#' + id);
            const placeholder = $select.data('placeholder') || $select.attr('data-placeholder') || '';
            $select.select2('destroy');
            $select.empty();
            $select.append('<option value=""></option>');
            values.forEach(opt => {
                $select.append(`<option value="${opt.value}" data-extra="${opt.extra ?? ''}">${opt.label}</option>`);
            });
            $select.select2({
                placeholder: placeholder,
                allowClear: true,
                multiple: true,
                tags: true,
                width: '100%'
            });
            $select.val(selected ?? []).trigger('change.select2');
        });

        // Listen for Livewire update event for new rows
        Livewire.on('init-select2-row', function(e) {
            const { index } = e[0];
            const targetId = 'select2-multiple-' + index;
            setTimeout(function() {
                initSelect2(targetId);
            }, 100);
        });
    });
</script>
@endpush