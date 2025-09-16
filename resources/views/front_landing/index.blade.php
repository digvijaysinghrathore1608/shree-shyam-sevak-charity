<?php
$latestNews = latestNews();
$brands = brands();
?>
@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.front_landing.home')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="home-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators d-flex d-xl-none">
                    @for($i = 0; $i< count($data['homepageThreeSliders']);$i++)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                                @if($i == 0) class="active" aria-current="true"
                                @endif aria-label="Slide {{$i+1}}"></button>
                    @endfor
                </div>
                <div class="carousel-inner">
                    @foreach($data['homepageThreeSliders'] as $slider)
                        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                            <div class="inner-bgimg position-relative object-fit-cover"
                                 style="background: url('{{ $slider->slider_image ? : asset('front_landing/images/hero-image.png')}}') no-repeat right;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-7 parallelogram-shape">
                                            <div class="text-white inner-text position-relative">
                                                <p class="fs-18 fw-5">{{ $slider->title_1 }}</p>
                                                <h2 class="fs-1 mb-0 fw-6">{{ $slider->title_2 }}</h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-5 mt-3 mt-md-4">
                                            <div class="video-play-btn m-lg-auto ms-md-auto">
                                                <button type="button"
                                                        class="play-video popup-video fs-4 border-0 slider-popup-video"
                                                        data-src="https://www.youtube.com/embed/{{ YoutubeID($data['homepageThreeVideo']['youtube_video_link']) }}">
                                                    <i class="fas fa-play text-primary"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Modal -->
					<div class="modal fade" id="homePageVideoModal" tabindex="-1"
	                         aria-labelledby="exampleModalLabel" aria-hidden="true">
		                    <div class="modal-dialog">
			                    <div class="modal-content">
				                    <div class="modal-header">
					                    <button type="button" class="btn-close text-white"
					                            data-bs-dismiss="modal" aria-label="Close"></button>
				                    </div>
				                    <div class="modal-body w-100">
					                    <iframe src=""
					                            class="w-100 h-100 home-page-video" title="YouTube video player"
					                            frameborder="0"
					                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					                            allowfullscreen></iframe>
				                    </div>
			                    </div>
		                    </div>
	                    </div>
                </div>
                <div class="d-none d-xl-block">
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('messages.common.previous')}}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('messages.common.next')}}</span>
                    </button>
                </div>
            </div>

        </section>
        <!-- end hero-section -->

        <!-- start category-section -->
        <section class="category-section pt-60 pb-50">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($data['campaignsCategories'] as $category)
                        @php
                            $campaignCount = getCampaignCount($category->id)
                        @endphp
                        @if($campaignCount > 0)
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="category-card">
                                <a href="{{ route('landing.causes',$category->id) }}">
                                        <div class="category-icon mx-auto mb-4">
                                            <img src="{{$category->image ? : asset('front_landing/images/category-icon1.png')}}"
                                                 alt="category"
                                                 class="img-fluid object-fit-cover"/>
                                        </div>
                                        <h6 class="mb-0 fw-5">{{ $category->name }}</h6>
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end category-section -->

        <!-- start trending-causes-section -->
        <section class="trending-causes-section bg-gray py-60">
            <div class="container">
                <div class="text-center">
                    <h2 class="fs-6 fw-6 text-primary">{{__('messages.front_landing.trending_causes')}}</h2>
                    <h3 class="fs-2 fw-6 mb-60">{{__("messages.front_landing.it's_about_impact_good_history")}}</h3>
                </div>
                <div class="row">
                    @foreach($data['campaigns'] as $campaign)
                        @if(!campaignEnd($campaign->id))
                            <div class="col-xl-4 col-lg-6 col-12 trending-card">
                                <div class="card">
                                    <div class="positon-relative">
                                        <div class="card-img">
                                            <a href="{{ route('landing.campaign.details',$campaign->slug) }}">
                                                <img src="{{ $campaign->image ? : asset('front_landing/images/tranding-1.png')}}"
                                                     class="card-img-top object-fit-cover" alt="card"></a>
                                            @if($campaign->is_featured)
                                                <div class="cause-feature-icon">
                                                    <i class="fas fa-award"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{route('landing.causes',$campaign->campaignCategory->id)}}"
                                           class="badge small-btn {{ $campaign->is_emergency == 1 ? 'custom-cause-red' : ''}}">
                                            {{ $campaign->campaignCategory->name}}</a>
                                        @php
                                            $shareUrl = Request::root().'/c/'.$campaign->slug;
                                        @endphp
                                        <div class="dropdown position-absolute">
                                            <button class="share-btn dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fa-solid fa-share text-white"></i>
                                            </button>
                                            <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton1">
                                                <div class="d-flex flex-wrap justify-content-between">
                                                    <div class="share-icon">
                                                        <a href="https://www.facebook.com/sharer.php?u={{ $shareUrl }}"
                                                           target="_blank" title="Facebook">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/facebook.png') }}"
                                                                 alt="facebook" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                    <div class="share-icon">
                                                        <a href="https://www.instagram.com/sharer.php?u={{$shareUrl}}"
                                                           target="_blank" title="Instagram">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/instagram.png') }}"
                                                                 alt="instagram" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                    <div class="share-icon">
                                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                                                           target="_blank" title="Linkedin">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/linkedin.png') }}"
                                                                 alt="linkedin" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                    <div class="share-icon ">
                                                        <a href="https://twitter.com/share?url={{$shareUrl}}&text={{ $campaign->title }}&hashtags=sharebuttons"
                                                           target="_blank" title="Twitter">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/twitter.png') }}"
                                                                 alt="twitter" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                    <div class="share-icon ">
                                                        <a href="mailto:?Subject={{ $campaign->title }}
                                                                &Body=This%20is%20your%20campaign%20link%20:%20{{$shareUrl}}"
                                                           target="_blank" title="Gmail">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/gmail.png') }}"
                                                                 alt="gmail" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                    <div class="share-icon">
                                                        <a href="https://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                                                           target="_blank" title="Pinterest">
                                                            <img src="{{ asset('front_landing/images/social-icon-images/pinterest.png') }}"
                                                                 alt="pinterest" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-primary fs-14">By {{ $campaign->user->full_name }}</h4>
                                        <h5 class="text-dark fs-18 mb-3">
                                            <a class="text-dark"
                                               href="{{ route('landing.campaign.details',$campaign->slug) }}">{{ Str::limit($campaign->title,50) }}</a>
                                        </h5>
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="d-flex align-items-center me-2 mt-2">
                                                @php
                                                    $goal = getRaisedAmountPercentage($campaign->campaignDonations->sum('donated_amount'),$campaign->goal);
                                                @endphp
                                                <div data-progress="{{$goal}}" style="--progress:{{$goal.'%'}};"
                                                     class="progress m-auto"></div>
                                                <div class="ms-0 ps-3">
                                                    <div class="mb-2">
                                                <span class="count-num text-dark fs-14 fw-5 me-1">
                                                    {{ getCurrencySymbol($campaign->currency) . $campaign->campaignDonations->sum('donated_amount') }}</span>
                                                        <span class="text-primary">{{__('messages.front_landing.raised')}}</span>
                                                    </div>
                                                    <div>
                                                <span class="count-num text-dark fs-14 fw-5 me-1">
                                                    {{ getCurrencySymbol($campaign->currency) . ($campaign->goal ? $campaign->goal : 0) }}
                                                </span><span class="text-primary">{{__('messages.campaign.goal')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{route('landing.payment', $campaign->slug)}}"
                                               class="btn btn-gray mt-4 {{ ((getSettingValue('stripe_enable')) == 1 || (getSettingValue('paypal_enable')) == 1 ? '' : '' )}}">{{__('messages.front_landing.donate')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('landing.causes') }}"
                       class="btn btn-secondary px-5">{{__('messages.front_landing.view_all')}}</a>
                </div>
            </div>
        </section>
        <!-- end trending-causes-section -->

        <!-- start about-section -->
        <section class="about-section pb-60 pt-60">
            <div class="container">
                <h2 class="text-primary d-flex  align-items-center justify-content-center mb-5">{{__('messages.about_us.about_us')}}</h2>
                <div class="row">
                    <div class="col-xxl-6 col-xl-7 col-lg-8">
                        <div class="about-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="about-1">
                                        <img src="{{$data['aboutUs']['image_1'] ? : asset('front_landing/images/about-1.png')}}"
                                             class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="about-content-box bg-primary ">
                                        <div class="about-content d-flex flex-column align-items-center justify-content-center ">
                                            <h2 class="number-big text-white fs-1 fw-6 counter"
                                                data-countto="{{ $data['aboutUs']['years_of_exp'] }}"
                                                data-duration="3000">
                                            </h2>
                                            <p class="mb-0 text-white fs-14 fw-5">{{__('messages.about_us.years_of_exp')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-md-flex align-items-center">
                                    <div class="about-2">
                                        <img src="{{$data['aboutUs']['image_2'] ? : asset('front_landing/images/about-2.png')}}"
                                             class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-5 col-lg-4 mt-lg-0 mt-sm-5 mt-4">
                        <div class="about-right">
                            <h2 class="text-dark fw-6 mb-3 pb-1">{{ $data['aboutUs']['title'] }}</h2>
                            <p class="text-dark fs-16 fw-5 mb-4 pb-lg-3">{{ $data['aboutUs']['short_description'] }}.</p>
                            <ul>
                                <li class="text-dark fs-16 fw-5 mb-2">{{ $data['aboutUs']['point_1'] }}</li>
                                <li class="text-dark fs-16 fw-5 mb-2">{{ $data['aboutUs']['point_2'] }}</li>
                                <li class="text-dark fs-16 fw-5 mb-2">{{ $data['aboutUs']['point_3'] }}</li>
                                <li class="text-dark fs-16 fw-5 mb-2">{{$data['aboutUs']['point_4']}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end about-section -->

        <!-- start count-section -->
        <section class="count-section bg-primary py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6 text-white text-center py-4">
                        <h2 class="fs-1 fw-6">
                            <span class="counter" data-countto="5" data-duration="3000">0</span>M+
                        </h2>
                        <h3 class="fs-6 mb-0">{{__('messages.front_landing.projects_done')}}</h3>
                    </div>
                    <div class="col-lg-3 col-6 text-white text-center py-4">
                        <h2 class="fs-1 fw-6">
                            <span class="counter" data-countto="3" data-duration="3000">0</span>M+
                        </h2>
                        <h3 class="fs-6 mb-0">{{__('messages.front_landing.hopeless_child')}}</h3>
                    </div>
                    <div class="col-lg-3 col-6 text-white text-center py-4">
                        <h2 class="fs-1 fw-6">
                            <span class="counter" data-countto="99" data-duration="3000">0</span>+
                        </h2>
                        <h3 class="fs-6 mb-0">{{__('messages.front_landing.team_member')}}</h3>
                    </div>
                    <div class="col-lg-3 col-6 text-white text-center py-4">
                        <h2 class="fs-1 fw-6">
                            <span class="counter" data-countto="10" data-duration="3000">0</span>+
                        </h2>
                        <h3 class="fs-6 mb-0">{{__('messages.front_landing.get_regards')}}</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- end count-section -->

        <!-- start video-section -->
        <section class="video-section pt-60">
            <div class="container">
                <div class="video-bg-img">
                    <div class="row position-relative">
                        <div class="col-md-8">
                            <h2 class="fs-6 fw-6 text-primary">{{ $data['homepageThreeVideo']['short_title'] }}</h2>
                            <h3 class="fs-2 fw-6 mb-0 text-white">{{ $data['homepageThreeVideo']['title'] }}</h3>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="video-play-btn m-lg-auto ms-md-auto">
                                <button type="button" class="play-video popup-video fs-4 border-0"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                    <i class="fas fa-play text-primary"></i>
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body w-100">
                                            <iframe src="https://www.youtube.com/embed/{{ YoutubeID($data['homepageThreeVideo']['youtube_video_link']) }}"
                                                    class="w-100 h-100"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end video-section -->

        <!-- start why-choose-section -->
        <section class="why-choose-section pt-60">
            <div class="container">
                <div class="text-center">
                    <h2 class="fs-6 fw-6 text-primary">{{__('messages.front_landing.why_choose_us')}}</h2>
                    <h3 class="fs-2 fw-6 mb-60">{{__("messages.front_landing.we've_funded_5k_dollars_over")}}</h3>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-lg-7 col-12 mb-5">
                        <div class="accordion" id="accordionExample">
                            @foreach($data['faqs'] as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq-{{ $faq->id }}">
                                        <button class="accordion-button  px-0 fw-5 fs-16 {{ !$loop->first ? 'collapsed' : ''}}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{$faq->id}}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faq-collapse-{{$faq->id}}">
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
                    <div class="col-lg-5 col-12 mt-4 mt-lg-0">
                        <div class="why-choos-img h-400 overflow-hidden">
                            <img src="{{ $data['aboutUs']['image_1'] ? : asset('front_landing/images/why-choose.png')}}"
                                 alt="why choose"
                                 class="img-fluid rounded-10 object-fit-cover h-75 w-100">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end why-chooses-section -->

        <!-- start news-feeds-section -->
        <section class="news-feed-section pb-60">
            <div class="container">
                <div class="text-center">
                    <h2 class="fs-6 fw-6 text-primary">{{__('messages.front_landing.insights')}}</h2>
                    <h3 class="fs-2 fw-6 mb-60">{{__('messages.front_landing.news_feeds')}}</h3>
                </div>
                <div class="row">
                    @foreach($latestNews as $news)
                        <div class="col-xl-4 col-lg-6 col-12 mb-2">
                            <div class="card">
                                <div class="positon-relative">
                                    <div class="card-img">
                                        <a href="{{route('landing.news-details', $news['slug'])}}">
                                            <img src="{{ $news['news_image'] ? : asset('front_landing/images/news-1.png') }}"
                                                 class="card-img-top object-fit-cover" alt="card"></a>
                                    </div>
                                    <a href="{{ route('landing.news') }}"
                                       class="badge small-btn">{{ $news->newsCategory->name }}</a>
                                </div>
                                <div class="card-body">
                                <span class="mb-2 d-block">
                                    <i class="fa-solid fa-calendar-days text-primary fs-6 me-2"></i>
                                    <span class="text-dark">{{ Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMMM YYYY') }}</span>
                                </span>
                                    <h4 class="card-title fs-18">
                                        <a class="link-dark"
                                           href="{{route('landing.news-details', $news['slug'])}}">{{ Str::limit($news->title , 35) }}</a>
                                    </h4>
                                    <p class="mb-0 text-secondary">
                                        {!! !empty(strip_tags($news->description)) ? Str::limit(strip_tags($news->description),40,'...') :__('messages.common.n/a') !!}
                                    </p>
                                    <a href="{{route('landing.news-details', $news['slug'])}}"
                                       class="read-more-btn">{{__('messages.front_landing.read_more')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end news-feeds-section -->

        <!-- start our-team-section -->
        <section class="our-team-section pb-60">
            <div class="container">
                <div class="text-center">
                    <h2 class="fs-6 fw-6 text-primary">{{__('messages.front_landing.volunteers')}}</h2>
                    <h3 class="fs-2 fw-6 mb-60">{{__('messages.front_landing.our_team_mates_with_good_history')}}</h3>
                </div>
                <div class="row">
                    @foreach($data['teams'] as $team)
                        <div class="col-lg-3 col-sm-6 col-12 our-team-block d-flex align-items-stretch mb-lg-0 mb-4">
                            <div class="card flex-fill border-0">
                                <div class="card-image  mx-auto ">
                                    <img src="{{ $team->image_url ? : asset('front_landing/images/team-1.png')}}"
                                         alt="Infy Care"
                                         class="img-fluid object-fit-cover">
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h4 class="fs-18 fw-5">{{ $team->name }}</h4>
                                    <h5 class="text-primary fs-14 fw-5 mb-0">{{ $team->designation }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end our-team-section -->

    </div>
@endsection
