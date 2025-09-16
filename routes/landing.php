
<?php

use App\Http\Controllers\EmailSubscribeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PaypalPayoutController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware(['xss', 'setLanguage'])->group(function () {
    Route::get('/', [LandingController::class, 'home'])->name('landing.home');
    Route::get('/about-us', [LandingController::class, 'aboutUs'])->name('landing.about');
    Route::get('/causes/{category?}', [LandingController::class, 'campaign'])->name('landing.causes');
    Route::get('/contact-us', [LandingController::class, 'contact'])->name('landing.contact');
    Route::post('/contact-us/get-in-touch', [LandingController::class, 'store'])->name('landing.contact.store');
    Route::get('/terms-conditions', [LandingController::class, 'termCondition'])->name('landing.terms-conditions');
    Route::get('/privacy-policy', [LandingController::class, 'privacyPolicy'])->name('landing.privacy-policy');
    Route::post('/email-subscribe', [EmailSubscribeController::class, 'store'])->name('email.subscribe.store');
    Route::get('/news', [LandingController::class, 'news'])->name('landing.news');
    Route::get('news-details/{news:slug}', [LandingController::class, 'newsDetails'])->name('landing.news-details');
    Route::get('/events/{category?}', [EventController::class, 'getEventList'])->name('landing.event');
    Route::get('/event-details/{event:slug}', [EventController::class, 'eventDetail'])->name('landing.event.detail');
    Route::post('/event-details/book-seat', [EventController::class, 'bookSeat'])->name('landing.event.book-seat');
    Route::get('/c/{campaign:slug}',
        [LandingController::class, 'campaignDetails'])->name('landing.campaign.details');
    Route::get('/c/{campaign:slug}/payment', [LandingController::class, 'getPayment'])->name('landing.payment');
    Route::get('/c/{campaign:slug}/gift/{id}/payment', [LandingController::class, 'getPayment'])->name('landing.gift.payment');
    Route::get('/events', [EventController::class, 'getEventList'])->name('landing.event');
    Route::post('/call-to-actions', [LandingController::class, 'callToActions'])->name('landing.call-to-actions');
    Route::get('/faqs', [LandingController::class, 'faqs'])->name('landing.faqs');
    Route::get('/teams', [TeamController::class, 'getTeam'])->name('landing.team');
    Route::get('/page/{page}', [PageController::class, 'pageDetail'])->name('landing.page.detail');
    Route::post('/news-comments', [LandingController::class, 'newsComments'])->name('landing.news-comments');

    //stripe routes
    Route::post('stripe-payment', [StripeController::class, 'createSession'])->name('campaign.stripe-payment');
    Route::get('payment-success', [StripeController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('failed-payment', [StripeController::class, 'handleFailedPayment'])->name('failed-payment');

    //paypal routes
    Route::get('paypal-onboard', [PaypalController::class, 'onBoard'])->name('paypal.init');
    Route::get('paypal-payment-success', [PaypalController::class, 'success'])->name('paypal.success');
    Route::get('paypal-payment-failed', [PaypalController::class, 'failed'])->name('paypal.failed');

    Route::get('paypal-payout', [PaypalPayoutController::class, 'payout'])->name('paypal.payout');

    Route::get('/change-language/{language}', [LandingController::class, 'changeLanguage'])->name('landing.change-language');
});
