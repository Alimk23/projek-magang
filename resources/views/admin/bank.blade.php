@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
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
            <a href="{{ url('bank/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Bank
              </button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-10">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
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
                        <img src="{{ $bank['bank_logo'] }}" width="50px" alt="" srcset="">
                      </td>
                      <td class="align-middle">{{ $bank['bank_code'] }}</td>
                      <td class="align-middle">{{ $bank['bank_name'] }}</td>
                      <td class="align-middle">{{ $bank['bank_account'] }}</td>
                      <td class="align-middle">{{ $bank['alias'] }}</td>
                      <td class="align-middle d-flex flex-row">
                        <button type="button" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editbankModal">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-xs rounded-lg py-0 px-1 mx-1" data-toggle="modal" data-target="#editbankModal">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

@section('footer')
    @include('partials.admin-footer')
@endsection