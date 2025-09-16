<div class="modal fade"  id="showCampaignFaqModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.campaign_faqs.campaign_faqs_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'pagesShowForm']) }}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger display-none hide d-none" id="inquiryShowValidationErrorsBox"></div>
                <div class="mb-5">
                    {{ Form::label('title', __('messages.common.title').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <br>
                    <p id="showTitle" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showCreatedAt" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
             {{ Form::label('updated_at', __('messages.common.last_updated').(':'), ['class' => 'fs-5 text-gray-600']) }}
                <p id="showUpdatedAt" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('description',__('messages.common.description').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showDescription" class="fs-5 text-gray-800"></p>
                </div>
            </div>
            {{ form::close() }}
        </div>
    </div>
</div>

