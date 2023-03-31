@extends('layouts.userLayout')
@section('content')
<div class="details">
<div class="details-div">
    <div class="info">
        <div class="details-img">
            @if ($child->profile_picture)
                <img src="/assets/{{$child->profile_picture}}" alt="{{ $child->name }}" />
            @else
                <img src="/assets/trans-logo.png" alt="{{ $child->name }}" />
            @endif
        </div>
        <div class="name"><h3>{{$child->name}}</h3></div>
    </div>
    <ul>
        @if($child->mother_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-person-breastfeeding"></i>
                <p>Mother</p>
            </span>
            <span>
                <p>{{$child->mother->name}}</p>
                <a href="{{ route('memberDetails', ['id' => $child->mother_id]) }}">view details</a>
            </span>
        </li>
        @endif
        @if($child->father_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-person"></i>
                <p>Father</p>
            </span>
            <span>
                <p>{{$child->father->name}}</p>
                <a href="{{ route('memberDetails', ['id' => $child->father_id]) }}">view details</a>
            </span>
        </li>
        @endif
        @if($child->guardian_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-person-rays"></i>
                <p>Guardian</p>
            </span>
            <span>
                <p>{{$child->guardian->name}}</p>
                <a href="{{ route('memberDetails', ['id' => $child->guardian_id]) }}">view details</a>
            </span>
        </li>
        @endif
        @if($child->mother_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-location-dot"></i>
                <p>Address</p>
            </span>
            <span class="address">{{$child->mother->home_address}}</span>
        </li>
        @elseif ($child->father_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-location-dot"></i>
                <p>Address</p>
            </span>
            <span class="address">{{$child->father->home_address}}</span>
        </li>
        @elseif ($child->guardian_id)
        <li>
            <span class="deets">
                <i class="fa-solid fa-location-dot"></i>
                <p>Address</p>
            </span>
            <span class="address">{{$child->guardian->home_address}}</span>
        </li>
        @endif

        @if($child->phone_number)
        <li>
            <span class="deets">
                <i class="fa-solid fa-phone"></i>
                <p>Phone</p>
            </span>
            <span>{{$child->phone_number}}</span>
        </li>
        @endif
        @if($child->email)
        <li>
            <span class="deets">
                <i class="fa-solid fa-envelope"></i>
                <p>Email</p>
            </span>
            <span id="email">{{$child->email}}</span>
        </li>
        @endif
        <li>
            <span class="deets">
                <i class="fa-solid fa-calendar-days"></i>
                <p>Date of Birth</p>
            </span>
            <span>{{$child->DOB}}</span>
        </li>
        <li>
            <span class="deets">
                <i class="fa-regular fa-calendar"></i>
                <p>Age</p>
            </span>
            <span>{{$age}} years</span>
        </li>
    </ul>
</div>
</div>
@endsection