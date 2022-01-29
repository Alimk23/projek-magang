@extends('layouts.main')
@section('title','Hobi Sedekah')

@section('css-custom')
<style>
  .slider::-webkit-scrollbar{
    width: 0;
  }
</style>
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" style="max-height:90vh; overflow:hidden">
          <img src="/img/c1.jpg" class="d-block img-fluid mx-auto" alt="c1">
      </div>
      <div class="carousel-item" style="max-height:90vh; overflow:hidden">
        <img src="/img/c2.jpg" class="d-block img-fluid mx-auto" alt="c2">
      </div>
      <div class="carousel-item" style="max-height:90vh; overflow:hidden">
        <img src="/img/c3.jpg" class="d-block img-fluid mx-auto" alt="c3">
      </div>
      <div class="carousel-item" style="max-height:90vh; overflow:hidden">
        <img src="/img/c4.jpg" class="d-block img-fluid mx-auto" alt="c4">
      </div>
      <div class="carousel-item" style="max-height:90vh; overflow:hidden">
        <img src="/img/c5.jpg" class="d-block img-fluid mx-auto" alt="c5">
      </div>
    </div>
  </div>

  {{-- distribution report --}}
  <div class="bg-dark">
    <div class="container text-white py-3">
      <div class="row text-center">
        <div class="col-4">
          <p class="font-weight-bold">
          @if (empty($data['donation']))
              0
          @else
            {{ count($data['donation']) }}
          @endif
          </p>
          <p class="text text-uppercase mb-0">Donatur</p>
        </div>
        <div class="col-4">
          <p class="font-weight-bold">Rp {{ currency_format($data['totalDonation']) }}</p>
          <p class="text text-uppercase mb-0">Total Ziswaf</p>
        </div>
        <div class="col-4">
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
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <h2 class="mb-4 text-uppercase font-weight-bold">Program Sedekah Prioritas</h2>
        </div>
        <div class="slider d-flex bg-light" style="overflow-x: auto;">
          @foreach ($data['campaign'] as $campaign)
          @if ($campaign['status'] == 1)
            @php                          
            $endDate=strtotime($campaign['end_date']);
            $countdown=ceil(($endDate-time())/60/60/24);
            @endphp
            <div class="col-10 col-md-4 mt-3">
              <div class="card d-flex shadow vh-75">
                <div class="card-body">
                  <a href="/campaigns/{{ $campaign['slug'] }}" class="text-dark text-decoration-none">
                    <div class="row">
                      <div class="col">
                        <div class="card mt-2 mx-auto shadow-sm" style="height: 15rem; overflow:hidden;">
                          @if (Storage::disk('public')->exists($campaign['cover']))
                            <img src="{{ Storage::disk('public')->url($campaign['cover']) }}" alt="" class="card-img-top">
                          @else
                            <img src="/img/logo.png" alt="" class="mx-auto my-auto" width="250px">
                            <p class="text-sm text-muted text-capitalize ml-4" style="color:rgb(175, 175, 175) !important;margin-top:-5rem !important;margin-bottom:3rem !important">#HidupBerkahBerlimpah</p>          
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-between text-dark">
                        <div class="d-flex flex-column">
                          <p class="mb-0">
                            <strong>
                            Rp. {{ currency_format($campaign['collected']) }}
                            </strong>
                          </p>
                          <p class="my-0 py-0">Donasi Terkumpul</p>
                        </div>
                        <div class="d-flex flex-column align">
                          @if ($countdown < 0)                          
                            <p class="my-0 py-0 text-muted">Sudah berakhir</p>                    
                          @else
                            <p class="mb-0">
                              <strong>
                                {{ $countdown }}
                              </strong>
                            </p>
                            <p class="my-0 py-0">Hari Lagi</p>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="row" style="max-height: 150px">
                      <div class="col d-flex flex-column p-2 border-top">
                        <div class="card-title font-weight-bold">
                          {{ $campaign['title'] }}
                        </div>
                        <p class="text-xs">
                          {{ $campaign['user']['company']['company_name'] }}
                          <i class="bi bi-patch-check-fill text-primary"></i>
                        </p>
                        <p class="card-text text-small">
                          {{ Str::limit($campaign['caption'], 120, '...') }}
                        </p>
                      </div>
                    </div>
                    <div class="row mt-5">
                      <div class="col">
                        @if ($countdown < 0)
                        <a href="/campaigns/{{ $campaign['slug'] }}" class="btn btn-secondary d-block rounded text-decoration-none" style="color:white !important">
                          Lihat Selengkapnya
                        </a>                                            
                        @else
                        <a href="/campaigns/{{ $campaign['slug'] }}" class="btn btn-primary d-block rounded text-decoration-none" style="color:white !important">
                          <i class="fas fa-hand-point-right mr-2"></i>
                          Donasi Sekarang
                        </a>                      
                        @endif
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
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
        <div class="slider col-sm-10 col-md-8 col-lg-6 d-flex" style="overflow-x: auto;">
          @foreach ($data['category'] as $category)
            <a href="/category/{{ $category['id'] }}" class="text-decoration-none text-white">
              <div class="col-12">
                <div class="d-flex flex-column">
                  <i class="{{ $category['icon'] }} mb-2 align-self-center"></i>
                  <p class="align-self-center">
                    {{ $category['title'] }}
                  </p>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  {{-- join as fundraiser --}}
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <h3 class="mb-4 text-uppercase font-weight-bold">Anda punya program kebaikan?</h3>
        <h5 class="mb-4 text-capitalize">
          ayo gabung bersama kami, agar orang lain dapat berkontribusi dalam kebaikan
        </h5>
        <a href="/organization/create" class="btn btn-primary rounded m-0">Gabung Sekarang</a>
      </div>
    </div>
  </div>

@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        var x = document.getElementsByClassName("navbar")[0];
        var y = document.getElementsByClassName("content-wrapper")[0];
        x.classList.add('sticky-top')
        y.classList.remove('content-wrapper')
    });
</script>
@endsection