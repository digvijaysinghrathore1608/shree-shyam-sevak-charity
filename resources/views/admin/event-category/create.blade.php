<div class="modal fade" id="addEventCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.event_category.add_event_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addEventCategoryForm','files' => true]) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="countryValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.campaign.enter_category_name')]) }}
                </div>
                <div class="mb-5">
                    <div class="mb-3" io-image-input="true">
                        <label for="exampleInputImage"
                               class="form-label required">{{__('messages.common.image').':' }}</label>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="previewImage"
                                     style="background-image: url('{{ asset('front_landing/images/events-4.png') }}')">
                                </div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                      data-placement="top" data-bs-original-title="Change Image">
                                    <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="Image" name="image" class="image-upload d-none"
                                                   accept=".png, .jpg, .jpeg"/>
                                         <input type="hidden" name="event_image">
                                    </label>
                                 </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                </div>
                <div class="mb-5">
                    {{ Form::label('is_active',__('messages.common.is_active').(':'), ['class' => 'form-label']) }}
                    <label class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1"
                               id="active" checked>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'eventCategoryBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
