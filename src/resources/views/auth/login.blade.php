@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card opacitybg">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="mb-2">
                                        <a href="{{ route('auth_social', ['provider' => 'vkontakte']) }}">
                                            <button type="button" class="social-button vk-button">
                                            <span class="social-button__icon vk-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/VKLogo.svg")}}">
                                                </object>
                                            </span>
                                                <span
                                                    class="social-button__text vk-text">{{ __('Sign in with') }} VK</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="{{ route('auth_social', ['provider' => 'google']) }}">
                                            <button type="button" class="social-button google-button">
                                            <span class="social-button__icon google-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/GoogleLogo.svg")}}">
                                                </object>
                                            </span>
                                                <span class="social-button__text google-text">{{ __('Sign in with') }} Google</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="{{ route('auth_social', ['provider' => 'twitter']) }}">
                                            <button type="button" class="social-button twitter-button">
                                            <span class="social-button__icon twitter-icon">
                                                <object
                                                    type="image/svg+xml"
                                                    data="{{asset("images/social/TwitterLogo.svg")}}">
                                                </object>
                                            </span>
                                                <span
                                                    class="social-button__text twitter-text">{{ __('Sign in with') }} Twitter</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('auth_social', ['provider' => 'facebook']) }}">
                                            <button type="button" class="social-button facebook-button">
                                            <span class="social-button__icon facebook-icon">
                                                <img src="{{asset("images/social/FacebookLogo.png")}}" alt="" height="100%" width="100%">
                                            </span>
                                                <span
                                                    class="social-button__text facebook-text">{{ __('Sign in with') }} Facebook</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <div class="vl">
                                        <span class="vl-innertext">{{ __('or') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 d-md-none text-center  mb-4">
                                    <div class="form-group">
                                        <div class="gl">
                                            <span class="gl-innertext">{{ __('or') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input id="login" type="text"
                                               class="form-control{{ $errors->has('nickname') || $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="login" placeholder="{{ __('Nickname or E-mail') }}"
                                               value="{{ old('nickname') ?: old('email') }}" required
                                               autofocus>

                                        @if ($errors->has('nickname') || $errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nickname') ?: $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               placeholder="{{ __('Password') }}"
                                               required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
