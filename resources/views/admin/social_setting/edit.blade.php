@extends('admin.layouts.app')
@section('title','Edit')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Setting</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Setting</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Setting Edit</h3>
    </div>

    <div class="card-body">
        <form action="{{ url('admin/setting')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Site Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $setting->name }}">
                @error('name')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>


            <div class="row">
                <div class="form-group col-6">
                    <label for="facebook">Facebook</label>
                    <input type="facebook" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ $setting->facebook }}">
                </div>

                <div class="form-group col-6">
                    <label for="instagram">instagram</label>
                    <input type="instagram" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ $setting->instagram }}">
                </div>

                <div class="form-group col-6">
                    <label for="linkedin">Linkedin</label>
                    <input type="linkedin" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{ $setting->linkedin }}">
                </div>

                <div class="form-group col-6">
                    <label for="twitter">Twitter</label>
                    <input type="twitter" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{ $setting->twitter }}">
                </div>

                <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $setting->email }}">
                </div>


                <div class="form-group col-6">
                    <label for="reddit">Reddit</label>
                    <input type="reddit" class="form-control @error('reddit') is-invalid @enderror" id="reddit" name="reddit" value="{{ $setting->reddi }}">
                </div>


                <div class="form-group col-6">
                    <label for="copyright">Copy Right</label>
                    <input type="copyright" class="form-control @error('copyright') is-invalid @enderror" id="copyright" name="copyright" value="{{ $setting->copyright }}">
                    @error('copyright')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

        </form>
  </div>

@endsection

