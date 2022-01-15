@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.superadmin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-university"></i>
    @endpush
    @include('partials.content-header')
@endsection

@section('content')
    <section class="content">
      @if (session()->has('success'))
        <input type="text" class="d-none" id="successAlert" value="{{ session('success') }}">
      @endif
      @if (session()->has('error'))
        <input type="text" class="d-none" id="errorAlert" value="{{ session('error') }}">
      @endif
      <div class="container-fluid">
        <div class="row mb-3 mt-0">
          <div class="col-md-2">
            <a href="{{ url('/superadmin/bank/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Bank
              </button>
            </a>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Code</th>
                        <th>Bank Name</th>
                        <th>Account</th>
                        <th>Alias</th>
                        <th style="width: 40px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($getBank as $bank)
                      <tr>
                        <td class="align-middle">{{ $i++ }}</td>
                        <td class="align-middle">
                          @if (Storage::disk('public')->exists($bank['bank_logo']))
                            <a href="{{ Storage::disk('public')->url($bank['bank_logo']) }}" target="_blank">
                              Custom Logo
                            </a>
                          @else
                            <a href="/img/logo.png" target="_blank">Default Logo</a>
                          @endif                            
                        </td>
                        <td class="align-middle">{{ $bank['bank_code'] }}</td>
                        <td class="align-middle">{{ $bank['bank_name'] }}</td>
                        <td class="align-middle">{{ $bank['bank_account'] }}</td>
                        <td class="align-middle">{{ $bank['alias'] }}</td>
                        <td class="align-middle d-inline-flex">
                          <form action="/superadmin/bank/{{ $bank['id'] }}/edit" method="GET">
                            <button type="submit" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1 mx-1">
                              <i class="fas fa-edit"></i>
                            </button>
                          </form>
                          <form action="/superadmin/bank/{{ $bank['id'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-xs rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editCategoryModal">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection