<table class="table table-striped table-hover table-responsive-md brand-datatable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>แบรนด์</th>
            <th>เปิดใช้งาน</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($brands as $i => $br)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $br->name_en }}</td>
                <td>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input custom-sw" id="activeSW-{{ $i }}" data-id="{{ $br->id }}" {{ $br->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="activeSW-{{ $i }}"></label>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal({{ $br->id }});">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $br->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
