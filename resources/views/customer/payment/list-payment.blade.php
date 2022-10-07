@extends('customer.layouts.customer')

@section('content')
<div class="container-fluid">
    <div class="container-product">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">สินค้า</h5>
        <div class="row mb-4">
            <div class="col">
                <label for="exampleInputPassword1">รหัสลูกค้า</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">ราคาผ่อน</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">ชื่อสินค้า</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <label for="exampleInputPassword1">แบรนด์สินค้า</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col">
                <label for="exampleInputPassword1">รายละเอียดสินค้า</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-status">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">รูปแบบการผ่อน /
            สถานะ</h5>
        <div class="row mb-4">
            <div class="col">
                <label>จำนวนเงินที่เปิดบิลผ่อน</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col">
                <label>ประเภทการชำระ</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col">
                <label>สถานะการผ่อน</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-promotion">
        <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
        <div class="row mb-4">
            <div class="col">
                <label>ส่วนลด</label>
                <input type="text" class="form-control" name="discount" readonly>
            </div>
            <div class="col">
                <label>รายละเอียดโปรโมชั่น</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label>ราคาผ่อนหลังจากหักส่วนลด</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label>เปอร์เซ็นการชำระปัจจุบัน</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label>เปอร์เซ็นการพิจารณา</label>
                <input type="text" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label>จำนวนเงินเมื่อถึง % พิจารณา</label>
                <input type="text" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div id="container-table">
        @include('customer.payment.table.payment-table')
    </div>
</div>
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
        setupDataTable();
    });
    function setupDataTable() {
        $('.payment-datatable').DataTable({
            // columnDefs : [
            //     {className: "text-center", targets: [0,1,2,3,4,5]},
            //     {orderable: false, targets: [1,4,5]},
            // ]
        });
    }
</script>
@endpush
