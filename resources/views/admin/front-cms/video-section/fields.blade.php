<div class="row">
    <div class="col-md-6 mb-5">
        {{ Form::label('short_title', __('messages.video_section.short_title').':', ['class' => 'form-label required mb-2']) }}
        {{ Form::text('short_title', $videoSection['short_title'],['class' => 'form-control', 'placeholder' => __('messages.video_section.enter_short_title'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required mb-2']) }}
        {{ Form::text('title', $videoSection['title'],['class' => 'form-control', 'placeholder' => __('messages.contact_us.enter_title'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('youtube_video_link', __('messages.video_section.youtube_video_link').':', ['class' => 'required form-label mb-2']) }}
        {{ Form::text('youtube_video_link',  $videoSection['youtube_video_link'] , ['class' => 'form-control form-control-solid','id'=>'youtubeUrl','placeholder' => __('messages.video_section.youtube_video_link'),'required']) }}
    </div>
    <div class="col-lg-12 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label required">{{__('messages.video_section.bg_image')}}
                :</label>

            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this image will be 1920x390">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="previewImage"
                         style="background-image: url({{ $videoSection['bg_image'] ? $videoSection['bg_image'] : asset('front_landing/landing/img/slider/3.png') }})">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="bg_image" id="bg_image" class="image-upload d-none"
                                   accept="image/*"/>
                                        <input type="hidden" name="avatar_remove1">
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
        <a href="{{route('video-section.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
