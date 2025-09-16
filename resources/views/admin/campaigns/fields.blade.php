<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required']) }}
            {{ Form::text('title', '', ['class' => 'form-control ', 'placeholder' => __('messages.common.title'), 'required', 'id' => 'campaignCreateTitle','maxLength'=>50]) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('slug', __('messages.common.slug').':', ['class' => 'form-label required']) }}
            {{ Form::text('slug', '', ['class' => 'form-control ', 'placeholder' => __('messages.common.slug'), 'required', 'id' => 'campaignCreateSlug', 'readonly']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('campaign_category_id', __('messages.campaign.campaign_category').':', ['class' => 'form-label required']) }}
            {{ Form::select('campaign_category_id', $campaignCategory, null,['class' => 'form-select','required','placeholder' => __('messages.campaign.select_campaign_category'), 'id' => 'campaignCategoryId', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label required']) }}
            {{ Form::select('status', $status, null,['class' => 'form-select ','required','placeholder' => __('messages.common.status'), 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.common.short_description').':', ['class' => 'form-label']) }}
            {{ Form::textarea('short_description', '', ['class' => 'form-control ', 'placeholder' => __('messages.common.short_description'), 'rows' => '5', 'maxLength'=>500]) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.common.image').':'}}</label>
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this image will be 200x200">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
            <span class="required"></span>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="profileImageIcon"
                         style="background-image:url('{{ asset('front_landing/images/cause-details.png') }}')"></div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*"/>
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-7">
            {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required']) }}
            <div id="campaignDescriptionCreateId" class="editor-height"></div>
            {{ Form::hidden('description', null, ['id' => 'campaignCreateDescription']) }}
        </div>
    </div>

    <div class="d-flex justify-content-start">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnSubmit"]) }}
        <a href="{{ route('campaigns.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>

