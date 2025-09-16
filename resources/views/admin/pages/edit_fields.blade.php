<div class="row">
    <div class="mb-5">
        {{ Form::label('name', __('messages.page.page_name').':', ['class' => 'required form-label fs-6']) }}
        {{ Form::text('name', isset($page) ? $page->name:null, ['class' => 'form-control', 'placeholder' => __('messages.page.page_name'),'maxlength'=>'25']) }}
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('title', __('messages.common.title').':', ['class' => 'required form-label']) }}
            {{ Form::text('title', isset($page) ? $page->title:null, ['class' => 'form-control', 'placeholder' => __('messages.common.title'),'maxlength'=>'25']) }}
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('description', __('messages.common.description').':', ['class' => 'required form-label']) }}
            <div id="pageEditDescription"
                 class="vh-ql-container"></div> {{ Form::hidden('description',isset($page) ? $page->title: null, ['class' => 'form-control', 'name'=>'description']) }}
        </div>
    </div>
    <div class="d-flex col-lg-12">
        <div class="mb-5">
            {{ Form::label('is_active',__('messages.common.is_active').(':'), ['class' => 'form-label']) }}
            <label class="form-check form-switch ">
                <input type="checkbox" name="is_active"
                       class="form-check-input form-check-custom form-check-solid form-switch-sm cursor-pointer"
                       value="1"
                       id="active" {{ isset($page->is_active) && $page->is_active == 1 ? 'checked':''}}>
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnPagedEditSave"]) }}
        <a href="{{ route('pages.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>


