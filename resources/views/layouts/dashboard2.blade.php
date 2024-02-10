<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    @include('partials.dashboard2.head')

    @yield('stylesheets')
</head>
<body class="theme-warning">
<!-- BEGIN #app -->
<div id="app" class="app">

    @include('partials.dashboard2.navbar')

    @include('partials.dashboard2.sidebar')


    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
            @yield('breadcrumbs')
        </ul>

        <h1 class="page-header">
            @yield('title')
        </h1>

        @yield('content')
    </div>
    <!-- END #content -->

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!-- END btn-scroll-top -->
</div>
<!-- END #app -->

@include('partials.dashboard2.scripts')

@yield('scripts')

</body>
</html>
