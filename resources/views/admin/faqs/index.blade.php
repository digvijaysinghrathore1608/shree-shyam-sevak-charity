@extends('admin.layouts.app')
@section('title')
    {{__('messages.faqs.faqs')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:faqs-table/>
        </div>
    </div>
    @include('admin.faqs.create-modal')
    @include('admin.faqs.edit-modal')
    @include('admin.faqs.show_model')
@endsection
 
