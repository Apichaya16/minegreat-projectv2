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

                    <button type="button" class="btn btn-primary btn-sm" onclick="openModal({{ $data->pc_id }});">
                        <i class="fas fa-plus"></i>
                    </button>
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
                                onclick="openEditModal({{ $p->p_id }});"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm btn-delete"
                                data-id="{{ $p->p_id }}"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endforeach
    </tbody>
</table>
