<table class="table table-striped table-hover table-responsive-md installment-datatable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>ประเภท</th>
            <th>เปิดใช้งาน</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($installmentTypes as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input custom-sw" id="customSwitch-{{ $i }}" data-id="{{ $item->it_id }}" data-name="{{ $item->name }}" {{ $item->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitch-{{ $i }}"></label>
                    </div>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal({{ $item->it_id }});">
                    <i class="fas fa-edit"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->it_id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
