<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title.' - '.config('app.name') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('v1/vendor/fontawesome-free-5.14.0/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('v1/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- datatable -->
    {{-- <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
     <!-- select2 -->
     <link href="{{ asset('v1/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
     <link href="{{ asset('v1/vendor/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.


                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-primary"
                        type="button">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:
                    none;">
        @csrf
    </form>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('v1/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('v1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('v1/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- datatables -->
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('v1/js/sb-admin-2.min.js') }}"></script>

    <!-- select2 -->
    <script src="{{ asset('v1/vendor/select2/js/select2.min.js') }}"></script>

    <script>
        let base_url = "{{ route('dashboard') }}";

    </script>

    @if ($page == 'user')
    <script src="{{ asset('v1/js/page/user.js?v=1.05') }}"></script>
    @endif

    @if ($page == 'activity')
    <script src="{{ asset('v1/js/page/activity.js?v=1.00') }}"></script>
    @endif

    @if ($page == 'arsip')
    <script src="{{ asset('v1/js/page/arsip.js?v=1.00') }}"></script>
    @endif
    <!-- Page level plugins -->
    

    <!-- Page level custom scripts -->

</body>

</html>
