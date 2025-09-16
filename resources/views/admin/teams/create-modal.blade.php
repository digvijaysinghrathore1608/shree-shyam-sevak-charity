<div class="modal fade" id="createTeamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.teams.add_new_team') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'createTeamForm','files' => true]) }}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert"
                     id="createTeamValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').(':'), ['class' => 'required mb-2']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name'), 'required']) }}
                </div>
                <div class="mb-5">
                    {{ Form::label('designation', __('messages.teams.designation').(':'), ['class' => 'required mb-2']) }}
                    {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => __('messages.teams.designation'), 'required']) }}
                </div>
                <div class="mb-3" io-image-input="true">
                    <label for="image" class="form-label required">{{ __('messages.common.image').':' }}</label>
                    <span data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title="Best resolution for this image will be 225x55">
                          <i class="fas fa-question-circle general-question-mark"></i>
                   </span>
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage image-object-fit" id="staffImage"
                                 style="background-image: url('{{ asset('front_landing/landing/img/team/team1.png') }}')">
                            </div>
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                  data-placement="top" data-bs-original-title="Change Image">
                                <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                         <input type="file" class="image-upload d-none" name="image" id="Image"
                                                accept=".png, .jpg, .jpeg">
                                         <input type="hidden" name="avatar_remove">
                                </label>
                             </span>
                        </div>
                        <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'createTeamBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>

