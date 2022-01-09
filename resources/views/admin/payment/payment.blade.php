@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection


@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-cart-plus"></i>
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
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
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
                      @php
                        $user = Auth::user();
                      @endphp
                        @if ($payment['donation']['campaign']['user_id'] == $user->id)                        
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
                              <form action="/donation/{{ $payment['id'] }}" class="mx-1" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-block btn-sm rounded-lg py-0 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                                  <i class="fas fa-check"></i>
                                </button>
                              </form>
                              <form action="/payment/{{ $payment['id'] }}" class="mx-1" method="POST">
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
                        @endif
                      @endforeach
                    @endif
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

@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection
