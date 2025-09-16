<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label required']) }}
            {{ Form::text('first_name', isset($user) ? $user->first_name : null, ['class' => 'form-control', 'placeholder' => __('messages.user.first_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label required']) }}
            {{ Form::text('last_name', isset($user) ? $user->last_name : null, ['class' => 'form-control', 'placeholder' => __('messages.user.last_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('email', __('messages.common.email').':', ['class' => 'form-label required']) }}
            {{ Form::email('email', isset($user) ? $user->email : null, ['class' => 'form-control', 'placeholder' => __('messages.common.email'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('contact', __('messages.user.contact_no').':', ['class' => 'form-label required']) }}<br>
            {{ Form::tel('contact', isset($user) && $user->contact ? '+'.$user->region_code.$user->contact : null, ['class' => 'form-control', 'placeholder' => __('messages.user.contact_no'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
            {{ Form::hidden('region_code',isset($user) ? $user->region_code : old('region_code'),['id'=>'prefix_code']) }}
            <span id="valid-msg" class="hide text-success fw-400 fs-small mt-2">✓ Valid</span>
            <span id="error-msg" class="hide text-danger fw-400 fs-small mt-2"></span>
        </div>
    </div>
  

    @if(!isset($user))
        <div class="col-lg-6 mb-5">
            <label class="form-label required">{{ __('messages.user.password').':' }}</label>
            <div class="mb-3 position-relative">
                <input class="form-control" id="password" type="password" name="password"
                       placeholder="{{__('messages.user.password')}}" autocomplete="off" required aria-label="Password"
                       data-toggle="password"/>
                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"><i
                            class="bi bi-eye-slash-fill"></i></span>
            </div>
        </div>

        <div class="col-lg-6 mb-5">
            <label class="form-label required">{{ __('messages.user.confirm_password').':' }}</label>
            <div class="mb-3 position-relative">
                <input class="form-control " id="cPassword"
                       type="password" placeholder="{{__('messages.user.confirm_password')}}"
                       name="password_confirmation"
                       autocomplete="off" required aria-label="Password" data-toggle="password"/>
                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"> <i
                            class="bi bi-eye-slash-fill"></i></span>
            </div>
        </div>
    @endif
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('role', __('messages.role.role').':', ['class' => 'form-label required']) }}
            {{ Form::select('role', $roles,isset($user->role_name) ? $user->roles()->first()->id : '', ['class' => 'form-select','required','data-control'=>'select2','placeholder' => __('messages.role.select_role')]) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                 <div class="mt-2">
                     <input class="form-check-input" type="radio" name="gender" value="0"
                            {{ !empty($user) && $user->gender === 0 ? 'checked' : '' }} required checked>
                    <label class="form-label mr-3">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                    
                     <input class="form-check-input ms-2" type="radio" name="gender" value="1"
                            {{ !empty($user) && $user->gender === 1 ? 'checked' : '' }} required>
                    <label class="form-label mr-3">{{ __('messages.user.female') }}</label>
                 </div>
        </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('country_id', __('messages.country.country').':', ['class' => 'form-label required']) }}
            {{ Form::select('country_id', $countries,isset($user->country_id) ? $user->country_id : null, ['class' => 'form-select','required','data-control'=>'select2','placeholder' => __('messages.country.select_country')]) }}
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('is_active',__('messages.common.is_active').(':'), ['class' => 'form-label']) }}
        <div class="d-flex">
            <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm">
                <input type="checkbox" name="is_active" class="form-check-input cursor-pointer" value="1"
                       id="active" {{ !empty($user) && $user->is_active === 1 ? 'checked' : '' }}  {{ empty($user) ? 'checked' : '' }}>
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('address', __('messages.setting.address').':', ['class' => 'form-label required']) }}
        {{ Form::textarea('address', isset($user) ? $user->address : null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.user.profile').(':') }}</label>
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this profile will be 40x40">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="staffImage"
                         style="background-image: url('{{ !empty($user->profile_image) ? $user->profile_image : asset('front_landing/images/team-3.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{__('Change profile')}}">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profile_image" name="profile" class="image-upload d-none"
                                   accept="image/*"/>
                    </label>
                </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnSubmit"]) }}
        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>



