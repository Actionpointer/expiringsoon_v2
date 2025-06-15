<section class="my-lg-14 my-8">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                <!-- img -->
                <img src="{{ asset('frontend/images/svg-graphics/signup-g.svg') }}" alt="" class="img-fluid" />
            </div>
            <!-- col -->
            <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                <div class="mb-lg-9 mb-5">
                    <h1 class="mb-1 h2 fw-bold">Get Start Shopping</h1>
                    <p>Welcome to FreshCart! Enter your email to get started.</p>
                </div>
                <!-- form -->
                <div class="needs-validation">
                    @if($errorMessage)
                    <div class="alert alert-danger">
                        {!! $errorMessage !!}
                    </div>
                    @endif
                    <div class="row g-3">
                        <!-- col -->
                        <div class="col">
                            <!-- input -->
                            <label for="formSignupfname" class="form-label visually-hidden">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="formSignupfname" placeholder="First Name" required wire:model="firstname" />
                            @error('firstname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <!-- input -->
                            <label for="formSignuplname" class="form-label visually-hidden">Last Name</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="formSignuplname" placeholder="Last Name" required wire:model="surname" />
                            @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <!-- input -->
                            <label for="formSignupEmail" class="form-label visually-hidden">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="formSignupEmail" placeholder="Email" required wire:model="email" />
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="password-field position-relative">
                                <label for="formSignupPassword" class="form-label visually-hidden">Password</label>
                                <div class="password-field position-relative">
                                    <input type="password" class="form-control fakePassword @error('password') is-invalid @enderror" id="formSignupPassword"
                                        placeholder="*****" required wire:model="password" />
                                    <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- btn -->
                        <div class="col-12 d-grid"><button type="submit" class="btn btn-primary" id="signUpButton" wire:click.prevent="submit">Register</button></div>

                        <!-- text -->
                        <p>
                            <small>
                                By continuing, you agree to our
                                <a href="#!">Terms of Service</a>
                                &
                                <a href="#!">Privacy Policy</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>