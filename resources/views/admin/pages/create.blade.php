@extends('admin.layouts.app')
@section('title')
    {{__('messages.page.add_page')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                @include('admin.layouts.errors')
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mb-5">
                        <h1>@yield('title')</h1>
                        <a class="btn btn-outline-primary float-end"
                           href="{{ route('pages.index') }}">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::hidden('page_description', null, ['id' => 'pageDescriptionData']) }}
                        {{ Form::open(['route' => 'pages.store','files' => 'true','id'=>'pageCreateForm']) }}
                        @include('admin.pages.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
