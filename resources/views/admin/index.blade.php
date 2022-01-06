@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
    <i class="fas fa-tachometer-alt"></i>
    @endpush
    @include('partials.content-header')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Users</span>
            <span class="info-box-number">
              {{ $user->all()->count() }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-fw fa-copy"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Campaign</span>
            <span class="info-box-number">{{ $getCampaign }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Donation</span>
            <span class="info-box-number">{{ $getDonation }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Donation Amount</span>
            <span class="info-box-number">Rp {{ currency_format($totalDonation) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection