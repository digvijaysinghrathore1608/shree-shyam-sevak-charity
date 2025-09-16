@extends('admin.layouts.app')
@section('title')
    {{$setting['application_name']}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('admin.setting.setting_menu')
            <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => 'setting.update', 'files' => true]) }}
                        {{ Form::hidden('sectionName', $sectionName) }}
                            <div class="row">
                                <input type="hidden" id="homepage" name="active_homepage_status"
                                       value="{{$setting['active_homepage_status']}}">
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                    <div class="img-radio img-thumbnail {{ ($setting['active_homepage_status'] == \App\Models\Setting::STATUS_HOMEPAGE_1) ? 'img-border' : '' }}"
                                         data-id="{{ \App\Models\Setting::STATUS_HOMEPAGE_1 }}">
                                        <img src="{{asset('assets/images/homepage_one.png')}}" alt="Homepage">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                    <div class="img-radio img-thumbnail {{ ($setting['active_homepage_status'] == \App\Models\Setting::STATUS_HOMEPAGE_2) ? 'img-border' : '' }}"
                                         data-id="{{ \App\Models\Setting::STATUS_HOMEPAGE_2 }}">
                                        <img src="{{asset('assets/images/homepage_two.png')}}" alt="Homepage">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                    <div class="img-radio img-thumbnail {{ ($setting['active_homepage_status'] == \App\Models\Setting::STATUS_HOMEPAGE_3) ? 'img-border' : '' }}"
                                         data-id="{{ \App\Models\Setting::STATUS_HOMEPAGE_3 }}">
                                        <img src="{{asset('assets/images/homepage_three.png')}}" alt="Homepage">
                                    </div>
                                </div>
                                <div class="mt-7">
                                    {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
@endsection
