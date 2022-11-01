<table class="table table-striped table-hover table-responsive-md" id="approveTable">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>ชื่อ</th>
            <th>เบอร์โทรศัพน์</th>
            <th>สินค้า</th>
            <th>ตรวจสอบ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $i => $ac)
            <tr>
                <td>{{ $i +1 }}</td>
                <td>{{ $ac->user->getFullName() }}</td>
                <td>{{ $ac->user->tel }}</td>
                <td>{{ $ac->products->name_th }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-sm" onclick="toggleModal({{ $ac->pc_id }})">ตรวจสอบ</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
