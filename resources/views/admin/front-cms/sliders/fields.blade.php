<div class="row">
    <div class="col-md-6 mb-5">
        {{ Form::label('title_1', __('messages.slider.title_1').':', ['class' => 'form-label required']) }}
        {{ Form::text('title_1', isset($slider) ? $slider->title_1 : '',['class' => 'form-control ', 'placeholder' => __('messages.slider.slider_title_1'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('title_2', __('messages.slider.title_2').':', ['class' => 'form-label required']) }}
        {{ Form::text('title_2', isset($slider) ? $slider->title_2 : '',['class' => 'form-control ', 'placeholder' => __('messages.slider.slider_title_2'), 'required', 'max' => '40']) }}
    </div>
    <div class="col-lg-3">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label required">{{__('messages.common.image').(':')}}
                <span data-bs-toggle="tooltip"
                      data-placement="top"
                      data-bs-original-title="Best resolution for this image will be 1920x1100">
        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
</span></label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="previewImage"
                         style="background-image: url('{{ isset($slider) ? asset($slider->slider_image) : asset('front_landing/web/media/avatars/slider.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*"
                                   id="slider_card_image"/>
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
</div>
    <div class="mt-5">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3', 'id' => 'saveSliderBtn']) }}
        <a href="{{route('sliders.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
