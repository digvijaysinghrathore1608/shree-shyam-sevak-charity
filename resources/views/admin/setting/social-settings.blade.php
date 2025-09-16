@extends('admin.layouts.app')
@section('title')
    {{$setting['application_name']}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('admin.setting.setting_menu')
            <div class="card">
                    {{ Form::open(['route' => 'setting.update', 'files' => true, 'id'=>'account_profile_details_form','class'=>'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="row card-body">
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('youtube_url', __('messages.setting.youtube_url').':', ['class' => 'required form-label mb-3']) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-youtube text-danger"></i>
                                </div>
                                {{ Form::text('youtube_url', $setting['youtube_url'], ['class' => ' required form-control','id'=>'youtubeUrl','placeholder' => __('messages.setting.youtube_url')]) }}
                            </div>
                        </div>
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('twitter_url', __('messages.setting.twitter_url').':', ['class' => 'required form-label mb-3']) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-twitter twitter-fa-icon text-primary"></i>
                                </div>
                                {{ Form::text('twitter_url', $setting['twitter_url'], ['class' => 'required form-control','id'=>'twitterUrl', 'placeholder' => __('messages.setting.twitter_url')]) }}
                            </div>
                        </div>
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('pinterest_url', __('messages.setting.pinterest_url').':', ['class' => 'required form-label mb-3','placeholder'=>__('messages.setting.pinterest_url')]) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-pinterest text-danger"></i>
                                </div>
                                {{ Form::text('pinterest_url', $setting['pinterest_url'], ['class' => 'required form-control','id'=>'googlePlusUrl', 'placeholder' => __('messages.setting.pinterest_url')]) }}
                            </div>
                        </div>
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('instagram_url', __('messages.setting.instagram_url').':', ['class' => 'required form-label mb-3']) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-instagram text-danger"></i></div>
                                {{ Form::text('instagram_url', $setting['instagram_url'], ['class' => 'form-control','id'=>'instagramUrl', 'placeholder' => __('messages.setting.instagram_url')]) }}
                            </div>
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                            {{ Form::label('facebook_url', __('messages.setting.facebook_url').':', ['class' => 'required form-label mb-3']) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-facebook-f facebook-fa-icon text-primary"></i>
                                </div>
                                {{ Form::text('facebook_url', $setting['facebook_url'], ['class' => 'form-control','id'=>'facebookUrl', 'placeholder' => __('messages.setting.facebook_url')]) }}
                            </div>
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                            {{ Form::label('linkedin_url', __('messages.setting.linkedin_url').':', ['class' => 'required form-label mb-3']) }}
                            <div class="input-group">
                                <div class="input-group-text border-0">
                                    <i class="fab fa-linkedin text-primary"></i>
                                </div>
                                {{ Form::text('linkedin_url', $setting['linkedin_url'], ['class' => 'form-control','id'=>'linkedInUrl', 'placeholder' => __('messages.setting.linkedin_url')]) }}
                            </div>
                        </div>
                    </div>
                <div class="card-footer d-flex pt-0 mb-5">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id'=>'submitId']) }}
                 </div>

                    {{ Form::close() }}
                
            </div>
        </div>
@endsection
