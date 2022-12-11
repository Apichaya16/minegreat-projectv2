@extends('admin.layouts.menu')
@section('name_page', 'ขอเปิดบิล')
@section('button_page')
<a type="button" class="btn btn-success" href="{{ route('admin.create.accounting') }}">
    <i class="fas fa-user-plus fa-sm text-gray-50"></i> เพิ่มข้อมูลการผ่อน
</a>
@endsection


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ขอเปิดบิล</h6>
    </div>
    <div class="card-body">
        <div id="containerTable">
            @include('admin.approve.table.approve-table')
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="approveForm" class="needs-validation" novalidate autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="accId" id="accId">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" id="product_name" class="form-control" readonly>
                        </div>
                        <div class="form-group ml-1">
                            <label for="product_price">ราคาสินค้า</label>
                            <input type="text" id="product_price" class="form-control" readonly>
                        </div>
                        <div class="form-group ml-1">
                            <label for="product_installment">จำนวนเงินเปิดบิลผ่อน</label>
                            <input type="text" id="product_installment" class="form-control" readonly>
                        </div>
                        {{-- <div class="form-group ml-1">
                            <label for="balance">คงเหลือ</label>
                            <input type="text" id="balance" class="form-control" readonly>
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="amount_after_discount">ราคาคงเหลือหลังจากหักส่วนลด</label>
                            <input type="text" class="form-control" id="amount_after_discount" readonly>
                        </div>
                        <div class="form-group ml-1">
                            <label for="discount">ส่วนลด</label>
                            <input type="number" name="discount" id="discount" class="form-control" min="1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="percent_current">เปอร์เซนต์การชำระปัจจุบัน</label>
                            <input type="text" class="form-control" id="percen_current" readonly>
                        </div>
                        <div class="form-group ml-1">
                            <label for="percent_consider">เปอร์เซนต์การพิจารณา</label>
                            <input type="number" name="percen_consider" id="percen_consider" class="form-control"  min="1" required>
                        </div>
                        <div class="form-group ml-1">
                            <label for="status_type">สถานะ</label>
                            <select name="status_type" id="status_type" class="form-control" required>
                                @foreach ($status as $s)
                                    <option value="{{ $s->s_id }}" {{ $s->s_id == 2 ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css"/>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/utils/validate.js') }}"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        setupDatatable();
        setupClearModal();
        bindSelect2();
        bindCalDiscount();
        bindOnSubmit();
    });
    function setupDatatable() {
        $('#approveTable').DataTable({
            columnDefs : [
                {className: "text-center", targets: [0,2,4]},
                {orderable: false, targets: [4]},
            ]
        });
    }
    function setupClearModal() {
        $('#approveModal').on('hidden.bs.modal', function (e) {
            $('#approveForm').clearValidation();
        })
    }
    function bindSelect2() {
        $('.select2').select2({
            widht: 'resolve'
        });
    }
    function bindCalDiscount() {
        $('#discount').on('keyup', function (e) {
            let discount = $(this).val() || 0;
            const price = $('#product_price').val();
            // const installment = $('#product_installment').val();
            // let balance = (parseInt(price) - parseInt(installment));
            let balance = parseInt(price);
            if (discount > 0 && discount <= balance) {
                // balance = (parseInt(price) - parseInt(installment)) - parseInt(discount);
                balance = parseInt(price) - parseInt(discount);
                $('#amount_after_discount').val(balance);

                // let sum = parseInt(installment) + parseInt(discount);
                let sum = parseInt(discount);
                let percen_current = (sum / parseInt(price)) * 100;
                $('#percen_current').val(percen_current.toFixed(2));
            } else {
                // balance = parseInt(price) - parseInt(installment);
                balance = parseInt(price);
                $('#amount_after_discount').val(balance);

                // let sum = parseInt(installment);
                // let percen_current = (sum / parseInt(price)) * 100;
                let percen_current = 0;
                $('#percen_current').val(percen_current.toFixed(2));
            }
        });
    }
    async function toggleModal(id) {
        await getAccountDetailById(id);
        $('#accId').val(id);
        $('#approveModal').modal('show');
    }
    async function getAccountDetailById(id) {
        showLoading();
        const url = "{{ route('admin.approve.getAccountDetailById', '') }}/" + id
        await $.get(url,
            function (resps, textStatus, jqXHR) {
                hideLoading();
                const {data} = resps;
                if (data) {
                    let fullName = data.user.first_name + ' ' + data.user.last_name;
                    $('#modalTitle').text(fullName);
                    $('#product_name').val(data.products.name_en);
                    $('#product_price').val(data.price);
                    $('#product_installment').val(data.installment);
                    $('#balance').val(data.balance_payment);
                    $('#amount_after_discount').val(data.balance_payment);
                    $('#percen_current').val(data.percen_current);
                }
            }
        );
    }
    function bindOnSubmit() {
        $('#approveForm').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            if (form[0].checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
                return
            }
            Swal.fire({
                icon: 'warning',
                title: 'ยืนยันการทำรายการ?',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then(async (result) => {
                if (!result.value) return;

                try {
                    showLoading();
                    const accId = $('#accId').val();
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('admin.approve.update', '') }}/" + accId,
                        data: form.serialize(),
                        success: function (response) {
                            hideLoading();
                            const {html} = response;
                            if (html) {
                                $('#approveModal').modal('hide');
                                $('#containerTable').html(html);
                                setupDatatable();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ทำรายการสำเร็จ',
                                    text: '',
                                    confirmButtonText: 'ตกลง',
                                });
                            }
                        },
                        error: function (e) {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถทำรายการได้',
                                text: '',
                                confirmButtonText: 'ยืนยัน',
                            });
                        }
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถทำรายการได้',
                        text: '',
                        confirmButtonText: 'ยืนยัน',
                    });
                }
            });
        });
    }
</script>
@endpush
