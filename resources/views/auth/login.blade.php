@extends('layouts.app')
@section('page', 'Login')
@section('content')
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form method="POST" action="{{ route('login') }}" class="md-float-material form-material">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset('files/assets/images/logo.png') }}" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign In</h3>
                                </div>
                            </div>
                            <p class="text-muted text-center p-b-5">Sign in with your regular account</p>
                            <div class="form-group form-primary">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" value="{{ old('email') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Email Address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  required autocomplete="current-password">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right float-right">
                                        @if (Route::has('password.request'))
                                            <a class="text-right f-w-600" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
