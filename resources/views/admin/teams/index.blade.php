@extends('admin.layouts.app')
@section('title')
    {{ __('messages.teams.teams') }}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:team-table/>
        </div>
    </div>
    @include('admin.teams.create-modal')
    @include('admin.teams.edit-modal')
@endsection

