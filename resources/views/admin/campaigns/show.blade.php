@extends('admin/layouts.app')
@section('title')
    {{ __('messages.campaign.campaign_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{url()->previous()}}"
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
                    @include('admin.campaigns.show_fields')
                </div>
            </div>
            <div class="mt-7 overflow-hidden">
                @include('admin.campaigns.campaign_faqs.index')
            </div>
        </div>
    </div>
@endsection

