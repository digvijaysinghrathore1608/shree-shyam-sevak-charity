@extends('admin.layouts.app')
@section('title')
    {{__('messages.email_subscribes.subscribes')}}
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column">
        @include('flash::message')
        <livewire:email-subscribe-table/>
    </div>
</div>
@endsection
 
