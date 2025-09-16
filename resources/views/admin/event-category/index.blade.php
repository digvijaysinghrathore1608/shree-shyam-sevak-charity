@extends('admin.layouts.app')
@section('title')
    {{__('messages.event.event_categories')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:event-category-table/>
        </div>
    </div>
    @include('admin.event-category.create')
    @include('admin.event-category.edit')
@endsection

