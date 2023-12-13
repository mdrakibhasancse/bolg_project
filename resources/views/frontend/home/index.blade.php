@extends('frontend.layouts.app')

@section('title','Blog')


@section('content')



    <!-- ##### Hero Area Start ##### -->
    <div class="hero-area">
        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
            <!-- Single Slide -->
            @foreach ($slider_posts as $post)

            <div class="single-hero-slide bg-img" style="background-image: url({{asset("storage/post_images/$post->image")}})">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="slide-content text-center">
                                <h2 data-animation="fadeInUp" data-delay="250ms"><a href="{{ url("single_post/$post->slug") }}">{{ $post->title }}</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Blog Wrapper Start ##### -->
    <div class="blog-wrapper section-padding-100 clearfix">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">

                   @foreach ($posts as $post)
                    <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="single-blog-thumbnail">
                                  <a style="cursor: pointer" href="{{ url("single_post/$post->slug") }}"><img style="height: 255px;" src="{{asset("storage/post_images/$post->image")}}" alt=""></a>
                                    <div class="post-date">
                                        <a href="#">{{ date('d', strtotime($post->published_at)) }} <span>{{ date('F', strtotime($post->published_at)) }}</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                            <!-- Blog Content -->
                                <div class="single-blog-content">
                                    <div class="line"></div>

                                    <h4><a href="{{ url("single_post/$post->slug") }}" class="post-headline">{{ $post->title }}</a></h4>
                                    <p>{!! html_entity_decode(Str::limit($post->description,300)) !!}</p>

                                    <div class="post-meta">
                                        <p>By <a href="#">{{ $post->user->name }}</a></p>
                                         {{-- total comment start--}}
                                        <?php
                                          $total_comment = $post->comments->count();
                                        ?>
                                        @foreach($post->comments as $c)
                                       <?php
                                          $total_comment += $c->replies->count();
                                        ?>
                                        @endforeach

                                       <p>{{ $total_comment }}  comments</p>

                                    {{-- total comment end--}}
                                        <p>
                                            @guest

                                            <a href="javascript:void()" onclick="toastr.info('To add favorite list, you need login first.','info',{
                                                closeButton: true,
                                                progressBar: true,
                                            })">
                                            (<i class="fa fa-heart"></i> favarites_post- {{ $post->favorite_to_users->count() }})
                                            </a>

                                            @else

                                            <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();">
                                            (<i class="fa fa-heart {{ !Auth::user()->favorite_to_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"></i>
                                            favarites_post- {{ $post->favorite_to_users->count() }})
                                            </a>

                                             <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ url("/favorite/add/$post->id") }}" style="display: none;">
                                                 @csrf
                                             </form>

                                            @endguest


                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach

                    <!-- Load More -->
                    <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
                       {{ $posts->links() }}
                    </div>
                </div>

                <!-- ##### Sidebar Area ##### -->
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="post-sidebar-area">
                       <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title subscribe-title">Subscribe to my newsletter</h5>
                            <div class="widget-content">
                                <form action="{{ url('/subscribe') }}" class="newsletterForm" method="post">
                                    @csrf
                                    <input type="email" name="email" id="subscribesForm" placeholder="Your e-mail here">
                                    <button type="submit" class="btn original-btn">Subscribe</button>
                                </form>
                            </div>
                        </div>


                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Latest Posts</h5>

                            <div class="widget-content">

                                @foreach ($latest_posts as $post)

                                <!-- Single Blog Post -->
                                <div class="single-blog-post d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="{{ url("single_post/$post->slug") }}"><img style="height: 70px; width:80px" src="{{asset("storage/post_images/$post->image")}}" alt=""></a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <h4><a href="{{ url("single_post/$post->slug") }}" class="post-headline">{{ $post->title }}</a></h4>
                                        <div class="post-meta">
                                            <p><a href="#">{{ date('d', strtotime($post->published_at)) }} {{ date('F', strtotime($post->published_at)) }}</a></p>
                                        </div>
                                    </div>
                                </div>


                                @endforeach

                            </div>
                        </div>

                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Tags</h5>
                            <div class="widget-content">
                                <ul class="tags">
                                    @foreach ($tags as $tag)
                                      <li><a href="{{ url("/tag/$tag->slug")}}">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Wrapper End ##### -->

@endsection





