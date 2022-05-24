@extends('layouts.app')

@section('content')
<section class="section-tb-padding-bg-image" style="background-image: url('/storage/img/farm/news-popup.jpg')">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="login-area">
                    <div class="login-box shadow">
                        <h1>Register</h1>
                        <p>Please login below account detail</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <label for="name" class="mt-3 mb-0">Name</label>
                                <input id="name" type="text" class="mt-0 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="phno" class="mt-3 mb-0">Phone</label>
                                <input id="phno" type="text" class="mt-0 form-control @error('phno') is-invalid @enderror" name="phno" value="{{ old('phno') }}" required autocomplete="phno" autofocus>
                                @error('phno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="mt-3 mb-0">Email</label>
                                <input id="email" type="email" class="mt-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="mt-3 mb-0">Password</label>
                                <input id="password" type="password" class="mt-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="password-confirm" class="mt-3 mb-0">Confirm Pasword</label>
                                <input id="password-confirm" type="password" class="mt-0 form-control"  name="password_confirmation" required >
                            </div>
                            <div class="form-check mt-2 ">
                                <div class="form-row">
                                    <div class="col-1">
                                        <input id="rem" checked class="mb-1 form-check-input" type="checkbox" name="subscribe" {{ old('subscribe') ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-11 mt-1">
                                        <label for="rem" class="form-check-label"> Subscribe to Newsletter </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn-login-custom btn-block btn mt-3">Create</button>
                        </form>
                    </div>
                    <div class="login-account shadow">
                        <h4>Already have an account?</h4>
                        <a href="/login" class="ceate-a">Log In Here</a>
                        <div class="login-info">
                            <a href="/termsandcondition" class="terms-link"><span>*</span> Terms & conditions.</a>
                            <p>You accept to our terms and conditions by continuing to register to our website</p>
                            <p>Your privacy and security are important to us. For more information on how we use your data read our <a href="/privacypolicy">privacy policy</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
