@extends('layouts.userLayout')

@section('content')
<div class="overview">
    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Dashboard</span>
    </div>

    <div class="boxes">
        <div class="box box1">
            <img src="/assets/member (2).png" alt="">
            <span class="number">50,120</span>
            <span class="text">View Children</span>
        </div>
        <div class="box box2">
            <img src="/assets/member (4).png" alt="">
            <span class="number">50,120</span>
            <span class="text">View Members</span>
        </div>
        <div class="box box3">
            <img src="/assets/member (1).png" alt="">
            <span class="text">Add Children</span>
            <span class="number">20,120</span>
        </div>
        <div class="box box4">
        <img src="/assets/member (3).png" alt="">
            <span class="text">Add Member</span>
            <span class="number">10,120</span>
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
</div>
@endsection