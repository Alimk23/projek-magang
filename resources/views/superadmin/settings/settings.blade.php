@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-user"></i>
    @endpush
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

  <div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-10">
      <div class="card">
        <div class="card-body">
          @if (session()->has('forbidden'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('forbidden') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>          
          @endif
          <div class="card card-primary card-outline">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">Login Info</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              <div class="row">
                <div class="col-11">
                  {{-- name --}}
                  <div class="form-group row d-flex flex-row mb-0">
                    <div class="col-4">
                      <label for="fullname" class="col-form-label font-weight-normal">Nama Lengkap</label>
                    </div>
                    <div class="col-8">
                      <input type="text" readonly  value=": {{ $data['name'] }}" class="form-control-plaintext" id="fullname">
                    </div>
                  </div>
                  {{-- email --}}
                  <div class="form-group row d-flex flex-row mb-0"">
                    <div class="col-4">
                      <label for="email" class="col-form-label font-weight-normal">Email</label>
                    </div>
                    <div class="col-8">
                      <input type="text" readonly  value=": {{ $data['email'] }}" class="form-control-plaintext" id="email">
                    </div>
                  </div>
                  {{-- phone --}}
                  <div class="form-group row d-flex flex-row mb-0"">
                    <div class="col-4">
                      <label for="phone" class="col-form-label font-weight-normal">Nomor HP</label>
                    </div>
                    <div class="col-8">
                      <input type="text" readonly  value=": {{ $data['phone'] }}" class="form-control-plaintext" id="phone">
                    </div>
                  </div>
                </div>
                <div class="col-1">
                  <button type="button" class="editLoginInfo btn btn-outline-primary btn-xs rounded-lg py-0 px-1" data-toggle="modal" data-target="#editLoginModal" data-id='{{ $data['id'] }}'>
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div> 
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">Profile Info</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              <div class="row">
                <div class="col-11">
                  <div class="d-flex flex-column flex-row flex-lg-row align-items-center w-100">
                    {{-- photo --}}
                    <div class="form-group col-md-2 mr-2">
                    @if (Storage::disk('public')->exists($data['photo']))
                      <img src="{{ Storage::disk('public')->url($data['photo']) }}" alt="" class="rounded-circle" width="100px">
                    @else
                      <img src="/img/default.png" class="rounded-circle" width="100px" alt="" srcset="">
                    @endif
                    </div>
                    {{-- address --}}
                    <div class="form-group col-md-10 d-flex flex-column mb-0">
                      <label for="address" class="col-form-label font-weight-normal">Alamat</label>
                      <textarea type="text" readonly class="form-control-plaintext" id="address" cols="30" rows="3">{{ $data['address'] }}</textarea>
                    </div>
                  </div>
                </div>
                <div class="col-1">
                  <button type="button" class="editProfileInfo btn btn-outline-primary btn-xs rounded-lg py-0 px-1" data-toggle="modal" data-target="#editProfileModal" data-id='{{ $data['id'] }}'>
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">Company Info</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              <div class="row">
                <div class="col-11">
                  {{-- company_name --}}
                  <div class="form-group row d-flex flex-row mb-0">
                    <div class="col-4">
                      <label for="company_name" class="col-form-label font-weight-normal">Nama Lembaga</label>
                    </div>
                    <div class="col-8">
                      <input type="text" readonly  value=": {{ $data['company_name'] }}" class="form-control-plaintext" id="company_name">
                    </div>
                  </div>
                  {{-- job_title --}}
                  <div class="form-group row d-flex flex-row mb-0">
                    <div class="col-4">
                      <label for="job_title" class="col-form-label font-weight-normal">Jabatan</label>
                    </div>
                    <div class="col-8">
                      <input type="text" readonly  value=": {{ $data['job_title'] }}" class="form-control-plaintext" id="job_title">
                    </div>
                  </div>
                </div>
                <div class="col-1">
                  <button type="button" class="editCompanyInfo btn btn-outline-primary btn-xs rounded-lg py-0 px-1" data-toggle="modal" data-target="#editCompanyModal" data-id='{{ $data['id'] }}'>
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <a href="" data-card-widget="collapse">
                <h3 class="card-title" style="font-size: 16px !important; font-weight:600;color:black;">Change Password</h3>
                <div class="card-tools text-right">
                  <button type="button" class="btn btn-tool" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              </a>
            <div class="card-body">
              <form action="#" method="post">
                  @csrf
                  @method('PATCH')
                  <div class="form-group row mt-0">
                    <div class="col-md-3">
                      <label class="font-weight-normal" for="oldPassword">Password Lama</label>
                    </div>
                    <div class="col-md-9">
                      <input type="password" name="oldpassword" class="form-control" id="oldPassword">
                    </div>
                  </div>
                  <div class="form-group row mt-0">
                    <div class="col-md-3">
                      <label class="font-weight-normal" for="newPassoword">Password Baru</label>
                    </div>
                    <div class="col-md-9">
                      <input type="password" name="newpassword" class="form-control" id="newPassoword">
                    </div>
                  </div>
                  <div class="form-group row mt-0">
                    <div class="col-md-3">
                      <label class="font-weight-normal" for="newPassword">Ulangi Password Baru</label>
                    </div>
                    <div class="col-md-9">
                      <input type="password" name="newpasswordconfirm" class="form-control" id="newPassword">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-block btn-outline-primary btn-sm w-auto ml-auto mr-auto">
                      <i class="fas fa-edit"></i>
                      Reset
                  </button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- edit Login --}}
<div class="modal fade" id="editLoginModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Login Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post">
        <div class="modal-body">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="editName" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="editEmail" required>
          </div>
          <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="editPhone" required>
          </div>
        </div>
        <div class="card-footer">        
          <div class="row d-flex float-right mx-3 justify-content-end">
            <div class="col-4 mx-1">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                  
            <div class="col-4 mx-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>                  
          </div>
        </div>                  
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- edit Profile --}}
<div class="modal fade" id="editProfileModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Profile Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/profile/{{ $data['id'] }}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="photo">Foto Profil</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" id="editPhoto">
                <label class="custom-file-label" for="photo">Pilih file</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="editAddress" required>
          </div>
        </div>
        <div class="card-footer">        
          <div class="row d-flex float-right mx-3 justify-content-end">
            <div class="col-4 mx-1">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                  
            <div class="col-4 mx-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>                  
          </div>
        </div>                  
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- edit company --}}
<div class="modal fade" id="editCompanyModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Company Info</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/company/{{ $data['id'] }}" method="post">
        <div class="modal-body">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="company_name">Nama Lembaga</label>
            <input class="form-control @error('company_name') is-invalid @enderror" type="text" name="company_name" id="editCompanyName" required>
          </div>
          <div class="form-group">
            <label for="job_title">Jabatan</label>
            <input class="form-control @error('job_title') is-invalid @enderror" type="text" name="job_title" id="editJobTitle" required>
          </div>
        </div>
        <div class="card-footer">        
          <div class="row d-flex float-right mx-3 justify-content-end">
            <div class="col-4 mx-1">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>                  
            <div class="col-4 mx-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>                  
          </div>
        </div>                  
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection

@section('js-custom')
<!-- bs-custom-file-input -->
<script src="{{ url('/assets_ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('/js/script.js') }}"></script>
<script>
    $(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection