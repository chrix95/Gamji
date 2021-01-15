@extends('layouts.app')
@section('page', 'Reset password')
@section('content')
<section class="login-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset('files/logo.svg') }}" alt="Gamji Group Logo">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-left">Recover your password</h3>
                                </div>
                            </div>
                            @if (session('status'))
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group form-primary">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span class="form-bar"></span>
                                <label class="float-label">Your Email Address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                            <p class="f-w-600 text-right">
                                <a href="{{ route('welcome') }}">
                                    Back to Login.
                                </a>
                            </p>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left">
                                        <a href="{{ route('welcome') }}">
                                            <strong>Back to website</strong>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <img src="{{ asset('files/logo.svg') }}" style="width: 100%" alt="Gamji Group">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
