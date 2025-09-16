@extends('user.layouts.app')
@section('title')
    {{__('messages.payout_setting.payout_settings')}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('flash::message')
            @include('user.layouts.errors')
            <div class="card ">
                <div class="card-body">
                    {{ Form::open(['route' => 'user.settings-update', 'class'=>'form' , 'id'=>'payoutSetting']) }}
                    <div class="row">
                        <div>
                            <h3>{{ __('messages.payout_setting.paypal') }}</h3>
                        </div>
                        <div class="paypal">
                            <div class="row">
                                <div class="col-sm-6 mb-5">
                                    {{ Form::label('email', __('messages.common.email').':', ['class' => 'form-label ']) }}
                                    {{ Form::text('email', $setting['email']??null, ['class' => 'form-control form-control-solid' , 'id' => 'paymentType' , 'placeholder' => __('messages.common.email')]) }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3>{{ __('messages.campaign.bank') }}</h3>
                        </div>
                        <div class="bank">
                            <div class="row">
                                <div class="col-sm-6 mb-5">
                                    {{ Form::label('account_number', __('messages.payout_setting.account_number').':', ['class' => 'form-label']) }}
                                    {{ Form::text('account_number', $setting['account_number']??null, ['class' => 'form-control accountNumber' , 'id' => 'accountNumber' , 'placeholder' => __('messages.payout_setting.account_number')]) }}
                                </div>
                                <div class="col-sm-6 mb-5">
                                    {{ Form::label('isbn_number', __('messages.payout_setting.isbn_number').':', ['class' => 'form-label']) }}
                                    {{ Form::text('isbn_number', $setting['isbn_number']??null, ['class' => 'form-control' , 'id' => 'isbnNumber' , 'placeholder' => __('messages.payout_setting.isbn_number')]) }}
                                    </div>
                                    <div class="col-sm-6">
                                        {{ Form::label('branch_name', __('messages.payout_setting.branch_name').':', ['class' => 'form-label']) }}
                                        {{ Form::text('branch_name', $setting['branch_name']??null, ['class' => 'form-control' , 'id' => 'branchName' , 'placeholder' => __('messages.payout_setting.branch_name')]) }}
                                    </div>
                                    <div class="col-sm-6">
                                        {{ Form::label('account_holder_name', __('messages.payout_setting.account_holder_name').':', ['class' => 'form-label']) }}
                                        {{ Form::text('account_holder_name',$setting['account_holder_name']??null, ['class' => 'form-control' , 'id' => 'accountHolderName' , 'placeholder' => __('messages.payout_setting.account_holder_name')]) }}
                                    </div>
                                    <div class="d-flex pt-7">
                                        <button type="submit" class="btn btn-primary"
                                                id="payoutSettingBtn">{{ __('messages.common.save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
@endsection
