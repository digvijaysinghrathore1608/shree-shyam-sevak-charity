<?php

use App\Models\Brand;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\Language;
use App\Models\News;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use App\Models\Withdraw;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

/**
 * @return Authenticatable|null
 */
function getLogInUser()
{
    return Auth::user();
}

/**
 * @return mixed
 */
function getAppName()
{
    static $appName;

    if (empty($appName)) {
        $appName = Setting::where('key', '=', 'application_name')->first()->value;
    }

    return $appName;
}

function settings()
{
    return Setting::toBase()->pluck('value', 'key')->toArray();
}

function getSettingValue($key)
{
    $value = null;

    $keyExist = Setting::where('key', '=', $key)->exists();

    if ($keyExist) {
        $value = Setting::where('key', '=', $key)->first()->value;
    }

    return $value;
}

function latestNews()
{
    return News::with('newsCategory')->latest()->take(3)->get();
}

function brands()
{
    return $brands = Brand::all();
}

/**
 * @return Page[]|Collection
 */
function pages()
{
    $page = Page::all();

    return $page;
}

/**
 * @return int
 */
function getLogInUserId()
{
    return Auth::user()->id;
}

/**
 * @return string
 */
function getDashboardURL()
{
    if (Auth::user()->hasRole('admin')) {
        return RouteServiceProvider::ADMIN_DASHBOARD;
    } elseif (Auth::user()->hasRole('user')) {
        return RouteServiceProvider::USER_DASHBOARD;
    }
    if (Auth::user() !== null) {
        /** @var User $user */
        $user = Auth::user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        if (in_array('manage_dashboard', $permissions, true)) {
            return 'admin/dashboard';
        }

        if (in_array('manage_campaign', $permissions, true)) {
            return 'admin/campaigns';
        }

        if (in_array('manage_events', $permissions, true)) {
            return 'admin/events';
        }

        if (in_array('manage_news', $permissions, true)) {
            return 'admin/news';
        }

        if (in_array('manage_users', $permissions, true)) {
            return 'admin/users';
        }

        if (in_array('manage_pages', $permissions, true)) {
            return 'admin/pages';
        }

        if (in_array('manage_brands', $permissions, true)) {
            return 'admin/brands';
        }

        if (in_array('manage_inquiries', $permissions, true)) {
            return 'admin/inquiries';
        }

        if (in_array('manage_language', $permissions, true)) {
            return 'admin/languages';
        }

        if (in_array('manage_settings', $permissions, true)) {
            return 'admin/settings';
        }

        if (in_array('manage_roles', $permissions, true)) {
            return 'admin/roles';
        }
    }

    return RouteServiceProvider::HOME;
}

function checkRoutePermissions($input)
{
    $user = Auth::user();
    $permissions = $user->getAllPermissions()->pluck('name')->toArray();

    foreach ($input as $key => $value) {
        if (in_array($value, $permissions, true)) {

            //first sliders

            if ($value === 'manage_success_stories') {
                return '/admin/success-stories';
            }

            if ($value === 'manage_email_subscribe') {
                return '/admin/email-subscribe';
            }

            if ($value === 'manage_about_us') {
                return '/admin/about-us';
            }

            if ($value === 'manage_contact_us') {
                return '/admin/contact-us';
            }

            if ($value === 'manage_faqs') {
                return '/admin/faqs';
            }

            if ($value === 'manage_teams') {
                return '/admin/team-members';
            }

            if ($value === 'manage_terms_conditions') {
                return '/admin/terms-conditions';
            }

            // second sliders

            // third sliders
            if ($value === 'manage_sliders_third') {
                return '/admin/third-slider';
            }

            if ($value === 'manage_categories_third') {
                return '/admin/third-categories';
            }

            if ($value === 'manage_video_section_third') {
                return '/admin/third-video-section';
            }
        }
    }
}

function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first();
    }

    return $appLogo->logo_url;
}

function getFaviconUrl()
{
    static $favicon;

    if (empty($favicon)) {
        $favicon = Setting::with('media')->where('key', '=', 'app_favicon')->first();
    }

    return $favicon->favicon_url;
}

function YoutubeID($url)
{
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
        $url, $match)) {
        return $match[1];
    }

    return $url;
}
/**
@return mixed
 */
function getCurrencySymbol($currency)
{
    $currencyPath = file_get_contents(resource_path().'/currencies/defaultCurrency.json');
    $currenciesData = json_decode($currencyPath, true)['currencies'];

    if (isset($currency)) {
        $currencySymbol = collect($currenciesData)->where('code',
            strtoupper($currency))->pluck('symbol')->first();
    } else {
        $currencySymbol = collect($currenciesData)->where('code',
            strtoupper('Usd'))->pluck('symbol')->first();
    }

    return $currencySymbol;
}

function setStripeApiKey()
{
    Stripe::setApiKey(getSettingValue('stripe_secret'));
}

/**
 * @param $raisedAmount
 * @param $goal
 * @return float|int
 */
function getRaisedAmountPercentage($raisedAmount, $goal)
{
    if ($goal == 0) {
        return number_format(0, 2);
    }
    $percentage = ($raisedAmount / $goal) * 100;
    if ($percentage > 100) {
        $percentage = 100;
    }

    return number_format($percentage, 2);
}

function getCommissionAmount($amount, $commissionPercentage)
{
    $commissionAmount = (float) $amount * $commissionPercentage / 100;

    return $commissionAmount;
}

function getTotalAmount($amount, $commissionAmount)
{
    $totalAmount = $amount - $commissionAmount;

    return $totalAmount;
}

/**
 * @return Language[]|Collection
 */
function getAllLanguage()
{
    return Language::all();
}

/**
 * @param $id
 * @return bool
 */
function campaignEnd($id)
{
    $campaign = Campaign::whereId($id)->first();

    if ($campaign->campaign_end_method == Campaign::AFTER_END_DATE &&
        $campaign->deadline < Carbon::now()->toDateString()) {
        return true;
    }

    if ($campaign->campaign_end_method == Campaign::AFTER_GOAL_ACHIEVE &&
        $campaign->campaignDonations->sum('donated_amount') >= $campaign->goal) {
        return true;
    }

    return false;
}

function getChartColor(): array
{
    return [
        'rgb(245, 158, 11',
        'rgb(77, 124, 15',
        'rgb(254, 199, 2',
        'rgb(80, 205, 137',
        'rgb(16, 158, 247',
        'rgb(241, 65, 108',
        'rgb(80, 205, 137',
        'rgb(245, 152, 28',
        'rgb(13, 148, 136',
        'rgb(59, 130, 246',
        'rgb(162, 28, 175',
        'rgb(190, 18, 60',
        'rgb(244, 63, 94',
        'rgb(30, 30, 45',
    ];
}

/**
 * @param $campaignCategoryId
 * @return int
 */
function getCampaignCount($campaignCategoryId)
{
    $campaigns = Campaign::where('campaign_category_id', $campaignCategoryId)
        ->where('status', Campaign::STATUS_ACTIVE)->get();

    $campaignCount = 0;
    foreach ($campaigns as $campaign) {
        $goal = CampaignDonation::where('campaign_id', $campaign->id)->sum('donated_amount');
        if ($campaign->campaign_end_method == Campaign::AFTER_END_DATE) {
            if ($campaign->deadline >= Carbon::now()) {
                $campaignCount++;
            }
        } else {
            if ($campaign->goal >= $goal) {
                $campaignCount++;
            }
        }
    }

    return $campaignCount;
}

function getSettlementAmount($data)
{
    $withdraw = Withdraw::where('campaign_id', $data->id)
        ->where('is_approved', Withdraw::APPROVED)
        ->where('status', Withdraw::APPROVED)->sum('amount');

    $settlementAmount = CampaignDonation::where('campaign_id', $data->id)->sum('donated_amount');

    if (empty($withdraw)) {
        return $settlementAmount;
    }

    return $settlementAmount - $withdraw;
}

/**
 * @param $row
 * @return bool
 */
function isDisabledRejectBtn($row): bool
{
    if ($row->status == Withdraw::REJECTED) {
        return true;
    }

    return false;
}

/**
 * @param $row
 * @return bool
 */
function isUserDisabledApproveBtn($row)
{
    $status = $row->status;

    $withdraw = Withdraw::where('campaign_id', $row->campaign->id)->where('status', Withdraw::PENDING)->first();
    if (! empty($withdraw)) {
        return true;
    }
    if ($status != Withdraw::APPROVED && $status != Withdraw::REJECTED) {
        return true;
    }

    $withdraw = Withdraw::where('campaign_id', $row->campaign->id)->where('status', Withdraw::REJECTED)->first();
    if (! empty($withdraw)) {
        return false;
    }

    if (getSettlementAmount($row) > 0) {
        return false;
    }

    return false;
}

/**
 * @param $row
 * @return false
 */
function checkRequestIsPending($row)
{
    $withdraw = Withdraw::where('campaign_id', $row->id)->where('status', Withdraw::PENDING)->first();

    if (! empty($withdraw)) {
        return true;
    }

    return false;
}

function formatCurrency($currencyValue)
{
    $amountValue = $currencyValue;
    $precision = 2;

    if ($amountValue < 900) {
        // 0 - 900
        $numberFormat = number_format($amountValue, $precision);
        $suffix = '';
    } else {
        if ($amountValue < 900000) {
            // 0.9k-850k
            $numberFormat = number_format($amountValue / 1000, $precision);
            $suffix = 'K';
        } else {
            if ($amountValue < 900000000) {
                // 0.9m-850m
                $numberFormat = number_format($amountValue / 1000000, $precision);
                $suffix = 'M';
            } else {
                if ($amountValue < 900000000000) {
                    // 0.9b-850b
                    $numberFormat = number_format($amountValue / 1000000000, $precision);
                    $suffix = 'B';
                } else {
                    // 0.9t+
                    $numberFormat = number_format($amountValue / 1000000000000, $precision);
                    $suffix = 'T';
                }
            }
        }
    }

    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
        $dotZero = '.'.str_repeat('0', $precision);
        $numberFormat = str_replace($dotZero, '', $numberFormat);
    }

    //  return $formattedAmount.' '.$currencySuffix;

    return $numberFormat.' '.$suffix;
}

/**
 * @return string[]
 */
function getPayPalSupportedCurrencies(): array
{
    return [
        'AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK',
        'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD',
    ];
}
function getHeaderLanguageName()
{
    $language = Language::where("iso_code", App::getLocale())->first();
    if (!empty($language)) {
        return $language->name;
    } else {
        return "English";
    }
}
