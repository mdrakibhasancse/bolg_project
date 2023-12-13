@extends('admin.layouts.app')
@section('title','Index')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Contact</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Contact List</h3>

    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ Str::limit($contact->message,50) }}</td>

                    <td >
                        <button  onclick="deleteContact({{ $contact->id }})" title="delete" type="submit" class="btn btn-danger  "><i class="fa fa-trash"></i></button>
                        <form id="delete-form-{{ $contact->id }}" action="{{ url("/admin/contact/$contact->id") }}" method="post">
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


        function deleteContact(id) {
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


