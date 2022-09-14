@extends('layouts.menu')
@section('name_page', 'ข้อมูลทั่วไป5555')
@section('button_page')
    <a type="button" class="btn btn-success" href="{{ url('add_data') }}">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> เพิ่มข้อมูลลูกค้า
    </a>


@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลทั่วไปลูกค้า</h6>
        </div>
        <div class="card-body">
            {{-- {{$users}} --}}
            <div class="table-responsive text-center">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>รหัสลูกค้า</th>
                            <th>ชื่อลูกค้า</th>
                            <th>นามสกุล</th>
                            <th>อายุ</th>
                            <th>เบอร์โทร</th>
                            <th>เลขบัตรประชาชน</th>
                            <th>ชื่อผู้ใช้งาน</th>
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
                                <td>{{ $data->username }}</td>
                                <td>
                                    <a type="button" class="btn btn-warning" 
                                        href="{{ url('add_data/' . $data->u_id) }}">แก้ไขข้อมูล</a>



                                    <button type="button" class="btn btn-danger del"
                                        data-id="{{ $data->u_id }}">ลบ</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="float: right">
                {!! $users->links() !!}
                @if (!$users->hasPages())
                    <nav>
                        <ul class="pagination">

                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                <span class="page-link" aria-hidden="true">‹</span>
                            </li>

                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                            </li>
                            {{-- <li class="page-item">
                                <a class="page-link" href="http://127.0.0.1:8000/data_user?page=2" rel="next"
                                    aria-label="Next »">›</a>
                            </li>/ --}}
                            <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                                <span class="page-link" aria-hidden="true">›</span>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>

        </div>
    </div>


@endsection

@push('css')
    <style>
        .test {
            background: red;
            border-radius: 50px;
        }
    </style>
@endpush

@push('scripts')
    <script>
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
                title: 'ยืนยันการลบข้อมูล',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('del.user') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
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
    </script>
@endpush
