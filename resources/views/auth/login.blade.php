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
<body class="">

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>{{ env('APP_NAME') }}</h1>
    </div>
    <div class="login-box">
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="text" placeholder="Email" autofocus name="email">
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" type="password" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> <span class="label-text">Stay Signed in</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
    </div>
</section>
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