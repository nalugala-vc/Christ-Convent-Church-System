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
                            <th>Date Of Birth</th>
                            <th>View Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($children as $child)
                        <tr>
                            <td>
                            @if ($child->profile_picture)
                                <img src="/assets/{{$child->profile_picture}}" alt="{{ $child->name }}" />
                            @else
                                <img src="/assets/trans-logo.png" alt="{{ $child->name }}" />
                            @endif
                                <p>{{$child->name}}</p>
                            </td>
                            <td>{{ $child->email ? $child->email : 'null' }}</td>
                            <td>{{$child->phone_number ? : 'null'}}</td>
                            <td>{{$child->DOB}}</td>
                            <td><a href="" id="view">view details</a></td>
                            <td><button class="edit-btn"><a href="{{ route('editChild', ['id' => $child->id]) }}">Edit</a></button></td>
                            <td>
                                <form action="{{ route('deleteChild', ['id' => $child->id]) }}" method="POST">
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
@endsection