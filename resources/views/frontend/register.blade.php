@extends('layouts.app')
@push('styles')
    <!-- Phone input -->
    <link rel="stylesheet" href="int-tel/build/css/intlTelInput.css">
    <link rel="stylesheet" href="int-tel/build/css/demo.css">
    <style>
      .notify{
        margin-top: 0px;
        text-align: center;
        background-color: #1cc88a;
        color: #fff;
        padding: 10px;
        width: 100%;
        height: 40px;
        font-size: 14px;
      }
  
      .error{
        margin-top: 0px;
        text-align: center;
        background-color: #e84a4a;
        color: #fff;
        padding: 10px;
        width: 100%;
        height: 40px;
        font-size: 14px;
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
  
    
@endpush
@section('title')Register @endsection
@section('main')

<!-- breedcrumb section start  -->
<div class="section breedcrumb">
  <div class="breedcrumb__img-wrapper">
    <img src="src/images/banner/breedcrumb.jpg" alt="breedcrumb" />
    <div class="container">
      <ul class="breedcrumb__content">
        <li>
          <a href="index.php">
            <svg
              width="18"
              height="19"
              viewBox="0 0 18 19"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                stroke="#808080"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
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

<?php
if(isset($_GET['user'])){
echo '<div class="error"><p style="color:#fff">That username is taken</p></div>';
}
if(isset($_GET['email'])){
echo '<div class="error"><p style="color:#fff">Wrong email format</p></div>';
}
if(isset($_GET['password'])){
echo '<div class="error"><p style="color:#fff">Invalid password format</p></div>';
}
if(isset($_GET['exists'])){
echo '<div class="error"><p style="color:#fff">That email is already registered</p></div>';
}
if(isset($_GET['phone'])){
echo '<div class="error"><p style="color:#fff">That phone number is already registered</p></div>';
}
?>

<!-- create account-in Section Start  -->
<section class="create-account section section--xl">
  <div class="container">
    <div class="form-wrapper">
      <h6 class="font-title--sm" style="font-size:16px">create account</h6>
      <form method="post" action="{{route('register')}}" id="register">@csrf
        <div class="form-input">
          <input type="text" name="fname" placeholder="First Name" required />
          @error('fname')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-input">
          <input type="text" name="lname" placeholder="Last Name" required />
          @error('lname')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="contact-form-input">
          <input type="hidden" name="country" id="selCountry" value="NG" required />
          <select
            id="ext"
            name="ext"
            class="form-control-lg w-100 border text-muted contact-form-input__dropdown droplist"
            required
          >
            <option value="" selected>Select Country</option>
            @foreach ($countries as $country)
            <option data-countryCode="{{$country->iso_code}}" data-dialingCode="{{$country->dialing_code}}" value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
            
            
          </select>
          @error('country')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

      <div class="form-input">
        <input type="tel" name="phone" id="phone" onkeypress="validate(event)" placeholder="Phone" required />
        
      </div>
      @error('phone')
          <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <div class="form-input">
        <input type="email" name="email" id="email" placeholder="Email Address" required />
        
      </div>
      @error('email')
          <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        <div class="form-input">
          <input type="password" name="password" placeholder="Password" id="password" required />
          <button type="button"  class="icon icon-eye" onclick="showPassword('password',this)" >
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <span class="icon icon-warning">
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M10.0003 18.8333C14.6027 18.8333 18.3337 15.1024 18.3337 10.5C18.3337 5.89762 14.6027 2.16666 10.0003 2.16666C5.39795 2.16666 1.66699 5.89762 1.66699 10.5C1.66699 15.1024 5.39795 18.8333 10.0003 18.8333Z"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 7.16666V10.5"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 13.8333H10.0083"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <span class="icon icon-error">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8.57465 3.21667L1.51632 15C1.37079 15.252 1.29379 15.5378 1.29298 15.8288C1.29216 16.1198 1.36756 16.4059 1.51167 16.6588C1.65579 16.9116 1.86359 17.1223 2.11441 17.2699C2.36523 17.4175 2.65032 17.4968 2.94132 17.5H17.058C17.349 17.4968 17.6341 17.4175 17.8849 17.2699C18.1357 17.1223 18.3435 16.9116 18.4876 16.6588C18.6317 16.4059 18.7071 16.1198 18.7063 15.8288C18.7055 15.5378 18.6285 15.252 18.483 15L11.4247 3.21667C11.2761 2.97176 11.0669 2.76927 10.8173 2.62874C10.5677 2.48821 10.2861 2.41438 9.99965 2.41438C9.71321 2.41438 9.43159 2.48821 9.18199 2.62874C8.93238 2.76927 8.72321 2.97176 8.57465 3.21667V3.21667Z"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 7.5V10.8333"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 14.1667H10.0083"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <span class="icon icon-success">
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M16.6663 5.5L7.49967 14.6667L3.33301 10.5"
                stroke="#00B307"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
        </div>
        <div class="form-input">
          <input
            type="password"
            name="password_confirmation"
            placeholder="Confirm Password"
            id="confirmPassword"
            required
          />
          <button
            type="button"
            class="icon icon-eye"
            onclick="showPassword('confirmPassword',this)"
          >
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1.66663 10.5003C1.66663 10.5003 4.69663 4.66699 9.99996 4.66699C15.3033 4.66699 18.3333 10.5003 18.3333 10.5003C18.3333 10.5003 15.3033 16.3337 9.99996 16.3337C4.69663 16.3337 1.66663 10.5003 1.66663 10.5003Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 13C10.663 13 11.2989 12.7366 11.7678 12.2678C12.2366 11.7989 12.5 11.163 12.5 10.5C12.5 9.83696 12.2366 9.20107 11.7678 8.73223C11.2989 8.26339 10.663 8 10 8C9.33696 8 8.70107 8.26339 8.23223 8.73223C7.76339 9.20107 7.5 9.83696 7.5 10.5C7.5 11.163 7.76339 11.7989 8.23223 12.2678C8.70107 12.7366 9.33696 13 10 13V13Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <span class="icon icon-warning">
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M10.0003 18.8333C14.6027 18.8333 18.3337 15.1024 18.3337 10.5C18.3337 5.89762 14.6027 2.16666 10.0003 2.16666C5.39795 2.16666 1.66699 5.89762 1.66699 10.5C1.66699 15.1024 5.39795 18.8333 10.0003 18.8333Z"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 7.16666V10.5"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 13.8333H10.0083"
                stroke="#FF8A00"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <span class="icon icon-error">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8.57465 3.21667L1.51632 15C1.37079 15.252 1.29379 15.5378 1.29298 15.8288C1.29216 16.1198 1.36756 16.4059 1.51167 16.6588C1.65579 16.9116 1.86359 17.1223 2.11441 17.2699C2.36523 17.4175 2.65032 17.4968 2.94132 17.5H17.058C17.349 17.4968 17.6341 17.4175 17.8849 17.2699C18.1357 17.1223 18.3435 16.9116 18.4876 16.6588C18.6317 16.4059 18.7071 16.1198 18.7063 15.8288C18.7055 15.5378 18.6285 15.252 18.483 15L11.4247 3.21667C11.2761 2.97176 11.0669 2.76927 10.8173 2.62874C10.5677 2.48821 10.2861 2.41438 9.99965 2.41438C9.71321 2.41438 9.43159 2.48821 9.18199 2.62874C8.93238 2.76927 8.72321 2.97176 8.57465 3.21667V3.21667Z"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 7.5V10.8333"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 14.1667H10.0083"
                stroke="#EA4B48"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <span class="icon icon-success">
            <svg
              width="20"
              height="21"
              viewBox="0 0 20 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M16.6663 5.5L7.49967 14.6667L3.33301 10.5"
                stroke="#00B307"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
        </div>
        @error('password')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
        @enderror
        
        <div class="form-wrapper__content">
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              id="remember"
            />
            <label class="form-check-label" for="remember">
              Accept all terms & Conditions
            </label>
          </div>
        </div>
        <div class="form-button">
          <button type="submit" name="btn-register" class="button button--md w-100 btn-register button--disable">Create Account</button>
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
<script src="int-tel/build/js/intlTelInput.js"></script>
<script>
  // Accept Terms
  $(document).ready(function(){
    // Phone select
  $("select[name=ext]").change(function() {
  var ext = '+' + $("#ext :selected").attr('dialingCode')
  $('input#phone').val(ext);
  $('input#selCountry').val($("#ext :selected").attr('data-countryCode'));
  // alert($("#country1 :selected").attr('value'))
  });

  $(".form-check-input").click(function() {
  $(".btn-register").toggleClass('button--disable');
  });

  // Validate email
  $("#email").change(function(){
  var email = document.getElementById('email').value;
  $.post("process.php",{email:email}, function(data){
    $('#emailcheck').html(data).css('color', '#ff0000');
  });
  });

  // Validate phone
  $("#phone").change(function(){
  var phone = document.getElementById('phone').value;
  $.post("process.php",{phone:phone}, function(data){
  $('#phonecheck').html(data).css('color', '#ff0000');
  });
  });

  // Validate username
  $("#username").change(function(){
  var username = document.getElementById('username').value;
  $.post("process.php",{username:username}, function(data){
  $('#usercheck').html(data);
  });
  });

  // Disable space in input
  $("input#username").on({
  keydown: function(e) {
  if (e.which === 32)
  return false;
  },
  change: function() {
  this.value = this.value.replace(/\s/g, "");
  }
  });

  $("input#email").on({
  keydown: function(e) {
  if (e.which === 32)
  return false;
  },
  change: function() {
  this.value = this.value.replace(/\s/g, "");
  }
  });
  });

  // Password check
  function passwordsMatch(){
  return $('#password').val() == $('#confirmPassword').val();
  }

  $(document).ready(function () {
  $("#confirmPassword").on("keyup change", function(e) {
  // $("#confirmPassword").change(function(){
      if(!passwordsMatch()){
        $('#passmatch').show();
        $("#passmatch").html("Passwords do not match").css('color', 'red');
      } else {
        $("#passmatch").html("").css('color', 'green');
        $("#passmatch").hide();
      }
  });

  $('#register').submit(function(evt) {
     if(!passwordsMatch()){
          evt.preventDefault();
      }
  });
  });

  // Numbers only
  function validate(evt) {
var theEvent = evt || window.event;

// Handle paste
if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
} else {
// Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
}
var regex = /[0-9]|\./;
if( !regex.test(key) ) {
  theEvent.returnValue = false;
  if(theEvent.preventDefault) theEvent.preventDefault();
}
}
  </script>
@endpush