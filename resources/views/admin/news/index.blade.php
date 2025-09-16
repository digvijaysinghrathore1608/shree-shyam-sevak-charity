@extends('admin.layouts.app')
@section('title')
    {{__('messages.news.news')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:news-table/>
        </div>
    </div>
@endsection
 
