@extends('admin.layouts.app')
@section('title')
    {{__('messages.categories.categories')}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('flash::message')
                <div class="pt-0">
                    <livewire:category-third-table/>
                </div>
        </div>
@endsection

