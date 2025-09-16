<?php

namespace App\Http\Controllers;

use App\Models\CampaignDonation;

class UserTransactionController extends AppBaseController
{
    /**
     * @param  CampaignDonation  $transaction
     * @return mixed
     */
    public function show(CampaignDonation $transaction)
    {
        $transaction->load('CampaignDonationTransaction', 'campaign');

        return $this->sendResponse($transaction, 'Transaction Retrieved Successfully.');
    }
}
