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
      <i class="fas fa-wallet"></i>
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
            <a href="{{ url('/admin/withdraw/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Withdraw Request
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
                        <th>Campaign</th>
                        <th>Nominal</th>
                        <th>Fee</th>
                        <th>Bank Detail</th>
                        <th>Cash Total</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>
                            Action
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach ($withdraw as $wd)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                      @php
                          $getCampaign = $campaign->find($wd['campaign_id']);
                      @endphp
                      {{ $getCampaign->title }}
                      </td>
                      <td>Rp {{ currency_format($wd['nominal']) }}</td>
                      <td>Rp {{ currency_format($wd['nominal']*5/100) }}</td>
                      <td>
                        @php
                            $getBank = $bank->find($wd['bank_id']);
                        @endphp
                        {{ $getBank->bank_name }} ({{ $getBank->bank_code }}) <br>
                        {{ $getBank->bank_account }}
                        an. {{ $getBank->alias }}
                      </td>
                      <td>
                        Rp {{ currency_format(($wd['nominal']) - $wd['nominal']*5/100) }}
                    </td>
                    <td>
                      <button type="button" class="btnWdDesc btn btn-block btn-outline-primary btn-xs rounded-lg py-0 my-0 px-1" data-toggle="modal" data-target="#showWdDescInfo" data-id='{{ $wd['id'] }}'>
                        <i class="far fa-eye fa-2x"></i>
                      </button>
                    </td>
                    <td>
                      @if ($wd['status'] == 0)
                          <div class="text-warning">Pending</div>
                      @endif
                      @if ($wd['status'] == 1)
                          <div class="text-primary">Processing</div>
                      @endif
                      @if ($wd['status'] == 2)
                          <div class="text-success">Successful</div>
                      @endif
                      @if ($wd['status'] == 3)
                          <div class="text-danger">Rejected</div>
                      @endif
                    </td>
                    <td>
                      @if ($wd['status'] == 3)
                      <form action="/admin/withdraw/{{ $wd['id'] }}" class="mx-1" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-block btn-sm rounded-lg py-0 mx-1">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                      @else
                        <button type="button" disabled class="btn btn-secondary btn-sm rounded-lg btn-block">No Action</button>                                
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
<div class="modal fade" id="showWdDescInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title">Description</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea class="form-control" readonly id="showDescriptionWd" name="showDescriptionWd" rows="8"></textarea>
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