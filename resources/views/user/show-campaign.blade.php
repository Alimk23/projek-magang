@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container py-5">
  <div class="row d-flex align-items-end justify-content-center">
    <div class="col-lg-4">
      <div class="card mt-0 mt-lg-4" style="width: 350px;height: 244px; overflow:hidden;">
        @if (Storage::disk('public')->exists($data['campaign']->cover))
          <img src="{{ Storage::disk('public')->url($data['campaign']->cover) }}" alt="" class="img-fluid">
        @else
          <img src="/img/logo.png" alt="" class="img-fluid">
          <p class="text-sm text-muted text-capitalize" style="color:rgb(175, 175, 175) !important; margin: -3rem 0rem 0rem 9rem">#HidupBerkahMelimpah</p>          
        @endif
      </div>
      <div class="d-flex">
        <div class="img rounded-circle">
          <img src="/img/default.png" width="40px" alt="Profile Picture" srcset="">
        </div>
        <div class="ml-3" style="margin-bottom: -1rem">
          <a href="#" class="text-decoration-none">
            <div class="d-flex align-items-center" style="margin-bottom: -1rem;">
              <p class="text-sm">
                {{ $data['campaign']->fundraiser }}
                <i class="bi bi-patch-check-fill text-primary"></i>
              </p>  
            </div>
          </a>
          <p class="text-muted text-xs border-top">Akun terverifikasi</p>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card-body d-flex flex-column p-2 border-bottom">
        <h4 class="card-title font-weight-bold">
          {{ $data['campaign']->title }}
        </h4>
        <p class="card-text text-small">
          {{ $data['campaign']->caption }}
        </p>
      </div>
      <div class="card-body p-2">
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $data['campaign']->collected/$data['campaign']->target*100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data['campaign']->collected/$data['campaign']->target*100 }}%"></div>
        </div>
        <div class="d-flex justify-content-between text-dark">
          <div class="d-flex flex-column">
            <h3 class="mb-0">
              <strong>
                Rp. {{ currency_format($data['campaign']->collected) }}
              </strong>
            </h3>
            <p class="my-0 py-0">Terkumpul dari Rp. {{ currency_format($data['campaign']->target) }}</p>
          </div>
          <div class="d-flex flex-column">
            <h3 class="mb-0">
              <strong>
              <?php 
                $endDate=strtotime($data['campaign']->end_date);
                $countdown=ceil(($endDate-time())/60/60/24);
                echo $countdown;
                ?>
                </strong>
            </h3>
            <p class="my-0 py-0">Hari Lagi</p>
          </div>
        </div>
      </div>
      <div class="card-footer bg-light p-2">
        <form action="/donation/{{ $data['campaign']->id }}" method="get">        
          @csrf
          <button type="submit" class="btn btn-primary btn-block rounded" style="color:white !important">
            <i class="fas fa-hand-point-right mr-2"></i>
            Donasi Sekarang
          </button>
        </form>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-deskripsi-tab" data-toggle="pill" href="#custom-tabs-four-deskripsi" role="tab" aria-controls="custom-tabs-four-deskripsi" aria-selected="true">Deskripsi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-info-terbaru-tab" data-toggle="pill" href="#custom-tabs-four-info-terbaru" role="tab" aria-controls="custom-tabs-four-info-terbaru" aria-selected="false">Info Terbaru</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-donatur-tab" data-toggle="pill" href="#custom-tabs-four-donatur" role="tab" aria-controls="custom-tabs-four-donatur" aria-selected="false">Donatur</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-deskripsi" role="tabpanel" aria-labelledby="custom-tabs-four-deskripsi-tab">
                  {!! $data['campaign']->description !!}
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-info-terbaru" role="tabpanel" aria-labelledby="custom-tabs-four-info-terbaru-tab">



                </div>
                <div class="tab-pane fade" id="custom-tabs-four-donatur" role="tabpanel" aria-labelledby="custom-tabs-four-donatur-tab">
                  @foreach ($data['getDonation'] as $getDonation)
                  @if ($getDonation['status']==2)
                    <?php 
                    $getUser = $data['user']->firstwhere('id',$getDonation['user_id']);
                    ?>
                    <div class="d-flex justify-content-between">
                      <div class="d-flex">
                        <div class="img rounded-circle">
                          <img src="/img/default.png" width="40px" alt="Profile Picture" srcset="">
                        </div>
                        <div class="ml-3" style="margin-bottom: -1rem">
                          <a href="#" class="text-decoration-none">
                            <div class="d-flex align-items-center" style="margin-bottom: -1rem;">
                              <p class="text-sm">
                                @if ($getDonation['anonim'] == 'on')
                                    Hamba Allah
                                @else
                                    {{ $getUser->name }}
                                @endif
                              </p>  
                            </div>
                          </a>
                          <p class="text-muted text-xs border-top">
                            <?php 
                            $endDate=strtotime($getDonation['updated_at']);
                            $countdown=ceil((time()-$endDate)/60/60/24);
                            echo $countdown . " hari yang lalu";
                          ?>
                          </p>
                        </div>
                      </div>
                      <div class="text-primary">
                        Rp {{ currency_format($getDonation['nominal']) }}
                      </div>
                    </div>
                    @if (!empty($getDonation['message']))
                      <div class="card mt-2 ml-5">
                        <div class="card-body">
                          {{ $getDonation['message'] }}
                        </div>
                        <div class="card-footer p-1 text-right">
                          <a href="" class="btn btn-sm">
                            <i class="fas fa-heart"></i>
                            Aamiin
                          </a>
                        </div>
                      </div>
                    @endif
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>  
        </div>
      </div>
    </div>
  </div>
  <div class="border-top pt-3">
    @if ($data['campaign']->category)
      <a href="#" class="badge badge-primary p-2 rounded-pill">
        {{ $data['campaign']->category->title }}
      </a>
    @endif
  </div>
</div>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
      