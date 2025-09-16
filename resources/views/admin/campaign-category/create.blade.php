<div class="modal fade" id="addCampaignCategoryModal"  tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.campaign.add_campaign_category') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addCampaignCategoryForm','files' => true,'enctype' => 'multipart/form-data'])}}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="createNews CategoryValidationErrorsBox"></div>
                <div class="mb-5">
                    {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.campaign.enter_category_name')]) }}
                </div>
                <div class="mb-5">
                    {{ Form::label('is_active',__('messages.common.is_active').(':'), ['class' => 'form-label']) }}
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="active"
                               checked value="1">
                    </div>
                </div>
                <div class="col-lg-12">
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
                                    <div class="image previewImage image-object-fit" id="previewImage"
                                         style="background-image: url('{{ asset('front_landing/images/causes-hero-img.png') }}')">
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
                                <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-2','id'=>'campaignCategoryBtn']) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{ form::close() }}
</div>

