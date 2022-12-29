@extends('admin.layouts.menu')
@section('name_page', 'รายการชำระ')
@section('button_page')
{{-- <a type="button" class="btn btn-success" href="{{ route('admin.create.user') }}">
    <i class="fas fa-user-plus fa-sm text-white-50"></i> ลงทะเบียน
</a> --}}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
@endpush

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">รายการชำระ</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วันที่</th>
                        <th>งวดที่</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>สินค้า</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->order_number }}</td>
                        <td>{{ $p->first_name }} {{ $p->last_name }}</td>
                        <td>{{ $p->product_nameen }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning ml-1" onclick="openEditModal('{{ $p->p_id }}');"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.payment.modal.payment-modal')
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
$(function () {
    setupDataTable();
    bindClearModal();
    bindOnSubmitBtn();
});
function setupDataTable() {
    $('#dataTable').DataTable({
        columnDefs : [
            {
                className: "text-center",
                targets: [0,1,2,5]
            },
            {
                orderable: false,
                targets: [5]
            }
        ]
    });
}
function bindClearModal() {
    $('#paymentModal').on('hidden.bs.modal', function (e) {
        $('.form-create-payment')[0].reset();
        $('#preview_image').addClass('d-none');
        $('#preview_image').prop('src', null);
    })
}
function openEditModal(id) {
    showLoading();
    $('.modal-title').text('แก้ไขรายละเอียดการผ่อน');
    const url = "{{ route('admin.accounting.payment.getPaymentById', '') }}/" + id
    $.get(url,
        function (resps, textStatus, jqXHR) {
            hideLoading();
            const {data} = resps;
            console.log(data);
            if (data) {
                if (data.slip_url) {
                    $('#preview_image').prop('src', data.slip_url);
                    $('#preview_image').removeClass('d-none');
                    $('#slip_image').prop('required', false);
                } else {
                    $('#slip_image').prop('required', true);
                }
                $('#order_number').val(data.order_number);
                $('#amount').val(data.amount);
                $('.btn-submit-payment').data('id', id);
                if (data.date_payment != '') {
                    let strSplit = data.date_payment.split(' ');
                    console.log(strSplit);
                    $('#date_payment').val(strSplit[0]);
                    $('#time_payment').val(strSplit[1]);
                }
                $('#status_id').val(data.status_id);
                $('#paymentModal').modal('show');
            }
        },
    );
}
function bindOnSubmitBtn() {
    $('.btn-submit-payment').on('click', function () {
        const id = $(this).data('id');
        onUpdate(id);
    });
}
function onUpdate(id) {
    const form = $('.form-create-payment');
    if (form[0].checkValidity() === false) {
        form[0].classList.add('was-validated');
        return
    }
    Swal.fire({
        icon: 'warning',
        title: 'ยืนยันการแก้ไขข้อมูล?',
        text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
        showDenyButton: true,
        confirmButtonText: 'ยืนยัน',
        denyButtonText: `ยกเลิก`,
    }).then(async (result) => {
        if (!result.isConfirmed) return;

        showLoading();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.accounting.payment.update_payment', '') }}/" + id,
            data: new FormData(form[0]),
            contentType: false,
            processData: false,
            success: function (response) {
                const {html} = response;
                $('#paymentModal').modal('hide');
                $('#container-table').html(html);
                setupDatatable();

                Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ'
                });
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด',
                    html: error.statusText || ''
                });
            }
        });
    });
}
</script>
@endpush
