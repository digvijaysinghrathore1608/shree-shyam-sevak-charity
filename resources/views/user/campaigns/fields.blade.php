<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required']) }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required', 'id' => 'campaignCreateTitle','maxLength'=>50]) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('slug', __('messages.common.slug').':', ['class' => 'form-label required']) }}
            {{ Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug', 'required', 'id' => 'campaignCreateSlug', 'readonly']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('campaign_category_id', __('messages.campaign.campaign_category').':', ['class' => 'form-label required']) }}
            {{ Form::select('campaign_category_id', $campaignCategory, null,['class' => 'form-select','required', 'data-control' => 'select2', 'placeholder' => 'Select Campaign Category', 'id' => 'campaignCategoryId']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label required']) }}
            {{ Form::select('status', $status, null,['class' => 'form-select','required', 'data-control' => 'select2', 'placeholder' => 'Select Status']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('short_description', __('messages.common.short_description').':', ['class' => 'form-label']) }}
                {{ Form::textarea('short_description', '', ['class' => 'form-control', 'placeholder' => 'Short description', 'rows' => '5', 'maxLength'=>2000]) }}
            </div>
        </div>

        <div class="col-lg-3 mb-2">
            <div class="mb-3" io-image-input="true">
                <label for="exampleInputImage"
                       class="form-label required">{{ __('messages.common.image').(':') }}</label>
                <span data-bs-toggle="tooltip"
                      data-placement="top"
                      data-bs-original-title="Best resolution for this profile will be 200x200">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
                <div class="d-block">
                    <div class="image-picker">
                        <div class="image previewImage image-object-fit" id="staffImage"
                             style="background-image: url('{{ asset('front_landing/landing/img/campaign/Group1.png') }}')">
                        </div>
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                              data-placement="top" data-bs-original-title="{{__('Change Image')}}">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profile_image" name="image" class="image-upload d-none"
                                   accept="image/*"/>
                    </label>
                </span>
                    </div>
                </div>
                <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required']) }}
            <div id="campaignDescriptionCreateId" class="editor-height"></div>
            {{ Form::hidden('description', null, ['id' => 'campaignCreateDescription']) }}
        </div>
    </div>

    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnSubmit"]) }}
        <a href="{{ route('user.campaigns.index') }}" type="reset"
           class="btn btn-secondary ">{{__('messages.common.discard')}}</a>
    </div>
</div>

