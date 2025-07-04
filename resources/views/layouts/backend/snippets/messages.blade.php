<li class="nav-item d-none d-sm-inline-block">
    <!-- Notification -->
    <div class="dropdown">
        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
            id="navbarNotificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false"
            data-bs-auto-close="outside" data-bs-dropdown-animation>
            <i class="bi-chat-square-text"></i>
            <span class="btn-status btn-sm-status btn-status-danger"></span>
        </button>

        <div
            class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless"
            aria-labelledby="navbarNotificationsDropdown" style="width: 25rem;">
            <div class="card">
                <!-- Header -->
                <div class="card-header card-header-content-between">
                    <h4 class="card-title mb-0">Messages</h4>

                    <!-- Unfold -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                            id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-three-dots-vertical"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless"
                            aria-labelledby="navbarNotificationsDropdownSettings">
                            <span class="dropdown-header">Settings</span>
                            <a class="dropdown-item" href="#">
                                <i class="bi-archive dropdown-item-icon"></i> Archive all
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi-check2-all dropdown-item-icon"></i> Mark all as read
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi-toggle-off dropdown-item-icon"></i> Disable notifications
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi-gift dropdown-item-icon"></i> What's new?
                            </a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-header">Feedback</span>
                            <a class="dropdown-item" href="#">
                                <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                            </a>
                        </div>
                    </div>
                    <!-- End Unfold -->
                </div>
                <!-- End Header -->

                <!-- Nav -->
                <ul class="nav nav-tabs nav-justified" id="notificationTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#notificationNavOne" id="notificationNavOne-tab"
                            data-bs-toggle="tab" data-bs-target="#notificationNavOne" role="tab"
                            aria-controls="notificationNavOne" aria-selected="true">Messages (3)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#notificationNavTwo" id="notificationNavTwo-tab" data-bs-toggle="tab"
                            data-bs-target="#notificationNavTwo" role="tab" aria-controls="notificationNavTwo"
                            aria-selected="false">Archived</a>
                    </li>
                </ul>
                <!-- End Nav -->

                <!-- Body -->
                <div class="card-body-height">
                    <!-- Tab Content -->
                    <div class="tab-content" id="notificationTabContent">
                        <div class="tab-pane fade show active" id="notificationNavOne" role="tabpanel"
                            aria-labelledby="notificationNavOne-tab">
                            <!-- List Group -->
                            <ul class="list-group list-group-flush navbar-card-list-group">
                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck1"
                                                        checked>
                                                    <label class="form-check-label" for="notificationCheck1"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <img class="avatar avatar-sm avatar-circle" src="{{asset('backend/images/160x160/img3.jpg')}}"
                                                    alt="Image Description">
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Brian Warner</h5>
                                            <p class="text-body fs-5">changed an issue from "In Progress" to <span
                                                    class="badge bg-success">Review</span></p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">2hr</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck2"
                                                        checked>
                                                    <label class="form-check-label" for="notificationCheck2"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                                    <span class="avatar-initials">K</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Klara Hampton</h5>
                                            <p class="text-body fs-5">mentioned you in a comment</p>
                                            <blockquote class="blockquote blockquote-sm">
                                                Nice work, love! You really nailed it. Keep it up!
                                            </blockquote>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">10hr</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck3"
                                                        checked>
                                                    <label class="form-check-label" for="notificationCheck3"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="{{asset('backend/images/160x160/img10.jpg')}}"
                                                        alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Ruby Walter</h5>
                                            <p class="text-body fs-5">joined the Slack group HS Team</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">3dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck4">
                                                    <label class="form-check-label" for="notificationCheck4"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="{{asset('backend/svg/brands/google-icon.svg')}}"
                                                        alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">from Google</h5>
                                            <p class="text-body fs-5">Start using forms to capture the information of prospects
                                                visiting your Google website</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">17dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck5">
                                                    <label class="form-check-label" for="notificationCheck5"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="{{asset('backend/images/160x160/img7.jpg')}}" alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Sara Villar</h5>
                                            <p class="text-body fs-5">completed <i
                                                    class="bi-journal-bookmark-fill text-primary"></i> FD-7 task</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">2mn</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="tab-pane fade" id="notificationNavTwo" role="tabpanel"
                            aria-labelledby="notificationNavTwo-tab">
                            <!-- List Group -->
                            <ul class="list-group list-group-flush navbar-card-list-group">
                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck6">
                                                    <label class="form-check-label" for="notificationCheck6"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                                    <span class="avatar-initials">A</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Anne Richard</h5>
                                            <p class="text-body fs-5">accepted your invitation to join Notion</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">1dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck7">
                                                    <label class="form-check-label" for="notificationCheck7"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="{{asset('backend/images/160x160/img5.jpg')}}" alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Finch Hoot</h5>
                                            <p class="text-body fs-5">left Slack group HS projects</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">1dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck8">
                                                    <label class="form-check-label" for="notificationCheck8"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-dark avatar-circle">
                                                    <span class="avatar-initials">HS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Htmlstream</h5>
                                            <p class="text-body fs-5">you earned a "Top endorsed" <i
                                                    class="bi-patch-check-fill text-primary"></i> badge</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">6dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck9">
                                                    <label class="form-check-label" for="notificationCheck9"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="{{asset('backend/images/160x160/img8.jpg')}}" alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Linda Bates</h5>
                                            <p class="text-body fs-5">Accepted your connection</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">17dy</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item form-check-select">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="notificationCheck10">
                                                    <label class="form-check-label" for="notificationCheck10"></label>
                                                    <span class="form-check-stretched-bg"></span>
                                                </div>
                                                <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                                    <span class="avatar-initials">L</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col ms-n2">
                                            <h5 class="mb-1">Lewis Clarke</h5>
                                            <p class="text-body fs-5">completed <i
                                                    class="bi-journal-bookmark-fill text-primary"></i> FD-134 task</p>
                                        </div>
                                        <!-- End Col -->

                                        <small class="col-auto text-muted text-cap">2mts</small>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->

                                    <a class="stretched-link" href="#"></a>
                                </li>
                                <!-- End Item -->
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Body -->

                <!-- Card Footer -->
                <a class="card-footer text-center" href="#">
                    View all notifications <i class="bi-chevron-right"></i>
                </a>
                <!-- End Card Footer -->
            </div>
        </div>
    </div>
    <!-- End Notification -->
</li>