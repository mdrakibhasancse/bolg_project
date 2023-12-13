@extends('admin.layouts.app')
@section('title','Comment')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Comment</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Comment</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
        <h3 class="card-title">Comment List</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th class="text-center">Comments Info</th>
                    <th class="text-center">Post Info</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)

                      @foreach ($post->comments as $comment)

                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="javascript:void()">
                                            <img class="media-object" src="{{(!empty($comment->user->image)) ? asset("storage/user_images/".$comment->user->image) : asset('/upload/extra.jpg')}}" width="64" height="64">
                                        </a>
                                    </div>
                                    <div class="media-body ml-2">
                                        <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small>
                                        </h4>
                                        <p>{{ $comment->comment }}</p>
                                        <a target="_blank" href="{{ url('/single_post',$comment->post->slug) }}">Reply</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="media">
                                    <div class="media-right">
                                        <a target="_blank" href="{{ url('/single_post',$comment->post->slug) }}">
                                            <img class="media-object" src="{{(!empty($comment->post->image)) ? asset("storage/post_images/".$comment->post->image) : asset('/upload/extra.jpg')}}" width="64" height="64">
                                        </a>
                                    </div>
                                    <div class="media-body  ml-2">
                                        <a target="_blank" href="{{ url('/single_post',$comment->post->slug) }}">
                                            <h4 class="media-heading">{{ (Str::limit($comment->post->title,30)) }}</h4>
                                        </a>
                                        <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                    <i class="material-icons">delete</i>
                                </button>
                                <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ url("author/comment/$comment->id") }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                      @endforeach
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
       $(document).ready( function () {
            $('#myTable').DataTable();
        } );


        function deleteComment(id) {
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


