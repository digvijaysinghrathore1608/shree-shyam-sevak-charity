@extends('admin.layouts.auth')
@section('title')
    {{__('messages.common.reset_password')}}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('users.index') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ getLogoUrl() }}" class="img-fluid logo-fix-size">
            </a>
        </div>
        <div class="width-540">
            @include('flash::message')
            @include('admin.layouts.errors')
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <form class="form w-100" method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">


                <!--Email-->
                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{ __('messages.common.email').':' }}<span class="required"></span>
                    </label>
                    <input id="email" class="form-control form-control-solid" type="email"
                           value="{{ old('email', $request->email) }}"
                           required autofocus name="email" autocomplete="off"/>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                {{--Password--}}
                <div class="mb-sm-7 mb-4">
                    <label class="form-label"
                           for="password">{{__('messages.user.password')}}</label>
                    <div class="mb-3 position-relative">
                        <input id="password" class="form-control form-control-solid"
                               type="password"
                               name="password"
                               required autocomplete="off"/>
                    </div>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="fv-row mb-5">
                    <label class="form-label "
                           for="password_confirmation">{{__('messages.user.confirm_password')}}</label>
                    <input class="form-control  form-control-solid" type="password"
                           id="password_confirmation" name="password_confirmation" autocomplete="off"/>
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('Reset Password') }}</span>
                      </button>
                </div>
            </form>
        </div>
@endsection
