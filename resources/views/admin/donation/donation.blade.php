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
    @push('icon-header')
      <i class="fas fa-hand-holding-usd"></i>
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
              <div class="card-body">
                <table
                  id="example1"
                  class="table table-bordered table-striped"
                >
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Campaign</th>
                        <th>Nominal</th>
                        <th>Anonym</th>
                        <th>Message</th>
                        <th>Validation Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php
                          $i=1;
                      @endphp 
                      @foreach ($data['donation'] as $donation)
                      @php
                          $user = Auth::user();
                          $getCampaign = $data['getCampaign']->firstwhere('id', $donation['campaign_id']);
                      @endphp
                      @if ($getCampaign->user_id == $user->id)
                        @if ($donation['status']==1)                          
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                              @php 
                                  $getCampaign = $data['getUser']->firstwhere('id', $donation['user_id']);
                                  echo $getCampaign['name'];
                              @endphp 
                            </td>
                            <td>
                              @php                                
                                  $getCampaign = $data['getUser']->firstwhere('id', $donation['user_id']);
                                  echo $getCampaign['phone'];
                              @endphp 
                            </td>
                            <td>
                              @php                                
                                  $getCampaign = $data['getCampaign']->firstwhere('id', $donation['campaign_id']);
                                  echo $getCampaign['title'];
                              @endphp 
                            </td>
                            <td>Rp {{ currency_format($donation['nominal']) }}</td>
                            <td>{{ $donation['anonym'] }}</td>
                            <td>{{ $donation['message'] }}</td>
                            <td>{{ $donation['updated_at']}}</td>
                            <td>
                              <div class="d-inline-flex">
                                <form action="/admin/donation/{{ $donation['id'] }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-outline-danger btn-block rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                                    <i class="fas fa-trash-alt"></i>
                                  </button>
                                </form>
                              </div>
                            </td>
                          </tr>
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