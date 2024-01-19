<!--header section start-->
<!--header start-->
<header class="main-header position-absolute w-100">
    <nav class="navbar navbar-expand-xl navbar-dark sticky-header">
        <div class="container d-flex align-items-center justify-content-lg-between position-relative">
            <a href="index.html" class="navbar-brand d-flex align-items-center mb-md-0 text-decoration-none">
                <img src="imgs/app/logo-white.png" alt="logo" class="img-fluid logo-white" />
                <img src="imgs/app/logo.png" alt="logo" class="img-fluid logo-color" />
            </a>

            <a class="navbar-toggler position-absolute right-0 border-0" href="#offcanvasWithBackdrop" role="button">
                <span class="far fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"></span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                    <li><a href="{{ route('index') }}" class="nav-link">Home</a></li>
{{--                    <li><a href="#" class="nav-link">Pricing</a></li>--}}
{{--                    <li><a href="#" target="_blank" class="nav-link">FAQ</a></li>--}}
                    <li><a href="https://discord.rustanalytics.com/" target="_blank" class="nav-link">Discord</a></li>
                </ul>
            </div>

            <div class="action-btns text-end me-5 me-lg-0 d-none d-md-block d-lg-block">
                @guest
                    <a href="{{ route('login.discord') }}" class="btn btn-link text-decoration-none me-2">Sign In</a>
                @endguest
                @auth
                    <a href="{{ route('user.dashboard') }}" class="btn btn-link text-decoration-none me-2">Dashboard</a>
                @endauth

{{--                <a href="request-demo.html" class="btn btn-primary">Documentation</a>--}}
            </div>


        </div>
    </nav>
</header>
<!--header end-->
<!--header section end-->
