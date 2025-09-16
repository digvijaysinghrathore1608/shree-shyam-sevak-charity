<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="addBasicDetails" role="tabpanel">
        {{ Form::open(['route' => ['user.campaigns.update', $campaign->id],'files' => 'true', 'id' => 'campaignEditForm', 'enctype' => 'multipart/form-data']) }}
        @method('PUT')
        @csrf
        <div class="card-body p-12">
            <div class="row gx-10">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-2">
                            {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required']) }}
                            {{ Form::text('title',isset($campaign) ? $campaign->title : '', ['class' => 'form-control', 'placeholder' => 'Title','id' => 'campaignCreateTitle', 'required','maxLength'=>51]) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-5">
                            {{ Form::label('slug', __('messages.common.slug').':', ['class' => 'form-label required']) }}
                            {{ Form::text('slug', isset($campaign) ? $campaign->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug','id' => 'campaignCreateSlug', 'readonly', 'required']) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-5">
                            {{ Form::label('campaign_category_id', __('messages.campaign.campaign_category').':', ['class' => 'form-label required']) }}
                            {{ Form::select('campaign_category_id', $campaignCategory, isset($campaign) ? $campaign->campaign_category_id : '',['class' => 'form-select','required', 'data-control' => 'select2', 'placeholder' => 'Select Campaign Category', 'id' => 'campaignCategoryId']) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-5">
                            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label required ']) }}
                            {{ Form::select('status', $status, isset($campaign) ? $campaign->status : '',['class' => 'form-select','required', 'data-control' => 'select2', 'placeholder' => 'Select Status']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-5">
                                {{ Form::label('short_description', __('messages.common.short_description').':', ['class' => 'form-label']) }}
                                {{ Form::textarea('short_description', isset($campaign) ? $campaign->short_description : '', ['class' => 'form-control', 'placeholder' => 'Short description', 'rows' => '5', 'maxLength'=>2000]) }}
                            </div>
                        </div>

                        <div class="col-lg-3 mb-2">
                            <div class="mb-3" io-image-input="true">
                                <label for="exampleInputImage"
                                       class="form-label required">{{ __('messages.common.image').(':') }}</label>
                                <span data-bs-toggle="tooltip"
                                      data-placement="top"
                                      data-bs-original-title="Best resolution for this profile will be 200x200">
                                <i class="fas fa-question-circle general-question-mark"></i>
                        </span>
                                <div class="d-block">
                                    <div class="image-picker">
                                        <div class="image previewImage image-object-fit" id="staffImage"
                                             style="background-image: url('{{ isset($campaign) ? $campaign->image : asset('front_landing/landing/img/campaign/Group1.png') }}')">
                                        </div>
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                              data-placement="top" data-bs-original-title="{{__('Change profile')}}">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profile_image" name="image" class="image-upload d-none"
                                   accept="image/*"/>
                    </label>
                </span>
                                    </div>
                                </div>
                                <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-7">
                            {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required ']) }}
                            <div id="editCampaignDescriptionId" class="editor-height"></div>
                            {{ Form::hidden('description', $campaign->description, ['id' => 'editCampaignDescription']) }}
                        </div>
                    </div>

                    <div class="d-flex mb-5">
                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "editCampaignBtn"]) }}
                        <a href="{{ route('user.campaigns.index') }}" type="reset"
                           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

    <div class="tab-pane fade active show" id="addDefineGoal" role="tabpanel">
        {{ Form::open(['id' => 'userEditCampaignFieldForm']) }}
        {{ Form::hidden('id', isset($campaign) ? $campaign->id : '', ['id' => 'userCampaignId']) }}
        <div class="card-body maincard-section p-12">
            <div class="row gx-10 mb-5">
                <div class="col-sm-6">
                    {{ Form::label('current_currency', __('messages.setting.currency').':',['class' => 'form-label required']) }}
                    <select id="currencyType" data-show-content="true" class="form-select form-select-solid"
                            name="currency">
                        @foreach($currencies as $key => $currency)
                            <option value="{{$key}}" {{$campaign->currency == $key ? 'selected' : ''}} > {{ $currency['symbol'] }}
                                &nbsp;&nbsp;&nbsp; {{$currency['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('goal', __('messages.campaign.goal').':', ['class' => 'form-label required']) }}
                        {{ Form::text('goal',isset($campaign) ? $campaign->goal : '', ['class' => 'form-control', 'placeholder' => 'Goal', 'required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('recommended_amount', __('messages.campaign.recommended_amount').':', ['class' => 'form-label required']) }}
                        {{ Form::text('recommended_amount',isset($campaign) ? $campaign->recommended_amount : '', ['class' => 'form-control', 'placeholder' => 'Recommended Amount','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('amount_prefilled', __('messages.campaign.amount_prefilled').':', ['class' => 'form-label required']) }}
                        {{ Form::text('amount_prefilled',isset($campaign) ? $campaign->amount_prefilled : '', ['class' => 'form-control','required', 'placeholder' => 'Amount Prefilled','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('campaign_end_method', __('messages.campaign.campaign_end_method').':', ['class' => 'form-label required']) }}
                        <div class="d-flex justify-content-between align-self-center">
                            <div class="d-inline-block col-6">
                                <label class="form-check form-check-custom">
                                    <input name="campaign_end_method" class="form-check-input me-3" type="radio"
                                           value="{{ \App\Models\Campaign::AFTER_GOAL_ACHIEVE }}" {{ ($campaign->campaign_end_method == \App\Models\Campaign::AFTER_GOAL_ACHIEVE) ? 'checked' : '' }}>
                                    {{ __('messages.campaign.after_goal_achieve') }}
                                </label>
                            </div>
                            <div class="d-inline-block col-6">
                                <label class="form-check form-check-custom">
                                    <input name="campaign_end_method" class="form-check-input me-3" type="radio"
                                           value="{{ \App\Models\Campaign::AFTER_END_DATE }}" {{ ($campaign->campaign_end_method == \App\Models\Campaign::AFTER_END_DATE) ? 'checked' : '' }}>
                                    {{ __('messages.campaign.after_end_date') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('video_link', __('messages.campaign.video').':', ['class' => 'form-label']) }}
                        {{ Form::text('video_link',isset($campaign) ? $campaign->video_link : '', ['class' => 'form-control', 'placeholder' => 'Video Link']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('country_id', __('messages.country.country').':', ['class' => 'form-label required']) }}
                        {{ Form::select('country_id', $country, isset($campaign) ? $campaign->country_id : '',['class' => 'form-select','required', 'data-control' => 'select2', 'placeholder' => 'Select Country']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('location', __('messages.campaign.location').':', ['class' => 'form-label']) }}
                        {{ Form::text('location', isset($campaign) ? $campaign->location : '',['class' => 'form-control', 'placeholder' => 'Location']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('start_date', __('messages.campaign.start_date').':', ['class' => 'form-label required']) }}
                        {{ Form::text('start_date', isset($campaign) ? $campaign->start_date : '',['class' => 'form-control bg-white', 'placeholder' => 'Select Start Date', 'id' => 'campaignStartDate', 'required']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-5">
                        {{ Form::label('deadline', __('messages.campaign.deadline').':', ['class' => 'form-label required']) }}
                        {{ Form::text('deadline', isset($campaign) ? $campaign->deadline : '',['class' => 'form-control bg-white', 'placeholder' => 'Select Deadline Date', 'id' => 'campaignDeadlineDate','required']) }}
                    </div>
                </div>
                <div class="col-lg-3 mb-5">
                    {{ Form::label('is_featured',__('messages.campaign.is_featured').(':'), ['class' => 'form-label']) }}
                    <label class="form-check form-switch form-check-custom form-switch-sm">
                        <input type="checkbox" name="is_featured" class="form-check-input editIsFeatured" value="1"
                                {{ (isset($campaign) && $campaign->is_featured === 1) ? 'checked' : '' }} >
                    </label>
                </div>
                <div class="col-lg-3 mb-5">
                    {{ Form::label('is_emergency',__('messages.campaign.is_emergency').(':'), ['class' => 'form-label']) }}
                    <label class="form-check form-switch form-check-custom form-switch-sm">
                        <input type="checkbox" name="is_emergency" class="form-check-input editIsEmergency" value="1"
                                {{ (isset($campaign) && $campaign->is_emergency === 1) ? 'checked' : '' }} >
                    </label>
                </div>

                <div class="d-flex mb-2">
                    <button type="submit" class="btn btn-primary"
                            id="userEditCampaignFieldBtnSave">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('user.campaigns.index') }}" type="reset"
                       class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

    <div class="tab-pane fade" id="addGallery" role="tabpanel">
        {{ Form::open(['id' => 'editCampaignImageForm']) }}
        <div class="card-body maincard-section p-12">
            <div class="row gx-10 mb-5">
                <div class="col-12">
                    <div class="dropzone border-primary" id="userCampaignImageDropZone">
                        <div class="dz-message needsclick text-start d-flex justify-content-start">
                            <i class="bi bi-file-earmark-arrow-up text-primary fa-3x"></i>
                            <div class="ms-4 custom-img">
                                <h3 class="text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                <span class="text-gray-400">Upload up to 10 files</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
