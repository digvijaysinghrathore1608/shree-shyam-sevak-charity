@extends('front_landing.layouts.app')
@section('title')
    {{ __('messages.terms_conditions.privacy_policy') }}
@endsection
@section('content')
    <div class="blog-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{asset('front_landing/images/blog-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative pe-xl-5">
                                <h2 class="fs-1 mb-md-0 fw-6">{{ __('messages.terms_conditions.privacy_policy') }}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start blog-section  -->
        <section class="blog-section pt-100 pb-100">
            <div class="container">
                <p class="fs-16 fw-5 text-gray mb-4 pb-lg-2">
                    {!! $privacyPolicy->value !!}
                </p>
            </div>
        </section>
        <!-- end blog-section  -->
    </div>
@endsection
