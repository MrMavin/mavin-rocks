<!DOCTYPE html>
<html>
<head>
    @push('stylesheets')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" integrity="sha256-zIG416V1ynj3Wgju/scU80KAEWOsO5rRLfVyRDuOv7Q=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @endpush

    @include('partials.head')
</head>
<body>

<progress id="progress" class="progress is-small is-danger" value="0" max="100"></progress>

<header class="header">
    @include('partials.header')
</header>

<div class="display-none">
    <div class="sr sr-c sr-p sr-col">
        <div class="section card container column"></div>
    </div>
</div>

<div id="barba-wrapper">
    <div class="barba-container @yield('page')" data-namespace="@yield('page')">
        @yield('content')
    </div>
</div>

{{--
<footer class="footer">
    @include('partials.footer')
</footer>
--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/barba.js/1.0.0/barba.min.js" integrity="sha256-H0TPKZAP4+uKmBpntUUMrKgH4VXBQNDZumun6fvan4w=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.0/scrollreveal.min.js" integrity="sha256-knIjHYN1AFLrQkulibJpReiSxKhUGhIVUhx0GYsIPjM=" crossorigin="anonymous"></script>
<script src="{{ mix('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>