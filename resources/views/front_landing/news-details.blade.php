@extends('front_landing.layouts.app')
@section('title')
    {{__('messages.news.news_details')}}
@endsection
@section('content')

    <div class="news-details-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{$newsDetailsImg['menu_image'] ? : asset('front_landing/images/team-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{__('messages.news.news_details')}}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start news-details-section -->
        <div class="news-section ">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-8">
                        <!-- start news-details-left-section-->
                        <div class="news-details-left-section pt-100 ">
                            <h5 class="title text-dark fw-6 fs-20 pb-1">{{$news->title}}
                            </h5>
                            <div class="news-details-img rounded-10 mb-20">
                                <img src="{{ !empty($news->news_image) ? $news->news_image : url(asset('front_landing/images/news-details-img.png')) }}"
                                     class="w-100 h-100 card-img-top object-fit-cover rounded-10" alt="card">
                            </div>
                            <div class="d-flex flex-wrap mb-20">
                                <div class="mb-2 me-4 pe-xxl-3">
                                    <i class="fa-solid fa-message text-primary me-2"></i>
                                    <span class="fs-14 fw-5 text-primary"
                                          id="commentCounts">{{$allCommnets->count()}} {{__('messages.news_comments.comments')}}</span>
                                </div>
                                <div class="mb-2">
                                    <i class="fa-solid fa-calendar text-primary me-2"></i>
                                    <span class="fs-14 fw-5 text-primary">{{ \Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMMM YYYY')}}</span>
                                </div>
                            </div>
                            <p class="fs-16 fw-5 text-dark">
                                {!! nl2br($news->description) !!}

                            </p>
                            <div class="row justify-content-between pb-4 pt-4">
                              
                                @php
                                    $shareUrl = Request::root().'/news-details/'.$news->slug;
                                @endphp

                                <div class="col-md-6 social-media">
                                    <h5 class="fs-20 fw-6 text-dark mb-4">{{__('messages.front_landing.social_share')}}</h5>
                                    <div class="d-flex flex-wrap">
                                        <div class="icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                            <a href="https://www.facebook.com/sharer.php?u={{ $shareUrl }}"
                                               target="_blank" title="Facebook">
                                                <img src="{{ asset('front_landing/images/social-icon-images/facebook.png') }}"
                                                     alt="facebook"
                                                     class="w-100 h-100 object-fit-cover">
                                            </a>
                                        </div>
                                        <div class="custom-twitter-img icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                            <a href="https://twitter.com/share?url={{$shareUrl}}&text={{ $news->title }}&hashtags=sharebuttons"
                                               target="_blank" title="Twitter">
                                                <img src="{{ asset('front_landing/images/social-icon-images/twitter.png') }}"
                                                     alt="twitter"
                                                     class="w-100 h-100 object-fit-cover">
                                            </a>
                                        </div>
                                        <div class="custom-instagram-img icon rounded-10 d-flex align-items-center justify-content-center me-3">
                                            <a href="https://www.instagram.com/sharer.php?u={{$shareUrl}}"
                                               target="_blank" title="Instagram">
                                                <img src="{{ asset('front_landing/images/social-icon-images/instagram.png') }}"
                                                     alt="instagram"
                                                     class="w-100 h-100 object-fit-cover">
                                            </a>
                                        </div>
                                        <div class="icon rounded-10 d-flex align-items-center justify-content-center  me-3">
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                                               target="_blank" title="Linkedin">
                                                <img src="{{ asset('front_landing/images/social-icon-images/linkedin.png') }}"
                                                     alt="linkedin"
                                                     class="w-100 h-100 object-fit-cover">
                                            </a>
                                        </div>
                                        <div class="custom-pinterest-img icon rounded-10 d-flex align-items-center justify-content-center">
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

                            <div class="comment-section pt-30">
                                <h5 class="fs-20 fw-6 text-dark" id="commentCount">{{$allCommnets->count()}}</span>
                                        Comments</h5>
                                    <div class="comment-box">
                                    @foreach($allCommnets as $newsComment)
                                            <div class="media d-flex mt-40 mb-40 post-comment">
                                                <div class="media-img me-sm-4 me-3 rounded-10">
                                                    <img src="{{ !empty($newsComment->users) ? $newsComment->users->profile_image : url(asset('front_landing/images/news-details-img.png')) }}"
                                                     class="w-100 h-100 rounded-10 object-fit-cover "
                                                     alt="comment-image">

                                            </div>
                                            <div class="media-body w-100">
                                                <div class="media-title d-flex flex-wrap justify-content-between ">
                                                    <div class="d-flex align-items-center flex-wrap  mb-2">
                                                        <h5 class="mt-sm-0 mt-2 mb-0  text-primary fs-18 fw-5 me-3 pe-sm-1">{{isset($newsComment->name) ? $newsComment->name : ''}}</h5>
                                                        <span class="text-dark fs-14 me-4 mt-sm-0 mt-2">
                                                        <span class="text-dark me-3 pe-sm-1">|</span> {{ \Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMMM YYYY')}}</span>
                                                    </div>
                                                </div>
                                                <p class="fs-16 fw-5 text-dark mb-0">
                                                    {{isset($newsComment->comments) ? $newsComment->comments : ''}}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            <div class="post-comment-section pt-40">
                                <h5 class="title text-dark fw-6 fs-20 mt-15 mb-20">{{__('messages.front_landing.post_comment')}}</h5>
                                <form id="newsCommentsForm" method="post" action="#" class="comment-form radius-four">
                                    @csrf
                                    <div class="row pb-5">
                                        <input type="hidden" name="news_id" value="{{$news->id}}">
                                        <input type="hidden" name="user_id"
                                               value="{{ \Illuminate\Support\Facades\Auth::id() }}">

                                        <div class="col-md-6 mb-3 pb-1">
                                            <input type="text" id="name" name="name"
                                                   class="form-control fs-14 fw-5 text-dark"
                                                   placeholder="{{__('messages.front_landing.enter_your_name')}}">
                                        </div>
                                        <div class="col-md-6 mb-3 pb-1">
                                            <input type="email" id="email" name="email"
                                                   class="form-control fs-14 fw-5 text-dark"
                                                   placeholder="{{__('messages.front_landing.enter_your_email')}}">
                                        </div>
                                        <div class="col-12 mb-3 pb-1">
                                            <input type="text" id="websiteName" name="website_name"
                                                   class="form-control fs-14 fw-5 text-dark"
                                                   placeholder="{{__('messages.front_landing.enter_your_website')}}">
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control fs-14 fw-5 text-dark" id="comments"
                                                      name="comments" rows="3"
                                                      placeholder="{{__('messages.front_landing.type_your_comments')}}"></textarea>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <button class="submit-btn btn btn-gray mt-2" id="newsCommentsBtn"
                                                    type="submit">
                                                {{__('messages.front_landing.post_comment')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end news-details-left-section-->
                    </div>
                    @include('front_landing.sidebar_news_detail')
                </div>
                @if(count($relatedPosts) > 0)
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="related-post-section pt-20 pb-20">
                                <h4 class="fs-26 fw-6 text-dark mb-20"> {{__('messages.front_landing.related_post')}}</h4>
                                <div class="related-causes">
                                    <div class="row">
                                        @foreach($relatedPosts as $relatedPost)
                                            <div class="col-md-6 trending-card mb-md-0 mb-40 pb-3">
                                                <div class="card h-100">
                                                    <div class="card-img">
                                                        <a href="{{route('landing.news-details',$relatedPost->slug)}}">
                                                        <img src="{{ !empty($relatedPost->news_image) ? $relatedPost->news_image : url(asset('front_landing/images/tranding-6.png')) }}" class="card-img-top object-fit-cover" alt="card"></a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="d-flex mb-2">
                                                            <i class="fa-solid fa-calendar text-primary me-2"></i>
                                                            <span class="fs-14 fw-5 text-dark">{{ \Carbon\Carbon::parse($relatedPost->created_at)->isoFormat('Do MMMM YYYY')}}</span>
                                                        </div>
                                                        <h5 class="text-dark fs-18 fw-5 mb-2"><a class="text-primary"
                                                                                                 href="{{route('landing.news-details',$relatedPost->slug)}}">{{ \Illuminate\Support\Str::limit($relatedPost->title, 30) }}</a>
                                                        </h5>
                                                        <p class="fs-16 fw-5 text-dark mb-0">
                                                        {!! !empty(strip_tags($relatedPost->description)) ? Str::limit(strip_tags($relatedPost->description),60,'...') :__('messages.common.n/a') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- end news-details-section -->
    </div>
@endsection
