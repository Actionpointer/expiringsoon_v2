<div wire:ignore.self class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div wire:ignore.self class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="signUpModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($errorMessage)
                <div class="alert alert-danger">
                    {!! $errorMessage !!}
                </div>
                @endif
                
                <div class="needs-validation" id="signupForm">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstName" 
                                placeholder="Enter Your First Name" required wire:model="firstname" autocomplete="off" />
                            @error('firstname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="surname" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" 
                                placeholder="Enter Your Last Name" required wire:model="surname" autocomplete="off" />
                            @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="signup-email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="signup-email" 
                            placeholder="Enter Email address" required wire:model="email" autocomplete="off" />
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Password</label>
                        <div class="password-field position-relative">
                            <input type="password" class="form-control fakePassword @error('password') is-invalid @enderror" 
                                id="signup-password" placeholder="Enter Password" required wire:model="password" autocomplete="off">
                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                        </div>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <small class="form-text">
                            By signing up, you agree to our
                            <a href="#!">Terms of Service</a>
                            &
                            <a href="#!">Privacy Policy</a>
                        </small>
                    </div>

                    <button type="button" class="btn btn-primary w-100" wire:click.prevent="submit" id="signUpButton">Sign Up</button>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                Already have an account?
                <a href="#" data-bs-toggle="modal" data-bs-target="#signInModal">Sign in</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggler functionality
        document.querySelectorAll('.passwordToggler').forEach(function(toggler) {
            toggler.addEventListener('click', function() {
                const passwordField = this.closest('.password-field').querySelector('input');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });

        // Listen for Livewire events
        Livewire.on('registered', () => {
            // Close the signup modal when registration is successful
            const modal = bootstrap.Modal.getInstance(document.getElementById('signUpModal'));
            if (modal) {
                modal.hide();
            }
        });
    });
</script> -->
@endpush