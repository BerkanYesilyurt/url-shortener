@extends('index')

@section('content')
    <h1 class="cover-heading">URL Shortener</h1>
    <br>
    <p class="lead">Free custom URL Shortener with many features that gives you better quality for links shortening. Shortened URLs will never expire. We do not display ads during direct redirecting to the original url.</p>
    <br>
    <form action="/shorten" method="POST">
        @csrf
        <p class="lead">
            <input type="text" name="url" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Shorten Your Link" autocomplete="off" value="{{old('url')}}" />
            <br>
            <select name="private" id="private" class="form-control form-control-lg" onchange="bring()" style="font-size: 1.45rem;">
                <option {{(old('private') == '0') ? "selected" : ""}} value="0">Public</option>
                <option {{(old('private') == '1') ? "selected" : ""}} value="1">Private</option>
            </select>

        <div id="emailarea" style="display: {{(old('private') == '1') ? "inline" : "none"}};">
            <input type="text" name="email" id="email" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Emails (comma separated)" autocomplete="off" value="{{old('email')}}" />
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-lg btn-block">SHORTEN</button>
        </p>
    </form>
    @if(session('short_path'))
        <div class="alert alert-success">
            <strong>SUCCESS!</strong> <p>You can copy the shortened link below.</p>
            <input class="form-control" style="text-align:center; font-size: 130%" type="text" onClick="this.select();" value="{{url('/') . "/" . session('short_path')}}" readonly />
            <br>
            <p>
                <a target="_blank" href="{{url('/') . "/stats/" . session('short_path')}}" class="badge badge-dark" style="font-size: 120%">Stats</a>
            </p>
        </div>
    @endif

    @error('url')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('private')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror
    @error('email')
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @enderror

    <script type="application/javascript">
        function bring(){

            var select = document.getElementById('private');
            var value = select.options[select.selectedIndex].value
            if(value == 1){
                document.getElementById("emailarea").style.display = "inline";
            }else{
                document.getElementById("emailarea").style.display = "none";
            }
        }
    </script>
@endsection
