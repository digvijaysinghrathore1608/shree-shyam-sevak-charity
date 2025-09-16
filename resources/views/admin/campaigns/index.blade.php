@extends('admin.layouts.app')
@section('title')
    {{__('messages.campaign.campaigns')}}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    @include('admin.layouts.errors')
    <div class="d-flex flex-column">
        <livewire:campaign-table/>
    </div>
</div>
@endsection

