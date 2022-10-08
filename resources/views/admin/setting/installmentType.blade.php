@extends('admin.layouts.menu')
@section('name_page', 'ตั้งค่า')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>จัดการประเภทการผ่อน
            <span class="float-right">
                <button type="button" class="btn btn-success" onclick="createModal();">+ เพิ่มประเภทการผ่อน</button>
            </span>
        </h5>
    </div>
    <div class="card-body">
        <div id="container-table">
            @include('admin.setting.tables.installment-table')
        </div>
    </div>
</div>
@include('admin.setting.modal.installment-modal')
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        setupDatatable();
        bindOnSubmitBtn();
    });
    function setupDatatable() {
        $('.installment-datatable').DataTable({
            // order: [[0,'desc']],
            columnDefs : [
                {className: "text-center", targets: [0,2,3]},
                {orderable: false, targets: [2,3]},
            ]
        });
        bindToggleSW();
        bindDeleteBtn();
    }
    function createModal() {
        const form = $('.form-installment-type');
        form[0].reset();
        $('#installmentModal').modal('show');
    }
    function openEditModal(id) {
        const url = "{{ route('admin.setting.getInstallmentById', '') }}/" + id
        $.get(url,
            function (resps, textStatus, jqXHR) {
                const {data} = resps;
                // console.log(data);
                $('#installment_type').val(data.name);
                $('.btn-submit').data('id', data.it_id);
                $('#customSwitch').prop('checked', data.is_active);
                $('#installmentModal').modal('show');
            },
        );
    }
    function bindOnSubmitBtn() {
        $('.btn-submit').on('click', function () {
            const id = $(this).data('id');
            if (id) {
                onUpdate(id);
            }else {
                onCreate();
            }
        });
    }
    function onCreate() {
        const form = $('.form-installment-type');
        if (form[0].checkValidity() === false) {
            form[0].classList.add('was-validated');
            return
        }
        Swal.fire({
            icon: 'warning',
            title: 'ยืนยันการเพิ่มประเภทการผ่อน  ?',
            text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
            showDenyButton: true,
            confirmButtonText: 'ยืนยัน',
            denyButtonText: `ยกเลิก`,
        }).then(async (result) => {
            if (!result.isConfirmed) return;

            showLoading();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.setting.createInstallment') }}",
                data: form.serialize(),
                success: function (response) {
                    const {status, html} = response;
                    if (status) {
                        $('#installmentModal').modal('hide');
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
    }
    function onUpdate(id) {
        const form = $('.form-installment-type');
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
                url: "{{ route('admin.setting.updateInstallmentById', '') }}/" + id,
                data: form.serialize(),
                success: function (response) {
                    const {html} = response;
                    $('#installmentModal').modal('hide');
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
    function bindToggleSW() {
        $('.custom-sw').on('change', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $.ajax({
                type: "PUT",
                url: "{{ route('admin.setting.updateInstallmentById', '') }}/" + id,
                data: {
                    name: name,
                    is_active: $(this).is(':checked') ? 'on' : null
                },
                success: function (response) {
                    const {html} = response;
                    $('#installmentModal').modal('hide');
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
                    url: "{{ route('admin.setting.deleteInstallmentById', '') }}/" + id,
                    success: function (response) {
                        const {html} = response;
                        if (html) {
                            $('#installmentModal').modal('hide');
                            $('#container-table').html(html);
                            setupDatatable();

                            Swal.fire({
                                icon: 'success',
                                title: 'แก้ไขข้อมูลสำเร็จ'
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
