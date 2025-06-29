<li class="nav-item d-none d-sm-inline-block">
    <!-- Apps -->
    <div class="dropdown">
        <button type="button" class="btn btn-icon btn-ghost-secondary rounded-circle" id="navbarAppsDropdown"
            data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
            <i class="bi-bell"></i>
        </button>

        <div
            class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless"
            aria-labelledby="navbarAppsDropdown" style="width: 25rem;">
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-title">Web apps &amp; services</h4>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body card-body-height">
                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{asset('backend/svg/brands/atlassian-icon.svg')}}"
                                    alt="Image Description">
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Atlassian</h5>
                                <p class="card-text text-body">Security and control across Cloud</p>
                            </div>
                        </div>
                    </a>

                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{asset('backend/svg/brands/slack-icon.svg')}}"
                                    alt="Image Description">
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Slack <span
                                        class="badge bg-primary rounded-pill text-uppercase ms-1">Try</span></h5>
                                <p class="card-text text-body">Email collaboration software</p>
                            </div>
                        </div>
                    </a>

                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{asset('backend/svg/brands/google-webdev-icon.svg')}}"
                                    alt="Image Description">
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Google webdev</h5>
                                <p class="card-text text-body">Work involved in developing a website</p>
                            </div>
                        </div>
                    </a>

                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{asset('backend/svg/brands/frontapp-icon.svg')}}"
                                    alt="Image Description">
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">Frontapp</h5>
                                <p class="card-text text-body">The inbox for teams</p>
                            </div>
                        </div>
                    </a>

                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3"
                                    src="{{asset('backend/svg/illustrations/review-rating-shield.svg')}}" alt="Image Description">
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">HS Support</h5>
                                <p class="card-text text-body">Customer service and support</p>
                            </div>
                        </div>
                    </a>

                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm avatar-soft-dark">
                                    <span class="avatar-initials"><i class="bi-grid"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-truncate ms-3">
                                <h5 class="mb-0">More Front products</h5>
                                <p class="card-text text-body">Check out more HS products</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <a class="card-footer text-center" href="#">
                    View all apps <i class="bi-chevron-right"></i>
                </a>
                <!-- End Footer -->
            </div>
        </div>
    </div>
    <!-- End Apps -->
</li>