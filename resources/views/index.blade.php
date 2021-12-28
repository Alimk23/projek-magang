@extends('layouts.main')
@section('title','Hobi Sedekah')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
  <div class="container">
    <div class="row flex justify-content-center">
      <!-- /.col-md-6 -->
      <div class="col-lg-8">
        <div class="row">
          @foreach ($data['campaign'] as $campaign)  
          <div class="col-lg-6 mt-2">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">{{ $campaign['category']['title'] }}</h5>
              </div>
              <div class="card-body">            
                  <a href="/campaigns/{{ $campaign['slug'] }}" class="text-decoration-none text-dark">
                  <form action="#" method="post">
                    <div class="row text-center">
                      <div class="col">
                        <div class="card-body">
                          <img src="{{ asset('/storage/'. $campaign['cover']) }}" alt="" style="max-width:100%; overflow: hidden">
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col">
                              <h3>{{ $campaign['title'] }}</h3>
                              <p>{{ $campaign['fundraiser'] }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <p>{{ $campaign['collected'] }}</p>
                              <p>Donasi terkumpul</p>
                              {{-- <button type="submit" class="btn btn-success btn-sm w-100" value="{{ $campaign['id'] }}">Pilih</button> --}}
                            </div>
                            <div class="col">
                              <?php 
                                $endDate=strtotime($campaign['end_date']);
                                $countdown=ceil(($endDate-time())/60/60/24);
                              ?>
                              <p>{{ $countdown }}</p>
                              <p>Hari lagi</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </a> 
                </div>
              </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
  </div>
  <!-- /.row -->
@endsection

@section('footer')
    @include('partials.footer')
@endsection