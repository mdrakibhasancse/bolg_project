@extends('admin.layouts.app')
@section('title','Edit')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>User</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">User</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">User Edit</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('admin.users.index')}}"><i class="fas fa-list"></i> User List</a>
      </div>
    </div>


      <div class="card-body">
        <form action="{{ route('admin.users.update',$user->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Name</label>
                </div>
                <div class="col-12 col-md-9">
                    <p class="form-control-static">{{$user->name}}</p>
                </div>
            </div>


            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Role</label>
                </div>
                <div class="col col-md-9">
                    <div class="form-check">
                        @foreach ($roles as $role)
                        <div class="radio">
                            <label for="radio1" class="form-check-label ">
                                <input type="radio"  name="role" value="{{$role->id}}"
                                    class="form-check-input" {{$user->role->id == $role->id ? 'checked' : "" }}>{{$role->name}}
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
             <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>


 </div>
@endsection
