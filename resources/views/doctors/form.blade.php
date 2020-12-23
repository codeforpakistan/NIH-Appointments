@extends('layouts/page')
@section('content')

@isset($doctor)
<form class="card bg-light mb-3" action="{{ route('doctors.update', $doctor->id) }}" method="post">
@method('PUT')
@else
<form class="card bg-light mb-3" action="{{ route('doctors.store') }}" method="post">
@endisset
  
@csrf

  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">
      @isset($doctor) Editing doctor @else Creating doctor @endisset
    </h2>
  </div>
  <div class="card-body">
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        @isset($doctor)
        <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $doctor->name) }}">
        @else
        <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
        @endif
      </div>
    </div>
    <div class="form-group row">
      <label for="hospital" class="col-sm-2 col-form-label">Hospital</label>
      <div class="col-sm-10">
        <select class="form-control" id="hospital" name="hospital" required>
          <option value="" selected default>Select a hospital...</option>
          @foreach ($hospitals as $hospital)
          @isset($doctor)
          <option value="{{ $hospital->id }}" @if($doctor->hospital_id == $hospital->id) selected @endif >{{ $hospital->name }}</option>
          @else
          <option value="{{ $hospital->id }}" @if(old('hospital')==$hospital->id) selected @endif>{{ $hospital->name }}</option>
          @endisset
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="department" class="col-sm-2 col-form-label">Department</label>
      <div class="col-sm-10">
        <select class="form-control" id="department" name="department" required>
          <option value="" selected default>Select a department...</option>
          @foreach ($departments as $department)
          @isset($doctor)
          <option value="{{ $department->id }}" @if($doctor->department_id == $department->id) selected @endif >{{ $department->name }}</option>
          @else
          <option value="{{ $department->id }}" @if(old('department')==$department->id) selected @endif>{{ $department->name }}</option>
          @endisset
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="card-footer border-0">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('doctors.index') }}" class="btn btn-default">Cancel</a>
  </div>
</form>
@isset($doctor)
<form class="card card-body text-danger d-block bg-light" method="post" action="{{route('doctors.destroy', $doctor->id)}}">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete Doctor</button>
</form>
@endisset
@endsection