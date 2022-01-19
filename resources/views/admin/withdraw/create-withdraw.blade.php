@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-wallet"></i>
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
                <form action="{{ url('/admin/withdraw') }}" method="post">
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
                          <label for="campaign">Campaign</label>
                          <select class="form-control select2-allow-clear select2Minimal @error('campaign') is-invalid @enderror" name="campaign_id" data-placeholder="Choose the campaign" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            @foreach ($data['campaign'] as $campaign)
                            <option value="{{ $campaign['id'] }}">{{ $campaign['title'] }}</option>
                            @endforeach
                          </select>                                  
                            @error('campaign_id')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                          <label for="bank">Bank</label>
                          <select class="form-control select2-allow-clear select2Minimal @error('bank') is-invalid @enderror" name="bank_id" data-placeholder="Choose the bank" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            @foreach ($data['bank'] as $bank)
                            <option value="{{ $bank['id'] }}">{{ $bank['bank_name'] }} - {{ $bank['alias'] }} ({{ $bank['bank_account'] }})</option>
                            @endforeach
                          </select>                                  
                            @error('bank_id')
                            <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                          <label for="nominal">Nominal</label>
                          <p>Jumlah maksimal yang dapat ditarik: 
                            <input type="text" disabled>
                          </p>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                              </div>
                              <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}">
                          </div>
                          @error('nominal')
                          <div class="text-small text-danger" role="alert">
                            <small>{{ $message }}</small>
                          </div>
                          @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                          <label for="description">Keterangan</label>
                          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" cols="30" rows="3">{{ old('description') }}</textarea>
                          @error('description')
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