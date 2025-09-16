@extends('admin.layouts.app')
@section('title')
    {{ __('messages.terms_conditions.terms_conditions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                @include('flash::message')
                @include('admin.layouts.errors')
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => 'terms-conditions.update', 'files' => true , 'id'=>'editTermsConditionsForm']) }}
                        @include('admin.front-cms.terms-conditions.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    
    
