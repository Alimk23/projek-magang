@extends('layouts.main')
@section('title')
  Status Pendaftaran Lembaga
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')

<div class="container pt-2 mb-2">
  <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title font-weight-bold">Status Pendaftaran Lembaga</h3>
          </div>
          <div class="card-body">
            <div class="container"></div>
            <div class="row mb-3 justify-content-between border-bottom">
              <div class="col-4">
                Nama Lembaga:
              </div>
              <div class="col-8">
                <p class="text-small text-right">
                  {{ $RegistrationStatus->user->company->company_name }}
                </p>
              </div>
            </div>
            <div class="row mb-3 justify-content-between border-bottom">
              <div class="col-4">
                Dibuat oleh:
              </div>
              <div class="col-8">
                <p class="text-small text-right">
                  {{ $RegistrationStatus->user->name }}
                </p>
              </div>
            </div>
            <div class="row mb-3 justify-content-between border-bottom">
              <div class="col-4">
                Sebagai:
              </div>
              <div class="col-8">
                <p class="text-small text-right">
                  {{ $RegistrationStatus->user->company->job_title }} dari {{ $RegistrationStatus->user->company->company_name }}
                </p>
              </div>
            </div>
            <div class="row mb-3 justify-content-between border-bottom">
              <div class="col-4">
                Status:
              </div>
              <div class="col-8">
                @if ($RegistrationStatus->status == 0)                    
                <p class="text-small text-primary text-right">
                  Dalam proses verifikasi
                </p>
                @endif
                @if ($RegistrationStatus->status == 1)                    
                <p class="text-small text-success text-right">
                  Disetujui
                </p>
                @endif
                @if ($RegistrationStatus->status == 2)                    
                <p class="text-small text-danger text-right">
                  Ditolak
                </p>
                @endif
              </div>
            </div>
            <div class="row mb-3 justify-content-between border-bottom">
              <div class="col">
                Simpan link berikut ini untuk melihat status pendaftaran lembaga anda:
                <input type="text" class="w-100 form-control form-control-border" readonly value="{{ env('APP_URL'); }}/organization/status/{{ $RegistrationStatus->id }}">
              </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            <div class="d-flex justify-content-between align-items-center">
              <a href="/">
                <button type="button" class="btn btn-lg btn-light">
                  <i class="fas fa-2x fa-home"></i>
                </button>
              </a>

              <a href=" {{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <button type="button" class="btn btn-lg btn-light">
                    <i class="fas fa-2x fa-sign-out-alt"></i>
                  </button>
              </a>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>

@endsection

@section('footer')
  @include('partials.footer')
@endsection

@section('js-custom')

<!-- BS-Stepper -->
<script src="/assets_ui/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })


  var state = false;
    function showPass() {
        if (state) {
            document.getElementById("password").setAttribute("type","password");
            document.getElementById("password-confirm").setAttribute("type","password");
            $('#eye').removeClass();
            $('#eye').addClass("fas fa-eye-slash");
            state = false;
        } else {
            document.getElementById("password").setAttribute("type","text");
            document.getElementById("password-confirm").setAttribute("type","text");
            $('#eye').removeClass();
            $('#eye').addClass("fas fa-eye");
            state = true;
        }
    }

    $(function () {
      bsCustomFileInput.init();
    });
</script>

@endsection