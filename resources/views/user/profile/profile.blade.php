@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection


@section('navbar')
    @include('partials.navbar')
@endsection

@section('content-header')
    @push('icon-header')
    <i class="fas fa-user"></i>
    @endpush
    <div class="container">
      @include('partials.content-header')
    </div>
@endsection

@section('content')
<div class="container">
  <section class="content">
    @if (session()->has('success'))
      <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
    @endif
    @if (session()->has('error'))
      <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
    @endif
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-12">
                    <div class="d-flex flex-column">
                      @if ($profile) 
                        @if (Storage::disk('public')->exists($profile->photo))
                          <img src="{{ Storage::disk('public')->url($profile->photo) }}" class="rounded-circle mx-auto" width="150px" height="150px">
                        @else
                          <img src="/img/default.png" class="rounded-circle mx-auto" width="150px" height="150px">
                        @endif
                        @else
                          <img src="/img/default.png" class="rounded-circle mx-auto" width="150px" height="150px">
                      @endif
                      <div class="mx-auto mt-2">
                        <button type="button" class="btnUpdateFoto btn btn-outline-primary btn-sm rounded-lg" data-toggle="modal" data-target="#editPhotoModal" data-id='{{ $auth->id }}'>
                          Update Foto Profil
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    {{-- name --}}
                    <div class="form-group row d-flex flex-row mb-0">
                      <div class="col-4">
                        <label for="fullname" class="col-form-label font-weight-normal">Nama Lengkap</label>
                      </div>
                      <div class="col-8">
                        <input type="text" readonly  value=": {{ $auth->name}}" class="form-control-plaintext" id="fullname">
                      </div>
                    </div>
                    {{-- email --}}
                    <div class="form-group row d-flex flex-row mb-0">
                      <div class="col-4">
                        <label for="email" class="col-form-label font-weight-normal">Email</label>
                      </div>
                      <div class="col-8">
                        <input type="text" readonly  value=": {{ $auth->email}}" class="form-control-plaintext" id="email">
                      </div>
                    </div>
                    {{-- phone --}}
                    <div class="form-group row d-flex flex-row mb-0">
                      <div class="col-4">
                        <label for="phone" class="col-form-label font-weight-normal">Nomor HP</label>
                      </div>
                      <div class="col-8">
                        <input type="text" readonly  value=": {{ $auth->phone}}" class="form-control-plaintext" id="phone">
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <button type="button" class="btn btn-outline-primary rounded-lg">
                    Ubah Password
                  </button>
                  <button type="button" class="editLoginInfo btn btn-outline-primary rounded-lg" data-toggle="modal" data-target="#editLoginModal" data-id='{{ $auth->id }}'>
                    Edit Profil
                  </button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    <!-- /.container-fluid -->
  </section>
</div>
@endsection

@section('modal')
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
      <form action="/userdata/{{ $auth->id }}" method="post">
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
<div class="modal fade" id="editPhotoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Foto Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/profile/{{ $auth->id }}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="photo">Upload Foto Profil</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" id="editPhoto">
                <label class="custom-file-label" for="photo">Pilih file</label>
              </div>
            </div>
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
<div class="fixed fixed-bottom">
      @include('partials.admin-footer')
</div>
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