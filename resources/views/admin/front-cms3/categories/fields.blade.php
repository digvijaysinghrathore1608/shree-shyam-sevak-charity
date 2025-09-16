<div class="row mb-5">
    <div class="row">
        <div class="col-md-12">
            @if(isset($thirdCategory))
                {{ Form::hidden('id',$thirdCategory->id) }}
            @endif
            {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label']) }}
            {{ Form::text('title',isset($thirdCategory) ? $thirdCategory->title : null,['class' => 'form-control', 'placeholder' => __('messages.categories.category_title'), 'required']) }}
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="mb-2" io-image-input="true">

        <label class="form-label required">
            <span>{{ __('messages.common.image').(':')}}</span>
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
        </label>
        <div class="d-block">
            <div class="image-picker">
                <div class="image previewImage" id="exampleInputImage"
                     style="background-image: url('{{ isset($thirdCategory) ? $thirdCategory->categories_image : asset('front_landing/landing/img/cat1.png') }}')">
                </div>
                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                      data-placement="top" data-bs-original-title="Change image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" id="menu_bg_image"
                                   accept="image/*"/> 
                        </label> 
                    </span>
            </div>
        </div>
        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
    </div>
</div>

<div class="row gx-10 mb-5">
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', 'id' => 'saveSlider3CategoryBtn']) }}
        <a href="{{route('third-categories.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>

