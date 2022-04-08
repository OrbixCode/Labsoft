<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    

    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link ref="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap.min.css')}}"/>
    <link ref="stylesheet" href="{{asset('datatable/css/dataTables.bootstrap4.min.css')}}"/>
    <link ref="stylesheet" href="{{asset('toastr/toastr.min.css')}}"/> -->
    <link ref="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}"/>



<!-- Default theme -->


    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   
    <link rel="stylesheet" href="{{asset('css/custom.css')}}"/>
    <title>
        @yield('title')
    </title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
   <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

</head>

<style>
    h2.show_patient_details {
    font-size: 18px !important;
    color: #000 !important;
    font-weight: 700!important;
}
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="{{asset('website/assets/img/dashboardlogo.png')}}" style="width:100%!important"/>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <li class="nav-item {{ (request()->is('admin/reports')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('reports')}}">
                <i  class="fa fa-clipboard" aria-hidden="true"></i>
                    <span>Create New Report</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/pending')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('pending')}}">
                <i  class="fa fa-clipboard" aria-hidden="true"></i>
                    <span>Pending Report</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/issued')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('issued')}}">
                <i  class="fa fa-clipboard" aria-hidden="true"></i>
                    <span>Issued Report</span></a>
            </li>

            
            <li class="nav-item {{ (request()->is('admin/testsetup')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('testsetup')}}">
                <i class="fa fa-flask" aria-hidden="true"></i>
                    <span>Test Setup</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/testparameter')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('testparameter')}}">
                <i class="fa fa-flask" aria-hidden="true"></i>
                    <span>Test Parameter</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/doctors')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('doctors')}}">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <span>Lab Doctors</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/branches')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('branches')}}">
                <i class="fa fa-university" aria-hidden="true"></i>
                    <span>Lab Branches</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/users')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('users')}}">
                <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item {{ (request()->is('admin/dated')) ? 'active' : '' }}">
                <a  class="nav-link" href="{{route('dated')}}">
                <i  class="fa fa-clipboard" aria-hidden="true"></i>
                    <span>Report Dates</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

    

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                      

                     

                        <div class="topbar-divider d-none d-sm-block"></div>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>

                </nav>
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
                        <span>Copyright &copy; Labsoft <span id="year"></span> </span>
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('jquery/jquery-3.6.0.min.js')}}"></script>

    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    
    <script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- <script src="{{asset('toastr/toastr.min.js')}}"></script>
    <script src="{{asset('datatable/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script> -->
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    @yield('script')
</body>

</html>