<div>
    <div class="input-group">
        <span class="input-group-btn">
            <a class="btn btn-primary file-manager-btn"
                data-input="{{ $uniqueId }}"
                data-preview="{{ $uniqueId }}_preview"
                data-route-prefix="{{$routePrefix}}"
                wire:key="fm-btn-{{ $uniqueId }}">
                <i class="fa fa-picture-o"></i> Choose
            </a>
        </span>
        <input
            id="{{ $uniqueId }}"
            class="form-control"
            type="text"
            placeholder="{{ $placeholder }}"
            wire:model="{{$wireModel}}" required
            wire:key="fm-input-{{ $uniqueId }}">
    </div>
    <div id="{{ $uniqueId }}_preview" class="border-dashed rounded-2" style="margin-top:15px;max-height:100px;"></div>
</div>

@push('scripts')
<script>
    function initFileManager(inputId) {
        const btn = $('.file-manager-btn[data-input="' + inputId + '"]');
        if (btn.data('fm-initialized')) return; // Prevent double init
        const routePrefix = btn.data('route-prefix');
        btn.filemanager('image', { prefix: routePrefix });
        btn.data('fm-initialized', true);

        $('#' + inputId).off('change.fm').on('change.fm', function() {
            const value = $(this).val();
            Livewire.dispatch('fileManagerValueUpdated', {
                value: value,
                wireModel: $(this).attr('wire:model') || '',
                inputId: inputId
            });
        });
    }

    function initAllFileManagers() {
        $('.file-manager-btn').each(function() {
            const inputId = $(this).data('input');
            initFileManager(inputId);
        });
    }

    document.addEventListener('livewire:init', function() {
        initAllFileManagers();
    });

    // Listen for Livewire DOM updates (for all dynamic changes)
    document.addEventListener('livewire:update', function() {
        setTimeout(initAllFileManagers, 50);
    });

    // Also listen for custom event from your component (optional, for extra safety)
    Livewire.on('init-file-manager', function(e) {
        if (Array.isArray(e) && e[0] && typeof e[0].index !== 'undefined') {
            const inputId = 'file-manager-' + e[0].index;
            setTimeout(function() {
                initFileManager(inputId);
            }, 100);
        }
    });

    // Initial input change handler for this instance
    $('#{{ $uniqueId }}').off('change.fm').on('change.fm', function() {
        const value = $(this).val();
        Livewire.dispatch('fileManagerValueUpdated', {
            value: value,
            wireModel: '{{ $wireModel }}',
            inputId: '{{ $uniqueId }}'
        });
    });
</script>
@endpush