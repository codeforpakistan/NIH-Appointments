@extends('layouts/page')
@section('content')

@isset($department)
<form class="card bg-light mb-3" action="{{ route('departments.update', $department->id) }}" method="post">
  @method('PUT')
  @else
  <form class="card bg-light mb-3" action="{{ route('departments.store') }}" method="post">
    @endisset
    @csrf

    <div class="card-header border-0 d-flex">
      <h2 class="mb-0 font-weight-normal flex-grow-1">
        @isset($department) Editing department @else Creating department @endisset
      </h2>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Department</label>
        <div class="col-sm-10">
          @isset($department)
          <input type="text" id="name" name="name" class="form-control" required value="{{ $department->name }}">
          @else
          <input type="text" id="name" name="name" class="form-control" required>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label for="hospitals" class="col-sm-2 col-form-label">Hospitals</label>
        <div class="col-sm-10">
          @foreach ($hospitals as $hospital)
          <div class="form-check form-checkinline">
            @isset($department)
            <input class="form-check-input" type="checkbox" id="h_{{$hospital->id}}" name="hospitals[]" value="{{$hospital->id}}" @if($department->hospitals->contains('id', $hospital->id)) checked @endif>
            @else
            <input class="form-check-input" type="checkbox" id="h_{{$hospital->id}}" name="hospitals[]" value="{{$hospital->id}}">
            @endisset
            <label class="form-check-label" for="h_{{$hospital->id}}">{{$hospital->name}}</label>
          </div>
          @endforeach
          @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="card-footer border-0">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{ route('departments.index') }}" class="btn btn-default">Cancel</a>
    </div>
  </form>
  @isset($department)
<form class="card card-body text-danger d-block bg-light" method="post" action="{{route('departments.destroy', $department->id)}}">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete Department</button>
</form>
@endisset

  @endsection