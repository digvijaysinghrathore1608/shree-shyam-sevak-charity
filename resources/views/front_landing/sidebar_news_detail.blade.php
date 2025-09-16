@php
    $settings  = settings();
@endphp

<div class="col-xl-4 pt-100 pb-20">
    <!-- start news-right-section -->
    <div class="news-right-section">

        <!-- start search-object-section -->
    

        <!-- start popular-feeds-section -->
        <div class="popular-feeds bg-light p-30 rounded-10 position-relative mb-20">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                <h5 class="fs-20 fw-6 text-dark mb-0">{{ __('messages.front_landing.popular_feeds') }}</h5>
                <div class="rectangle-shape"></div>
            </div>
            @foreach($latestFourNews as $news)
                <div class="d-flex mb-2 pb-lg-1 align-items-sm-center">
                    <div class="feeds-post me-3 rounded-10">
                        <a href="{{route('landing.news-details',$news->slug)}}">
                            <img src="{{ !empty($news->news_image) ? $news->news_image : url(asset('front_landing/landing/img/blog/1.jpg')) }}"
                                 class="w-100 h-100 object-fit-cover rounded-10"></a>
                    </div>
                    <div class="feeds-text">
                        <p class="fs-16 fw-5 text-dark mb-1">
                            <a class="text-dark"
                               href="{{route('landing.news-details',$news->slug)}}">{{ \Illuminate\Support\Str::limit($news->title, 40) }}</a>
                        </p>
                        <p class="text-primary fs-14 fw-5 mb-0">{{ \Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMMM YYYY')}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end popular-feeds-section -->

        <!-- start categories-section -->
        <div class="categories-section bg-light p-30 rounded-10 position-relative mb-20">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                <h5 class="fs-20 fw-6 text-dark mb-0">{{ __('messages.categories.categories') }}</h5>
                <div class="rectangle-shape"></div>
            </div>
            @foreach($newsCategories as $newsCategory)
                <a href="{{ route('landing.news' , ['category' => $newsCategory->id])}}" data-id="{{$newsCategory->id}}"
                   class=" categories d-flex align-items-center justify-content-between bg-white rounded-10 mb-2 news-category-filter1">
                    <span href="{{ route('landing.news' , ['category' => $newsCategory->id])}}"
                          data-id="{{$newsCategory->id}}"
                          class="text-dark fs-16 fw-5 news-category-filter1">{{isset($newsCategory) ? $newsCategory->name : ''}}</span>
                    <button class="border-0">
                        <span class="text-dark">{{ $newsCategory->news->count() }}</span>
                    </button>
                </a>
                
            @endforeach
        </div>
        <!-- end categories-section -->

        <!-- start popular-tags-section -->
        <div class="popular-tags bg-light  rounded-10 position-relative ">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                <h5 class="fs-20 fw-6 text-dark mb-0">{{ __('messages.front_landing.popular_tags') }}</h5>
                <div class="rectangle-shape"></div>
            </div>
            <div class="tags d-flex flex-wrap">
                @foreach($newsTags as $newsTag)
                    <div class="tag me-2 mb-2">
                        <a href="{{ route('landing.news' , ['tag' => $newsTag->id])}}"
                           data-id="{{$newsTag->id}}"
                           class="text-dark news-tags-filter fs-16 fw-5">{{$newsTag->name}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end popular-tags-section -->

    </div>
    <!-- end news-right-section -->
</div>
