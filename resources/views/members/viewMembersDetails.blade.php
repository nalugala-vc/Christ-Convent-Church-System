@extends('layouts.userLayout')
@section('content')
<div class="details">
<div class="details-div">
    <div class="info">
        <div class="details-img">
            @if ($member->profile_picture)
                <img src="/assets/{{$member->profile_picture}}" alt="{{ $member->name }}" />
            @else
                <img src="/assets/trans-logo.png" alt="{{ $member->name }}" />
            @endif
        </div>
        <div class="name"><h3>{{$member->name}}</h3></div>
    </div>
    <ul>
        @if($member->spouse_name)
        <li>
            <span class="deets">
                <i class="fa-solid fa-person-rays"></i>
                <p>Spouse</p>
            </span>
            <span>
                <p>{{$member->spouse_name}}</p>
            </span>
        </li>
        @endif
        <li>
            <span class="deets">
                <i class="fa-solid fa-location-dot"></i>
                <p>Address</p>
            </span>
            <span class="address">{{$member->home_address}}</span>
        </li>
        @if($member->phone_number)
        <li>
            <span class="deets">
                <i class="fa-solid fa-phone"></i>
                <p>Phone</p>
            </span>
            <span>{{$member->phone_number}}</span>
        </li>
        @endif
        @if($member->email)
        <li>
            <span class="deets">
                <i class="fa-solid fa-envelope"></i>
                <p>Email</p>
            </span>
            <span id="email">{{$member->email}}</span>
        </li>
        @endif
    </ul>
</div>
</div>
@endsection