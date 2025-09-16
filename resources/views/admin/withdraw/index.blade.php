@extends('admin.layouts.app')
@section('title')
    {{__('messages.withdraw.withdraw_request')}}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="d-flex flex-column livewire-table">
        <livewire:admin-withdraw-table/>
    </div>
    @include('admin.withdraw.paypal_type_show_modal')
    @include('admin.withdraw.bank_type_show_modal')
</div>
@endsection
