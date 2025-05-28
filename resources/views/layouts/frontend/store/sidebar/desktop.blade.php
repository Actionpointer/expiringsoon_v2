<nav class="navbar-vertical-nav d-none d-xl-block">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a @if(request()->routeIs('store.create')) href="{{ route('welcome') }}" @else href="{{ route('store.dashboard', 1) }}" @endif  class="navbar-brand">
                <img src="{{ asset('frontend/images/logo/freshcart-logo.svg') }}" alt="" />
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">
                @include('layouts.frontend.store.sidebar.menus')
            </ul>
        </div>
    </div>
</nav>