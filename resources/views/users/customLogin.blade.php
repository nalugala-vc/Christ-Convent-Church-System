<form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" id="reg-form">
@csrf
    <div>
    <h2>Sign In</h2>
    @if($errors->any())
    <span class="red" role="alert">
        <strong>{{ $errors->first() }}</strong>
    </span>
    @endif
    <div class="row mb-3">
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
        </div>
    </div>
    <div class="mb-0" id="rem">
        <div class="col-md-6 offset-md-4" id="rem">
            <input type="checkbox" name="remember" id="check">
            <p>Remember me?</p>
        </div>
        <div class="col-md-6 offset-md-4">
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        </div>
    </div>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </div>
    <div class="mb">
        <div class="col-md-6 offset-md-4">
            <p>Already have an account?</p>
            <a href="">Sign In</a>
        </div>
    </div>
    </div>
</form>