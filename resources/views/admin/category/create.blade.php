@extends('admin.layouts.app')
@section('title','Create')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Category</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Category Create</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('admin.categories.index')}}"><i class="fas fa-list"></i> Category List</a>
      </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Category Name">
                @error('name')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active" value="active">
                    <label class="form-check-label" for="active">
                      Active
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                    <label class="form-check-label" for="inactive">
                      Inactive
                    </label>
                </div>
                @error('status')
                <p style="color: red">{{ $message }}</p>
                @enderror
                <p></p>
                <div class="form-group">
                    <label for="name">Category Image</label>
                    <input type="file"  id="image" name="image">
                    @error('image')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

        </form>
  </div>

@endsection
