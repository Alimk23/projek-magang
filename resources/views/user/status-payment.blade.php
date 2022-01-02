@extends('layouts.main')
@section('title','Status Transaksi')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container-fluid w-auto">
    <div class="row justify-content-center mb-2 pt-4">
      <div class="col-lg-4">
        <div class="row mb-3">
          <div class="col">
            <p class="text-small">Terima kasih telah melakukan donasi, kami akan segera memverifikasi pembayaran anda sebesar:</p>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  Rp
                </span>
              </div>
              <input readonly type="text" class="form-control" id="nominal" value="{{ $data['donations']->nominal }}">
            </div>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Nomor Invoice:
          </div>
          <div class="col">
            <p class="text-small text-right">
              {{ $data['donations']->order_id }}
            </p>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Status
          </div>
          <div class="col">
            <p class="text-small text-right">
              {{ ($data['donations']->status) == 0 ? 'Menunggu Pembayaran' : '' }}
              {{ ($data['donations']->status) == 1 ? 'Dalam proses verifikasi' : '' }}
              {{ ($data['donations']->status) == 2 ? 'Transaksi berhasil' : '' }}
              {{ ($data['donations']->status) == 3 ? 'Transaksi gagal' : '' }}
            </p>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Simpan link berikut ini untuk melihat status transaksi anda:
            <input type="text" class="w-100 form-control form-control-border" readonly value="{{ env('APP_URL'); }}/status/{{ $data['donations']->order_id }}">
          </div>
        </div>
        <a href="/">
          <button type="button" class="btn btn-block btn-primary">Kembali ke menu utama</button>
        </a>
      </div>
    </div>
</div>
@endsection

@section('footer')
  @include('partials.footer')
@endsection

@section('js-custom')
<!-- bs-custom-file-input -->
<script src="{{ url('assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
      $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection