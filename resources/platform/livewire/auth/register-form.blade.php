<div>
    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign Up</h4>
                <p class="mb-0">
                    Enter your email and password to sign up
                </p>
            </div>
            <div class="card-body">
                <form role="form" wire:submit="handleRegistration()">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <input type="text" name="first_name" wire:model="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" placeholder="First Name" aria-label="First Name">
                            @error('first_name')
                                <p class="text-sm text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <input type="text" name="last_name" wire:model="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" placeholder="Last Name" aria-label="Last Name">
                            @error('last_name')
                                <p class="text-sm text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" wire:model="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email">
                        @error('email')
                        <p class="text-sm text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" wire:model="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password">
                        @error('password')
                        <p class="text-sm text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" wire:model="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" aria-label="Confirm Password">
                        @error('password_confirmation')
                        <p class="text-sm text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-2 mb-0">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
            <img src="/assets/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-4 start-0">
            <div class="position-relative">
                <img class="max-width-500 w-100 position-relative z-index-2" src="/assets/img/illustrations/chat.png" alt="chat-img">
            </div>
            <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
            <p class="text-white">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
        </div>
    </div>
</div>
