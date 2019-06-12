<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', env('APP_NAME')) }}</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('img/avatar.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="{{ route('admin.home') }}#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Help and Support -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#">
                    <i class="fa fa-info-circle"></i>
                    <span class="badge badge-primary navbar-badge">0</span>
                </a>
            </li>
            <!-- Messages Notifications -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#">
                    <i class="fa fa-comments-o"></i>
                    <span class="badge badge-danger navbar-badge">0</span>
                </a>
            </li>

            {{--user profile--}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i><img src="{{ asset('img/avatar.png') }}" alt="" class="img-circle"
                            style="height: 30px;width: 30px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                        <!-- Message Start -->
                        <div class="clearfix">
                            <a href="{{ route('admin.profile') }}" class="btn btn-default btn-md pull-left bg-primary"
                               style="margin-left: 20px; margin-bottom: 20px; margin-top: 20px;"><strong>My
                                    Profile</strong></a>
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-md pull-right"
                               style="margin-right: 20px; margin-bottom: 20px; margin-top: 20px;">
                                <strong>Logout</strong></a>
                        </div>
                        <!-- Message End -->
                    </div>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link">
            <img src="{{ asset('img/avatar.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('admin.home') }}" class="d-block">{{ auth('admin')->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
						 with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="index.html#" class="nav-link">
                            <i class="nav-icon fa fa-user-secret"></i>
                            <p>
                                Account
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-user-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-lock nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-inbox nav-icon"></i>
                            <p>Inbox
                                <span class="badge badge-danger right">2</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="fa fa-lock nav-icon text-danger"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

@include('inc.dashboardFooter')

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('js/raphael-min.js') }}"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
@yield('scripts')
@include('sweet::alert')
<script>
    //Date picker
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
    CKEDITOR.replace('article-ckeditor');
</script>
</body>
</html>
