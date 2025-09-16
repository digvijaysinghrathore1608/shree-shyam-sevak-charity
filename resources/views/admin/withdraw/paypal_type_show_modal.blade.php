<div class="modal side-fade fade modal-right" id="paypalPaymentDetailsShowModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.campaign.payment_type_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'pagesShowForm']) }}
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="inquiryShowValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('payment_account_email', __('messages.campaign.payment_account_email').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <br>
                        <p id="showPaypalAccountEmail" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('payment_account_message', __('messages.campaign.payment_account_message').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showPaypalAccountMessage" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showPaypalCreatedRequestDate" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('created_at', __('messages.common.status').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="approvedPayPalType" class="fs-4 text-gray-800"></p>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

