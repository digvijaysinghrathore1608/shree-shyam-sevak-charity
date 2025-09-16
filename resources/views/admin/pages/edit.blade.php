@extends('admin.layouts.app')
@section('title')
    {{__('messages.page.edit_page')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                @include('admin.layouts.errors')
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('pages.index') }}">{{ __('messages.common.back') }}</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::hidden('page_description', $page->description, ['id' => 'pageDescriptionData']) }}
                        {{ Form::open(['route' => ['pages.update', $page->id], 'method' => 'put','files' => 'true','id'=>'pageEditForm']) }}
                        @include('admin.pages.edit_fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
