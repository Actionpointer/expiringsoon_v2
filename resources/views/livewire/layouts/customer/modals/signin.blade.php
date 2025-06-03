<div wire:ignore.self class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div wire:ignore.self class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="signInModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($errorMessage)
                <div class="alert alert-danger">
                    {{ $errorMessage }}
                </div>
                @endif
                
                <div class="needs-validation" id="loginForm">
                    <div class="mb-3">
                        <label for="signin-email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="signin-email" placeholder="Enter Email address"
                            required wire:model="email" autocomplete="off" />
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="signin-password" class="form-label">Password</label>
                        <div class="password-field position-relative">
                            <input type="password" class="form-control fakePassword @error('password') is-invalid @enderror" id="signin-password" placeholder="Enter Password" 
                                required wire:model="password" autocomplete="off">
                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                        </div>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="signin-remember" wire:model.defer="remember">
                        <label class="form-check-label" for="signin-remember">Remember me</label>
                    </div>

                    <button type="button" class="btn btn-primary w-100" wire:click.prevent="submit" id="signInButton">Sign In</button>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                Don't have an account?
                <a href="#" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign up</a>
            </div>
        </div>
    </div>
</div>