<div class="modal side-fade fade modal-right" id="showGiftTransactionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.campaign_transactions.donor_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'transactionShowForm']) }}
            <input type="hidden" value="{{getCurrencySymbol($campaign->currency)}}" id="campaignGiftCurrencySymbol">
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="transactionShowValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('full_name', __('messages.user.full_name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <br>
                        <p id="userGiftFullName" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('user_email', __('messages.common.email').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="userGiftEmail" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('donated_amount', __('messages.campaign_transactions.donated_amount').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showGiftDonatedAmount" class="fs-4 text-gray-800"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('payment_id', __('messages.campaign_transactions.payment_id').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showGiftPaymentId" class="ffs-4 text-gray-800 text-break"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('payment_method', __('messages.campaign_transactions.payment_method').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <div class="me-3">
                            <div class="badge bg-success">
                                <div id="showGiftPaymentMethod"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mt-3">
                        {{ Form::label('payment_date', __('messages.campaign_transactions.payment_date').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showGiftPaymentDate" class="fs-4 text-gray-800"></p>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

