@extends('admin.layouts.app')
@section('title','Create')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Post</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Post</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Post Edit</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('author.posts.index')}}"><i class="fas fa-list"></i> Post List</a>
      </div>
    </div>

    <div class="card-body">
        <form action="{{ route('author.posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $post->title }}">
                @error('title')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Post Category</label> <br>
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="{{ $category->id }}"
                    {{ in_array($category->id,$post->categories()->pluck('category_id')->toArray()) ? 'checked': " "}}>
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
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->id }}"
                    {{ in_array($tag->id,$post->tags()->pluck('tag_id')->toArray()) ? 'checked': " "}}>
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
                <textarea name="description" class="form-control" id="description">{{ $post->description }}</textarea>
                @error('description')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>



            <div class="form-group">
                <label for="name">Post Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $post->status=='active'? 'checked' : ' '}}>
                    <label class="form-check-label" for="active">
                      Active
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $post->status=='inactive'? 'checked' : ' '}}>
                    <label class="form-check-label" for="inactive">
                      Inactive
                    </label>
                </div>
                @error('status')
                <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="name">Post Image</label>
                    <input type="file"  id="image" name="image" id="image">
                    @error('image')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                   <img width="100" height="150" id="showImage" src="{{asset("storage/post_images/$post->image")}}" alt="">
                </div>
            </div>

        </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

        </form>
  </div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $('#description').summernote({
      placeholder: 'Description',
      height: 150
    });
  </script>

<script>
  $(document).ready(function() {
     $('#image').change(function(e){
        var reader = new FileReader();
         reader.onload=function(e){
            $('#showImage').attr('src',e.target.result);
         }
         reader.readAsDataURL(e.target.files['0']);
     });
  });
</script>

@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

