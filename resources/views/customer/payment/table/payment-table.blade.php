<table class="table table-striped table-hover table-responsive-md payment-datatable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">งวดที่</th>
            <th class="text-center">ยอดโอน</th>
            <th class="text-center">วันที่โอน</th>
            <th class="text-center">ยอดรวมชำระ</th>
            <th class="text-center">จัดการข้อมูล</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($account->payment as $i => $p)
        <tr>
            <td>{{ $p->order_number }}</td>
            <td>{{ number_format($p->amount, 0, '', ',') }}</td>
            <td>{{ $p->date_payment }}</td>
            <td>{{ number_format($p->sum, 0, '', ',') }}</td>
            <td>
                {{-- <button type="button" class="btn btn-primary btn-sm" onclick="openEditModal({{ $p->p_id }});">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $p->p_id }}">
                    <i class="fas fa-trash-alt"></i>
                </button> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
