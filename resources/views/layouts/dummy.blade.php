<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="Description" content="@yield('description')">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/common/toaster.js') }}"></script>
    <script src="{{ asset('assets/js/common/loading.js') }}"></script>
</head>
<body>
    <div id="app">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/dummy/articles">Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/dummy/violation-types">Violation Types</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dummy/violation-code">Violation Codes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dummy/countries">Countries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dummy/company-brands">Company Brand</a>
            </li>
        </ul>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

