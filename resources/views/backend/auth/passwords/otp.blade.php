@extends('layouts.base.auth')
@section('title','2-Step Verification')
@section('main')
<div class="container-fluid px-3">
  <div class="row">
    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0">
      <!-- Logo & Language -->
      <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
        <div class="d-none d-lg-flex justify-content-between">
          <a href="{{ route('index') }}">
            @include('layouts.backend.snippets.logo')
          </a>

          <!-- Select -->
          <div class="tom-select-custom tom-select-custom-end tom-select-custom-bg-transparent">

          </div>
          <!-- End Select -->
        </div>
      </div>
      <!-- End Logo & Language -->

      <div style="max-width: 23rem;">
        <div class="text-center mb-5">
          <img class="img-fluid" src="{{asset('backend/svg/illustrations/oc-chatting.svg')}}" alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="default">
          <img class="img-fluid" src="{{asset('backend/svg/illustrations-light/oc-chatting.svg')}}" alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="dark">
        </div>

        <div class="mb-5">
          <h2 class="display-5">Build digital products with:</h2>
        </div>

        <!-- List Checked -->
        <ul class="list-checked list-checked-lg list-checked-primary list-py-2">
          <li class="list-checked-item">
            <span class="d-block fw-semibold mb-1">All-in-one tool</span>
            Build, run, and scale your apps - end to end
          </li>

          <li class="list-checked-item">
            <span class="d-block fw-semibold mb-1">Easily add &amp; manage your services</span>
            It brings together your tasks, projects, timelines, files and more
          </li>
        </ul>
        <!-- End List Checked -->

        <div class="row justify-content-between mt-5 gx-3">
          <div class="col">
            <img class="img-fluid" src="{{asset('backend/svg/brands/gitlab-gray.svg')}}" alt="Logo">
          </div>
          <!-- End Col -->

          <div class="col">
            <img class="img-fluid" src="{{asset('backend/svg/brands/fitbit-gray.svg')}}" alt="Logo">
          </div>
          <!-- End Col -->

          <div class="col">
            <img class="img-fluid" src="{{asset('backend/svg/brands/flow-xo-gray.svg')}}" alt="Logo">
          </div>
          <!-- End Col -->

          <div class="col">
            <img class="img-fluid" src="{{asset('backend/svg/brands/layar-gray.svg')}}" alt="Logo">
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Col -->

    <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
      <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
        <div class="text-center">
          <div class="mb-4">
            <img class="avatar avatar-xxl avatar-4x3" src="{{asset('backend/svg/illustrations/oc-unlock.svg')}}" alt="Image Description" data-hs-theme-appearance="default">
            <img class="avatar avatar-xxl avatar-4x3" src="{{asset('backend/svg/illustrations-light/oc-unlock.svg')}}" alt="Image Description" data-hs-theme-appearance="dark">
          </div>

          <div class="mb-5">
            <h1 class="display-5">2-step Verification</h1>
            <p class="mb-0">We sent a verification code to your email.</p>
            <p class=" text-center"><i>{{ auth()->user()->email }}</i></p>
            <p>Enter the code from the email in the field below.</p>
          </div>
          <form action="{{ route('otp.verify') }}" method="post" class="js-validate needs-validation">@csrf
          <div class="row gx-2 gx-sm-3">
            <div class="col">
              <!-- Form -->
              <div class="mb-4">
                <input type="text" 
                       class="form-control" 
                       name="otp" 
                       id="otpInput"
                       placeholder="******"
                       aria-label="Enter verification code"
                       maxlength="6"
                       autocomplete="off"
                       autocapitalize="off" 
                       spellcheck="false"
                       style="letter-spacing: 3.7em; text-align: center;"
                       pattern="[0-9]*"
                       inputmode="numeric" required
                       autofocus>
              </div>
              @error('otp')
                <p class="text-danger">{{$message}}</p>
              @enderror
              <!-- End Form -->
            </div>
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Verify my account</button>
          </div>
          </form>

          <div class="text-center">
            <span id="otp_response" class="text-info"></span>
            <p id="resend_block">Haven't received it? <a href="javascript:void(0)" id="send_otp" class="text-primary">Resend a new code.</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->
</div>
@endsection
@push('scripts')
<script>
  $('#send_otp').on('click', function() {
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: "{{route('otp.resend')}}",
      beforeSend: function() {
        $('#otp_response').text('sending...')
      },
      success: function(data) {
        $('#otp_response').text(data.message)
        if (data.status) {
          $('#otp_response').addClass('text-success')
          $('#resend_block').hide()
        } else {
          $('#otp_response').addClass('text-danger')
        }
        displayTimer();
      },
      error: function(data) {
        console.log(data);
      }
    });
  })

  function displayTimer() {
    var start = 10;
    const myInterval = setInterval(function() {
      if (start > 0) {
        $('#timer').text(start)
          --start
      } else {
        $('#otp_response').text('')
        $('#resend_block').show()
        clearInterval(myInterval)

      }
    }, 1000);

  }
</script>
@endpush
