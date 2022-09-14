@extends('layouts.menu')
@section('name_page', 'เพิ่มบัญชีลูกค้า')


@section('content')
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูลบัญชีลูกค้า</h6>
        </div> --}}

    </div>

    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูล</h6>
        </div> --}}
        <div class="card-body">
            <form action="{{ route('accounting.store') }}" method="POST" id="addAccForm">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">รหัสลูกค้า</span>
                    </div>
                    <select class="form-control" name="user_id" aria-label="Default select example">
                        @foreach ($data as $d)
                            <option value="{{ $d->u_id }}">{{ $d->number_customers }}</option>
                        @endforeach

                    </select>
                    {{-- <input type="text" class="form-control" name="user_id" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุรหัสลูกค้า"> --}}
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
                        <span class="input-group-text" id="inputGroup-sizing-default">ราคาผ่อน</span>
                    </div>
                    <input type="number" class="form-control" name="price" id="price"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        placeholder="ระบุราคาผ่อนของสินค้า">
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ส่วนลด</span>
                    </div>
                    <input type="number" class="form-control" name="discount" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุส่วนลด">
                </div>

                <div class="form-group">
                    <label class="form-label" for="exampleInputPassword1">รายละเอียดโปรโมชั่นที่ใช้</label>
                    <input type="text" class="form-control" name="detail_promotion" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดโปรโมชั่นที่ใช้">
                </div>

                {{-- <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">รายละเอียดโปรโมชั่นที่ใช้</span>
                    </div>
                    <input type="text" class="form-control" name="detail_promotion" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดโปรโมชั่นที่ใช้">
                </div> --}}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ราคาผ่อนหลังจากหักส่วนลด</span>
                    </div>
                    <input type="number" class="form-control" name="amount_after_discount"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        placeholder="แสดงราคาผ่อนหลังจากหักส่วนลด" readonly>
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">จำนวนเงินที่เปิดบิลผ่อน</span>
                    </div>
                    <input type="number" class="form-control" name="installment" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุจำนวนเงินที่ลูกค้าเปิดบิลผ่อน">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ยอดผ่อนคงเหลือปัจจุบัน</span>
                    </div>
                    <input type="number" class="form-control" name="balance_payment" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="ระบุยอดผ่อนคงเหลือปัจจุบันของลูกค้า"
                        readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">เปอร์เซนต์การชำระปัจจุบัน</span>
                    </div>
                    <input type="number" class="form-control" name="percen_current" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="แสดง % ชำระปัจจุบันของลูกค้า" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">การพิจารณา</span>
                    </div>
                    <input type="number" aria-label="First name" name="percen_consider" class="form-control"
                        placeholder="แสดง % การพิจารณา">
                    <input type="number" aria-label="Last name" name="amount_consider" class="form-control"
                        placeholder="แสดงจำนวนเงิน" readonly>
                </div>

                {{-- <div class="form-group">
                            <label for="exampleInputPassword1">เปอร์เซนต์การพิจารณา</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="แสดงเปอร์เซนต์การพิจารณา">
                        </div> --}}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">สถานะการผ่อน</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="status_type">
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

                <div class="text-center">
                    <a type="button" class="btn btn-danger" href="{{ url('accounting') }}">ยกเลิก</a>
                    <button type="button" id="addAccBtn" class="btn btn-primary submitBtn">บันทึก</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function() {
            $('#addAccBtn').on('click', function() {
                showAlertWithConfirm('error', 'test', 'test')
                    .then(ok => {
                        if (!ok) return;

                        $('#addAccForm').submit();
                    });
            });

            $('[name="price"], [name="discount"]').keyup(function(e) {
                const price = $('[name="price"]').val();
                const discount = $('[name="discount"]').val();
                if (price.length > 0 && discount.length > 0) {
                    $('input[name="amount_after_discount"]').val(price - discount);
                    var sum = price - discount;
                    var percen = 0;
                    if (sum <= 5000) {
                        percen = 20;

                    } else if (sum > 5000 && sum <= 11000) {
                        percen = 30;
                    } else if (sum > 11000) {
                        percen = 50;
                    }
                    $('input[name="percen_consider"]').val(percen);
                    $('input[name="amount_consider"]').val((sum * percen) / 100);
                }
            });

            $('[name="percen_consider"]').keyup(function(e) {
                const sum = $('[name="price"]').val() - $('[name="discount"]').val();
                const percen = $(this).val();
                $('input[name="amount_consider"]').val((sum * percen) / 100);
            })

            $('[name="installment"]').keyup(function(e) {
                const sum = $('[name="price"]').val() - $('[name="discount"]').val();
                if (sum > 0) {
                    $('input[name="balance_payment"]').val(sum - $(this).val());
                    $('input[name="percen_current"]').val((($(this).val() / sum) * 100).toFixed(2));
                }
            });
        });
    </script>
@endpush
