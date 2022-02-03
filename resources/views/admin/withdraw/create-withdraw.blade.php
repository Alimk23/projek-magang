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
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 mb-5">
          <div class="card">
            <div class="card-header">
              @if (session()->has('limit'))
              <div class="card-header">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('limit') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                     
              </div>
              @endif
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
                          <select class="form-control @error('campaign') is-invalid @enderror" name="campaign_id" id="campaignId" data-placeholder="Choose the campaign" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            <option selected disabled>Pilih Campaign</option>
                            @foreach ($data['campaign'] as $campaign)
                            <option value="{{ $campaign['id'] }}" {{ (old('campaign_id') == $campaign['id']) ? 'selected' : '' }}>{{ $campaign['title'] }}</option>
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
                          <select class="form-control select2-allow-clear @error('bank') is-invalid @enderror" name="bank_id" data-placeholder="Choose the bank" data-dropdown-css-class="select2-primary" style="width: 100%;">
                            <option selected disabled>Pilih Bank Tujuan</option>
                            @foreach ($data['bank'] as $bank)
                            <option value="{{ $bank['id'] }}" {{ (old('bank_id') == $bank['id']) ? 'selected' : '' }}>{{ $bank['bank_name'] }} - {{ $bank['alias'] }} ({{ $bank['bank_account'] }})</option>
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
                          <div class="d-flex">
                            <div class="mr-2">
                              <p>Saldo terkumpul: </p>
                            </div>
                            <div class="">
                              <input class="text-primary border-0 shadow-none" type="text" id="maxNominal" name="maxNominal" value="Rp " readonly>
                            </div>
                          </div>
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
<script>
    const campaignId = document.querySelector('#campaignId');
    const maxNominal = document.querySelector('#maxNominal');

    var formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
    });
    campaignId.addEventListener('change', function(){
      fetch('http://localhost:8000/admin/withdraw/create/checkCampaign?id=' + campaignId.value)
            .then(response => response.json())
            .then(data => maxNominal.value = formatter.format(data.maxNominal))
    });
</script>
@endsection