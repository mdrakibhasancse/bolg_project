@extends('admin.layouts.app')
@section('title','Create')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Post</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Post</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Post Create</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('admin.posts.index')}}"><i class="fas fa-list"></i> Post List</a>
      </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" placeholder="Post Title">
                @error('title')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Post Category</label><br>
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}">
                    <label class="form-check-label" for="{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
                @error('categories')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


            <div class="form-group">
                <label>Post Tag</label><br>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->id }}">
                    <label class="form-check-label" for="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
                @endforeach
                @error('tags')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>



            <div class="form-group">
                <label for="description">Post Description</label>
                <textarea name="description"  value="{{ old('description') }}" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Post Description">{{ old('name') }}</textarea>
                @error('description')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


            <div class="form-group">
                <label for="name">Post Status</label><br>
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
            </div>

            <div class="form-group">
                <label for="name">Post Image</label>
                <input type="file"  id="image" name="image">
                @error('image')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

        </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

        </form>
  </div>

@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $('#description').summernote({
      placeholder: 'Description',
      height: 150
    });
  </script>
@endpush
