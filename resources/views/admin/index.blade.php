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
    Admin Dashboard
@endsection

@section('footer')
    @include('partials.footer')
@endsection