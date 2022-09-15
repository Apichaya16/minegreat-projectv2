@extends('layouts.menu')
@section('name_page', 'ข้อมูลทั่วไป')
@section('button_page')
    <a type="button" class="btn btn-success" href="{{ route('admin.create.user') }}">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> เพิ่มข้อมูลลูกค้า
    </a>


@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลทั่วไปลูกค้า</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-responsive-md user-datatable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>รหัสลูกค้า</th>
                        <th>ชื่อลูกค้า</th>
                        <th>นามสกุล</th>
                        <th>อายุ</th>
                        <th>เบอร์โทร</th>
                        <th>เลขบัตรประชาชน</th>
                        <th>จัดการข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <td>{{ $data->number_customers }}</td>
                            <td>{{ $data->first_name }}</td>
                            <td>{{ $data->last_name }}</td>
                            <td>{{ $data->age }}</td>
                            <td>{{ $data->tel }}</td>
                            <td>{{ $data->cid }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('admin.edit.user', ['userId' => $data->u_id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-sm del" data-id="{{ $data->u_id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css"/>
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

            $('.del').click(function(e) {
                var id = $(this).data('id');
                Swal.fire({
                    text: 'ยืนยันการลบข้อมูล?',
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: "{{ route('admin.delete.user') }}",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบข้อมูลสำเร็จ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    })
                                }
                            }
                        });
                    }
                });
            });
        });

        function setupDatatable() {
            $('.user-datatable').DataTable({
                columnDefs : [
                    {className: "text-center", targets: [0,3,4,5]},
                    {className: "text-center", orderable: false, targets: [6]},
                ]
            });
        }
    </script>
@endpush
