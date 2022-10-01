<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>สมัครสมาชิก</title>
    <!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{!! asset('assets/img/logo.png') !!}">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/customer.css') }}" rel="stylesheet">

</head>


<body>
    <section class="login-block vh-100 d-flex align-items-center">
        <div class="container">
            <div class="card-body">
                <h2>สมัครสมาชิก</h2>
                <form class="needs-validation form-add-user" method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="text-danger">*</label><label for="first_name">ชื่อ</label>
                                <input
                                    type="text"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name"
                                    name="first_name"
                                    placeholder="ระบุชื่อ"
                                    value="{{ old('first_name') }}"
                                    required
                                >

                                @error('first_name')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="text-danger">*</label><label for="last_name">นามสกุล</label>
                                <input
                                    type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name"
                                    name="last_name"
                                    placeholder="ระบุนามสกุล"
                                    value="{{ old('last_name') }}"
                                    required
                                >

                                @error('last_name')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="tel">เบอร์โทร</label>
                            <input
                                type="text"
                                class="form-control @error('tel') is-invalid @enderror"
                                id="tel"
                                name="tel"
                                placeholder="เบอร์โทร"
                                value="{{ old('tel') }}"
                                required
                            >

                            @error('tel')
                            <div class="valid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="email">อีเมล</label>
                            <input
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="อีเมล"
                                value="{{ old('email') }}"
                                required
                            >

                            @error('email')
                            <div class="valid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="password">รหัสผ่าน</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="ตั้งค่ารหัสผ่าน"
                                required
                            >

                            @error('password')
                            <div class="valid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="confirm_password">ยืนยันรหัสผ่าน</label>
                            <input
                                type="password"
                                class="form-control"
                                id="confirm_password"
                                name="password_confirmation"
                                placeholder="ใส่รหัสผ่านอีกครั้ง"
                                required
                            >
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="line_id">ID:Line</label>
                            <input
                                type="text"
                                class="form-control"
                                id="line_id"
                                name="line_id"
                                placeholder="ไอดีไลน์"
                                value="{{ old('line_id') }}"
                            >
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                มีบัญชีอยู่แล้ว<a href="{{ route('customer.login') }}" class="effect ml-1 mr-1"><span class="text-danger">เข้าสู่ระบบ</span></a>
                            </div>
                            <button type="button" class="btn btn-danger submitBtn" style="border-radius: 5px">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/utils/sweetAlert.js') }}"></script>
    <script>
        $('.submitBtn').on('click', function() {
            if (!$('.form-add-user')[0].checkValidity()) {
                $('.form-add-user').addClass('was-validated');
                return
            }
            Swal.fire({
                title: 'ยืนยันการสมัครสมาชิก',
                text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: 'ยกเลิก'
            }).then(result => {
                if (!result.isConfirmed) return;
                $('.form-add-user').submit();
            });
        });
    </script>
</body>
