<div class="modal fade" id="editNewsCommentsModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.news_comments.edit_news_comments') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="editNewsCommentsForm" >
                    @csrf
                    @method('POST')
                    {{ Form::hidden('id',null,['id' => 'newsCommentsID']) }}
                <div class="alert alert-danger d-none" id="createNews CategoryValidationErrorsBox"></div>
                <div class="row mb-5">
                    <div>
                        <div class="mb-5">
                            {{ Form::label('comments', __('messages.news_comments.comments').':', ['class' => 'required']) }}
                            {{ Form::textarea('comments', null, ['class' => 'form-control', 'placeholder' => __('messages.news_comments.comments'), 'required','id'=>'editNewsComments']) }}
                        </div>
                        <div class="mb-5">
                            {{ Form::label('name', __('messages.common.name').':', ['class' => 'required']) }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name'), 'rows' => '3' ,'id'=>'editNewsCommentsName']) }}
                        </div>
                        <div class="mb-5">
                            {{ Form::label('email', __('messages.common.email').':', ['class' => 'required']) }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('messages.common.email'), 'rows' => '3' ,'id'=>'editNewsCommentsEmail']) }}
                        </div>
                        <div>
                            {{ Form::label('website_name', __('messages.news_comments.website_name').':') }}
                            {{ Form::text('website_name', null, ['class' => 'form-control', 'placeholder' => __('messages.news_comments.website_name'), 'rows' => '3' ,'id'=>'editNewsCommentsWebsiteName']) }}
                        </div>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="d-flex justify-content-end pt-7">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'createNews CategoryBtn']) }}
                        <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
