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
            {{-- {{$accounts}} --}}
            <div class="table-responsive text-center">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
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
                            <tr>
                                <td>{{ $data->user == '' ? 'not user' : $data->user->number_customers }}</td>

                                <td>{{ $data->installmentType->name }}</td>

                                <td>{{ number_format($data->balance_payment, 0, '', ',') }}</td>
                                <td>{{ number_format($data->percen_current, 2, '.', ',') }}</td>

                                <td>
                                    <span class="badge rounded-pill bg-{{ $data->statusType->color }}" style="color: white">
                                        {{ $data->statusType->name }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $index }}">อัพเดตยอด</button>
                                    <button type="button" class="btn btn-dark open-detail"
                                        data-id="{{ $index }}">รายละเอียด</button>

                                    <div class="modal fade" id="editModal{{ $index }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
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
                                    </div>
                                </td>
                            </tr>

                            <thead class="thead-dark detail-{{ $index }}" style="display: none;">
                                {{-- @if ($data->payment != '') --}}
                                <tr class="">

                                    <th>งวดที่</th>
                                    <th colspan="2">ยอดโอน</th>
                                    <th>วันที่โอน</th>
                                    <th>ยอดรวมชำระ</th>
                                    <th>จัดการข้อมูล</th>

                                </tr>
                            </thead>
                            @foreach ($data->payment as $k => $p)
                                <tr class="detail-{{ $index }}" style="display: none;">
                                    <td>{{ $p->order_number }}</td>
                                    <td colspan="2">{{ number_format($p->amount, 0, '', ',') }}</td>
                                    <td>{{ $p->date_payment }}</td>
                                    <td>{{ number_format($p->sum, 0, '', ',') }}
                                    </td>
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editDetail{{ $k }}">แก้ไขข้อมูล</button>
                                        <button type="button" class="btn btn-danger del-btn"
                                            data-id="{{ $p->p_id }}">ลบ</button>

                                        <div class="modal fade" id="editDetail{{ $k }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
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
                                                            data-dismiss="modal">Close</button>

                                                        <button type="submit" class="btn btn-primary edit-btn"
                                                            data-id="{{ $k }}">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="float: right">
                {!! $accounts->links() !!}
                @if (!$accounts->hasPages())
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

@push('scripts')
    <script>
        $(function() {
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
    </script>
@endpush
