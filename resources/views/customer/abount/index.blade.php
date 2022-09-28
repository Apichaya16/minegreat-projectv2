@extends('customer.layouts.customer')

@section('content')
<div class="container-fluid">
    <div class="text-center">
        <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="300px">
    </div>
    <div class="text-center">
        <a data-fancybox="gallery" href="{{ asset('assets/img/dbd/dbd_cert.png') }}">
            <img src="{{ asset('assets/img/dbd/dbd_cert.png') }}" alt="dbd cert" class="shadow shadow-md" width="300px">
        </a>
    </div>
    <div class="text-center mt-4">
        <a href="https://www.trustmarkthai.com/callbackData/popup.php?data=71-17-5-1da416843b575c1784141337e4bde87a3f258657b73" type="button" class="btn btn-primary px-5">DBD WEB</a>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/fancybox/dist/jquery.fancybox.min.css') }}">
@endpush

@push('css')
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
</style>
@endpush
