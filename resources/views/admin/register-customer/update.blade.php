@extends('admin.layouts.menu')
@section('name_page', 'แก้ไขข้อมูล')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="needs-validation form-add-user" method="POST" action="{{ route('admin.update.user', ['userId' => $user->u_id]) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="form-group">
                        <label class="text-danger">*</label><label for="number_customers">รหัสลูกค้า</label>
                        <input
                            type="text"
                            class="form-control"
                            id="number_customers"
                            name="number_customers"
                            placeholder="ระบุรหัสลูกค้า"
                            value="{{ $user->number_customers }}"
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
                                value="{{ $user->first_name }}"
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
                                value="{{ $user->last_name }}"
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
                            value="{{ $user->cid }}"
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
                            value="{{ $user->age }}"
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
                            value="{{ $user->tel }}"
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
