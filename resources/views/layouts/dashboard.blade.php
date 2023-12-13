<!DOCTYPE html>
<html lang="en">
<head>

    @include('partials.dashboard.head')

</head>
<body class="layout-boxed">

@include('partials.dashboard.preloader')

@include('partials.dashboard.navbar')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

@include('partials.dashboard.sidebar')

<!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing">

                    @yield('content')

                </div>

            </div>

        </div>
        @include('partials.dashboard.footer')
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

@include('partials.dashboard.scripts')

</body>
</html>
