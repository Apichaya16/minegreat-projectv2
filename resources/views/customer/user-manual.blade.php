@extends('customer.layouts.customer')

@push('css')
<style>
    .sticky-wrapper {
        position: relative !important;
        background-color: #051922;
        height: 100px !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h3 class="py-3">คู่มือการใช้งาน</h3>
    <embed
        src="{{ asset('assets/pdf/user-manual.pdf') }}"
        type="application/pdf"
        frameBorder="0"
        scrolling="auto"
        height="1080"
        width="100%"
    ></embed>
</div>
@endsection
