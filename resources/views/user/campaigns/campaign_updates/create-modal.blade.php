<div class="modal fade" id="creatCampaignUpdatesModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.campaign_updates.add_campaign_updates') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id'=>'createUserCampaignUpdatesForm','files' => true]) }}
                @csrf
                @method('POST')
                <div class="alert alert-danger d-none" id="createNews CategoryValidationErrorsBox"></div>
                <div class="row">
                    <div>
                        <div class="mb-5">
                            {{ Form::label('title', __('messages.common.title').':', ['class' => 'required']) }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required', 'id' => 'createCampaignUpdatesTitle']) }}
                        </div>
                        <div>
                            {{ Form::label('description', __('messages.common.description').':') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Short Description', 'rows' => '3' ,'id' => 'createCampaignUpdatesDescription']) }}
                        </div>
                        {{Form::hidden('campaign_id', $campaign->id)}}
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end pt-5">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'createCampaignUpdateBtn']) }}
                    <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
