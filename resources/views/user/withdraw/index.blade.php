@extends('user.layouts.app')
@section('title')
    {{__('messages.withdraw.withdraw_request')}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('flash::message')
            @include('flash::message')
            <div class="table-responsive overflow-visible" >
                <div class=" pt-0">
                    <livewire:user-withdraw-table/>
                </div>
            </div>
        </div>
    @include('user.withdraw.show-modal')
    <input type="hidden" id="defaultPayPal" value="{{ !empty($userSetting) ? $userSetting->email : '' }}">
    <input type="hidden" id="defaultAccountNumber" value="{{ !empty($userSetting) ? $userSetting->isbn_number : '' }}">
    <input type="hidden" id="defaultIsbnNumber" value="{{ !empty($userSetting) ? $userSetting->isbn_number : '' }}">
    <input type="hidden" id="defaultBranchName" value="{{ !empty($userSetting) ? $userSetting->branch_name : '' }}">
    <input type="hidden" id="defaultHolderName" value="{{ !empty($userSetting) ? $userSetting->account_holder_name : '' }}">
@endsection
