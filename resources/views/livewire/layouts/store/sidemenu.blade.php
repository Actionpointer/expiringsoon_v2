<div>
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
        <a class="nav-link 
            @if(request()->routeIs('store.dashboard')) active @endif 
            @if(request()->routeIs('store.create')) disabled @endif"
             @if(isset($store)) href="{{ route('store.dashboard',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-house"></i></span>
                <span>Dashboard</span>
            </div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link 
            @if(request()->routeIs('store.products')) active @endif 
            @if(request()->routeIs('store.create')) disabled @endif" 
            @if(isset($store)) href="{{ route('store.products',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                <span class="nav-link-text">Products</span>
            </div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed 
            @if(request()->is('*/marketing/*')) active @endif 
            @if(request()->routeIs('store.create')) disabled @endif" 
            href="#" data-bs-toggle="collapse" data-bs-target="#navOrders" aria-expanded="false" aria-controls="navOrders">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-megaphone"></i></span>
                <span class="nav-link-text">Marketing</span>
            </div>
        </a>
        <div id="navOrders" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/bundles')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.bundles',$store) }}" @endif>
                        Bundles
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/sales')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.sales',$store) }}" @endif>
                        Sales
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/giveaways')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.giveaways',$store) }}" @endif>
                        Giveaways
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/coupons')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.coupons',$store) }}" @endif>
                        Coupons
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/adverts')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.adverts',$store) }}" @endif>
                        Adverts
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/newsletters')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.newsletters',$store) }}" @endif>
                        Newsletters
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/marketing/blog')) active @endif" 
                    @if(isset($store)) href="{{ route('store.marketing.blog',$store) }}" @endif>
                        Blog
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/orders')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.orders',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
                <span class="nav-link-text">Orders</span>
            </div>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/disputes')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.disputes',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-cash"></i></span>
                <span class="nav-link-text">Disputes</span>
            </div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/reviews')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.reviews',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-star"></i></span>
                <span class="nav-link-text">Reviews</span>
            </div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/earnings')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        href="#" data-bs-toggle="collapse" data-bs-target="#navStoreEarnings" aria-expanded="false" aria-controls="navStoreEarnings">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-cash"></i></span>
                <span class="nav-link-text">Earnings</span>
            </div>
        </a>
        <div id="navStoreEarnings" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/earnings')) active @endif" 
                    @if(isset($store)) href="{{ route('store.earnings',$store) }}" @endif>
                        Income
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/earnings/withdrawals')) active @endif" 
                    @if(isset($store)) href="{{ route('store.earnings.withdrawals',$store) }}" @endif>
                        Withdrawals
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/analytics')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.analytics',$store) }}" @endif>
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
        <a class="nav-link collapsed 
        @if(request()->is('*/settings')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        href="#" data-bs-toggle="collapse" data-bs-target="#navStoreSettings" aria-expanded="false" aria-controls="navStoreSettings">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-gear"></i></span>
                <span class="nav-link-text">Store Settings</span>
            </div>
        </a>
        <div id="navStoreSettings" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/settings')) active @endif" 
                    @if(isset($store)) href="{{ route('store.settings',$store) }}" @endif>
                        Store Details
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/settings/subscription')) active @endif" 
                    @if(isset($store)) href="{{ route('store.settings.subscription',$store) }}" @endif>
                        Subscription
                    </a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/settings/banking')) active @endif" 
                    @if(isset($store)) href="{{ route('store.settings.banking',$store) }}" @endif>
                        Bank Details
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/settings/compliance')) active @endif" 
                    @if(isset($store)) href="{{ route('store.settings.compliance',$store) }}" @endif>
                        Compliance
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/settings/team')) active @endif" 
                    @if(isset($store)) href="{{ route('store.settings.team',$store) }}" @endif>
                        Team
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link 
                    @if(request()->is('*/notifications')) active @endif" 
                    @if(isset($store)) href="{{ route('store.notifications',$store) }}" @endif>
                        Notifications
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/media-library')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.media-library',$store) }}" @endif>
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
        <a class="nav-link 
        @if(request()->is('*/support')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.support',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-headphones"></i></span>
                <span class="nav-link-text">Support Ticket</span>
            </div>
        </a>
    </li>
    <!-- 
    <li class="nav-item">
        <a class="nav-link " href="{{ route('store.support.help-center',1) }}">
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-question-circle"></i></span>
                <span class="nav-link-text">Help Center</span>
            </div>
        </a>
    </li> 
    -->

    <li class="nav-item mt-6 mb-3">
        <span class="nav-label">Download Apps</span>
    </li>
    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/support/help-center')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.support.help-center',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-apple"></i></span>
                <span class="nav-link-text">Apple Store</span>
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link 
        @if(request()->is('*/support/help-center')) active @endif 
        @if(request()->routeIs('store.create')) disabled @endif" 
        @if(isset($store)) href="{{ route('store.support.help-center',$store) }}" @endif>
            <div class="d-flex align-items-center">
                <span class="nav-link-icon"><i class="bi bi-google-play"></i></span>
                <span class="nav-link-text">Google Play Store</span>
            </div>
        </a>
    </li>

</div>