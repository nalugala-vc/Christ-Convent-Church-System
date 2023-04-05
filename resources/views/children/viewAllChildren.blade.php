@extends('layouts.userLayout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="div" id="div">
    <div class="confirm-popup">
        <img src="/assets/delete.png" alt="">
        <h2>Are you sure you want to <br> delete this member?</h2>
        <div class="button-div">
            <button id="edit-btn">No</button>
            <button id="delete-btn">Yes</button>
        </div>
    </div>
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
                            <td><a href="{{ route('childDetails', ['id' => $child->id]) }}" id="view">view details</a></td>
                            <td><button class="edit-btn"><a href="{{ route('editChild', ['id' => $child->id]) }}">Edit</a></button></td>
                            <td>
                                    <button class="delete-btn" id="delete-{{$child->id}}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script>
    const children = @json($children);

    children.forEach(element => {
    const deleteButton = document.getElementById(`delete-${element.id}`);
    const no_delete = document.getElementById('edit-btn');

    // Create a closure for the element variable
    const deleteHandler = () => {
        document.getElementById("div").style.display = "flex";
        const delete_member = document.getElementById('delete-btn');
        delete_member.addEventListener('click', () => {
        deleteMember(element);
        document.getElementById("div").style.display = "none";
        });
    }

    deleteButton.addEventListener('click', deleteHandler);

    no_delete.addEventListener('click', () => {
        document.getElementById("div").style.display = "none";
    });
    });

    function deleteMember(element) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/deleteChild/${element.id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        })
        .then(response => {
        // Handle the response from the server
        if (response.redirected) {
            window.location.href = response.url;
        } else {
            return response.json();
        }
        console.log(response)
        }).then(data => {
            // Handle the JSON response
            console.log(data.message);
            if(data.status == 'success'){
                window.location.href = "/children"
                const successMsg = document.createElement('div');
                successMsg.classList.add('cart-popup-success');
                successMsg.textContent = data.message;
                document.body.appendChild(successMsg);
                setTimeout(function () {
                successMsg.style.display = 'none';
                }, 3000);
            } else {
                const errorMsg = document.createElement('div');
                errorMsg.classList.add('cart-popup-error');
                errorMsg.textContent = 'An error occurred while deleting member.';
                document.body.appendChild(errorMsg);
                setTimeout(function () {
                errorMsg.style.display = 'none';
                }, 3000);
            }
        })
        .catch(error => {
            // Handle any errors that occur
            console.error(error);
            const errorMsg = document.createElement('div');
            errorMsg.classList.add('cart-popup-error');
            errorMsg.textContent = 'An error occurred while adding the item to cart.';
            document.body.appendChild(errorMsg);
            setTimeout(function () {
            errorMsg.style.display = 'none';
            }, 3000);
        });
    }

</script>
@endsection