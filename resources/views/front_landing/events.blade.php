@extends('front_landing.layouts.app')
@section('title')
{{__('messages.events.events')}}
@endsection
@section('content')
    <div class="events-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{asset('front_landing/images/events-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{__('messages.event.events')}}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start upcoming-events-section  -->



        <section class="trending-causes-section pt-100 pb-100">
            <div class="px-lg-5 px-md-2 ps-2 pe-2">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-xl-3 pb-5" >
                        <div class="news-right-section">
                            <div class="popular-tags bg-light rounded-10 position-relative ">
                                <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                    <h5 class="fs-20 fw-6 text-dark mb-0">{{ __('messages.front_landing.all_categories') }}</h5>
                                    <div class="rectangle-shape"></div>
                                </div>
                                <div class="tags nav-tabs">
                                    @if(count($eventCategories) > 0)
                                        <div class="tag me-2 mb-2 item">
                                            <a class="fs-16 text-dark fw-5 radius-four {{ $eventCategoryId == '' ? 'active' : '' }} category_id">{{__('messages.front_landing.all_categories')}}</a>
                                        </div>
                                    @else
                                        <p class="font-weight-bold">{{__('messages.front_landing.no_events_available_at_this_moment')}}</p>
                                    @endif
                                    @foreach($eventCategories as $eventCategory)
                                        @if($eventCategory->events_count > 0 && $eventCategory->is_active)
                                            <div class="tag me-2 mb-2">
                                                <a class="fs-16 text-dark fw-5 radius-four category_id {{ $eventCategory->id == $eventCategoryId ? 'active' : '' }}"
                                                   data-filter=".water"
                                                   data-id="{{ $eventCategory->id }}">{{ $eventCategory->name }}</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9  col-lg-8 ">
                        @livewire('show-events')
                    </div>
                </div>
            </div>
        </section>

        <!-- end upcoming-events-section  -->
    </div>
   
@endsection
