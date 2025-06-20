<section class="my-lg-14 my-8">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                <!-- img -->
                <img src="{{ asset('frontend/images/svg-graphics/fp-g.svg') }}" alt="" class="img-fluid" />
            </div>
            <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                <div>
                    <div class="mb-lg-9 mb-5">
                        <!-- heading -->
                        <h1 class="mb-2 h2 fw-bold">Forgot your password?</h1>
                        <p>Please enter the email address associated with your account and We will email you a link to reset
                            your password.</p>
                    </div>
                    <!-- form -->
                    <form class="needs-validation" wire:submit.prevent="forgotPassword">
                        <!-- row -->
                        <div class="row g-3">
                            <!-- col -->
                            <div class="col-12">
                                <!-- input -->
                                <label for="formForgetEmail" class="form-label visually-hidden">Email address</label>
                                <input type="email" class="form-control" id="formForgetEmail" placeholder="Email" required />
                                <div class="invalid-feedback">Please enter correct password.</div>
                            </div>

                            <!-- btn -->
                            <div class="col-12 d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                                <a wire:navigate href="{{ route('signin') }}" class="btn btn-light">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>