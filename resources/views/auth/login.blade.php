@extends('layouts.app')

@section('content')
<section class="section-tb-padding-bg-image" style="background-image: url('/storage/img/farm/news-popup.jpg')">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="login-area">
                    <div class="login-box shadow" style="border-radius: 3px">
                        <h1>Login</h1>
                        <p>Login with your credentials if you are an existing user</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div>
                                <label for="email" class="mb-0">Email/PhoneNumber</label>
                                <input id="email" type="text" class="mt-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="mb-0 mt-4">Password</label>
                                <input id="password" type="password" class="mt-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-check mt-2">
                                <div class="form-row">
                                    <div class="col-1">
                                        <input id="rem" class="form-check-input mb-1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-11 mt-1">
                                        <label for="rem" class="form-check-label"> {{ __('Remember Me') }} </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-login-custom btn-block mt-3">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" style="color: var(--prim)" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif

                                {{-- <div class="mt-3">
                                    <a href="{{ url('login/google') }}" class="btn btn-block btn-outline-success "><i class="fab mr-3 fa-google-plus" aria-hidden="true"></i>  Login using Google</a>

                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <div class="login-account shadow" style="border-radius: 3px">
                        <h4>Don't have an account?</h4>
                        <a href="/register" class="ceate-a">Create account</a>
                        <div class="login-info">
                            <a href="/termsandcondition" class="terms-link"><span>*</span> Terms & conditions.</a>
                            <p>Your privacy and security are important to us. For more information on how we use your data read our <a href="/privacypolicy">privacy policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
