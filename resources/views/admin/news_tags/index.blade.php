@extends('admin.layouts.app')
@section('title')
    {{__('messages.news.news_tags')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:news-tag-table/>
        </div>
    </div>
    @include('admin.news_tags.create-modal')
    @include('admin.news_tags.edit-modal')
@endsection

