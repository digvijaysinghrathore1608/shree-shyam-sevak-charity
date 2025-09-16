@extends('admin.layouts.app')
@section('title')
    {{__('messages.events.events')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:event-table/>
        </div>
    </div>
@endsection
 
 
