<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\UserCampaignController;
use App\Http\Controllers\UserCampaignFaqController;
use App\Http\Controllers\UserCampaignUpdatesController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\UserWithdrawController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->middleware('auth', 'xss', 'valid.user', 'role:user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/donation-withdraw-chart',
            [DashboardController::class, 'donationWithdrawChart'])->name('donation.withdraw.chart');

//    Route::group(['middleware' => ['permission:manage_user_campaign']], function () {
    // Campaigns
    Route::resource('campaigns', UserCampaignController::class);
    Route::post('update-field/{id}', [UserCampaignController::class, 'updateField'])->name('update.field');
    Route::post('campaign-file/{id}',
            [UserCampaignController::class, 'campaignFileStore'])->name('campaign.file.store');
    Route::get('get-campaign-file/{id}', [UserCampaignController::class, 'getCampaignFile'])->name('get.campaign.file');
    Route::post('remove-campaign-file',
        [UserCampaignController::class, 'removeCampaignFile'])->name('remove.campaign.file');
    Route::resource('campaign-faqs', UserCampaignFaqController::class);
    Route::resource('campaign-updates', UserCampaignUpdatesController::class);
    Route::get('/transaction/{transaction?}', [UserTransactionController::class, 'show'])->name('transaction.show');

    Route::get('payout-settings', [UserSettingController::class, 'index'])->name('settings.index');
    Route::post('payout-setting/update', [UserSettingController::class, 'update'])->name('settings-update');
    // });

    Route::resource('withdraw', UserWithdrawController::class);

    Route::get('get-commission/{campaign_id}', [UserWithdrawController::class, 'getCommission'])->name('get-commission');
});
