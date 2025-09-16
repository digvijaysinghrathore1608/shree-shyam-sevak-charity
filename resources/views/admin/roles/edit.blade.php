@extends('admin.layouts.app')
@section('title')
    {{__('messages.role.edit_role')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('roles.index') }}">{{ __('messages.common.back') }}</a>
        </div>
        <div class="card">
            <div class="card-body p-12">
                {{ Form::open(['route' => ['roles.update', $role->id], 'method' => 'put']) }}
                @include('admin.roles.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
 
