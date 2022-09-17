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
                            <label for="exampleInputPassword1">user</label>
                            <input type="text" class="form-control" value="{{ $data->user->number_customers }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">price</label>
                            <input type="text" class="form-control" value="{{ number_format($data->price, 2) }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">product</label>
                            <input type="text" class="form-control" value="{{ $data->product }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="exampleInputPassword1">brand</label>
                            <input type="text" class="form-control" value="{{ $data->brand }}" readonly>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">details</label>
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
                            <label>installment</label>
                            <input type="text" class="form-control" value="{{ $data->installmentType->name }}" readonly>
                        </div>
                        <div class="col">
                            <label>type_pay</label>
                            <input type="text" class="form-control" value="{{ $data->paymentType->name }}" readonly>
                        </div>
                        <div class="col">
                            <label>status_type</label>
                            <input type="text" class="form-control" value="{{ $data->statusType->name }}" readonly>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="container-promotion">
                    <h5 class="text-left badge badge-pill badge-primary custom-badge">การพิจารณา</h5>
                    <div class="row mb-4">
                        <div class="col">
                            <label>discount</label>
                            <input type="text" class="form-control" name="discount" value="{{ $data->discount }}"
                                readonly>
                        </div>
                        <div class="col">
                            <label>detail_promotion</label>
                            <input type="text" class="form-control" value="{{ $data->detail_promotion }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>balance_payment</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($data->balance_payment, 2) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>percen_current</label>
                            <input type="text" class="form-control" value="{{ $data->percen_current }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>percen_consider</label>
                            <input type="text" class="form-control" value="{{ $data->percen_consider }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>amount_consider</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($data->amount_consider, 2) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
