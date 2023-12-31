<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <!-- link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="/css/laraknife.css" rel="stylesheet">
    <link href="/css/langutor.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/laraknife.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md bg-primary ">
            <a class="navbar-brand" href="/home">Booking</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Start</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user-edit">{{ __('Settings') }}</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/public/doc/Impressum.pdf" target="_blank">{{ __('Imprint') }}</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/public/doc/Datenschutz.pdf" target="_blank">{{ __('Privacy') }}</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="/logout" method="post">
                    <button class="btn btn-outline-success my-2 my-sm-0 logout" name="btnLogout"
                        type="submit"> {{ __('Logout') }}</button>
                </form>
                </div>                
        </nav>
    </header>
        @yield('content')
</body>

</html>
