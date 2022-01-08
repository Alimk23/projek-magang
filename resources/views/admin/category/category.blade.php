@extends('layouts.main')

@section('title')
  {{$data['title']}}
@endsection

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content-header')
    @push('icon-header')
      <i class="fas fa-list-ul"></i>
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
            <a href="{{ url('category/create') }}">
              <button type="button" class="btn btn-block btn-outline-success btn-sm">
                <i class="fas fa-plus-circle"></i>
                Add New Category
              </button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-10 col-md-6">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Title</th>
                      <th>Icon</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($getCategory as $category)
                    <tr>
                      <td class="align-middle">{{ $i++ }}</td>
                      <td class="align-middle">{{ $category['category']['title'] }}</td>
                      <td>
                        <i class="{{ $category['category']['icon']}}"></i>
                      </td>
                      <td class="align-middle d-inline-flex">
                        <form action="category/{{ $category['category']['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-outline-primary btn-xs rounded-lg py-0 px-1 mx-1">
                            <i class="fas fa-edit"></i>
                          </button>
                        </form>
                        <form action="category/{{ $category['category']['id'] }}" method="POST">
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