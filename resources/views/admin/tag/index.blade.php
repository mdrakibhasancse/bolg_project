@extends('admin.layouts.app')
@section('title','Index')
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
      <h3 class="card-title">Tag List</h3>

      <div class="card-tools">
         <a class="btn btn-primary" href="{{ route('admin.tags.create')}}"><i class="fas fa-plus"></i> Add Tag</a>
      </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Tag Name</th>
                    <th>Tag Slug</th>
                    <th>Tag Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td> @if($tag->status=='active')
                        <a href="{{ url("admin/tags/inactive/$tag->id") }}" onclick="return confirm('Are you sure change status?')" class="btn btn-success btn-sm">
                            Active
                        </a>
                        @else
                        <a href="{{ url("admin/tags/active/$tag->id") }}" onclick="return confirm('Are you sure change status?')" class="btn btn-danger btn-sm">
                            Inactive
                       </a>
                    @endif</td>
                    <td >
                        <a href="{{ route('admin.tags.edit',$tag->id) }}" title="edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        {{-- delete Category --}}
                        <button  onclick="deleteTag({{ $tag->id }})" title="delete" type="submit" class="btn btn-danger  "><i class="fa fa-trash"></i></button>
                        <form id="delete-form-{{ $tag->id }}" action="{{ route('admin.tags.destroy',$tag->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')

                        </form>
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

        function deleteTag(id) {
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
