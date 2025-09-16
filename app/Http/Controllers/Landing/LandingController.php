<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCallToActionRequest;
use App\Http\Requests\CreateInquiryRequest;
use App\Http\Requests\CreateNewsCommentsRequest;
use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\CallToAction;
use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\CampaignDonation;
use App\Models\Category;
use App\Models\CategoryThird;
use App\Models\ContactUs;
use App\Models\DonationGift;
use App\Models\Event;
use App\Models\Faqs;
use App\Models\FrontSlider;
use App\Models\FrontSlider2;
use App\Models\FrontSliderThird;
use App\Models\Inquiry;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsComment;
use App\Models\NewsTags;
use App\Models\SecondVideoSection;
use App\Models\Setting;
use App\Models\SliderCard;
use App\Models\SuccessStory;
use App\Models\Team;
use App\Models\ThirdVideoSection;
use App\Models\VideoSection;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LandingController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function home()
    {
        $settings = Setting::pluck('value', 'key');
        $homepage = 'index';

        $data = [];

        if ($settings['active_homepage_status'] == Setting::STATUS_HOMEPAGE_1) {
            $data['events'] = Event::all();
        } else {
            $data['events'] = Event::with('eventCategory')->where('event_date', '>=',
                Carbon::now())->latest()->take(3)->get();
        }

        $data['sliderCard'] = SliderCard::pluck('value', 'key')->toArray();

        $data['teams'] = Team::latest()->take(4)->get();

        $data['faqs'] = Faqs::latest()->take(3)->get();

        $data['videoSection'] = VideoSection::pluck('value', 'key');

        $data['homepageTwoVideo'] = SecondVideoSection::pluck('value', 'key');

        $data['homepageThreeVideo'] = ThirdVideoSection::pluck('value', 'key');

        $data['aboutUs'] = AboutUs::pluck('value', 'key')->toArray();

        $data['sliders'] = FrontSlider::all();

        $data['homepageTwoSliders'] = FrontSlider2::all();

        $data['homepageThreeSliders'] = FrontSliderThird::all();

        $data['homepageTwoCategories'] = Category::pluck('value', 'key');

        $data['homepageThreeCategories'] = CategoryThird::all();

        $data['campaignsCategories'] = CampaignCategory::withCount([
            'campaigns' => function ($q) {
                $q->where('status', '=', Campaign::STATUS_ACTIVE);
            },
        ])->get();

        $data['latestNewsFeeds'] = News::with('newsCategory')->latest()->first();

        $data['oldNewsFeeds'] = News::where('id', '!=',
            $data['latestNewsFeeds'] != null ? $data['latestNewsFeeds']->id : '')->limit(3)->get();

        $data['campaigns'] = Campaign::with('campaignCategory', 'user')->where('status',
            Campaign::STATUS_ACTIVE)->latest()->take(6)->orderBy('is_emergency', 'desc')->get();

        $data['brands'] = Brand::all();

        return view("front_landing.$homepage", compact('data'));
    }

    /**
     * @return Application|Factory|View
     */
    public function aboutUs()
    {
        $aboutUs = AboutUs::pluck('value', 'key')->toArray();
        $brands = Brand::all();
        $successStories = SuccessStory::all();

        return view('front_landing.about', compact('aboutUs', 'brands', 'successStories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function campaign($id = null)
    {
        if ($id) {
            $campaignCategoryId = $id;
        } else {
            $campaignCategoryId = '';
        }
        $contactUs = ContactUs::pluck('value', 'key')->toArray();

        $campaignCategories = CampaignCategory::withCount([
            'campaigns' => function ($q) {
                $q->where('status', '=', Campaign::STATUS_ACTIVE);
            },
        ])->get();

        return view('front_landing.campaigns', compact('campaignCategories', 'contactUs', 'campaignCategoryId'));
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function contact()
    {
        $contactUs = ContactUs::pluck('value', 'key')->toArray();

        return view('front_landing.contact', compact('contactUs'));
    }

    /**
     * @param  CreateInquiryRequest  $request
     * @return JsonResponse
     */
    public function store(CreateInquiryRequest $request)
    {
        $input = $request->all();
        Inquiry::create($input);

        return $this->sendSuccess('Inquiry sent successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function news(Request $request)
    {
        $newsCategoryId = '';
        $newsTagId = '';

        if (isset($request->category)) {
            $newsCategoryId = $request->category;
        }

        if (isset($request->tag)) {
            $newsTagId = $request->tag;
        }

        $mostUser = News::withCount('users')->with('users', 'newsCategory')->whereHas('users',
            function (Builder $query) {
            })->distinct()->take(1)->orderByDesc('users_count')->get();

        $latestFourNews = News::latest()->take(4)->get();

        $newsCategories = NewsCategory::withCount('news')->with('news')->whereHas('news',
            function (Builder $query) {
            })->distinct()->take(6)->orderByDesc('news_count')->get();

        $newsTags = NewsTags::latest()->take(8)->get();

        $newsImg = ContactUs::pluck('value', 'key')->toArray();

        return view('front_landing.news',
            compact('newsCategories', 'newsTags', 'latestFourNews', 'mostUser', 'newsCategoryId', 'newsTagId',
                'newsImg'));
    }

    /**
     * @param  News  $news
     * @return Application|Factory|View
     */
    public function newsDetails(News $news)
    {
        $news = News::with('newsCategory')->where('id', '=', $news->id)->first();

        $relatedPosts = News::with('newsCategory')->where('news_category_id', '=', $news->news_category_id)->where('id', '!=', $news->id)->latest()->take(2)->get();

        $allCommnets = NewsComment::with('users')->where('news_id', '=', $news->id)->orderBy('id', 'desc')->get();

        $newsies = News::latest()->take(3)->get();

        $newsCategories = NewsCategory::withCount('news')->with('news')->whereHas('news',
            function (Builder $query) {
            })->distinct()->take(6)->orderByDesc('news_count')->get();

        $latestFourNews = News::where('id', '!=', $news->id)->latest()->take(4)->get();

        $newsTags = NewsTags::latest()->take(8)->get();

        $newsDetailsImg = ContactUs::pluck('value', 'key')->toArray();

        return view('front_landing.news-details',
            compact('news', 'newsies', 'newsCategories', 'newsTags', 'latestFourNews', 'allCommnets', 'relatedPosts',
                'newsDetailsImg'));
    }

    /**
     * @param  CreateCallToActionRequest  $request
     * @return mixed
     */
    public function callToActions(CreateCallToActionRequest $request)
    {
        CallToAction::create($request->all());

        return $this->sendSuccess('Call To Action Saved Successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function faqs()
    {
        $faqs = Faqs::all();

        $faqsImg = ContactUs::pluck('value', 'key')->toArray();

        return view('front_landing.faqs', compact('faqs', 'faqsImg'));
    }

    /**
     * @param  Campaign  $campaign
     * @return Application|Factory|View
     */
    public function campaignDetails(Campaign $campaign)
    {
        if(in_array($campaign->status ,[Campaign::STATUS_BLOCKED,Campaign::STATUS_FINISHED])){
            return redirect(route('landing.home'));
        }

        $contactUs = ContactUs::pluck('value', 'key')->toArray();

        $campaign = $campaign->load('campaignCategory');

        $campaignCategories = CampaignCategory::withCount([
            'campaigns' => function ($q) {
                $q->where('status', '=', Campaign::STATUS_ACTIVE);
            },
        ])->get();

        $sidebarCampaignCategories = CampaignCategory::withCount('campaigns')->with('campaigns')->whereHas('campaigns',
            function (Builder $query) {
            })->distinct()->take(6)->orderByDesc('campaigns_count')->get();

        $medias = $campaign->getMedia(Campaign::CAMPAIGN_DROP_IMAGE);

        $campaignFaqs = Campaign::with('campaignFaqs')->where('id', '=', $campaign->id)->first();

        $campaignUpdates = Campaign::with('campaignUpdates')->where('id', '=', $campaign->id)->first();

        $allDonors = CampaignDonation::where('campaign_id', '=', $campaign->id)->latest()->take(5)->get();

        $donationEnableGifts = Campaign::with('campaignGifts')->where('id', '=', $campaign->id)->where('gift_status',
            '=', true)->first();

        return view('front_landing.campaign-details',
            compact('campaign', 'campaignCategories', 'medias', 'contactUs', 'campaignFaqs', 'campaignUpdates',
                'sidebarCampaignCategories', 'allDonors', 'donationEnableGifts'));
    }

    /**
     * @param  CreateNewsCommentsRequest  $request
     * @return mixed
     */
    public function newsComments(CreateNewsCommentsRequest $request)
    {
        $newsComments = NewsComment::create($request->all());

        $newsComment = NewsComment::with('users')->where('id', '=', $newsComments->id)->first();

        $commentCount = NewsComment::where('news_id', '=', $request->news_id)->count();

        return $this->sendResponse(['newsComment' => $newsComment, 'commentCount' => $commentCount], 'News Comment saved successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function termCondition()
    {
        $termsConditions = Setting::where('key', 'terms_conditions')->first();

        return view('front_landing.terms-conditions', compact('termsConditions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy()
    {
        $privacyPolicy = Setting::where('key', 'privacy_policy')->first();

        return view('front_landing.privacy-policy', compact('privacyPolicy'));
    }

    /**
     * @param  Campaign  $campaign
     * @return Application|Factory|View
     */
    public function getPayment(Campaign $campaign, $id = null)
    {

        if(in_array($campaign->status ,[Campaign::STATUS_BLOCKED,Campaign::STATUS_FINISHED])){
            return redirect(route('landing.home'));
        }

        if ($id) {
            $giftAsDonationId = $id;
        } else {
            $giftAsDonationId = '';
        }

        $donationAsGiftDetails = DonationGift::whereId($giftAsDonationId)->get()->first();

        $allDonors = CampaignDonation::where('campaign_id', '=', $campaign->id)->latest()->take(5)->get();

        $donationEnableGifts = Campaign::with('campaignGifts')->where('id', '=', $campaign->id)->where('gift_status', '=', true)->first();

        $amount_prefilled = $campaign->amount_prefilled;

//        $withdrawal = Withdrawal::wherePaymentType('Stripe')->first();
//
//        if ($withdrawal->discount_type == Withdrawal::FIXED){
//            $totalAmount = $amount_prefilled + $withdrawal->discount;
//            $chargeAmount = $withdrawal->discount;
//        } else {
//            $totalAmount = $amount_prefilled + ($amount_prefilled * $withdrawal->discount) / 100;
//            $chargeAmount = ($amount_prefilled * $withdrawal->discount) / 100;
//        }
//
//        $stripeWithdraw = Withdrawal::wherePaymentType('Stripe')->first();
//        $paypalWithdraw = Withdrawal::wherePaymentType('PayPal')->first();

//        return view('front_landing.payment', compact('campaign', 'stripeWithdraw', 'paypalWithdraw', 'totalAmount', 'chargeAmount'));

        $typeOfCommission = getSettingValue('charges_type');
        $donationCommission = getSettingValue('donation_commission');

        $totalAmount = $amount_prefilled;
        $chargeAmount = 0;

        if ($donationCommission > 0) {
            if ($typeOfCommission == Setting::PERCENTAGE) {
                $totalAmount = $amount_prefilled + ($amount_prefilled * $donationCommission) / 100;
                $chargeAmount = ($amount_prefilled * $donationCommission) / 100;
            } else {
                $totalAmount = $amount_prefilled + $donationCommission;
                $chargeAmount = $donationCommission;
            }
        }

//        return view('front_landing.payment', compact('campaign', 'stripeWithdraw', 'paypalWithdraw', 'totalAmount', 'chargeAmount'));

        return view('front_landing.payment',
            compact('campaign', 'totalAmount', 'chargeAmount', 'typeOfCommission', 'donationCommission',
                'donationAsGiftDetails', 'allDonors', 'donationEnableGifts'));
    }

    public function changeLanguage($language)
    {
        Session::put('languageName', $language);
        return redirect()->back();
    }
}
