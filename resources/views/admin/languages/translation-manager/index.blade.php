@extends('admin.layouts.app')
@section('title')
    {{ __('messages.translation_manager') }}
@endsection
@section('header_toolbar')
<div class="container-fluid">
    <div class="col-12">
        @include('flash::message')
        @include('admin.layouts.errors')
    </div>
    <div class="d-flex justify-content-between align-items-end mb-5">
        <h1 class="mb-0">@yield('title')</h1>
        <div class="text-end mt-4 mt-md-0">
            <a href="{{ route('languages.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    {{ Form::hidden('selected_lang', $selectedLang, ['id' => 'indexSelectedLang']) }}
                    {{ Form::hidden('language_id', $id, ['id' => 'indexLanguageId']) }}
                    {{ Form::open(['route' => ['languages.translation.update','language'=> $id],'method'=>'post']) }}
                    @include('admin.languages.translation-manager.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    
@endsection

