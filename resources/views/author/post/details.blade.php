@extends('admin.layouts.app')
@section('title','Index')
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
        <h3 class="card-title">Post Details</h3>

        <div class="card-tools">
           <a class="btn btn-success" href="{{ route('author.posts.index')}}"><i class="fas fa-list"></i> Post List</a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
              <h3>Post Id : {{ $post->id }}</h3>
                <tr>
                    <th style="width: 200px">Post title</th>
                    <td>{{ $post->title }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Post Image</th>
                    <td><img width="150" height="150" src="{{asset("/storage/post_images/$post->image")}}" alt=""></td>
                 </tr>

                <tr>
                    <th style="width: 200px">Post Slug</th>
                    <td>{{ $post->slug }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Post Author</th>
                    <td>{{ $post->user->name }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Post Tag</th>
                    <td>
                        @foreach ($post->tags as $tag)
                         <span class="badge badge-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                </tr>


                <tr>
                    <th style="width: 200px">Post Category</th>
                    <td>
                        @foreach ($post->categories as $category)
                        <span class="badge badge-primary">{{ $category->name }}</span>
                        @endforeach
                    </td>
                </tr>



                <tr>
                    <th style="width: 200px">Post Description</th>
                    <td>{!! $post->description !!}</td>
                </tr>

        </table>
    </div>
  </div>

@endsection

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script>
       $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush
