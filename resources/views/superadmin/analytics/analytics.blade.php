@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
    <i class="fas fa-chart-line"></i>
    @endpush
    @include('partials.content-header')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/superadmin/contributor" class="text-dark text-decoration-none">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Contributor</span>
              <span class="info-box-number">
                {{ $countUser }}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
      
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/superadmin/campaign" class="text-dark text-decoration-none">
        <!-- /.col -->
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-fw fa-copy"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Campaign</span>
              <span class="info-box-number">{{ $getCampaign }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <a href="/superadmin/donation" class="text-dark text-decoration-none">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Donation</span>
              <span class="info-box-number">{{ $getDonation }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
        <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <a href="/superadmin/donation" class="text-dark text-decoration-none">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Donation Amount</span>
              <span class="info-box-number" class="font-weight-bold">Rp {{ currency_format($totalDonation) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
      </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection