<div id="showTransactionModal" class="modal side-fade fade modal-right" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <!-- Modal content-->
        <div class="modal-content min-h-100">
            <div class="modal-header">
                <h2>{{ __('messages.campaign_transactions.donor_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'transactionShowForm']) }}
            <input type="hidden" value="{{getCurrencySymbol($campaign->currency)}}" id="campaignCurrencySymbol">
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="transactionShowValidationErrorsBox"></div>
                <div class="row">
                    <div>
                        {{ Form::label('full_name', __('messages.user.full_name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <br>
                        <p id="userFullName" class="fs-4 text-gray-800"></p>
                    </div>
                    <div>
                        {{ Form::label('user_email', __('messages.common.email').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="userEmail"></p>
                    </div>
                    <div>
                        {{ Form::label('donated_amount', __('messages.campaign_transactions.donated_amount').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showDonatedAmount" class="fs-4 text-gray-800"></p>
                    </div>
                    <div>
                        {{ Form::label('payment_id', __('messages.campaign_transactions.payment_id').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <p id="showPaymentId" class="ffs-4 text-gray-800 text-break"></p>
                    </div>
                    <div>
                        {{ Form::label('payment_method', __('messages.campaign_transactions.payment_method').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                        <div class="me-3 mb-3">
                            <div class="badge bg-success">
                                <div id="showPaymentMethod"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{ Form::label('payment_date', __('messages.campaign_transactions.payment_date').(':'), ['class' => 'mb-3']) }}
                        <p id="showPaymentDate" class="fs-4 text-gray-800"></p>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

