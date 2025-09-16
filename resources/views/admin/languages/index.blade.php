@extends('admin.layouts.app')
@section('title')
    {{ __('messages.languages') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:language-table/>
        </div>
    </div>
@include('admin.languages.add_modal')
    @include('admin.languages.edit_modal')
@endsection

