@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @include('partials.content-header')
@endsection

@section('content')
<div class="container">
  @if (session()->has('success'))
    <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
  @endif
  @if (session()->has('error'))
    <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
  @endif
    <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-fw fa-users"></i>
            Profile
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-5 col-sm-3">
              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-login-info-tab" data-toggle="pill" href="#vert-tabs-login-info" role="tab" aria-controls="vert-tabs-login-info" aria-selected="true">Login Info</a>
                <a class="nav-link" id="vert-tabs-profile-info-tab" data-toggle="pill" href="#vert-tabs-profile-info" role="tab" aria-controls="vert-tabs-profile-info" aria-selected="false">Profile Info</a>
                <a class="nav-link" id="vert-tabs-bank-info-tab" data-toggle="pill" href="#vert-tabs-bank-info" role="tab" aria-controls="vert-tabs-bank-info" aria-selected="false">Bank Info</a>
                <a class="nav-link" id="vert-tabs-reset-passsword-tab" data-toggle="pill" href="#vert-tabs-reset-passsword" role="tab" aria-controls="vert-tabs-reset-passsword" aria-selected="false">Reset Passsword</a>
              </div>
            </div>
            <div class="col-7 col-sm-9">
              <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-login-info" role="tabpanel" aria-labelledby="vert-tabs-login-info-tab">
                    <div class="float-right">
                        <button type="button" class="btn btn-block btn-outline-primary btn-xs">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                            <p><b>Nama</b></p>
                            <p>{{ $data['name'] }}</p>
                            <p><b>Email</b></p>
                            <p>{{ $data['email'] }}</p>
                            <p><b>No. HP</b></p>
                            <p>{{ $data['phone'] }}</p>
                       </div>
                   </div>
                </div>
                <div class="tab-pane fade" id="vert-tabs-profile-info" role="tabpanel" aria-labelledby="vert-tabs-profile-info-tab">
                    <div class="float-right">
                        <button type="button" class="btn btn-block btn-outline-primary btn-xs">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                            <p><b>Nama</b></p>
                            <p>nama</p>
                            <p><b>Biografi</b></p>
                            <p>Biografi</p>
                       </div>
                       <div class="col-md-6">
                           <p><b>Domisili</b></p>
                           <p>Domisili</p>
                           <p><b>Alamat</b></p>
                           <p>Alamat</p>
                       </div>
                   </div>
                </div>
                <div class="tab-pane fade" id="vert-tabs-bank-info" role="tabpanel" aria-labelledby="vert-tabs-bank-info-tab">
                    <div class="float-right">
                        <button type="button" class="btn btn-block btn-outline-primary btn-xs">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                            <p><b>Nama Bank</b></p>
                            <p>Nama Bank</p>
                            <p><b>Nomor Rekening</b></p>
                            <p>Nomor Rekening</p>
                            <p><b>Atas Nama</b></p>
                            <p>Atas Nama</p>
                       </div>
                   </div>
                </div>
                <div class="tab-pane fade" id="vert-tabs-reset-passsword" role="tabpanel" aria-labelledby="vert-tabs-reset-passsword-tab">
                    <div class="row">
                        <div class="col-6">
                            <form action="#" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="oldPassword">Password Lama</label>
                                    <input type="password" name="oldpassword" class="form-control" id="oldPassword" placeholder="Password">
                                  </div>
                                <div class="form-group">
                                    <label for="newPassoword">Password Baru</label>
                                    <input type="password" name="newpassword" class="form-control" id="newPassoword" placeholder="Password">
                                  </div>
                                <div class="form-group">
                                    <label for="newPassword">Ulangi Password Baru</label>
                                    <input type="password" name="newpasswordconfirm" class="form-control" id="newPassword" placeholder="Password">
                                  </div>
                                <button type="submit" class="btn btn-block btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Reset
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection
