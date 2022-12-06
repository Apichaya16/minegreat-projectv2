@extends('admin.layouts.menu')
@section('name_page', 'จัดการแบรนด์')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5>แบรนด์
                    <span class="float-right">
                        <button type="button" class="btn btn-success" onclick="openCreateModal();">+ เพิ่มแบรนด์</button>
                    </span>
                </h5>
            </div>
            <div class="card-body">
                <div id="container-table">
                    @include('admin.setting.tables.brand-table')
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.setting.modal.brand-modal')
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
        bindOnSubmitBtn();
    });
    function setupDatatable() {
        $('.brand-datatable').DataTable({
            // autoWidth: false,
            columnDefs : [
                {width: '5%', targets: [0]},
                {className: "text-center", targets: [0,2,3]},
                {orderable: false, width: '100px', targets: [2,3]},
            ]
        });
        bindToggleSW();
        bindDeleteBtn();
    }
    function setupModal() {
        $('#brandModal').on('hide.bs.modal', function (event) {
            $('.form-color').clearValidation();
            $('.form-color')[0].reset();
            $('.btn-submit').data('id', null);
        })
    }
    function openCreateModal() {
        $('#brandModal').modal('show');
    }
    function openEditModal(id) {
        showLoading();
        const url = "{{ route('admin.setting.brand.getBrandById', '') }}/" + id
        $.get(url,
            function (resps, textStatus, jqXHR) {
                hideLoading();
                const {data} = resps;
                let inputs = $('#brandModal').find('input');
                $.each(inputs, function (i, v) {
                    let id = $(this).prop('id');
                    if (id === 'is_active') return;
                    $(this).val(data[id]);
                });
                $('#brandModal #is_active').prop('checked', data.is_active);
                $('.btn-submit').data('id', data.id);
                $('#brandModal').modal('show');
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
        const form = $('.form-color');
        if (form[0].checkValidity() === false) {
            form[0].classList.add('was-validated');
            return
        }
        Swal.fire({
            icon: 'warning',
            title: 'ยืนยันการเพิ่มแบรนด์?',
            text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
            showDenyButton: true,
            confirmButtonText: 'ยืนยัน',
            denyButtonText: `ยกเลิก`,
        }).then(async (result) => {
            if (!result.isConfirmed) return;

            showLoading();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.setting.brand.createBrand') }}",
                data: form.serialize(),
                success: function (response) {
                    const {status, html} = response;
                    if (status) {
                        $('#brandModal').modal('hide');
                        $('#container-table').html(html);
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
        const form = $('.form-color');
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
                url: "{{ route('admin.setting.brand.updateBrandById', '') }}/" + id,
                data: form.serialize(),
                success: function (response) {
                    const {html} = response;
                    $('#brandModal').modal('hide');
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
            showLoading();

            const id = $(this).data('id');
            $.ajax({
                type: "PUT",
                url: "{{ route('admin.setting.brand.updateActiveById', '') }}/" + id,
                data: {
                    is_active: $(this).is(':checked') ? 'on' : null
                },
                success: function (response) {
                    const {html} = response;
                    $('#brandModal').modal('hide');
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
        $(document).on('click', '.btn-delete', function () {
            Swal.fire({
                icon: 'warning',
                title: 'ยืนยันการลบข้อมูล?',
                text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then(async (result) => {
                if (!result.isConfirmed) return;

                showLoading();

                const id = $(this).data('id');
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.setting.brand.deleteBrandById', '') }}/" + id,
                    success: function (response) {
                        const {html} = response;
                        if (html) {
                            $('#brandModal').modal('hide');
                            $('#container-table').html(html);
                            setupDatatable();

                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ'
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
