@extends('user.layouts.app')
@section('title')
    {{__('messages.campaign.edit_campaign')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('header_toolbar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
                @include('admin.layouts.errors')
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('user.campaigns.index') }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="container-fluid mt-5">
        <div class="pb-0">
            <div class="d-flex">
                <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
                     <li class="nav-item position-relative  me-7 mb-3" role="presentation">
                         <button class="nav-link  p-0" id="addBasicDetailsBtn" data-bs-toggle="tab" data-bs-target="#addBasicDetails"
                                 type="button" role="tab" aria-controls="overview" aria-selected="true">
                             {{ __('messages.campaign.basic_details') }}
                         </button>
                     </li>
                     <li class="nav-item position-relative me-7 mb-3" role="presentation">
                         <button class="nav-link active p-0" id="addDefineGoalBtn" data-bs-toggle="tab" data-bs-target="#addDefineGoal"
                                 type="button" role="tab" aria-controls="overview" aria-selected="true">
                             {{ __('messages.campaign.define_goal') }}
                         </button>
                     </li>
                     <li class="nav-item position-relative me-7 mb-3" role="presentation">
                         <button class="nav-link  p-0" id="addGalleryBtn" data-bs-toggle="tab" data-bs-target="#addGallery"
                                 type="button" role="tab" aria-controls="overview" aria-selected="true">
                             {{ __('messages.campaign.gallery') }}
                         </button>
                     </li>
                 </ul>

             </div>
         </div>
         {{ Form::hidden('campaign_is_edit', true, ['id' => 'campaignIsEdit']) }}
         {{ Form::hidden('edit_campaignDescription', $campaign['description'], ['id' => 'editCampaignDescriptionData']) }}
         <div class="card">
             @include('user.campaigns.edit_fields')
             
         </div>
     </div>
        
@endsection
