@extends('layouts.main')

@section('title','Register')

@section('content')
<div class="hold-transition login-page container-fluid">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center my-0 py-0">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img
                        src="{{ url('/img/logo.png') }}"
                        alt="Hobi Sedekah"
                        class="brand-image ml-md-4 mt-2 py-0 mx-auto"
                        style="opacity: 0.8;width:150px"
                    />
                    <p class="text-xs text-muted text-capitalize mx-auto" style="color:rgb(175, 175, 175) !important">#HidupBerkahBerlimpah</p>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name">
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
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
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
                        <div class="input-group-append" onclick="showPass()">
                            <div class="input-group-text">
                                <span>
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
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Repeat Password">
                    </div>
                    @error('password_confirmation')
                    <div class="text-small text-danger" role="alert">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Buat Akun</button>
                </form>
                <!-- /.social-auth-links -->
        
                <p class="mb-1 mt-2">
                    Sudah punya akun? <a href="{{ url('login') }}" class="text-center">klik untuk login</a>
                </p>
                <p class="mb-1 mt-2">
                    Punya program kebaikan? <a href="{{ url('/organization/create') }}" class="text-center">silahkan daftar disini</a>
                </p>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js-custom')
<script>
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
</script>
@endsection