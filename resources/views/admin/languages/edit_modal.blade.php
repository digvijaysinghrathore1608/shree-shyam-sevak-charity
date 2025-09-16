<div class="modal fade" id="editLanguageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.language.edit_language') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editLanguageForm','files' => true]) }}
            {{ Form::hidden('languageId',null,['id'=>'languageId']) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="editValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('name',__('messages.language.language').(':'), ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control','required','id'=>'editLanguage','placeholder' => __('messages.language.language')] ) }}
                </div>
                <div class="mb-5">
                    {{ Form::label('iso_code',__('messages.language.iso_code').(':'),['class' => 'form-label required']) }}
                    {{ Form::text('iso_code', '', ['class' => 'form-control', 'id' => 'editIso','placeholder' => __('messages.language.iso_code')]) }}
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

