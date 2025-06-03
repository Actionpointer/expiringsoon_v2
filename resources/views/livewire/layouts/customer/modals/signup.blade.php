<div wire:ignore.self class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div wire:ignore.self class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="signUpModalLabel">Sign Up</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name"
                            required />
                        <div class="invalid-feedback">Please enter name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signup-email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signup-email" placeholder="Enter Email address"
                            required />
                        <div class="invalid-feedback">Please enter email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Password</label>
                        <div class="password-field position-relative">
                            <input type="password" class="form-control fakePassword" id="signup-password" placeholder="Enter Password" required="">
                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                        </div>
                        <small class="form-text">
                            By Signup, you agree to our
                            <a href="#!">Terms of Service</a>
                            &
                            <a href="#!">Privacy Policy</a>
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary" type="submit">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                Already have an account?
                <a href="#">Sign in</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush