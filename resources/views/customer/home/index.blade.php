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
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
            </ul>
        </div>
        <div class="col-6" data-aos="fade-left">
            <h4>เงื่อนไข</h4>
            <ul>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
                <li>
                    test
                </li>
            </ul>
        </div>
    </div>
    <hr>

    <div data-aos="fade-up">
        <h4>แบรนชั้นนำทั่วโลก</h4>
        <div class="row">
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/acer/images/logo/thumb_logo_acer.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/samsung/images/logo/thumb_logo_samsung.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/apple/images/logo/thumb_logo_apple.png" alt="">
            </div>
            <div class="col-3 text-center">
                <img src="https://www.siamphone.com/spec/nokia/images/logo/thumb_logo_nokia.png" alt="">
            </div>
        </div>
    </div>

    @include('customer.layouts.feature')
    @include('customer.layouts.owner')
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
