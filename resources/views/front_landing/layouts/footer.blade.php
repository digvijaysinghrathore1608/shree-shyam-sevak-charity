{{--<!-- start-companies-logo section -->--}}
<section class="companies-logo-section pt-100 pb-100 bg-gray">
    <div class="container">
        <div class="slick-slider">
            @foreach($brands as $brand)
                <div class="slide d-flex justify-content-center">
                    <div class="company-logo ">
                        <img src="{{ $brand->image_url ? : asset('front_landing/images/duragas.png')}}"
                             alt="duragas-logo"
                             class="w-100 h-100 object-fit-cover" title="{{ $brand->name }}"/>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- start footer-section -->
<footer class=" bg-secondary pt-100 pb-100">
    <div class="container">
        <div class="row  justify-content-between">
            <div class="col-lg-6 ">
                <div class="footer-left mb-lg-0 mb-4">
                    <div class="footer-logo mb-4 pb-lg-2">
                        <a href="{{route('landing.home') }}">
                            <img src="{{getLogoUrl() ? : asset('front_landing/images/funding-logo.png')}}" alt="Jobs"
                                 class="w-100 h-100 object-fit-cover"/>
                        </a>
                    </div>
                    <p class="fs-14 text-white mb-0">
                        {{ Str::limit($settings['about_us'] , 350) }}

                    </p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="footer-right ps-xl-3">
                    <h3 class="fs-18 text-white mb-4 pb-lg-2">{{__('messages.front_landing.get_updates')}}
                    </h3>
                    <div class="email-box position-relative">
                        <form action="{{route('email.subscribe.store')}}" method="post" id="addEmailForm"
                              class="ajax-form form-wraper mailchimp-form d-flex shadow-sm">
                            @csrf()
                            <input type="email" name="email" class="fs-14 fw-5 text-white"
                                   placeholder="Enter Email Address">
                            <button type="submit" id="emailBtn" class="button btn-primary position-absolute fs-14 fw-5">
                                {{__('messages.front_landing.subscribe')}}
                            </button>
                        </form>
                    </div>


                    <div class="social-icon d-flex mt-4 pt-lg-2">
                        <div class="icon d-flex align-items-center justify-content-center me-sm-4 me-3">
                            <a href="{{ $settings['facebook_url'] }}" target="_blank">
                                <i class="fa-brands fa-facebook-f fs-16 justify-content-between align-items-center"></i>
                            </a>
                        </div>
                        <div class="icon d-flex align-items-center justify-content-center me-sm-4 me-3">
                            <a href="{{ $settings['twitter_url'] }}" target="_blank">
                                <i class="fa-brands fa-twitter fs-16 justify-content-between align-items-center"></i>
                            </a>
                        </div>
                        <div class="icon d-flex align-items-center justify-content-center me-sm-4 me-3">
                            <a href="{{ $settings['instagram_url'] }}" target="_blank">
                                <i class="fa-brands fa-instagram fs-16 justify-content-between align-items-center"></i>
                            </a>
                        </div>
                        <div class="icon d-flex align-items-center justify-content-center me-sm-4 me-3">
                            <a href="{{ $settings['linkedin_url'] }}" target="_blank">
                                <i class="fa-brands fa-linkedin-in fs-16 justify-content-between align-items-center"></i>
                            </a>
                        </div>
                        <div class="icon d-flex align-items-center justify-content-center">
                            <a href="{{ $settings['youtube_url'] }}" target="_blank">
                                <i class="fa-brands fa-youtube fs-16 justify-content-between align-items-center"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer-section -->

