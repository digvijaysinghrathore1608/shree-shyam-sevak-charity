<div class="row gx-10 mb-5">
    <div class="col-md-12 mb-5">
        {{ Form::label('short_title', __('messages.video_section.short_title').':', ['class' => 'required form-label mb-2']) }}
        {{ Form::text('short_title', $secondVideoSection['short_title'],['class' => 'form-control form-control-solid', 'placeholder' => __('messages.video_section.enter_short_title'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-12 mb-5">
        {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label mb-2']) }}
        {{ Form::text('title', $secondVideoSection['title'],['class' => 'form-control form-control-solid', 'placeholder' => __('messages.contact_us.enter_title'), 'required', 'max' => '45']) }}
    </div>
    <div class="col-md-12 mb-5">
        {{ Form::label('youtube_video_link', __('messages.video_section.youtube_video_link').':', ['class' => 'required form-label text-gray-700 mb-3']) }}
        {{ Form::text('youtube_video_link',  $secondVideoSection['youtube_video_link'] , ['class' => 'form-control form-control-solid','id'=>'youtubeUrl','placeholder' => __('messages.video_section.youtube_video_link'),'required']) }}
    </div>
    <div class="col-md-12">
        <div class="mb-3" io-image-input="true">
            <label class="form-label required">
                <span>{{  __('messages.video_section.bg_image').(':')}}</span>
                <span data-bs-toggle="tooltip"
                      data-placement="top"
                      data-bs-original-title="Best resolution for this image will be 1920*390">   
                                <i class="fas fa-question-circle ml-1  general-question-mark"></i>
                        </span>
            </label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style=" background-image: url('{{ ($secondVideoSection['bg_image']) ? $secondVideoSection['bg_image'] : asset('assets/images/infyom-logo.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="bg_image" class="image-upload d-none" id='bg_image'
                                   accept="image/*"/> 
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
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('second-video-section.index')}}" type="reset"
           class="btn btn-light btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
