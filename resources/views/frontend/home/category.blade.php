@extends('frontend.layouts.app')

@section('title','Category')

@section('content')
  <!-- ##### Cool Facts Area Start ##### -->
  <div class="cool-facts-area section-padding-100-0 bg-img background-overlay" style="background-image: url({{asset("storage/category_images/$category->image")}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-blog-area blog-style-2 text-center mb-100">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                       <a href="javascript:void()" class="post-tag">{{ $category->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Cool Facts Area End ##### -->

<!-- ##### Blog Wrapper Start ##### -->
<div class="blog-wrapper section-padding-100-0 clearfix">
    <div class="container">
        <div class="row">
            <!-- Single Blog Area  -->

            @if($posts->count()>0)

            @foreach ($posts as $post)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area blog-style-2 mb-100">
                    <div class="single-blog-thumbnail">
                        <img style="height: 300px; width:300px" src="{{asset("storage/post_images/$post->image")}}" alt="">
                        <div class="post-date">
                            <a href="#">{{ date('d', strtotime($post->published_at)) }} <span>{{ date('F', strtotime($post->published_at)) }}</span></a>
                        </div>
                    </div>
                    <!-- Blog Content -->
                    <div class="single-blog-content mt-50">
                        <div class="line"></div>
                        <h4><a href="#" class="post-headline">{{ $post->title }}</a></h4>
                        <p>{!! Str::limit($post->description,300) !!}</p>

                        <div class="post-meta">
                            <p>By <a href="#">{{ $post->user->name }}</a></p>
                            <p>comments</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area blog-style-2 mb-100">

                    <h4 class="text-danger"> Sorry, post not found</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- ##### Blog Wrapper End ##### -->



@endsection



