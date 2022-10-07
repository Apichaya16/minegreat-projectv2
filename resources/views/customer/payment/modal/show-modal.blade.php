<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="container-product">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">สินค้า</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="cusId">รหัสลูกค้า</label>
                            <input type="text" class="form-control" id="cusId" readonly>
                        </div>
                        <div class="col">
                            <label for="price">ราคาผ่อน</label>
                            <input type="text" class="form-control" id="price" readonly>
                        </div>
                        <div class="col">
                            <label for="productName">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="productName" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="brand">แบรนด์สินค้า</label>
                            <input type="text" class="form-control" id="brand" readonly>
                        </div>
                        <div class="col">
                            <label for="desc">รายละเอียดสินค้า</label>
                            <input type="text" class="form-control" id="desc" readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-status">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">รูปแบบการผ่อน /
                        สถานะ</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label>จำนวนเงินที่เปิดบิลผ่อน</label>
                            <input type="text" class="form-control" id="installmentPrice" readonly>
                        </div>
                        <div class="col">
                            <label>ประเภทการชำระ</label>
                            <input type="text" class="form-control" id="installmentType" readonly>
                        </div>
                        <div class="col">
                            <label>สถานะการผ่อน</label>
                            <input type="text" class="form-control" id="status" readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-promotion">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="discount">ส่วนลด</label>
                            <input type="text" class="form-control" id="discount" readonly>
                        </div>
                        <div class="col">
                            <label for="promotion">รายละเอียดโปรโมชั่น</label>
                            <input type="text" class="form-control" id="promotion" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="priceDiscount">ราคาผ่อนหลังจากหักส่วนลด</label>
                            <input type="text" class="form-control" id="priceDiscount" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="percent">เปอร์เซ็นการชำระปัจจุบัน</label>
                            <input type="text" class="form-control" id="percent" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="percentPass">เปอร์เซ็นการพิจารณา</label>
                            <input type="text" class="form-control" id="percentPass" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="priceForPass">จำนวนเงินเมื่อถึง % พิจารณา</label>
                            <input type="text" class="form-control" id="priceForPass" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
