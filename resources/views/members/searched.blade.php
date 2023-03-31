@extends('layouts.userLayout')
@section('content')
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
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection