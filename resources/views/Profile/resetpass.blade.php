@extends('layouts.profile')

@section('subcontent')
<div style="background-image: url('/storage/img/bgg1.png'); min-height: 80vh">

<div class="container-fluid h-100">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
          <ol class="breadcrumb breadcrumb-bar" style="background-color: rgba(255, 255, 255, 0.7)">
            <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
            <li class="breadcrumb-item"><a class='text-dark' href="/profile/loginandsecurity">Login & Security  </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Reset Password </li>
          </ol>
        </div>
        <div class="col-md-8">
            <div class="card shadow mt-3">
                <div class="card-body">
                    <div class="container text-center">
                        <h3 class="py-2 font-weight-bold font-prim">Reset Password</h3>
                        <hr>
                    </div>
                    <form method="POST" action="/profile/resetpassword">
                        @csrf
                        <div class="form-group row">
                            <label for="oldpassword" class="font-weight-bold font-prim color-prim col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" required>
                                @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="font-weight-bold font-prim color-prim col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="font-weight-bold font-prim color-prim col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-login-custom float-right">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
