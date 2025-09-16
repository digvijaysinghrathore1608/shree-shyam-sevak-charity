@extends('admin.layouts.app')
@section('title')
    {{__('messages.campaign.campaign_categories')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        @include('admin.layouts.errors')
        <div class="d-flex flex-column">
            <livewire:campaign-category-table/>
        </div>
        @include('admin.campaign-category.create')
        @include('admin.campaign-category.edit')
    </div>
@endsection

