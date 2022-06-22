@extends('layouts.login')

@section('content')
    <div class="container-login rows no-gutters">
        <div class="form__login col l-6 m-12 c-12">
            <div class="block__login">
                <div class="login__header">{{ __('Login') }}</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <p class="title__login">{{ __('E-mail') }}</p>
                        <div class="email--login">
                            <img src="{{ asset('/assets/image/email.svg') }}" alt="email-icon" >
                            <input id="email" type="email" class=" @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                        </div>
                    <p class="title__login" style="margin-top:21px">{{ __('Password') }}</p>
                    <div class="input__pwd--login">
                        <div class="email--login">
                            <img src="{{ asset('/assets/image/key.svg') }}" alt="key-icon" >
                            <input id="password" type="password" class="@error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Enter your pasword">
                        </div>
                        @error('email')
                            <span class="text-dangers" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="bottom__login">
                        <label class="container__remember--me">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmarks"></span>
                                {{ __('Remember Me') }}
                            </label>
                        @if (Route::has('password.request'))
                            <a class="btn_forgot--pasword" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="btn_submit">
                        {{ __('Login') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="bg__login col l-6 m-0 c-0">
            <div class="background"></div>
        </div>
    </div>
@endsection
