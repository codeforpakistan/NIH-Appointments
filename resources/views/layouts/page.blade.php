@extends('layouts/master')

@section('page')
@include('partials/navbar')
<main class="container-fluid py-3">
  
  @if (session('success'))
  @component('components.alert', ['type' => 'success'])
    {!! session('success') !!}
  @endcomponent
  @endif

  @if (session('error'))
  @component('components.alert', ['type' => 'danger'])
    {!! session('error') !!}
  @endcomponent
  @endif

  @if ($errors->any())
  @include('components.errors', ['errors' => $errors])
  @endif

  @yield('content')
</main>
@endsection