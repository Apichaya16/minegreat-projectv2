<table class="table table-striped table-hover table-responsive-md payment-datatable" width="100%" cellspacing="0">
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
            <tr class="text-center">
                <td>{{ $data->number_customers == '' ? 'not user' : $data->number_customers }}</td>
                <td class="text-left">{{ $data->first_name }} {{ $data->last_name }}</td>
                <td>{{ $data->installment_name }}</td>
                <td>{{ number_format($data->balance_payment, 0, '', ',') }}</td>
                <td>{{ number_format($data->percen_current, 2, '.', ',') }}</td>
                <td>
                    <span class="badge rounded-pill bg-{{ $data->type_color }} text-white">
                        {{ $data->type_name }}
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

                    <button type="button" class="btn btn-primary btn-sm" onclick="openModal('{{ $data->pc_id }}');">
                        <i class="fas fa-plus"></i>
                    </button>
                </td>
            </tr>

            <thead class="bg-primary detail-{{ $index }}" style="display: none;">
                <tr class="text-white">
                    <th class="text-center">งวดที่</th>
                    <th class="text-center" colspan="2">ยอดโอน</th>
                    <th class="text-center" colspan="2">วันที่โอน</th>
                    <th class="text-center">ยอดรวมชำระ</th>
                    {{-- <th class="text-center">สถานะ</th> --}}
                    <th class="text-center">จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $k => $p)
                    @if ($data->pc_id == $p->account_id)
                    <tr class="detail-{{ $index }} text-center" style="display: none;">
                        <td>{{ $p->order_number }}</td>
                        <td colspan="2">{{ number_format($p->amount, 0, '', ',') }}</td>
                        <td colspan="2">{{ $p->date_payment }}</td>
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
                            <button
                                type="button"
                                class="btn btn-warning btn-sm"
                                onclick="openEditModal('{{ $p->p_id }}');"
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
                    @endif
                @endforeach
            </tbody>
        @endforeach
    </tbody>
</table>
