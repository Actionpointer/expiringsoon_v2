<li class="nav-item">
    <!-- Account -->
    <div class="dropdown">
        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
            @if(auth()->user()->photo)
            <div class="avatar avatar-sm avatar-circle">
                <img class="avatar-img" src="{{Storage::url(auth()->user()->photo)}}" alt="Image Description">
                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
            </div>
            @else
            <div class="flex-shrink-0">
                <div class="avatar avatar-sm avatar-dark avatar-circle">
                    <span class="avatar-initials">{{ auth()->user()->initials }}</span>
                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                </div>
                
            </div>
            @endif
            
        </a>

        <div
            class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
            aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
            <div class="dropdown-item-text">
                <div class="d-flex align-items-center">
                    @if(auth()->user()->photo)
                    <div class="avatar avatar-sm avatar-circle">
                        <img class="avatar-img" src="{{Storage::url(auth()->user()->photo)}}" alt="Image Description">
                    </div>
                    @else
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-sm avatar-dark avatar-circle">
                            <span class="avatar-initials">{{ auth()->user()->initials }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="flex-grow-1 ms-3" style="min-width: 0;">
                        <h5 class="mb-0 text-truncate">{{ auth()->user()->name }}</h5>
                        <p class="card-text text-body text-truncate mb-0">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="dropdown-divider"></div>

            <!-- Dropdown -->

            <!-- End Dropdown -->

            <a class="dropdown-item" href="{{route('account')}}">Profile &amp; account</a>
            <a class="dropdown-item" href="#">Referrals</a>
            <a class="dropdown-item" href="#">Support</a>

            <div class="dropdown-divider"></div>


            @if(auth()->user()->profile_id)
            <!-- Dropdown -->
            <div class="dropdown">
                <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;"
                    id="navSubmenuPagesAccountDropdown2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        @if(auth()->user()->profile->photo)
                        <div class="avatar avatar-sm avatar-circle">
                            <img class="avatar-img" src="{{Storage::url(auth()->user()->profile->photo)}}" alt="Image Description">
                        </div>
                        @else
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-sm avatar-dark avatar-circle">
                                <span class="avatar-initials">{{ auth()->user()->profile->initials }}</span>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex-grow-1 ms-2" style="min-width: 0;">
                            <h5 class="mb-0 text-truncate">{{ auth()->user()->profile->name }}</h5>
                            <span class="card-text text-truncate d-block">{{ ucwords(auth()->user()->profile->type) }}</span>
                        </div>
                    </div>
                </a>

                <div
                    class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu"
                    aria-labelledby="navSubmenuPagesAccountDropdown2">
                    @foreach (auth()->user()->profiles->except(auth()->user()->profile_id) as $profile)

                    <a data-profile_id="{{ $profile->id }}" class="dropdown-item text-truncate" href="/{{$profile->slug}}" onclick="event.preventDefault(); document.getElementById('switch_profile_id').value = @json($profile->id) ;document.getElementById('switch-profile').submit();">
                        {{ $profile->name }} <i class="bi-box-arrow-in-up-right"></i>
                        
                    </a>  
                                        
                    @endforeach                   
                    <a class="dropdown-item text-truncate border-top" href="{{route('profile.create')}}">
                        Add New Profile <i class="bi-box-arrow-in-up-right"></i>
                    </a>
                </div>
            </div>
            <!-- End Dropdown -->

            <a class="dropdown-item" href="{{route('profile.settings.general')}}">Settings</a>
            
            <div class="dropdown-divider"></div>
            @endif
            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-forms').submit();">Sign out</a>
            <form id="logout-forms" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <form id="switch-profile" action="{{ route('profile.switch') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="profile_id" id="switch_profile_id">
            </form>
        </div>
    </div>
    <!-- End Account -->
</li>