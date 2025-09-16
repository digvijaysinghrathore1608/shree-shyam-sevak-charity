<!-- start header section -->
@php
    $pages  = pages();
@endphp
<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-1 col-4">
                <div class="header-logo">
                    <a href="{{ route('landing.home') }}">
                        <img src="{{ getLogoUrl() ? : asset('front_landing/images/funding-logo.png')}}" alt="Jobs"
                             class="w-100 h-100"/>
                    </a>
                </div>
            </div>
            <div class="col-lg-11 col-8 ">
                <nav class="navbar navbar-expand-lg navbar-dark justify-content-end py-0">
                    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav align-items-center py-2 py-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : ''}}  fw-5 fs-14"
                                   aria-current="page"
                                   href="{{ route('landing.home') }}">{{__('messages.front_landing.home')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('about-us') ? 'active' : ''}} fw-5 fs-14"
                                   href="{{ route('landing.about') }}">{{__('messages.front_landing.about')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('causes','c/*') ? 'active' : '' }} fw-5  fs-14"
                                   href="{{ route('landing.causes') }}">{{__('messages.front_landing.causes')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link fw-5  fs-14 {{ Request::is('faqs','events','teams','event-details/*','page*') ? 'active' : '' }}">{{__('messages.pages')}}</a>
                                <ul class="dropdown-nav ps-0">
                                    <li><a href="{{ route('landing.faqs') }}"
                                           class="fs-14 fw-5 {{ Request::is('faqs') ? 'active' : '' }}">{{__('messages.faqs.faqs')}}</a>
                                    </li>
                                    <li><a href="{{ route('landing.event') }}"
                                            class="fs-14 fw-5 {{ Request::is('events', 'event-details/*') ? 'active' : '' }}">{{ __('messages.events.events') }}</a>
                                    </li>
                                    @foreach ($pages as $page)
                                        @if ($page->is_active)
                                            <li>
                                                <a href="{{ route('landing.page.detail', $page->id) }}"
                                                    class="fs-14 fw-5 {{ Request::is('page/' . $page->id) ? 'active' : '' }}">{!! nl2br(\Illuminate\Support\Str::limit($page->name)) !!}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li><a href="{{ route('landing.team') }}"
                                            class="fs-14 fw-5 {{ Request::is('teams') ? 'active' : '' }}">{{ __('messages.front_landing.team') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fw-5 fs-14 {{ Request::is('news', 'news-details*') ? 'active' : '' }}"
                                    href="{{ route('landing.news') }}">{{ __('messages.news.news') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fw-5  fs-14 {{ Request::is('contact-us') ? 'active' : '' }}"
                                    href="{{ route('landing.contact') }}">{{ __('messages.contact_us.contact_us') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link fw-5  fs-14">
                                    <i class="fas fa-language me-1"></i>
                                    {{ getHeaderLanguageName() }}</a>
                                <ul class="dropdown-nav ps-0">
                                    @foreach (getAllLanguage() as $language)
                                        <li>
                                            <a class="fs-14 fw-5 {{ $language->iso_code == App::getLocale() ? 'active' : '' }}"
                                                href="{{ route('landing.change-language', $language->iso_code) }}"
                                                data-prefix-value="{{ $language->iso_code }}">
                                                {{ $language->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="text-lg-end header-btn-grp ms-lg-2">

                            @if (getLogInUser())
                                <a href="{{ url(getDashboardURL()) }}"
                                    class="btn btn-primary mb-3 mb-lg-0">{{ __('messages.dashboard') }}</a>
                            @else
                                <a href="{{ route('register') }}" type="button"
                                    class="btn btn-secondary  me-3 mb-3 mb-lg-0">
                                    {{ __('messages.front_landing.sign_up') }}</a>
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary mb-3 mb-lg-0">{{ __('messages.common.sign_in') }}</a>
                            @endif

                        </div>
                    </div>
                </nav>
                <!--start mobile-menu -->
                <div class="offcanvas-toggle d-lg-none d-block text-end">
                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                    <div class="offcanvas offcanvas-end text-start" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <button type="button" class="btn-close text-reset mb-3" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                        <div class="offcanvas-body p-0">
                            <div class="nav-item">
                                <a class="nav-link fw-5 fs-14 {{ Request::is('/') ? 'active' : '' }}"
                                    aria-current="page"
                                    href="{{ route('landing.home') }}">{{ __('messages.front_landing.home') }}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link  fw-5 fs-14 {{ Request::is('about-us') ? 'active' : '' }}"
                                    href="{{ route('landing.about') }}">{{ __('messages.front_landing.about') }}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link fw-5  fs-14 {{ Request::is('causes', 'c/*') ? 'active' : '' }}"
                                    href="{{ route('landing.causes') }}">{{ __('messages.front_landing.causes') }}</a>
                            </div>
                            <div class="set">
                                <a class="nav-link fw-5  fs-14 {{ Request::is('faqs', 'events', 'page*', 'event-details/*') ? 'active-menu' : '' }}"
                                    href="#">{{ __('messages.pages') }}</a>
                                <a href="#" class="p-0"><i class="fa fa-plus"></i></a>
                                <div class="content">
                                    <li><a href="{{ route('landing.faqs') }}"
                                            class="fs-14 fw-5 {{ Request::is('faqs') ? 'active' : '' }}">{{ __('messages.faqs.faqs') }}</a>
                                    </li>
                                    <li><a href="{{ route('landing.event') }}"
                                            class="fs-14 fw-5 {{ Request::is('events', 'event-details/*') ? 'active' : '' }}">{{ __('messages.events.events') }}</a>
                                    </li>
                                    @foreach ($pages as $page)
                                        @if ($page->is_active)
                                            <li>
                                                <a href="{{ route('landing.page.detail', $page->id) }}"
                                                    class="{{ Request::is('page/' . $page->id) ? 'active' : '' }}">{{ $page->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="nav-item">
                                <a class="nav-link  fw-5 fs-14 {{ Request::is('news', 'news-details*') ? 'active' : '' }}"
                                    href="{{ route('landing.news') }}">{{ __('messages.news.news') }}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link  fw-5 fs-14 {{ Request::is('teams') ? 'active' : '' }}"
                                    href="{{ route('landing.team') }}">{{ __('messages.front_landing.team') }}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link  fw-5  fs-14 {{ Request::is('contact-us') ? 'active' : '' }}"
                                    href="{{ route('landing.contact') }}">{{ __('messages.front_landing.contact') }}</a>
                            </div>
                            <div class="set">
                                <a class="nav-link fw-5  fs-14 " href="#">{{ getHeaderLanguageName() }}</a>
                                <a href="#" class="p-0"><i class="fa fa-plus"></i></a>
                                <div class="content">
                                    @foreach (getAllLanguage() as $language)
                                        <li>
                                            <a class="fs-14 fw-5 {{ $language->iso_code == App::getLocale() ? 'active' : '' }}"
                                                href="{{ route('landing.change-language', $language->iso_code) }}"
                                                data-prefix-value="{{ $language->iso_code }}">
                                                {{ $language->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-lg-end header-btn-grp mt-4">
                                @if (getLogInUser())
                                    <a href="{{ getDashboardURL() }}"
                                        class="d-btn btn btn-primary">{{ __('messages.dashboard') }}</a>
                                @else
                                    <a href="{{ route('register') }}" type="button"
                                        class="btn btn-secondary me-xxl-3 me-3 mb-3 mb-lg-0">
                                        {{ __('messages.front_landing.sign_up') }}</a>
                                    <a href="{{ route('login') }}"
                                        class="btn btn-primary mb-3 mb-lg-0">{{ __('messages.common.sign_in') }}</a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
                <!--end mobile-menu -->
            </div>
        </div>
    </div>
</header>
