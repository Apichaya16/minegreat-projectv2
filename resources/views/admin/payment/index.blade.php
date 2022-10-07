@extends('layouts.menu')
@section('name_page', 'จัดการข้อมูลการผ่อนชำระ')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการผ่อนชำระ</h6>
    </div>
    <div class="card-body">
        <div id="container-table">
            @include('admin.payment.tables.payment-table')
        </div>
    </div>
</div>
@include('admin.payment.modal.payment-modal')
@endsection

@push('css')
    {{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css"/>
@endpush

@push('scripts')
    {{-- <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            setupDatatable();
            bindOnSubmitBtn();
            bindDeleteBtn();
        });

        function setupDatatable() {
            $('.payment-datatable').DataTable({
                columnDefs : [
                    {className: "text-center", targets: [0,1,2,3,4,5]},
                    {orderable: false, targets: [5]},
                ]
            });
            bindOpenDetail();
        }
        function bindOpenDetail() {
            $('.open-detail').click(function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $('.detail-' + id).toggle();
            });
        }
        function openEditModal(id) {
            $('.modal-title').text('แก้ไขรายละเอียดการผ่อน');
            const url = "{{ route('admin.getPaymentById.accounting', '') }}/" + id
            $.get(url,
                function (resps, textStatus, jqXHR) {
                    const {data} = resps;
                    // console.log(data);
                    $('#order_number').val(data.order_number);
                    $('#amount').val(data.amount);
                    $('.btn-submit-payment').data('id', id);
                    if (data.date_payment != '') {
                        let strSplit = data.date_payment.split(' ');
                        console.log(strSplit);
                        $('#date_payment').val(strSplit[0]);
                        $('#time_payment').val(strSplit[1]);
                    }
                    $('#paymentModal').modal('show');
                },
            );
        }
        function openModal(id) {
            $('.modal-title').text('เพิ่มรายละเอียดการผ่อน');
            const form = $('.form-create-payment');
            form[0].reset();
            $('#pc_id').val(id);
            $('.btn-submit-payment').data('id', null);
            $('#paymentModal').modal('show');
        }
        function bindOnSubmitBtn() {
            $('.btn-submit-payment').on('click', function () {
                const id = $(this).data('id');
                if (id) {
                    onUpdate(id);
                }else {
                    onCreate();
                }
            });
        }
        function onCreate() {
            const form = $('.form-create-payment');
            console.log(form);
            if (form[0].checkValidity() === false) {
                form[0].classList.add('was-validated');
                return
            }
            Swal.fire({
                icon: 'warning',
                title: 'ยืนยันการเพิ่มรายละเอียดการผ่อน?',
                text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then(async (result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.create_payment.accounting') }}",
                    data: form.serialize(),
                    success: function (response) {
                        const {status, html} = response;
                        if (status) {
                            $('#paymentModal').modal('hide');
                            $('#container-table').html(html);
                            setupDatatable();

                            Swal.fire({
                                icon: 'success',
                                title: 'เพิ่มรายละเอียดการผ่อนข้อมูลสำเร็จ'
                            });
                        }else {
                            Swal.fire({
                                icon: 'success',
                                title: 'ไม่สามารถทำรายการได้'
                            });
                        }
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
                    type: "PUT",
                    url: "{{ route('admin.update_payment.accounting', '') }}/" + id,
                    data: form.serialize(),
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
        function bindDeleteBtn() {
            $('.btn-delete').on('click', function () {
                Swal.fire({
                    icon: 'warning',
                    title: 'ยืนยันการลบข้อมูล?',
                    text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then(async (result) => {
                    if (!result.isConfirmed) return;

                    const id = $(this).data('id');
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.delete_payment.accounting', '') }}/" + id + '?filter=' + "{{ Request::get('filter') }}",
                        success: function (response) {
                            const {status, html} = response;
                            if (status) {
                                $('#paymentModal').modal('hide');
                                $('#container-table').html(html);
                                setupDatatable();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสำเร็จ'
                                });
                            }else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ไม่สามารถทำรายการได้'
                                });
                            }
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
            });
        }
    </script>
@endpush
