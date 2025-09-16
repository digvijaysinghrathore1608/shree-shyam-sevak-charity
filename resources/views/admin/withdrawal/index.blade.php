@extends('admin.layouts.app')
@section('title')
    {{__('messages.withdrawal.withdrawal')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:withdrawal-table/>
        </div>
    </div>
@endsection
 
