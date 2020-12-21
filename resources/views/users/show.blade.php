@extends('layouts/page')

@section('content')
<div class="card bg-light">
  <div class="card-header border-0 d-flex align-items-center">
    <h2 class="mb-0 font-weight-normal flex-grow-1">{{ $user->name }} <small class="text-muted">({{ ucwords($user->roles->pluck('name')[0]) }})</small></h2>
    <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover table-striped text-nowrap mb-0">
      <thead>
        <tr>
          <th>ID</th>
          <th width="99%">Title</th>
          @role('admin')
          <th>Created</th>
          <th>Updated</th>
          @endrole
        </tr>
      </thead>
      <tbody>
        @foreach ($user->appointments as $appointment)
        <tr>
          <td>{{ $appointment->id }}</td>
          <td>
            &#x1F3E5;
            <a class="mr-3" href="{{ route('hospitals.show', $appointment->hospital_id) }}">{{$appointment->hospital->name}}</a>
            &#x1F551;
            <a href="{{ route('appointments.edit', $appointment->id) }}">
              {!! date('l, j F \a\t g:ia', strtotime($appointment->start)) !!}
            </a>
          </td>
          @role('admin')
          <td class="text-muted">{{ \Carbon\Carbon::parse($appointment->created_at)->diffForHumans() }}</td>
          <td class="text-muted">{{ \Carbon\Carbon::parse($appointment->updated_at)->diffForHumans() }}</td>
          @endrole
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection