@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/summernote/summernote-bs4.min.css') }}">
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
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/admin/news/{{ $report->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                      <div class="col">
                        <input type="text" class="d-none" name="campaign_id" id="campaign_id" value="{{ $report->campaign->id }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="title">Title Report</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $report->title }}">
                      @error('title')
                      <div class="text-small text-danger" role="alert">
                        <small>{{ $message }}</small>
                      </div>
                      @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="description">Description</label>
                            @error('description')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                            <textarea id="description" name="description">
                              {{ $report->description }}
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-block bg-gradient-primary btn-md">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection

@section('js-custom')
<!-- Summernote -->
<script src="{{ url('assets_ui/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(function () {
        // Summernote
        $('#description').summernote()
    });
</script>

@endsection