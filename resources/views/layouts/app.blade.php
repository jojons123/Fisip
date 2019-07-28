<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" href="https://unej.ac.id/wp-content/uploads/2017/10/cropped-Logo-Unej-Bakucompress-32x32.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @toastr_css
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">--}}
    @yield('css')
</head>

<body>
<!--::header part start::-->
@include('includes.header')
<!-- Header part end-->

<!-- banner part start-->
@yield('content')
<!-- banner part start-->

<!-- footer part start-->
@include('includes.footer')
<!-- footer part end-->

<!-- jquery plugins here-->
<!-- jquery -->
<script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- easing js -->
<script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
<!-- swiper js -->
<script src="{{ asset('js/swiper.min.js') }}"></script>
<!-- swiper js -->
<script src="{{ asset('js/masonry.pkgd.js') }}"></script>
<!-- particles js -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<!-- swiper js -->
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('js/custom.js') }}"></script>
@toastr_js
@toastr_render
<script>
    toastr.options = {
        "preventDuplicates": true
    }
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>--}}
@yield('js')
</body>

</html>