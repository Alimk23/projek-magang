@extends('layouts.main')
@section('title','Konfirmasi Pembayaran')

@section('navbar')
    @include('partials.detail-navbar')
@endsection

@section('content')
<div class="container-fluid w-auto">
    <div class="row justify-content-center mt-4 pt-3">
      <div class="col-lg-4">
        <div class="row mb-3">
          <div class="col">
            <p class="text-small">Yuk selesaikan sedekah Anda dengan transfer ke rekening atas nama</p>
            <div class="row">
              <div class="col">
                <strong>{{ $data['banks']->alias }}</strong>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <img src="{{ asset('/storage/'. $data['banks']->bank_logo) }}" width="50px" alt="" srcset="">
                </span>
              </div>
              <input readonly type="text" class="form-control" id="nominal" value="{{ $data['banks']->bank_account }}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p class="text-small align-text-bottom">Dengan nominal sebesar:</p>
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
        <div class="row">
          <div class="col">
            <p class="text-small align-text-bottom">Upload bukti pembayaran dan tekan konfirmasi pembayaran untuk menyelesaikan transaksi</p>
          </div>
        </div>
        <form action="/payment/{{ $data['payments']->id }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row mb-3">
            <div class="col">
              <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input @error('receipt') is-invalid @enderror" name="receipt" id="receipt">
                    <label class="custom-file-label" for="receipt">Choose file</label>
                  </div>
              </div>
              @error('receipt')
              <div class="text-small text-danger" role="alert">
                <small>{{ $message }}</small>
              </div>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <button type="submit" class="btn btn-block btn-primary">Konfirmasi Pembayaran</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('js-custom')
<!-- bs-custom-file-input -->
<script src="{{ url('vendor/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
      $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection