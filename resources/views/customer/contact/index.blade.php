@extends('customer.layouts.customer')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="footer-box get-in-touch">
            <h2 class="widget-title" style="color: black">ที่อยู่</h2>
            <p style="color: black">หมู่บ้านตวงทอง เลข ที่ 59 หมู่ 4 ทางหลวงแผ่นดินหมายเลข. 3056 ตำบล ตลิ่งชัน อำเภอบางปะอิน จังหวัดพระนครศรีอยุธยา 13160</p>
            <ul>
                <li>
                    <i class="fas fa-mobile-alt"></i> : 094-654-983-6
                </li>
                <li>
                    <i class="fab fa-facebook"></i> : อภิ ไมน์เกรท จำหน่าย รับผ่อน มือถือและอุปกรณ์เสริม ผ่อนไปใช้ไป
                </li>
                <li>
                    <i class="fa fa-envelope""> : apiminegreat@gmail.com</i>
                </li>
                <li>
                    <i class="fab fa-line"></i> : @237mtcph
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30932.36272802335!2d100.58736707910157!3d14.279717000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d89684bef6715%3A0x6aaf1c5e9eb9d85a!2sApi%20mineGreat!5e0!3m2!1sth!2sth!4v1664121372662!5m2!1sth!2sth"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
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
