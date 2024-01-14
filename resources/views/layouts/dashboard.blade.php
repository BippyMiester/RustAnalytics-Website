<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.dashboard.head')

    @yield('stylesheets')
</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    @include('partials.dashboard.sidebar')

    <div class="main-content">

        @include('partials.dashboard.navbar')

        <hr />

        @yield('content')

        @include('partials.dashboard.footer')
    </div>

</div>

@include('partials.dashboard.scripts')

@yield('scripts')

</body>
</html>
