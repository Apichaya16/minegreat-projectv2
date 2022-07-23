@extends('layouts.menu')
@section('name_page', 'ข้อมูลบัญชี')
@section('button_page')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_user">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> เพิ่มข้อมูลบัญชีลูกค้า
    </button>


@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
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
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลบัญชีลูกค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('accounting.store')}}" method="POST">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">รหัสลูกค้า</span>
                            </div>
                            <input type="text" class="form-control" name="user_id" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุรหัสลูกค้า">
                        </div>

                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">รหัสลูกค้า</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="ระบุรหัสลูกค้า">
                        </div> --}}

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อสินค้า</span>
                            </div>
                            <input type="text" class="form-control" name="product" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุชื่อของสินค้าที่ผ่อน">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">แบรนด์สินค้า</span>
                            </div>
                            <input type="text" class="form-control" name="brand" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุแบรนด์ของสินค้า">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">รายละเอียด</span>
                            </div>
                            <input type="text" class="form-control" name="details" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดของสินค้า">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">ประเภทการผ่อน</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="type">
                                <option selected>เลือกประเภทการผ่อน</option>
                                <option value="1">ผ่อนไปใช้ไป</option>
                                <option value="2">ผ่อนครบรับของ</option>
                                <option value="3">วางดาวน์</option>
                                <option value="4">อื่นๆ / ไม่ระบุ</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">ประเภทการส่งยอดผ่อน</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="type_pay">
                                <option selected>เลือกประเภทการส่งยอดผ่อน</option>
                                <option value="1">รายวัน</option>
                                <option value="2">รายวันเว้นวัน</option>
                                <option value="3">รายสัปดาห์</option>
                                <option value="4">รายเดือน</option>
                                <option value="5">อื่นๆ / ไม่ระบุ</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ส่วนลดหรือโปรโมชั่น</span>
                            </div>
                            <input type="text" class="form-control" name="discount" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุส่วนลดหรือโปรโมชั่นที่ใช้">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">จำนวนเงินที่เปิดบิลผ่อน</span>
                            </div>
                            <input type="text" class="form-control" name="installment" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุจำนวนเงินที่ลูกค้าเปิดบิลผ่อน">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ราคาสินค้า</span>
                            </div>
                            <input type="text" class="form-control" name="price" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุราคาผ่อนของสินค้า">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ยอดผ่อนคงเหลือ</span>
                            </div>
                            <input type="text" class="form-control" name="balance_payment" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="ระบุยอดผ่อนคงเหลือ">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">เปอร์เซนต์การชำระปัจจุบัน</span>
                            </div>
                            <input type="text" class="form-control" name="percen_current" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="แสดง % ชำระปัจจุบันของลูกค้า">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">การพิจารณา</span>
                            </div>
                            <input type="text" aria-label="First name" name="percen_consider" class="form-control"
                                placeholder="แสดง % การพิจารณา">
                            <input type="text" aria-label="Last name" name="amount_consider" class="form-control"
                                placeholder="แสดงจำนวนเงิน">
                        </div>

                        {{-- <div class="form-group">
                            <label for="exampleInputPassword1">เปอร์เซนต์การพิจารณา</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="แสดงเปอร์เซนต์การพิจารณา">
                        </div> --}}

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">สถานะการผ่อน</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="status">
                                <option selected>เลือกสถานะการผ่อน</option>
                                <option value="1">ผ่านการพิจารณา</option>
                                <option value="2">อยู่ระหว่างการพิจารณา</option>
                                <option value="3">ยกเลิกการผ่อน</option>
                                <option value="4">พักการผ่อน</option>
                                <option value="5">รอตรวจสอบเอกสาร</option>
                                <option value="6">รับสินค้า</option>
                                <option value="7">ค้างชำระ</option>
                                <option value="8">ชำระการผ่อนครบ</option>
                                <option value="9">อื่นๆ / ไม่ระบุ</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
@endsection
