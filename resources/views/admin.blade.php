@extends('index')

@section('content')

    <h1 class="cover-heading">USERS</h1>
    <br>
    <p class="lead">
    <div class="alert alert-warning" role="alert" style="text-shadow: none;">
        <b>Total Users: {{count($users)}}</b>
    </div>
    </p>




    @if(count($users) > 0)
        <table class="table" style="text-shadow: none;">
            <thead>
            <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Admin</th>
                <th scope="col">Links</th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="table-secondary">
                    <td><b>{{$user->id}}</b></td>
                    <td>{{substr($user->name, 0, 6)}}...</td>
                    <td>{{$user->email}}</td>
                    <td>@php
                            if($user->admin_authority == 1){
                                echo 'Yes';
                            }else{
                                echo 'No';
                            }
                        @endphp</td>
                    <td><a target="_blank" href="{{url('/') . '/admin/user/' . $user->id}}" class="btn btn-info">Links</a></td>
                    <td><a target="_blank" href="{{url('/') . '/admin/user/' . $user->id . '/edit'}}" class="btn btn-danger">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <style>
            .bg-white { background-color: transparent!important; }
        </style>
        <br>
        {{ $users->links() }}
    @else
        <font size="5"><center>No users found.</center></font>
    @endif



@endsection
