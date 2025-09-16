@extends('admin.layouts.app')
@section('title')
    {{__('messages.pages')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:page-table/>
        </div>
        @include('admin.pages.show_modal')
    </div>
@endsection

