@extends('layouts.main')

@section('title','Login')

@section('content')
<div class="hold-transition login-page container-fluid">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Hobi</b>Sedekah</a>
            </div>
        <div class="card-body">
            <p class="login-box-msg">Login</p>
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

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
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
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
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
                <button type="submit" class="mt-3 btn btn-primary btn-block">Masuk</button>
            </form>
            <!-- /.social-auth-links -->
    
            <p class="mb-1 mt-2">
                <a href="#">Lupa Password</a>
            </p>
            <p class="mb-1">
                <a href="#" class="text-center">Buat Akun</a>
            </p>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection