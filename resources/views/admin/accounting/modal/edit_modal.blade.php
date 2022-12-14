<div class="modal fade" id="editModal-{{ $index }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการผ่อน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form class="needs-validation update-form" novalidate>
                    <div class="container-product">
                        <h5 class="text-left badge badge-pill badge-primary custom-badge">สินค้า</h5>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleInputPassword1">รหัสลูกค้า</label>
                                <input type="text" class="form-control"
                                    value="{{ $data->number_customers }}" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">ราคาผ่อน</label>
                                <input type="text" class="form-control" name="price"
                                    value="{{ $data->price }}" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">ชื่อสินค้า</label>
                                <input type="text" class="form-control" name="product" value="{{ $data->product_name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleInputPassword1">แบรนด์สินค้า</label>
                                <input type="text" class="form-control" name="brand" value="{{ $data->brand_name }}" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">รายละเอียดสินค้า</label>
                                <input type="text" class="form-control" name="details" value="{{ $data->product_desc }}" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="container-status">
                        <h5 class="text-left badge badge-pill badge-primary custom-badge">รูปแบบการผ่อน / สถานะ</h5>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label>จำนวนเงินที่เปิดบิลผ่อน</label>
                                <input type="text" name="installment" id="installment" class="form-control" value="{{ $data->installment }}" required>
                            </div>
                            <div class="col-md-3">
                                <label>ประเภทการผ่อน</label>
                                <select name="type" class="form-control" required>
                                    @foreach ($installmentTypes as $it)
                                    <option value="{{ $it->it_id }}" {{ ($it->it_id == $data->type) ? 'selected' : '' }}>{{ $it->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>ประเภทการชำระ</label>
                                <select name="type_pay" class="form-control" required>
                                    @foreach ($paymentTypes as $pt)
                                    <option value="{{ $pt->id }}" {{ ($pt->id == $data->type_pay) ? 'selected' : '' }}>{{ $pt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>สถานะการผ่อน</label>
                                <select name="status_type" class="form-control" required>
                                    @foreach ($typeStatus as $type)
                                    <option value="{{ $type->s_id }}" {{ ($type->s_id == $data->status_type) ? 'selected' :
                                        '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="container-promotion">
                        <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
                        <div class="row mb-4">
                            <div class="col">
                                <label>ส่วนลด</label>
                                <input type="text" class="form-control" name="discount" value="{{ $data->discount }}">
                            </div>
                            <div class="col">
                                <label>รายละเอียดโปรโมชั่น</label>
                                <input type="text" class="form-control" name="detail_promotion" value="{{ $data->detail_promotion }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>ราคาผ่อนหลังจากหักส่วนลด</label>
                                <input type="text" class="form-control" name="balance_payment"
                                    value="{{ number_format($data->amount_after_discount, 2) }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>เปอร์เซ็นการชำระปัจจุบัน</label>
                                <input type="text" class="form-control" name="percen_current"
                                    value="{{ number_format($data->percen_current, 2, '.', '') }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label>เปอร์เซ็นการพิจารณา</label>
                                <input type="text" class="form-control" name="percen_consider"
                                    value="{{ number_format($data->percen_consider, 2, '.', '') }}" readonly>
                            </div>
                            {{-- <div class="col-md-6">
                                <label>จำนวนเงินเมื่อถึง % พิจารณา</label>
                                <input type="text" class="form-control" name="amount_consider"
                                    value="{{ $data->amount_consider }}" readonly>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-update" data-id="{{ $data->pc_id }}">บันทึก</button>
            </div>
        </div>
    </div>
</div>
