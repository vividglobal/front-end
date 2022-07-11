<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="Description" content="@yield('description')">

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/jquery/jquery.lazy.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dateRangePicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dateRangePicker/dateRangePicker.js') }}"></script>
     <!-- //captCha_v2  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- ---------------------------- -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('assets/css/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/grid.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/js/btn_select/HTMLSelect.js') }}"></script>
    <script src="{{ asset('assets/js/btn_select/searchSelect.js') }}"></script>
    <script src="{{ asset('assets/js/btn_select/countrySuspected.js') }}"></script>
    <script src="{{ asset('assets/js/btn_select/selectBrandAndCompany.js') }}"></script>
    <script src="{{ asset('assets/js/btn_select/selectCountry.js') }}"></script>
    <script src="{{ asset('assets/js/btn_select/selectViolationType.js') }}"></script>
    <script src="{{ asset('assets/js/suspected/suspectedTextOrImage.js') }}"></script>
    <script src="{{ asset('assets/js/suspected/suspectedCountry.js') }}"></script>
    <script src="{{ asset('assets/js/common/toaster.js') }}"></script>
    <script src="{{ asset('assets/js/common/loading.js') }}"></script>
    <script src="{{ asset('assets/js/query/filterMobile.js') }}"></script>
    <script src="{{ asset('assets/js/modal/returnMessage.js') }}"></script>
</head>
<body>
    <div id="app">
        @include('layouts/header')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

