@extends('layouts.userLayout')
@section('content')
<form method="POST" action="{{ route('updateMember', ['id' => $member->id]) }}" enctype="multipart/form-data" id="reg-form">

@csrf
@method('PUT')
    <div>
        <h2>Edit Member</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $member->name }}" required autocomplete="name" placeholder="Name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $member->email }}" required autocomplete="email" placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
            <input type="file" name="profile_picture" id="">

                @error('profile_picture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="home_address" type="text" class="form-control @error('home_address') is-invalid @enderror" name="home_address" value="{{ $member->home_address }}" required autocomplete="home_address" autofocus placeholder="Home Address">

                @error('home_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $member->phone_number }}" required autocomplete="phone_number" autofocus placeholder="Phone Number">

                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="spouse_name" type="text" class="form-control @error('spouse_name') is-invalid @enderror" spouse_name="spouse_name" value="{{ $member->spouse_name }}" required autocomplete="spouse_name" placeholder="Spouse Name">

                @error('spouse_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Edit
                </button>
            </div>
        </div>
    </div>
</form>
@endsection