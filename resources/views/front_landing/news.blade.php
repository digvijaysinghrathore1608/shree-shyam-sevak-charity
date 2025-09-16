@php
    $settings  = settings();
@endphp
@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.news.news')}}
@endsection
@section('content')
    <div class="news-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{ $newsImg['menu_image'] ? : asset('front_landing/images/team-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{__('messages.front_landing.news_feeds')}}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start news-section -->
        <div class="news-section ">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- start news-left-section -->
                        <div class="news-left-section pt-60">
                            @livewire('show-news',['newsCategory'=>$newsCategoryId , 'newsTags' => $newsTagId])
                        </div>
                        <!-- end news-left-section -->
                    </div>
                    @include('front_landing.sidebar_menu')
                </div>
            </div>
        </div>
        <!-- end news-section -->
    </div>
    </div>
@endsection
