@extends('customer.layouts.customer')

@section('content')
<div class="container-fluid">
    <div class="container-product">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">สินค้า</h5>
        <div class="row mb-4">
            <div class="col">
                <label for="exampleInputPassword1">รหัสลูกค้า</label>
                <input type="text" class="form-control" value="{{ $account->number_customers }}" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">ราคาผ่อน</label>
                <input type="text" class="form-control" value="{{ $account->price }}" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">ชื่อสินค้า</label>
                <input type="text" class="form-control" value="{{ $account->product_name }}" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <label for="exampleInputPassword1">แบรนด์สินค้า</label>
                <input type="text" class="form-control" value="{{ $account->brand_name }}" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">รายละเอียดสินค้า</label>
                <input type="text" class="form-control" value="{{ $account->product_desc }}" readonly>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-status">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">รูปแบบการผ่อน /
            สถานะ</h5>
        <div class="row mb-4">
            <div class="col">
                <label>จำนวนเงินที่เปิดบิลผ่อน</label>
                <input type="text" class="form-control" value="{{ $account->installment }}" readonly>
            </div>
            <div class="col">
                <label>ประเภทการผ่อน</label>
                <input type="text" class="form-control" value="{{ $account->installment_name }}" readonly>
            </div>
            <div class="col">
                <label>ประเภทการชำระ</label>
                <input type="text" class="form-control" value="{{ $account->payment_name }}" readonly>
            </div>
            <div class="col">
                <label>สถานะการผ่อน</label>
                <input type="text" class="form-control" value="{{ $account->type_name }}" readonly>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-promotion">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
        <div class="row mb-4">
            <div class="col">
                <label>ส่วนลด</label>
                <input type="text" class="form-control" value="{{ $account->discount ?? '-' }}" readonly>
            </div>
            <div class="col">
                <label>รายละเอียดโปรโมชั่น</label>
                <input type="text" class="form-control" value="{{ $account->detail_promotion ?? '-' }}" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label>ราคาผ่อนหลังจากหักส่วนลด</label>
                <input type="text" class="form-control" value="{{ $account->amount_after_discount }}" readonly>
            </div>
            <div class="col-md-6">
                <label>เปอร์เซ็นการชำระปัจจุบัน</label>
                <input type="text" class="form-control" value="{{ number_format($account->percen_current, 2) }} %" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label>เปอร์เซ็นการพิจารณา</label>
                <input type="text" class="form-control" value="{{ number_format($account->percen_consider, 2) }} %" readonly>
            </div>
            <div class="col-md-6">
                <label>จำนวนเงินเมื่อถึง % พิจารณา</label>
                <input type="text" class="form-control" value="{{ $account->amount_consider }}" readonly>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-success" onclick="openModal()">+ แจ้งโอน</button>
    </div>
    <div id="container-table">
        @include('customer.payment.table.payment-table')
    </div>
</div>
@include('customer.payment.modal.show-payment')
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script type="text/javascript" src="{{asset('js/utils/validate.js')}}"></script>
<script>
    $(function () {
        setupDataTable();
        bindClearModal();
        bindCreateOrUpdate();
    });
    function setupDataTable() {
        $('.payment-datatable').DataTable({
            order: [[0,'desc']],
            columnDefs : [
                {className: "text-center", targets: [0,1,2,3]},
                {orderable: false, targets: [4]},
            ]
        });
    }
    function bindClearModal() {
        $('#paymentModal').on('hidden.bs.modal', function (e) {
            $('#paymentForm').clearValidation();
            $('#paymentForm')[0].reset();
        })
    }
    async function openModal(id) {
        if (id) {
            $('#paymentModal #modalTitle').text('แก้ไขแจ้งโอน');
            $('#p_id').val(id);
            $('#order_number').prop('readonly', true);
            await getPaymentById(id);
            $('#paymentModal').modal('show');
        } else {
            $('#paymentModal #modalTitle').text('แจ้งโอน');
            $('#p_id').val(null);
            $('#order_number').prop('readonly', false);
            $('#status').addClass('d-none');
            $('#paymentModal').modal('show');
        }
    }
    async function getPaymentById(id) {
        try {
            $('body').waitMe({
                effect : 'ios',
                text : 'Loading...',
            });
            await $.get("{{ route('customer.payment.getPaymentById', '') }}/" + id,
                function (resps, textStatus, jqXHR) {
                    $('body').waitMe('hide');
                    console.log(resps);
                    const {data} = resps;
                    if (data) {
                        $('#order_number').val(data.order_number);
                        $('#amount').val(data.amount);
                        let dateArr = data.date_payment.split(" ");
                        console.log(dateArr);
                        if (dateArr.length > 1) {
                            $('#date_payment').val(dateArr[0]);
                            $('#time_payment').val(dateArr[1]);
                        }
                        $('#status').text(data.payment_status.name);
                        $("#status").removeAttr('class');
                        $("#status").attr('class', 'badge rounded-pill text-white py-1');
                        if (data.status_id == 1) {
                            $('#status').addClass('badge-warning');
                        } else if (data.status_id == 2) {
                            $('#status').addClass('badge-success');
                        } else if (data.status_id == 3) {
                            $('#status').addClass('badge-danger');
                        }
                    }
                }
            );
        } catch (error) {
        }
    }
    function bindCreateOrUpdate() {
        $('#paymentForm').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            if (form[0].checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
            showAlertWithConfirm('warning', 'ยืนยันการทำรายการ?', '')
            .then(ok => {
                if (!ok) return;

                try {
                    $('body').waitMe({
                        effect : 'ios',
                        text : 'Loading...',
                    });
                    let id = $('#p_id').val();
                    let url = "{{route('customer.payment.storePayment')}}";
                    if (id) url = "{{route('customer.payment.updatePaymentById', '')}}/" + id;

                    $.ajax({
                        type: id ? "PUT" : "POST",
                        url: url,
                        data: form.serialize(),
                        success: function (response) {
                            $('body').waitMe('hide');
                            const {html} = response;
                            if (html) {
                                $('#paymentModal').modal('hide');
                                showAlert('success', 'ทำรายการสำเร็จ', '');
                                $('#container-table').html(html);
                                setupDataTable();
                            }
                        }
                    });
                } catch (error) {
                    showAlert('error', 'พบข้อผิดพลาด', '');
                }
            });
        });
    }
</script>
@endpush
