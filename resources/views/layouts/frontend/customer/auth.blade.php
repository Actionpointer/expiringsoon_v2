<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>Expiring Soon</title>
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
  <!-- navigation -->
  <div class="border-bottom shadow-sm">
    <nav class="navbar navbar-light py-2">
      <div class="container justify-content-center justify-content-lg-between">
        <a class="navbar-brand" href="{{ route('welcome') }}">
          <img src="{{ asset('frontend/images/logo/freshcart-logo.svg') }}" alt="" class="d-inline-block align-text-top">
        </a>
        <span class="navbar-text">
            @if (Route::is('signin'))
                Don’t have an account? <a href="{{ route('signup') }}">Sign Up</a>
            @else
                Already have an account? <a href="{{ route('signin') }}">Sign in</a>
            @endif
          
        </span>
      </div>
    </nav>
  </div>


  <main>
    <!-- section -->
    {{ $slot }}
  </main>

  @include('layouts.frontend.customer.footer')

  <script src="{{ asset('frontend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/libs/simplebar/dist/simplebar.min.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('frontend/js/theme.min.js') }}"></script>

  <script src="{{ asset('frontend/js/vendors/password.js') }}"></script>
  <script src="{{ asset('frontend/js/vendors/validation.js') }}"></script>
</body>

</html>