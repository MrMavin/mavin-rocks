<!DOCTYPE html>
<html lang="en">
<head>
    @push('stylesheets')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" integrity="sha256-zIG416V1ynj3Wgju/scU80KAEWOsO5rRLfVyRDuOv7Q=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/ui/trumbowyg.min.css" integrity="sha256-47SUgOWFTAjhNC6wVnQQZlf34IbB4U1UuCQG3D0A3ug=" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}">
    @endpush

    @include('partials.head')
</head>
<body class="@yield('page')">

<div id="root" data-api-key="<?=\Auth::user()->getApiKey()?>"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/trumbowyg.min.js" integrity="sha256-VBPq2huFnLqr2pLznEQnmgYAvJ9FnPJnd7yCzDAJi4c=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/base64/trumbowyg.base64.min.js" integrity="sha256-FqTxGZ53Sus9tKHTfFU1kSOYsYEbYyZpBONvtFRP5bA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/allowtagsfrompaste/trumbowyg.allowtagsfrompaste.min.js" integrity="sha256-Q9CdhFEJpjSPRaBFO7k17xGec7jijJhAJqGUutl0JJQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/history/trumbowyg.history.min.js" integrity="sha256-YuuxzugNh02otgoMnihUQcD4QXTtzOK5c0lmFUV26n8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/noembed/trumbowyg.noembed.min.js" integrity="sha256-qjgRtT3utsbUwg8Kc8WbPw/ytFYsDwaq1SgoYN5aslk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/pasteembed/trumbowyg.pasteembed.min.js" integrity="sha256-FOfK6nVdwHGcPxEgyjsLPabFl/NkZoInD6wGR7l3O9Q=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/preformatted/trumbowyg.preformatted.min.js" integrity="sha256-4INuueXnOHpyb0f+9/jUlenk9eUK84m7CTXQQrTrmOM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/upload/trumbowyg.upload.min.js" integrity="sha256-cfciNQJ5K+8B8vXmEbN3Q42fqtuJHPiExuAu94EJyy4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js" integrity="sha256-IkytFcY/Z/rLvRE9rYyZvybaitAWr1y2jS/+eyxXky8=" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin/Admin.js') }}"></script>
@stack('scripts')
</body>
</html>