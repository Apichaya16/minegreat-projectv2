<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

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
                <form class="needs-validation form-add-user" method="POST" action="" novalidate>
                @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <label class="text-danger">*</label><label for="first_name">ชื่อ - นามสกุล</label>
                                <input
                                type="text"
                                class="form-control"
                                id="first_name"
                                name="first_name"
                                placeholder="ระบุชื่อ-นามสกุล"
                                required
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="tel">เบอร์โทร</label>
                            <input
                            type="text"
                            class="form-control"
                            id="tel"
                            name="tel"
                            placeholder="เบอร์โทร"
                            required
                            >
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="tel">อีเมล</label>
                            <input
                            type="text"
                            class="form-control"
                            id="tel"
                            name="tel"
                            placeholder="อีเมล"
                            required
                            >
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="password">รหัสผ่าน</label>
                            <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="ตั้งค่ารหัสผ่าน"
                            required
                            >
                        </div>

                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="password">ยืนยันรหัสผ่าน</label>
                            <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="confirm_password"
                            placeholder="ใส่รหัสผ่านอีกครั้ง"
                            required
                            >
                        </div>
                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="password">ID:Line</label>
                            <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="confirm_password"
                            placeholder="ไอดีไลน์"
                            required
                            >
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                มีบัญชีอยู่แล้ว<a href="{{ route('customer.login') }}" class="effect ml-1 mr-1"><span class="text-danger">เข้าสู่ระบบ</span></a>
                            </div>
                            <button type="button" class="btn btn-danger" style="border-radius: 5px">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>


@push('scripts')
    <script>
        $('.submitBtn').on('click', function() {
            if (!$('.form-add-user')[0].checkValidity()) {
                $('.form-add-user').addClass('was-validated');
                return
            }
            Swal.fire({
                title: 'ยืนยันการบันทึกข้อมูล',
                text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                icon: 'warning',
                confirmButtonText: 'ยืนยัน',
            }).then(result => {
                if (!result.isConfirmed) return;
                $('.form-add-user').submit();
            });
        });
    </script>
@endpush
