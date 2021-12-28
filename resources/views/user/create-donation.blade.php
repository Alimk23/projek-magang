@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.detail-navbar')
@endsection

@section('content')
<div class="container-fluid w-auto">
  <div class="row justify-content-center mt-4 pt-3">
      <div class="col-lg-4">
        <div class="row">
          <div class="col-lg-4">
            <img src="{{ asset('/storage/'. $data['details']->cover) }}" width="100%" class="m-0 p-0 img-fluid">
          </div>
          <div class="col-lg-8 align-self-center">
            <p class=" font-weight-bold">{{ $data['details']->title }}</p>
          </div>
        </div>
      </div>
  </div>
  <form action="/donation" method="post">
    @csrf
    <div class="row justify-content-center mt-4 pt-3">
      <div class="col-lg-4">
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
                <input type="checkbox" class="custom-control-input" name="anonim" id="anonim">
                <label class="custom-control-label" for="anonim" style="font-weight: normal">Sembunyikan nama saya (Hamba Allah)</label>
              </div>
          </div>
            @error('name')
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
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" placeholder="Tuliskan pesan atau doa disini (Optional)" value="{{ old('message') }}" cols="30" rows="5"></textarea>
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