@extends('admin.layouts.app')
@section('title','Index')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1> Profile</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{(!empty(Auth::user()->image)) ? asset("storage/user_images/".Auth::user()->image) : asset('/upload/extra.jpg')}}" alt="profile picture">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="float-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Update Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change Password</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">

                <div class="tab-pane active" id="settings">
                  <form class="form-horizontal" action="{{ url('admin/profiles/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" value="{{ Auth::user()->name }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail" value="{{ Auth::user()->email }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="inputExperience">{{ Auth::user()->description }}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Profile Image</label>
                      <div class="col-sm-4">
                        <input type="file" id="image" name="image">
                      </div>
                      <div class="col-sm-4">
                        <img width="50" height="50" id="showImage" src="{{(!empty(Auth::user()->image)) ? asset("storage/user_images/".Auth::user()->image) : asset('/upload/extra.jpg')}}" alt="">
                     </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->

                   <!-- /.tab-pane -->
                   <div class="tab-pane" id="timeline">
                    <form class="form-horizontal" action="{{ url('admin/update/password')}}" method="post" >
                        @csrf
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="old_password" class="form-control" id="inputEmail" placeholder="Enter Old Password">
                        </div>

                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                              <input type="password" name="password" class="form-control" id="inputEmail" placeholder="Enter New Password">
                        </div>

                        </div>

                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                              <input type="password" name="password_confirmation" class="form-control" id="inputEmail" placeholder="Enter Again New Password">
                          </div>
                            {{-- @error('email')
                            <p style="color: red">{{ $message }}</p>
                            @enderror --}}
                          </div>

                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-success">Update</button>
                          </div>
                        </div>
                      </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
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
