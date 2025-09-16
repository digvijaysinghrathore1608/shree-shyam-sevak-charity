@extends('user.layouts.app')
@section('title')
    {{__('messages.campaign.campaigns')}}
@endsection
@section('content')
    
        <div class="container-fluid">
            @include('flash::message')
                <div class="pt-0">
                    <livewire:user-campaign-table/>
                </div>
        </div>
@endsection
