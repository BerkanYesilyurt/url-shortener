
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>URL Shortener</title>
    <meta name="description" content="URL Shortener">


    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('css/cover.css')}}" rel="stylesheet">
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">LOGO</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="#">Home</a>
                <!--<a class="nav-link" href="#">Features</a>
                <a class="nav-link" href="#">Contact</a>
                -->
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">URL Shortener</h1>
        <br>
        <p class="lead">Free custom URL Shortener with many features that gives you better quality for links shortening. Shortened URLs will never expire. We do not display ads during direct redirecting to the original url.</p>
        <br>
        <form action="/shorten" method="POST">
         @csrf
        <p class="lead">
            <input type="text" name="url" class="form-control form-control-lg" style="font-size: 1.45rem;" placeholder="Shorten Your Link" value="{{old('url')}}">
            <br>
            <select name="private" class="form-control form-control-lg" style="font-size: 1.45rem;">
                <option {{(old('private') == '0') ? "selected" : ""}} value="0">Public</option>
                <option {{(old('private') == '1') ? "selected" : ""}} value="1">Private</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary btn-lg btn-block">SHORTEN</button>
        </p>
        </form>
            @if(session('short_path'))
            <div class="alert alert-success">
                <strong>SUCCESS!</strong> <p>You can copy the shortened link below.</p>
                <input class="form-control" style="text-align:center; font-size: 130%" type="text" onClick="this.select();" value="{{url('/') . "/" . session('short_path')}}" readonly>
                <br>
                <p>
                <a href="{{url('/') . "/stats/" . session('short_path')}}" class="badge badge-dark" style="font-size: 120%">Stats</a>
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
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p><a href="https://github.com/BerkanYesilyurt/url-shortener">BerkanYesilyurt/url-shortener</a></p>
        </div>
    </footer>
</div>


</body>
</html>
