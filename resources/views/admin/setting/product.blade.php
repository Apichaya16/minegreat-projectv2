@extends('admin.layouts.menu')
@section('name_page', 'ตั้งค่า')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5>จัดการสินค้า
            <span class="float-right">
                <button type="button" class="btn btn-success" onclick="openCreateModal();">+ เพิ่มสินค้า</button>
            </span>
        </h5>
    </div>
    <div class="card-body">
        <div id="container-table">
            @include('admin.setting.tables.product-table')
        </div>
    </div>
</div>
@include('admin.setting.modal.product-modal')
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/utils/validate.js') }}"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        setupModal();
        setupDatatable();

        bindSelect2();
        bindOnSubmitBtn();
    });
    function setupDatatable() {
        $('.product-datatable').DataTable({
            // order: [[0,'desc']],
            columnDefs : [
                {className: "text-center", targets: [0,3,4]},
                {orderable: false, targets: [3,4]},
            ]
        });
        bindToggleSW();
        bindDeleteBtn();
    }
    function bindSelect2() {
        $('.select2').each(function (i, v) {
            $(this).select2({
                width: 'resolve'
            });
        });
    }
    function setupModal() {
        $('#productModal').on('hide.bs.modal', function (event) {
            $('.form-product').clearValidation();
        })
    }
    function openCreateModal() {
        bindSelect2();
        $('.form-product')[0].reset();
        $('#productModal').modal('show');
    }
    function openEditModal(id) {
        showLoading();
        const url = "{{ route('admin.setting.getProductById', '') }}/" + id
        $.get(url,
            function (resps, textStatus, jqXHR) {
                hideLoading();
                const {data} = resps;
                let inputs = $('#productModal').find('input');
                $.each(inputs, function (i, v) {
                    let id = $(this).prop('id');
                    $(this).val(data[id]);
                });

                if (Array.isArray(data['color_maps'])) {
                    $("#color").val('').trigger('change');
                    let ids = [];
                    for (let i = 0; i < data['color_maps'].length; i++) {
                        const item = data['color_maps'][i];
                        ids.push(item.color.id);
                    }
                    $("#color").val(ids).trigger('change');
                }
                if (Array.isArray(data['capacity_maps'])) {
                    $("#capacity").val('').trigger('change');
                    let ids = [];
                    for (let i = 0; i < data['capacity_maps'].length; i++) {
                        const item = data['capacity_maps'][i];
                        ids.push(item.capacity.id);
                    }
                    $("#capacity").val(ids).trigger('change');
                }

                $('.btn-submit').data('id', data.id);
                $('#customSwitch').prop('checked', data.is_active);
                $('#productModal').modal('show');
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
        const form = $('.form-product');
        if (form[0].checkValidity() === false) {
            form[0].classList.add('was-validated');
            return
        }
        Swal.fire({
            icon: 'warning',
            title: 'ยืนยันการเพิ่มสินค้า?',
            text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
            showDenyButton: true,
            confirmButtonText: 'ยืนยัน',
            denyButtonText: `ยกเลิก`,
        }).then(async (result) => {
            if (!result.isConfirmed) return;

            showLoading();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.setting.createProduct') }}",
                data: form.serialize(),
                success: function (response) {
                    const {status, html} = response;
                    if (status) {
                        $('#productModal').modal('hide');
                        // $('#container-table').html(html);
                        setupDatatable();

                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ'
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
        const form = $('.form-product');
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
                url: "{{ route('admin.setting.updateProductById', '') }}/" + id,
                data: form.serialize(),
                success: function (response) {
                    const {html} = response;
                    $('#productModal').modal('hide');
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
                url: "{{ route('admin.setting.updateProductById', '') }}/" + id,
                data: {
                    name: name,
                    is_active: $(this).is(':checked') ? 'on' : null
                },
                success: function (response) {
                    const {html} = response;
                    $('#productModal').modal('hide');
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
                    url: "{{ route('admin.setting.deleteProductById', '') }}/" + id,
                    success: function (response) {
                        const {html} = response;
                        if (html) {
                            $('#productModal').modal('hide');
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
