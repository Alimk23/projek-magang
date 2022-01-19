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
                        <th>Status</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Target</th>
                        <th>Collected</th>
                        <th>End_Date</th>
                        <th>Fundraiser</th>
                        <th>Cover</th>
                        <th>Caption</th>
                        <th>Description</th>
                        <th>Created_at</th>
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
                          @if ($campaign['status'] == 0 || $campaign['status'] == 3)
                              <div class="text-warning">Need Review</div>
                          @endif
                          @if ($campaign['status'] == 1)
                              <div class="text-success">Published</div>
                          @endif
                          @if ($campaign['status'] == 2)
                              <div class="text-danger">Rejected</div>
                          @endif
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
                          {{ $campaign['user']['company']['company_name'] }}
                        </td>
                        <td>
                            @if (Storage::disk('public')->exists($campaign['cover']))
                              <a href="{{ Storage::disk('public')->url($campaign['cover']) }}" target="_blank">Custom Cover</a>
                            @else
                              <a href="/img/logo.png" target="_blank">Default Cover</a>
                            @endif                            
                        </td>
                        <td>
                          <button type="button" class="btnCaptionInfo btn btn-block btn-outline-primary btn-xs rounded-lg py-0 my-0 px-1" data-toggle="modal" data-target="#showCaptionInfo" data-id='{{ $campaign['id'] }}'>
                            <i class="far fa-eye fa-2x"></i>
                          </button>
                        </td>
                        <td>
                          <form action="/superadmin/campaign/{{ $campaign['id'] }}" class="mx-1" method="get">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-xs rounded-lg py-0 my-0 px-1">
                              <i class="far fa-eye fa-2x"></i>
                            </button>
                          </form>
                        </td>
                        <td>
                          {{ date_format($campaign['created_at'],"d M Y | H:i") }}
                        </td>
                        <td>
                          @if ($campaign['status'] == 0 || $campaign['status'] == 3)                              
                          <div class="d-flex">    
                            <form action="/superadmin/campaign/{{ $campaign['id'] }}" class="mx-1" method="post">
                              @csrf
                              @method('PATCH')
                              <input type="text" name="status" class="d-none" id="status" value="1">
                              <button type="submit" class="btn btn-outline-success btn-block btn-sm rounded-lg py-0 mx-1">
                                <i class="fas fa-check"></i>
                              </button>
                            </form>
                            <form action="/superadmin/campaign/{{ $campaign['id'] }}" class="mx-1" method="post">
                              @csrf
                              @method('PATCH')
                              <input type="text" name="status" class="d-none" id="status" value="2">
                              <button type="submit" class="btn btn-outline-danger btn-block btn-sm rounded-lg py-0 mx-1">
                                <i class="fa fa-times"></i>
                              </button>
                            </form>
                          </div>
                          @else
                          <div class="d-flex">    
                            <form action="/superadmin/campaign/{{ $campaign['id'] }}" class="mx-1" method="post">
                              @csrf
                              @method('PATCH')
                              <input type="text" name="status" class="d-none" id="status" value="1">
                              <button type="submit" class="btn btn-outline-warning btn-block btn-sm rounded-lg py-0 mx-1">
                                <i class="fas fa-exclamation-triangle"></i>
                              </button>
                            </form>
                          </div>
                          @endif
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

@section('modal')
{{-- show caption info --}}
<div class="modal fade" id="showCaptionInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title">Caption</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea class="form-control" readonly id="showCaption" name="showCaption" rows="8"></textarea>
        </div>
      </div>
      <div class="card-footer">        
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
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