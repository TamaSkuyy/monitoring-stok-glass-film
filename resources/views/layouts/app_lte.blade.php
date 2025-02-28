<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DSM | Glass Film</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/lte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/home" class="brand-link">
                <img src="/lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Glass Film</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
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
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('barang*', 'vendor*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is('barang*', 'vendor*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Master
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/barang" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/vendor" class="nav-link {{ request()->is('vendor*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Vendor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->is('order*', 'hitting*', 'transaksi*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is('order*', 'hitting*', 'transaksi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/order" class="nav-link {{ request()->is('order*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order Film</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/hitting"
                                        class="nav-link {{ request()->is('hitting*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transaksi"
                                        class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ request()->is('laporan*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-0">
                        <div class="col-sm-6">
                            <h1>{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Barang</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->

                            </div>
                            <!-- /.card -->

                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    @include('flash::message')
                                    <script>
                                        setTimeout(function() {
                                            $('.alert').fadeOut('slow');
                                        }, 5000);
                                    </script>
                                    @yield('content')
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/lte/plugins/jszip/jszip.min.js"></script>
    <script src="/lte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/lte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/lte/dist/js/adminlte.min.js"></script>
    <!-- Select2 -->
    <script src="/lte/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="/lte/dist/js/demo.js"></script> --}}
    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

</body>

</html>
