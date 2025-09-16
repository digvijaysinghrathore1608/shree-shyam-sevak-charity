<div class="modal fade" id="creatCampaignFaqsModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.faqs.add_faqs') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id'=>'createUserCampaignFaqsForm','files' => true]) }}
                @csrf
                @method('POST')
                <div class="alert alert-danger d-none" id="createNews CategoryValidationErrorsBox"></div>
                <div class="row">
                    <div>
                        <div class="mb-5">
                            {{ Form::label('title', __('messages.common.title').':', ['class' => 'required']) }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required','id'=>'createCampaignFaqsTitle']) }}
                        </div>
                        <div>
                            {{ Form::label('description', __('messages.common.description').':') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => '3' ,'id' => 'createCampaignFaqsDescription']) }}
                        </div>
                        {{Form::hidden('campaign_id', $campaign->id)}}
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end pt-5">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'addCampaignFaqsBtn']) }}
                    <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
