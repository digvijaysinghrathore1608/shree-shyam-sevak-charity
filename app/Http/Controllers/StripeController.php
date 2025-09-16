<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Setting;
use App\Repositories\StripeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StripeController extends AppBaseController
{
    public StripeRepository $stripeRepository;

    /**
     * StripeController constructor.
     *
     * @param  StripeRepository  $stripeRepository
     */
    public function __construct(StripeRepository $stripeRepository)
    {
        $this->stripeRepository = $stripeRepository;
    }

    /**
     * @param  Request  $request
     * @throws ApiErrorException
     * @return Application|Redirector|RedirectResponse
     */
    public function createSession(Request $request)
    {
        $amount = $request->get('amount');
        $campaignId = $request->get('campaign_id');

        $campaign = Campaign::findOrFail($campaignId);
        if(in_array($campaign->status ,[Campaign::STATUS_BLOCKED,Campaign::STATUS_FINISHED])){
            return $this->sendError('This Campaign is not active.');
        }
//        $withdrawal = Withdrawal::wherePaymentType('Stripe')->first();
//        if ($withdrawal->discount_type == Withdrawal::FIXED){
//             $totalAmount = $amount + $withdrawal->discount;
//        } else {
//            $totalAmount = $amount + ($amount * $withdrawal->discount) / 100;
//        }

        $typeOfCommission = getSettingValue('charges_type');
        $donationCommission = getSettingValue('donation_commission');

        $totalAmount = $amount;
        $chargeAmount = 0;

        if ($donationCommission > 0) {
            if ($typeOfCommission == Setting::PERCENTAGE) {
                $totalAmount = $amount + ($amount * $donationCommission) / 100;
                $chargeAmount = ($amount * $donationCommission) / 100;
            } else {
                $totalAmount = $amount + $donationCommission;
                $chargeAmount = $donationCommission;
            }
        }

        $donateAnonymously = $request->get('donate_anonymously') == 1 ? 1 : 0;
        $giftId = $request->get('gift_id');
        $checkGiftId = $giftId ? $giftId : null;

        session(['charge_amount' => $chargeAmount, 'donate_anonymously' => $donateAnonymously, 'check_gift_id' => $checkGiftId]);

        $currencyCode = $request->get('currency_code');
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');

        setStripeApiKey();

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => 'BILL OF PRODUCT #'.$campaignId,
                            'description' => 'BILL OF PRODUCT #'.$currencyCode,
                        ],
                        'unit_amount' => (strtoupper($currencyCode) != 'JPY') ? $totalAmount * 100 : $totalAmount,
                        'currency' => $currencyCode,
                    ],
                    'quantity' => 1,
                ],
            ],
            'billing_address_collection' => 'auto',
            'client_reference_id' => $campaignId,
            'metadata' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,

            ],
            'mode' => 'payment',
            'success_url' => url('payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url('failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        session(['campaign_id' => $campaignId]);

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        $this->stripeRepository->donationPaymentSuccess($sessionId);

        $campaign = Campaign::whereId(session('campaign_id'))->first()->only('slug');

        session()->forget(['campaign_id', 'gift_id']);

        Flash::success('Payment successfully done.');

        return redirect(route('landing.campaign.details', $campaign['slug']));
    }

    /**
     * @return RedirectResponse
     */
    public function handleFailedPayment(): RedirectResponse
    {
        $campaign = Campaign::whereId(session('campaign_id'))->first()->only('slug');

        session()->forget(['campaign_id']);

        Flash::error('Your Payment is Cancelled');

        return redirect(route('landing.campaign.details', $campaign['slug']));
    }
}
