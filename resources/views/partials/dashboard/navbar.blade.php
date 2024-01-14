<div class="row">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/imgs/dashboard/placeholders/thumb-1@2x.png" alt="" class="img-circle" width="44" />
                    John Henderson
                </a>

                <ul class="dropdown-menu">

                    <!-- Reverse Caret -->
                    <li class="caret"></li>

                    <!-- Profile sub-links -->
                    <li>
                        <a href="extra-timeline.html">
                            <i class="entypo-user"></i>
                            Edit Profile
                        </a>
                    </li>

                    <li>
                        <a href="mailbox.html">
                            <i class="entypo-mail"></i>
                            Inbox
                        </a>
                    </li>

                    <li>
                        <a href="extra-calendar.html">
                            <i class="entypo-calendar"></i>
                            Calendar
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="entypo-clipboard"></i>
                            Tasks
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

        <ul class="user-info pull-left pull-right-xs pull-none-xsm">

            <!-- Raw Notifications -->
            <li class="notifications dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-attention"></i>
                    <span class="badge badge-info">6</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="top">
                        <p class="small">
                            <a href="#" class="pull-right">Mark all Read</a>
                            You have <strong>3</strong> new notifications.
                        </p>
                    </li>

                    <li>
                        <ul class="dropdown-menu-list scroller">
                            <li class="unread notification-success">
                                <a href="#">
                                    <i class="entypo-user-add pull-right"></i>

                                    <span class="line">
												<strong>New user registered</strong>
											</span>

                                    <span class="line small">
												30 seconds ago
											</span>
                                </a>
                            </li>

                            <li class="unread notification-secondary">
                                <a href="#">
                                    <i class="entypo-heart pull-right"></i>

                                    <span class="line">
												<strong>Someone special liked this</strong>
											</span>

                                    <span class="line small">
												2 minutes ago
											</span>
                                </a>
                            </li>

                            <li class="notification-primary">
                                <a href="#">
                                    <i class="entypo-user pull-right"></i>

                                    <span class="line">
												<strong>Privacy settings have been changed</strong>
											</span>

                                    <span class="line small">
												3 hours ago
											</span>
                                </a>
                            </li>

                            <li class="notification-danger">
                                <a href="#">
                                    <i class="entypo-cancel-circled pull-right"></i>

                                    <span class="line">
												John cancelled the event
											</span>

                                    <span class="line small">
												9 hours ago
											</span>
                                </a>
                            </li>

                            <li class="notification-info">
                                <a href="#">
                                    <i class="entypo-info pull-right"></i>

                                    <span class="line">
												The server is status is stable
											</span>

                                    <span class="line small">
												yesterday at 10:30am
											</span>
                                </a>
                            </li>

                            <li class="notification-warning">
                                <a href="#">
                                    <i class="entypo-rss pull-right"></i>

                                    <span class="line">
												New comments waiting approval
											</span>

                                    <span class="line small">
												last week
											</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="external">
                        <a href="#">View all notifications</a>
                    </li>
                </ul>

            </li>

        </ul>

    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">

            <li>
                <a href="{{ route('logout') }}">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div>

</div>
