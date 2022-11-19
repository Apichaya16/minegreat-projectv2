@extends('admin.layouts.menu')
@section('name_page', 'เพิ่มบัญชีลูกค้า')

@section('content')
<div class="card shadow mt-4 mb-4">
    <div class="card-body">
        <form action="{{ route('admin.accounting.store') }}" method="POST" id="addAccForm" class="needs-validation" novalidate autocomplete="off">
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

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="brandProduct">แบรนด์:</label>
                        <select class="form-control @error('brandProduct') is-invalid @enderror" id="brandProduct" required>
                            <option>เลือกแบรนด์</option>
                            @foreach ($brands as $b)
                                <option value="{{ $b->id }}">{{ $b->name_en }}</option>
                            @endforeach
                        </select>
                        @error('brandProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="modelProduct">รุ่น:</label>
                        <select class="form-control @error('modelProduct') is-invalid @enderror" name="modelProduct" id="modelProduct" required>
                            <option>เลือกรุ่น</option>
                        </select>
                        @error('modelProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="colorProduct">สี:</label>
                        <select class="form-control @error('colorProduct') is-invalid @enderror" id="colorProduct" required>
                            <option>เลือกสี</option>
                        </select>
                        @error('colorProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="capacityProduct">ความจุ:</label>
                        <select class="form-control @error('capacityProduct') is-invalid @enderror" id="capacityProduct" required>
                            <option>เลือกความจุ</option>
                        </select>
                        @error('capacityProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="price">ราคา</label>
                        <input type="text" name="price" id="price" class="form-control" readonly>
                    </div>
                </div>
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

            {{-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ราคาสินค้า</span>
                </div>
                <input type="number" class="form-control" name="price" id="price" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุราคาผ่อนของสินค้า" required>
            </div> --}}

            <h5>รายละเอียดโปรโมชั่นที่ใช้</h5>

            <div class="form-group">
                <input type="text" class="form-control" name="detail_promotion" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุรายละเอียดโปรโมชั่นที่ใช้" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">ส่วนลด</span>
                </div>
                <input type="number" class="form-control" id="discount" name="discount" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="ระบุส่วนลด" required>
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
        bindSelectBrand();
        bindSelectModel();
        bindSelectColor();
        bindSelectInstallment();
        bindPrice();
        bindSelectCapacity();
        bindOnSubmit();

        bindKeyUp();
    });
    function bindKeyUp() {
        $('#discount').on('keyup', function(e) {
            const price = parseFloat($('#price').val());
            const discount = parseFloat($('#discount').val());
            console.log(price);
            console.log(discount);
            if (discount <= price) {
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
            } else {
                $('input[name="amount_after_discount"]').val('');
                $('input[name="percen_consider"]').val('');
                $('input[name="amount_consider"]').val('');
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
    }
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
    function bindPrice() {
        $('#installment').on('keyup', function () {
            let value = $(this).val();
            let price = $('#price').val();
            if (parseInt(price) > parseInt(value)) {
            } else {
            }
        });
    }
    function bindSelectInstallment() {
        $('.card-installment-type').on('click', function () {
            $('.card-installment-type').each(function (index, element) {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            let value = $(this).data('pk');
        });
    }
    function bindSelectBrand() {
        $('#brandProduct').on('change', function () {
            const bId = $(this).val();
            getProductByBrandId(bId);
        });
    }
    function getProductByBrandId(bId) {
        // $('body').waitMe({
        //     effect : 'ios',
        //     text : 'Loading...',
        // })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getProductByBrandId', '') }}/" + bId,
            success: function (response) {
                // $('body').waitMe('hide');
                const {items} = response;
                $('#modelProduct').empty();
                $('#modelProduct').append('<option>เลือกรุ่น</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.name_en}</option>`;
                    $('#modelProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                // $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectModel() {
        $('#modelProduct').on('change', function () {
            const pId = $(this).val();
            $('#colorProduct').data('pid', pId);
            getColorByProductId(pId);
        });
    }
    function getColorByProductId(pId) {
        // $('body').waitMe({
        //     effect : 'ios',
        //     text : 'Loading...',
        // })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getColorByProductId', '') }}/" + pId,
            success: function (response) {
                // $('body').waitMe('hide');
                // console.log(response);
                const {items} = response;
                $('#colorProduct').empty();
                $('#colorProduct').append('<option>เลือกสี</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.name_th}</option>`;
                    $('#colorProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                // $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectColor() {
        $('#colorProduct').on('change', function () {
            const pId = $(this).data('pid');
            const cId = $(this).val();
            // const cName = $(this).text();
            getCapacityByProductId(pId, cId);
        });
    }
    function getCapacityByProductId(pId, cId) {
        // $('body').waitMe({
        //     effect : 'ios',
        //     text : 'Loading...',
        // })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getCapacityByProductId', ['','']) }}/" + pId + '/' + cId,
            success: function (response) {
                // $('body').waitMe('hide');
                // console.log(response);
                const {items} = response;
                $('#capacityProduct').empty();
                $('#capacityProduct').append('<option>เลือกความจุ</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.size}  (${item.price} ฿)</option>`;
                    $('#capacityProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                // $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectCapacity() {
        $('#capacityProduct').on('change', function () {
            let productId = $('#modelProduct').val();
            let capacityId = $(this).val();
            let colorId = $('#colorProduct').val();
            console.log("555");
            getPriceByProduct(productId, capacityId, colorId);
        });
    }
    function getPriceByProduct(productId, capacityId, colorId) {
        $.ajax({
            type: "GET",
            url: "{{route('api.product.getPriceByProduct')}}",
            data: {
                product_id: productId,
                capacity_id: capacityId,
                color_id: colorId
            },
            success: function (response) {
                if (response.data.price) {
                    $('#price').val(response.data.price);
                }
            }
        });
    }
</script>
@endpush
