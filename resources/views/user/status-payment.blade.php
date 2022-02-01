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
        @foreach ($data['getPayment'] as $getPayment)
        <div class="row mb-3">
          <div class="col">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  Rp
                </span>
              </div>
              <input readonly type="text" class="form-control" id="nominal" value="{{ currency_format($getPayment['nominal']) }}">
            </div>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Nomor Invoice:
          </div>
          <div class="col">
            <p class="text-small text-right">
              {{ $getPayment->order_id }}
            </p>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Status
          </div>
          <div class="col">
            <p class="text-small text-right">
              {{ ($getPayment->status) == 0 ? 'Menunggu Pembayaran' : '' }}
              {{ ($getPayment->status) == 1 ? 'Dalam proses verifikasi' : '' }}
              {{ ($getPayment->status) == 2 ? 'Transaksi berhasil' : '' }}
              {{ ($getPayment->status) == 3 ? 'Transaksi gagal' : '' }}
            </p>
          </div>
        </div>
        <div class="row mb-3 justify-content-between border-bottom">
          <div class="col">
            Simpan link berikut ini untuk melihat status transaksi anda:
            <div class="d-flex">              
              <input type="text" class="w-100 form-control form-control-border" readonly name="link" id="link" value="{{ env('APP_URL'); }}/status/{{ $getPayment->order_id }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <button type="button" onclick="copyText()" class="btn py-0 btn-outline-primary btn-sm rounded-lg">
                    <i class="fas fa-copy"></i>
                  </button>
                  <input id="copyAlert" class="d-none" value="Link berhasil di salin">
                </div>
            </div>
            </div>
          </div>
        </div>
        @endforeach
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
    function copyText() {
    /* Get the text field */
    var copyText = document.getElementById("link");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    // alert("Link berhasil di copy ");
    var x = document.getElementById("copyAlert").value;
    Toast.fire({
      icon: 'success',
      title: x
    })
  }
</script>
@endsection