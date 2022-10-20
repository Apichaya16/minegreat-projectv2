<!-- Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="brandModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">จัดการแบรนด์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation form-color" novalidate>
                    <div class="form-group">
                        <label for="size">แบรนด์ (ภาษาไทย)</label>
                        <input type="text" name="name_th" id="name_th" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="size">แบรนด์ (ภาษาอังกฤษ)</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
                            <label class="custom-control-label" for="is_active">เปิดใช้งาน</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-submit">บันทึก</button>
            </div>
        </div>
    </div>
</div>
