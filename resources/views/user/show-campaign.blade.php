@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.detail-navbar')
@endsection

@section('content')
  <div class="container-fluid w-auto">
    <div class="row justify-content-center">
        <div class="col-lg-4">
          <img src="{{ asset('/storage/'. $data['details']->cover) }}" width="100%" class="m-0 p-0 img-fluid">
        </div>
    </div>
    <div class="row justify-content-center">
      <!-- /.col-md-6 -->
      <div class="col-lg-4">
        <form action="/donation/create" method="get">
          <div class="row">
            <div class="col">
              <p class="text-small">{{ $data['details']->fundraiser }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p>{{ $data['details']->collected }}</p>
              <p>Donasi terkumpul</p>
              {{-- <button type="submit" class="btn btn-success btn-sm w-100" value="{{ $campaign['id'] }}">Pilih</button> --}}
            </div>
            <div class="col">
              <?php 
                $endDate=strtotime($data['details']->end_date);
                $countdown=ceil(($endDate-time())/60/60/24);
              ?>
              <p>{{ $countdown }}</p>
              <p>Hari lagi</p>
            </div>
          </div>
          <input type="text" name="campaign_id" id="campaign_id" class="d-none" value="{{ $data['details']->id }}">
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-outline-primary btn-lg rounded-lg w-100">Bantu Sekarang</button>
            </div>
          </div>
        </form>
        <!-- /.col-md-6 -->
      </div>
    </div>
  </div>
      <!-- /.row -->
@endsection
      