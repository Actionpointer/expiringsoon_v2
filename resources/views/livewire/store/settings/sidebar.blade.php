<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            <a href="{{ route('store.settings', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-shop me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">Store Information</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('store.settings.notifications', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings.notification')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bell me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">Notification Settings</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('store.settings.subscription', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings.subscription')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-star me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">Subscription Plan</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('store.settings.banking', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings.banking')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bank me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">Bank Account Details</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('store.settings.compliance', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings.compliance')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-shield-check me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">KYC Compliance</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('store.settings.team', $store) }}" class="list-group-item list-group-item-action py-3 px-4 @if(Route::is('store.settings.team')) active @endif">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people me-3 fs-5"></i>
                    <div>
                        <h5 class="mb-0 fs-6">Team Members</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>