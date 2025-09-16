
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/dashboard*')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>

    @can('manage_settings')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/settings*','admin/countries*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/settings*') ? 'active' : '' }}"
               href="{{ route('setting.index') }}">{{ __('messages.settings') }}</a>
        </li>
    @endcan
    @can('manage_countries')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/settings*','admin/countries*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/countries*') ? 'active' : '' }}"
               href="{{ route('countries.index') }}">{{ __('messages.countries') }}</a>
        </li>
    @endcan

    @can('manage_campaign')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/campaigns*','admin/campaign-categories*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/campaigns*') ? 'active' : '' }}"
               href="{{ route('campaigns.index') }}">{{ __('messages.campaign.campaigns') }}</a>
        </li>
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/campaigns*','admin/campaign-categories*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/campaign-categories*') ? 'active' : '' }}"
               href="{{ route('campaign-categories.index') }}">{{ __('messages.campaign.campaign_categories') }}</a>
        </li>
    @endcan

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/withdraw')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/withdraw*') ? 'active' : '' }}"
           href="{{ route('withdraw.index') }}">{{ __('messages.withdraw.withdraw_request') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/withdrawals*')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/withdrawals*') ? 'active' : '' }}"
           href="{{ route('withdrawals.index') }}">{{  __('messages.withdrawal.withdrawal_charges') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/donation-gifts*')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/donation-gifts*') ? 'active' : '' }}"
           href="{{ route('donation-gifts.index') }}">{{  __('messages.donation_gifts.donation_gifts') }}</a>
    </li>
    @can('manage_inquiries')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/inquiries*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/inquiries*') ? 'active' : '' }}"
               href="{{ route('inquiries.index') }}">{{ __('messages.inquiries.inquiries') }}</a>
        </li>
    @endcan

    @can('manage_users')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/users*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/users*') ? 'active' : '' }}"
               href="{{ route('users.index') }}">{{ __('messages.users') }}</a>
        </li>
    @endcan

    @can('manage_events')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/events*','admin/event-categories*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{Request::is('admin/events*') ? 'active' : '' }}"
               href="{{ route('events.index') }}">{{ __('messages.events.events') }}</a>
        </li>
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/events*','admin/event-categories*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/event-categories*') ? 'active' : '' }}"
               href="{{ route('event-categories.index') }}">{{ __('messages.event.event_categories') }}</a>
        </li>
    @endcan

    @can('manage_sliders2')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/second-slider*','admin/categories*','admin/second-video-section*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{Request::is('admin/second-slider*') ? 'active' : '' }}"
               href="{{ route('second-slider.index') }}">{{ __('messages.slider.sliders') }}</a>
        </li>
    @endcan
    
    @can('manage_categories')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/second-slider*','admin/categories*','admin/second-video-section*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/categories*') ? 'active' : '' }}"
               href="{{ route('categories.index') }}">{{ __('messages.categories.categories') }}</a>
        </li>
    @endcan
    
    @can('manage_second_video_section')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/second-slider*','admin/categories*','admin/second-video-section*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/second-video-section*') ? 'active' : '' }}"
               href="{{ route('second-video-section.index') }}">{{ __('messages.second_video_section.second_video_section') }}</a>
        </li>
    @endcan

    @can('manage_sliders_third')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{Request::is('admin/third-slider*') ? 'active' : '' }}"
               href="{{ route('third-slider.index') }}">{{ __('messages.slider.sliders') }}</a>
        </li>
    @endcan
    
    @can('manage_categories_third')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/third-categories*') ? 'active' : '' }}"
               href="{{ route('third-categories.index') }}">{{ __('messages.categories.categories') }}</a>
        </li>
    @endcan
    
    @can('manage_video_section_third')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
        {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/third-video-section*') ? 'active' : '' }}"
               href="{{ route('third-video-section.index') }}">{{ __('messages.second_video_section.second_video_section') }}</a>
        </li>
    @endcan

    @can('manage_success_stories')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/success-stories*') ? 'active' : '' }}"
               href="{{ route('success-stories.index') }}">{{ __('messages.success_story.success_story') }}</a>
        </li>
    @endcan

    @can('manage_email_subscribe')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/email-subscribe*') ? 'active' : '' }}"
               href="{{ route('email.subscribe.index') }}">{{ __('messages.email_subscribes.subscribes') }}</a>
        </li>
    @endcan

    @can('manage_about_us')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/about-us*') ? 'active' : '' }}"
               href="{{ route('about-us.index') }}">{{ __('messages.about_us.about_us') }}</a>
        </li>
    @endcan

    @can('manage_contact_us')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/contact-us*') ? 'active' : '' }}"
               href="{{ route('contact-us.index') }}">{{ __('messages.contact_us.contact_us') }}</a>
        </li>
    @endcan

    @can('manage_faqs')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/faqs*') ? 'active' : '' }}"
               href="{{ route('faqs.index') }}">{{ __('messages.faqs.faqs') }}</a>
        </li>
    @endcan

    @can('manage_teams')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/team-members*') ? 'active' : '' }}"
               href="{{ route('team-members.index') }}">{{ __('messages.teams.teams') }}</a>
        </li>
    @endcan

    @can('manage_terms_conditions')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/terms-conditions*') ? 'active' : '' }}"
               href="{{ route('terms-conditions.index') }}">{{ __('messages.terms_conditions.terms_conditions') }}</a>
        </li>
    @endcan

    @can('manage_pages')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/pages*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/pages*') ? 'active' : '' }}"
               href="{{ route('pages.index') }}">{{ __('messages.pages') }}</a>
        </li>
    @endcan

    @can('manage_roles')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/roles*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/roles*') ? 'active' : '' }}"
               href="{{ route('roles.index') }}">{{ __('messages.roles') }}</a>
        </li>
    @endcan
    
    @can('manage_brands')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/brands*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/brands*') ? 'active' : '' }}"
               href="{{ route('brands.index') }}">{{ __('messages.brand.brands') }}</a>
        </li>
    @endcan

@can('manage_news')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/news*','admin/news-categories*','admin/news-tags*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{Request::is('admin/news/*','admin/news') ? 'active' : '' }}"
           href="{{ route('news.index') }}">{{ __('messages.news.news') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/news*','admin/news-categories*','admin/news-tags*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/news-categories*') ? 'active' : '' }}"
           href="{{ route('news-categories.index') }}">{{ __('messages.news_category.news_categories') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0
    {{ !Request::is('admin/news*','admin/news-categories*','admin/news-tags*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/news-tags*') ? 'active' : '' }}"
           href="{{ route('news-tags.index') }}">{{ __('messages.new_tag.news_tags') }}</a>
    </li>
@endcan
   
    @can('manage_language')
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/languages*')) ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('admin/languages*') ? 'active' : '' }}"
               href="{{ route('languages.index') }}">{{ __('messages.languages') }}</a>
        </li>
    @endcan

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('profile*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('profile*') ? 'active' : '' }}"
           href="{{ route('profile.setting') }}">{{ __('messages.user.profile_details') }}</a>
    </li>
