@extends('admin.layouts.app')
@section('title')
    {{__('messages.slider.sliders_3')}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('flash::message')
            <div>
                <div class="pt-0">
                    <livewire:front-slider-third-table/>
                </div>
            </div>
        </div>
@endsection

