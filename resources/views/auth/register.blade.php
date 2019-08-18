<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="">

    <title>Register</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    @toastr_css
    <style>
        .login-box {
            height: 100%;
        }

        .login-form {
            height: 100%;
        }

        .login-content .login-box .login-form, .login-content .login-box .forget-form {
            margin-left: 10%;
            margin-right: 10%;
            position: relative;
        }
    </style>
</head>
<body class="">

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>{{ env('APP_NAME') }}</h1>
    </div>
    <div class="login-box col-md-12">
        <form class="login-form" method="POST" action="{{ route('register') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Register</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nama</label>
                        <input class="form-control" type="text" placeholder="Nama" autofocus name="name"
                               value="{{ \Request::old('nama') }}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nomor Handphone</label>
                        <input class="form-control" type="text" placeholder="Nomor Handphone" autofocus name="no_hp">
                    </div>
                    <div class="form-group">
                        <label class="control-label">NIM</label>
                        <input class="form-control" type="text" placeholder="Nim" autofocus name="nim">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="text" placeholder="Email" autofocus name="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input class="form-control" type="password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nama Universitas</label>
                        <input class="form-control" type="text" placeholder="Universitas" autofocus name="universitas">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fakultas</label>
                        <input class="form-control" type="text" placeholder="Fakultas" autofocus name="fakultas">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Program Studi</label>
                        <input class="form-control" type="text" placeholder="Program Studi" autofocus name="prodi">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semester</label>
                        <input class="form-control" type="number" placeholder="Semester" name="semester">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <input class="form-control" type="text" placeholder="Alamat" name="alamat">
                    </div>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Register</button>
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
</body>
</html>