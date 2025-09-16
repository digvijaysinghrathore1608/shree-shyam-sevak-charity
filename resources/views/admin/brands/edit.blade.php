<div class="modal fade" id="editBrandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.brand.edit_brand') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editBrandForm','files' => true]) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="countryValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::hidden('id', null,['id' => 'editBrandId']) }}
                    {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control','id' => 'editName','required', 'placeholder' => __('messages.brand.enter_brand_name')]) }}
                </div>
                <div class="mb-5">
                    <div class="mb-3" io-image-input="true">
                        <label for="exampleInputImage"
                               class="form-label">{{__('messages.common.image').':' }}</label>
                        <span class="required"></span>
                        <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="Best resolution for this favicon will be 225x55">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage image-object-fit" id="editPreviewImage"
                                     style="background-image: url('{{ asset('front_landing/images/turbologo.png') }}')">
                                </div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                      data-placement="top" data-bs-original-title="Change Image">
                                    <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="editImage" name="image" class="image-upload d-none"
                                                   accept=".png, .jpg, .jpeg"/>
                                         <input type="hidden" name="event_image">
                                    </label>
                                 </span>
                            </div>
                            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>

                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

