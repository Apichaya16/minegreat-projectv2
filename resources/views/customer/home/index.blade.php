@extends('customer.layouts.customer')

@section('top-bg')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        {{-- <div class="row">
            <div class="col-lg-9 offset-lg-2 text-center">
                <div class="hero-text">
                    <div class="hero-text-tablecell">
                        <p class="subtitle">Fresh & Organic</p>
                        <h1>Delicious Seasonal Fruits</h1>
                        <div class="hero-btns">
                            <a href="shop.html" class="boxed-btn">Fruit Collection</a>
                            <a href="contact.html" class="bordered-btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
<!-- end hero area -->
@endsection

@section('content')
<div class="container">
    <hr>
    <div class="row">
        <div class="col-6" data-aos="fade-right">
            <h4>บริการของเรา</h4>
            <ul>
                <li>จำหน่ายโทรศัพท์มือถือ iPhone iPad Android AirPods และอุปกรณ์เสริม สินค้ารับประกันศูนย์ไทย </li>
                <li>
                    ผ่อนไปใช้ไป สินค้าไอที | แบรนด์เนม
                   <br> ✱ ส่งยอดทำเครดิต ไม่ใช้เงินก้อน
                   <br> ─ อยากได้มือถือใหม่ ไม่ต้องรอเก็บเงินจนครบ
                   <br> ─ การันตีลูกค้าส่วนใหญ่ได้ของไปใช้ก่อนถึงราคาซื้อสดหลักหมื่น++
                </li>
                <li>
                    ผ่อนครบรับของ  สินค้าไอที | แบรนด์เนม
                   <br> ✱ เหมาะสำหรับคนไม่รีบใช้สินค้า อยากสะสมยอดผ่อนเรื่อยๆ
                   <br> ─ ราคาประหยัดกว่าแบบผ่อนไปใช้ไป
                </li>
                <li>
                    ผ่อนง่าย ไม่จำกัดอาชีพ ไม่จำกัดระยะเวลา
                </li>
                <li>
                    สินค้าแท้ ออกช็อปไทย ประกันศูนย์ไทย 100% มีปัญหาสามารถนำส่งศูนย์ใกล้บ้านได้เลย
                </li>
            </ul>
        </div>
        <div class="col-6" data-aos="fade-left">
            <h4>กฎการผ่อนและข้อพิจารณา</h4>
            <ul>
                <li>
                    ยกเลิกผ่อน ร้านสงวนสิทธิ์ไม่คืนเงินทุกกรณี
                </li>
                <li>
                    ลูกค้ามีปัญหาทางการเงิน สามารถพักการผ่อนหรือขอปิดยอดรับของในราคาผ่อนใกล้เคียงได้เลย
                </li>
                <li>
                    ขาดผ่อนโดยไม่แจ้งภายใน 30 วันถือว่ายกเลิกการผ่อน (กรณียังไม่ได้รับการอนุมัติ)

                </li>
                <li>
                    * ยกเลิกผ่อน ร้านสงวนสิทธิ์ไม่คืนเงินทุกกรณี เนื่องจากจุดประสงค์ของร้านคือการรับผ่อนสินค้า ไม่ใช่การรับออมเงิน
                </li>
            </ul>
        </div>
    </div>
    <hr>

    <div data-aos="fade-up">
        <h4>แบรนด์มือถือ
            <span class="float-right">
                <a href="{{ route('customer.payment.register') }}">
                    สนใจสินค้า <i class="fas fa-arrow-right"></i>
                </a>
            </span>
        </h4>
        <div class="row align-items-center">
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/apple/images/logo/thumb_logo_apple.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://seeklogo.com/images/V/vivo-logo-9FBC12B0F9-seeklogo.com.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/samsung/images/logo/thumb_logo_samsung.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/oppo/images/logo/logo_oppo.jpg" alt="">
            </div>
        </div>
    </div>

    {{-- @include('customer.layouts.feature') --}}
    {{-- @include('customer.layouts.owner') --}}
    @include('customer.layouts.dsd')
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/aos/dist/aos.css') }}">
<style>
    .title-animate {
        text-transform: uppercase;
        background-image: linear-gradient(-225deg,
                #231557 0%,
                #44107a 29%,
                #ff1361 67%,
                #fff800 100%);
        background-size: auto auto;
        background-clip: border-box;
        background-size: 200% auto;
        color: #fff;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 2s linear infinite;
        display: inline-block;
    }

    @keyframes textclip {
        to {
            background-position: 200% center;
        }
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('vendor/aos/dist/aos.js') }}"></script>
<script>
    AOS.init();
</script>
@endpush
