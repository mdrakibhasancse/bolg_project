@extends('admin.layouts.app')
@section('title','Index')
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
        <h3 class="card-title">
            <a class="btn btn-info" href="{{ route('admin.posts.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
        </h3>

        <div class="card-tools">
           @if($post->is_approved=='pending')
           <button type="submit" class="btn btn-success" onclick="approvalPost({{ $post->id}})"> <i class="fas fa-check"></i> Approved</button>

           <form id="approval-form" action="{{ url("admin/approve/post/$post->id") }}" method="post" style="dispaly:none">
            @csrf

          </form>

           @else
           <button type="button" class="btn btn-success" disabled> <i class="fas fa-check"></i> Approved</button>
           @endif
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
                    <th style="width: 200px">Post Author</th>
                    <td>{{ $post->user->name }}</td>
                </tr>
                <tr>
                    <th style="width: 200px">Post Image</th>
                    <td><img width="150" height="150" src="{{asset("storage/post_images/$post->image")}}" alt=""></td>
                 </tr>

                <tr>
                    <th style="width: 200px">Post Slug</th>
                    <td>{{ $post->slug }}</td>
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        function approvalPost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approved this post!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approved it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success ml-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'This post remain pending :)',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush

