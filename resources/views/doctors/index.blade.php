@extends('layouts/page')
@section('content')
@component('partials/table', ['model' => 'doctor', 'items' => $doctors, 'controls' => true, 'search' => false])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th width="99%">Hospital</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($doctors as $doctor)
      <tr @if($doctor->deleted_at) class="table-danger" @endif>
        <td>{{ $doctor->id }}</td>
        <td><a href="{{ route('doctors.edit', $doctor->id) }}">{{ $doctor->name }}</a></td>
        <td>{!! $doctor->department ? $doctor->department->name : '&ndash;' !!}</td>
        <td>{!! $doctor->hospital ? $doctor->hospital->name : '&ndash;' !!}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($doctor->created_at)->diffForHumans() }}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($doctor->updated_at)->diffForHumans() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent

@endsection