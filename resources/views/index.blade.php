@extends('layouts.main')
@section('title','Hobi Sedekah')


@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
  {{-- jumbotron --}}
  {{-- <div class="jumbotron d-flex justify-content-center align-items-center mb-0">
    <div class="shadow-sm p-3 bg-light" style="border-radius: 40px">
      <div class="card rounded-pill p-4 text-center bg-opacity-50">
        <h3 class="font-weight-bold display-4 mt-3">Hobi Sedekah</h3>
        <p class="lead text-capitalize">hidup berkah melimpah</p>
        <a href="#sedekahprioritas" class="btn btn-primary rounded-pill w-50 m-auto">Yuk Donasi Sekarang</a>
      </div>
    </div>
  </div> --}}
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item my-3 active">
          <img src="/img/c1.jpg" class="d-block img-fluid mx-auto" alt="c1" style="height: 640px">
      </div>
      <div class="carousel-item my-3">
        <img src="/img/c2.jpg" class="d-block img-fluid mx-auto" alt="c2" style="height: 640px">
      </div>
      <div class="carousel-item my-3">
        <img src="/img/c3.jpg" class="d-block img-fluid mx-auto" alt="c3" style="height: 640px">
      </div>
      <div class="carousel-item my-3">
        <img src="/img/c4.jpg" class="d-block img-fluid mx-auto" alt="c4" style="height: 640px">
      </div>
      <div class="carousel-item my-3">
        <img src="/img/c5.jpg" class="d-block img-fluid mx-auto" alt="c5" style="height: 640px">
      </div>
    </div>
  </div>


  {{-- distribution report --}}
  <div class="report bg-dark">
    <div class="container text-white py-3">
      <div class="row text-center">
        <div class="col-4">
          <p class="icon"><i class="fas fa-users fa-3x"></i></p>
          <p class="font-weight-bold">
          @if ($data['donation']->isEmpty())
              0
          @else
            {{ $data['donation']->count() }}
          @endif
          </p>
          <p class="text text-uppercase mb-0">Donatur</p>
        </div>
        <div class="col-4">
          <p class="icon"><i class="fas fa-dollar-sign fa-3x"></i></p>
          <p class="font-weight-bold">Rp {{ currency_format($data['totalDonation']) }}</p>
          <p class="text text-uppercase mb-0">Total Ziswaf</p>
        </div>
        <div class="col-4">
          <p class="icon"><i class="fas fa-clipboard-check fa-3x"></i></p>
          <p class="font-weight-bold">
            {{ $data['campaign']->count() }}
          </p>
          <p class="text text-uppercase mb-0">Program</p>
        </div>
      </div>
    </div>
  </div>
  {{-- list campaign --}}
  <section id="sedekahprioritas">
    <div class="list-campaign">
      <div class="container py-5">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h2 class="fa-3x mb-4 text-uppercase font-weight-bold">Program Sedekah Prioritas</h2>
            <h3 class="mb-3 text-capitalize">
              Raih keberkahan rezeki dengan bersedekah lillahi ta'ala
            </h3>
          </div>
          @foreach ($data['campaign'] as $campaign)
          @if ($campaign['status'] == 1)
            @php                          
            $endDate=strtotime($campaign['end_date']);
            $countdown=ceil(($endDate-time())/60/60/24);
            @endphp
            <a href="/campaigns/{{ $campaign['slug'] }}" class="text-dark text-decoration-none">
              <div class="col-lg-4 col-md-6">
                <div class="card mt-4 mx-auto" style="width: 350px;height: 244px; overflow:hidden;">
                @if (Storage::disk('public')->exists($campaign['cover']))
                  <img src="{{ Storage::disk('public')->url($campaign['cover']) }}" alt="" class="card-img-top">
                @else
                  <img src="/img/logo.png" alt="" class="card-img-top">
                  <p class="text-sm text-muted text-capitalize" style="color:rgb(175, 175, 175) !important; margin: -3rem 0rem 0rem 9rem">#HidupBerkahBerlimpah</p>          
                @endif
                </div>
                <div class="card-body p-2">
                  <div class="d-flex justify-content-between text-dark">
                    <div class="d-flex flex-column">
                      <p class="mb-0">
                        <strong>
                        Rp. {{ currency_format($campaign['collected']) }}
                        </strong>
                      </p>
                      <p class="my-0 py-0">Donasi Terkumpul</p>
                    </div>
                    <div class="d-flex flex-column align">
                      @if ($countdown != -0.0)                          
                      <p class="mb-0">
                        <strong>
                          {{ $countdown }}
                        </strong>
                      </p>
                      <p class="my-0 py-0">Hari Lagi</p>
                      @else
                        <p class="my-0 py-0 text-muted">Sudah berakhir</p>                    
                      @endif
                    </div>
                  </div>
                </div>
                <div class="card-body d-flex flex-column p-2 border-top">
                  <h4 class="card-title font-weight-bold">
                    {{ $campaign['title'] }}
                  </h4>
                  <p class="text-xs">
                    {{ $campaign['user']['company']['company_name'] }}
                    <i class="bi bi-patch-check-fill text-primary"></i>
                  </p>
                  <p class="card-text text-small" style="height: 70px">
                    {{ Str::limit($campaign['caption'], 120, '...') }}
                  </p>
                </div>
                <div class="card-footer bg-light p-2">
                  @if ($countdown != -0.0)
                  <a href="/campaigns/{{ $campaign['slug'] }}" class="btn btn-primary d-block rounded text-decoration-none" style="color:white !important">
                    <i class="fas fa-hand-point-right mr-2"></i>
                    Donasi Sekarang
                  </a>                      
                  @else
                  <button class="btn btn-secondary text-white d-block rounded text-decoration-none">
                    Program telah berakhir
                  </button>                                            
                  @endif
                </div>
              </div>              
            </a>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </section>
  {{-- category --}}
  <section id="kategori" class="bg-dark">
    <div class="container text-white pt-2 pb-4">
      <div class="row justify-content-center text-center">
        <div class="col-12 text-center">
          <h3 class="mb-4 text-uppercase font-weight-bold">Kategori Program</h3>
        </div>
        @foreach ($data['category'] as $category) 
        <a href="/category/{{ $category['id'] }}" class="text-decoration-none text-white btn btn-lg btn-primary rounded-pill mr-3 p-2 d-flex justify-content-center align-items-center mb-3" style="width: 200px">          
          <div class="col-10">
            <div class="d-flex flex-column">
              <i class="{{ $category['icon'] }} mb-2"></i>
              {{ $category['title'] }}
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- join as fundraiser --}}
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <h2 class="fa-3x mb-4 text-uppercase font-weight-bold">Anda punya program sedekah?</h2>
        <h3 class="mb-4 text-capitalize">
          ayo gabung bersama kami, agar orang lain dapat berkontribusi dalam kebaikan
        </h3>
        <a href="#" class="btn btn-primary rounded m-0">Gabung Sekarang</a>
      </div>
    </div>
  </div>

@endsection

@section('footer')
    @include('partials.footer')
@endsection