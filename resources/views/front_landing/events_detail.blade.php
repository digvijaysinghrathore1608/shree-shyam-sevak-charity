@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.events.event_details')}}
@endsection
@section('content')
    <div class="crystal-events-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{asset('front_landing/images/eventsdetails-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{ $event->title }}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start crystal-events-section -->
        <section class="crystal-events-section  pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="crystal-img rounded-10 mb-40">
                            <img src="{{ !empty($event->image_url) ? $event->image_url : url('front_landing/images/events-2.png') }}"
                                 class="w-100 h-100 object-fit-cover ">
                        </div>
                        <p class="fs-16 fw-5 text-dark">{{ $event->description }}</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="crystal-events bg-light p-30 rounded-10">
                            <h5 class="fs-18 fw-5 text-primary pb-lg-2 mb-4">{{ $event->title }}</h5>
                            <div class="d-flex  flex-wrap align-items-center mb-3 pb-1">
                                <div class="icon rounded-10 d-flex justify-content-center align-items-center me-3">
                                    <i class="fa-solid fa-location-dot text-primary "></i>
                                </div>
                                <a class="fs-16 fw-5 text-dark mb-0">{{ $event->venue ? $event->venue : 'N/A' }}</a>
                            </div>
                            <div class="d-flex flex-wrap  align-items-center mb-3 pb-1">
                                <div class="icon rounded-10 d-flex justify-content-center align-items-center me-3">
                                    <i class="fa-solid fa-envelope text-primary "></i>
                                </div>
                                <a href="mailto::{{ $event->event_organizer_email }}"
                                   class="fs-16 fw-5 text-dark mb-0">{{ $event->event_organizer_email ? $event->event_organizer_email : 'N/A'}}</a>
                            </div>
                            <div class="d-flex flex-wrap  align-items-center mb-3 pb-1">
                                <div class="icon rounded-10 d-flex justify-content-center align-items-center me-3">
                                    <i class="fa-solid fa-phone text-primary "></i>
                                </div>
                                <a href="tel:{{ $event->event_organizer_phone }}"
                                   class="fs-16 fw-5 text-dark mb-0">{{ $event->event_organizer_phone ? $event->event_organizer_phone : 'N/A' }}</a>
                            </div>
                            <div class="d-flex flex-wrap  align-items-center mb-40">
                                <div class="icon rounded-10 d-flex justify-content-center align-items-center me-3">
                                    <i class="fa-solid text-primary">{{ $event->available_tickets }}</i>
                                </div>
                                <a class="fs-16 fw-5 text-dark mb-0">{{__('messages.front_landing.available_seats')}}</a>
                            </div>
                           
                            @if($event->event_date >= \Carbon\Carbon::now()->format('Y-m-d'))
                            <div class="button">
                                <a type="button" class="btn btn-primary w-100  bookSeatBtn" data-bs-toggle="modal"
                                   data-bs-target="#bookSeatModalShow"
                                   data-id="{{ $event->id }}">{{__('messages.front_landing.book_your_seat')}}</a>
                            </div>
                            @else
                                <p class="text-danger">Event already expired.</p>
                            @endif
                            @include('front_landing.book_seat')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end crystal-events-section -->
@endsection
