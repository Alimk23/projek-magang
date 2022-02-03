@extends('layouts.main')
@section('title')
  {{$data['title']}}
@endsection

@section('css-custom')
  <!-- BS Stepper -->
  <link rel="stylesheet" href="/assets_ui/plugins/bs-stepper/css/bs-stepper.min.css">
@endsection

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')

<div class="container pt-2 mb-2">
  <div class="row justify-content-center">
      <div class="col-sm-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $data['title'] }}</h3>
          </div>
          <div class="card-body p-2">
            <form action="/organization" method="POST" enctype="multipart/form-data" class="text-left">
              @csrf
              <div class="form-group">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#login">
                        <button type="button" class="step-trigger" role="tab" aria-controls="login" id="login-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Info Login</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#company">
                        <button type="button" class="step-trigger" role="tab" aria-controls="company" id="company-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Info Lembaga</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="login" class="content" role="tabpanel" aria-labelledby="login-trigger">
                        <div class="mb-3">
                          <div class="input-group">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                              <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap">
                          </div>
                          @error('name')
                          <div class="text-small text-danger" role="alert">
                          <small>{{ $message }}</small>
                          </div>
                          @enderror
      
                          <div class="input-group mt-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                  </div>
                              </div>
                              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                          </div>
                          @error('email')
                          <div class="text-small text-danger" role="alert">
                          <small>{{ $message }}</small>
                          </div>
                          @enderror
      
                          <div class="input-group mt-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                  </div>
                              </div>
                              <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nomor HP (misal. 0821{{  date("d") }}{{  date("m") }}{{  date("Y") }})">
                          </div>
                          @error('phone')
                          <div class="text-small text-danger" role="alert">
                          <small>{{ $message }}</small>
                          </div>
                          @enderror
      
                          <div class="input-group mt-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span onclick="showPass()">
                                          <i id="eye" class="fas fa-eye-slash"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          @error('password')
                          <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                          </div>
                          @enderror
                          <div class="input-group mt-3">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>
                              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Ulangi Password">
                          </div>
                          @error('password_confirmation')
                          <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                          </div>
                          @enderror                  
                      </div>
                        <button type="button" class="btn btn-primary" onclick="stepper.next()">Next</button>
                      </div>


                      <div id="company" class="content" role="tabpanel" aria-labelledby="company-trigger">
                        <div class="form-group">
                          <label for="company_name">Nama Lembaga</label>
                          <input class="form-control @error('company_name') is-invalid @enderror" type="text" name="company_name" value="{{ old('company_name') }}" required>
                          @error('company_name')
                          <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                          </div>
                          @enderror  
                        </div>
                        <div class="form-group">
                          <label for="photo">Foto Profil Lembaga</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}">
                              <label class="custom-file-label" for="photo">Pilih file</label>
                            </div>
                          </div>
                          @error('photo')
                          <div class="text-small text-danger" role="alert">
                              <small>{{ $message }}</small>
                          </div>
                          @enderror  
                        </div>
                        <div class="form-group">
                          <label for="job_title">Jabatan</label>
                          <input class="form-control @error('job_title') is-invalid @enderror" aria-describedby="job_title_helper" type="text" name="job_title" value="{{ old('job_title') }}" required>
                          <small id="job_title_helper">Masukkan jabatan anda dalam lembaga tersebut</small>
                        </div>
                        @error('job_title')
                        <div class="text-small text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </div>
                        @enderror  

                        <div class="form-group">
                          <label for="address">Alamat</label>
                          <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ old('address') }}" required>
                        </div>
                        @error('address')
                        <div class="text-small text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </div>
                        @enderror  

                        <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
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