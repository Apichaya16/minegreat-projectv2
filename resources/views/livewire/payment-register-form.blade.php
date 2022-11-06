<div>
    <div class="text-center">
        <div class="d-flex justify-content-center">
            <!-- progressbar -->
            <ul class="progressbar mb-5">
                <li class="{{ $currentStep != 1 ? '' : 'active' }}"><a href="#" type="button">สินค้า</a></li>
                <li class="{{ $currentStep != 2 ? '' : 'active' }}"><a href="#" type="button">การผ่อน</a></li>
                <li class="{{ $currentStep != 3 ? '' : 'active' }}"><a href="#" type="button">ข้อมูลส่วนตัว</a></li>
            </ul>
        </div>
    </div>
    {{-- STEP1 --}}
    <div class="row setup-content justify-content-center {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3>เลือกสินค้าที่ต้องการ</h3>
                <div class="form-group">
                    <label for="brandProduct">แบรนด์:</label>
                    <select class="form-control @error('brandProduct') is-invalid @enderror" wire:model.defer="brandProduct" id="brandProduct">
                        <option>เลือกแบรนด์</option>
                        @foreach ($brands as $b)
                            <option value="{{ $b->id }}">{{ $b->name_en }}</option>
                        @endforeach
                    </select>
                    @error('brandProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="modelProduct">รุ่น:</label>
                    <select class="form-control @error('modelProduct') is-invalid @enderror" wire:model.defer="modelProduct" id="modelProduct">
                        <option>เลือกรุ่น</option>
                    </select>
                    @error('modelProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="colorProduct">สี:</label>
                    <select class="form-control @error('colorProduct') is-invalid @enderror" wire:model.defer="colorProduct" id="colorProduct">
                        <option>เลือกสี</option>
                    </select>
                    @error('colorProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="capacityProduct">ความจุ:</label>
                    <select class="form-control @error('capacityProduct') is-invalid @enderror" wire:model.defer="capacityProduct" id="capacityProduct">
                        <option>เลือกความจุ</option>
                    </select>
                    @error('capacityProduct') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <button class="btn btn-primary btn-block nextBtn pull-right" wire:click="firstStepSubmit" type="button" wire:loading.attr="disabled">
                    <span wire:loading.remove>ถัดไป</span>
                    <span wire:loading>ถัดไป...</span>
                </button>
            </div>
        </div>
    </div>
    {{-- STEP2 --}}
    <div class="container-fluid setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
        <h3>เลือกรูปแบบการผ่อนที่ต้องการ
            <div class="float-right">
                <input type="hidden" name="installmentType" id="installmentType" class="@error('installmentType') is-invalid @enderror" wire:model.defer="installmentType">
                @error('installmentType')
                    <span class="invalid-feedback">
                        <p class="text-danger">กรุณาเลือกการผ่อน</p>
                    </span>
                @enderror
            </div>
        </h3>
        <div class="row">
            @foreach ($installmentTypes as $i)
                <div class="col-md-4 mb-4" style="height: 150px">
                    <div class="card card-installment-type position-relative shadow-sm {{ $i->it_id == $installmentType ? 'active' : '' }} h-100" data-pk="{{ $i->it_id }}">
                        @if (isset($i->ribbon))
                            <div class="ribbon {{$i->ribbon_color}}">
                                <span>{{$i->ribbon}}</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h3>{{ $i->name }}</h3>
                            <p>{{ $i->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="price">ราคาสินค้า:</label>
                    <input type="text" class="form-control" wire:model.defer="price" id="price" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="balance">คงเหลือ:</label>
                    <input type="text" class="form-control" wire:model.defer="balance" id="balance" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="installment">จำนวนเงินเปิดบิลผ่อน:</label>
                    <input type="text" class="form-control @error('installment') is-invalid @enderror" wire:model.defer="installment" id="installment">
                    @error('installment') <span class="invalid-feedback">กรุณากรอกข้อมูล</span> @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="paymentType">รูปแบบการจ่ายงวด:</label>
                    <select class="form-control @error('paymentType') is-invalid @enderror" wire:model.defer="paymentType" id="paymentType">
                        <option>เลือกรูปแบบการจ่ายงวด</option>
                        @foreach ($paymentTypes as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @error('paymentType') <span class="invalid-feedback">กรุณากรอกข้อมูล</span> @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(1)">ย้อนกลับ</button>
            <button class="btn btn-primary nextBtn pull-right" type="button" wire:click="secondStepSubmit" wire:loading.attr="disabled">
                <span wire:loading.remove>ถัดไป</span>
                <span wire:loading>ถัดไป...</span>
            </button>
        </div>
    </div>
    {{-- STEP3 --}}
    <div class="container-fluid setup-content {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>ข้อมูลผู้ลงทะเบียน</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="customerCode">รหัสสมาชิก:</label>
                                    <input type="text" class="form-control @error('customerCode') is-invalid @enderror" id="customerCode" value="{{ auth()->user()->number_customers }}" readonly>
                                    @error('customerCode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">อีเมล์:</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ auth()->user()->email }}" readonly>
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="firstname">ชื่อ:</label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{ auth()->user()->first_name }}" readonly>
                                    @error('firstname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="lastname">นามสกุล:</label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" value="{{ auth()->user()->last_name }}" readonly>
                                    @error('lastname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tel">เบอร์โทรศัพท์:</label>
                                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" value="{{ auth()->user()->tel }}" readonly>
                                    @error('tel') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cid">เลขบัตรประชาชน:</label>
                                    <input type="text" class="form-control @error('cid') is-invalid @enderror" id="cid" value="{{ auth()->user()->cid }}" readonly>
                                    @error('cid') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>ข้อมูลสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="finalBrand">ยี่ห้อ:</label>
                                    @foreach ($brands as $b)
                                        @if ($b->id == $brandProduct)
                                            <input type="text" class="form-control" id="finalBrand" value="{{ $b->name_th }}" readonly>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="finalModel">รุ่น:</label>
                                    <input type="text" class="form-control" id="finalModel" wire:model.defer="modelName" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="finalColor">สี:</label>
                                    <input type="text" class="form-control" id="finalColor" wire:model.defer="colorName" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="finalCapacity">ความจุ:</label>
                                    <input type="text" class="form-control" id="finalCapacity" wire:model.defer="capacityName" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="3price">ราคาสินค้า:</label>
                                    <input type="text" class="form-control" id="3price" wire:model.defer="price" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="3installment">จำนวนเงินเปิดบิลผ่อน:</label>
                                    <input type="text" class="form-control" id="3installment" wire:model.defer="installment" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="3balance">คงเหลือ:</label>
                                    <input type="text" class="form-control" id="3balance" wire:model.defer="balance" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">ย้อนกลับ</button>
            <button class="btn btn-success pull-right" wire:click="showConfirm" type="button" wire:loading.attr="disabled">ลงทะเบียน</button>
        </div>
    </div>
</div>

@push('css')
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }

    .card-installment-type:hover {
        cursor: pointer;
        border-color: #F28123;
        border-width: 2px;
    }

    .card-installment-type.active {
        border-color: #F28123;
        border-width: 2px;
    }
</style>
@endpush

@push('scripts')
<script>
    window.addEventListener('swal:toast', event => {
        Swal.fire(event.detail);
    });
    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.icon,
            confirmButtonText: 'ตกลง',
            denyButtonText: 'ยกเลิก',
            showDenyButton: true,
        })
        .then((r) => {
            if (r.value) {
                window.livewire.emit('submitForm');
            }
        });
    });
    document.addEventListener('livewire:load', function () {
        bindSelectBrand();
        bindSelectModel();
        bindSelectColor();
        bindSelectCapacity();
        bindSelectInstallment();
        bindPrice();
    });
    function bindPrice() {
        $('#installment').on('keyup', function () {
            let value = $(this).val();
            let price = $('#price').val();
            if (parseInt(price) > parseInt(value)) {
                @this.set('balance', (parseInt(price) - parseInt(value)) || 0);
            } else {
                @this.set('balance', 0);
            }
        });
    }
    function bindSelectInstallment() {
        $('.card-installment-type').on('click', function () {
            $('.card-installment-type').each(function (index, element) {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            let value = $(this).data('pk');
            @this.set('installmentType', value);
        });
    }
    function bindSelectBrand() {
        $('#brandProduct').on('change', function () {
            const bId = $(this).val();
            getProductByBrandId(bId);
        });
    }
    function getProductByBrandId(bId) {
        $('body').waitMe({
            effect : 'ios',
            text : 'Loading...',
        })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getProductByBrandId', '') }}/" + bId,
            success: function (response) {
                $('body').waitMe('hide');
                const {items} = response;
                $('#modelProduct').empty();
                $('#modelProduct').append('<option>เลือกรุ่น</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.name_en}</option>`;
                    $('#modelProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectModel() {
        $('#modelProduct').on('change', function () {
            const pId = $(this).val();
            $('#colorProduct').data('pid', pId);
            getColorByProductId(pId);
        });
    }
    function getColorByProductId(pId) {
        $('body').waitMe({
            effect : 'ios',
            text : 'Loading...',
        })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getColorByProductId', '') }}/" + pId,
            success: function (response) {
                $('body').waitMe('hide');
                // console.log(response);
                const {items} = response;
                $('#colorProduct').empty();
                $('#colorProduct').append('<option>เลือกสี</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.name_th}</option>`;
                    $('#colorProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectColor() {
        $('#colorProduct').on('change', function () {
            const pId = $(this).data('pid');
            const cId = $(this).val();
            // const cName = $(this).text();
            // @this.set('colorName', cName);
            getCapacityByProductId(pId, cId);
        });
    }
    function getCapacityByProductId(pId, cId) {
        $('body').waitMe({
            effect : 'ios',
            text : 'Loading...',
        })
        $.ajax({
            type: "GET",
            url: "{{ route('api.product.getCapacityByProductId', ['','']) }}/" + pId + '/' + cId,
            success: function (response) {
                $('body').waitMe('hide');
                // console.log(response);
                const {items} = response;
                $('#capacityProduct').empty();
                $('#capacityProduct').append('<option>เลือกความจุ</option>');
                items.forEach(item => {
                    let option = `<option value="${item.id}">${item.size}  (${item.price} ฿)</option>`;
                    $('#capacityProduct').append(option);
                });
            },
            error: function (error) {
                console.log(error);
                $('body').waitMe('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด!',
                    html: error.responseText || ''
                });
            }
        });
    }
    function bindSelectCapacity() {
        // $('#capacityProduct').on('change', function () {
        //     const cName = $(this).text();
        //     @this.set('capacityName', cName);
        // });
    }
</script>
@endpush
