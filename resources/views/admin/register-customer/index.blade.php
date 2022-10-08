@extends('admin.layouts.menu')
@section('name_page', 'ข้อมูลการลงทะเบียนลูกค้า')
@section('button_page')
<a type="button" class="btn btn-success" href="{{ route('admin.create.user') }}">
    <i class="fas fa-user-plus fa-sm text-white-50"></i> ลงทะเบียน
</a>


@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการลงทะเบียนลูกค้า</h6>
    </div>
    <div class="card-body">
        <div id="container-table">
            @include('admin.register-customer.table.user-table')
        </div>
    </div>
</div>
@include('admin.register-customer.modal.edit_modal')
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<style>
    .test {
        background: red;
        border-radius: 50px;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
    $(function () {
            setupDatatable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('.submitBtn').on('click', function() {
                Swal.fire({
                    title: 'ยืนยันการบันทึกข้อมูล',
                    text: 'Do you want to continue',
                    icon: 'warning',
                    confirmButtonText: 'ok',
                }).then(result => {
                    if (!result.isConfirmed) return;
                    $('.form-add-user').submit();
                });
            });

            $(document).on('click', '.btn-update', function () {
                let _this = $(this);
                const form = _this.parent().parent().find('.form-update-user');
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
                    const u_id = $(this).data('id');
                    await $.ajax({
                        type: "put",
                        url: "{{ route('admin.update.user', '') }}/" + u_id,
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                $('#editModal').modal('hide');
                                $('#container-table').html(response.html);
                                setupDatatable();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสำเร็จ'
                                });
                            }
                        },
                        error: function (resps) {
                            let msg = resps.responseJSON.message
                            if (!msg || msg === '') {
                                msg = resps.statusText
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'พบข้อผิดพลาด',
                                text: msg
                            });
                        }
                    });
                });
            });

            $('.del').click(function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'ยืนยันการลบข้อมูล?',
                    text: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then(async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        showLoading();

                        let id = $(this).data('id');
                        await $.ajax({
                            type: "delete",
                            url: "{{ route('admin.delete.user', '') }}/" + id,
                            success: function(response) {
                                if (response.status) {
                                    $('#editModal').modal('hide');
                                    $('#container-table').html(response.html);
                                    setupDatatable();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบข้อมูลสำเร็จ'
                                    });
                                }
                            },
                            error: function (resps) {
                                let msg = resps.responseJSON.message
                                if (!msg || msg === '') {
                                    msg = resps.statusText
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'พบข้อผิดพลาด',
                                    text: msg
                                });
                            }
                        });
                    }
                });
            });
        });

        function setupDatatable() {
            $('.user-datatable').DataTable({
                order: [[0,'desc']],
                columnDefs : [
                    {className: "text-center", targets: [0,3,4,5]},
                    {className: "text-center", orderable: false, targets: [6]},
                ]
            });
        }
        function openEditModal(id) {
            showLoading();

            const url = "{{ route('admin.detail.user', '') }}/" + id
            $.get(url,
                function (resps, textStatus, jqXHR) {
                    hideLoading();
                    const {data} = resps;
                    console.log(data);
                    $('#number_customers').val(data.number_customers);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#cid').val(data.cid);
                    $('#age').val(data.age);
                    $('#tel').val(data.tel);
                    $('.btn-update').data('id', data.u_id);
                    $('#editModal').modal('show');
                },
            );
        }
</script>
@endpush
