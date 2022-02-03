@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-university"></i>
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
        <div class="col-lg-6 mb-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('/superadmin/bank') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 d-none">
                        <div class="col">
                            <label for="user_id">User ID</label>
                            <input type="text" readonly class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ $data['user_id'] }}" required>
                            @error('user_id')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="bank_name">Nama Bank</label>
                            <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" required>
                            @error('bank_name')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="bank_code">Kode Transfer Bank</label>
                            <input type="number" class="form-control @error('bank_code') is-invalid @enderror" id="bank_code" name="bank_code" value="{{ old('bank_code') }}" required>
                            @error('bank_code')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="bank_account">Nomor Rekening</label>
                            <input type="number" class="form-control @error('bank_account') is-invalid @enderror" id="bank_account" name="bank_account" value="{{ old('bank_account') }}" required>
                            @error('bank_account')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="alias">Atas Nama</label>
                            <input type="text" class="form-control @error('alias') is-invalid @enderror" id="alias" name="alias" value="{{ old('alias') }}" required>
                            @error('alias')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="bank_logo">Logo Bank</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input @error('bank_logo') is-invalid @enderror" aria-describedby="logoBankHelp" name="bank_logo" id="bank_logo" value="{{ old('bank_logo') }}">
                                <label class="custom-file-label" for="bank_logo">Choose file</label>
                              </div>
                            </div>
                            <small id="logoBankHelp" class="form-text text-muted">
                              Ukuran logo yang ditampilkan adalah 50 x 20 piksel
                            </small>
                            @error('bank_logo')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mt-2">
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
<!-- bs-custom-file-input -->
<script src="{{ url('assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
      $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection