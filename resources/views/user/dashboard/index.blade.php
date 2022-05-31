@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content-header')
    @push('icon-header')
    <i class="fas fa-tachometer-alt"></i>
    @endpush
    <div class="container">
      @include('partials.content-header')
    </div>
@endsection

@section('content')
<div class="container">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-4">
        <a href="/user/fundraising" class="text-dark text-decoration-none">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Fundraising</span>
              <span class="info-box-number">
                {{ $countFundraising }} Link
                {{-- {{ $countUser ? $countUser : '0' }} --}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
      
      <div class="col-12 col-sm-6 col-md-4">
        <a href="/user/donation" class="text-dark text-decoration-none">
        <!-- /.col -->
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-fw fa-copy"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Berdonasi Sebanyak</span>
              <span class="info-box-number">
                {{ $countDonation }} Kali
              </span>
              {{-- <span class="info-box-number">{{ $getDonation ? $getDonation : '0' }}</span> --}}
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-4">
        <a href="/user/donation" class="text-dark text-decoration-none">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Donasi</span>
              <span class="info-box-number">
                Rp {{ currency_format($amountDonation) }}
              </span>
              {{-- <span class="info-box-number">{{ $getDonation ? currency_format($getDonation) : 'Rp 0'  }}</span> --}}
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
    </div>
    <!-- /.row -->
@endsection

@section('footer')
<div class="fixed fixed-bottom">
      @include('partials.admin-footer')
</div>
@endsection