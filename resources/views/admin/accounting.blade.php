@extends('layouts.menu')
@section('name_page', 'บัญชีลูกค้า')
@section('button_page')
    <style>
        .badge {
            color: white;
        }
    </style>
    <a type="button" class="btn btn-success" href="{{ url('add_account') }}">
        <i class="fas fa-user-plus fa-sm text-gray-50"></i> เพิ่มรายการบัญชี
    </a>


@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลบัญชีลูกค้า</h6>
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
                                <td>{{ $data->user==""?'not user':$data->user->number_customers }}</td>

                                <td>{{ $data->installmentType->name }}</td>

                                <td>{{ number_format($data->balance_payment, 0, '', ',') }}</td>
                                <td>{{ $data->percen_current }}</td>

                                <td>
                                    <span class="badge rounded-pill bg-{{ $data->statusType->color }}">
                                        {{ $data->statusType->name }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-dark" data-toggle="modal"
                                        data-target="#description{{ $index }}">รายละเอียด</button>
                                    <div class="modal fade" id="description{{ $index }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการผ่อน</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">user</label>
                                                            <input type="text" class="form-control" name="user"
                                                                value="{{ $data->user_id }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">price</label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="{{ $data->price }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">product</label>
                                                            <input type="text" class="form-control" name="product"
                                                                value="{{ $data->product }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">brand</label>
                                                            <input type="text" class="form-control" name="brand"
                                                                value="{{ $data->brand }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">details</label>
                                                            <input type="text" class="form-control" name="detail"
                                                                value="{{ $data->details }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">discount</label>
                                                            <input type="text" class="form-control" name="discount"
                                                                value="{{ $data->discount }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">installment</label>
                                                            <input type="text" class="form-control" name="installment"
                                                                value="{{ $data->installment }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">balance_payment</label>
                                                            <input type="text" class="form-control"
                                                                name="balance_payment" value="{{ $data->balance_payment }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">percen_current</label>
                                                            <input type="text" class="form-control" name="percen_current"
                                                                value="{{ $data->percen_current }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">percen_consider</label>
                                                            <input type="text" class="form-control"
                                                                name="percen_consider"
                                                                value="{{ $data->percen_consider }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">amount_consider</label>
                                                            <input type="text" class="form-control"
                                                                name="amount_consider"
                                                                value="{{ $data->amount_consider }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">status_type</label>
                                                            <input type="text" class="form-control" name="status_type"
                                                                value="{{ $data->status_type }}"readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">type_pay</label>
                                                            <input type="text" class="form-control" name="type_pay"
                                                                value="{{ $data->type_pay }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">detail_promotion</label>
                                                            <input type="text" class="form-control"
                                                                name="detail_promotion"
                                                                value="{{ $data->detail_promotion }}" readonly>
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">type</label>
                                                            <input type="text" class="form-control" name="type"
                                                                value="{{ $data->type }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editModal{{ $index }}">แก้ไขข้อมูล</button>
                                    <div class="modal fade" id="editModal{{ $index }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขรายละเอียดการผ่อน
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
                                                            <label for="exampleInputPassword1">user</label>
                                                            <input type="text" class="form-control" name="user"
                                                                value="{{ $data->user_id }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">price</label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="{{ $data->price }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">product</label>
                                                            <input type="text" class="form-control" name="product"
                                                                value="{{ $data->product }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">brand</label>
                                                            <input type="text" class="form-control" name="brand"
                                                                value="{{ $data->brand }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">details</label>
                                                            <input type="text" class="form-control" name="details"
                                                                value="{{ $data->details }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">discount</label>
                                                            <input type="text" class="form-control" name="discount"
                                                                value="{{ $data->discount }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">installment</label>
                                                            <input type="text" class="form-control" name="installment"
                                                                value="{{ $data->installment }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">balance_payment</label>
                                                            <input type="text" class="form-control"
                                                                name="balance_payment"
                                                                value="{{ $data->balance_payment }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">percen_current</label>
                                                            <input type="text" class="form-control"
                                                                name="percen_current"
                                                                value="{{ $data->percen_current }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">percen_consider</label>
                                                            <input type="text" class="form-control"
                                                                name="percen_consider"
                                                                value="{{ $data->percen_consider }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">amount_consider</label>
                                                            <input type="text" class="form-control"
                                                                name="amount_consider"
                                                                value="{{ $data->amount_consider }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">status_type</label>
                                                            <input type="text" class="form-control" name="status_type"
                                                                value="{{ $data->status_type }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">type_pay</label>
                                                            <input type="text" class="form-control" name="type_pay"
                                                                value="{{ $data->type_pay }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">detail_promotion</label>
                                                            <input type="text" class="form-control"
                                                                name="detail_promotion"
                                                                value="{{ $data->detail_promotion }}">
                                                        </div>
                                                        <div class="col text-left">
                                                            <label for="exampleInputPassword1">type</label>
                                                            <input type="text" class="form-control" name="type"
                                                                value="{{ $data->type }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                    <button type="submit" class="btn btn-primary update-btn"
                                                        data-id="{{ $index }}">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger del"
                                        data-id="{{ $data->pc_id }}">ลบ</button>
                                </td>
                            </tr>
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
            $('#addAccBtn').on('click', function() {
                showAlertWithConfirm('error', 'test', 'test')
                    .then(ok => {
                        if (!ok) return;

                        $('#addAccForm').submit();
                    });
            });
        });

        $('.update-btn').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'ยืนยันการแก้ไขข้อมูล',
                showDenyButton: true,
                confirmButtonText: 'ยืนยัน',
                denyButtonText: `ยกเลิก`,
            }).then((result) => {
                if (!result.isConfirmed) return;

                const pc_id = $('#editModal' + id + ' .update-form input[name=pc_id]').val();
                const price = $('#editModal' + id + ' .update-form input[name=price]').val();
                const product = $('#editModal' + id + ' .update-form input[name=product]').val();
                const brand = $('#editModal' + id + ' .update-form input[name=brand]').val();
                const details = $('#editModal' + id + ' .update-form input[name=details]').val();
                const discount = $('#editModal' + id + ' .update-form input[name=discount]').val();
                const installment = $('#editModal' + id + ' .update-form input[name=installment]').val();
                const balance_payment = $('#editModal' + id + ' .update-form input[name=balance_payment]')
                    .val();
                const percen_current = $('#editModal' + id + ' .update-form input[name=percen_current]')
                    .val();
                const percen_consider = $('#editModal' + id + ' .update-form input[name=percen_consider]')
                    .val();
                const amount_consider = $('#editModal' + id + ' .update-form input[name=amount_consider]')
                    .val();
                const detail_promotion = $('#editModal' + id + ' .update-form input[name=detail_promotion]')
                    .val();
                const params = {
                    _token: '{{ csrf_token() }}',
                    price: price,
                    product: product,
                    brand: brand,
                    details: details,
                    discount: discount,
                    installment: installment,
                    balance_payment: balance_payment,
                    percen_current: percen_current,
                    percen_consider: percen_consider,
                    amount_consider: amount_consider,
                    // type: data.type,
                    // status_type: data.status_type,
                    // type_pay: data.type_pay,
                    detail_promotion: detail_promotion,
                }
                $.ajax({
                    type: "post",
                    url: `/update_account/${pc_id}`,
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
                        url: "{{ route('del.acc') }}",
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
