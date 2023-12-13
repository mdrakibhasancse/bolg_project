@extends('frontend.layouts.app')

@section('title')
   {{ $post->title }}
@endsection
@section('content')


 <!-- ##### Single Blog Area Start ##### -->
 <div class="single-blog-wrapper section-padding-0-100">

    <!-- Single Blog Area  -->
    <div class="single-blog-area blog-style-2 mb-50">
        <div class="single-blog-thumbnail">
            <img style="height: 550px" src="{{asset("storage/post_images/$post->image")}}" alt="">
            <div class="post-tag-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="post-date">
                                <a href="#">{{ date('d', strtotime($post->published_at)) }}<span>{{ date('F', strtotime($post->published_at)) }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- ##### Post Content Area ##### -->
            <div class="col-12 col-lg-9">
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="#" class="post-tag">
                            @foreach ($post->categories as $category)
                            <span style="font-weight: 400" class="badge badge-light">{{ $category->name }}</span>
                            @endforeach
                        </a>
                        <h4><a href="javascript:void()" class="post-headline mb-0">{{ $post->title }}</a></h4>
                        <div class="post-meta mb-50">
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

                        </div>
                        <p>{!! html_entity_decode($post->description,300) !!}</p>
                    </div>
                </div>

                <!-- About Author -->
                <div class="blog-post-author mt-100 d-flex">
                    <div class="author-thumbnail">
                        <img src="{{(!empty($post->user->image)) ? asset("storage/user_images/".$post->user->image) : asset('/upload/extra.jpg')}}" alt="Image">
                    </div>
                    <div class="author-info">
                        <div class="line"></div>
                        <span class="author-role">{{ $post->user->role->name }}</span>
                        <h4><a href="#" class="author-name">{{ $post->user->name }}</a></h4>
                        <p>{{ $post->user->description }}</p>
                    </div>
                </div>

                     <!-- Comment Area Start -->
                <div class="comment_area clearfix mt-70">

                  {{-- total comment start--}}
                  <?php
                  $total_comment = $post->comments->count();
                  ?>
                  @foreach($post->comments as $c)
                  <?php
                  $total_comment += $c->replies->count();
                  ?>
                  @endforeach

                  <h4 class="title">Comments({{ $total_comment }})</h4>

                  {{-- total comment end--}}

                    @if($post->comments->count() > 0)
                    <ol>
                        @foreach($post->comments as $comment)
                        <!-- Single Comment Area -->
                        <li class="single_comment_area">
                            <!-- Comment Content -->


                            <div class="comment-content d-flex">
                                <!-- Comment Author -->
                                <div class="comment-author">
                                    <img src="{{(!empty($comment->user->image)) ? asset("storage/user_images/".$comment->user->image) : asset('/upload/extra.jpg')}}" alt="Image">
                                </div>
                                <!-- Comment Meta -->
                                <div class="comment-meta">
                                    <a href="#" class="post-date">{{ $comment->created_at->diffForHumans() }}</a>
                                    <p><a href="#" class="post-author">{{ $comment->user->name }}</a></p>
                                    <p>{{ $comment->comment }}</p>


                                    <a href="javascript:void(0);" onclick="showReplyForm({{ $comment->id }});"  class="comment-reply">Reply</a>
                                    <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ url("/comment_reply/$comment->id") }}" style="display: none;">
                                        @csrf

                                            <textarea
                                              cols="60"
                                              rows="2"
                                              class="form-control mb-10"
                                              name="message"
                                              placeholder="Messege"
                                              onfocus="this.placeholder = ''"
                                              onblur="this.placeholder = 'Messege'"
                                              required=""
                                            ></textarea>

                                          <button type="submit" class="btn btn-style mt-2" style="">Reply</button>
                                    </form>

                                </div>
                            </div>






                            <ol class="children">
                                @foreach ($comment->replies as $comment_reply)
                                <li class="single_comment_area">
                                    <!-- Comment Content -->

                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->

                                        <div class="comment-author">
                                            <img src="{{(!empty($comment_reply->user->image)) ? asset("storage/user_images/".$comment_reply->user->image) : asset('/upload/extra.jpg')}}" alt="Image">
                                        </div>

                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="post-date">{{ $comment_reply->created_at->diffForHumans() }}</a>
                                            <p><a href="#" class="post-author">{{ $comment_reply->user->name }}</a></p>
                                            <p>{{ $comment_reply->message }}</p>

                                               <a href="javascript:void(0);" onclick="showReplyForm({{ $comment->id }});"  class="comment-reply">Reply</a>
                                                <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ url("/comment_reply/$comment->id") }}" style="display: none;">
                                                @csrf

                                                    <textarea
                                                    cols="60"
                                                    rows="2"
                                                    class="form-control mb-10"
                                                    name="message"
                                                    placeholder="Messege"
                                                    onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = 'Messege'"
                                                    required=""
                                                    ></textarea>

                                                <button type="submit" class="btn btn-style mt-2" style="">Reply</button>
                                            </form>

                                        </div>
                                    </div>

                                </li>
                                @endforeach
                            </ol>


                        </li>
                        @endforeach


                    </ol>

                    @else
                     <div class="card ">
                        <div class="card-body">
                            <div class="comment-meta">
                                <p>No Comment yet.</p>
                            </div>
                        </div>
                     </div>
                    @endif

                </div>




                <!-- Post Comment  -->
                <div class="post-a-comment-area mt-70">
                    <h5>Post Comment</h5>
                    @guest
                      <div class="card">
                        <div class="card-body">
                            <p>
                                For a post comment , you need to login first?
                                <a class="" href="{{ route('login') }}">Login</a>
                            </p>

                        </div>
                      </div>
                    @else
                    <form action="{{ url("/comment/$post->id") }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="group">
                                    <textarea name="comment" id="message"  required></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Comment</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn original-btn">Post Comment</button>
                            </div>
                        </div>
                    </form>
                    @endguest
                </div>


            </div>

            <!-- ##### Sidebar Area ##### -->
            <div class="col-12 col-md-4 col-lg-3">
                <div class="post-sidebar-area">

                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Latest Posts</h5>

                        <div class="widget-content">
                            @foreach ($latest_posts as $post)

                            <!-- Single Blog Post -->
                            <div class="single-blog-post d-flex align-items-center widget-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                   <a href="{{ url("single_post/$post->slug") }}"> <img style="height: 70px; width:80px" src="{{asset("storage/post_images/$post->image")}}" alt=""></a>
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
                                <li><a href="#">{{ $tag->name }}</a></li>
                              @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Single Blog Area End ##### -->


@endsection


@push('scripts')
  <script>
    function showReplyForm(commentId) {
    var x = document.getElementById(`reply-form-${commentId}`);
    var input = document.getElementById(`reply-form-${commentId}-text`);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
  </script>
@endpush
