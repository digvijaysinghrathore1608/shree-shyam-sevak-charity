<div class="row">
    <div class="col-md-12 mb-5">
        {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label']) }}
        {{ Form::text('title', isset($successStory) ? $successStory->title : '',['class' => 'form-control', 'placeholder' => __('messages.contact_us.enter_title'), 'required', 'maxlength' => '60']) }}
    </div>
    <div class="col-md-12 mb-5">
        {{ Form::label('short_description', __('messages.common.short_description').':', ['class' => 'required form-label']) }}
        {{ Form::textarea('short_description', isset($successStory) ? $successStory->short_description : '',['class' => 'form-control', 'placeholder' => __('messages.success_story.enter_short_description'), 'required', 'maxlength' => '400']) }}
    </div>
    <div class="col-lg-3 mb-7">
        <div io-image-input="true">
            <label class="form-label required" data-bs-toggle="tooltip"
                   data-placement="top"
                   data-bs-original-title="Best resolution for this image will be 270x160">{{ __('messages.common.image').(':') }}
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
            </label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="profileImageIcon"
                         style="   background-image: url('{{ isset($successStory) ? $successStory->image : asset('front_landing/images/success-stories.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*" id="slider_card_image"/>
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
    </div>
</div>
    <div class="d-flex">
        <div>
            {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3', 'id' => 'saveSuccessStoryBtn']) }}
            <a href="{{route('success-stories.index')}}" type="reset"
               class="btn btn-secondary">{{__('messages.common.discard')}}</a>
        </div>
    </div>
</div>
