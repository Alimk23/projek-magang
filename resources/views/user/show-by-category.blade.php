@extends('layouts.main')
@section('title','Hobi Sedekah')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-10 bg-white pb-5 border-left border-light">
      <div class="row justify-content-center mt-3">
        <div class="col-lg-12 text-center">
          <h4 class="fa-3x mb-2 text-uppercase font-weight-bold">{{ $selectedCategory->title }}</h4>
        </div>
        @foreach ($getCampaign as $campaign)
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
    <div class="col-sm-2">
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header text-uppercase">Kategori</li>
          @foreach ($getCategory as $category) 
            <li class="nav-item">
                <a href="/category/{{ $category['id'] }}" class="nav-link {{ Request::is('category/'.$category['id']) ? 'bg-primary' : ''}}">
                <i class="nav-icon {{ $category['icon'] }}"></i>
                    <p>
                      {{ $category['title'] }}
                    </p>
                </a>
            </li>
          @endforeach
        </ul>
      </nav>
    </div>
  </div>
</div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection