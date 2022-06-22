@extends('layouts.login')

@section('content')
    <div class="container-login rows no-gutters">
        <div class="form__login col l-6 m-12 c-12">
            <div class="block__login">
                <div class="login__header">{{ __('Reset Password') }}</div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- EMAIL INPUT --}}
                    <p class="title__login">{{ __('E-mail') }}</p>
                    <div class="email--login">
                        <img src="{{ asset('/assets/image/email.svg') }}" alt="email-icon" >
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"
                            required autocomplete="email" placeholder="Enter your email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- PASSWORD INPUT --}}
                    <p class="title__login">{{ __('Password') }}</p>
                    <div class="email--login">
                        <img src="{{ asset('/assets/image/key.svg') }}" alt="key-icon" >
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                            required autocomplete="new-password" placeholder="Enter your password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- CONFIRM PASSWORD INPUT --}}
                    <p class="title__login">{{ __('Confirm Password') }}</p>
                    <div class="email--login">
                        <img src="{{ asset('/assets/image/key.svg') }}" alt="key-icon" >
                        <input id="password-confirm" type="password" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Enter confirm password">
                    </div>

                    <button type="submit" class="btn_submit">
                        {{ __('Reset password') }}
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
