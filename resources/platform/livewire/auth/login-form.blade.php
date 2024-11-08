<div>
    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign In</h4>
                <p class="mb-0">Enter your email and password to sign in</p>
            </div>
            <div class="card-body">
                <form role="form" wire:submit="handleLogin()">
                    <div class="mb-3">
                        <input type="email" name="email" wire:model="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Email" aria-label="Email">
                        @error('email')
                            <p class="text-sm text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" wire:model="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Password" aria-label="Password">
                        @error('password')
                            <p class="text-sm text-danger mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:model="remember" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign
                            in</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="/platform/livewire/auth/register-form.blade.php"
                        class="text-dark text-gradient font-weight-bold">Sign up</a>
                </p>
            </div>


            <!-- Google Login Button -->

            <a href='/auth/sso/google/redirect' aria-label="Sign in with Google">
                <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-700">
                    <button
                        class="flex items-center bg-white dark:bg-gray-900 border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 dark:text-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="50px"
                            viewBox="-0.5 0 48 48" version="1.1">
                            <title>Google-color</title>
                            <desc>Created with Sketch.</desc>
                            <defs> </defs>
                            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                    <g id="Google" transform="translate(401.000000, 860.000000)">
                                        <path
                                            d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24"
                                            id="Fill-1" fill="#FBBC05"> </path>
                                        <path
                                            d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333"
                                            id="Fill-2" fill="#EB4335"> </path>
                                        <path
                                            d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667"
                                            id="Fill-3" fill="#34A853"> </path>
                                        <path
                                            d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24"
                                            id="Fill-4" fill="#4285F4"> </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span>Continue with Google</span>
                    </button>
                </div>
        </div>
        <div
            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div
                class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                <img src="/assets/img/shapes/pattern-lines.svg" alt="pattern-lines"
                    class="position-absolute opacity-4 start-0">
                <div class="position-relative">
                    <img class="max-width-500 w-100 position-relative z-index-2"
                        src="/assets/img/illustrations/chat.png" alt="chat-img">
                </div>
                <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
                <p class="text-white">The more effortless the writing looks, the more effort the writer actually put
                    into
                    the process.</p>
            </div>
        </div>
    </div>
