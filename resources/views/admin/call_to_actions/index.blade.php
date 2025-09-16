@extends('admin.layouts.app')
@section('title')
    {{__('messages.call_to_actions.call_to_actions')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:call-to-action-table/>
        </div>
    </div>
    @include('admin.call_to_actions.show_modal')
@endsection
