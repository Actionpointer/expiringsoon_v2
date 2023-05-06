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
    
    <style>
        .ec-cart-float,.ec-wish-float {
            display: none;
            position: fixed;
            width: 100px;
            height: 100px;
            bottom: 50%;
            right: 49%;
            border-radius: 50px;
            padding: 15px;
            -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
                    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
            z-index: 15;
            background: #00b207;
        }
        .ec-cart-float .ec-cart-count,.ec-wish-float .wish-counter {
            position: absolute;
            top: 20px;
            right: 0;
            left: 0;
            bottom: 0;
            background: #000;
            color: #ffffff;
            height: 18px;
            width: 18px;
            border-radius: 50%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin: auto;
            font-size: 12px;
            line-height: 30px;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
        }
        .ec-wish-float .wish-counter{
            top:5px !important;
        }

        @media (max-width: 550px) {
            .ec-cart-float,.ec-wish-float {
                position: fixed;
                width: 100px;
                height: 100px;
                top: 30%;
                right: 40%;
                border-radius: 50px;
                padding: 15px;
                -webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
                        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
                z-index: 15;
                background: #00b207;
            }
        }

        .stock-out {
            background: #ea4b4833;
            color: #ea4b48;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: capitalize;
            font-weight: 500;
        }

        .product-title {
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 500;
            width: 180px;
        }

        .show-heart {
            opacity: 1;
            visibility: visible;
        }

        .liked {
            visibility: visible;
            width: 40px;
            height: 40px;
            border-radius: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            color: #fff;
            background-color: #00b207;
            -webkit-transition: all 0.3s linear;
            transition: all 0.3s linear; 
        }
        .liked:hover {
            color: #1a1a1a;
            background-color: #f2f2f2;
            border-color: transparent; 
        }
        .notify{
            margin-top: 0px;
            margin-bottom: 20px;
            text-align: center;
            background-color: #00b207;
            color: #fff;
            padding: 10px;
            width: 100%;
            height: 45px;
        }

        .error{
            margin-top: 0px;
            margin-bottom: 20px;
            text-align: center;
            background-color: #e84a4a;
            color: #fff;
            padding: 10px;
            width: 100%;
        }

        @media screen and (max-width: 480px){
            .notify, .error{
                margin-top: -30px;
                margin-bottom: 20px;
                padding: 10px;
                height: 45px;
            }
        }
    </style>
    @stack('styles')
    
</head>

<body>
    <div class="ec-cart-float">
        <svg width="70" height="70" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="ec-cart-count">{{Session::has('carts') ? session('carts')->count() : 0}}</div>
        @php $total = 0 @endphp
        @if(Session::has('carts') && session('carts')->count())
            @foreach(session('carts') as $cart)
                @php $total += $cart['amount'] * $cart['quantity'] @endphp
            @endforeach
        @endif
    </div>
    <div class="ec-wish-float">
        <svg width="70" height="70" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="white" stroke-width="1.5" />
        </svg>
        <div class="wish-counter">{{auth()->check() ? auth()->user()->likes->count() : 0}}</div>
    </div>
    <div class="loader">
        <div class="loader-icon">
            <img src="{{asset('src/images/loader.gif')}}" alt="loader" />
        </div>
    </div>

    <!-- Header Section start -->
    <header class="header header--two">
        <div class="header__top" style="background:#1a1a1a;color:#b2b2b2">
            <div class="container">
                <div class="header__top-content">
                    <div class="header__top-left">
                        <p class="font-body--sm">
                            <span>
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 8.36364C16 14.0909 8.5 19 8.5 19C8.5 19 1 14.0909 1 8.36364C1 6.41068 1.79018 4.53771 3.1967 3.15676C4.60322 1.77581 6.51088 1 8.5 1C10.4891 1 12.3968 1.77581 13.8033 3.15676C15.2098 4.53771 16 6.41068 16 8.36364Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.5 10.8182C9.88071 10.8182 11 9.71925 11 8.36364C11 7.00803 9.88071 5.90909 8.5 5.90909C7.11929 5.90909 6 7.00803 6 8.36364C6 9.71925 7.11929 10.8182 8.5 10.8182Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Office: 5100 West Commercial Blvd, Tamarac, FL 33319
                        </p>
                    </div>
                    
                    <div class="header__top-right">
                        
                        {{-- <div class="header__dropdown">
                            <select id="states" class="header__dropdown-menu">
                              <option value="pt_1" selected>Lagos</option>
                              <option value="en_2">Rivers</option>
                              <option value="ch_4">Delta</option>
                              <option value="5">Abuja</option>
                            </select>
                        </div> --}}
                        <div class="header__in">
                            @guest
                            <a href="{{route('login')}}">Login</a>
                            <span>|</span>
                            <a href="{{route('register')}}">Register</a>
                            <span>|</span>
                            <a href="{{route('start-selling')}}">Start Selling</a>
                            @else
                            <div class="header__navigation-menu-link p-0">
                                <a href="#">
                                  Account
                                  <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M3.33332 5.66667L7.99999 10.3333L12.6667 5.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                  </span>
                                </a>
                                <ul class="header__navigation-drop-menu top">
                                  <li class="header__navigation-drop-menu-link">
                                    <a href="{{route('profile')}}">Profile</a>
                                  </li>
                                  <li class="header__navigation-drop-menu-link">
                                    <a @if(in_array(auth()->user()->role,['vendor','shopper'])) href="#" @else href="#" @endif>Support</a>
                                  </li>
                                  <li class="header__navigation-drop-menu-link">
                                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                  </li>
                                </ul>
                            </div>
                            @endguest
                        </div>
                        {{-- <span>
                            <svg width="17" height="20" fill="#fff" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 24" role="img">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.98156 18C2.18156 18 1.68156 17 2.18156 16.4L2.58156 15.9C3.98156 14.2 4.98157 12.2 4.98157 10.1V9C4.98157 6.2 7.18156 4 9.98156 4C12.7816 4 14.9816 6.2 14.9816 9V10.1C14.9816 12.2 15.9816 14.2 17.3816 15.9L17.7816 16.4C18.2816 17 17.7816 18 16.9816 18H2.98156ZM7.98157 20C7.98157 21.1 8.88156 22 9.98156 22C11.0816 22 11.9816 21.1 11.9816 20H7.98157ZM9.98156 0C10.5816 0 10.9816 0.4 10.9816 1V2.1C14.3816 2.6 16.9816 5.5 16.9816 9V10.1C16.9816 11.7 17.8816 13.3 18.8816 14.6L19.2816 15.1C20.8816 17.1 19.4816 20 16.9816 20H13.9816C13.9816 22.2 12.1816 24 9.98156 24C7.78156 24 5.98157 22.2 5.98157 20H2.98156C0.481559 20 -0.918441 17 0.681559 15.1L1.08156 14.6C2.08156 13.3 2.98156 11.8 2.98156 10.1V9C2.98156 5.5 5.58156 2.6 8.98156 2.1V1C9.08156 0.4 9.38156 0 9.98156 0Z"></path>
                            </svg>
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="header__center">
            <div class="container">
                <div class="header__center-content">
                    <div class="header__brand">
                        <button class="header__sidebar-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 6H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <a href="{{route('index')}}">
                            <img src="{{asset('src/images/logo.png')}}" alt="brand-logo" />
                        </a>
                    </div>
                    <form action="#">
                        <div class="header__input-form">
                            <input type="text" placeholder="Search" />
                            <span class="search-icon">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <button type="submit" class="search-btn button button--md">
                                Search
                            </button>
                        </div>
                    </form>
                    <div class="header__cart">
                        <div class="header__cart-item">
                            @if(!auth()->check() || auth()->user()->role->name == 'shopper')
                            <a class="fav wish-bag" href="{{route('wishlist')}}">
                                <svg width="25" height="23" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="#1A1A1A" stroke-width="1.5" />
                                </svg>
                                <span class="item-number wish-counter" @if(auth()->check() && auth()->user()->likes->count()) style @else style="display:none" @endif>{{auth()->check() ? auth()->user()->likes->count() : 0}}</span>
                            </a>
                            @endif
                        </div>
                        <div class="header__cart-item">
                            <div class="header__cart-item-content">
                                @if(!auth()->check() || auth()->user()->role->name == 'shopper')
                                <button class="cart-bag">
                                    <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    
                                    <span class="item-number cart-counter">{{Session::has('carts') ? session('carts')->count() : 0}}</span>
                                </button>
                                <div class="header__cart-item-content-info">
                                    <h5>Shopping cart:</h5>
                                    <span class="price">{!!session('locale')['currency_symbol']!!}<span class="cart-ttl-amount">{{number_format($total,2)}}</span>
                                </div>
                                @else
                                <a href="{{route('notifications')}}" class="cart-bag">
                                    <svg fill="#000000" height="35" width="34" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 611.999 611.999" xml:space="preserve">
                                        <path d="M570.107,500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203 C381.969,34,347.883,0,306.001,0c-41.883,0-75.968,34.002-76.121,75.849c-70.682,29.804-120.425,99.801-120.425,181.203v84.578 c-0.046,3.181-2.522,129.251-67.561,158.622c-7.409,3.347-11.481,11.412-9.768,19.36c1.711,7.949,8.74,13.626,16.871,13.626 h164.88c3.38,18.594,12.172,35.892,25.619,49.903c17.86,18.608,41.479,28.856,66.502,28.856 c25.025,0,48.644-10.248,66.502-28.856c13.449-14.012,22.241-31.311,25.619-49.903h164.88c8.131,0,15.159-5.676,16.872-13.626 C581.586,511.664,577.516,503.6,570.107,500.254z M484.434,439.859c6.837,20.728,16.518,41.544,30.246,58.866H97.32 c13.726-17.32,23.407-38.135,30.244-58.866H484.434z M306.001,34.515c18.945,0,34.963,12.73,39.975,30.082 c-12.912-2.678-26.282-4.09-39.975-4.09s-27.063,1.411-39.975,4.09C271.039,47.246,287.057,34.515,306.001,34.515z M143.97,341.736v-84.685c0-89.343,72.686-162.029,162.031-162.029s162.031,72.686,162.031,162.029v84.826 c0.023,2.596,0.427,29.879,7.303,63.465H136.663C143.543,371.724,143.949,344.393,143.97,341.736z M306.001,577.485 c-26.341,0-49.33-18.992-56.709-44.246h113.416C355.329,558.493,332.344,577.485,306.001,577.485z"></path> <path d="M306.001,119.235c-74.25,0-134.657,60.405-134.657,134.654c0,9.531,7.727,17.258,17.258,17.258 c9.531,0,17.258-7.727,17.258-17.258c0-55.217,44.923-100.139,100.142-100.139c9.531,0,17.258-7.727,17.258-17.258 C323.259,126.96,315.532,119.235,306.001,119.235z"></path> 
                                    </svg>
                                    <span class="item-number cart-counter">{{Session::has('notifications') ? session('notifications')->count() : 0}}</span>
                                </a>
                                <a href="{{route('profile')}}" class="cart-bag">
                                    <svg width="40" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 18.7023C18 15.6706 14.5 15 12 15C9.5 15 6 15.6706 6 18.7023M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                    </svg>
                                </a>
                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom" style="background: #1a1a1a">
            <div class="container">
                <div class="header__bottom-content">
                    <div class="header__bottom-left">
                        @includeWhen(isset($categories),'layouts.categoriesmenu')
                        <ul class="header__navigation-menu">
                            <li class="header__navigation-menu-link">
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            <li class="header__navigation-menu-link">
                                <a href="{{route('product.list')}}">Products</a>
                            </li>
                            <li class="header__navigation-menu-link">
                                <a href="{{route('hotdeals')}}">Hot Deals</a>
                            </li>
                            <li class="header__navigation-menu-link">
                                <a href="{{route('vendors')}}">Vendors</a>
                            </li>
                            <li class="header__navigation-menu-link">
                            @guest
                                <a href="{{route('login')}}">Login </a>
                            @else
                                <a href="{{route('home')}}">Dashboard</a>
                            @endguest
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="header__bottom-right">
                        <div class="header__activity-icons">
                            <div class="fav d-inline-block mx-sm-4">
                                <a href="{{route('wishlist')}}">
                                    <svg width="25" height="23" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.9996 16.5451C-6.66672 7.3333 4.99993 -2.6667 9.9996 3.65668C14.9999 -2.6667 26.6666 7.3333 9.9996 16.5451Z" stroke="#fff" stroke-width="1.5" />
                                    </svg>
                                </a>
                            </div>

                            <button class="cart-bag">
                                <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path     d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"
                                    />
                                </svg>
                                <span class="item-number cart-counter">{{session('carts')->count()}}</span>
                            </button>
                            <a class="user-icon text-white" href="{{route('home')}}">
                                <svg width="23" height="23" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path     d="M6.99993 7.66667C8.84088 7.66667 10.3333 6.17428 10.3333 4.33333C10.3333 2.49238 8.84088 1 6.99993 1C5.15898 1 3.6666 2.49238 3.6666 4.33333C3.6666 6.17428 5.15898 7.66667 6.99993 7.66667Z"     stroke="currentColor"     stroke-width="1.2" />
                                    <path     d="M9.49995 10.1665H4.49995C2.19828 10.1665 0.137447 12.2915 1.65161 14.024C2.68161 15.2023 4.38495 15.9998 6.99995 15.9998C9.61495 15.9998 11.3174 15.2023 12.3474 14.024C13.8624 12.2907 11.8008 10.1665 9.49995 10.1665Z"     stroke="currentColor"     stroke-width="1.2"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div> --}}
                    <a href="#" class="header__telephone-number">
                        <span>
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.4359 2.375C15.9193 2.77396 17.2718 3.55567 18.358 4.64184C19.4441 5.72801 20.2258 7.08051 20.6248 8.56388" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.5306 5.75687C14.4205 5.99625 15.2318 6.46521 15.8833 7.11678C16.5349 7.76835 17.0039 8.57967 17.2433 9.46949" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.115 11.6517C8.02238 13.5074 9.5263 15.0049 11.3859 15.9042C11.522 15.9688 11.6727 15.9966 11.8229 15.9851C11.9731 15.9736 12.1178 15.9231 12.2425 15.8386L14.9812 14.0134C15.1022 13.9326 15.2414 13.8833 15.3862 13.8698C15.5311 13.8564 15.677 13.8793 15.8107 13.9364L20.9339 16.1326C21.1079 16.2065 21.2532 16.335 21.3479 16.4987C21.4426 16.6623 21.4815 16.8523 21.4589 17.04C21.2967 18.307 20.6784 19.4714 19.7196 20.3154C18.7608 21.1593 17.5273 21.6249 16.25 21.625C12.3049 21.625 8.52139 20.0578 5.73179 17.2682C2.94218 14.4786 1.375 10.6951 1.375 6.75C1.37512 5.47279 1.84074 4.23941 2.68471 3.28077C3.52867 2.32213 4.6931 1.70396 5.96 1.542C6.14771 1.51936 6.33769 1.55832 6.50134 1.653C6.66499 1.74769 6.79345 1.89298 6.86738 2.067L9.06537 7.1945C9.1219 7.32698 9.14485 7.47137 9.13218 7.61485C9.11951 7.75833 9.07162 7.89647 8.99275 8.017L7.17275 10.7977C7.09015 10.923 7.04141 11.0675 7.03129 11.2171C7.02117 11.3668 7.05001 11.5165 7.115 11.6517V11.6517Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            +1305-434-7149
                        </span>
                    </a>
                </div>
                
            </div>
        </div>
        <div class="header__sidebar">
            <button class="header__cross">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="header__mobile-sidebar">
                <div class="header__mobile-top">
                    <form action="#">
                        <div class="header__mobile-input">
                            <input type="text" placeholder="Search" />
                            <button class="search-btn">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path     d="M9.16667 16.3333C12.8486 16.3333 15.8333 13.3486 15.8333 9.66667C15.8333 5.98477 12.8486 3 9.16667 3C5.48477 3 2.5 5.98477 2.5 9.66667C2.5 13.3486 5.48477 16.3333 9.16667 16.3333Z"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round" />
                                    <path d="M17.4999 18L13.8749 14.375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <ul class="header__mobile-menu">
                        <li class="header__mobile-menu-item">
                            <a href="{{route('home')}}" class="header__mobile-menu-item-link">Home</a>
                        </li>
                        <li class="header__mobile-menu-item">
                            <a href="shop.php" class="header__mobile-menu-item-link">Shop</a>
                        </li>
                        <li class="header__mobile-menu-item">
                            @guest
                            <a href="{{route('login')}}" class="header__mobile-menu-item-link">Login / Register</a>
                            @else
                            <a href="account.php" class="header__mobile-menu-item-link">My Account</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- Header  Section start -->
    @yield('main')
    
    <div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            {{-- <div class="modal-header">
              <h5 class="modal-title" id="pinModalLabel">Enter Access Pin</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                <div class="contact-form__content my-3">
                    <div class="contact-form-input">
                        <label for="pin">Enter Your Access Pin</label>
                        <input type="text" name="pin" id="pin" value="" placeholder="Access pin" />
                    </div>
                    <div class="contact-form-btn">
                        <button class="button button--md" id="pinsubmit" type="button"> Save </button>
                        <button class="button button--md bg-danger" type="button" data-bs-dismiss="modal"> Cancel </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-start">
              <span class="small text-muted">Set or reset your access pin from your <a href="{{route('profile')}}">profile</a></span>
            </div>
          </div>
        </div>
    </div>
      
    <!--Footer Section Start  -->
    <footer class="footer footer--one">
        <div class="container">
            <div class="footer__top">
                <div class="row">
                    <!-- Brand information-->
                    <div class="col-md-4">
                        <div class="footer__brand-info">
                            <div class="footer__brand-info-logo">
                                <a href="{{route('index')}}"> <img src="{{asset('src/images/logo-nl-white.png')}}" alt="logo" /></a>
                            </div>
                            <p class="font-body--md-400">
                                Same day deliveries nationwide!
                            </p>
                            <div style="font-size:13px;color:#fff;font-weight:500">
                                <span>+234 811 123 4568</span>
                                <br />
                                <span>info@expiringsoon.shop</span>
                            </div>
                        </div>
                    </div>
                    <!-- My Account  -->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="footer__navigation">
                                    <li class="footer__navigation-title">
                                        <h2 class="font-body--lg-500">My Account</h2>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="{{route('home')}}"> My Account </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="{{route('vendor.shop.create')}}"> Create Shop </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="{{route('cart')}}"> Shoping Cart </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="{{route('wishlist')}}"> My Wishlist </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="footer__navigation">
                                    <li class="footer__navigation-title">
                                        <h2 class="font-body--lg-500">Help</h2>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="contact.php"> Contact Us </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="faqs.php"> FAQs </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="terms.php"> Terms &amp; Conditions </a>
                                    </li>
                                    <li class="footer__navigation-link">
                                        <a href="privacy.php"> Privacy Policy </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="bg--gray-9">
                            <div class="newsletter__leftcontent">
                                <h2 class="font-body--lg-500 text-white" style="font-size:15px">Subscribe to our Newsletter</h2> 
                                <div class="newsletter__leftcontent-text-content d-flex">
                                    <span class="newsletter__leftcontent-icon">
                                        <svg width="46" height="42" viewBox="0 0 46 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 15.5V38.25C2 38.7141 2.18437 39.1592 2.51256 39.4874C2.84075 39.8156 3.28587 40 3.75 40H42.25C42.7141 40 43.1592 39.8156 43.4874 39.4874C43.8156 39.1592 44 38.7141 44 38.25V15.5L23 1.5L2 15.5Z"             stroke="#00B307"             stroke-width="3"             stroke-linecap="round"             stroke-linejoin="round"         ></path>
                                            <path d="M19.1816 27.75L2.53906 39.5047" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M43.4611 39.5065L26.8186 27.75" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M44 15.5L26.8185 27.75H19.1815L2 15.5" stroke="#00B307" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <p class="font-body--md-400 mx-2">Receive deals & special offers right in your inbox!</p>
                                </div>
                                <div class="mt-3">
                                    <form action="#">
                                        <div class="newsletter__input">
                                            <input type="text" placeholder="Email Address" />
                                            <button class="button button--lg" type="submit">
                                                Subscribe
                                            </button>
                                        </div>
                                    </form>
                                    <ul class="newsletter__social-icon mt-2">
                                        <li>
                                            <a href="#">
                                                <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.99764 2.98875H9.64089V0.12675C9.35739 0.08775 8.38239 0 7.24689 0C4.87764 0 3.25464 1.49025 3.25464 4.22925V6.75H0.640137V9.9495H3.25464V18H6.46014V9.95025H8.96889L9.36714 6.75075H6.45939V4.5465C6.46014 3.62175 6.70914 2.98875 7.99764 2.98875Z"
                                                        fill="currentColor"
                                                    ></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18 2.41888C17.3306 2.7125 16.6174 2.90713 15.8737 3.00163C16.6388 2.54488 17.2226 1.82713 17.4971 0.962C16.7839 1.38725 15.9964 1.68763 15.1571 1.85525C14.4799 1.13413 13.5146 0.6875 12.4616 0.6875C10.4186 0.6875 8.77387 2.34575 8.77387 4.37863C8.77387 4.67113 8.79862 4.95238 8.85938 5.22013C5.7915 5.0705 3.07687 3.60013 1.25325 1.36025C0.934875 1.91263 0.748125 2.54488 0.748125 3.2255C0.748125 4.5035 1.40625 5.63638 2.38725 6.29225C1.79437 6.281 1.21275 6.10888 0.72 5.83775C0.72 5.849 0.72 5.86363 0.72 5.87825C0.72 7.6715 1.99912 9.161 3.6765 9.50413C3.37612 9.58625 3.04875 9.62563 2.709 9.62563C2.47275 9.62563 2.23425 9.61213 2.01038 9.56263C2.4885 11.024 3.84525 12.0984 5.4585 12.1333C4.203 13.1154 2.60888 13.7071 0.883125 13.7071C0.5805 13.7071 0.29025 13.6936 0 13.6565C1.63462 14.7106 3.57188 15.3125 5.661 15.3125C12.4515 15.3125 16.164 9.6875 16.164 4.81175C16.164 4.64863 16.1584 4.49113 16.1505 4.33475C16.8829 3.815 17.4982 3.16588 18 2.41888Z"
                                                        fill="currentColor"
                                                    ></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.24471 0C3.31136 0 0.687744 3.16139 0.687744 6.60855C0.687744 8.20724 1.58103 10.2008 3.01097 10.8331C3.22811 10.931 3.34624 10.8894 3.39462 10.688C3.43737 10.535 3.62525 9.79807 3.71638 9.45042C3.74451 9.33904 3.72988 9.24229 3.63988 9.13766C3.16511 8.58864 2.78821 7.58847 2.78821 6.65017C2.78821 4.24594 4.69967 1.91146 7.9522 1.91146C10.7648 1.91146 12.7325 3.73854 12.7325 6.35204C12.7325 9.30529 11.1698 11.3484 9.13912 11.3484C8.0152 11.3484 7.17816 10.4663 7.44367 9.37505C7.76431 8.07561 8.39321 6.6783 8.39321 5.74113C8.39321 4.90072 7.91844 4.20544 6.94865 4.20544C5.80447 4.20544 4.87631 5.33837 4.87631 6.85943C4.87631 7.82585 5.21832 8.47838 5.21832 8.47838C5.21832 8.47838 4.08652 13.0506 3.87614 13.9045C3.52062 15.3502 3.92451 17.6914 3.95939 17.8928C3.98077 18.0042 4.10565 18.0391 4.1754 17.9479C4.28678 17.8017 5.65484 15.8497 6.03848 14.4389C6.17799 13.9248 6.75064 11.84 6.75064 11.84C7.12753 12.5207 8.21546 13.0911 9.37426 13.0911C12.8214 13.0911 15.3123 10.0613 15.3123 6.30141C15.2999 2.69675 12.215 0 8.24471 0Z"
                                                        fill="currentColor"
                                                    ></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg width="25" height="18" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.0027 24.0548C8.72269 24.0548 8.33602 24.0375 7.05602 23.9815C6.05785 23.9487 5.07259 23.7458 4.14269 23.3815C3.34693 23.0718 2.62426 22.6 2.02058 21.9961C1.4169 21.3922 0.945397 20.6694 0.636019 19.8735C0.28576 18.9402 0.0968427 17.9542 0.0773522 16.9575C0.00268554 15.6802 0.00268555 15.2615 0.00268555 12.0068C0.00268555 8.7175 0.0200189 8.3335 0.0773522 7.06017C0.0972691 6.06486 0.28618 5.08018 0.636019 4.14817C0.945042 3.35128 1.41686 2.62761 2.02134 2.02335C2.62583 1.4191 3.34968 0.947556 4.14669 0.638836C5.07821 0.287106 6.06315 0.0976949 7.05869 0.0788358C8.33202 0.0068358 8.75069 0.00683594 12.0027 0.00683594C15.3094 0.00683594 15.6894 0.0241691 16.9494 0.0788358C17.9467 0.0975025 18.936 0.286836 19.8694 0.638836C20.6661 0.947914 21.3898 1.41958 21.9943 2.02379C22.5987 2.628 23.0706 3.35149 23.38 4.14817C23.736 5.09484 23.9267 6.09484 23.9414 7.10417C24.016 8.3815 24.016 8.79883 24.016 12.0522C24.016 15.3055 23.9974 15.7322 23.9414 16.9948C23.9214 17.9924 23.7321 18.9794 23.3814 19.9135C23.0712 20.7099 22.5988 21.4332 21.9942 22.0373C21.3896 22.6414 20.666 23.1133 19.8694 23.4228C18.936 23.7722 17.9507 23.9615 16.9547 23.9815C15.6814 24.0548 15.264 24.0548 12.0027 24.0548ZM11.9574 2.1175C8.69602 2.1175 8.35735 2.1335 7.08402 2.19084C6.32355 2.20078 5.57042 2.34103 4.85735 2.6055C4.33726 2.80486 3.86471 3.11098 3.47017 3.50414C3.07563 3.89731 2.76786 4.36878 2.56669 4.88817C2.30002 5.60817 2.16002 6.3695 2.15202 7.1375C2.08135 8.4295 2.08135 8.76817 2.08135 12.0068C2.08135 15.2068 2.09335 15.5948 2.15202 16.8788C2.16402 17.6388 2.30402 18.3922 2.56669 19.1055C2.97469 20.1548 3.80669 20.9842 4.85869 21.3868C5.57083 21.653 6.32382 21.7933 7.08402 21.8015C8.37469 21.8762 8.71469 21.8762 11.9574 21.8762C15.228 21.8762 15.5667 21.8602 16.8294 21.8015C17.5899 21.7923 18.3432 21.652 19.056 21.3868C19.5733 21.186 20.0432 20.8796 20.4357 20.4873C20.8282 20.095 21.1348 19.6254 21.336 19.1082C21.6027 18.3882 21.7427 17.6255 21.7507 16.8575H21.7654C21.8227 15.5828 21.8227 15.2428 21.8227 11.9855C21.8227 8.72817 21.808 8.3855 21.7507 7.11217C21.7386 6.35278 21.5984 5.60088 21.336 4.88817C21.1353 4.37023 20.8289 3.89977 20.4364 3.50677C20.0438 3.11376 19.5737 2.80682 19.056 2.6055C18.3427 2.33884 17.5894 2.20017 16.8294 2.19084C15.54 2.1175 15.2027 2.1175 11.9574 2.1175ZM12.0027 18.1655C10.7834 18.1663 9.59136 17.8055 8.5772 17.1287C7.56304 16.4519 6.77236 15.4896 6.30517 14.3634C5.83798 13.2373 5.71526 11.9978 5.95254 10.8019C6.18982 9.60598 6.77644 8.50729 7.63819 7.64478C8.49995 6.78228 9.59814 6.19471 10.7939 5.9564C11.9896 5.71808 13.2291 5.83973 14.3557 6.30594C15.4823 6.77216 16.4453 7.56201 17.1229 8.57558C17.8006 9.58916 18.1624 10.7809 18.1627 12.0002C18.1606 13.6337 17.5111 15.1999 16.3565 16.3555C15.2018 17.5111 13.6363 18.162 12.0027 18.1655ZM12.0027 7.9975C11.2116 7.9975 10.4382 8.2321 9.78041 8.67162C9.12261 9.11115 8.60992 9.73586 8.30717 10.4668C8.00442 11.1977 7.9252 12.0019 8.07954 12.7779C8.23388 13.5538 8.61485 14.2665 9.17426 14.8259C9.73367 15.3853 10.4464 15.7663 11.2223 15.9206C11.9982 16.075 12.8025 15.9958 13.5334 15.693C14.2643 15.3903 14.889 14.8776 15.3286 14.2198C15.7681 13.562 16.0027 12.7886 16.0027 11.9975C16.0002 10.9374 15.578 9.92141 14.8284 9.1718C14.0788 8.42219 13.0628 7.99997 12.0027 7.9975ZM18.4027 7.04683C18.2139 7.04613 18.0272 7.00826 17.8531 6.93538C17.6789 6.8625 17.5209 6.75604 17.3879 6.62208C17.1193 6.35153 16.9693 5.98537 16.9707 5.60417C16.9721 5.22296 17.1249 4.85793 17.3954 4.58938C17.666 4.32083 18.0321 4.17075 18.4134 4.17217C18.7946 4.17358 19.1596 4.32637 19.4281 4.59693C19.6967 4.86748 19.8468 5.23363 19.8454 5.61484C19.8439 5.99604 19.6912 6.36107 19.4206 6.62962C19.15 6.89817 18.7839 7.04825 18.4027 7.04683Z"
                                                        fill="currentColor"
                                                    ></path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__copyright-text">
                    Expiring Soon © {{now()->format('Y')}}. All Rights Reserved
                </p>
                <div class="footer__partner d-flex">
                    <a  href="#" class="footer__partner-item">
                        <img src="{{asset('src/images/brand-icon/img-02.png')}}" alt="img" />
                    </a>
                    <a  href="#" class="footer__partner-item">
                        <img src="{{asset('src/images/brand-icon/img-04.png')}}" alt="img" />
                    </a >
                    <a  href="#" class="footer__partner-item">
                        <img src="{{asset('src/images/brand-icon/img-05.png')}}" alt="img" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer Section end  -->

    <!-- Shopping Cart sidebar start  -->
    @include('layouts.side_cart')
    <script src="{{asset('src/js/jquery.min.js')}}"></script>
    <script src="{{asset('src/plugins/swiper-bundle/script.min.js')}}"></script>
    <script src="{{asset('src/plugins/bvselect/script.js')}}"></script>
    <script src="{{asset('src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('src/js/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('src/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('src/js/main.js')}}"></script>
    {{-- <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script> --}}
    {{-- <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('30f7e5194b874bf1230b', {
            cluster: 'eu',
            wsHost: 'expiringsoon.test',
            wsPort: 6001,
            wssPort: 6001,
            forceTLS: false,
            enabledTransports: ['ws'],
            debug: true,
            authEndpoint: 'http://expiringsoon.test/broadcasting/auth', // The URL of your Laravel app's auth endpoint
            auth: {
                headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token if CSRF protection is enabled
                }
            }
        });
        var channel = pusher.subscribe('private-App.Models.Shop.1');
        channel.bind('Illuminate\Notifications\Events\BroadcastNotificationCreated', function(data) {
            console.log('Received event:', data);
        });
    </script> --}}
    
    @stack('scripts')
</body>
</html>
