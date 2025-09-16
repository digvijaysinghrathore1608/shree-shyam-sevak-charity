@extends('admin.layouts.app')
@section('title')
    {{$setting['application_name']}}
@endsection
@section('content')
        <div class="container-fluid">
            @include('admin.setting.setting_menu')
            <div class="card mb-5">
                <div class="card-header" role="button" data-bs-toggle="collapse">
                    <div class="card-title m-0">
                        <h3 class="m-0">{{__('messages.setting.contact_information')}}</h3>
                    </div>
                </div>
                <div class="card-body pt-5">
                    {{ Form::open(['route' => 'setting.update', 'files' => true,'class'=>'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::label('address', __('messages.setting.address').':', ['class' => 'required form-label']) }}
                            {{ Form::textarea('address',$setting['address'], ['class' => 'form-control', 'required','placeholder' => __('messages.setting.address'),'rows'=>'5', 'maxLength'=>200]) }}
                        </div>
                        <div class="d-flex pt-8">
                            {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
@endsection
