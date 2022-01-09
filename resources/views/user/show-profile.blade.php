@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if (Storage::disk('public')->exists($getProfileData->photo))
                        <img src="{{ Storage::disk('public')->url($getProfileData->photo) }}" class="profile-user-img img-fluid img-circle" alt="Profile Picture">
                    @else
                        <img src="/img/default.png" class="profile-user-img img-fluid img-circle" alt="Profile Picture">
                    @endif
                </div>

                <h3 class="profile-username text-center">
                    {{ $getProfileData->company->company_name }}
                    <i class="bi bi-patch-check-fill text-primary"></i>
                </h3>

                <p class="text-muted text-center">Bergabung sejak {{ date_format($getProfileData->company->user->created_at,"d M Y") }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Program</b> <a class="float-right text-primary font-weight-bold">{{ $data['countCampaign'] ? $data['countCampaign'] : '0'}}</a>
                </li>
                <li class="list-group-item">
                    <b>Donatur</b> <a class="float-right text-primary font-weight-bold">{{ $data['countDonation'] ? $data['countDonation'] : '0'}}</a>
                </li>
                <li class="list-group-item">
                    <b>Dana dikelola</b> <a class="float-right text-primary font-weight-bold">Rp {{ currency_format($data['amountDonation'] ? $data['amountDonation'] : '0') }}</a>
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
                <h3 class="card-title">Program Kebaikan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  @foreach ($getCampaign as $campaign)
                      @if ($campaign['user_id'] == $data['user_id'])
                      <div class="d-flex flex-row">                          
                          <div class="mr-2">
                            <i class="{{ $campaign['category']['icon'] }}"></i>
                          </div>
                          <div class="ml-1">
                              <a href="/campaigns/{{ $campaign['slug'] }}">
                                  <strong>{{ $campaign['title'] }}</strong>
                              </a>
                              <p class="text-muted">
                                {{ Str::limit($campaign['caption'], 120, '...') }}
                              </p>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center" style="margin-bottom: -0.8rem">
                            <a href="/category/{{ $campaign['category']['id'] }}" class="badge badge-primary py-2 px-3 rounded-pill">
                              {{ $campaign['category']['title'] }}
                            </a>
                            <small class="mr-3"> 
                                {{ date_format($campaign['created_at'],"d M Y") }}
                            </small>
                        </div>
                      <hr>
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
      