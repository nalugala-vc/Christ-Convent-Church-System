@extends('layouts.userLayout')
@section('content')
<form method="POST" action="{{ route('updateChild', ['id' => $child->id]) }}"  enctype="multipart/form-data" id="reg-form">

@csrf
@method('PUT')
    <div>
        <h2>Edit Child's Details</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <input 
                    id="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" 
                    value="{{ $child->name }}" 
                    required 
                    autocomplete="name" 
                    placeholder="Name"
                    >

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input 
                id="father_name" 
                type="text" 
                class="form-control @error('father_name') is-invalid @enderror" 
                name="father_name" 
                data-autocomplete-url="{{ route('getMembersNames') }}"
                value="{{ $child->father ? $child->father->name : '' }}" 
                autocomplete="father_name" placeholder="Father's Name">
                <ul id="member-suggestions"></ul>

                @error('father_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input 
                    id="mother_name" 
                    type="text" 
                    class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" 
                    value="{{ $child->mother ? $child->mother->name : '' }}"
                    autocomplete="mother_name" 
                    data-autocomplete-url="{{ route('getMembersNames') }}"
                    placeholder="Mother's Name">
                <ul id="mother_suggestions"></ul>

                @error('mother_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input 
                    id="guardian_name" 
                    type="text" 
                    class="form-control @error('guardian_name') is-invalid @enderror" name="guardian_name" 
                    value="{{ $child->guardian ? $child->guardian->name : '' }}" autocomplete="guardian_name" 
                    data-autocomplete-url="{{ route('getMembersNames') }}"
                    placeholder="Guardian's Name">
                <ul id="guardian_suggestions"></ul>

                @error('guardian_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
            <input type="file" name="profile_picture" id="">

                @error('profile_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $child->phone_number }}" autocomplete="phone_number" autofocus placeholder="Phone Number">

                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input 
                    id="DOB" 
                    type="date" 
                    class="form-control @error('DOB') is-invalid @enderror" 
                    name="DOB" value="{{ $child->DOB }}" required autocomplete="DOB" placeholder="Date Of Birth">

                @error('DOB')
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
<script src="{{ asset('js/autocomplete.js') }}"></script>
@endsection