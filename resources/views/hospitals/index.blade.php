@extends('layouts/page')
@section('content')
@component('partials/table', ['model' => 'hospital', 'items' => $hospitals, 'controls' => true, 'search' => true])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th width="99%">Hospital</th>
        <th>Departments</th>
        <th>Appointments</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($hospitals as $hospital)
      <tr>
        <td>{{ $hospital->id }}</td>
        <td><a href="{{ route('hospitals.edit', $hospital->id) }}">{{ $hospital->name }}</a></td>
        <td class="text-center">{!! $hospital->departments_count > 0 ? $hospital->departments_count : '&ndash;' !!}</td>
        <td class="text-center">{!! $hospital->appointments_count > 0 ? $hospital->appointments_count : '&ndash;' !!}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($hospital->created_at)->diffForHumans() }}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($hospital->updated_at)->diffForHumans() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent

@endsection