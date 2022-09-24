<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    เพิ่มรายละเอียดการผ่อน
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body update-form">
                <form class="needs-validation form-create-payment" novalidate>
                    <input type="hidden" id="pc_id" name="pc_id">
                    <input type="hidden" id="filter" name="filter" value="{{ Request::get('filter') }}">

                    <div class="row mb-4">
                        <div class="col text-left">
                            <label for="order_number">งวดที่</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" required>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-submit-payment">บันทึก</button>
            </div>
        </div>
    </div>
</div>
