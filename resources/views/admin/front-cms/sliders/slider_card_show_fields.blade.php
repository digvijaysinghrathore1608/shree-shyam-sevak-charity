@include('flash::message')
@include('admin.layouts.errors')
<div class="card mb-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="col-md-3">
                    <div class="mb-3" io-image-input="true">
                        <label for="exampleInputImage" class="form-label">{{__('messages.common.image')}}:</label>
                        <span class="required"></span>
                        <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="Best resolution for this image will be 1920x482">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage image-object-fit" id="profileImageIcon"
                                     style="background-image: url({{ !empty($sliderCard['image']) ? asset($sliderCard['image']) : asset('front_landing/landing/img/event/370-240_1.png') }})">
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
            <div class="col-md-9">
                <div class="mb-5">
                    {{ Form::label('title_1', __('messages.categories.title_1').':', ['class' => 'required form-label']) }}
                    {{ Form::text('title_1',$sliderCard['title_1'],['class' => 'form-control ', 'placeholder' => __('messages.categories.card_title'), 'required','max'=>'15']) }}
                </div>
                <div class="mb-5">
                    {{ Form::label('title_2', __('messages.categories.title_2').':', ['class' => 'form-label required']) }}
                    {{ Form::text('title_2',$sliderCard['title_2'],['class' => 'form-control ', 'placeholder' => __('messages.categories.card_title'), 'required','max'=>'15']) }}
                </div>
            </div>
        </div>
    </div>
        <div class="d-flex justify-content-end">
            <div>
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
                <a href="{{route('sliders.index')}}" type="reset"
                   class="btn btn-secondary">{{__('messages.common.discard')}}</a>
            </div>
        </div>
    </div>
</div>
