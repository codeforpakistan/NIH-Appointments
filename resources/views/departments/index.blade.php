@extends('layouts/page')
@section('content')
@component('partials/table', ['model' => 'department', 'items' => $departments, 'controls' => true, 'search' => false])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th width="99%">Department</th>
        <th>Hospitals</th>
        <th>Doctors</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($departments as $department)
      <tr>
        <td>{{ $department->id }}</td>
        <td><a href="{{ route('departments.edit', $department->id) }}">{{ $department->name }}</a></td>
        <td class="text-center">{!! $department->hospitals_count > 0 ? $department->hospitals_count : '&ndash;' !!}</td>
        <td class="text-center">{!! $department->doctors_count > 0 ? $department->doctors_count : '&ndash;' !!}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($department->created_at)->diffForHumans() }}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($department->updated_at)->diffForHumans() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent

@endsection