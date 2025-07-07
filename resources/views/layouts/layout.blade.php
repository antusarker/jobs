<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('custom/images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('custom/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('custom/vendor/owl-carousel/css/owl.theme.default.min.css')}}">
    <link href="{{asset('custom/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{asset('custom/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('custom/css/myStyle.css')}}" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="javascript:;" class="brand-logo">
                <img class="logo-abbr" src="{{asset('custom/images/logo.png')}}" alt="">
                <img class="logo-compact" src="{{asset('custom/images/logo-text.png')}}" alt="">
                <img class="brand-title" src="{{asset('custom/images/logo-text.png')}}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <p class="px-4 mb-1"><b>{{auth()->user()->name}} | {{auth()->user()->role->name}}</b></p>
                                    <a href="{{route('profile.edit')}}" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{ route('logout') }}" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    @if(auth()->user()->role_id == 1)
                    <li><a href="{{URL::To('dashboard')}}" aria-expanded="false"><i class="icon icon-home"></i><span
                                class="nav-text">Dashboard</span></a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Employer</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('employer.list')}}">Employer List</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Candidate</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('candidate.list')}}">Candidate List</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="mdi mdi-eventbrite"></i><span class="nav-text">Jobs</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('job.list')}}">Job List</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="mdi mdi-application"></i><span class="nav-text">Application</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('application.all')}}">Application List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->role_id == 2)
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="mdi mdi-eventbrite"></i><span class="nav-text">Jobs</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('job.create')}}">Create Job</a></li>
                            <li><a href="{{route('job.list')}}">Job List</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->role_id == 3)
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="mdi mdi-eventbrite"></i><span class="nav-text">Jobs</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('job.list')}}">Job List</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="mdi mdi-application"></i><span class="nav-text">Application</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('application.all')}}">Application List</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">HireSmart</a> 2025</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('custom/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('custom/js/quixnav-init.js')}}"></script>
    <script src="{{asset('custom/js/custom.min.js')}}"></script>


    <!-- Vectormap -->
    <script src="{{asset('custom/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('custom/vendor/morris/morris.min.js')}}"></script>


    <script src="{{asset('custom/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('custom/vendor/chart.js/Chart.bundle.min.js')}}"></script>

    <script src="{{asset('custom/vendor/gaugeJS/dist/gauge.min.js')}}"></script>

    <!--  flot-chart js -->
    <script src="{{asset('custom/vendor/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('custom/vendor/flot/jquery.flot.resize.js')}}"></script>

    <!-- Owl Carousel -->
    <script src="{{asset('custom/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

    <!-- Counter Up -->
    <script src="{{asset('custom/vendor/jqvmap/js/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('custom/vendor/jqvmap/js/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('custom/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('custom/js/dashboard/dashboard-1.js')}}"></script>

    <script src="{{asset('custom/js/myJs.js')}}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });
    </script>
</body>
</html>