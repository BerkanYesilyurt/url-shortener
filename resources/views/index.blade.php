
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>URL Shortener</title>
    <meta name="description" content="URL Shortener">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">
    <style>
        label {
            color: white;
            font-weight: bold;
            padding: 4px;
            text-transform: uppercase;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: small;
            text-align: left;
            float:left;
        }

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
            <a href="/"><h3 class="masthead-brand">LOGO</h3></a>
            <nav class="nav nav-masthead justify-content-center">
                @auth()
                <a href="/profile" class="nav-link">Welcome, <i class="fa fa-user"></i> {{auth()->user()->name}}</a>
                @if(auth()->user()->admin_authority == 1)
                <a class="nav-link active" href="/admin">Admin Panel</a>
                @endif
                <a class="nav-link active" href="/dashboard">Dashboard</a>
                <a class="nav-link active" href="/logout">Logout</a>
                @else
                <a class="nav-link active" href="/login">Login</a>
                <a class="nav-link active" href="/register">Register</a>
                @endauth

            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
    @yield('content')
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p><a href="https://github.com/BerkanYesilyurt/url-shortener">BerkanYesilyurt/url-shortener</a></p>
        </div>
    </footer>
</div>

@if(session('message'))
    <script>alert('{{session('message')}}')</script>
@endif
</body>
</html>
