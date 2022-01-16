@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-copy"></i>
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
                <form action="/admin/campaign/{{ $campaign->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $campaign->title }}">
                            @error('title')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="slug">Slug</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">{{ env('APP_URL'); }}/campaigns/</span>
                              </div>
                              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ $campaign->slug }}">
                            </div>
                            @error('slug')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                          <div class="d-flex flex-row justify-content-between">
                            <label for="cover">Cover</label>
                            @if (Storage::disk('public')->exists($campaign->cover))
                              <a href="{{ Storage::disk('public')->url($campaign->cover) }}" target="_blank">Custom Cover</a>
                            @else
                              <a href="/img/logo.png" target="_blank">Default Cover</a>
                            @endif
                          </div>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input @error('cover') is-invalid @enderror" name="cover" id="cover">
                                  <label class="custom-file-label" for="cover">Choose file</label>
                                </div>
                            </div>
                            
                            @error('cover')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="category">Category</label>
                            
                            <select class="form-control select2-allow-clear select2Minimal @error('category') is-invalid @enderror" name="category_id" data-placeholder="Choose the category" data-dropdown-css-class="select2-primary" style="width: 100%;">
                              @foreach ($data['category'] as $category)
                              <option value="{{ $category['id'] }}" {{ $category['id'] == $campaign->category_id ? 'selected' : ''}}>{{ $category['title'] }}</option>
                              @endforeach
                            </select>                                  
                            @error('category_id')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="target">Target</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="text" class="form-control @error('target') is-invalid @enderror" id="target" name="target" value="{{ $campaign->target }}">
                            </div>
                            @error('target')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ $campaign->end_date }}">
                            @error('end_date')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="caption">Caption</label>
                            <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption" cols="30" rows="3">{{ $campaign->caption }}</textarea>
                            @error('caption')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
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
                                {{ $campaign->description }}
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
<!-- Select2 -->
<script src="{{ url('assets_ui/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function () {
        // Summernote
        $('#description').summernote()
    });

    $(function () {
      bsCustomFileInput.init();
    });

    $(document).ready(function() {
      $('.select2Minimal').select2({
        theme: "bootstrap4",
        width: "resolve"
      })
    });
</script>

@endsection