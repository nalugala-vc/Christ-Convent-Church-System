@extends('layouts.userLayout')
@section('content')
<form method="POST" action="{{ route('addAdmin') }}" enctype="multipart/form-data" id="reg-form">

@csrf
    <div>
        <h2>Add New Admin</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name">
            </div>
        </div>
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

        <div class="row mb-3">
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection