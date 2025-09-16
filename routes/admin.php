<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminWithdrawController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CallToActionController;
use App\Http\Controllers\CampaignCategoryController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignFaqController;
use App\Http\Controllers\CampaignUpdatesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryThirdController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationGiftController;
use App\Http\Controllers\EmailSubscribeController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FrontSlider2Controller;
use App\Http\Controllers\FrontSliderController;
use App\Http\Controllers\FrontSliderThirdController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsCommentsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsTagsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SecondVideoSectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ThirdVideoSectionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoSectionController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'xss', 'valid.user','role:admin')->group(function () {
    //admin dashboard route
    Route::middleware('permission:manage_dashboard')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/donation-withdraw-chart',
            [DashboardController::class, 'donationWithdrawChart'])->name('donation.withdraw.chart');
    });

//    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    // Role route
    Route::middleware('permission:manage_roles')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    // Settings routes
    Route::middleware('permission:manage_settings')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('setting.update')->withoutMiddleware('xss');
        Route::post('/setting-credential', [SettingController::class, 'settingCredential'])->name('setting.credential.update');
    });
    Route::middleware('permission:manage_inquiries')->group(function () {
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    });

    //call to actions routes
    Route::middleware('permission:manage_call_to_action')->group(function () {
        Route::get('/call-to-actions', [CallToActionController::class, 'index'])->name('call-to-actions.index');
        Route::delete('/call-to-actions/{callToAction}',
            [CallToActionController::class, 'destroy'])->name('call-to-action.destroy');
        Route::get('/call-to-actions/{callToAction}', [CallToActionController::class, 'show'])->name('call-to-actions.show');
    });

    // users route
    Route::middleware('permission:manage_users')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/verify', [UserController::class, 'EmailVerify'])->name('user.email.verify');
        Route::post('users/{user}/active-deactive',
            [UserController::class, 'activeDeactiveStatus'])->name('user.status.active.deactive');
    });

//    Route::group(['middleware' => ['permission:manage_campaign_categories']], function () {
//        Route::resource('campaign-categories', CampaignCategoryController::class);
//        Route::post('campaign-categories-status',
//            [CampaignCategoryController::class, 'changeCategoryStatus'])->name('campaign-categories.status');
//    });

    // Country Route
    Route::middleware('permission:manage_countries')->group(function () {
        Route::resource('countries', CountryController::class);
    });

    // Front CMS
    Route::middleware('permission:manage_sliders')->group(function () {
        Route::resource('sliders', FrontSliderController::class);
        Route::post('/slider-card', [FrontSliderController::class, 'updateSliderCard'])->name('slider-card.update');
    });
    // Front CMS 2
    Route::middleware('permission:manage_sliders2')->group(function () {
        Route::resource('second-slider', FrontSlider2Controller::class);
    });
    Route::middleware('permission:manage_categories')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'update'])->name('categories.update');
    });
    Route::middleware('permission:manage_second_video_section')->group(function () {
        Route::get('/second-video-section', [SecondVideoSectionController::class, 'index'])->name('second-video-section.index');
        Route::post('/second-video-section', [SecondVideoSectionController::class, 'update'])->name('second-video-section.update');
    });

    // Front CMS 3
    Route::middleware('permission:manage_sliders_third')->group(function () {
        Route::resource('third-slider', FrontSliderThirdController::class);
    });
    Route::middleware('permission:manage_categories_third')->group(function () {
        Route::resource('/third-categories', CategoryThirdController::class);
    });
    Route::middleware('permission:manage_video_section_third')->group(function () {
        Route::get('/third-video-section', [ThirdVideoSectionController::class, 'index'])->name('third-video-section.index');
        Route::post('/third-video-section', [ThirdVideoSectionController::class, 'update'])->name('third-video-section.update');
    });
    // Front CMS About Us menu
    Route::middleware('permission:manage_about_us')->group(function () {
        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
        Route::post('/about-us', [AboutUsController::class, 'update'])->name('about-us.update');
    });

    // Front CMS Video section menu
    Route::middleware('permission:manage_video_section')->group(function () {
        Route::get('/video-section', [VideoSectionController::class, 'index'])->name('video-section.index');
        Route::post('/video-section', [VideoSectionController::class, 'update'])->name('video-section.update');
    });

    // Front CMS Contact Us menu
    Route::middleware('permission:manage_contact_us')->group(function () {
        Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
        Route::post('/contact-us', [ContactUsController::class, 'update'])->name('contact-us.update');
    });

    // Front CMS About Us menu
    Route::middleware('permission:manage_terms_conditions')->group(function () {
        Route::get('/terms-conditions', [SettingController::class, 'editTermCondition'])->name('terms-conditions.index');
        Route::post('/terms-conditions', [SettingController::class, 'updateTermCondition'])->name('terms-conditions.update');
    });

    // Events Route
    Route::middleware('permission:manage_events')->group(function () {
        Route::resource('events', EventController::class);
        Route::resource('event-categories', EventCategoryController::class);
        Route::post('event-categories-status',
            [EventCategoryController::class, 'changeCategoryStatus'])->name('event-categories.status');
        Route::post('event-categories/{event_category}',
            [EventCategoryController::class, 'update'])->name('event-categories.update');
    });

    //Page Route
    Route::middleware('permission:manage_pages')->group(function () {
        Route::resource('pages', PageController::class);
        Route::post('pages-status',
            [PageController::class, 'changePageStatus'])->name('pages.status');
    });

    // Success Story Route
    Route::middleware('permission:manage_success_stories')->group(function () {
        Route::resource('success-stories', SuccessStoryController::class);
    });

    // Brands Route
    Route::middleware('permission:manage_brands')->group(function () {
        Route::resource('brands', BrandController::class);
        Route::post('edit-brand/{brand}',
            [BrandController::class, 'update'])->name('brands.update');
    });

    // Email Subscribe Route
    Route::middleware('permission:manage_email_subscribe')->group(function () {
        Route::get('/email-subscribe', [EmailSubscribeController::class, 'index'])->name('email.subscribe.index');
        Route::delete('/email-subscribe/{emailSubscribe}',
            [EmailSubscribeController::class, 'destroy'])->name('email.subscribe.destroy');
    });

    // News Route
    Route::middleware('permission:manage_news')->group(function () {
        Route::resource('news', NewsController::class);
        Route::resource('news-comments', NewsCommentsController::class);
        Route::resource('news-categories', App\Http\Controllers\NewsCategoryController::class);
        Route::resource('news-tags', NewsTagsController::class);
        Route::post('news-tags/{id}',
            [NewsTagsController::class, 'update'])->name('news-tags.update ');
    });

//    Route::group(['middleware' => ['permission:manage_news_categories']], function () {
//        Route::resource('news-categories', App\Http\Controllers\NewsCategoryController::class);
//    });
//
//    Route::group(['middleware' => ['permission:manage_news_tags']], function () {
//        Route::resource('news-tags', NewsTagsController::class);
//        Route::post('news-tags/{id}',
//            [NewsTagsController::class, 'update'])->name('news-tags.update ');
//    });

    Route::delete('/email-subscribe/{emailSubscribe}',
        [EmailSubscribeController::class, 'destroy'])->name('email.subscribe.destroy');

    // Events Route
    Route::resource('events', EventController::class);
    Route::get('events/participate-list/{id}',
        [EventController::class, 'showParticipateList'])->name('events.show-participate-list');
    Route::delete('/events/participate-list/{eventParticipant}',
        [EventController::class, 'destroyParticipate'])->name('events.participate.destroy');

    Route::middleware('permission:manage_campaign')->group(function () {
        // Campaigns
        Route::resource('campaigns', CampaignController::class);
        Route::post('update-field/{id}', [CampaignController::class, 'updateField'])->name('update.field');
        Route::post('campaign-file/{id}',
            [CampaignController::class, 'campaignFileStore'])->name('campaign.file.store');
        Route::get('get-campaign-file/{id}', [CampaignController::class, 'getCampaignFile'])->name('get.campaign.file');
        Route::post('remove-campaign-file',
            [CampaignController::class, 'removeCampaignFile'])->name('remove.campaign.file');
        Route::resource('campaign-faqs', CampaignFaqController::class);
        Route::resource('campaign-updates', CampaignUpdatesController::class);
        Route::get('/transaction/{transaction?}', [TransactionController::class, 'show'])->name('transaction.show');

        // Campaign Categories
        Route::resource('campaign-categories', CampaignCategoryController::class);
        Route::post('edit-campaign-categories/{campaign_category}',
            [CampaignCategoryController::class, 'update'])->name('campaign-categories.update');
        Route::post('campaign-categories-status',
            [CampaignCategoryController::class, 'changeCategoryStatus'])->name('campaign-categories.status');

        Route::resource('withdraw', AdminWithdrawController::class);
        Route::get('/withdraw/{withdraw}',
            [AdminWithdrawController::class, 'showPaymentDetails'])->name('withdraw.showPaymentDetails');
        Route::resource('withdrawals', WithdrawalController::class);

        Route::resource('donation-gifts', DonationGiftController::class);

        Route::delete('/donation-gifts-destroy/{deleteGiftId}',
            [DonationGiftController::class, 'giftDestroy'])->name('donation.gift.destroy');
    });
    // Teams
    Route::middleware('permission:manage_teams')->group(function () {
        Route::resource('team-members', TeamController::class);
        Route::post('team-members/{team}',
            [TeamController::class, 'update'])->name('teams.update');
    });

    Route::middleware('permission:manage_faqs')->group(function () {
        Route::resource('faqs', FaqsController::class);
    });

    // Languages
    Route::middleware('permission:manage_language')->group(function () {
        Route::resource('languages', LanguageController::class);
        Route::get('languages/translation/{language}',
            [LanguageController::class, 'showTranslation'])->name('languages.translation');
        Route::post('languages/translation/{language}/update',
            [LanguageController::class, 'updateTranslation'])->name('languages.translation.update');
    });
});
