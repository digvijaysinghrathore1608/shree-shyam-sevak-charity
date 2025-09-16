    <li class="nav-item {{ Request::is('user/dashboard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.dashboard') }}">
            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-circle-dot fs-3"></i></span>
            <span class="aside-menu-title">{{ __('messages.dashboard') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('user/campaigns*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.campaigns.index') }}">
            <span class="aside-menu-icon pe-3"> <i class='fas fa-bullhorn fs-3'></i></span>
            <span class="aside-menu-title">{{ __('messages.campaign.campaigns') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('user/withdraw*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.withdraw.index') }}">
            <span class="aside-menu-icon pe-3"> <i class='fa fa-money-bill fs-3'></i></span>
            <span class="aside-menu-title">{{ __('messages.withdraw.withdraw_request') }}</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('user/payout-settings*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-3" aria-current="page" href="{{ route('user.settings.index') }}">
            <span class="aside-menu-icon pe-3"> <i class="fas fa-calendar fs-3"></i></span>
            <span class="aside-menu-title">{{ __('messages.payout_setting.payout_settings') }}</span>
        </a>
    </li>
