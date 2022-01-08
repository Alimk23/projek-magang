@extends('layouts.main')
@section('title','Konfirmasi Pembayaran')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container-fluid w-auto">
    <div class="row justify-content-center pt-4 mb-4">
      <div class="col-lg-4">
        <div class="row mb-3">
          <div class="col">
            <p class="text-small">Yuk selesaikan sedekah Anda dengan transfer ke rekening atas nama</p>
            <div class="row">
              <div class="col">
                <strong>{{ $getBank->alias }}</strong>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                @if (Storage::disk('public')->exists($getBank->bank_logo))
                  <img src="{{ Storage::disk('public')->url($getBank->bank_logo) }}" style="width: 50px;height: 20px;">
                @else
                  <img src="/img/logo.png" style="width: 50px;height: 20px; overflow:hidden;">
                @endif
                </span>
              </div>
              <input readonly type="text" class="form-control" id="nominal" value="{{ $getBank->bank_account }}">
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
              <input readonly type="text" class="form-control" id="nominal" value="{{ currency_format($getDonation->nominal) }}">
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
              {{ ($getDonation->status) == 0 ? 'Menunggu Pembayaran' : '' }}
              {{ ($getDonation->status) == 1 ? 'Dalam proses verifikasi' : '' }}
              {{ ($getDonation->status) == 2 ? 'Transaksi berhasil' : '' }}
              {{ ($getDonation->status) == 3 ? 'Transaksi gagal' : '' }}
            </p>
          </div>
        </div>
        <div class="btnConfirm">
          <div class="row">
            <div class="col">
              <p class="text-small align-text-bottom">Jika sudah membayar, lakukan konfirmasi pembayaran dengan menekan tombol dibawah ini:</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <button type="button" class="btn btn-block btn-primary">Konfirmasi Pembayaran</button>
            </div>
          </div>
        </div>
        <div class="formConfirm d-none">
          <div class="row">
            <div class="col">
              <p class="text-small align-text-bottom">Isi formulir konfirmasi pembayaran berikut ini:</p>
            </div>
          </div>    
          <form action="/payment/{{ $getPayment->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
              <div class="col">
                <input type="text" class="form-control @error('bank_alias') is-invalid @enderror" id="bank_alias" name="bank_alias" placeholder="Atas Nama Rekening Pengirim" value="{{ old('bank_alias') }}">
                @error('bank_alias')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror
              </div>   
            </div> 
            <div class="row mb-3">
              <div class="col">
                <input type="text" class="form-control @error('bank_account') is-invalid @enderror" id="bank_account" name="bank_account" placeholder="Nomor Rekening Pengirim" value="{{ old('bank_account') }}">
                @error('bank_account')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror
              </div>   
            </div> 
            <div class="row mb-3">
              <div class="col">
                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" placeholder="Nama Bank Pengirim" value="{{ old('bank_name') }}">
                @error('bank_name')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror
              </div>   
            </div> 
            <div class="row mb-3">
              <div class="col">
                <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('receipt') is-invalid @enderror" name="receipt" id="receipt">
                      <label class="custom-file-label text-muted" for="receipt">Upload Bukti Pembayaran</label>
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
                <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" placeholder="Keterangan (Optional)" value="{{ old('note') }}">
                @error('note')
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
          </form>
        </div>
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
    const btnConfirm = document.querySelector('.btnConfirm');
    const formConfirm = document.querySelector('.formConfirm');

    $('.btnConfirm').click(function () {
    formConfirm.classList.toggle('d-none');
    btnConfirm.classList.toggle('d-none');
  });

    $(function () {
      bsCustomFileInput.init();
    });
  </script>
@endsection