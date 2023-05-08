@extends('layouts.app')
@push('styles')

@endpush
@section('title')Forgot Password @endsection
@section('main')
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Forgot Password</a></li>
        </ul>
      </div>
    </div>
</div>

@include('layouts.session')

<section class="sign-in section section--xl">
    <div class="container">
      <div class="form-wrapper">
        <h6 class="font-title--sm" style="font-size:16px">{{ __('Forgot Password') }}</h6>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @if (session('status'))
                <div class="alert alert-success mb-5" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-input">
                <input id="email" placeholder="{{ __('Email Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
            </div>
            @error('email')
                <span class="invalid-feedback d-block mb-4" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          
          <div class="form-button">
            <button type="submit" class="button button--md w-100">{{ __('Send Password Reset Link') }}</button>
          </div>
          <div class="form-register">
            You remember? <a href="{{route('login')}}">Login Now</a>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
