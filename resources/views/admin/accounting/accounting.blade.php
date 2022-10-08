@extends('admin.layouts.menu')
@section('name_page', 'รายละเอียดการผ่อน')
@section('button_page')
<a type="button" class="btn btn-success" href="{{ route('admin.create.accounting') }}">
    <i class="fas fa-user-plus fa-sm text-gray-50"></i> เพิ่มข้อมูลการผ่อน
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">รายละเอียดการผ่อน</h6>
    </div>
    <div class="card-body">
        <div id="container-table">
            @include('admin.accounting.table.accounting-table')
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<style>
    .badge {
        color: white;
    }
    .custom-badge {
        font-size: 100%;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
    $(function() {
        setupDataTable();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $('#addAccBtn').on('click', function() {
            showAlertWithConfirm('error', 'test', 'test')
                .then(ok => {
                    if (!ok) return;

                    $('#addAccForm').submit();
                });
        });
        $(document).on('click', '.btn-update', function() {
            let _this = $(this);
            const form = _this.parent().parent().find('.update-form');
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
                const pc_id = $(this).data('id');
                await $.ajax({
                    type: "put",
                    url: "{{ route('admin.update.accounting', '') }}/" + pc_id,
                    data: form.serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $("div.modal-backdrop").remove();
                            $('#container-table').html(response.html);
                            setupDataTable();

                            Swal.fire({
                                icon: 'success',
                                title: 'แก้ไขข้อมูลสำเร็จ'
                            });
                        }
                    },
                    error: function (resps) {
                        Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด',
                            text: resps.statusText || ""
                        });
                    }
                });
            });
        });

        $(document).on('click', '.del', function(e) {
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

                    const id = $(this).data('id');
                    await $.ajax({
                        type: "delete",
                        url: "{{ route('admin.delete.accounting', '') }}/" + id,
                        success: function(response) {
                            if (response.status) {
                                $("div.modal-backdrop").remove();
                                $('#container-table').html(response.html);
                                setupDataTable();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบข้อมูลสำเร็จ'
                                });
                            }
                        },
                        error: function (resps) {
                            Swal.fire({
                                icon: 'error',
                                title: 'พบข้อผิดพลาด',
                                text: resps.statusText || ""
                            });
                        }
                    });
                }
            });
        });
    });

    function setupDataTable() {
        $('.accounting-datatable').DataTable({
            columnDefs : [
                {className: "text-center", targets: [0,1,2,3,4,5]},
                {orderable: false, targets: [1,4,5]},
            ]
        });
    }
</script>
@endpush
