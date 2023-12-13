  <!-- ##### Footer Area Start ##### -->
  <footer class="footer-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Footer Nav Area -->
                <div class="classy-nav-container breakpoint-off">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-center">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="javascript:void()">Lifestyle</a></li>
                                    <li><a href="javascript:void()">travel</a></li>
                                    <li><a href="javascript:void()">Music</a></li>
                                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>

                <!-- Footer Social Area -->
                <div class="footer-social-area mt-30">
                    @if($setting->instagram)<a target="_blank" href="{{ $setting->instagram }}" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>@endif
                    @if($setting->facebook)<a target="_blank" href="{{ $setting->facebook }}" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>@endif
                    @if($setting->twitter)<a target="_blank" href="{{ $setting->twitter }}" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>@endif
                    @if($setting->reddit)<a target="_blank" href="{{ $setting->reddit }}" data-toggle="tooltip" data-placement="top" title="Reddit"><i class="fa fa-reddit" aria-hidden="true"></i></a>@endif
                    @if($setting->email)<a target="_blank" href="{{ $setting->email }}" data-toggle="tooltip" data-placement="top" title="Email"><i class="fa fa-envelope" aria-hidden="true"></i></a>@endif
                    @if($setting->linkedin)<a target="_blank" href="{{ $setting->linkedin }}" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>@endif
                </div>
            </div>
        </div>
    </div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
 Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

</footer>
<!-- ##### Footer Area End ##### -->
