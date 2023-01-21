<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Custom styles for this template-->
    <style>
        .login-block {
            background: #DE6262;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #FFB88C, #DE6262);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            float: left;
            width: 100%;
            padding: 50px 0;
        }

        .banner-sec {
            background: url(https://static.pexels.com/photos/33972/pexels-photo.jpg) no-repeat left bottom;
            background-size: cover;
            min-height: 500px;
            border-radius: 0 10px 10px 0;
            padding: 0;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .carousel-inner {
            border-radius: 0 10px 10px 0;
        }

        .carousel-caption {
            text-align: left;
            left: 5%;
        }

        .login-sec {
            padding: 50px 30px;
            position: relative;
        }

        .login-sec .copy-text {
            position: absolute;
            width: 80%;
            bottom: 20px;
            font-size: 13px;
            text-align: center;
        }

        .login-sec .copy-text i {
            color: #FEB58A;
        }

        .login-sec .copy-text a {
            color: #E36262;
        }

        .login-sec h2 {
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 30px;
            color: #DE6262;
        }

        .login-sec h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FEB58A;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
            margin-left: auto;
            margin-right: auto
        }

        .btn-login {
            background: #DE6262;
            color: #fff;
            font-weight: 600;
        }

        .banner-text {
            width: 70%;
            position: absolute;
            bottom: 40px;
            padding-left: 20px;
        }

        .banner-text h2 {
            color: #fff;
            font-weight: 600;
        }

        .banner-text h2:after {
            content: " ";
            width: 100px;
            height: 5px;
            background: #FFF;
            display: block;
            margin-top: 20px;
            border-radius: 3px;
        }

        .banner-text p {
            color: #fff;
        }
    </style>

</head>

<body>

    <section class="login-block min-vh-100 d-flex align-items-center">
        <div class="container mx-3 mx-md-auto">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Login Now</h2>
                    <form action="{{ route('login') }}" method="POST" class="login-form needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">รหัสลูกค้า</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-uppercase">รหัสผ่าน</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remember_me">
                                <small>Remember Me</small>
                            </label>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                ต้องการ<a href="{{ route('customer.register') }}" class="effect ml-1 mr-1"><span class="text-danger">สมัครสมาชิก</span></a>หรือไม่ ?
                            </div>
                            <button type="submit" class="btn btn-danger" style="border-radius: 5px">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                    <div class="copy-text">
                        <a href="{{ route('customer.home') }}"><i class="fas fa-home" style="color: #E36262"></i> หน้าหลัก</a>
                    </div>
                </div>
                <div class="col-md-8 banner-sec d-none d-md-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active d-flex justify-content-center">
                                <img class="d-block img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="logo" width="480px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('js/utils/validate.js') }}"></script>

</body>

</html>
