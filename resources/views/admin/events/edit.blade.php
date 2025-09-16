@extends('admin.layouts.app')
@section('title')
    {{__('messages.events.edit_event')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('events.index') }}">{{ __('messages.common.back') }}</a>
                </div>

                <div class="col-12">
                    @include('admin.layouts.errors')
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['events.update', $event->id], 'method' => 'put','files' => 'true','id'=>'eventEditForm']) }}
                        {{ Form::hidden('is_edit', true,['id' => 'eventIsEdit']) }}
                        @include('admin.events.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

