<div id="showWithdrawModal" class="modal side-fade fade modal-right" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <!-- Modal content-->
        <div class="modal-content min-h-100">
            <div class="modal-header">
                <h2>{{ __('messages.withdraw.rejected_reasons') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'withdrawShowForm']) }}
            <div class="modal-body scroll-y">
                <div class="alert alert-danger display-none hide d-none" id="withdrawShowValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('user_notes', __('messages.withdraw.your_notes').(':'), ['class' => 'mb-3']) }}
                        <p id="showUserNotes"></p>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('admin_notes', __('messages.withdraw.rejected_reason_notes').(':'), ['class' => 'mb-3']) }}
                        <p id="showAdminNotes"></p>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

