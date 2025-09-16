<?php

namespace App\Repositories;

use App\Models\CampaignDonation;
use App\Models\CampaignDonationTransaction;
use App\Models\Earnings;
use DB;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class StripeRepository
 */
class StripeRepository
{
    /**
     * @param $sessionId
     */
    public function donationPaymentSuccess($sessionId)
    {
        setStripeApiKey();
        $sessionData = \Stripe\Checkout\Session::retrieve($sessionId);

        $stripeID = $sessionData->id;
        $paymentStatus = $sessionData->payment_status;
        $amount = (strtoupper($sessionData->currency) != 'JPY') ? $sessionData->amount_total / 100 : $sessionData->amount_total;
        $campaignId = $sessionData->client_reference_id;
        $giftId = session('check_gift_id');

        $transactionData = [
            'transaction_id' => $stripeID,
            'amount' => $amount,
            'campaign_id' => $campaignId,
            'gift_id' => $giftId,
            'payment_method' => CampaignDonationTransaction::STRIPE,
            'payload' => json_encode($sessionData),
        ];

        try {
            DB::beginTransaction();

            $campaignDonationTransaction = CampaignDonationTransaction::create($transactionData);
            $loginUserData = getLogInUser();

            $userId = getLogInUser() ? getLogInUserId() : null;
            $firstName = getLogInUser() ? $loginUserData->first_name : $sessionData->metadata->first_name;
            $lastName = getLogInUser() ? $loginUserData->last_name : $sessionData->metadata->last_name;
            $email = getLogInUser() ? $loginUserData->email : $sessionData->metadata->email;

            $chargeAmount = session('charge_amount');
            $donateAnonymously = session('donate_anonymously');

            $paymentData = [
                'campaign_id' => $campaignId,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'user_id' => $userId,
                'donated_amount' => $amount,
                'charge_amount' => $chargeAmount,
                'campaign_donation_transaction_id' => $campaignDonationTransaction->id,
                'donate_anonymously' => $donateAnonymously,
                'gift_id' => $giftId,
            ];

            $campaignDonation = CampaignDonation::create($paymentData);

            session()->forget(['charge_amount', 'donate_anonymously', 'gift_id']);

            $commissionAmount = 0;

            $commissionPercentage = getSettingValue('donation_commission');

            if ($commissionPercentage != 0) {
                $commissionAmount = getCommissionAmount($amount, $commissionPercentage);
            }

            $totalAmount = getTotalAmount($amount, $commissionAmount);

            $earningData = [
                'campaign_id' => $campaignId,
                'amount' => $totalAmount,
                'commission_amount' => $commissionAmount,
            ];

            $earning = Earnings::create($earningData);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
