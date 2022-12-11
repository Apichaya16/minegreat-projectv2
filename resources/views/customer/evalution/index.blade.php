@extends('customer.layouts.customer')

@section('content')
<div>
    <div class="card shadow-sm mb-3">
        <div class="card-body text-center p-5">
            <div class="header-doc">
                <h3>แบบประเมินความพึงพอใจต่อการใช้งานเว็บแอปพลิเคชัน</h3>
                <h3>ระบบประมวลผลและแสดงข้อมูลการผ่อนชำระของลูกค้าร้านอภิ ไมน์เกรท</h3>
            </div>
        </div>
    </div>
    <iframe
        src="https://docs.google.com/forms/d/e/1FAIpQLSc4kAjGPA2kDEEJDhUKH-X5xxu8NIvr81AZ4ZZiZpoiD7voKQ/viewform"
        frameborder="0"
        width="100%"
        height="1080px"
    ></iframe>
</div>
@endsection

@push('css')
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
    .header-doc > h3 {
        color: #F28123
    }
</style>
@endpush
