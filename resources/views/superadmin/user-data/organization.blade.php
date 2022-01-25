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
    @include('partials.superadmin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-users"></i>
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
            <a href="{{ url('/organization/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Organization
              </button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Profile</th>
                        <th>
                            Action
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach ($users as $user)                  
                      <tr>
                        <td>
                          {{ $i++ }}
                        </td>
                        <td>
                          {{ $user['name'] }}
                        </td>
                        <td>
                          {{ $user['email'] }}
                        </td>
                        <td>
                          {{ $user['phone'] }}
                        </td>
                        <td>
                          @php
                              $companyData = collect($user->company);
                              $getCompany = $companyData->get('company_name');
                          @endphp
                          @if ($getCompany)
                            {{ $getCompany }}
                          @else
                          <div class="text-muted">
                            _
                          </div>
                          @endif
                        </td>
                        <td>
                          @php
                              $status = $user->RegistrationStatus->pluck('status')->first();
                          @endphp
                          @if ($status == 0)                              
                          <div class="text-danger">
                            Inactive
                          </div>
                          @endif
                          @if ($status == 1)                              
                          <div class="text-success">
                            Active
                          </div>
                          @endif
                          @if ($status == 2)                              
                          <div class="text-danger">
                            Rejected
                          </div>
                          @endif
                        </td>
                        <td>
                            <form action="/superadmin/organization/{{ $user['id'] }}" method="get">
                              <button type="submit" class="btn btn-outline-primary btn-sm rounded-lg py-0">
                                <i class="far fa-eye"></i>
                              </button>
                            </form>
                        </td>
                        <td>
                          <div class="d-flex">
                            @if ($status == 1)                                
                            <form action="/superadmin/organization/id" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-outline-warning btn-sm rounded-lg py-0 px-1 mx-1">
                                <i class="fas fa-exclamation-triangle"></i>
                              </button>
                            </form>
                            @endif
                            @if ($status == 0)
                            <div class="d-flex">    
                              <form action="/superadmin/organization/{{ $user['id'] }}" class="mx-1" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="status" class="d-none" id="status" value="1">
                                <button type="submit" class="btn btn-outline-success btn-block btn-sm rounded-lg py-0 mx-1">
                                  <i class="fas fa-check"></i>
                                </button>
                              </form>
                              <form action="/superadmin/organization/{{ $user['id'] }}" class="mx-1" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="status" class="d-none" id="status" value="2">
                                <button type="submit" class="btn btn-outline-danger btn-block btn-sm rounded-lg py-0 mx-1">
                                  <i class="fa fa-times"></i>
                                </button>
                              </form>
                            </div>  
                            @endif
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