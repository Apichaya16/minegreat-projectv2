@extends('layouts.menu')
@section('name_page', 'จัดการข้อมูลการผ่อนชำระ')
@section('content')
    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ดูว่าแต่ละคน ผ่อนมากี่ครั้ง แต่ละครั้งยอดเท่าไหร่
                ยอดทั้งหมดเท่าไหร่ เหลือเท่าไหร่ กี่เปอร์เซ็นต์แล้ว</h6>

        </div>

    </div> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการผ่อนชำระ</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-responsive-md payment-datatable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>รหัสลูกค้า</th>
                        <th>ประเภทการผ่อน</th>
                        <th>ยอดผ่อนคงเหลือ</th>
                        <th>% การชำระปัจจุบัน</th>
                        <th>สถานะ</th>
                        <th>จัดการข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $index => $data)
                        <tr class="text-center">
                            <td>{{ $data->user == '' ? 'not user' : $data->user->number_customers }}</td>
                            <td>{{ $data->installmentType->name }}</td>
                            <td>{{ number_format($data->balance_payment, 0, '', ',') }}</td>
                            <td>{{ number_format($data->percen_current, 2, '.', ',') }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $data->statusType->color }}" style="color: white">
                                    {{ $data->statusType->name }}
                                </span>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-dark btn-sm open-detail"
                                    data-id="{{ $index }}"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- <button
                                    type="button"
                                    class="btn btn-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#editModal-{{ $index }}"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <div class="modal fade" id="editModal-{{ $index }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    แก้ไขรายละเอียดการผ่อน
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body update-form">
                                                <input type="hidden" name="pc_id" value="{{ $data->pc_id }}">

                                                <div class="row mb-4">
                                                    <div class="col text-left">
                                                        <label for="exampleInputPassword1">งวดที่</label>
                                                        <input type="text" class="form-control" name="order_number"
                                                            value="{{ count($data->payment) == 0 ? 2 : $data->payment[count($data->payment) - 1]->order_number + 1 }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col text-left">
                                                        <label for="exampleInputPassword1">ยอดโอน</label>
                                                        <input type="text" class="form-control" name="amount"
                                                            value="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col text-left">
                                                        <label for="exampleInputPassword1">วันที่โอน</label>
                                                        <input type="date" class="form-control" name="date_payment"
                                                            value="">
                                                    </div>

                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col text-left">
                                                        <label for="exampleInputPassword1">เวลาโอน</label>
                                                        <input type="time" class="form-control" name="time_payment"
                                                            value="">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>

                                                <button type="submit" class="btn btn-primary add-btn"
                                                    data-id="{{ $index }}">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>

                        <thead class="thead-dark detail-{{ $index }}" style="display: none;">
                            <tr>
                                <th class="text-center">งวดที่</th>
                                <th class="text-center" colspan="2">ยอดโอน</th>
                                <th class="text-center">วันที่โอน</th>
                                <th class="text-center">ยอดรวมชำระ</th>
                                <th class="text-center">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->payment as $k => $p)
                                <tr class="detail-{{ $index }} text-center" style="display: none;">
                                    <td>{{ $p->order_number }}</td>
                                    <td colspan="2">{{ number_format($p->amount, 0, '', ',') }}</td>
                                    <td>{{ $p->date_payment }}</td>
                                    <td>{{ number_format($p->sum, 0, '', ',') }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#editDetail-{{ $p->p_id }}"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm del-btn"
                                            data-id="{{ $p->p_id }}"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="editDetail-{{ $p->p_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            แก้ไขรายละเอียดการผ่อน
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body update-form">
                                                        <input type="hidden" name="p_id"
                                                            value="{{ $p->p_id }}">

                                                        <div class="row mb-4">
                                                            <div class="col text-left">
                                                                <label for="exampleInputPassword1">งวดที่</label>
                                                                <input type="text" class="form-control"
                                                                    name="order_number" value="{{ $p->order_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col text-left">
                                                                <label for="exampleInputPassword1">ยอดโอน</label>
                                                                <input type="text" class="form-control" name="amount"
                                                                    value="{{ $p->amount }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col text-left">
                                                                <label for="exampleInputPassword1">วันที่โอน</label>
                                                                <input type="date" class="form-control"
                                                                    name="date_payment"
                                                                    value="{{ substr($p->date_payment, 0, 10) }}">
                                                            </div>

                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col text-left">
                                                                <label for="exampleInputPassword1">เวลาโอน</label>
                                                                <input type="time" class="form-control"
                                                                    name="time_payment"
                                                                    value="{{ substr($p->date_payment, 11, 5) }}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">ปิด</button>

                                                        <button type="submit" class="btn btn-primary edit-btn"
                                                            data-id="{{ $k }}">บันทึก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
            setupDatatable();

            $('.add-btn').on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'ยืนยันการบันทึกข้อมูล',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then((result) => {
                    if (!result.isConfirmed) return;
                    const pc_id = $('#editModal' + id + ' input[name=pc_id]').val();
                    const amount = $('#editModal' + id + ' input[name=amount]').val();
                    const order_number = $('#editModal' + id + ' input[name=order_number]').val();
                    const date_payment = $('#editModal' + id + ' input[name=date_payment]').val();
                    const time_payment = $('#editModal' + id + ' input[name=time_payment]').val();

                    const params = {
                        _token: '{{ csrf_token() }}',
                        pc_id: pc_id,
                        amount: amount,
                        order_number: order_number,
                        date_payment: date_payment,
                        time_payment: time_payment,
                    }
                    console.log(params)
                    $.ajax({
                        type: "post",
                        url: `/add_payment/0`,
                        data: params,
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                })
                            }
                        }
                    });
                });
            });

            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'ยืนยันการแก้ไขข้อมูล',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then((result) => {
                    if (!result.isConfirmed) return;
                    const p_id = $('#editDetail' + id + ' input[name=p_id]').val();
                    const amount = $('#editDetail' + id + ' input[name=amount]').val();
                    const order_number = $('#editDetail' + id + ' input[name=order_number]').val();
                    const date_payment = $('#editDetail' + id + ' input[name=date_payment]').val();
                    const time_payment = $('#editDetail' + id + ' input[name=time_payment]').val();

                    const params = {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        order_number: order_number,
                        date_payment: date_payment,
                        time_payment: time_payment,
                    }
                    console.log(params)
                    $.ajax({
                        type: "post",
                        url: `/add_payment/${p_id}`,
                        data: params,
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                })
                            }
                        }
                    });
                });
            });

            $('.del-btn').on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'ยืนยันการลบข้อมูล',
                    showDenyButton: true,
                    confirmButtonText: 'ยืนยัน',
                    denyButtonText: `ยกเลิก`,
                }).then((result) => {
                    if (!result.isConfirmed) return;
                    const params = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                    }
                    console.log(params)
                    $.ajax({
                        type: "post",
                        url: `/del_payment`,
                        data: params,
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
                });
            });


            $('.open-detail').click(function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                console.log('.detail-' + id);

                $('.detail-' + id).toggle();

            });
        });

        function setupDatatable() {
            $('.payment-datatable').DataTable({
                columnDefs : [
                    {className: "text-center", targets: [0,1,2,3,4,5]},
                    {orderable: false, targets: [5]},
                ]
            });
        }
    </script>
@endpush
