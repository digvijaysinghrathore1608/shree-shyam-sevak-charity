@extends('admin.layouts.app')
@section('title')
    {{__('messages.inquiries.inquiries')}}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="d-flex flex-column">
        <livewire:inquiry-table/>
    </div>
</div>
@include('admin.inquiries.show_modal')
@endsection
 
