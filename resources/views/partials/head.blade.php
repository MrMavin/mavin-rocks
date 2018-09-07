<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') :: {{ config('app.name') }}</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ mix('apple-touch-icon.png') }}">
<link rel="icon" type="image/x-icon" href="{{ mix('favicon.ico') }}" sizes="48x48">
<link rel="icon" type="image/png" sizes="32x32" href="{{ mix('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ mix('favicon-16x16.png') }}">

<link rel="canonical" href="{{ url()->current() }}">

@if (isset($description))
    @php($description = str_limit(strip_tags($description), 255))
    <meta name="description" content="{{ $description }}">
    <meta property="og:description" content="{{ $description }}">
@endif

@if (isset($image))
    <meta property="og:image" content="{{ $image }}">
@endif

@if (config('app.env') != 'production')
    <meta name="robots" content="noindex, nofollow">
@endif

<meta property="og:title" content="@yield('title')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="en_GB">

<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="{{ config('me.social.twitter') }}">

@stack('meta')
@stack('stylesheets')