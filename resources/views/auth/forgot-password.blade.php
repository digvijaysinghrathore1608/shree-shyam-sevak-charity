@extends('admin.layouts.auth')
@section('title')
    {{__('messages.common.forgot_password')}}
@endsection
@section('content')

    <div class="d-flex flex-column flex-column-fluid align-items-center mt-12 p-4">
        <div class="col-12 text-center mt-0">
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
            <h1 class="text-center mb-7">{{__('messages.common.forgot_password').' ?'}}</h1>
            <div class="fw-bold fs-4 mb-5 text-center">{{__('messages.common.enter_your_email_to_reset_your_password')}}</div>
            <div class="fs-4 text-center mb-5">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</div>
            <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            {{ __('messages.common.email').':' }}<span class="required"></span>
                        </label>
                        <input id="email" class="form-control" type="email"
                               value="{{ old('email') }}"
                               required autofocus name="email" autocomplete="off"
                               placeholder="{{ __('auth.login.enter_email') }}"/>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit"
                            class="btn btn-primary mx-3">{{ __('messages.common.email_password_reset_link') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
