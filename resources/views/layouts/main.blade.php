<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="{{ url('vendor/fontawesome-free/css/all.min.css')}}"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('vendor/adminlte/dist/css/adminlte.min.css')}}" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('vendor/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">


    @yield('css-custom')

  </head>

  <body 
      @hasSection ('sidebar')
        class="hold-transition sidebar-mini sidebar-collapse"
      @else
        class="hold-transition layout-top-nav"
      @endif
      >
    <div class="wrapper">
      <!-- sidebar -->
      @yield('sidebar')
      <!-- /.sidebar -->

      <!-- Navbar -->
      @yield('navbar')
      <!-- /.navbar -->

      @yield('detail-content')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       @yield('content-header')
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          @yield('content')
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      @yield('modal')

      <!-- Main Footer -->
      @yield('footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('vendor/adminlte/dist/js/demo.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('vendor/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 5000
      });
      $(document).ready(function() {
        var x = document.getElementById("successAlert").value;
        Toast.fire({
          icon: 'success',
          title: x
        })
      });
      $(document).ready(function() {
        var y = document.getElementById("errorAlert").value;
        Toast.fire({
          icon: 'error',
          title: y
        })
      });
    </script>

    @yield('js-custom')
  </body>
</html>
