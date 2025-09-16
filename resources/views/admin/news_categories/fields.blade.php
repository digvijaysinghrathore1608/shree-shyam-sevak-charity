<div class="row gx-10 mb-5">
    <div class="fv-row mb-7 fv-plugins-icon-container">
    {{ Form::label('name', __('messages.common.name').':', ['class' => 'required fw-bold fs-6 mb-2']) }}
    {{ Form::text('name', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.common.name'), 'required']) }}
    <div class="fv-plugins-message-container invalid-feedback"></div>
</div>


    <div class="d-flex">
            <button type="submit" class="btn btn-primary" id="account_profile_details_submit">{{ __('crud.save') }}</button>&nbsp;&nbsp;&nbsp;
            <a href="{{ route('news-categories.index') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">@lang('crud.cancel')</a>
    </div>
</div>

