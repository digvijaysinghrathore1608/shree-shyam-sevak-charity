@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.faqs.faqs')}}
@endsection
@section('content')
    <div class="faqs-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{$faqsImg['menu_image'] ? : asset('front_landing/images/causes-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{__('messages.faqs.faqs')}}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->
        <!-- start accordian-section -->
        <section class="accordian-section mt-5 pb-100">
            <div class="container">
                <div class="row align-items-stretch">
                    <div class="col-12">
                        <div class="accordion" id="accordionExample">
                            @foreach($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq-{{ $faq->id }}">
                                        <button class="accordion-button px-0 fw-5 fs-16 {{ !$loop->first ? 'collapsed' : ''}}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{$faq->id}}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faq-collapse-{{$faq->id}}">
                                            {{$faq->title}}
                                        </button>
                                    </h2>
                                    <div id="faq-collapse-{{$faq->id}}" class="accordion-collapse collapse {{ $loop->first ? 'show' : ''}}" aria-labelledby="faq-{{ $faq->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-0 pt-0">
                                            <p class="fs-14 text-dark mb-0">
                                                {{$faq->description}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end accordian-section -->
    </div>
@endsection
