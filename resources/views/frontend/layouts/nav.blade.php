

    <!-- Subscribe Modal -->
    <div class="subscribe-newsletter-area">
        <div class="modal fade" id="subsModal" tabindex="-1" role="dialog" aria-labelledby="subsModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-body">
                        <h5 class="title">Subscribe to my newsletter</h5>
                        <form action="{{ url('/subscribe')}}" class="newsletterForm" method="post">
                            @csrf
                            <input type="email" name="email" id="subscribesForm2" placeholder="Your e-mail here">
                            <button type="submit" class="btn original-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Breaking News Area -->
                    <div class="col-12 col-sm-8">
                        <div class="breaking-news-area">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a href="#">Hello World!</a></li>
                                    <li><a href="#">Hello Universe!</a></li>
                                    <li><a href="#">Hello Original!</a></li>
                                    <li><a href="#">Hello Earth!</a></li>
                                    <li><a href="#">Hello Colorlib!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Top Social Area -->
                    <div class="col-12 col-sm-4">
                        <div class="top-social-area">
                            @if($setting->instagram)<a target="_blank" href="{{ $setting->instagram }}" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>@endif
                            @if($setting->facebook)<a target="_blank" href="{{ $setting->facebook }}" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>@endif
                            @if($setting->twitter)<a target="_blank" href="{{ $setting->twitter }}" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>@endif
                            @if($setting->reddit)<a target="_blank" href="{{ $setting->reddit }}" data-toggle="tooltip" data-placement="bottom" title="Reddit"><i class="fa fa-reddit" aria-hidden="true"></i></a>@endif
                            @if($setting->email)<a target="_blank" href="{{ $setting->email }}" data-toggle="tooltip" data-placement="bottom" title="Email"><i class="fa fa-envelope" aria-hidden="true"></i></a>@endif
                            @if($setting->linkedin)<a target="_blank" href="{{ $setting->linkedin }}" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Nav Area -->
        <div class="original-nav-area" id="stickyNav">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between">

                        <!-- Subscribe btn -->
                        <div class="subscribe-btn">
                            <a href="#" class="btn subscribe-btn" data-toggle="modal" data-target="#subsModal">Subscribe</a>
                        </div>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu" id="originalNav">
                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{ url('/')}}">Home</a></li>
                                    <li><a href="#">Catagory</a>
                                        <ul class="dropdown">
                                            @foreach ($categories as $category)
                                            <li><a href="{{ url("category/$category->slug")}}">{{ Str::limit($category->name,12)  }}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>

                                    <li><a href="{{ url('/contact') }}">Contact</a></li>

                                    @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Signup</a></li>
                                    @else
                                       @if(Auth::user()->role->id==1)
                                       <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                                       @endif

                                       @if(Auth::user()->role->id==2)
                                       <li><a href="{{ url('/author/dashboard') }}">Dashboard</a></li>
                                       @endif
                                    @endguest
                                </ul>

                                <!-- Search Form  -->
                                <div id="search-wrapper">
                                    <form action="{{ url('/search') }}" method="get">
                                        <input type="text" id="search" name="search" placeholder="Search something...">
                                        <div id="close-icon"></div>
                                        <input class="d-none" type="submit" value="">
                                    </form>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

