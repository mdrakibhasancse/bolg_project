@extends('admin.layouts.app')
@section('title','Edit')
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
      <h3 class="card-title">Category Edit</h3>

      <div class="card-tools">
         <a class="btn btn-success" href="{{ route('admin.categories.index')}}"><i class="fas fa-list"></i> Category List</a>
      </div>
    </div>

      <div class="card-body">
        <form action="{{ route('admin.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}">
                @error('name')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


        <div class="form-group">
            <label for="name">Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $category->status=='active'? 'checked' : ' '}}>
                <label class="form-check-label" for="active">
                  Active
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $category->status=='inactive'? 'checked' : ' '}}>
                <label class="form-check-label" for="inactive">
                  Inactive
                </label>
            </div>
            @error('status')
            <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="name">Category Image</label>
                    <input type="file"  id="image" name="image" id="image">
                    @error('image')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                   <img width="100" height="150" id="showImage" src="{{asset("storage/category_images/$category->image")}}" alt="">
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
@push('scripts')

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
