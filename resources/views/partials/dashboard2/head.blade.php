<!-- FAVICON LINKS -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('imgs/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('imgs/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('imgs/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('imgs/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('imgs/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="shortcut icon" href="{{ asset('imgs/favicon/favicon.ico') }}">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="{{ asset('imgs/favicon/browserconfig.xml') }}">
<meta name="theme-color" content="#ffffff">
<!-- END FAVICON LINKS -->

@toastifyCss

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>Rust Analytics - @yield('title')</title>

<!-- ================== BEGIN core-css ================== -->
<link href="{{ asset('css/dashboard2/vendor.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard2/app.min.css') }}" rel="stylesheet">
<!-- ================== END core-css ================== -->

<!-- ================== BEGIN page-css ================== -->
<link href="{{ asset('src/dashboard2/jvectormap-next/jquery-jvectormap.css') }}" rel="stylesheet">
<!-- ================== END page-css ================== -->

<!-- Background Image -->
<style>
    html:after {
        background-image: url({{ asset('imgs/dashboard2/background.png') }})
    }
    [data-bs-theme=dark] {
        --bs-body-bg-gradient: linear-gradient(180deg, rgba(50, 70, 80, 0.7) 0%, rgb(13, 16, 27) 100%);
    }
</style>
