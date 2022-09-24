<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขประเภทการชำระ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation form-payment-type" novalidate>
                    <div class="form-group">
                        <label for="payment_type">ประเภท</label>
                        <input type="text" name="name" id="payment_type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch" name="is_active">
                            <label class="custom-control-label" for="customSwitch">เปิดใช้งาน</label>
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
