@extends('index')

@section('content')
    <h1 class="cover-heading">Login</h1>
    <br>
    <p class="lead">Log in now and use all our features for free.</p>
    <br>
    <form action="/login" method="POST">
        @csrf
        <p class="lead">
            <input type="text" name="email" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your E-mail" autocomplete="off" value="{{old('email')}}" />
            <br>
            <input type="password" name="password" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Your Password" autocomplete="off" />
            <br>

        <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
        </p>
    </form>
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
@endsection
