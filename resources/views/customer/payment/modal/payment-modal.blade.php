<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">แจ้งโอน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="paymentForm" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body update-form">
                    <input type="hidden" id="p_id" name="p_id">
                    <input type="hidden" id="account_id" name="account_id" value="{{$account->pc_id}}">

                    <div class="d-flex justify-content-end">
                        <div class="badge rounded-pill text-white py-1" id="status"></div>
                    </div>

                    <div class="row mb-4">
                        <div class="col text-left">
                            <label for="order_number">งวดที่</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" readonly required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col text-left">
                            <label for="amount">ยอดโอน</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col text-left">
                            <label for="date_payment">วันที่โอน</label>
                            <input type="date" class="form-control" id="date_payment" name="date_payment" required>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col text-left">
                            <label for="time_payment">เวลาโอน</label>
                            <input type="time" class="form-control" id="time_payment" name="time_payment" required>
                        </div>
                    </div>
                    <div class="preview-image">
                        <img alt="SLIP" class="img-thumbnail d-none" id="preview_image">
                    </div>
                    <div class="form-group">
                        <label for="slip_image">แนบสลิป</label>
                        <input type="file" class="form-control-file" id="slip_image" name="slip_image" required>
                        <div class="invalid-feedback">กรุณาเลือกรูปสลิป</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary btn-submit-payment">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
