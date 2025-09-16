@extends('admin.layouts.app')
@section('title')
    {{$setting['application_name']}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('admin.setting.setting_menu')
            <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        {{ Form::open(['route' => 'setting.credential.update', 'id'=>'credentialsSettings', 'class'=>'form']) }}
                        {{ Form::hidden('sectionName', $sectionName) }}
                        <div class="row">
                            {{--  STRIPE --}}
                            <div class="col-12 d-flex align-items-center">
                                <span class="text-gray-900 fs-3 my-3">{{ __('messages.setting.stripe') }}</span>
                                <label class="form-check form-switch form-check-custom form-switch-sm ms-3">
                                    <input type="checkbox" name="stripe_enable" class="form-check-input stripe-enable"
                                           value="1" {{ $setting['stripe_enable'] === '1' ? 'checked' : ''}}
                                           id="stripeEnable">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                            <div class="stripe-div {{  $setting['stripe_enable'] === '1' ? '' : 'd-none'}} col-12">
                                <div class="row">
                                    <div class="col-sm-6 mb-5">
                                        {{ Form::label('stripe_key', __('messages.setting.stripe_key').':', ['class' => 'form-label required']) }}
                                        {{ Form::text('stripe_key', $setting['stripe_key'] ?? null, ['class' => 'form-control' , 'id' => 'stripeKey' , 'placeholder' => __('messages.setting.stripe_key')]) }}
                                    </div>
                                    <div class="col-sm-6 mb-5">
                                        {{ Form::label('stripe_secret', __('messages.setting.stripe_secret').':', ['class' => 'form-label required']) }}
                                        {{ Form::text('stripe_secret', $setting['stripe_secret'] ?? null, ['class' => 'form-control', 'id' => 'stripeSecret' , 'placeholder' => __('messages.setting.stripe_secret')]) }}
                                    </div>
                                </div>
                            </div>

                            {{--  PAYPAL --}}
                            <div class="col-12 d-flex align-items-center">
                                <span class="text-gray-900 fs-3 my-3">{{ __('messages.payout_setting.paypal') }}</span>
                                <label class="form-check form-switch form-check-custom form-switch-sm ms-3">
                                    <input type="checkbox" name="paypal_enable" class="form-check-input paypal-enable"
                                           value="1"
                                           {{ $setting['paypal_enable'] === '1' ? 'checked' : ''}}
                                           id="paypalEnable">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                            <div class="paypal-div {{  $setting['paypal_enable'] === '1' ? '' : 'd-none'}} col-12">
                                <div class="row">
                                    <div class="col-sm-6 mb-5">
                                        {{ Form::label('paypal_client_id', __('messages.setting.paypal_client_id').':', ['class' => 'form-label required']) }}
                                        {{ Form::text('paypal_client_id', $setting['paypal_client_id'] ?? null, ['class' => 'form-control','id' => 'paypalKey' , 'placeholder' => __('messages.setting.paypal_client_id')]) }}
                                    </div>
                                    <div class="col-sm-6 mb-5">
                                        {{ Form::label('paypal_secret', __('messages.setting.paypal_secret').':', ['class' => 'form-label required']) }}
                                        {{ Form::text('paypal_secret', $setting['paypal_secret'] ?? null, ['class' => 'form-control','id' => 'paypalSecret' , 'placeholder' => __('messages.setting.paypal_secret')]) }}
                                    </div>
                                    <div class="col-sm-6 mb-5">
                                        {{ Form::label('paypal_mode', __('messages.setting.paypal_mode').':', ['class' => 'form-label required']) }}
                                        {{ Form::select('paypal_mode',\App\Models\Setting::PAYPAL_MODE,$setting['paypal_mode']??null, ['class' => 'form-select','data-control'=>'select2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-5 d-flex">
                            <button type="submit" class="btn btn-primary"
                                    id="credentialSettingBtn">{{ __('messages.common.save') }}</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>

@endsection
