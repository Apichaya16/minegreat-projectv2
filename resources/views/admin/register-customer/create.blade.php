@extends('layouts.menu')
@section('name_page', 'กรอกข้อมูลลูกค้า')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="needs-validation form-add-user" method="POST" action="{{ route('admin.create.user.store') }}" novalidate>
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label class="text-danger">*</label><label for="number_customers">รหัสลูกค้า</label>
                        <input
                            type="text"
                            class="form-control"
                            id="number_customers"
                            name="number_customers"
                            placeholder="ระบุรหัสลูกค้า"
                            value="{{ $nextCode }}"
                            readonly
                            required
                        >
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="text-danger">*</label><label for="first_name">ชื่อจริง</label>
                            <input
                                type="text"
                                class="form-control"
                                id="first_name"
                                name="first_name"
                                placeholder="ระบุชื่อลูกค้า"
                                value="{{ old('first_name') }}"
                                required
                            >
                        </div>
                        <div class="col">
                            <label class="text-danger">*</label><label for="last_name">นามสกุล</label>
                            <input
                                type="text"
                                class="form-control"
                                id="last_name"
                                name="last_name"
                                placeholder="ระบุนามสกุลลูกค้า"
                                value="{{ old('last_name') }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-danger">*</label><label class="form-label" for="cid">เลขบัตรประชาชน</label>
                        <input
                            type="text"
                            class="form-control @error('cid') is-invalid @enderror"
                            id="cid"
                            name="cid"
                            placeholder="x-xxxx-xxxxx-xx-x"
                            value="{{ old('cid') }}"
                            required
                        >

                        @error('cid')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="age">อายุ</label>
                        <input
                            type="text"
                            class="form-control"
                            id="age"
                            name="age"
                            placeholder="อายุลูกค้า"
                            value="{{ old('age') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="text-danger">*</label><label class="form-label" for="tel">เบอร์โทร</label>
                        <input
                            type="text"
                            class="form-control"
                            id="tel"
                            name="tel"
                            placeholder="เบอร์โทรลูกค้า"
                            value="{{ old('tel') }}"
                            required
                        >
                    </div>

                    {{-- <div class="form-group">
                        <label class="text-danger">*</label><label class="form-label" for="username">ชื่อผู้ใช้งาน</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="ตั้งค่าชื่อผู้ใช้งาน"
                            value="{{ old('username') }}"
                            required
                        >
                    </div> --}}

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

                    <div class="text-center">
                        <button class="w-100 btn btn-primary mb-2 submitBtn" type="button">บันทึก</button>
                        <button class="w-100 btn btn-danger" type="reset">ล้างข้อมูล</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection

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
