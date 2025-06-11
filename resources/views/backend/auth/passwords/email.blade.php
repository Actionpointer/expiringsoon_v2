@extends('layouts.backend.base.auth')
@section('title','Forgot Password')
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
            <!-- Form -->
            <form action="{{route('password.email')}}" class="js-validate needs-validation" novalidate>@csrf
              <div class="text-center">
                <div class="mb-5">
                  <h1 class="display-5">Forgot password?</h1>
                  <p>Enter the email address you used when you joined and we'll send you instructions to reset your password.</p>
                </div>
              </div>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="resetPasswordSrEmail" tabindex="0">Your email</label>

                <input type="email" class="form-control form-control-lg" name="email" id="resetPasswordSrEmail" tabindex="1" placeholder="Enter your email address" aria-label="Enter your email address" required>
                @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
              </div>
              <!-- End Form -->

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>

                <div class="text-center">
                  <a class="btn btn-link" href="{{ route('admin.login') }}">
                    <i class="bi-chevron-left"></i> Back to Sign in
                  </a>
                </div>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
@endsection