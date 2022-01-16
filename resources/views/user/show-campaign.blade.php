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
          <p class="text-sm text-muted text-capitalize" style="color:rgb(175, 175, 175) !important; margin: -3rem 0rem 0rem 9rem">#HidupBerkahBerlimpah</p>          
        @endif
      </div>
      <div class="d-flex">
        <div class="img rounded-circle">
        @if (Storage::disk('public')->exists($data['photo']))
          <img src="{{ Storage::disk('public')->url($data['photo']) }}" width="40px" class="rounded-circle" alt="Profile Picture">
        @else
          <img src="/img/default.png" width="40px" class="rounded-circle" alt="Profile Picture" srcset="">
        @endif

        </div>
        <div class="ml-3" style="margin-bottom: -1rem">
          <a href="/profile/{{ $data['campaign']->user->id }}" class="text-decoration-none">
            <div class="d-flex align-items-center" style="margin-bottom: -1rem;">
              <p class="text-sm">
                {{ $data['campaign']->user->company->company_name }}
                <i class="bi bi-patch-check-fill text-primary"></i>
              </p>  
            </div>
          </a>
          <p class="text-muted text-xs border-top">Akun terverifikasi</p>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card-body d-flex flex-column p-2 border-bottom" style="height: 170px">
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
          @php                  
            $endDate=strtotime($data['campaign']->end_date);
            $countdown=ceil(($endDate-time())/60/60/24);
          @endphp 
          <div class="d-flex flex-column">
            <h3 class="mb-0">
              <strong>
              {{ $countdown > -0.0 ? $countdown : '' }}
                </strong>
            </h3>
            <p class="my-0 py-0">{{ $countdown > -0.0 ? 'Hari Lagi' : 'Sudah berakhir' }}</p>
          </div>
        </div>
      </div>
      <div class="card-footer bg-light p-2">
        @if ($countdown > -0.0)            
        <form action="/donation/{{ $data['campaign']->id }}" method="get">        
          <button type="submit" class="btn btn-primary btn-block rounded">
            <i class="fas fa-hand-point-right mr-2"></i>
            Donasi Sekarang
          </button>
        </form>
        @else
        <button type="button" class="btn btn-secondary disabled text-white btn-block rounded">
          Program telah berakhir
        </button>
        @endif
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="card">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 20px !important; font-weight:600;color:black;">Deskripsi</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              {!! $data['campaign']->description !!}
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 20px !important; font-weight:600;color:black;">Info Terbaru</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <div class="timeline">
                    <!-- timeline time label -->
                    @if ($data['getNews'])                        
                    @foreach ($data['getNews'] as $newsReport) 
                    <div class="time-label">
                      <span class="bg-red">{{ date_format($newsReport['created_at'],"d M Y") }}</span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-envelope bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ date_format($newsReport['created_at'],"H:i") }}</span>
                        <h3 class="timeline-header">{{ $newsReport['title'] }}</h3>
      
                        <div class="timeline-body">
                          {!! $newsReport['description'] !!}
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    @endforeach
                    @endif
                  </div>
                </div>
                <!-- /.col -->
              </div>


            </div>
            <!-- /.card-body -->
          </div>
          <div class="card">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 20px !important; font-weight:600;color:black;">Donatur</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              @foreach ($data['getDonation'] as $getDonation)
              @if ($getDonation['status']==1)
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
                            @if ($getDonation['anonym'] == 'on')
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
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="border-top pt-3">
    @if ($data['campaign']->category)
      <a href="/category/{{ $data['campaign']->category->id }}" class="badge badge-primary p-2 rounded-pill">
        {{ $data['campaign']->category->title }}
      </a>
    @endif
  </div>
</div>
@endsection

@section('footer')
  @include('partials.footer')
@endsection
      