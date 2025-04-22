<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="#" aria-label="Front">
                @include('layouts.base.snippets.logo')
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <div class="nav-item">
                        <a class="nav-link @if(Route::is('admin.dashboard')) active @endif" href="#" data-placement="left">
                            <i class="bi-house-door nav-icon"></i>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </div>

                    <!-- End Collapse -->

                    <span class="dropdown-header mt-1">Entities</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <div id="navbarVerticalMenuPagesMenu">
                        <!-- Consumers -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesUsersMenu" role="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="false"
                                aria-controls="navbarVerticalMenuPagesUsersMenu">
                                <i class="bi-people-fill nav-icon"></i>
                                <span class="nav-link-title">Stakeholders</span>
                            </a>

                            <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse"
                                data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <a class="nav-link" href="#">Users</a>
                                <a class="nav-link" href="#">Shops</a>
                                
                            </div>
                        </div>
                        <!-- End Consumers -->

                        <!-- Logistics Companies -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesUserProfileMenu" role="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUserProfileMenu"
                                aria-expanded="false" aria-controls="navbarVerticalMenuPagesUserProfileMenu">
                                <i class="bi-grid-3x3-gap nav-icon"></i>
                                <span class="nav-link-title">Resources</span>
                            </a>

                            <div id="navbarVerticalMenuPagesUserProfileMenu" class="nav-collapse collapse"
                                data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <a class="nav-link" href="#">Orders</a>
                                <a class="nav-link" href="#">Products</a>
                                
                                <a class="nav-link" href="#">Coupons</a>

                            </div>
                        </div>
                        <!-- Insurance Companies -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesProjectsMenu" role="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesProjectsMenu" aria-expanded="false"
                                aria-controls="navbarVerticalMenuPagesProjectsMenu">
                                <i class="bi-megaphone nav-icon"></i>
                                <span class="nav-link-title">Ads Manager</span>
                            </a>

                            <div id="navbarVerticalMenuPagesProjectsMenu" class="nav-collapse collapse"
                                data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <a class="nav-link" href="#">Adsets</a>
                                <a class="nav-link" href="#">Ads</a>
                                <a class="nav-link" href="#">Reports</a>
                                

                            </div>
                        </div>
                        <!-- End Courier Setting -->
                    </div>
                    <!-- End Collapse -->

                    <span class="dropdown-header mt-1">Logistics</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuLogisticsMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuLogisticsMenu" aria-expanded="false"
                            aria-controls="navbarVerticalMenuLogisticsMenu">
                            <i class="bi-truck nav-icon"></i>
                            <span class="nav-link-title">Shipping</span>
                        </a>

                        <div id="navbarVerticalMenuLogisticsMenu" class="nav-collapse collapse"
                            data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <a class="nav-link" href="#"><i class="bi-people-fill nav-icon"></i> Shippers</a>
                            <a class="nav-link" href="#"><i class="bi-tags-fill nav-icon"></i> Shipment Rates</a>
                            <a class="nav-link" href="#"><i class="bi-box-seam nav-icon"></i> Shipments</a>
                        </div>
                    </div>

                    <span class="dropdown-header mt-1">Compliance </span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <!-- E-commerce -->
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuComplianceMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuComplianceMenu" aria-expanded="false"
                            aria-controls="navbarVerticalMenuComplianceMenu">
                            <i class="bi-shield-check nav-icon"></i>
                            <span class="nav-link-title">Compliance</span>
                        </a>

                        <div id="navbarVerticalMenuComplianceMenu" class="nav-collapse collapse">
                            <a class="nav-link" href="#">All Submissions</a>
                            <a class="nav-link" href="#">Pending Approvals</a>
                            <a class="nav-link" href="#">Rejected Submissions</a>
                        </div>
                    </div>
                    <!-- End E-commerce -->

                    
                    <!-- End Projects -->


                    <span class="dropdown-header mt-1">Support</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                    <!-- Authentication -->
                    <div class="nav-item">
                        <a class="nav-link" href="#" data-placement="left">
                            <i class="bi-ticket-detailed nav-icon"></i>
                            <span class="nav-link-title">Support Tickets</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="#" data-placement="left">
                            <i class="bi-ticket-detailed-fill nav-icon"></i>
                            <span class="nav-link-title">Closed Tickets</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesDisputesMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesDisputesMenu"
                            aria-expanded="false" aria-controls="navbarVerticalMenuPagesDisputesMenu">
                            <i class="bi-exclamation-diamond nav-icon"></i>
                            <span class="nav-link-title">Disputes</span>
                        </a>

                        <div id="navbarVerticalMenuPagesDisputesMenu" class="nav-collapse collapse"
                            data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <a class="nav-link" href="#">All Disputes</a>
                            <a class="nav-link" href="#">Pending Disputes</a>
                            <a class="nav-link" href="#">Resolved Disputes</a>
                            <a class="nav-link" href="#">Closed Disputes</a>
                        </div>
                    </div>
                    <!-- End Project -->
                    <span class="dropdown-header mt-1">Finance</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                    <div class="nav-item">
                        <a class="nav-link " href="#" data-placement="left">
                            <i class="bi-graph-up nav-icon"></i>
                            <span class="nav-link-title">Revenues</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link " href="#" data-placement="left">
                            <i class="bi-credit-card nav-icon"></i>
                            <span class="nav-link-title">Payments</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesAccountMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesAccountMenu" aria-expanded="false"
                            aria-controls="navbarVerticalMenuPagesAccountMenu">
                            <i class="bi-wallet2 nav-icon"></i>
                            <span class="nav-link-title">Withdrawals</span>
                        </a>

                        <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse "
                            data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <a class="nav-link " href="#">Pending Approvals</a>
                            <a class="nav-link " href="#">Completed Withdrawals</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link " href="#" data-placement="left">
                            <i class="bi-receipt-cutoff nav-icon"></i>
                            <span class="nav-link-title">Settlements</span>
                        </a>
                    </div>

                    <!-- <div class="nav-item">
                        <a class="nav-link " href="{{-- route('coupons.index') --}}" data-placement="left">
                            <i class="bi-x-diamond nav-icon"></i>
                            <span class="nav-link-title">Coupons</span>
                        </a>
                    </div> -->
                    
                    <span class="dropdown-header mt-1">Settings & Security</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <!-- Settings Menu -->
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuSettingsMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuSettingsMenu"
                            aria-expanded="false" aria-controls="navbarVerticalMenuSettingsMenu">
                            <i class="bi-gear nav-icon"></i>
                            <span class="nav-link-title">Settings</span>
                        </a>

                        <div id="navbarVerticalMenuSettingsMenu" class="nav-collapse collapse"
                            data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <a class="nav-link" href="{{ route('admin.settings.index') }}">
                                <i class="bi-sliders nav-icon"></i> General
                            </a>
                            <a class="nav-link" href="{{ route('admin.settings.currencies.index') }}">
                                <i class="bi-currency-exchange nav-icon"></i> Currencies
                            </a>
                            <a class="nav-link" href="{{ route('admin.settings.places.index') }}">
                                <i class="bi-geo-alt nav-icon"></i> Places
                            </a>
                            <a class="nav-link" href="{{ route('admin.settings.categories.index') }}">
                                <i class="bi-diagram-3 nav-icon"></i> Categories
                            </a>
                            <a class="nav-link" href="{{ route('admin.settings.staff.index') }}">
                                <i class="bi-people nav-icon"></i> Staff
                            </a>
                            <a class="nav-link" href="{{ route('admin.settings.plans.index') }}">
                                <i class="bi-boxes nav-icon"></i> Plans
                            </a>
                        </div>
                    </div>

                    <!-- Security Menu -->
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuSecurityMenu" role="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuSecurityMenu"
                            aria-expanded="false" aria-controls="navbarVerticalMenuSecurityMenu">
                            <i class="bi-shield-lock nav-icon"></i>
                            <span class="nav-link-title">Security</span>
                        </a>

                        <div id="navbarVerticalMenuSecurityMenu" class="nav-collapse collapse"
                            data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <!-- API Submenu -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuAPIMenu" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAPIMenu"
                                    aria-expanded="false" aria-controls="navbarVerticalMenuAPIMenu">
                                    <i class="bi-braces nav-icon"></i>
                                    <span class="nav-link-title">API</span>
                                </a>
                                <div id="navbarVerticalMenuAPIMenu" class="nav-collapse collapse">
                                    <a class="nav-link" href="{{ route('admin.security.api.keys') }}">
                                        <i class="bi-key nav-icon"></i> API Keys
                                    </a>
                                    <a class="nav-link" href="{{ route('admin.security.api.logs') }}">
                                        <i class="bi-clock-history nav-icon"></i> Access Logs
                                    </a>
                                </div>
                            </div>

                            <!-- Monitoring Submenu -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuMonitoringMenu" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuMonitoringMenu"
                                    aria-expanded="false" aria-controls="navbarVerticalMenuMonitoringMenu">
                                    <i class="bi-shield-exclamation nav-icon"></i>
                                    <span class="nav-link-title">Monitoring</span>
                                </a>
                                <div id="navbarVerticalMenuMonitoringMenu" class="nav-collapse collapse">
                                    <a class="nav-link" href="{{ route('admin.security.monitoring.ips') }}">
                                        <i class="bi-ban nav-icon"></i> Blacklisted IPs
                                    </a>
                                    <a class="nav-link" href="{{ route('admin.security.monitoring.shops') }}">
                                        <i class="bi-shop-slash nav-icon"></i> Blacklisted Shops
                                    </a>
                                    <a class="nav-link" href="{{ route('admin.security.monitoring.users') }}">
                                        <i class="bi-person-x nav-icon"></i> Blacklisted Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    



                </div>

            </div>
            <!-- End Content -->

            <!-- Footer -->
            <div class="navbar-vertical-footer">
                <ul class="navbar-vertical-footer-list">
                    <li class="navbar-vertical-footer-list-item">
                        <!-- Style Switcher -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                                aria-labelledby="selectThemeDropdown">
                                <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                    <i class="bi-moon-stars me-2"></i>
                                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                                </a>
                                <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                                    <i class="bi-brightness-high me-2"></i>
                                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                                </a>
                                <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                    <i class="bi-moon me-2"></i>
                                    <span class="text-truncate" title="Dark">Dark</span>
                                </a>
                            </div>
                        </div>

                        <!-- End Style Switcher -->
                    </li>

                    <li class="navbar-vertical-footer-list-item">
                        <!-- Other Links -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="otherLinksDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                                <i class="bi-info-circle"></i>
                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="otherLinksDropdown">
                                <span class="dropdown-header">Help</span>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-journals dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-command dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Keyboard shortcuts">Keyboard shortcuts</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-alt dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Connect other apps">Connect other apps</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-gift dropdown-item-icon"></i>
                                    <span class="text-truncate" title="What's new?">What's new?</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-header">Contacts</span>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-chat-left-dots dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Contact support">Contact support</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Other Links -->
                    </li>

                    <li class="navbar-vertical-footer-list-item">
                        <!-- Language -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                id="selectLanguageDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-dropdown-animation>
                                <img class="avatar avatar-xss avatar-circle" src="{{asset('vendor/flag-icon-css/flags/1x1/us.svg')}}"
                                    alt="United States Flag">
                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                                <span class="dropdown-header">Select language</span>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/us.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="English">English (US)</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/gb.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="English">English (UK)</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/de.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="Deutsch">Deutsch</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/dk.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="Dansk">Dansk</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/it.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="Italiano">Italiano</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img class="avatar avatar-xss avatar-circle me-2"
                                        src="{{asset('vendor/flag-icon-css/flags/1x1/cn.svg')}}" alt="Flag">
                                    <span class="text-truncate" title="中文 (繁體)">中文 (繁體)</span>
                                </a>
                            </div>
                        </div>

                        <!-- End Language -->
                    </li>
                </ul>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</aside>