@extends('admin.layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
        <div class="container-fluid">
            @include('admin.setting.setting_menu')
            <div class="card mb-5 mb-xl-10 border-0 px-10">
                <div class="card-header border-0 cursor-pointer ps-0 cursor-default" role="button">
                    <div class="card-title m-0 ">
                        <h3 class="m-0">{{ __('messages.setting.general_details') }}</h3>
                    </div>
                </div>
                {{ Form::open(['route' => 'setting.update', 'files' => true, 'id'=>'generalSettingFrom','class'=>'form']) }}
                <div class="collapse show">
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('app_name', __('messages.setting.app_name').':', ['class' => 'form-label required']) }}
                            {{ Form::text('application_name', $setting['application_name'], ['class' => 'form-control', 'required', 'placeholder' => __('messages.setting.app_name'),'maxlength'=>'30']) }}
                        </div>
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('phone', __('messages.setting.phone_number').':', ['class' => 'form-label required']) }}
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                {{ Form::tel('phone', '+'.$setting['prefix_code'].''.$setting['phone'], ['class' => 'form-control', 'placeholder' => __('messages.setting.phone_number'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                                {{ Form::hidden('prefix_code','+'.$setting['prefix_code'] ,['id'=>'prefix_code']) }}
                                <br>
                                <span id="valid-msg" class="hide text-success fw-400 fs-small mt-2">✓ Valid</span>
                                <span id="error-msg" class="hide text-danger fw-400 fs-small mt-2"></span>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('about_us', __('messages.setting.about_us').':', ['class' => 'form-label required']) }}
                            {{ Form::textarea('about_us', $setting['about_us'], ['class' => 'form-control', 'required', 'placeholder' => __('messages.setting.about_us'), 'maxLength'=>5000]) }}
                        </div>
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('email', __('messages.common.email').':', ['class' => 'form-label required']) }}
                            {{ Form::email('email', $setting['email'], ['class' => 'form-control', 'required', 'placeholder' => __('messages.common.email') ]) }}
                        </div>
                        <div class="col-sm-6 mb-5">
                            <div class="input-group ">
                                {{ Form::label('commission_type', __('messages.withdrawal.commission_type').':', ['class' => 'form-label required']) }}
                                {{ Form::select('charges_type',\App\Models\Withdrawal::TYPE,$setting['charges_type']??null, ['class' => 'form-select','required','placeholder' => __('messages.withdrawal.commission_type'),'data-control'=>'select2','id'=>'settingChargesType']) }}
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('donation_commission', __('messages.setting.donation_commission').':', ['class' => 'form-label  text-gray-700 required']) }}
                            <div class="input-group ">
                                {{ Form::number('donation_commission', $setting['donation_commission'] ?? null, ['class' => 'form-control required', 'placeholder' => __('messages.setting.donation_commission'), 'aria-describedby' => 'basic-addon2', 'min' => '0' , 'max' => '100', 'id' => 'commission', 'required','step' => '.01']) }}
                                <span class="input-group-text ms-0" id="commissionSymbol"></span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            {{ Form::label('location_embedded_code', __('Location Embedded Code Of Map').':', ['class' => 'form-label required']) }}
                            {{ Form::textarea('location_embedded_code',  $setting['location_embedded_code'], ['class' => 'form-control', 'required', 'placeholder' => __('Location Embedded Code Of Map'), 'id' => 'locationEmbeddedCode' ]) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- App Logo Field -->
                    <div class="col-sm-6 mb-2">
                        <div class="row">
                            <label class="form-label required">
                                <span>{{ __('messages.setting.app_logo').':'}}</span>
                                <span data-bs-toggle="tooltip"
                                      data-placement="top"
                                      data-bs-original-title="Best resolution for this Logo will be 120x56">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                            </label>
                            <div>
                                <div class="mb-3" io-image-input="true">
                                    <div class="d-block">
                                        <div class="image-picker">
                                            <div class="image previewImage" id="appLogoPreview"
                                                 style="background-image: url('{{ ($setting['app_logo']) ?  asset($setting['app_logo']): asset('front_landing/images/funding-logo.png') }}')">
                                            </div>
                                            <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                  data-bs-toggle="tooltip"
                                                  data-placement="top" data-bs-original-title="Change app logo">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="appLogo" name="app_logo" class="image-upload d-none"
                                                   accept=".png, .jpg, .jpeg"/>
                                        </label>
                                    </span>
                                        </div>
                                        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label class="form-label required">
                            <span>{{ __('messages.setting.favicon').(':')}}</span>
                            <span data-bs-toggle="tooltip"
                                  data-placement="top"
                                  data-bs-original-title="Best resolution for this favicon will be 34x34">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                        </label>
                        <div class="col-lg-8">
                            <div class="mb-3" io-image-input="true">
                                <div class="d-block">
                                    <div class="image-picker">
                                        <div class="image previewImage" id="faviconPreview"
                                             style="background-image: url('{{ ($setting['app_favicon']) ? asset($setting['app_favicon']): asset('assets/images/infyom-logo.png') }}')">
                                        </div>
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                              data-bs-toggle="tooltip"
                                              data-placement="top" data-bs-original-title="Change favicon">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                        <input type="file" id="appLogo1" name="app_favicon" class="image-upload d-none"
                               accept="image/*"/>
                    </label>
                </span>
                                    </div>
                                    <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex py-6 p-0 mb-5">
                    <button type="submit" class="btn btn-primary"
                            id="generalSettingBtn">{{ __('messages.common.save') }}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}

@endsection

