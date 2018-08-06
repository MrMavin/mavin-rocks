<!DOCTYPE html>
<html>
<head>
    @push('stylesheets')
        <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
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

<script src="{{ mix('js/vendor.js') }}" defer></script>
<script src="{{ mix('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>