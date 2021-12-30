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
                <form action="{{ url('campaign') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
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
                                <span class="input-group-text" id="basic-addon1">{{ env('APP_URL'); }}/campaign/</span>
                              </div>
                              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Auto complete from title form" value="{{ old('slug') }}">
                            </div>
                            @error('slug')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cover">Cover</label>

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
                          <div class="row">
                            <div class="col-3">
                              <label for="category">Category</label>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1" data-toggle="modal" data-target="#createCategoryModal">
                                  <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1" data-toggle="modal" data-target="#editCategoryModal">
                                  <i class="fas fa-edit"></i>
                                </button>
                            </div>
                          </div>
                            <div class="select2-primary">
                              <select class="form-control select2 @error('category') is-invalid @enderror" name="category" multiple="multiple" data-placeholder="Choose the category" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                @foreach ($data['category'] as $category)
                                <option value="{{ $category['title'] }}">{{ $category['title'] }}</option>
                                @endforeach
                              </select>                                  
                            </div>                            
                            @error('category')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                            @error('title')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                            @error('logo')
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
                                <input type="text" class="form-control @error('target') is-invalid @enderror" id="target" name="target" value="{{ old('target') }}">
                            </div>
                            @error('target')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                            @error('end_date')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="post">Post</label>
                            @error('post')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                            <textarea id="post" name="post">
                                <b>Geser ke bawah</b> atau pilih tampilan <b>Full Screen</b> untuk memperbesar area mengetik
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

@section('modal')
{{-- create new category --}}
<div class="modal fade" id="createCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/category" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" required>
          </div>
          <div class="form-group">
            <label for="logo">Logo</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" id="logo">
                <label class="custom-file-label" for="logo">Choose file (Optional)</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">        
          <div class="row d-flex float-right mx-3 justify-content-end">
            <div class="col-4 mx-1">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                  
            <div class="col-4 mx-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>                  
          </div>
        </div>                  
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
{{-- edit category --}}
<div class="modal fade" id="editCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="category" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
          <div class="form-group">
            <label for="title">Category Name</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" required>
          </div>
          <div class="form-group">
            <label for="logo">Logo</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" id="logo">
                <label class="custom-file-label" for="logo">Choose file (Optional)</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">        
          <div class="row d-flex float-right mx-3 justify-content-end">
            <div class="col-4 mx-1">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                  
            <div class="col-4 mx-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>                  
          </div>
        </div>                  
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('js-custom')
<!-- Summernote -->
<script src="{{ url('assets_ui/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ url('assets_ui/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/campaign/create/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    $(function () {
        // Summernote
        $('#post').summernote()
    });

    $(function () {
      bsCustomFileInput.init();
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>

@endsection