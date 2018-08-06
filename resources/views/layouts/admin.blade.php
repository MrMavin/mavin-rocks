<!DOCTYPE html>
<html>
<head>
    @push('stylesheets')
        <link rel="stylesheet" href="{{ mix('css/admin/vendor.css') }}">
        <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}">
    @endpush

    @include('partials.head')
</head>
<body class="@yield('page')">
<header class="header">
    @include('partials.admin.header')
</header>

<div class="container">
    <div class="columns">
        <div class="column is-3">
            @includeWhen(is_active('admin.blog'), 'partials.admin.blog')
        </div>
        <div class="column is-9">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ mix('js/admin/vendor.js') }}"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>
@stack('scripts')
</body>
</html>