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
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Campaign</th>
                      <th>Status</th>
                      <th>
                          Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=1;
                    @endphp

                      @foreach ($getDonation as $donation)
                        @if ($donation['status']==0 || $donation['status']==1) 
                          @if ($donation['campaign']['user_id']==$userAuth->id)
                            @php
                              $getUser = $user->where('id',$donation['user_id'])->first()
                            @endphp
                            @if ($getUser)                                
                              <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $getUser->name}}</td>
                                  <td>{{ $getUser->phone }}</td>
                                  <td>{{ $getUser->email }}</td>
                                  <td>{{ $donation['campaign']['title'] }}</td>
                                  <td>
                                    <div class="text-danger">
                                      {{ ($donation['status'] == 0) ? 'Not Confirm' : ''}}                                    
                                    </div>
                                    <div class="text-success">
                                      {{ ($donation['status'] == 1) ? 'Confirm' : ''}}  
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-none">
                                      <div class="d-inline-flex">
                                        <form action="/admin/contributor/{{ $donation['user_id'] }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-outline-danger btn-block rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      </div>
                                    </div>
                                    <button type="button" disabled class="btn btn-secondary btn-sm rounded-lg btn-block">No Action</button>                                
                                  </td>
                              </tr>
                            @endif
                          @endif
                        @endif
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