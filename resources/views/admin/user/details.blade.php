@extends('admin.layouts.app')
@section('title','Index')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>User</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">User</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a class="btn btn-info" href="{{ route('admin.users.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
        </h3>

    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
                <tr>
                    <th style="width: 200px">Name</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Email</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Role</th>
                    <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                    <th style="width: 200px">Image</th>
                    <td><img width="150" height="150" src="{{(!empty($user->image)) ? asset("storage/user_images/".$user->image) : asset('/upload/extra.jpg')}}" alt=""></td>
                </tr>

                <tr>
                    <th style="width: 200px">Post Count</th>
                    <td>{{ $user->posts->count() }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Favorite_Post Count</th>
                    <td>{{ $user->favorite_to_posts->count() }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Comment Count</th>
                    <td>{{ $user->comments->count() }}</td>
                </tr>

                <tr>
                    <th style="width: 200px">Description</th>
                    <td>{{ $user->description }}</td>
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

