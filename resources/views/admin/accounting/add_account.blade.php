@extends('layouts.menu')
@section('name_page', 'เพิ่มบัญชีลูกค้า')

@section('content')
<div class="card shadow mt-4 mb-4">
    <div class="card-body">
        <form action="{{ route('admin.accounting.store') }}" method="POST" id="addAccForm" class="needs-validation" novalidate>
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">รหัสลูกค้า</span>
                </div>
                <select class="form-control" name="user_id" aria-label="Default select example" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->u_id }}">{{ $user->number_customers }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ชื่อสินค้า</span>
                </div>
                <input type="text" class="form-control" name="product" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุชื่อของสินค้าที่ผ่อน" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">แบรนด์สินค้า</span>
                </div>
                <input type="text" class="form-control" name="brand" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุแบรนด์ของสินค้า" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">รายละเอียด</span>
                </div>
                <input type="text" class="form-control" name="details" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดของสินค้า" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">ประเภทการผ่อน</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="type" required>
                    <option selected disabled>เลือกประเภทการผ่อน</option>
                    @foreach ($installmentType as $type)
                        <option value="{{ $type->it_id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">ประเภทการส่งยอดผ่อน</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="type_pay" required>
                    <option selected disabled>เลือกประเภทการส่งยอดผ่อน</option>
                    @foreach ($paymentTypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ราคาสินค้า</span>
                </div>
                <input type="number" class="form-control" name="price" id="price" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุราคาผ่อนของสินค้า" required>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ส่วนลด</span>
                </div>
                <input type="number" class="form-control" name="discount" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุส่วนลด" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="exampleInputPassword1">รายละเอียดโปรโมชั่นที่ใช้</label>
                <input type="text" class="form-control" name="detail_promotion" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดโปรโมชั่นที่ใช้" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ราคาผ่อนหลังจากหักส่วนลด</span>
                </div>
                <input type="number" class="form-control" name="amount_after_discount" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="แสดงราคาผ่อนหลังจากหักส่วนลด" readonly>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">จำนวนเงินที่เปิดบิลผ่อน</span>
                </div>
                <input type="number" class="form-control" name="installment" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุจำนวนเงินที่ลูกค้าเปิดบิลผ่อน" required>
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
                    placeholder="แสดงจำนวนเงิน" readonly required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">สถานะการผ่อน</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="status_type" required>
                    <option selected disabled>เลือกสถานะการผ่อน</option>
                    @foreach ($typeStatus as $status)
                        <option value="{{ $status->s_id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="button" id="addAccBtn" class="btn btn-primary submitBtn">บันทึก</button>
                <button type="reset" class="btn btn-danger">ล้างค่า</button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function() {
        bindOnSubmit();

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
    function bindOnSubmit() {
        $('#addAccBtn').on('click', function() {
            const form = $('#addAccForm');
            if (form[0].checkValidity() === false) {
                form[0].classList.add('was-validated');
                return
            }
            showAlertWithConfirm('warning', 'คุณต้องการเพิ่มข้อมูล?', 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง')
                .then(ok => {
                    if (!ok) return;

                    $('#addAccForm').submit();
                });
        });
    }
</script>
@endpush
