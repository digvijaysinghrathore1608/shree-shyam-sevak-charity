<div id="showCampaignUpdateModal" class="modal side-fade fade modal-right" role="dialog" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-md side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <!-- Modal content-->
        <div class="modal-content min-h-100">
            <div class="modal-header">
                <h2>{{ __('messages.campaign_updates.campaign_update_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'pagesShowForm1']) }}
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="inquiryShowValidationErrorsBox"></div>
                <div class="row">
                    <div>
                        {{ Form::label('title', __('messages.common.title').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <br>
                        <p id="faqUpdateShowTitle" class="fs-4 text-gray-800"></p>
                    </div>
                    <div>
                        {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="faqUpdateShowCreatedAt" class="fs-4 text-gray-800"></p>
                    </div>
                    <div>
                        {{ Form::label('updated_at', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="faqUpdateShowUpdatedAt" class="fs-4 text-gray-800"></p>
                    </div>
                    <div>
                        {{ Form::label('description',__('messages.common.description').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="faqUpdateShowDescription" class="fs-4 text-gray-800"></p>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
