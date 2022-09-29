@extends('layouts.app')
@push('styles')
   
    
@endpush
@section('title')Register @endsection
@section('main')

<!-- breedcrumb section start  -->
<div class="section breedcrumb">
  <div class="breedcrumb__img-wrapper">
    <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
    <div class="container">
      <ul class="breedcrumb__content">
        <li>
          <a href="index.php">
            <svg   width="18"   height="19"   viewBox="0 0 18 19"   fill="none"   xmlns="http://www.w3.org/2000/svg" >
              <path     d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"     stroke="#808080"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"   />
            </svg>
            <span> > </span>
          </a>
        </li>
        <li class="active">
          <a href="register.php">Create Account</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- breedcrumb section end   -->
@include('layouts.session')
<!-- create account-in Section Start  -->
<section class="create-account section section--xl">
  <div class="container">
    <div class="form-wrapper">
      <h6 class="font-title--sm" style="font-size:16px">create account</h6>
      <form method="post" action="{{route('register')}}" id="register">@csrf

        @if(Route::is('start-selling'))<input type="hidden" name="role" value="vendor">@endif
        <div class="form-input">
          <input type="text" name="fname" placeholder="First Name" required />
          
        </div>
        @error('fname')
            <span class="invalid-feedback d-block mb-4" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="form-input">
          <input type="text" name="lname" placeholder="Last Name" required />
        </div>
        @error('lname')
        <span class="invalid-feedback d-block mb-4" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="form-input">
          <input type="tel" name="phone" id="phone" placeholder="Phone number in {{cache('settings')['country']}}local format. e.g 08023456789" required />
        </div>
        @error('phone')
          <span class="invalid-feedback d-block mb-4" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      
      <div class="form-input">
        <input type="email" name="email" id="email" placeholder="Email Address" required />
      </div>
      @error('email')
          <span class="invalid-feedback d-block mb-4" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="form-input">
        <input type="password" name="password" placeholder="Password" id="password" required />
        <button type="button"  class="icon icon-eye" onclick="showPassword('password',this)" >
          <svg   width="20"   height="21"   viewBox="0 0 20 21"   fill="none"   xmlns="http://www.w3.org/2000/svg" >   
            <path d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"   />
            <path     d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"   />
          </svg>
        </button>
        
      </div>
      @error('password')
            <span class="invalid-feedback d-block mb-2" role="alert">
                <strong>{{ $message }}</strong>
            </span>
      @enderror
      <div class="form-input">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirmPassword" required/>
        <button type="button" class="icon icon-eye" onclick="showPassword('confirmPassword',this)">
          <svg   width="20"   height="21"   viewBox="0 0 20 21"   fill="none"   xmlns="http://www.w3.org/2000/svg" >
            <path     d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"   />
            <path     d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"     stroke="currentColor"     stroke-width="1.5"     stroke-linecap="round"     stroke-linejoin="round"   />
          </svg>
        </button>
        
      </div>
        
        
      <div class="form-wrapper__content">
        <div class="form-check">
          <input   class="form-check-input"   type="checkbox"   value=""   id="remember" required/>
          <label class="form-check-label" for="remember">
            Accept all terms & Conditions
          </label>
        </div>
      </div>
        <div class="form-button">
          <button type="submit" name="btn-register" class="button button--md w-100 btn-register">Create Account</button>
        </div>
        <div class="form-register">
          Already have an account? <a href="{{route('login')}}">Login</a>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- create account-in Section end  -->


@endsection
@push('scripts')
<script>
</script>
@endpush