@extends('admin.layouts.app')
@section('title')
    {{ __('messages.user.profile_details') }}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')

    <div class="container-fluid">
        @include('flash::message')
        @include('admin.layouts.errors')
        <div class="card mb-5 mb-xl-10">
          
            <div class="collapse show">
                <form method="POST" action="{{ route('update.profile.setting') }}" novalidate="novalidate"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row mb-5">
                            {{ Form::label('Avatar', __('messages.user.profile_image').':',  ['class'=> 'col-lg-4 form-label ']) }}

                            <div class="col-lg-8">
                                <div class="mb-3" io-image-input="true">
                                    <div class="d-block">
                                        <div class="image-picker">
                                            <div class="image previewImage" id="exampleInputImage"
                                                 style="background-image: url('{{isset($user->profile_image) ? $user->profile_image : asset('front_landing/web/media/avatars/150-19.jpg')}}')">
                                            </div>
                                            <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                  data-bs-toggle="tooltip"
                                                  data-placement="top" data-bs-original-title="Change Profile">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*"/>
                                        {{ Form::hidden('avatar_remove') }}
                        </label> 
                    </span>
                                        </div>
                                    </div>
                                </div>
                                        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                                        </div>
                                       
                                    </div>
                                
                                <div class="row mb-6">
                                    <label class="col-lg-4 form-label required">{{ __('messages.user.full_name').':' }}</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{ Form::text('first_name', $user->first_name, ['class'=> 'form-control', 'placeholder' => __('messages.user.first_name'), 'required']) }}
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6 ">
                                                {{ Form::text('last_name', $user->last_name, ['class'=> 'form-control', 'placeholder' => __('messages.user.last_name'), 'required']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 form-label required">{{ __('messages.common.email').':' }}</label>
                            <div class="col-lg-8">
                                {{ Form::email('email', $user->email, ['class'=> 'form-control', 'placeholder' => __('messages.common.email'), 'required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 form-label required">{{ __('messages.user.contact_number').':' }}</label>
                            <div class="col-lg-8">
                                {{ Form::tel('contact', $user->contact, ['class'=> 'form-control', 'placeholder' => __('messages.profile.phone_number'), 'required']) }}
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                                </div>

                            </div>
                            <div class="card-footer d-flex py-6 px-9">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                                @if(getLogInUser()->role_name == 'Admin')
                                    <a href="{{route('admin.dashboard')}}" type="reset"
                                       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
                                @endif
                                @if(getLogInUser()->role_name == 'User')
                                    <a href="{{route('user.dashboard')}}" type="reset"
                                       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
                                @endif
                            </div>
                        </form>
                    </div>
               
@endsection
