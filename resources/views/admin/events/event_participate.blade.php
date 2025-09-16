@extends('admin.layouts.app')
@section('title')
    {{__('messages.event.events_participants')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{url()->previous()}}">{{ __('messages.common.back') }}</a>
                </div>
                <div>
                    <div class="d-flex flex-column">
                        @include('flash::message')
                        @include('admin.layouts.errors')
                        <livewire:event-participant-table :event-id="$id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
