@extends('admin.layouts.app')
@section('title')
    {{__('messages.brand.brands')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:brand-table/>
        </div>
    </div>
    @include('admin.brands.create')
    @include('admin.brands.edit')
@endsection
