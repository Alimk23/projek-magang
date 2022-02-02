@extends('layouts.main')

@section('title','Login')

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
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>          
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>          
                @endif

                <form action="/password/reset" method="post">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    @error('email')
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
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Password Lama">
                        <div class="input-group-append" onclick="showPass()">
                            <div class="input-group-text">
                                <span>
                                    <i id="eye" class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @error('old_password')
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
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
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
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Ulangi Password Baru">
                    </div>
                    @error('password_confirmation')
                    <div class="text-small text-danger" role="alert">
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Reset Password</button>
                </form>
                <!-- /.social-auth-links -->
        
                <p class="mb-1 mt-2">
                    Kembali ke halaman login? <a href="{{ url('login') }}" class="text-center">klik untuk login</a>
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
            document.getElementById("old_password").setAttribute("type","password");
            document.getElementById("password").setAttribute("type","password");
            document.getElementById("password-confirm").setAttribute("type","password");
            $('#eye').removeClass();
            $('#eye').addClass("fas fa-eye-slash");
            state = false;
        } else {
            document.getElementById("old_password").setAttribute("type","text");
            document.getElementById("password").setAttribute("type","text");
            document.getElementById("password-confirm").setAttribute("type","text");
            $('#eye').removeClass();
            $('#eye').addClass("fas fa-eye");
            state = true;
        }
    }
</script>
@endsection