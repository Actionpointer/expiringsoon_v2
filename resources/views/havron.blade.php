<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payments </title>
    <link rel="icon" type="image/png" href="{{asset('src/images/favicon/favicon-16x16.png')}}" />
    <link rel="stylesheet" href="{{asset('src/lib/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('src/lib/css/bvselect.css')}}" />
    <link rel="stylesheet" href="{{asset('src/lib/css/venobox.css')}}" />
    <link rel="stylesheet" href="{{asset('src/lib/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('src/lib/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('src/select2/css/select2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('src/select2/css/custom.css')}}"/>
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
      <path
          d="M11.3333 14.6667H7.08333L4.25 30.25H29.75L26.9167 14.6667H22.6667M11.3333 14.6667V10.4167C11.3333 7.28705 13.8704 4.75 17 4.75V4.75C20.1296 4.75 22.6667 7.28705 22.6667 10.4167V14.6667M11.3333 14.6667H22.6667M11.3333 14.6667V18.9167M22.6667 14.6667V18.9167"
          stroke="white"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
      />
  </svg>
  
  </div>
  
  

 
  <!-- Header  Section start -->
      <!-- Sign-in Section Start  -->
      <section class="sign-in section section--xl">
        <div class="container">
          <div class="form-wrapper">
            <h6 class="font-title--sm" style="font-size:16px">Payment</h6>
            <form method="POST" action="{{ route('havron.pay') }}">
              @csrf
              <div class="form-input">
                <input type="email" name="email" placeholder="Email" />
              </div>
              <div class="form-input">
                <input type="text" name="name" placeholder="Name" />
              </div>
              <div class="form-input">
                <input type="text" name="phone" placeholder="Phone number" />
              </div>
              <div class="form-input">
                <input type="number" name="amount" placeholder="Amount in usd" />
              </div>

              <div class="form-button">
                <button type="submit" class="button button--md w-100">Pay</button>
              </div>
              
            </form>
          </div>
        </div>
      </section>
      <!-- Sign-in Section end  -->
  </body>
  </html>
  