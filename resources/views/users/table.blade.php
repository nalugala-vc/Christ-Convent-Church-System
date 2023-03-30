@extends('layouts.userLayout')
@section('content')
<div id="content">
    <main>
    <div class="table-data">
    <div class="order">
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>County</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                <img src="/assets/trans-logo.png" alt={user.firstName} />

                    <p>name</p>
                </td>
                <td>email</td>
                <td>password</td>
                <td>what</td>
                <td>wehe</td>
                <td><button class="edit-btn"><a href="">Edit</a></button></td>
                <td>
                    <form action="" method="POST">
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