<div class="modal side-fade fade modal-right" id="showPagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog side-modal-show vh-100 ms-auto my-0 me-0 modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.page.page_detail') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'pagesShowForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="inquiryShowValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('title', __('messages.common.title').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <br>
                    <p id="showTitle" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showName" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('status', __('messages.common.is_active').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showStatus" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showCreatedAt" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('updated_at', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showUpdatedAt" class="fs-4 text-gray-800"></p>
                </div>
                <div class="mb-5">
                    {{ Form::label('description',__('messages.common.description').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                    <p id="showDescription" class="fs-4 text-gray-800"></p>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>



