<table class="table table-striped table-hover table-responsive-md accounting-datatable" id="dataTable" width="100%"
    cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>รหัสลูกค้า</th>
            <th>ชื่อ-นามสกุล</th>
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
            <td>{{ $data->number_customers }}</td>
            <td>{{ $data->first_name }} {{ $data->last_name }}</td>
            <td>{{ $data->installment_name }}</td>
            <td>{{ number_format($data->balance_payment, 0, '', ',') }}</td>
            <td>{{ number_format($data->percen_current, 2, '.', '') }}</td>
            <td>
                <span class="badge rounded-pill bg-{{ $data->type_color }}">
                    {{ $data->type_name }}
                </span>
            </td>
            <td>
                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                    data-target="#showModal-{{ $index }}">
                    <i class="fas fa-eye"></i>
                </button>
                @include('admin.accounting.modal.show_modal')

                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                    data-target="#editModal-{{ $index }}">
                    <i class="fas fa-edit"></i>
                </button>
                @include('admin.accounting.modal.edit_modal')

                <button type="button" class="btn btn-danger btn-sm del" data-id="{{ $data->pc_id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
