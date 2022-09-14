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
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>สินค้า</th>
                           <th>แบรนด์</th>
                           <th>รายละเอียด</th>
                             <th>ประเภทการส่งยอด</th>
                           <th>ส่วนลดหรือโปรโมชั่น</th>
                           <th>จำนวนเงินเปิดบิล(บาท)</th>
                           <th>ราคาผ่อน</th>
                           <th>% การพิจารณา</th>
                           <th>จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $data)
                            <tr>
                                <td>{{ $data->product }}</td>
                                <td>{{ $data->brand }}</td>
                                <td>{{ $data->details }}</td>
                                        <td>{{ $data->type_pay }}</td>
                                <td>{{ $data->discount }}</td>
                                <td>{{ $data->installment }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->percen_consider }}</td>
                               
                                <td>
                                    <span class="badge rounded-pill bg-{{$data->statusType->color}}"> {{ $data->statusType->name }}</span>
                                </td>
                                <td>{{ $data->amount_consider }}</td>
                                <td>
                                    <button type="button" class="btn btn-dark" data-toggle="modal"
                                        data-target="#edit_user">รายละเอียด</button>
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#edit_user">แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger del"
                                    data-id="{{ $data->u_id }}">ลบ</button>
                                </td>
                            </tr>
                            {{-- <tr><tr>
                                <th>สินค้า</th>
                           <th>แบรนด์</th>
                           <th>รายละเอียด</th>
                             <th>ประเภทการส่งยอด</th>
                           <th>ส่วนลดหรือโปรโมชั่น</th>
                           <th>จำนวนเงินเปิดบิล(บาท)</th>
                           <th>ราคาผ่อน</th>
                           <th>% การพิจารณา</th>
                           <th>จำนวนเงิน</th>
                           </tr>
                           <tr>
 <td>{{ $data->product }}</td>
                           <td>{{ $data->brand }}</td>
                           <td>{{ $data->details }}</td>
                                   <td>{{ $data->type_pay }}</td>
                           <td>{{ $data->discount }}</td>
                           <td>{{ $data->installment }}</td>
                           <td>{{ $data->price }}</td>
                            <td>{{ $data->percen_consider }}</td>
                           <td>{{ $data->amount_consider }}</td>
                           </tr></tr> --}}
                            
                        @endforeach
                    </tbody>
                </table>
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

    </script>
@endpush

