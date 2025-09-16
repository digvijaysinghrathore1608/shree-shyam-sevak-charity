@extends('user/layouts.app')
@section('title')
    {{ __('messages.campaign.campaign_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid d-flex justify-content-between align-items-center">
        @include('flash::message')
        <h1>@yield('title')</h1>
        <div class="d-flex align-items-center py-1">
            <a href="{{ route('user.campaigns.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
    
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="card">
            @include('user.campaigns.show_fields')
        </div>
        <div class="mt-5">
            <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
                <li class="nav-item position-relative  me-7 mb-3" role="presentation">
                    <button class="nav-link campaign-FAQ {{ $option == 'default' ? 'active' : ''}}   p-0"
                            data-bs-toggle="tab" data-bs-target="#campaignFaqs"
                            type="button" role="tab" aria-controls="overview" aria-selected="true">
                        {{__('messages.campaign_faqs.campaign_faqs')}}
                    </button>
                </li>
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <button class="nav-link  p-0" data-bs-toggle="tab" data-bs-target="#campaignUpdates"
                            type="button" role="tab" aria-controls="overview" aria-selected="true">
                        {{__('messages.campaign_updates.campaign_updates')}}
                    </button>
                </li>
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <button class="nav-link  p-0 {{ $option == 'donors' ? 'active' : ''}}" id="addGalleryBtn"
                            data-bs-toggle="tab" data-bs-target="#campaignTransactions"
                            type="button" role="tab" aria-controls="overview" aria-selected="true">
                        {{__('messages.campaign.donors')}}
                    </button>
                </li>
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <button class="nav-link p-0" id="campaign-gift-transactions-tab" data-bs-toggle="tab"
                            data-bs-target="#campaignGiftTransactions"
                            type="button" role="tab" aria-controls="campaignGiftTransactions" aria-selected="false">
                        {{__('messages.campaign_transactions.donors_as_gift')}}
                    </button>
                </li>
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <button class="nav-link p-0" id="campaign-withdraw-request-tab" data-bs-toggle="tab"
                            data-bs-target="#campaignWithdrawRequest"
                            type="button" role="tab" aria-controls="campaignWithdrawRequest" aria-selected="false">
	                    {{__('messages.withdraw.withdraw_request')}}

                    </button>
                </li>
            </ul>
        </div>
        @include('user.campaigns.campaign_faqs.index')
    </div>
@endsection

