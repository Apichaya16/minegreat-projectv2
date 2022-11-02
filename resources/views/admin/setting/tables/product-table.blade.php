<table class="table table-striped table-hover table-responsive-md product-datatable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>สินค้า</th>
            <th>รุ่น</th>
            <th>เปิดใช้งาน</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->brands->name_en }}</td>
            <td>{{ $item->name_th }}</td>
            <td>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input custom-sw" id="activeSW-{{ $i }}" data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="activeSW-{{ $i }}"></label>
                    </div>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal({{ $item->id }});">
                    <i class="fas fa-edit"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
