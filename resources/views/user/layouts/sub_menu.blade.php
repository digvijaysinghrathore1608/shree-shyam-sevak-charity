<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('user/dashboard*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('user/dashboard*') ? 'active' : ''  }}"
       href="{{ route('user.dashboard') }}">{{ __('messages.dashboard') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('user/campaigns*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('user/campaigns*') ? 'active' : ''  }}"
       href="{{ route('user.campaigns.index') }}">{{ __('messages.campaign.campaigns') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('user/withdraw*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('user/withdraw*') ? 'active' : ''  }}"
       href="{{ route('user.withdraw.index') }}">{{ __('messages.withdraw.withdraw_request') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0  {{ (!Request::is('user/payout-settings*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('user/payout-settings*') ? 'active' : ''  }}"
       href="{{ route('user.settings.index') }}">{{ __('messages.payout_setting.payout_settings') }}</a>
</li>
