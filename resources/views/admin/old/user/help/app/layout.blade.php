<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Expiring Soon</title>
    <link rel="icon" type="image/png" href="{{asset('src/images/favicon/favicon-16x16.png')}}" />
    <link rel="stylesheet" href="{{asset('src/plugins/swiper-bundle/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('src/plugins/bvselect/style.css')}}" />
    <link rel="stylesheet" href="{{asset('src/plugins/venobox/style.css')}}" />
    <link rel="stylesheet" href="{{asset('src/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('src/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/select2/css/select2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/select2/css/custom.css')}}"/>
    <link rel="stylesheet" href="{{asset('src/css/style.css')}}" />
    
    @stack('styles')
    
</head>

<body>
    
    <div class="loader">
        <div class="loader-icon">
            <img src="{{asset('src/images/loader.gif')}}" alt="loader" />
        </div>
    </div>

    <!-- Header  Section start -->
    @yield('main')
    
    
    <script src="{{asset('src/js/jquery.min.js')}}"></script>
    <script src="{{asset('src/plugins/swiper-bundle/script.min.js')}}"></script>
    <script src="{{asset('src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('src/js/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('src/js/main.js')}}"></script>

</body>
</html>
