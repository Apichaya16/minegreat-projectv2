<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">จัดการสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation form-product" novalidate>
                    <div class="form-group">
                        <label for="payment_type">แบรนด์</label>
                        <input type="text" name="brand" id="brand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_type">ชื่อสินค้า (ภาษาไทย)</label>
                        <input type="text" name="name_th" id="name_th" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_type">ชื่อสินค้า (ภาษาอังกฤษ)</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_type">รายละเอียด (ภาษาไทย)</label>
                        <input type="text" name="desc_th" id="desc_th" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_type">รายละเอียด (ภาษาอังกฤษ)</label>
                        <input type="text" name="desc_en" id="desc_en" class="form-control" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="payment_type">ไอดี</label>
                        <input type="text" name="product_id" id="product_id" class="form-control" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="payment_type">สี</label>
                        <input type="text" name="color" id="color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_type">ความจุ</label>
                        <input type="text" name="capacity" id="capacity" class="form-control" required>
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
