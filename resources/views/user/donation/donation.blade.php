@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
        <!-- DataTables -->
        <link
        rel="stylesheet"
        href="/assets_ui/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
      />
      <link
        rel="stylesheet"
        href="/assets_ui/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
      />
      <link
        rel="stylesheet"
        href="/assets_ui/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
      />
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content-header')
    @push('icon-header')
    <i class="fas fa-donate"></i>
    @endpush
    <div class="container">
      @include('partials.content-header')
    </div>
@endsection

@section('content')
<div class="container">
  <section class="content">
    @if (session()->has('success'))
      <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
    @endif
    @if (session()->has('error'))
      <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
    @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive">
                <table
                  id="example1"
                  class="table table-head-fixed text-nowrap table-bordered table-striped"
                >  
                  <thead>
                    <tr>
                      <th style="width: 30px">No</th>
                      <th>Nama Program</th>
                      <th>Nominal</th>
                      <th>Waktu</th>
                      <th style="width: 60px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($getDonation as $donation)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>
                            <a class="text-dark" href="{{ env('APP_URL') .'/campaigns/'. $donation['campaign']['slug']}}">
                              {{ $donation['campaign']['title'] }}
                            </a>
                          </td>
                          <td>Rp {{ currency_format($donation['nominal']) }}</td>
                          <td>{{ date_format($donation['updated_at'],"d M Y | H:i") }}</td>
                          <td>
                            @php
                                $getPayment = $donation->getPayment($donation['id']);
                            @endphp

                            @foreach ($getPayment as $payment)
                              <div class="text-danger">
                                {{ ($payment->status == 0) ? 'Belum dibayar' : ''}}                                    
                              </div>
                              <div class="text-warning">
                                {{ ($payment->status == 1) ? 'Sedang diproses' : ''}}                                    
                              </div>
                            @endforeach
                            <div class="text-success">
                              {{ ($donation['status'] == 1) ? 'Berhasil' : ''}}  
                            </div>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    <!-- /.container-fluid -->
  </section>
</div>
@endsection

@section('footer')
<div class="fixed fixed-bottom">
      @include('partials.admin-footer')
</div>
@endsection

@section('js-custom')
        <!-- DataTables  & Plugins -->
        <script src="/assets_ui/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets_ui/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets_ui/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/assets_ui/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/assets_ui/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/assets_ui/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/assets_ui/plugins/jszip/jszip.min.js"></script>
        <script src="/assets_ui/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="/assets_ui/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="/assets_ui/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="/assets_ui/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="/assets_ui/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="/js/script.js"></script>

        <!-- Page specific script -->
        <script>
            $(function () {
                $("#example1")
                .DataTable({
                    responsive: false,
                    lengthChange: false,
                    autoWidth: false,
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
            });
        </script>
@endsection