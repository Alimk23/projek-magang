@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if ($getProfile)
                        @if (Storage::disk('public')->exists($getProfile->photo))
                            <img src="{{ Storage::disk('public')->url($getProfile->photo) }}" class="profile-user-img img-fluid img-circle" alt="Profile Picture">
                        @else
                            <img src="/img/default.png" class="profile-user-img img-fluid img-circle" alt="Profile Picture">
                        @endif                        
                    @else                          
                        <img src="/img/default.png" class="profile-user-img img-fluid img-circle" alt="Profile Picture">
                    @endif
                </div>

                <h3 class="profile-username text-center">
                    {{ $user->name }}
                </h3>

                <p class="text-muted text-center">Registered on {{ date_format($user->created_at,"d M Y") }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Grade</b> <a class="float-right text-muted font-weight-bold">{{ $userGrade ? $userGrade->donation_grade : '0'}}{{$userGrade ? $userGrade->amount_grade : '' }}</a>
                </li>
                <li class="list-group-item">
                    <b>Donation Count</b> <a class="float-right text-muted font-weight-bold">{{ $data['totalDonation'] ? $data['totalDonation'] : '0'}}</a>
                </li>
                <li class="list-group-item">
                    <b>Donation Success</b> <a class="float-right text-muted font-weight-bold">{{ $data['successDonation'] ? $data['successDonation'] : '0'}}</a>
                </li>
                <li class="list-group-item">
                    <b>Donation Total</b> <a class="float-right text-muted font-weight-bold">Rp {{ currency_format($data['amountDonation'] ? $data['amountDonation'] : '0') }}</a>
                </li>
                <li class="list-group-item">
                    <b>Last Donation</b> <a class="float-right text-muted font-weight-bold">
                        {{ date_format($data['lastDonation']->created_at,"d M Y | H:i") }}
                    </a>
                </li>
                </ul>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    <!-- About Me Box -->
        <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Donated Campaign</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  @foreach ($getDonation as $donation)
                    @if ($donation['user_id'] == $data['user_id'])
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <a href="" data-card-widget="collapse" class="d-flex flex-column">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                      <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">
                                          {{ $donation['campaign']['title'] }}
                                      </h3>
                                      <div class="card-tools text-right">
                                        <button type="button" class="btn btn-tool" title="Collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                      </div>
                                    </div>
                                      <small class="mr-2 text-muted"> 
                                          {{ date_format($donation['created_at'],"d M Y | H:i") }}
                                      </small>
                                  </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Nominal</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>: Rp {{ currency_format($donation['nominal']) }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Payment Status</p>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($donation['status'] == 0)
                                            <p>: <span class="text-danger"> Not Confirm</span></p>
                                        @else
                                            <p>: <span class="text-success">Confirm</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>
                    @endif
                @endforeach
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    <!-- /.card -->
    </div>
</div>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
      