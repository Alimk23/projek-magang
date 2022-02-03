@extends('layouts.main')

@section('title')
    Akses dilarang
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card shadow-lg py-5 bg-light" style="margin-top:10rem">
                <div class="card-body">
                    <div class="mb-5 text-center text-dark">
                        <h5><b>Anda tidak dapat mengakses halaman ini</b></h5>
                        <p>{{ $exception->getMessage() }}</p>
                    </div>
                    <div class="container">
                        <div class="d-flex justify-content-around align-items-center">
                          <a href="{{ URL::previous() }}">
                            <button type="button" class="btn btn-lg btn-light">
                              <i class="fas fa-2x fa-arrow-left"></i>
                            </button>
                          </a>
                          <a href="/">
                              <button type="button" class="btn btn-lg btn-light">
                                <i class="fas fa-2x fa-home"></i>
                              </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        var x = document.getElementsByTagName("body")[0];
        var y = document.getElementsByClassName("content-wrapper")[0];
        x.classList.add('bg-dark')
        y.classList.add('bg-dark')
    });
</script>
@endsection