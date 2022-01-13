@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-newspaper"></i>
    @endpush
    @include('partials.content-header')
@endsection

@section('content')
    <section class="content">
      @if (session()->has('success'))
        <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
      @endif
      @if (session()->has('error'))
        <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
      @endif
      <div class="container-fluid">
        <div class="row mb-3 mt-0">
          <div class="col-md-2">
            <form action="{{ url('/admin/news/create') }}" method="GET">
              <input type="text" class="d-none" name="id" id="id" value="{{ $campaign->id }}">
              <button type="submit" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add News Report
              </button>
            </form>
          </div>
        </div>
        <div class="row justify-content-center my-5">
          <div class="col-sm-10">
            <div class="container-fluid">
              <!-- Timelime example  -->
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <div class="timeline">
                    <!-- timeline time label -->
                    @if ($report)                        
                    @foreach ($report as $newsReport) 
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
                        <div class="timeline-footer d-flex mt-3">
                          <form action="news/{{ $newsReport['id'] }}/edit" method="GET">
                            <button type="submit" class="btn btn-primary btn-sm rounded-lg mx-1">
                              Edit
                            </button>
                          </form>
                          <form action="news/{{ $newsReport['id'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-lg mx-1">
                              Delete
                            </button>
                          </form>  
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
            <!-- /.timeline -->
          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection