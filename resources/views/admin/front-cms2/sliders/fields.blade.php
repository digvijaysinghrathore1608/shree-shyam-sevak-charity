<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('title_1', __('messages.slider.title_1').':', ['class' => 'required form-label']) }}
        {{ Form::text('title_1', isset($secondSlider) ? $secondSlider->title_1 : '',['class' => 'form-control', 'placeholder' => __('messages.slider.slider_title_1'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('title_2', __('messages.slider.title_2').':', ['class' => 'required form-label']) }}
        {{ Form::text('title_2', isset($secondSlider) ? $secondSlider->title_2 : '',['class' => 'form-control', 'placeholder' => __('messages.slider.slider_title_2'), 'required', 'max' => '40']) }}
    </div>
    <div class="col-lg-3 mb-3">
        <div class="mb-3" io-image-input="true">
            <label class="form-label required">
                <span>{{ __('messages.common.image').(':')}}</span>
                <span data-bs-toggle="tooltip"
                      data-placement="top"
                      data-bs-original-title="Best resolution for this image will be 1920x1100">
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
            </label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage"
                         style="background-image: url('{{ isset($secondSlider) ? $secondSlider->slider_image : asset('front_landing/web/media/avatars/slider.png') }}')">
                    </div>
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
</div>


<div class="row gx-10 mb-5">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', 'id' => 'saveSlider2Btn']) }}
        <a href="{{route('second-slider.index')}}" type="reset"
           class="btn btn-light btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
