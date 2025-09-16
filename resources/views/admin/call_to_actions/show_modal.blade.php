<div class="modal fade" id="showCallToActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.call_to_actions.call_to_actions_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'inquiryShowForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="inquiryShowValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showName" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('phone_no', __('messages.call_to_actions.phone').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showPhoneNo" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('subject', __('messages.call_to_actions.address').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showAddress" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('subject', __('messages.call_to_actions.zip').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showZip" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showCreatedAt" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('updated_at', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showUpdatedAt" class="fs-4 text-gray-800"></p>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


