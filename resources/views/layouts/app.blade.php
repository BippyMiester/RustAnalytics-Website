<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.app.head')
</head>

<body>

{{--@include('partials.app.preloader')--}}

<!--main content wrapper start-->
<div class="main-wrapper">

    @include('partials.app.navbar')

    @yield('content')

    @include('partials.app.footer')

</div>

@include('partials.app.scripts')
</body>

</html>
