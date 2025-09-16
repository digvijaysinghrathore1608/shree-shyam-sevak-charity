<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('name', __('messages.common.title').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{$event->title}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3n">
                {{ Form::label('email', __('messages.events.event_category').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ (isset($event->eventCategory->name)) ? $event->eventCategory->name : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('email', __('messages.events.event_date').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('Do MMM, YYYY')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.start_time').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->start_time)) ? \Carbon\Carbon::parse($event->start_time)->format('H:i:s') : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.end_time').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->end_time)) ? \Carbon\Carbon::parse($event->end_time)->format('H:i:s') : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.available_tickets').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->available_tickets)) ? $event->available_tickets : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.event_organizer_name').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->event_organizer_name)) ? $event->event_organizer_name : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.event_organizer_email').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->event_organizer_email)) ? $event->event_organizer_email : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.event_organizer_phone').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->event_organizer_phone)) ? $event->event_organizer_phone : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.event_organizer_website').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->event_organizer_website)) ? $event->event_organizer_website : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.venue').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->venue)) ? $event->venue : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.venue_location').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->venue_location)) ? $event->venue_location : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.events.venue_phone').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($event->venue_phone)) ? $event->venue_phone : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.common.status').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (($event->status == 1)) ? 'Published' : 'Draft'}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($event->created_at)) }}">{{ $event->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($event->updated_at)) }}">{{ $event->updated_at->diffForHumans() }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('icon', __('messages.common.image').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <img src="{{ $event->image_url}}" alt="Price Image"
                     class="show-image-detail" height="50px" width="50px">
            </div>
            <div class="col-sm-12 d-flex flex-column mb-md-10 mb-12">
                {{ Form::label('view_by', __('messages.common.description').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ (isset($event->description)) ? $event->description : __('messages.common.n/a')}}</span>
            </div>
        </div>
    </div>
</div>

<div class="mt-7 overflow-hidden">
    <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <button class="nav-link active p-0" id="registration-tab" data-bs-toggle="tab"
                    data-bs-target="#registration"
                    type="button" role="tab" aria-controls="overview" aria-selected="true">
                {{__('messages.event.registration')}}
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="registration" role="tabpanel"
             aria-labelledby="registration-tab">
            <div class="fw-bold">
                <livewire:event-participant-table :event-id="$event->id"/>
            </div>
        </div>
    </div>
</div>

