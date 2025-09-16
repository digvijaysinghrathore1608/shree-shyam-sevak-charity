@extends('front_landing.layouts.app')
@section('title')
    {{ __('messages.page.cause_details') }}
@endsection
@section('content')
    <div class="payment-page">
        <!-- start hero-section -->
        <section class="hero-section">
            <div class="inner-bgimg  position-relative"
                 style="background: url('{{asset('front_landing/images/causes-hero-img.png')}}');">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-6 col-md-7 parallelogram-shape">
                            <div class="text-white inner-text position-relative">
                                <p class="fs-18 fw-5 mb-md-3 pb-lg-2 mb-2">{{__('messages.front_landing.our_mission_food_education_medicine')}}</p>
                                <h2 class="fs-1 mb-md-0 fw-6">{{ __('messages.front_landing.payment') }}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end hero-section -->

        <!-- start payment-section -->
        <section class="payment-section pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- start payment-left-section -->
                        <div class="payment-left-section pb-100">
                            @if($campaign->goal)
                                {{ Form::open(['id'=>'campaignDonationForm' , 'class'=>'give-form mt-3' , 'autocomplete' => 'off']) }}
                                @if(empty($donationAsGiftDetails))
                                <div class="tags d-flex flex-wrap pb-1 give-donation-amount donate-amount-buttons">
                                    @if($campaign->currency != 'inr')
                                        <div class="tag bg-light rounded-10  mb-3 ">
                                            <span class="single_amount currency prefilled-amount">20</span>
                                        </div>
                                    @endif
                                        <div class="tag bg-light rounded-10  mb-3">
                                            <span class="single_amount currency prefilled-amount">40</span>
                                        </div>
                                        <div class="tag bg-light rounded-10  mb-3 ">
                                            <span class="single_amount currency prefilled-amount">60</span>
                                        </div>
                                        <div class="tag bg-light rounded-10  mb-3 ">
                                            <span class="single_amount currency prefilled-amount">80</span>
                                        </div>
                                        <div class="tag bg-light rounded-10  mb-3 ">
                                            <span class="single_amount currency prefilled-amount">100</span>
                                        </div>
                                        <div class="tag bg-light rounded-10  mb-3 ">
                                            <span class="single_amount currency prefilled-amount">120</span>
                                        </div>
                                </div>
                                @endif

                                <input type="hidden" name="campaign_id" id="campaignId" value="{{$campaign->id}}">
                                <input type="hidden" name="user_id" id="userId"
                                       value="{{getLogInUser() ? getLogInUserId() : null}}">
                                <input type="hidden" name="currency_code" id="currencyCode"
                                       value="{{$campaign->currency}}">
                                <input type="hidden" name="stripe_key" id="stripeKey"
                                       value="{{ getSettingValue('stripe_key') }}">

                                <div class="row">
                                    @if(!empty($donationAsGiftDetails))
                                    <div class="col-12 input-group mb-3 pb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ getCurrencySymbol($campaign->currency) }}</span>
                                        </div>
                                        <input type="text"
                                               class="form-control give-final-total-amount pl-1 custom-final-amount price donation_amount text-dark fillAmount"
                                               placeholder="Amount"
                                               aria-label="Username"
                                               name="amount" id="amount"
                                               aria-describedby="basic-addon1"
                                               value="{{ $donationAsGiftDetails->amount }}" required
                                               onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                                               readonly
                                        >
                                    </div>
                                    @else
                                        <div class="col-12 input-group mb-3 pb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ getCurrencySymbol($campaign->currency) }}</span>
                                            </div>
                                            <input type="text"
                                                   class="form-control give-final-total-amount pl-1 custom-final-amount price donation_amount text-dark fillAmount"
                                                   placeholder="Amount"
                                                   aria-label="Username"
                                                   name="amount" id="amount"
                                                   aria-describedby="basic-addon1"
                                                   value="{{ $campaign->amount_prefilled }}" required
                                                   onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'>
                                        </div>
                                    @endif

                                    <div class="col-lg-6 mb-3 pb-1">
                                        <input type="text" name="first_name" class="form-control fs-14 text-dark"
                                               id="firstName"
                                               value="{{ getLogInUser() ? getLogInUser()->first_name : '' }}"
                                               placeholder="{{__('messages.user.first_name')}} *" required>
                                    </div>
                                    <div class="col-lg-6 mb-3 pb-1">
                                        <input type="text" name="last_name" class="form-control fs-14 text-dark"
                                               id="lastName"
                                               value="{{ getLogInUser() ? getLogInUser()->last_name : '' }}"
                                               class="form-control"
                                               placeholder="{{__('messages.user.last_name')}} *" required>
                                    </div>
                                    <div class="col-12 mb-3 pb-1">
                                        <input type="email" class="form-control fs-14 text-dark"
                                               aria-describedby="emailHelp"
                                               id="email"
                                               value="{{ getLogInUser() ? getLogInUser()->email : '' }}"
                                               placeholder="{{__('messages.common.email')}}">
                                    </div>
                                    <input type="hidden" name="admin_tip" value="2">
                                        @if(getSettingValue('stripe_enable') == 1 || getSettingValue('paypal_enable') == 1 && $campaign->currency != 'inr')
                                    <div class="col-12 mb-4 pb-2">
                                        <input type="hidden" name="selected_payment_gateway"
                                               value="paypal">
                                        <div class="radio-button rounded-10 d-flex flex-wrap align-items-center pt-3 px-4">
                                            @if(getSettingValue('stripe_enable') == 1)
                                                <div class="form-check me-lg-5 me-4 my-1 pb-3">
                                                    <input class="form-check-input me-2 payment-method checkPaymentType" type="radio"
                                                           name="payment_method" id="paymentStripe"
                                                           value="{{ \App\Models\CampaignDonationTransaction::STRIPE }}"
                                                           checked>
                                                    <label class="form-check-label" for="paymentStripe">
                                                        <img src="{{asset('front_landing/images/stripe.png')}}"
                                                             class="w-100 h-100 object-fit-cover">
                                                    </label>
                                                </div>
                                            @endif
                                            @if($campaign->currency != 'inr' && getSettingValue('paypal_enable') == 1)
                                                <div class="form-check  my-1 pb-3">
                                                    <input class="form-check-input me-3 payment-method checkPaymentType"
                                                           type="radio"
                                                           name="payment_method" id="paymentPaypal"
                                                           value="{{ \App\Models\CampaignDonationTransaction::PAYPAL }}">
                                                    <label class="form-check-label" for="paymentPaypal">
                                                        <img src="{{asset('front_landing/images/paypal.png')}}"
                                                             class="w-100 h-100 object-fit-cover">
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                        @endif
                                    <div class="col-12 mb-4 pb-2">
                                        <input type="checkbox" class="form-check-input" id="donateAnonymously" name="donateAnonymously" value="1" checked>
                                        <label>{{ __('Donate Anonymously') }}</label>
                                    </div>
                                    {{--                                    <input type="hidden" name="stripeDiscountType" id="stripeDiscountType" value="{{$stripeWithdraw->discount_type}}">--}}
                                    {{--                                    <input type="hidden" name="stripeDiscount" id="stripeDiscount" value="{{$stripeWithdraw->discount}}">--}}
                                    {{--                                    --}}
                                    {{--                                    <input type="hidden" name="paypalDiscountType" id="paypalDiscountType" value="{{$paypalWithdraw->discount_type}}">--}}
                                    {{--                                    <input type="hidden" name="paypalDiscount" id="paypalDiscount" value="{{$paypalWithdraw->discount}}">--}}

                                    <input type="hidden" name="type_commission" id="typeOfCommission"
                                           value="{{$typeOfCommission}}">
                                    <input type="hidden" name="donation_commission" id="donationCommission"
                                           value="{{$donationCommission}}">


                                    <div class="form-button donate-seperate-page-button stripePayment">
                                        <button type="button"
                                                class="btn btn-primary me-3 donate-btn paymentByStripe">{{__('messages.payment.donate_now')}}</button>
                                        <a href="{{route('landing.campaign.details',$campaign->slug)}}"
                                           class="btn btn-gray">{{__('messages.front_landing.go_back')}}</a>
                                    </div>

                                    <div class="form-button donate-seperate-page-button d-none paypalPayment">
                                        <button type="button"
                                                class="btn btn-primary me-3 donate-btn paymentByPaypal">{{__('messages.payment.donate_now')}}</button>
                                        <a href="{{route('landing.campaign.details',$campaign->slug)}}"
                                           class="btn btn-gray">{{__('messages.front_landing.go_back')}}</a>
                                    </div>
                                </div>
                                {{ Form::close() }}

                        </div>
                        <!-- end payment-left-section -->
                    </div>
                    <div class="col-xl-4">
                        <!-- start payment-right-section -->
                        <div class="pb-100">
                            <div class="about-section bg-light p-30 rounded-10 position-relative mb-20">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-lg-1">
                                    <h5 class="fs-20 fw-6 text-dark mb-0 me-4">{{__('messages.front_landing.your_donation_details')}}</h5>
                                    <div class="rectangle-shape"></div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="about-post me-sm-3 me-2">
                                            <img src="{{ $campaign->image ? : asset('front_landing/images/about-post.png')}}"
                                                 alt="" width="80" height="80"
                                                 class="radius-four object-fit-cover rounded-10">
                                        </div>
                                        <div class="text">
                                            <a class="fs-18 fw-5 text-dark mb-2"
                                               href="{{route('landing.campaign.details',$campaign->slug)}}">{{ Str::limit($campaign->title,20) }}</a>
                                            <p class="fs-14 fw-5 text-gray mb-0">{{__('messages.front_landing.created_by')}}
                                                {{$campaign->user->first_name.' '.$campaign->user->last_name}}</p>
                                        </div>
                                    </div>
                                </div>
                                    @if(!empty($donationAsGiftDetails))
                                {{Form::hidden('donation_as_gift_id', $donationAsGiftDetails->id, ['id' => 'donationAsGiftId'])}}
                                    <span class="fs-14 fw-5 text-primary mb-0 charge_element">Your Gift Amount Is {{getCurrencySymbol($campaign->currency)}} <span id="">{{$donationAsGiftDetails->amount}}</span></span><br>
                                     @endif
                                @if($chargeAmount > 0)
                                    <span class="fs-14 fw-5 text-danger mb-0 charge_element">Note : Charge Amount Is {{getCurrencySymbol($campaign->currency)}} <span
                                                id="chargeAmtID">{{$chargeAmount}}</span></span>
                                @endif
                                    <p class="fs-14 fw-5 text-gray mb-0">{{__('messages.front_landing.your_donation')}}
                                        <span class="fs-18 fw-5 text-dark">{{ getCurrencySymbol($campaign->currency) }}</span>
                                        <span class="give-final-total-amount pl-1 fs-18  custom-final-amount price donation_amount text-dark showTotalAmount"
                                              id="yourAmount">
                                            {{ $totalAmount }}</span>
                                    </p>
                            </div>
                        @if(!empty($donationAsGiftDetails))
                            <!-- start select-gift section -->
                                <div class="select-gift-section bg-light p-30 pb-2 rounded-10 mb-20">
                                    <div class="d-flex justify-content-between align-items-center mb-1 pb-lg-1">
                                        <h5 class="fs-20 fw-5 text-dark mb-0">{{__('messages.front_landing.selected_gift')}}</h5>
                                        <div class="rectangle-shape"></div>
                                    </div>
                                    <div class="select-gift pb-4 pt-4">
                                        <div class="d-flex">
                                            <div class="me-3 position-relative">
                                                <div class="gift-img"><img src="{{$donationAsGiftDetails->donation_gift_image}}" class="w-100 h-100 rounded-10">
                                                </div>
                                                <h5 class="badge small-btn">{{getCurrencySymbol($campaign->currency)}}{{$donationAsGiftDetails->amount}}</h5></div>
                                            <div class=""><h6 class="fs-20 fw-5 text-dark">{{$donationAsGiftDetails->title}}</h6>
                                                <p class="fs-12 text-secondary mb-2">{{Str::limit($donationAsGiftDetails->description, 50)}}</p>
                                                <div class="d-flex flex-wrap"><span class="text-dark fw-5 me-2">{{__('messages.front_landing.gifts')}}:</span>
                                                    @foreach($donationAsGiftDetails->gifts as $campaignGift)
                                                        <span class="tag">
                                                    {{$campaignGift->name}}
                                                </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="button col-xl-12 col-md-3 col-sm-6 text-center pt-2">--}}
                                        {{--                                            --}}{{--                                    {{Form::hidden('gift_amount', $donationEnableGift->id,['id' => 'giftAmount'])}}--}}
                                        {{--                                            <a href="{{route('landing.gift.payment', [$campaign->slug, $donationEnableGift->id])}}"--}}
                                        {{--                                               class="btn btn-transparent w-100 mt-3 {{ ((getSettingValue('stripe_enable')) == 1 || (getSettingValue('paypal_enable')) == 1 ? '' : '' )}}">{{__('messages.front_landing.select_gift')}}</a>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div> <!-- end select-gift section -->
                            @endif
                            @if(count($allDonors) > 0)
                                <section class="donation-section bg-light p-30 rounded-10 mb-20">
                                    <div class="d-flex justify-content-between align-items-center mb-4 pb-lg-1">
                                        <h5 class="fs-20 fw-6 text-dark mb-0">People have made a donation</h5>
                                        <div class="rectangle-shape"></div>
                                    </div>
                                    @foreach($allDonors as $donor)
                                        <div class=" d-flex align-items-center mb-3">
                                            <div class="icon me-3">
                                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                            </div>
                                            <div class="desc"><p
                                                        class="mb-0 fw-5">{{ $donor->donate_anonymously ? 'Anonymous' : $donor->full_name }} </p>
                                                <span
                                                        class="fs-14 fw-5 text-primary">{{  getCurrencySymbol($donor->campaign->currency).' '.number_format($donor->donated_amount, 2) }}</span>
                                                <span class="fs-14 fw-5">at {{ Carbon\Carbon::parse($donor->created_at)->isoFormat('Do MMM YYYY') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </section>
                            @endif
                        </div>
                        <!-- end payment-right-section -->
                    </div>
                    @else
                        <h5 align="center">{{__('messages.front_landing.the_goal_amount_should_be_greater_than_0')}}</h5>
                    @endif

                </div>
            </div>
        </section>
        <!-- end payment-section -->
    </div>
@endsection
