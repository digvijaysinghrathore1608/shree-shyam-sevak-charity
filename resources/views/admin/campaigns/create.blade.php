@extends('admin.layouts.app')
@section('title')
    {{__('messages.campaign.add_campaign')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('header_toolbar')
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-end mb-5">
        <h1 class="mb-0">@yield('title')</h1>
        <div class="text-end mt-4 mt-md-0">
            <a href="{{ route('campaigns.index') }}"
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
                {{ Form::open(['route' => 'campaigns.store','files' => 'true','id'=>'campaignCreateForm']) }}
                @include('admin.campaigns.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

