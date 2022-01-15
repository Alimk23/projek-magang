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
                    <th>No</th>
                    <th>Order Number</th>
                    <th>Campaign</th>
                    <th>Nominal</th>
                    <th>Payment Date</th>
                    <th>Receiver Info</th>
                    <th>Payment Info</th>
                    <th>Status</th>
                    <th>
                        Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  @if ($data['payment']->isEmpty()||$data['donation']->isEmpty())
                    <tr>
                      <td colspan="9" class="text-center">Tidak ada data yang dapat ditampilkan</td>
                    </tr>
                  @else
                    @foreach ($data['payment'] as $payment)
                    <tr>                          
                      <td>{{ $i++ }}</td>
                      <td>{{ $payment['order_id'] }}</td>
                      <td>{{ $payment['donation']['campaign']['title'] }}</td>
                      <td>Rp {{ currency_format($payment['nominal']) }}</td>
                      <td>{{ $payment['created_at'] }}</td>
                      <td>
                        <button type="button" class="btnReceiverInfo btn btn-block btn-outline-primary btn-xs rounded-lg py-0 my-0 px-1" data-toggle="modal" data-target="#showReceiverInfo" data-id='{{ $payment['bank_id'] }}'>
                          <i class="far fa-eye fa-2x"></i>
                        </button>
                      </td>
                      <td>
                        <button type="button" class="btnPaymentInfo btn btn-block btn-outline-primary btn-xs rounded-lg py-0 my-0 px-1" data-toggle="modal" data-target="#showPaymentInfo" data-id='{{ $payment['id'] }}'>
                          <i class="far fa-eye fa-2x"></i>
                        </button>
                      </td>
                      <td>
                          {{ ($payment['status'] == 0) ? 'Menunggu Pembayaran' : ''}}
                          {{ ($payment['status'] == 1) ? 'Menunggu Verifikasi' : ''}}
                          {{ ($payment['status'] == 2) ? 'Transaksi Berhasil' : ''}}
                          {{ ($payment['status'] == 3) ? 'Transaksi Gagal' : ''}}
                      </td>
                      <td>  
                      @if ($payment['status'] == 1)
                      <div class="d-inline-flex">
                        <form action="/superadmin/payment/{{ $payment['id'] }}" class="mx-1" method="post">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="btn btn-outline-success btn-block btn-sm rounded-lg py-0 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                        <form action="/superadmin/payment/{{ $payment['id'] }}" class="mx-1" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger btn-block btn-sm rounded-lg py-0 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </div>
                      @else
                        <button type="button" disabled class="btn btn-secondary btn-sm rounded-lg btn-block">No Action</button>                                
                      @endif
                      </td>
                    </tr>
                    @endforeach
                  @endif
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
{{-- show receiver info --}}
<div class="modal fade" id="showReceiverInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title">Receiver Info</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="showBankName">Bank Name</label>
          <input class="form-control" readonly type="text" name="showBankName" id="showBankName">
        </div>
        <div class="form-group">
          <label for="showBankAccount">Bank Account</label>
          <input class="form-control" readonly type="text" name="showBankAccount" id="showBankAccount">
        </div>
        <div class="form-group">
          <label for="showAlias">Alias</label>
          <input class="form-control" readonly type="text" name="showAlias" id="showAlias">
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
<div class="modal fade" id="showPaymentInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title">Payment Info</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="showBankNamePayment">Bank Name</label>
          <input class="form-control" readonly type="text" name="showBankNamePayment" id="showBankNamePayment">
        </div>
        <div class="form-group">
          <label for="showBankAccountPayment">Bank Account</label>
          <input class="form-control" readonly type="text" name="showBankAccountPayment" id="showBankAccountPayment">
        </div>
        <div class="form-group">
          <label for="showAliasPayment">Alias</label>
          <input class="form-control" readonly type="text" name="showAliasPayment" id="showAliasPayment">
        </div>
        <div class="form-group">
          <label for="showNotePayment">Note</label>
          <textarea class="form-control" readonly name="showNotePayment" id="showNotePayment" cols="30" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label for="showReceiptPayment">Receipt</label>
          <img id="receiptPreview" class="img-fluid mb-3 col-sm-5">
          <input class="form-control" readonly type="text" name="showReceiptPayment" id="showReceiptPayment">
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