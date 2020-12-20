@extends('layouts/master')

@section('page')
@include('partials/navbar')
<main class="container-fluid py-3">
  @yield('content')
</main>
@endsection