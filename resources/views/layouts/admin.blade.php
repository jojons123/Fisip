<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">
    <!-- Twitter meta-->
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    @yield('css')
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
@include('includes.admin.header')
<!-- Sidebar menu-->
@include('includes.admin.sidebar')
<main class="app-content">
    @yield('content')
</main>
<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin_asset/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin_asset/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_asset/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_asset/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('admin_asset/js/plugins/pace.min.js') }}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/chart.js') }}"></script>


<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>
    function logout() {
        $('#logout-form').submit();
    }
</script>
@yield('js')

{{--<!-- Google analytics script-->--}}
{{--<script type="text/javascript">--}}
{{--if(document.location.hostname == 'pratikborsadiya.in') {--}}
{{--(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
{{--(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
{{--m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
{{--})(window,document,'script','//www.google-analytics.com/analytics.js','ga');--}}
{{--ga('create', 'UA-72504830-1', 'auto');--}}
{{--ga('send', 'pageview');--}}
{{--}--}}
{{--</script>--}}
</body>
</html>