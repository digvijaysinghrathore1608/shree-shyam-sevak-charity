<div>
    <div class="tab-content pt-5 mb-lg-4 ps-lg-0 ps-md-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
             aria-labelledby="pills-home-tab">
            @if(count($campaigns) > 0)
            <div class="row">
                    <div class="row">
                        @foreach($campaigns as $index => $campaign)
                            <div wire:key="{{$campaign->id}}" class="col-xl-4 col-lg-6 col-md-6 trending-card">
                                <div class="card">
                                    <div class="positon-relative">
                                        <div class="card-img">
                                            <a href="{{route('landing.campaign.details',$campaign->slug) }}">
                                                <img src="{{$campaign->image ? : asset('front_landing/images/card-img.png')}}"
                                                     class="card-img-top object-fit-cover" alt="card">
                                            </a>
                                        </div>
                                        <a href="javascript:void(0)"
                                           class="badge small-btn campaign_category_id {{ $campaign->is_emergency == 1 ? 'custom-cause-red' : ''}}"
                                           data-id="{{ $campaign->campaignCategory->id }}"> {{ $campaign->campaignCategory->name}}</a>
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
                                        <h4 class="card-title text-primary fs-14">
                                            By {{ $campaign->user->full_name }}</h4>
                                        <a class="text-dark fs-18 mb-4 lh-sm"
                                           href="{{ route('landing.campaign.details',$campaign->slug) }}">{{ Str::limit($campaign->title,50) }}</a>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="col-7">
                                                <span class="count-num count-num1 me-1">{{getRaisedAmountPercentage($campaign->campaignDonations->sum('donated_amount'),$campaign->goal)}}%</span>
                                                <span class="text-primary">{{__('messages.front_landing.raised')}}</span>
                                            </div>
                                            <div class="col-5 d-flex justify-content-between">
                                                <div>
                                                <span class="text-primary count-num2 me-1">{{__('messages.campaign.goal')}}</span>
                                                <span class="count-num ">
                                                    {{ getCurrencySymbol($campaign->currency) . ($campaign->goal ? $campaign->goal : 0) }}
                                                </span>
                                                </div>
                                                @if($campaign->is_featured)
                                                <div class="">
                                                    <i class="fas fa-award"></i>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-md-6 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mb-0  flex-wrap">
                            <span class="page-item">{{ $campaigns->links() }}</span>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
            @else
                <h3 align="center">{{__('No Causes found')}}</h3>
            @endif
    </div>
    </div>
</div>





