@extends('layouts.login')
@section('body')
<form method="POST" action="{{ route('login') }}" id="reg-form">
    @csrf

    <div>
    <div class="img-div">
        <img src="/assets/trans-logo.png" alt="">
    </div>
    <h2>Welcome back Admin!</h2>
    @if($errors->any())
    <span class="red" role="alert">
        <strong>{{ $errors->first() }}</strong>
    </span>
    @endif
    <div class="row mb-3">

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        </div>
    </div>

    <div class="mb-0" id="rem">
        <div class="col-md-6 offset-md-4">
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
        </div>
    </div>
    </div>
</form>
@endsection