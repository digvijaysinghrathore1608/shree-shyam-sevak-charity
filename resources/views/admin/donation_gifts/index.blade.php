@extends('admin.layouts.app')
@section('title')
    {{__('messages.donation_gifts.donation_gifts')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:donation-gift-table/>
        </div>
    </div>
@endsection
 
