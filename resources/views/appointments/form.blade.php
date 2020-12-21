@extends('layouts/page')
@section('content')

@isset($appointment)
<form class="card bg-light mb-3" action="{{ route('appointments.update', $appointment->id) }}" method="post">
@method('PUT')
@else
<form class="card bg-light mb-3" action="{{ route('appointments.store') }}" method="post">
@endisset
@csrf

  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">
      @isset($appointment) Editing Appointment @else Creating Appointment @endisset
    </h2>
  </div>
  <div class="card-body">
    
    @role('admin')
    <div class="form-group row">
      <label for="caller" class="col-sm-2 col-form-label">Caller</label>
      <div class="col-sm-10">
        <select class="form-control" id="caller" name="caller" >
          <option value="" selected default>Select a caller...</option>
          @foreach ($users as $user)
            @isset($appointment)
              @if (old('caller'))
              <option value="{{ $user->id }}" @if($appointment->user_id == old('caller')) selected @endif >{{ $user->name }}</option>
              @else
              <option value="{{ $user->id }}" @if($appointment->user_id == $user->id) selected @endif >{{ $user->name }}</option>
              @endif
            @else
              @if (old('caller'))
              <option value="{{ $user->id }}" @if(old('caller') == $user->id) selected @endif>{{ $user->name }}</option>
              @else
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endif
            @endisset
          @endforeach
        </select>
      </div>
    </div>
    @endrole

    <div class="form-group row">
      <label for="hospital" class="col-sm-2 col-form-label">Hospital</label>
      <div class="col-sm-10">
        <select class="form-control" id="hospital" name="hospital" >
          <option value="" selected default>Select a hospital...</option>
          @foreach ($hospitals as $hospital)
          @isset($appointment)
          <option value="{{ $hospital->id }}" @if($appointment->hospital_id == $hospital->id) selected @endif >{{ $hospital->name }}</option>
          @else
          <option value="{{ $hospital->id }}" @if(old('hospital') == $hospital->id) selected @endif>{{ $hospital->name }}</option>
          @endisset
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="start" class="col-sm-2 col-form-label">Date</label>
      <div class="col-sm-10">
        @isset($appointment)
          <input type="date" name="start" class="form-control"  value="{{old('start', date('Y-m-d', strtotime($appointment->start))) }}">
        @else
          <input type="date" name="start" class="form-control" value="{{old('start')}}" >
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label for="slot" class="col-sm-2 col-form-label">Time</label>
      <div class="col-sm-10">
        <select class="form-control" id="slot" name="slot" >
        <option value="" selected default>Select a time slot...</option>
        @foreach ($slots as $slot)
          @isset($appointment)
          <option value="{{$slot}}" @if(date('g:ia', strtotime($appointment->start)) == $slot) selected @endif>{{$slot}}</option>
          @else
          <option value="{{$slot}}">{{$slot}}</option>
          @endisset
        @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="card-footer border-0">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('appointments.index') }}" class="btn btn-default">Cancel</a>
  </div>
</form>

@isset($appointment)
<form class="card card-body text-danger d-block bg-light" method="post" action="{{route('appointments.destroy', $appointment->id)}}">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Cancel Appointment</button>
</form>
@endisset

@endsection
