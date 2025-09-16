<div class="modal side-fade fade modal-right" id="bankPaymentDetailsShowModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.campaign.bank_request_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'paypalRequestShowForm']) }}
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="inquiryShowValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('bank_account_number', __('messages.campaign.bank_account_no').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <br>
                        <p id="showBankAccountNumber" class="fs-4 text-gray-800"></p>
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('bank_isbn_number', __('messages.campaign.bank_isbn_no').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showIsbnNo" class="fs-4 text-gray-800"></p>
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('bank_branch_name', __('messages.campaign.bank_branch_name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showBranchName" class="fs-4 text-gray-800"></p>
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('bank_account_holder_name', __('messages.campaign.bank_account_holder_name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showAccountHolderName" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('bank_message', __('messages.campaign.bank_message').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showBankMessage" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showBankCreatedRequestDate" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('created_at', __('messages.common.status').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="approvedType" class="fs-4 text-gray-800"></p>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

