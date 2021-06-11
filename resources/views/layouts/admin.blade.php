<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container{
            /* margin-top: 5px; */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="26.373" height="30" viewBox="0 0 26.373 30">
                    <g id="Bouclier" transform="translate(0 0)">
                        <path id="Tracé_15" data-name="Tracé 15"
                            d="M-1024.856,338.144a.568.568,0,0,0-.479-.626c-.9-.242-1.783-.529-2.683-.768a37.841,37.841,0,0,0-8.784-1.462c-.286,0-.47-.031-.591-.026h0s-.791-.023-1.508.022c0,0-.907,0-1.3.028a50.3,50.3,0,0,0-10.584,2.218.513.513,0,0,0-.425.56,72.635,72.635,0,0,0,.457,10.675c.718,4.931,2.625,9.21,6.527,12.472a31.159,31.159,0,0,0,4.868,3.272l.019.011,1.239.737,1.246-.688.012-.006a27.076,27.076,0,0,0,5.972-4.226,18.611,18.611,0,0,0,5.374-10.646A63.3,63.3,0,0,0-1024.856,338.144Zm-3.887,7.079-.094,1.58c-.1.925-.192,1.849-.358,2.765a14.442,14.442,0,0,1-2.481,6.175,16.537,16.537,0,0,1-5.419,4.534v-.006l-.994.505-.535-.274a2.627,2.627,0,0,1-.349-.179c-.1-.072-.205-.136-.313-.2a17.058,17.058,0,0,1-4.794-3.94c-2.252-2.8-2.928-6.127-3.18-9.594l-.073-1.277c0-.136-.038-.268-.04-.4-.007-1.163,0-2.323-.017-3.487,0-.3.146-.4.4-.476a32.906,32.906,0,0,1,8.245-1.486h.03l1.358,0c.316,0,.635.038.95.058a33.526,33.526,0,0,1,7.327,1.44.5.5,0,0,1,.4.553C-1028.661,342.755-1028.722,343.988-1028.743,345.222Z"
                            transform="translate(1051.217 -335.254)" fill="#bc0c37" />
                        <path id="Tracé_16" data-name="Tracé 16"
                            d="M-1029.315,340.816a.5.5,0,0,0-.4-.553,33.526,33.526,0,0,0-7.327-1.44c-.316-.019-.635-.058-.95-.058l-1.359,0h-.03a32.91,32.91,0,0,0-8.245,1.486c-.251.072-.4.178-.4.476.017,1.164.01,2.324.017,3.487,0,.134.037.266.04.4l.073,1.277c.252,3.467.928,6.793,3.18,9.594a17.059,17.059,0,0,0,4.794,3.94c.108.061.209.125.313.2a2.642,2.642,0,0,0,.349.179l.535.274.994-.505v.006a16.532,16.532,0,0,0,5.419-4.534,14.443,14.443,0,0,0,2.482-6.175c.166-.916.259-1.84.357-2.765l.094-1.58C-1029.359,343.286-1029.3,342.054-1029.315,340.816Zm-3.936,9.348h-3.333V353.5a2.084,2.084,0,0,1-2.083,2.083,2.083,2.083,0,0,1-2.083-2.083v-3.334h-3.333a2.061,2.061,0,0,1-1.167-.36h0c-.018-.011-.034-.023-.052-.035a.55.55,0,0,0-.049-.037c-.019-.014-.039-.03-.056-.046s-.052-.043-.076-.066-.047-.042-.07-.065l-.01-.011c-.043-.046-.086-.091-.126-.14-.02-.024-.037-.047-.056-.071l-.006-.007c-.02-.029-.041-.055-.057-.083s-.029-.043-.043-.064l-.012-.022c-.018-.028-.035-.056-.05-.086h0c-.017-.029-.03-.056-.044-.086l0,0-.037-.079c-.016-.041-.031-.08-.045-.119s-.019-.056-.028-.084-.018-.059-.025-.086-.016-.06-.021-.089-.006-.035-.01-.052a.291.291,0,0,1-.011-.064.249.249,0,0,1-.007-.04c0-.026-.007-.052-.008-.078s-.006-.053-.007-.078v-.028a1,1,0,0,1,0-.106,2.083,2.083,0,0,1,2.083-2.083h3.333v-3.335a2.083,2.083,0,0,1,2.083-2.083c.068,0,.139,0,.206.01s.128.017.191.028l.042.01c.029.006.055.012.082.019l.09.024a2.072,2.072,0,0,1,.263.1.21.21,0,0,1,.047.023,1.6,1.6,0,0,1,.16.086.9.9,0,0,1,.083.053.646.646,0,0,1,.056.041l.05.036.043.034c.03.025.06.05.088.077s.046.042.068.065l.011.011c.022.02.043.044.063.065s.035.041.053.06c.042.052.084.106.121.161a2.071,2.071,0,0,1,.367,1.18V346h3.333a2.083,2.083,0,0,1,2.083,2.083A2.084,2.084,0,0,1-1033.251,350.164Z"
                            transform="translate(1051.855 -334.552)" fill="#be1e3c" />
                    </g>
                </svg>
                <span class="brand-text font-weight-light text-center" style="color:rgb(190,30,60);">Mobikisi</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/img/doctor.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/Medecin" class="nav-link">
                                <i class="fas fa-user-nurse"></i>
                                <p>
                                    Medecins
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class=" content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- AdminLTE App -->
    {{-- <script src="dist/js/adminlte.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
