@extends('layouts.menu')
@section('name_page', 'ข้อมูลทั่วไป')
@section('button_page')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_user">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> เพิ่มข้อมูลลูกค้า
    </button>


@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลทั่วไปลูกค้า</h6>
        </div>
        <div class="card-body">
            {{-- {{$users}} --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>รหัสลูกค้า</th>
                            <th>ชื่อลูกค้า</th>
                            <th>นามสกุล</th>
                            <th>อายุ</th>
                            <th>เบอร์โทร</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ชื่อผู้ใช้งาน</th>
                            <th>จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                        <tr>
                          <td>{{ $data->number_customers}}</td>
                          <td>{{ $data->first_name }}</td>
                          <td>{{ $data->last_name }}</td>
                          <td>{{ $data->age }}</td>
                          <td>{{ $data->tel }}</td>
                          <td>{{ $data->cid }}</td>
                          <td>{{ $data->username }}</td>
                          <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลลูกค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-user form-add-user" method="POST" action="{{route('add.user')}}">
                    @csrf
                    <div class="modal-body">

                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">รหัสลูกค้า</span>
                            </div>
                            <input type="text" aria-label="First name" class="form-control" id="number_customers" name="number_customers" placeholder="รหัสลูกค้า" required>
                          </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">ชื่อและนามสกุล</span>
                                </div>
                                <input type="text" aria-label="First name" class="form-control" id="first_name" name="first_name" placeholder="ชื่อลูกค้า">
                                <input type="text" aria-label="Last name" class="form-control" id="last_name" name="last_name" placeholder="นามสกุลลูกค้า">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputPassword1">เลขบัตรประชาชน</label>
                                <input type="text" class="form-control" id="cid" name="cid" placeholder="เลขบัตรประชาชนลูกค้า">
                            </div>

                            {{-- <div class="form-group">
                                <label for="exampleInputPassword1">ชื่อ</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="ชื่อลูกค้า">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">นามสกุล</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="นามสกุลลูกค้า">
                            </div> --}}

                            <div class="form-group">
                                <label for="exampleInputPassword1">อายุ</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="อายุลูกค้า">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">เบอร์โทร</label>
                                <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทรลูกค้า">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="ตั้งค่าชื่อผู้ใช้งาน">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="cid" placeholder="ตั้งค่ารหัสผ่าน">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control" id="cid" name="cid" placeholder="ใส่รหัสผ่านอีกครั้ง">
                            </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-primary submitBtn">บันทึก</button>
                    </div>
                </form>
            </div>
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
    $('.submitBtn').on('click', function () {
        Swal.fire({
                title: 'ยืนยันการบันทึกข้อมูล',
                text: 'Do you want to continue',
                icon: 'warning',
                confirmButtonText: 'ok',
                showCancelButton: true,
        }).then(result => {
            if (!result.isConfirmed) return;

            $('.form-add-user').submit();
        });
    });
</script>
@endpush