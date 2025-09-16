<div class="row mb-5">
    <div class="col-md-12 mb-5">
        {{ Form::label('terms_conditions', __('messages.terms_conditions.terms_conditions').':', ['class' => 'required form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div id="termConditionId" class="vh-ql-container"></div> 
        {{ Form::hidden('terms_conditions', isset($settings['terms_conditions']->value) ? $settings['terms_conditions']->value : null, ['class' => 'form-control form-control-solid', 'id'=>'termsConditionsData']) }}
    </div>
    <div class="col-md-12 mb-5">
        {{ Form::label('privacy_policy', __('messages.terms_conditions.privacy_policy').':', ['class' => 'required form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
        <div id="privacyPolicyId" class="vh-ql-container"></div>
        {{ Form::hidden('privacy_policy', isset($settings['privacy_policy']->value) ? $settings['privacy_policy']->value : null, ['class' => 'form-control form-control-solid', 'id'=>'privacyPolicyData']) }}
    </div>
</div>
<div class="row mb-5">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('terms-conditions.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
