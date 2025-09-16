@extends('admin.layouts.app')
@section('title')
    {{__('messages.success_story.success_story')}}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="d-flex flex-column">
        <livewire:success-story-table/>
    </div>
</div>
@endsection
 
