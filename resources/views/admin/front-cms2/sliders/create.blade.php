@extends('admin.layouts.app')
@section('title')
    {{__('messages.slider.add_slider')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @include('flash::message')
            @include('admin.layouts.errors')
        </div>
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('second-slider.index') }}">{{ __('messages.common.back') }}</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => 'second-slider.store', 'files' => true, 'id' => 'createFrontSlider2Form']) }}
                        @include('admin.front-cms2.sliders.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
