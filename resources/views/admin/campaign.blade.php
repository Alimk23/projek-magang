@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
        <!-- DataTables -->
        <link
        rel="stylesheet"
        href="assets_ui/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
      />
      <link
        rel="stylesheet"
        href="assets_ui/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
      />
      <link
        rel="stylesheet"
        href="assets_ui/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
      />
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @include('partials.content-header')
@endsection

@section('content')
    <section class="content">
      @if (session()->has('success'))
        <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
      @endif
      @if (session()->has('error'))
        <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
      @endif
      <div class="container-fluid">
        <div class="row mb-3 mt-0">
          <div class="col-md-2">
            <a href="{{ url('campaign/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Campaign
              </button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table
                  id="example1"
                  class="table table-bordered table-striped"
                >
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Target</th>
                        <th>Collected</th>
                        <th>End Date</th>
                        <th>Fundraiser</th>
                        <th>Cover</th>
                        <th>
                            Action
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach ($data['campaign'] as $campaign)                  
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $campaign['title'] }}</td>
                        <td>{{ $campaign['category']['title'] }}</td>
                        <td>{{ $campaign['target'] }}</td>
                        <td>{{ $campaign['collected'] }}</td>
                        <td>{{ $campaign['end_date'] }}</td>
                        <td>{{ $campaign['fundraiser'] }}</td>
                        <td>
                          <img src="{{ asset('storage/'.$campaign['cover']) }}" alt="" srcset="" style="width:30px">
                        </td>
                        <td>
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-block btn-outline-primary btn-xs">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-block btn-outline-danger btn-xs">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
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
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection

@section('js-custom')
        <!-- DataTables  & Plugins -->
        <script src="assets_ui/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets_ui/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets_ui/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets_ui/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="assets_ui/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets_ui/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="assets_ui/plugins/jszip/jszip.min.js"></script>
        <script src="assets_ui/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="assets_ui/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="assets_ui/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="assets_ui/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="assets_ui/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function () {
                $("#example1")
                .DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
                $("#example2").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                });
            });
        </script>
@endsection