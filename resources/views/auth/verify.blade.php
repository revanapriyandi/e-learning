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
                <div class="col-12 col-sm-8 col-md-10 mx-auto my-auto">
                    <div class="card index-card">
                        <div class="card-body text-center form-side">
                            <a href="Dashboard.Default.html">
                                <h1>{{ config('app.name') }}</h1>
                            </a>
                            <p class="lead mb-5">{{ __('Verify Your Email Address') }}</p>
                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12 offset-0 col-md-8 offset-md-2 mb-2">
                                    <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                                        {{ __('If you did not receive the email') }}, <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                        </form></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('layouts.include.script')
    </body>
    </html>