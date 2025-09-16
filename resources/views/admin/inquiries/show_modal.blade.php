<div class="modal side-fade fade modal-right" id="showInquiriesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.inquiries.message') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'inquiryShowForm']) }}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger display-none hide d-none" id="inquiryShowValidationErrorsBox"></div>
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').(':'),['class' => 'fs-5 text-gray-600']) }}
                    <br>
                    <p id="showName" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('email', __('messages.common.email').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showEmail" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('phone_no', __('messages.inquiries.phone').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showPhoneNo" class="fs-5 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('subject', __('messages.inquiries.subject').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showSubject" class="fs-5 text-gray-800"></p>
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
                    {{ Form::label('message',__('messages.inquiries.message').(':'), ['class' => 'fs-5 text-gray-600']) }}
                    <p id="showMessage" class="fs-5 text-gray-800"></p>
                </div>
                {{ form::close() }}
            </div>
        </div>
    </div>
</div>
