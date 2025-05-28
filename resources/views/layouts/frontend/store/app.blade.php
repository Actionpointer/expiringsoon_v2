<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>Vendor Dashboard</title>
    @stack('styles')
    
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon/favicon.ico') }}">


    <!-- Libs CSS -->
    <link href="{{ asset('frontend/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/theme.min.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass">
        @include('layouts.frontend.store.topbar')
    </nav>

    <div class="main-wrapper">
        <!-- navbar vertical -->
        <!-- navbar -->
        @include('layouts.frontend.store.sidebar.desktop')
        

        <main class="main-content-wrapper">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('frontend/js/vendors/jquery.min.js')}}"></script>
    @stack('scripts')
    
    <!-- Libs JS -->
    
    <script src="{{ asset('frontend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('frontend/js/theme.min.js') }}"></script>

    <script src="{{ asset('frontend/js/vendors/validation.js') }}"></script>
</body>

</html>