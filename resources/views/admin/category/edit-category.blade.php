@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets_ui/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-list-ul"></i>
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
        <div class="col-lg-6">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/category/{{ $category->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $category->title }}" required>
                            @error('title')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                          <label for="select2Minimal" class="control-label">Icon</label>
                          <div class="row">
                            <div class="col d-flex flex-md-row flex-column">
                              <div class="form-group mr-lg-4 mr-sm-2 mr-1">
                                  <select class="form-control select2-allow-clear select2Minimal @error('icon') is-invalid @enderror" name="icon" id="icon" value="{{ $category->icon }}" required>
                                    @foreach ($icons as $icon)
                                    <option value="{{ $icon }}" {{ $icon == $category->icon ? 'selected' : ''}}>{{ $icon }}</option>
                                    @endforeach
                                  </select>
                                @error('icon')
                                <div class="text-small text-danger" role="alert">
                                  <small>{{ $message }}</small>
                                </div>
                                @enderror
                              </div>
                              <i id="iconShow"></i>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-block bg-gradient-primary btn-md">
                                Update
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
<!-- Select2 -->
<script src="{{ url('assets_ui/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('.select2Minimal').select2({
    theme: "bootstrap4",
    width: "resolve"
  })
});
  $('[name=icon]').on('change', function (){
    let value = $(this).val();
    $('#iconShow').removeClass();
    $('#iconShow').addClass(value);
  })
</script>

@endsection