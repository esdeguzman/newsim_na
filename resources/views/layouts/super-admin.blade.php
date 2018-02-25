<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('page-title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="/css/theme-dark-head-light.css"/>
        <link rel="stylesheet" href="/css/ring.css">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body onload="myFunction()">
        <!-- START PAGE CONTAINER -->

        <div class='uil-ring-css' style='transform:scale(0.51);' id="loader"><div></div></div>

        <div style="visibility:hidden;" id="myDiv" class="page-container page-navigation-toggled">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/">ATLANT</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="/assets/images/users/no-image.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="/assets/images/users/no-image.jpg" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{ Auth::user()->fullName() }}</div>
                                <div class="profile-data-title">{{ Auth::user()->position }}</div>
                            </div>

                        </div>
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li class="@yield('nav-dashboard')"><a href="/dashboard"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a></li>
                    <li class="xn-title">Components</li>
                    <li class="@yield('nav-applications')"><a href="{{ route('applications.index') }}"><span class="fa fa-rocket"></span> <span class="xn-text">Applications</span></a></li>
                    <li class="@yield('nav-users')"><a href="{{ route('users.index') }}"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a></li>
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- END SIGN OUT -->

                 	<li class="pull-right"><a href="#"><strong>{{ Auth::user()->fullName() }}</strong></a></li>
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                @yield('breadcrumb')
                <!-- END BREADCRUMB -->

                <!-- PAGE CONTENT WRAPPER -->
                @yield('page-content-wrapper')
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- LOG OUT MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LOG OUT MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type='text/javascript' src='/js/plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='/js/plugins/noty/layouts/topRight.js'></script>
        <script type='text/javascript' src='/js/plugins/noty/themes/default.js'></script>
        @yield('scripts')
        <script>
            $(function(){
                @if($notify = session('notify'))
                    noty({text: '{{ $notify['message'] }}', layout: 'topRight', type: '{{ $notify['type'] }}'});
                @endif
            });

            var myVar;
            function myFunction() {
                // pageLoadingFrame("show");
                myVar = setTimeout(showPage, 500);
            }

            function showPage() {
                // pageLoadingFrame("hide");
                document.getElementById("loader").style.display = "none";
                document.getElementById("myDiv").style.visibility = "visible";
            }
        </script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="/js/plugins.js"></script>
        <script type="text/javascript" src="/js/actions.js"></script>

        <script type="text/javascript" src="/js/demo_dashboard.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>