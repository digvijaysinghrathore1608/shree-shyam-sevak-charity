<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\CampaignDonationTransaction;
use App\Models\Earnings;
use App\Models\Setting;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use PayPalHttp\IOException;

class PaypalController extends AppBaseController
{
    /**
     * @param  Request  $request
     * @throws HttpException
     * @throws IOException
     *@return Application|Redirector|RedirectResponse
     */
    public function onBoard(Request $request)
    {
        $amount = $request->get('amount');
        $campaignId = $request->get('campaign_id');

        $campaign = Campaign::findOrFail($campaignId);
        if(in_array($campaign->status ,[Campaign::STATUS_BLOCKED,Campaign::STATUS_FINISHED])){
            return $this->sendError('This Campaign is not active.');
        }
//        $withdrawal = Withdrawal::wherePaymentType('PayPal')->first();
//        if ($withdrawal->discount_type == Withdrawal::FIXED){
//            $totalAmount = $amount + $withdrawal->discount;
        ////            dd($totalAmount);
//        } else {
//            $totalAmount = $amount + ($amount * $withdrawal->discount) / 100;
        ////            dd($totalAmount);
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

        $donateAnonymously = $request->get('donate_anonymously') ? 1 : 0;
        $giftId = $request->get('gift_id');
        $checkGiftId = $giftId ? $giftId : null;

        session(['charge_amount' => $chargeAmount, 'donate_anonymously' => $donateAnonymously, 'check_gift_id' => $checkGiftId]);

        $currencyCode = strtoupper($request->get('currency_code'));

        if (!empty($currencyCode) && !in_array($currencyCode,getPayPalSupportedCurrencies())){
            return $this->sendError('This currency is not supported by PayPal.');
        }

        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');

        $clientId = getSettingValue('paypal_client_id');
        $clientSecret = getSettingValue('paypal_secret');
        $mode = getSettingValue('paypal_mode');

        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }

        $client = new PayPalHttpClient($environment);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $campaignId,
                    'amount' => [
                        //                        "value"         => $amount,
                        'value' => $totalAmount,
                        'currency_code' => $currencyCode,
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('paypal.failed'),
                'return_url' => route('paypal.success'),
            ],
        ];

        $order = $client->execute($request);

        session(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'campaign_id' => $campaignId]);

        return response()->json($order);
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function failed()
    {
        $campaign = Campaign::whereId(session('campaign_id'))->first()->only('slug');

        session()->forget(['first_name', 'last_name', 'email', 'campaign_id']);

        Flash::error('Your Payment is Cancelled');

        return redirect(route('landing.campaign.details', $campaign['slug']));
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws IOException
     */
    public function success(Request $request)
    {
        $clientId = getSettingValue('paypal_client_id');
        $clientSecret = getSettingValue('paypal_secret');
        $mode = getSettingValue('paypal_mode');

        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest($request->get('token'));
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            $campaignId = $response->result->purchase_units[0]->reference_id;
//            $amount = $response->result->purchase_units[0]->amount->value;
            $totalAmount = $response->result->purchase_units[0]->amount->value;
            $transactionId = $response->result->id;
            $giftId = session('check_gift_id');

            $transactionDetails = [
                'transaction_id' => $transactionId,
                //                'amount'         => $amount,
                'amount' => $totalAmount,
                'campaign_id' => $campaignId,
                'gift_id' => $giftId,
                'payment_method' => CampaignDonationTransaction::PAYPAL,
                'payload' => json_encode($response),
            ];
            $campaignDonationTransaction = CampaignDonationTransaction::create($transactionDetails);

            $loginUserData = getLogInUser();

            $userId = getLogInUser() ? getLogInUserId() : null;
            $firstName = getLogInUser() ? $loginUserData->first_name : session('first_name');
            $lastName = getLogInUser() ? $loginUserData->last_name : session('last_name');
            $email = getLogInUser() ? $loginUserData->email : session('email');

            $chargeAmount = session('charge_amount');
            $donateAnonymously = session('donate_anonymously');

            $paymentData = [
                'campaign_id' => $campaignId,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'user_id' => $userId,
                'donated_amount' => $totalAmount,
                'charge_amount' => $chargeAmount,
                'campaign_donation_transaction_id' => $campaignDonationTransaction->id,
                'donate_anonymously' => $donateAnonymously,
                'gift_id' => $giftId,
            ];

            $campaignDonation = CampaignDonation::create($paymentData);

            $commissionAmount = 0;

            $commissionPercentage = getSettingValue('donation_commission');

            if ($commissionPercentage != 0) {
//                $commissionAmount = getCommissionAmount($amount, $commissionPercentage);
                $commissionAmount = getCommissionAmount($totalAmount, $commissionPercentage);
            }

//            $totalAmount = getTotalAmount($amount, $commissionAmount);
            $totalAmount = getTotalAmount($totalAmount, $commissionAmount);

            $earningData = [
                'campaign_id' => $campaignId,
                'amount' => $totalAmount,
                'commission_amount' => $commissionAmount,
            ];

            $earning = Earnings::create($earningData);

            $campaign = Campaign::whereId(session('campaign_id'))->first()->only('slug');

            session()->forget(['first_name', 'last_name', 'email', 'campaign_id']);

            Flash::success('Payment successfully done.');

            return redirect(route('landing.campaign.details', $campaign['slug']));
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
