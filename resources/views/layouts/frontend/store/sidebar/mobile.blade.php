<nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
    <div class="navbar-vertical">
        <div class="px-4 py-5 d-flex justify-content-between align-items-center">
            <a @if(request()->routeIs('store.create')) href="{{ route('welcome') }}" @else href="{{ route('store.dashboard', 1) }}" @endif  class="navbar-brand">
                <img src="{{ asset('frontend/images/logo/freshcart-logo.svg') }}" alt="" />
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column">
                @include('layouts.frontend.store.sidebar.menus')
            </ul>
        </div>
    </div>
</nav>