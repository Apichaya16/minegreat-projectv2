@extends('customer.layouts.customer')

@section('content')
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>รายละเอียดบัญชี</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <label>วันที่เป็นสมาชิก : {{ auth()->user()->created_at }}</label>
                        <label>หมายเลขสมาชิก : {{ auth()->user()->number_customers }}</label>
                        <label>ชื่อ-นามสกุล : {{ auth()->user()->getFullName() }}</label>
                        <label>อายุ : {{ auth()->user()->age }}</label>
                        <label>เบอร์โทร : {{ auth()->user()->tel }}</label>
                        @php
                            $lineId = auth()->user()->line_id;
                            if ($lineId == '') {
                                $lineId = '-';
                            }
                        @endphp
                        <label>Line : {{ $lineId }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>รายการผ่อนชำระ</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md table-striped payment-datatble w-100" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รายการ</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $i => $acc)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $acc->products->brands->name_en }} {{ $acc->products->name_en }}</td>
                                    <td>
                                        <div class="badge badge-pill badge-{{ $acc->statusType->color }}">
                                            {{ $acc->statusType->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-center">
                                            <button type="button" class="btn btn-primary btn-sm m-1" onclick="openShowModal('{{ $acc->pc_id }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('customer.payment.create', ['accId' => $acc->pc_id]) }}" class="btn btn-warning btn-sm m-1">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm m-1">
                                                <i class="fas fa-window-close"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('customer.payment.modal.show-modal')
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
    $(function () {
        setupDatatable();
    });
    function setupDatatable() {
        $('.payment-datatble').DataTable({
            columnDefs: [
                {className: 'text-center', targets: [0,2,3]},
                {orderable: false, targets: 3}
            ]
        });
    }
    function openShowModal(id) {
        showLoading();
        $.get("{{ route('customer.payment.getPaymentDetailById', '') }}/" + id,
            function (resps, textStatus, jqXHR) {
                hideLoading();
                const {data} = resps
                console.log(data);
                $('#cusId').val(data.number_customers);
                $('#price').val(data.price);
                $('#productName').val(data.product_name);
                $('#brand').val(data.brand_name);
                $('#desc').val(data.product_desc);
                $('#installmentPrice').val(data.installment);
                $('#installmentType').val(data.installment_name);
                $('#paymentType').val(data.payment_name);
                $('#status').val(data.type_name);

                // discount
                $('#discount').val(data.discount || '-');
                $('#promotion').val(data.detail_promotion || '-');
                $('#priceDiscount').val(data.amount_after_discount);
                $('#percent').val(data.percen_current);
                $('#percentPass').val(data.percen_consider);
                $('#priceForPass').val(data.amount_consider);
                $('#showModal').modal('show');
            },
        );
    }
</script>
@endpush
