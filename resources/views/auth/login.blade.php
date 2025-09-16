@extends('admin.layouts.auth')
@section('title')
    {{__('messages.common.login')}}
@endsection
@section('content')
    <ul class="nav nav-pills language-option" style="justify-content: flex-end; cursor: pointer">
        <li class="nav-item dropdown m-5">
            <a class="btn btn-primary w-150px mb-5 indicator m-3 dropdown-toggle" data-bs-toggle="dropdown"
                href="javascript:void(0)" role="button" aria-expanded="false">{{ getHeaderLanguageName() }}</a>
            <ul class="dropdown-menu w-150px">
                @foreach (getAllLanguage() as $language)
                    <li class="{{ $language->iso_code == App::getLocale() ? 'active' : '' }}">
                        <a class="dropdown-item  px-5 language-select {{ $language->iso_code == App::getLocale() ? 'bg-primary text-white' : 'text-dark' }}"
                            href="{{ route('landing.change-language', $language->iso_code) }}"
                            data-prefix-value="{{ $language->iso_code }}">
                            {{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('landing.home') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ getLogoUrl() }}" class="img-fluid logo-fix-size">
            </a>
        </div>
        <div class="width-540">
            @include('flash::message')
            @include('admin.layouts.errors')
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('messages.common.sign_in')}}</h1>
            <form class="form w-100" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{__('messages.common.email')}}<span class="required"></span>
                    </label>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" id="email"
                           aria-describedby="emailHelp" required placeholder=" {{ __('auth.login.enter_email')}}"
                           autofocus>
                </div>
                <!-- Password -->
                <div class="mb-sm-7 mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="form-label">{{__('messages.user.password')}}<span
                                    class="required"></span></label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-info fs-6 text-decoration-none">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="mb-3 position-relative">
                        <input name="password" type="password" class="form-control" id="password" required
                               placeholder="{{ __('auth.login.password')}}" aria-label="Password"
                               data-toggle="password">
                        <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                <i class="bi bi-eye-slash-fill"></i>
                            </span>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-sm-7 mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">{{ __('messages.common.remember_me') }}</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('messages.common.login') }}</button>
                </div>
                <div class="d-flex align-items-center mb-10 mt-4">
                    <span class="text-gray-700 me-2">{{__('messages.common.new_here').'?'}}</span>
                    <a href="{{ route('register') }}" class="link-info fs-6 text-decoration-none">
                        {{__('messages.common.create_an_account')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
