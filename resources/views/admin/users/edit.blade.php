@extends('admin.layouts.app')
@section('title')
    {{__('messages.user.edit_user')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="col-12">
                    @include('admin.layouts.errors')
                </div>
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('users.index') }}">{{ __('messages.common.back') }}</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['users.update', $user->id], 'method' => 'put','files' => 'true','id'=>'userEditForm']) }}
                        @include('admin.users.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
