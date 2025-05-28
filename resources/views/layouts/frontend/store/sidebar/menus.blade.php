@if(request()->routeIs('store.create'))
<li class="nav-item">
    <a class="nav-link active" href="{{ route('store.create') }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
            <span>Create Store</span>
        </div>
    </a>
</li>
@endif
<li class="nav-item mt-6 mb-3">
    <span class="nav-label">Store Managements</span>
</li>
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.dashboard')) active @endif @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.dashboard',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-house"></i></span>
            <span>Dashboard</span>
        </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.products')) active @endif @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.products',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
            <span class="nav-link-text">Products</span>
        </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed @if(request()->routeIs('store.create')) disabled @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navOrders" aria-expanded="false" aria-controls="navOrders">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-megaphone"></i></span>
            <span class="nav-link-text">Marketing</span>
        </div>
    </a>
    <div id="navOrders" class="collapse " data-bs-parent="#sideNavbar">
        <ul class="nav flex-column">
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.bundles',1)}}">Bundles</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.sales',1)}}">Sales</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.giveaways',1)}}">Giveaways</a>
            </li>
            
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.coupons',1)}}">Coupons</a>
            </li>
            
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.adverts',1)}}">Adverts</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.newsletters',1)}}">Newsletters</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{route('store.marketing.blog',1)}}">Blog</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.orders',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
            <span class="nav-link-text">Orders</span>
        </div>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.disputes',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-cash"></i></span>
            <span class="nav-link-text">Disputes</span>
        </div>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.reviews',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-star"></i></span>
            <span class="nav-link-text">Reviews</span>
        </div>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navStoreEarnings" aria-expanded="false" aria-controls="navStoreEarnings">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-cash"></i></span>
            <span class="nav-link-text">Earnings</span>
        </div>
    </a>
    <div id="navStoreEarnings" class="collapse " data-bs-parent="#sideNavbar">
        <ul class="nav flex-column">
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.earnings',1) }}">Income</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.earnings.withdrawals',1) }}">Withdrawals</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.analytics',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-bar-chart"></i></span>
            <span class="nav-link-text">Analytics</span>
        </div>
    </a>
</li>

<li class="nav-item mt-6 mb-3">
    <span class="nav-label">Site Settings</span>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed @if(request()->routeIs('store.create')) disabled @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navStoreSettings" aria-expanded="false" aria-controls="navStoreSettings">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-gear"></i></span>
            <span class="nav-link-text">Store Settings</span>
        </div>
    </a>
    <div id="navStoreSettings" class="collapse " data-bs-parent="#sideNavbar">
        <ul class="nav flex-column">
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.settings',1) }}">Store Details</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.settings.subscription',1) }}">Subscription</a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.settings.banking',1) }}">Bank Details</a>
            </li>
            
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.settings.compliance',1) }}">Compliance</a>
            </li>
            
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.settings.team',1) }}">Team</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store.notifications',1) }}">Notifications</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.media-library',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-images"></i></span>
            <span class="nav-link-text">Media Library</span>
        </div>
    </a>
</li>

<li class="nav-item mt-6 mb-3">
    <span class="nav-label">Support</span>
</li>
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs('store.create')) disabled @endif" href="{{ route('store.support',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-headphones"></i></span>
            <span class="nav-link-text">Support Ticket</span>
        </div>
    </a>
</li>
<!-- <li class="nav-item">
    <a class="nav-link " href="{{ route('store.support.help-center',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-question-circle"></i></span>
            <span class="nav-link-text">Help Center</span>
        </div>
    </a>
</li> -->

<li class="nav-item mt-6 mb-3">
    <span class="nav-label">Download Apps</span>
</li>
<li class="nav-item">
    <a class="nav-link " href="{{ route('store.support.help-center',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-apple"></i></span>
            <span class="nav-link-text">Apple Store</span>
        </div>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link " href="{{ route('store.support.help-center',1) }}">
        <div class="d-flex align-items-center">
            <span class="nav-link-icon"><i class="bi bi-google-play"></i></span>
            <span class="nav-link-text">Google Play Store</span>
        </div>
    </a>
</li>
