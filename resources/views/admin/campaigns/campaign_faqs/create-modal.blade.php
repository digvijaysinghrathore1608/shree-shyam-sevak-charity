<div class="modal fade" id="creatCampaignFaqsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.faqs.add_faqs') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'createCampaignFaqsForm','files' => true]) }}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="createNews CategoryValidationErrorsBox"></div>
                <div class="mb-5">
                    {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label']) }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('messages.common.title'), 'required','id'=>'createCampaignFaqsTitle']) }}
                    </div>
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('messages.common.description'), 'rows' => '3' ,'id' => 'createCampaignFaqsDescription']) }}
                
                    {{Form::hidden('campaign_id', $campaign->id)}}

                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="modal-footer pt-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'addCampaignFaqsBtn']) }}
                    <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
                </div>
          {{ form::close() }}
        </div>
</div>
