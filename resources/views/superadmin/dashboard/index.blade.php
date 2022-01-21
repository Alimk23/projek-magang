@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
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
        <a href="/superadmin/contributor" class="text-dark text-decoration-none">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Total Contributor</span>
              <span class="info-box-number">
                {{ $getContributor }}
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
    <div class="row mt-3 mb-5">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
          <div class="card-header h5 font-weight-bold">
            Payment Request
          </div>
          <div class="card-body">
            @if ($getPayment->isEmpty())
              <div class="d-flex justify-content-center text-muted">
                Tidak ada data yang dapat ditampilkan
              </div>
            @else
              @foreach ($getPayment as $payment)
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="" data-card-widget="collapse" class="d-flex flex-column">
                          <div class="d-flex flex-row justify-content-between align-items-center">
                            <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">
                                @php
                                    $getUser = $user->find($payment['donation']['user_id']);
                                @endphp
                                {{ $getUser->name }} 
                            </h3>
                            <div class="text-muted">{{ $payment['order_id'] }}</div>
                            <div class="card-tools text-right">
                              <button type="button" class="btn btn-tool" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                            <small class="mr-2 text-muted"> 
                                {{ date_format($payment['created_at'],"d M Y | H:i") }}
                            </small>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nominal</p>
                            </div>
                            <div class="col-md-6">
                                <p>: Rp {{ currency_format($payment['nominal']) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Payment Status</p>
                            </div>
                            <div class="col-md-6">
                                @if ($payment['status'] == 1)
                                    <p>: <span class="text-danger"> Not Confirm</span></p>
                                @else
                                    <p>: <span class="text-success">Confirm</span></p>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
              @endforeach
            @endif
          </div>
          <div class="card-footer">
            <a href="/superadmin/payment">
              <button type="button" class="btn bg-gradient-primary btn-block w-100">Detail</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
          <div class="card-header h5 font-weight-bold">
            Campaign Request
          </div>
          <div class="card-body">
            @if ($getCampaignStatus->isEmpty())
              <div class="d-flex justify-content-center text-muted">
                Tidak ada data yang dapat ditampilkan
              </div>
            @else
              @foreach ($getCampaignStatus as $campaign)
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="" data-card-widget="collapse" class="d-flex flex-column">
                          <div class="d-flex flex-row justify-content-between align-items-center">
                            <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">
                              {{ $campaign->title }}
                            </h3>
                            <div class="card-tools text-right">
                              <button type="button" class="btn btn-tool" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                            <small class="mr-2 text-muted"> 
                                {{ date_format($campaign['created_at'],"d M Y | H:i") }}
                            </small>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Fundraiser</p>
                            </div>
                            <div class="col-md-6">
                                <p>: {{ $campaign['user']['company']['company_name'] }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Campaign Status</p>
                            </div>
                            <div class="col-md-6">
                                @if ($campaign['status'] == 0)
                                    <p>: <span class="text-danger"> Not Confirm</span></p>
                                @else
                                    <p>: <span class="text-success">Confirm</span></p>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
              @endforeach
            @endif
          </div>
          <div class="card-footer">
            <a href="/superadmin/campaign">
              <button type="button" class="btn bg-gradient-primary btn-block w-100">Detail</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
          <div class="card-header h5 font-weight-bold">
            Withdraw Request
          </div>
          <div class="card-body">
            @if ($getWithdraw->isEmpty())
              <div class="d-flex justify-content-center text-muted">
                Tidak ada data yang dapat ditampilkan
              </div>
            @else
              @foreach ($getWithdraw as $withdraw)
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="" data-card-widget="collapse" class="d-flex flex-column">
                          <div class="d-flex flex-row justify-content-between align-items-center">
                            <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">
                              {{ $withdraw->campaign->title }}
                            </h3>
                            <div class="card-tools text-right">
                              <button type="button" class="btn btn-tool" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                            <small class="mr-2 text-muted"> 
                                {{ date_format($withdraw['created_at'],"d M Y | H:i") }}
                            </small>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Fundraiser</p>
                            </div>
                            <div class="col-md-6">
                                <p>: {{ $withdraw['campaign']['user']['company']['company_name'] }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Withdraw Status</p>
                            </div>
                            <div class="col-md-6">
                                @if ($withdraw['status'] == 0)
                                    <p>: <span class="text-danger"> Not Confirm</span></p>
                                @else
                                    <p>: <span class="text-success">Confirm</span></p>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
              @endforeach
            @endif
          </div>
          <div class="card-footer">
            <a href="/superadmin/withdraw">
              <button type="button" class="btn bg-gradient-primary btn-block w-100">Detail</button>
            </a>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection