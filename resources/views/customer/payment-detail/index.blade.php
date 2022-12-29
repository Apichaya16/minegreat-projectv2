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
    <div class="row justify-content-center">
        <div class="col-md-6 shadow-sm rounded mb-2">
            <img src="{{ asset('assets/img/payment-detail/1.png') }}" alt="1" class="img-fluid">
        </div>
        <div class="col-md-6 shadow-sm rounded mb-2">
            <img src="{{ asset('assets/img/payment-detail/2.png') }}" alt="2" class="img-fluid">
        </div>
        <div class="col-md-6 shadow-sm rounded mb-2">
            <img src="{{ asset('assets/img/payment-detail/3.png') }}" alt="3" class="img-fluid">
        </div>
        <div class="col-md-6 shadow-sm rounded mb-2">
            <img src="{{ asset('assets/img/payment-detail/4.png') }}" alt="4" class="img-fluid">
        </div>
        <div class="col-md-6 shadow-sm rounded mb-2">
            <img src="{{ asset('assets/img/payment-detail/5.png') }}" alt="5" class="img-fluid">
        </div>
    </div>
</div>
@endsection
