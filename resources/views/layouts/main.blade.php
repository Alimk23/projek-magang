<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="facebook-domain-verification" content="bela2dp6a4gt38ma3i598jrk5eb7sp" />
    <meta property='fb:app_id' content='1092848738224575'/>   
    <meta property="og:title" content="HobiSedekah">
    <meta property="og:url" content="https://hobisedekah.com">
    <meta property="og:description" content="Hidup Berkah Melimpah">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://hobisedekah.com/img/logo.png"> 
    
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/img/icon.png">
    
    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="/assets_ui/fontawesome-free/css/all.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets_ui/adminlte/dist/css/adminlte.min.css" />

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/assets_ui/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    @yield('css-custom')

  </head>

  <body 
      @hasSection ('sidebar')
        class="hold-transition sidebar-mini sidebar-collapse layout-fixed"
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
    <script src="/assets_ui/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets_ui/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets_ui/adminlte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets_ui/adminlte/dist/js/demo.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets_ui/plugins/sweetalert2/sweetalert2.min.js"></script>
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
