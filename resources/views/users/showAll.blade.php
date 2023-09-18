@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <ul id="users">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    window.axios.get('/api/users')
        .then((response) => {
            console.log(response);
            const usersElement = document.getElementById('users');
            let users = response.data;
            users.forEach((user) => {
                let listItemElement = document.createElement('li');
                listItemElement.setAttribute('id', user.id);
                listItemElement.innerHTML = user.name;
                usersElement.appendChild(listItemElement);
            });
        })
        .catch((error) => {
            console.log(error);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    Echo.channel('users')
        .listen('UserCreated', (e) => {
            console.log(e);
            const usersElement = document.getElementById('users');
            let element = document.createElement('li');
            element.setAttribute('id', e.user.id);
            element.innerHTML = e.user.name;
            usersElement.appendChild(element);
        })
        .listen('UserDeleted', (e) => {
            console.log(e);
            const usersElement = document.getElementById('users');
            let element = document.getElementById(e.user.id);
            element.parentNode.removeChild(element);
        })
        .listen('UserUpdated', (e) => {
            console.log(e);
            const usersElement = document.getElementById('users');
            let element = document.getElementById(e.user.id);
            element.innerHTML = e.user.name;
        })
    });
</script>
@endpush