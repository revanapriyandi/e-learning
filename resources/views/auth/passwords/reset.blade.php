<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.include.head')
</head>
<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">
                            
                            <p class="text-white h2">MAGIC IS IN THE DETAILS</p>
                            
                            <p class="white mb-0">
                                Please us your credentials to login.
                                <br>If you are not a member, please
                                <a href="#" class="white">register</a>.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="{{ url('/') }}">
                                <h1>{{ config('app.name') }}</h1>
                            </a>
                            <h6 class="mb-4">Reset Password</h6>
                            <form method="POST" action="{{ route('password.update') }}" id="exampleForm" class="needs-validation tooltip-label-right" novalidate>
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <label class="form-group has-float-label mb-4">
                                    <input id="email" type="email" class="form-control @error('email') error @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                                    <span>{{ __('Alamat E-Mail') }}</span>
                                    @error('email')
                                    <span class="invalid-tooltip" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>
                                
                                <label class="form-group has-float-label mb-4">
                                    <input id="password" type="password" class="form-control @error('password') error @enderror" name="password" required autocomplete="new-password" />
                                    <span>Password</span>
                                    @error('password')
                                    <span class="invalid-tooltip" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                                    <span>Konfirmasi Password</span>
                                    @error('password')
                                    <span class="invalid-tooltip" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">{{ __('Reset Password') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.include.script')
    <script src="{{ asset('js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
</body>
</html>