@extends('layouts.userLayout')

@section('content')
<div class="overview">
    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Dashboard</span>
    </div>

    <div class="boxes">
        <div class="box box1">
            <a href="{{ route('children') }}">
                <img src="/assets/member (2).png" alt="">
                <span class="number">{{$childrenCount}}</span>
                <span class="text">View Children</span>
            </a>
        </div>
        <div class="box box2">
            <a href="{{ route('members') }}">
                <img src="/assets/member (4).png" alt="">
                <span class="number">{{$memberCount}}</span>
                <span class="text">View Members</span>
            </a>
        </div>
        <div class="box box3">
            <a href="{{ route('registerChild') }}">
                <img src="/assets/member (1).png" alt="">
                <span class="text">Add Children</span>
                <span class="number">{{$childrenCount}}</span>
            </a>
        </div>
        <div class="box box4">
            <a href="{{ route('registerMember') }}">
                <img src="/assets/member (3).png" alt="">
                <span class="text">Add Member</span>
                <span class="number">{{$memberCount}}</span>
            </a>
        </div>
    </div>
</div>

<div class="activity">
    <div class="title">
        <i class="uil uil-clock-three"></i>
        <span class="text">Recent Members</span>
    </div>

    <div id="content">
    <main>
        <div class="table-data">
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Spouse Name</th>
                            <th>View Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>
                            @if ($member->profile_picture)
                                <img src="/assets/{{$member->profile_picture}}" alt="{{ $member->name }}" />
                            @else
                                <img src="/assets/trans-logo.png" alt="{{ $member->name }}" />
                            @endif
                                <p>{{$member->name}}</p>
                            </td>
                            <td>{{ $member->email ? $member->email : 'null' }}</td>
                            <td>{{$member->phone_number ? : 'null'}}</td>
                            <td>{{$member->spouse_name}}</td>
                            <td><a href="{{ route('memberDetails', ['id' => $member->id]) }}" id="view">view details</a></td>
                            <td><button class="edit-btn"><a href="{{ route('editMember', ['id' => $member->id]) }}">Edit</a></button></td>
                            <td>
                                <form action="{{ route('deleteMember', ['id' => $member->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</div>
@endsection