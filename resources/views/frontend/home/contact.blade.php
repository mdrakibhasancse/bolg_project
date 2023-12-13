@extends('frontend.layouts.app')

@section('title','Contact')


@section('content')

  <!-- ##### Breadcumb Area Start ##### -->
  <div class="breadcumb-area bg-img" style="background-image: url({{asset("/frontend/img/bg-img/b1.jpg")}})">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-content text-center">
                    <h2>Contact</h2>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- ##### Contact Area Start ##### -->
 <section class="contact-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-12 col-md-10 col-lg-9">
                <div class="contact-form">
                    <h5>Get in Touch</h5>
                    <!-- Contact Form -->
                    <form action="{{ url('/contact')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="name" id="name" value="{{ old('name')}}" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="email" name="email" id="email" value="{{ old('email')}}" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Email</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="number" name="mobile" value="{{ old('mobile')}}" id="mobile" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Mobile</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="subject" value="{{ old('subject')}}" id="subject" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <textarea name="message" id="message" required>{{ old('message')}}</textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn original-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-3">
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
                        <div class="widget-content social-widget d-flex justify-content-between">
                            @if($setting->instagram)<a target="_blank" href="{{ $setting->instagram }}"  title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>@endif
                            @if($setting->facebook)<a target="_blank" href="{{ $setting->facebook }}"  title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>@endif
                            @if($setting->twitter)<a target="_blank" href="{{ $setting->twitter }}"  title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>@endif
                            @if($setting->reddit)<a target="_blank" href="{{ $setting->reddit }}" title="Reddit"><i class="fa fa-reddit" aria-hidden="true"></i></a>@endif
                            @if($setting->email)<a target="_blank" href="{{ $setting->email }}"  title="Email"><i class="fa fa-envelope" aria-hidden="true"></i></a>@endif
                            @if($setting->linkedin)<a target="_blank" href="{{ $setting->linkedin }}"  title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>@endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->



@endsection





