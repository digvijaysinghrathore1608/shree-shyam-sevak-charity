<div class="modal fade" id="editNewsCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.news_category.edit_news_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form id="editNewsCategoryForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                @csrf
                @method('POST')
                {{ Form::hidden('id',null,['id' => 'NewsCategoryID']) }}
                <div class="modal-body">
                    <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                         id="CategoryValidationErrorsBox">
                        <i class="fa-solid fa-face-frown me-5"></i>
                    </div>
                    <div class="mb-5">
                        {{ Form::label('name', __('messages.common.name').':', ['class' => 'required mb-2']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name'), 'required', 'id'=>'editNewsCategoryName']) }}
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'editNewsCategoryBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
