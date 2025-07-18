<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>Vendor Dashboard</title>
    @livewireStyles
    @stack('styles')

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon/favicon.ico') }}">


    <!-- Libs CSS -->
    <link href="{{ asset('frontend/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}" />
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass">
        @livewire('layouts.store.header')
    </nav>

    <div class="main-wrapper">
        <!-- navbar vertical -->
        <!-- navbar -->
        <nav class="navbar-vertical-nav d-none d-xl-block">
            <div class="navbar-vertical">
                <div class="px-4 py-5">
                    <a @if(!request()->store) href="{{ route('welcome') }}" @else href="{{ route('store.dashboard', request()->store) }}" @endif class="navbar-brand">
                        <img src="{{ asset('frontend/images/logo/freshcart-logo.svg') }}" alt="" />
                    </a>
                </div>
                <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        
                        @livewire('layouts.store.sidemenu')
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- offcanvas -->
        <nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
            <div class="navbar-vertical">
                <div class="px-4 py-5 d-flex justify-content-between align-items-center">
                    <a @if(!isset($store)) href="{{ route('welcome') }}" @else href="{{ route('store.dashboard', $store) }}" @endif class="navbar-brand">
                        <img src="{{ asset('frontend/images/logo/freshcart-logo.svg') }}" alt="" />
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
                    <ul class="navbar-nav flex-column">
                        @livewire('layouts.store.sidemenu')
                    </ul>
                </div>
            </div>
        </nav>


        <main class="main-content-wrapper">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('frontend/js/vendors/jquery.min.js')}}"></script>
    <!-- Libs JS -->
    <script data-navigate-once src="{{ asset('frontend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <!-- Theme JS -->
    <script src="{{ asset('frontend/js/theme.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendors/validation.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    @livewireScripts
    <script>
		$(document).ready(function() {
			Livewire.on('closeModal', function(data) {
				console.log('Close modal event received:', data);
				const modalId = data[0].modalId;

				const modalEl = document.getElementById(modalId);

				// Check if Bootstrap modal instance already exists
				let modalInstance = bootstrap.Modal.getInstance(modalEl);
				if (!modalInstance) {
					// If not, create a new instance (Bootstrap 5)
					modalInstance = new bootstrap.Modal(modalEl);
				}
				// Hide the modal with Bootstrap 5 API
				modalInstance.hide();
			});
		});
	</script>
    @stack('scripts')
</body>

</html>