@extends('layouts.main')

@section('title','Register')

@section('content')
<div class="hold-transition login-page container-fluid">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Hobi</b>Sedekah</a>
            </div>
        <div class="card-body">
            <p class="login-box-msg">Register</p>
    
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('name')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror

                <div class="input-group mt-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror

                <div class="input-group mt-3">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="phone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                @error('phone')
                <div class="text-small text-danger" role="alert">
                  <small>{{ $message }}</small>
                </div>
                @enderror

                <div class="input-group mt-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <div class="text-small text-danger" role="alert">
                    <small>{{ $message }}</small>
                </div>
                @enderror
                <div class="input-group mt-3">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Repeat Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
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
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection