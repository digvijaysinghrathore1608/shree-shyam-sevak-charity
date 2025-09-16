<div class="row">
    <!-- Title Field -->
    <div class="col-lg-6 mb-5">
        <input type="hidden" name="added_by" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
        {{ Form::label('title',__('messages.common.title').':', ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
        {{ Form::text('title', isset($news) ? $news->title : null, ['class' => 'form-control', 'placeholder' =>  __('messages.common.title'), 'required', 'id'=>'newsCreateTitle', 'maxLength'=>250]) }}
    </div>

    <!-- Slug Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('slug', __('messages.common.slug').':', ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
        {{ Form::text('slug',  isset($news) ? $news->slug : null, ['class' => 'form-control', 'placeholder' => __('messages.common.slug'), 'tabindex' => 1, 'required', 'id'=>'newsCreateSlug', 'readonly']) }}
    </div>

    <!-- News Category Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('news', __('messages.news.news_categories').':', ['class' => 'form-label']) }}
        <span class="text-danger">*</span>
        {{ Form::select('news_category_id',$newsCategory,null, ['class' => 'form-select','data-control'=>'select2', 'required']) }}
    </div>
    <!-- Tag Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('tags', __('messages.news.tags').':', ['class' => 'form-label required']) }}
        {{Form::select('tags[]',$newsTags,!empty($tags) ? $tags : null, ['class' => 'form-select io-select2','data-control'=>'select2','id'=>'newsTagId','multiple'=>true,'required'])}}
    </div>
    <!-- Description Field -->
    <div class="col-lg-6 mb-5">
        {{ Form::label('description', __('messages.common.description').':', ['class' => 'required']) }}
        <div id="newsEditDetails"
             class="vh-ql-container"></div> {{ Form::hidden('description', isset($news) ? $news->description : null, ['class' => 'form-control', 'name'=>'description']) }}
    </div>
    <!-- Image Field -->
    <div class="col-lg-6 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label required">{{__('messages.common.image')}}:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="exampleInputImage"
                         style="background-image: url('{{ !empty($news->news_image) ? $news->news_image : asset('front_landing/images/news-details-img.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" id="Image" class="image-upload d-none" accept="image/*"/> 
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnNewsSave"]) }}
    <a href="{{ route('news.index') }}" type="reset"
       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
</div>
</div>
</div>

