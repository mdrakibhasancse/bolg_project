@extends('admin.layouts.app')
@section('title','Admin')
@section('top-content')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>DashBoard</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">DashBoard</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $posts->count() }}</h3>

                    <p>Total Post</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ Auth::user()->favorite_to_posts()->count() }}</h3>

                    <p>Total Favorite Post</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('/admin/favorite/post') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
                     <!-- small box -->
                     <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $pending_post }}</h3>

                            <p>Total Pending Post</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('/admin/pending') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>

            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $user_count }}</h3>

                      <p>User Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                      Popular Post
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                          <tr>
                              <th>SL</th>
                              <th>Post title</th>
                              <th>Favorite</th>
                              <th>Comment</th>
                              <th>Is_Approved</th>
                              <th>Status</th>
                          </tr>
                        </tr>
                        @foreach ($popular_posts as $post)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $post->title }}</td>
                              <td>{{ $post->favorite_to_users->count() }}</td>
                              <td>{{ $post->comments->count() }}</td>
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
                                      <a href="javascript:void()" class="badge badge-success">
                                          Active
                                      </a>
                                      @else
                                      <a href="javascript:void()" class="badge badge-danger">
                                          Inactive
                                  </a>
                                  @endif
                             </td>
                          </tr>
                        @endforeach
                     </table>
                </div><!-- /.card-body -->
              </div>
            </section>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
