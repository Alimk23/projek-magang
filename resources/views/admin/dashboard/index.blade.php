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
        <a href="/contributor" class="text-dark text-decoration-none">
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
        <a href="/campaign" class="text-dark text-decoration-none">
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
        <a href="/donation" class="text-dark text-decoration-none">
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
        <a href="/donation" class="text-dark text-decoration-none">
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

    <div class="row justify-content-center">
      <div class="col-12 col-sm-6">
        <div class="card">
          <div class="card-header h4 font-weight-bold">
            Donation Detail
          </div>
          <div class="card-body">
            <div class="d-flex flex-column">
              <div class="my-2 d-flex justify-content-between">
                <h5>Collected Amount</h5>
                <h5 class="font-weight-bold">Rp {{ currency_format($totalDonation) }}</h5>
              </div>

              @php
                $commisionFee = $totalDonation * 5/100;
              @endphp
              <div class="my-2 d-flex justify-content-between text-danger">
                <div class="d-flex flex-column">
                  <h5 class="mb-0">Commission Fee</h5>
                  <small class="mt-0">5% from Collected Donation</small>
                </div>
                <h5 class="font-weight-bold">-Rp {{ currency_format($commisionFee) }}</h5>
              </div>

              <div class="my-2 d-flex justify-content-between text-success">
                <h5>Withdrawable Cash</h5>
                <h5 class="font-weight-bold">Rp {{ currency_format($totalDonation-$commisionFee) }}</h5>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-outline-primary btn-block w-100">Withdraw</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection