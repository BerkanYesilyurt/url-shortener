@extends('index')

@section('content')
    <h1 class="cover-heading">Profile</h1>
    <br>
    <p class="lead">Update your profile.</p>
    <br>
    <form action="/profile" method="POST">
        @csrf
        <p class="lead">

            <input type="text" name="name" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your New Name" value="{{auth()->user()->name}}" autocomplete="off" />
            <br>
            <hr style="border: 1px solid white;">
            <br>
            <input type="password" name="oldpassword" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Old Password" autocomplete="off" required />
            <br>
            <input type="password" name="password" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="New Password" autocomplete="off" />
            <br>
            <input type="password" name="password_confirmation" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Confirm Password" autocomplete="off" />
            <br>
            <button type="submit" class="btn btn-primary btn-lg btn-block">UPDATE</button>
        </p>
    </form>
    @error('name')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
@endsection
