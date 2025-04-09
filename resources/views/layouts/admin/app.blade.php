<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZH68M5HXQ3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-ZH68M5HXQ3');
    </script>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/logo/logo_header.webp') }}">
    <title>
        @isset($title)
            {{ $title }}
        @endisset
    </title>

    <!-- Custom fonts for this template-->
    {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('assets/admin_pages/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    {{-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/admin_pages/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/admin_pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    @stack('css')
    <style>
        #clear-notifications {
            transition: color 0.3s ease-in-out;
        }
        #clear-notifications:hover {
            color: red !important;
            cursor: pointer;
        }
        #link-to-history-download {
            transition: color 0.3s ease-in-out;
        }
        #link-to-history-download:hover {
            color: #4e73df !important;
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.admin.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto" id="copyright">
                        <span>Copyright &copy; Your Website </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <button class="btn btn-primary" type="submit">Logout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="vendor/jquery/jquery.min.js"></script> --}}
    {{-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/admin_pages/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin_pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/admin_pages/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admin_pages/js/sb-admin-2.min.js') }}"></script>
    
    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin_pages/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin_pages/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin_pages/js/demo/chart-pie-demo.js') }}"></script>

    <!-- datatable -->
    <script src="{{ asset('assets/admin_pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin_pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
    
    <script>
        const date = new Date();
        let year = date.getFullYear();
        document.getElementById("copyright").innerHTML = '<span>Copyright &copy; Sindy '+year+'</span>';
    </script>

    @stack('js')
    @include('layouts.admin.notify_js')
</body>

</html>