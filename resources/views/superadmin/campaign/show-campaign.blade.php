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
      <a href="{{ URL::previous() }}" class="text-dark">
      <i class="fas fa-arrow-circle-left"></i>
      </a>
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
              <div class="card-body table-responsive" style="width: 100%">
                {!! $data['description'] !!}
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
{{-- show receiver info --}}
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
{{-- show payment info --}}
<div class="modal fade" id="showDescriptionInfo">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title">Description</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea class="form-control" readonly id="showDescription" name="showDescription" rows="16"></textarea>
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