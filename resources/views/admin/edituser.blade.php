@extends('index')

@section('content')

    <h1 class="cover-heading">Edit User</h1>
    <p class="lead">{{$userInfo->email}}</p>
    <br>
    <form action="/update/user/{{$userInfo->id}}" method="POST">
        @csrf
        @method('PUT')
        <p class="lead">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your Name" autocomplete="off" value="{{$userInfo->name}}" />
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your E-mail" autocomplete="off" value="{{$userInfo->email}}" />
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="New Password" autocomplete="off" />
            <br>
            <label for="admin_authority">Is Admin</label>
            <select name="admin_authority" class="form-control form-control-lg" style="font-size: 1.45rem;">
                <option {{($userInfo->admin_authority == '0') ? "selected" : ""}} value="0">No</option>
                <option {{($userInfo->admin_authority == '1') ? "selected" : ""}} value="1">Yes</option>
            </select>
            <br>
            <label for="API_token">API Token - <a onclick="generateAPI()" style="color: #3794ff; cursor:hand;cursor:pointer;"><b>GENERATE</b></a></label>
            <input type="text" id="API_token" name="API_token" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="API Token" autocomplete="off" value="{{$userInfo->API_token}}" />
            <script>
                function generateAPI() {
                    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    var Length = 35;
                    var password = "";
                    for (var i = 1; i <= Length; i++) {
                        var randomNumber = Math.floor(Math.random() * chars.length);
                        password += chars.substring(randomNumber, randomNumber +1);
                    }
                    document.getElementById("API_token").value = password;
                }
            </script>
            <br>
            <button type="submit" class="btn btn-primary btn-lg btn-block">EDIT</button>
        </p>
    </form>
    @if($userInfo->email != auth()->user()->email)
    <form method="POST" action="/admin/user/{{$userInfo->id}}/delete">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE USER</button>
    </form>
    @else
        <a onclick="alert('You cannot delete your account.')" class="btn btn-danger btn-lg btn-block">DELETE USER</a>
    @endif
    @error('name')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('admin_authority')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('API_token')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
@endsection
