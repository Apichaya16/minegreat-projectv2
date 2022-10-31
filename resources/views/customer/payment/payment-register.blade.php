@extends('customer.layouts.customer')

@section('content')
    <div class="container-fluid">
        <div class="text-center">
            <img src="{{ asset('assets/img/icons/register-icon.png') }}" alt="register" class="mb-3" width="256">
            <h3>ลงทะเบียน</h3>
            <hr>
        </div>
        <livewire:payment-register />
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
