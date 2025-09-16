@extends('admin.layouts.app')
@section('title')
    {{__('messages.slider.sliders_2')}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('flash::message')
            <div class="pt-0">
                <livewire:second-slider-table/>
            </div>
        </div>
@endsection
 
