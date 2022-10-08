<table class="table table-striped table-hover table-responsive-md user-datatable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>รหัสลูกค้า</th>
            <th>ชื่อลูกค้า</th>
            <th>นามสกุล</th>
            <th>อายุ</th>
            <th>เบอร์โทร</th>
            <th>เลขบัตรประชาชน</th>
            <th>จัดการข้อมูล</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $i => $user)
        <tr>
            <td>{{ $user->number_customers }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->age }}</td>
            <td>{{ $user->tel }}</td>
            <td>
                @if ($user->cid != '')
                    {{ substr_replace($user->cid, 'XXXXX-XX-', 7, -1) }}
                @endif
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal({{ $user->u_id }});">
                    <i class="fas fa-edit"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm del" data-id="{{ $user->u_id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
