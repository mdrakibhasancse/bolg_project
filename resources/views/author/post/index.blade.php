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
      <h3 class="card-title">Post List</h3>

      <div class="card-tools">
         <a class="btn btn-primary" href="{{ route('author.posts.create') }}"><i class="fas fa-plus"></i> Add Post</a>
      </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Post title</th>
                    <th>Post Slug</th>
                    <th>Post Image</th>
                    <th>Is_Approved</th>
                    <th>Post Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td><img width="50" height="50" src="{{asset("/storage/post_images/$post->image")}}" alt=""></td>
                    <td>
                        @if($post->is_approved=='approved')
                            <a href="javascript:void()" class="badge badge-success">
                                Approved
                            </a>
                            @else
                            <a href="javascript:void()" class="badge badge-danger">
                                Pendding
                           </a>
                        @endif
                    </td>

                    <td>
                        @if($post->status=='active')
                            <a href="{{ url("author/posts/inactive/$post->id") }}" onclick="return confirm('Are you sure change status?')" class="badge badge-success">
                                Active
                            </a>
                            @else
                            <a href="{{ url("author/posts/active/$post->id") }}" onclick="return confirm('Are you sure change status?')" class="badge badge-danger">
                                Inactive
                        </a>
                        @endif
                   </td>

                   <td >
                    <a href="{{ route('author.posts.edit',$post->id) }}" title="edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    {{-- delete post --}}
                    <button  onclick="deletePost({{ $post->id }})" title="delete" type="submit" class="btn btn-danger  "><i class="fa fa-trash"></i></button>
                    <form id="delete-form-{{ $post->id }}" action="{{ route('author.posts.destroy',$post->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')

                    </form>

                    <a href="{{ route('author.posts.show',$post->id) }}" title="details" class="btn btn-success"><i class="fas fa-eye"></i></a>
                </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

@endsection

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script>
       $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success ml-2',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>

@endpush
