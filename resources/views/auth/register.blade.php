@extends('admin.layouts.auth')
@section('title')
    {{__('messages.common.register')}}
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
            @include('admin.layouts.errors')
            @if (session('status'))
                @include('flash::message')
            @endif
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('messages.common.create_an_account')}}</h1>
            <form class="form w-100" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="formInputFirstName" class="form-label">
                            {{ __('messages.user.first_name').':' }}<span class="required"></span>
                        </label>
                        <input name="first_name" type="text" class="form-control" id="first_name"
                               placeholder=" {{  __('auth.registration.first_name') }}"
                               aria-describedby="firstName" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="last_name" class="form-label">
                            {{ __('messages.user.last_name').':' }}<span class="required"></span>
                        </label>
                        <input name="last_name" type="text" class="form-control" id="last_name"
                               placeholder=" {{ __('auth.registration.last_name') }}"
                               aria-describedby="lastName" required value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-sm-7 mb-4">
                        <label for="email" class="form-label">
                            {{ __('messages.common.email').':' }}<span class="required"></span>
                        </label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email"
                               placeholder=" {{ __('auth.login.enter_email') }}"
                               value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row mb-sm-7">
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            {{ __('messages.user.password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder=" {{ __('auth.login.password') }}" aria-describedby="password" required
                                   aria-label="Password" data-toggle="password" autocomplete="new-password">
                            <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                <i class="bi bi-eye-slash-fill"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">
                            {{ __('messages.user.confirm_password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input name="password_confirmation" type="password" class="form-control"
                                   placeholder=" {{ __('auth.login.confirm_password') }}" id="password_confirmation"
                                   aria-describedby="confirmPassword" required aria-label="Password"
                                   data-toggle="password">
                            <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                <i class="bi bi-eye-slash-fill"></i>
                            </span>
                        </div>
                    </div>
                    <div class="text-muted">{{__('messages.common.use_8_or_more_characters')}}</div>
                </div>
                <div class="mb-sm-4 form-check">
                    <input type="checkbox" class="form-check-input" name="toc" value="1" required/>
                    <span class="text-gray-700 me-2 ml-1">{{__('messages.common.i_agree')}}
									<a href="{{ route('landing.terms-conditions') }}" target="_blank"
                                       class="ms-1 link-primary">{{__('messages.common.terms_and_conditions')}}</a><span> and</span>
                        <a href="{{ route('landing.privacy-policy') }}"
                           target="_blank" class="ms-1 link-primary">{{__('messages.terms_conditions.privacy_policy')}}</a>.</span>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{__('messages.common.submit')}}</button>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <span class="text-gray-700 me-2">{{__('messages.common.already_have_an_account').'?'}}</span>
                    <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                        {{__('messages.common.sign_in_here')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
