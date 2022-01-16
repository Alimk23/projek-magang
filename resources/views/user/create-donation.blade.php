@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container pt-2 mb-2">
  <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-4">
            <div class="card mt-0 mt-lg-4" style="width: 180px;height: 120px; overflow:hidden;">
              @if (Storage::disk('public')->exists($data['details']->cover))
                <img src="{{ Storage::disk('public')->url($data['details']->cover) }}" alt="" class="img-fluid">
              @else
                <img src="/img/logo.png" alt="" class="img-fluid">
                <p class="text-xs text-muted text-capitalize" style="color:rgb(175, 175, 175) !important; margin: -2rem 0rem 0rem 2rem">#HidupBerkahBerlimpah</p>          
              @endif
            </div>
          </div>
          <div class="col-lg-8 align-self-center">
            <p>Silahkan lengkapi formulir di bawah ini untuk berdonasi ke:</p>
            <h5 class=" font-weight-bold">{{ $data['details']->title }}</h5>
          </div>
        </div>
      </div>
  </div>
  <form action="/donation" method="post">
    @csrf
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="row mb-3">
          <div class="col">
            <input type="text" class="d-none" name="campaign_id" id="campaign_id" value="{{ $data['details']->id }}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" placeholder="Masukkan Nominal"  class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}">
            </div>
            @error('nominal')
              <div class="text-small text-danger" role="alert">
                <small>{{ $message }}</small>
              </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <select class="form-control select2 @error('bank') is-invalid @enderror" name="bank" data-placeholder="Pilih metode pembayaran" data-dropdown-css-class="select2-primary" style="width: 100%;">
              <option selected disabled>Pilih Metode Pembayaran</option>
              <option disabled>Transfer manual dibutuhkan waktu 24 jam verifikasi</option>
              @foreach ($data['banks'] as $bank)
                <option value="{{ $bank->id }}"> {{ $bank->bank_name }}</option>
              @endforeach
            </select>                                  
            @error('bank')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
            @error('name')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="anonym" id="anonym">
                <label class="custom-control-label" for="anonym" style="font-weight: normal">Sembunyikan nama saya (Hamba Allah)</label>
              </div>
            </div>
            @error('anonym')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Nomor Handphone" value="{{ old('phone') }}">
            @error('phone')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email (Optional)" value="{{ old('email') }}">
            @error('email')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" placeholder="Tuliskan pesan atau doa disini (Optional)" cols="30" rows="5">{{ old('message') }}</textarea>
            @error('email')
            <div class="text-small text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <button class="btn btn-block btn-primary" type="submit">Lanjut Pembayaran</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('footer')
  @include('partials.footer')
@endsection