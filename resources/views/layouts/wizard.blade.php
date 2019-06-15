<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>FormWizard_v1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', env('APP_NAME')) }}</title>

    <!--favicon-->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="{{ asset('fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="wrapper">
    @yield('wizard')
</div>

<!-- JQUERY -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="80352ca4ff03bc1728b13968-text/javascript"></script>
<script src="{{ asset('js/jquery.steps.js') }}" type="80352ca4ff03bc1728b13968-text/javascript"></script>
<script src="{{ asset('js/main.js') }}" type="80352ca4ff03bc1728b13968-text/javascript"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
        type="80352ca4ff03bc1728b13968-text/javascript"></script>
<script type="80352ca4ff03bc1728b13968-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');





</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="80352ca4ff03bc1728b13968-|49" defer=""></script>
</body>
</html>
