@extends('admin.layouts.app')
@section('title','Admin')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Subscribe</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Subscribe</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Subscribe</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($subscribes as $subscribe)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subscribe->email }}</td>

                    <td >
                        {{-- delete post --}}
                        <button  onclick="deleteSubscrive({{ $subscribe->id }})" title="delete" type="submit" class="btn btn-danger  "><i class="fa fa-trash"></i></button>
                        <form id="delete-form-{{ $subscribe->id }}" action="{{ route('admin.subscribes.destroy',$subscribe->id) }}" method="post">
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
       $(document).ready( function () {
            $('#myTable').DataTable();
        } );


        function deleteSubscrive(id) {
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

