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
      <i class="fas fa-copy"></i>
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
            <a href="{{ url('/admin/campaign/create') }}">
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
              <div class="card-body table-responsive">
                <table
                  id="example1"
                  class="table table-head-fixed text-nowrap table-bordered table-striped"
                >
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Target</th>
                        <th>Collected</th>
                        <th>End_Date</th>
                        <th>Customer Service</th>
                        <th>Cover</th>
                        <th>News_Report</th>
                        <th>Status</th>
                        <th>
                            Action
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach ($data['campaign'] as $campaign)
                      <tr>
                        <td>
                            {{ $i++ }}
                        </td>
                        <td>
                            {{ $campaign['title'] }}
                        </td>
                        <td>
                            {{ $campaign['category']['title'] }}
                        </td>
                        <td>
                            Rp.{{ currency_format($campaign['target']) }}
                        </td>
                        <td>
                            Rp.{{ currency_format($campaign['collected']) }}
                        </td>
                        <td>
                            {{ $campaign['end_date'] }}
                        </td>
                        <td>
                          @php
                              $getCS = $cs->where('id',$campaign['cs_id'])->first();
                          @endphp
                          @if ($getCS)                              
                          {{ $getCS->name }}
                          <br>
                          ({{ $getCS->phone }})
                          @else
                          <div class="text-danger">
                            Not Complete
                          </div>
                          @endif
                        </td>
                        <td>
                            @if (Storage::disk('public')->exists($campaign['cover']))
                              <a href="{{ Storage::disk('public')->url($campaign['cover']) }}" target="_blank">Custom Cover</a>
                            @else
                              <a href="/img/logo.png" target="_blank">Default Cover</a>
                            @endif                            
                        </td>
                        <td>
                          <div class="d-flex justify-content-center">
                            <form action="/admin/news" method="get">
                              <input type="text" class="d-none" name="id" id="id" value="{{ $campaign['id'] }}">
                              <button type="submit" class="btn btn-outline-primary btn-sm rounded-lg py-0">
                                Update
                              </button>
                            </form>
                          </div>
                        </td>
                        <td>
                          @if ($campaign['status'] == 0)
                              <div class="text-warning">Need Review</div>
                          @endif
                          @if ($campaign['status'] == 1)
                              <div class="text-success">Published</div>
                          @endif
                          @if ($campaign['status'] == 2)
                              <div class="text-danger">Rejected</div>
                          @endif
                          @if ($campaign['status'] == 3)
                              <div class="text-warning">Update Review</div>
                          @endif
                          @if ($campaign['status'] == 4)
                              <div class="text-danger">Not Publish</div>
                          @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                              <form action="/admin/campaign/{{ $campaign['id'] }}/edit" method="GET">
                                <button type="submit" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1 mx-1">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </form>
                              @if ($campaign['status'] == 0 || $campaign['status'] == 2)
                              <form action="/admin/campaign/{{ $campaign['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-xs rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                                  <i class="fas fa-trash-alt"></i>
                                </button>
                              </form>
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
                $("#example2").DataTable({
                paging: true,
                lengthChange: false,

                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                });

            });
        </script>
@endsection