<div class="row">
    <div class="col-lg-6 mb-5">
        {{ Form::label('title', __('messages.common.title').':', ['class' => 'form-label required']) }}
        {{ Form::text('title', isset($event) ? $event->title : null, ['class' => 'form-control', 'placeholder' => __('messages.common.title') ,'id'=>'eventCreateTitle', 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('slug', __('messages.common.slug').':', ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
        {{ Form::text('slug',  isset($event) ? $event->slug : null, ['class' => 'form-control', 'placeholder' => __('messages.common.slug'), 'tabindex' => 1, 'required', 'id'=>'eventCreateSlug' , 'readonly']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('category_id', __('messages.events.event_category').':', ['class' => 'form-label required']) }}
        {{ Form::select('category_id', $events,isset($event->category_id) ? $event->category_id : null, ['class' => 'form-select io-select2','data-control'=>'select2','placeholder' => __('messages.events.event_category') , 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('event_date', __('messages.events.event_date').':', ['class' => 'form-label required']) }}
        {{ Form::text('event_date', isset($event) ? $event->event_date : null, ['class' => 'form-control bg-white', 'placeholder' => __('messages.events.event_date'), 'required', 'id' => 'eventDate', 'autocomplete'=>'off', 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('start_time', __('messages.events.start_time').':', ['class' => 'form-label required']) }}
        {{ Form::text('start_time', isset($event) ? \Carbon\Carbon::parse($event->start_time)->format('H:i:s') : null, ['class' => 'form-control bg-white', 'placeholder' =>  __('messages.events.start_time'), 'required', 'id' => 'startDate', 'autocomplete'=>'off','required']) }}

    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('end_time', __('messages.events.end_time').':', ['class' => 'form-label required']) }}
        {{ Form::text('end_time', isset($event) ? \Carbon\Carbon::parse($event->end_time)->format('H:i:s') : null, ['class' => 'form-control bg-white', 'required' , 'placeholder' =>  __('messages.events.end_time'), 'id' => 'endDate', 'autocomplete'=>'off']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('available_tickets', __('messages.events.available_tickets').':', ['class' => 'form-label required']) }}
        {{ Form::text('available_tickets', isset($event) ? $event->available_tickets : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.available_tickets'), 'required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('event_organizer_name', __('messages.events.event_organizer_name').':', ['class' => 'form-label']) }}
        {{ Form::text('event_organizer_name', isset($event) ? $event->event_organizer_name : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.event_organizer_name')]) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('event_organizer_email', __('messages.events.event_organizer_email').':', ['class' => 'form-label required']) }}
        {{ Form::text('event_organizer_email', isset($event) ? $event->event_organizer_email : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.event_organizer_email'), 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('event_organizer_phone', __('messages.events.event_organizer_phone').':', ['class' => 'form-label required']) }}
        {{ Form::text('event_organizer_phone', isset($event) ? $event->event_organizer_phone : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.event_organizer_phone'),'required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('event_organizer_website', __('messages.events.event_organizer_website').':', ['class' => 'form-label']) }}
        {{ Form::text('event_organizer_website', isset($event) ? $event->event_organizer_website : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.event_organizer_website'), 'id' => 'event_organizer_website']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('venue', __('messages.events.venue').':', ['class' => 'form-label required']) }}
        {{ Form::text('venue', isset($event) ? $event->venue : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.venue'), 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('venue_location', __('messages.events.venue_location').':', ['class' => 'form-label']) }}
        {{ Form::text('venue_location', isset($event) ? $event->venue_location : null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.venue_location')]) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('venue_phone', __('messages.events.venue_phone').':', ['class' => 'form-label']) }}
        {{ Form::tel('venue_phone', isset($event)?$event->venue_phone:null, ['class' => 'form-control', 'placeholder' =>  __('messages.events.venue_phone'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('is_active',__('messages.common.status').(':'), ['class' => 'form-label required']) }}
        {{ Form::select('status', \App\Models\Event::ADDSTATUS,isset($event->status) ? $event->status : null, ['class' => 'form-select io-select2','data-control'=>'select2','placeholder' => __('messages.common.select_status')]) }}
    </div>
    <div class="col-lg-12 mb-5">
        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label']) }}
        {{ Form::textarea('description', isset($event) ? $event->description : null, ['class' => 'form-control', 'placeholder' => __('messages.common.description')]) }}
    </div>

    <div class="col-lg-6 mb-7">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.common.image')}}:</label>
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="Best resolution for this image will be 40x40">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
            <span class="required"></span>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="profileImageIcon"
                         style="background-image: url('{{ !empty($event->image_url) ? $event->image_url : asset('front_landing/images/events-1.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" class="image-upload d-none" accept="image/*"/>
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "btnEventSubmit"]) }}
        <a href="{{ route('events.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>

