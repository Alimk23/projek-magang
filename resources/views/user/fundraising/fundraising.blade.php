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
    <i class="fas fa-bullhorn"></i>
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
        <div class="row mb-3 mt-0">
          <div class="col-md-3">
            <button type="button" class="btnCreateRef btn btn-block btn-outline-success btn-sm"  data-toggle="modal" data-target="#createRef">
              <i class="fas fa-plus-circle"></i>
              Buat Link Fundraising
            </button>
            @error('campaign_id')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
      </div>
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
                      <th>No</th>
                      <th>Nama Program</th>
                      <th>Total Transaksi</th>
                      <th>Total Donasi</th>
                      <th>Share Link</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($getFundraising as $fundraising)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>
                              {{ $campaign->where('id',$fundraising['campaign_id'])->first()->title }}
                          </td>
                          <td>
                            {{ $donationByFundraiser->where('fundraising_id',$fundraising['id'])->get()->count() }}
                          </td>
                          <td>
                            Rp {{ currency_format($fundraising['total']) }}
                          </td>
                          <td>
                            @php
                                $slug = $campaign->where('id',$fundraising['campaign_id'])->first()->slug;
                                $link = env('APP_URL').'/campaigns/'.$slug .'?ref='. $fundraising['referral_code'];
                            @endphp
                            <a href="{{ $link }}" >
                            Link
                            </a>
                          </td>
                          <td>
                            <div class="d-flex">
                              <input type="text" class="d-none" name="link" id="link" value="{{ $link }}">
                              <button type="button" onclick="copyText()" class="mx-1 btn btn-outline-primary btn-sm rounded-lg btn-block">
                                <i class="fas fa-copy"></i>
                              </button>                                
                              <a href="https://api.whatsapp.com/send?text={{ $link }}" target="_blank">
                                <button type="button" class="mx-1 btn btn-outline-success btn-sm rounded-lg btn-block">
                                  <i class="fab fa-whatsapp"></i>
                                </button>                                
                              </a>
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

@section('modal')
{{-- Buat Fundraising Link --}}
<div class="modal fade" id="createRef">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Buat Fundraising Link</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/fundraising" method="post">
        @csrf
        <div class="modal-body mb-5 mt-1">
          <label for="campaign">Campaign</label>
          <select class="form-control select2Minimal @error('campaign') is-invalid @enderror" name="campaign_id" id="campaignId" data-placeholder="Choose the campaign" data-dropdown-css-class="select2-primary" style="width: 100%;">
            <option selected disabled>Pilih Campaign</option>
            @foreach ($data['campaign'] as $campaign)
            <option value="{{ $campaign['id'] }}" {{ (old('campaign_id') == $campaign['id']) ? 'selected' : '' }}>{{ $campaign['title'] }} ({{ $campaign['user']['company']['company_name'] }}) </option>
            @endforeach
          </select>                                  
            @error('campaign_id')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
        </div>
        <div class="modal-footer">        
          <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary float-right">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
        <!-- Select2 -->
        <script src="{{ url('assets_ui/plugins/select2/js/select2.full.min.js') }}"></script>

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
            $(document).ready(function() {
              $('.select2Minimal').select2({
                theme: "bootstrap4",
                width: "resolve"
              })
            });

            function copyText() {
              /* Get the text field */
              var copyText = document.getElementById("link");

              /* Select the text field */
              copyText.select();
              copyText.setSelectionRange(0, 99999); /* For mobile devices */

              /* Copy the text inside the text field */
              navigator.clipboard.writeText(copyText.value);

              /* Alert the copied text */
              alert("Link berhasil di copy ");
            }
        </script>
@endsection