@extends('admin.layouts.app')
@section('title')
    {{__('messages.withdrawal.edit_withdrawal_charge')}}
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
                <a href="{{ route('withdrawals.index') }}"
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
                    {{ Form::open(['route' => ['withdrawals.update', $withdrawal->id], 'method' => 'put', 'files' => true, 'id' => 'editWithdrawSetting']) }}
                    <div class="row">
                        <div class="mb-5">
                            <h2>{{$withdrawal->payment_type}}</h2>
                        </div>
                        <div class="mb-5 col-lg-6">
                            {{ Form::label('commissionType', __('messages.withdrawal.charge_type').':', ['class' => 'form-label required']) }}
                            {{ Form::select('discount_type',\App\Models\Withdrawal::TYPE,isset($withdrawal) ? $withdrawal->discount_type : null,['class' => 'form-select ','required','placeholder' => __('messages.withdrawal.charge_type'), 'data-control' => 'select2', 'id'=>'editDiscountType']) }}
                        </div>
                        <div class="mb-5 col-lg-6">
                            {{ Form::label('commission', __('messages.withdrawal.charge').':', ['class' => 'form-label required mb-2']) }}
                            <div class="input-group ">
                                {{ Form::number('discount', isset($withdrawal) ? $withdrawal->discount : '', ['class' => 'form-control', 'placeholder' => __('messages.withdrawal.charge'),'id'=>'editDiscount', 'required','min' => '0','step' => '.01']) }}
                                <span class="input-group-text ms-0" id="withdrwalCommissionSymbol"></span>
                            </div>
                        </div>
                        <div class="d-flex col-lg-6">
                            {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'createFaqsBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <a href="{{ route('withdrawals.index') }}" type="reset"
                           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

