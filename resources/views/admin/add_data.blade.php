@extends('layouts.menu')
@section('name_page', 'เพิ่มข้อมูล')


@section('content')
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูล</h6>
        </div> --}}
        <div class="card-body">
            <form class="form-user form-add-user" method="POST" action="{{ route('add.user', ['id' => isset($id) ? $id : 0]) }}">
                @csrf
                <div class="modal-body">

                    {{-- <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">รหัสลูกค้า</span>
                        </div>
                        <input type="text" aria-label="First name" class="form-control" id="number_customers"
                            value="{{ old('number_customers ') }}" name="number_customers" placeholder="รหัสลูกค้า"
                            required>
                    </div> --}}

                    <div class="form-group">
                        <label for="exampleInputPassword1">รหัสลูกค้า</label>
                        <input type="text" aria-label="First name" class="form-control" id="number_customers"
                            value="{{ isset($user) ? $user->number_customers : '' }}" name="number_customers"
                            placeholder="ระบุรหัสลูกค้า" required>
                    </div>


                    <div class="row mb-4">
                        <div class="col">
                            <label for="exampleInputPassword1">ชื่อจริง</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="ระบุชื่อลูกค้า" value="{{ isset($user) ? $user->first_name : '' }}">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">นามสกุล</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="ระบุนามสกุลลูกค้า" value="{{ isset($user) ? $user->last_name : '' }}">
                        </div>
                    </div>


                    {{-- <div class="input-group">
                        <label for="exampleInputPassword1">ชื่อและนามสกุล</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">ชื่อและนามสกุล</span>
                        </div>
                        
                        <input type="text" aria-label="First name" class="form-control" id="first_name"
                            name="first_name" placeholder="ชื่อลูกค้า">
                        <input type="text" aria-label="Last name" class="form-control" id="last_name"
                            name="last_name" placeholder="นามสกุลลูกค้า">
                    </div> --}}
                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid" name="cid"
                            placeholder="เลขบัตรประชาชนลูกค้า" value="{{ isset($user) ? $user->cid : '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">อายุ</label>
                        <input type="text" class="form-control" id="age" name="age" placeholder="อายุลูกค้า"
                            value="{{ isset($user) ? $user->age : '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">เบอร์โทร</label>
                        <input type="text" class="form-control" id="tel" name="tel"
                            placeholder="เบอร์โทรลูกค้า" value="{{ isset($user) ? $user->tel : '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">ชื่อผู้ใช้งาน</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="ตั้งค่าชื่อผู้ใช้งาน" value="{{ isset($user) ? $user->username : '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="ตั้งค่ารหัสผ่าน">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exampleInputPassword1">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="confirm_password"
                            placeholder="ใส่รหัสผ่านอีกครั้ง">
                    </div>

                    <div class="text-center">
                        {{-- <a type="button" class="btn btn-danger" href="{{ url('data_user') }}"
                    >ยกเลิก</a> --}}

                        <button class="w-100 btn btn-primary btn-lg" type="submit">บันทึก</button>
                        <hr class="my-1">

                        <button class="w-100 btn btn-danger btn-lg" href="{{ url('data_user') }}"
                            type="submit">ยกเลิก</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection

@push('css')
    <style>
        .test {
            background: red;
            border-radius: 50px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.submitBtn').on('click', function() {
            Swal.fire({
                title: 'ยืนยันการบันทึกข้อมูล',
                text: 'Do you want to continue',
                icon: 'warning',
                confirmButtonText: 'ok',
            }).then(result => {
                if (!result.isConfirmed) return;
                $('.form-add-user').submit();
            });
        });

        $('.del').click(function(e) {
            var id = $(this).data('id');
            Swal.fire({
                title: 'ยืนยันการลบข้อมูล',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('del.user') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'ลบข้อมูลสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                })
                            }
                        }
                    });
                }
            });

        });
    </script>
@endpush
