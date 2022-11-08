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
        @foreach ($payments as $i => $p)
        <tr>
            <td>{{ $p->order_number }}</td>
            <td>{{ number_format($p->amount, 0, '', ',') }}</td>
            <td>{{ $p->date_payment }}</td>
            <td>
                @if (isset($p->sum))
                {{ number_format($p->sum, 0, '', ',') }}
                @else
                <div class="badge rounded-pill badge-{{$p->status_color}} text-white">
                    {{ $p->status_name }}
                </div>
                @endif
            </td>
            <td>
                <div class="d-flex flex-column flex-md-row justify-content-center">
                    <button type="button" class="btn btn-warning btn-sm m-1" onclick="openModal('{{ $p->p_id }}')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm m-1 btn-delete-payment" data-pk="{{ $p->p_id }}">
                        <i class="fas fa-window-close"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
