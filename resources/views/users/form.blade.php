@extends('layouts/page')
@section('content')

@isset($user)
<form class="card bg-light mb-3" action="{{ route('users.update', $user->id) }}" method="post">
@method('PUT')
@else
<form class="card bg-light mb-3" action="{{ route('users.store') }}" method="post">
@endisset
@csrf

  <div class="card-header border-0 d-flex">
    <h2 class="mb-0 font-weight-normal flex-grow-1">
      @isset($user) Editing user @else Creating user @endisset
    </h2>
  </div>
  <div class="card-body">
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        @isset($user)
        <input type="text" id="name" name="name" class="form-control" required value="{{old('name', $user->name)}}">
        @else
        <input type="text" id="name" name="name" class="form-control" required value="{{old('name')}}">
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        @isset($user)
        <input type="text" id="email" name="email" class="form-control" required value="{{old('email', $user->email)}}">
        @else
        <input type="text" id="email" name="email" class="form-control" required value="{{old('email')}}">
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label for="role" class="col-sm-2 col-form-label">Role</label>
      <div class="col-sm-10">
        @foreach ($roles as $role)
        <div class="form-check form-check-inline">
          @isset($user)
            @if (old('role'))
              <input class="form-check-input" type="radio" name="role" id="role_{{$role->name}}" required value="{{$role->name}}" @if($role->name == old('role')) checked @endif>
            @else
              <input class="form-check-input" type="radio" name="role" id="role_{{$role->name}}" required value="{{$role->name}}" @if(in_array($role->name, $user->roles->pluck('name')->all())) checked @endif>
            @endif
          @else
          <input class="form-check-input" type="radio" name="role" id="role_{{$role->name}}" required value="{{$role->name}}" @if($role->name == old('role')) checked @endif>
          @endisset
          <label class="form-check-label" for="role_{{$role->name}}">{{ucwords($role->name)}}</label>
        </div>
        @endforeach
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <div class="form-row">
          <div class="col">
            <input type="password" name="password" class="form-control" placeholder="Enter new password..." @empty($user) @role('admin') required @endrole @endempty>
          </div>
          <div class="col">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password..." @empty($user) @role('admin') required @endrole @endempty>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="card-footer border-0">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
  </div>
</form>

@isset($user)
<form class="card card-body text-danger d-block bg-light" method="post" action="{{route('users.destroy', $user->id)}}">
  @csrf @method('DELETE')
  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete User</button>
</form>
@endisset

@endsection
