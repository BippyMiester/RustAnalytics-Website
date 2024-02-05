<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item active">
                <a href="{{ route('user.dashboard.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
{{--            <div class="menu-item">--}}
{{--                <a href="analytics.html" class="menu-link">--}}
{{--                    <span class="menu-icon"><i class="bi bi-bar-chart"></i></span>--}}
{{--                    <span class="menu-text">Analytics</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="menu-item has-sub">--}}
{{--                <a href="#" class="menu-link">--}}
{{--							<span class="menu-icon">--}}
{{--								<i class="bi bi-envelope"></i>--}}
{{--							</span>--}}
{{--                    <span class="menu-text">Email</span>--}}
{{--                    <span class="menu-caret"><b class="caret"></b></span>--}}
{{--                </a>--}}
{{--                <div class="menu-submenu">--}}
{{--                    <div class="menu-item">--}}
{{--                        <a href="email_inbox.html" class="menu-link">--}}
{{--                            <span class="menu-text">Inbox</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="menu-item">--}}
{{--                        <a href="email_compose.html" class="menu-link">--}}
{{--                            <span class="menu-text">Compose</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="menu-item">--}}
{{--                        <a href="email_detail.html" class="menu-link">--}}
{{--                            <span class="menu-text">Detail</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="menu-header">Servers</div>
            @foreach($servers as $server)
                <div class="menu-item">
                    <a href="{{ route('user.dashboard.server.show', $server->slug) }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-server"></i>
                        </span>
                        <span class="menu-text">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</span>
                    </a>
                </div>
            @endforeach


            <div class="menu-divider"></div>
            <div class="menu-header">Settings</div>
            <div class="menu-item">
                <a href="profile.html" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people"></i></span>
                    <span class="menu-text">Profile</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="settings.html" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>
        <!-- END menu -->
        <div class="p-3 px-4 mt-auto">
            <a href="../../documentation/index.html" class="btn d-block btn-outline-theme">
                <i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> Documentation
            </a>
        </div>
    </div>
    <!-- END scrollbar -->
</div>
<!-- END #sidebar -->

<!-- BEGIN mobile-sidebar-backdrop -->
<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>
<!-- END mobile-sidebar-backdrop -->
