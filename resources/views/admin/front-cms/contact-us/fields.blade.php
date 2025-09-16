<div class="row">
    <div class="col-md-12 mb-5">
        {{ Form::label('menu_title', __('messages.contact_us.menu_title').':', ['class' => 'required mb-2']) }}
        {{ Form::text('menu_title', $contactUs['menu_title'],['class' => 'form-control', 'placeholder' => __('messages.contact_us.enter_title'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-lg-12 mb-3">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage"
                   class="form-label required">{{__('messages.contact_us.menu_image').(':')}}</label>
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="profileImageIcon"
                         style="background-image: url('{{ $contactUs['menu_image'] ? $contactUs['menu_image'] : asset('assets/images/infyom-logo.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="menu_image" id="menu_image" class="image-upload d-none"
                                   accept="image/*"/>
                         </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
</div>
<div class="row gx-10 mb-3">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('contact-us.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
