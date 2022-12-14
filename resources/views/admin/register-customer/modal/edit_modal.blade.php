<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body text-left">
                <form class="needs-validation form-update-user" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-danger">*</label><label for="number_customers">รหัสลูกค้า</label>
                            <input
                                type="text"
                                class="form-control"
                                id="number_customers"
                                name="number_customers"
                                placeholder="ระบุรหัสลูกค้า"
                                readonly
                                required
                            >
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="text-danger">*</label><label for="first_name">ชื่อจริง</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="first_name"
                                    name="first_name"
                                    placeholder="ระบุชื่อลูกค้า"
                                    required
                                >
                            </div>
                            <div class="col">
                                <label class="text-danger">*</label><label for="last_name">นามสกุล</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="last_name"
                                    name="last_name"
                                    placeholder="ระบุนามสกุลลูกค้า"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="cid">เลขบัตรประชาชน</label>
                            <input
                                type="text"
                                class="form-control @error('cid') is-invalid @enderror"
                                id="cid"
                                name="cid"
                                placeholder="x-xxxx-xxxxx-xx-x"
                                onkeyup="autoTab(this);"
                                required
                            >

                            @error('cid')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="age">อายุ</label>
                            <input
                                type="text"
                                class="form-control"
                                id="age"
                                name="age"
                                placeholder="อายุลูกค้า"
                            >
                        </div>

                        <div class="form-group">
                            <label class="text-danger">*</label><label class="form-label" for="tel">เบอร์โทร</label>
                            <input
                                type="text"
                                class="form-control"
                                id="tel"
                                name="tel"
                                placeholder="เบอร์โทรลูกค้า"
                                required
                            >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-update">บันทึก</button>
            </div>
        </div>
    </div>
</div>
