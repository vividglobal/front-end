@extends('layouts.login')

@section('content')
    <div class="container-login rows no-gutters">
        <div class="form__login col l-6 m-12 c-12">
            <div class="block__login">
                <div class="login__header">{{ __('Recover Password') }}</div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <p class="text_recover--pass">Please re-enter the email address associated with your account to recover your password. We will send a recovery link to your email.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="title__login">{{ __('E-mail') }}</p>
                    <div class="email--login">
                        <img src="{{ asset('/assets/image/email.svg') }}" alt="email-icon" >
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email"
                        oninvalid="this.setCustomValidity('Please enter your email')">
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn_submit">
                        {{ __('Recover password') }}
                    </button>
                </form>
                <a href="{{ route('login') }}">
                    <button type="submit" class="btn_back--login">
                            {{ __('Back to login') }}
                    </button>
                </a>
            </div>
        </div>
        <div class="bg__login col l-6 m-0 c-0">
            <div class="background"></div>
        </div>
    </div>
@endsection
