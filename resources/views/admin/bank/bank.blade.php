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
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-university"></i>
    @endpush
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
            <a href="{{ url('/admin/bank/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Bank
              </button>
            </a>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table
                    id="example1"
                    class="table table-head-fixed text-nowrap table-bordered table-striped"
                  >
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Bank Name</th>
                        <th>Account</th>
                        <th>Alias</th>
                        <th style="width: 40px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($getBank as $bank)
                      <tr>
                        <td class="align-middle">{{ $i++ }}</td>
                        <td class="align-middle">{{ $bank['bank_code'] }}</td>
                        <td class="align-middle">{{ $bank['bank_name'] }}</td>
                        <td class="align-middle">{{ $bank['bank_account'] }}</td>
                        <td class="align-middle">{{ $bank['alias'] }}</td>
                        <td class="align-middle d-inline-flex">
                          <form action="/admin/bank/{{ $bank['id'] }}/edit" method="GET">
                            <button type="submit" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1 mx-1">
                              <i class="fas fa-edit"></i>
                            </button>
                          </form>
                          <form action="/admin/bank/{{ $bank['id'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-xs rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </form>
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
        </div>

      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

@section('footer')
    @include('partials.admin-footer')
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