@extends('layouts/page')

@section('content')
@component('partials/table', ['model' => 'appointment', 'items' => $appointments, 'controls' => true, 'search' => false, 'filters' => ['hospital' => $hospitals]])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date / Time</th>
        @role('admin')
        <th>Caller</th>
        @endrole
        <th width="99%">Hospital</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($appointments as $appointment)
      <tr>
        <td>{{ $appointment->id }}</td>
        <td>
          <a href="{{ route('appointments.edit', $appointment->id) }}">
            {!! date('l, j F \a\t g:ia', strtotime($appointment->start)) !!}
          </a>
        </td>
        @hasanyrole('admin|staff|agent')
        <td>
          <a class="mr-3" href="{{ route('users.show', $appointment->user_id) }}">
            {!! $appointment->user ? $appointment->user->name : '&ndash;' !!}
          </a>
        </td>
        @endhasanyrole
        <td>
          @hasanyrole('admin|staff|agent')
          <a class="mr-3" href="{{ route('hospitals.show', $appointment->hospital_id) }}">
          {!!$appointment->hospital ? $appointment->hospital->name : '&ndash;'!!}
          </a>
          @else
          {!!$appointment->hospital ? $appointment->hospital->name : '&ndash;'!!}
          @endhasanyrole
        </td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($appointment->created_at)->diffForHumans() }}</td>
        <td class="text-muted">{{ \Carbon\Carbon::parse($appointment->updated_at)->diffForHumans() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent


@endsection