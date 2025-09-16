@extends('admin.layouts.app')
@section('title')
    {{__('messages.news.news_categories')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:news-category-table/>
        </div>
    </div>
    @include('admin.news_categories.create-modal')
    @include('admin.news_categories.edit-modal')
@endsection

