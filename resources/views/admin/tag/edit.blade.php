@extends('admin.layouts.app')
@section('title','Edit')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Tag</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Tag</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tag Edit</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('admin.tags.index')}}"><i class="fas fa-list"></i>Tag List</a>
      </div>
    </div>

      <div class="card-body">
        <form action="{{ route('admin.tags.update',$tag->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $tag->name }}">
                @error('name')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


        <div class="form-group">
            <label for="name">Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $tag->status=='active'? 'checked' : ' '}}>
                <label class="form-check-label" for="active">
                  Active
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $tag->status=='inactive'? 'checked' : ' '}}>
                <label class="form-check-label" for="inactive">
                  Inactive
                </label>
            </div>
            @error('status')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
      </div>

        <div class="card-footer">
             <button type="submit" class="btn btn-primary">Update</button>
        </div>

        </form>
  </div>

@endsection
