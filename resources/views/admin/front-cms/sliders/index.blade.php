@extends('admin.layouts.app')
@section('title')
    {{__('messages.slider.sliders')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="d-flex flex-column mb-3">
        {{ Form::open(['route' => 'slider-card.update','files' => true]) }}
        @include('admin.front-cms.sliders.slider_card_show_fields')
        {{ Form::close() }}
    </div>
    <div class="d-flex flex-column">
        @include('flash::message')
        <livewire:front-slider-table/>
    </div>
</div>
@endsection

