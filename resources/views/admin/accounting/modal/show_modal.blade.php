<div class="modal fade" id="showModal-{{ $index }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการผ่อน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">

                <div class="container-product">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">สินค้า</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="exampleInputPassword1">รหัสลูกค้า</label>
                            <input type="text" class="form-control" value="{{ $data->user->number_customers }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">ราคาผ่อน</label>
                            <input type="text" class="form-control" value="{{ number_format($data->price, 2) }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">ชื่อสินค้า</label>
                            <input type="text" class="form-control" value="{{ $data->product }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="exampleInputPassword1">แบรนด์สินค้า</label>
                            <input type="text" class="form-control" value="{{ $data->brand }}" readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">รายละเอียดสินค้า</label>
                            <input type="text" class="form-control" value="{{ $data->details }}" readonly>
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
                            <input type="text" class="form-control" value="{{ $data->installmentType->name }}" readonly>
                        </div>
                        <div class="col">
                            <label>ประเภทการชำระ</label>
                            <input type="text" class="form-control" value="{{ $data->paymentType->name }}" readonly>
                        </div>
                        <div class="col">
                            <label>สถานะการผ่อน</label>
                            <input type="text" class="form-control" value="{{ $data->statusType->name }}" readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-promotion">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label>ส่วนลด</label>
                            <input type="text" class="form-control" name="discount" value="{{ $data->discount }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label>รายละเอียดโปรโมชั่น</label>
                            <input type="text" class="form-control" value="{{ $data->detail_promotion }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>ราคาผ่อนหลังจากหักส่วนลด</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($data->balance_payment, 2) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>เปอร์เซ็นการชำระปัจจุบัน</label>
                            <input type="text" class="form-control" value="{{ $data->percen_current }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>เปอร์เซ็นการพิจารณา</label>
                            <input type="text" class="form-control" value="{{ $data->percen_consider }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>จำนวนเงินเมื่อถึง % พิจารณา</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($data->amount_consider, 2) }}" readonly>
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
