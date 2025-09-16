
<div class="row mb-5">
    <div class="col-md-12 d-flex mb-7 mt-4">
        <div class="col-md-3">
            <div class="mb-3" io-image-input="true">
                <label class="form-label required">
                    <span>{{  __('messages.about_us.image_1').(':')}}</span>
                    <span data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
                </label>
                <div class="d-block">
                    <div class="image-picker">
                        <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ ($category['image_1']) ? $category['image_1'] : asset('assets/images/infyom-logo.png') }}')">
                        </div>
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                              data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image_1" class="image-upload d-none" id='menu_bg_image' accept="image/*" /> 
                        </label> 
                    </span>
                    </div>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
        <div class="col-md-9">
            <div class="mb-5">
                {{ Form::label('title_1', __('messages.categories.title_1').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('title_1',$category['title_1'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_title'), 'required']) }}
            </div>
            <div class="mb-5">
                {{ Form::label('description_1', __('messages.categories.description_1').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::textarea('description_1',$category['description_1'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_description'), 'required','rows'=>'3']) }}
            </div>
        </div>
    </div>

</div>
<div class="row mb-5">
    <div class="col-md-12 d-flex mb-7 mt-4">
        <div class="col-md-3">
            <div class="mb-3" io-image-input="true">
                <label class="form-label required">
                    <span>{{  __('messages.about_us.image_2').(':')}}</span>
                    <span data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
                </label>
                <div class="d-block">
                    <div class="image-picker">
                        <div class="image previewImage" id="exampleInputImage" style=" background-image: url('{{ ($category['image_2']) ? $category['image_2'] : asset('assets/images/infyom-logo.png') }}')">
                        </div>
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                              data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image_2" class="image-upload d-none" id='menu_bg_image' accept="image/*" /> 
                        </label> 
                    </span>
                    </div>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
        <div class="col-md-9">
            <div class="mb-5">
                {{ Form::label('title_2', __('messages.categories.title_2').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('title_2', $category['title_2'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_title'), 'required']) }}
            </div>
            <div class="mb-5">
                {{ Form::label('description_2', __('messages.categories.description_2').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::textarea('description_2',$category['description_2'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_description'), 'required','rows'=>'3']) }}
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12 d-flex mb-7 mt-4">
        <div class="col-md-3">
            <div class="mb-3" io-image-input="true">
                <label class="form-label required">
                    <span>{{  __('messages.categories.image_3').(':')}}</span>
                    <span data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
                </label>
                <div class="d-block">
                    <div class="image-picker">
                        <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ ($category['image_3']) ? $category['image_3'] : asset('assets/images/infyom-logo.png') }}')">
                        </div>
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                              data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image_3" class="image-upload d-none" id='menu_bg_image' accept="image/*" /> 
                        </label> 
                    </span>
                    </div>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
        <div class="col-md-9">
            <div class="mb-5">
                {{ Form::label('title_3', __('messages.categories.title_3').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::text('title_3',$category['title_3'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_title'), 'required']) }}
            </div>
            <div class="mb-5">
                {{ Form::label('description_3', __('messages.categories.description_3').':', ['class' => 'required form-label mb-2']) }}
                {{ Form::textarea('description_3',$category['description_3'],['class' => 'form-control', 'placeholder' => __('messages.categories.category_description'), 'required','rows'=>'3']) }}
            </div>
        </div>
    </div>

</div>

<div class="row gx-10 mb-5">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('categories.index')}}" type="reset"
           class="btn btn-light btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
