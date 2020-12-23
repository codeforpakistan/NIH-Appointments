@extends('layouts/page')
@section('content')

@isset($hospital)
<form class="card bg-light mb-3" action="{{ route('hospitals.update', $hospital->id) }}" method="post">
@method('PUT')
@else
<form class="card bg-light mb-3" action="{{ route('hospitals.store') }}" method="post">
@endisset
@csrf

  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">
      @isset($hospital) Editing hospital @else Creating hospital @endisset
    </h2>
  </div>
  <div class="card-body">
    <div class="form-group row">
      <label for="hospital" class="col-sm-2 col-form-label">Hospital</label>
      <div class="col-sm-10">
        @isset($hospital)
        <input type="text" name="name" class="form-control" required value="{{ $hospital->name }}">
        @else
        <input type="text" name="name" class="form-control" required>
        @endif
      </div>
    </div>
    <div class="form-group row">
      <label for="departments" class="col-sm-2 col-form-label">Departments</label>
      <div class="col-sm-10">
        @foreach ($departments as $department)
        <div class="form-check form-checkinline">
          @isset($hospital)
          <input class="form-check-input" type="checkbox" id="h_{{$department->id}}" name="departments[]" value="{{$department->id}}" @if($hospital->departments->contains('id', $department->id)) checked @endif>
          @else
          <input class="form-check-input" type="checkbox" id="h_{{$department->id}}" name="departments[]" value="{{$department->id}}">
          @endisset
          <label class="form-check-label" for="h_{{$department->id}}">{{$department->name}}</label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="card-footer border-0">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('hospitals.index') }}" class="btn btn-default">Cancel</a>
  </div>
</form>
@isset($hospital)
<form class="card card-body text-danger d-block bg-light" method="post" action="{{route('hospitals.destroy', $hospital->id)}}">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete Hospital</button>
</form>
@endisset
@endsection
