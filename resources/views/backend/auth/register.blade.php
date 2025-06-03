@extends('layouts.base.auth')   
@section('title','Register')
@section('main')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0">
            <!-- Logo & Language -->
            <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                <div class="d-none d-lg-flex justify-content-between">
                    <a href="{{route('index')}}">
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
                 
                <form action="{{route('register')}}" method="post" class="js-validate needs-validation">
                @csrf
                    <div class="text-center">
                        <div class="mb-5">
                            <h1 class="display-5">Create your account</h1>
                            <p>Already have an account? <a class="link" href="{{ route('admin.login') }}">Sign in here</a></p>
                        </div>
                    </div>

                    <!-- <div class="mt-9 mb-5">
                        <label class="form-label" for="signupModalFormSignupEmail">Profile Type</label>
                        <select name="role" id="signupModalFormSignupType" class="form-control form-control-lg" required>
                            <option value="consumer">Consumer</option>
                            <option value="logistics">Logistics Provider</option>
                            <option value="insurance">Insurance Provider</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label" for="fullNameSrEmail">Full name</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Form -->
                                <div class="mb-4">
                                    <input type="text" value="{{ old('firstname') }}" class="form-control form-control-lg" name="firstname" id="fullNameSrEmail" placeholder="First name" aria-label="firstname" required>
                                    @error('firstname')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Form -->
                            </div>

                            <div class="col-sm-6">
                                <!-- Form -->
                                <div class="mb-4">
                                    <input type="text" value="{{ old('surname') }}" class="form-control form-control-lg" name="surname" placeholder="Surname" aria-label="surname" required>
                                    @error('surname')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                    

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="signupSrEmail">Your email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control form-control-lg" name="email" id="signupSrEmail" placeholder="email@site.com" aria-label="email@site.com" required>
                        <span class="invalid-feedback">Please enter a valid email address.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="signupSrPassword">Password</label>

                        <div class="input-group input-group-merge" data-hs-validation-validate-class>
                            <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Min 8 characters with letters, numbers & symbol" aria-label="min 8 characters containing letters, numbers and symbol" required minlength="8" data-hs-toggle-password-options='{
                           "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": ".js-toggle-password-show-icon-1"
                         }'>
                            <a class="js-toggle-password-target-1 input-group-append input-group-text" href="javascript:;">
                                <i class="js-toggle-password-show-icon-1 bi-eye"></i>
                            </a>
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="signupSrConfirmPassword">Confirm password</label>

                        <div class="input-group input-group-merge" data-hs-validation-validate-class>
                            <input type="password" class="js-toggle-password form-control form-control-lg" name="password_confirmation" id="signupSrConfirmPassword" placeholder="Min 8 characters with letters, numbers & symbol" aria-label="8+ characters required" required minlength="8" data-hs-toggle-password-options='{
                           "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": ".js-toggle-password-show-icon-2"
                         }'>
                            <a class="js-toggle-password-target-2 input-group-append input-group-text" href="javascript:;">
                                <i class="js-toggle-password-show-icon-2 bi-eye"></i>
                            </a>
                        </div>

                        
                    </div>
                    <!-- End Form -->

                    <!-- Form Check -->
                    <div class="form-check mb-4">
                        <input name="terms" class="form-check-input" type="checkbox" value="1" id="termsCheckbox" required>
                        <label class="form-check-label" for="termsCheckbox">
                            I accept the <a href="#">Terms and Conditions</a>
                        </label>
                        @error('terms')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        
                    </div>
                    <!-- End Form Check -->

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Create an account</button>
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