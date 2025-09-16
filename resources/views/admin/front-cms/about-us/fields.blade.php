<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-md-12 mb-5">
                {{ Form::label('menu_title', __('messages.about_us.menu_title').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('menu_title', $aboutUs['menu_title'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.menu_title'), 'required', 'max' => '45']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('title', $aboutUs['title'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.about_us_title'), 'required', 'max' => '45']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('short_description', __('messages.common.short_description').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::textarea('short_description', $aboutUs['short_description'] ,['class' => 'form-control', 'placeholder' => __('messages.common.short_description'), 'required', 'maxLength'=>2000]) }}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-md-12 mb-5">
                {{ Form::label('years_of_exp', __('messages.about_us.years_of_exp').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('years_of_exp', $aboutUs['years_of_exp'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.years_of_exp'), 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'max' => '45']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('point_1', __('messages.about_us.point_1').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('point_1', $aboutUs['point_1'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.point_1'), 'required']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('point_2', __('messages.about_us.point_2').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('point_2', $aboutUs['point_2'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.point_2'), 'required']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('point_3', __('messages.about_us.point_3').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('point_3', $aboutUs['point_3'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.point_3'), 'required']) }}
            </div>
            <div class="col-md-12 mb-5">
                {{ Form::label('point_4', __('messages.about_us.point_4').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('point_4', $aboutUs['point_4'] ,['class' => 'form-control', 'placeholder' => __('messages.about_us.point_4'), 'required']) }}
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-4" io-image-input="true">
        <label for="exampleInputImage" class="form-label required">{{__('messages.about_us.menu_bg_image').(':')}}
        </label>
        <span data-bs-toggle="tooltip"
              data-placement="top"
              data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
        <div class="d-block">
            <div class="image-picker">
                <div class="image previewImage image-object-fit" id="profileImageIcon"
                     style="background-image: url('{{$aboutUs['menu_bg_image'] ? $aboutUs['menu_bg_image'] : asset('front_landing/images/about-hero-img.png')}}')">
                </div>
                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                      data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="menu_bg_image" id="menu_bg_image" class="image-upload d-none"
                                   accept="image/*"/>
                        </label> 
                    </span>
            </div>
        </div>
        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
    </div>
    <div class="col-md-4" io-image-input="true">
        <label for="exampleInputImage" class="form-label required">{{__('messages.about_us.image_1').(':')}}</label>
        <span data-bs-toggle="tooltip"
              data-placement="top"
              data-bs-original-title="Best resolution for this image will be 500x563">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
        <div class="d-block">
            <div class="image-picker">
                <div class="image previewImage image-object-fit" id="profileImageIcon"
                     style="background-image: url('{{ $aboutUs['image_1']  ? $aboutUs['image_1']  : asset('front_landing/images/about-us1.png') }}')">
                </div>
                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                      data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image_1" id="image_1" class="image-upload d-none"
                                   accept="image/*"/>
                         </label> 
                    </span>
            </div>
        </div>
        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
    </div>
    <div class="col-md-4" io-image-input="true">
        <label for="exampleInputImage" class="form-label required">{{__('messages.about_us.image_2').(':')}}</label>
        <span data-bs-toggle="tooltip"
              data-placement="top"
              data-bs-original-title="Best resolution for this image will be 320x280">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
        <div class="d-block">
            <div class="image-picker">
                <div class="image previewImage image-object-fit" id="profileImageIcon"
                     style="background-image: url('{{ $aboutUs['image_2']  ? $aboutUs['image_2']  : asset('front_landing/images/about-us2.png') }}')">
                </div>
                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                      data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image_2" id="image_2" class="image-upload d-none"
                                   accept="image/*"/>
                         </label> 
                    </span>
            </div>
        </div>
        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
    </div>
</div>
<div class="row mb-5">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('about-us.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
