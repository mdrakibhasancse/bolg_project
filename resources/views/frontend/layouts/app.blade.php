<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset("/img/core-img/favicon.ico")}}">

    <link rel="stylesheet" href="{{asset("frontend/css/animate.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/classy-nav.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/owl.carousel.css")}}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset("frontend/style.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/custom.css")}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')

</head>

<body>

    @include('frontend.layouts.nav')


    @yield('content')
    <hr>


    @include('frontend.layouts.footer')

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset("/frontend/js/jquery/jquery-2.2.4.min.js")}}"></script>
    <!-- Popper js -->
    <script src="{{asset("/frontend/js/popper.min.js")}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset("/frontend/js/bootstrap.min.js")}}"></script>
    <!-- Plugins js -->
    <script src="{{asset("/frontend/js/plugins.js")}}"></script>
    <!-- Active js -->
    <script src="{{asset("/frontend/js/active.js")}}"></script>

    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
         @if($errors->any())
            @foreach ($errors->all() as $error)
               toastr.error('{{$error}}','Error',{
                closeButton:true,
                progressBar:true,
              });
            @endforeach
         @endif
    </script>
@stack('scripts')
</body>

</html>
