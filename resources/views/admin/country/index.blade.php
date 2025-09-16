@extends('admin.layouts.app')
@section('title')
    {{ __('messages.countries') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="pt-0">
            <livewire:country-table/>
            @include('admin.country.create')
            @include('admin.country.edit')
        </div>
    </div>
@endsection
 
