@extends('layouts/page')

@section('content')
@component('partials/table', ['model' => 'appointment', 'items' => $appointments, 'controls' => true])
<div class="card-body table-responsive p-0">
  <table class="table table-hover table-striped text-nowrap mb-0">
    <thead>
      <tr>
        <th>ID</th>
        <th width="99%">Hospital</th>
        <th>Time</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($appointments as $appointment)
      <tr>
        <td>{{ $appointment->id }}</td>
        <td><a href="{{ route('appointments.edit', $appointment->id) }}">{{ $appointment->hospital->name }}</td>
        <td>{{ \Carbon\Carbon::parse($appointment->start)->diffForHumans() }}</td>
        <td>{{ \Carbon\Carbon::parse($appointment->created_at)->diffForHumans() }}</td>
        <td>{{ \Carbon\Carbon::parse($appointment->updated_at)->diffForHumans() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endcomponent


@endsection