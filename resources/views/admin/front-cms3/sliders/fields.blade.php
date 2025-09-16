<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('title_1', __('messages.slider.title_1').':', ['class' => 'required form-label']) }}
        {{ Form::text('title_1', isset($thirdSlider) ? $thirdSlider->title_1 : '',['class' => 'form-control', 'placeholder' => __('messages.slider.slider_title_1'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('title_2', __('messages.slider.title_2').':', ['class' => 'required form-label ']) }}
        {{ Form::text('title_2', isset($thirdSlider) ? $thirdSlider->title_2 : '',['class' => 'form-control', 'placeholder' => __('messages.slider.slider_title_2'), 'required', 'max' => '40']) }}
    </div>
    <div class="col-lg-3">
        <div class="mb-5" io-image-input="true">
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
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ isset($thirdSlider) ? $thirdSlider->slider_image : asset('front_landing/images/tranding-4.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*"/> 
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', 'id' => 'saveSlider3Btn']) }}
        <a href="{{route('third-slider.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
