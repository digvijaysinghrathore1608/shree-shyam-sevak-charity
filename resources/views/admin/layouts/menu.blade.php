@can('manage_dashboard')
    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('admin.dashboard') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-circle-dot fs-3"></i></span>
            <span class="aside-menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </li>
@endcan
@can('manage_campaign')
    <li class="nav-item {{ Request::is('admin/campaign-categories*', 'admin/campaigns*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('campaigns.index') }}">
            <span class="aside-menu-icon pe-3"><i class='fas fa-bullhorn fs-3'></i></span>
            <span class="aside-menu-title">{{ __('messages.campaign.campaigns') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('admin/donation-gifts*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('donation-gifts.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-donate fs-3"></i></span>
            <span class="aside-menu-title">{{ __('messages.donation_gifts.donation_gifts') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('admin/withdraw') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('withdraw.index') }}">
            <span class="aside-menu-icon pe-3"><i class='fa fa-money-bill fs-3'></i></span>
            <span class="aside-menu-title">{{ __('messages.withdraw.withdraw_request') }}</span>
        </a>
    </li>
@endcan

<li class="nav-item {{ Request::is('admin/withdrawals*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('withdrawals.index') }}">
        <span class="aside-menu-icon pe-3"><i class="fa-solid fa-money-bill-transfer fs-3"></i></span>
        <span class="aside-menu-title">{{ __('messages.withdrawal.withdrawal_charges') }}</span>
    </a>
</li>

@can('manage_events')
    <li class="nav-item {{ Request::is('admin/events*','admin/event-categories*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('events.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-calendar fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.events.events')}}</span>
        </a>
    </li>
@endcan
@can('manage_news')
    <li class="nav-item {{ Request::is('admin/news*','admin/news-categories*','admin/news-tags*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('news.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-newspaper fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.news.news')}}</span>
        </a>
    </li>
@endcan
@can('manage_users')
    <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('users.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-users fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.users')}}</span>
        </a>
    </li>
@endcan
@can('manage_pages')
    <li class="nav-item {{ Request::is('admin/pages*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('pages.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-file fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.pages')}}</span>
        </a>
    </li>
@endcan
@can('manage_roles')
    <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('roles.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-user fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.roles')}}</span>
        </a>
    </li>
@endcan
@can('manage_brands')
    <li class="nav-item {{ Request::is('admin/brands*') ? 'active' : '' }}" href="{{ route('brands.index') }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('brands.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-adjust fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.brand.brands')}}</span>
        </a>
    </li>
@endcan
@can('manage_inquiries')
    <li class="nav-item {{ Request::is('admin/inquiries*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('inquiries.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-question-circle fs-3"></i></span>
            <span class="aside-menu-title">{{ __('messages.inquiries.inquiries') }}</span>
        </a>
    </li>
@endcan
@can('manage_language')
    <li class="nav-item {{ Request::is('admin/languages*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('languages.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fa fa-language fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.languages')}}</span>
        </a>
    </li>
@endcan


@canany(['manage_sliders_third','manage_categories_third','manage_video_section_third','manage_success_stories','manage_email_subscribe','manage_about_us','manage_contact_us','manage_faqs','manage_teams','manage_terms_conditions'])
    <li class="nav-item {{ Request::is('admin/third-slider*','admin/third-categories*','admin/third-video-section*','admin/success-stories*','admin/email-subscribe*','admin/about-us*','admin/contact-us*','admin/faqs*','admin/team-members*','admin/terms-conditions*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ checkRoutePermissions(['manage_sliders_third','manage_categories_third','manage_video_section_third', 'manage_success_stories', 'manage_email_subscribe', 'manage_about_us', 'manage_contact_us', 'manage_faqs','manage_teams', 'manage_terms_conditions'],'thirdCMS') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-house-user fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.back_front_cms')}}</span>
        </a>
    </li>
@endcan



@can('manage_settings')
    <li class="nav-item {{ Request::is('admin/settings*','admin/countries*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('setting.index') }}">
            <span class="aside-menu-icon pe-3"><i class="fas fa-cogs fs-3"></i></span>
            <span class="aside-menu-title">{{__('messages.settings')}}</span>
        </a>
    </li>
@endcan
