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
                        class="brand-image ml-4 my-0 py-0"
                        style="opacity: 0.8;width:250px"
                    />
                    <p class="text-xs text-muted text-capitalize" style="color:rgb(175, 175, 175) !important;margin-top:-2rem;margin-left:2rem">#HidupBerkahBerlimpah</p>
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
                    <a href="{{ route('register') }}" class="text-center">Buat Akun</a>
                </p>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection