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
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                            <a href="{{ url('/') }}">
                                <h1>{{ config('app.name') }}</h1>
                            </a>
                            <h6 class="mb-4">{{ __('Reset Password') }}</h6>
                            <form method="POST" action="{{ route('password.email') }}" >
                                @csrf
                                <label class="form-group has-float-label mb-4">
                                    <input id="email" type="email" class="form-control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                    <span>E-mail</span>
                                </label>
                                
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">{{ __('Send Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.include.script')
</body>
</html>