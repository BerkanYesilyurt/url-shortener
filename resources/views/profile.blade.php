@extends('index')

@section('content')

    <form action="/profile" method="POST">
        @csrf

        <p class="lead">

            <br><br>
        <h1 class="cover-heading">PROFILE SETTINGS</h1>
            <br>
            <input type="text" name="name" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your New Name" value="{{auth()->user()->name}}" autocomplete="off" />
            <br>
            <input type="password" name="oldpassword" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Old Password" autocomplete="off" required />
            <br>
            <input type="password" name="password" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="New Password" autocomplete="off" />
            <br>
            <input type="password" name="password_confirmation" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Confirm Password" autocomplete="off" />
            <br>
            <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE</button>
        @error('name')
        <br>
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        @error('password')
        <br>
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror

    </form>
    <br><br>
    <h1 class="cover-heading">API</h1>
    <br>
    @if(is_null(auth()->user()->API_token))
        <a href="/generateToken" class="btn btn-primary btn-lg btn-block">Generate API Token</a>
    @else
        <input class="form-control" style="text-align:center; font-size: 130%" type="text" onclick="this.select();" value="{{auth()->user()->API_token}}" readonly />
        <br>
        <a href="/generateToken" class="btn btn-primary btn-lg btn-block">Regenerate API Token</a>
    @endif
    </p>

@endsection
