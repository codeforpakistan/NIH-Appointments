@extends('layouts/page')

@section('content')
@component('partials/table', ['model' => 'user', 'items' => $users, 'controls' => true, 'search' => true, 'filters' => ['role' => $roles]])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th width="99%">Email</th>
        <th>Appointments</th>
        <th>Role</th>
        @role('admin')
        <th>Created</th>
        <th>Updated</th>
        @endrole
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td class="text-center">{!! $user->appointments_count > 0 ? $user->appointments_count : '&ndash;' !!}</td>
        <td>
          @foreach ($user->roles as $role)
          {{ ucwords($role->name) }}
          @endforeach
        </td>
        @role('admin')
        <td class="text-muted">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
        @endrole
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent


@endsection