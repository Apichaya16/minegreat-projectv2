@extends('customer.layouts.customer')

@section('content')
<div>
    <h3>ช่องทางการชำระเงิน</h3>
    <div>
        <img src="/public/assets/img/payment/slip_payment.jpg" alt="">
    </div>
    <div class=" text-center">
        <img src="https://www.kasikornbank.com/SiteCollectionDocuments/assets/img/logo/kasikornbank.png" alt="" style="width: 20%">
        <h5>ธนาคารกสิกรไทย : 034-884-7910</h5>
    </div>
    <hr>
    <div class="text-center">
        <img src="https://www.truemoney.com/wp-content/uploads/2020/11/truemoney-wallet-logo-1x.png" alt="" style="width: 20%">
        <h5>ทรูมันนี่ วอลเลต : 0628791447</h5>
    </div>
    <hr>
    <div class="text-center">
        <img src="https://www.designil.com/wp-content/uploads/2020/04/prompt-pay-logo.png" alt="" style="width: 20%">
        <h5>พร้อมเพย์ : 1480700195313</h5>
    </div>
    <br>
        <span class="text-danger">*ปลอมแปลงสลิปโอนเงินถือเป็นความผิด หากตรวจพบดำเนินคดีทางกฎหมายทันที</span>
    <div class="text-center mt-5">
        <a href="https://lin.ee/9L9Bh1Y"><button class=" btn btn-outline-info">แจ้งส่งสลิป</button></a>
    </div>
</div>
@endsection

@push('css')
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
</style>
@endpush
