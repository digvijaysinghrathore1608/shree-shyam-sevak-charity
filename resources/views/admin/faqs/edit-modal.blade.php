<div class="modal fade" id="editFaqsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.faqs.edit_faqs') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form id="editFaqsForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                @csrf
                @method('POST')
                {{ Form::hidden('id',null,['id' => 'faqsID']) }}
                <div class="modal-body">
                    <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                         id="createNews CategoryValidationErrorsBox">
                        <i class="fa-solid fa-face-frown me-5"></i>
                    </div>
                    <div class="mb-5">
                        {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required']) }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('messages.common.title'), 'required','id'=>'editFaqsTitle', 'maxLength'=>100]) }}
                    </div>
                    <div class="mb-5">
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label mb-2']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('messages.common.description'), 'rows' => '3','id'=>'editFaqsDescription', 'maxLength'=>500]) }}
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'editFaqsBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
