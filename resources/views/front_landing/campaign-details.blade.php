@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.page.cause_details')}}
@endsection
@section('content')
    <div class="cause-details-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{$contactUs['menu_image'] ? : asset('front_landing/images/causes-hero-img.png')}}')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{__('messages.page.cause_details')}}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start cause-details-section -->
        <section class="cause-details-section">
            <div class="container">
                <div class="row pt-100">
                    <div class="col-xl-8 ">
                        <div class="cause-image mb-20 rounded-20">
                            <img src="{{asset($campaign->image ? : 'front_landing/images/card-img.png')}}"
                                 alt="causes-image" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="cause-desc mb-40">
                            <h3 class="fw-6 fs-26 text-dark mb-3">{{ Str::limit($campaign->title,70) }}</h3>
                            <div class="desc-box d-flex flex-wrap">
                                <div class="d-flex align-items-center me-lg-5 me-4">
                                    <i class="fa-solid fa-tag text-primary fs-18 me-2"></i>
                                    <p class="fs-16 fw-5 text-primary mb-0">{{ $campaign->campaignCategory->name }}</p>
                                </div>
                                <div class="d-flex align-items-center me-lg-5 me-4">
                                    <i class="fa-solid fa-calendar text-primary fs-18 me-2"></i>
                                    <p class="fs-16 fw-5 text-primary mb-0">{{__('messages.campaign.start_date')}}
                                        : {{ \Carbon\Carbon::parse($campaign->start_date )->isoFormat('Do MMMM YYYY')}} </p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-calendar text-primary fs-18 me-2"></i>
                                    <p class="fs-16 fw-5 text-primary mb-0">{{__('messages.campaign.end_date')}}
                                        : {{ \Carbon\Carbon::parse($campaign->deadline )->isoFormat('Do MMMM YYYY')}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="cause-tab">
                            <ul class="nav nav-pills overflow-auto flex-nowrap mb-40" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fs-16 fw-5 text-dark" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home"
                                            aria-selected="true">{{__('messages.common.description')}}
                                    </button>
                                </li>
                                @if(count($campaignFaqs->campaignFaqs) > 0)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-16 fw-5" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile"
                                                aria-selected="false">{{__('messages.faqs.faqs')}}
                                        </button>
                                    </li>
                                @endif
                                @if(count($campaignUpdates->campaignUpdates ) > 0)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fs-16 fw-5" id="pills-contact-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-contact" type="button" role="tab"
                                                aria-controls="pills-contact"
                                                aria-selected="false">{{__('messages.front_landing.updates')}}
                                        </button>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active mb-5" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <p class="fs-16 fw-5 text-dark mb-lg-4 mb-3">
                                        {!! $campaign->short_description !!}
                                    </p>
                                    <p class="fs-16 fw-5 text-dark mb-lg-4 mb-3">
                                        {!! $campaign->description !!}
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                     aria-labelledby="pills-contact-tab">
                                    @foreach($campaignUpdates->campaignUpdates as $campaignUpdate)
                                        <p class="fs-17 fw-5 text-dark mb-lg-4 mb-3">
                                            {{$campaignUpdate->title}}
                                        </p>
                                        <p class="fs-16 fw-5 text-dark mb-lg-4 mb-3">
                                            {{$campaignUpdate->description}}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                     aria-labelledby="pills-profile-tab">
                                    @foreach($campaignFaqs->campaignFaqs as $campaignFaq)
                                        <p class="fs-17 fw-5 text-dark mb-lg-4 mb-3">
                                            {{$campaignFaq->title}}
                                        </p>
                                        <p class="fs-16 fw-5 text-dark mb-lg-4 mb-3">
                                            {{$campaignFaq->description}}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if(count($campaign->campaignCategory->campaigns) > 2)
                            <div class="related-causes pb-100">
                                <h4 class="fs-26 fw-6 text-dark mb-40">{{__('messages.front_landing.related_causes')}}</h4>
                                <div class="trending-causes-section ">
                                    <div class="row">
                                        @foreach($campaign->campaignCategory->campaigns as $relatedCampaign)
                                            @if($relatedCampaign->id != $campaign->id && $relatedCampaign->status == \App\Models\Campaign::STATUS_ACTIVE && !campaignEnd($relatedCampaign->id))
                                                <div class="col-md-6 trending-card mb-md-0 mb-40 pb-3">
                                                    <div class="card">
                                                        <div class="positon-relative">
                                                            <div class="card-img">
                                                                <a href="{{ route('landing.campaign.details',$relatedCampaign->slug) }}">
                                                                    <img src="{{$relatedCampaign->image ? : asset('front_landing/images/tranding-6.png')}}"
                                                                         class="card-img-top object-fit-cover"
                                                                         alt="card">
                                                                </a>
                                                            </div>
                                                            <a href="{{route('landing.causes',$relatedCampaign->campaignCategory->id)}}"
                                                               class="badge small-btn cause-cat cause-cat-top campaign_category custom-causes-category radius-four custom-cause-cat-two m-0 {{ $relatedCampaign->is_emergency == 1 ? 'custom-cause-red' : ''}}"
                                                               data-id="{{ $relatedCampaign->campaignCategory->id }}">{{ $relatedCampaign->campaignCategory->name}}</a>
                                                            @php
                                                                $shareUrl = Request::root().'/c/'.$campaign->slug;
                                                            @endphp
                                                            <div class="dropdown position-absolute">
                                                                <button class="share-btn dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <i class="fa-solid fa-share text-white"></i>
                                                                </button>
                                                                <div class="dropdown-menu px-2"
                                                                     aria-labelledby="dropdownMenuButton1">
                                                                    <div class="d-flex flex-wrap justify-content-between">
                                                                        <div class="share-icon">
                                                                            <a href="https://www.facebook.com/sharer.php?u={{ $shareUrl }}"
                                                                               target="_blank" title="Facebook">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/facebook.png') }}"
                                                                                     alt="facebook"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                        <div class="share-icon">
                                                                            <a href="https://www.instagram.com/sharer.php?u={{$shareUrl}}"
                                                                               target="_blank" title="Instagram">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/instagram.png') }}"
                                                                                     alt="instagram"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                        <div class="share-icon">
                                                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                                                                               target="_blank" title="Linkedin">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/linkedin.png') }}"
                                                                                     alt="linkedin"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                        <div class="share-icon ">
                                                                            <a href="https://twitter.com/share?url={{$shareUrl}}&text={{ $campaign->title }}&hashtags=sharebuttons"
                                                                               target="_blank" title="Twitter">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/twitter.png') }}"
                                                                                     alt="twitter"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                        <div class="share-icon ">
                                                                            <a href="mailto:?Subject={{ $campaign->title }}
                                                                                    &Body=This%20is%20your%20campaign%20link%20:%20{{$shareUrl}}"
                                                                               target="_blank" title="Gmail">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/gmail.png') }}"
                                                                                     alt="gmail"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                        <div class="share-icon">
                                                                            <a href="https://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                                                                               target="_blank" title="Pinterest">
                                                                                <img src="{{ asset('front_landing/images/social-icon-images/pinterest.png') }}"
                                                                                     alt="pinterest"
                                                                                     class="w-100 h-100 object-fit-cover">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="card-title text-primary fw-5 fs-14">
                                                                {{__('messages.front_landing.by')}} {{ $relatedCampaign->user->full_name }}</h4>
                                                            <a class="text-dark fs-18 fw-5 mb-4 lh-sm"
                                                               href="{{ route('landing.campaign.details',$relatedCampaign->slug) }}">{{ Str::limit($relatedCampaign->title,50) }}</a>

                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="col-7">
                                                        <span
                                                                class="count-num count-num1 me-1 text-dark fs-14 fw-5">{{getRaisedAmountPercentage($relatedCampaign->campaignDonations->sum('donated_amount'),$relatedCampaign->goal)}}%</span>
                                                                    <span class="text-primary fs-14">{{__('messages.front_landing.raised')}}</span>
                                                                </div>
                                                                <div class="col-5">
                                                                    <span class="text-primary count-num2 me-1 fs-14">{{__('messages.campaign.goal')}}</span>
                                                        <span class="count-num  me-1 text-dark fs-14 fw-5">{{ getCurrencySymbol($relatedCampaign->currency) . ($relatedCampaign->goal ? $relatedCampaign->goal : 0) }}</span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-4  pb-4 mb-2">
                        <!--start time-counter-section -->
                            @if($campaign->campaign_end_method == App\Models\Campaign::AFTER_END_DATE && isset($campaign->deadline))
                                <input type="hidden" id="dueDate" value="{{$campaign->deadline}}">
                            <div class="counter-section bg-light p-30 rounded-10 mb-20">
                                <ul class="d-flex justify-content-between mb-0 flex-wrap ps-0">
                                    <li class="mb-sm-0 mb-2">
                                        <h4 id="day-box" class="text-center mb-0 fs-20">00</h4>
                                        <p class="mb-0 fs-12">Days</p>
                                    </li>
                                    <li class="mb-sm-0 mb-2">
                                        <h4 id="hr-box" class="text-center mb-0 fs-20">00</h4>
                                        <p class="mb-0 fs-12">Hrs</p>
                                    </li>
                                    <li class="mb-sm-0 ">
                                        <h4 id="min-box" class="text-center mb-0 fs-20">00</h4>
                                        <p class="mb-0 fs-12">Min</p>
                                    </li>
                                    <li class="mb-sm-0 ">
                                        <h4 id="sec-box" class="text-center mb-0 fs-20">00</h4>
                                        <p class="mb-0 fs-12">Sec</p>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <!-- end time-counter section -->

                            <!-- start time-count-section -->
                            @if($campaign->goal)
                                <section class="news-right-section time-count-section bg-light p-30 rounded-10 mb-20 position-relative">
                                    <div class="rectangle-shape"></div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-3 col-sm-6  text-center pt-4">
                                            <p class="fs-14 mb-0 text-secondary"><i class="fa-solid fa-arrow-trend-up me-1"></i>Goals</p>
                                            <h5 class="fs-18 text-primary mb-0">
                                                <span class="timecount" data-countto="100000" data-duration="3000">{{getCurrencySymbol($campaign->currency)}}{{ $campaign->goal }}</span>
                                            </h5>
                                        </div>
                                        <div class="col-xl-6 col-md-3 col-sm-6 text-center pt-4">
                                            <p class="fs-14 mb-0 text-secondary"><i class="fa-solid fa-scale-balanced me-1"></i>Raised</p>
                                            <h5 class="fs-18 text-primary mb-0">
                                                <span class="timecount" data-countto="7000" data-duration="3000">{{getCurrencySymbol($campaign->currency)}}{{$campaign->campaignDonations->sum('donated_amount')}}</span>
                                            </h5>

                                        </div>
                                        <div class="col-xl-6 col-md-3 col-sm-6 text-center pt-4">
                                            @if($campaign->campaignDonations->sum('donated_amount') >= $campaign->goal)
                                                <p class="fs-14 mb-0 text-secondary"><i class="fa-solid fa-bullseye me-1"></i>Already Achieved</p>
                                                <h5 class="fs-18 text-primary mb-0">
                                                    <span class="timecount" data-countto="14" data-duration="3000">{{getCurrencySymbol($campaign->currency)}}0</span>
                                                </h5>
                                            @else
                                                <h5 class="fs-18 text-primary mb-0">
                                                    <p class="fs-14 mb-0 text-secondary"><i class="fa-solid fa-bullseye me-1"></i>Also To Go</p>
                                                    <span class="timecount" data-countto="93000" data-duration="3000">{{getCurrencySymbol($campaign->currency)}}{{$campaign->goal - $campaign->campaignDonations->sum('donated_amount')}}</span>
                                                </h5>
                                            @endif
                                        </div>
                                        <div class=" col-xl-6 col-md-3 col-sm-6 text-center pt-4">
                                            @if($campaign->campaignDonations->sum('donated_amount') >= $campaign->goal)
                                                <p class="fs-14 mb-0 text-secondary"><i class="fa-regular fa-circle-check me-1"></i>Completed</p>

                                                <h5 class="fs-18 text-primary mb-0">
                                                    <span class="timecount" data-countto="14" data-duration="3000">N/A</span>
                                                </h5>
                                            @else
                                                <p class="fs-14 mb-0 text-secondary"><i class="fa-regular fa-circle-check me-1"></i>Not Yet Completed</p>
                                                <h5 class="fs-18 text-primary mb-0">
                                                    @php
                                                        $nowDate = \Carbon\Carbon::now();
                                                    $day = $nowDate->floatDiffInDays($campaign->deadline);
                                                    @endphp
                                                    <span class="timecount" data-countto="14" data-duration="3000">{{round($day)}}</span> days to go
                                                </h5>
                                            @endif
                                        </div>
                                        <div class="button col-xl-6 col-md-3 col-sm-6 align-items-center pt-4">
                                            <a href="{{route('landing.payment', $campaign->slug)}}"
                                               class="btn btn-primary w-100 mt-3{{ ((getSettingValue('stripe_enable')) == 1 || (getSettingValue('paypal_enable')) == 1 ? '' : '' )}}">{{__('messages.front_landing.donate_now')}}</a>
                                        </div>
                                    </div>

                                </section>
                            @endif
                        <!-- end time-count-section -->
                            <!--start input-section -->
                            <div class="input-group mb-20">
                                @php
                                    $shareUrl = Request::root().'/c/'.$campaign->slug;
                                @endphp
                                <input type="text" class="form-control text-dark p-2 fs-14 "
                                       placeholder="" value="{{ $shareUrl }}" aria-label="Recipient's username"
                                       aria-describedby="basic-addon2" readonly>
                                <div class="input-group-append">
                                    <button class="input-group-text btn-primary p-3 fs-14 copy-link" data-link="{{ $shareUrl }}">Copy</button>
                                </div>
                            </div>
                            <!--end input-section -->
                            <div class="news-right-section share bg-light p-30 rounded-10 mb-20 position-relative">
                                <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                    <h5 class="fs-20 fw-6 text-dark mb-0">Social share</h5>
                                    <div class="rectangle-shape"></div>
                                </div>
                                {{--                            <h5 class="fs-18 fw-5 text-dark mb-sm-4 mb-3">{{__('messages.front_landing.social_share').(' :')}}</h5>--}}
                                @php
                                    $shareUrl = Request::root().'/c/'.$campaign->slug;
                                @endphp
                                <div class="social-media d-flex flex-wrap">
                                    <div class="icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                        <a href="https://www.facebook.com/sharer.php?u={{ $shareUrl }}" target="_blank"
                                           title="Facebook">
                                            <img src="{{ asset('front_landing/images/social-icon-images/facebook.png') }}"
                                                 alt="facebook" class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                    <div class="custom-twitter-img icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                        <a href="https://twitter.com/share?url={{$shareUrl}}&text={{ $campaign->title }}&hashtags=sharebuttons"
                                           target="_blank" title="Twitter">
                                            <img src="{{asset('front_landing/images/social-icon-images/twitter.png') }}"
                                                 alt="twitter" class=" w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                    <div class="custom-instagram-img icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                        <a href="https://www.instagram.com/sharer.php?u={{$shareUrl}}"
                                           target="_blank" title="Instagram">
                                            <img src="{{ asset('front_landing/images/social-icon-images/instagram.png') }}"
                                                 alt="instagram" class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                    <div class="icon rounded-10 d-flex align-items-center justify-content-center  me-3">
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                                           target="_blank" title="Linkedin">
                                            <img src="{{ asset('front_landing/images/social-icon-images/linkedin.png') }}"
                                                 alt="linkedin" class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                    <div class="custom-gmail-img icon rounded-10 d-flex align-items-center justify-content-center  me-3">
                                        <a href="mailto:?Subject={{ $campaign->title }}
                                                &Body=This%20is%20your%20campaign%20link%20:%20{{$shareUrl}}" title="Gmail"
                                           target="_blank">
                                            <img src="{{ asset('front_landing/images/social-icon-images/gmail.png') }}"
                                                 alt="gmail" class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                    <div class="custom-pinterest-img icon rounded-10 d-flex align-items-center justify-content-center">
                                        <a href="https://pinterest.com/pin/create/link/?url={{$shareUrl}}" title="Pinterest"
                                           target="_blank">
                                            <img src="{{ asset('front_landing/images/social-icon-images/pinterest.png') }}"
                                                 alt="pinterest" class="w-100 h-100 object-fit-cover">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if(count($medias) > 0 || !empty($campaign->video_link))
                                <div class="news-right-section gallery bg-light p-30 rounded-10 mb-20 position-relative">
                                    <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                        <h5 class="fs-20 fw-6 text-dark mb-0">Gallery</h5>
                                        <div class="rectangle-shape"></div>
                                    </div>
                                    {{--                                <h5 class="fs-18 fw-5 text-dark mb-sm-4 mb-3">{{__('messages.campaign.gallery').(' :')}}</h5>--}}
                                    <div class="row">
                                        @foreach($medias as $media)
                                            <div class="col-sm-4 col-6 mb-lg-4 mb-3">
                                                <div class="img-box rounded-10">
                                                    <img class="img-timg"
                                                         src="{{$media->getFullUrl() ? : asset('front_landing/images/tranding-5.png')}}">
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(!empty($campaign->video_link))
                                            <div class="col-sm-4 col-6 mb-lg-4 mb-3">
                                                <a href="{{ $campaign->video_link }}" target="_blank"
                                                   class="img-box rounded-10">
                                                    <img class="video-timg" src="{{ asset('img/video-thumbnail.png')}}">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal">
                                        <span class="close">&times;</span>
                                        <span class="previous">&#8249;</span>
                                        <span class="next">&#8250;</span>
                                        <img class="modal-content" src="" alt="">
                                    </div>
                                </div>
                        @endif

                        @if(!empty($donationEnableGifts) && $campaign->goal)
                            <?php
                            $remainingCampaignAmount = $campaign->goal - $campaign->campaignDonations->sum('donated_amount');
                            ?>
                        <!-- start select-gift section -->
                                @foreach($donationEnableGifts->campaignGifts as $donationEnableGift)
                                    @if($donationEnableGift->amount <= $remainingCampaignAmount)
                                        @if ($loop->first)
                            <div class="select-gift-section bg-light p-30 pb-2 rounded-10 mb-20">
                                <div class="d-flex justify-content-between align-items-center mb-1 pb-lg-1">
                                    <h5 class="fs-20 fw-5 text-dark mb-0">{{__('messages.front_landing.select_gift_while_doing_donation')}}</h5>
                                    <div class="rectangle-shape"></div>
                                </div>
                                @endif
                                        <div class="select-gift pb-4 pt-4">
                                            <div class="d-flex">
                                                <div class="me-3 position-relative">
                                                    <div class="gift-img"><img
                                                                src="{{$donationEnableGift->donation_gift_image}}"
                                                                class="w-100 h-100 rounded-10">
                                                    </div>
                                                    <h5 class="badge small-btn">{{getCurrencySymbol($campaign->currency)}}{{$donationEnableGift->amount}}</h5>
                                                </div>
                                                <div class=""><h6
                                                            class="fs-20 fw-5 text-dark">{{$donationEnableGift->title}}</h6>
                                                    <p class="fs-12 text-secondary mb-2">{{Str::limit($donationEnableGift->description, 50)}}</p>
                                                    <div class="d-flex flex-wrap"><span class="text-dark fw-5 me-2">{{__('messages.front_landing.gifts')}}:</span>
                                                        @foreach($donationEnableGift->gifts as $campaignGift)
                                                            <span class="tag">
                                                            {{$campaignGift->name}}
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button col-xl-12 col-md-3 col-sm-6 text-center pt-2">
                                                {{--                                    {{Form::hidden('gift_amount', $donationEnableGift->id,['id' => 'giftAmount'])}}--}}
                                                <a href="{{route('landing.gift.payment', [$campaign->slug, $donationEnableGift->id])}}"
                                                   class="btn btn-transparent w-100 mt-3 {{ ((getSettingValue('stripe_enable')) == 1 || (getSettingValue('paypal_enable')) == 1 ? '' : '' )}}">{{__('messages.front_landing.select_gift')}}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div> <!-- end select-gift section -->
                        @endif
                    <!-- start categories-section -->
                        <div class="news-right-section mb-20">
                            <div class="categories-section bg-light p-30 rounded-10 position-relative pt-100">
                                <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                    <h5 class="fs-20 fw-6 text-dark mb-0">{{ __('messages.categories.categories') }}</h5>
                                    <div class="rectangle-shape"></div>
                                </div>
                                @foreach($sidebarCampaignCategories as $campaignCategory)
                                    <a href="{{ route('landing.causes' , ['category' => $campaignCategory->id])}}"
                                       data-id="{{$campaignCategory->id}}"
                                       class=" categories d-flex align-items-center justify-content-between bg-white rounded-10 mb-2 news-category-filter1">
                    <span href="{{ route('landing.causes' , ['category' => $campaignCategory->id])}}"
                          data-id="{{$campaignCategory->id}}"
                          class="text-dark fs-16 fw-5 news-category-filter1">{{isset($campaignCategory) ? $campaignCategory->name : ''}}</span>
                                        <button class="border-0">
                                            <span class="text-dark">{{ getCampaignCount($campaignCategory->id) }}</span>
                                        </button>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    <!-- end categories-section -->
                    <!-- start donation section -->
                        @if($campaign->goal)
                            @if(count($allDonors) > 0)
                                <section class="donation-section bg-light p-30 rounded-10 mt-20">
                                    <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                        <h5 class="fs-20 fw-6 text-dark mb-0">People have made a donation</h5>
                                        <div class="rectangle-shape"></div>
                                    </div>
                                    @foreach($allDonors as $donor)
                                        <div class=" d-flex align-items-center mb-3">
                                            <div class="icon me-3">
                                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                            </div>
                                            <div class="desc"><p
                                                        class="mb-0 fw-5">{{ $donor->donate_anonymously ? 'Anonymous' : $donor->full_name }} </p>
                                                <span
                                                        class="fs-14 fw-5 text-primary">{{  getCurrencySymbol($donor->campaign->currency).' '.number_format($donor->donated_amount, 2) }}</span>
                                                <span class="fs-14 fw-5">at {{ Carbon\Carbon::parse($donor->created_at)->isoFormat('Do MMM YYYY') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </section>
                        @endif
                    @endif
                    <!-- end donation section -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end cause-details-section-->
    </div>
@endsection




