<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="facebook-domain-verification" content="j7gvwt2pwgmbzw9tbfvo40u17haw59" />
    <meta property='fb:app_id' content='1092848738224575'/>   
    <meta property="og:title" content="Hobi Sedekah">
    <meta property="og:url" content="https://hobisedekah.id">
    <meta property="og:description" content="#HidupBerkahBerlimpah">
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

        <!-- Meta Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '3721745134718017');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=3721745134718017&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
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
